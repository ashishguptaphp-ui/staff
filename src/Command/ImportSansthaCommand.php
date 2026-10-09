<?php
namespace App\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\Datasource\ConnectionManager;
use Exception;

class ImportSansthaCommand extends Command
{
    protected function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {
        $parser->setDescription('Imports Sanstha data from a specified CSV file in the background.');
        
        // Add an argument so you can pass the path of the file to the command
        $parser->addArgument('file_path', [
            'help' => 'The absolute path to the CSV file',
            'required' => true
        ]);

        return $parser;
    }

    public function execute(Arguments $args, ConsoleIo $io): ?int
    {
        $startTime = microtime(true);
        $csvFilePath = $args->getArgument('file_path');

        if (!file_exists($csvFilePath) || !($handle = fopen($csvFilePath, 'r'))) {
            $io->error("Cannot open CSV file at: " . $csvFilePath);
            return static::CODE_ERROR;
        }

        $io->info("Starting background import processing for file: " . $csvFilePath);

        // Extract headers with double quote support
        $headers = fgetcsv($handle, 1000, ",", '"');
        $connection = ConnectionManager::get('default');
        $sansthaTable = $this->fetchTable('Sansthas');

        if (!in_array('sanstha_code', $headers)) {
            fclose($handle);
            $io->error('CSV file must contain a "sanstha_code" column header.');
            return static::CODE_ERROR;
        }

        $headerMap = [
            'sanstha_code'          => 'code',
            'sanstha_name'          => 'name',
            'minority_sanstha'      => 'minority_sanstha',
            'sanstha_minority_name' => 'sanstha_minority_name',
            'distcd'                => 'district_code',
            'distname'              => 'district_name',
            'mobile'                => 'mobile'
        ];

        $insertedCount = 0;
        $updatedCount = 0;
        $processedRows = 0;

        $connection->begin();

        try {
            while (($row = fgetcsv($handle, 1000, ",", '"')) !== false) {
                if (empty($row) || $row === [null]) {
                    continue;
                }

                $processedRows++;

                // Align array size discrepancies
                $headerCount = count($headers);
                $rowCountElements = count($row);
                if ($rowCountElements < $headerCount) {
                    $row = array_pad($row, $headerCount, null);
                } elseif ($rowCountElements > $headerCount) {
                    $row = array_slice($row, 0, $headerCount);
                }

                $csvData = array_combine($headers, $row);
                $dbData = [];
                foreach ($csvData as $csvKey => $value) {
                    if (isset($headerMap[$csvKey])) {
                        $dbData[$headerMap[$csvKey]] = ($value !== null) ? trim($value) : null;
                    }
                }

                if (empty($dbData['code'])) {
                    continue;
                }

                $existingRecord = $sansthaTable->find()
                    ->where(['code' => $dbData['code']])
                    ->first();

                if ($existingRecord) {
                    $entity = $sansthaTable->patchEntity($existingRecord, $dbData);
                    $isNew = false;
                } else {
                    $entity = $sansthaTable->newEntity($dbData);
                    $isNew = true;
                }

                if ($entity->getErrors()) {
                    throw new Exception("Row {$processedRows} validation failed: " . json_encode($entity->getErrors()));
                }

                $isDirty = $entity->isDirty();

                if ($sansthaTable->save($entity)) {
                    if ($isNew) {
                        $insertedCount++;
                    } elseif ($isDirty) {
                        $updatedCount++;
                    }
                }

                // Periodic commit and output to CLI terminal logs
                if ($processedRows % 1000 === 0) {
                    $connection->commit();
                    $connection->begin();
                    $io->verbose("Processed {$processedRows} records...");
                }
            }

            $connection->commit();
            fclose($handle);

            $endTime = microtime(true);
            $executionTime = round($endTime - $startTime, 4);

            $io->success("Import Completed Successfully!");
            $io->hr();
            $io->info("Total rows parsed: " . $processedRows);
            $io->info("Records inserted: " . $insertedCount);
            $io->info("Records updated: " . $updatedCount);
            $io->info("Execution time: " . $executionTime . " seconds");

            return static::CODE_SUCCESS;

        } catch (Exception $e) {
            $connection->rollback();
            fclose($handle);
            $io->error("Import process terminated: " . $e->getMessage());
            return static::CODE_ERROR;
        }
    }
}

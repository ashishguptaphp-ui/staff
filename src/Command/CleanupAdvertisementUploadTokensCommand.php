<?php
declare(strict_types=1);

namespace App\Command;

use App\Service\EsdlStorageService;
use Cake\Console\Arguments;
use Cake\Command\Command;
use Cake\Console\ConsoleIo;
use Cake\I18n\FrozenTime;
use Cake\Log\Log;
use Cake\ORM\TableRegistry;
use Throwable;

class CleanupAdvertisementUploadTokensCommand extends Command
{
    public function execute(Arguments $args, ConsoleIo $io): ?int
    {
        $table = TableRegistry::getTableLocator()->get('PostAdvertisementUploadTokens');
        $connection = $table->getConnection();
        $storage = new EsdlStorageService();
        $now = FrozenTime::now();
        $ids = $table->find()
            ->select(['id'])
            ->where([
                'status IN' => ['uploaded', 'cleanup_pending'],
                'expires_at <=' => $now,
            ])
            ->limit(100)
            ->all()
            ->extract('id')
            ->toList();

        $deleted = 0;
        $failed = 0;

        foreach ($ids as $id) {
            try {
                $storageKey = $connection->transactional(function () use ($table, $id, $now) {
                    $upload = $table->find()
                        ->where([
                            'id' => $id,
                            'status IN' => ['uploaded', 'cleanup_pending'],
                            'expires_at <=' => $now,
                        ])
                        ->epilog('FOR UPDATE')
                        ->first();

                    if (!$upload) {
                        return null;
                    }

                    if ($upload->status === 'uploaded') {
                        $table->updateAll(
                            ['status' => 'cleanup_pending'],
                            ['id' => $id, 'status' => 'uploaded']
                        );
                    }

                    return $upload->storage_key;
                });

                if ($storageKey === null) {
                    continue;
                }

                $storage->delete($storageKey);
                $upload = $table->get($id);
                if (!$table->delete($upload)) {
                    throw new \RuntimeException('Unable to delete expired upload token row ' . $id);
                }
                $deleted++;
            } catch (Throwable $exception) {
                $failed++;
                Log::error('Advertisement upload cleanup failed: ' . $exception->getMessage());
                $io->err('Cleanup failed for upload row ' . $id . '. It will be retried.');
            }
        }

        $io->out(sprintf('Deleted %d expired uploads; %d will be retried.', $deleted, $failed));

        return $failed > 0 ? static::CODE_ERROR : static::CODE_SUCCESS;
    }
}

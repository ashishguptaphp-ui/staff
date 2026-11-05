<?php
declare(strict_types=1);

namespace App\Command;

use App\Service\SmsNotificationService;
use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\I18n\FrozenTime;
use Cake\ORM\TableRegistry;
use Throwable;
use Cake\Log\Log;

class SendAdvertisementSmsCommand extends Command
{
    public static function defaultName(): string
    {
        return 'send_advertisement_sms';
    }

    public function execute(
        Arguments $args,
        ConsoleIo $io
    ): int {
        $logTable = TableRegistry::getTableLocator()
            ->get('SmsNotificationLog');

        // Process up to 100 pending SMS notifications.
        $logs = $logTable->find()
            ->where([
                'module_name' => 'advertisement',
                'flag_status' => 0,
            ])
            ->orderBy(['id' => 'ASC'])
            ->limit(100)
            ->all();

        $sent = 0;
        $failed = 0;

        $smsService = new SmsNotificationService();

        foreach ($logs as $log) {
            try {
                // Your existing recipient creation and SMS sending
                // logic should be moved into this service method.
                $result = $smsService->processAdvertisementSms(
                    (int)$log->application_id,
                    (int)$log->id
                );

                echo "Processing SMS log ID: {$log->id}, Result: " . ($result ? 'Success' : 'Failure') . PHP_EOL;
                if ($result) {
                    $log->flag_status = 1;
                    //$log->updated_at = FrozenTime::now();

                    if ($logTable->save($log)) {
                        $sent++;
                    } else {
                        $failed++;
                    }
                } else {
                    $failed++;
                }
            } catch (Throwable $e) {
                $failed++;

                $io->err(
                    'SMS log ID ' . $log->id .
                    ' failed: ' . $e->getMessage()
                );
            }
        }

        $io->out(
            sprintf(
                'Processed %d notifications; %d successful; %d failed.',
                $sent + $failed,
                $sent,
                $failed
            )
        );

        return $failed > 0
            ? static::CODE_ERROR
            : static::CODE_SUCCESS;
    }
}
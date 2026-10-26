<?php
declare(strict_types=1);

namespace App\Service;

use Cake\ORM\TableRegistry;

class SmsNotificationService
{
    /**
     * Save an SMS notification log.
     *
     * This method records the SMS request.
     * Actual SMS delivery requires a configured SMS gateway.
     */
    public function logSms(array $data): array
    {
        $table = TableRegistry::getTableLocator()
            ->get('SmsNotificationLog');

        $smsLog = $table->newEntity([
            'sms_template_id' => $data['sms_template_id'] ?? null,
            'text' => $data['text'] ?? '',
            'sender' => $data['sender'] ?? null,
            'status' => $data['status'] ?? 'pending',
            'created_by' => $data['created_by'] ?? null,
            'application_id' => $data['application_id'] ?? null,
            'module_name' => $data['module_name'] ?? null,
        ]);

        if ($smsLog->hasErrors()) {
            return [
                'success' => false,
                'message' => 'SMS log validation failed.',
                'errors' => $smsLog->getErrors(),
            ];
        }

        $saved = $table->save($smsLog);

        if (!$saved) {
            return [
                'success' => false,
                'message' => 'Failed to save SMS log.',
                'errors' => $smsLog->getErrors(),
            ];
        }

        return [
            'success' => true,
            'message' => 'SMS log saved successfully.',
            'id' => $saved->id,
            'status' => $saved->status,
        ];
    }
}

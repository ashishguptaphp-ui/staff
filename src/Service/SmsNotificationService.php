<?php
declare(strict_types=1);

namespace App\Service;

use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;
use Cake\Log\Log;
use App\Service\SmsService;

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
            'status' => $data['status'] ?? '0',
            'created_by' => $data['created_by'] ?? null,
            'application_id' => $data['application_id'] ?? null,
            'post_id' => $data['post_id'] ?? null,
            'institution_code' => $data['institution_code'] ?? null,
            'institution_name' => $data['institution_name'] ?? null,
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


    public function processAdvertisementSms(
    int $applicationId,
    int $smsNotifyId
    ): bool {


    $PostAdvertisementTable = TableRegistry::getTableLocator()
        ->get('PostAdvertisement');

    $UserTable = TableRegistry::getTableLocator()
        ->get('Users');

    $SmsNotificationRecipients = TableRegistry::getTableLocator()
        ->get('SmsNotificationRecipients');

    $SmsNotificationLog = TableRegistry::getTableLocator()
        ->get('SmsNotificationLog');

    // Fetch advertisement details
    $dataArr = $PostAdvertisementTable->find()
        ->select([
            'id',
            'institution_code',
            'institution_name',
            'is_primary',
            'secondary',
            'higher_secondary'
        ])
        ->where(['id' => $applicationId])
        ->first();

    if (!$dataArr) {
        Log::error(
            'Advertisement not found: ' . $applicationId,
            'error'
        );

        return false;
    }

    // Determine school level
    if ((int)$dataArr->secondary === 1) {
        $medium = 'Secondary';
    } elseif ((int)$dataArr->higher_secondary === 1) {
        $medium = 'Higher_Secondary';
    } elseif ((int)$dataArr->is_primary === 1) {
        $medium = 'Primary';
    } else {
        $medium = 'Not specified';
    }

    $sanstha_name = $dataArr->institution_name;

    // Institution code: first 4 characters
    $institutionCode = substr(
        (string)$dataArr->institution_code,
        0,
        4
    );

    $userList = [];

    /*
     * SECONDARY
     */
    if ($medium === 'Secondary') {

        // Replace with your actual institution code if required.
        $institutionCode = '2707EO02';

        $userList = $UserTable->find()
            ->select([
                'id',
                'username',
                'role',
                'mobile',
                'email'
            ])
            ->where([
                'role' => 'district',
                'username LIKE' => $institutionCode . '%'
            ])
            ->all()
            ->toArray();

        foreach ($userList as $user) {

            $userName = (string)$user->username;

            // Skip SU users
            if (str_ends_with($userName, 'SU')) {
                continue;
            }

            if (str_ends_with($userName, 'CLR')) {
                $role = 'CLR';
                $type = 1;
            } elseif (str_ends_with($userName, 'SUP')) {
                $role = 'SUP';
                $type = 2;
            } else {
                $role = 'EO';
                $type = 3;
            }

            $this->saveSmsRecipient(
                $SmsNotificationRecipients,
                $user,
                $applicationId,
                $smsNotifyId,
                $role,
                $type
            );
        }

    /*
     * HIGHER SECONDARY
     */
    } elseif ($medium === 'Higher_Secondary') {

        $DistrictsTable = TableRegistry::getTableLocator()
            ->get('Districts');

        $RegionsTable = TableRegistry::getTableLocator()
            ->get('Regions');

        // Get region ID from district code
        $district = $DistrictsTable->find()
            ->select(['region_id'])
            ->where(['code' => $institutionCode])
            ->first();

        $regionId = $district?->region_id;

        // Get region code
        $region = $regionId
            ? $RegionsTable->find()
                ->select(['code'])
                ->where(['id' => $regionId])
                ->first()
            : null;

        if (!$region) {
            Log::error(
                'Region not found for institution: ' . $institutionCode
            );

            return false;
        }

        $institutionCode = $region->code . 'DD';

        $userList = $UserTable->find()
            ->select([
                'id',
                'username',
                'role',
                'mobile',
                'email'
            ])
            ->where([
                'role' => 'division',
                'username LIKE' => $institutionCode . '%'
            ])
            ->all()
            ->toArray();

        foreach ($userList as $user) {

            $userName = (string)$user->username;

            // Skip unrelated users
            $skipSuffixes = [
                'CLR',
                'SUP',
                'CLRP',
                'CLRS',
                'EIP',
                'EIS',
                'SUPS'
            ];

            $skipUser = false;

            foreach ($skipSuffixes as $suffix) {
                if (str_ends_with($userName, $suffix)) {
                    $skipUser = true;
                    break;
                }
            }

            if ($skipUser) {
                continue;
            }

            // Identify role
            if (str_ends_with($userName, 'CLRH')) {
                $role = 'CLR';
                $type = 1;
            } elseif (str_ends_with($userName, 'ADIH')) {
                $role = 'ADIH';
                $type = 2;
            } elseif (str_ends_with($userName, 'ADH')) {
                $role = 'ADH';
                $type = 3;
            } elseif ($userName === $institutionCode) {
                $role = 'DD';
                $type = 4;
            } else {
                // Unknown user suffix
                continue;
            }

            $this->saveSmsRecipient(
                $SmsNotificationRecipients,
                $user,
                $applicationId,
                $smsNotifyId,
                $role,
                $type
            );
        }

    } else {
        Log::debug(
            'Unsupported school level: ' . $medium
        );
    }

    /*
 * SEND SMS TO RECIPIENTS
 */

// Get recipients for this application
$recipients = $SmsNotificationRecipients->find()
    ->select([
        'id',
        'mobile_number'
    ])
    ->where([
        'app_id' => $applicationId,
        'sms_notify_id' => $smsNotifyId
    ])
    ->all();

$smsService = new SmsService();

foreach ($recipients as $recipient) {

    $mobileNumber = $recipient->mobile_number;
    $message = $sanstha_name.' संस्थेचा जाहिरात परवानगी प्रस्ताव प्राप्त झाला आहे. प्रस्तावावर आवश्यक कार्यवाही करावी.';
    if (empty($mobileNumber)) {
        continue;
    }

    try {
        $mobileNumber = '9891824962';
        $result= true;
        /*$result = $smsService->sendSMS(
            'otp',
            $mobileNumber,
            $message
        );*/

        // Update SMS recipient status if required
        Log::debug(
            'SMS sent to ' . $sanstha_name . ' (' . $mobileNumber . '): ' . json_encode($result),
            'debug'
        );

    } catch (\Throwable $e) {

        Log::error(
            'SMS sending failed for ' . $mobileNumber . ': ' . $e->getMessage(),
            'error'
        );
    }
}


    return true;
        // Move your existing logic here:
        // 1. Fetch advertisement details.
        // 2. Determine school level.
        // 3. Find users.
        // 4. Save SMS recipients.
        // 5. Send SMS to recipients.
        // 6. Return true only if processing succeeds.

    }


 public function processApplicationSms(
    int $applicationId,
    int $smsNotifyId,
    string $institutionCode
    ): bool {

    $appointmentsTable = TableRegistry::getTableLocator()->get('StaffOnboardingAppointments');

    $appointment = $appointmentsTable->find()
                ->where(['id' => (int)$applicationId])
                ->first();

      $PostAdvertisementVacanciesTable = TableRegistry::getTableLocator()->get('PostAdvertisementVacancies');
      $dataArr = $PostAdvertisementVacanciesTable->getConnection()->execute(
                                'SELECT
                                    pav.id,
                                    pav.post_id,
                                    pa.institution_code,
                                    pa.institution_name,
                                    pa.is_primary,
                                    pa.secondary,
                                    pa.higher_secondary
                                FROM post_advertisement_vacancies pav
                                INNER JOIN post_advertisement pa
                                    ON pa.id = pav.post_advertisement_id
                                WHERE pa.institution_code = :institution_code
                                AND pav.id = :staff_id
                                LIMIT 1',
                                [
                                    'institution_code' => $institutionCode,
                                    'staff_id' => $appointment->staff_id,
                                ]
                            )->fetch('assoc');   


                $UserTable = TableRegistry::getTableLocator()
                    ->get('Users');

                $SmsNotificationRecipients = TableRegistry::getTableLocator()
                    ->get('SmsNotificationRecipients');

                $SmsNotificationLog = TableRegistry::getTableLocator()
                    ->get('SmsNotificationLog');

if (!$dataArr) {
        Log::error(
            'Advertisement not found: ' . $appointment->staff_id,
            'error'
        );

        return false;
    }

    // Determine school level
    if ((int)$dataArr['secondary'] === 1) {
        $medium = 'Secondary';
    } elseif ((int)$dataArr['higher_secondary'] === 1) {
        $medium = 'Higher_Secondary';
    } elseif ((int)$dataArr['is_primary'] === 1) {
        $medium = 'Primary';
    } else {
        $medium = 'Not specified';
    }

    $sanstha_name = $dataArr['institution_name'];

    // Institution code: first 4 characters
    $institutionCode = substr(
        (string)$dataArr['institution_code'],
        0,
        4
    );

    $userList = [];

    /*
     * SECONDARY
     */
    if ($medium === 'Secondary') {

        // Replace with your actual institution code if required.
        $institutionCode = '2707EO02';

        $userList = $UserTable->find()
            ->select([
                'id',
                'username',
                'role',
                'mobile',
                'email'
            ])
            ->where([
                'role' => 'district',
                'username LIKE' => $institutionCode . '%'
            ])
            ->all()
            ->toArray();

        foreach ($userList as $user) {

            $userName = (string)$user->username;

            // Skip SU users
            if (str_ends_with($userName, 'SU')) {
                continue;
            }

            if (str_ends_with($userName, 'CLR')) {
                $role = 'CLR';
                $type = 1;
            } elseif (str_ends_with($userName, 'SUP')) {
                $role = 'SUP';
                $type = 2;
            } else {
                $role = 'EO';
                $type = 3;
            }

            $this->saveSmsRecipient(
                $SmsNotificationRecipients,
                $user,
                $applicationId,
                $smsNotifyId,
                $role,
                $type
            );
        }

    /*
     * HIGHER SECONDARY
     */
    } elseif ($medium === 'Higher_Secondary') {

        $DistrictsTable = TableRegistry::getTableLocator()
            ->get('Districts');

        $RegionsTable = TableRegistry::getTableLocator()
            ->get('Regions');

        // Get region ID from district code
        $district = $DistrictsTable->find()
            ->select(['region_id'])
            ->where(['code' => $institutionCode])
            ->first();

        $regionId = $district?->region_id;

        // Get region code
        $region = $regionId
            ? $RegionsTable->find()
                ->select(['code'])
                ->where(['id' => $regionId])
                ->first()
            : null;

        if (!$region) {
            Log::error(
                'Region not found for institution: ' . $institutionCode,
                'error'
            );

            return false;
        }

        $institutionCode = $region->code . 'DD';

        $userList = $UserTable->find()
            ->select([
                'id',
                'username',
                'role',
                'mobile',
                'email'
            ])
            ->where([
                'role' => 'division',
                'username LIKE' => $institutionCode . '%'
            ])
            ->all()
            ->toArray();

        foreach ($userList as $user) {

            $userName = (string)$user->username;

            // Skip unrelated users
            $skipSuffixes = [
                'CLR',
                'SUP',
                'CLRP',
                'CLRS',
                'EIP',
                'EIS',
                'SUPS'
            ];

            $skipUser = false;

            foreach ($skipSuffixes as $suffix) {
                if (str_ends_with($userName, $suffix)) {
                    $skipUser = true;
                    break;
                }
            }

            if ($skipUser) {
                continue;
            }

            // Identify role
            if (str_ends_with($userName, 'CLRH')) {
                $role = 'CLR';
                $type = 1;
            } elseif (str_ends_with($userName, 'ADIH')) {
                $role = 'ADIH';
                $type = 2;
            } elseif (str_ends_with($userName, 'ADH')) {
                $role = 'ADH';
                $type = 3;
            } elseif ($userName === $institutionCode) {
                $role = 'DD';
                $type = 4;
            } else {
                // Unknown user suffix
                continue;
            }

            $this->saveSmsRecipient(
                $SmsNotificationRecipients,
                $user,
                $applicationId,
                $smsNotifyId,
                $role,
                $type
            );
        }

    } else {
        Log::error(
            'Unsupported school level: ' . $medium,
            'error'
        );
    }


    
// Get recipients for this application
$recipients = $SmsNotificationRecipients->find()
    ->select([
        'id',
        'mobile_number'
    ])
    ->where([
        'app_id' => $applicationId,
        'sms_notify_id' => $smsNotifyId
    ])
    ->all();

$smsService = new SmsService();

foreach ($recipients as $recipient) {

    $mobileNumber = $recipient->mobile_number;
    $message = $sanstha_name.' संस्थेचा कर्मचारी मान्यता प्रस्ताव प्राप्त झाला आहे. प्रस्तावावर आवश्यक कार्यवाही करावी.';
    if (empty($mobileNumber)) {
        continue;
    }

    try {
        $mobileNumber = '9891824962';
        $result = true;
        /*$result = $smsService->sendSMS(
            'otp',
            $mobileNumber,
            $message
        );*/

        // Update SMS recipient status if required
        Log::error(
            'SMS sent to ' . $sanstha_name . ' (' . $mobileNumber . '): ' . json_encode($result),
            'error'
        );

    } catch (\Throwable $e) {

        Log::error(
            'SMS sending failed for ' . $mobileNumber . ': ' . $e->getMessage(),
            'error'
        );
    }
}


    return true;

    }
  
    
private function saveSmsRecipient(
    $SmsNotificationRecipients,
    $user,
    $applicationId,
    $smsNotifyId,
    $role,
    $type
) {
    // Avoid duplicate recipients for the same application
    $existingRecipient = $SmsNotificationRecipients->find()
        ->where([
            'app_id' => $applicationId,
            'sms_notify_id' => $smsNotifyId,
            'userid' => $user->id,
            'role' => $role,
        ])
        ->first();

    if ($existingRecipient) {
        return true;
    }

    $smsRecipient = $SmsNotificationRecipients->newEntity([
        'mobile_number' => $user->mobile,
        'email' => $user->email,
        'app_id' => $applicationId,
        'sms_notify_id' => $smsNotifyId,
        'role' => $role,
        'role_type' => $type,
        'userid' => $user->id,
        'created_at' => FrozenTime::now(),
    ]);

    if (!$SmsNotificationRecipients->save($smsRecipient)) {
        Log::error(
            'SMS recipient save failed: ' .
            json_encode($smsRecipient->getErrors()),
            'error'
        );

        return false;
    }

    return true;
}

}

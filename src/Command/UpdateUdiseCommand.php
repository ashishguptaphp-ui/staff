<?php
declare(strict_types=1);

namespace App\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\Http\Client;
use Exception;

class UpdateUdiseCommand extends Command
{
    /**
     * कमांडचे वर्णन आणि मदत (Help Text) कॉन्फिगर करा.
     */
    protected function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {
        $parser = parent::buildOptionParser($parser);
        $parser->setDescription('Updates UDISE data by Employee ID in the background.');
        return $parser;
    }

    /**
     * मुख्य एक्झिक्युशन लॉजिक
     */
    public function execute(Arguments $args, ConsoleIo $io): ?int
    {
        $io->out('[' . date('Y-m-d H:i:s') . '] UDISE Update process started...');

        // अंतर्गत सुरक्षितपणे URL कॉल करण्यासाठी CakePHP Client चा वापर
        $http = new Client([
            'timeout' => 0, // बॅकग्राउंड प्रोसेस असल्यामुळे टाईमआऊट अनलिमिटेड (0) ठेवला आहे
            'ssl_verify_peer' => false // जर लोकल किंवा सेल्फ-साइंड SSL सर्टिफिकेट असेल तर एरर येऊ नये म्हणून
        ]);

        //$url = 'https://edustaff.maharashtra.gov.in/Education/staff/import/updateUdiseDataByEmpId';
        $url = 'http://localhost/Education/Education/staff/import/updateUdiseDataByEmpId';
        try {
            $io->out("Calling URL: $url");
            
            // GET किंवा POST रिक्वेस्ट पाठवा (तुमच्या गरजेनुसार बदल करा)
            $response = $http->get($url);

            if ($response->isOk()) {
                $io->success('[' . date('Y-m-d H:i:s') . '] UDISE Data updated successfully!');
                // जर URL काही रिस्पॉन्स (JSON/Text) देत असेल तर तो लॉगमध्ये प्रिंट करा:
                $io->verbose("Response: " . $response->getStringBody());
                return static::CODE_SUCCESS;
            } else {
                $io->error('[' . date('Y-m-d H:i:s') . '] Failed to update. HTTP Status: ' . $response->getStatusCode());
                $io->error("Response Error: " . $response->getStringBody());
                return static::CODE_ERROR;
            }

        } catch (Exception $e) {
            $io->error('[' . date('Y-m-d H:i:s') . '] Exception occurred during update:');
            $io->error($e->getMessage());
            return static::CODE_ERROR;
        }
    }
}
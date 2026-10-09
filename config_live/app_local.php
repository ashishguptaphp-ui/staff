<?php

use function Cake\Core\env;

/*
 * Local configuration file to provide any overrides to your app.php configuration.
 * Copy and save this file as app_local.php and make changes as required.
 * Note: It is not recommended to commit files with credentials such as app_local.php
 * into source code version control.
 */
$appMode = 'uat';
if($appMode == 'uat'){
    $esdlMode = 'uat';
    $dbhost = '10.48.143.49';
    $dbusername = 'postgres';
    $dbpassword = 'postgres';
    $dbport = 5432;
    $dbdatabase = 'gov_maha_edu_staff_portal';
    $udiseBasedEmployeesApi = 'http://115.124.116.194:8083/ShalarthPlus/V2/Staffportal/employee/details-Report';
    $shalarthBasedEmployeeApi = 'http://115.124.116.194:8083/ShalarthPlus/employee/details-Report';
}else{
    $esdlMode = 'prod';
    $dbhost = '10.48.168.71';
    $dbusername = 'postgres';
    $dbpassword = 'postgres';
    $dbport = 5433;
    $dbdatabase = 'gov_maha_edu_staff_portal_prod';
    $udiseBasedEmployeesApi = 'https://shalarth.maharashtra.gov.in/ShalarthPlus/V2/Staffportal/employee/details-Report';    
    $shalarthBasedEmployeeApi = 'https://shalarth.maharashtra.gov.in/ShalarthPlus/employee/details-Report';
    
}
ini_set('memory_limit', '512M');
return [
    /*
     * Debug Level:
     *
     * Production Mode:
     * false: No error messages, errors, or warnings shown.
     *
     * Development Mode:
     * true: Errors and warnings shown.
     */
    
    'debug' => filter_var(env('DEBUG', false), FILTER_VALIDATE_BOOLEAN),

    /*
     * Security and encryption configuration
     *
     * - salt - A random string used in security hashing methods.
     *   The salt value is also used as the encryption key.
     *   You should treat it as extremely sensitive data.
     */
    'Security' => [
        'salt' => env('SECURITY_SALT', '8ea4028a9bb15cf132329acb0514475e4c9f83022e82ea14509eb9806f21cd87'),
    ],

    /*
     * Connection information used by the ORM to connect
     * to your application's datastores.
     *
     * See app.php for more configuration options.
     */
  
    'Datasources' => [
         'default' => [
            'className' => \Cake\Database\Connection::class,
            'driver' => \Cake\Database\Driver\Postgres::class,
            'host' => $dbhost,
            'username' => $dbusername,
            'password' => $dbpassword,
            'port' => $dbport,
            'database' => $dbdatabase ,
            'encoding' => 'utf8',
            'timezone' => 'UTC',
            'cacheMetadata' => true,
            'quoteIdentifiers' => false,
        ],

        /*
         * The test connection is used during the test suite.
         */
        'test' => [
            'host' => 'localhost',
            //'port' => 'non_standard_port_number',
            'username' => 'my_app',
            'password' => 'secret',
            'database' => 'test_myapp',
            //'schema' => 'myapp',
            'url' => env('DATABASE_TEST_URL', 'sqlite://127.0.0.1/tmp/tests.sqlite'),
        ],
    ],

    'ESDL' => [
        'endpoint' => 'https://adc-ent-ecos.enlightcloud.com',
        'bucket'   => '7144-staff',
        'mode'     => $esdlMode, //uat → prod
        'key'      => '1w0I0BBXzYfapDY3Gk6L',
        'secret'   => 'XkJxpUuSBXx20EU4F4Hrh8rO2Eq6OvsSiCCfep5l',
        'region'   => 'us-east-1',
    ],

    'SMS' => [
        'endpoint' => 'https://msdgweb.mgov.gov.in/esms/sendsmsrequestDLT',
        'username'   => 'MAHSCHEDU',
        'password'     => 'Cdac@123', 
        'senderid'      => 'MAHEDU',
        'deptSecureKey'   => '9de275bb-5c84-4a8c-8453-d15424bd2c4f',
        'templateids' => [
            'otp' => '1107176224326836932'
        ],
        'responseArr' => [
            '401' => 'Credentials Error',
            '402' => 'Success',
            '403' => 'Credits not available',
            '404' => 'Internal DB Error',
            '405' => 'Network Error',
            '406' => 'Invalid Numbers',
            '407' => 'SMSC Error',
            '408' => 'SMSC Error',
            '410' => 'Limit Exceeded',
            '411' => 'Sender ID not approved',
            '412' => 'Sender ID not approved',
            '413' => 'Spam Rejected',
            '414' => 'DND/Operator Rejected'
        ],
    ],

    'SHALARTH' => [
        'udiseBasedEmployeesApi' => $udiseBasedEmployeesApi,
        'shalarthBasedEmployeeApi' => $shalarthBasedEmployeeApi,
    ],

    /*
     * Email configuration.
     *
     * Host and credential configuration in case you are using SmtpTransport
     *
     * See app.php for more configuration options.
     */
    'EmailTransport' => [
        'default' => [
            'host' => 'localhost',
            'port' => 25,
            'username' => null,
            'password' => null,
            'client' => null,
            'url' => env('EMAIL_TRANSPORT_DEFAULT_URL', null),
        ],
    ],
];

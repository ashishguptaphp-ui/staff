<?php
use Cake\Routing\RouteBuilder;

$routes->prefix('Recruit', function (RouteBuilder $routes) {

    /*
     * Authentication
     */
    $routes->connect('/login', [
        'controller' => 'Recruit',
        'action' => 'login'
    ]);

    $routes->connect('/logout', [
        'controller' => 'Recruit',
        'action' => 'logout'
    ]);

    $routes->connect('/otp', [
        'controller' => 'Recruit',
        'action' => 'otp'
    ]);






    /*
     * Sanstha
     */
    $routes->connect('/sanstha/dashboard', [
        'controller' => 'Sanstha',
        'action' => 'dashboard'
    ]);
     $routes->connect('/sanstha/import', [
        'controller' => 'Sanstha',
        'action' => 'import'
    ]);

    $routes->connect('/sanstha/advertisement-list', [
        'controller' => 'Sanstha',
        'action' => 'advertisementList'
    ]);

    $routes->connect('/sanstha/unified-data-integration', [
        'controller' => 'Sanstha',
        'action' => 'unifiedDataIntegration'
    ]);

    $routes->connect(
            '/sanstha/advertisement-list',
            [
                'controller' => 'Sanstha',
                'action' => 'AdvertisementList'
            ]
        );

    $routes->connect(
            '/sanstha/schoolDdoPostData',
            [
                'controller' => 'Sanstha',
                'action' => 'schoolDdoPostData'
            ]
        );


    $routes->connect('/sanstha/staff-seniority-list', [
        'controller' => 'Sanstha',
        'action' => 'staffSeniorityList'
    ]);

      $routes->connect('/sanstha/updateSanchWorkingData', [
        'controller' => 'Sanstha',
        'action' => 'updateSanchWorkingData'
    ]);

     $routes->connect(
            '/sanstha/processVacacyRequest',
            [
                'controller' => 'Sanstha',
                'action' => 'processVacacyRequest'
            ]
        );


    $routes->connect(
            '/sanstha/advertisementVacancyAjax',
            [
                'controller' => 'Sanstha',
                'action' => 'advertisementVacancyAjax',
            ],            
        );

    $routes->connect(
            '/sanstha/saveStaffOnboarding/',
            [
                'controller' => 'Sanstha',
                'action' => 'saveStaffOnboarding',
            ],            
        );
    $routes->connect(
            '/sanstha/getStaffOnboardingDetails',
            [
                'controller' => 'Sanstha',
                'action' => 'getStaffOnboardingDetails',
            ],            
        );

    /*
     * District Clerk
     */
    $routes->connect('/district-clerk/dashboard', [
        'controller' => 'DistrictClerk',
        'action' => 'dashboard'
    ]);

    $routes->connect(
            '/district-clerk/advertisementVacancyAjax',
            [
                'controller' => 'DistrictClerk',
                'action' => 'advertisementVacancyAjax',
            ],            
        );

    $routes->connect(
            '/district-clerk/advertisement-list',
            [
                'controller' => 'DistrictClerk',
                'action' => 'AdvertisementList'
            ]
        );
    $routes->connect(
            '/district-clerk/advertisementPostforword',
            [
                'controller' => 'DistrictClerk',
                'action' => 'advertisementPostforword',
            ],            
        ); 


    $routes->connect(
        '/district_clerk/pendingIndividualApproval',
        [
            'controller' => 'DistrictClerk',
            'action' => 'pendingIndividualApproval',
        ],            
        );

    $routes->connect(
        '/district_clerk/ng2gTransfer',
        [
            'controller' => 'DistrictClerk',
            'action' => 'ng2gTransfer',
        ],            
        );

    $routes->connect('/district_clerk/staff-seniority-list', [
        'controller' => 'DistrictClerk',
        'action' => 'staffSeniorityList'
    ]);

      $routes->connect(
            '/district_clerk/getStaffOnboardingDetails',
            [
                'controller' => 'DistrictClerk',
                'action' => 'getStaffOnboardingDetails',
            ],            
        );


    /*
     * District Superintendent
     */
    $routes->connect('/district-superintendent/dashboard', [
        'controller' => 'DistrictSuperintendent',
        'action' => 'dashboard'
    ]);

        $routes->connect(
            '/district-superintendent/advertisementVacancyAjax',
            [
                'controller' => 'DistrictSuperintendent',
                'action' => 'advertisementVacancyAjax',
            ],            
        );

    $routes->connect(
            '/district-superintendent/advertisement-list',
            [
                'controller' => 'DistrictSuperintendent',
                'action' => 'AdvertisementList'
            ]
        );
    $routes->connect(
            '/district-superintendent/advertisementPostforword',
            [
                'controller' => 'DistrictSuperintendent',
                'action' => 'advertisementPostforword',
            ],            
        );    

        $routes->connect(
        '/district-superintendent/ng2gTransfer',
        [
            'controller' => 'DistrictSuperintendent',
            'action' => 'ng2gTransfer',
        ],            
        );


   $routes->connect('/district-superintendent/staff-seniority-list', [
        'controller' => 'DistrictSuperintendent',
        'action' => 'staffSeniorityList'
    ]);

      $routes->connect(
            '/district-superintendent/getStaffOnboardingDetails',
            [
                'controller' => 'DistrictSuperintendent',
                'action' => 'getStaffOnboardingDetails',
            ],            
        );

    /*
     * District
     */
    $routes->connect('/district/dashboard', [
        'controller' => 'District',
        'action' => 'dashboard'
    ]);

    $routes->connect('/district/header-upload', [
        'controller' => 'District',
        'action' => 'headerUpload'
    ]);

    $routes->connect('/district/header-delete', [
        'controller' => 'District',
        'action' => 'headerDelete'
    ]);

    $routes->connect(
            '/district/advertisementVacancyAjax',
            [
                'controller' => 'District',
                'action' => 'advertisementVacancyAjax',
            ],            
        );

    $routes->connect(
            '/district/advertisementPostApprovel',
            [
                'controller' => 'district',
                'action' => 'advertisementPostApprovel',
            ],            
        );

    $routes->connect(
            '/district/advertisement-list',
            [
                'controller' => 'district',
                'action' => 'AdvertisementList'
            ]
        );

       $routes->connect('/district/staff-seniority-list', [
        'controller' => 'district',
        'action' => 'staffSeniorityList'
    ]);

      $routes->connect(
            '/district/getStaffOnboardingDetails',
            [
                'controller' => 'district',
                'action' => 'getStaffOnboardingDetails',
            ],            
        );   

    /*
    * General Utilities
    */   
     $routes->connect(
            '/general-utilities/getAdvertisementVacancies',
            [
                'controller' => 'GeneralUtilities',
                'action' => 'getAdvertisementVacancies',
            ],            
        );   

    //$routes->fallbacks(DashedRoute::class);
      

});
<?php
/**
 * Routes configuration.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * It's loaded within the context of `Application::routes()` method which
 * receives a `RouteBuilder` instance `$routes` as method argument.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
/*
 * This file is loaded in the context of the `Application` class.
 * So you can use `$this` to reference the application class instance
 * if required.
 */
return function (RouteBuilder $routes): void {
    /*
     * The default class to use for all routes
     *
     * The following route classes are supplied with CakePHP and are appropriate
     * to set as the default:
     *
     * - Route
     * - InflectedRoute
     * - DashedRoute
     *
     * If no call is made to `Router::defaultRouteClass()`, the class used is
     * `Route` (`Cake\Routing\Route\Route`)
     *
     * Note that `Route` does not do any inflections on URLs which will result in
     * inconsistently cased URLs when used with `{plugin}`, `{controller}` and
     * `{action}` markers.
     */
    $routes->setRouteClass(DashedRoute::class);
    // Routes for Controller/SansthaController.php (Root level)
   

    $routes->prefix('Recruit', function (RouteBuilder $routes): void {
            
            $routes->connect('/login', ['controller' => 'Recruit','action' => 'login']);

            $routes->connect('/logout', ['controller' => 'Recruit','action' => 'logout']);

            $routes->connect('/otp', ['controller' => 'Recruit','action' => 'otp']);

            $routes->connect(
                '/sanstha/upload-advertisement-document',
                [
                    'controller' => 'Sanstha',
                    'action' => 'uploadAdvertisementDocument',
                    '_method' => 'POST',
                ]
            );

            $routes->connect(
                '/sanstha/processVacacyRequest',
                [
                    'controller' => 'Sanstha',
                    'action' => 'processVacacyRequest',
                    '_method' => 'POST',
                ]
            );

            $routes->connect(
                '/district/upload-signed-advertisement-pdf',
                ['controller' => 'District', 'action' => 'uploadSignedAdvertisementPdf'],
                ['_method' => 'POST']
            );
    
            $routes->fallbacks(DashedRoute::class);
     });


    $routes->scope('/', function (RouteBuilder $builder): void {
        /*
         * Here, we are connecting '/' (base path) to a controller called 'Pages',
         * its action called 'display', and we pass a param to select the view file
         * to use (in this case, templates/Pages/home.php)...
         */
        //$builder->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);
        $builder->connect('/', ['controller' => 'users', 'action' => 'login', 'login']);
        /*
         * ...and connect the rest of 'Pages' controller's URLs.
         */
        $builder->connect('/pages/*', 'Pages::display');

       

        /*
         * Connect catchall routes for all controllers.
         *
         * The `fallbacks` method is a shortcut for
         *
         * ```
         * $builder->connect('/{controller}', ['action' => 'index']);
         * $builder->connect('/{controller}/{action}/*', []);
         * ```
         *
         * It is NOT recommended to use fallback routes after your initial prototyping phase!
         * See https://book.cakephp.org/5/en/development/routing.html#fallbacks-method for more information
         */
           

        $builder->fallbacks();
    });

    $routes->prefix('Api', function ($builder) {
        $builder->setExtensions(['json']);
        $builder->connect('/login', ['controller' => 'Auth', 'action' => 'login']);
        //$builder->connect('/user-details', ['controller' => 'Auth', 'action' => 'userDetails']);
        /*$builder->connect(
            '/user-details/{user_id}',
            ['controller' => 'Auth', 'action' => 'userDetails'],
            ['pass' => ['user_id'], 'user_id' => '\d+']
        );*/
        $builder->connect(
            '/user-details',
            ['controller' => 'Auth', 'action' => 'userDetails']
        );
        $builder->connect('/subjects', ['controller' => 'Master', 'action' => 'subjects']);
        $builder->connect('/mediums', ['controller' => 'Master', 'action' => 'mediums']);
        $builder->connect('/posts', ['controller' => 'Master', 'action' => 'posts']);
        $builder->connect('/horizontal-categories', ['controller' => 'Master', 'action' => 'horizontalCategories']);
        $builder->connect('/caste-categories', ['controller' => 'Master', 'action' => 'casteCategories']);
        $builder->connect('/ph-categories', ['controller' => 'Master', 'action' => 'phCategories']);
        $builder->connect(
            '/ph-sub-categories/{cat_id}',
            ['controller' => 'Master', 'action' => 'phSubCategories'],
            ['pass' => ['cat_id'], 'cat_id' => '\d+']
        );

        $builder->connect('/lgd-districts', ['controller' => 'Master', 'action' => 'lgdDistricts']);
        $builder->connect(
            '/lgd-blocks/{district_id}',
            ['controller' => 'Master', 'action' => 'lgdBlocks'],
            ['pass' => ['district_id'], 'district_id' => '\d+']
        );
        $builder->connect(
            '/lgd-villages/{block_id}',
            ['controller' => 'Master', 'action' => 'lgdVillages'],
            ['pass' => ['block_id'], 'block_id' => '\d+']
        );

        $builder->connect('/blood-groups', ['controller' => 'Master', 'action' => 'bloodGroups']);
        $builder->connect('/relationships', ['controller' => 'Master', 'action' => 'relationships']);
        $builder->connect('/appointment-types', ['controller' => 'Master', 'action' => 'appointmentTypes']);
        $builder->connect('/caste-issuing-authorities', ['controller' => 'Master', 'action' => 'casteIssuingAuthorities']);
        $builder->connect('/caste-valid-authorities', ['controller' => 'Master', 'action' => 'casteValidAuthorities']);
        $builder->connect('/languages', ['controller' => 'Master', 'action' => 'languages']);


        $builder->connect('/religions', ['controller' => 'Master', 'action' => 'religions']);
        $builder->connect('/pavitra-states', ['controller' => 'Master', 'action' => 'pavitraStates']);

        $builder->connect(
            '/state-wise-universities/{state_id}',
            ['controller' => 'Master', 'action' => 'stateUniversities'],
            ['pass' => ['state_id'], 'state_id' => '\d+']
        );
        $builder->connect('/academic-qualification-levels', ['controller' => 'Master', 'action' => 'academicQualificationLevels']);
        

        $builder->connect(
            '/academic-qualification-level-degrees/{level_id}',
            ['controller' => 'Master', 'action' => 'academicLevelDegrees'],
            ['pass' => ['level_id'], 'level_id' => '\d+']
        );

        $builder->connect(
            '/academic-qualification-level-degree-state-univercities/{level_id}/{state_id}',
            ['controller' => 'Master', 'action' => 'academicLevelDegreeStateUnivercities'],
            [
                'pass' => ['level_id', 'state_id'],
                'level_id' => '\d+',
                'state_id' => '\d+'
            ]
        );


        $builder->connect(
            '/academic-qualification-level-degree-subjects/{level_id}/{degree_id}',
            ['controller' => 'Master', 'action' => 'academicLevelDegreeSubjects'],
            [
                'pass' => ['level_id', 'degree_id'],
                'level_id' => '\d+',
                'degree_id' => '\d+'
            ]
        );

        $builder->connect('/professional-grades', ['controller' => 'Master', 'action' => 'professionalGrades']);
        $builder->connect('/professional-classes', ['controller' => 'Master', 'action' => 'professionalClasses']);


        $builder->connect('/professional-qualification-levels', ['controller' => 'Master', 'action' => 'professionalQualificationLevels']);
        

        $builder->connect(
            '/professional-qualification-level-degrees/{level_id}',
            ['controller' => 'Master', 'action' => 'professionalLevelDegrees'],
            ['pass' => ['level_id'], 'level_id' => '\d+']
        );

        $builder->connect(
            '/professional-qualification-level-degree-state-univercities/{level_id}/{state_id}',
            ['controller' => 'Master', 'action' => 'professionalLevelDegreeStateUnivercities'],
            [
                'pass' => ['level_id', 'state_id'],
                'level_id' => '\d+',
                'state_id' => '\d+'
            ]
        );


        $builder->connect(
            '/professional-qualification-level-degree-subjects/{level_id}/{degree_id}',
            ['controller' => 'Master', 'action' => 'professionalLevelDegreeSubjects'],
            [
                'pass' => ['level_id', 'degree_id'],
                'level_id' => '\d+',
                'degree_id' => '\d+'
            ]
        );
        

        $builder->connect('/tet-years', ['controller' => 'Master', 'action' => 'tetYears']);
        $builder->connect('/tet-exam-papers', ['controller' => 'Master', 'action' => 'tetExamPapers']);

        
        $builder->connect(
            '/school-details-by-udise/{udise_code}',
            ['controller' => 'Master', 'action' => 'searchByUdise'],
            [
                'pass' => ['udise_code'],'udise_code' => '\d+'
            ]
        );

        $builder->connect('/training-types', ['controller' => 'Master', 'action' => 'trainingTypes']);
        $builder->connect('/training-categories', ['controller' => 'Master', 'action' => 'trainingCategories']);
        $builder->connect('/training-institutes', ['controller' => 'Master', 'action' => 'trainingInstitutes']);
        $builder->connect('/training-levels', ['controller' => 'Master', 'action' => 'trainingLevels']);




        $builder->connect('/training-levels', ['controller' => 'Master', 'action' => 'trainingLevels']);

        $builder->connect(
            '/staff/profile',
            ['controller' => 'Staff', 'action' => 'updatePersonalDetails', '_method' => 'PATCH']
        );

        $builder->connect(
            '/staff/address',
            ['controller' => 'Staff', 'action' => 'updateAddressDetails', '_method' => 'PATCH']
        );

        $builder->connect(
            '/staff/other-personal-details',
            ['controller' => 'Staff', 'action' => 'updateOtherPersonalDetails', '_method' => 'PATCH']
        );


        $builder->connect('/staff/family', ['controller' => 'Staff', 'action' => 'familyLists', '_method' => 'GET']);

        $builder->connect(
            '/staff/family',
            ['controller' => 'Staff', 'action' => 'addFamily', '_method' => 'POST']
        );

        $builder->connect(
            '/staff/family',
            ['controller' => 'Staff', 'action' => 'updateFamily', '_method' => 'PUT']
        );

        $builder->connect(
            '/staff/family',
            ['controller' => 'Staff', 'action' => 'removeFamily', '_method' => 'DELETE']
        );

         $builder->connect(
            '/staff/caste',
            ['controller' => 'Staff', 'action' => 'updateCaste', '_method' => 'PATCH']
        );

       
        //$builder->resources('Users');
    });



    // API routes
    $routes->scope('/services', function (RouteBuilder $builder) {
        // Version 1.0
        $builder->scope('/1.0', function (RouteBuilder $builder) {
            // POST /services/1.0/connect
            $builder->post('/connect', ['controller' => 'Services', 'action' => 'connect']);
             $builder->get('/get-teachers/*', ['controller' => 'Services', 'action' => 'getTeachers']);
            $builder->get('/dashboard/*', ['controller' => 'Services', 'action' => 'dashboard']);

            // POST /services/1.0/refresh (optional)
            $builder->post('/refresh', ['controller' => 'Services', 'action' => 'refresh']);
        });

        // Version v1
        $builder->scope('/1.0', function (RouteBuilder $builder) {
            // GET /services/v1/dashboard/{user_id}
            $builder->get('/dashboard1/:user_id', ['controller' => 'Services', 'action' => 'dashboard']);
                //->setPass(['user_id'])
                //->setPatterns(['user_id' => '^[a-zA-Z0-9]+$']);
        });
    });


 

   /* $routes->scope('/api', function (RouteBuilder $builder) {
        $builder->setExtensions(['json']); 
        $builder->resources('Staffs');    
    });*/

    /*
     * If you need a different set of middleware or none at all,
     * open new scope and define routes there.
     *
     * ```
     * $routes->scope('/api', function (RouteBuilder $builder): void {
     *     // No $builder->applyMiddleware() here.
     *
     *     // Parse specified extensions from URLs
     *     // $builder->setExtensions(['json', 'xml']);
     *
     *     // Connect API actions here.
     * });
     * ```
     */
};

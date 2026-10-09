<?php

namespace App\Controller\Recruit;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\Http\Client;
use Cake\Http\Exception\BadRequestException;
use Cake\Http\Response;
use Cake\I18n\FrozenTime;
use DateTime;
use stdClass;
use Cake\Routing\Router;
use Cake\Core\Configure;
use Laminas\Diactoros\UploadedFile;
use App\Service\EsdlStorageService;
use Dompdf\Dompdf;
use Dompdf\Options;

//App\Controller\stdClass


class CommissionerController extends AppController
{
    private $user_id;
    private $username;
    private $UD;
    private $statuses;
    
    public function initialize(): void
    {
        parent::initialize();
        //$this->loadComponent('RequestHandler');

    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->FormProtection->setConfig('unlockedActions', 
        [
            'ng2gRejectTransfer',
            'ng2gApproveTransfer',
            'ng2gTransfer',
            'generateApprovalLetter',
            'staffSeniorityList',
            'advertisementList',
        ]);

        $user = $this->request->getAttribute('identity');
        if (!$user) {
            $this->Flash->error('Please log in with your authorized credentials to continue.');
            return $this->redirect(['controller' => 'Recruit', 'action' => 'login']);
        }
        
        $sessionUser = $this->request->getSession()->read('Auth.User');
               
        if (!$sessionUser) {
            $this->Flash->error('Please log in with your authorized credentials to continue.');
            return $this->redirect(['controller' => 'Recruit', 'action' => 'login']);
        }

        $role = $user->getOriginalData()->role ?? null;

       
        if ($role !== 'commissioner') {
            $this->Flash->error('Access denied.');
            return $this->redirect(['controller' => 'Recruit', 'action' => 'login']);
        }

        $this->user_id = $this->request->getSession()->read('Auth.User.id');
        $this->username = $this->request->getSession()->read('Auth.User.username');
     

       
        $this->statuses = [
                    'commissioner_desk_pending'
                ];
        

        $user = $this->request->getSession()->read('Auth.User');
       
        $this->set('user', $user);
       
        $event->setResult(false); // Correct way to set a result or stop the flow
    	return; // Do not return a value
    }

    public function dashboard()
    {                
        $this->Authorization->skipAuthorization();
        $this->viewBuilder()->setLayout('recruit/commissioner');

      
       $postAdvertisementTable = $this->fetchTable('PostAdvertisement');
        $advertisementStatusCounts = [
            'total' => 0,
            'pending' => 0,
            'approved' => 0,
            'rejected' => 0,
            'resubmission' => 0
        ];

        $advertisementStatusRows = $postAdvertisementTable->find()
            ->select([
                'status' => 'PostAdvertisement.status',
                'count' => $postAdvertisementTable->find()->func()->count('PostAdvertisement.id')
            ])
            ->innerJoin(
                ['Sansthas' => 'sansthas'],
                'Sansthas.code = PostAdvertisement.institution_code'
            )
            ->where([
                //'Sansthas.district_code' => (int)$this->dcode
            ])
            ->group(['PostAdvertisement.status'])
            ->all();

   

        foreach ($advertisementStatusRows as $statusRow) {
            $count = (int)$statusRow->count;
            $advertisementStatusCounts['total'] += $count;

            if ($statusRow->status === 'pending') {
                $advertisementStatusCounts['pending'] = $count;
            } elseif ($statusRow->status === 'approved') {
                $advertisementStatusCounts['approved'] = $count;
            } elseif ($statusRow->status === 'rejected') {
                $advertisementStatusCounts['rejected'] = $count;
            } elseif (in_array($statusRow->status, ['send_back_correction', 'resubmission_required'], true)) {
                $advertisementStatusCounts['resubmission'] += $count;
            }
        }

     
        $this->set('advertisementStatusCounts', $advertisementStatusCounts);
        
    }

    public function ng2gTransfer()
    {
        $this->Authorization->skipAuthorization();
        $this->viewBuilder()->setLayout('commissioner');
    
        $staffTransfersTable = TableRegistry::getTableLocator()->get('StaffTransfers');
        

        $ng2g = $staffTransfersTable->find()
                ->select([
                            'block' => 'Blocks.name',
                            'cluster' => 'Clusters.name',
                            'StaffTransfers.id', 
                            'StaffTransfers.created_at', 
                            'StaffTransfers.staff_id', 
                            'StaffTransfers.employee_name', 
                            'StaffTransfers.designation',
                            'institution_name', 
                            'StaffTransfers.school_name', 
                            'StaffTransfers.school_name_at_transfer', 
                            'StaffTransfers.staff_type_name', 
                            'StaffTransfers.aid_name',
                            'StaffTransfers.status'
                            ])
                 ->join([
                    'Schools' => [
                        'table' => 'schools',
                        'type' => 'INNER',
                        'conditions' => 'StaffTransfers.udise_number = Schools.udise_code'
                    ],
                    'Clusters' => [
                        'table' => 'clusters',
                        'type' => 'INNER',
                        'conditions' => 'Clusters.code = Schools.cluster_code'
                    ],
                    'Blocks' => [
                        'table' => 'blocks',
                        'type' => 'INNER',
                        'conditions' => 'Blocks.code = Clusters.block_code::int'
                    ]
                    
                ])     
                ->where([
                    'StaffTransfers.status IN' => $this->statuses
                ])
                ->orderBy([
                    'StaffTransfers.id' => 'ASC'
                ])
                
            ->all();
        /*echo "<pre>";
        echo "<hr>". $this->dcode;
        echo count($ng2g);
        print_r($ng2g);
        exit;*/
        $this->set('ng2g', $ng2g);

        

    }

    
    public function ng2gApproveTransfer()
    {
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['post', 'ajax']);
        $data = $this->request->getData();
        
        /*echo "<pre>";
       
        print_r( $data);
        exit;*/
        $files = $this->request->getUploadedFiles();

        $connection = ConnectionManager::get('default');
        $connection->begin();

        try {
           
           
            $staffTransferTable = TableRegistry::getTableLocator()->get('StaffTransfers');
            
            if (!empty($data['ng2g_id'])) {
                $transfer = $staffTransferTable->get($data['ng2g_id']);
            }else{
                return $this->response
                            ->withType('application/json')
                            ->withStringBody(json_encode([
                                'success' => false,
                                'message' => 'Invalid Application'
                            ]));
            }

            if($transfer->id < 1){
                return $this->response
                            ->withType('application/json')
                            ->withStringBody(json_encode([
                                'success' => false,
                                'message' => 'Invalid Application'
                            ]));
            }
            
            
            //'pending'::staff_update_statuses_enum
            $staffData = [               
                'status'            => 'commissioner_desk_pending', 
                'director_remark'        => $data['app_remark'] ?? null,
                'director_replied_at'  =>  time()           

            ];
            $config = Configure::read('ESDL');
            //staff/<staff_id>/transfers
            //staff/<staff_id>/docs
            $bucketPath = $config['mode'].'/staff/transfers/'.$transfer->id;

           

            if (!empty($data['app_doc']) && $data['app_doc']->getError() === UPLOAD_ERR_OK) {

                $file = $data['app_doc'];
                
                if ($file->getClientMediaType() !== 'application/pdf') {
                    return $this->response
                        ->withType('application/json')
                        ->withStringBody(json_encode([
                            'success' => false,
                            'message' => 'Must be a PDF File'
                        ]));
                }

                if ($file->getSize() > (2 * 1024 * 1024)) {
                    return $this->response
                        ->withType('application/json')
                        ->withStringBody(json_encode([
                            'success' => false,
                            'message' => 'Exceeds 2MB limit File'
                        ]));
                }

                if (!$file || $file->getError() !== UPLOAD_ERR_OK) {
                    return $this->response
                        ->withType('application/json')
                        ->withStringBody(json_encode([
                            'success' => false,
                            'message' => 'Invalid File'
                        ]));
                    //$this->Flash->error('Invalid file');
                }


                // Get temp path safely
                $tmpPath = $file->getStream()->getMetadata('uri');

                // Extract extension (safe)
                $extension = pathinfo($file->getClientFilename(), PATHINFO_EXTENSION);

                // New filename
                $newFileName = 'director_replied_file.' . $extension;

                // Create NEW UploadedFile object
                $renamedFile = new UploadedFile(
                    $tmpPath,
                    $file->getSize(),
                    $file->getError(),
                    $newFileName,
                    $file->getClientMediaType()
                );

                $storage = new EsdlStorageService();
                $fileName = $storage->upload($renamedFile, $bucketPath);

                $staffData['director_replied_file'] = $fileName;
            } 
    
            
            $transfer = $staffTransferTable->patchEntity($transfer, $staffData);

            if ($transfer->hasErrors()) {
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'success' => false,
                        'message' => 'Unable to upload file'
                    ]));
            }

            if (!$staffTransferTable->save($transfer)) {
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'success' => false,
                        'message' => 'Unable to reject staff transfer'
                    ]));
            }

            $connection->commit();

            /* ===============================
            * 4. JSON Response
            * =============================== */
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'success' => true,
                    'id' => $transfer->id,
                    'message' => 'Transfer application rejected successfully'
                ]));

           

        } catch (\Throwable $e) {
            $connection->rollback();

            return $this->response
                ->withStatus(422)
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'status' => false,
                    'error' => $e->getMessage()
                ]));
        }
    }
 
    public function ng2gRejectTransfer()
    {
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['post', 'ajax']);
        $data = $this->request->getData();
        
        /*echo "<pre>";
       
        print_r( $data);
        exit;*/
        $files = $this->request->getUploadedFiles();

        $connection = ConnectionManager::get('default');
        $connection->begin();

        try {
           
           
            $staffTransferTable = TableRegistry::getTableLocator()->get('StaffTransfers');
            
            if (!empty($data['ng2g_id'])) {
                $transfer = $staffTransferTable->get($data['ng2g_id']);
            }else{
                return $this->response
                            ->withType('application/json')
                            ->withStringBody(json_encode([
                                'success' => false,
                                'message' => 'Invalid Application'
                            ]));
            }

            if($transfer->id < 1){
                return $this->response
                            ->withType('application/json')
                            ->withStringBody(json_encode([
                                'success' => false,
                                'message' => 'Invalid Application'
                            ]));
            }
            
          
            
            //'pending'::staff_update_statuses_enum
            $staffData = [               
                'status'            => 'director_rejected', 
                'director_remark'        => $data['reject_remark'] ?? null,
                'director_replied_at'  =>  time()           

            ];
            $config = Configure::read('ESDL');
            //staff/<staff_id>/transfers
            //staff/<staff_id>/docs
            $bucketPath = $config['mode'].'/staff/transfers/'.$transfer->id;

            
                

            if (!empty($data['reject_doc']) && $data['reject_doc']->getError() === UPLOAD_ERR_OK) {

                $file = $data['reject_doc'];
                
                if ($file->getClientMediaType() !== 'application/pdf') {
                    return $this->response
                        ->withType('application/json')
                        ->withStringBody(json_encode([
                            'success' => false,
                            'message' => 'Must be a PDF File'
                        ]));
                }

                if ($file->getSize() > (2 * 1024 * 1024)) {
                    return $this->response
                        ->withType('application/json')
                        ->withStringBody(json_encode([
                            'success' => false,
                            'message' => 'Exceeds 2MB limit File'
                        ]));
                }

                if (!$file || $file->getError() !== UPLOAD_ERR_OK) {
                    return $this->response
                        ->withType('application/json')
                        ->withStringBody(json_encode([
                            'success' => false,
                            'message' => 'Invalid File'
                        ]));
                    //$this->Flash->error('Invalid file');
                }


                // Get temp path safely
                $tmpPath = $file->getStream()->getMetadata('uri');

                // Extract extension (safe)
                $extension = pathinfo($file->getClientFilename(), PATHINFO_EXTENSION);

                // New filename
                $newFileName = 'director_replied_file.' . $extension;

                // Create NEW UploadedFile object
                $renamedFile = new UploadedFile(
                    $tmpPath,
                    $file->getSize(),
                    $file->getError(),
                    $newFileName,
                    $file->getClientMediaType()
                );

                $storage = new EsdlStorageService();
                $fileName = $storage->upload($renamedFile, $bucketPath);

                $staffData['director_replied_file'] = $fileName;
            } 
    
            
            $transfer = $staffTransferTable->patchEntity($transfer, $staffData);

            if ($transfer->hasErrors()) {
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'success' => false,
                        'message' => 'Unable to upload file'
                    ]));
            }

            if (!$staffTransferTable->save($transfer)) {
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'success' => false,
                        'message' => 'Unable to reject staff transfer'
                    ]));
            }

            $connection->commit();

            /* ===============================
            * 4. JSON Response
            * =============================== */
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'success' => true,
                    'id' => $transfer->id,
                    'message' => 'Transfer application rejected successfully'
                ]));

           

        } catch (\Throwable $e) {
            $connection->rollback();

            return $this->response
                ->withStatus(422)
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'status' => false,
                    'error' => $e->getMessage()
                ]));
        }
    }

    public function generateApprovalLetter()
    {
        $this->autoRender = false;

        $html = $this->renderApprovalLetterViewContent();
        


        $outputPath = WWW_ROOT.'uploads/ng2gtransfers/approve/staff_profile_.pdf';

        $tempHtmlPath = WWW_ROOT . 'uploads/ng2gtransfers/approve/temp_approval_letter.html';

        // ३. HTML कंटेंट तात्पुरत्या फाईलमध्ये सेव्ह करा
        file_put_contents($tempHtmlPath, $html);


        $cmd = sprintf(
            'wkhtmltopdf --enable-local-file-access --encoding UTF-8 --page-size A4 %s %s',
            escapeshellarg($tempHtmlPath),
            escapeshellarg($outputPath)
        );


        exec($cmd . ' 2>&1', $output, $status);

        if ($status !== 0) {
            throw new \RuntimeException(
                "wkhtmltopdf failed:\n" . implode("\n", $output)
            );
        }


        if ($status !== 0) {
            throw new \RuntimeException('PDF generation failed');
        }

        echo $outputPath;
        exit;


        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set('defaultFont', 'DejaVu Sans');

        $dompdf = new Dompdf($options);

        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $filename = 'teacher_transfer_approval.pdf';

        $response = $this->response
            ->withType('application/pdf')
            ->withStringBody($dompdf->output());

        return $response;
    }

    public function generateApprovalLetter_old()
    {
        $this->autoRender = false;

        $html = $this->renderApprovalLetterViewContent();

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set('defaultFont', 'DejaVu Sans');

        $dompdf = new Dompdf($options);

        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $filename = 'teacher_transfer_approval.pdf';

        $response = $this->response
            ->withType('application/pdf')
            ->withStringBody($dompdf->output());

        return $response;
    }

    private function renderApprovalLetterViewContent(): string
    {
        return '
        <!DOCTYPE html>
        <html lang="mr">
        <head>
            <meta charset="UTF-8">
            <style>
                body {
                    font-family: DejaVu Sans;
                    font-size: 14px;
                    line-height: 1.7;
                    margin: 40px;
                }

                .right {
                    text-align: right;
                }

                .center {
                    text-align: center;
                }

                .subject {
                    font-weight: bold;
                }

                .content {
                    text-align: justify;
                    margin-top: 20px;
                }

                .signature {
                    margin-top: 60px;
                    text-align: right;
                }

                .copy-section {
                    margin-top: 40px;
                }

                .indent {
                    margin-left: 40px;
                }
            </style>
        </head>
        <body>

            <div>
                क्रमांक : शिसंमा-2026/अनु-विना बदली/टी-4/
                <span class="right">दि.</span>
            </div>

            <br>

            <div>
                प्रति,<br>
                <span class="indent">
                    विभागीय शिक्षण उपसंचालक,<br>
                    विभाग.
                </span>
            </div>

            <br>

            <div class="subject">
                विषय :- विनाअनुदानित/ अंशत: अनुदानितकडून अनुदानितकडे बदली झालेल्या शिक्षक कर्मचारी यांचे मान्यतेबाबत.
            </div>

            <br>

            <div>
                संदर्भ :-
                <br>
                1. शासन परिपत्रक क्रमांक-संकीर्ण-2022/प्र.क्र.120/टिएनटि-1 दि.03.10.2024.
                <br>
                2. शासन निर्णयक्र.संकीर्ण-2022/प्र.क्र.120/टिएपटि-1 दि.29.04.2024.
                <br>
                3. शालेय शिक्षण व क्रीडा विभाग यांची अधिसूचना दि.13.11.2025.
                <br>
                4. आपला प्रस्ताव दिनांक-
            </div>

            <div class="content">
                उपरोक्त संदर्भाधिन पत्रानुसार निर्देशित करण्यांत येते की,
                संदर्भाधिन प्रस्तावामध्ये या शाळेमधील/कनिष्ठ महाविद्यालयातील
                नियुक्त शिक्षक यांचे विनाअनुदानितकडून अनुदानितकडे बदली
                करणेबाबतचा प्रस्ताव सादर करण्यात आलेला होता.

                त्यास अनुसरुन संचालनालय स्तरावर करण्यात आलेल्या छाननीअंती
                परिपुर्ण असलेल्या शिक्षकांच्या विनाअनुदानित/ अंशत:
                अनुदानितकडून अनुदानितकडे बदली मान्यतेस परवानगी देण्यांत येत आहे.
            </div>

            <div class="content">
                विनाअनुदानित/ अंशत: अनुदानितकडून अनुदानितकडे बदली झालेल्या
                शिक्षक कर्मचा-यांच्या बदलीस यासोबत जोडलेल्या प्रपत्रातील
                1 ते 13 रकान्यामध्ये दर्शविण्यात आलेली आहे.
            </div>

            <br><br>

            <div>
                सोबत प्रपत्र- 1 ते 13 ( शिक्षक कर्मचारी)
            </div>

            <div class="signature">
                (सचिन्द्र प्रताप सिंह, भा.प्र.से)<br>
                आयुक्त, शिक्षण<br>
                महाराष्ट्र राज्य पुणे-1
            </div>

            <div class="copy-section">
                प्रत-<br><br>

                1. विभागीय अध्यक्ष, महाराष्ट्र राज्य माध्यमिक व उच्च माध्यमिक शिक्षण मंडळ सर्व.<br><br>

                2. शिक्षणाधिकारी (माध्यमिक/प्राथमिक) व शिक्षण निरीक्षक (उ/द/प) सर्व.<br><br>

                3. अधीक्षक, वेतन व भविष्य निर्वाह निधी पथक.<br><br>

                4. अध्यक्ष/सचिव संबंधित शाळा.<br><br>

                5. संबंधित मुख्याध्यापक.<br><br>

                6. संबंधित कर्मचारी.
            </div>

        </body>
        </html>
        ';
    }


     public function advertisementList()
    {
      
        $districtTable = TableRegistry::getTableLocator()->get('Districts');
        $districts = $districtTable->find()->all();
        $regionTable = TableRegistry::getTableLocator()->get('Regions');
        $regions = $regionTable->find()->all();
        
        $this->Authorization->skipAuthorization();
        $this->viewBuilder()->setLayout('recruit/commissioner');

        $schoolsTable = TableRegistry::getTableLocator()->get('Schools');

        $schools = $schoolsTable->find()->where(['sanstha_code' => $this->username])
            ->all();

        $casteCategoriesTable = TableRegistry::getTableLocator()->get('CasteCategories');
        $casteCategoriesDetails = $casteCategoriesTable->find()->all();

        
        $horizontalCategoriesTable = TableRegistry::getTableLocator()->get('HorizontalCategories');
        $horizontalCategoriesDetails = $horizontalCategoriesTable->find()->all();
         
        $acYear = ["2025-26","2026-27"];
        $postWorkingTable = $this->fetchTable('PostWorking');

        $postAdvertisementTable = $this->fetchTable('PostAdvertisement');
        $ng2g = $postAdvertisementTable->getAdvertisementList();

        
       
       

        $ddovacantTable = $this->fetchTable('DdoVacantMaster');    
        $PostAdvertisementVacanciesTable = $this->fetchTable('PostAdvertisementVacancies');
        $usedPostIds = $PostAdvertisementVacanciesTable->find()
                        ->select(['post_id'])
                        ->where(['post_id IS NOT' => null]);
                        
        $ddovacant = $ddovacantTable->find()
                       ->select([
                        'DdoVacantMaster.id',
                        'DdoVacantMaster.post_name',
                        'DdoVacantMaster.post_id',
                        'school_name' => 'schools.school_name',
                        'udise_code' => 'schools.udise_code',                       
                    ])  
                     ->enableAutoFields(true)
                    ->innerJoin(
                        ['Schools' => 'schools'],
                        'CAST(Schools.udise_code AS VARCHAR) = DdoVacantMaster.school_udise_code'
                    ) 
                    ->innerJoin(
                        ['Sansthas' => 'sansthas'],
                        'Schools.sanstha_code = Sansthas.code'
                    )  
                      ->where([
                        'DdoVacantMaster.id NOT IN' => $usedPostIds,
                    ])
                    /* ->where([
                        'Schools.sanstha_code' => $this->username,
                    ])*/ 
                    ->all();

        $approvedLogDocuments = [];
        $rejectLogDocuments = [];
        $applicationIds = array_map(static function ($post): int {
            return (int)$post->id;
        }, $ng2g->toArray());

        
        if ($applicationIds !== []) {
            $logsTable = TableRegistry::getTableLocator()->get('PostAdvertisementAuditLogs');
            $approvedLogs = $logsTable->find()
                ->select(['post_advertisement_id', 'stage_doc', 'created_at'])
                ->where([
                    'post_advertisement_id IN' => $applicationIds,
                    'new_status' => 'approved',
                    'stage_doc IS NOT' => null,
                ])
                ->order(['created_at' => 'DESC'])
                ->all();

            foreach ($approvedLogs as $approvedLog) {
                $approvedLogDocuments[(int)$approvedLog->post_advertisement_id] ??= $approvedLog->stage_doc;
            }

             $rejectLogs = $logsTable->find()
                ->select(['post_advertisement_id', 'stage_doc', 'created_at'])
                ->where([
                    'post_advertisement_id IN' => $applicationIds,
                    'new_status' => 'rejected',
                    'stage_doc IS NOT' => null,
                ])
                ->order(['created_at' => 'DESC'])
                ->all();

            
            foreach ($rejectLogs as $rejectLog) {
                $rejectLogDocuments[(int)$rejectLog->post_advertisement_id] ??= $rejectLog->stage_doc;
            }
        }

        //echo "<pre>";print_r($approvedLogDocuments);exit;
        $this->set('ddovacant', $ddovacant);               
        $this->set('ng2g', $ng2g);
        $this->set('schools', $schools);
        $this->set('casteCategories', $casteCategoriesDetails); 
        $this->set('horizontalCategories', $horizontalCategoriesDetails);        
        $this->set('districts', $districts);
        $this->set('regions', $regions);
        $this->set('approvedLogDocuments', $approvedLogDocuments);
        $this->set('rejectLogDocuments', $rejectLogDocuments);

    }

     public function staffSeniorityList()
    {
      
        $mnp_npTable = TableRegistry::getTableLocator()->get('MnpNps');
        $mnp_nps = $mnp_npTable->find()->all();
        $districtTable = TableRegistry::getTableLocator()->get('Districts');
        $districts = $districtTable->find()->all();
        $regionTable = TableRegistry::getTableLocator()->get('Regions');
        $regions = $regionTable->find()->all();
        /*echo "<pre>";
        print_r($regions);
        exit;*/
        $this->Authorization->skipAuthorization();
        $this->viewBuilder()->setLayout('recruit/commissioner');

        $schoolsTable = TableRegistry::getTableLocator()->get('Schools');

        $schools = $schoolsTable->find()->where(['sanstha_code' => $this->username])
            ->all();

        $casteCategoriesTable = TableRegistry::getTableLocator()->get('CasteCategories');
        $casteCategoriesDetails = $casteCategoriesTable->find()->all();

       
        $horizontalCategoriesTable = TableRegistry::getTableLocator()->get('HorizontalCategories');
        $horizontalCategoriesDetails = $horizontalCategoriesTable->find()->all();
 
              
        $postAdvertisementVacanciesTable = $this->fetchTable('PostAdvertisementVacancies');

        $ng2g = $postAdvertisementVacanciesTable->find()
            ->select([
                'id' => 'PostAdvertisementVacancies.id',
                'post_name' => 'PostAdvertisementVacancies.post_name',
                'school_name' => 'PostAdvertisementVacancies.school_name',
                'udise_code' => 'PostAdvertisementVacancies.school_udise_code',
                'post_id' => 'PostAdvertisementVacancies.post_id',
                'category' => 'PostAdvertisementVacancies.category',
                'post_advertisement_id' => 'PostAdvertisementVacancies.post_advertisement_id',
                'status' => 'SOA.status',
                'soa_id' =>'SOA.id',
                'is_onboarding_submitted' => 'CASE
                    WHEN SOA.id IS NOT NULL THEN 1
                    ELSE 0
                END'
            ])
            ->leftJoin(
                ['SOA' => 'staff_onboarding_appointments'],
                'CAST(SOA.staff_id AS TEXT) = CAST(PostAdvertisementVacancies.id AS TEXT)'
            )
            ->innerJoin(
                ['PostAdvertisement' => 'post_advertisement'],
                'PostAdvertisement.id = PostAdvertisementVacancies.post_advertisement_id'
            )
            ->where([
                'PostAdvertisement.status' => 'approved',
                 'SOA.id IS NOT' => null
                //'PostAdvertisement.institution_code' => $this->username
            ])
            ->order([
                'PostAdvertisement.created_at' => 'DESC',
                'PostAdvertisementVacancies.id' => 'ASC'
            ])
            ->all();



       //echo "<pre>"; print_r($ng2g);  exit;
                    
        $this->set('ng2g', $ng2g);
        $this->set('schools', $schools);
        $this->set('casteCategories', $casteCategoriesDetails); 
        $this->set('horizontalCategories', $horizontalCategoriesDetails);  
        $this->set('mnp_nps', $mnp_nps);
        $this->set('districts', $districts);
        $this->set('regions', $regions);


    }

  }




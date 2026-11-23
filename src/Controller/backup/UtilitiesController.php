<?php

namespace App\Controller;
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

//App\Controller\stdClass


class UtilitiesController extends AppController
{
    private $user_id;
    private $username;
    private $UD;
    private $statuses;
    private $formFields;
    
    public function initialize(): void
    {
        parent::initialize();
        $this->formFields= array(
            'hsc_file' => 'HSC / 12th Document',
            'graduate_file' => 'Graduate Degree Document',
            'post_graduate_file' => 'Post Graduate Degree Document',
            'ded_file' => 'D.Ed / Equivalent Document',
            'bed_file' => 'BED / Equivalent Document',
            'mped_file' => 'M.P.Ed / Equivalent Document',
            'school_committee_outward_number' => 'शाळा व्यवस्थापन समितीचा ठराव. (MEPS Act 1981) - जावक क्रमांक',
            'school_committee_outward_date' => 'शाळा व्यवस्थापन समितीचा ठराव. (MEPS Act 1981) - दिनांक',                              
            'school_committee_outward_file' => 'शाळा व्यवस्थापन समितीचा ठराव. (MEPS Act 1981) - दस्तऐवज', 
            'origin_sanstha_appointment_number' => 'विनाअनुदानित / अंशतः अनुदानित तत्त्वावरील मूळ संस्था नियुक्ती आदेश - जावक क्रमांक',
            'origin_sanstha_appointment_date' => 'विनाअनुदानित / अंशतः अनुदानित तत्त्वावरील मूळ संस्था नियुक्ती आदेश - दिनांक',                              
            'origin_sanstha_appointment_file' => 'विनाअनुदानित / अंशतः अनुदानित तत्त्वावरील मूळ संस्था नियुक्ती आदेश - दस्तऐवज', 
            'personal_recognition_number' => 'शिक्षणाधिकारी / उपसंचालक यांनी दिलेला अंशतः अनुदानित तत्त्वावरील वैयक्तिक मान्यता आदेश - जावक क्रमांक',
            'personal_recognition_date' => 'शिक्षणाधिकारी / उपसंचालक यांनी दिलेला अंशतः अनुदानित तत्त्वावरील वैयक्तिक मान्यता आदेश - दिनांक',                              
            'personal_recognition_file' => 'शिक्षणाधिकारी / उपसंचालक यांनी दिलेला अंशतः अनुदानित तत्त्वावरील वैयक्तिक मान्यता आदेश - दस्तऐवज', 
            'service_seniority_list_number' => 'संबंधित व्यवस्थापनाची विनाअनुदानित / अंशतः अनुदानित सेवाज्येष्ठता सूची - जावक क्रमांक',
            'service_seniority_list_date' => 'संबंधित व्यवस्थापनाची विनाअनुदानित / अंशतः अनुदानित सेवाज्येष्ठता सूची - दिनांक',                              
            'service_seniority_list_file' => 'संबंधित व्यवस्थापनाची विनाअनुदानित / अंशतः अनुदानित सेवाज्येष्ठता सूची - दस्तऐवज', 
            'vacant_post_merit_list_number' => 'बदलीपूर्वी बिंदुनामावलीनुसार रिक्त पदाचा विषय व आरक्षण विचारात घेण्यात आल्याचे प्रमाणपत्र - जावक क्रमांक',
            'vacant_post_merit_list_date' => 'बदलीपूर्वी बिंदुनामावलीनुसार रिक्त पदाचा विषय व आरक्षण विचारात घेण्यात आल्याचे प्रमाणपत्र - दिनांक',                              
            'vacant_post_merit_list_file' => 'बदलीपूर्वी बिंदुनामावलीनुसार रिक्त पदाचा विषय व आरक्षण विचारात घेण्यात आल्याचे प्रमाणपत्र - दस्तऐवज', 
            'vacant_post_merit_list_number' => 'विनाअनुदानित / अंशतः अनुदानित शाळेत 5 वर्षे सेवा केल्याचे (मुख्याध्यापक) प्रमाणपत्र- जावक क्रमांक',
            'vacant_post_merit_list_date' => 'विनाअनुदानित / अंशतः अनुदानित शाळेत 5 वर्षे सेवा केल्याचे (मुख्याध्यापक) प्रमाणपत्र- दिनांक',                              
            'vacant_post_merit_list_file' => 'विनाअनुदानित / अंशतः अनुदानित शाळेत 5 वर्षे सेवा केल्याचे (मुख्याध्यापक) प्रमाणपत्र- दस्तऐवज', 
            'five_years_hm_certificate_outward_number' => 'अनुदानित रिक्त पदाचा तपशील व कागदपत्रे- जावक क्रमांक',
            'five_years_hm_certificate_date' => 'अनुदानित रिक्त पदाचा तपशील व कागदपत्रे- दिनांक',                              
            'five_years_hm_certificate_file' => 'अनुदानित रिक्त पदाचा तपशील व कागदपत्रे- दस्तऐवज',
            'mavak_checklist_date' => 'बिंदुनामावली तपासणी पत्र (मावकद्वारे)- दिनांक',                              
            'mavak_checklist_file' => 'बिंदुनामावली तपासणी पत्र (मावकद्वारे)- दस्तऐवज', 
            'recruitment_noc_outward_number' => 'संबंधित शिक्षकांचे विनाअनुदानित भरतीचे ना हरकत प्रमाणपत्र- जावक क्रमांक',
            'recruitment_noc_outward_date' => 'संबंधित शिक्षकांचे विनाअनुदानित भरतीचे ना हरकत प्रमाणपत्र- दिनांक',                              
            'recruitment_noc_outward_file' => 'संबंधित शिक्षकांचे विनाअनुदानित भरतीचे ना हरकत प्रमाणपत्र- दस्तऐवज',
            'advrt_newspaper_name' => 'वर्तमानपत्रातील जाहिरात (मूळप्रत)- विवरण',
            'advrt_newspaper_date' => 'वर्तमानपत्रातील जाहिरात (मूळप्रत)- दिनांक',                              
            'advrt_newspaper_file' => 'वर्तमानपत्रातील जाहिरात (मूळप्रत)- दस्तऐवज',
            'interview_date' => 'मुलाखत- दिनांक',                              
            'interview_file' => 'मुलाखत- दस्तऐवज',
            'report_ng_principle_date' => 'रुजू अहवाल विनाअनुदानित तत्त्वावरील- दिनांक',                              
            'report_ng_principle_file' => 'रुजू अहवाल विनाअनुदानित तत्त्वावरील- दस्तऐवज',
            'report_g_principle_date' => 'रुजू अहवाल अंशतः अनुदानित/अनुदानित तत्त्वावरील- दिनांक',                              
            'report_g_principle_file' => 'रुजू अहवाल अंशतः अनुदानित/अनुदानित तत्त्वावरील- दस्तऐवज',
            'self_financing_certificate_outward_number' => 'बदली होणारा शिक्षक स्वयंअर्थसहाय्यित तत्त्वावर कार्यरत नव्हता याबाबत प्रमाणपत्र- जावक क्रमांक',
            'self_financing_certificate_date' => 'बदली होणारा शिक्षक स्वयंअर्थसहाय्यित तत्त्वावर कार्यरत नव्हता याबाबत प्रमाणपत्र- दिनांक',                              
            'self_financing_certificate_file' => 'बदली होणारा शिक्षक स्वयंअर्थसहाय्यित तत्त्वावर कार्यरत नव्हता याबाबत प्रमाणपत्र- दस्तऐवज',
            'transfer_not_higher_post_outward_number' => 'बदली असमान पदावर झालेली नाही याबाबत प्रमाणपत्र- जावक क्रमांक',
            'transfer_not_higher_post_date' => 'बदली असमान पदावर झालेली नाही याबाबत प्रमाणपत्र- दिनांक',                              
            'transfer_not_higher_post_file' => 'बदली असमान पदावर झालेली नाही याबाबत प्रमाणपत्र- दस्तऐवज',
            'salary_subsidy_guarantee_letter_file' => 'महाराष्ट्र खासगी शाळा कर्मचारी (सेवा अटी) नियमावली 1981 मधील नियम 41(1)(3) नुसार वेतन अनुदानाबाबत हमीपत्र- दस्तऐवज',
            'itr1_file' => 'आयकर विवरणपत्र Form-16. Year 1- दस्तऐवज',
            'itr2_file' => 'आयकर विवरणपत्र Form-16. Year 2- दस्तऐवज',
            'itr3_file' => 'आयकर विवरणपत्र Form-16. Year 3- दस्तऐवज',
            'bank_statement_from_date' => 'वेतन बँक स्टेटमेंट ( मागील ५ वर्षाचे)- दिनांक',                              
            'bank_statement_to_date' => 'वेतन बँक स्टेटमेंट ( मागील ५ वर्षाचे)- दिनांक',                            
            'bank_statement_file' => 'वेतन बँक स्टेटमेंट ( मागील ५ वर्षाचे)- दस्तऐवज',
            'no_benefits_certificate_details' => 'विनाअनुदानित तत्त्वावरील रुजू दिनांकापासून इतर शासकीय लाभ घेतले नाहीत याबाबत प्रमाणपत्र- विवरण',                              
            'no_benefits_certificate_file' => 'विनाअनुदानित तत्त्वावरील रुजू दिनांकापासून इतर शासकीय लाभ घेतले नाहीत याबाबत प्रमाणपत्र- दस्तऐवज',                            
            'nps_scheme' => 'NPS योजना बंधनकारक असल्याबाबत हमीपत्र- दस्तऐवज',
            'institution_guarantee_file' => 'प्रस्तुत प्रस्तावातील कागदपत्रे खरी असल्याबाबत संस्थेचे हमीपत्र (प्रपत्र-2)- दस्तऐवज',
            'institution_no_disbute_file' => 'संस्थेमध्ये वाद नसल्याबाबत हमीपत्र- दस्तऐवज',
            'court_order_petition_number' => 'या प्रकरणासंदर्भात न्यायालयीन आदेश- याचिका क्रमांक',
            'court_order_date' => 'या प्रकरणासंदर्भात न्यायालयीन आदेश- दिनांक',                              
            'court_order_file' => 'या प्रकरणासंदर्भात न्यायालयीन आदेश- दस्तऐवज',
            'overall_remark' => 'Overall Remark'            
        );
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->FormProtection->setConfig('unlockedActions', 
        [           
            'ng2gTransferDetails',
            'ng2gReturnApplicationForm','ng2gReturnApplicationSubmission',
            'ng2gReplyToReturnApplication','ng2gReplyToReturnApplicationSubmission',
            'ng2gVerifyReturnedApplicationForm','ng2gVerifyReturnedApplicationSubmission','jurisdictionStats','jurisdictionNg2GStats',
            'ng2gViewApplicationTimelines'
        ]);
        

        $this->FormProtection->setConfig('validate', false);

        $user = $this->request->getAttribute('identity');
        if (!$user) {
            $this->Flash->error('Please log in with your authorized credentials to continue.');
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
        
        $sessionUser = $this->request->getSession()->read('Auth.User');
       
        if (!$sessionUser) {
            $this->Flash->error('Please log in with your authorized credentials to continue.');
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

       

        $this->user_id = $this->request->getSession()->read('Auth.User.id');
        $this->username = $this->request->getSession()->read('Auth.User.username');
     

        $user = $this->request->getSession()->read('Auth.User');
       
        /*
        echo "<pre>";
        print_r( $user );
        exit;*/
       
        $this->set('user', $user);
        $event->setResult(false); // Correct way to set a result or stop the flow
    	return; // Do not return a value
    }

    
    
    public function ng2gViewApplicationTimelines($ng2g_id)
    {
        $html = '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

                    <style>
                    .workflow-card{
                        border:none;
                        border-radius:12px;
                        box-shadow:0 5px 18px rgba(0,0,0,.08);
                    }

                    .timeline{
                        position:relative;
                        margin-left:25px;
                    }

                    .timeline:before{
                        content:"";
                        position:absolute;
                        left:17px;
                        top:0;
                        bottom:0;
                        width:3px;
                        background:#dee2e6;
                    }

                    .timeline-item{
                        position:relative;
                        padding-left:60px;
                        margin-bottom:28px;
                    }

                    .timeline-icon{
                        position:absolute;
                        left:0;
                        width:36px;
                        height:36px;
                        border-radius:50%;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        color:#fff;
                        font-weight:bold;
                        z-index:2;
                    }

                    .icon-primary{background:#0d6efd;}
                    .icon-success{background:#198754;}
                    .icon-warning{background:#fd7e14;}
                    .icon-danger{background:#dc3545;}
                    .icon-info{background:#0dcaf0;}
                    .icon-dark{background:#343a40;}

                    .timeline-content{
                        background:#fff;
                        border-radius:10px;
                        border:1px solid #e9ecef;
                        padding:10px 15px 1px 15px;
                        transition:.3s;
                    }

                    .timeline-content:hover{
                        box-shadow:0 8px 20px rgba(0,0,0,.08);
                        transform:translateY(-2px);
                    }

                    .timeline-content h6{
                        margin-bottom:6px;
                        font-weight:600;
                    }

                    .stage{
                        font-size:13px;
                        font-weight:600;
                        color:#6c757d;
                    }

                    .badge-stage{
                        font-size:12px;
                    }
                    </style>





                    <div class="card shadow-sm border-0">

                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">
                                <i class="bi bi-clock-history me-2"></i>
                                Application Approval History
                            </h5>
                        </div>

                        <div class="card-body">

                            <div class="timeline">

                                <!-- Stage 1 -->

                                <div class="timeline-item">

                                    <div class="timeline-icon bg-success">
                                        <i class="fa-solid fa-check"></i>
                                    </div>

                                    <div class="timeline-content">

                                        <div class="d-flex justify-content-between">
                                            <span class="badge bg-info">
                                                4-Jul-2026 11:32 AM
                                            </span>
                                            <h6 class="mb-1">
                                                Stage 1 – Application Submitted
                                            </h6>

                                            <span class="badge bg-primary">
                                                Completed
                                            </span>
                                            

                                        </div>

                                        <table class="table table-sm table-borderless mb-0">

                                            <tr>
                                                <th width="170">Action By</th>
                                                <td>ABC School, Pune</td>
                                            </tr>

                                            

                                            <tr>
                                                <th>Remarks</th>
                                                <td>
                                                    Application submitted successfully.
                                                </td>
                                            </tr>

                                        </table>

                                    </div>

                                </div>

                                <!-- EO Clerk -->

                                <div class="timeline-item">

                                    <div class="timeline-icon bg-success">
                                        <i class="bi bi-person-check-fill"></i>
                                    </div>

                                    <div class="timeline-content">

                                        <div class="d-flex justify-content-between">

                                            <span class="badge bg-info">
                                                4-Jul-2026 11:32 AM
                                            </span>
                                            <h6 class="mb-1">
                                                Stage 2A – EO Clerk Verification
                                            </h6>

                                            <span class="badge bg-success">
                                                Approved
                                            </span>

                                        </div>

                                        
                                        <p><b>Remark:- </b>Documents verified successfully.</p>            
                                                

                                    </div>

                                </div>

                                <!-- Returned -->

                                <div class="timeline-item">

                                    <div class="timeline-icon bg-warning">
                                        <i class="bi bi-arrow-counterclockwise"></i>
                                    </div>

                                    <div class="timeline-content border-warning">

                                        <div class="d-flex justify-content-between">
                                            <span class="badge bg-info">
                                                4-Jul-2026 11:32 AM
                                            </span>

                                            <h6 class="mb-1">
                                                Returned for Correction
                                            </h6>

                                            <span class="badge bg-warning text-dark">
                                                Returned
                                            </span>

                                        </div>

                                        <p><b>Remark:- </b>Please upload revised approval order and correct student count.</p> 
                                        

                                    </div>

                                </div>

                                <!-- Resubmitted -->

                                <div class="timeline-item">

                                    <div class="timeline-icon bg-info">
                                        <i class="bi bi-upload"></i>
                                    </div>

                                    <div class="timeline-content">

                                        <div class="d-flex justify-content-between">
                                            <span class="badge bg-info">
                                                4-Jul-2026 11:32 AM
                                            </span>
                                            <h6 class="mb-1">
                                                Application Resubmitted
                                            </h6>

                                            <span class="badge bg-info">
                                                Resubmitted
                                            </span>

                                        </div>

                                        <table class="table table-sm table-borderless mb-0">

                                            <tr>
                                                <th width="170">Action By</th>
                                                <td>ABC School</td>
                                            </tr>

                                            <tr>
                                                <th>Remarks</th>
                                                <td>
                                                    Required corrections completed.
                                                </td>
                                            </tr>

                                        </table>

                                    </div>

                                </div>

                                <!-- Final -->

                                <div class="timeline-item">

                                    <div class="timeline-icon bg-success">
                                        <i class="bi bi-award-fill"></i>
                                    </div>

                                    <div class="timeline-content border-success">

                                        <div class="d-flex justify-content-between">
                                            <span class="badge bg-info">
                                                4-Jul-2026 11:32 AM
                                            </span>
                                            <h6 class="mb-1 text-success">
                                                Final Approval
                                            </h6>

                                            <span class="badge bg-success">
                                                Completed
                                            </span>

                                        </div>
                                        <p><b>Remark:- </b>Application approved. Eligible for order generated and sent to Sanstha.</p> 

                                        

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>';

     $response = [
                'success' => true,
                'status' => 200,
                'timestamp' => time(),
                
                'html' => $html
            ];
          
         return $this->response
            ->withType('application/json')
            ->withStatus(200)
            ->withStringBody(json_encode($response));   

        $this->request->allowMethod(['get', 'ajax']);
      
         $ng2gApplicationLogsTable = $this->fetchTable('Ng2gApplicationLogs');
       
        $staffLogs = $ng2gApplicationLogsTable->find()->where(['ng2g_id' => $ng2g_id     
            ])->all();
        echo "<pre>";

        print_r($staffLogs);
        exit;

        $jurisdicationString = '';
        $jurisdicationData = '';
        $jurisdicationTotalCount = 0;
        $jurisdicationCount = count($jurisdictionCounts);
        $maxPendingCount = 0;
        
        $maxPendingJuridications = '';
        foreach($jurisdictionCounts as $loc){
            //print_r($loc['jurisdiction_name']);
            $jurisdicationString .= '"'.$loc['jurisdiction_name'].'",';
            $jurisdicationData .= $loc['jurisdiction_count'].',';
            $jurisdicationTotalCount += $loc['jurisdiction_count'];
            if($maxPendingCount == $loc['jurisdiction_count']){
                $maxPendingJuridications .= $loc['jurisdiction_name'].'/';
            }else if($maxPendingCount < $loc['jurisdiction_count']){
                $maxPendingJuridications = $loc['jurisdiction_name'].'/';
                $maxPendingCount = $loc['jurisdiction_count'];
            }
            //jurisdiction_count
            //exit;

        }
        $jurisdicationString = trim($jurisdicationString,",");
        $jurisdicationData = trim($jurisdicationData,",");
        $maxPendingJuridications = trim($maxPendingJuridications,"/");
        $html ='<div class="row mb-3">
                    <div class="col-md-4">
                        <div class="card shadow-sm border-primary">
                            <div class="card-body text-center py-3">
                                <h6 class="text-muted fw-semibold small mb-1">Total Jurisdictions</h6>
                                <h3 class="text-primary fw-bold mb-0">'. $jurisdicationCount.'</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-sm border-success">
                            <div class="card-body text-center py-3">
                                <h6 class="text-muted fw-semibold small mb-1">Total Applications</h6>
                                <h3 class="text-success fw-bold mb-0">'. $jurisdicationTotalCount .'</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-sm border-warning">
                            <div class="card-body text-center py-3">
                                <h6 class="text-muted fw-semibold small mb-1">
                                    Highest Pending
                                    <span class="badge bg-warning text-dark ms-1">'.$maxPendingCount.'</span>
                                </h6>
                                <h5 class="text-warning fw-bold mb-0">'. $maxPendingJuridications.'</h5>
                            </div>
                        </div>
                    </div>
                </div>';
        $html .='<div class="card shadow">
            <div class="card-header fw-bold">
                Applications by Jurisdiction
            </div>

            <div class="card-body">
                <div id="jurisdictionChart"></div>
            </div>
        </div>';
        $html .="<script>var options = {

            chart:{
                type:'bar',
                height:450,
                toolbar:{
                    show:true
                }
            },

            plotOptions:{
                bar:{
                    horizontal:true,
                    borderRadius:5
                }
            },

            series:[{
                name:'Applications',
                data:[".$jurisdicationData."]
            }],

            xaxis:{
                categories:[".$jurisdicationString."]
            },

            colors:['#f98704'],
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    type: 'vertical',   // horizontal | vertical | diagonal1 | diagonal2
                    shadeIntensity: 0.5,
                    inverseColors: false,
                    opacityFrom: 1,
                    opacityTo: 0.7,
                    stops: [0, 100]
                }
            },

            dataLabels:{
                enabled:true
            }

        };

        new ApexCharts(document.querySelector('#jurisdictionChart'), options).render();</script>";

         $response = [
                'success' => true,
                'status' => 200,
                'timestamp' => time(),
                
                'html' => $html
            ];
          
         return $this->response
            ->withType('application/json')
            ->withStatus(200)
            ->withStringBody(json_encode($response));   
        echo "<pre>".$html;
            echo count($jurisdictionCounts);
        print_r($jurisdictionCounts);
        exit;
       
       
       
    }
    public function jurisdictionNg2GStats($jurisdiction,$level)
    {

        $this->request->allowMethod(['get', 'ajax']);
      
        $staffTransfersTable = TableRegistry::getTableLocator()->get('StaffTransfers');
        $query = $staffTransfersTable->find();
                    $query->select([
                         'jurisdiction_name' => 'Jurisdication.name',
                         'jurisdiction_count' => $query->func()->count('StaffTransfers.id')
                    ])
                    ->join([
                        'Schools' => [
                            'table' => 'schools',
                            'type' => 'LEFT',
                            'conditions' => 'Schools.udise_code = StaffTransfers.udise_number'
                        ],
                        'Sansthas' => [
                            'table' => 'sansthas',
                            'type' => 'LEFT',
                            'conditions' => 'Sansthas.code = Schools.sanstha_code'
                        ]
                    ]);
        if($jurisdiction == 'eo'){
            if($level == 1) {
                $query->join(['Jurisdication' => [
                            'table' => 'districts',
                            'type' => 'LEFT',
                            'conditions' => 'Jurisdication.code = StaffTransfers.stage1_fwd_to_target'
                        ]])->where(['status LIKE' => 'eo_%','stage1_fwd_to' => 1]);
            }elseif ($level == 2) {
                $query->join(['Jurisdication' => [
                                'table' => 'districts',
                                'type' => 'LEFT',
                                'conditions' => 'Jurisdication.code = StaffTransfers.stage1_fwd_to_target'
                            ]])->where(['status LIKE' => 'eo_%','stage1_fwd_to' => 2]);
            }

        }elseif ($jurisdiction == 'mnp') {
            /*$query->join(['Jurisdication' => [
                            'table' => 'districts',
                            'type' => 'LEFT',
                            'conditions' => 'Jurisdication.code = StaffTransfers.fwd_to_target'
                        ]])->where(['fwd_to' => 3]);*/
            $query->where(['stage1_fwd_to' => 3]);
        }elseif ($jurisdiction == 'dyd') {
            if($level == 1) {
                $query->join([
                                'Districts' => [
                                    'table' => 'districts',
                                    'type' => 'LEFT',
                                    'conditions' => 'Districts.code = StaffTransfers.stage1_fwd_to_target'
                                ],
                                'Jurisdication' => [
                                    'table' => 'regions',
                                    'type' => 'LEFT',
                                    'conditions' => 'Jurisdication.id = Districts.region_id'
                                ]
                            ])->where(['status LIKE' => 'dyd_%','stage1_fwd_to' => 1]);
            }elseif ($level == 2) {               
                $query->join([
                                'Districts' => [
                                    'table' => 'districts',
                                    'type' => 'LEFT',
                                    'conditions' => 'Districts.code = StaffTransfers.stage1_fwd_to_target'
                                ],
                                'Jurisdication' => [
                                    'table' => 'regions',
                                    'type' => 'LEFT',
                                    'conditions' => 'Jurisdication.id = Districts.region_id'
                                ]
                            ])->where(['status LIKE' => 'dyd_%','stage1_fwd_to' => 2]);
            }elseif ($level == 3) {
            }elseif ($level == 4) {
                $query->join(['Jurisdication' => [
                                'table' => 'regions',
                                'type' => 'LEFT',
                                'conditions' => 'Jurisdication.code = StaffTransfers.stage1_fwd_to_target'
                            ]])->where(['status LIKE' => 'dyd_%','stage1_fwd_to' => 4]);
            }
        }        

        $jurisdictionCounts = $query->where([
                'status NOT LIKE' => 'application_draft_step_%',
                'status NOT LIKE' => 'sanstha_application_pending',
                'status LIKE' => '%_pending',
                'stage1_fwd_to >' => 0     
            ])
            ->groupBy([
                'Jurisdication.name'
            ])
            ->orderBy([
                'Jurisdication.name' => 'ASC'
            ])
            ->enableHydration(false)
            ->toArray();


        $jurisdicationString = '';
        $jurisdicationData = '';
        $jurisdicationTotalCount = 0;
        $jurisdicationCount = count($jurisdictionCounts);
        $maxPendingCount = 0;
        
        $maxPendingJuridications = '';
        foreach($jurisdictionCounts as $loc){
            //print_r($loc['jurisdiction_name']);
            $jurisdicationString .= '"'.$loc['jurisdiction_name'].'",';
            $jurisdicationData .= $loc['jurisdiction_count'].',';
            $jurisdicationTotalCount += $loc['jurisdiction_count'];
            if($maxPendingCount == $loc['jurisdiction_count']){
                $maxPendingJuridications .= $loc['jurisdiction_name'].'/';
            }else if($maxPendingCount < $loc['jurisdiction_count']){
                $maxPendingJuridications = $loc['jurisdiction_name'].'/';
                $maxPendingCount = $loc['jurisdiction_count'];
            }
            //jurisdiction_count
            //exit;

        }
        $jurisdicationString = trim($jurisdicationString,",");
        $jurisdicationData = trim($jurisdicationData,",");
        $maxPendingJuridications = trim($maxPendingJuridications,"/");
        $html ='<div class="row mb-3">
                    <div class="col-md-4">
                        <div class="card shadow-sm border-primary">
                            <div class="card-body text-center py-3">
                                <h6 class="text-muted fw-semibold small mb-1">Total Jurisdictions</h6>
                                <h3 class="text-primary fw-bold mb-0">'. $jurisdicationCount.'</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-sm border-success">
                            <div class="card-body text-center py-3">
                                <h6 class="text-muted fw-semibold small mb-1">Total Applications</h6>
                                <h3 class="text-success fw-bold mb-0">'. $jurisdicationTotalCount .'</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-sm border-warning">
                            <div class="card-body text-center py-3">
                                <h6 class="text-muted fw-semibold small mb-1">
                                    Highest Pending
                                    <span class="badge bg-warning text-dark ms-1">'.$maxPendingCount.'</span>
                                </h6>
                                <h5 class="text-warning fw-bold mb-0">'. $maxPendingJuridications.'</h5>
                            </div>
                        </div>
                    </div>
                </div>';
        $html .='<div class="card shadow">
            <div class="card-header fw-bold">
                Applications by Jurisdiction
            </div>

            <div class="card-body">
                <div id="jurisdictionChart"></div>
            </div>
        </div>';
        $html .="<script>var options = {

            chart:{
                type:'bar',
                height:450,
                toolbar:{
                    show:true
                }
            },

            plotOptions:{
                bar:{
                    horizontal:true,
                    borderRadius:5
                }
            },

            series:[{
                name:'Applications',
                data:[".$jurisdicationData."]
            }],

            xaxis:{
                categories:[".$jurisdicationString."]
            },

            colors:['#f98704'],
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    type: 'vertical',   // horizontal | vertical | diagonal1 | diagonal2
                    shadeIntensity: 0.5,
                    inverseColors: false,
                    opacityFrom: 1,
                    opacityTo: 0.7,
                    stops: [0, 100]
                }
            },

            dataLabels:{
                enabled:true
            }

        };

        new ApexCharts(document.querySelector('#jurisdictionChart'), options).render();</script>";

         $response = [
                'success' => true,
                'status' => 200,
                'timestamp' => time(),
                
                'html' => $html
            ];
          
         return $this->response
            ->withType('application/json')
            ->withStatus(200)
            ->withStringBody(json_encode($response));   
        echo "<pre>".$html;
            echo count($jurisdictionCounts);
        print_r($jurisdictionCounts);
        exit;
       
       
       
    }

    public function jurisdictionStats($jurisdiction,$level)
    {

        $this->request->allowMethod(['get', 'ajax']);      

        $staffTransfersTable = TableRegistry::getTableLocator()->get('StaffTransfers');
        $query = $staffTransfersTable->find();

                    $query->select([
                         'jurisdiction_name' => 'Jurisdication.name',
                         'jurisdiction_count' => $query->func()->count('StaffTransfers.id')
                    ])
                    ->join([
                        'Schools' => [
                            'table' => 'schools',
                            'type' => 'LEFT',
                            'conditions' => 'Schools.udise_code = StaffTransfers.udise_number'
                        ],
                        'Sansthas' => [
                            'table' => 'sansthas',
                            'type' => 'LEFT',
                            'conditions' => 'Sansthas.code = Schools.sanstha_code'
                        ]
                    ]);

        // Add level-wise condition
        if($level == 1) {
            $query->join(['Jurisdication' => [
                            'table' => 'districts',
                            'type' => 'LEFT',
                            'conditions' => 'Jurisdication.code = StaffTransfers.fwd_to_target'
                        ]])->where(['fwd_to' => 1]);
        } elseif ($level == 2) {
           $query->join(['Jurisdication' => [
                            'table' => 'districts',
                            'type' => 'LEFT',
                            'conditions' => 'Jurisdication.code = StaffTransfers.fwd_to_target'
                        ]])->where(['fwd_to' => 2]);
        } elseif ($level == 3) {
            /*$query->join(['Jurisdication' => [
                            'table' => 'districts',
                            'type' => 'LEFT',
                            'conditions' => 'Jurisdication.code = StaffTransfers.fwd_to_target'
                        ]])->where(['fwd_to' => 3]);*/
            $query->where(['fwd_to' => 3]);
        }elseif ($level == 4) {
            $query->join(['Jurisdication' => [
                            'table' => 'regions',
                            'type' => 'LEFT',
                            'conditions' => 'Jurisdication.code = StaffTransfers.fwd_to_target'
                        ]])->where(['fwd_to' => 4]);
        }

            

        

        $jurisdictionCounts = $query->where([
                'status NOT LIKE' => 'application_draft_step_%',
                'status NOT LIKE' => 'sanstha_application_pending',
                'status LIKE' => '%_pending',
                'OR' => [
                    ['stage1_fwd_to <' => 1],
                    ['stage1_fwd_to IS' => null]
                ]
            ])
            ->groupBy([
                'Jurisdication.name'
            ])
            ->orderBy([
                'Jurisdication.name' => 'ASC'
            ])
            ->enableHydration(false)
            ->toArray();


        $jurisdicationString = '';
        $jurisdicationData = '';
        $jurisdicationTotalCount = 0;
        $jurisdicationCount = count($jurisdictionCounts);
        $maxPendingCount = 0;
        
        $maxPendingJuridications = '';
        foreach($jurisdictionCounts as $loc){
            //print_r($loc['jurisdiction_name']);
            $jurisdicationString .= '"'.$loc['jurisdiction_name'].'",';
            $jurisdicationData .= $loc['jurisdiction_count'].',';
            $jurisdicationTotalCount += $loc['jurisdiction_count'];
            if($maxPendingCount == $loc['jurisdiction_count']){
                $maxPendingJuridications .= $loc['jurisdiction_name'].'/';
            }else if($maxPendingCount < $loc['jurisdiction_count']){
                $maxPendingJuridications = $loc['jurisdiction_name'].'/';
                $maxPendingCount = $loc['jurisdiction_count'];
            }
            //jurisdiction_count
            //exit;

        }
        $jurisdicationString = trim($jurisdicationString,",");
        $jurisdicationData = trim($jurisdicationData,",");
        $maxPendingJuridications = trim($maxPendingJuridications,"/");
        $html ='<div class="row mb-3">
                    <div class="col-md-4">
                        <div class="card shadow-sm border-primary">
                            <div class="card-body text-center py-3">
                                <h6 class="text-muted fw-semibold small mb-1">Total Jurisdictions</h6>
                                <h3 class="text-primary fw-bold mb-0">'. $jurisdicationCount.'</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-sm border-success">
                            <div class="card-body text-center py-3">
                                <h6 class="text-muted fw-semibold small mb-1">Total Applications</h6>
                                <h3 class="text-success fw-bold mb-0">'. $jurisdicationTotalCount .'</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-sm border-warning">
                            <div class="card-body text-center py-3">
                                <h6 class="text-muted fw-semibold small mb-1">
                                    Highest Pending
                                    <span class="badge bg-warning text-dark ms-1">'.$maxPendingCount.'</span>
                                </h6>
                                <h5 class="text-warning fw-bold mb-0">'. $maxPendingJuridications.'</h5>
                            </div>
                        </div>
                    </div>
                </div>';
        $html .='<div class="card shadow">
            <div class="card-header fw-bold">
                Applications by Jurisdiction
            </div>

            <div class="card-body">
                <div id="jurisdictionChart"></div>
            </div>
        </div>';
        $html .="<script>var options = {

            chart:{
                type:'bar',
                height:450,
                toolbar:{
                    show:true
                }
            },

            plotOptions:{
                bar:{
                    horizontal:true,
                    borderRadius:5
                }
            },

            series:[{
                name:'Applications',
                data:[".$jurisdicationData."]
            }],

            xaxis:{
                categories:[".$jurisdicationString."]
            },

            colors:['#f98704'],
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    type: 'vertical',   // horizontal | vertical | diagonal1 | diagonal2
                    shadeIntensity: 0.5,
                    inverseColors: false,
                    opacityFrom: 1,
                    opacityTo: 0.7,
                    stops: [0, 100]
                }
            },

            dataLabels:{
                enabled:true
            }

        };

        new ApexCharts(document.querySelector('#jurisdictionChart'), options).render();</script>";

         $response = [
                'success' => true,
                'status' => 200,
                'timestamp' => time(),
                
                'html' => $html
            ];
          
         return $this->response
            ->withType('application/json')
            ->withStatus(200)
            ->withStringBody(json_encode($response));   
        echo "<pre>".$html;
            echo count($jurisdictionCounts);
        print_r($jurisdictionCounts);
        exit;
       
       
       
    }
    public function ng2gVerifyReturnedApplicationSubmission()
    {

        $this->request->allowMethod(['post', 'ajax']);
        $data = $this->request->getData();
        $ng2g_id = (int)$data["application_id"];
        $transaction_id= $ng2g_id.rand(100000,999999);
        $stTime = time();

        $returnsTable = $this->fetchTable('Ng2gApplicationReturns');
        
        //print_r($result);
        /*echo "<pre>123";
        print_r($data);
        exit;*/
        $connection = ConnectionManager::get('default');
        $connection->begin();
        $config = Configure::read('ESDL');
          
        $bucketPath = $config['mode'].'/staff/'.$ng2g_id.'/transfers';
        try {
            $user = $this->request->getSession()->read('Auth.User');

            /*echo "<pre>123";
            print_r($user);
            print_r($juridication);
            exit;*/
            
            if(isset($data['verification_status']) && (count($data['verification_status'])>0)){
                foreach ($data['verification_status'] as $key => $value) {  
                   // echo "<hr>kkk-".$key."==".$value;                
                    if($value == 'correct'){
                        $returnsTable->updateAll(
                        [
                            'status' => 'corrected'
                        ],
                        [
                            'ng2g_id' => $ng2g_id,
                            'id' => $key
                        ]
                    );
                    }else{
                        $returnsTable->updateAll(
                            [                               
                                'status' => 'returned'
                            ],
                            [
                                'ng2g_id' => $ng2g_id,
                                'id' => $key
                            ]
                        );
                    }
                } 
            }
         

            $return_remark = "";
            if(!empty($data["return_remark"])){
                $return_remark = $data["return_remark"];
            }

            $returnsTable->updateAll(
                [                               
                    'rtn_field_reason' => $return_remark,
                     'status' => 'returned'
                ],
                [
                    'ng2g_id' => $ng2g_id,
                    'rtn_field_name' => 'overall_remark'
                ]
            );
        
            $ng2gApplicationLogsTable = $this->fetchTable('Ng2gApplicationLogs');
            $logData = [
                'ng2g_id'      => $ng2g_id,
                'transaction_id' => $transaction_id,
                'app_stage'    => 'returned',
                'stage_remark'    => $return_remark,
                'created_by'   => $this->user_id,
                'created_at'   => $stTime
            ];

            $log = $ng2gApplicationLogsTable->newEntity($logData);

            if (!$ng2gApplicationLogsTable->save($log)){
                    $connection->rollback();
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'success' => false,
                        'message' => 'Unable to return Application'
                    ]));  
            }

            $staffTransferTable = TableRegistry::getTableLocator()->get('StaffTransfers');  
            $transfer = $staffTransferTable->get($ng2g_id);

            $status = $transfer->status;
            $newStatus = preg_replace('/_forwarded$/', '_returned', $status);                                
            $staffData = [               
                'status' => $newStatus 
            ];
            $transfer = $staffTransferTable->patchEntity($transfer, $staffData);
            if (!$staffTransferTable->save($transfer)) {
                $connection->rollback();
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'success' => false,
                        'message' => 'Unable to save return application'
                    ]));
            }

            $connection->commit();

            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'success' => true,
                    'message' => 'Application returned successfully'
                ]));

        } catch (\Throwable $e) {
            $connection->rollback();

            return $this->response
                ->withStatus(422)
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'status' => false,
                    'error' =>  $e->getMessage(),
                    //'file'    => $e->getFile(),
                    //'line'    => $e->getLine(),
                   //  'ddd'    =>$e->getTraceAsString()
                ]));
        }
    }
    public function ng2gReplyToReturnApplicationSubmission()
    {

        $this->request->allowMethod(['post', 'ajax']);
        $data = $this->request->getData();
        $ng2g_id = (int)$data["application_id"];
        $transaction_id= $ng2g_id.rand(100000,999999);
        $stTime = time();

        $returnsTable = $this->fetchTable('Ng2gApplicationReturns');
        
        //print_r($result);
        /*echo "<pre>123";
        print_r($data);
        exit;*/
        $connection = ConnectionManager::get('default');
        $connection->begin();
        $config = Configure::read('ESDL');
          
        $bucketPath = $config['mode'].'/staff/'.$ng2g_id.'/transfers';
        try {
            foreach ($data as $key => $value) {

                if (preg_match('/^date_(\d+)$/', $key, $matches)) {              
                   $timestamp = !empty($value) ? strtotime($value) : null;
                  
                    $returnsTable->updateAll(
                        [
                            'sanstha_fwd_info' => $timestamp,
                            'status' => 'forwarded'
                        ],
                        [
                            'ng2g_id' => $ng2g_id,
                            'id' => $matches[1]
                        ]
                    );
                }else if (preg_match('/^(input|text)_(\d+)$/', $key, $matches)) {
                 
                    $returnsTable->updateAll(
                        [
                            'sanstha_fwd_info' => $value,
                            'status' => 'forwarded'
                        ],
                        [
                            'ng2g_id' => $ng2g_id,
                            'id' => $matches[2]
                        ]
                    );           

                }else if (preg_match('/^(sdate)_(\d+)$/', $key, $matches)) {

                    $id = $matches[2];

                    if (isset($data["sdate_$id"]) && isset($data["edate_$id"])) {

                        $sdate = $data["sdate_$id"];
                        $edate = $data["edate_$id"];
                        $dates = $sdate ." - ".$edate;

                        $returnsTable->updateAll(
                            [
                                'sanstha_fwd_info' => $dates,
                                'status' => 'forwarded'
                            ],
                            [
                                'ng2g_id' => $ng2g_id,
                                'id' => $id
                            ]
                        );  
                    }
                }else if (preg_match('/^document_(\d+)$/', $key, $matches)) {
                    
                     if (!empty($data[$key]) && $data[$key]->getError() === UPLOAD_ERR_OK) {
                        $file = $data[$key];
                        if ($file->getClientMediaType() !== 'application/pdf') {   
                            $connection->rollback();                     
                            return $this->response
                                ->withType('application/json')
                                ->withStringBody(json_encode([
                                    'success' => false,
                                    'message' => 'Must be a PDF File'
                                ]));
                        }

                        if ($file->getSize() > (2 * 1024 * 1024)) {
                            $connection->rollback();
                            return $this->response
                                ->withType('application/json')
                                ->withStringBody(json_encode([
                                    'success' => false,
                                    'message' => 'Exceeds 2MB limit File - '
                                ]));                        
                        }

                        if (!$file || $file->getError() !== UPLOAD_ERR_OK) {
                            $connection->rollback();
                            return $this->response
                                ->withType('application/json')
                                ->withStringBody(json_encode([
                                    'success' => false,
                                    'message' => 'Invalid File - '
                                ]));                        
                        }


                        // Get temp path safely
                        $tmpPath = $file->getStream()->getMetadata('uri');

                        // Extract extension (safe)
                        $extension = pathinfo($file->getClientFilename(), PATHINFO_EXTENSION);

                        // New filename
                        $newFileName = $key . '.' . $extension;

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
                        $returnsTable->updateAll(
                            [
                                'sanstha_fwd_info' => $fileName,
                                'status' => 'forwarded'
                            ],
                            [
                                'ng2g_id' => $ng2g_id,
                                'id' => $matches[1]
                            ]
                        );
                    }
                }
            }

            $ng2gApplicationLogsTable = $this->fetchTable('Ng2gApplicationLogs');
            $logData = [
                'ng2g_id'      => $ng2g_id,
                'transaction_id' => $transaction_id,
                'app_stage'    => 'forwarded',
                'created_by'   => $this->user_id,
                'created_at'   => $stTime
            ];

            $log = $ng2gApplicationLogsTable->newEntity($logData);

            if (!$ng2gApplicationLogsTable->save($log)){
                    $connection->rollback();
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'success' => false,
                        'message' => 'Unable to forward Application'
                    ]));  
            }

            $staffTransferTable = TableRegistry::getTableLocator()->get('StaffTransfers');  
            $transfer = $staffTransferTable->get($ng2g_id);

            $status = $transfer->status;
            $newStatus = preg_replace('/_returned$/', '_forwarded', $status);                                
            $staffData = [               
                'status' => $newStatus 
            ];
            $transfer = $staffTransferTable->patchEntity($transfer, $staffData);
            if (!$staffTransferTable->save($transfer)) {
                $connection->rollback();
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'success' => false,
                        'message' => 'Unable to save return application'
                    ]));
            }

            $connection->commit();

            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'success' => true,
                    'message' => 'Application forwarded successfully'
                ]));

        } catch (\Throwable $e) {
            $connection->rollback();

            return $this->response
                ->withStatus(422)
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'status' => false,
                    'error' =>  $e->getMessage(),
                    //'file'    => $e->getFile(),
                    //'line'    => $e->getLine(),
                   //  'ddd'    =>$e->getTraceAsString()
                ]));
        }
    }

    public function ng2gReturnApplicationSubmission()
    {

        $this->request->allowMethod(['post', 'ajax']);
        $data = $this->request->getData();
       
        /*echo "<pre>123";
        print_r($data);
        exit;*/

        $insertData = array();
        $ng2g_id =  $data['application_id'];
        $transaction_id= $ng2g_id.rand(100000,999999);
        
        if(isset($data['user_level_id'])){
            $user_level_id = data['user_level_id'];
        }else{
            $user_level_id = "";
        }
        if(isset($data['user_juridiction_id'])){
            $user_juridiction_id = data['user_juridiction_id'];
        }else{
            $user_juridiction_id = "";
        }
        $status= 'returned'; 
        $stTime = time();

        $user = $this->request->getSession()->read('Auth.User');

        /*echo "<pre>123";
        print_r($user);
        print_r($juridication);
        exit;*/
        if($user["role"] =='division'){
            $juridication = $this->request->getSession()->read('Auth.Division');
            $user_level_id =  $juridication->Jurisdiction;
            $user_juridiction_id =  $juridication->code;
            $last4 = substr($user["username"], -4);
            if($last4=='CLRP'){
                $status= 'dyd_clerk_primary_desk_returned'; 
            }else if($last4=='CLRS'){
                $status= 'dyd_clerk_secondary_desk_returned'; 
            }else if($last4=='CLRH'){
                $status= 'dyd_clerk_higher_secondary_desk_returned'; 
            }else if($last4=='DEIP'){
                $status= 'dyd_deputy_education_inspector_primary_desk_returned'; 
            }else if($last4=='DEIS'){
                $status= 'dyd_deputy_education_inspector_secondary_desk_returned'; 
            }else if($last4=='ADIH'){
                $status= 'dyd_assistant_director_inspector_higher_secondary_desk_returned'; 
            }else{
                $status= 'dyd_desk_returned'; 
            }
        }else if($user["role"] =='district'){
            $juridication = $this->request->getSession()->read('Auth.District');
            $user_level_id =  $juridication->Jurisdiction;
            $user_juridiction_id =  $juridication->code;
            $last3 = substr($user["username"], -3);
            if($last3=='CLR'){
                if($user_level_id == 1){
                    $status= 'eo_clerk_primary_desk_returned'; 
                }else{
                    $status= 'eo_clerk_secondary_desk_returned';                     
                }
            }else if($last3=='SUP'){
                if($user_level_id == 1){
                    $status= 'eo_superintendent_primary_desk_returned'; 
                }else{
                    $status= 'eo_superintendent_secondary_desk_returned';                     
                }
            }else{
                if($user_level_id == 1){
                    $status= 'eo_primary_desk_returned'; 
                }else{
                    $status= 'eo_secondary_desk_returned';                     
                }
                $status= 'eo_desk_returned'; 
            }
        }else if($user["role"] =='deputydirector'){
            if($user["username"] == '27DDP'){
                $status= 'dy_director_primary_desk_returned'; 
            }else if($user["username"] == '27DDS'){
                $status= 'dy_director_secondary_desk_returned';                     
            }else{
                $status= 'dy_director_higher_secondary_desk_returned';                     
            }
        }
        
       
        if (
            (isset($data['hsc_doc_chk']) && $data['hsc_doc_chk'] === 'on') ||
            !empty($data['hsc_doc_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "hsc_file",
                "rtn_field_reason" =>  $data['hsc_doc_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }


        if (
            (isset($data['graduate_doc_chk']) && $data['graduate_doc_chk'] === 'on') ||
            !empty($data['graduate_doc_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "graduate_file",
                "rtn_field_reason" =>  $data['graduate_doc_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['post_graduate_doc_chk']) && $data['post_graduate_doc_chk'] === 'on') ||
            !empty($data['post_graduate_doc_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "post_graduate_file",
                "rtn_field_reason" =>  $data['post_graduate_doc_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['ded_doc_chk']) && $data['ded_doc_chk'] === 'on') ||
            !empty($data['ded_doc_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "ded_file",
                "rtn_field_reason" =>  $data['ded_doc_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['bed_doc_chk']) && $data['bed_doc_chk'] === 'on') ||
            !empty($data['bed_doc_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "bed_file",
                "rtn_field_reason" =>  $data['bed_doc_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['mped_doc_chk']) && $data['mped_doc_chk'] === 'on') ||
            !empty($data['mped_doc_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "mped_file",
                "rtn_field_reason" =>  $data['mped_doc_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }




        if (
            (isset($data['school_committee_outward_chk']) && $data['school_committee_outward_chk'] === 'on') ||
            !empty($data['school_committee_outward_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "school_committee_outward",
                "rtn_field_reason" =>  $data['school_committee_outward_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }



        if (
            (isset($data['school_committee_date_chk']) && $data['school_committee_date_chk'] === 'on') ||
            !empty($data['school_committee_date_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "school_committee_date",
                "rtn_field_reason" =>  $data['school_committee_date_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['school_committee_doc_chk']) && $data['school_committee_doc_chk'] === 'on') ||
            !empty($data['school_committee_doc_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "school_committee_outward_file",
                "rtn_field_reason" =>  $data['school_committee_doc_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['origin_sanstha_appointment_outward_chk']) && $data['origin_sanstha_appointment_outward_chk'] === 'on') ||
            !empty($data['origin_sanstha_appointment_outward_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "origin_sanstha_appointment_outward",
                "rtn_field_reason" =>  $data['origin_sanstha_appointment_outward_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['origin_sanstha_appointment_date_chk']) && $data['origin_sanstha_appointment_date_chk'] === 'on') ||
            !empty($data['origin_sanstha_appointment_date_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "origin_sanstha_appointment_date",
                "rtn_field_reason" =>  $data['origin_sanstha_appointment_date_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }
        if (
            (isset($data['origin_sanstha_appointment_doc_chk']) && $data['origin_sanstha_appointment_doc_chk'] === 'on') ||
            !empty($data['origin_sanstha_appointment_doc_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "origin_sanstha_appointment_file",
                "rtn_field_reason" =>  $data['origin_sanstha_appointment_doc_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }



        if (
            (isset($data['personal_recognition_outward_chk']) && $data['personal_recognition_outward_chk'] === 'on') ||
            !empty($data['personal_recognition_outward_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "personal_recognition_outward",
                "rtn_field_reason" =>  $data['personal_recognition_outward_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['personal_recognition_date_chk']) && $data['personal_recognition_date_chk'] === 'on') ||
            !empty($data['personal_recognition_date_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "personal_recognition_date",
                "rtn_field_reason" =>  $data['personal_recognition_date_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['personal_recognition_doc_chk']) && $data['personal_recognition_doc_chk'] === 'on') ||
            !empty($data['personal_recognition_doc_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "personal_recognition_file",
                "rtn_field_reason" =>  $data['personal_recognition_doc_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }


        if (
            (isset($data['service_seniority_outward_chk']) && $data['service_seniority_outward_chk'] === 'on') ||
            !empty($data['service_seniority_outward_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "service_seniority_outward",
                "rtn_field_reason" =>  $data['service_seniority_outward_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['service_seniority_date_chk']) && $data['service_seniority_date_chk'] === 'on') ||
            !empty($data['service_seniority_date_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "service_seniority_date",
                "rtn_field_reason" =>  $data['service_seniority_date_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['service_seniority_doc_chk']) && $data['service_seniority_doc_chk'] === 'on') ||
            !empty($data['service_seniority_doc_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "service_seniority_list_file",
                "rtn_field_reason" =>  $data['service_seniority_doc_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['vacant_post_merit_outward_chk']) && $data['vacant_post_merit_outward_chk'] === 'on') ||
            !empty($data['vacant_post_merit_outward_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "vacant_post_merit_outward",
                "rtn_field_reason" =>  $data['vacant_post_merit_outward_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['vacant_post_merit_date_chk']) && $data['vacant_post_merit_date_chk'] === 'on') ||
            !empty($data['vacant_post_merit_date_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "vacant_post_merit_date",
                "rtn_field_reason" =>  $data['vacant_post_merit_date_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['vacant_post_merit_doc_chk']) && $data['vacant_post_merit_doc_chk'] === 'on') ||
            !empty($data['vacant_post_merit_doc_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "vacant_post_merit_list_file",
                "rtn_field_reason" =>  $data['vacant_post_merit_doc_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['hm_5yrs_certi_outward_chk']) && $data['hm_5yrs_certi_outward_chk'] === 'on') ||
            !empty($data['hm_5yrs_certi_outward_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "hm_5yrs_certi_outward",
                "rtn_field_reason" =>  $data['hm_5yrs_certi_outward_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['hm_5yrs_certi_date_chk']) && $data['hm_5yrs_certi_date_chk'] === 'on') ||
            !empty($data['hm_5yrs_certi_date_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "hm_5yrs_certi_date",
                "rtn_field_reason" =>  $data['hm_5yrs_certi_date_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }


        if (
            (isset($data['hm_5yrs_certi_doc_chk']) && $data['hm_5yrs_certi_doc_chk'] === 'on') ||
            !empty($data['hm_5yrs_certi_doc_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "five_years_hm_certificate_file",
                "rtn_field_reason" =>  $data['hm_5yrs_certi_doc_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }


        if (
            (isset($data['vacant_post_outward_chk']) && $data['vacant_post_outward_chk'] === 'on') ||
            !empty($data['vacant_post_outward_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "vacant_post_outward",
                "rtn_field_reason" =>  $data['vacant_post_outward_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }


        if (
            (isset($data['vacant_post_date_chk']) && $data['vacant_post_date_chk'] === 'on') ||
            !empty($data['vacant_post_date_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "vacant_post_date",
                "rtn_field_reason" =>  $data['vacant_post_date_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }


        if (
            (isset($data['vacant_post_doc_chk']) && $data['vacant_post_doc_chk'] === 'on') ||
            !empty($data['vacant_post_doc_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "vacant_post_causing_transfer_file",
                "rtn_field_reason" =>  $data['vacant_post_doc_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }


        if (
            (isset($data['mavak_checklist_outward_chk']) && $data['mavak_checklist_outward_chk'] === 'on') ||
            !empty($data['mavak_checklist_outward_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "mavak_checklist_outward",
                "rtn_field_reason" =>  $data['mavak_checklist_outward_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }


        if (
            (isset($data['mavak_checklist_doc_chk']) && $data['mavak_checklist_doc_chk'] === 'on') ||
            !empty($data['mavak_checklist_doc_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "mavak_checklist_file",
                "rtn_field_reason" =>  $data['mavak_checklist_doc_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['recruitment_noc_outward_chk']) && $data['recruitment_noc_outward_chk'] === 'on') ||
            !empty($data['recruitment_noc_outward_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "recruitment_noc_outward",
                "rtn_field_reason" =>  $data['recruitment_noc_outward_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['recruitment_noc_doc_chk']) && $data['recruitment_noc_doc_chk'] === 'on') ||
            !empty($data['recruitment_noc_doc_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "recruitment_noc_outward_file",
                "rtn_field_reason" =>  $data['recruitment_noc_doc_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }


        if (
            (isset($data['advrt_newspaper_outward_chk']) && $data['advrt_newspaper_outward_chk'] === 'on') ||
            !empty($data['advrt_newspaper_outward_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "advrt_newspaper_outward",
                "rtn_field_reason" =>  $data['advrt_newspaper_outward_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['advrt_newspaper_doc_chk']) && $data['advrt_newspaper_doc_chk'] === 'on') ||
            !empty($data['advrt_newspaper_doc_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "advrt_newspaper_file",
                "rtn_field_reason" =>  $data['advrt_newspaper_doc_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['interview_outward_chk']) && $data['interview_outward_chk'] === 'on') ||
            !empty($data['interview_outward_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "interview_outward",
                "rtn_field_reason" =>  $data['interview_outward_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['interview_doc_chk']) && $data['interview_doc_chk'] === 'on') ||
            !empty($data['interview_doc_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "interview_file",
                "rtn_field_reason" =>  $data['interview_doc_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }


        if (
            (isset($data['report_ng_principle_outward_chk']) && $data['report_ng_principle_outward_chk'] === 'on') ||
            !empty($data['report_ng_principle_outward_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "report_ng_principle_outward",
                "rtn_field_reason" =>  $data['report_ng_principle_outward_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['report_ng_principle_doc_chk']) && $data['report_ng_principle_doc_chk'] === 'on') ||
            !empty($data['report_ng_principle_doc_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "report_ng_principle_file",
                "rtn_field_reason" =>  $data['report_ng_principle_doc_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }


        if (
            (isset($data['report_g_principle_outward_chk']) && $data['report_g_principle_outward_chk'] === 'on') ||
            !empty($data['report_g_principle_outward_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "report_g_principle_outward",
                "rtn_field_reason" =>  $data['report_g_principle_outward_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }


        if (
            (isset($data['report_g_principle_doc_chk']) && $data['report_g_principle_doc_chk'] === 'on') ||
            !empty($data['report_g_principle_doc_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "report_g_principle_file",
                "rtn_field_reason" =>  $data['report_g_principle_doc_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['self_financing_certificate_outward_chk']) && $data['self_financing_certificate_outward_chk'] === 'on') ||
            !empty($data['self_financing_certificate_outward_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "self_financing_certificate_outward",
                "rtn_field_reason" =>  $data['self_financing_certificate_outward_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['self_financing_certificate_doc_chk']) && $data['self_financing_certificate_doc_chk'] === 'on') ||
            !empty($data['self_financing_certificate_doc_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "self_financing_certificate_file",
                "rtn_field_reason" =>  $data['self_financing_certificate_doc_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['transfer_not_higher_post_outward_chk']) && $data['transfer_not_higher_post_outward_chk'] === 'on') ||
            !empty($data['transfer_not_higher_post_outward_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "transfer_not_higher_post_outward",
                "rtn_field_reason" =>  $data['transfer_not_higher_post_outward_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['transfer_not_higher_post_doc_chk']) && $data['transfer_not_higher_post_doc_chk'] === 'on') ||
            !empty($data['transfer_not_higher_post_doc_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "transfer_not_higher_post_file",
                "rtn_field_reason" =>  $data['transfer_not_higher_post_doc_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['salary_subsidy_guarantee_doc_chk']) && $data['salary_subsidy_guarantee_doc_chk'] === 'on') ||
            !empty($data['salary_subsidy_guarantee_doc_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "salary_subsidy_guarantee_letter_file",
                "rtn_field_reason" =>  $data['salary_subsidy_guarantee_doc_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['itr1_doc_chk']) && $data['itr1_doc_chk'] === 'on') ||
            !empty($data['itr1_doc_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "itr1_file",
                "rtn_field_reason" =>  $data['itr1_doc_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['itr2_doc_chk']) && $data['itr2_doc_chk'] === 'on') ||
            !empty($data['itr2_doc_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "itr2_file",
                "rtn_field_reason" =>  $data['itr2_doc_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['itr3_doc_chk']) && $data['itr3_doc_chk'] === 'on') ||
            !empty($data['itr3_doc_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "itr3_file",
                "rtn_field_reason" =>  $data['itr3_doc_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['bank_statement_date_chk']) && $data['bank_statement_date_chk'] === 'on') ||
            !empty($data['bank_statement_date_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "bank_statement_date",
                "rtn_field_reason" =>  $data['bank_statement_date_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['bank_statement_doc_chk']) && $data['bank_statement_doc_chk'] === 'on') ||
            !empty($data['bank_statement_doc_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "bank_statement_file",
                "rtn_field_reason" =>  $data['bank_statement_doc_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['court_order_outward_chk']) && $data['court_order_outward_chk'] === 'on') ||
            !empty($data['court_order_outward_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "court_order_outward",
                "rtn_field_reason" =>  $data['court_order_outward_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['court_order_date_chk']) && $data['court_order_date_chk'] === 'on') ||
            !empty($data['court_order_date_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "court_order_date",
                "rtn_field_reason" =>  $data['court_order_date_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['court_order_doc_chk']) && $data['court_order_doc_chk'] === 'on') ||
            !empty($data['court_order_doc_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "court_order_file",
                "rtn_field_reason" =>  $data['court_order_doc_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['no_benefits_certificate_description_chk']) && $data['no_benefits_certificate_description_chk'] === 'on') ||
            !empty($data['no_benefits_certificate_description_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "no_benefits_certificate_description",
                "rtn_field_reason" =>  $data['no_benefits_certificate_description_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['no_benefits_certificate_doc_chk']) && $data['no_benefits_certificate_doc_chk'] === 'on') ||
            !empty($data['no_benefits_certificate_doc_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "no_benefits_certificate_file",
                "rtn_field_reason" =>  $data['no_benefits_certificate_doc_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['nps_scheme_doc_chk']) && $data['nps_scheme_doc_chk'] === 'on') ||
            !empty($data['nps_scheme_doc_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "nps_scheme",
                "rtn_field_reason" =>  $data['nps_scheme_doc_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }


        if (
            (isset($data['institution_guarantee_doc_chk']) && $data['institution_guarantee_doc_chk'] === 'on') ||
            !empty($data['institution_guarantee_doc_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "institution_guarantee_file",
                "rtn_field_reason" =>  $data['institution_guarantee_doc_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['institution_no_disbute_doc_chk']) && $data['institution_no_disbute_doc_chk'] === 'on') ||
            !empty($data['institution_no_disbute_doc_reason'])
        ) {
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "institution_no_disbute_file",
                "rtn_field_reason" =>  $data['institution_no_disbute_doc_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        $overall_remark ="";
        if (!empty($data['overall_remark'])) {
            $overall_remark =$data['overall_remark'];
            $insertData[] = array(
                "ng2g_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "overall_remark",
                "rtn_field_reason" =>  $data['overall_remark'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }
       

       

        try {
            if(count($insertData) > 0){
                $connection = ConnectionManager::get('default');
                $connection->begin();

                $ng2gApplicationReturnsTable = TableRegistry::getTableLocator()->get('Ng2gApplicationReturns');

                $entities = $ng2gApplicationReturnsTable->newEntities($insertData);

                if ($ng2gApplicationReturnsTable->saveMany($entities)) {
                    $ng2gApplicationLogsTable = $this->fetchTable('Ng2gApplicationLogs');
                    $logData = [
                        'ng2g_id'      => $ng2g_id,
                        'transaction_id' => $transaction_id,
                        'app_stage'    => 'returned',
                        'stage_remark'    => $overall_remark,
                        'created_by'   => $this->user_id,
                        'created_at'   => $stTime
                    ];

                    $log = $ng2gApplicationLogsTable->newEntity($logData);

                    if ($ng2gApplicationLogsTable->save($log)) {

                        $staffTransferTable = TableRegistry::getTableLocator()->get('StaffTransfers');  
                        $transfer = $staffTransferTable->get($ng2g_id);
                                            
                        $staffData = [               
                            'status'            => $status       

                        ];
                        $transfer = $staffTransferTable->patchEntity($transfer, $staffData);
                        if (!$staffTransferTable->save($transfer)) {
                            $connection->rollback();
                            return $this->response
                                ->withType('application/json')
                                ->withStringBody(json_encode([
                                    'success' => false,
                                    'message' => 'Unable to save return application'
                                ]));
                        }
                        $connection->commit();
                        return $this->response
                            ->withType('application/json')
                            ->withStringBody(json_encode([
                                'success' => true,
                                'message' => 'Application returned to Sanstha successfully'
                            ]));

                    }
                        
                }          
            }
            return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'success' => false,
                        'message' => 'Unable to save return application'
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
    public function ng2gTransferDetails($app_id)
    {
        
        $this->Authorization->skipAuthorization();
       // $this->viewBuilder()->setLayout('state');
    
        $staffTransfersTable = TableRegistry::getTableLocator()->get('StaffTransfers');
      

        $ng2g = $staffTransfersTable->find()               
                ->where(['id' => $app_id])
                ->first();

        /*
        echo "<pre>";
        print_r($ng2g);
        exit;
        */

        if(!is_object($ng2g)){
            $response = [
                'success' => false,
                'status' => 400,
                'timestamp' => time(),
                'message' => "No data found"
            ];
          
            return $this->response
                ->withType('application/json')
                ->withStatus(400)
                ->withStringBody(json_encode($response));   
        }
        
        $storage = new EsdlStorageService();

        if (!empty($ng2g->hsc_file)) {
                $ng2g->hsc_file = $storage->signedUrl($ng2g->hsc_file);
        }
        if (!empty($ng2g->graduate_file)) {
                $ng2g->graduate_file = $storage->signedUrl($ng2g->graduate_file);
        }
        if (!empty($ng2g->post_graduate_file)) {
                $ng2g->post_graduate_file = $storage->signedUrl($ng2g->post_graduate_file);
        }
        if (!empty($ng2g->ded_file)) {
                $ng2g->ded_file = $storage->signedUrl($ng2g->ded_file);
        }
        if (!empty($ng2g->bed_file)) {
                $ng2g->bed_file = $storage->signedUrl($ng2g->bed_file);
        }
        if (!empty($ng2g->mped_file)) {
                $ng2g->mped_file = $storage->signedUrl($ng2g->mped_file);
        }
        if (!empty($ng2g->tet_certificate_file)) {
                $ng2g->tet_certificate_file = $storage->signedUrl($ng2g->tet_certificate_file);
        }

        if (!empty($ng2g->ctet_certificate_file)) {
                $ng2g->ctet_certificate_file = $storage->signedUrl($ng2g->ctet_certificate_file);
        }

        if (!empty($ng2g->school_committee_outward_file)) {
                $ng2g->school_committee_outward_file = $storage->signedUrl($ng2g->school_committee_outward_file);
        }
        if (!empty($ng2g->origin_sanstha_appointment_file)) {
                $ng2g->origin_sanstha_appointment_file = $storage->signedUrl($ng2g->origin_sanstha_appointment_file);
        }
        if (!empty($ng2g->personal_recognition_file)) {
                $ng2g->personal_recognition_file = $storage->signedUrl($ng2g->personal_recognition_file);
        }
        if (!empty($ng2g->service_seniority_list_file)) {
                $ng2g->service_seniority_list_file = $storage->signedUrl($ng2g->service_seniority_list_file);
        }
        if (!empty($ng2g->vacant_post_merit_list_file)) {
                $ng2g->vacant_post_merit_list_file = $storage->signedUrl($ng2g->vacant_post_merit_list_file);
        }
        if (!empty($ng2g->five_years_hm_certificate_file)) {
                $ng2g->five_years_hm_certificate_file = $storage->signedUrl($ng2g->five_years_hm_certificate_file);
        }
        if (!empty($ng2g->vacant_post_causing_transfer_file)) {
                $ng2g->vacant_post_causing_transfer_file = $storage->signedUrl($ng2g->vacant_post_causing_transfer_file);
        }
        if (!empty($ng2g->mavak_checklist_file)) {
                $ng2g->mavak_checklist_file = $storage->signedUrl($ng2g->mavak_checklist_file);
        }
        if (!empty($ng2g->recruitment_noc_outward_file)) {
                $ng2g->recruitment_noc_outward_file = $storage->signedUrl($ng2g->recruitment_noc_outward_file);
        }

        
        if (!empty($ng2g->advrt_newspaper_file)) {
                $ng2g->advrt_newspaper_file = $storage->signedUrl($ng2g->advrt_newspaper_file);
        }
        
        if (!empty($ng2g->interview_file)) {
                $ng2g->interview_file = $storage->signedUrl($ng2g->interview_file);
        }
        
        if (!empty($ng2g->school_permission_order_file)) {
                $ng2g->school_permission_order_file = $storage->signedUrl($ng2g->school_permission_order_file);
        }
        
        
        if (!empty($ng2g->school_at_transfer_file)) {
                $ng2g->school_at_transfer_file = $storage->signedUrl($ng2g->school_at_transfer_file);
        }
        
        if (!empty($ng2g->outward_number_match_certificate_file)) {
                $ng2g->outward_number_match_certificate_file = $storage->signedUrl($ng2g->outward_number_match_certificate_file);
        }
        
        
        if (!empty($ng2g->report_ng_principle_file)) {
                $ng2g->report_ng_principle_file = $storage->signedUrl($ng2g->report_ng_principle_file);
        }
        
        if (!empty($ng2g->report_g_principle_file)) {
                $ng2g->report_g_principle_file = $storage->signedUrl($ng2g->report_g_principle_file);
        }
        
        if (!empty($ng2g->self_financing_certificate_file)) {
                $ng2g->self_financing_certificate_file = $storage->signedUrl($ng2g->self_financing_certificate_file);
        }
        
        if (!empty($ng2g->salary_subsidy_guarantee_letter_file)) {
                $ng2g->salary_subsidy_guarantee_letter_file = $storage->signedUrl($ng2g->salary_subsidy_guarantee_letter_file);
        }

        if (!empty($ng2g->itr1_file)) {
                $ng2g->itr1_file = $storage->signedUrl($ng2g->itr1_file);
        }
        
        if (!empty($ng2g->itr2_file)) {
                $ng2g->itr2_file = $storage->signedUrl($ng2g->itr2_file);
        }
        
        if (!empty($ng2g->itr3_file)) {
                $ng2g->itr3_file = $storage->signedUrl($ng2g->itr3_file);
        }
        
        if (!empty($ng2g->bank_statement_file)) {
                $ng2g->bank_statement_file = $storage->signedUrl($ng2g->bank_statement_file);
        }
        if (!empty($ng2g->no_benefits_certificate_file)) {
                $ng2g->no_benefits_certificate_file = $storage->signedUrl($ng2g->no_benefits_certificate_file);
        }
        
        if (!empty($ng2g->nps_scheme)) {
                $ng2g->nps_scheme = $storage->signedUrl($ng2g->nps_scheme);
        }

        if (!empty($ng2g->institution_guarantee_file)) {
                $ng2g->institution_guarantee_file = $storage->signedUrl($ng2g->institution_guarantee_file);
        }

        if (!empty($ng2g->institution_no_disbute_file)) {
                $ng2g->institution_no_disbute_file = $storage->signedUrl($ng2g->institution_no_disbute_file);
        }
        
       
        
        if (!empty($ng2g->other_documents_file)) {
                $ng2g->other_documents_file = $storage->signedUrl($ng2g->other_documents_file);
        }
    

        

        

        $html = '<div class="row mb-2">
                    <div class="col-md-3">
                        <label for="institutionCode" class="form-label marathi-label" style="font-size:10px !important;">संस्था कोड <span class="english-label" style="font-size:10px !important;">(Institution Code)</span> &rarr; <span class="txtval">'.
                        h($ng2g->institution_code).
                        '</span></label>                            
                    </div>
                    <div class="col-md-9">                            
                        <label for="institutionName" class="form-label marathi-label" style="font-size:10px !important;">संस्थेचे नाव <span class="english-label" style="font-size:10px !important;">(Institution Name)</span> &rarr; <span class="txtval">'.
                        h($ng2g->institution_name).
                        '</span></label> 
                    </div>
                </div>';
        $html .= '<div class="row mb-2">
                        <div class="col-md-3">
                            <label for="udiseNumber" class="form-label marathi-label" style="font-size:10px !important;">UDISE क्रमांक <span class="english-label" style="font-size:10px !important;">(UDISE Code)</span> &rarr; <span class="txtval">'.
                            h($ng2g->udise_number).
                            '</span></label> 
                        </div>
                    
                   
                        <div class="col-md-9">
                            <label for="schoolName" class="form-label marathi-label" style="font-size:10px !important;">शाळेचे नाव <span class="english-label" style="font-size:10px !important;">(School Name)</span> &rarr; <span class="txtval">'.
                            h($ng2g->school_name)
                            .'</span></label> 
                        </div>                  
                        
                        <!--
                        <div class="col-md-12">
                            <label for="schoolLocation" class="form-label marathi-label" style="font-size:10px !important;">शाळेचे ठिकाण <span class="english-label" style="font-size:10px !important;">(School Location)</span> &rarr; <span class="txtval"></span></label> 
                        </div>-->
                    </div>';


        if(($ng2g->is_transfer_school == 1) && (!empty($ng2g->udise_number_at_transfer))){         
            $html .= '<div class="row mb-2">
                        <div class="col-md-3">
                            <label for="udiseNumber" class="form-label marathi-label">बदलीने रुजू होण्यासाठी प्रस्तावित शाळा क्रमांक <span class="english-label">(UDISE Code)</span> &rarr; <span class="txtval">'.
                            h($ng2g->udise_number_at_transfer).
                            '</span></label> 
                        </div>
                    
                   
                        <div class="col-md-9">
                            <label for="schoolName" class="form-label marathi-label">बदलीने रुजू होण्यासाठी प्रस्तावित शाळेचे नाव <span class="english-label">(School Name)</span> &rarr; <span class="txtval">'.
                            h($ng2g->school_name_at_transfer)
                            .'</span></label> 
                        </div>                  
                        
                        <!--
                        <div class="col-md-12">
                            <label for="schoolLocation" class="form-label marathi-label">शाळेचे ठिकाण <span class="english-label">(School Location)</span> &rarr; <span class="txtval"></span></label> 
                        </div>-->
                    </div>';
        }

        $is_minority_school = false;
        if(($ng2g->is_minority_school == 1) && (!empty($ng2g->minority_cert_outward_number))){  
            $is_minority_school = true;
            if (!empty($ng2g->minority_cert_outward_file)) {
                 $ng2g->minority_cert_outward_file = $storage->signedUrl(
                    $ng2g->minority_cert_outward_file
                );
            }       
            $html .= '<div class="row mb-2">
                        <h3 class="section-title">अल्पसंख्याक शाळा प्रमाणपत्र</h3> 
                        
                        <div class="col-md-4">
                            <label class="form-label marathi-label">जावक क्रमांक <span class="english-label">(Outward No.)</span> &rarr; <span class="txtval">'.
                            h($ng2g->minority_cert_outward_number)
                            .'</span></label> 
                        </div>  
                         <div class="col-md-4">
                            <label class="form-label marathi-label">दिनांक <span class="english-label">(Date)</span> &rarr; <span class="txtval">'.
                            h($ng2g->minority_cert_outward_date)
                            .'</span></label> 
                        </div>  
                        <div class="col-md-4">
                             <a class="viewBtn" href="'.h($ng2g->minority_cert_outward_file).'" target="_blank">
                                <i class="fa fa-eye"></i> View
                            </a>
                        </div>  
                    </div>';
        }

        $html .= '<div class="row">
                        <div class="col-md-4">
                            <label class="form-label marathi-label" style="font-size:10px !important;">कर्मचाऱ्याचे नाव<span class="english-label" style="font-size:10px !important;">(Teacher Name)</span>&rarr;<span class="txtval">'.
                            h($ng2g->employee_name).
                            '</span></label>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label marathi-label" style="font-size:10px !important;">पदनाम<span class="english-label" style="font-size:10px !important;">(Designation)</span>&rarr;<span class="txtval">'.
                            h($ng2g->designation).
                            '</span></label>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label marathi-label" style="font-size:10px !important;">अनुदान प्रकार<span class="english-label" style="font-size:10px !important;">(Aid  Type)</span>&rarr;<span class="txtval">'.
                            h($ng2g->aid_name)
                            .'</span></label>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label marathi-label" style="font-size:10px !important;">कर्मचारी प्रकार<span class="english-label" style="font-size:10px !important;">(Staff Type)</span>&rarr;<span class="txtval">'.
                            h($ng2g->staff_type_name)
                            .'</span></label>
                        </div>
                    </div>';
       

                    

        $html .= '<div class="row">
                    <div class="col-md-4">
                        <label class="form-label marathi-label" style="font-size:10px !important;">वेतनश्रेणी <span class="english-label" style="font-size:10px !important;">(Salary Grade)</span> &rarr; <span class="txtval">'.
                        h((empty($ng2g->salary_grade) || ($ng2g->salary_grade=='null'))? '-': $ng2g->salary_grade).
                        '</span></label>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label marathi-label" style="font-size:10px !important;">अध्यापन विषय <span class="english-label" style="font-size:10px !important;">(Teaching Subjects)</span> &rarr; <span class="txtval">'.
                        h((empty($ng2g->teaching_subject) || ($ng2g->teaching_subject=='null'))? '-': $ng2g->teaching_subject).
                        '</span></label>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label marathi-label" style="font-size:10px !important;">अध्यापनाचे माध्यम <span class="english-label" style="font-size:10px !important;">(Medium)</span> &rarr; <span class="txtval">'.
                        h((empty($ng2g->medium) || ($ng2g->medium=='null'))? '-': $ng2g->medium).
                        '</span></label>
                    </div>
                </div>';


       
                


        if(!$is_minority_school){
            $html .= '<div class="row">
                    <div class="col-md-4">
                        <label class="form-label marathi-label" style="font-size:10px !important;">मूळ आरक्षण प्रवर्ग <span class="english-label" style="font-size:10px !important;">(Social Category)</span> &rarr; <span class="txtval">'.
                        h((empty($ng2g->original_category) || ($ng2g->original_category=='null'))? '-': $ng2g->original_category).
                        '</span></label>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label marathi-label" style="font-size:10px !important;">नियुक्तीचा आरक्षण प्रवर्ग <span class="english-label" style="font-size:10px !important;">(Appointment Category Subjects)</span> &rarr; <span class="txtval">'.
                        h((empty($ng2g->appointment_category) || ($ng2g->appointment_category=='null'))? '-': $ng2g->appointment_category).
                        '</span></label>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label marathi-label" style="font-size:10px !important;">समांतर आरक्षण प्रवर्ग <span class="english-label" style="font-size:10px !important;">(Horizontal Category)</span> &rarr; <span class="txtval">'.
                        h((empty($ng2g->horizontal_category) || ($ng2g->horizontal_category=='null'))? '-': $ng2g->horizontal_category).
                        '</span></label>
                    </div>
                </div>';
        } 

        $html .= '<div class="row">
                    <div class="col-md-3">
                        <label class="form-label marathi-label" style="font-size:10px !important;">पॅन क्रमांक <span class="english-label" style="font-size:10px !important;">(Salary Grade)</span> &rarr; <span class="txtval">'.
                        h((empty($ng2g->pan_number) || ($ng2g->pan_number=='null'))? '-': $ng2g->pan_number).
                        '</span></label>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label marathi-label" style="font-size:10px !important;">आधार क्रमांक <span class="english-label" style="font-size:10px !important;">(Teaching Subjects)</span> &rarr; <span class="txtval">'.
                        h((empty($ng2g->aadhar_number) || ($ng2g->aadhar_number=='null'))? '-': $ng2g->aadhar_number).
                        '</span></label>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label marathi-label" style="font-size:10px !important;">ई-मेल <span class="english-label" style="font-size:10px !important;">(Email)</span> &rarr; <span class="txtval">'.
                        h((empty($ng2g->email) || ($ng2g->email=='null'))? '-': $ng2g->email).
                        '</span></label>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label marathi-label" style="font-size:10px !important;">मोबाईल क्रमांक <span class="english-label" style="font-size:10px !important;">(Mobile)</span> &rarr; <span class="txtval">'.
                        h((empty($ng2g->mobile) || ($ng2g->mobile=='null'))? '-': $ng2g->mobile).
                        '</span></label>
                    </div>
                </div>';



        $html .= '<div class="row mt-4 mb-4">
                    <div class="col-md-12">
                        <h3 class="section-title">TET & CTET</h3>

                        <table class="table table-striped table-bordered table-hover">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">परीक्षा (Examination)</th>
                                <th scope="col">आसन क्रमांक (Seat Number)</th>
                                <th scope="col">वर्ष (Year)</th>
                                <th scope="col">पेपर (Paper)</th>
                                <th scope="col">प्रमाणपत्र (Certificate)</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">TET</th>
                                <td>'.
                                    h((empty($ng2g->tet_number) || ($ng2g->tet_number=='null'))? '-': $ng2g->tet_number)
                                .'</td>
                                <td>'.
                                    h((empty($ng2g->tet_year) || ($ng2g->tet_year=='null'))? '-': $ng2g->tet_year)
                                .'</td>
                                <td>'.
                                    h((empty($ng2g->tet_paper) || ($ng2g->tet_paper=='null'))? '-': $ng2g->tet_paper)
                                .'</td>
                                <td><a class="viewBtn" href="'.
                                    h($ng2g->tet_certificate_file).
                                    '" target="_blank">
                                    <i class="fa fa-eye"></i> View
                                </a></td>
                            </tr>
                            <tr>
                                <th scope="row">CTET</th>
                                <td>'.
                                    h((empty($ng2g->ctet_number) || ($ng2g->ctet_number=='null'))? '-': $ng2g->ctet_number)
                                .'</td>
                                <td>'.
                                    h((empty($ng2g->ctet_year) || ($ng2g->ctet_year=='null'))? '-': $ng2g->ctet_year)
                                .'</td>
                                <td>'.
                                    h((empty($ng2g->ctet_paper) || ($ng2g->ctet_paper=='null'))? '-': $ng2g->ctet_paper)
                                .'</td>
                                <td><a class="viewBtn" href="'.
                                    h($ng2g->ctet_certificate_file).
                                    '" target="_blank">
                                    <i class="fa fa-eye"></i> View
                                </a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>';      
         


        $html .= '<div class="row mb-4">
                    <h3 class="section-title">शैक्षणिक व व्यावसायिक अर्हता. <small style="font-size:10px;">संबंधित शिक्षकाची शैक्षणिक व व्यावसायिक अर्हता प्रमाणपत्रे • शासन निर्णय दिनांक 25.02.2019 नुसार.</small></h3>
                    <div class="col-md-4 mb-2">
                        <a class="viewBtn" href="'.
                            h($ng2g->hsc_file).
                            '" target="_blank">
                            <i class="fa fa-eye"></i> View HSC / 12th
                        </a>
                    </div>
                     <div class="col-md-4 mb-2">
                        <a class="viewBtn" href="'.
                            h($ng2g->graduate_file).
                            '" target="_blank">
                            <i class="fa fa-eye"></i> View Graduate Degree
                        </a>
                    </div>
                     <div class="col-md-4 mb-2">
                        <a class="viewBtn" href="'.
                            h($ng2g->post_graduate_file).
                            '" target="_blank">
                            <i class="fa fa-eye"></i> View Post Graduate Degree
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a class="viewBtn" href="'.
                            h($ng2g->ded_file).
                            '" target="_blank">
                            <i class="fa fa-eye"></i> View D.Ed / Equivalent
                        </a>
                    </div>
                     <div class="col-md-4">
                        <a class="viewBtn" href="'.
                            h($ng2g->bed_file).
                            '" target="_blank">
                            <i class="fa fa-eye"></i> View B.Ed  / Equivalent
                        </a>
                    </div>
                     <div class="col-md-4">
                        <a class="viewBtn" href="'.
                            h($ng2g->mped_file).
                            '" target="_blank">
                            <i class="fa fa-eye"></i> View M.P.Ed / Equivalent
                        </a>
                    </div>
                </div>';


        $html .= '<div class="row mb-4">
                    <div class="col-md-12">
                        <h3 class="section-title">आवश्यक कागदपत्रे</h3>
                        <table class="table table-striped table-bordered table-hover">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">विवरण</th>
                                <th scope="col">जावक क्रमांक</th>
                                <th scope="col">दिनांक</th>
                                <th scope="col">दस्तऐवज</th>
                            </tr>
                              

                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        शाळा व्यवस्थापन समितीचा ठराव. (MEPS Act 1981)
                                    </th>
                                    <td>'.
                                        h((empty($ng2g->school_committee_outward_number) || ($ng2g->school_committee_outward_number=='null'))? '-': $ng2g->school_committee_outward_number)
                                    .'</td>
                                    <td>'.
                                        h((empty($ng2g->school_committee_outward_date) || ($ng2g->school_committee_outward_date=='null'))? '-': $ng2g->school_committee_outward_date)
                                    .'</td>
                                    <td><a class="viewBtn" href="'.
                                        h($ng2g->school_committee_outward_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View
                                    </a></td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        विनाअनुदानित / अंशतः अनुदानित तत्त्वावरील मूळ संस्था नियुक्ती आदेश
                                    </th>
                                    <td>'.
                                        h((empty($ng2g->origin_sanstha_appointment_number) || ($ng2g->origin_sanstha_appointment_number=='null'))? '-': $ng2g->origin_sanstha_appointment_number)
                                    .'</td>
                                    <td>'.
                                        h((empty($ng2g->origin_sanstha_appointment_date) || ($ng2g->origin_sanstha_appointment_date=='null'))? '-': $ng2g->origin_sanstha_appointment_date)
                                    .'</td>
                                    <td><a class="viewBtn" href="'.
                                        h($ng2g->origin_sanstha_appointment_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View
                                    </a></td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        शिक्षणाधिकारी / उपसंचालक यांनी दिलेला अंशतः अनुदानित तत्त्वावरील वैयक्तिक मान्यता आदेश
                                    </th>
                                    <td>'.
                                        h((empty($ng2g->personal_recognition_number) || ($ng2g->personal_recognition_number=='null'))? '-': $ng2g->personal_recognition_number)
                                    .'</td>
                                    <td>'.
                                        h((empty($ng2g->personal_recognition_date) || ($ng2g->personal_recognition_date=='null'))? '-': $ng2g->personal_recognition_date)
                                    .'</td>
                                    <td><a class="viewBtn" href="'.
                                        h($ng2g->personal_recognition_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View
                                    </a></td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        संबंधित व्यवस्थापनाची विनाअनुदानित / अंशतः अनुदानित सेवाज्येष्ठता सूची
                                    </th>
                                    <td>'.
                                        h((empty($ng2g->service_seniority_list_number) || ($ng2g->service_seniority_list_number=='null'))? '-': $ng2g->service_seniority_list_number)
                                    .'</td>
                                    <td>'.
                                        h((empty($ng2g->service_seniority_list_date) || ($ng2g->service_seniority_list_date=='null'))? '-': $ng2g->service_seniority_list_date)
                                    .'</td>
                                    <td><a class="viewBtn" href="'.
                                        h($ng2g->service_seniority_list_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View
                                    </a></td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        बदलीपूर्वी बिंदुनामावलीनुसार रिक्त पदाचा विषय व आरक्षण विचारात घेण्यात आल्याचे प्रमाणपत्र
                                    </th>
                                    <td>'.
                                        h((empty($ng2g->vacant_post_merit_list_number) || ($ng2g->vacant_post_merit_list_number=='null'))? '-': $ng2g->vacant_post_merit_list_number)
                                    .'</td>
                                    <td>'.
                                        h((empty($ng2g->vacant_post_merit_list_date) || ($ng2g->vacant_post_merit_list_date=='null'))? '-': $ng2g->vacant_post_merit_list_date)
                                    .'</td>
                                    <td><a class="viewBtn" href="'.
                                        h($ng2g->vacant_post_merit_list_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View
                                    </a></td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        विनाअनुदानित / अंशतः अनुदानित शाळेत 5 वर्षे सेवा केल्याचे (मुख्याध्यापक) प्रमाणपत्र
                                    </th>
                                    <td>'.
                                        h((empty($ng2g->five_years_hm_certificate_outward_number) || ($ng2g->five_years_hm_certificate_outward_number=='null'))? '-': $ng2g->five_years_hm_certificate_outward_number)
                                    .'</td>
                                    <td>'.
                                        h((empty($ng2g->five_years_hm_certificate_date) || ($ng2g->five_years_hm_certificate_date=='null'))? '-': $ng2g->five_years_hm_certificate_date)
                                    .'</td>
                                    <td><a class="viewBtn" href="'.
                                        h($ng2g->five_years_hm_certificate_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View
                                    </a></td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        अनुदानित रिक्त पदाचा तपशील व कागदपत्रे
                                    </th>
                                    <td>'.
                                        h((empty($ng2g->vacant_post_causing_transfer_outward_number) || ($ng2g->vacant_post_causing_transfer_outward_number=='null'))? '-': $ng2g->vacant_post_causing_transfer_outward_number)
                                    .'</td>
                                    <td>'.
                                        h((empty($ng2g->vacant_post_causing_transfer_date) || ($ng2g->vacant_post_causing_transfer_date=='null'))? '-': $ng2g->vacant_post_causing_transfer_date)
                                    .'</td>
                                    <td><a class="viewBtn" href="'.
                                        h($ng2g->vacant_post_causing_transfer_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View
                                    </a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>';      
         
        $html .= '<div class="row mb-4">
                    <div class="col-md-12">
                        <h3 class="section-title">शासन निर्णय दि. 06.02.2012 व 10.06.2022 नुसार मान्यता असल्याबाबतचा शिक्षणाधिकारी / उपसंचालक यांचा स्पष्ट अभिप्राय</h3>
  
                        <table class="table table-striped table-bordered table-hover">                            
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        बिंदुनामावली तपासणी पत्र (मावकद्वारे)
                                    </th>
                                    <td>दिनांक:- '.
                                        h((empty($ng2g->mavak_checklist_date) || ($ng2g->mavak_checklist_date=='null'))? '-': $ng2g->mavak_checklist_date)
                                    .'</td>                                  
                                    <td><a class="viewBtn" href="'.
                                        h($ng2g->mavak_checklist_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View
                                    </a></td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        संबंधित शिक्षकांचे विनाअनुदानित भरतीचे ना हरकत प्रमाणपत्र
                                    </th>
                                    <td>जावक क्रमांक:- '.
                                        h((empty($ng2g->recruitment_noc_outward_number) || ($ng2g->recruitment_noc_outward_number=='null'))? '-': $ng2g->recruitment_noc_outward_number)
                                    .', दिनांक:- '.
                                        h((empty($ng2g->recruitment_noc_outward_date) || ($ng2g->recruitment_noc_outward_date=='null'))? '-': $ng2g->recruitment_noc_outward_date)
                                    .'</td>                                  
                                    <td><a class="viewBtn" href="'.
                                        h($ng2g->recruitment_noc_outward_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View
                                    </a></td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        वर्तमानपत्रातील जाहिरात (मूळप्रत)
                                    </th>
                                    <td>वर्तमानपत्राचे नाव:- '.
                                        h((empty($ng2g->advrt_newspaper_name) || ($ng2g->advrt_newspaper_name=='null'))? '-': $ng2g->advrt_newspaper_name)
                                        .', दिनांक:- '.
                                        h((empty($ng2g->advrt_newspaper_date) || ($ng2g->advrt_newspaper_date=='null'))? '-': $ng2g->advrt_newspaper_date)
                                    .'</td>                                  
                                    <td><a class="viewBtn" href="'.
                                        h($ng2g->advrt_newspaper_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View
                                    </a></td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        मुलाखत
                                    </th>
                                    <td>दिनांक:- '.
                                        h((empty($ng2g->interview_date) || ($ng2g->interview_date=='null'))? '-': $ng2g->interview_date)
                                    .'</td>                                  
                                    <td><a class="viewBtn" href="'.
                                        h($ng2g->interview_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View
                                    </a></td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        रुजू अहवाल विनाअनुदानित तत्त्वावरील
                                    </th>
                                    <td>दिनांक:- '.
                                        h((empty($ng2g->report_ng_principle_date) || ($ng2g->report_ng_principle_date=='null'))? '-': $ng2g->report_ng_principle_date)
                                    .'</td>                                  
                                    <td><a class="viewBtn" href="'.
                                        h($ng2g->report_ng_principle_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View
                                    </a></td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        रुजू अहवाल अंशतः अनुदानित/अनुदानित तत्त्वावरील
                                    </th>
                                    <td>दिनांक:- '.
                                        h((empty($ng2g->report_g_principle_date) || ($ng2g->report_g_principle_date=='null'))? '-': $ng2g->report_g_principle_date)
                                    .'</td>                                  
                                    <td><a class="viewBtn" href="'.
                                        h($ng2g->report_g_principle_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View
                                    </a></td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        बदली होणारा शिक्षक स्वयंअर्थसहाय्यित तत्त्वावर कार्यरत नव्हता याबाबत प्रमाणपत्र 
                                    </th>
                                    <td>जावक क्रमांक:- '.
                                        h((empty($ng2g->self_financing_certificate_outward_number) || ($ng2g->self_financing_certificate_outward_number=='null'))? '-': $ng2g->self_financing_certificate_outward_number)
                                    .', दिनांक:- '.
                                        h((empty($ng2g->self_financing_certificate_date) || ($ng2g->self_financing_certificate_date=='null'))? '-': $ng2g->self_financing_certificate_date)
                                    .'</td>                                  
                                    <td><a class="viewBtn" href="'.
                                        h($ng2g->self_financing_certificate_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View
                                    </a></td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        बदली असमान पदावर झालेली नाही याबाबत प्रमाणपत्र 
                                    </th>
                                    <td>जावक क्रमांक:- '.
                                        h((empty($ng2g->transfer_not_higher_post_outward_number) || ($ng2g->transfer_not_higher_post_outward_number=='null'))? '-': $ng2g->transfer_not_higher_post_outward_number)
                                    .', दिनांक:- '.
                                        h((empty($ng2g->transfer_not_higher_post_date) || ($ng2g->transfer_not_higher_post_date=='null'))? '-': $ng2g->transfer_not_higher_post_date)
                                    .'</td>                                  
                                    <td><a class="viewBtn" href="'.
                                        h($ng2g->transfer_not_higher_post_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View
                                    </a></td>
                                </tr>
                                <tr>
                                    <th scope="row" colspan="2">
                                        महाराष्ट्र खासगी शाळा कर्मचारी (सेवा अटी) नियमावली 1981 मधील नियम 41(1)(3) नुसार वेतन अनुदानाबाबत हमीपत्र                                         
                                    </th>                                
                                    <td><a class="viewBtn" href="'.
                                        h($ng2g->salary_subsidy_guarantee_letter_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View
                                    </a></td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>';   
        
                
        
        $html .= '<div class="row mb-4">
                    <h3 class="section-title">आयकर विवरणपत्र</h3>
                    <div class="col-md-4">
                        <a class="viewBtn" href="'.
                            h($ng2g->itr1_file).
                            '" target="_blank">
                            <i class="fa fa-eye"></i> View Form-16. Year 1
                        </a>
                    </div>
                     <div class="col-md-4">
                        <a class="viewBtn" href="'.
                            h($ng2g->itr2_file).
                            '" target="_blank">
                            <i class="fa fa-eye"></i> View Form-16. Year 2
                        </a>
                    </div>
                     <div class="col-md-4">
                        <a class="viewBtn" href="'.
                            h($ng2g->itr3_file).
                            '" target="_blank">
                            <i class="fa fa-eye"></i> View Form-16. Year 3
                        </a>
                    </div>
                </div>';

        $html .= '<div class="row mb-4">
                    <h3 class="section-title">वेतन बँक स्टेटमेंट ( मागील ५ वर्षाचे)</h3>
                    <div class="col-md-10">दिनांक:- '. 
                    h((empty($ng2g->bank_statement_from_date) || ($ng2g->bank_statement_from_date=='null'))? '-': $ng2g->bank_statement_from_date)

                    .' to '.
                    h((empty($ng2g->bank_statement_to_date) || ($ng2g->bank_statement_to_date=='null'))? '-': $ng2g->bank_statement_to_date)

                    .'
                    </div>
                     <div class="col-md-2">
                        <a class="viewBtn" href="'.
                            h($ng2g->bank_statement_file).
                            '" target="_blank">
                            <i class="fa fa-eye"></i> View
                        </a>
                    </div>
                    </div>
                </div>';



        if(($ng2g->is_court_order == 1) && (!empty($ng2g->court_order_petition_number))){  
            if (!empty($ng2g->court_order_file)) {
                 $ng2g->court_order_file = $storage->signedUrl(
                    $ng2g->court_order_file
                );
            }     
            $html .= '<div class="row mb-2">
                        <h3 class="section-title">या प्रकरणासंदर्भात कोणताही न्यायालयीन आदेश निर्गमित झाला आहे का? - <i style="color:purple;">होय</i></h3> 
                        
                        <div class="col-md-4">
                            <label class="form-label marathi-label">याचिका क्रमांक <span class="english-label">(Outward No.)</span> &rarr; <span class="txtval">'.
                            h($ng2g->court_order_petition_number)
                            .'</span></label> 
                        </div>  
                         <div class="col-md-4">
                            <label class="form-label marathi-label">दिनांक <span class="english-label">(Date)</span> &rarr; <span class="txtval">'.
                            h($ng2g->court_order_date)
                            .'</span></label> 
                        </div>  
                        <div class="col-md-4">
                             <a class="viewBtn" href="'.h($ng2g->court_order_file).'" target="_blank">
                                <i class="fa fa-eye"></i> View
                            </a>
                        </div>  
                    </div>';  
            
        }else{
            $html .= '<div class="row mb-2">
                        <h3 class="section-title">या प्रकरणासंदर्भात कोणताही न्यायालयीन आदेश निर्गमित झाला आहे का? - <i style="color:purple;">नाही</i></h3> 
                        
                        
                    </div>';
        }

       

        $html .= '<hr/><div class="row mb-4">
                    <div class="col-md-6">विनाअनुदानित तत्त्वावरील रुजू दिनांकापासून इतर शासकीय लाभ घेतले नाहीत याबाबत प्रमाणपत्र
                    </div>
                     <div class="col-md-4">विवरण:- '.h($ng2g->no_benefits_certificate_details).
                    '</div>
                    
                     <div class="col-md-2">
                        <a class="viewBtn" href="'.
                            h($ng2g->no_benefits_certificate_file).
                            '" target="_blank">
                            <i class="fa fa-eye"></i> View
                        </a>
                    </div>
                    </div>
                </div>';

        $html .= '<div class="row mb-4">
                    <div class="col-md-10">NPS योजना बंधनकारक असल्याबाबत हमीपत्र
                    </div>
                     
                    
                     <div class="col-md-2">
                        <a class="viewBtn" href="'.
                            h($ng2g->nps_scheme).
                            '" target="_blank">
                            <i class="fa fa-eye"></i> View
                        </a>
                    </div>
                    </div>
                </div>';


       
        $html .= '<div class="row mb-4">
                    <div class="col-md-10">प्रस्तुत प्रस्तावातील कागदपत्रे खरी असल्याबाबत संस्थेचे हमीपत्र (प्रपत्र-2)
                    </div>                  
                     <div class="col-md-2">
                        <a class="viewBtn" href="'.
                            h($ng2g->institution_guarantee_file).
                            '" target="_blank">
                            <i class="fa fa-eye"></i> View
                        </a>
                    </div>
                    </div>
                </div>';

        $html .= '<div class="row mb-4">
                    <div class="col-md-10">संस्थेमध्ये वाद नसल्याबाबत हमीपत्र
                    </div>                  
                     <div class="col-md-2">
                        <a class="viewBtn" href="'.
                            h($ng2g->institution_no_disbute_file).
                            '" target="_blank">
                            <i class="fa fa-eye"></i> View
                        </a>
                    </div>
                    </div>
                </div>';

        $html .= '<div class="row mb-4">
                    <div class="col-md-10">इतर (जर काही असेल तर)
                    </div>                  
                     <div class="col-md-2">
                        <a class="viewBtn" href="'.
                            h($ng2g->other_documents_file).
                            '" target="_blank">
                            <i class="fa fa-eye"></i> View
                        </a>
                    </div>
                    </div>
                </div>';

                


                
        //echo $html;
        //exit;
       /* echo "<pre>";
        print_r($ng2g);
        exit;*/

            
               
        $response = [
                'success' => true,
                'status' => 200,
                'timestamp' => time(),
                'data' =>$ng2g,
                'html' => $html
            ];
          
         return $this->response
            ->withType('application/json')
            ->withStatus(200)
            ->withStringBody(json_encode($response));   

    }


     public function ng2gVerifyReturnedApplicationForm($app_id)
    {
        
        $this->Authorization->skipAuthorization();
       // $this->viewBuilder()->setLayout('state');
    
        $ng2gApplicationReturnsTable = TableRegistry::getTableLocator()->get('Ng2gApplicationReturns');
      

        $ng2gReturnsResult = $ng2gApplicationReturnsTable->find()               
                ->where(['ng2g_id' => $app_id])
                ->all();

        
       
        
        /*echo "<pre>";
        print_r($ng2g);
        exit;*/
        if(count($ng2gReturnsResult)<=0){
            $response = [
                'success' => false,
                'status' => 400,
                'timestamp' => time(),
                'message' => "No data found"
            ];
          
            return $this->response
                ->withType('application/json')
                ->withStatus(400)
                ->withStringBody(json_encode($response));   
        }

        $html = '<form id="verifyReturnedApplicationForm" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="application_id" value="'. $app_id .'"> 
                    <input type="hidden" name="ng2g_id" value="'. $app_id .'"><style>    
                        .card{
                            border:none;
                            border-radius:12px;
                        }


                        table td{
                            vertical-align:middle;
                            font-size:12px !important;
                        }

                        .table thead{
                            background:#0d6efd;
                            color:white;
                        }

                        textarea{
                            resize:none;
                        }

                        .required{
                            color:red;
                        }

                        .field-name{
                            font-weight:500;
                        }
                        label{
                            font-size:12px !important;
                        }
                        input{
                         padding:3px !important;
                        }
                        .alert-warning{
                            font-size:10px !important; 
                        }
                    
                    </style>';

        $storage = new EsdlStorageService();
        $finalDataSet =array();
        foreach($ng2gReturnsResult as $key => $ng2g){
           
            
            if ($ng2g->status=='forwarded') {
                $value = "";
                if (!empty($ng2g->sanstha_fwd_info)) {                    
                    if (str_ends_with(strtolower($ng2g->sanstha_fwd_info), '.pdf')) {
                        $ftype = "file";
                       $value = $storage->signedUrl($ng2g->sanstha_fwd_info);
                    }else if (str_contains($ng2g->sanstha_fwd_info, '_date')) {
                        $ftype = "date";
                        $value = date('d F Y', $timestamp); $ng2g->sanstha_fwd_info;
                    }else{
                        $ftype = "text";
                        $value = $ng2g->sanstha_fwd_info;
                    }

                    //$ng2gReturnsResult[$key][$ng2g->{$ng2g->rtn_field_name}]  = $value;
                    //$ng2gReturnsResult->{$key}->$ng2g['sanstha_fwd_info']  = $value;
                    $finalDataSet['fwd'][$key]['id'] = $ng2g->id;
                    $finalDataSet['fwd'][$key]['type'] = $ftype;
                    $finalDataSet['fwd'][$key]['field'] = $ng2g->rtn_field_name;
                    $finalDataSet['fwd'][$key]['reason'] = $ng2g->rtn_field_reason;    
                    $finalDataSet['fwd'][$key]['reply'] = $value;
                                    
                }
            }else if($ng2g->status=='returned') {
                $finalDataSet['rtn'][$key]['id'] = $ng2g->id;
                $finalDataSet['rtn'][$key]['field'] = $ng2g->rtn_field_name;
                $finalDataSet['rtn'][$key]['reason'] = $ng2g->rtn_field_reason;  
                
            }
        }
         //echo "<pre>";//.$key."=====".$ng2g;
            //print_r($finalDataSet);

        //exit;
        //$value['id'];
       
        
        if(isset($finalDataSet['fwd']) && count($finalDataSet['fwd'])>0){
            $html .= '<div class="card shadow">
                        <div class="card-header group-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="section-title">
                                    👤 त्रुटी दुरुस्त करून सादर केलेली कागदपत्रे / माहिती
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="alert alert-warning">
                                <strong>Instructions :</strong>
                                Please review the information and documents resubmitted by the institution after correcting the previously identified deficiencies. Verify that all observations have been satisfactorily addressed before taking further action.
                                <hr/>
                                <strong>सूचना :</strong>
                                संस्थेकडून त्रुटी दुरुस्त करून पुनः सादर केलेली माहिती व कागदपत्रे काळजीपूर्वक तपासून, पूर्वी नमूद केलेल्या त्रुटींची पूर्तता झाल्याची खात्री करावी. 
                                आवश्यक असल्यास पुढील कार्यवाहीसाठी अर्ज मंजूर/पुढे पाठवावा अथवा पुन्हा दुरुस्तीसाठी परत पाठवावा.                            
                            </div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>
                                        पडताळणी
                                    </th>

                                    <th>
                                        माहिती / कागदपत्र
                                    </th>

                                    <th>
                                        अधिकाऱ्यांची निरीक्षणे / शेरा
                                    </th>

                                    <th>
                                        संस्थेचा खुलासा / प्रतिसाद
                                    </th>
                                </tr>
                                </thead>
                                <tbody>';
            
            foreach($finalDataSet['fwd'] as $fwd){
                
                if($fwd['type'] == 'file'){
                    $html .=  $this->reviewFile($fwd);
                }else{
                    $html .=  $this->reviewText($fwd);                    
                }
            }
            $html .= '</tbody></table></div></div>';
        }

        if(isset($finalDataSet['rtn']) && count($finalDataSet['rtn'])>0){
            $html .= '<div class="card shadow">
                        <div class="card-header group-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="section-title">
                                    👤 त्रुटींची पूर्तता प्रलंबित
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>
                                        पडताळणी
                                    </th>

                                    <th>
                                        माहिती / कागदपत्र
                                    </th>

                                    <th>
                                        अधिकाऱ्यांची निरीक्षणे / शेरा
                                    </th>

                                    <th>
                                        संस्थेचा खुलासा / प्रतिसाद
                                    </th>
                                </tr>
                                </thead>
                                <tbody>';
            
          
            foreach($finalDataSet['rtn'] as $rtn){
                    $html .=  $this->reviewPendingField($rtn);
            }
            $html .= '</tbody></table></div></div>';
        }
       

       

       
           /* $courtDetails="";
            if(($ng2g->is_court_order == 1) && (!empty($ng2g->court_order_petition_number))){  

                if (!empty($ng2g->court_order_file)) {
                    $ng2g->court_order_file = $storage->signedUrl(
                        $ng2g->court_order_file
                    );
                }     
                
                
            }*/

            
            $html .= '</div>
                <div class="card-footer text-end">
                    <div class="row g-4 mt-2">
                        <!-- Return for Correction -->
                        <div class="col-lg-3">
                            <div class="card border-warning bg-warning shadow-sm h-100">
                                <div class="card-header bg-warning text-dark fw-bold">
                                    <i class="fa fa-undo me-2"></i> त्रुटी पूर्ततेसाठी परत पाठवा
                                </div>

                                <div class="card-body">
                                    <p class="small text-muted mb-3">
                                        अर्जामध्ये त्रुटी अथवा अपूर्ण माहिती असल्यास संबंधित कारण नमूद करून अर्ज दुरुस्तीसाठी परत पाठवा.
                                    </p>

                                    <label class="form-label fw-semibold">
                                        अधिकाऱ्यांचा शेरा 
                                    </label>

                                    <textarea
                                        class="form-control"
                                        name="return_remark"
                                        rows="6"
                                        placeholder="त्रुटी / सूचना नमूद करा..."
                                        ></textarea>
                                </div>

                                <div class="card-footer bg-white">                               
                                    <button type="button" onclick="submitVerifyReturnedApplication()" class="btn btn-warning w-100 fw-bold">
                                        <i class="fa fa-reply me-2"></i>
                                        त्रुटी पूर्ततेसाठी परत पाठवा
                                    </button>
                                </div>
                            </div>
                        </div>


                        <!-- Approve -->
                        <div class="col-lg-3">
                            <div class="card border-success bg-success shadow-sm h-100 text-white">

                                <div class="card-header bg-success text-white fw-bold">
                                    <i class="fa fa-check-circle me-2"></i> मंजुरी द्या
                                </div>

                                <div class="card-body d-flex flex-column">

                                    <p class="small">
                                        अर्जातील माहिती व कागदपत्रे नियमांनुसार योग्य असल्यास अर्जास मंजुरी देऊन पुढील स्तरावर पाठवा.
                                    </p>

                                     <div class="mb-3">
                                        <label class="form-label fw-bold text-white">
                                            शेरा / Remark
                                        </label>

                                        <textarea class="form-control"
                                                name="app_remark"
                                                id="app_remark"
                                                rows="5"
                                                placeholder="कृपया शेरा नमूद करा..."
                                                ></textarea>
                                    </div>

                                    <!-- Supporting File -->
                                    <div class="mb-3">
                                        <label class="form-label fw-bold text-white">
                                            सहाय्यक कागदपत्र अपलोड करा
                                        </label>

                                        <input type="file"
                                            name="app_doc"
                                            id="app_doc"
                                            class="form-control"
                                            name="supporting_document"
                                            accept=".pdf">

                                        <small>
                                            Allowed: PDF Only
                                        </small>
                                    </div>

                                </div>

                                <div class="card-footer bg-white">
                                    <button type="button" onclick="submitVerifyReturnedApproveApplication(1)" class="btn btn-success w-100 fw-bold">
                                        <i class="fa fa-check me-2"></i>
                                        मंजुरी द्या
                                    </button>
                                </div>

                            </div>
                        </div>

                        <!-- Approve with Condition -->
                        <div class="col-lg-3">
                            <div class="card border-info bg-info shadow-sm h-100 text-white">

                                <div class="card-header bg-info text-white fw-bold">
                                    <i class="fa fa-check-circle me-2"></i> सशर्त मंजुरी द्या
                                </div>

                                <div class="card-body d-flex flex-column">

                                    <p class="small">
                                        अर्जातील माहिती व कागदपत्रे नियमांनुसार योग्य असल्यास अर्जास मंजुरी देऊन पुढील स्तरावर पाठवा.
                                    </p>

                                     <div class="mb-3">
                                        <label class="form-label fw-bold text-white">
                                            शेरा / Remark
                                        </label>

                                        <textarea class="form-control"
                                                name="app_remark_1"
                                                id="app_remark_1"
                                                rows="5"
                                                placeholder="कृपया शेरा नमूद करा..."
                                                ></textarea>
                                    </div>

                                    <!-- Supporting File -->
                                    <div class="mb-3">
                                        <label class="form-label fw-bold text-white">
                                            सहाय्यक कागदपत्र अपलोड करा
                                        </label>

                                        <input type="file"
                                            name="app_doc_1"
                                            id="app_doc_1"
                                            class="form-control"
                                            name="supporting_document"
                                            accept=".pdf">

                                        <small>
                                            Allowed: PDF Only
                                        </small>
                                    </div>

                                </div>

                                <div class="card-footer bg-white">
                                    <button type="button" onclick="submitVerifyReturnedApproveApplication(2)" class="btn btn-info w-100 fw-bold">
                                        <i class="fa fa-check me-2"></i>
                                        सशर्त मंजुरी द्या
                                    </button>
                                </div>

                            </div>
                        </div>


                        <!-- Reject -->
                        <div class="col-lg-3">
                            <div class="card border-danger bg-danger shadow-sm h-100 text-white">

                                <div class="card-header bg-danger text-white fw-bold">
                                    <i class="fa fa-times-circle me-2"></i> नामंजूर करा
                                </div>

                                <div class="card-body d-flex flex-column">

                                    <p class="small">
                                        अर्ज नियमांनुसार अपात्र असल्यास किंवा आवश्यक अटी पूर्ण न झाल्यास अर्ज नामंजूर करा.
                                    </p>                                

                                    <div class="mb-3">
                                        <label class="form-label fw-bold text-white">
                                            शेरा / Remark
                                        </label>

                                        <textarea class="form-control"
                                                name="reject_remark"
                                                id="reject_remark"
                                                rows="5"
                                                placeholder="कृपया शेरा नमूद करा..."
                                                ></textarea>
                                    </div>

                                    <!-- Supporting File -->
                                    <div class="mb-3">
                                        <label class="form-label fw-bold text-white">
                                            सहाय्यक कागदपत्र अपलोड करा
                                        </label>

                                        <input type="file"
                                            name="reject_doc"
                                            id="reject_doc"
                                            class="form-control"
                                            name="supporting_document"
                                            accept=".pdf">

                                        <small>
                                            Allowed: PDF Only
                                        </small>
                                    </div>

                                </div>

                                <div class="card-footer bg-white">
                                    <button type="button" onclick="submitVerifyReturnedRejectApplication()"  class="btn btn-danger w-100 fw-bold">
                                        <i class="fa fa-ban me-2"></i>
                                        नामंजूर करा
                                    </button>
                                </div>

                            </div>
                        </div>

                    </div>
                    

                </div>

            </div>

        </div></form>';
        
/*
  if(($staff->status=="dy_director_primary_desk_forwarded") || ($staff->status=="dy_director_secondary_desk_forwarded") || ($staff->status=="dy_director_higher_secondary_desk_forwarded")) {
                                        echo "<a href='#' style='text-decoration:none;color:#f107ff;' class='verifyReturnedApplication-open-transfer' data-id='".$staff->id."'>
                                                <i class='fa-solid fa-refresh'></i>  त्रुटी दुरुस्ती अहवाल
                                            </a><br/>";
                                    }else if (in_array($staff->status, $pendingStatuses)) {

                                        echo "<a href='#' style='text-decoration:none;color:green;' class='approveApplication-open-transfer' data-staff='". json_encode($staff, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP)."' data-id='".$staff->id."'>
                                            <i class='fa-solid fa-arrow-trend-up'></i>  मंजुरी द्या
                                        </button><br/>";

                                        echo "<a href='#' style='text-decoration:none;color:#c98813;' class='returnApplication-open-transfer' data-id='".$staff->id."'>
                                                <i class='fa-solid fa-reply-all'></i>  त्रुटी पुर्तेतसाठी परत पाठवा
                                            </a><br/>";
                                   
                                        echo "<a href='#' style='text-decoration:none;color:red;' class='rejectApplication-open-transfer' data-staff='". json_encode($staff, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ."' data-id='".$staff->id."'>
                                            <i class='fa-solid fa-arrow-trend-down'></i>  नामंजूर करा
                                        </a>";
                                    }

        */


       

                

         
        


            /* echo "<pre>";
        print_r($ng2g);
        exit;*/

            
               
        $response = [
                'success' => true,
                'status' => 200,
                'timestamp' => time(),
                'data' =>$ng2g,
                'html' => $html
            ];
          
         return $this->response
            ->withType('application/json')
            ->withStatus(200)
            ->withStringBody(json_encode($response));      
       

        

    }

    public function ng2gReturnApplicationForm($app_id)
    {
        
        $this->Authorization->skipAuthorization();
       // $this->viewBuilder()->setLayout('state');
    
        $staffTransfersTable = TableRegistry::getTableLocator()->get('StaffTransfers');
      

        $ng2g = $staffTransfersTable->find()               
                ->where(['id' => $app_id])
                ->first();

        /*
        echo "<pre>";
        print_r($ng2g);
        exit;
        */

        if(!is_object($ng2g)){
            $response = [
                'success' => false,
                'status' => 400,
                'timestamp' => time(),
                'message' => "No data found"
            ];
          
            return $this->response
                ->withType('application/json')
                ->withStatus(400)
                ->withStringBody(json_encode($response));   
        }
        
        $storage = new EsdlStorageService();

        if (!empty($ng2g->hsc_file)) {
                $ng2g->hsc_file = $storage->signedUrl($ng2g->hsc_file);
        }
        if (!empty($ng2g->graduate_file)) {
                $ng2g->graduate_file = $storage->signedUrl($ng2g->graduate_file);
        }
        if (!empty($ng2g->post_graduate_file)) {
                $ng2g->post_graduate_file = $storage->signedUrl($ng2g->post_graduate_file);
        }
        if (!empty($ng2g->ded_file)) {
                $ng2g->ded_file = $storage->signedUrl($ng2g->ded_file);
        }
        if (!empty($ng2g->bed_file)) {
                $ng2g->bed_file = $storage->signedUrl($ng2g->bed_file);
        }
        if (!empty($ng2g->mped_file)) {
                $ng2g->mped_file = $storage->signedUrl($ng2g->mped_file);
        }
        if (!empty($ng2g->tet_certificate_file)) {
                $ng2g->tet_certificate_file = $storage->signedUrl($ng2g->tet_certificate_file);
        }

        if (!empty($ng2g->ctet_certificate_file)) {
                $ng2g->ctet_certificate_file = $storage->signedUrl($ng2g->ctet_certificate_file);
        }

        if (!empty($ng2g->school_committee_outward_file)) {
                $ng2g->school_committee_outward_file = $storage->signedUrl($ng2g->school_committee_outward_file);
        }
        if (!empty($ng2g->origin_sanstha_appointment_file)) {
                $ng2g->origin_sanstha_appointment_file = $storage->signedUrl($ng2g->origin_sanstha_appointment_file);
        }
        if (!empty($ng2g->personal_recognition_file)) {
                $ng2g->personal_recognition_file = $storage->signedUrl($ng2g->personal_recognition_file);
        }
        if (!empty($ng2g->service_seniority_list_file)) {
                $ng2g->service_seniority_list_file = $storage->signedUrl($ng2g->service_seniority_list_file);
        }
        if (!empty($ng2g->vacant_post_merit_list_file)) {
                $ng2g->vacant_post_merit_list_file = $storage->signedUrl($ng2g->vacant_post_merit_list_file);
        }
        if (!empty($ng2g->five_years_hm_certificate_file)) {
                $ng2g->five_years_hm_certificate_file = $storage->signedUrl($ng2g->five_years_hm_certificate_file);
        }
        if (!empty($ng2g->vacant_post_causing_transfer_file)) {
                $ng2g->vacant_post_causing_transfer_file = $storage->signedUrl($ng2g->vacant_post_causing_transfer_file);
        }
        if (!empty($ng2g->mavak_checklist_file)) {
                $ng2g->mavak_checklist_file = $storage->signedUrl($ng2g->mavak_checklist_file);
        }
        if (!empty($ng2g->recruitment_noc_outward_file)) {
                $ng2g->recruitment_noc_outward_file = $storage->signedUrl($ng2g->recruitment_noc_outward_file);
        }

        
        if (!empty($ng2g->advrt_newspaper_file)) {
                $ng2g->advrt_newspaper_file = $storage->signedUrl($ng2g->advrt_newspaper_file);
        }
        
        if (!empty($ng2g->interview_file)) {
                $ng2g->interview_file = $storage->signedUrl($ng2g->interview_file);
        }
        
        if (!empty($ng2g->school_permission_order_file)) {
                $ng2g->school_permission_order_file = $storage->signedUrl($ng2g->school_permission_order_file);
        }
        
        
        if (!empty($ng2g->school_at_transfer_file)) {
                $ng2g->school_at_transfer_file = $storage->signedUrl($ng2g->school_at_transfer_file);
        }
        
        if (!empty($ng2g->outward_number_match_certificate_file)) {
                $ng2g->outward_number_match_certificate_file = $storage->signedUrl($ng2g->outward_number_match_certificate_file);
        }
        
        
        if (!empty($ng2g->report_ng_principle_file)) {
                $ng2g->report_ng_principle_file = $storage->signedUrl($ng2g->report_ng_principle_file);
        }
        
        if (!empty($ng2g->report_g_principle_file)) {
                $ng2g->report_g_principle_file = $storage->signedUrl($ng2g->report_g_principle_file);
        }
        
        if (!empty($ng2g->self_financing_certificate_file)) {
                $ng2g->self_financing_certificate_file = $storage->signedUrl($ng2g->self_financing_certificate_file);
        }
        
        if (!empty($ng2g->salary_subsidy_guarantee_letter_file)) {
                $ng2g->salary_subsidy_guarantee_letter_file = $storage->signedUrl($ng2g->salary_subsidy_guarantee_letter_file);
        }

        if (!empty($ng2g->itr1_file)) {
                $ng2g->itr1_file = $storage->signedUrl($ng2g->itr1_file);
        }
        
        if (!empty($ng2g->itr2_file)) {
                $ng2g->itr2_file = $storage->signedUrl($ng2g->itr2_file);
        }
        
        if (!empty($ng2g->itr3_file)) {
                $ng2g->itr3_file = $storage->signedUrl($ng2g->itr3_file);
        }
        
        if (!empty($ng2g->bank_statement_file)) {
                $ng2g->bank_statement_file = $storage->signedUrl($ng2g->bank_statement_file);
        }
        if (!empty($ng2g->no_benefits_certificate_file)) {
                $ng2g->no_benefits_certificate_file = $storage->signedUrl($ng2g->no_benefits_certificate_file);
        }

        if (!empty($ng2g->nps_scheme)) {
                $ng2g->nps_scheme = $storage->signedUrl($ng2g->nps_scheme);
        }

        if (!empty($ng2g->institution_guarantee_file)) {
                $ng2g->institution_guarantee_file = $storage->signedUrl($ng2g->institution_guarantee_file);
        }

        if (!empty($ng2g->institution_no_disbute_file)) {
                $ng2g->institution_no_disbute_file = $storage->signedUrl($ng2g->institution_no_disbute_file);
        }
        
        if (!empty($ng2g->other_documents_file)) {
                $ng2g->other_documents_file = $storage->signedUrl($ng2g->other_documents_file);
        }

        $html = '<form id="returnApplicationForm" method="post" enctype="multipart/form-data"><input type="hidden" name="application_id" value="'. $ng2g->id .'"><div class="row mb-2">        
                    <div class="col-md-3">
                        <label for="institutionCode" class="form-label marathi-label" style="font-size:10px !important;">संस्था कोड <span class="english-label" style="font-size:10px !important;">(Institution Code)</span> &rarr; <span class="txtval">'.
                        h($ng2g->institution_code).
                        '</span></label>                            
                    </div>
                    <div class="col-md-9">                            
                        <label for="institutionName" class="form-label marathi-label" style="font-size:10px !important;">संस्थेचे नाव <span class="english-label" style="font-size:10px !important;">(Institution Name)</span> &rarr; <span class="txtval">'.
                        h($ng2g->institution_name).
                        '</span></label> 
                    </div>
                </div>';
        $html .= '<div class="row mb-2">
                        <div class="col-md-3">
                            <label for="udiseNumber" class="form-label marathi-label" style="font-size:10px !important;">UDISE क्रमांक <span class="english-label" style="font-size:10px !important;">(UDISE Code)</span> &rarr; <span class="txtval">'.
                            h($ng2g->udise_number).
                            '</span></label> 
                        </div>
                    
                   
                        <div class="col-md-9">
                            <label for="schoolName" class="form-label marathi-label" style="font-size:10px !important;">शाळेचे नाव <span class="english-label" style="font-size:10px !important;">(School Name)</span> &rarr; <span class="txtval">'.
                            h($ng2g->school_name)
                            .'</span></label> 
                        </div>                  
                        
                        <!--
                        <div class="col-md-12">
                            <label for="schoolLocation" class="form-label marathi-label" style="font-size:10px !important;">शाळेचे ठिकाण <span class="english-label" style="font-size:10px !important;">(School Location)</span> &rarr; <span class="txtval"></span></label> 
                        </div>-->
                    </div>';



        $html .= '<div class="row">
                        <div class="col-md-4">
                            <label class="form-label marathi-label" style="font-size:10px !important;">कर्मचाऱ्याचे नाव<span class="english-label" style="font-size:10px !important;">(Teacher Name)</span>&rarr;<span class="txtval">'.
                            h($ng2g->employee_name).
                            '</span></label>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label marathi-label" style="font-size:10px !important;">पदनाम<span class="english-label" style="font-size:10px !important;">(Designation)</span>&rarr;<span class="txtval">'.
                            h($ng2g->designation).
                            '</span></label>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label marathi-label" style="font-size:10px !important;">अनुदान प्रकार<span class="english-label" style="font-size:10px !important;">(Aid  Type)</span>&rarr;<span class="txtval">'.
                            h($ng2g->aid_name)
                            .'</span></label>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label marathi-label" style="font-size:10px !important;">कर्मचारी प्रकार<span class="english-label" style="font-size:10px !important;">(Staff Type)</span>&rarr;<span class="txtval">'.
                            h($ng2g->staff_type_name)
                            .'</span></label>
                        </div>
                    </div>';
       

                    

        $html .= '<div class="row">
                    <div class="col-md-4">
                        <label class="form-label marathi-label" style="font-size:10px !important;">वेतनश्रेणी <span class="english-label" style="font-size:10px !important;">(Salary Grade)</span> &rarr; <span class="txtval">'.
                        h((empty($ng2g->salary_grade) || ($ng2g->salary_grade=='null'))? '-': $ng2g->salary_grade).
                        '</span></label>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label marathi-label" style="font-size:10px !important;">अध्यापन विषय <span class="english-label" style="font-size:10px !important;">(Teaching Subjects)</span> &rarr; <span class="txtval">'.
                        h((empty($ng2g->teaching_subject) || ($ng2g->teaching_subject=='null'))? '-': $ng2g->teaching_subject).
                        '</span></label>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label marathi-label" style="font-size:10px !important;">अध्यापनाचे माध्यम <span class="english-label" style="font-size:10px !important;">(Medium)</span> &rarr; <span class="txtval">'.
                        h((empty($ng2g->medium) || ($ng2g->medium=='null'))? '-': $ng2g->medium).
                        '</span></label>
                    </div>
                </div>';


       
                
        $is_minority_school = false;
        if(($ng2g->is_minority_school == 1) && (!empty($ng2g->minority_cert_outward_number))){  
            $is_minority_school = true;
            
        }

        if(!$is_minority_school){
            $html .= '<div class="row">
                    <div class="col-md-4">
                        <label class="form-label marathi-label" style="font-size:10px !important;">मूळ आरक्षण प्रवर्ग <span class="english-label" style="font-size:10px !important;">(Social Category)</span> &rarr; <span class="txtval">'.
                        h((empty($ng2g->original_category) || ($ng2g->original_category=='null'))? '-': $ng2g->original_category).
                        '</span></label>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label marathi-label" style="font-size:10px !important;">नियुक्तीचा आरक्षण प्रवर्ग <span class="english-label" style="font-size:10px !important;">(Appointment Category Subjects)</span> &rarr; <span class="txtval">'.
                        h((empty($ng2g->appointment_category) || ($ng2g->appointment_category=='null'))? '-': $ng2g->appointment_category).
                        '</span></label>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label marathi-label" style="font-size:10px !important;">समांतर आरक्षण प्रवर्ग <span class="english-label" style="font-size:10px !important;">(Horizontal Category)</span> &rarr; <span class="txtval">'.
                        h((empty($ng2g->horizontal_category) || ($ng2g->horizontal_category=='null'))? '-': $ng2g->horizontal_category).
                        '</span></label>
                    </div>
                </div>';
        } 

        $html .= '<div class="row">
                    <div class="col-md-3">
                        <label class="form-label marathi-label" style="font-size:10px !important;">पॅन क्रमांक <span class="english-label" style="font-size:10px !important;">(Salary Grade)</span> &rarr; <span class="txtval">'.
                        h((empty($ng2g->pan_number) || ($ng2g->pan_number=='null'))? '-': $ng2g->pan_number).
                        '</span></label>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label marathi-label" style="font-size:10px !important;">आधार क्रमांक <span class="english-label" style="font-size:10px !important;">(Teaching Subjects)</span> &rarr; <span class="txtval">'.
                        h((empty($ng2g->aadhar_number) || ($ng2g->aadhar_number=='null'))? '-': $ng2g->aadhar_number).
                        '</span></label>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label marathi-label" style="font-size:10px !important;">ई-मेल <span class="english-label" style="font-size:10px !important;">(Email)</span> &rarr; <span class="txtval">'.
                        h((empty($ng2g->email) || ($ng2g->email=='null'))? '-': $ng2g->email).
                        '</span></label>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label marathi-label" style="font-size:10px !important;">मोबाईल क्रमांक <span class="english-label" style="font-size:10px !important;">(Mobile)</span> &rarr; <span class="txtval">'.
                        h((empty($ng2g->mobile) || ($ng2g->mobile=='null'))? '-': $ng2g->mobile).
                        '</span></label>
                    </div>
                </div>';


                $courtDetails="";
                if(($ng2g->is_court_order == 1) && (!empty($ng2g->court_order_petition_number))){  

                    if (!empty($ng2g->court_order_file)) {
                        $ng2g->court_order_file = $storage->signedUrl(
                            $ng2g->court_order_file
                        );
                    }     
                    $courtDetails = '<tr>
                                    <td class="field-name" colspan="4" style="color:#ffffff;background:#3498db;">
                                        या प्रकरणासंदर्भात कोणताही न्यायालयीन आदेश निर्गमित झाला आहे का?
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <input class="form-check-input item" type="checkbox" id="court_order_outward_chk" name="court_order_outward_chk">
                                    </td>
                                    <td class="field-name">
                                        याचिका क्रमांक
                                    </td>
                                    <td>'.
                                        h((empty($ng2g->court_order_petition_number) || ($ng2g->court_order_petition_number=='null'))? '-': $ng2g->court_order_petition_number)
                                    .'</td>
                                    <td>
                                        <textarea
                                                class="form-control"
                                                rows="1"
                                                placeholder="Reason for correction" id="court_order_outward_reason" name="court_order_outward_reason"></textarea>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <input class="form-check-input item" type="checkbox" id="court_order_date_chk" name="court_order_date_chk">
                                    </td>
                                    <td class="field-name">
                                        दिनांक
                                    </td>
                                    <td>'.
                                        h((empty($ng2g->court_order_date) || ($ng2g->court_order_date=='null'))? '-': $ng2g->court_order_date)
                                    .'</td>
                                    <td>
                                        <textarea
                                                class="form-control"
                                                rows="1"
                                                placeholder="Reason for correction" id="court_order_date_reason" name="court_order_date_reason"></textarea>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <input class="form-check-input item" type="checkbox" id="court_order_doc_chk" name="court_order_doc_chk">
                                    </td>
                                    <td class="field-name">
                                        दस्तऐवज / Document
                                    </td>
                                    <td>
                                        <a class="viewBtn" href="'.
                                            h($ng2g->court_order_file).
                                            '" target="_blank">
                                            <i class="fa fa-eye"></i> View 
                                        </a>
                                    </td>
                                    <td>
                                        <textarea
                                                class="form-control"
                                                rows="1"
                                                placeholder="Reason for correction" id="court_order_doc_reason" name="court_order_doc_reason"></textarea>

                                    </td>
                                </tr>';  
                
            }

            $html .= '<style>      

                        .card{
                            border:none;
                            border-radius:12px;
                        }


                        table td{
                            vertical-align:middle;
                            font-size:10px;
                        }

                        .table thead{
                            background:#0d6efd;
                            color:white;
                        }

                        textarea{
                            resize:none;
                        }

                        .required{
                            color:red;
                        }

                        .field-name{
                            font-weight:500;
                        }
                        /* Animated Checkbox */
                        .form-check-input {
                            width: 22px;
                            height: 22px;
                            cursor: pointer;
                            border: 2px solid #6c757d;
                            border-radius: 6px;
                            transition: all 0.25s ease-in-out;
                            box-shadow: 0 0 0 0 rgba(13,110,253,.3);
                        }

                        /* Hover */
                        .form-check-input:hover {
                            border-color: #0d6efd;
                            transform: scale(1.08);
                        }

                        /* Checked */
                        .form-check-input:checked {
                            background-color: #e03647;
                            border-color: #e03647;
                            transform: scale(1.15);
                            box-shadow: 0 0 0 6px rgba(25,135,84,.15);
                        }

                        /* Focus */
                        .form-check-input:focus {
                            border-color: #e03647;
                            box-shadow: 0 0 0 0.25rem rgba(25,135,84,.25);
                        }

                        /* Click Animation */
                        .form-check-input:checked {
                            animation: checkbox-pop .25s ease;
                        }

                        @keyframes checkbox-pop {
                            0%   { transform: scale(0.8); }
                            50%  { transform: scale(1.3); }
                            100% { transform: scale(1.15); }
                        }
                    
                    </style><div>

                <div class="card shadow">

                    <div class="card-header group-header">

                        <div class="d-flex justify-content-between align-items-center">

                            <div class="section-title">
                                👤 दुरुस्तीसाठी आवश्यक बाबी निवडा व प्रत्येक बाबीसाठी शेरा नमूद करा.
                            </div>

                            <div>

                              
                            </div>

                        </div>

                    </div>

                    <div class="card-body">

                        <div class="alert alert-warning">

                            <strong>Instructions :</strong>

                            Tick the fields which contain incorrect or incomplete information.
                            Mention the reason in Remarks.
                            <hr/>
                            <strong>सूचना :</strong>
                            ज्या बाबींमध्ये माहिती चुकीची, अपूर्ण किंवा त्रुटीपूर्ण आहे त्या संबंधित बाबीसमोरील चेकबॉक्स (✓) निवडा.
                            प्रत्येक निवडलेल्या बाबीसाठी "शेरा / दुरुस्तीचे कारण" या स्तंभात दुरुस्तीचे कारण नमूद करा.
                            
                        </div>

                        <table class="table table-bordered table-hover">

                            <thead>

                            <tr>

                                <th>
                                    Select
                                </th>

                                <th>
                                    Field Name
                                </th>

                                <th>
                                    Current Value
                                </th>

                                <th width="60%">
                                    Remarks
                                </th>

                            </tr>

                            </thead>

                            <tbody>

                            <tr>

                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="hsc_doc_chk" name="hsc_doc_chk">
                                </td>

                                <td class="field-name">
                                    HSC / 12th Document
                                </td>

                                <td>
                                    <a class="viewBtn" href="'.
                                        h($ng2g->hsc_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View 
                                    </a>
                                </td>

                                <td>

                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="hsc_doc_reason" name="hsc_doc_reason"></textarea>

                                </td>

                            </tr>

                            

                            <tr>

                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="graduate_doc_chk" name="graduate_doc_chk">
                                </td>

                                <td class="field-name">
                                    Graduate Degree Document
                                </td>

                                <td>
                                    <a class="viewBtn" href="'.
                                        h($ng2g->graduate_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View 
                                    </a>
                                </td>

                                <td>

                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="graduate_doc_reason" name="graduate_doc_reason"></textarea>

                                </td>

                            </tr>

                            <tr>

                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="post_graduate_doc_chk" name="post_graduate_doc_chk">
                                </td>

                                <td class="field-name">
                                    Post Graduate Degree Document
                                </td>

                                <td>
                                    <a class="viewBtn" href="'.
                                        h($ng2g->post_graduate_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View 
                                    </a>
                                </td>

                                <td>

                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="post_graduate_doc_reason" name="post_graduate_doc_reason"></textarea>

                                </td>

                            </tr>
                   
                            <tr>

                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="ded_doc_chk" name="ded_doc_chk">
                                </td>

                                <td class="field-name">
                                    D.Ed / Equivalent Document
                                </td>

                                <td>
                                    <a class="viewBtn" href="'.
                                        h($ng2g->ded_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View 
                                    </a>
                                </td>

                                <td>

                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="ded_doc_reason" name="ded_doc_reason"></textarea>

                                </td>

                            </tr>

                            <tr>

                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="bed_doc_chk" name="bed_doc_chk">
                                </td>

                                <td class="field-name">
                                    BED / Equivalent Document
                                </td>

                                <td>
                                    <a class="viewBtn" href="'.
                                        h($ng2g->bed_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View 
                                    </a>
                                </td>

                                <td>

                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="bed_doc_reason" name="bed_doc_reason"></textarea>

                                </td>

                            </tr>
                     

                            <tr>

                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="mped_doc_chk" name="mped_doc_chk">
                                </td>

                                <td class="field-name">
                                    M.P.Ed / Equivalent Document
                                </td>

                                <td>
                                    <a class="viewBtn" href="'.
                                        h($ng2g->mped_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View 
                                    </a>
                                </td>

                                <td>

                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="mped_doc_reason" name="mped_doc_reason"></textarea>

                                </td>

                            </tr>
                            <tr>
                                <td class="field-name" colspan="4" style="color:#ffffff;background:#3498db;">
                                    शाळा व्यवस्थापन समितीचा ठराव. (MEPS Act 1981)
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="school_committee_outward_chk" name="school_committee_outward_chk">
                                </td>
                                <td class="field-name">
                                    जावक क्रमांक
                                </td>
                                <td>'.
                                    h((empty($ng2g->school_committee_outward_number) || ($ng2g->school_committee_outward_number=='null'))? '-': $ng2g->school_committee_outward_number)
                                .'</td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="school_committee_outward_reason" name="school_committee_outward_reason"></textarea>

                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="school_committee_date_chk" name="school_committee_date_chk">
                                </td>
                                <td class="field-name">
                                    दिनांक
                                </td>
                                <td>'.
                                     h((empty($ng2g->school_committee_outward_date) || ($ng2g->school_committee_outward_date=='null'))? '-': $ng2g->school_committee_outward_date)
                                .'</td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="school_committee_date_reason" name="school_committee_date_reason"></textarea>

                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="school_committee_doc_chk" name="school_committee_doc_chk">
                                </td>
                                <td class="field-name">
                                    दस्तऐवज / Document
                                </td>
                                <td>
                                    <a class="viewBtn" href="'.
                                        h($ng2g->school_committee_outward_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View 
                                    </a>
                                </td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="school_committee_doc_reason" name="school_committee_doc_reason"></textarea>

                                </td>
                            </tr>
                            

                            <tr>
                                <td class="field-name" colspan="4" style="color:#ffffff;background:#3498db;">
                                    विनाअनुदानित / अंशतः अनुदानित तत्त्वावरील मूळ संस्था नियुक्ती आदेश
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="origin_sanstha_appointment_outward_chk" name="origin_sanstha_appointment_outward_chk">
                                </td>
                                <td class="field-name">
                                    जावक क्रमांक
                                </td>
                                <td>'.
                                    h((empty($ng2g->origin_sanstha_appointment_number) || ($ng2g->origin_sanstha_appointment_number=='null'))? '-': $ng2g->origin_sanstha_appointment_number)
                                .'</td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="origin_sanstha_appointment_outward_reason" name="origin_sanstha_appointment_outward_reason"></textarea>

                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="origin_sanstha_appointment_date_chk" name="origin_sanstha_appointment_date_chk">
                                </td>
                                <td class="field-name">
                                    दिनांक
                                </td>
                                <td>'.
                                     h((empty($ng2g->origin_sanstha_appointment_date) || ($ng2g->origin_sanstha_appointment_date=='null'))? '-': $ng2g->origin_sanstha_appointment_date)
                                .'</td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="origin_sanstha_appointment_date_reason" name="origin_sanstha_appointment_date_reason"></textarea>

                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="origin_sanstha_appointment_doc_chk" name="origin_sanstha_appointment_doc_chk">
                                </td>
                                <td class="field-name">
                                     दस्तऐवज / Document
                                </td>
                                <td>
                                    <a class="viewBtn" href="'.
                                        h($ng2g->origin_sanstha_appointment_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View 
                                    </a>
                                </td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="origin_sanstha_appointment_doc_reason" name="origin_sanstha_appointment_doc_reason"></textarea>

                                </td>
                            </tr>
                            
                            <tr>
                                <td class="field-name" colspan="4" style="color:#ffffff;background:#3498db;">
                                    शिक्षणाधिकारी / उपसंचालक यांनी दिलेला अंशतः अनुदानित तत्त्वावरील वैयक्तिक मान्यता आदेश
                                </td>
                            </tr> 
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="personal_recognition_outward_chk" name="personal_recognition_outward_chk">
                                </td>
                                <td class="field-name">
                                    जावक क्रमांक
                                </td>
                                <td>'.
                                    h((empty($ng2g->personal_recognition_number) || ($ng2g->personal_recognition_number=='null'))? '-': $ng2g->personal_recognition_number)
                                .'</td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="personal_recognition_outward_reason" name="personal_recognition_outward_reason"></textarea>

                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="personal_recognition_date_chk" name="personal_recognition_date_chk">
                                </td>
                                <td class="field-name">
                                    दिनांक
                                </td>
                                <td>'.
                                     h((empty($ng2g->personal_recognition_date) || ($ng2g->personal_recognition_date=='null'))? '-': $ng2g->personal_recognition_date)
                                .'</td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="personal_recognition_date_reason" name="personal_recognition_date_reason"></textarea>

                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="personal_recognition_doc_chk" name="personal_recognition_doc_chk">
                                </td>
                                <td class="field-name">
                                     दस्तऐवज / Document
                                </td>
                                <td>
                                    <a class="viewBtn" href="'.
                                        h($ng2g->personal_recognition_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View 
                                    </a>
                                </td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="personal_recognition_doc_reason" name="personal_recognition_doc_reason"></textarea>

                                </td>
                            </tr>
                                
                            <tr>
                                <td class="field-name" colspan="4" style="color:#ffffff;background:#3498db;">
                                    संबंधित व्यवस्थापनाची विनाअनुदानित / अंशतः अनुदानित सेवाज्येष्ठता सूची
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="service_seniority_outward_chk" name="service_seniority_outward_chk">
                                </td>
                                <td class="field-name">
                                    जावक क्रमांक
                                </td>
                                <td>'.
                                    h((empty($ng2g->service_seniority_list_number) || ($ng2g->service_seniority_list_number=='null'))? '-': $ng2g->service_seniority_list_number)
                                .'</td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="service_seniority_outward_reason" name="service_seniority_outward_reason"></textarea>

                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="service_seniority_date_chk" name="service_seniority_date_chk">
                                </td>
                                <td class="field-name">
                                    दिनांक
                                </td>
                                <td>'.
                                     h((empty($ng2g->service_seniority_list_date) || ($ng2g->service_seniority_list_date=='null'))? '-': $ng2g->service_seniority_list_date)
                                .'</td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="service_seniority_date_reason" name="service_seniority_date_reason"></textarea>

                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="service_seniority_doc_chk" name="service_seniority_doc_chk">
                                </td>
                                <td class="field-name">
                                     दस्तऐवज / Document
                                </td>
                                <td>
                                    <a class="viewBtn" href="'.
                                        h($ng2g->service_seniority_list_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View 
                                    </a>
                                </td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="service_seniority_doc_reason" name="service_seniority_doc_reason"></textarea>

                                </td>
                            </tr>
                            
                            <tr>
                                <td class="field-name" colspan="4" style="color:#ffffff;background:#3498db;">
                                    बदलीपूर्वी बिंदुनामावलीनुसार रिक्त पदाचा विषय व आरक्षण विचारात घेण्यात आल्याचे प्रमाणपत्र
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="vacant_post_merit_outward_chk" name="vacant_post_merit_outward_chk">
                                </td>
                                <td class="field-name">
                                    जावक क्रमांक
                                </td>
                                <td>'.
                                    h((empty($ng2g->vacant_post_merit_list_number) || ($ng2g->vacant_post_merit_list_number=='null'))? '-': $ng2g->vacant_post_merit_list_number)
                                .'</td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="vacant_post_merit_outward_reason" name="vacant_post_merit_outward_reason"></textarea>

                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="vacant_post_merit_date_chk" name="vacant_post_merit_date_chk">
                                </td>
                                <td class="field-name">
                                    दिनांक
                                </td>
                                <td>'.
                                     h((empty($ng2g->vacant_post_merit_list_date) || ($ng2g->vacant_post_merit_list_date=='null'))? '-': $ng2g->vacant_post_merit_list_date)
                                .'</td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="vacant_post_merit_date_reason" name="vacant_post_merit_date_reason"></textarea>

                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="vacant_post_merit_doc_chk" name="vacant_post_merit_doc_chk">
                                </td>
                                <td class="field-name">
                                    दस्तऐवज / Document
                                </td>
                                <td>
                                    <a class="viewBtn" href="'.
                                        h($ng2g->vacant_post_merit_list_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View 
                                    </a>
                                </td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="vacant_post_merit_doc_reason" name="vacant_post_merit_doc_reason"></textarea>

                                </td>
                            </tr>
                               
                            <tr>
                                <td class="field-name" colspan="4" style="color:#ffffff;background:#3498db;">
                                    विनाअनुदानित / अंशतः अनुदानित शाळेत 5 वर्षे सेवा केल्याचे (मुख्याध्यापक) प्रमाणपत्र
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="hm_5yrs_certi_outward_chk" name="hm_5yrs_certi_outward_chk">
                                </td>
                                <td class="field-name">
                                    जावक क्रमांक
                                </td>
                                <td>'.
                                    h((empty($ng2g->five_years_hm_certificate_outward_number) || ($ng2g->five_years_hm_certificate_outward_number=='null'))? '-': $ng2g->five_years_hm_certificate_outward_number)
                                .'</td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="hm_5yrs_certi_outward_reason" name="hm_5yrs_certi_outward_reason"></textarea>

                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="hm_5yrs_certi_date_chk" name="hm_5yrs_certi_date_chk">
                                </td>
                                <td class="field-name">
                                    दिनांक
                                </td>
                                <td>'.
                                    h((empty($ng2g->five_years_hm_certificate_date) || ($ng2g->five_years_hm_certificate_date=='null'))? '-': $ng2g->five_years_hm_certificate_date)
                                .'</td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="hm_5yrs_certi_date_reason" name="hm_5yrs_certi_date_reason"></textarea>

                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="hm_5yrs_certi_doc_chk" name="hm_5yrs_certi_doc_chk">
                                </td>
                                <td class="field-name">
                                     दस्तऐवज / Document
                                </td>
                                <td>
                                    <a class="viewBtn" href="'.
                                        h($ng2g->five_years_hm_certificate_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View 
                                    </a>
                                </td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="hm_5yrs_certi_doc_reason" name="hm_5yrs_certi_doc_reason"></textarea>

                                </td>
                            </tr>
                                
                            <tr>
                                <td class="field-name" colspan="4" style="color:#ffffff;background:#3498db;">
                                    अनुदानित रिक्त पदाचा तपशील व कागदपत्रे
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="vacant_post_outward_chk" name="vacant_post_outward_chk">
                                </td>
                                <td class="field-name">
                                    जावक क्रमांक
                                </td>
                                <td>'.
                                    h((empty($ng2g->vacant_post_causing_transfer_outward_number) || ($ng2g->vacant_post_causing_transfer_outward_number=='null'))? '-': $ng2g->vacant_post_causing_transfer_outward_number)
                                .'</td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="vacant_post_outward_reason" name="vacant_post_outward_reason"></textarea>

                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="vacant_post_date_chk" name="vacant_post_date_chk">
                                </td>
                                <td class="field-name">
                                    दिनांक
                                </td>
                                <td>'.
                                    h((empty($ng2g->vacant_post_causing_transfer_date) || ($ng2g->vacant_post_causing_transfer_date=='null'))? '-': $ng2g->vacant_post_causing_transfer_date)
                                .'</td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="vacant_post_date_reason" name="vacant_post_date_reason"></textarea>

                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="vacant_post_doc_chk" name="vacant_post_doc_chk">
                                </td>
                                <td class="field-name">
                                     दस्तऐवज / Document
                                </td>
                                <td>
                                    <a class="viewBtn" href="'.
                                        h($ng2g->vacant_post_causing_transfer_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View 
                                    </a>
                                </td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="vacant_post_doc_reason" name="vacant_post_doc_reason"></textarea>

                                </td>
                            </tr>


                            <tr>
                                <td class="field-name" colspan="4" style="color:#ffffff;background:#3498db;">
                                    बिंदुनामावली तपासणी पत्र (मावकद्वारे)
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="mavak_checklist_outward_chk" name="mavak_checklist_outward_chk">
                                </td>
                                <td class="field-name">
                                    विवरण
                                </td>
                                <td>दिनांक:- '.
                                        h((empty($ng2g->mavak_checklist_date) || ($ng2g->mavak_checklist_date=='null'))? '-': $ng2g->mavak_checklist_date)
                                    .'</td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="mavak_checklist_outward_reason" name="mavak_checklist_outward_reason"></textarea>

                                </td>
                            </tr>                            
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="mavak_checklist_doc_chk" name="mavak_checklist_doc_chk">
                                </td>
                                <td class="field-name">
                                     दस्तऐवज / Document
                                </td>
                                <td>
                                    <a class="viewBtn" href="'.
                                        h($ng2g->mavak_checklist_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View 
                                    </a>
                                </td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="mavak_checklist_doc_reason" name="mavak_checklist_doc_reason"></textarea>

                                </td>
                            </tr>                           
                                    
                            <tr>
                                <td class="field-name" colspan="4" style="color:#ffffff;background:#3498db;">
                                    संबंधित शिक्षकांचे विनाअनुदानित भरतीचे ना हरकत प्रमाणपत्र
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="recruitment_noc_outward_chk" name="recruitment_noc_outward_chk">
                                </td>
                                <td class="field-name">
                                    विवरण
                                </td>
                                <td>जावक क्रमांक:- '.
                                        h((empty($ng2g->recruitment_noc_outward_number) || ($ng2g->recruitment_noc_outward_number=='null'))? '-': $ng2g->recruitment_noc_outward_number)
                                    .', दिनांक:- '.
                                        h((empty($ng2g->recruitment_noc_outward_date) || ($ng2g->recruitment_noc_outward_date=='null'))? '-': $ng2g->recruitment_noc_outward_date)
                                    .'</td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="recruitment_noc_outward_reason" name="recruitment_noc_outward_reason"></textarea>

                                </td>
                            </tr>                            
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="recruitment_noc_doc_chk" name="recruitment_noc_doc_chk">
                                </td>
                                <td class="field-name">
                                     दस्तऐवज / Document
                                </td>
                                <td>
                                    <a class="viewBtn" href="'.
                                        h($ng2g->recruitment_noc_outward_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View 
                                    </a>
                                </td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="recruitment_noc_doc_reason" name="recruitment_noc_doc_reason"></textarea>

                                </td>
                            </tr>
                              
                            <tr>
                                <td class="field-name" colspan="4" style="color:#ffffff;background:#3498db;">
                                    वर्तमानपत्रातील जाहिरात (मूळप्रत)
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="advrt_newspaper_outward_chk" name="advrt_newspaper_outward_chk">
                                </td>
                                <td class="field-name">
                                    विवरण
                                </td>
                                <td>वर्तमानपत्राचे नाव:- '.
                                        h((empty($ng2g->advrt_newspaper_name) || ($ng2g->advrt_newspaper_name=='null'))? '-': $ng2g->advrt_newspaper_name)
                                        .', दिनांक:- '.
                                        h((empty($ng2g->advrt_newspaper_date) || ($ng2g->advrt_newspaper_date=='null'))? '-': $ng2g->advrt_newspaper_date)
                                    .'</td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="advrt_newspaper_outward_reason" name="advrt_newspaper_outward_reason"></textarea>

                                </td>
                            </tr>                            
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="advrt_newspaper_doc_chk" name="advrt_newspaper_doc_chk">
                                </td>
                                <td class="field-name">
                                     दस्तऐवज / Document
                                </td>
                                <td>
                                    <a class="viewBtn" href="'.
                                        h($ng2g->advrt_newspaper_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View 
                                    </a>
                                </td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="advrt_newspaper_doc_reason" name="advrt_newspaper_doc_reason"></textarea>

                                </td>
                            </tr>
                                
                            <tr>
                                <td class="field-name" colspan="4" style="color:#ffffff;background:#3498db;">
                                    मुलाखत
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="interview_outward_chk" name="interview_outward_chk">
                                </td>
                                <td class="field-name">
                                    विवरण
                                </td>
                                <td>दिनांक:- '.
                                        h((empty($ng2g->interview_date) || ($ng2g->interview_date=='null'))? '-': $ng2g->interview_date)
                                    .'</td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="interview_outward_reason" name="interview_outward_reason"></textarea>

                                </td>
                            </tr>                            
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="interview_doc_chk" name="interview_doc_chk">
                                </td>
                                <td class="field-name">
                                     दस्तऐवज / Document
                                </td>
                                <td>
                                    <a class="viewBtn" href="'.
                                        h($ng2g->interview_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View 
                                    </a>
                                </td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="interview_doc_reason" name="interview_doc_reason"></textarea>

                                </td>
                            </tr>
                                
                            <tr>
                                <td class="field-name" colspan="4" style="color:#ffffff;background:#3498db;">
                                    रुजू अहवाल विनाअनुदानित तत्त्वावरील
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="report_ng_principle_outward_chk" name="report_ng_principle_outward_chk">
                                </td>
                                <td class="field-name">
                                    विवरण
                                </td>
                                <td>दिनांक:- '.
                                        h((empty($ng2g->report_ng_principle_date) || ($ng2g->report_ng_principle_date=='null'))? '-': $ng2g->report_ng_principle_date)
                                    .'</td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="report_ng_principle_outward_reason" name="report_ng_principle_outward_reason"></textarea>

                                </td>
                            </tr>                            
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="report_ng_principle_doc_chk" name="report_ng_principle_doc_chk">
                                </td>
                                <td class="field-name">
                                     दस्तऐवज / Document
                                </td>
                                <td>
                                    <a class="viewBtn" href="'.
                                        h($ng2g->report_ng_principle_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View 
                                    </a>
                                </td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="report_ng_principle_doc_reason" name="report_ng_principle_doc_reason"></textarea>

                                </td>
                            </tr>
                            <tr>
                                <td class="field-name" colspan="4" style="color:#ffffff;background:#3498db;">
                                    रुजू अहवाल अंशतः अनुदानित/अनुदानित तत्त्वावरील
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="report_g_principle_outward_chk" name="report_g_principle_outward_chk">
                                </td>
                                <td class="field-name">
                                    विवरण
                                </td>
                                <td>दिनांक:- '.
                                        h((empty($ng2g->report_g_principle_date) || ($ng2g->report_g_principle_date=='null'))? '-': $ng2g->report_g_principle_date)
                                    .'</td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="report_g_principle_outward_reason" name="report_g_principle_outward_reason"></textarea>

                                </td>
                            </tr>                            
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="report_g_principle_doc_chk" name="report_g_principle_doc_chk">
                                </td>
                                <td class="field-name">
                                     दस्तऐवज / Document
                                </td>
                                <td>
                                    <a class="viewBtn" href="'.
                                        h($ng2g->report_g_principle_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View 
                                    </a>
                                </td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="report_g_principle_doc_reason" name="report_g_principle_doc_reason"></textarea>

                                </td>
                            </tr>                                
                            <tr>
                                <td class="field-name" colspan="4" style="color:#ffffff;background:#3498db;">
                                    बदली होणारा शिक्षक स्वयंअर्थसहाय्यित तत्त्वावर कार्यरत नव्हता याबाबत प्रमाणपत्र 
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="self_financing_certificate_outward_chk" name="self_financing_certificate_outward_chk">
                                </td>
                                <td class="field-name">
                                    विवरण
                                </td>
                                <td>जावक क्रमांक:- '.
                                        h((empty($ng2g->self_financing_certificate_outward_number) || ($ng2g->self_financing_certificate_outward_number=='null'))? '-': $ng2g->self_financing_certificate_outward_number)
                                    .', दिनांक:- '.
                                        h((empty($ng2g->self_financing_certificate_date) || ($ng2g->self_financing_certificate_date=='null'))? '-': $ng2g->self_financing_certificate_date)
                                    .'</td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="self_financing_certificate_outward_reason" name="self_financing_certificate_outward_reason"></textarea>

                                </td>
                            </tr>                            
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="self_financing_certificate_doc_chk" name="self_financing_certificate_doc_chk">
                                </td>
                                <td class="field-name">
                                     दस्तऐवज / Document
                                </td>
                                <td>
                                    <a class="viewBtn" href="'.
                                        h($ng2g->self_financing_certificate_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View 
                                    </a>
                                </td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="self_financing_certificate_doc_reason" name="self_financing_certificate_doc_reason"></textarea>

                                </td>
                            </tr>

                            <tr>
                                <td class="field-name" colspan="4" style="color:#ffffff;background:#3498db;">
                                    बदली असमान पदावर झालेली नाही याबाबत प्रमाणपत्र 
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="transfer_not_higher_post_outward_chk" name="transfer_not_higher_post_outward_chk">
                                </td>
                                <td class="field-name">
                                    विवरण
                                </td>
                                <td>जावक क्रमांक:- '.
                                        h((empty($ng2g->transfer_not_higher_post_outward_number) || ($ng2g->transfer_not_higher_post_outward_number=='null'))? '-': $ng2g->transfer_not_higher_post_outward_number)
                                    .', दिनांक:- '.
                                        h((empty($ng2g->transfer_not_higher_post_date) || ($ng2g->transfer_not_higher_post_date=='null'))? '-': $ng2g->transfer_not_higher_post_date)
                                    .'</td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="transfer_not_higher_post_outward_reason" name="transfer_not_higher_post_outward_reason"></textarea>

                                </td>
                            </tr>                            
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="transfer_not_higher_post_doc_chk" name="transfer_not_higher_post_doc_chk">
                                </td>
                                <td class="field-name">
                                     दस्तऐवज / Document
                                </td>
                                <td>
                                    <a class="viewBtn" href="'.
                                        h($ng2g->transfer_not_higher_post_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View 
                                    </a>
                                </td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="transfer_not_higher_post_doc_reason" name="transfer_not_higher_post_doc_reason"></textarea>

                                </td>
                            </tr>                         


                            <tr>
                                <td class="field-name" colspan="4" style="color:#ffffff;background:#3498db;">
                                    महाराष्ट्र खासगी शाळा कर्मचारी (सेवा अटी) नियमावली 1981 मधील नियम 41(1)(3) नुसार वेतन अनुदानाबाबत हमीपत्र 
                                </td>
                            </tr>
                                                      
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="salary_subsidy_guarantee_doc_chk" name="salary_subsidy_guarantee_doc_chk">
                                </td>
                                <td class="field-name">
                                     दस्तऐवज / Document
                                </td>
                                <td>
                                    <a class="viewBtn" href="'.
                                        h($ng2g->salary_subsidy_guarantee_letter_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View 
                                    </a>
                                </td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="salary_subsidy_guarantee_doc_reason" name="salary_subsidy_guarantee_doc_reason"></textarea>

                                </td>
                            </tr>
        
                            <tr>
                                <td class="field-name" colspan="4" style="color:#ffffff;background:#3498db;">
                                    आयकर विवरणपत्र 
                                </td>
                            </tr>
                                                      
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="itr1_doc_chk" name="itr1_doc_chk">
                                </td>
                                <td class="field-name">
                                     Form-16. Year 1
                                </td>
                                <td>
                                    <a class="viewBtn" href="'.
                                        h($ng2g->itr1_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View 
                                    </a>
                                </td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="itr1_doc_reason" name="itr1_doc_reason"></textarea>

                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="itr2_doc_chk" name="itr2_doc_chk">
                                </td>
                                <td class="field-name">
                                     Form-16. Year 2
                                </td>
                                <td>
                                    <a class="viewBtn" href="'.
                                        h($ng2g->itr2_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View 
                                    </a>
                                </td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="itr2_doc_reason" name="itr2_doc_reason"></textarea>

                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="itr3_doc_chk" name="itr3_doc_chk">
                                </td>
                                <td class="field-name">
                                     Form-16. Year 3
                                </td>
                                <td>
                                    <a class="viewBtn" href="'.
                                        h($ng2g->itr3_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View 
                                    </a>
                                </td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="itr3_doc_reason" name="itr3_doc_reason"></textarea>

                                </td>
                            </tr>
                            <tr>
                                <td class="field-name" colspan="4" style="color:#ffffff;background:#3498db;">
                                    वेतन बँक स्टेटमेंट ( मागील ५ वर्षाचे)
                                </td>
                            </tr>
                                                      
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="bank_statement_date_chk" name="bank_statement_date_chk">
                                </td>
                                <td class="field-name">
                                     विवरण
                                </td>
                                <td>दिनांक:- '. 
                                    h((empty($ng2g->bank_statement_from_date) || ($ng2g->bank_statement_from_date=='null'))? '-': $ng2g->bank_statement_from_date)

                                    .' to '.
                                    h((empty($ng2g->bank_statement_to_date) || ($ng2g->bank_statement_to_date=='null'))? '-': $ng2g->bank_statement_to_date)

                                    .'</td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="bank_statement_date_reason" name="bank_statement_date_reason"></textarea>

                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="bank_statement_doc_chk" name="bank_statement_doc_chk">
                                </td>
                                <td class="field-name">
                                     दस्तऐवज / Document
                                </td>
                                <td>
                                    <a class="viewBtn" href="'.
                                        h($ng2g->bank_statement_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View 
                                    </a>
                                </td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="bank_statement_doc_reason" name="bank_statement_doc_reason"></textarea>

                                </td>
                            </tr>'.$courtDetails.'
                            <tr>
                                <td class="field-name" colspan="4" style="color:#ffffff;background:#3498db;">
                                    विनाअनुदानित तत्त्वावरील रुजू दिनांकापासून इतर शासकीय लाभ घेतले नाहीत याबाबत प्रमाणपत्र
                                </td>
                            </tr>
                                                      
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="no_benefits_certificate_description_chk" name="no_benefits_certificate_description_chk">
                                </td>
                                <td class="field-name">
                                     विवरण
                                </td>
                                <td>'. 
                                    h((empty($ng2g->no_benefits_certificate_details) || ($ng2g->no_benefits_certificate_details=='null'))? '-': $ng2g->no_benefits_certificate_details)
                                .'</td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="no_benefits_certificate_description_reason" name="no_benefits_certificate_description_reason"></textarea>

                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="no_benefits_certificate_doc_chk" name="no_benefits_certificate_doc_chk">
                                </td>
                                <td class="field-name">
                                     दस्तऐवज / Document
                                </td>
                                <td>
                                    <a class="viewBtn" href="'.
                                        h($ng2g->no_benefits_certificate_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View 
                                    </a>
                                </td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="no_benefits_certificate_doc_reason" name="no_benefits_certificate_doc_reason"></textarea>

                                </td>
                            </tr>

                             <tr>
                                <td class="field-name" colspan="4" style="color:#ffffff;background:#3498db;">
                                    NPS योजना बंधनकारक असल्याबाबत हमीपत्र
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="nps_scheme_doc_chk" name="nps_scheme_doc_chk">
                                </td>
                                <td class="field-name">
                                     दस्तऐवज / Document
                                </td>
                                <td>
                                    <a class="viewBtn" href="'.
                                        h($ng2g->nps_scheme).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View 
                                    </a>
                                </td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="nps_scheme_doc_reason" name="nps_scheme_doc_reason"></textarea>

                                </td>
                            </tr>

                            <tr>
                                <td class="field-name" colspan="4" style="color:#ffffff;background:#3498db;">
                                    प्रस्तुत प्रस्तावातील कागदपत्रे खरी असल्याबाबत संस्थेचे हमीपत्र (प्रपत्र-2)
                                </td>
                            </tr>                     
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="institution_guarantee_doc_chk" name="institution_guarantee_doc_chk">
                                </td>
                                <td class="field-name">
                                    दस्तऐवज / Document
                                </td>
                                <td>
                                    <a class="viewBtn" href="'.
                                        h($ng2g->institution_guarantee_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View 
                                    </a>
                                </td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="institution_guarantee_doc_reason" name="institution_guarantee_doc_reason"></textarea>

                                </td>
                            </tr>
                            
       

                            <tr>
                                <td class="field-name" colspan="4" style="color:#ffffff;background:#3498db;">
                                    संस्थेमध्ये वाद नसल्याबाबत हमीपत्र
                                </td>
                            </tr> 
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input item" type="checkbox" id="institution_no_disbute_doc_chk" name="institution_no_disbute_doc_chk">
                                </td>
                                <td class="field-name">
                                     दस्तऐवज / Document
                                </td>
                                <td>
                                    <a class="viewBtn" href="'.
                                        h($ng2g->institution_no_disbute_file).
                                        '" target="_blank">
                                        <i class="fa fa-eye"></i> View 
                                    </a>
                                </td>
                                <td>
                                    <textarea
                                            class="form-control"
                                            rows="1"
                                            placeholder="Reason for correction" id="institution_no_disbute_doc_reason" name="institution_no_disbute_doc_reason"></textarea>

                                </td>
                            </tr>


                        </tbody>

                    </table>

                    <div class="border rounded p-3 mb-2 bg-light">
                        <div class="form-check">
        
                        <label class="form-check-label fw-semibold">
                        Overall Remark
                        </label>
                        <textarea
                                            class="form-control"
                                            rows="5"
                                            placeholder=" Overall Remark" id="overall_remark" name="overall_remark"></textarea>

                        </div>
                    </div>

                </div>

                <div class="card-footer text-end">

                    
                    <button type="button" onclick="submitReturnApplication()" class="btn btn-danger">
                        Return Application to Sanstha
                    </button>

                </div>

            </div>

        </div></form>';
        



        


       

                

         
        


            /* echo "<pre>";
        print_r($ng2g);
        exit;*/

            
               
        $response = [
                'success' => true,
                'status' => 200,
                'timestamp' => time(),
                'data' =>$ng2g,
                'html' => $html
            ];
          
         return $this->response
            ->withType('application/json')
            ->withStatus(200)
            ->withStringBody(json_encode($response));      
       

        

    }

    

    public function ng2gReplyToReturnApplication($app_id)
    {
        
        $this->Authorization->skipAuthorization();
       // $this->viewBuilder()->setLayout('state');
    
        $ng2gApplicationReturnsTable = TableRegistry::getTableLocator()->get('Ng2gApplicationReturns');

        $staffTransfersTable = TableRegistry::getTableLocator()->get('StaffTransfers');
      

        $ng2g = $ng2gApplicationReturnsTable->find()               
                ->where(['ng2g_id' => $app_id,'status' => 'returned'])
                ->all();

        
        
        $count = count($ng2g);
        /*echo "<pre>";
        print_r($ng2g);
        exit;*/

        if($count == 0){
            $response = [
                'success' => false,
                'status' => 400,
                'timestamp' => time(),
                'message' => "No data found"
            ];
          
            return $this->response
                ->withType('application/json')
                ->withStatus(400)
                ->withStringBody(json_encode($response));   
        }

        
        $html = '<form id="returnApplicationForm" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="application_id" value="'. $app_id .'"><div class="row mb-2">
                    <div class="card shadow">                 
                        <div class="card-body">
                            <div class="alert alert-warning">
                                <i class="fa-solid fa-circle-info me-2"></i>
                                <strong>सूचना:</strong> कृपया अधिकाऱ्यांनी नमूद केलेल्या सर्व आक्षेपांची पूर्तता करून आवश्यक कागदपत्रे अपलोड करून अर्ज <strong>पुनः सादर करा</strong>.
                            </div>
                            
                            <table class="table table-bordered table-hover">
                                <thead>
                                 <tr>
                                    <th>
                                        माहिती / कागदपत्र
                                    </th>

                                    <th>
                                        अधिकाऱ्यांची निरीक्षणे
                                    </th>

                                    <th>
                                        दुरुस्ती आवश्यक असलेली माहिती / कागदपत्रे
                                    </th>                               

                                </tr>';
        foreach($ng2g as $ng){            
            if($ng->rtn_field_name == "hsc_file"){
                $html .= $this->genrateFileRow('HSC / 12th Document',$ng->id,$ng->rtn_field_reason);
            }

            if($ng->rtn_field_name == "graduate_file"){
                $html .= $this->genrateFileRow('Graduate Degree Document',$ng->id,$ng->rtn_field_reason);
            }

            if($ng->rtn_field_name == "post_graduate_file"){
                $html .= $this->genrateFileRow('Post Graduate Degree Document',$ng->id,$ng->rtn_field_reason);
            }

            if($ng->rtn_field_name == "ded_file"){
                $html .= $this->genrateFileRow('D.Ed / Equivalent Document',$ng->id,$ng->rtn_field_reason);
            }

            if($ng->rtn_field_name == "bed_file"){
                $html .= $this->genrateFileRow('BED / Equivalent Document',$ng->id,$ng->rtn_field_reason);
            }

            if($ng->rtn_field_name == "mped_file"){
                $html .= $this->genrateFileRow('M.P.Ed / Equivalent Document',$ng->id,$ng->rtn_field_reason);
            }                
	
            if(($ng->rtn_field_name == "school_committee_outward") || ($ng->rtn_field_name == "school_committee_date") || ($ng->rtn_field_name == "school_committee_outward_file")){
                $html .= $this->genrateHeaderRow('शाळा व्यवस्थापन समितीचा ठराव. (MEPS Act 1981)');
                if($ng->rtn_field_name == "school_committee_outward"){
                    $html .= $this->genrateInputRow('जावक क्रमांक',$ng->id,$ng->rtn_field_reason);
                }
                if($ng->rtn_field_name == "school_committee_date"){
                    $html .= $this->genrateDateRow('दिनांक',$ng->id,$ng->rtn_field_reason);
                }
                if($ng->rtn_field_name == "school_committee_outward_file"){
                    $html .= $this->genrateFileRow('दस्तऐवज / Document',$ng->id,$ng->rtn_field_reason);
                }
            }

            if(($ng->rtn_field_name == "origin_sanstha_appointment_outward") || ($ng->rtn_field_name == "origin_sanstha_appointment_date") || ($ng->rtn_field_name == "origin_sanstha_appointment_file")){
                $html .= $this->genrateHeaderRow('विनाअनुदानित / अंशतः अनुदानित तत्त्वावरील मूळ संस्था नियुक्ती आदेश');
                if($ng->rtn_field_name == "origin_sanstha_appointment_outward"){
                    $html .= $this->genrateInputRow('जावक क्रमांक',$ng->id,$ng->rtn_field_reason);
                }
                if($ng->rtn_field_name == "origin_sanstha_appointment_date"){
                    $html .= $this->genrateDateRow('दिनांक',$ng->id,$ng->rtn_field_reason);
                }
                if($ng->rtn_field_name == "origin_sanstha_appointment_file"){
                    $html .= $this->genrateFileRow('दस्तऐवज / Document',$ng->id,$ng->rtn_field_reason);
                }
            }

            if(($ng->rtn_field_name == "personal_recognition_outward") || ($ng->rtn_field_name == "personal_recognition_date") || ($ng->rtn_field_name == "personal_recognition_file")){
                $html .= $this->genrateHeaderRow('शिक्षणाधिकारी / उपसंचालक यांनी दिलेला अंशतः अनुदानित तत्त्वावरील वैयक्तिक मान्यता आदेश');
                if($ng->rtn_field_name == "personal_recognition_outward"){
                    $html .= $this->genrateInputRow('जावक क्रमांक',$ng->id,$ng->rtn_field_reason);
                }
                if($ng->rtn_field_name == "personal_recognition_date"){
                    $html .= $this->genrateDateRow('दिनांक',$ng->id,$ng->rtn_field_reason);
                }
                if($ng->rtn_field_name == "personal_recognition_file"){
                    $html .= $this->genrateFileRow('दस्तऐवज / Document',$ng->id,$ng->rtn_field_reason);
                }
            }

            if(($ng->rtn_field_name == "service_seniority_outward") || ($ng->rtn_field_name == "service_seniority_date") || ($ng->rtn_field_name == "service_seniority_list_file")){
                $html .= $this->genrateHeaderRow('संबंधित व्यवस्थापनाची विनाअनुदानित / अंशतः अनुदानित सेवाज्येष्ठता सूची');
                if($ng->rtn_field_name == "service_seniority_outward"){
                    $html .= $this->genrateInputRow('जावक क्रमांक',$ng->id,$ng->rtn_field_reason);
                }
                if($ng->rtn_field_name == "service_seniority_date"){
                    $html .= $this->genrateDateRow('दिनांक',$ng->id,$ng->rtn_field_reason);
                }
                if($ng->rtn_field_name == "service_seniority_list_file"){
                    $html .= $this->genrateFileRow('दस्तऐवज / Document',$ng->id,$ng->rtn_field_reason);
                }
            }

            if(($ng->rtn_field_name == "vacant_post_merit_outward") || ($ng->rtn_field_name == "vacant_post_merit_date") || ($ng->rtn_field_name == "vacant_post_merit_list_file")){
                $html .= $this->genrateHeaderRow('बदलीपूर्वी बिंदुनामावलीनुसार रिक्त पदाचा विषय व आरक्षण विचारात घेण्यात आल्याचे प्रमाणपत्र');
                if($ng->rtn_field_name == "vacant_post_merit_outward"){
                    $html .= $this->genrateInputRow('जावक क्रमांक',$ng->id,$ng->rtn_field_reason);
                }
                if($ng->rtn_field_name == "vacant_post_merit_date"){
                    $html .= $this->genrateDateRow('दिनांक',$ng->id,$ng->rtn_field_reason);
                }
                if($ng->rtn_field_name == "vacant_post_merit_list_file"){
                    $html .= $this->genrateFileRow('दस्तऐवज / Document',$ng->id,$ng->rtn_field_reason);
                }
            }

            if(($ng->rtn_field_name == "hm_5yrs_certi_outward") || ($ng->rtn_field_name == "hm_5yrs_certi_date") || ($ng->rtn_field_name == "five_years_hm_certificate_file")){
                $html .= $this->genrateHeaderRow('विनाअनुदानित / अंशतः अनुदानित शाळेत 5 वर्षे सेवा केल्याचे (मुख्याध्यापक) प्रमाणपत्र');
                if($ng->rtn_field_name == "hm_5yrs_certi_outward"){
                    $html .= $this->genrateInputRow('जावक क्रमांक',$ng->id,$ng->rtn_field_reason);
                }
                if($ng->rtn_field_name == "hm_5yrs_certi_date"){
                    $html .= $this->genrateDateRow('दिनांक',$ng->id,$ng->rtn_field_reason);
                }
                if($ng->rtn_field_name == "five_years_hm_certificate_file"){
                    $html .= $this->genrateFileRow('दस्तऐवज / Document',$ng->id,$ng->rtn_field_reason);
                }
            }


            if(($ng->rtn_field_name == "vacant_post_outward") || ($ng->rtn_field_name == "vacant_post_date") || ($ng->rtn_field_name == "vacant_post_causing_transfer_file")){
                $html .= $this->genrateHeaderRow('अनुदानित रिक्त पदाचा तपशील व कागदपत्रे');
                if($ng->rtn_field_name == "vacant_post_outward"){
                    $html .= $this->genrateInputRow('जावक क्रमांक',$ng->id,$ng->rtn_field_reason);
                }
                if($ng->rtn_field_name == "vacant_post_date"){
                    $html .= $this->genrateDateRow('दिनांक',$ng->id,$ng->rtn_field_reason);
                }
                if($ng->rtn_field_name == "vacant_post_causing_transfer_file"){
                    $html .= $this->genrateFileRow('दस्तऐवज / Document',$ng->id,$ng->rtn_field_reason);
                }
            }
            
            if(($ng->rtn_field_name == "mavak_checklist_outward") || ($ng->rtn_field_name == "mavak_checklist_file")){
                $html .= $this->genrateHeaderRow('बिंदुनामावली तपासणी पत्र (मावकद्वारे)');
                if($ng->rtn_field_name == "mavak_checklist_outward"){
                    $html .= $this->genrateInputRow('जावक क्रमांक',$ng->id,$ng->rtn_field_reason);
                }
                if($ng->rtn_field_name == "mavak_checklist_file"){
                    $html .= $this->genrateFileRow('दस्तऐवज / Document',$ng->id,$ng->rtn_field_reason);
                }
            }

            if(($ng->rtn_field_name == "recruitment_noc_outward") || ($ng->rtn_field_name == "recruitment_noc_outward_file")){
                $html .= $this->genrateHeaderRow('संबंधित शिक्षकांचे विनाअनुदानित भरतीचे ना हरकत प्रमाणपत्र');
                if($ng->rtn_field_name == "recruitment_noc_outward"){
                    $html .= $this->genrateInputRow('विवरण',$ng->id,$ng->rtn_field_reason);
                }
                if($ng->rtn_field_name == "recruitment_noc_outward_file"){
                    $html .= $this->genrateFileRow('दस्तऐवज / Document',$ng->id,$ng->rtn_field_reason);
                }
            }


            if(($ng->rtn_field_name == "advrt_newspaper_outward") || ($ng->rtn_field_name == "advrt_newspaper_file")){
                $html .= $this->genrateHeaderRow('वर्तमानपत्रातील जाहिरात (मूळप्रत)');
                if($ng->rtn_field_name == "advrt_newspaper_outward"){
                    $html .= $this->genrateInputRow('विवरण',$ng->id,$ng->rtn_field_reason);
                }
                if($ng->rtn_field_name == "advrt_newspaper_file"){
                    $html .= $this->genrateFileRow('दस्तऐवज / Document',$ng->id,$ng->rtn_field_reason);
                }
            }

            if(($ng->rtn_field_name == "interview_outward") || ($ng->rtn_field_name == "interview_file")){
                $html .= $this->genrateHeaderRow('मुलाखत');
                if($ng->rtn_field_name == "interview_outward"){
                    $html .= $this->genrateInputRow('विवरण',$ng->id,$ng->rtn_field_reason);
                }
                if($ng->rtn_field_name == "interview_file"){
                    $html .= $this->genrateFileRow('दस्तऐवज / Document',$ng->id,$ng->rtn_field_reason);
                }
            }
            
            

            if(($ng->rtn_field_name == "report_ng_principle_outward") || ($ng->rtn_field_name == "report_ng_principle_file")){
                $html .= $this->genrateHeaderRow('रुजू अहवाल विनाअनुदानित तत्त्वावरील');
                if($ng->rtn_field_name == "report_ng_principle_outward"){
                    $html .= $this->genrateInputRow('विवरण',$ng->id,$ng->rtn_field_reason);
                }
                if($ng->rtn_field_name == "report_ng_principle_file"){
                    $html .= $this->genrateFileRow('दस्तऐवज / Document',$ng->id,$ng->rtn_field_reason);
                }
            }
            
            
            if(($ng->rtn_field_name == "report_g_principle_outward") || ($ng->rtn_field_name == "report_g_principle_file")){
                $html .= $this->genrateHeaderRow('रुजू अहवाल अंशतः अनुदानित/अनुदानित तत्त्वावरील');
                if($ng->rtn_field_name == "report_g_principle_outward"){
                    $html .= $this->genrateInputRow('विवरण',$ng->id,$ng->rtn_field_reason);
                }
                if($ng->rtn_field_name == "report_g_principle_file"){
                    $html .= $this->genrateFileRow('दस्तऐवज / Document',$ng->id,$ng->rtn_field_reason);
                }
            }

            if(($ng->rtn_field_name == "self_financing_certificate_outward") || ($ng->rtn_field_name == "self_financing_certificate_file")){
                $html .= $this->genrateHeaderRow('बदली होणारा शिक्षक स्वयंअर्थसहाय्यित तत्त्वावर कार्यरत नव्हता याबाबत प्रमाणपत्र');
                if($ng->rtn_field_name == "self_financing_certificate_outward"){
                    $html .= $this->genrateInputRow('विवरण',$ng->id,$ng->rtn_field_reason);
                }
                if($ng->rtn_field_name == "self_financing_certificate_file"){
                    $html .= $this->genrateFileRow('दस्तऐवज / Document',$ng->id,$ng->rtn_field_reason);
                }
            }
            
            
            if(($ng->rtn_field_name == "transfer_not_higher_post_outward") || ($ng->rtn_field_name == "transfer_not_higher_post_file")){
                $html .= $this->genrateHeaderRow('बदली असमान पदावर झालेली नाही याबाबत प्रमाणपत्र');
                if($ng->rtn_field_name == "transfer_not_higher_post_outward"){
                    $html .= $this->genrateInputRow('विवरण',$ng->id,$ng->rtn_field_reason);
                }
                if($ng->rtn_field_name == "transfer_not_higher_post_file"){
                    $html .= $this->genrateFileRow('दस्तऐवज / Document',$ng->id,$ng->rtn_field_reason);
                }
            }

            if($ng->rtn_field_name == "salary_subsidy_guarantee_letter_file"){
                $html .= $this->genrateHeaderRow('महाराष्ट्र खासगी शाळा कर्मचारी (सेवा अटी) नियमावली 1981 मधील नियम 41(1)(3) नुसार वेतन अनुदानाबाबत हमीपत्र');
                $html .= $this->genrateFileRow('दस्तऐवज / Document',$ng->id,$ng->rtn_field_reason);
            }

            if(($ng->rtn_field_name == "itr1_file") || ($ng->rtn_field_name == "itr2_file") || ($ng->rtn_field_name == "itr3_file")){
                $html .= $this->genrateHeaderRow('आयकर विवरणपत्र');
                if($ng->rtn_field_name == "itr1_file"){
                    $html .= $this->genrateFileRow('Form-16. Year 1',$ng->id,$ng->rtn_field_reason);
                }
                if($ng->rtn_field_name == "itr2_file"){
                    $html .= $this->genrateFileRow('Form-16. Year 2',$ng->id,$ng->rtn_field_reason);
                }
                if($ng->rtn_field_name == "itr3_file"){
                    $html .= $this->genrateFileRow('Form-16. Year 3',$ng->id,$ng->rtn_field_reason);
                }
            }

            if(($ng->rtn_field_name == "bank_statement_date") || ($ng->rtn_field_name == "bank_statement_file")){
                $html .= $this->genrateHeaderRow('वेतन बँक स्टेटमेंट ( मागील ५ वर्षाचे)');
                if($ng->rtn_field_name == "bank_statement_date"){
                    $html .= $this->genrateTwoDatesRow('विवरण',$ng->id,$ng->rtn_field_reason);
                }
                if($ng->rtn_field_name == "bank_statement_file"){
                    $html .= $this->genrateFileRow('दस्तऐवज / Document',$ng->id,$ng->rtn_field_reason);
                }
            }
            
            if(($ng->rtn_field_name == "court_order_outward") || ($ng->rtn_field_name == "court_order_date") || ($ng->rtn_field_name == "court_order_file")){
                $html .= $this->genrateHeaderRow('या प्रकरणासंदर्भात कोणताही न्यायालयीन आदेश निर्गमित झाला आहे का?');
                if($ng->rtn_field_name == "court_order_outward"){
                    $html .= $this->genrateFileRow('याचिका क्रमांक',$ng->id,$ng->rtn_field_reason);
                }
                if($ng->rtn_field_name == "court_order_date"){
                    $html .= $this->genrateFileRow('दिनांक',$ng->id,$ng->rtn_field_reason);
                }
                if($ng->rtn_field_name == "court_order_file"){
                    $html .= $this->genrateFileRow('दस्तऐवज / Document',$ng->id,$ng->rtn_field_reason);
                }
            }
            
            
            
            
            
            if(($ng->rtn_field_name == "no_benefits_certificate_description") || ($ng->rtn_field_name == "no_benefits_certificate_file")){
                $html .= $this->genrateHeaderRow('विनाअनुदानित तत्त्वावरील रुजू दिनांकापासून इतर शासकीय लाभ घेतले नाहीत याबाबत प्रमाणपत्र');
                if($ng->rtn_field_name == "no_benefits_certificate_description"){
                    $html .= $this->genrateTwoDatesRow('विवरण',$ng->id,$ng->rtn_field_reason);
                }
                if($ng->rtn_field_name == "no_benefits_certificate_file"){
                    $html .= $this->genrateFileRow('दस्तऐवज / Document',$ng->id,$ng->rtn_field_reason);
                }
            }
            
            
            if($ng->rtn_field_name == "nps_scheme"){
                $html .= $this->genrateHeaderRow('NPS योजना बंधनकारक असल्याबाबत हमीपत्र');
                $html .= $this->genrateFileRow('दस्तऐवज / Document',$ng->id,$ng->rtn_field_reason);               
            }
            
            if($ng->rtn_field_name == "institution_guarantee_file"){
                $html .= $this->genrateHeaderRow('प्रस्तुत प्रस्तावातील कागदपत्रे खरी असल्याबाबत संस्थेचे हमीपत्र (प्रपत्र-2)');
                $html .= $this->genrateFileRow('दस्तऐवज / Document',$ng->id,$ng->rtn_field_reason);               
            }
            
            if($ng->rtn_field_name == "institution_no_disbute_file"){
                $html .= $this->genrateHeaderRow('संस्थेमध्ये वाद नसल्याबाबत हमीपत्र');
                $html .= $this->genrateFileRow('दस्तऐवज / Document',$ng->id,$ng->rtn_field_reason);               
            }

            if($ng->rtn_field_name == "overall_remark"){
                $html .= $this->genrateHeaderRow('अधिकाऱ्यांचे एकत्रित निरीक्षण');
                $html .= $this->genrateTextWithoutLabelRow($ng->id,$ng->rtn_field_reason);               
            }
        }
       
        
        

        
        
        $html .= '</tbody></table></div>
                    <div class="card-footer text-end">                        
                        <button type="button" onclick="submitReturnApplication()" class="btn btn-success">
                            अर्ज पुढील स्तरावर पाठवा
                        </button>
                    </div>
                </div>
            </div>
        </form>';
       

                

         
        


            /* echo "<pre>";
        print_r($ng2g);
        exit;*/

            
               
        $response = [
                'success' => true,
                'status' => 200,
                'timestamp' => time(),
                'data' =>$ng2g,
                'html' => $html
            ];
          
         return $this->response
            ->withType('application/json')
            ->withStatus(200)
            ->withStringBody(json_encode($response));      
       

        

    }

    private function genrateHeaderRow($heding){
        return '<tr>
                    <td class="field-name" colspan="3" style="color:#ffffff;background:#3498db;">'.$heding.'</td></tr>';
    }
    private function genrateInputRow($heding,$fid,$remark){
        return '<tr>
                    <td class="field-name">'.$heding.'</td>
                    <td class="field-name">'.$remark.'</td>
                    <td style="border:3px dotted red;">
                        <input type="text" required
                            class="form-control form-control-sm"
                            name="input_'.$fid.'"
                            id="input_'.$fid.'">                                      
                    </td>
                </tr>';
    }
    private function genrateDateRow($heding,$fid,$remark){
        return '<tr>
                    <td class="field-name">'.$heding.'</td>
                    <td class="field-name">'.$remark.'</td>
                    <td style="border:3px dotted red;">
                        <input type="date" required
                            class="form-control form-control-sm"
                            name="date_'.$fid.'"
                            id="date_'.$fid.'">                                      
                    </td>
                </tr>';
    }

    private function genrateTwoDatesRow($heding,$fid,$remark){
        return '<tr>
                    <td class="field-name">'.$heding.'</td>
                    <td class="field-name">'.$remark.'</td>
                    <td style="border:3px dotted red;">
                        From: <input type="date" required
                            class="form-control form-control-sm"
                            name="sdate_'.$fid.'"
                            id="sdate_'.$fid.'"> 
                            - 
                        To: <input type="date" required
                            class="form-control form-control-sm"
                            name="edate_'.$fid.'"
                            id="edate_'.$fid.'">                                       
                    </td>
                </tr>';
    }


    
    private function genrateTextRow($heding,$fid,$remark){
        return '<tr>
                    <td class="field-name">'.$heding.'</td>
                    <td class="field-name">'.$remark.'</td>
                    <td style="border:3px dotted red;">
                        <textarea rows="3" required
                            class="form-control form-control-sm"
                            name="text_'.$fid.'"
                            id="text_'.$fid.'"
                            accept=".pdf"> </textarea>                                    
                    </td>
                </tr>';

    }
    private function genrateTextWithoutLabelRow($fid,$remark){
        return '<tr>
                    <td class="field-name align-top" colspan="2">'.$remark.'</td>
                    <td style="border:3px dotted red;">
                        <textarea rows="3" required
                            class="form-control form-control-sm"
                            name="text_'.$fid.'"
                            id="text_'.$fid.'"
                            accept=".pdf"> </textarea>                                    
                    </td>
                </tr>';

    }

    private function genrateFileRow($heding,$fid,$remark){
        return '<tr>
                    <td class="field-name">'.$heding.'</td>
                    <td class="field-name">'.$remark.'</td>
                    <td style="border:3px dotted red;">
                        <input type="file" required
                            class="form-control form-control-sm"
                            name="document_'.$fid.'"
                            id="document_'.$fid.'"
                            accept=".pdf">                                      
                    </td>
                </tr>';

    }

    
    
    private function reviewFile($data){

        if(isset($this->formFields[$data['field']])){
            $fname = $this->formFields[$data['field']];
        }else{
            $fname = ucwords(str_replace('_', ' ', $data['field']));
        }
        $fid = $data['id'];
        return '<tr>
                    <td class="text-center">                        
                        <div class="btn-group w-100" role="group">
                            <input type="radio" class="btn-check" name="verification_status['.$fid.']" id="correct_verifications_'.$fid.'" value="correct" autocomplete="off" required>
                            <label class="btn btn-outline-success" for="correct_verifications_'.$fid.'" >
                                ✔ योग्य
                            </label>
                            <input type="radio" class="btn-check" name="verification_status['.$fid.']" id="wrong_verifications_'.$fid.'" value="wrong" autocomplete="off">
                            <label class="btn btn-outline-danger" for="wrong_verifications_'.$fid.'">
                                ✖ अयोग्य
                            </label>
                        </div>
                    </td>
                    <td class="field-name">'.$fname.'</td>
                    <td class="field-name">'. h($data['reason']) .'</td>
                    <td>
                        <a class="viewBtn" href="'.
                            h($data['reply']).
                            '" target="_blank">
                            <i class="fa fa-eye"></i> View 
                        </a>
                    </td>
                </tr>';
    }

    
    private function reviewText($data){

        if(isset($this->formFields[$data['field']])){
            $fname = $this->formFields[$data['field']];
        }else{
            $fname = ucwords(str_replace('_', ' ', $data['field']));
        }
        $fid = $data['id'];
        return '<tr>
                    <td class="text-center">                        
                        <div class="btn-group w-100" role="group">
                            <input type="radio" class="btn-check" name="verification_status['.$fid.']" id="correct_verifications_'.$fid.'" value="correct" autocomplete="off" required>
                            <label class="btn btn-outline-success" for="correct_verifications_'.$fid.'" >
                                ✔ योग्य
                            </label>
                            <input type="radio" class="btn-check" name="verification_status['.$fid.']" id="wrong_verifications_'.$fid.'" value="wrong" autocomplete="off">
                            <label class="btn btn-outline-danger" for="wrong_verifications_'.$fid.'">
                                ✖ अयोग्य
                            </label>
                        </div>
                    </td>
                    <td class="field-name">'.$fname.'</td>
                    <td class="field-name">'. h($data['reason']) .'</td>
                    <td class="field-name">'. h($data['reply']) .'</td>                    
                </tr>';
    }

    private function reviewPendingField($data){

        if(isset($this->formFields[$data['field']])){
            $fname = $this->formFields[$data['field']];
        }else{
            $fname = ucwords(str_replace('_', ' ', $data['field']));
        }
        $fid = $data['id'];
        return '<tr>
                    <td class="text-center">                        
                        <div class="btn-group w-100" role="group">
                            <input type="radio" class="btn-check" name="verification_status['.$fid.']" id="correct_verifications_'.$fid.'" value="correct" autocomplete="off" required>
                            <label class="btn btn-outline-success" for="correct_verifications_'.$fid.'" >
                                ✔ योग्य
                            </label>
                            <input type="radio" class="btn-check" name="verification_status['.$fid.']" id="wrong_verifications_'.$fid.'" value="wrong" autocomplete="off">
                            <label class="btn btn-outline-danger" for="wrong_verifications_'.$fid.'">
                                ✖ अयोग्य
                            </label>
                        </div>
                    </td>
                    <td class="field-name">'.$fname.'</td>
                    <td class="field-name">'. h($data['reason']) .'</td>
                    <td class="field-name">त्रुटींची पूर्तता प्रलंबित</td>                    
                </tr>';
    }




  }




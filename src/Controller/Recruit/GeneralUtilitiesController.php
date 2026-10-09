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

//App\Controller\stdClass


class GeneralUtilitiesController extends AppController
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
            'getAdvertisementVacancies',
            'returnApplicationForm',
            'returnApplicationSubmission',
            'replyToReturnApplication',
            'replyToReturnApplicationSubmission',
            'getStaffonBoardingHistory',
            'rejectApplicationForm'
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
             
        $this->set('user', $user);
        $event->setResult(false); // Correct way to set a result or stop the flow
    	return; // Do not return a value
    }

    
    
    public function getAdvertisementVacancies()
    {
        $this->request->allowMethod(['post', 'ajax']);
        $data = $this->request->getData();
        $postAdvertisementId = $data['post_id'];
        
        $ng2g = $this->fetchTable('PostAdvertisement')
                     ->getAdvertisementDetails($postAdvertisementId);   
        
       $approvalLetterUrl = null;
       if ($ng2g && !empty($ng2g->approval_letter)) {
           $storage = new EsdlStorageService();
           $approvalLetterUrl = $storage->signedUrl($ng2g->approval_letter);
       }
                    
        $resolutionfile = null;
         if ($ng2g && !empty($ng2g->resolutionfile)) {
              $storage = new EsdlStorageService();
              $resolutionfile = $storage->signedUrl($ng2g->resolutionfile);    
        }
        
        $period2324file = null;
         if ($ng2g && !empty($ng2g->period2324_file)) {
              $storage = new EsdlStorageService();
              $period2324file = $storage->signedUrl($ng2g->period2324_file);    
        }
         $periodfile = null;
         if ($ng2g && !empty($ng2g->period_file)) {
              $storage = new EsdlStorageService();
              $periodfile = $storage->signedUrl($ng2g->period_file);    
        }

        $cadetailsfile = null;
         if ($ng2g && !empty($ng2g->cadetails_file)) {
              $storage = new EsdlStorageService();
              $cadetailsfile = $storage->signedUrl($ng2g->cadetails_file);    
        }

       $sanchManyataUrls = [];
       if ($ng2g && !empty($ng2g->sanch_manyata)) {
           $storedFiles = json_decode($ng2g->sanch_manyata, true);
           if (!is_array($storedFiles)) {
               $storedFiles = ['document' => $ng2g->sanch_manyata];
           }

           $storage = new EsdlStorageService();
           foreach ($storedFiles as $udiseCode => $storedFile) {
               if (!empty($storedFile)) {
                   $sanchManyataUrls[(string)$udiseCode] =
                       $storage->signedUrl($storedFile);
               }
           }
       }
       
       $smDetails = [];
       if ($ng2g && !empty($ng2g->sm_details)) {
           $storedSmDetails = json_decode($ng2g->sm_details, true);
           if (is_array($storedSmDetails)) {
               $storage = new EsdlStorageService();
               foreach ($storedSmDetails as $udiseCode => $details) {
                   if (!is_array($details)) {
                       continue;
                   }

                   $smDetails[(string)$udiseCode] = [
                       'smdetails' => (string)($details['smdetails'] ?? ''),
                       'fileUrl' => !empty($details['file'])
                           ? $storage->signedUrl($details['file'])
                           : null,
                   ];
               }
           }
       }

       
        $sansthaTable = $this->fetchTable('Sansthas');
        $sansthaRecord = $sansthaTable->find()
                    ->where(['code' => $ng2g['institution_code']])
                    ->first();

        $minority_status =  (($sansthaRecord['minority_sanstha'] == 2) || ($sansthaRecord['minority_sanstha'] == 3)) ? '<span class="badge rounded-pill bg-success">Minority Sanstha ('.$sansthaRecord['sanstha_minority_name'].')</span>' : '<span class="badge rounded-pill bg-warning text-dark">Non-Minority Sanstha</span>';        
       
        
        $vacancyData = $this->fetchTable('PostAdvertisementVacancies')
                    ->getVacanciesByAdvertisement($postAdvertisementId);

         $html = '';   
         $i = 1;
         foreach($vacancyData as $dataVal){
            $html .= ' <tr> <td>'.$i.'</td>
                                <td>'.$dataVal['school_name'].'</td>
                                <td>'.$dataVal['school_udise_code'].' </td>                                    
                                <td> '.$dataVal['post_name'].'</td>
                                <td> '.$dataVal['category'].'</td>
                                <td> '.$dataVal['pay_scale'].'</td>
                            </tr>';
             $i++;               
         }    

         $periodDiv = '<h6>आपले सदस्य पद सन २०२३-२४ च्या संयमान्यतेनुसार आहे किंवा त्यापूर्वीचे पायाभूत आहे.</h6>';
         if ($ng2g && !empty($ng2g->period)) {
            $periodDiv .= '<div class="col-md-6"> ' . h($ng2g->period==1 ? 'पायाभूत' : '') . '</div>';
        }
        if ($ng2g && !empty($ng2g->period2324)) {
            $periodDiv .= '<div class="col-md-6"> ' . h($ng2g->period2324==1 ? 'आकृतिबंधाच्या मर्यादित  २०२३-२४ च्या नंतरचे असल्यास, संचालित शासन मान्यता घेतली आहे का : होय' : 'नाही') . '</div>';
        }
        if ($ng2g && !empty($periodfile)) {
            $periodDiv .= '<div class="col-md-6"><strong>पायाभूत दस्तऐवज:</strong> <a href="' . h($periodfile) . '" target="_blank">View Document</a></div>';
        }
        if ($ng2g && !empty($period2324file)) {
            $periodDiv .= '<div class="col-md-6"><strong>सन २०२३-२४ च्या नंतरचे दस्तऐवज:</strong> <a href="' . h($period2324file) . '" target="_blank">View Document</a></div>';
        }

        $cadetailsDiv = '<br/><h6>अनुकंपा माहिती</h6>';
        if ($ng2g && !empty($cadetailsfile)) {  
            $cadetailsDiv .= '<div class="col-md-6"><strong>अनुकंपा माहिती: ' . h($ng2g->cadetails==1 ? 'होय' : 'नाही') . '</strong> <br/><a href="' . h($cadetailsfile) . '" target="_blank">View Document</a></div>';
        }

         $htmlVacancyDiv = $this->generateVacancyTable($vacancyData->toArray(), $periodDiv);

         $auditTable = $this->fetchTable('PostAdvertisementAuditLogs');

        $auditLogs = $auditTable->find()
            ->where([
                'post_advertisement_id' => $postAdvertisementId
            ])
            ->order([
                'created_at' => 'DESC'
            ])
            ->toArray();

        $audithtml = $this->generateAuditTableRows($auditLogs);        
     
        $audithtmlHistory = $this->generateAuditHistoryHtml($auditLogs);

        $sansthaRecordDiv = $this->generateSansthaRecordHtml(
            $ng2g->toArray(),
            $minority_status
        );

        return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'success' => true,
                    'data' => [
                        'ng2g'=>$ng2g,
                        'vancancyData'=>$vacancyData,
                        'sanchManyataUrls' => $sanchManyataUrls,
                        'approvalLetterUrl' => $approvalLetterUrl,
                        'resolutionFileUrl' => $resolutionfile,
                        'auditLogsHistory' => $audithtmlHistory,
                        'sansthaRecordDiv' => $sansthaRecordDiv,
                        'htmlVacancyDiv' => $htmlVacancyDiv,
                        'periodDivShow' => $periodDiv,
                        'cadetailsDivShow' => $cadetailsDiv,
                        'smDetails' => $smDetails,
                        'minority_sanstha' => $sansthaRecord['minority_sanstha'] ?? null,
                     ],
                    'html'=> $html,
                    'audithtml'=>$audithtml,
                    'minority_status'=> $minority_status,
                    'message' => 'Application forwarded successfully'
                ]));


    }



private function generateAuditTableRows(iterable $auditLogs): string
{
    $html = '';
    $j = 1;

    if (!empty($auditLogs)) {

        foreach ($auditLogs as $log) {

            $createdAt      = h($log->created_at ?? '');
            $userName       = h($log->user_name ?? '');
            $previousStatus = h($log->previous_status ?? '');
            $newStatus      = h($log->new_status ?? '');
            $remarks        = h($log->remarks ?? '');

            $ipAddress = ($log->ip_address ?? '') === '::1'
                ? '127.0.0.1'
                : ($log->ip_address ?? '');

            $ipAddress = h($ipAddress);

            $actionBadge = $this->getAuditActionBadge(
                $log->action ?? ''
            );

            $html .= '
                <tr>
                    <td>' . $j . '</td>
                    <td>' . $createdAt . '</td>
                    <td>' . $userName . '</td>
                    <td> ' .$actionBadge . '</td>
                    <td>' . $previousStatus . '</td>
                    <td>' . $newStatus . '</td>
                    <td>' . $remarks . '</td>
                    <td>' . $ipAddress . '</td>
                </tr>
            ';

            $j++;
        }

    } else {

        $html .= '
            <tr>
                <td
                    colspan="8"
                    class="text-center text-muted"
                >
                    No audit history found.
                </td>
            </tr>
        ';
    }

    return $html;
}
    
private function generateAuditHistoryHtml(iterable $auditLogs): string
{
    $html = '';
    $k = 0;

    if (!empty($auditLogs)) {
        foreach ($auditLogs as $log) {

            // Alternate timeline position
            $position = ($k % 2 !== 0) ? 'left' : 'right';

            // Convert localhost IPv6 to IPv4
            $ip = ($log->ip_address === '::1')
                ? '127.0.0.1'
                : $log->ip_address;

            $createdAt     = h($log->created_at ?? '');
            $userName      = h($log->user_name ?? '');
            $action        = h($log->action ?? '');
            $previousStatus = h($log->previous_status ?? '');
            $newStatus     = h($log->new_status ?? '');
            $remarks       = h($log->remarks ?? '');
            $ipAddress     = h($ip);

            $html .= '
                <div class="timeline ' . $position . '">
                    <div class="card">
                        <div class="card-body p-4">

                            <h3>' . $createdAt . '</h3>

                            <p class="mb-0">
                                ' . $userName . ' posted a ' . $action . ' update
                            </p>

                            <p class="mb-0">
                                Old status: ' . $previousStatus . '
                                changed to New status: ' . $newStatus . '
                            </p>

                            <p class="mb-0">
                                ' . $remarks . '
                            </p>

                            <p class="mb-0">
                                ' . $ipAddress . '
                            </p>

                        </div>
                    </div>
                </div>
            ';

            $k++;
        }
    } else {

        $html .= '
            <div class="timeline right">
                <div class="card">
                    <div class="card-body p-4">
                        <h3 class="text-center">
                            No audit history found.
                        </h3>
                    </div>
                </div>
            </div>
        ';
    }

    return $html;
}



private function generateSansthaRecordHtml(
    array $ng2g,
    string $minorityStatus = ''
): string {
    
    $institutionCode = h($ng2g['institution_code'] ?? '');
    $institutionName = h($ng2g['institution_name'] ?? '');

    return '
        <div class="section">

            <input
                type="hidden"
                id="appointmentDate"
                name="appointmentDate"
                class="form-control"
            >

            <div class="row mb-2">

                <div class="col-md-3">
                    <label
                        for="institutionCode"
                        class="form-label marathi-label"
                    >
                        संस्था कोड
                        <span class="english-label">
                            (Institution Code)
                        </span>
                        &rarr;

                        <span class="txtval">
                            ' . $institutionCode . '
                        </span>
                    </label>
                </div>

                <div class="col-md-6">
                    <label
                        for="institutionName"
                        class="form-label marathi-label"
                    >
                        संस्थेचे नाव
                        <span class="english-label">
                            (Institution Name)
                        </span>
                        &rarr;

                        <span class="txtval">
                            ' . $institutionName . '
                        </span>
                    </label>
                </div>

                <div class="col-md-3">
                    ' . $minorityStatus . '
                </div>
                

            </div>
        </div>
    ';
}


private function generateVacancyTable(array $vacancyData, string $periodDiv): string
{
    $html = '
        <div style="background: #fff; padding: 10px;">
            <table id="staffTable" class="table table-bordered table-striped table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>अनु. क्र.</th>
                        <th>शाळेचे नाव</th>
                        <th>UDISE Code</th>
                        <th>पदाचे नाव</th>
                        <th>श्रेणी</th>
                        <th>वेतनश्रेणी</th>
                    </tr>
                </thead>
                <tbody>
    ';

    $i = 1;

    foreach ($vacancyData as $dataVal) {
        $schoolName = h($dataVal['school_name'] ?? '');
        $udiseCode  = h($dataVal['school_udise_code'] ?? '');
        $postName   = h($dataVal['post_name'] ?? '');
        $category   = h($dataVal['category'] ?? '');
        $payScale   = h($dataVal['pay_scale'] ?? '');

        $html .= '
            <tr>
                <td>' . $i . '</td>
                <td>' . $schoolName . '</td>
                <td>' . $udiseCode . '</td>
                <td>' . $postName . '</td>
                <td>' . $category . '</td>
                <td>' . $payScale . '</td>
            </tr>
        ';

        $i++;
    }

    $html .= '
                </tbody>
            </table>
        </div>
         <div class="pdf-field">
            <div id="periodDivShow">' . $periodDiv . '</div>           
         </div>
    ';

    return $html;
}


    function getAuditActionBadge(?string $action): string
        {
            $badgeClass = 'bg-secondary';
            $text = $action ?? '-';

            switch ($action) {

                case 'created':
                    $badgeClass = 'bg-secondary';
                    $text = 'Created';
                    break;

                case 'submitted':
                    $badgeClass = 'bg-primary';
                    $text = 'Submitted';
                    break;

                case 'viewed':
                    $badgeClass = 'bg-info';
                    $text = 'Viewed';
                    break;

                case 'approved':
                    $badgeClass = 'bg-success';
                    $text = 'Approved';
                    break;

                case 'rejected':
                    $badgeClass = 'bg-danger';
                    $text = 'Rejected';
                    break;

                case 'correction':
                case 'send_back_correction':
                    $badgeClass = 'bg-warning text-dark';
                    $text = 'Send Back for Correction';
                    break;

                case 'clarification':
                case 'request_clarification':
                    $badgeClass = 'bg-info';
                    $text = 'Request Clarification';
                    break;

                case 'resubmitted':
                    $badgeClass = 'bg-primary';
                    $text = 'Resubmitted';
                    break;
            }

            return '<span class="badge ' . $badgeClass . '">'
                . h($text)
                . '</span>';
        }


        
public function getStaffOnboardingDetails()
    {
        $this->request->allowMethod(['get', 'ajax']);
        $this->Authorization->skipAuthorization();
        

        $staffId = $this->request->getQuery('staff_id');
        if ($staffId === null || $staffId === '' || !is_numeric($staffId)) {
            $staffId = $this->request->getData('staff_id');
        }

        if ($staffId === null || $staffId === '' || !is_numeric($staffId)) {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'success' => false,
                    'message' => 'Missing or invalid staff id',
                    'data' => []
                ]));
        }

        $appointmentsTable = $this->fetchTable('StaffOnboardingAppointments');

        $appointment = $appointmentsTable->find()
            ->contain(['StaffOnboardingDocuments'])
            ->where(['staff_id' => (int)$staffId])
            ->order(['StaffOnboardingAppointments.id' => 'DESC'])
            ->first();

         $vacancyData = $this->fetchTable('PostAdvertisementVacancies')
                        ->find()
                        ->where(['id' => (int)$staffId])
                        ->first();

         $ng2g = $this->fetchTable('PostAdvertisement')
                     ->getAdvertisementDetails($vacancyData->post_advertisement_id);                
        
        $sansthaTable = $this->fetchTable('Sansthas');
        $sansthaRecord = $sansthaTable->find()
                    ->where(['code' => $ng2g['institution_code']])
                    ->first();

        $minority_status =  (($sansthaRecord['minority_sanstha'] == 2) || ($sansthaRecord['minority_sanstha'] == 3)) ? '<span class="badge rounded-pill bg-success">Minority Sanstha ('.$sansthaRecord['sanstha_minority_name'].')</span>' : '<span class="badge rounded-pill bg-warning text-dark">Non-Minority Sanstha</span>';        
                    

        if (!$appointment) {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'success' => false,
                    'message' => 'No onboarding record found',
                    'data' => []
                ]));
        }

        $appointmentData = $appointment->toArray();
        $appointmentData['documents'] = $appointment->staff_onboarding_documents ?? [];
        $appointmentData['vacancyData'] = $vacancyData ?? [];
        $appointmentData['ng2g'] = $ng2g ?? [];
        $appointmentData['minority_status'] = $minority_status ?? '';
        $appointmentData['minority_sanstha'] = $sansthaRecord['minority_sanstha'] ?? '';
        $htmlbody = $this->staffonboardinghtmlbody($appointmentData);
        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode([
                'success' => true,
                'data' => $appointmentData,
                'htmlbody' => $htmlbody
            ]));
    }


    public function staffonboardinghtmlbody($appointmentData){

        
        $casteCategoriesTable = TableRegistry::getTableLocator()->get('CasteCategories');

        // Get Original Category
        $originalCategory = null;
        if (!empty($appointmentData['original_category'])) {
            $originalCategory = $casteCategoriesTable->find()
                ->where(['code' => $appointmentData['original_category']])
                ->first();
        }

        $originalCategoryName = $originalCategory ? $originalCategory->category_name: '-';

        $appointmentCategory = null;
        if (!empty($appointmentData['appointment_category'])) {
            $appointmentCategory = $casteCategoriesTable->find()
                ->where(['code' => $appointmentData['appointment_category']])
                ->first();
        }

        $appointmentCategoryName = $appointmentCategory ? $appointmentCategory->category_name: '-';

       $horizontalCategoriesTable = TableRegistry::getTableLocator()->get('HorizontalCategories');

        // Get Horizontal Category
        $horizontalCategory = null;
        if (!empty($appointmentData['horizontal_category'])) {
            $horizontalCategory = $horizontalCategoriesTable->find()
                ->where(['code' => $appointmentData['horizontal_category']])
                ->first();
        }

        $horizontalCategoryName = $horizontalCategory? $horizontalCategory->name : '-';
        

        $payScaleTable = TableRegistry::getTableLocator()->get('PayScales');

        // Get pay scale
        $payScale = null;
        if ($appointmentData['pay_scale'] !== null && $appointmentData['pay_scale'] !== '') {
            $payScale = $payScaleTable->find()
                ->where([
                    'id' => $appointmentData['pay_scale']
                ])
                ->first();
        }

        $payScaleName = ($appointmentData['pay_scale']!=null)? $appointmentData['pay_scale'] : '-';

        $html ='<div class="row mb-3">
                         <div class="col-md-3">
                            <label for="candidateName " class="form-label marathi-label ">मुख्याध्यापक नाव 
                             <span class="txtval">'.$appointmentData['headmastername'].'</span></label> 
                        </div>
                        <div class="col-md-3">
                            <label for="panNumber" class="form-label marathi-label ">ई-मेल 
                             <span class="txtval">'.$appointmentData['heademail'].'</span></label> 
                           
                        </div>
                        <div class="col-md-3">
                            <label for="aadharNumber" class="form-label marathi-label ">मोबाईल क्रमांक
                             <span class="txtval">'.$appointmentData['headmobilenumber'].'</span></label>                             
                        </div>
                      
                    </div>';
        $html .='<div class="row mb-3">
                         <div class="col-md-3">
                            <label for="candidateName " class="form-label marathi-label ">उमेदवाराचे नाव 
                             <span class="txtval">'.$appointmentData['candidate_name'].'</span></label> 
                        </div>
                        <div class="col-md-3">
                            <label for="gender" class="form-label marathi-label ">लिंग
                             <span class="txtval">'.$appointmentData['gender'].'</span></label>                            
                        </div>
                        <div class="col-md-3">
                            <label for="dob_date" class="form-label marathi-label ">जन्मतारीख
                             <span class="txtval">'.$appointmentData['dob_date'].'</span></label>                             
                        </div>
                      
                    </div>';             
        $html .='<div class="row mb-3">
                         <div class="col-md-3">
                            <label for="candidateemail " class="form-label marathi-label ">ई-मेल 
                             <span class="txtval">'.$appointmentData['candidateemail'].'</span></label> 
                        </div>
                          <div class="col-md-3">
                            <label for="candidatemobile " class="form-label marathi-label ">मोबाईल क्रमांक 
                             <span class="txtval">'.$appointmentData['candidatemobile'].'</span></label> 
                        </div>
                        <div class="col-md-3">
                            <label for="panNumber" class="form-label marathi-label ">पॅन क्रमांक <span class="english-label">(PAN)</span> 
                             <span class="txtval">'.$appointmentData['pan_number'].'</span></label>                            
                        </div>
                        <div class="col-md-3">
                            <label for="aadharNumber" class="form-label marathi-label ">आधार क्रमांक <span class="english-label">(Aadhar)</span>
                             <span class="txtval">'.$appointmentData['aadhar_number'].'</span></label>                             
                        </div>
                      
                    </div>';

        $html .= '<div class="row mb-3" id="casteCategoryBox_onboard">';
        $html .= ' <div class="col-md-4">
                            <label for="originalCategory_onboard" class="form-label marathi-label">मूळ आरक्षण प्रवर्ग <span class="english-label">(Original)</span></label>
                           <span class="txtval">'.$originalCategoryName.'</span>
                        </div>
                         <div class="col-md-4">
                           <label for="appointmentCategory_onboard" class="form-label marathi-label">समांतर आरक्षण प्रवर्ग <span class="english-label">(Horizontal)</span></label>
                             <span class="txtval">'.$horizontalCategoryName.'</span>
                        </div>
                        <div class="col-md-4">
                            <label for="horizontalcertificateFile_onboard" class="form-label marathi-label ">लागू असल्यास प्रमाणपत्र अपलोड करा</label>
                              <span class="txtval">'.$this->getdocumentFileLink($appointmentData['staff_onboarding_documents'],'horizontalcertificate').'</span>
                        </div>';

        
        if (!in_array((int)$appointmentData["minority_sanstha"], [2, 3], true)){

         $html .= ' <div class="col-md-4">
                          <label for="appointmentCategory_onboard" class="form-label marathi-label required-field">नियुक्तीचा आरक्षण प्रवर्ग <span class="english-label">(Appointment)</span></label>
                             <span class="txtval">'.$appointmentCategoryName.'</span>
                        </div>
                        <div class="col-md-4">
                            <label for="castecertificateFile_onboard" class="form-label marathi-label ">जात प्रमाणपत्र अपलोड करा</label>
                             <span class="txtval">'.$this->getdocumentFileLink($appointmentData['staff_onboarding_documents'],'castecertificate').' </span>
                        </div>
                        <div class="col-md-4">
                            <label for="validcastecertificateFile_onboard" class="form-label marathi-label ">वैध जात प्रमाणपत्र अपलोड करा</label>
                            <span class="txtval">'.$this->getdocumentFileLink($appointmentData['staff_onboarding_documents'],'validcastecertificate').' </span>
                        </div>';  
       

        }    
                 
        $html .= ' <div class="col-md-4">
                          <label for="pay_scale_onboard" class="form-label marathi-label">वेतनश्रेणी  <span class="english-label">(Pay Scale)</span></label>
                              <span class="txtval">'.$payScaleName.'</span>
                        </div>
                     ';                                   

        $html .= '</div>';     
        
        $html .=' <div class="pdf-field">
                        <h3 class="section-title">शैक्षणिक व व्यावसायिक अर्हता. <small style="font-size:10px;">संबंधित शिक्षकाची शैक्षणिक व व्यावसायिक अर्हता प्रमाणपत्रे • शासन निर्णय दिनांक 25.02.2019 नुसार.</small></h3>
                        <div class="row">
                            <div class="col-md-3 ">
                                <label for="sscFile" class="form-label marathi-label">
                                     माध्यमिक <span class="english-label">(SSC)</span>
                                </label>
                                <div class="col-md-3">
                                '.$this->getdocumentFileLink($appointmentData['staff_onboarding_documents'],'ssc').'
                            </div>      
                            </div>    
                            <div class="col-md-3">
                                <label for="hscFile" class="form-label marathi-label">
                                    उच्च माध्यमिक <span class="english-label">(HSC)</span>
                                </label>
                                <div class="col-md-3">
                                '.$this->getdocumentFileLink($appointmentData['staff_onboarding_documents'],'hsc').'
                            </div>      
                            </div>                     
                            <div class="col-md-3">
                                <label for="graduateFile" class="form-label marathi-label">
                                    पदवी <span class="english-label">(Graduate Degree)</span>
                                </label>
                                <div class="col-md-3">
                                '.$appointmentData['graduate_degree'].'<br>
                               '.$this->getdocumentFileLink($appointmentData['staff_onboarding_documents'],'graduate').'
                            </div>      
                            </div>
                                <div class="col-md-3">
                                <label for="postGraduateFile" class="form-label marathi-label">
                                    पदव्युत्तर पदवी  <span class="english-label">(Post Graduate Degree)</span>
                                </label>
                               <div class="col-md-3" >
                                '.$appointmentData['post_graduate_degree'].'<br>
                                '.$this->getdocumentFileLink($appointmentData['staff_onboarding_documents'],'post_graduate').'
                            </div>      
                            </div>     
                                
                        </div>
                        <hr/>                        
                    </div> ';

        $html .= '   <div class="pdf-field">
                        <h3 class="section-title">जाहिरातीचा तपशील.</h3>
                        <div class="row mt-1">
                            <div class="col-md-3 mt-2">
                                <label for="advApprovelFile" class="form-label english-label ">
                                     जाहिरात मंजूरी पत्र 
                                </label>                                
                            </div>    
                            <div class="col-md-3" >
                               '.$this->getdocumentFileLink($appointmentData['staff_onboarding_documents'],'adv_approval').'
                            </div>      
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-3 mt-2">
                                <label for="advertisementFile" class="form-label english-label">
                                   जाहिरात
                                </label>                                    
                            </div>     
                            <div class="col-md-3">
                               '.$this->getdocumentFileLink($appointmentData['staff_onboarding_documents'],'advertisement').'
                            </div>   
                        </div>
                        <hr/>                        
                    </div> ';            
        
        $html .=' <div class="pdf-field">
                        <h3 class="section-title">निवड प्रक्रिया</h3>
                        <div class="row mt-2">
                            <div class="col-md-2 mt-2">
                                <label for="signatureFile" class="form-label english-label">
                                     उमेदवारांच्या स्वाक्षरीची यादी
                                </label>                                
                            </div>    
                            <div class="col-md-3" >
                                '.$this->getdocumentFileLink($appointmentData['staff_onboarding_documents'],'signature').'
                           
                                
                            </div>      
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-2 mt-2">
                                <label for="markingFile" class="form-label english-label">
                                  उमेदवार गुणांकन
                                </label>                                    
                            </div>     
                            <div class="col-md-3" >
                                '.$this->getdocumentFileLink($appointmentData['staff_onboarding_documents'],'marking').'
                           
                                
                            </div>   
                        </div>
                          <div class="row mt-3">
                            <div class="col-md-2 mt-2">
                                <label for="resolutionFile" class="form-label english-label ">
                                  संस्थेचा ठराव
                                </label>                                    
                            </div>     
                            <div class="col-md-3" >
                                '.$this->getdocumentFileLink($appointmentData['staff_onboarding_documents'],'resolution').'
                           

                            </div>   
                        </div>

                          <div class="row mt-3">
                            <div class="col-md-2 mt-2">
                                <label for="orderFile" class="form-label english-label">
                                  आदेश
                                </label>                                    
                            </div>     
                            <div class="col-md-3" >
                                '.$this->getdocumentFileLink($appointmentData['staff_onboarding_documents'],'order').'
                           
                            </div>   
                        </div>

                        <hr/>                        
                    </div>';  

        if (!in_array((int)$appointmentData["minority_sanstha"], [2, 3], true)){
                    $rosterValue = ($appointmentData['roster']==true)?'Yes':'No';
                     $html .='<div class="pdf-field">
                        <h3 class="section-title">रोस्टर (Roster)</h3>

                        <div class="card">
                        <label class="checkbox-label">
                        <label class="checkbox-label">
                            या संस्थेमध्ये एकच शिक्षकेतर पद आहे का?   &rarr;
                            </label>
                           <div>
                            '.$rosterValue.'<br>
                            </div>
                        
                        </label>
                        
                        <div class="">                        
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div >
                                         '.$this->getdocumentFileLink($appointmentData['staff_onboarding_documents'],'court_order').'
                                    </div>
                                </div>
                            </div>                    
                        </div>
                    </div>';

          
            $court_order = ($appointmentData['court_order']==true)?'Yes':'No';

            $html .='<div class="card">
                        <label class="checkbox-label">
                        <label class="checkbox-label">
                            या प्रकरणासंदर्भात कोणताही न्यायालयीन आदेश निर्गमित झाला आहे का?  &rarr;
                            </label>
                            <div >'.$court_order.'
                                       
                                    </div>
                        
                        </label>';
                  if(($appointmentData['court_order']===true)) {    
                   $html .='   <div  class="">                        
                            <div class="row mb-3">     
                                <div class="col-md-3"><lavel>याचिका क्रमांक</lavel>                            
                                        '.h($appointmentData['court_order_petition_number']).'
                               </div>  
                                <div class="col-md-3"> <lavel>याचिका तारीख</lavel>                                    
                                         '.h($appointmentData['court_order_date']).'
                                </div>                
                                <div class="col-md-6">
                                    <div >
                                       '.$this->getdocumentFileLink($appointmentData['staff_onboarding_documents'],'order').'
                                    </div>
                                </div>
                            </div>                    
                        </div>';
                    } 
                  $html .='  </div>';          

        }
                   

        return $html;
    }


 public function getdocumentFileLink($staff_onboarding_documents, $document_type)
    {
        foreach ($staff_onboarding_documents as $document) {

            if ($document['document_type'] == $document_type) {

                $imageUrl = Router::url(
                    '/' . ltrim($document['file_path'], '/'),
                    true
                );

                return '<a class="" href="'.$imageUrl.'" target="_blank">कागदपत्र पहा  </a>';
            }
        }

        return 'कागदपत्र उपलब्ध नाही';
    }



    public function rejectApplicationForm($app_id)
    {
        $this->Authorization->skipAuthorization();
          
         $appointmentsTable = $this->fetchTable('StaffOnboardingAppointments');   
         $appointment = $appointmentsTable->find()
            ->contain(['StaffOnboardingDocuments'])
            ->where(['staff_id' => $app_id])
            ->order(['StaffOnboardingAppointments.id' => 'DESC'])
            ->first();

         
        $PostAdvertisementVacanciesTable = TableRegistry::getTableLocator()->get('PostAdvertisementVacancies');
        $PostAdvertisementVacanciesDetails = $PostAdvertisementVacanciesTable->find()->where(['id' => $appointment->staff_id])->first();
        $postAdvertisementId = $PostAdvertisementVacanciesDetails->post_advertisement_id ?? null;

        $PostAdvertisementTable = TableRegistry::getTableLocator()
                                            ->get('PostAdvertisement');

        $ng2g = $PostAdvertisementTable
            ->getAdvertisementDetails($postAdvertisementId);

        $staffs = [];

        $sansthaTable = TableRegistry::getTableLocator()->get('Sansthas');
        $sanstha = $sansthaTable->find()
                    ->where(['code' => $ng2g['institution_code']])
                    ->first();

         $casteCategoriesTable = TableRegistry::getTableLocator()->get('CasteCategories');

        // Get Original Category
        $originalCategory = null;
        if (!empty($appointment->original_category)) {
            $originalCategory = $casteCategoriesTable->find()
                ->where(['code' => $appointment->original_category])
                ->first();
        }

        $originalCategoryName = $originalCategory ? $originalCategory->category_name: '-';

        $appointmentCategory = null;
        if (!empty($appointment->appointment_category)) {
            $appointmentCategory = $casteCategoriesTable->find()
                ->where(['code' => $appointment->appointment_category])
                ->first();
        }

        $appointmentCategoryName = $appointmentCategory ? $appointmentCategory->category_name: '-';

       $horizontalCategoriesTable = TableRegistry::getTableLocator()->get('HorizontalCategories');

        // Get Horizontal Category
        $horizontalCategory = null;
        if (!empty($appointment->horizontal_category)) {
            $horizontalCategory = $horizontalCategoriesTable->find()
                ->where(['code' => $appointment->horizontal_category])
                ->first();
        }

        $horizontalCategoryName = $horizontalCategory? $horizontalCategory->name : '-';
        

        $payScaleTable = TableRegistry::getTableLocator()->get('PayScales');

        // Get pay scale
        $payScale = null;
        if ($appointment->pay_scale !== null && $appointment->pay_scale !== '') {
            $payScale = $payScaleTable->find()
                ->where([
                    'id' => $appointment->pay_scale
                ])
                ->first();
        }

        $payScaleName = $payScale? $payScale->scale_name : '-';


        //$storage = new EsdlStorageService();

    $html = '<form id="rejectApplicationForm" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="reject_id" value="'.$app_id.'">
                    <div class="row mb-2">
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
                            h($PostAdvertisementVacanciesDetails->school_udise_code).
                            '</span></label> 
                        </div>
                    
                   
                        <div class="col-md-9">
                            <label for="schoolName" class="form-label marathi-label" style="font-size:10px !important;">शाळेचे नाव <span class="english-label" style="font-size:10px !important;">(School Name)</span> &rarr; <span class="txtval">'.
                            h($PostAdvertisementVacanciesDetails->school_name)
                            .'</span></label> 
                        </div>                  
                        
                        <!--
                            <input type="hidden" name="application_id" value="'.$app_id.'">
                            <label for="schoolLocation" class="form-label marathi-label" style="font-size:10px !important;">शाळेचे ठिकाण <span class="english-label" style="font-size:10px !important;">(School Location)</span> &rarr; <span class="txtval"></span></label> 
                        </div>-->
                    </div>';

          $html .= '<div class="row">
                        <div class="col-md-3">
                            <label class="form-label marathi-label" style="font-size:10px !important;">मुख्याध्यापक नाव &rarr;<span class="txtval">'.
                            h($appointment->headmastername).
                            '</span></label>
                        </div>
                       <div class="col-md-3">
                            <label class="form-label marathi-label" style="font-size:10px !important;">ई-मेल  &rarr;<span class="txtval">'.
                            h($appointment->heademail).
                            '</span></label>
                        </div>
                         <div class="col-md-3">
                            <label class="form-label marathi-label" style="font-size:10px !important;">मोबाईल क्रमांक &rarr;<span class="txtval">'.
                            h($appointment->headmobilenumber).
                            '</span></label>
                        </div>
                    </div>';
       
            $html .= '<div class="row">
                        <div class="col-md-3">
                            <label class="form-label marathi-label" style="font-size:10px !important;">कर्मचाऱ्याचे नाव<span class="english-label" style="font-size:10px !important;">(Teacher Name)</span>&rarr;<span class="txtval">'.
                            h($appointment->candidate_name).
                            '</span></label>
                        </div>
                         <div class="col-md-3">
                            <label for="gender" class="form-label marathi-label " style="font-size:10px !important;">लिंग
                             <span class="txtval">'.h($appointment->gender).'</span></label>                            
                        </div>
                        <div class="col-md-3">
                            <label for="dob_date" class="form-label marathi-label " style="font-size:10px !important;">जन्मतारीख
                             <span class="txtval">'.h($appointment->dob_date).'</span></label>                             
                        </div>
                      
                    </div>';

             $html .= '<div class="row">
                        <div class="col-md-3">
                            <label class="form-label marathi-label" style="font-size:10px !important;">ई-मेल &rarr;<span class="txtval">'.
                            h($appointment->candidateemail).
                            '</span></label>
                        </div>
                         <div class="col-md-3">
                            <label for="gender" class="form-label marathi-label " style="font-size:10px !important;">मोबाईल क्रमांक 
                             <span class="txtval">'.h($appointment->candidatemobile).'</span></label>                            
                        </div>
                        <div class="col-md-3">
                            <label for="dob_date" class="form-label marathi-label " style="font-size:10px !important;">पॅन क्रमांक
                             <span class="txtval">'.h($appointment->pan_number).'</span></label>                             
                        </div>
                      <div class="col-md-3">
                            <label for="dob_date" class="form-label marathi-label " style="font-size:10px !important;">आधार क्रमांक
                             <span class="txtval">'.h($appointment->aadhar_number).'</span></label>                             
                        </div>
                    </div>';

     $html .= '<div class="row mb-3" id="casteCategoryBox_onboard">';
        $html .= ' <div class="col-md-4">
                            <label for="originalCategory_onboard" class="form-label marathi-label" style="font-size:10px !important;">मूळ आरक्षण प्रवर्ग <span class="english-label">(Original)</span>
                           <span class="txtval">'.$originalCategoryName.'</span></label>
                        </div>
                         <div class="col-md-4">
                           <label for="appointmentCategory_onboard" class="form-label marathi-label" style="font-size:10px !important;">समांतर आरक्षण प्रवर्ग <span class="english-label">(Horizontal)</span>
                             <span class="txtval">'.$horizontalCategoryName.'</span></label>
                        </div>
                      ';

        
        if (!in_array((int)$sanstha["minority_sanstha"], [2, 3], true)){
            
                  $html .= ' <div class="col-md-4">
                          <label for="appointmentCategory_onboard" class="form-label marathi-label" style="font-size:10px !important;">नियुक्तीचा आरक्षण प्रवर्ग <span class="english-label">(Appointment)</span>
                             <span class="txtval">'.$appointmentCategoryName.'</span></label>
                        </div>
                      
                       ';  
        }
  
        $html .= ' <div class="col-md-4">
                          <label for="pay_scale_onboard" class="form-label marathi-label" style="font-size:10px !important;">वेतनश्रेणी  <span class="english-label">(Pay Scale)</span>
                              <span class="txtval">'.$payScaleName.'</span></label>
                        </div>
                     ';                                   

        $html .= '</div>';
        


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
                    
                    </style>';

                
            $html .=    '<div> <div class="card shadow">';

             $html .= '   <div class="card-header group-header">

                       नामंजुरी प्रक्रिया

                    </div>';



            $html .=    '<div class="card-body">
                      
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Select</th>
                                <th>Field Name</th>                              
                            </tr>
                            </thead><tbody>';

             
                            
            $documentGroups = [
    'education' => [
        'title' => 'शैक्षणिक दस्तऐवज',
        'types' => ['ssc', 'hsc', 'graduate','post_graduate']
    ],
    'Certificate' => [
        'title' => 'आरक्षण दस्तऐवज',
        'types' => ['horizontalcertificate', 'castecertificate', 'validcastecertificate']
    ],
    'advertisement' => [
        'title' => 'जाहिरात संबंधित दस्तऐवज',
        'types' => ['advertisement', 'adv_approval']
    ],
     'Selection_Process' => [
        'title' => 'निवड प्रक्रिया दस्तऐवज',
        'types' => ['signature', 'marking', 'resolution', 'order']
    ],
     'Roster' => [
        'title' => 'रोस्टर (Roster)',
        'types' => ['court_roster']
    ],
     'Roster' => [
        'title' => 'या प्रकरणासंदर्भात कोणताही न्यायालयीन आदेश निर्गमित झाला आहे का? ',
        'types' => ['court_order']
    ]
];

foreach ($documentGroups as $group) {

    $groupDocuments = [];

    foreach ($appointment->staff_onboarding_documents as $document) {
        if (in_array($document['document_type'], $group['types'])) {
            $groupDocuments[] = $document;
        }
    }

    // If no documents in this group, skip it
    if (empty($groupDocuments)) {
        continue;
    }

    // Group heading
    $html .= '
        <tr>
            <td class="field-name"
                colspan="4"
                style="color:#ffffff;background:#3498db;">
                ' . h($group['title']) . '
            </td>
        </tr>
    ';

    // Documents inside group
    foreach ($groupDocuments as $document) {

        $documentType = $document['document_type'];

        $imageUrl = Router::url(
            '/' . ltrim($document['file_path'], '/'),
            true
        );

        $html .= '
            <tr>
                <td>
                    <input
                        class="form-check-input item"
                        type="checkbox"
                        id="' . h($documentType) . '_doc_chk"
                        name="' . h($documentType) . '_doc_chk"
                        value="' . h($document['id'] ?? '') . '"
                    >
                </td>

                <td class="field-name">
                    ' . h($this->getfieldName($documentType)) . ' दस्तऐवज
                </td>

                
            </tr>
        ';
    }
}

$html .= ' <tr>
            <td class="field-name"
                colspan="4"
                style="color:#ffffff;background:#3498db;">
                पद रिक्त नाही
            </td>
        </tr>
        <tr>
                <td>
                <input 
                            type="checkbox"
                            name="no_post_vacant"
                            id="no_post_vacant"
                            class="form-check-input"
                            value="1"
                        >
                </td>

                <td class="field-name">
                  
                                    पद रिक्त नाही
                  
                </td>

                
            </tr>';


          
              $html .=    '</tbody></table>
                         <div class="border rounded p-3 mb-2 bg-light">
                        <div class="form-check">
        
                        <label class="form-check-label fw-semibold">
                        शेरा / Remark
                        </label>
                        <textarea
                                            class="form-control"
                                            rows="5"
                                            placeholder="कृपया शेरा नमूद करा..."
                                            name="reject_remark"
                                            id="reject_remark"></textarea>

                        </div>
                    </div>
                    
                    </div>';               
              $html .=    '<div class="card-footer text-end">

                    
                    <button type="button" onclick="submitRejectApplication()" class="btn btn-danger">
                         <i class="fas fa-times-circle me-1"></i>
                            नामंजूर करा
                    </button>

                </div>
                </div></div></form>';          

                    




          $response = [
                'success' => true,
                'status' => 200,
                'timestamp' => time(),
                'data' =>$staffs,
                'html' => $html
            ];
          
         return $this->response
            ->withType('application/json')
            ->withStatus(200)
            ->withStringBody(json_encode($response)); 
    }

    public function returnApplicationForm($app_id)
    {
        
        $this->Authorization->skipAuthorization();
          
         $appointmentsTable = $this->fetchTable('StaffOnboardingAppointments');   
         $appointment = $appointmentsTable->find()
            ->contain(['StaffOnboardingDocuments'])
            ->where(['staff_id' => $app_id])
            ->order(['StaffOnboardingAppointments.id' => 'DESC'])
            ->first();

         
        $PostAdvertisementVacanciesTable = TableRegistry::getTableLocator()->get('PostAdvertisementVacancies');
        $PostAdvertisementVacanciesDetails = $PostAdvertisementVacanciesTable->find()->where(['id' => $appointment->staff_id])->first();
        $postAdvertisementId = $PostAdvertisementVacanciesDetails->post_advertisement_id ?? null;

        $PostAdvertisementTable = TableRegistry::getTableLocator()
                                            ->get('PostAdvertisement');

        $ng2g = $PostAdvertisementTable
            ->getAdvertisementDetails($postAdvertisementId);

        $staffs = [];

        $sansthaTable = TableRegistry::getTableLocator()->get('Sansthas');
        $sanstha = $sansthaTable->find()
                    ->where(['code' => $ng2g['institution_code']])
                    ->first();

         $casteCategoriesTable = TableRegistry::getTableLocator()->get('CasteCategories');

        // Get Original Category
        $originalCategory = null;
        if (!empty($appointment->original_category)) {
            $originalCategory = $casteCategoriesTable->find()
                ->where(['code' => $appointment->original_category])
                ->first();
        }

        $originalCategoryName = $originalCategory ? $originalCategory->category_name: '-';

        $appointmentCategory = null;
        if (!empty($appointment->appointment_category)) {
            $appointmentCategory = $casteCategoriesTable->find()
                ->where(['code' => $appointment->appointment_category])
                ->first();
        }

        $appointmentCategoryName = $appointmentCategory ? $appointmentCategory->category_name: '-';

       $horizontalCategoriesTable = TableRegistry::getTableLocator()->get('HorizontalCategories');

        // Get Horizontal Category
        $horizontalCategory = null;
        if (!empty($appointment->horizontal_category)) {
            $horizontalCategory = $horizontalCategoriesTable->find()
                ->where(['code' => $appointment->horizontal_category])
                ->first();
        }

        $horizontalCategoryName = $horizontalCategory? $horizontalCategory->name : '-';
        

        $payScaleTable = TableRegistry::getTableLocator()->get('PayScales');

        // Get pay scale
        $payScale = null;
        if ($appointment->pay_scale !== null && $appointment->pay_scale !== '') {
            $payScale = $payScaleTable->find()
                ->where([
                    'id' => $appointment->pay_scale
                ])
                ->first();
        }

        $payScaleName = $payScale? $payScale->scale_name : '-';


        //$storage = new EsdlStorageService();

    $html = '<form id="returnApplicationForm" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="application_id" value="'.$app_id.'">
                    <div class="row mb-2">
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
                            h($PostAdvertisementVacanciesDetails->school_udise_code).
                            '</span></label> 
                        </div>
                    
                   
                        <div class="col-md-9">
                            <label for="schoolName" class="form-label marathi-label" style="font-size:10px !important;">शाळेचे नाव <span class="english-label" style="font-size:10px !important;">(School Name)</span> &rarr; <span class="txtval">'.
                            h($PostAdvertisementVacanciesDetails->school_name)
                            .'</span></label> 
                        </div>                  
                        
                        <!--
                        <div class="col-md-12">
                            <label for="schoolLocation" class="form-label marathi-label" style="font-size:10px !important;">शाळेचे ठिकाण <span class="english-label" style="font-size:10px !important;">(School Location)</span> &rarr; <span class="txtval"></span></label> 
                        </div>-->
                    </div>';

          $html .= '<div class="row">
                        <div class="col-md-3">
                            <label class="form-label marathi-label" style="font-size:10px !important;">मुख्याध्यापक नाव &rarr;<span class="txtval">'.
                            h($appointment->headmastername).
                            '</span></label>
                        </div>
                       <div class="col-md-3">
                            <label class="form-label marathi-label" style="font-size:10px !important;">ई-मेल  &rarr;<span class="txtval">'.
                            h($appointment->heademail).
                            '</span></label>
                        </div>
                         <div class="col-md-3">
                            <label class="form-label marathi-label" style="font-size:10px !important;">मोबाईल क्रमांक &rarr;<span class="txtval">'.
                            h($appointment->headmobilenumber).
                            '</span></label>
                        </div>
                    </div>';
       
            $html .= '<div class="row">
                        <div class="col-md-3">
                            <label class="form-label marathi-label" style="font-size:10px !important;">कर्मचाऱ्याचे नाव<span class="english-label" style="font-size:10px !important;">(Teacher Name)</span>&rarr;<span class="txtval">'.
                            h($appointment->candidate_name).
                            '</span></label>
                        </div>
                         <div class="col-md-3">
                            <label for="gender" class="form-label marathi-label " style="font-size:10px !important;">लिंग
                             <span class="txtval">'.h($appointment->gender).'</span></label>                            
                        </div>
                        <div class="col-md-3">
                            <label for="dob_date" class="form-label marathi-label " style="font-size:10px !important;">जन्मतारीख
                             <span class="txtval">'.h($appointment->dob_date).'</span></label>                             
                        </div>
                      
                    </div>';

             $html .= '<div class="row">
                        <div class="col-md-3">
                            <label class="form-label marathi-label" style="font-size:10px !important;">ई-मेल &rarr;<span class="txtval">'.
                            h($appointment->candidateemail).
                            '</span></label>
                        </div>
                         <div class="col-md-3">
                            <label for="gender" class="form-label marathi-label " style="font-size:10px !important;">मोबाईल क्रमांक 
                             <span class="txtval">'.h($appointment->candidatemobile).'</span></label>                            
                        </div>
                        <div class="col-md-3">
                            <label for="dob_date" class="form-label marathi-label " style="font-size:10px !important;">पॅन क्रमांक
                             <span class="txtval">'.h($appointment->pan_number).'</span></label>                             
                        </div>
                      <div class="col-md-3">
                            <label for="dob_date" class="form-label marathi-label " style="font-size:10px !important;">आधार क्रमांक
                             <span class="txtval">'.h($appointment->aadhar_number).'</span></label>                             
                        </div>
                    </div>';

     $html .= '<div class="row mb-3" id="casteCategoryBox_onboard">';
        $html .= ' <div class="col-md-4">
                            <label for="originalCategory_onboard" class="form-label marathi-label" style="font-size:10px !important;">मूळ आरक्षण प्रवर्ग <span class="english-label">(Original)</span>
                           <span class="txtval">'.$originalCategoryName.'</span></label>
                        </div>
                         <div class="col-md-4">
                           <label for="appointmentCategory_onboard" class="form-label marathi-label" style="font-size:10px !important;">समांतर आरक्षण प्रवर्ग <span class="english-label">(Horizontal)</span>
                             <span class="txtval">'.$horizontalCategoryName.'</span></label>
                        </div>
                      ';

        
        if (!in_array((int)$sanstha["minority_sanstha"], [2, 3], true)){
            
                  $html .= ' <div class="col-md-4">
                          <label for="appointmentCategory_onboard" class="form-label marathi-label" style="font-size:10px !important;">नियुक्तीचा आरक्षण प्रवर्ग <span class="english-label">(Appointment)</span>
                             <span class="txtval">'.$appointmentCategoryName.'</span></label>
                        </div>
                      
                       ';  
        }
  
        $html .= ' <div class="col-md-4">
                          <label for="pay_scale_onboard" class="form-label marathi-label" style="font-size:10px !important;">वेतनश्रेणी  <span class="english-label">(Pay Scale)</span>
                              <span class="txtval">'.$payScaleName.'</span></label>
                        </div>
                     ';                                   

        $html .= '</div>';
        


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
                    
                    </style>';

                
            $html .=    '<div> <div class="card shadow">';

             $html .= '   <div class="card-header group-header">

                        <div class="d-flex justify-content-between align-items-center">

                            <div class="section-title">
                                👤 दुरुस्तीसाठी आवश्यक बाबी निवडा व प्रत्येक बाबीसाठी शेरा नमूद करा.
                            </div>

                            <div>

                              
                            </div>

                        </div>

                    </div>';



            $html .=    '<div class="card-body">
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
                                <th>Select</th>
                                <th>Field Name</th>
                                <th> Current Value</th>
                                <th width="60%">Remarks</th>
                            </tr>
                            </thead><tbody>';

             
                            
            $documentGroups = [
    'education' => [
        'title' => 'शैक्षणिक दस्तऐवज',
        'types' => ['ssc', 'hsc', 'graduate','post_graduate']
    ],
    'Certificate' => [
        'title' => 'आरक्षण दस्तऐवज',
        'types' => ['horizontalcertificate', 'castecertificate', 'validcastecertificate']
    ],
    'advertisement' => [
        'title' => 'जाहिरात संबंधित दस्तऐवज',
        'types' => ['advertisement', 'adv_approval']
    ],
     'Selection_Process' => [
        'title' => 'निवड प्रक्रिया दस्तऐवज',
        'types' => ['signature', 'marking', 'resolution', 'order']
    ],
     'Roster' => [
        'title' => 'रोस्टर (Roster)',
        'types' => ['court_roster']
    ],
     'Roster' => [
        'title' => 'या प्रकरणासंदर्भात कोणताही न्यायालयीन आदेश निर्गमित झाला आहे का? ',
        'types' => ['court_order']
    ]
];

foreach ($documentGroups as $group) {

    $groupDocuments = [];

    foreach ($appointment->staff_onboarding_documents as $document) {
        if (in_array($document['document_type'], $group['types'])) {
            $groupDocuments[] = $document;
        }
    }

    // If no documents in this group, skip it
    if (empty($groupDocuments)) {
        continue;
    }

    // Group heading
    $html .= '
        <tr>
            <td class="field-name"
                colspan="4"
                style="color:#ffffff;background:#3498db;">
                ' . h($group['title']) . '
            </td>
        </tr>
    ';

    // Documents inside group
    foreach ($groupDocuments as $document) {

        $documentType = $document['document_type'];

        $imageUrl = Router::url(
            '/' . ltrim($document['file_path'], '/'),
            true
        );

        $html .= '
            <tr>
                <td>
                    <input
                        class="form-check-input item"
                        type="checkbox"
                        id="' . h($documentType) . '_doc_chk"
                        name="' . h($documentType) . '_doc_chk"
                        value="' . h($document['id'] ?? '') . '"
                    >
                </td>

                <td class="field-name">
                    ' . h($this->getfieldName($documentType)) . ' दस्तऐवज
                </td>

                <td>
                    <a class="viewBtn"
                       href="' . h($imageUrl) . '"
                       target="_blank">
                        <i class="fa fa-eye"></i> View
                    </a>
                </td>

                <td>
                    <textarea
                        class="form-control"
                        rows="1"
                        placeholder="Reason for correction"
                        id="' . h($documentType) . '_doc_reason"
                        name="' . h($documentType) . '_doc_reason"
                    ></textarea>
                </td>
            </tr>
        ';
    }
}



              $html .=    '</tbody></table>
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
                    
                    </div>';               
              $html .=    '<div class="card-footer text-end">

                    
                    <button type="button" onclick="submitReturnApplication()" class="btn btn-danger">
                        Return Application to Sanstha
                    </button>

                </div>
                </div></div></form>';          

                    




          $response = [
                'success' => true,
                'status' => 200,
                'timestamp' => time(),
                'data' =>$staffs,
                'html' => $html
            ];
          
         return $this->response
            ->withType('application/json')
            ->withStatus(200)
            ->withStringBody(json_encode($response));  

    }

    private function getfieldName($name){

          $array = ['ssc'=>'माध्यमिक (SSC)',
                    'hsc'=>'उच्च माध्यमिक (HSC)',
                    'graduate'=>'पदवी (Graduate Degree)',
                    'post_graduate'=>'पदव्युत्तर पदवी (Post Graduate Degree)',
                    'adv_approval'=>'जाहिरात मंजूरी पत्र',
                    'advertisement'=>'जाहिरात',
                    'signature'=>'उमेदवार स्वाक्षरीची यादी',
                    'marking'=>'उमेदवार गुणांकन',
                    'resolution'=>'संस्थेचा ठराव',
                    'order'=>'आदेश',
                    'court_roster'=>'रोस्टर (Roster)',
                    'court_order'=>'या प्रकरणासंदर्भात कोणताही न्यायालयीन आदेश निर्गमित झाला आहे का',   
                    'government'=>'रोस्टर (Roster)',
                    'horizontalcertificate'=>'समांतर आरक्षण प्रमाणपत्र ',
                    'castecertificate'=>'जात प्रमाणपत्र', 
                    'validcastecertificate'=>'वैध जात प्रमाणपत्र ', 
	                ];

         return $array[$name] ?? $name;

    }
      private function genrateHeaderRow($heding){
        return '<tr>
                    <td class="field-name" colspan="3" style="color:#ffffff;background:#3498db;">'.$heding.'</td></tr>';
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

     public function returnApplicationSubmission()
    {

        $this->request->allowMethod(['post', 'ajax']);
        $data = $this->request->getData();
       
        /*echo "<pre>123";
        print_r($data);
        exit;*/

        $insertData = array();
        $ng2g_id =  $data['application_id'];
        $transaction_id= $ng2g_id.rand(100000,999999);

        $status= 'returned'; 
        $stTime = time();
        $user_level_id = 1;           
        $user_juridiction_id = "";
        $user = $this->request->getSession()->read('Auth.User');

         if (
            (isset($data['ssc_doc_chk']) && $data['ssc_doc_chk'] === 'on') ||
            !empty($data['ssc_doc_reason'])
        ) {
            $insertData[] = array(
                "app_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "ssc_file",
                "rtn_field_reason" =>  $data['ssc_doc_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['hsc_doc_chk']) && $data['hsc_doc_chk'] === 'on') ||
            !empty($data['hsc_doc_reason'])
        ) {
            $insertData[] = array(
                "app_id" => $ng2g_id,
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
                "app_id" => $ng2g_id,
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
                "app_id" => $ng2g_id,
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
            (isset($data['adv_approval_doc_chk']) && $data['adv_approval_doc_chk'] === 'on') ||
            !empty($data['adv_approval_doc_reason'])
        ) {
            $insertData[] = array(
                "app_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "adv_approval_file",
                "rtn_field_reason" =>  $data['adv_approval_doc_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['advertisement_doc_chk']) && $data['advertisement_doc_chk'] === 'on') ||
            !empty($data['advertisement_doc_reason'])
        ) {
            $insertData[] = array(
                "app_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "advertisement_file",
                "rtn_field_reason" =>  $data['advertisement_doc_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['signature_doc_chk']) && $data['signature_doc_chk'] === 'on') ||
            !empty($data['signature_doc_reason'])
        ) {
            $insertData[] = array(
                "app_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "signature_file",
                "rtn_field_reason" =>  $data['signature_doc_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['marking_doc_chk']) && $data['marking_doc_chk'] === 'on') ||
            !empty($data['marking_doc_reason'])
        ) {
            $insertData[] = array(
                "app_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "marking_file",
                "rtn_field_reason" =>  $data['marking_doc_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }

        if (
            (isset($data['resolution_doc_chk']) && $data['resolution_doc_chk'] === 'on') ||
            !empty($data['resolution_doc_reason'])
        ) {
            $insertData[] = array(
                "app_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "resolution_file",
                "rtn_field_reason" =>  $data['resolution_doc_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }        

        if (
            (isset($data['order_doc_chk']) && $data['order_doc_chk'] === 'on') ||
            !empty($data['order_doc_reason'])
        ) {
            $insertData[] = array(
                "app_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "order_file",
                "rtn_field_reason" =>  $data['order_doc_reason'],
                "rtn_user_id" => $this->user_id,
                "rtn_created_at" => $stTime,
                "rtn_fwd_to" => $user_level_id ,
                "rtn_fwd_to_target" => $user_juridiction_id  
            );     
        }  
        if (
            (isset($data['court_roster_doc_chk']) && $data['court_roster_doc_chk'] === 'on') ||
            !empty($data['court_roster_doc_reason'])
        ) {
            $insertData[] = array(
                "app_id" => $ng2g_id,
                "transaction_id" => $transaction_id,
                "rtn_field_name" => "court_roster_file",
                "rtn_field_reason" =>  $data['court_roster_doc_reason'],
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
                "app_id" => $ng2g_id,
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
                $fileName = null;     
                $StaffOnboardApplicationReturnsTable = TableRegistry::getTableLocator()->get('StaffOnboardApplicationReturns');

                $entities = $StaffOnboardApplicationReturnsTable->newEntities($insertData);

                if ($StaffOnboardApplicationReturnsTable->saveMany($entities)) {

                    $this->generateReturnLetter($ng2g_id);

                    $generatedDocument = 'uploads/staffonboarding/return/staff_order_return_' . $onboard->id . '.pdf';
                    if (is_file(WWW_ROOT . $generatedDocument)) {
                        $fileName = $generatedDocument;
                    }


                    $StaffOnboardApplicationLogsTable = $this->fetchTable('StaffOnboardApplicationLogs');
                    $logData = [
                        'app_id'      => $ng2g_id,
                        'transaction_id' => $transaction_id,
                        'app_stage'    => 'returned',
                        'stage_remark'    => $overall_remark,
                        'created_by'   => $this->user_id,
                        'created_at'   => $stTime,
                        'stage_doc'      => $fileName,
                    ];

                    $log = $StaffOnboardApplicationLogsTable->newEntity($logData);

                    if ($StaffOnboardApplicationLogsTable->save($log)) {

                        $StaffOnboardingAppointmentsTable = TableRegistry::getTableLocator()->get('StaffOnboardingAppointments');
                        $transfer = $StaffOnboardingAppointmentsTable->find()
                                    ->where(['staff_id' => $ng2g_id])
                                    ->first();
                                            
                        $staffData = [               
                            'status'            => 'returned'       

                        ];
                        $transfer = $StaffOnboardingAppointmentsTable->patchEntity($transfer, $staffData);
                        if (!$StaffOnboardingAppointmentsTable->save($transfer)) {
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


     public function replyToReturnApplication($app_id)
    {
        
        $this->Authorization->skipAuthorization();
       // $this->viewBuilder()->setLayout('state');
    
        $staffOnboardApplicationReturnsTable = TableRegistry::getTableLocator()->get('StaffOnboardApplicationReturns');

      //  $staffTransfersTable = TableRegistry::getTableLocator()->get('StaffTransfers');
      

        $ng2g = $staffOnboardApplicationReturnsTable->find()               
                ->where(['app_id' => $app_id,'status' => 'returned'])
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
            if($ng->rtn_field_name == "ssc_file"){
                $html .= $this->genrateFileRow('SSC',$ng->id,$ng->rtn_field_reason);
            }      
            if($ng->rtn_field_name == "hsc_file"){
                $html .= $this->genrateFileRow('HSC / 12th Document',$ng->id,$ng->rtn_field_reason);
            }

            if($ng->rtn_field_name == "graduate_file"){
                $html .= $this->genrateFileRow('Graduate Degree Document',$ng->id,$ng->rtn_field_reason);
            }

            if($ng->rtn_field_name == "post_graduate_file"){
                $html .= $this->genrateFileRow('Post Graduate Degree Document',$ng->id,$ng->rtn_field_reason);
            }

            if($ng->rtn_field_name == "adv_approval_file"){
                $html .= $this->genrateFileRow('जाहिरात मंजुरी पत्र',$ng->id,$ng->rtn_field_reason);
            }

            if($ng->rtn_field_name == "advertisement_file"){
                $html .= $this->genrateFileRow('जाहिरात',$ng->id,$ng->rtn_field_reason);
            }

            if($ng->rtn_field_name == "signature_file"){
                $html .= $this->genrateFileRow('उमेदवारांच्या स्वाक्षरीची यादी',$ng->id,$ng->rtn_field_reason);
            }                
	
        
            if($ng->rtn_field_name == "marking_file"){
                $html .= $this->genrateFileRow('उमेदवार गुणांकन',$ng->id,$ng->rtn_field_reason);
            } 
            if($ng->rtn_field_name == "resolution_file"){
                $html .= $this->genrateFileRow('संस्थेचा ठराव',$ng->id,$ng->rtn_field_reason);
            } 
            if($ng->rtn_field_name == "order_file"){
                $html .= $this->genrateFileRow('आदेश',$ng->id,$ng->rtn_field_reason);
            } 
            if($ng->rtn_field_name == "court_roster_file"){
                $html .= $this->genrateFileRow('या संस्थेमध्ये एकच शिक्षकेतर पद आहे का',$ng->id,$ng->rtn_field_reason);
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


    public function replyToReturnApplicationSubmission()
    {

        $this->request->allowMethod(['post', 'ajax']);
        $data = $this->request->getData();
        $ng2g_id = (int)$data["application_id"];
        $transaction_id= $ng2g_id.rand(100000,999999);
        $stTime = time();

        $returnsTable = $this->fetchTable('StaffOnboardApplicationReturns');
        
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
                            'app_id' => $ng2g_id,
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
                            'app_id' => $ng2g_id,
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
                                'app_id' => $ng2g_id,
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
                                'app_id' => $ng2g_id,
                                'id' => $matches[1]
                            ]
                        );
                    }
                }
            }

            $StaffOnboardApplicationLogsTable = $this->fetchTable('StaffOnboardApplicationLogs');
            $logData = [
                'app_id'      => $ng2g_id,
                'transaction_id' => $transaction_id,
                'app_stage'    => 'forwarded',
                'created_by'   => $this->user_id,
                'created_at'   => $stTime
            ];

            $log = $StaffOnboardApplicationLogsTable->newEntity($logData);

            if (!$StaffOnboardApplicationLogsTable->save($log)){
                    $connection->rollback();
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode([
                        'success' => false,
                        'message' => 'Unable to forward Application'
                    ]));  
            }

            $StaffOnboardingAppointmentsTable = TableRegistry::getTableLocator()->get('StaffOnboardingAppointments');  
            $transfer = $StaffOnboardingAppointmentsTable->find()
                                    ->where(['staff_id' => $ng2g_id])
                                    ->first();

            $status = $transfer->status;
            $newStatus = 'forwarded';//preg_replace('/_returned$/', '_forwarded', $status);                                
            $staffData = [               
                'status' => $newStatus 
            ];
            $transfer = $StaffOnboardingAppointmentsTable->patchEntity($transfer, $staffData);
            if (!$StaffOnboardingAppointmentsTable->save($transfer)) {
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


     public function generateReturnLetter($appId)
    {
        $this->autoRender = false;

        try {
            $appId = (int)$appId;
            if ($appId <= 0) {
                throw new \InvalidArgumentException('Invalid application ID');
            }

            $staffName = 'श्री. अमोल रमेश पाटील';
            $orderDate = '24-08-2026';
            $post = 'सहाय्यक शिक्षक';
            $proposalNumber = sprintf('NG2G-TRFR-%s-%06d', date('Y'), $appId);
            $proposalDate = '15-08-2026';

            $sansthaCode = '';
            $sansthaName = '';
            $schoolCode = '';
            $sansthaName = 'श्री शिवाजी हायस्कूल व कनिष्ठ महाविद्यालय, कोल्हापूर';

            $sourceAided = 'विना अनुदानित';
            $targetAided = 'अंशतः अनुदानित (२० टक्के)';
            $unaidedTimeFrame = 'विना अनुदान सेवा कालावधी';
            $educationQualification = 'शैक्षणिक पात्रता';
            $payScale = 'वेतनश्रेणी';
            $unaidedOrderDate = 'अनुदानित वरील नेमणुक दिनांक';
            $remark = 'शेरा';
            $status = 'मान्य';

            $refNo = 'जा.क्र.: शिसंमा-' . date('Y') . "/विना-अनु बदली आदेश/" . $staffName . "/" . sprintf('%06d', $appId);
            $letterData = [
                'ref_no' => $refNo,
                'letter_date' => $orderDate,
                'division_name' => 'पुणे',
                'proposal_number' => $proposalNumber,
                'proposal_date' => $proposalDate,
                'teacher_name' => $staffName,
                'designation' => $post,
                'sanstha_code' => $sansthaCode,
                'sanstha_name' => $sansthaName,
                'school_code' => $schoolCode,
                'school_name' => $sansthaName,
                'source_aided' => $sourceAided,
                'target_aided' => $targetAided,
                'unaided_time_frame' => $unaidedTimeFrame,
                'education_qualification' => $educationQualification,
                'pay_scale' => $payScale,
                'unaided_order_date' => $unaidedOrderDate,
                'remark' => $remark,
                'status' => $status,
            ];

            $uploadDir = WWW_ROOT . 'uploads' . DS . 'staffonboarding' . DS . 'return' . DS;
            $qrcodeDir = $uploadDir . 'qrcodes' . DS;

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            if (!is_dir($qrcodeDir)) {
                mkdir($qrcodeDir, 0777, true);
            }

            $endPoint = 'uploads/staffonboarding/return/staff_order_return_' . $appId . '.pdf';
            $outputPath = WWW_ROOT . $endPoint;
            $tempHtmlPath = $uploadDir . 'temp_return_letter.html';

            $basePath = $this->request->getAttribute('base') ?? '';
            $fullUrl = $this->request->scheme() . '://' . $this->request->host() . $basePath . '/' . $endPoint;

            $letterData['app_id'] = $appId;
            $letterData['targetAppUrl'] = $fullUrl;
            $letterData['targetQRUrl'] = $this->request->scheme() . '://' . $this->request->host() . $basePath . '/uploads/staffonboarding/return/qrcodes/staff_order_return_' . $appId . '.png';
            $letterData['targetQRPath'] = $qrcodeDir . 'staff_order_return_' . $appId . '.png';

            //$this->generateQRCode($fullUrl, $appId);
            $html = $this->renderReturnLetterViewContent($letterData);

            $writeResult = file_put_contents($tempHtmlPath, $html);
            if ($writeResult === false) {
                throw new \RuntimeException('Unable to write temporary approval letter HTML.');
            }

            $wkhtmltopdfBinary = $this->findWkhtmltopdfBinary();
            if ($wkhtmltopdfBinary === null) {
                throw new \RuntimeException('wkhtmltopdf is not installed or not available in PATH.');
            }

            $cmd = sprintf(
                '%s --enable-local-file-access --encoding UTF-8 --page-size A4 %s %s',
                escapeshellarg($wkhtmltopdfBinary),
                escapeshellarg($tempHtmlPath),
                escapeshellarg($outputPath)
            );

            exec($cmd . ' 2>&1', $output, $statusCode);

            if ($statusCode !== 0 || !file_exists($outputPath)) {
                $error = implode("\n", $output);
                throw new \RuntimeException('PDF generation failed: ' . $error);
            }

            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'success' => true,
                    'url' => $fullUrl,
                    'path' => $outputPath,
                    'message' => 'return letter generated successfully',
                ]));
        } catch (\Throwable $e) {
            error_log('generateApprovalLetter failed: ' . $e->getMessage());

            return $this->response
                ->withStatus(500)
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'success' => false,
                    'message' => $e->getMessage(),
                ]));
        }
    }



    private function renderReturnLetterViewContent($data): string
    {
        $base64ImageQR = '';
        if (!empty($data['targetQRPath']) && file_exists($data['targetQRPath'])) {
            $imageDataQR = base64_encode(file_get_contents($data['targetQRPath']));
            $base64ImageQR = 'data:image/png;base64,' . $imageDataQR;
        }

        $base64Image = $this->getActiveHeaderImageDataUri((int)$this->user_id);

        return '<!DOCTYPE html>
                <html lang="mr">
                <head>
                    <meta charset="UTF-8">
                    <style>
                        body {
                            font-family: "DejaVu Sans", "Nirmala UI", "Mangal", "Arial Unicode MS", sans-serif;
                            font-size: 18px;
                            line-height: 1.7;
                            margin: 0px 30px;
                            color: #111;
                        }
                        .header-img {
                            width: 250px;
                            height: 250px;
                        }
                        .qrcode-img {
                            width: 300px;
                            border:2px solid #1da5bd;
                        }
                        .meta-table {
                            width: 100%;
                            border-collapse: collapse;
                            margin-bottom: 15px;
                        }
                        .meta-table td {
                            vertical-align: top;
                            padding: 2px 0;
                        }
                        .text-right {
                            text-align: right;
                        }
                        .recipient {
                            margin: 15px 0;
                            line-height: 1.6;
                        }
                        .subject-box {
                            font-weight: bold;
                            margin: 15px 0;
                            padding: 6px 10px;
                            background-color: #f4f4f4;
                            border-left: 3px solid #666;
                        }
                        .reference {
                            margin-bottom: 15px;
                        }
                        .content {
                            text-align: justify;
                            text-indent: 30px;
                            margin-top: 15px;
                            line-height: 1.8;
                        }
                        .signature-table {
                            width: 100%;
                            margin-top: 50px;
                            border-collapse: collapse;
                            page-break-inside: avoid;
                        }
                        .copy-section {
                            margin-top: 40px;
                            padding-top: 10px;
                            border-top: 1px dashed #aaa;
                            font-size: 13px;
                            page-break-inside: avoid;
                        }
                        .right {
                            float:right;
                        }
                        .signature-wrap {
                            width: 100%;
                            margin-top: 40px;
                            clear: both;
                        }
                        .signature-block {
                            float: right;
                            width: 260px;
                            text-align: right;
                            margin-top: 10px;
                            margin-bottom: 10px;
                        }
                        .signature {
                            text-align: right;
                            margin: 0;
                        }
                        .copy-to {
                            margin-top: 70px;
                            clear: both;
                            font-weight: 600;
                        }
                    </style>
                </head>
                <body>
                ' . (!empty($base64Image) ? '<img class="header-img" src="' . $base64Image . '">' : '') . '

               
                <br>

                प्रति,
                <div>
                    <span class="indent">अध्यक्ष/सचिव संबंधित शाळा,
                    </span>
                    
                </div>

                <br>
                <div class="subject">
                      विषय :- कनिष्‍ठ लिपिक/प्रयोगशाळा सहाय्यक/ग्रंथपाल पदी वैयक्तीक मान्‍यताबाबत.
                </div>
                <br>
                <div>
                    संदर्भ :-
                    <br>
                    ' . $this->transliterateToMarathi("१. शासन पत्र क्र.न्‍यायाप्र/२०२३/प्र.क्र.३०/टिएनटी-२ दि.२१.०२.२०२४.<br>
	               २. शिक्षण संचालनालयाचे पत्रक्र.शिसंमा-२०२४/शिक्षकेत्‍तर/न्‍याप्र-५०५८/२१/टी-४/११७९ दि.०१.०३.२०२४.<br>
	               ३. संचालनालयाचे पत्रक्र.शिसंमा/शिक्षकेत्‍तर पदभरती/कार्यासन टि-४/२५९२ दि.२८.०५.२०२५.<br>
	               ४. शालेय शिक्षण व क्रीडा विभाग यांचे शासन निर्णय क्रमांक संकीर्ण-२०२६/प्र.क्र.२६६/ई-१७६८६६७/टीएनटी-१ दि.११.०८.२०२६.<br>
	               ५. शाळेचा प्रस्‍ताव ") . '
                </div>

                    <div class="content">
                        <p>उपरोक्त संदर्भाधिन पत्राानुसार निर्देशित करण्यांत येते की, संदर्भाधिन प्रस्तावामध्ये ............................ या शाळेतील/कनिष्ठ महाविदयालयातील नियुक्त शिक्षकेत्तर कर्मचारी (कनिष्ठ लिपिक,प्रयोगशाळा सहाय्यक,ग्रंथपाल) यांचे पदास मान्यता मिळणेबाबतचा प्रस्ताव सादर करण्यात आलेला होता.</p>
                        <p>त्यास अनुसरुन...........................................स्तरावर करण्यात आलेल्या छाननीअंती आपल्या प्रस्तावात त्रुटी आढळून आल्या आहेत</p>
                        <p>1.</p>
                        <p>2.</p>
                        <p>3.</p>
                        <p>4.</p>
                        <p>5.</p>
                        <p>वरील त्रुटी असल्याने आपला शिक्षकेत्तर कर्मचारी (कनिष्ठ लिपिक,प्रयोगशाळा सहाय्यक,ग्रंथपाल) पदास मान्यता मिळणेबाबतचा प्रस्ताव अमान्य करण्यात येत आहे.</p>
                    </div>      
                    <div>
                        <p class="right" style="text-align:right; margin:0;">
                            स्वाक्षरी/-
                        </p>
                        <div style="height: 150px;"></div>
                        <p style="margin:0;"> प्रत -</p>
                        <p>१. विभागीय अध्यक्ष,महाराष्ट्र राज्य माध्यमिक व उच्च माध्यमिक शिक्षण मंडळ सर्व.</p>
                        <p>२. विभागीय शिक्षण उपसंचालक सर्व.</p>
                        <p>३.शिक्षणाधिकारी (माध्यमिक/प्राथमिक) व शिक्षण निरीक्षक(उ/द/प) सर्व.</p> 
                        <p>4.	अधीक्षक,वेतन व भविष्य निर्वाह निधी पथक.</p>
                        <p> 5.	संबंधित कर्मचारी.</p>
                    </div>


                <div style="clear:both;"></div>
            </body>
            </html>';
    }


    function transliterateToMarathi($text)
    {
        $eng = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $mar = ['०', '१', '२', '३', '४', '५', '६', '७', '८', '९'];
        return str_replace($eng, $mar, (string)$text);
    }


    private function findWkhtmltopdfBinary(): ?string
    {
        $candidates = [
            'C:\\Program Files\\wkhtmltopdf\\bin\\wkhtmltopdf.exe',
            'C:\\Program Files (x86)\\wkhtmltopdf\\bin\\wkhtmltopdf.exe',
            'wkhtmltopdf',
            '/usr/local/bin/wkhtmltopdf',
            '/usr/bin/wkhtmltopdf',
        ];

        foreach ($candidates as $candidate) {
            if (empty($candidate)) {
                continue;
            }

            if (is_executable($candidate) || is_file($candidate)) {
                return $candidate;
            }

            $command = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN'
                ? 'where "' . $candidate . '" 2>nul'
                : 'command -v "' . $candidate . '" 2>/dev/null';

            $result = @shell_exec($command);
            if (!empty($result)) {
                $path = trim((string) explode(PHP_EOL, $result)[0]);
                if ($path !== '') {
                    return $path;
                }
            }
        }

        return null;
    }


    public function getStaffonBoardingHistory()
    {
        $this->request->allowMethod(['post', 'ajax']);
        $data = $this->request->getData();
        $postId = $data['post_id'];

        $auditTable = 
            TableRegistry::getTableLocator()->get(
                'StaffOnboardApplicationLogs'
            );

        $auditLogs = $auditTable->find()
            ->where([
                'app_id' => $postId
            ])
            ->order([
                'created_at' => 'DESC'
            ])
            ->toArray();


        
        $audithtmlHistory = $this->onBoardingAuditHistoryHtml($auditLogs);

        return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'success' => true,
                    'data' => [
                        'auditLogsHistory' => $audithtmlHistory,
                     ],
                    'message' => 'Application forwarded successfully'
                ]));
       
        
    }


private function onBoardingAuditHistoryHtml(iterable $auditLogs): string
{
    $html = '';
    $k = 0;
    $userName = '';

    if (!empty($auditLogs)) {
        foreach ($auditLogs as $log) {

            // Alternate timeline position
            $position = ($k % 2 !== 0) ? 'left' : 'right';

            // Convert localhost IPv6 to IPv4
            $ip = ($log->ip_address === '::1')
                ? '127.0.0.1'
                : $log->ip_address;

            $createdAt = !empty($log->created_at)
                            ? h(date('d-m-yy', ($log->created_at)))
                            : '';
           
            $action        = h($log->app_stage ?? '');
            $remarks       = h($log->stage_remark ?? '');
           
            $usersTable = TableRegistry::getTableLocator()->get('Users');

            $user = $usersTable
                    ->find()
                    ->select(['username', 'full_name'])
                    ->where(['id' => $log->created_by])
                    ->first();
            
             $userName = $user?->username ?? '';
             $fullName  = $user?->full_name ?? '';        
            
            $html .= '
                <div class="timeline ' . $position . '">
                    <div class="card">
                        <div class="card-body p-4">

                            <h3>' . $createdAt . '</h3>

                            <p class="mb-0">
                                ' . $fullName . ' take action to ' . $action . ' 
                            </p>

                            <p class="mb-0">
                                ' . $remarks . '
                            </p>

                       
                        </div>
                    </div>
                </div>
            ';

            $k++;
        }
    } else {

        $html .= '
            <div class="timeline right">
                <div class="card">
                    <div class="card-body p-4">
                        <h3 class="text-center">
                            No audit history found.
                        </h3>
                    </div>
                </div>
            </div>
        ';
    }

    return $html;
}



  }




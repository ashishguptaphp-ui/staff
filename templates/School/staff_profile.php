<style>
    .form-label {
        font-weight: bold;
         /* adjust as needed */
    }
    label {
       color:black;
        font-size: 1rem;
    }

    .custom-box input {
    color: #787474;
    
    }

    .breadcrumb-item.active {
        color: #fff !important;  /* make active breadcrumb white */
            /* optional: make it bold */
    }
    .required-field {
        position: relative;
    }

    .required-field::after {
        content: "*";
        color: red;
        position: absolute;
        top: 6px;          /* adjust if needed */
        right: 8px;        /* keep inside border */
        font-size: 24px;
        font-weight: bold;
    }
    
    .work-history-card {
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      background: #fff;
      padding: 10px;
    }
    .header-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 2px solid #eee;
      padding-bottom: 10px;
    }
    .header-bar h4 {
      color: #004aad;
      font-weight: 600;
    }
    .btn-add {
      background: linear-gradient(90deg, #004aad, #007bff);
      color: #fff;
      border: none;
      border-radius: 25px;
      padding: 6px 18px;
      font-weight: 500;
    }
    .modal-header {
      background: #004aad;
      color: #fff;
    }
    .form-section {
      background: #f0f6ff;
      border-radius: 10px;
      padding: 12px;
      margin-bottom: 15px;
    }

    /* small UI polish */
    
    #qualTableContainer .table td, #qualTableContainer .table th { vertical-align: middle; }
    #professionalTableContainer .table td, #professionalTableContainer .table th { vertical-align: middle; }

    .modal .modal-header { border-bottom: 1px solid rgba(0,0,0,0.05); }

    /* === Fullscreen Processing Overlay === */
    .processing-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 99999; /* make sure it's above everything */
    background: rgba(0, 0, 0, 0.6);
    display: flex;
    align-items: center;
    justify-content: center;
    visibility: hidden;
    opacity: 0;
    transition: opacity 0.3s ease, visibility 0.3s ease;
    }

    /* visible state */
    .processing-modal.visible {
    visibility: visible;
    opacity: 1;
    }

    /* content container */
    .processing-content {
    background: rgba(255, 255, 255, 0.95);
    padding: 30px 40px;
    border-radius: 12px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
    text-align: center;
    min-width: 260px;
    animation: popIn 0.3s ease;
    }

    /* spinner */
    .spinner {
    width: 60px;
    height: 60px;
    border: 6px solid #ccc;
    border-top: 6px solid #007bff;
    border-radius: 50%;
    margin: 0 auto 15px;
    animation: spin 1s linear infinite;
    }

    /* text */
    .processing-text {
    font-size: 1.1rem;
    color: #222;
    font-weight: 500;
    }

    /* animations */
    @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
    }

    @keyframes popIn {
    0% { transform: scale(0.9); opacity: 0; }
    100% { transform: scale(1); opacity: 1; }
    }


    .confirmation-box {
      max-width: 600px;
      margin: 80px auto;
      background: white;
      border-radius: 15px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      padding: 30px;
      text-align: center;
    }
    .btn-main {
      background-color: #0d6efd;
      color: white;
      font-weight: 500;
      border-radius: 8px;
    }
    .btn-main:hover {
      background-color: #0b5ed7;
    }
    .readonly-select {
        pointer-events: none;
        background-color: #eee;
    }


    .preview-item {
        padding: 8px;
        border: 1px solid #dee2e6;
        border-radius: 4px;
        background-color: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .preview-item a {
        text-decoration: none;
    }
    .preview-item img {
        max-width: 100px;
        max-height: 100px;
        margin-right: 10px;
    }
</style>
 <?php 

    //dd($staff);
    if(!empty($staff->photo_base64)){
        //data:image/jpeg;base64,
        $imgData=$staff->photo_base64;
    }else{
        $imgData="https://eu.ui-avatars.com/api/?name=".$staff->emp_name."&size=50";
    }

    $cssST = "border-danger bg-light-subtle";
    $cssSH = "border-success bg-dark-subtle";
    $cssUD = "border-warning bg-warning-subtle";
    $css = new stdClass();
    $readFlag = new stdClass();
    $css->bank = new stdClass();
    $readFlag->bank = new stdClass();
    $css->pf = new stdClass();
    $readFlag->pf = new stdClass();
    $css->train = new stdClass();
    $readFlag->train = new stdClass();

    $css->upload_photo          = $cssST;
    $css->staff_name            = $cssST;
    $css->staff_name_adhar      = $cssST;    
    $css->dob                   = $cssST;
    $css->gender                = $cssST;
    $css->aadhar                = $cssST;
    $css->mobile                = $cssST;
    $css->email                 = $cssST;
    $css->current_post          = $cssST;
    $css->post_group            = $cssST;
    $css->post_aid              = $cssST;
    $css->recruitment_subject   = $cssST;
    $css->posting_mode          = $cssST;
    $css->shikshan_sevak        = $cssST;
    $css->joining_date          = $cssST;
    $css->joining_district      = $cssST;
    $css->joining_block         = $cssST;
    $css->joining_mgmt          = $cssST;
    $css->joining_school        = $cssST;
    
    $css->joining_designation   = $cssST;
    $css->superannuation        = $cssST;
    $css->initial_order         = $cssST;
    $css->approval_order        = $cssST;
    $css->medical_certificate   = $cssST;
    $css->police_certificate    = $cssST;

    $css->marital_status        = $cssST;
    $css->children              = $cssST;
    $css->domicile              = $cssST;
    $css->border_village        = $cssST;
    $css->suicide_farmer_child  = $cssST;
    $css->non_vremy             = $cssST;
    $css->freedom_fighter_ward  = $cssST;
    $css->election_1991         = $cssST;
    $css->election_1994         = $cssST;
    $css->mother_tongue         = $cssST;
    $css->blood_group           = $cssST;
    $css->lang1                 = $cssST;
    $css->lang2                 = $cssST;
    $css->lang3                 = $cssST;
    $css->remarks               = $cssST;
    $css->election_card                  = $cssST;
    $css->ex_servicemen                  = $cssST;
    $css->height                         = $cssST;
    $css->weight                         = $cssST;
    $css->identification_mark1           = $cssST;
    $css->identification_mark2           = $cssST;
    $css->no_of_non_teaching_working_days = $cssST;
    $css->capable_handling_digital       = $cssST;
    $css->teacher_deputation_school      = $cssST;
    $css->is_uid_verified                = $cssST;
    $css->teaching_other_school          = $cssST;

    


                    
    $css->religion                          = $cssST;
    $css->social_category                   = $cssST;
    $css->caste                             = $cssST;
    $css->certificate_no                    = $cssST;
    $css->certificate_date                  = $cssST;
    $css->certificate_issuing_authority     = $cssST;
    $css->certificate_place                 = $cssST;
    $css->certificate_file                  = $cssST;
    $css->certificate_remarks               = $cssST;
    $css->certificate_validation_no         = $cssST;
    $css->certificate_validation_date       = $cssST;
    $css->certificate_validation_authority  = $cssST;
    $css->certificate_validation_place      = $cssST;
    $css->certificate_validation_file       = $cssST;
    $css->certificate_validation_remarks    = $cssST;
    

    $css->is_disabled                               = $cssST;
    $css->disability_type                           = $cssST;
    $css->disability_percentage                     = $cssST;
    $css->disability_certificate_no                 = $cssST;
    $css->disability_certificate_date               = $cssST;
    $css->disability_certificate_issuing_authority  = $cssST;
    $css->disability_certificate_place              = $cssST;
    $css->disability_id                             = $cssST;
    $css->disability_certificate_file               = $cssST;
    $css->disability_remarks                        = $cssST;



    $css->math_studied_upto             = $cssST;
    $css->science_studied_upto          = $cssST;
    $css->english_studied_upto          = $cssST;
    $css->social_studies_studied_upto   = $cssST;
    $css->language_studied_upto         = $cssST;
    $css->teaching_level                = $cssST;
    $css->main_subject1                 = $cssST;
    $css->main_subject2                 = $cssST;


    $css->tet_paper1_pass             = $cssST;
    $css->tet_paper1_number           = $cssST;
    $css->tet_paper1_percentage       = $cssST;
    $css->tet_paper1_teacher_category = $cssST;
    $css->tet_paper1_pasing_month     = $cssST;
    $css->tet_paper1_pasing_year      = $cssST;

    $css->ctet_paper1_pass             = $cssST;
    $css->ctet_paper1_number           = $cssST;
    $css->ctet_paper1_percentage       = $cssST;
    $css->ctet_paper1_teacher_category = $cssST;
    $css->ctet_paper1_pasing_month     = $cssST;
    $css->ctet_paper1_pasing_year      = $cssST;

    $css->tet_paper2_pass             = $cssST;
    $css->tet_paper2_number           = $cssST;
    $css->tet_paper2_percentage       = $cssST;
    $css->tet_paper2_teacher_category = $cssST;
    $css->tet_paper2_pasing_month     = $cssST;
    $css->tet_paper2_pasing_year      = $cssST;

    $css->ctet_paper2_pass             = $cssST;
    $css->ctet_paper2_number           = $cssST;
    $css->ctet_paper2_percentage       = $cssST;
    $css->ctet_paper2_teacher_category = $cssST;
    $css->ctet_paper2_pasing_month     = $cssST;
    $css->ctet_paper2_pasing_year      = $cssST;


                                                
    $css->classes_taught                = $cssST;
    $css->current_appointment_subject   = $cssST;
    $css->subject_taught_first          = $cssST;
    $css->subject_taught_second         = $cssST;  
    
    $css->pf->acc_type                 = $cssST;
    $css->pf->acc_maintained_by        = $cssST;
    $css->pf->series                   = $cssST;
    $css->pf->gpf_account_no           = $cssST;
    $css->pf->pf_remarks               = $cssST;

    


    $css->bank->bank_name               = $cssST; 
    $css->bank->branch_name             = $cssST; 
    $css->bank->acc_name                = $cssST; 
    $css->bank->acc_number              = $cssST; 
    $css->bank->ifsc                    = $cssST; 
    $css->bank->micr                    = $cssST;   


    $css->train->trained_cwsn                    = $cssST;
    $css->train->training_computer               = $cssST;
    $css->train->training_received               = $cssST;
    $css->train->training_needed                 = $cssST;
    $css->train->training_nishtha                = $cssST;
    $css->train->training_ssa                    = $cssST;
    $css->train->psy_soc_aspect                  = $cssST;
    $css->train->support_cwsn                    = $cssST;

    $css->permanent_address                      = $cssST;
    $css->current_address                        = $cssST;


 




    $css->recruitment_mode                 = $cssST;
    $css->current_post_mode                 = $cssST;
    $css->initial_post                     = $cssST;
    $css->mode_of_post                     = $cssST;
    $css->recruitment_category             = $cssST;
    $css->recruitment_hor_category         = $cssST;
    $css->recruitment_ph_category           = $cssST;
    $css->recruitment_orphan_category       = $cssST;
    $css->appointment_for_subject_1        = $cssST;
    $css->appointment_for_subject_2        = $cssST;
    $css->recruitment_appointment_nature   = $cssST;
    $css->intial_appointment_remark        = $cssST;



    $css->pay_commission_id            = $cssST;
    $css->scale_id                 = $cssST;
    $css->pay_matrix                 = $cssST;
    $css->pay_in_band               = $cssST;
    $css->grade_pay                 = $cssST;
    $css->basic_pay                 = $cssST;
    $css->next_increment_date       = $cssST;
    $css->senior_grade              = $cssST;
    $css->selection_grade           = $cssST;
    $css->pan_no                    = $cssST;
    $css->pay_wef_date              = $cssST;
    $css->senior_grade_date         = $cssST;
    $css->selection_grade_date      = $cssST;







    $readFlag->upload_photo             = '';
    $readFlag->staff_name               = '';
    $readFlag->staff_name_adhar         = '';    
    $readFlag->dob                      = '';
    $readFlag->gender                   = '';
    $readFlag->aadhar                   = '';
    $readFlag->mobile                   = '';
    $readFlag->email                    = '';
    $readFlag->current_post             = '';
    $readFlag->post_group               = '';
    $readFlag->post_aid                 = '';
    $readFlag->recruitment_subject      = '';
    $readFlag->posting_mode             = '';
    $readFlag->shikshan_sevak           = '';
    $readFlag->joining_date             = '';
    $readFlag->joining_district         = '';
    $readFlag->joining_block            = '';
    $readFlag->joining_mgmt             = '';
    $readFlag->joining_school           = '';
    $readFlag->joining_designation      = '';
    $readFlag->superannuation           = '';
    $readFlag->initial_order            = '';
    $readFlag->approval_order           = '';
    $readFlag->medical_certificate      = '';
    $readFlag->police_certificate       = '';

    
                                            
    $readFlag->marital_status        = '';
    $readFlag->children              = '';
    $readFlag->domicile              = '';
    $readFlag->border_village        = '';
    $readFlag->suicide_farmer_child  = '';
    $readFlag->non_vremy             = '';
    $readFlag->freedom_fighter_ward  = '';
    $readFlag->election_1991         = '';
    $readFlag->election_1994         = '';
    $readFlag->mother_tongue         = '';
    $readFlag->blood_group           = '';
    $readFlag->lang1                 = '';
    $readFlag->lang2                 = '';
    $readFlag->lang3                 = '';
    $readFlag->remarks               = '';
    $readFlag->upload_photo          = '';
                    
                                     
    
    $readFlag->election_card                  = '';
    $readFlag->ex_servicemen                  = '';
    $readFlag->height                         = '';
    $readFlag->weight                         = '';
    $readFlag->identification_mark1           = '';
    $readFlag->identification_mark2           = '';
    $readFlag->no_of_non_teaching_working_days = '';
    $readFlag->capable_handling_digital       = '';
    $readFlag->teacher_deputation_school      = '';
    $readFlag->is_uid_verified                = '';
    $readFlag->teaching_other_school          = '';
                                            
                                      
              
    $readFlag->religion                          = '';
    $readFlag->social_category                   = '';
    $readFlag->caste                             = '';
    $readFlag->certificate_no                    = '';
    $readFlag->certificate_date                  = '';
    $readFlag->certificate_issuing_authority     = '';
    $readFlag->certificate_place                 = '';
    $readFlag->certificate_file                  = '';
    $readFlag->certificate_remarks               = '';
    $readFlag->certificate_validation_no         = '';
    $readFlag->certificate_validation_date       = '';
    $readFlag->certificate_validation_authority  = '';
    $readFlag->certificate_validation_place      = '';
    $readFlag->certificate_validation_file       = '';
    $readFlag->certificate_validation_remarks    = '';

    
    $readFlag->is_disabled                               = '';
    $readFlag->disability_type                           = '';
    $readFlag->disability_percentage                     = '';
    $readFlag->disability_certificate_no                 = '';
    $readFlag->disability_certificate_date               = '';
    $readFlag->disability_certificate_issuing_authority  = '';
    $readFlag->disability_certificate_place              = '';
     
     
    $readFlag->disability_id                             = '';
    $readFlag->disability_certificate_file               = '';
    $readFlag->disability_remarks                        = '';


    $readFlag->math_studied_upto             = '';
    $readFlag->science_studied_upto          = '';
    $readFlag->english_studied_upto          = '';
    $readFlag->social_studies_studied_upto   = '';
    $readFlag->language_studied_upto         = '';
    $readFlag->teaching_level                = '';
    $readFlag->main_subject1                 = '';
    $readFlag->main_subject2                 = '';



    $readFlag->tet_paper1_pass             = '';
    $readFlag->tet_paper1_number           = '';
    $readFlag->tet_paper1_percentage       = '';
    $readFlag->tet_paper1_teacher_category = '';
    $readFlag->tet_paper1_pasing_month     = '';
    $readFlag->tet_paper1_pasing_year      = '';

    $readFlag->ctet_paper1_pass             = '';
    $readFlag->ctet_paper1_number           = '';
    $readFlag->ctet_paper1_percentage       = '';
    $readFlag->ctet_paper1_teacher_category = '';
    $readFlag->ctet_paper1_pasing_month     = '';
    $readFlag->ctet_paper1_pasing_year      = '';

    $readFlag->tet_paper2_pass                  = '';
    $readFlag->tet_paper2_number           = '';
    $readFlag->tet_paper2_percentage       = '';
    $readFlag->tet_paper2_teacher_category = '';
    $readFlag->tet_paper2_pasing_month     = '';
    $readFlag->tet_paper2_pasing_year      = '';

    $readFlag->ctet_paper2_pass             = '';
    $readFlag->ctet_paper2_number           = '';
    $readFlag->ctet_paper2_percentage       = '';
    $readFlag->ctet_paper2_teacher_category = '';
    $readFlag->ctet_paper2_pasing_month     = '';
    $readFlag->ctet_paper2_pasing_year      = '';



    
                                                
    $readFlag->classes_taught                = '';
    $readFlag->current_appointment_subject   = '';
    $readFlag->subject_taught_first          = '';
    $readFlag->subject_taught_second         = '';                               
                                                    
    $readFlag->pf->acc_type                 = ''; 
    $readFlag->pf->acc_maintained_by        = ''; 
    $readFlag->pf->series                   = ''; 
    $readFlag->pf->gpf_account_no           = '';  
    $readFlag->pf->pf_remarks               = ''; 

    
    $readFlag->bank->bank_name               = '';  
    $readFlag->bank->branch_name             = '';  
    $readFlag->bank->acc_name                = '';  
    $readFlag->bank->acc_number              = '';  
    $readFlag->bank->ifsc                    = '';  
    $readFlag->bank->micr                    = '';    


    

    $readFlag->train->trained_cwsn                    = '';
    $readFlag->train->training_computer               = '';
    $readFlag->train->training_received               = '';
    $readFlag->train->training_needed                 = '';
    $readFlag->train->training_nishtha                = '';
    $readFlag->train->training_ssa                    = '';
    $readFlag->train->psy_soc_aspect                  = '';
    $readFlag->train->support_cwsn                    = '';


    $readFlag->recruitment_mode                 = '';
    $readFlag->current_post_mode                 = '';

    $readFlag->initial_post                     = '';
    $readFlag->mode_of_post                     = '';
    $readFlag->recruitment_category             = '';
    $readFlag->recruitment_hor_category         = '';
    $readFlag->recruitment_ph_category           = '';
    $readFlag->recruitment_orphan_category       = '';
    $readFlag->appointment_for_subject_1        = '';
    $readFlag->appointment_for_subject_2        = '';
    $readFlag->recruitment_appointment_nature   = '';
    $readFlag->intial_appointment_remark        = '';


    $readFlag->pay_commission_id           = '';
    $readFlag->scale_id                = '';
    $readFlag->pay_matrix                = '';
    $readFlag->senior_grade             = '';
    $readFlag->selection_grade          = '';
    $readFlag->pay_in_band              = '';
    $readFlag->grade_pay                = '';
    $readFlag->basic_pay                = '';
    $readFlag->pan_no                   = '';
    $readFlag->pay_wef_date             = '';
    $readFlag->next_increment_date      = '';
    $readFlag->senior_grade_date        = '';
    $readFlag->selection_grade_date     = '';


    

    $css->is_uid_verified                = $cssUD;
    $css->social_category                = $cssUD;
    $css->disability_type                = $cssUD;

    $readFlag->is_uid_verified           = 'disabled';
    $readFlag->social_category           = 'disabled';
    $readFlag->disability_type           = 'disabled';

    /***UDISE+ */
    $css->staff_name            = $cssUD;
    $css->dob                   = $cssUD;
    $css->gender                = $cssUD;
    $css->mobile                = $cssUD;
    $css->email                 = $cssUD;
    $css->is_uid_verified                = $cssUD;
    $css->social_category                = $cssUD;
    $css->recruitment_appointment_nature = $cssUD;

    
    $readFlag->staff_name               = 'disabled';
    $readFlag->dob                      = 'disabled';
    $readFlag->gender                   = 'disabled';
    $readFlag->mobile                   = 'disabled';
    $readFlag->is_uid_verified           = 'disabled';
    $readFlag->social_category           = 'disabled';
    $readFlag->recruitment_appointment_nature = 'disabled';

    if($updateMode == 2){
        
        $css->staff_name            = $cssSH;
        $css->staff_name_adhar      = $cssSH;
        $css->dob                   = $cssSH;
        $css->gender                = $cssSH;
        $css->aadhar                = $cssSH;
        $css->mobile                = $cssSH;
        $css->email                 = $cssSH;
        $css->current_post          = $cssSH;
        $css->post_group            = $cssSH;
        $css->post_aid              = $cssSH;
        $css->recruitment_subject   = $cssSH;
        $css->recruitment_category   = $cssSH;
        $css->recruitment_mode       = $cssSH;

   

        
        $css->posting_mode          = $cssSH;
        $css->joining_date          = $cssSH;
        $css->joining_school        = $cssSH;
        $css->superannuation        = $cssSH;
        $css->marital_status        = $cssSH;

        $css->is_uid_verified                = $cssUD;
        $css->social_category                = $cssUD;
        $css->disability_type                = $cssUD;

        $css->is_disabled      = $cssSH;

        $css->math_studied_upto             = $cssUD;
        $css->science_studied_upto          = $cssUD;
        $css->english_studied_upto          = $cssUD;
        $css->social_studies_studied_upto   = $cssUD;
        $css->language_studied_upto         = $cssUD;
        $css->teaching_level                = $cssUD;
        $css->main_subject1                 = $cssUD;
        $css->main_subject2                 = $cssUD;

        $css->tet_paper1_pass                = $cssUD;
        $css->tet_paper1_pasing_month        = $cssUD;
        $css->tet_paper1_pasing_year         = $cssUD;

        
        $css->pay_commission_id            = $cssSH;
        $css->scale_id                 = $cssSH;
        $css->pay_matrix                 = $cssSH;
        $css->pay_in_band               = $cssSH;
        $css->grade_pay                 = $cssSH;
        $css->basic_pay                 = $cssSH;
        $css->next_increment_date       = $cssSH;
                                                
        $css->classes_taught                = $cssUD;
        $css->current_appointment_subject   = $cssUD;
        $css->subject_taught_first          = $cssUD;
        $css->subject_taught_second         = $cssUD;   
                  
        $css->pf->acc_type                 = $cssSH;
        $css->pf->acc_maintained_by        = $cssSH;
        $css->pf->series                   = $cssSH;
        $css->pf->gpf_account_no           = $cssSH;

        $css->bank->bank_name               = $cssSH; 
        $css->bank->branch_name             = $cssSH;  
        $css->bank->acc_number              = $cssSH;  
        $css->bank->ifsc                    = $cssSH;

        $css->train->trained_cwsn                    = $cssUD;
        $css->train->training_computer               = $cssUD;
        $css->train->training_received               = $cssUD;
        $css->train->training_needed                 = $cssUD;
        $css->train->training_nishtha                = $cssUD;
        $css->train->training_ssa                    = $cssUD;
        $css->train->psy_soc_aspect                  = $cssUD;
        $css->train->support_cwsn                    = $cssUD;

        $readFlag->is_uid_verified           = 'disabled';
        $readFlag->social_category           = 'disabled';
        $readFlag->disability_type           = 'disabled';



       
        $readFlag->staff_name               = 'disabled';
        $readFlag->staff_name_adhar         = 'disabled';    
        $readFlag->dob                      = 'disabled';
        $readFlag->gender                   = 'disabled';
        $readFlag->aadhar                   = 'disabled';
        $readFlag->mobile                   = 'disabled';
        $readFlag->email                    = 'disabled';
        $readFlag->current_post             = 'disabled';
        $readFlag->post_group               = 'disabled';
        $readFlag->post_aid                 = 'disabled';
        $readFlag->recruitment_subject      = 'disabled';
        $readFlag->recruitment_category     = 'disabled';
        $readFlag->recruitment_mode         = 'disabled';
        $readFlag->posting_mode             = 'disabled';
        $readFlag->shikshan_sevak           = 'disabled';
        $readFlag->joining_date             = 'disabled';       
        $readFlag->joining_school           = 'disabled';
        $readFlag->superannuation           = 'disabled';
        /*$readFlag->initial_order            = 'disabled';
        $readFlag->approval_order           = 'disabled';
        $readFlag->medical_certificate      = 'disabled';
        $readFlag->police_certificate       = 'disabled';*/

        $readFlag->marital_status           = 'disabled';

        $readFlag->is_uid_verified          = 'disabled';

        $readFlag->is_disabled              = 'disabled';

        $readFlag->math_studied_upto              = 'disabled';
        $readFlag->science_studied_upto           = 'disabled';
        $readFlag->english_studied_upto           = 'disabled';
        $readFlag->social_studies_studied_upto    = 'disabled';
        $readFlag->language_studied_upto          = 'disabled';
        $readFlag->teaching_level                 = 'disabled';
        $readFlag->main_subject1                  = 'disabled';
        $readFlag->main_subject2                  = 'disabled';

        $readFlag->tet_paper1_pass             = 'disabled';
        $readFlag->tet_paper1_pasing_month     = 'disabled';
        $readFlag->tet_paper1_pasing_year      = 'disabled';

        $readFlag->classes_taught                = 'disabled';
        $readFlag->current_appointment_subject   = 'disabled';
        $readFlag->subject_taught_first          = 'disabled';
        $readFlag->subject_taught_second         = 'disabled';  

        $readFlag->pay_commission_id            = 'disabled';
        $readFlag->scale_id                 = 'disabled';
        $readFlag->pay_matrix                 = 'disabled';
        $readFlag->pay_in_band               = 'disabled';
        $readFlag->grade_pay                 = 'disabled';
        $readFlag->basic_pay                 = 'disabled';
        $readFlag->next_increment_date       = 'disabled';

        $readFlag->pf->acc_type                 = 'disabled';
        $readFlag->pf->acc_maintained_by        = 'disabled';
        $readFlag->pf->series                   = 'disabled';
        $readFlag->pf->gpf_account_no           = 'disabled';

        $readFlag->bank->bank_name               = 'disabled';  
        $readFlag->bank->branch_name             = 'disabled';  
        $readFlag->bank->acc_name                = '';  
        $readFlag->bank->acc_number              = 'disabled';  
        $readFlag->bank->ifsc                    = 'disabled';  
        $readFlag->bank->micr                    = ''; 


        $readFlag->train->trained_cwsn                    = 'disabled';
        $readFlag->train->training_computer               = 'disabled';
        $readFlag->train->training_received               = 'disabled';
        $readFlag->train->training_needed                 = 'disabled';
        $readFlag->train->training_nishtha                = 'disabled';
        $readFlag->train->training_ssa                    = 'disabled';
        $readFlag->train->psy_soc_aspect                  = 'disabled';
        $readFlag->train->support_cwsn                    = 'disabled';

    }
    
    $is_social_category = true;
    if($staff->social_category_id <= 0){
        
        $is_social_category = false;
        $social_category = "NA";
    }else{
         
        //$social_category = $staff?->caste_category?->category_name;    
        $social_category = $staff?->caste_category?->category_name ?? 'Not Available';    
        if((in_array($staff->social_category_id,array(1,99)))){
             
            $is_social_category = false;                            
        }
    }
    /*
        echo "<pre>";
        print_r($staff);
        exit;
        */


    $districtOptions = '<option value="">Select District</option>';
    foreach ($districts as $d):
        $districtOptions .='<option value="'.h($d->id).'">'.h($d->name_en).'</option>';
    endforeach; 

    $languageOptions = '<option value="">Select Language</option>';
    foreach ($languages as $l):
        $languageOptions .='<option value="'.h($l->id).'">'.h($l->name).'</option>';
    endforeach; 

    $motherTongueOptions = '<option value="">Select Mother Tongue</option>';
    foreach ($mediums as $l):
        $motherTongueOptions .='<option value="'.h($l->id).'">'.h($l->name).'</option>';
    endforeach; 


    $casteValidAuthorityOptions = '<option value="">Select Caste Validity Authority</option>';
    foreach ($casteValidAuthority as $c):
        $casteValidAuthorityOptions .='<option value="'.h($c->id).'">'.h($c->name).'</option>';
    endforeach; 

        
    $subject1Options = '<option value="">Select Subject</option>';
    $subject2Options = '<option value="">Select Subject</option>';
    $recruitmentSubjectOptions = '<option value="">Select Subject</option>';
 
    foreach ($subjects as $s):
        if($staff->appointment_for_subject_1 == $s->id){
            $subject1Options .='<option value="'.h($s->id).'" selected>'.h($s->name).'</option>';
        }else{
            $subject1Options .='<option value="'.h($s->id).'">'.h($s->name).'</option>';
        }
        if($staff->appointment_for_subject_2 == $s->id){
            $subject2Options .='<option value="'.h($s->id).'" selected>'.h($s->name).'</option>';
        }else{
            $subject2Options .='<option value="'.h($s->id).'">'.h($s->name).'</option>';
        }
        if($staff->subject == $s->id){
            $recruitmentSubjectOptions .='<option value="'.h($s->id).'" selected>'.h($s->name).'</option>';
        }else{
            $recruitmentSubjectOptions .='<option value="'.h($s->id).'">'.h($s->name).'</option>';
        }
    endforeach; 

    $appointment_typesOptions = '<option value="">Select Appointment Types</option>';
    foreach ($appointment_types as $at):
        if($staff->mode_of_recruitment_id == $at->code){
            $appointment_typesOptions .='<option value="'.h($at->code).'" selected>'.h($at->name).'</option>';
        }else{
            $appointment_typesOptions .='<option value="'.h($at->code).'">'.h($at->name).'</option>';
        }          
    endforeach; 

   //echo $staff->mode_of_recruitment_id;
   //echo $appointment_typesOptions;
   //exit;
    $horizontalCategoriesOptions = '<option value="">Select Horizontal Categories</option>';
    foreach ($horizontalCategories as $hc):
        if($staff->recruitment_hor_category == $hc->id){
            $horizontalCategoriesOptions .='<option value="'.h($hc->id).'" selected>'.h($hc->name).'</option>';
        }else{
            $horizontalCategoriesOptions .='<option value="'.h($hc->id).'">'.h($hc->name).'</option>';
        }        
    endforeach; 


    
    $postsOptions = '<option value="">Select Post</option>';
    $currentPostsOptions = '<option value="">Select Post</option>';
    //echo $staff->initial_post."<=>".$staff->shalarth_post_id;
    //exit;
    //echo "<pre>";

    foreach ($posts as $p):       
        if($staff->initial_post == $p->code){
            $postsOptions .='<option value="'.h($p->id).'" selected>'.h($p->name).'</option>';
        }else{
            $postsOptions .='<option value="'.h($p->id).'">'.h($p->name).'</option>';
        }
        if($staff->post_id == $p->id){
            $currentPostsOptions .='<option value="'.h($p->id).'" selected>'.h($p->name).'</option>';
        }else{
            $currentPostsOptions .='<option value="'.h($p->id).'">'.h($p->name).'</option>';
        }
    endforeach; 
    // print_r($currentPostsOptions);
    //exit;
    /*
    echo "<pre>";
    print_r($staff);
    exit;*/

    $socialCasteOptions = '<option value="">Select Socia Category</option>';
    $recuritmentCasteOptions = '<option value="">Select Recuritment Category</option>';
    foreach ($castes as $c):
        if($staff->social_category_id == $c->code){
            $socialCasteOptions .='<option value="'.h($c->code).'" selected>'.h($c->category_name).'</option>';
        }else{
            $socialCasteOptions .='<option value="'.h($c->code).'">'.h($c->category_name).'</option>';
        }

        if($staff->recruitment_category == $c->code){
            $recuritmentCasteOptions .='<option value="'.h($c->code).'" selected>'.h($c->category_name).'</option>';
        }else{
            $recuritmentCasteOptions .='<option value="'.h($c->code).'">'.h($c->category_name).'</option>';
        }
    endforeach; 
    
    $recruitmentPHCategoriesOptions = '<option value="">Select Physical Handicap Category</option>';


    foreach ($disabilityTypes as $dt):
        if($staff->recruitment_ph_category == $dt->id){
            $recruitmentPHCategoriesOptions .='<option value="'.h($dt->id).'" selected>'.h($dt->dt_code).'</option>';
        }else{
            $recruitmentPHCategoriesOptions .='<option value="'.h($dt->id).'" selected>'.h($dt->dt_code).'</option>';  
        }            
    endforeach; 

    $recruitmentAppointmentOptions  = '<option value="">Select Appointment Types</option>';
    $recruitmentAppointmentOptions .='<option value="1">Regular</option>';
    $recruitmentAppointmentOptions .='<option value="2">Contract</option>';
    $recruitmentAppointmentOptions .='<option value="3">Part-Time/Guest</option>';

    $maritalStatuses = array(0 => "NON MENTIONED", 1 =>'MARRIED', 2 => 'UNMARRIED', 3 => 'DIVORCED', 4 => 'WIDOWED');
    $maritalOptions  = '<option value="">Select Marital Option</option>';

    foreach ($maritalStatuses as $mk => $mv):
        if($staff->maritial_status == $mk){
            $maritalOptions .='<option value="'.h($mk).'" selected>'.h($mv).'</option>';
        }else{
            $maritalOptions .='<option value="'.h($mk).'">'.h($mv).'</option>';
        }        
    endforeach; 


    $orphanStatuses = array(0 => "NA", 1 =>'Internal Orphan', 2 => 'External Orphan');
    $orphanOptions  = '<option value="">Select Recruitment Orphan Category</option>';
    foreach ($orphanStatuses as $mk => $mv):        
        if($staff->recruitment_orphan_category == $mk){
            $orphanOptions .='<option value="'.h($mk).'" selected>'.h($mv).'</option>';
        }else{
            $orphanOptions .='<option value="'.h($mk).'">'.h($mv).'</option>';
        } 
             
    endforeach; 

    $currentPostModeStatuses = array(0 => "NA", 1 =>'Direct', 2 => 'Transfer Approval',3=> 'Promotion Approval');
    $currentPostModeOptions  = '<option value="">Select current Post Mode</option>';
    $servicePostModeOptions  = '<option value="">Select current Post Mode</option>';
    foreach ($currentPostModeStatuses as $mk => $mv):
        
        if($staff->current_post_mode == $mk){
            $currentPostModeOptions .='<option value="'.h($mk).'" selected>'.h($mv).'</option>';
        }else{
            $currentPostModeOptions .='<option value="'.h($mk).'">'.h($mv).'</option>';
        } 
              
        $servicePostModeOptions .='<option value="'.h($mk).'">'.h($mv).'</option>';      
    endforeach;


    
    
?>

<input type="hidden" id="__sid" value="<?= h($staff->id) ?>">
<input type="hidden" id="__umode" value="<?= h($updateMode) ?>">

            <div class="card profile-card" role="region" aria-labelledby="profileTitle">
                <div class="card shadow-sm profile-card-horizontal" style="background:#D6EAF8;border:0px;border-radius: 0px;">
                    <div class="card-body d-flex align-items-center" style="padding:0px;">
                        <div class="avatar bg-primary text-white rounded-circle me-3 d-flex justify-content-center align-items-center"
                            style="width:60px; height:60px; font-size:28px;">

                            <img src="<?= h($imgData) ?>" alt="Profile" class="rounded-circle" style="width:60px; height:60px;"/>
                        </div>
                        <div class="flex-grow-1">
                            <div class="row g-1 small">
                                <div class="col-md-4">
                                    <h6 class="mb-1 fw-bold" style="font-size:14px;color:#8b008b"><?= h($staff->emp_name ?? '') ?></h6>
                                </div>
                               <div class="col-md-6" style="font-size:12px;">
                               <strong>Designation:</strong> <?= h($staff->post->name ?? '') ?> (<?= h($staff->current_post ?? '') ?>)
                                |
                                    <strong>Staff Type:</strong> <?= h($staff->staffs_type->staff_type_name ?? '') ?> 
                                </div>
                                <div class="col-md-2" style="font-size:12px;">
                                    <strong>NationalID:</strong> <?= h($staff->nat_tch_id ?? '') ?> 
                                </div>
                                <div class="col-md-4" style="font-size:12px;">
                                    Joining &rarr;
                                    <strong> Service:</strong> <?= h(!empty($staff->joining_date) ? date('d/m/Y', strtotime($staff->joining_date)) : '') ?>
                                    
                                    |
                                    <strong> School:</strong> <?= h(!empty($staff->date_of_joining_current_school) ? date('d/m/Y', strtotime($staff->date_of_joining_current_school)) : '') ?>
                                
                                </div>
                                <div class="col-md-6" style="font-size:12px;">
                                    <strong>Mobile:</strong> <?= h($staff->mobile ?? '') ?> |
                                    <strong>Gender:</strong> <?= h($staff->gender->gender_name ?? '') ?>
                                |
                                    <strong>Social Category:</strong> <?= h($social_category ?? '') ?>
                                </div>
                                <div class="col-md-2" style="font-size:12px;">
                                    <strong>ShalarthID:</strong> <?= h($staff->shalarth_code ?? '') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="layout-container">
                    <div class="profilecontainer">
                        <nav class="sidebar" >
                            <button class="btn close-btn" onclick="toggleSidebar()"><i class="fas fa-times"></i></button>
                            <ul class="menu">
                                <li class="menu-item">
                                    <button class="menu-btn"><span><i class="fa-solid fa-user"></i> Basic Information</span> ▾</button>
                                    <ul class="submenu" >
                                        <li><a href="#" onclick="leftMenuClick(0);" data-breadcrumb="Basic Information → Personal Details"><i class="fa-solid fa-id-card"></i>&nbsp;&nbsp;&nbsp;Personal Details</a></li>
                                        <li><a href="#" onclick="leftMenuClick(1);" data-breadcrumb="Basic Information → Address Details"><i class="fa-solid fa-location-dot"></i>&nbsp;&nbsp;&nbsp;Address Details</a></li>
                                        <li><a href="#" onclick="leftMenuClick(2);" data-breadcrumb="Basic Information → Other Personal Details"><i class="fa-solid fa-user-tag"></i>&nbsp;&nbsp;&nbsp;Other Personal Details</a></li>
                                        <li><a href="#" onclick="leftMenuClick(3);" data-breadcrumb="Basic Information → Family & Nomination"><i class="fa-solid fa-users"></i>&nbsp;&nbsp;&nbsp;Family Details</a></li>
                                        <!--<li><a href="#" onclick="leftMenuClick(4);" data-breadcrumb="Basic Information → Nomination Details"><i class="fa-solid fa-hand-holding-heart"></i>&nbsp;&nbsp;&nbsp;Nomination Details</a></li>-->
                                    </ul>
                                </li>


                                <li class="menu-item">
                                    <button class="menu-btn"><span><i class="fa-solid fa-id-card"></i> Caste & Disability</span> ▾</button>
                                    <ul class="submenu">
                                        <li><a href="#" onclick="leftMenuClick(4);" data-breadcrumb="Caste & Disability → Caste Category & Certification">Caste Details</a></li>
                                        <li><a href="#" onclick="leftMenuClick(5);" data-breadcrumb="Caste & Disability → Disability Details">Disability Details</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item">
                                    <button class="menu-btn"><span><i class="fa-solid fa-graduation-cap"></i> Qualifications</span> ▾</button>
                                    <ul class="submenu">
                                        <li><a href="#" onclick="leftMenuClick(6);" data-breadcrumb="Qualifications → Academic Qualifications">Academic Qualifications</a></li>
                                        <li><a href="#" onclick="leftMenuClick(7);" data-breadcrumb="Qualifications → Professional Qualifications">Professional Qualifications</a></li>
                                        <li><a href="#" onclick="leftMenuClick(8);" data-breadcrumb="Qualifications → UDISE Qualification Details">UDISE Qualification Details</a></li>
                                        <li><a href="#" onclick="leftMenuClick(9);" data-breadcrumb="Qualifications → TET/CTET Details">TET/CTET Details</a></li>
                                    </ul>
                                </li>
                
                                <li class="menu-item">
                                    <button class="menu-btn"><span><i class="fa-solid fa-briefcase"></i> Employment Details</span> ▾</button>
                                    <ul class="submenu">
                                        <!--<li><a href="#content-section-11" data-breadcrumb="Other Details → Initial Appointment">Initial Appointment</a></li>-->
                                        <li><a href="#" onclick="leftMenuClick(10);" data-breadcrumb="Other Details → Teaching Details (UDISE)">Teaching Details (UDISE)</a></li>
                                        <li><a href="#" onclick="leftMenuClick(11);" data-breadcrumb="Other Details → Service Tracking">Service Tracking</a></li>
                                        <!--<li><a href="#" onclick="leftMenuClick(10);" data-breadcrumb="Other Details → Attach / Detach">Attach / Detach</a></li>
                                        <li><a href="#" onclick="leftMenuClick(10);" data-breadcrumb="Other Details → Superannuation">Superannuation</a></li>
                                        <li><a href="#" onclick="leftMenuClick(10);" data-breadcrumb="Other Details → Death Cases">Death Cases</a></li>-->
                                    </ul>
                                </li>
                                <li class="menu-item">
                                    <button class="menu-btn"><span><i class="fa-solid fa-sack-dollar"></i> Financial & Benefits</span> ▾</button>
                                    <ul class="submenu">
                                        <li><a href="#" onclick="leftMenuClick(12);" data-breadcrumb="Financial & Benefits → Pay Details">Pay Details</a></li>
                                        <li><a href="#" onclick="leftMenuClick(13);" data-breadcrumb="Financial & Benefits → PF/DCPS/GPF">PF/DCPS/GPF</a></li>
                                        <li><a href="#" onclick="leftMenuClick(14);" data-breadcrumb="Financial & Benefits → Bank Account">Bank Account</a></li>
                                        <li><a href="#" onclick="leftMenuClick(15);" data-breadcrumb="Financial & Benefits → Leave Details">Leave Details</a></li>
                                        <li><a href="#" onclick="leftMenuClick(16);" data-breadcrumb="Financial & Benefits → Rewards">Rewards</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item">
                                    <button class="menu-btn"><span><i class="fa-solid fa-chalkboard-teacher"></i> Training & Compliance</span> ▾</button>
                                    <ul class="submenu">
                                        <li><a href="#" onclick="leftMenuClick(17);" data-breadcrumb="Training & Compliance → Training Attended">Training Attended</a></li>
                                        <li><a href="#" onclick="leftMenuClick(18);" data-breadcrumb="Training & Compliance → Disciplinary Actions">Disciplinary Actions</a></li>
                                        <!--<li><a href="#" onclick="leftMenuClick(20);" data-breadcrumb="Training & Compliance → Complaints">Complaints</a></li>-->
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                        <main class="content">
                            <div class="d-flex justify-content-between align-items-center" style="background: linear-gradient(45deg, #537895, #333);color: white;">
                                <nav style="font-size: 18px;" aria-label="breadcrumb" class="p-2 shadow-sm mb-3" >
                                    <ol id="breadcrumbTrail" class="breadcrumb mb-0" style="--bs-breadcrumb-divider: '→';">
                                        <li class="breadcrumb-item">
                                            <i class="fas fa-user-tie"></i> Staff Management
                                        </li>
                                        <li class="breadcrumb-item">
                                            Basic Information
                                        </li>
                                        <li class="breadcrumb-item" aria-current="page">
                                            Personal Details
                                        </li>
                                    </ol>
                                </nav>
                                <div class="btn-group">
                                    <button id="prevBtn" class="btn btn-warning me-2 " disabled>
                                        <i class="bi bi-arrow-left"></i> Previous
                                    </button>
                                    <button id="nextBtn" class="btn btn-primary me-2">
                                        Next <i class="bi bi-arrow-right"></i>
                                    </button>

                                     <!-- <button id="prvBtn" class="btn btn-warning">
                                        Preview <i class="bi bi-arrow-right"></i>
                                    </button> -->
                                </div>
                            </div>

                            <div id="contentArea" class="card p-3 shadow-sm">
                                <section id="content-section-0" class="content-section"><!-- Personal details start -->
                                    <form id="content-section-form-0">
                                        
                                        <div class="row g-3">
                                            

                                            <div class="col-md-4">
                                                <div class="custom-box border rounded-3 p-3 shadow-sm  required-field <?= h($css->staff_name) ?>">
                                                    <label for="staff_name" class="form-label fw-semibold">Staff Name</label>
                                                    <input class="form-control" type="text" id="staff_name" name="staff_name" value="<?= h($staff->emp_name ?? '') ?>" <?= h($readFlag->staff_name) ?>>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="custom-box border rounded-3 p-3 shadow-sm  required-field <?= h($css->staff_name_adhar ?? '') ?>">
                                                    <label for="staff_name_adhar" class="form-label fw-semibold">Staff Name as per Aadhaar</label>
                                                    <input class="form-control" type="text" id="staff_name_adhar" name="staff_name_adhar" value="<?= h($staff->emp_name_per_uid ?? '') ?>"  <?= h($readFlag->staff_name_adhar) ?>>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="custom-box border rounded-3 p-3 shadow-sm  required-field <?= h($css->aadhar ?? '') ?>">
                                                    <label for="aadhar" class="form-label fw-semibold">Aadhaar Card Number</label>
                                                    <input class="form-control" type="text" id="aadhar" name="aadhar" value="<?= h($staff->adhar_no ?? '') ?>"  <?= h($readFlag->aadhar) ?>>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="custom-box border rounded-3 p-3 shadow-sm  required-field <?= h($css->dob ?? '') ?>">
                                                    <label for="dob" class="form-label fw-semibold">Date of Birth</label>
                                                    <input class="form-control" type="text" id="dob" name="dob" value="<?= h(!empty($staff->dob) ? date('d/m/Y', strtotime($staff->dob)) : '') ?>"  <?= h($readFlag->dob) ?>>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="custom-box border rounded-3 p-3 shadow-sm  required-field <?= h($css->gender ?? '') ?>">
                                                    <label for="gender" class="form-label fw-semibold">Gender</label>
                                                    <input class="form-control" type="text" id="gender" name="gender" value="<?= h($staff->gender->gender_name ?? '') ?>"  <?= h($readFlag->gender) ?>>
                                                </div>
                                            </div>

                                            

                                            <div class="col-md-3">
                                                <div class="custom-box border rounded-3 p-3 shadow-sm  required-field <?= h($css->mobile ?? '') ?>">
                                                    <label for="mobile" class="form-label fw-semibold">Mobile Number</label>
                                                    <input class="form-control" type="text" id="mobile" name="mobile" value="<?= h($staff->mobile ?? '') ?>"  <?= h($readFlag->mobile) ?>>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="custom-box border rounded-3 p-3 shadow-sm required-field <?= h($css->email ?? '') ?>">
                                                    <label for="email" class="form-label fw-semibold">Email ID</label>
                                                    <input class="form-control" type="text" id="email" name="email" value="<?= h($staff->email ?? '') ?>" <?= h($readFlag->email) ?>>
                                                    <div class="validation-error-message" id="error_email"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="custom-box border rounded-3 p-3 shadow-sm  required-field <?= h($css->current_post ?? '') ?>">
                                                    <label for="current_post" class="form-label fw-semibold">Current Post / Designation</label>
                                                    <select class="form-select" id="current_post" name="current_post" <?= h($readFlag->current_post) ?>>
                                                        <?php echo $currentPostsOptions; ?> 
                                                    </select>

                                                    
                                                </div>
                                            </div>
                                            <?php
                                                $selectGroupC = "";
                                                $selectGroupD = "";
                                                if($staff->desig_grp == 'C'){
                                                    $selectGroupC = "selected";
                                                }
                                                if($staff->desig_grp == 'D'){
                                                    $selectGroupD = "selected";
                                                }
                                            ?>
                                            
                                            <div class="col-md-4">
                                                <div class="custom-box border rounded-3 p-3 shadow-sm  required-field <?= h($css->post_group ?? '') ?>">
                                                    <label for="post_group" class="form-label fw-semibold">Current Post Group</label>
                                                    <select class="form-select"  id="post_group" name="post_group"  <?= h($readFlag->post_group) ?>>                                    
                                                        <option value="C" <?= h($selectGroupC ?? '') ?>>C</option>
                                                        <option value="D" <?= h($selectGroupD ?? '') ?>>D</option>    
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="custom-box border rounded-3 p-3 shadow-sm  required-field <?= h($css->post_aid ?? '') ?>">
                                                    <label for="post_aid" class="form-label fw-semibold">Current Post Aid Type</label>
                                                    <input class="form-control" type="text" id="post_aid" name="post_aid" value="<?= h($staff->current_post_aid_type ?? '') ?>"  <?= h($readFlag->post_aid) ?>>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="custom-box border rounded-3 p-3 shadow-sm required-field <?= h($css->appointment_for_subject_1 ?? '') ?>">
                                                    <label for="appointment_for_subject_1" class="form-label fw-semibold">Current Teaching Subject 1</label>
                                                    <select class="form-select appointment-for-subject-select" id="appointment_for_subject_1" name="appointment_for_subject_1" <?= h($readFlag->appointment_for_subject_1) ?>>
                                                        <?php echo $subject1Options; ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->appointment_for_subject_2 ?? '') ?>">
                                                    <label for="appointment_for_subject_2" class="form-label fw-semibold">Current Teaching Subject 2</label>
                                                    <select class="form-select appointment-for-subject-select" id="appointment_for_subject_2" name="appointment_for_subject_2" <?= h($readFlag->appointment_for_subject_2) ?>>
                                                        <?php echo $subject2Options; ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="custom-box border rounded-3 p-3 shadow-sm required-field <?= h($css->current_post_mode ?? '') ?>">
                                                    <label for="current_post_mode" class="form-label fw-semibold">Mode of Current Post</label>
                                                    
                                                    <select class="form-select" id="current_post_mode" name="current_post_mode" <?= h($readFlag->current_post_mode) ?>>
                                                        <?php echo $currentPostModeOptions; ?> 
                                                    </select>
                                                    
                                                </div>
                                            </div>  

                                        </div>
                                        <div style="clear:both;">&nbsp;</div>
                                        <div class="row g-2" style="padding:10px;background:#c1c1c1">
                                            <div class="col-md-4">
                                                <div class="custom-box border rounded-3 p-3 shadow-sm required-field <?= h($css->recruitment_mode ?? '') ?>">
                                                    <label for="recruitment_mode" class="form-label fw-semibold">Mode of Recruitment</label>
                                                    
                                                    <select class="form-select" id="recruitment_mode" name="recruitment_mode" <?= h($readFlag->recruitment_mode) ?>>
                                                        <?php echo $appointment_typesOptions; ?> 
                                                    </select>
                                                    
                                                </div>
                                            </div>                                     

                                            
                                            <div class="col-md-4">
                                                <div class="custom-box border rounded-3 p-3 shadow-sm required-field <?= h($css->initial_post ?? '') ?>">
                                                    <label for="initial_post" class="form-label fw-semibold">Post of Initial Appointment</label>
                                                    <select class="form-select" id="initial_post" name="initial_post" <?= h($readFlag->initial_post) ?>>
                                                        <?php echo $postsOptions; ?> 
                                                    </select>
                                                </div>
                                            </div>

                                        
                                        

                                            <div class="col-md-4">
                                                <div class="custom-box border rounded-3 p-3 shadow-sm  required-field <?= h($css->recruitment_subject ?? '') ?>">
                                                    <label for="recruitment_subject" class="form-label fw-semibold">Recruitment Subject</label>
                                                     <select class="form-select" id="recruitment_subject" name="recruitment_subject" <?= h($readFlag->recruitment_subject) ?>>
                                                        <?php echo $recruitmentSubjectOptions; ?>
                                                    </select>

                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="custom-box border rounded-3 p-3 shadow-sm required-field <?= h($css->recruitment_category ?? '') ?>">
                                                    <label for="recruitment_category" class="form-label fw-semibold">Recruitment Category</label>
                                                    <select class="form-select" id="recruitment_category" name="recruitment_category" <?= h($readFlag->recruitment_category) ?>>
                                                        <?php echo $recuritmentCasteOptions; ?> 
                                                    </select>


                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="custom-box border rounded-3 p-3 shadow-sm required-field <?= h($css->recruitment_hor_category ?? '') ?>">
                                                    <label for="recruitment_hor_category" class="form-label fw-semibold">Recruitment Hor. Category</label>
                                                    <select class="form-select" id="recruitment_hor_category" name="recruitment_hor_category" <?= h($readFlag->recruitment_hor_category) ?>>
                                                        <?php echo $horizontalCategoriesOptions; ?> 
                                                    </select>
                                                </div>
                                            </div>
                                            
                                                

                                            
                                            <div class="col-md-4">
                                                <div class="custom-box border rounded-3 p-3 shadow-sm required-field <?= h($css->recruitment_ph_category ?? '') ?>">
                                                    <label for="recruitment_ph_category" class="form-label fw-semibold">Recruitment PH. Details</label>
                                                    <select class="form-select" id="recruitment_ph_category" name="recruitment_ph_category" <?= h($readFlag->recruitment_ph_category) ?>>
                                                        <?php echo $recruitmentPHCategoriesOptions; ?> 
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="custom-box border rounded-3 p-3 shadow-sm required-field <?= h($css->recruitment_orphan_category ?? '') ?>">
                                                    <label for="recruitment_orphan_category" class="form-label fw-semibold">Recruitment Orphan Details</label>
                                                    <select class="form-select" id="recruitment_orphan_category" name="recruitment_orphan_category" <?= h($readFlag->recruitment_orphan_category) ?>>
                                                        <?php echo $orphanOptions; ?> 
                                                    </select>                                                    
                                                </div>
                                            </div>
                                            

                                            

                                             <div class="col-md-4">
                                                <div class="custom-box border rounded-3 p-3 shadow-sm required-field <?= h($css->recruitment_appointment_nature ?? '') ?>">
                                                    <label for="recruitment_appointment_nature" class="form-label fw-semibold">Nature of Appointment</label>
                                                    <select class="form-select" id="recruitment_appointment_nature" name="recruitment_appointment_nature" <?= h($readFlag->recruitment_appointment_nature) ?>>
                                                        <?php echo $recruitmentAppointmentOptions; ?>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-md-4">
                                                <div class="custom-box border rounded-3 p-3 shadow-sm required-field <?= h($css->shikshan_sevak ?? '') ?>">
                                                    <label class="form-label fw-semibold">Shikshan Sevak (Probation)?</label>
                                                    <div style="background-color: #d1ddf4;padding:4px;">&nbsp;&nbsp;&nbsp;
                                                        <div class="form-check form-check-inline" style="width:70px;">
                                                            <input class="form-check-input" type="radio" name="shikshan_sevak" id="shikshan_sevak_yes" value="1" <?= !empty($staff->shikshan_sevak) && $staff->shikshan_sevak == 1 ? 'checked' : '' ?>>
                                                            <label class="form-check-label" for="shikshan_sevak_yes">&nbsp;&nbsp;Yes</label>
                                                        </div>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <div class="form-check form-check-inline" style="width:70px;">
                                                            <input  class="form-check-input" type="radio" name="shikshan_sevak" id="shikshan_sevak_no" value="0" <?= empty($staff->shikshan_sevak) || $staff->shikshan_sevak != 1 ? 'checked' : '' ?>>
                                                            <label class="form-check-label" for="shikshan_sevak_no">&nbsp;&nbsp;No</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                        
                                        <div style="clear:both;">&nbsp;</div>
                                        <div class="row g-2" style="padding:10px;background:#dedca0">
                                            <div class="col-md-4">
                                                <div class="custom-box border rounded-3 p-3 shadow-sm required-field <?= h($css->joining_date ?? '') ?>">
                                                    <label for="joining_date" class="form-label fw-semibold">Date of Entry in Service</label>
                                                    <input class="form-control date-field" type="text" id="joining_date" name="joining_date" value="<?= h(!empty($staff->joining_date) ? date('d/m/Y', strtotime($staff->joining_date)) : '') ?>"  <?= h($readFlag->joining_date) ?>>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                
                                                <div class="custom-box border rounded-3 p-3 shadow-sm required-field <?= h($css->joining_district ?? '') ?>">
                                                    <label for="joining_district" class="form-label fw-semibold">Date of Joining District</label>
                                                    <input class="form-control date-field" type="text" id="joining_district" class="form-control date-field" name="joining_district" value="<?= h(!empty($staff->joining_district_date) ? date('d/m/Y', strtotime($staff->joining_district_date)) : '') ?>" placeholder="dd/mm/yyyy" <?= h($readFlag->joining_district) ?>>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="custom-box border rounded-3 p-3 shadow-sm required-field <?= h($css->joining_block ?? '') ?>">
                                                    <label for="joining_block" class="form-label fw-semibold">Date of Joining Block</label>
                                                <input class="form-control date-field" type="text" id="joining_block" class="form-control date-field" name="joining_block" value="<?= h(!empty($staff->joining_block_date) ? date('d/m/Y', strtotime($staff->joining_block_date)) : '') ?>" placeholder="dd/mm/yyyy" <?= h($readFlag->joining_block) ?>>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="custom-box border rounded-3 p-3 shadow-sm required-field<?= h($css->joining_mgmt ?? '') ?>">
                                                    <label for="joining_mgmt" class="form-label fw-semibold">Date of Joining Current Management</label>
                                                    <input class="form-control date-field" type="text" id="joining_mgmt" class="form-control date-field" name="joining_mgmt" value="<?= h(!empty($staff->joining_mgmt) ? date('d/m/Y', strtotime($staff->joining_mgmt)) : '') ?>" placeholder="dd/mm/yyyy" <?= h($readFlag->joining_mgmt) ?>>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="custom-box border rounded-3 p-3 shadow-sm required-field <?= h($css->joining_school ?? '') ?>">
                                                    <label for="joining_school" class="form-label fw-semibold">Date of Joining Current School</label>
                                                    <input class="form-control date-field" type="text" id="joining_school" class="form-control date-field" name="joining_school" value="<?= h(!empty($staff->date_of_joining_current_school) ? date('d/m/Y', strtotime($staff->date_of_joining_current_school)) : '') ?>" placeholder="dd/mm/yyyy" <?= h($readFlag->joining_school) ?>>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="custom-box border rounded-3 p-3 shadow-sm required-field <?= h($css->joining_designation ?? '') ?>">

                                                    
    
                                                    <label for="joining_designation" class="form-label fw-semibold required-field">Date of Joining Current Designation</label>
                                                    <input class="form-control date-field" type="text" id="joining_designation" class="form-control date-field" name="joining_designation" value="<?= h(!empty($staff->joining_designation_date) ? date('d/m/Y', strtotime($staff->joining_designation_date)) : '') ?>" placeholder="dd/mm/yyyy" <?= h($readFlag->joining_designation) ?>>
                                                </div>
                                            </div>
                                            

                                            <div class="col-md-4">
                                                <div class="custom-box border rounded-3 p-3 shadow-sm required-field <?= h($css->superannuation ?? '') ?>">
                                                    <label for="superannuation" class="form-label fw-semibold">Superannuation Date</label>
                                                    <input class="form-control date-field" type="text" id="superannuation" class="form-control date-field" name="superannuation" value="<?= h(!empty($staff->super_ann_date) ? date('d/m/Y', strtotime($staff->super_ann_date)) : '') ?>" placeholder="dd/mm/yyyy" <?= h($readFlag->superannuation) ?>>
                                                </div>
                                            </div>
                                        </div>
                                        <!--
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->initial_order) ?>">
                                                <label for="initial_order" class="form-label fw-semibold">Upload Initial Appointment Order</label>
                                                <input type="file" class="form-control" id="initial_order" name="initial_order" accept="image/*" <?= h($readFlag->initial_order) ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->approval_order) ?>">
                                                <label for="approval_order" class="form-label fw-semibold">Upload Approval Order</label>
                                                <input type="file" class="form-control" id="approval_order" name="approval_order" accept="image/*" <?= h($readFlag->approval_order) ?>>
                                            </div>
                                        </div>

                                       <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->medical_certificate) ?>">
                                                <label for="medical_certificate" class="form-label fw-semibold">Upload Medical Certificate</label>
                                                <input type="file" class="form-control" id="medical_certificate" name="medical_certificate" accept="image/*" <?= h($readFlag->medical_certificate) ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->police_certificate) ?>">
                                                <label for="police_certificate" class="form-label fw-semibold">Upload Police Verification Certificate</label>
                                                <input type="file" class="form-control" id="police_certificate" name="police_certificate" accept="image/*" <?= h($readFlag->police_certificate) ?>>
                                            </div>
                                        </div>-->
                                      

                                    </form><br>

                                    
                                </section><!-- Personal details end -->

                                <section id="content-section-1" class="content-section"><!-- address details start -->
                                    <form id="content-section-form-1">
                                        <div class="address-block custom-box border rounded-3 p-3 shadow-sm <?= h($css->permanent_address ?? '') ?>">
                                            <h3>🏠 Permanent Address</h3>
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="required-field">
                                                        <label for="permanent_address_line1" class="form-label fw-semibold">Address Line 1</label>
                                                        <input class="form-control" type="text" id="permanent_address_line1" name="permanent_address_line1">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div>
                                                        <label for="permanent_address_line2" class="form-label fw-semibold">Address Line 2</label>
                                                        <input class="form-control" type="text" id="permanent_address_line2" name="permanent_address_line2">
                                                    </div>
                                                </div>
                                               
                                                <div class="col-md-4 p-3">
                                                    <div class="required-field">
                                                        <label for="permanent_state_id" class="form-label fw-semibold">State</label>
                                                        <select class="form-select" id="permanent_state_id" name="permanent_state_id" disabled>
                                                            <option value="">Select State</option> 
                                                            <option value="27" selected>MAHARASHTRA</option>  
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 p-3">
                                                    <div class="required-field">
                                                        <label for="permanent_district_id" class="form-label fw-semibold">District  </label>
                                                        <select class="form-select" id="permanent_district_id" name="permanent_district_id">                                                                                                          
                                                            <?php echo $districtOptions; ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 p-3">
                                                    <div class="required-field">
                                                        <label for="permanent_block_id" class="form-label fw-semibold">Block / Taluka</label>
                                                        <select class="form-select" id="permanent_block_id" name="permanent_block_id">
                                                            <option value="">Select Block/Taluka</option>                                                         
                                                               
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 p-3">
                                                    <div class="required-field">
                                                        <label for="permanent_village_id" class="form-label fw-semibold">Village / Town</label>
                                                        <select class="form-select" id="permanent_village_id" name="permanent_village_id">
                                                            <option value="">Select Village / Town</option>                                                         
                                                               
                                                        </select>
                                                    </div>
                                                </div>

                                                

                                               <div class="col-md-6 p-3">
                                                    <div class="required-field">
                                                        <label for="permanent_pincode" class="form-label fw-semibold">Pincode</label>
                                                        <input class="form-control" type="text" id="permanent_pincode" name="permanent_pincode">
                                                    </div>
                                                </div>
                                                
                                               
                                            </div>
                                        </div>

                                        <div class="address-block custom-box border rounded-3 p-3 shadow-sm <?= h($css->current_address ?? '') ?>">
                                            <h3 style="width:100%;">📬 Correspondence Address <small style="float:right;"><input type="checkbox" id="copyPermanentAddress" style="inline-size:auto;"> Same as Permanent Address</small></h3>
                                            <div class="row">


                                                <div class="col-md-6">
                                                    <div class="required-field">
                                                        <label for="current_address_line1" class="form-label fw-semibold">Address Line 1</label>
                                                        <input class="form-control" type="text" id="current_address_line1" name="current_address_line1">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div>
                                                        <label for="current_address_line2" class="form-label fw-semibold">Address Line 2</label>
                                                        <input class="form-control" type="text" id="current_address_line2" name="current_address_line2">
                                                    </div>
                                                </div>
                                               
                                                <div class="col-md-4 p-3">
                                                    <div class="required-field">
                                                        <label for="current_state_id" class="form-label fw-semibold">State</label>
                                                        <select class="form-select" id="current_state_id" name="current_state_id" disabled>
                                                            <option value="">Select State</option>  
                                                            <option value="27" selected>MAHARASHTRA</option>  
                                                        </select>
                                                    </div>
                                                </div>

                                                 

                                                <div class="col-md-4 p-3">
                                                    <div class="required-field">
                                                        <label for="current_district_id" class="form-label fw-semibold">District</label>
                                                        <select class="form-select" id="current_district_id" name="current_district_id">
                                                             <?php echo $districtOptions; ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 p-3">
                                                    <div class="required-field">
                                                        <label for="current_block_id" class="form-label fw-semibold">Block / Taluka</label>
                                                        <select class="form-select" id="current_block_id" name="current_block_id">
                                                            <option value="">Select Block/Taluka</option>                                                         
                                                               
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 p-3">
                                                    <div class="required-field">
                                                        <label for="current_village_id" class="form-label fw-semibold">Village / Town</label>
                                                        <select class="form-select" id="current_village_id" name="current_village_id">
                                                            <option value="">Select Village / Town</option>                                                         
                                                               
                                                        </select>
                                                    </div>
                                                </div>

                                                

                                               <div class="col-md-6 p-3">
                                                    <div class="required-field">
                                                        <label for="current_pincode" class="form-label fw-semibold">Pincode</label>
                                                        <input class="form-control" type="text" id="current_pincode" name="current_pincode">
                                                    </div>
                                                </div>
                                                
                                               
                                            </div>
                                        </div>
                                       
                                    </form>
                                    
                                </section><!-- address details end -->

                                <section id="content-section-2" class="content-section"><!-- other personal details start -->
                                    
                                    <form id="content-section-form-2" class="row g-3">

                                        <!-- Marital Status -->
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->marital_status ?? '') ?>">
                                                <label for="marital_status" class="form-label fw-semibold">Marital Status</label>
                                                 <select class="form-select" id="marital_status" name="marital_status" <?= h($readFlag->marital_status) ?>>
                                                        <?php echo $maritalOptions; ?> 
                                                    </select>
                                                
                                            </div>
                                        </div>

                                        <!-- No. of Children -->
                                        <!-- 
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->children ?? '') ?>">
                                                <label for="children" class="form-label fw-semibold">No. of Children</label>
                                                <input class="form-control" type="number" id="children" name="children"
                                                    value="<?= h($staff->children ?? '') ?>" <?= h($readFlag->children) ?>>
                                            </div>
                                        </div>-->
                                        <!--
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->domicile ?? '') ?>">
                                                <label class="form-label fw-semibold">Domicile of Maharashtra?</label>
                                                <div style="background-color: #d1ddf4; padding:4px;">
                                                    <div class="form-check form-check-inline" style="width:70px;">
                                                        <input class="form-check-input domicile-radio" type="radio" name="domicile" id="domicile_yes" value="1" 
                                                            <?= !empty($staff->domicile) && $staff->domicile == 1 ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="domicile_yes">&nbsp;Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline" style="width:70px;">
                                                        <input class="form-check-input domicile-radio" type="radio" name="domicile" id="domicile_no" value="0"
                                                            <?= empty($staff->domicile) || $staff->domicile != 1 ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="domicile_no">&nbsp;No</label>
                                                    </div>
                                                </div>
                                                <div class="domicile-upload-container mt-3" style="display: <?= !empty($staff->domicile) && $staff->domicile == 1 ? 'block' : 'none' ?>;">
                                                    <input type="file" class="form-control file-input" name="domicile_file" id="domicile_file" accept="image/*,.pdf,.doc,.docx" data-field="domicile">
                                                    <input type="hidden" name="domicile_file_path" id="domicile_file_path" value="<?= h($staff->domicile_file_path ?? '') ?>">
                                                    <div class="preview-container mt-2" id="domicile_preview">
                                                        <?php if(!empty($staff->domicile_file_path)): ?>
                                                            <div class="preview-item">
                                                                <a href="<?= h($staff->domicile_file_path) ?>" target="_blank">View Uploaded File</a>
                                                                <button type="button" class="btn btn-sm btn-danger ms-2 remove-file" data-field="domicile">×</button>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->border_village ?? '') ?>">
                                                <label class="form-label fw-semibold">Are you from controversial Karnataka 865 border villages?</label>
                                                <div style="background-color: #d1ddf4;padding:4px;">
                                                    <div class="form-check form-check-inline" style="width:70px;">
                                                        <input class="form-check-input border_village-radio" type="radio" name="border_village" id="border_village_yes" value="1"
                                                            <?= !empty($staff->border_village) && $staff->border_village == 1 ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="border_village_yes">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline" style="width:70px;">
                                                        <input class="form-check-input border_village-radio" type="radio" name="border_village" id="border_village_no" value="0"
                                                            <?= empty($staff->border_village) || $staff->border_village != 1 ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="border_village_no">No</label>
                                                    </div>
                                                </div>
                                                
                                                <div class="border_village-upload-container mt-3" style="display: <?= !empty($staff->border_village) && $staff->border_village == 1 ? 'block' : 'none' ?>;">
                                                    <input type="file" class="form-control file-input" name="border_village_file" id="border_village_file" accept="image/*,.pdf,.doc,.docx" data-field="border_village">
                                                    <input type="hidden" name="border_village_file_path" id="border_village_file_path" value="<?= h($staff->border_village_file_path ?? '') ?>">
                                                    <div class="preview-container mt-2" id="border_village_preview">
                                                        <?php if(!empty($staff->border_village_file_path)): ?>
                                                            <div class="preview-item">
                                                                <a href="<?= h($staff->border_village_file_path) ?>" target="_blank">View Uploaded File</a>
                                                                <button type="button" class="btn btn-sm btn-danger ms-2 remove-file" data-field="border_village">×</button>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->suicide_farmer_child ?? '') ?>">
                                                <label class="form-label fw-semibold">Are you a child of suicide victim farmer?</label>
                                                <div style="background-color: #d1ddf4; padding:4px;">
                                                    <div class="form-check form-check-inline" style="width:70px;">
                                                        <input class="form-check-input suicide_farmer_child-radio" type="radio" name="suicide_farmer_child" id="suicide_farmer_child_yes" value="1"
                                                            <?= !empty($staff->suicide_farmer_child) && $staff->suicide_farmer_child == 1 ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="suicide_farmer_child_yes">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline" style="width:70px;">
                                                        <input class="form-check-input suicide_farmer_child-radio" type="radio" name="suicide_farmer_child" id="suicide_farmer_child_no" value="0"
                                                            <?= empty($staff->suicide_farmer_child) || $staff->suicide_farmer_child != 1 ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="suicide_farmer_child_no">No</label>
                                                    </div>
                                                </div>
                                                
                                                <div class="suicide_farmer_child-upload-container mt-3" style="display: <?= !empty($staff->suicide_farmer_child) && $staff->suicide_farmer_child == 1 ? 'block' : 'none' ?>;">
                                                    <input type="file" class="form-control file-input" name="suicide_farmer_child_file" id="suicide_farmer_child_file" accept="image/*,.pdf,.doc,.docx" data-field="suicide_farmer_child">
                                                    <input type="hidden" name="suicide_farmer_child_file_path" id="suicide_farmer_child_file_path" value="<?= h($staff->suicide_farmer_child_file_path ?? '') ?>">
                                                    <div class="preview-container mt-2" id="suicide_farmer_child_preview">
                                                        <?php if(!empty($staff->suicide_farmer_child_file_path)): ?>
                                                            <div class="preview-item">
                                                                <a href="<?= h($staff->suicide_farmer_child_file_path) ?>" target="_blank">View Uploaded File</a>
                                                                <button type="button" class="btn btn-sm btn-danger ms-2 remove-file" data-field="suicide_farmer_child">×</button>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->non_vremy ?? '') ?>">
                                                <label class="form-label fw-semibold">Do you have the certificate for non-creamy layer?</label>
                                                <div style="background-color: #d1ddf4; padding:4px;">
                                                    <div class="form-check form-check-inline" style="width:70px;">
                                                        <input class="form-check-input non_vremy-radio" type="radio" name="non_vremy" id="non_vremy_yes" value="1"
                                                            <?= !empty($staff->non_vremy) && $staff->non_vremy == 1 ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="non_vremy_yes">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline" style="width:70px;">
                                                        <input class="form-check-input non_vremy-radio" type="radio" name="non_vremy" id="non_vremy_no" value="0"
                                                            <?= empty($staff->non_vremy) || $staff->non_vremy != 1 ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="non_vremy_no">No</label>
                                                    </div>
                                                </div>
                                                
                                                <div class="non_vremy-upload-container mt-3" style="display: <?= !empty($staff->non_vremy) && $staff->non_vremy == 1 ? 'block' : 'none' ?>;">
                                                    <input type="file" class="form-control file-input" name="non_vremy_file" id="non_vremy_file" accept="image/*,.pdf,.doc,.docx" data-field="non_vremy">
                                                    <input type="hidden" name="non_vremy_file_path" id="non_vremy_file_path" value="<?= h($staff->non_vremy_file_path ?? '') ?>">
                                                    <div class="preview-container mt-2" id="non_vremy_preview">
                                                        <?php if(!empty($staff->non_vremy_file_path)): ?>
                                                            <div class="preview-item">
                                                                <a href="<?= h($staff->non_vremy_file_path) ?>" target="_blank">View Uploaded File</a>
                                                                <button type="button" class="btn btn-sm btn-danger ms-2 remove-file" data-field="non_vremy">×</button>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->freedom_fighter_ward ?? '') ?>">
                                                <label class="form-label fw-semibold">Are you a ward of Freedom Fighter?</label>
                                                <div style="background-color: #d1ddf4; padding:4px;">
                                                    <div class="form-check form-check-inline" style="width:70px;">
                                                        <input class="form-check-input freedom_fighter_ward-radio" type="radio" name="freedom_fighter_ward" id="freedom_fighter_ward_yes" value="1"
                                                            <?= !empty($staff->freedom_fighter_ward) && $staff->freedom_fighter_ward == 1 ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="freedom_fighter_ward_yes">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline" style="width:70px;">
                                                        <input class="form-check-input freedom_fighter_ward-radio" type="radio" name="freedom_fighter_ward" id="freedom_fighter_ward_no" value="0"
                                                            <?= empty($staff->freedom_fighter_ward) || $staff->freedom_fighter_ward != 1 ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="freedom_fighter_ward_no">No</label>
                                                    </div>
                                                </div>
                                                
                                                <div class="freedom_fighter_ward-upload-container mt-3" style="display: <?= !empty($staff->freedom_fighter_ward) && $staff->freedom_fighter_ward == 1 ? 'block' : 'none' ?>;">
                                                    <input type="file" class="form-control file-input" name="freedom_fighter_ward_file" id="freedom_fighter_ward_file" accept="image/*,.pdf,.doc,.docx" data-field="freedom_fighter_ward">
                                                    <input type="hidden" name="freedom_fighter_ward_file_path" id="freedom_fighter_ward_file_path" value="<?= h($staff->freedom_fighter_ward_file_path ?? '') ?>">
                                                    <div class="preview-container mt-2" id="freedom_fighter_ward_preview">
                                                        <?php if(!empty($staff->freedom_fighter_ward_file_path)): ?>
                                                            <div class="preview-item">
                                                                <a href="<?= h($staff->freedom_fighter_ward_file_path) ?>" target="_blank">View Uploaded File</a>
                                                                <button type="button" class="btn btn-sm btn-danger ms-2 remove-file" data-field="freedom_fighter_ward">×</button>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->election_1994 ?? '') ?>">
                                                <label class="form-label fw-semibold">Were you an Employee of election 1994?</label>
                                                <div style="background-color: #d1ddf4; padding:4px;">
                                                    <div class="form-check form-check-inline" style="width:70px;">
                                                        <input class="form-check-input election_1994-radio" type="radio" name="election_1994" id="election_1994_yes" value="1"
                                                            <?= !empty($staff->election_1994) && $staff->election_1994 == 1 ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="election_1994_yes">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline" style="width:70px;">
                                                        <input class="form-check-input election_1994-radio" type="radio" name="election_1994" id="election_1994_no" value="0"
                                                            <?= empty($staff->election_1994) || $staff->election_1994 != 1 ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="election_1994_no">No</label>
                                                    </div>
                                                </div>
                                                
                                                <div class="election_1994-upload-container mt-3" style="display: <?= !empty($staff->election_1994) && $staff->election_1994 == 1 ? 'block' : 'none' ?>;">
                                                    <input type="file" class="form-control file-input" name="election_1994_file" id="election_1994_file" accept="image/*,.pdf,.doc,.docx" data-field="election_1994">
                                                    <input type="hidden" name="election_1994_file_path" id="election_1994_file_path" value="<?= h($staff->election_1994_file_path ?? '') ?>">
                                                    <div class="preview-container mt-2" id="election_1994_preview">
                                                        <?php if(!empty($staff->election_1994_file_path)): ?>
                                                            <div class="preview-item">
                                                                <a href="<?= h($staff->election_1994_file_path) ?>" target="_blank">View Uploaded File</a>
                                                                <button type="button" class="btn btn-sm btn-danger ms-2 remove-file" data-field="election_1994">×</button>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->election_1991 ?? '') ?>">
                                                <label class="form-label fw-semibold">Were you an Employee of election 1991?</label>
                                                <div style="background-color: #d1ddf4; padding:4px;">
                                                    <div class="form-check form-check-inline" style="width:70px;">
                                                        <input class="form-check-input election_1991-radio" type="radio" name="election_1991" id="election_1991_yes" value="1"
                                                            <?= !empty($staff->election_1991) && $staff->election_1991 == 1 ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="election_1991_yes">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline" style="width:70px;">
                                                        <input class="form-check-input election_1991-radio" type="radio" name="election_1991" id="election_1991_no" value="0"
                                                            <?= empty($staff->election_1991) || $staff->election_1991 != 1 ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="election_1991_no">No</label>
                                                    </div>
                                                </div>
                                                
                                                <div class="election_1991-upload-container mt-3" style="display: <?= !empty($staff->election_1991) && $staff->election_1991 == 1 ? 'block' : 'none' ?>;">
                                                    <input type="file" class="form-control file-input" name="election_1991_file" id="election_1991_file" accept="image/*,.pdf,.doc,.docx" data-field="election_1991">
                                                    <input type="hidden" name="election_1991_file_path" id="election_1991_file_path" value="<?= h($staff->election_1991_file_path ?? '') ?>">
                                                    <div class="preview-container mt-2" id="election_1991_preview">
                                                        <?php if(!empty($staff->election_1991_file_path)): ?>
                                                            <div class="preview-item">
                                                                <a href="<?= h($staff->election_1991_file_path) ?>" target="_blank">View Uploaded File</a>
                                                                <button type="button" class="btn btn-sm btn-danger ms-2 remove-file" data-field="election_1991">×</button>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        -->



                                        <!-- Mother Tongue -->
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->mother_tongue ?? '') ?>">
                                                <label for="mother_tongue" class="form-label fw-semibold">Mother Tongue</label>
                                                
                                                 <select class="form-select" id="mother_tongue" name="mother_tongue" <?= h($readFlag->mother_tongue) ?>>
                                                        <?php echo $motherTongueOptions; ?> 
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Blood Group -->
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->blood_group ?? '') ?>">
                                                <label for="blood_group" class="form-label fw-semibold">Blood Group</label>
                                                <select class="form-select" id="blood_group" name="blood_group" <?= h($readFlag->blood_group) ?>>
                                                    <option value="">Select</option>
                                                    <?php
                                                    $bloodGroups = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
                                                    foreach ($bloodGroups as $group):
                                                    ?>
                                                        <option value="<?= h($group) ?>" <?= ($staff->blood_group ?? '') == $group ? 'selected' : '' ?>>
                                                            <?= h($group) ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>


                                        <!-- Election Card No -->
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->election_card ?? '') ?>">
                                                <label for="election_card" class="form-label fw-semibold">Election Card No</label>
                                                <input class="form-control" type="text" id="election_card" name="election_card"
                                                    value="<?= h($staff->election_card ?? '') ?>" <?= h($readFlag->election_card) ?>>
                                            </div>
                                        </div>


                                        <!-- Ex-Servicemen 
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->ex_servicemen ?? '') ?>">
                                                <label class="form-label fw-semibold">Ex-Servicemen?</label>
                                                <div style="background-color: #d1ddf4; padding:4px;">
                                                    <div class="form-check form-check-inline" style="width:70px;">
                                                        <input class="form-check-input" type="radio" name="ex_servicemen" id="ex_servicemen_yes" value="1"
                                                            <?= !empty($staff->ex_servicemen) && $staff->ex_servicemen == 1 ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="ex_servicemen_yes">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline" style="width:70px;">
                                                        <input class="form-check-input" type="radio" name="ex_servicemen" id="ex_servicemen_no" value="0"
                                                            <?= empty($staff->ex_servicemen) || $staff->ex_servicemen != 1 ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="ex_servicemen_no">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        -->

                                        <!-- Height (in cm) -->
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->height ?? '') ?>">
                                                <label for="height" class="form-label fw-semibold">Height (in cm)</label>
                                                <input class="form-control" type="text" id="height" name="height"
                                                    value="<?= h($staff->height ?? '') ?>" <?= h($readFlag->height) ?>>
                                            </div>
                                        </div>


                                        <!-- Weight (in kg) -->
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->weight ?? '') ?>">
                                                <label for="weight" class="form-label fw-semibold">Weight (in kg)</label>
                                                <input class="form-control" type="text" id="weight" name="weight"
                                                    value="<?= h($staff->weight ?? '') ?>" <?= h($readFlag->weight) ?>>
                                            </div>
                                        </div>



                                        <!-- Identification Marks (#1) -->
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->identification_mark1 ?? '') ?>">
                                                <label for="identification_mark1" class="form-label fw-semibold">Identification Marks (#1)</label>
                                                <input class="form-control" type="text" id="identification_mark1" name="identification_mark1"
                                                    value="<?= h($staff->identification_mark1 ?? '') ?>" <?= h($readFlag->identification_mark1) ?>>
                                            </div>
                                        </div>

                                        <!-- Identification Marks (#2) -->
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->identification_mark2 ?? '') ?>">
                                                <label for="identification_mark2" class="form-label fw-semibold">Identification Marks (#2)</label>
                                                <input class="form-control" type="text" id="identification_mark2" name="identification_mark2"
                                                    value="<?= h($staff->identification_mark2 ?? '') ?>" <?= h($readFlag->identification_mark2) ?>>
                                            </div>
                                        </div>

                                        <!-- No. of Working Days Spent on Non-Teaching Assignments -->
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->no_of_non_teaching_working_days ?? '') ?>">
                                                <label for="no_of_non_teaching_working_days" class="form-label fw-semibold">No. of Working Days Spent on Non-Teaching Assignments</label>
                                                <input class="form-control" type="text" id="no_of_non_teaching_working_days" name="no_of_non_teaching_working_days"
                                                    value="<?= h($staff->no_of_non_teaching_working_days ?? '') ?>" <?= h($readFlag->no_of_non_teaching_working_days) ?>>
                                            </div>
                                        </div>




                                        <!-- Languages -->
                                        <div class="row">
                                            <h3>Languages in which the teacher is having working knowledge?</h3>

                                            <div class="col-md-4">
                                                <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->lang1 ?? '') ?>">
                                                    <label for="lang1" class="form-label fw-semibold">Language 1</label>
                                                    <select class="form-select lang-select" id="lang1" name="lang1" <?= h($readFlag->lang1) ?>>
                                                        <?php echo $languageOptions; ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->lang2 ?? '') ?>">
                                                    <label for="lang2" class="form-label fw-semibold">Language 2</label>
                                                    <select class="form-select lang-select" id="lang2" name="lang2" <?= h($readFlag->lang2) ?>>
                                                        <?php echo $languageOptions; ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->lang3 ?? '') ?>">
                                                    <label for="lang3" class="form-label fw-semibold">Language 3</label>
                                                    <select class="form-select lang-select" id="lang3" name="lang3" <?= h($readFlag->lang3) ?>>
                                                        <?php echo $languageOptions; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        

                                        <!-- Is Capable of Handling Digital devices and VC application -->
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->capable_handling_digital ?? '') ?>">
                                                <label class="form-label fw-semibold">Is Capable of Handling Digital devices and VC application?</label>
                                                <div style="background-color: #d1ddf4; padding:4px;">
                                                    <div class="form-check form-check-inline" style="width:70px;">
                                                        <input class="form-check-input" type="radio" name="capable_handling_digital" id="capable_handling_digital_yes" value="1"
                                                            <?= !empty($staff->capable_handling_digital) && $staff->capable_handling_digital == 1 ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="capable_handling_digital_yes">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline" style="width:70px;">
                                                        <input class="form-check-input" type="radio" name="capable_handling_digital" id="capable_handling_digital_no" value="0"
                                                            <?= empty($staff->capable_handling_digital) || $staff->capable_handling_digital != 1 ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="capable_handling_digital_no">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <!-- Is Teacher Deputation in this School from other School -->
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->teacher_deputation_school ?? '') ?>">
                                                <label class="form-label fw-semibold">Is Teacher Deputation in this School from other School?</label>
                                                <div style="background-color: #d1ddf4; padding:4px;">
                                                    <div class="form-check form-check-inline" style="width:70px;">
                                                        <input class="form-check-input" type="radio" name="teacher_deputation_school" id="teacher_deputation_school_yes" value="1"
                                                            <?= !empty($staff->teacher_deputation_school) && $staff->teacher_deputation_school == 1 ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="teacher_deputation_school_yes">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline" style="width:70px;">
                                                        <input class="form-check-input" type="radio" name="teacher_deputation_school" id="teacher_deputation_school_no" value="0"
                                                            <?= empty($staff->teacher_deputation_school) || $staff->teacher_deputation_school != 1 ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="teacher_deputation_school_no">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <!-- Is Teacher Teaching at other school as Guest/Contractual -->
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->teaching_other_school ?? '') ?>">
                                                <label class="form-label fw-semibold">Is Teacher Teaching at other school as Guest/Contractual?</label>
                                                <div style="background-color: #d1ddf4; padding:4px;">
                                                    <div class="form-check form-check-inline" style="width:70px;">
                                                        <input class="form-check-input" type="radio" name="teaching_other_school" id="teaching_other_school_yes" value="1"
                                                            <?= !empty($staff->teaching_other_school) && $staff->teaching_other_school == 1 ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="teaching_other_school_yes">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline" style="width:70px;">
                                                        <input class="form-check-input" type="radio" name="teaching_other_school" id="teaching_other_school_no" value="0"
                                                            <?= empty($staff->teaching_other_school) || $staff->teaching_other_school != 1 ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="teaching_other_school_no">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <!-- Is Teacher Aadhaar Verified -->
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->is_uid_verified ?? '') ?>">
                                                <label class="form-label fw-semibold">Is Teacher Aadhaar Verified?</label>
                                                <div style="background-color: #d1ddf4; padding:4px;">
                                                    <div class="form-check form-check-inline" style="width:70px;">
                                                        <input class="form-check-input" type="radio" name="is_uid_verified" id="is_uid_verified_yes" value="1"
                                                        <?= h($readFlag->is_uid_verified?? '') ?> <?= !empty($staff->is_uid_verified) && $staff->is_uid_verified == 1 ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="is_uid_verified_yes">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline" style="width:70px;">
                                                        <input class="form-check-input" type="radio" name="is_uid_verified" id="is_uid_verified_no" value="0"
                                                            <?= h($readFlag->is_uid_verified?? '') ?> <?= empty($staff->is_uid_verified) || $staff->is_uid_verified != 1 ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="is_uid_verified_no">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
        
                                       

                                     

                                     
        
                                    </form><br>

                                </section><!-- other personal details end -->

                               
                                <section id="content-section-3" class="content-section"><!-- family details start-->
                                   
                                    <div class="card shadow-lg border-0 rounded-4">
                                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">👨‍👩‍👧 Family Members Details</h5>
                                        <button id="addFamilyBtn" class="btn btn-light btn-sm fw-semibold">
                                            + Add Family Member
                                        </button>
                                        </div>
                                        <div class="card-body">
                                        <div id="familyTableContainer" class="table-responsive"></div>
                                        </div>
                                    </div>
                                    
                                    
                                   

                                </section><!-- Family details end -->
                                                        <!-- Nomination details start 
                                <section id="content-section-4" class="content-section">
                                    <form id="content-section-form-4">
                                        <div class="card shadow-lg border-0 rounded-4">
                                            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                            <h5 class="mb-0">🧩 Nomination Records</h5>
                                        
                                            </div>
                                            <div class="card-body">
                                            <div id="nominationTableContainer" class="table-responsive"></div>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </section> Nomination details end -->

                                <section id="content-section-4" class="content-section"><!-- Caste Category & Certification start  -->
                                    <form id="content-section-form-5">
                                        <div class="card shadow-lg border-0 rounded-4">
                                            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                                <h5 class="mb-0">🛕 Religion & Caste Details</h5>
                                           
                                            </div>
                                            <div class="card-body row g-3">

                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->religion ?? '') ?>">
                                                        <label for="religion" class="form-label fw-semibold">Religion</label>
                                                        <select class="form-select" id="religion" name="religion" <?= h($readFlag->religion) ?>>
                                                            <option value="">Select Religion</option>
                                                        </select>
                                                    </div>
                                                </div>

                                               
                        

                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->social_category ?? '') ?>">
                                                        <label for="social_category" class="form-label fw-semibold">Social Category</label>
                                                        <input class="form-control" type="text" id="social_category" name="social_category" value="<?= h($social_category ?? '') ?>"  <?= h($readFlag->social_category) ?>>
                                                    </div>
                                                </div>
                                                

                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->caste ?? '') ?>">
                                                        <label for="caste" class="form-label fw-semibold">Caste</label>
                                                        <select class="form-select" id="caste" name="caste" <?= h($readFlag->caste) ?>>
                                                            <option value="">Select Caste</option>
                                                        </select>
                                                    </div>
                                                </div>

                                               

                                              
                                            </div>
                                        </div>

                                        <?php if($is_social_category){?>
                             
                                        <div class="card shadow-lg border-0 rounded-4">
                                            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                                <h5 class="mb-0">📄 Certification Details</h5>
                                           
                                            </div>
                                            <div class="card-body row g-3">

                                                        
                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->certificate_no ?? '') ?>">
                                                        <label for="certificate_no" class="form-label fw-semibold">Certificate No.</label>
                                                        <input class="form-control" type="text" id="certificate_no" name="certificate_no" value="<?= h($staff->certificate_no ?? '') ?>"  <?= h($readFlag->certificate_no) ?>>
                                                    </div>
                                                </div>
 

                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->certificate_date ?? '') ?>">
                                                        <label for="certificate_date" class="form-label fw-semibold">Certificate Date</label>
                                                        <input class="form-control date-field" type="text" id="certificate_date" name="certificate_date" value="<?= h(!empty($staff->certificate_date) ? date('d/m/Y', strtotime($staff->certificate_date)) : '') ?>"  <?= h($readFlag->certificate_date) ?>>
                                                    </div>
                                                </div>

                                
                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->certificate_issuing_authority ?? '') ?>">
                                                        <label for="certificate_issuing_authority" class="form-label fw-semibold">Issuing Authority</label>
                                                        <select class="form-select" id="certificate_issuing_authority" name="certificate_issuing_authority" <?= h($readFlag->certificate_issuing_authority) ?>>
                                                            <option value="">Select Issuing Authority</option>
                                                            <option value="1">Tahasildar</option>
                                                            <option value="2">Subdivisional Officer</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->certificate_place ?? '') ?>">
                                                        <label for="certificate_place" class="form-label fw-semibold">Place</label>
                                                        <input class="form-control" type="text" id="certificate_place" name="certificate_place" value="<?= h($staff->certificate_place ?? '') ?>"  <?= h($readFlag->certificate_place) ?>>
                                                    </div>
                                                </div>

                                                

                                                

                                                <!-- Remarks -->
                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->certificate_file) ?>">
                                                        <label for="certificate_file" class="form-label fw-semibold">Upload Certificate</label>
                                                        <input type="file" class="form-control" id="certificate_file" name="certificate_file" accept="image/*" <?= h($readFlag->certificate_file) ?>>
                                                    </div>
                                                </div>

                                               
                                           

                                            </div>
                                        </div>
                                        
                                       
                                        <div class="card shadow-lg border-0 rounded-4">
                                            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                                <h5 class="mb-0">📜 Certificate Validation Details</h5>
                                           
                                            </div>
                                            <div class="card-body row g-3">

                                                        
                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->certificate_validation_no ?? '') ?>">
                                                        <label for="certificate_validation_no" class="form-label fw-semibold">Certificate Validation No.</label>
                                                        <input class="form-control" type="text" id="certificate_validation_no" name="certificate_validation_no" value="<?= h($staff->certificate_validation_no ?? '') ?>"  <?= h($readFlag->certificate_validation_no) ?>>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->certificate_validation_date ?? '') ?>">
                                                        <label for="certificate_validation_date" class="form-label fw-semibold">Certificate Validation Date</label>
                                                        <input class="form-control date-field" type="text" id="certificate_validation_date" name="certificate_validation_date" value="<?= h(!empty($staff->certificate_validation_date) ? date('d/m/Y', strtotime($staff->certificate_validation_date)) : '') ?>"  <?= h($readFlag->certificate_validation_date) ?>>
                                                    </div>
                                                </div>

                                                
                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->certificate_validation_authority ?? '') ?>">
                                                        <label for="certificate_validation_authority" class="form-label fw-semibold">Certificate Validation Authority</label>
                                                        <select class="form-select" id="certificate_validation_authority" name="certificate_validation_authority" <?= h($readFlag->certificate_validation_authority) ?>>
                                                            <?= $casteValidAuthorityOptions ?>
                                                        </select>
                                                    </div>
                                                </div>




                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->certificate_validation_place ?? '') ?>">
                                                        <label for="certificate_validation_place" class="form-label fw-semibold">Place</label>
                                                        <input class="form-control" type="text" id="certificate_validation_place" name="certificate_validation_place" value="<?= h($staff->certificate_validation_place ?? '') ?>"  <?= h($readFlag->certificate_validation_place) ?>>
                                                    </div>
                                                </div>

                                                

                                                

                                                <!-- Validation File -->
                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->certificate_validation_file) ?>">
                                                        <label for="certificate_validation_file" class="form-label fw-semibold">Upload Certificate Validation File</label>
                                                        <input type="file" class="form-control" id="certificate_validation_file" name="certificate_validation_file" accept="image/*" <?= h($readFlag->certificate_validation_file) ?>>
                                                    </div>
                                                </div>
                                               

                                                <!-- Remarks -->
                                                <div class="col-md-12">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->certificate_validation_remarks ?? '') ?>">
                                                        <label for="certificate_validation_remarks" class="form-label fw-semibold">Remarks (if any)</label>
                                                        <input class="form-control" type="text" id="certificate_validation_remarks" name="certificate_validation_remarks"
                                                            value="<?= h($staff->certificate_validation_remarks ?? '') ?>" <?= h($readFlag->certificate_validation_remarks?? '') ?>>
                                                    </div>
                                                </div>
                                            
                                            

                                            </div>
                                        </div>
                                        <?php }?>
                                        
                                    </form>
                                </section><!-- Caste Category & Certification end  -->

                                <section id="content-section-5" class="content-section"><!-- Disability details start-->
                                    <form id="content-section-form-6" class="row g-3">
                                         <div class="card shadow-lg border-0 rounded-4">
                                            
                                            <div class="card-body row g-3">


                                                 <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->is_disabled ?? '') ?>">
                                                        <label class="form-label fw-semibold">Is Disabled?</label>
                                                        <div style="background-color: #d1ddf4;padding:4px;">&nbsp;&nbsp;&nbsp;
                                                            <div class="form-check form-check-inline" style="width:70px;">
                                                                <input class="form-check-input" type="radio" name="is_disabled" id="is_disabled_yes" value="1" <?= !empty($staff->is_disabled) && $staff->is_disabled == 1 ? 'checked' : '' ?> <?= h($readFlag->is_disabled) ?>>
                                                                <label class="form-check-label" for="is_disabled_yes">&nbsp;&nbsp;Yes</label>
                                                            </div>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <div class="form-check form-check-inline" style="width:70px;">
                                                                <input  class="form-check-input" type="radio" name="is_disabled" id="is_disabled_no" value="0" <?= empty($staff->is_disabled) || $staff->is_disabled != 1 ? 'checked' : '' ?> <?= h($readFlag->is_disabled) ?>>
                                                                <label class="form-check-label" for="is_disabled_no">&nbsp;&nbsp;No</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <?php if($staff->is_disabled == 1){ ?>

                                                
                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->disability_type ?? '') ?>">
                                                        <label for="disability_type" class="form-label fw-semibold">Type of Disability</label>
                                                        <select class="form-select" id="disability_type" name="disability_type" <?= h($readFlag->disability_type) ?>>
                                                            <option value="">Select Type of Disability</option>
                                                        </select>
                                                    </div>
                                                </div>



                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->disability_percentage ?? '') ?>">
                                                        <label for="disability_percentage" class="form-label fw-semibold">disability_percentage</label>
                                                        <input class="form-control" type="text" id="disability_percentage" name="disability_percentage" value="<?= h($staff->disability_percentage ?? '') ?>"  <?= h($readFlag->disability_percentage) ?>>
                                                    </div>
                                                </div>
                                                        
                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->disability_certificate_no ?? '') ?>">
                                                        <label for="disability_certificate_no" class="form-label fw-semibold">Disability Certificate No.</label>
                                                        <input class="form-control" type="text" id="disability_certificate_no" name="disability_certificate_no" value="<?= h($staff->disability_certificate_no ?? '') ?>"  <?= h($readFlag->disability_certificate_no) ?>>
                                                    </div>
                                                </div>
                                                


                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->disability_certificate_date ?? '') ?>">
                                                        <label for="disability_certificate_date" class="form-label fw-semibold">Date of Certificate</label>
                                                        <input class="form-control" type="text" id="disability_certificate_date" name="disability_certificate_date" value="<?= h(!empty($staff->disability_certificate_date) ? date('d/m/Y', strtotime($staff->disability_certificate_date)) : '') ?>"  <?= h($readFlag->disability_certificate_date) ?>>
                                                    </div>
                                                </div>

                                
                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->disability_certificate_issuing_authority ?? '') ?>">
                                                        <label for="disability_certificate_issuing_authority" class="form-label fw-semibold">Issuing Authority</label>
                                                        <select class="form-select" id="disability_certificate_issuing_authority" name="disability_certificate_issuing_authority" <?= h($readFlag->disability_certificate_issuing_authority) ?>>
                                                            <option value="">Select Issuing Authority</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->disability_certificate_place ?? '') ?>">
                                                        <label for="disability_certificate_place" class="form-label fw-semibold">Place</label>
                                                        <input class="form-control" type="text" id="disability_certificate_place" name="disability_certificate_place" value="<?= h($staff->disability_certificate_place ?? '') ?>"  <?= h($readFlag->disability_certificate_place) ?>>
                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->disability_id ?? '') ?>">
                                                        <label for="disability_id" class="form-label fw-semibold">Unique Disability ID</label>
                                                        <input class="form-control" type="text" id="disability_id" name="disability_id" value="<?= h($staff->disability_id ?? '') ?>"  <?= h($readFlag->disability_id) ?>>
                                                    </div>
                                                </div>

                                            
                                                <!-- Remarks -->
                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->disability_certificate_file) ?>">
                                                        <label for="disability_certificate_file" class="form-label fw-semibold">Upload Certificate</label>
                                                        <input type="file" class="form-control" id="disability_certificate_file" name="disability_certificate_file" accept="image/*" <?= h($readFlag->disability_certificate_file) ?>>
                                                    </div>
                                                </div>

                                                <!-- Remarks -->
                                                <div class="col-md-12">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->disability_remarks ?? '') ?>">
                                                        <label for="disability_remarks" class="form-label fw-semibold">Remarks (if any)</label>
                                                        <input class="form-control" type="text" id="disability_remarks" name="disability_remarks"
                                                            value="<?= h($staff->disability_remarks ?? '') ?>" <?= h($readFlag->disability_remarks?? '') ?>>
                                                    </div>
                                                </div>

                                              <?php } ?>
                                            </div>
                                        </div>



                                        
                                    </form><br>
                                    
                                </section><!-- Disability details end -->

                                <section id="content-section-6" class="content-section"><!-- Academic Qualifications start -->
                                    <div class="container my-4">
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <h4 class="mb-0">Academic Qualifications</h4>
                                            <div>
                                            <button id="addAcademicQualificationBtn" class="btn btn-primary">
                                                <i class="bi bi-plus-lg"></i> Add Qualification
                                            </button>
                                            </div>
                                        </div>

                                        <div id="AcademicQualificationsWrapper" class="card shadow-sm">
                                            <div class="card-body">
                                            <div id="qualTableContainer" class="table-responsive">
                                                <!-- Table will be injected here -->
                                                <div class="text-center py-4 text-muted">Loading qualifications…</div>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                
                                    
                                    
                                </section><!-- Academic Qualifications end -->

                             
                                <section id="content-section-7" class="content-section"><!-- Professional Qualifications start -->
                                    <div class="container my-4">
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <h4 class="mb-0">Professional Qualifications</h4>
                                            <div>
                                            <button id="addProfessionalQualificationBtn" class="btn btn-primary">
                                                <i class="bi bi-plus-lg"></i> Add Qualification
                                            </button>
                                            </div>
                                        </div>

                                        <div id="ProfessionalQualificationsWrapper" class="card shadow-sm">
                                            <div class="card-body">
                                                <div id="professionalTableContainer" class="table-responsive">
                                                    <!-- Table will be injected here -->
                                                    <div class="text-center py-4 text-muted">Loading qualifications…</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                                    
                                </section><!-- Professional Qualifications end -->


                                <section id="content-section-8" class="content-section"><!-- Udise Qualification Details start -->
                                    <form id="content-section-form-9" class="row g-3">                                       
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->math_studied_upto ?? '') ?>">
                                                <label for="math_studied_upto" class="form-label fw-semibold">Math Studied Upto</label>
                                                <input class="form-control" type="text" id="math_studied_upto" name="math_studied_upto" value="<?= h($staff->math_studied_upto ?? '') ?>"  <?= h($readFlag->math_studied_upto) ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->science_studied_upto ?? '') ?>">
                                                <label for="science_studied_upto" class="form-label fw-semibold">Science Studied Upto</label>
                                                <input class="form-control" type="text" id="science_studied_upto" name="science_studied_upto" value="<?= h($staff->science_studied_upto ?? '') ?>"  <?= h($readFlag->science_studied_upto) ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->english_studied_upto ?? '') ?>">
                                                <label for="english_studied_upto" class="form-label fw-semibold">English Studied Upto</label>
                                                <input class="form-control" type="text" id="english_studied_upto" name="english_studied_upto" value="<?= h($staff->english_studied_upto ?? '') ?>"  <?= h($readFlag->english_studied_upto) ?>>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->social_studies_studied_upto ?? '') ?>">
                                                <label for="social_studies_studied_upto" class="form-label fw-semibold">Social Studies Studied Upto</label>
                                                <input class="form-control" type="text" id="social_studies_studied_upto" name="social_studies_studied_upto" value="<?= h($staff->social_studies_studied_upto ?? '') ?>"  <?= h($readFlag->social_studies_studied_upto) ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->language_studied_upto ?? '') ?>">
                                                <label for="language_studied_upto" class="form-label fw-semibold">Language Studied Upto</label>
                                                <input class="form-control" type="text" id="language_studied_upto" name="language_studied_upto" value="<?= h($staff->language_studied_upto ?? '') ?>"  <?= h($readFlag->language_studied_upto) ?>>
                                            </div>
                                        </div>
                                       
                                         <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->teaching_level ?? '') ?>">
                                                <label for="teaching_level" class="form-label fw-semibold">Teaching Level</label>
                                                <input class="form-control" type="text" id="teaching_level" name="teaching_level" value="<?= h($staff->teaching_level ?? '') ?>"  <?= h($readFlag->teaching_level) ?>>
                                            </div>
                                        </div>
                                         <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->main_subject1 ?? '') ?>">
                                                <label for="main_subject1" class="form-label fw-semibold">Main Subject 1</label>
                                                <input class="form-control" type="text" id="main_subject1" name="main_subject1" value="<?= h($staff->main_subject1 ?? '') ?>"  <?= h($readFlag->main_subject1) ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->main_subject2 ?? '') ?>">
                                                <label for="main_subject2" class="form-label fw-semibold">Main Subject 2</label>
                                                <input class="form-control" type="text" id="main_subject2" name="main_subject2" value="<?= h($staff->main_subject2 ?? '') ?>"  <?= h($readFlag->main_subject2) ?>>
                                            </div>
                                        </div>

                                    </form><br>

                                    
                                </section><!-- Udise Qualification Details end -->
                            
                                <section id="content-section-9" class="content-section"><!-- TET/CTET Details start -->    
                                   
                                    
                                
                                    <form id="content-section-form-10">
                                        <div class="card shadow-lg border-0 rounded-4">
                                            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                                <h5 class="mb-0">📝TET Result Lookup</h5>
                                           
                                            </div>
                                            <div class="card-body row g-3">

                                                <div class="col-md-3">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm">
                                                        <label class="form-label fw-semibold">Year</label>
                                                        <select id="examYear" class="form-control">
                                                        <option value="">Select Year</option>
                                                            <option>2020</option>
                                                            <option>2021</option>
                                                            <option>2022</option>
                                                            <option>2023</option>
                                                            <option>2024</option>
                                                            <option>2025</option>
                                                        </select>
                                                        
                                                    </div>
                                                </div>

                                                

                                                <div class="col-md-3">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm">
                                                        <label for="tet_paper1_number" class="form-label fw-semibold">Exam Paper</label>
                                                        <select id="examPaper" class="form-control">
                                                            <option value="">Select Exam Paper</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm">
                                                        <label for="tet_paper1_number" class="form-label fw-semibold">Roll Number</label>
                                                        <input type="text" id="rollNumber"  class="form-control" placeholder="Enter Roll Number">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm">
                                                        <button type="button" class="btn btn-success" id="fetchResult">Fetch TET Data</button>
                                                    </div>
                                                </div>
                                                

                                                <div class="col-md-12">
                                                    <hr>
                                                    <!-- Result Section -->
                                                    <div id="result"></div>
                                                </div>                                              
                                            </div>

                                            <div id="TetResultWrapper" class="card shadow-sm">
                                                <div class="card-body">
                                                    <div id="TetResultTableContainer" class="table-responsive">
                                                        <!-- Table will be injected here -->
                                                        <div class="text-center py-4 text-muted">Loading qualifications…</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--
                                        <div class="card shadow-lg border-0 rounded-4">
                                            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                                <h5 class="mb-0">📝 CTET Paper 1</h5>
                                           
                                            </div>
                                            <div class="card-body row g-3">

                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->ctet_paper1_pass ?? '') ?>">
                                                        <label class="form-label fw-semibold">CTET Paper 1 Pass</label>
                                                        <div style="background-color: #d1ddf4;padding:4px;">&nbsp;&nbsp;&nbsp;
                                                            <div class="form-check form-check-inline" style="width:70px;">
                                                                <input class="form-check-input" type="radio" name="ctet_paper1_pass" id="ctet_paper1_pass_yes" value="1" <?= !empty($staff->ctet_paper1_pass) && $staff->ctet_paper1_pass == 1 ? 'checked' : '' ?> <?= h($readFlag->tet_paper1_pass) ?>>
                                                                <label class="form-check-label" for="ctet_paper1_pass_yes">&nbsp;&nbsp;Yes</label>
                                                            </div>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <div class="form-check form-check-inline" style="width:70px;">
                                                                <input  class="form-check-input" type="radio" name="ctet_paper1_pass" id="ctet_paper1_pass_no" value="0" <?= empty($staff->ctet_paper1_pass) || $staff->ctet_paper1_pass != 1 ? 'checked' : '' ?> <?= h($readFlag->ctet_paper1_pass) ?>>
                                                                <label class="form-check-label" for="ctet_paper1_pass_no">&nbsp;&nbsp;No</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                

                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->ctet_paper1_number ?? '') ?>">
                                                        <label for="ctet_paper1_number" class="form-label fw-semibold">CTET Number Paper 1</label>
                                                        <input class="form-control" type="text" id="ctet_paper1_number" name="ctet_paper1_number" value="<?= h($staff->ctet_paper1_number ?? '') ?>"  <?= h($readFlag->ctet_paper1_number) ?>>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->ctet_paper1_percentage ?? '') ?>">
                                                        <label for="ctet_paper1_percentage" class="form-label fw-semibold">Percentage of Marks / Grade</label>
                                                        <input class="form-control" type="text" id="ctet_paper1_percentage" name="ctet_paper1_percentage" value="<?= h($staff->ctet_paper1_percentage ?? '') ?>"  <?= h($readFlag->ctet_paper1_percentage) ?>>
                                                    </div>
                                                </div>
                                                

                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->ctet_paper1_teacher_category ?? '') ?>">
                                                        <label for="ctet_paper1_teacher_category" class="form-label fw-semibold">Teacher Category</label>
                                                        <select class="form-select" id="ctet_paper1_teacher_category" name="ctet_paper1_teacher_category" <?= h($readFlag->ctet_paper1_teacher_category) ?>>
                                                            <option value="">Select Teacher Category</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->ctet_paper1_pasing_month ?? '') ?>">
                                                        <label for="ctet_paper1_pasing_month" class="form-label fw-semibold">Month of Passing</label>
                                                        <input class="form-control" type="text" id="ctet_paper1_pasing_month" name="ctet_paper1_pasing_month" value="<?= h($staff->ctet_paper1_pasing_month ?? '') ?>"  <?= h($readFlag->ctet_paper1_pasing_month) ?>>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->ctet_paper1_pasing_month ?? '') ?>">
                                                        <label for="ctet_paper1_pasing_year" class="form-label fw-semibold">Year of Passing</label>
                                                        <input class="form-control" type="text" id="ctet_paper1_pasing_year" name="ctet_paper1_pasing_year" value="<?= h($staff->ctet_paper1_pasing_year ?? '') ?>"  <?= h($readFlag->ctet_paper1_pasing_year) ?>>
                                                    </div>
                                                </div>                                              
                                            </div>
                                        </div>

                                        <div class="card shadow-lg border-0 rounded-4">
                                            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                                <h5 class="mb-0">📝 TET Paper 2</h5>
                                           
                                            </div>
                                            <div class="card-body row g-3">

                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->tet_paper2_pass ?? '') ?>">
                                                        <label class="form-label fw-semibold">TET Paper 2 Pass</label>
                                                        <div style="background-color: #d1ddf4;padding:4px;">&nbsp;&nbsp;&nbsp;
                                                            <div class="form-check form-check-inline" style="width:70px;">
                                                                <input class="form-check-input" type="radio" name="tet_paper2_pass" id="tet_paper2_pass_yes" value="1" <?= !empty($staff->tet_paper2_pass) && $staff->tet_paper2_pass == 1 ? 'checked' : '' ?> <?= h($readFlag->tet_paper2_pass) ?>>
                                                                <label class="form-check-label" for="tet_paper2_pass_yes">&nbsp;&nbsp;Yes</label>
                                                            </div>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <div class="form-check form-check-inline" style="width:70px;">
                                                                <input  class="form-check-input" type="radio" name="tet_paper2_pass" id="tet_paper2_pass_no" value="0" <?= empty($staff->tet_paper2_pass) || $staff->tet_paper2_pass != 1 ? 'checked' : '' ?> <?= h($readFlag->tet_paper2_pass) ?>>
                                                                <label class="form-check-label" for="tet_paper2_pass_no">&nbsp;&nbsp;No</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                

                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->tet_paper2_number ?? '') ?>">
                                                        <label for="tet_paper2_number" class="form-label fw-semibold">TET Number Paper 2</label>
                                                        <input class="form-control" type="text" id="tet_paper2_number" name="tet_paper2_number" value="<?= h($staff->tet_paper2_number ?? '') ?>"  <?= h($readFlag->tet_paper2_number) ?>>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->tet_paper2_percentage ?? '') ?>">
                                                        <label for="tet_paper2_percentage" class="form-label fw-semibold">Percentage of Marks / Grade</label>
                                                        <input class="form-control" type="text" id="tet_paper2_percentage" name="tet_paper2_percentage" value="<?= h($staff->tet_paper2_percentage ?? '') ?>"  <?= h($readFlag->tet_paper2_percentage) ?>>
                                                    </div>
                                                </div>
                                                

                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->tet_paper2_teacher_category ?? '') ?>">
                                                        <label for="tet_paper2_teacher_category" class="form-label fw-semibold">Teacher Category</label>
                                                        <select class="form-select" id="tet_paper2_teacher_category" name="tet_paper2_teacher_category" <?= h($readFlag->tet_paper2_teacher_category) ?>>
                                                            <option value="">Select Teacher Category</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->tet_paper2_pasing_month ?? '') ?>">
                                                        <label for="tet_paper2_pasing_month" class="form-label fw-semibold">Month of Passing</label>
                                                        <input class="form-control" type="text" id="tet_paper2_pasing_month" name="tet_paper2_pasing_month" value="<?= h($staff->tet_paper2_pasing_month ?? '') ?>"  <?= h($readFlag->tet_paper2_pasing_month) ?>>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->tet_paper2_pasing_month ?? '') ?>">
                                                        <label for="tet_paper2_pasing_year" class="form-label fw-semibold">Year of Passing</label>
                                                        <input class="form-control" type="text" id="tet_paper2_pasing_year" name="tet_paper2_pasing_year" value="<?= h($staff->tet_paper2_pasing_year ?? '') ?>"  <?= h($readFlag->tet_paper2_pasing_year) ?>>
                                                    </div>
                                                </div>                                              
                                            </div>
                                        </div>

                                        <div class="card shadow-lg border-0 rounded-4">
                                            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                                <h5 class="mb-0">📝 CTET Paper 2</h5>
                                           
                                            </div>
                                            <div class="card-body row g-3">

                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->ctet_paper2_pass ?? '') ?>">
                                                        <label class="form-label fw-semibold">CTET Paper 2 Pass</label>
                                                        <div style="background-color: #d1ddf4;padding:4px;">&nbsp;&nbsp;&nbsp;
                                                            <div class="form-check form-check-inline" style="width:70px;">
                                                                <input class="form-check-input" type="radio" name="ctet_paper2_pass" id="ctet_paper2_pass_yes" value="1" <?= !empty($staff->ctet_paper2_pass) && $staff->ctet_paper2_pass == 1 ? 'checked' : '' ?> <?= h($readFlag->tet_paper2_pass) ?>>
                                                                <label class="form-check-label" for="ctet_paper2_pass_yes">&nbsp;&nbsp;Yes</label>
                                                            </div>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <div class="form-check form-check-inline" style="width:70px;">
                                                                <input  class="form-check-input" type="radio" name="ctet_paper2_pass" id="ctet_paper2_pass_no" value="0" <?= empty($staff->ctet_paper2_pass) || $staff->ctet_paper2_pass != 1 ? 'checked' : '' ?> <?= h($readFlag->ctet_paper2_pass) ?>>
                                                                <label class="form-check-label" for="ctet_paper2_pass_no">&nbsp;&nbsp;No</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                

                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->ctet_paper2_number ?? '') ?>">
                                                        <label for="ctet_paper2_number" class="form-label fw-semibold">CTET Number Paper 2</label>
                                                        <input class="form-control" type="text" id="ctet_paper2_number" name="ctet_paper2_number" value="<?= h($staff->ctet_paper2_number ?? '') ?>"  <?= h($readFlag->ctet_paper2_number) ?>>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->ctet_paper2_percentage ?? '') ?>">
                                                        <label for="ctet_paper2_percentage" class="form-label fw-semibold">Percentage of Marks / Grade</label>
                                                        <input class="form-control" type="text" id="ctet_paper2_percentage" name="ctet_paper2_percentage" value="<?= h($staff->ctet_paper2_percentage ?? '') ?>"  <?= h($readFlag->ctet_paper2_percentage) ?>>
                                                    </div>
                                                </div>
                                                

                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->ctet_paper2_teacher_category ?? '') ?>">
                                                        <label for="ctet_paper2_teacher_category" class="form-label fw-semibold">Teacher Category</label>
                                                        <select class="form-select" id="ctet_paper2_teacher_category" name="ctet_paper2_teacher_category" <?= h($readFlag->ctet_paper2_teacher_category) ?>>
                                                            <option value="">Select Teacher Category</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->ctet_paper2_pasing_month ?? '') ?>">
                                                        <label for="ctet_paper2_pasing_month" class="form-label fw-semibold">Month of Passing</label>
                                                        <input class="form-control" type="text" id="ctet_paper2_pasing_month" name="ctet_paper2_pasing_month" value="<?= h($staff->ctet_paper2_pasing_month ?? '') ?>"  <?= h($readFlag->ctet_paper2_pasing_month) ?>>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->ctet_paper2_pasing_month ?? '') ?>">
                                                        <label for="ctet_paper2_pasing_year" class="form-label fw-semibold">Year of Passing</label>
                                                        <input class="form-control" type="text" id="ctet_paper2_pasing_year" name="ctet_paper2_pasing_year" value="<?= h($staff->ctet_paper2_pasing_year ?? '') ?>"  <?= h($readFlag->ctet_paper2_pasing_year) ?>>
                                                    </div>
                                                </div>                                              
                                            </div>
                                        </div>-->
                                                                            
             


                                        
                                        

                                                   

                                                    

                                        
                                    </form><br>

                                    
                                </section><!--TET/CTET details end-->
                                 <!-- Initial Appointment start-->
                                  <!-- 
                                <section id="content-section-11" class="content-section">

                                    NO NEED
                                    <form id="content-section-form-11" class="row g-3">

                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->recruitment_mode ?? '') ?>">
                                                <label for="recruitment_mode" class="form-label fw-semibold">Mode of Recruitment</label>
                                                <input class="form-control" type="text" id="recruitment_mode" name="recruitment_mode" value="<?= h($staff->recruitment_mode ?? '') ?>"  <?= h($readFlag->recruitment_mode) ?>>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->initial_post ?? '') ?>">
                                                <label for="initial_post" class="form-label fw-semibold">Post of Initial Appointment</label>
                                                <input class="form-control" type="text" id="initial_post" name="initial_post" value="<?= h($staff->initial_post ?? '') ?>"  <?= h($readFlag->initial_post) ?>>
                                            </div>
                                        </div>
                                       

                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->mode_of_post ?? '') ?>">
                                                <label for="mode_of_post" class="form-label fw-semibold">Mode of Getting Post</label>
                                                <input class="form-control" type="text" id="mode_of_post" name="mode_of_post" value="<?= h($staff->mode_of_post ?? '') ?>"  <?= h($readFlag->mode_of_post) ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->recruitment_category ?? '') ?>">
                                                <label for="recruitment_category" class="form-label fw-semibold">Recruitment Category</label>
                                                <input class="form-control" type="text" id="recruitment_category" name="recruitment_category" value="<?= h($staff->recruitment_category ?? '') ?>"  <?= h($readFlag->recruitment_category) ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->recruitment_hor_category ?? '') ?>">
                                                <label for="recruitment_hor_category" class="form-label fw-semibold">Recruitment Hor. Category</label>
                                                <input class="form-control" type="text" id="recruitment_hor_category" name="recruitment_hor_category" value="<?= h($staff->recruitment_hor_category ?? '') ?>"  <?= h($readFlag->recruitment_hor_category) ?>>
                                            </div>
                                        </div>
                                         
                                            

                                           
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->recruitment_ph_category ?? '') ?>">
                                                <label for="recruitment_ph_category" class="form-label fw-semibold">Recruitment PH. Details</label>
                                                <input class="form-control" type="text" id="recruitment_ph_category" name="recruitment_ph_category" value="<?= h($staff->recruitment_ph_category ?? '') ?>"  <?= h($readFlag->recruitment_ph_category) ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->recruitment_orphan_category ?? '') ?>">
                                                <label for="recruitment_orphan_category" class="form-label fw-semibold">Recruitment Orphan Details</label>
                                                <input class="form-control" type="text" id="recruitment_orphan_category" name="recruitment_orphan_category" value="<?= h($staff->recruitment_orphan_category ?? '') ?>"  <?= h($readFlag->recruitment_orphan_category) ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->appointment_for_subject_1 ?? '') ?>">
                                                <label for="appointment_for_subject_1" class="form-label fw-semibold">Appointment for Subject 1</label>
                                                <select class="form-select" id="appointment_for_subject_1" name="appointment_for_subject_1" <?= h($readFlag->appointment_for_subject_1) ?>>
                                                    <option value="">Select Appointment of Subject 1</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->appointment_for_subject_2 ?? '') ?>">
                                                <label for="appointment_for_subject_2" class="form-label fw-semibold">Appointment for Subject 2</label>
                                                <select class="form-select" id="appointment_for_subject_2" name="appointment_for_subject_2" <?= h($readFlag->appointment_for_subject_2) ?>>
                                                    <option value="">Select Appointment of Subject 1</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->recruitment_appointment_nature ?? '') ?>">
                                                <label for="recruitment_appointment_nature" class="form-label fw-semibold">Nature of Appointment</label>
                                                <input class="form-control" type="text" id="recruitment_appointment_nature" name="recruitment_appointment_nature" value="<?= h($staff->recruitment_appointment_nature ?? '') ?>"  <?= h($readFlag->recruitment_appointment_nature) ?>>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->intial_appointment_remark ?? '') ?>">
                                                <label for="intial_appointment_remark" class="form-label fw-semibold">Nature of Appointment</label>
                                                <input class="form-control" type="text" id="intial_appointment_remark" name="intial_appointment_remark" value="<?= h($staff->intial_appointment_remark ?? '') ?>"  <?= h($readFlag->intial_appointment_remark) ?>>
                                            </div>
                                        </div>
                                    </form><br>
                                
                                </section>--><!-- Initial Appointment end-->
                                                    <!--Teaching Details (UDISE) start
                                <section id="content-section-11" class="content-section">
                                    <form id="content-section-form-12" class="row g-3">
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->classes_taught ?? '') ?>">
                                                <label for="classes_taught" class="form-label fw-semibold">Classes Taught (Level)</label>
                                                <input class="form-control" type="text" id="classes_taught" name="classes_taught" value="<?= h($staff->classes_taught ?? '') ?>"  <?= h($readFlag->classes_taught) ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->current_appointment_subject ?? '') ?>">
                                                <label for="current_appointment_subject" class="form-label fw-semibold">Current Appointment for Subject</label>
                                                <input class="form-control" type="text" id="current_appointment_subject" name="current_appointment_subject" value="<?= h($staff->current_appointment_subject ?? '') ?>"  <?= h($readFlag->current_appointment_subject) ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->subject_taught_first ?? '') ?>">
                                                <label for="subject_taught_first" class="form-label fw-semibold">Subject Taught (First)</label>
                                                <input class="form-control" type="text" id="subject_taught_first" name="subject_taught_first" value="<?= h($staff->subject_taught_first ?? '') ?>"  <?= h($readFlag->subject_taught_first) ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->subject_taught_second ?? '') ?>">
                                                <label for="subject_taught_second" class="form-label fw-semibold">Subject Taught (Second)</label>
                                                <input class="form-control" type="text" id="subject_taught_second" name="subject_taught_second" value="<?= h($staff->subject_taught_second ?? '') ?>"  <?= h($readFlag->subject_taught_second) ?>>
                                            </div>
                                        </div>                                       
                                    </form><br>

                                    

                                </section>Teaching Details (UDISE) end -->

                                <section id="content-section-10" class="content-section"><!--Service Tracking start-->

                                
                                    <div class="card shadow-lg border-0 rounded-4">
                                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Service History</h5>
                                        <button id="addWorkBtn" class="btn btn-light btn-sm fw-semibold">
                                            + Add New Service Details
                                        </button>
                                        </div>
                                        <div class="card-body">
                                        <div id="workTableContainer" class="table-responsive"></div>
                                        </div>
                                    </div>


                                        
                                        <br>
                                </section><!-- Service Tracking end -->

                                <section id="content-section-11" class="content-section"><!--Pay Details start-->
                                    <form id="content-section-form-14" class="row g-3">
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->pay_commission_id ?? '') ?>">
                                                <label for="pay_commission_id" class="form-label fw-semibold">Pay Commission</label>
                                                <select class="form-select" id="pay_commission_id" name="pay_commission_id" <?= h($readFlag->pay_commission_id ?? '') ?>>
                                               
                                                </select>
                                            </div>
                                        </div>

                                         
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->scale_id ?? '') ?>">
                                                <label for="scale_id" class="form-label fw-semibold">Pay Scale</label>
                                                <select class="form-select" id="scale_id" name="scale_id" <?= h($readFlag->scale_id ?? '') ?>>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->pay_matrix ?? '') ?>">
                                                <label for="pay_matrix" class="form-label fw-semibold">Pay Matrix</label>
                                                <!--<select class="form-select" id="pay_matrix" name="pay_matrix" <?= h($readFlag->pay_matrix ?? '') ?>>
                                                </select>-->
                                                <input class="form-control" type="text" id="pay_matrix" name="pay_matrix"
                                                    value="<?= h($staff->pay_matrix ?? '') ?>" <?= h($readFlag->pay_matrix) ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm required-field <?= h($css->senior_grade ?? '') ?>">
                                                <label class="form-label fw-semibold">Received Senior Grade Scale?</label>
                                                <div style="background-color: #d1ddf4; padding:4px;">
                                                &nbsp;&nbsp;&nbsp;
                                                <div class="form-check form-check-inline" style="width:70px;">
                                                    <input class="form-check-input" type="radio" name="senior_grade" id="senior_grade_yes" value="1"
                                                    <?= !empty($staff->senior_grade) && $staff->senior_grade == 1 ? 'checked' : '' ?>>
                                                    <label class="form-check-label" for="senior_grade_yes">&nbsp;&nbsp;Yes</label>
                                                </div>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <div class="form-check form-check-inline" style="width:70px;">
                                                    <input class="form-check-input" type="radio" name="senior_grade" id="senior_grade_no" value="0"
                                                    <?= empty($staff->senior_grade) || $staff->senior_grade != 1 ? 'checked' : '' ?>>
                                                    <label class="form-check-label" for="senior_grade_no">&nbsp;&nbsp;No</label>
                                                </div>
                                                </div>
                                            </div>
                                            </div>

                                            
                                            <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm required-field <?= h($css->selection_grade ?? '') ?>">
                                                <label class="form-label fw-semibold">Received Selection Grade Scale?</label>
                                                <div style="background-color: #d1ddf4; padding:4px;">
                                                &nbsp;&nbsp;&nbsp;
                                                <div class="form-check form-check-inline" style="width:70px;">
                                                    <input class="form-check-input" type="radio" name="selection_grade" id="selection_grade_yes" value="1"
                                                    <?= !empty($staff->selection_grade) && $staff->selection_grade == 1 ? 'checked' : '' ?>>
                                                    <label class="form-check-label" for="selection_grade_yes">&nbsp;&nbsp;Yes</label>
                                                </div>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <div class="form-check form-check-inline" style="width:70px;">
                                                    <input class="form-check-input" type="radio" name="selection_grade" id="selection_grade_no" value="0"
                                                    <?= empty($staff->selection_grade) || $staff->selection_grade != 1 ? 'checked' : '' ?>>
                                                    <label class="form-check-label" for="selection_grade_no">&nbsp;&nbsp;No</label>
                                                </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm required-field <?= h($css->pay_in_band ?? '') ?>">
                                                <label for="pay_in_band" class="form-label fw-semibold">Pay in Band</label>
                                                <input class="form-control" type="text" id="pay_in_band" name="pay_in_band"
                                                    value="<?= h($staff->pay_in_band ?? '') ?>" <?= h($readFlag->pay_in_band) ?>>
                                            </div>
                                            </div>

                                            <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm required-field <?= h($css->grade_pay ?? '') ?>">
                                                <label for="grade_pay" class="form-label fw-semibold">Grade Pay</label>
                                                <input class="form-control" type="text" id="grade_pay" name="grade_pay"
                                                    value="<?= h($staff->grade_pay ?? '') ?>" <?= h($readFlag->grade_pay) ?>>
                                            </div>
                                            </div>
                                            <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm required-field <?= h($css->basic_pay ?? '') ?>">
                                                <label for="basic_pay" class="form-label fw-semibold">Basic Pay</label>
                                                <input class="form-control" type="text" id="basic_pay" name="basic_pay"
                                                    value="<?= h($staff->basic_pay ?? '') ?>" <?= h($readFlag->basic_pay) ?>>
                                            </div>
                                            </div>
                                           
                                            

                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm required-field <?= h($css->pay_wef_date ?? '') ?>">
                                                <label for="pay_wef_date" class="form-label fw-semibold">Pay w.e.f. Date</label>
                                                <input class="form-control date-field" type="text" id="pay_wef_date" name="pay_wef_date"
                                                    value="<?= h(!empty($staff->pay_wef_date) ? date('d/m/Y', strtotime($staff->pay_wef_date)) : '') ?>"
                                                    placeholder="dd/mm/yyyy" <?= h($readFlag->pay_wef_date) ?>>
                                            </div>
                                            </div>

                                            <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm required-field <?= h($css->next_increment_date ?? '') ?>">
                                                <label for="next_increment_date" class="form-label fw-semibold">Next Increment Date</label>
                                                <input class="form-control date-field" type="text" id="next_increment_date" name="next_increment_date"
                                                    value="<?= h(!empty($staff->next_increment_date) ? date('d/m/Y', strtotime($staff->next_increment_date)) : '') ?>"
                                                    placeholder="dd/mm/yyyy" <?= h($readFlag->next_increment_date) ?>>
                                            </div>
                                            </div>

                                            <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm required-field <?= h($css->senior_grade_date ?? '') ?>">
                                                <label for="senior_grade_date" class="form-label fw-semibold">Senior Grade Date Received</label>
                                                <input class="form-control date-field" type="text" id="senior_grade_date" name="senior_grade_date"
                                                    value="<?= h(!empty($staff->senior_grade_date) ? date('d/m/Y', strtotime($staff->senior_grade_date)) : '') ?>"
                                                    placeholder="dd/mm/yyyy" <?= h($readFlag->senior_grade_date) ?>>
                                            </div>
                                            </div>

                                            <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm required-field <?= h($css->selection_grade_date ?? '') ?>">
                                                <label for="selection_grade_date" class="form-label fw-semibold">Selection Grade Date Received</label>
                                                <input class="form-control date-field" type="text" id="selection_grade_date" name="selection_grade_date"
                                                    value="<?= h(!empty($staff->selection_grade_date) ? date('d/m/Y', strtotime($staff->selection_grade_date)) : '') ?>"
                                                    placeholder="dd/mm/yyyy" <?= h($readFlag->selection_grade_date) ?>>
                                            </div>
                                        </div>                                      
                                    </form><br>

                                    
                                </section><!--Pay Details end-->

                            
                                <section id="content-section-12" class="content-section"><!--PF/DCPS/GPF start-->                                    
                                    <form id="content-section-form-15" class="row g-3">
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->pf->acc_type ?? '') ?>">
                                                <label for="pf_acc_type" class="form-label fw-semibold">Account Type</label>
                                                <input class="form-control" type="text" id="pf_acc_type" name="pf_acc_type" value="<?= h($staff->pf_acc_type ?? '') ?>"  <?= h($readFlag->pf->acc_type) ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->pf->acc_maintained_by ?? '') ?>">
                                                <label for="pf_acc_maintained_by" class="form-label fw-semibold">Account Maintained By</label>
                                                <input class="form-control" type="text" id="pf_acc_maintained_by" name="pf_acc_maintained_by" value="<?= h($staff->pf_acc_maintained_by ?? '') ?>"  <?= h($readFlag->pf->acc_maintained_by) ?>>
                                            </div>
                                        </div>

                                         <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->pf->series ?? '') ?>">
                                                <label for="pf_series" class="form-label fw-semibold">PF Series</label>
                                                <input class="form-control" type="text" id="pf_series" name="pf_series" value="<?= h($staff->pf_series ?? '') ?>"  <?= h($readFlag->pf->series) ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->pf->gpf_account_no ?? '') ?>">
                                                <label for="pf_gpf_account_no" class="form-label fw-semibold">PF Account No</label>
                                                <input class="form-control" type="text" id="pf_gpf_account_no" name="pf_gpf_account_no" value="<?= h($staff->pf_gpf_account_no ?? '') ?>"  <?= h($readFlag->pf->gpf_account_no) ?>>
                                            </div>
                                        </div>                                        

                                       
                                    </form><br>

                                    
                                </section><!--PF/DCPS/GPF end-->

                                <section id="content-section-13" class="content-section"><!--Bank Account details start-->
                                    <form id="content-section-form-16" class="row g-3">
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->bank->bank_name ?? '') ?>">
                                                <label for="bank_name" class="form-label fw-semibold">Bank Name</label>
                                                <input class="form-control" type="text" id="bank_name" name="bank_name" value="<?= h($staff->bank_name ?? '') ?>"  <?= h($readFlag->bank->bank_name) ?>>
                                            </div>
                                        </div>

                                         <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->bank->branch_name ?? '') ?>">
                                                <label for="branch_name" class="form-label fw-semibold">Branch Name</label>
                                                <input class="form-control" type="text" id="branch_name" name="branch_name" value="<?= h($staff->branch_name ?? '') ?>"  <?= h($readFlag->bank->branch_name) ?>>
                                            </div>
                                        </div>

                                         <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->bank->acc_name ?? '') ?>">
                                                <label for="bank_account_holder_name" class="form-label fw-semibold">Name as per Bank Account</label>
                                                <input class="form-control" type="text" id="bank_account_holder_name" name="bank_account_holder_name" value="<?= h($staff->bank_account_holder_name ?? '') ?>"  <?= h($readFlag->bank->acc_name) ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->bank->acc_number ?? '') ?>">
                                                <label for="account_number" class="form-label fw-semibold">Account Number</label>
                                                <input class="form-control" type="text" id="account_number" name="account_number" value="<?= h($staff->account_number ?? '') ?>"  <?= h($readFlag->bank->acc_number) ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->bank->ifsc ?? '') ?>">
                                                <label for="ifsc_code" class="form-label fw-semibold">IFSC Code</label>
                                                <input class="form-control" type="text" id="ifsc_code" name="ifsc_code" value="<?= h($staff->ifsc_code ?? '') ?>"  <?= h($readFlag->bank->ifsc) ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->bank->micr ?? '') ?>">
                                                <label for="micr_code" class="form-label fw-semibold">MICR Code</label>
                                                <input class="form-control" type="text" id="micr_code" name="micr_code" value="<?= h($staff->micr_code ?? '') ?>"  <?= h($readFlag->bank->micr) ?>>
                                            </div>
                                        </div>
                                            
                                    </form><br>
                                    
                                </section><!--Bank Account details end-->

                                <section id="content-section-14" class="content-section"><!-- Leave Details start-->
                                    <form id="content-section-form-17">
                                        <div class="container">
                                            <div class="card shadow-sm border-0 rounded-4">
                                                <div class="card-header bg-primary text-white rounded-top-4">
                                                <h5 class="mb-0"><i class="fa-solid fa-calendar-days me-2"></i>Leave Details</h5>
                                                </div>

                                                <div class="card-body">
                                                <!-- Casual Leave Section -->
                                                <h6 class="text-primary fw-semibold mb-3">Leave Availability</h6>
                                                <div class="row g-3 mb-4">
                                                    <div class="col-md-8">
                                                        <label class="form-label fw-semibold">Casual Leave (Current Academic Year)</label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="number" class="form-control" id="cl_available" name="cl_available" placeholder="Enter Casual Leave (AY)">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <label class="form-label fw-semibold">Earned Leave (Current Academic Year)</label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="number" class="form-control" id="el_available" name="el_available"  placeholder="Enter Earned Leave (AY)">
                                                    </div>

                                                    <div class="col-md-8">
                                                        <label class="form-label fw-semibold">Earned Leave – Carry Forward (Last Year)</label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="number" class="form-control" id="el_carry_forward" name="el_carry_forward"  placeholder="Enter Earned Leave Carry Forward">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <label class="form-label fw-semibold">Total Leaves Available</label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="number" class="form-control" id="total_leave_balance"  id="total_leave_balance" placeholder="Enter Total Leave Entitlement" readonly>
                                                    </div>
                                                   
                                                </div>

                                                <hr>

                                                <h6 class="text-warning fw-semibold mb-3">Leave Utilization (Current Academic Year)</h6>
                                                <div class="row g-3 mb-4">
                                                    <div class="col-md-8">
                                                        <label class="form-label fw-semibold">Used Leaves</label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="number" class="form-control" id="used_leaves" name="used_leaves" placeholder="Enter Leaves Utilized (AY)">
                                                    </div>                                                   
                                                   
                                                </div>

                                                <hr>

                                                <h6 class="text-success fw-semibold mb-3">Leave Balance (Current Academic Year)</h6>
                                                <div class="row g-3 mb-4">
                                                    <div class="col-md-8">
                                                        <label class="form-label fw-semibold">Remaining Leaves</label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="number" class="form-control" id="remaining_leaves" name="remaining_leaves" placeholder="Enter Available Leave Balance (AY)" readonly>
                                                    </div>                                                   
                                                   
                                                </div>

                                                <hr>

                                                <!-- Unpaid Leave Section -->
                                                <h6 class="text-danger fw-semibold mb-3">Unpaid Leave</h6>
                                                <div class="row g-3">
                                                     <div class="col-md-8">
                                                        <label class="form-label fw-semibold">Unpaid Leaves (This Academic Year)</label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="number" class="form-control"  id="unpaid_leaves"  name="unpaid_leaves" placeholder="Enter Unpaid Leave (AY)" readonly>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>

                                        
                                    </form>
                                    
                                    

                                    
                                </section><!-- Leave details end-->

                                <section id="content-section-15" class="content-section"><!--Rewards details start-->                                    
                                    <div class="card shadow-lg border-0 rounded-4">
                                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Rewards History</h5>
                                        <button id="addRewardBtn" class="btn btn-light btn-sm fw-semibold">
                                            + Add Reward Details
                                        </button>
                                        </div>
                                        <div class="card-body">
                                        <div id="rewardTableContainer" class="table-responsive"></div>
                                        </div>
                                    </div>                                  
                                </section><!--Rewards details end-->

                                <section id="content-section-16" class="content-section"><!--Training Attended details start-->
                                    <div class="card shadow-lg border-0 rounded-4">
                                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Training Attended History</h5>
                                        <button id="addTrainingBtn" class="btn btn-light btn-sm fw-semibold">
                                            + Add Training Details
                                        </button>
                                        </div>
                                        <div class="card-body">
                                        <div id="trainingTableContainer" class="table-responsive"></div>
                                        </div>
                                    </div>

                                    <form id="content-section-form-19">
                                        

                                        <div class="card shadow-lg border-0 rounded-4">
                                            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                                <h5 class="mb-0">📅Attendance Details</h5>
                                           
                                            </div>
                                            <div class="card-body row g-3">

                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->train->trained_cwsn ?? '') ?>">
                                                        <label class="form-label fw-semibold">Trained CWSN</label>
                                                        <div style="background-color: #d1ddf4;padding:4px;">&nbsp;&nbsp;&nbsp;
                                                            <div class="form-check form-check-inline" style="width:70px;">
                                                                <input class="form-check-input" type="radio" name="train_trained_cwsn" id="train_trained_cwsn_yes" value="1" <?= !empty($staff->train_trained_cwsn) && $staff->train_trained_cwsn == 1 ? 'checked' : '' ?> <?= h($readFlag->train->trained_cwsn) ?>>
                                                                <label class="form-check-label" for="train_trained_cwsn_yes">&nbsp;&nbsp;Yes</label>
                                                            </div>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <div class="form-check form-check-inline" style="width:70px;">
                                                                <input  class="form-check-input" type="radio" name="train_trained_cwsn" id="train_trained_cwsn_no" value="0" <?= empty($staff->train_trained_cwsn) || $staff->train_trained_cwsn != 1 ? 'checked' : '' ?> <?= h($readFlag->train->trained_cwsn) ?>>
                                                                <label class="form-check-label" for="train_trained_cwsn_no">&nbsp;&nbsp;No</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->train->training_computer ?? '') ?>">
                                                        <label class="form-label fw-semibold">Trained Computer</label>
                                                        <div style="background-color: #d1ddf4;padding:4px;">&nbsp;&nbsp;&nbsp;
                                                            <div class="form-check form-check-inline" style="width:70px;">
                                                                <input class="form-check-input" type="radio" name="train_training_computer" id="train_training_computer_yes" value="1" <?= !empty($staff->train_training_computer) && $staff->train_training_computer == 1 ? 'checked' : '' ?> <?= h($readFlag->train->training_computer) ?>>
                                                                <label class="form-check-label" for="train_training_computer_yes">&nbsp;&nbsp;Yes</label>
                                                            </div>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <div class="form-check form-check-inline" style="width:70px;">
                                                                <input  class="form-check-input" type="radio" name="train_training_computer" id="train_training_computer_no" value="0" <?= empty($staff->train_training_computer) || $staff->train_training_computer != 1 ? 'checked' : '' ?> <?= h($readFlag->train->training_computer) ?>>
                                                                <label class="form-check-label" for="train_training_computer_no">&nbsp;&nbsp;No</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->train->training_received ?? '') ?>">
                                                        <label class="form-label fw-semibold">Trained Received</label>
                                                        <div style="background-color: #d1ddf4;padding:4px;">&nbsp;&nbsp;&nbsp;
                                                            <div class="form-check form-check-inline" style="width:70px;">
                                                                <input class="form-check-input" type="radio" name="train_training_received" id="train_training_received_yes" value="1" <?= !empty($staff->train_training_received) && $staff->train_training_received == 1 ? 'checked' : '' ?> <?= h($readFlag->train->training_received) ?>>
                                                                <label class="form-check-label" for="train_training_received_yes">&nbsp;&nbsp;Yes</label>
                                                            </div>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <div class="form-check form-check-inline" style="width:70px;">
                                                                <input  class="form-check-input" type="radio" name="train_training_received" id="train_training_received_no" value="0" <?= empty($staff->train_training_received) || $staff->train_training_received != 1 ? 'checked' : '' ?> <?= h($readFlag->train->training_received) ?>>
                                                                <label class="form-check-label" for="train_training_received_no">&nbsp;&nbsp;No</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->train->training_needed ?? '') ?>">
                                                        <label class="form-label fw-semibold">Training Needed</label>
                                                        <div style="background-color: #d1ddf4;padding:4px;">&nbsp;&nbsp;&nbsp;
                                                            <div class="form-check form-check-inline" style="width:70px;">
                                                                <input class="form-check-input" type="radio" name="train_training_needed" id="train_training_needed_yes" value="1" <?= !empty($staff->train_training_needed) && $staff->train_training_needed == 1 ? 'checked' : '' ?> <?= h($readFlag->train->training_needed) ?>>
                                                                <label class="form-check-label" for="train_training_needed_yes">&nbsp;&nbsp;Yes</label>
                                                            </div>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <div class="form-check form-check-inline" style="width:70px;">
                                                                <input  class="form-check-input" type="radio" name="train_training_needed" id="train_training_needed_no" value="0" <?= empty($staff->train_training_needed) || $staff->train_training_needed != 1 ? 'checked' : '' ?> <?= h($readFlag->train->training_needed) ?>>
                                                                <label class="form-check-label" for="train_training_needed_no">&nbsp;&nbsp;No</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->train->training_nishtha ?? '') ?>">
                                                        <label class="form-label fw-semibold">Training Nishtha</label>
                                                        <div style="background-color: #d1ddf4;padding:4px;">&nbsp;&nbsp;&nbsp;
                                                            <div class="form-check form-check-inline" style="width:70px;">
                                                                <input class="form-check-input" type="radio" name="train_training_nishtha" id="train_training_nishtha_yes" value="1" <?= !empty($staff->train_training_nishtha) && $staff->train_training_nishtha == 1 ? 'checked' : '' ?> <?= h($readFlag->train->training_nishtha) ?>>
                                                                <label class="form-check-label" for="train_training_nishtha_yes">&nbsp;&nbsp;Yes</label>
                                                            </div>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <div class="form-check form-check-inline" style="width:70px;">
                                                                <input  class="form-check-input" type="radio" name="train_training_nishtha" id="train_training_nishtha_no" value="0" <?= empty($staff->train_training_nishtha) || $staff->train_training_nishtha != 1 ? 'checked' : '' ?> <?= h($readFlag->train->training_nishtha) ?>>
                                                                <label class="form-check-label" for="train_training_nishtha_no">&nbsp;&nbsp;No</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->train->training_ssa ?? '') ?>">
                                                        <label class="form-label fw-semibold">Training SSA</label>
                                                        <div style="background-color: #d1ddf4;padding:4px;">&nbsp;&nbsp;&nbsp;
                                                            <div class="form-check form-check-inline" style="width:70px;">
                                                                <input class="form-check-input" type="radio" name="train_training_ssa" id="train_training_ssa_yes" value="1" <?= !empty($staff->train_training_ssa) && $staff->train_training_ssa == 1 ? 'checked' : '' ?> <?= h($readFlag->train->training_ssa) ?>>
                                                                <label class="form-check-label" for="train_training_ssa_yes">&nbsp;&nbsp;Yes</label>
                                                            </div>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <div class="form-check form-check-inline" style="width:70px;">
                                                                <input  class="form-check-input" type="radio" name="train_training_ssa" id="train_training_ssa_no" value="0" <?= empty($staff->train_training_ssa) || $staff->train_training_ssa != 1 ? 'checked' : '' ?> <?= h($readFlag->train->training_ssa) ?>>
                                                                <label class="form-check-label" for="train_training_ssa_no">&nbsp;&nbsp;No</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->train->psy_soc_aspect ?? '') ?>">
                                                        <label class="form-label fw-semibold">Psychological & Social Aspects Training</label>
                                                        <div style="background-color: #d1ddf4;padding:4px;">&nbsp;&nbsp;&nbsp;
                                                            <div class="form-check form-check-inline" style="width:70px;">
                                                                <input class="form-check-input" type="radio" name="train_psy_soc_aspect" id="train_psy_soc_aspect_yes" value="1" <?= !empty($staff->train_psy_soc_aspect) && $staff->train_psy_soc_aspect == 1 ? 'checked' : '' ?> <?= h($readFlag->train->psy_soc_aspect) ?>>
                                                                <label class="form-check-label" for="train_psy_soc_aspect_yes">&nbsp;&nbsp;Yes</label>
                                                            </div>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <div class="form-check form-check-inline" style="width:70px;">
                                                                <input  class="form-check-input" type="radio" name="train_psy_soc_aspect" id="train_psy_soc_aspect_no" value="0" <?= empty($staff->train_psy_soc_aspect) || $staff->train_psy_soc_aspect != 1 ? 'checked' : '' ?> <?= h($readFlag->train->psy_soc_aspect) ?>>
                                                                <label class="form-check-label" for="train_psy_soc_aspect_no">&nbsp;&nbsp;No</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->train->support_cwsn ?? '') ?>">
                                                        <label class="form-label fw-semibold">Received Training Support CWSN</label>
                                                        <div style="background-color: #d1ddf4;padding:4px;">&nbsp;&nbsp;&nbsp;
                                                            <div class="form-check form-check-inline" style="width:70px;">
                                                                <input class="form-check-input" type="radio" name="train_support_cwsn" id="train_support_cwsn_yes" value="1" <?= !empty($staff->train_support_cwsn) && $staff->train_support_cwsn == 1 ? 'checked' : '' ?> <?= h($readFlag->train->support_cwsn) ?>>
                                                                <label class="form-check-label" for="train_support_cwsn_yes">&nbsp;&nbsp;Yes</label>
                                                            </div>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <div class="form-check form-check-inline" style="width:70px;">
                                                                <input  class="form-check-input" type="radio" name="train_support_cwsn" id="train_support_cwsn_no" value="0" <?= empty($staff->train_support_cwsn) || $staff->train_support_cwsn != 1 ? 'checked' : '' ?> <?= h($readFlag->train->support_cwsn) ?>>
                                                                <label class="form-check-label" for="train_support_cwsn_no">&nbsp;&nbsp;No</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                

                                                                                             
                                            </div>
                                        </div>

                                        
                                    </form><br>
                                </section><!--Training Attended details end-->
                            
                                <section id="content-section-17" class="content-section"><!--Disciplinary Action start-->
                                    <div class="container my-4">
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <h4 class="mb-0">Disciplinary Action</h4>
                                            <div>
                                            <button id="addDisciplinaryActionBtn" class="btn btn-primary">
                                                <i class="bi bi-plus-lg"></i> Add Disciplinary Action
                                            </button>
                                            </div>
                                        </div>

                                        <div id="DisciplinaryActionsWrapper" class="card shadow-sm">
                                            <div class="card-body">
                                            <div id="disciplinaryActionTableContainer" class="table-responsive">
                                                <!-- Table will be injected here -->
                                                <div class="text-center py-4 text-muted">Loading Disciplinary Actions...</div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </section><!--Disciplinary Action end-->

                                <section id="content-section-18" class="content-section"><!--Confirm details start-->
                                 
                                    <div class="confirmation-box">
                                        <h4 class="fw-bold text-primary mb-3">Confirmation Required</h4>
                                        <p class="text-muted">
                                            Are you sure all the information updated is correct to the best of your knowledge?<br>
                                            Once confirmed, this staff information will be forwarded to the next level.
                                        </p>
                                        <a href="#" id="viewProfileLink" target="_blank" class="d-block mb-3 text-decoration-none fw-semibold text-success">
                                            🔍 View Staff Profile
                                        </a>
                                        <button id="confirmBtn" class="btn btn-main">OK, Proceed</button>
                                    </div>


                                </section><!--Confirm details end-->
                            </div>
                        </main>
                    </div>
                </div>
            </div>
       


<!-- Processing Modal (hidden by default) -->
<div id="processingModal" class="processing-modal" aria-hidden="true">
  <div class="processing-content">
    <div class="spinner"></div>
    <div class="processing-text">Processing... Please wait</div>
  </div>
</div>


 



<!-- ================= Modal for Add Family Member ================= -->
<div class="modal fade" id="familyModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 shadow">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Add Family Member</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="familyForm" class="row g-3">             
            <input type="hidden" name="familyId" />
            <div id="familyError"></div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Family Member Name</label>
                <input type="text" name="family_member_name" id="family_member_name" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Relation</label>
                <select name="relation_id" id="relation_id" class="form-select" required>
                <option value="">Select Relation</option>
                <?php 
                    foreach($relationships as $rkey => $relation){
                        echo '<option value="'.$relation->id.'">'.$relation->relationship.'</option>';
                    }
                ?>
                </select>
            </div>

            <div class="col-md-6">
                <label for="date_of_birth" class="form-label fw-semibold">Date of Birth</label>
                <input type="text" name="date_of_birth" id="date_of_birth" class="form-control date-field" required>
            </div>


          
            <div class="col-md-6">
                <label class="form-label fw-semibold">Aadhar Card No</label>
                <input type="text" name="aadhar_card_no" maxlength="12" pattern="\d{12}" class="form-control">
            </div>

          
            <div class="col-md-12 d-flex align-items-center">
                <label class="me-3 fw-semibold">Covered under Family?</label>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="covered_under_family" value="true" checked>
                    <label class="form-check-label">Yes</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="covered_under_family" value="false">
                    <label class="form-check-label">No</label>
                </div>
            </div>

            <div class="row" id="nomination-section">
                <div class="col-md-6">
                    <label for="date_of_nominaton" class="form-label fw-semibold">Date of Nomination</label>
                    <input type="text" name="date_of_nominaton" id="date_of_nominaton" class="form-control date-field" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Nomination Percentage</label>
                    <input type="number" name="nominaton_percentage" id="nominaton_percentage"  class="form-control">
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer bg-light">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" id="saveFamilyBtn" class="btn btn-primary fw-semibold">Save</button>
      </div>
    </div>
  </div>
</div>

<!-- ============ VIEW FAMILY MEMBER MODAL ============ -->
<div class="modal fade" id="viewFamilyModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content shadow">

      <div class="modal-header bg-info text-white">
        <h5 class="modal-title">Family Member Details</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="row g-3">

          <div class="col-md-6">
            <label class="fw-semibold">Family Member Name</label>
            <p id="v_family_member_name" class="form-control bg-light"></p>
          </div>

          <div class="col-md-6">
            <label class="fw-semibold">Relation</label>
            <p id="v_relation" class="form-control bg-light"></p>
          </div>

          <div class="col-md-6">
            <label class="fw-semibold">Date of Birth</label>
            <p id="v_date_of_birth" class="form-control bg-light"></p>
          </div>

          <div class="col-md-6">
            <label class="fw-semibold">Aadhar</label>
            <p id="v_aadhar" class="form-control bg-light"></p>
          </div>

          <div class="col-md-6">
            <label class="fw-semibold">Covered Under Family</label>
            <p id="v_covered" class="form-control bg-light"></p>
          </div>

          <div class="col-md-6">
            <label class="fw-semibold">Nomination Date</label>
            <p id="v_nom_date" class="form-control bg-light"></p>
          </div>

          <div class="col-md-6">
            <label class="fw-semibold">Nomination %</label>
            <p id="v_nom_percent" class="form-control bg-light"></p>
          </div>

        </div>
      </div>

      <div class="modal-footer bg-light">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


<!-- ================= Modal for Add Nomination Record ================= -->
<div class="modal fade" id="nominationModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 shadow">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Add Nomination Record</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="nominationForm" class="row g-3">
            <div id="nominationError"></div>       

          <div class="col-md-6">
            <label class="form-label fw-semibold" for="nomination_type_id">Nomination Type</label>
            <select name="nomination_type_id" class="form-select" required>
              <option value="">Select Nomination Type</option>
              <?php 
                foreach($nominations as $rkey => $nomination){
                    echo '<option value="'.$nomination->id.'">'.$nomination->nomination_type.' ('.$nomination->description.')</option>';
                }
             ?>
            </select>
          </div>

          <div class="col-md-6">
            <label for="date_of_nomination" class="form-label fw-semibold">Date of Nomination</label>
            <input type="text" name="date_of_nomination" id="date_of_nomination" class="form-control date-field" required>
          </div>

          

          <div class="col-md-6">
            <label class="form-label fw-semibold" for="nomination_as_id">Nomination As</label>
            <select name="nomination_as_id" id="nomination_as_id" class="form-select" required>
              <option value="">Select Nomination As</option>
             
            </select>
          </div>

          
          <div class="col-md-6">
            <label class="form-label fw-semibold">Nomination Percentage</label>
            <input type="number" name="nomination_percentage" min="1" max="100" placeholder="Enter %" class="form-control">
          </div>
        </form>
      </div>
      <div class="modal-footer bg-light">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" id="saveNominationBtn" class="btn btn-primary fw-semibold">Save</button>
      </div>
    </div>
  </div>
</div>

<!-- ============ VIEW ACADEMIC QUALIFICATON MODAL ============ -->
<div class="modal fade" id="viewAcademicModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content shadow">

      <div class="modal-header bg-info text-white">
        <h5 class="modal-title">Academic Qualification Details</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="row g-3">

          <div class="col-md-3">
            <label class="fw-semibold">Qualification Level</label>
            <p id="v_academic_level" class="form-control bg-light"></p>
          </div>

          <div class="col-md-3">
            <label class="fw-semibold">Degree / Certification</label>
            <p id="v_academic_degree" class="form-control bg-light"></p>
          </div>

          <div class="col-md-3">
            <label class="fw-semibold">Degree From Maharashtra?</label>
            <p id="v_academic_degree_from_maharashtra" class="form-control bg-light"></p>
          </div>

          <div class="col-md-3">
            <label class="fw-semibold">State</label>
            <p id="v_academic_state" class="form-control bg-light"></p>
          </div>

          <div class="col-md-4">
            <label class="fw-semibold">Board / University</label>
            <p id="v_academic_board_university" class="form-control bg-light"></p>
          </div>

          <div class="col-md-3">
            <label class="fw-semibold">Marks Obtained</label>
            <p id="v_academic_marks_obtained" class="form-control bg-light"></p>
          </div>

          <div class="col-md-3">
            <label class="fw-semibold">Marks Out Of</label>
            <p id="v_academic_marks_out_of" class="form-control bg-light"></p>
          </div>

          <div class="col-md-2">
            <label class="fw-semibold">Percentage</label>
            <p id="v_academic_percentage" class="form-control bg-light"></p>
          </div>

          <div class="col-md-3">
            <label class="fw-semibold">Grade</label>
            <p id="v_academic_grade" class="form-control bg-light"></p>
          </div>

          <div class="col-md-3">
            <label class="fw-semibold">Class</label>
            <p id="v_academic_class" class="form-control bg-light"></p>
          </div>

          <div class="col-md-3">
            <label class="fw-semibold">Result Date</label>
            <p id="v_academic_result_date" class="form-control bg-light"></p>
          </div>

          <div class="col-md-3">
            <label class="fw-semibold">Medium</label>
            <p id="v_academic_medium" class="form-control bg-light"></p>
          </div>

          <div class="col-md-3">
            <label class="fw-semibold">Main Subject 1</label>
            <p id="v_academic_main_subject_1" class="form-control bg-light"></p>
          </div>

          <div class="col-md-3">
            <label class="fw-semibold">Main Subject 2</label>
            <p id="v_academic_main_subject_2" class="form-control bg-light"></p>
          </div>

          <div class="col-md-3">
            <label class="fw-semibold">Main Subject 3</label>
            <p id="v_academic_main_subject_3" class="form-control bg-light"></p>
          </div>

          <div class="col-md-4">
            <label class="fw-semibold">Certificate File</label>
            <p id="v_academic_certificate_file" class="form-control bg-light"></p>
          </div>

        </div>
      </div>

      <div class="modal-footer bg-light">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!-- View Details Modal -->
<div class="modal fade" id="viewQualModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Qualification Details</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div id="qualDetails" class="row g-3">
          <!-- Details injected dynamically -->
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Add Academic Qualification Modal -->
<div class="modal fade" id="addQualModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Add Academic Qualification</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form id="addQualForm" class="needs-validation" novalidate enctype="multipart/form-data">
        <input type="hidden" name="academicId" />
        <div id="academicError"></div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-3">
              <label class="form-label">Qualification Type</label>
              <select name="academic_level_id" id="academic_level_id" class="form-select" required>
                <option value="">Select Level</option>
                <!-- populate server-side or via AJAX -->
              </select>
              <div class="invalid-feedback">Please select qualification level.</div>
            </div>
            <div class="col-md-3">
              <label class="form-label">Certification / Degree </label>
              <select name="academic_degree_id" id="academic_degree_id" class="form-select" required>
                <option value="">Select Degree/Trade</option>
                <!-- populate server-side or via AJAX -->
              </select>
              <div class="invalid-feedback">Please select degree/trade.</div>
            </div>

            

            <div class="col-md-3">
              <label class="form-label">Is Degree from Maharashtra?</label>
              <div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="academic_degree_from_maharashtra" id="academic_degree_from_maharashtra_yes" value="1">
                  <label style="display:flex" class="form-check-label" for="academic_degree_from_maharashtra_yes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="academic_degree_from_maharashtra" id="academic_degree_from_maharashtra_no" value="0">
                  <label style="display:flex" class="form-check-label" for="academic_degree_from_maharashtra_no">No</label>
                </div>
              </div>
            </div>


            

            <div class="col-md-3">
              <label class="form-label">State</label>
              <select name="academic_state_id" id="academic_state_id" class="form-select" required>
                <option value="">Select State</option>
                <!-- populate server-side or via AJAX -->
              </select>
              <div class="invalid-feedback">Please select state.</div>
            </div>

            <div class="col-md-4">
              <label class="form-label">Board / University</label>
              <select name="academic_board_university_id" id="academic_board_university_id" class="form-select" required>
                <option value="">Select Board/University</option>
                <!-- populate server-side or via AJAX -->
              </select>
              <div class="invalid-feedback">Please select board/university.</div>
            </div>

            <!--<div class="col-md-2">
              <label class="form-label">Month of Start</label>
              <input type="text" name="academic_month_start" class="form-control" placeholder="e.g., Aug" required>
            </div>
            <div class="col-md-2">
              <label class="form-label">Year of Start</label>
              <input type="text" name="academic_year_start" class="form-control" placeholder="e.g., 2010" required pattern="\d{4}">
            </div>
            <div class="col-md-2">
              <label class="form-label">Month of Passing</label>
              <input type="text" name="academic_month_passing" class="form-control" placeholder="e.g., May" required>
            </div>
            <div class="col-md-2">
              <label class="form-label">Year of Passing</label>
              <input type="text" name="academic_year_passing" class="form-control" placeholder="e.g., 2014" required pattern="\d{4}">
            </div>-->

            <div class="col-md-3">
              <label class="form-label">Marks Obtained</label>
              <input type="number" name="academic_marks_obtained" id="academic_marks_obtained" class="form-control" placeholder="" required>
            </div>

            <div class="col-md-3">
              <label class="form-label">Marks Out Of</label>
              <input type="number" name="academic_marks_out_of" id="academic_marks_out_of" class="form-control"  required>
            </div>

            <div class="col-md-2">
              <label class="form-label">Percentage</label>
              <input type="text" name="academic_percentage" id="academic_percentage" class="form-control"  required dissabled readonly>
            </div>

            <div class="col-md-3">
              <label class="form-label">Grade</label>
              <select name="academic_grade" id="academic_grade" class="form-select" required>
                <option value="">Select Grade</option>
                <option value="1">A++</option>
                <option value="2">A+</option>
                <option value="3">A</option>
                <option value="4">B++</option>
                <option value="5">B+</option>
                <option value="6">B</option>
                <option value="7">C++</option>
                <option value="8">C+</option>
                <option value="9">C</option>
              </select>
            </div>

            <div class="col-md-3">
              <label class="form-label">Passing Class</label>
              <select name="academic_class" id="academic_class" class="form-select" required>
                <option value="">Select Grade</option>
                <option value="1">Distinction</option>
                <option value="2">First Division</option>
                <option value="3">Second Division</option>
                <option value="4">Third Division</option>
                <option value="5">Pass</option>
              </select>
            </div>
            <div class="col-md-3">
                <label for="academic_result_date" class="form-label fw-semibold">Result Date</label>
                <input type="text" name="academic_result_date" id="academic_result_date" class="form-control date-field" required>
            </div>

             <div class="col-md-3">
              <label class="form-label">Upload Certificate</label>
              <p id="edit_academic_certificate_file"></p>
              <input type="file" name="academic_certificate_file" id="academic_certificate_file" accept=".pdf,.jpg,.jpeg,.png" class="form-control">
              <div class="form-text">Allowed: pdf, jpg, png. Max size as per server config.</div>
            </div>
            
            <div class="col-md-3">
              <label class="form-label">Medium</label>
              <select name="academic_medium" id="academic_medium" class="form-select" required>
                <option value="">Select Medium</option>
                <option value="Marathi">Marathi</option>
                <option value="English">English</option>
                <option value="Hindi">Hindi</option>
                <option value="Other">Other</option>
              </select>
              <div class="invalid-feedback">Please select medium.</div>
            </div>
            <div class="col-md-3">
              <label class="form-label">Main Subject 1</label>
              <select name="academic_main_subject_1" id="academic_main_subject_1" class="form-select academic-subject-select" required>
                
              </select>
            </div>
            <div class="col-md-3">
              <label class="form-label">Main Subject 2</label>
              <select name="academic_main_subject_2" id="academic_main_subject_2" class="form-select academic-subject-select">
               
              </select>
            </div>
            <div class="col-md-3">
              <label class="form-label">Main Subject 3</label>
              <select name="academic_main_subject_3" id="academic_main_subject_3" class="form-select academic-subject-select">
                
              </select>
            </div>
            

           
            
            

            <!-- hidden staff id -->
            <input type="hidden" name="staff_id" id="staff_id" value="">
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" id="saveAcademicQualificationBtn" class="btn btn-success">Save Qualification</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Add Professional Qualification Modal -->
<div class="modal fade" id="addProfessionalQualModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Add Professional Qualification</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form id="addProfessionalQualForm" class="needs-validation" novalidate>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-3">
              <label class="form-label">Qualification Type</label>
              <select name="professional_level_id" id="professional_level_id" class="form-select" required>
                <option value="">Select Level</option>
                <!-- populate server-side or via AJAX -->
              </select>
              <div class="invalid-feedback">Please select qualification level.</div>
            </div>
            <div class="col-md-3">
              <label class="form-label">Certification / Degree </label>
              <select name="professional_degree_id" id="professional_degree_id" class="form-select" required>
                <option value="">Select Degree/Trade</option>
                <!-- populate server-side or via AJAX -->
              </select>
              <div class="invalid-feedback">Please select degree/trade.</div>
            </div>

            

            <div class="col-md-3">
              <label class="form-label">Is Degree from Maharashtra?</label>
              <div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="professional_degree_from_maharashtra" id="professional_degree_from_maharashtra_yes" value="1">
                  <label style="display:flex" class="form-check-label" for="professional_degree_from_maharashtra_yes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="professional_degree_from_maharashtra" id="professional_degree_from_maharashtra_no" value="0">
                  <label style="display:flex" class="form-check-label" for="professional_degree_from_maharashtra_no">No</label>
                </div>
              </div>
            </div>


            

            <div class="col-md-3">
              <label class="form-label">State</label>
              <select name="professional_state_id" id="professional_state_id" class="form-select" required>
                <option value="">Select State</option>
                <!-- populate server-side or via AJAX -->
              </select>
              <div class="invalid-feedback">Please select state.</div>
            </div>

            <div class="col-md-4">
              <label class="form-label">Board / University</label>
              <select name="professional_board_university_id" id="professional_board_university_id" class="form-select" required>
                <option value="">Select Board/University</option>
                <!-- populate server-side or via AJAX -->
              </select>
              <div class="invalid-feedback">Please select board/university.</div>
            </div>

            <!--<div class="col-md-2">
              <label class="form-label">Month of Start</label>
              <input type="text" name="professional_month_start" class="form-control" placeholder="e.g., Aug" required>
            </div>
            <div class="col-md-2">
              <label class="form-label">Year of Start</label>
              <input type="text" name="professional_year_start" class="form-control" placeholder="e.g., 2010" required pattern="\d{4}">
            </div>
            <div class="col-md-2">
              <label class="form-label">Month of Passing</label>
              <input type="text" name="professional_month_passing" class="form-control" placeholder="e.g., May" required>
            </div>
            <div class="col-md-2">
              <label class="form-label">Year of Passing</label>
              <input type="text" name="professional_year_passing" class="form-control" placeholder="e.g., 2014" required pattern="\d{4}">
            </div>-->

            <div class="col-md-3">
              <label class="form-label">Marks Obtained</label>
              <input type="number" name="professional_marks_obtained" id="professional_marks_obtained" class="form-control" placeholder="" required>
            </div>

            <div class="col-md-3">
              <label class="form-label">Marks Out Of</label>
              <input type="number" name="professional_marks_out_of" id="professional_marks_out_of" class="form-control" required>
            </div>

            <div class="col-md-2">
              <label class="form-label">Percentage</label>
              <input type="text" name="professional_percentage" id="professional_percentage" class="form-control" required dissabled readonly>
            </div>

            <div class="col-md-3">
              <label class="form-label">Grade</label>
              <select name="professional_grade" id="professional_grade" class="form-select" required>
                <option value="">Select Grade</option>
                <option value="1">A++</option>
                <option value="2">A+</option>
                <option value="3">A</option>
                <option value="4">B++</option>
                <option value="5">B+</option>
                <option value="6">B</option>
                <option value="7">C++</option>
                <option value="8">C+</option>
                <option value="9">C</option>
              </select>
            </div>

            <div class="col-md-3">
              <label class="form-label">Passing Class</label>
              <select name="professional_class" id="professional_class" class="form-select" required>
                <option value="">Select Grade</option>
                <option value="1">Distinction</option>
                <option value="2">First Division</option>
                <option value="3">Second Division</option>
                <option value="4">Third Division</option>
                <option value="5">Pass</option>
              </select>
            </div>
            <div class="col-md-3">
                <label for="professional_result_date" class="form-label fw-semibold">Result Date</label>
                <input type="text" name="professional_result_date" id="professional_result_date" class="form-control date-field" required>
            </div>

             
            
            <div class="col-md-3">
              <label class="form-label">Medium</label>
              <select name="professional_medium" id="professional_medium" class="form-select" required>
                <option value="">Select Medium</option>
                <option value="Marathi">Marathi</option>
                <option value="English">English</option>
                <option value="Hindi">Hindi</option>
                <option value="Other">Other</option>
              </select>
              <div class="invalid-feedback">Please select medium.</div>
            </div>
            <div class="col-md-6">
              <label class="form-label">Upload Certificate</label>
              <input type="file" name="professional_certificate_file" accept=".pdf,.jpg,.jpeg,.png" class="form-control">
              <div class="form-text">Allowed: pdf, jpg, png. Max size as per server config.</div>
            </div>
            <!--<div class="col-md-3">
              <label class="form-label">Main Subject 1</label>
              <select name="professional_main_subject_1" id="professional_main_subject_1" class="form-select professional-subject-select" required>
                
              </select>
            </div>
            <div class="col-md-3">
              <label class="form-label">Main Subject 2</label>
              <select name="professional_main_subject_2" id="professional_main_subject_2" class="form-select professional-subject-select">
               
              </select>
            </div>
            <div class="col-md-3">
              <label class="form-label">Main Subject 3</label>
              <select name="professional_main_subject_3" id="professional_main_subject_3" class="form-select professional-subject-select">
                
              </select>
            </div>-->
            

           
            
            
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" id="saveProfessionalQualificationBtn" class="btn btn-success">Save Qualification</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- TET Modal Overlay -->
<div id="resultModal" class="modal-overlay">
  <div class="modal-box">
    <span class="close-btn" onclick="closeModal()">×</span>

    <h3>TET Result Details</h3>
   
    <table class="result-table">
        <tbody id="modalResultBody"></tbody>
    </table>
        <hr/>
    <h5>Exam Information Verification</h5>
    
    <p>Kindly confirm whether the exam information is correct and belongs to this staff member.<p>
    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="closeModal()">No, It Is Not Correct</button>
    <button type="button" id="saveTetExamData" class="btn btn-success">Yes, It Is Correct</button>
           
  </div>
</div>



  
<!-- Add Work History Modal -->
<div class="modal fade" id="workModal" tabindex="-1" aria-labelledby="workModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="workModalLabel">Add Service Details</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="workForm">

          <div class="form-section">
            <h6 class="fw-semibold text-primary mb-2">Search School by UDISE Code</h6>
            <div class="row g-2">
              <div class="col-md-6">
                <label class="form-label">UDISE Code</label>
                <input type="text" class="form-control" id="work_search_udise" name="work_search_udise" placeholder="Enter UDISE Code">
              </div>
              <div class="col-md-6 d-flex align-items-end">
                <button type="button" class="btn btn-primary w-100" id="work_search_udise_btn" id="work_search_udise_btn">Search &rarr;</button>
              </div>
            </div>
          </div>

          <!--<div class="form-section">
            <h6 class="fw-semibold text-primary mb-2">Section 2: Select School by Location</h6>
            <div class="row g-2">
              <div class="col-md-3">
                <label class="form-label">District</label>
                <select class="form-select">
                    <?phph($districtOptions); ?>
                </select>
              </div>
              <div class="col-md-3">
                <label class="form-label">Block</label>
                <select class="form-select">
                  <option>Select Block</option>
                </select>
              </div>
              <div class="col-md-3">
                <label class="form-label">Cluster</label>
                <select class="form-select">
                  <option>Select Cluster</option>
                </select>
              </div>
              <div class="col-md-3">
                <label class="form-label">School</label>
                <select class="form-select">
                  <option>Select School</option>
                </select>
              </div>
            </div>
          </div>-->
          <div class="add_work_form">
            <div class="row g-3 mt-3" >


                <div class="col-md-3">
                <label class="form-label">School Udise</label>
                <input type="text" class="form-control" id="work_udise" name="work_udise" readonly>              
                </div>
                <div class="col-md-3">
                <label class="form-label">School Name</label>
                <input type="text" class="form-control" id="work_school" name="work_school" readonly>              
                </div>

                <div class="col-md-3">
                <label class="form-label">School Aid Type</label>
                <select class="form-select" id="work_school_aid_type" name="work_school_aid_type">
                   
                </select>
                </div>



                <div class="col-md-3">
                <label class="form-label">School Category</label>
                <select class="form-select" id="work_school_category" name="work_school_category">
                  
                </select>
                </div>

                
            
                                            

                <div class="col-md-4">
                <label class="form-label">Post / Designation</label>
                <select class="form-select" id="work_school_post" name="work_school_post">
                    
                </select>
                </div>
                <div class="col-md-4">
                <label class="form-label">From Date</label>
                <input type="text" class="form-control date-field" id="work_school_from_date" name="work_school_from_date">
                </div>
                <div class="col-md-4">
                <label class="form-label">End Date</label>
                <input type="text" class="form-control date-field" id="work_school_to_date" name="work_school_to_date">
                
                </div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-4">
                <label class="form-label">Work in PESA Area (ST Staff)</label>
                <select class="form-select" id="work_school_is_pesa" name="work_school_is_pesa">
                    <option value="">Select</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
                </div>
                <div class="col-md-4">
                <label class="form-label">Work in Difficult Area</label>
                <select class="form-select" id="work_school_is_difficult_area" name="work_school_is_difficult_area">
                    <option value="">Select</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
                </div>
                <div class="col-md-4">
                <label class="form-label">School Change Mode</label>
                <select class="form-select" id="work_school_change_reason" name="work_school_change_reason">
                   <?php echo $servicePostModeOptions;?>
                </select>
                </div>
            </div>
          </div>

        </form>
      </div>
      <div class="modal-footer add_work_form">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" id="saveWorkBtn" class="btn btn-primary fw-semibold">Save</button>

      </div>
    </div>
  </div>
</div>
<!-- ============ VIEW Work Details MODAL ============ -->
<div class="modal fade" id="viewWorkModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content shadow">

      <div class="modal-header bg-info text-white">
        <h5 class="modal-title">Work Details</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="row g-3">

        

          <div class="col-md-6">
            <label class="fw-semibold">School UDISE</label>
            <p id="v_school_udise" class="form-control bg-light"></p>
          </div>
     
          <div class="col-md-6">
            <label class="fw-semibold">School Name</label>
            <p id="v_school_name" class="form-control bg-light"></p>
          </div>

          <div class="col-md-6">
            <label class="fw-semibold">School Aid Type</label>
            <p id="v_school_aid_type" class="form-control bg-light"></p>
          </div>

          <div class="col-md-6">
            <label class="fw-semibold">School Category</label>
            <p id="v_school_category" class="form-control bg-light"></p>
          </div>

          <div class="col-md-6">
            <label class="fw-semibold">Post / Designation</label>
            <p id="v_post" class="form-control bg-light"></p>
          </div>

          <div class="col-md-6">
            <label class="fw-semibold">Start Date</label>
            <p id="v_start_date" class="form-control bg-light"></p>
          </div>
          <div class="col-md-6">
            <label class="fw-semibold">End Date</label>
            <p id="v_end_date" class="form-control bg-light"></p>
          </div>
          <div class="col-md-6">
            <label class="fw-semibold">Work in PESA Area (ST Staff)</label>
            <p id="v_work_in_pesa" class="form-control bg-light"></p>
          </div>
          
          <div class="col-md-6">
            <label class="fw-semibold">Work in Difficult Area</label>
            <p id="v_work_in_diff_area" class="form-control bg-light"></p>
          </div>
          <div class="col-md-6">
            <label class="fw-semibold">School Change Mode</label>
            <select id="v_school_change_mode" class="form-control bg-light"><?php echo $currentPostModeOptions; ?> </select>
           
          </div>
          

        </div>
      </div>

      <div class="modal-footer bg-light">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!-- Add Training Modal -->
<div class="modal fade" id="trainingModal" tabindex="-1" aria-labelledby="trainingModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content shadow-lg">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title fw-semibold" id="trainingModalLabel">Add Training Details</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form id="trainingForm" class="needs-validation" novalidate>
        <div class="modal-body">
          <div class="row g-3">

            <div class="col-md-6">
              <label class="form-label fw-semibold">Training Type</label>
              <select class="form-select" id="training_type" name="training_type"></select>             
            </div>

            <div class="col-md-6">
              <label class="form-label fw-semibold">Category</label>
              <select class="form-select" id="training_category" name="training_category"></select>             
            </div>

            <div class="col-md-6">
              <label class="form-label fw-semibold">Institute</label>
              <select class="form-select" id="training_institute" name="training_institute"></select>              
            </div>

            <div class="col-md-6">
              <label class="form-label fw-semibold">Level</label>
              <select class="form-select" id="training_level" name="training_level"></select>             
            </div>

            <div class="col-md-6">
              <label class="form-label fw-semibold">From Date</label>
              <input type="text" name="training_from_date" id="training_from_date" class="form-control date-field" required>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-semibold">To Date</label>
              <input type="text" name="training_to_date" id="training_to_date" class="form-control date-field" required>
            </div>

            <div class="col-md-12">
              <label class="form-label fw-semibold">Title</label>
              <input type="text" name="training_title" id="training_title" class="form-control" placeholder="Enter training title" required>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-semibold">Whether Attended?</label>
              <div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="training_attended" id="training_attended_yes" value="1">
                  <label class="form-check-label">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="training_attended" id="training_attended_no" value="0">
                  <label class="form-check-label">No</label>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-semibold">Certificate Awarded?</label>
              <div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="training_certificate_awarded" id="training_certificate_awarded_yes" value="1">
                  <label class="form-check-label">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="training_certificate_awarded" id="training_certificate_awarded_no" value="0">
                  <label class="form-check-label">No</label>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" id="saveTrainingBtn" class="btn btn-primary fw-semibold">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- ============ VIEW Training Details MODAL ============ -->
<div class="modal fade" id="viewTrainingModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content shadow">

      <div class="modal-header bg-info text-white">
        <h5 class="modal-title">Training Details</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="row g-3">
          <div class="col-md-6">
            <label class="fw-semibold">Training Type</label>
            <p id="v_training_type" class="form-control bg-light"></p>
          </div>

          <div class="col-md-6">
            <label class="fw-semibold">Training Category</label>
            <p id="v_training_category" class="form-control bg-light"></p>
          </div>
     
          <div class="col-md-6">
            <label class="fw-semibold">Training Institute</label>
            <p id="v_training_institute" class="form-control bg-light"></p>
          </div>

          <div class="col-md-6">
            <label class="fw-semibold">Training Level</label>
            <p id="v_training_level" class="form-control bg-light"></p>
          </div>

          <div class="col-md-6">
            <label class="fw-semibold">From Date</label>
            <p id="v_training_from_date" class="form-control bg-light"></p>
          </div>

          <div class="col-md-6">
            <label class="fw-semibold">To Date</label>
            <p id="v_training_to_date" class="form-control bg-light"></p>
          </div>
          <div class="col-md-12">
            <label class="fw-semibold">Title</label>
            <p id="v_training_title" class="form-control bg-light"></p>
          </div>

          <div class="col-md-6">
            <label class="fw-semibold">Whether Attended?</label>
            <p id="v_training_attended" class="form-control bg-light"></p>
          </div>

          <div class="col-md-6">
            <label class="fw-semibold">Certificate Awarded?</label>
            <p id="v_training_certificate_awarded" class="form-control bg-light"></p>
          </div>
        </div>
      </div>

      <div class="modal-footer bg-light">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!-- Add Rewards Modal -->
<div class="modal fade" id="rewardModal" tabindex="-1" aria-labelledby="rewardModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-semibold" id="rewardModalLabel">Add Reward Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="rewardForm" class="needs-validation" novalidate>
                <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-3">
                    <label class="form-label">Year</label>
                    <select name="reward_year" id="reward_year" class="form-select" required>
                        <option value="">Select Year</option>

                        <?php
                            $currentYear = date("Y");
                            for ($year = $currentYear; $year >= 1980; $year--) {
                                echo "<option value='$year'>$year</option>";
                            }
                        ?>
                    </select>
                    <div class="invalid-feedback">Please select year.</div>
                    </div>
                    <div class="col-md-9">
                    <label class="form-label">Reward Details</label>
                    <textarea name="reward" id="reward" class="form-control" rows="2"></textarea>
                    </div>
                </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="saveRewardBtn" class="btn btn-primary fw-semibold">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ============ VIEW Rewards Details MODAL ============ -->
<div class="modal fade" id="viewRewardModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content shadow">

      <div class="modal-header bg-info text-white">
        <h5 class="modal-title">Reward Details</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="row g-3">
          <div class="col-md-6">
            <label class="fw-semibold">Reward Year</label>
            <p id="v_reward_year" class="form-control bg-light"></p>
          </div>

          <div class="col-md-6">
            <label class="fw-semibold">Reward</label>
            <p id="v_reward" class="form-control bg-light"></p>
          </div>
     
        
        </div>
      </div>

      <div class="modal-footer bg-light">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!-- Add Disciplinary Action Modal -->
<div class="modal fade" id="addDisciplinaryActionModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Add Disciplinary Action</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form id="addDisciplinaryActionForm" class="needs-validation" novalidate>
        <div class="modal-body">
          <div class="row g-3">

            <div class="col-md-12">
              <label class="form-label">Detail of Disciplinary Action</label>
              <textarea name="disc_action" id="disc_action" class="form-control" rows="6"></textarea>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" id="saveDisciplinaryActionBtn" class="btn btn-success">Save Disciplinary Action</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- OTP Modal -->
<div class="modal fade" id="otpModal" tabindex="-1" aria-labelledby="otpModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="otpModalLabel">OTP Verification</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center">
        <p>Please enter the 6-digit OTP sent to your registered mobile number.</p>
        <input type="text" id="otpInput" maxlength="6" class="form-control text-center fs-4" placeholder="Enter OTP" style="letter-spacing: 5px;">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" id="verifyOtpBtn" class="btn btn-success">Verify & Forward</button>
      </div>
    </div>
  </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 text-center">
      <div class="modal-body py-5">
        <h4 class="text-success fw-bold mb-3">✅ Successfully Forwarded!</h4>
        <p>The staff information has been successfully forwarded to the next level.</p>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>


<!-- Error Modal (hidden by default) --> 
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="otpModalLabel">Field Verification</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-left">
        <div class="alert alert-danger"><strong>Invalid entry: <span id="validation_message"></span></strong></div>
        
        <div class="alert alert-warning p-3 rounded-3">
            <h5 class="mb-2 fw-bold">Important Update Required</h5>
            <p class="mb-2">Please ensure the field is updated in the correct system before proceeding:</p>

            <ul class="mb-3 text-left">
                <li><strong>If the field belongs to UDISE:</strong> Update it in the <strong>UDISE portal</strong>, then sync to the Staff Portal.</li>

                <li><strong>If the field belongs to Shalarth:</strong> Update it in the <strong>Shalarth portal</strong>, then sync to the Staff Portal.</li>

                <li><strong>If the field does NOT belong to UDISE or Shalarth:</strong> Update it directly in this form and continue.</li>
            </ul>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>


<!-- Confirm Modal (hidden by default) --> 
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="confirmModalLabel">Confirm Updation</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-left">
        <div class="alert alert-warning" id="confirm_message"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">No</button>
        <button type="button" class="btn btn-success" onclick="proceedFurther();" data-bs-dismiss="modal">Yes</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<style>
    .form-label {
        font-weight: bold;
         /* adjust as needed */
    }
    label {
       color:black;
        font-size: 1rem;
    }

    .custom-box input {
    color: #787474;
    
    }

    .breadcrumb-item.active {
        color: #fff !important;  /* make active breadcrumb white */
            /* optional: make it bold */
    }
    .required-field {
        position: relative;
    }

    .required-field::after {
        content: "*";
        color: red;
        position: absolute;
        top: 6px;          /* adjust if needed */
        right: 8px;        /* keep inside border */
        font-size: 24px;
        font-weight: bold;
    }
    
    .work-history-card {
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      background: #fff;
      padding: 10px;
    }
    .header-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 2px solid #eee;
      padding-bottom: 10px;
    }

    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.6);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        }

        .modal-box {
        background: #fff;
        width: 800px;
        max-width: 95%;
        padding: 20px;
        border-radius: 8px;
        position: relative;
        }

        .close-btn {
        position: absolute;
        right: 12px;
        top: 8px;
        font-size: 22px;
        cursor: pointer;
        }

        .result-table {
        width: 100%;
        border-collapse: collapse;
        }

        .result-table td {
        padding: 5px;
        border-bottom: 1px solid #ddd;
        }

       

</style>
<script>
    flatpickr(".date-field", {
        dateFormat: "d/m/Y",   // dd/mm/yyyy format
        allowInput: true,
        altInput: true,
        altFormat: "d/m/Y",
        disableMobile: false,  // uses native picker on mobile
        maxDate: "31-12-3100", // optional future limit
    });
</script>
<script>
    // ????? ???????? ?????? ??????????? ??? ????
    const baseUrl = '<?php echo $this->Url->build('/'); ?>';
    const staffId = <?= h($staff->id ?? 0) ?>; // PHP ????????? staffId
    const schoolId = <?= h($staff->school_id ?? 0) ?>;

    // ... (????? ??? ????? ??? ????? ???????? ??? ?????) ...

   

    // ????? ??? ???????? (???. loadRewards, showAcademicQualificationDetails, ???????) ??? ???? ??????.
</script>
<script>
    // === Modal Helper ===
    const ProcessingModal = (() => {
        const modal = document.getElementById('processingModal');
        return {
            show: (text = 'Processing... Please wait') => {
                if (!modal) return;
                const message = modal.querySelector('.processing-text');
                if (message) message.textContent = text;
                modal.classList.add('visible');
                modal.setAttribute('aria-hidden', 'false');
            },
            hide: () => {
                if (!modal) return;
                modal.classList.remove('visible');
                modal.setAttribute('aria-hidden', 'true');
            }
        };
    })();

    // === jQuery integration ===
    if (window.jQuery) {
        (function ($) {
            // AJAX ??? ???? ???????? Modal ?????
            $(document).ajaxStart(() => ProcessingModal.show());
            // AJAX ??? ????? ???????? Modal ????
            $(document).ajaxStop(() => ProcessingModal.hide());
            $(document).ajaxError(() => ProcessingModal.hide());
        })(jQuery);
    }

    

    $(document).ready(function() {
    

        const baseUrl = "<?= $this->Url->build('/', ['fullBase' => true]); ?>";
        const staffId = <?= h($staff->id ?? 0) ?>;
        window.initPersonalDetails = $("#content-section-form-0").serialize();
        window.initAddressDetails = $("#content-section-form-1").serialize();
        window.initOtherDetails = $("#content-section-form-2").serialize();
        // File Uploading start
            // Handle radio button change (same as before)
            $('input[type="radio"]').on('change', function() {
                const fieldName = $(this).attr('name');
                const isYes = $(this).val() === '1';
                
                $(`.${fieldName}-upload-container`).toggle(isYes);
                
                if (!isYes) {
                    $(`#${fieldName}_file`).val('');
                    $(`#${fieldName}_preview`).html('');
                    $(`#${fieldName}_file_path`).val('');
                }
            });

            // Handle file upload
            $('.file-input').on('change', function() {
                const fieldName = $(this).data('field');
                const fileInput = $(this)[0];
                const file = fileInput.files[0];
                const previewContainer = $(`#${fieldName}_preview`);
                const filePathInput = $(`#${fieldName}_file_path`);
                
                
                if (!file) return;
                
                // Validate file size (max 5MB)
                if (file.size > 5 * 1024 * 1024) {
                    alert('File size must be less than 5MB');
                    $(this).val('');
                    return;
                }
                
                // Create FormData
                const formData = new FormData();
                formData.append('file', file);
                formData.append('field_name', fieldName);
                formData.append('staff_id', staffId);
                
                // Show loading
                previewContainer.html('<div class="text-muted">Uploading...</div>');
                
                // CakePHP AJAX upload
                $.ajax({
                    url: '<?= $this->Url->build(['controller' => 'Staffs', 'action' => 'uploadDocument']) ?>',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            // Update hidden input with file path
                            filePathInput.val(response.file_path);
                            
                            // Show preview
                            let previewHtml = '';
                            if (file.type.startsWith('image/')) {
                                previewHtml = `
                                    <div class="preview-item">
                                        <img src="${URL.createObjectURL(file)}" alt="Preview">
                                        <a href="${response.file_path}" target="_blank">View Full Image</a>
                                        <button type="button" class="btn btn-sm btn-danger ms-2 remove-file" data-field="${fieldName}">×</button>
                                    </div>
                                `;
                            } else {
                                previewHtml = `
                                    <div class="preview-item">
                                        <a href="/${response.file_path}" target="_blank">${response.original_name || file.name}</a>
                                        <button type="button" class="btn btn-sm btn-danger ms-2 remove-file" data-field="${fieldName}">×</button>
                                    </div>
                                `;
                            }
                            previewContainer.html(previewHtml);
                        } else {
                            alert('Upload failed: ' + response.message);
                            $(`#${fieldName}_file`).val('');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Upload error: ' + error);
                        $(`#${fieldName}_file`).val('');
                        previewContainer.html('');
                    }
                });
            });

            // Handle file removal
            $(document).on('click', '.remove-file', function() {
                const fieldName = $(this).data('field');
                const filePath = $(`#${fieldName}_file_path`).val();
                
                
                if (confirm('Are you sure you want to remove this file?')) {
                    // Send request to delete file
                    $.ajax({
                        url: '<?= $this->Url->build(['controller' => 'Staffs', 'action' => 'deleteDocument']) ?>',
                        type: 'POST',
                        data: {
                            file_path: filePath,
                            field_name: fieldName,
                            staff_id: staffId
                        },
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                        },
                        success: function(response) {
                            if (response.success) {
                                // Clear inputs and preview
                                $(`#${fieldName}_file`).val('');
                                $(`#${fieldName}_file_path`).val('');
                                $(`#${fieldName}_preview`).html('');
                            } else {
                                alert('Error: ' + response.message);
                            }
                        },
                        error: function() {
                            alert('Error removing file');
                        }
                    });
                }
            });
        // File Uploading end

        // Common upload function for any stage start
        function uploadStageFile(stageName, fileInputId) {
            let formData = new FormData();
            formData.append("staff_id", staffId);
            formData.append("stage", stageName);
            formData.append("file", $("#" + fileInputId)[0].files[0]);

            $.ajax({
                url: baseUrl + "/staff-files/upload",        // CakePHP 5.2 route
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $('#responseMessage').html('<span class="text-info"><div class="text-info d-flex align-items-center"><div class="spinner-border spinner-border-sm me-2" role="status"></div><span>Processing...</span></div></span>');

                    console.log("Uploading...");
                },
                success: function (response) {
                    alert("Uploaded successfully!");
                    console.log(response);
                },
                error: function (xhr) {
                    alert("Upload failed!");
                    console.log(xhr.responseText);
                }
            });
        }
        // Common upload function for any stage end



       

        function toggleNomination() {
            if ($("input[name='covered_under_family']:checked").val() === "true") {
                $("#nomination-section").show();
                $("#nominaton_percentage").val('');
                $("#date_of_nominaton").val('');
                
            } else {
                $("#nomination-section").hide();
                $("#nominaton_percentage").val('');
                $("#date_of_nominaton").val('');
            }
        }

        toggleNomination(); // run on page load

        $("input[name='covered_under_family']").on("change", function () {
            toggleNomination();
        });

        //appointment_for_subject_1
        function updateAppointmentSubjectOptions() {
            // Collect all selected values
            var selected = $(".appointment-for-subject-select").map(function () {
                return $(this).val();
            }).get();

            // For each dropdown
            $(".appointment-for-subject-select").each(function () {
                var currentSelect = $(this);
                var currentValue = currentSelect.val();

                // Enable all options first
                currentSelect.find("option").prop("disabled", false);

                // Disable selected options in other dropdowns
                $(".appointment-for-subject-select").not(currentSelect).each(function () {
                    var val = $(this).val();
                    if (val) {
                        currentSelect.find("option[value='" + val + "']").prop("disabled", true);
                    }
                });

                // Keep the current value enabled
                currentSelect.find("option[value='" + currentValue + "']").prop("disabled", false);
            });
        }

        function updateLanguageOptions() {
            // Collect all selected values
            var selected = $(".lang-select").map(function () {
                return $(this).val();
            }).get();

            // For each dropdown
            $(".lang-select").each(function () {
                var currentSelect = $(this);
                var currentValue = currentSelect.val();

                // Enable all options first
                currentSelect.find("option").prop("disabled", false);

                // Disable selected options in other dropdowns
                $(".lang-select").not(currentSelect).each(function () {
                    var val = $(this).val();
                    if (val) {
                        currentSelect.find("option[value='" + val + "']").prop("disabled", true);
                    }
                });

                // Keep the current value enabled
                currentSelect.find("option[value='" + currentValue + "']").prop("disabled", false);
            });
        }

        // Run on change of any language select
        // $("#language_1, #language_2, #language_3").on("change", updateLanguageOptions); // Re-enabled based on new section logic

        // Run on page load
        // updateLanguageOptions(); // Re-enabled based on new section logic

        updateAppointmentSubjectOptions();
        // === Address integration Starts ===

            // 🧭 Fetch and populate districts details (FIXED: Family logic removed)
            function getDistrictsByState(stateId) {
                if (!stateId) return; // Prevent AJAX call if no state is selected
                
                // Define all district fields to update
                const districtFields = ['permanent_district_id', 'current_district_id']; 

                $.ajax({
                    url: baseUrl + "staff-addresses/districts-by-state/" + stateId,
                    method: "GET",
                    dataType: "json",
                    success: function (response) {
                        let data = response.data;

                        districtFields.forEach(id => {
                            const districtSelect = $('#' + id);
                            if (districtSelect.length) {
                                // Only update the dropdown if it's not disabled (for current address copy logic)
                                if (!districtSelect.prop('disabled')) {
                                    districtSelect.empty().append('<option value="">Select District</option>');

                                    if (data && data.length > 0) {
                                        data.forEach(opt => {
                                            districtSelect.append(`<option value="${opt.id}">${opt.name_en}</option>`);
                                        });
                                    }
                                }
                            }
                        });
                    },
                    error: function () {
                        console.error('Error loading districts');
                    }
                });
            }
            // 🧭 Fetch and display blocks details
            function getBlocksByDistrict(dstrictId, addType) {
                if (!dstrictId) return;
                
                $.ajax({
                    url: baseUrl + "staff-addresses/blocks-by-district/" + dstrictId,
                    method: "GET",
                    dataType: "json",
                    success: function (response) {
                        console.log(response.data);
                        let data = response.data;
                        let blockBox, villageBox;
                        
                        if (addType == 2) {
                            blockBox = "current_block_id";
                            villageBox = "current_village_id";
                        } else {
                            blockBox = "permanent_block_id";
                            villageBox = "permanent_village_id";
                        }

                        const blockSelect = $('#' + blockBox);
                        const villageSelect = $('#' + villageBox);
                        
                        if (blockSelect.length && !blockSelect.prop('disabled')) {
                            blockSelect.empty().append('<option value="">Select Block/Taluka</option>');
                            if (data && data.length > 0) {
                                // Populate options dynamically
                                data.forEach(opt => {
                                    //console.log("==========="+opt)
                                    blockSelect.append(`<option value="${opt.id}">${opt.name_en}</option>`);
                                });
                            }
                        }
                        if (villageSelect.length) {
                            // Clear village dropdown when block list updates
                            villageSelect.empty().append('<option value="">Select Village / Town</option>');
                        }


                    },
                    error: function () {
                        console.error('Error loading blocks');
                    }
                });
            }

            function getAddressBlocksByDistrict(dstrictId1, dstrictId2, blockId1, blockId2) {
                if ((!dstrictId1) &&  (!dstrictId2)) return;
                
                $.ajax({
                    url: baseUrl + "staff-addresses/both-blocks-by-district/" + dstrictId1 +'/'+ dstrictId2,
                    method: "GET",
                    dataType: "json",
                    success: function (response) {
                        console.log(response.data);
                        let data1 = response.data1;
                        let blockBox1, villageBox1;
                        let data2 = response.data2;
                        let blockBox2, villageBox2;

                        const block1Select = $('#permanent_block_id');
                        const village1Select = $('#permanent_village_id');
                        const block2Select = $('#current_block_id');
                        const village2Select = $('#current_village_id');
                        
                        if (block1Select.length && !block1Select.prop('disabled')) {
                            block1Select.empty().append('<option value="">Select Block/Taluka</option>');
                            if (data1 && data1.length > 0) {
                                // Populate options dynamically
                                data1.forEach(opt => {
                                    //console.log("==========="+opt)
                                    block1Select.append(`<option value="${opt.id}">${opt.name_en}</option>`);
                                });
                                $("#permanent_block_id").val(blockId1);
                            
                            
                            }
                        }
                    

                        if (block2Select.length && !block2Select.prop('disabled')) {
                            block2Select.empty().append('<option value="">Select Block/Taluka</option>');
                            if (data2 && data2.length > 0) {
                                // Populate options dynamically
                                data2.forEach(opt => {
                                    //console.log("==========="+opt)
                                    block2Select.append(`<option value="${opt.id}">${opt.name_en}</option>`);
                                });
                                $("#current_block_id").val(blockId2);
                            }
                        }
                    


                    },
                    error: function () {
                        console.error('Error loading blocks');
                    }
                });
            }
            function getVillagesByBlock(blockId, addType) {
                if (!blockId) return;
                
                $.ajax({
                    url: baseUrl + "staff-addresses/villages-by-block/" + blockId,
                    method: "GET",
                    dataType: "json",
                    success: function (response) {
                        console.log(response.data);
                        let data = response.data;
                        let villageBox;
                        
                        if (addType == 2) {
                            villageBox = "current_village_id";
                        } else {
                            villageBox = "permanent_village_id";
                        }
                        
                        const villageSelect = $('#' + villageBox);
                        
                        if (villageSelect.length && !villageSelect.prop('disabled')) {
                            villageSelect.empty().append('<option value="">Select Village</option>');
                            if (data && data.length > 0) {
                                // Populate options dynamically
                                data.forEach(opt => {
                                    //console.log("==========="+opt)
                                    villageSelect.append(`<option value="${opt.id}">${opt.name_en}</option>`);
                                });
                            }
                        }

                    },
                    error: function () {
                        console.error('Error loading villages');
                    }
                });
            }

            function getAddressVillagesByBlock(blockId1, blockId2,villageId1,villageId2){
                if ((!blockId1) &&  (!blockId2)) return;
                
                $.ajax({
                    url: baseUrl + "staff-addresses/both-villages-by-block/" + blockId1 +"/"+ blockId2,
                    method: "GET",
                    dataType: "json",
                    success: function (response) {
                        let data1 = response.data1;
                        let data2 = response.data2;                   
                        
                        const village1Select = $('#permanent_village_id');
                        const village2Select = $('#current_village_id');
                        
                        if (village1Select.length && !village1Select.prop('disabled')) {
                            village1Select.empty().append('<option value="">Select Village</option>');
                            if (data1 && data1.length > 0) {
                                // Populate options dynamically
                                data1.forEach(opt => {
                                    //console.log("==========="+opt)
                                    village1Select.append(`<option value="${opt.id}">${opt.name_en}</option>`);
                                });
                            
                                $("#permanent_village_id").val(villageId1);
                            }
                        }
                        if (village2Select.length && !village2Select.prop('disabled')) {
                            village2Select.empty().append('<option value="">Select Village</option>');
                            if (data2 && data2.length > 0) {
                                // Populate options dynamically
                                data2.forEach(opt => {
                                    //console.log("==========="+opt)
                                    village2Select.append(`<option value="${opt.id}">${opt.name_en}</option>`);
                                });
                            
                                $("#current_village_id").val(villageId2);
                            }
                        }                   


                    },
                    error: function () {
                        console.error('Error loading villages');
                    }
                });
            }

        
            
            // DD/MM/YYYY ????? ???????? ????? ?????????? ?????? ??????
            const parseDate = (dateString) => {
                if (!dateString || dateString.length !== 10) return null;
                const parts = dateString.split('/');
                // Date(year, monthIndex (0-11), day)
                const dateObj = new Date(parts[2], parts[1] - 1, parts[0]);
                // ???? ????? ?????? (???. Feb 30)
                if (dateObj.getFullYear() != parts[2] || dateObj.getMonth() != parts[1] - 1 || dateObj.getDate() != parts[0]) {
                    return null;
                }
                return dateObj;
            };

            // ?? (Age) ??????????? ?????? ??????
            const calculateAge = (dobString) => {
                const dateOfBirth = parseDate(dobString);
                if (!dateOfBirth) return null;
                const today = new Date();
                let age = today.getFullYear() - dateOfBirth.getFullYear();
                const m = today.getMonth() - dateOfBirth.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < dateOfBirth.getDate())) {
                    age--;
                }
                return age;
            };
            
            // **????** ???? ?????????? ?????? ??????
            const validateFile = (fieldId, name, required, allowedTypes, minKb, maxKb) => {
                const input = $(`#${fieldId}`)[0];
                const file = input ? input.files[0] : null;
                let fileIsValid = true;
                let fileMsg = '';

                const minBytes = minKb * 1024;
                const maxBytes = maxKb * 1024;
                const allowedExtensions = allowedTypes.map(t => t.split('/')[1].toUpperCase()).join('/');


                if (required && $('#' + fieldId).closest('.form-group').is(':visible') && !file) {
                    // ???? ???????? (visible) ??? ?????? (required) ??????? ?????
                    fileMsg = `${name} ?????? ???.`;
                    fileIsValid = false;
                } else if (file) {
                    // Type check
                    if (!allowedTypes.includes(file.type)) {
                        fileMsg = `${name} ???? ${allowedExtensions.replace(/JPEG/g, 'JPG')} ???????? ?????.`;
                        fileIsValid = false;
                    }
                    // Size check
                    else if (file.size < minBytes || file.size > maxBytes) {
                        const minMB = (minKb / 1000) < 1 ? `${minKb} KB` : `${minKb / 1000} MB`;
                        const maxMB = (maxKb / 1000) < 1 ? `${maxKb} KB` : `${maxKb / 1000} MB`;
                        fileMsg = `${name} ?? ???? ${minMB} ?? ${maxMB} ??????? ?????.`;
                        fileIsValid = false;
                    }
                    // File name check (excluding special characters: @ % ^ * ! ~ ` ' " \ | < > ? : )
                    else if (/[@%$^*!~`'"\\|<>?:;]/.test(file.name.slice(0, file.name.lastIndexOf('.')))) {
                        fileMsg = `${name} ???? ????? ????? ?????? (@ % ^ *) ??????.`;
                        fileIsValid = false;
                    }
                }
                
                // NOTE: showError function must be defined globally or in the current scope for this helper to work.
                if (!fileIsValid && fileMsg) {
                    showError(fieldId, fileMsg);
                }
                return fileIsValid;
            };


            // --- Event Handlers ---
            // Permanent Address Handlers
            $("#permanent_state_id").on("change", (e) => getDistrictsByState(e.target.value));
            $("#permanent_district_id").on("change", (e) => getBlocksByDistrict(e.target.value, 1));
            $("#permanent_block_id").on("change", (e) => getVillagesByBlock(e.target.value, 1));
            
            // Current Address Handlers (Only enabled if not same as permanent)
            $("#current_state_id").on("change", (e) => {
                if (!$("#copyPermanentAddress").is(":checked")) getDistrictsByState(e.target.value);
            });
            $("#current_district_id").on("change", (e) => {
                if (!$("#copyPermanentAddress").is(":checked")) getBlocksByDistrict(e.target.value, 2);
            });
            $("#current_block_id").on("change", (e) => {
                if (!$("#copyPermanentAddress").is(":checked")) getVillagesByBlock(e.target.value, 2);
            });


            // When checkbox "Same as Permanent Address" is clicked
            $("#copyPermanentAddress").on("change", function () {

                if ($(this).is(":checked")) {
                    // ----------- COPY TEXT INPUTS AND DISABLE FIELDS -----------
                    $("#current_address_line1").prop("readonly", true);
                    $("#current_address_line2").prop("readonly", true);
                    $("#current_pincode").prop("readonly", true);
                    $("#current_state_id").prop("disabled", true).addClass("readonly-select");
                    $("#current_district_id").prop("disabled", true).addClass("readonly-select");
                    $("#current_block_id").prop("disabled", true).addClass("readonly-select");
                    $("#current_village_id").prop("disabled", true).addClass("readonly-select");

                    $("#current_address_line1").val($("#permanent_address_line1").val());
                    $("#current_address_line2").val($("#permanent_address_line2").val());
                    $("#current_pincode").val($("#permanent_pincode").val());

                    // ----------- FIX: COPY SELECT OPTIONS + VALUE SYNCHRONOUSLY -----------

                    // State (already same)
                    $("#current_state_id")
                        .html($("#permanent_state_id").html())
                        .val($("#permanent_state_id").val());

                    // District - AJAX ??? ??????????? .trigger("change") ????? ?????.
                    $("#current_district_id")
                        .html($("#permanent_district_id").html())
                        .val($("#permanent_district_id").val());

                    // Block
                    $("#current_block_id")
                        .html($("#permanent_block_id").html())
                        .val($("#permanent_block_id").val());

                    // Village
                    $("#current_village_id")
                        .html($("#permanent_village_id").html())
                        .val($("#permanent_village_id").val());

                } else {

                    $("#current_address_line1").prop("readonly", false);
                    $("#current_address_line2").prop("readonly", false);
                    $("#current_pincode").prop("readonly", false);
                    $("#current_state_id").prop("disabled", false).removeClass("readonly-select");
                    $("#current_district_id").prop("disabled", false).removeClass("readonly-select");
                    $("#current_block_id").prop("disabled", false).removeClass("readonly-select");
                    $("#current_village_id").prop("disabled", false).removeClass("readonly-select");
                    
                }

            });
            // 🧭 Fetch and display address details
            function getAddressDetails() {
                $.ajax({
                    url: baseUrl + "staff-addresses/lists/" + staffId,
                    method: "GET",
                    dataType: "json",
                    success: function (response) {
                        let data = response.data;
                                            
                        if (currentIndex < sections.length - 1) {
                            currentIndex++;
                            updateUI();
                        }
                        if (data && data.length > 0) {

                            $("#permanent_address_line1").val(data[0].permanent_address_line1);
                            $("#permanent_address_line2").val(data[0].permanent_address_line2);
                            $("#permanent_pincode").val(data[0].permanent_pincode);
                            $("#current_address_line1").val(data[0].current_address_line1);
                            $("#current_address_line2").val(data[0].current_address_line2);
                            $("#current_pincode").val(data[0].current_pincode);
                            $("#copyPermanentAddress").prop('checked', data[0].is_current_same_as_permanent);
                            
                            // Set State IDs (assuming these are already populated by PHP/initial load)
                            $("#permanent_state_id").val(data[0].permanent_state_id);
                            $("#current_state_id").val(data[0].current_state_id);

                            // Trigger district load for permanent address
                            $("#permanent_district_id").val(data[0].permanent_district_id);
                            $("#current_district_id").val(data[0].current_district_id);
                            let district_id1 = data[0].permanent_district_id;
                            let district_id2 = data[0].current_district_id;
                            let block_id1 = data[0].permanent_block_id;
                            let block_id2 = data[0].current_block_id;
                            let village_id1 = data[0].permanent_village_id;
                            let village_id2 = data[0].current_village_id;
                            // Handle current address, respecting the 'Same as Permanent' checkbox
                            /*if (!data[0].is_current_same_as_permanent) {
                                $("#current_district_id").val(data[0].current_district_id);
                                getBlocksByDistrict(data[0].current_district_id, 2);
                            } else {
                                // Trigger copy logic to disable fields and fill dropdowns
                                $("#copyPermanentAddress").trigger("change");
                            }*/
                            getAddressBlocksByDistrict(district_id1,district_id2,block_id1, block_id2);
                        
                            getAddressVillagesByBlock(block_id1, block_id2,village_id1,village_id2);
                            setTimeout(function() {
                                    window.initAddressDetails = $("#content-section-form-1").serialize();
                            }, 1500);                           

                        }
                    },
                    error: function () {
                        // ??????? ??????????? ?????? ?????? ?? ??? ???????, ???????? ????
                        console.error('Error loading address details.');
                    }
                });
            }
        // === Address integration end ===

        // === Other details integration start ===
            window.setAssetsDetailsPreview = function(fieldName,fieldValue,assetUrl){

             //if(data.domicile ==1){
             console.log(fieldName+"=>"+fieldValue+""+assetUrl);
             if(fieldValue == 1){
                $('#'+fieldName+'_yes').prop('checked', true);

                if(!isEmpty(assetUrl)){
                    const previewContainer = $('#'+fieldName+'_preview');    
                    let previewHtml = '';
                    var ext = assetUrl.split('.').pop().toLowerCase();
                    var imageExts = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];

                    if (imageExts.includes(ext)) {
                        previewHtml = `
                            <div class="preview-item">
                                <img src="${assetUrl}" alt="Preview">
                                <a href="${assetUrl}" target="_blank">View Full Image</a>
                                <button type="button" class="btn btn-sm btn-danger ms-2 remove-file" data-field="${fieldName}">×</button>
                            </div>
                        `;
                    } else {
                        previewHtml = `
                            <div class="preview-item">
                                <a href="${assetUrl}" target="_blank">View</a>
                                <button type="button" class="btn btn-sm btn-danger ms-2 remove-file" data-field="${fieldName}">×</button>
                            </div>
                        `;
                    }
                    previewContainer.html(previewHtml);
                    $('.'+fieldName+'-upload-container').show();
                
                }
             }
            }

            function getOtherDetails() {
                $.ajax({
                    url: baseUrl + "staffs/other-details/" + staffId,
                    method: "GET",
                    dataType: "json",
                    success: function (response) {
                        let data = response.data;
                        if (currentIndex < sections.length - 1) {
                            currentIndex++;
                            updateUI();
                        }
                        console.log(data);
                        if (data && data.id > 0) {
                           
                           /* setAssetsDetailsPreview('domicile',data.domicile,data.domicile_file_path);
                            setAssetsDetailsPreview('border_village',data.border_village,data.border_village_file_path);
                            setAssetsDetailsPreview('suicide_farmer_child',data.suicide_farmer_child,data.suicide_farmer_child_file_path);
                            setAssetsDetailsPreview('non_vremy',data.non_vremy,data.non_vremy_file_path);
                            setAssetsDetailsPreview('freedom_fighter_ward',data.freedom_fighter_ward,data.freedom_fighter_ward_file_path);
                            setAssetsDetailsPreview('election_1991',data.election_1991,data.election_1991_file_path);
                            setAssetsDetailsPreview('election_1994',data.election_1994,data.election_1994_file_path);*/

                            $("#mother_tongue").val(data.mother_tongue);
                            $("#blood_group").val(data.blood_group);
                            $("#election_card").val(data.election_card);
                            
                            $("#height").val(data.height);
                            $("#weight").val(data.weight);
                            $("#identification_mark1").val(data.identification_mark1);
                            $("#identification_mark2").val(data.identification_mark2);
                            $("#no_of_non_teaching_working_days").val(data.days_spent_non_teaching_assignments);

                            /*if(data.ex_servicemen == 1){
                                $('#ex_servicemen_yes').prop('checked', true);
                            }else{
                                 $('#ex_servicemen_no').prop('checked', true);
                            }*/

                            if(data.days_spent_non_teaching_assignments == 1){
                                $('#ex_servicemen_yes').prop('checked', true);
                            }else{
                                 $('#ex_servicemen_no').prop('checked', true);
                            }

                            if(data.digital_devices == 1){
                                $('#capable_handling_digital_yes').prop('checked', true);
                            }else{
                                 $('#capable_handling_digital_no').prop('checked', true);
                            }

                            if(data.deputation_from_other_school == 1){
                                $('#teacher_deputation_school_yes').prop('checked', true);
                            }else{
                                 $('#teacher_deputation_school_no').prop('checked', true);
                            }

                            if(data.teaching_at_other_school_as_guest == 1){
                                $('#teaching_other_school_yes').prop('checked', true);
                            }else{
                                 $('#teaching_other_school_no').prop('checked', true);
                            }
                              
                            $("#lang1").val(data.lang1);
                            $("#lang2").val(data.lang2);
                            $("#lang3").val(data.lang3);

                        }
                    },
                    error: function () {
                        // ??????? ??????????? ?????? ?????? ?? ??? ???????, ???????? ????
                        console.error('Error loading address details.');
                    }
                });
            }
        // === Other details integration end ===


        
        // === Leaves details integration start ===
            function calculateTotalLeaves() {
                let casual = parseInt($("#cl_available").val()) || 0;
                let earned = parseInt($("#el_available").val()) || 0;
                let carry = parseInt($("#el_carry_forward").val()) || 0;

                let total = casual + earned + carry;

                $("#total_leave_balance").val(total);
            }
            function calculateRemainingLeaves() {
                let casual = parseInt($("#cl_available").val()) || 0;
                let earned = parseInt($("#el_available").val()) || 0;
                let carry = parseInt($("#el_carry_forward").val()) || 0;
                let used = parseInt($("#used_leaves").val()) || 0;

                let remaining = casual + earned + carry - used;

                $("#remaining_leaves").val(remaining);
                if(remaining < 0){
                    $("#remaining_leaves").val(0);
                    $("#unpaid_leaves").val(-1*remaining);
                }else{
                    $("#remaining_leaves").val(remaining);
                    $("#unpaid_leaves").val(0);
                }
            }

            // Trigger calculation on change / typing
            $("#cl_available, #el_available, #el_carry_forward").on("input keyup change", function () {
                calculateTotalLeaves();
                calculateRemainingLeaves();
            });

            $("#used_leaves").on("input keyup change", function () {
                calculateRemainingLeaves();
            });
            function updateLeaveDetails(){                 
                    let is_form_data_change = false;
                   // let currentSectionData = $("#content-section-form-0").serialize();
                    //if (currentSectionData !== window.initPersonalDetails) { is_form_data_change = true; }else{
                        //take rewards here
                        //getAddressDetails(); 
                       // return false;}
                    let cl_available = $('#cl_available').val();
                    let el_available = $('#el_available').val();
                    let el_carry_forward = $("#el_carry_forward").val();
                    let total_leave_balance = $("#total_leave_balance").val();
                    let used_leaves = $("#used_leaves").val();
                    let unpaid_leaves = $("#unpaid_leaves").val();
                    let remaining_leaves = $('#remaining_leaves').val();
                    
                    if(is_form_data_change){
                        if (!confirm("Are you sure you want to save your data?")) {
                            return false; 
                        }
                    }
                    payload = {           
                            staff_id: sID,
                            cl_available: cl_available,
                            el_available: el_available,
                            el_carry_forward:el_carry_forward,
                            total_leave_balance:total_leave_balance,
                            used_leaves:used_leaves,
                            unpaid_leaves:unpaid_leaves,
                            remaining_leaves:remaining_leaves,
                            _Token:'ZGVlcGFraHBhdGlsMzAwODE5ODA='
                        };

                    $.ajax({
                        url: '<?= $this->Url->build(["controller" => "staffs", "action" => "update-leave-details"]); ?>',
                        type: 'POST',
                        contentType: 'application/json', 
                        dataType: 'json',                
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                        },
                        data: JSON.stringify(payload),
                        beforeSend: function() {
                            
                            //$('#processingModal').show();
                            //alert(11)
                            $('#responseMessage').html('<span class="text-info"><div class="text-info d-flex align-items-center"><div class="spinner-border spinner-border-sm me-2" role="status"></div><span>Processing...</span></div></span>');
                        },
                        success: function(response, status, xhr) {
                            if (xhr.getResponseHeader("X-Session-Expired") === "1") {
                                //alert("Session expired. Please login again.");
                                window.location.href = "/users/login";
                            }
                        
                            window.initPersonalDetails = $("#content-section-form-0").serialize();
                            //take rewards here
                            //getAddressDetails();                           
                        
                            
                        },           
                        error: function(xhr) {
                            if (xhr.status === 401) { window.location.href = "/users/login";}
                            $('#processingModal').hide();
                            let msg = "Unexpected error";
                            try {
                                const json = JSON.parse(xhr.responseText);
                                msg = json.message || xhr.statusText;
                            } catch(e) {
                                msg = xhr.statusText;
                            }
                            $('#responseMessage').html('<span class="text-danger">Error: ' + msg + '</span>');
                            $('#submitBtn').show();
                        }
                    });
            }
            function getLeaveDetails() {
                $.ajax({
                    url: baseUrl + "staffs/leave-details/" + staffId,
                    method: "GET",
                    dataType: "json",
                    success: function (response) {
                        let data = response.data;
                        if (currentIndex < sections.length - 1) {
                            currentIndex++;
                            updateUI();
                        }
                        if (data && data.id > 0) {                           
                            $("#cl_available").val(data.cl_available);
                            $("#el_available").val(data.el_available);
                            $("#el_carry_forward").val(data.el_carry_forward);
                            $("#total_leave_balance").val(data.total_leave_balance);
                            $("#used_leaves").val(data.used_leaves);
                            $("#unpaid_leaves").val(data.unpaid_leaves);
                            $("#remaining_leaves").val(data.remaining_leaves);   
                        }
                    },
                    error: function () {
                        // ??????? ??????????? ?????? ?????? ?? ??? ???????, ???????? ????
                        console.error('Error loading address details.');
                    }
                });
            }
        // === Leaves details integration end ===

        // === Bank Account details integration start ===
            function getBankAccountDetails() {
                $.ajax({
                    url: baseUrl + "staffs/bank-account-details/" + staffId,
                    method: "GET",
                    dataType: "json",
                    success: function (response) {
                        let data = response.data;
                        if (currentIndex < sections.length - 1) {
                            currentIndex++;
                            updateUI();
                        }
                        console.log(data);
                        if (data && data.id > 0) {
                           
                            $("#bank_name").val(data.bank_name);
                            $("#branch_name").val(data.branch_name);
                            $("#account_number").val(data.bank_account_number);
                            $("#ifsc_code").val(data.ifsc);
                           

                        }
                    },
                    error: function () {
                        // ??????? ??????????? ?????? ?????? ?? ??? ???????, ???????? ????
                        console.error('Error loading address details.');
                    }
                });
            }
        // === Bank details integration end ===

        // === Bank Pay details integration start ===
            function getPayDetails() {
                $.ajax({
                    url: baseUrl + "staffs/pay-details/" + staffId,
                    method: "GET",
                    dataType: "json",
                    success: function (response) {
                        let data = response.data;
                        if (currentIndex < sections.length - 1) {
                            currentIndex++;
                            updateUI();
                        }
                        console.log(data);
                        if (data && data.id > 0) {
                            $("#pay_commission_id").val(data.pay_commission_id);
                            $("#scale_id").val(data.scale_id);
                            $("#pay_matrix").val(data.pay_matrix);
                            $("#pay_in_band").val(data.pay_in_band);
                            $("#grade_pay").val(data.grade_pay);
                            $("#basic_pay").val(data.basic_pay);
                            $("#senior_grade").val(data.senior_grade);
                            $("#selection_grade").val(data.selection_grade);
                            $("#next_increment_date").val(data.next_increment_date);
                            $("#pay_wef_date").val(data.pay_wef_date);
                            $("#senior_grade_date").val(data.senior_grade_date);
                            $("#selection_grade_date").val(data.selection_grade_date);                      

                        }
                    },
                    error: function () {
                        // ??????? ??????????? ?????? ?????? ?? ??? ???????, ???????? ????
                        console.error('Error loading address details.');
                    }
                });
            }
        // === Pay details integration end ===

        // === UDISE Qualification details integration start ===
            function getUdiseQualDetails() {
                $.ajax({
                    url: baseUrl + "staffs/udise-qual-details/" + staffId,
                    method: "GET",
                    dataType: "json",
                    success: function (response) {
                        let data = response.data;
                        if (currentIndex < sections.length - 1) {
                            currentIndex++;
                            updateUI();
                        }
                        console.log(data);
                        if (data && data.id > 0) {
                            $("#math_studied_upto").val(data.math_upto);
                            $("#science_studied_upto").val(data.science_upto);
                            $("#english_studied_upto").val(data.english_upto);
                            $("#social_studies_studied_upto").val(data.soc_study_upto);
                            $("#language_studied_upto").val(data.lang_study_upto);
                            $("#teaching_level").val(data.appointed_level);
                            $("#main_subject1").val(data.sub_taught_1);
                            $("#main_subject2").val(data.sub_taught_2);
                             // "trade": 1,
                            //"qual_prof": 1,
                        // "class_taught": 1,
                        }
                    },
                    error: function () {
                        // ??????? ??????????? ?????? ?????? ?? ??? ???????, ???????? ????
                        console.error('Error loading address details.');
                    }
                });
            }
        // ===  UDISE Qualification details integration end ===

        // === TET/CTET details integration start ===
            $('#examYear').change(function () {
                let year = $(this).val();
                $('#examPaper').html('<option>Loading...</option>');
                 $.ajax({
                    url: baseUrl + "tet/exam-pepers/" + year,
                    method: "GET",
                    dataType: "json",
                    success: function (response) {
                        let data = response.data;
                       
                         $('#examPaper').empty().append('<option value="">Select Exam Paper</option>');

                        // Populate options dynamically
                        data.forEach(d => {
                                $('#examPaper').append(`<option value="${d.paper_name}">${d.paper_name}</option>`);
                        });

                        
                    },
                    error: function () {
                        // ??????? ??????????? ?????? ?????? ?? ??? ???????, ???????? ????
                        console.error('Error loading address details.');
                    }
                });
            });
            current_tet_id=0;
            window.closeModal = function() {$('#resultModal').fadeOut();}
            $('#saveTetExamData').click(function () {
                $.ajax({
                    url: baseUrl + "tet/add-staff-exam-details/" + $("#__sid").val()+"/"+current_tet_id,
                    method: "GET",
                    dataType: "json",
                    success: function (response) {
                        // get detals
                        closeModal();
                        loadStaffTetResults();
                    },
                    error: function () {
                        // ??????? ??????????? ?????? ?????? ?? ??? ???????, ???????? ????
                        console.error('Error loading address details.');
                    }
                });
            });


            window.loadStaffTetResults = function () {
                $('#TetResultTableContainer').html('<div class="text-center py-4 text-muted">Loading TET Result</div>');
                $.ajax({
                    url: baseUrl + "tet/staff-exam-details/" + $("#__sid").val(),
                    method: "GET",
                    dataType: "json",
                    success: function (response) {
                       /////
                       const items = (response && response.data) ? response.data : [];

                        if (!items || items.length === 0) {
                            $('#TetResultTableContainer').html('<div class="text-center py-4 text-muted">No TET Result found.</div>');
                            return;
                        }

                        let html = `
                            <table class="table table-hover table-bordered align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                <th style="width:60px">Sr. No.</th>
                                <th>Year</th>
                                <th>Paper</th>                                
                                <th>CandidateName</th>
                                <th>RollNumber</th>
                                <th>Eligibility</th>
                                <th>Percentage</th>                                
                                <th>CertificateNumber</th>
                                <th>Result Date</th>
                                <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                        `;

                        items.forEach((row, i) => {
                            let result_date = formatDateISO(row.result_date);
                            html += `
                            <tr data-id="${row.id}">
                                <td>${i + 1}</td>
                                <td>${(row?.year || '-')}</td>  
                                <td>${(row?.paper_name || '-')}</td>                        
                                <td>${(row?.candidate_name || '-')}</td>
                                <td>${(row?.roll_no || '-')}</td>                                                  
                                <td>${(row?.eligibility || '-')}</td>
                                <td>${(row?.obtained_percentage || '-')}</td>      
                                <td>${(row?.certificate_no || '-')}</td>
                                <td>${result_date}</td>   
                                
                                <td class="text-nowrap">
                                    <!--<button class="btn btn-sm  btn-info text-white me-2 viewQualBtn" data-item='${JSON.stringify(row).replace(/'/g,"&#39;")}'>
                                        <i class="fas fa-eye"></i>
                                    </button>                           
                                    <button class="btn btn-sm btn-warning me-2 editProfessionalBtn" data-id="${row.id}">
                                        <i class="fas fa-pencil"></i>
                                    </button>-->

                                    <button class="btn btn-sm btn-danger deleteTetResultBtn" data-id="${row.id}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>  
                            </tr>
                            `;
                        });

                        html += '</tbody></table>';
                        $('#TetResultTableContainer').html(html);
                       /////
                    },
                    error: function () {
                        // ??????? ??????????? ?????? ?????? ?? ??? ???????, ???????? ????
                        console.error('Error loading address details.');
                    }
                });
            }

            $(document).on("click", ".deleteTetResultBtn", function () {
                let id = $(this).data("id");

                if (!confirm("Are you sure you want to delete this TET Result?")) return;


                 $.ajax({
                    url: "/tet/delete/" + id,
                    method: "DELETE",
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                    },
                    success: function () {
                        loadStaffTetResults(); 
                    },
                    error: function () {
                        alert("Delete failed.");
                    }
                });


                
            });
            // Fetch TET result
            $('#fetchResult').click(function () {               
                current_tet_id=0;
                let payload = {};
                
                payload['staff_id'] = $("#__sid").val();
                payload['_Token'] = 'ZGVlcGFraHBhdGlsMzAwODE5ODA=';
                payload['exam_year'] = $("#examYear").val();
                payload['exam_paper'] = $("#examPaper").val();
                payload['roll_number'] = $("#rollNumber").val();
                 $.ajax({
                        url: '<?= $this->Url->build(["controller" => "tet", "action" => "exam-results"]); ?>',
                        type: 'POST',
                        contentType: 'application/json', 
                        dataType: 'json',                
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                        },
                        data: JSON.stringify(payload),
                        beforeSend: function() {
                            
                            //$('#processingModal').show();
                            //alert(11)
                            $('#responseMessage').html('<span class="text-info"><div class="text-info d-flex align-items-center"><div class="spinner-border spinner-border-sm me-2" role="status"></div><span>Processing...</span></div></span>');
                        },
                        success: function(response, status, xhr) {
                            if (xhr.getResponseHeader("X-Session-Expired") === "1") {
                                //alert("Session expired. Please login again.");
                                window.location.href = "/users/login";
                            }

                            if (response.status !== 'success') {
                                alert('No data found');
                                return;
                            }

                            let d = response.data;

                            /*if(d.candidate_name != "<?= h($staff->emp_name ?? '') ?>"){
                                alert(" Staff name doesn't match candidate name. Please verify the staff member's TET registration details");
                                return;
                            }*/
                            current_tet_id = d.id;
                            let html = `
                                <tr>
                                    <td colspan="2">Candidate Name &rarr; ${d.candidate_name}</td>
                                    <td>Eligibility &rarr; ${d.eligibility === 'Y' ? 'Eligible' : 'Not Eligible'}</td>
                                </tr>
                                <tr>
                                    <td>Year &rarr; ${d.year}</td>
                                    <td>Roll Number &rarr; ${d.roll_no}</td>
                                    <td>Paper &rarr; ${d.paper_name}</td>
                                </tr>                                
                                <tr>
                                    
                                    <td>Category &rarr; ${d.category}</td>
                                    <td>Handicapped &rarr; ${d.is_handicapped ? 'Yes' : 'No'}</td>
                                    <td>Ex-Serviceman/Wife/Sibling &rarr; ${d.is_ex_serviceman_wife_or_sibling ? 'Yes' : 'No'}</td>
                                </tr>
                                <tr>
                                    <td>Exam Medium &rarr; ${d.exam_medium}</td>
                                    <td>Language 2 &rarr; ${d.language2_name}</td>
                                    <td>Certificate No &rarr; ${d.certificate_no}</td>
                                </tr>
                                <tr>
                                    <td>Total Marks &rarr; ${d.total_marks}</td>
                                    <td>Min Marks Required &rarr; ${d.min_marks_required}</td>
                                    <td>Required % &rarr; ${d.required_percentage}</td>
                                </tr>

                                <tr>
                                    <td>Obtained Marks &rarr; ${d.obtained_marks}</td>
                                    <td>Obtained % &rarr; ${d.obtained_percentage}</td>
                                    <td>Result Date &rarr; ${d.result_date}</td>                             
                                    
                                </tr>                               
                            `;

                            $('#modalResultBody').html(html);
                            $('#resultModal').fadeIn();
                           

                            //window.initPersonalDetails = $("#content-section-form-0").serialize();
                            //take rewards here
                            //getAddressDetails();                           
                        
                            
                        },           
                        error: function(xhr) {
                            if (xhr.status === 401) { window.location.href = "/users/login";}
                            $('#processingModal').hide();
                            let msg = "Unexpected error";
                            try {
                                const json = JSON.parse(xhr.responseText);
                                msg = json.message || xhr.statusText;
                            } catch(e) {
                                msg = xhr.statusText;
                            }
                            $('#responseMessage').html('<span class="text-danger">Error: ' + msg + '</span>');
                            $('#submitBtn').show();
                        }
                    });
            });
        // ===  TET/CTET details integration end ===

        


        // === PF/GPF  details integration start ===
            function getPfGpfDetails() {
                $.ajax({
                    url: baseUrl + "staffs/bank-pf-gpf-details/" + staffId,
                    method: "GET",
                    dataType: "json",
                    success: function (response) {
                        let data = response.data;
                        if (currentIndex < sections.length - 1) {
                            currentIndex++;
                            updateUI();
                        }
                        console.log(data);
                        if (data && data.id > 0) {
                           
                            $("#pf_acc_type").val(data.account_type);
                            $("#pf_acc_maintained_by").val(data.account_maintained_by);
                            $("#pf_series").val(data.pf_series);
                            $("#pf_gpf_account_no").val(data.pf_account_no);
            
                        }
                    },
                    error: function () {
                        // ??????? ??????????? ?????? ?????? ?? ??? ???????, ???????? ????
                        console.error('Error loading address details.');
                    }
                });
            }
        // === PF/GPF details integration end ===

        // === Familly integration Starts ===
            // 🧭 Fetch and display family details (FIXED: Error message and function placement)
            // Nomination
            function loadFamilyDetails() {
                if (!staffId) {
                    $('#familyTableContainer').html('<p class="text-danger text-center py-3">Error loading family details. Staff ID not available.</p>');
                    return;
                }
                $.ajax({
                    url: baseUrl + "staff-family/lists/" + staffId,
                    method: "GET",
                    dataType: "json",
                    headers: {
                                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                                },
                    success: function (response) {
                        let data = response.data;
                        if (!data || data.length === 0) {
                            $('#familyTableContainer').html(`
                                <div class="text-center py-4 text-muted">
                                <i class="bi bi-people fs-1 d-block mb-2"></i>
                                <p class="mb-0">There are no family records yet.</p>
                                </div>
                            `);
                            return;
                        }

                        let table = `
                            <table class="table table-striped table-hover align-middle">
                                <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Family Member</th>
                                    <th>Relation</th>
                                    <th>Date of Birth</th>
                                    <th>Aadhar</th>
                                    <th>Covered Under Family</th>
                                    <th>Date of Nomination</th>
                                     <th>Nomination Percentage</th>
                                     <th>Actions</th>

                                </tr>
                                </thead>
                                <tbody>
                        `;
                        $.each(data, function (i, row) {
                            //alert(row);
                            table += `
                                <tr>
                                <td>${i + 1}</td>
                                <td>${row.family_member_name}</td>
                                <td>${row?.relationship?.relationship || '-'}</td>
                                <td>${row.date_of_birth ? new Date(row.date_of_birth).toLocaleDateString('en-GB') : '-'}</td>
                                <td>${row.aadhar_card_no || '-'}</td>
                                <td>${row.covered_under_family ? 'Yes' : 'No'}</td>                                
                                <td>${row.date_of_nominaton ? new Date(row.date_of_nominaton).toLocaleDateString('en-GB') : '-'}</td>
                                <td>${row?.nominaton_percentage || '-'}</td>
                                <td class="text-nowrap">
                                    <button class="btn btn-sm btn-info text-white me-2 viewFamilyBtn" 
                                            data-id="${row.id}">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                    <button class="btn btn-sm btn-warning me-2 editFamilyBtn" data-id="${row.id}">
                                        <i class="fas fa-pencil"></i>
                                    </button>

                                    <button class="btn btn-sm btn-danger deleteFamilyBtn" data-id="${row.id}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                                                            
                                </tr>`;
                        });
                        table += "</tbody></table>";
                        $('#familyTableContainer').html(table);
                    },
                    error: function () {
                        // Family Members Details -Error loading family details.
                        $('#familyTableContainer').html('<p class="text-danger text-center py-3">Error loading family details.</p>');
                    }
                });
            }
            // 🎯 Add new member button
            $('#addFamilyBtn').on('click', function() {
                $('#familyError').hide();                
                $("#familyForm")[0].reset();
                $("#familyModal .modal-title").text("Add Family Member");
                $("#saveFamilyBtn").data("mode", "add");
                $("#saveFamilyBtn").data("id", "");
                $("#familyModal").modal("show");
            });

            $(document).on("click", ".viewFamilyBtn", function () {
                let id = $(this).data("id");

                $.ajax({
                    url: "/staff-family/edit/" + id,
                    method: "GET",
                    headers: {
                                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                                },
                    success: function(response) {
                        let d = response.data;

                        $("#v_family_member_name").text(d.family_member_name || '-');
                        $("#v_relation").text(d.relationship?.relationship || '-');

                        $("#v_date_of_birth").text(
                            d.date_of_birth ? new Date(d.date_of_birth).toLocaleDateString('en-GB') : '-'
                        );

                        $("#v_aadhar").text(d.aadhar_card_no || '-');
                        $("#v_covered").text(d.covered_under_family ? "Yes" : "No");

                        $("#v_nom_date").text(
                            d.date_of_nominaton ? new Date(d.date_of_nominaton).toLocaleDateString('en-GB') : '-'
                        );

                        $("#v_nom_percent").text(d.nominaton_percentage || '-');

                        $("#viewFamilyModal").modal("show");
                    }
                });
            });


            $(document).on("click", ".editFamilyBtn", function () {
                let id = $(this).data("id");

                $.ajax({
                    url: "/staff-family/edit/" + id,
                    method: "GET",
                    headers: {
                                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                                },
                    success: function(response) {
                        let d = response.data;
                        
                        $("#familyId").val(id);
                        $("#familyModal .modal-title").text("Edit Family Member");
                        $("#saveFamilyBtn").data("mode", "edit");
                        $("#saveFamilyBtn").data("id", id);

                        // Fill form
                        $("[name=family_member_name]").val(d.family_member_name);
                        $("[name=relation_id]").val(d.relation_id);
                        const fp = flatpickr("#date_of_birth", { dateFormat: "d/m/Y",allowInput: true});
                        fp.setDate(d.date_of_birth, true, "d/m/Y");
                        $("[name=aadhar_card_no]").val(d.aadhar_card_no);

                        $("input[name=covered_under_family][value=" + (d.covered_under_family ? "true" : "false") + "]").prop("checked", true);
                        const fp1 = flatpickr("#date_of_nominaton", { dateFormat: "d/m/Y",allowInput: true});
                        fp1.setDate(d.date_of_nominaton, true, "d/m/Y");
                        $("[name=nominaton_percentage]").val(d.nominaton_percentage);

                        $("#familyModal").modal("show");
                    }
                });
            });

            $(document).on("click", ".deleteFamilyBtn", function () {
                let id = $(this).data("id");

                if (!confirm("Are you sure you want to delete this family member?")) return;

                $.ajax({
                    url: "/staff-family/delete/" + id,
                    method: "POST",
                    headers: {
                                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                                },
                    success: function () {
                        loadFamilyDetails();
                    },
                    error: function () {
                        alert("Delete failed.");
                    }
                });
            });



            // 💾 Save family member
            $('#saveFamilyBtn').on('click', function() {

               

                let mode = $(this).data("mode");
                let id = $(this).data("id");
                console.log(id);
                console.log("ffid=>"+$(this).data("familyId"));
                let endPoint = mode === "add" 
                    ? "staff-family/add"
                    : "staff-family/update/" + id;
                let url = baseUrl +  endPoint;

                ///
                const formData = $('#familyForm').serializeArray();
                let payload = {};
                
                payload['staff_id'] = $("#__sid").val();
                payload['_Token'] = 'ZGVlcGFraHBhdGlsMzAwODE5ODA=';
                formData.forEach(f => payload[f.name] = f.value);

                if(payload['family_member_name'] == ''){
                    $('#familyError').show();
                    $('#familyError').html('<p style="padding:10px;" class="text-danger text-center py-3">Please enter family memebr name.</p>');
                    return;                    
                }

                if(payload['relation_id'] == ''){
                    $('#familyError').show();
                    $('#familyError').html('<p style="padding:10px;" class="text-danger text-center py-3">Please Select Relation with memeber.</p>');
                    return;                    
                }
                //date_of_nominaton
                /*if ($("input[name='covered_under_family']:checked").val() === "true") {
                    if(payload['nominaton_percentage'] == ''){
                        $('#familyError').show();
                        $('#familyError').html('<p style="padding:10px;" class="text-danger text-center py-3">Please Select Relation with memeber.</p>');
                        return;                    
                    }
                }*/
 
                $.ajax({
                    url: url,
                    type: "POST",
                    contentType: 'application/json', 
                    dataType: 'json',   
                    data: JSON.stringify(payload),
                    headers: {
                                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                                },
                    success: function() {
                        $('#familyModal').modal('hide');
                        loadFamilyDetails();
                    },
                    error: function() {
                        alert("Failed to save family member.");
                    }
                });
            });
        // === Familly integration end ===

        // === Nomination integration Starts (NEW FUNCTION) ===
         // 🧭 Fetch and display nomination details
            function loadNominationDetails() {
                $.ajax({
                url: baseUrl + "staff-nomination/lists/" + staffId,
                method: "GET",
                dataType: "json",
                success: function(response) {                             
                    let data = response.data;
                    
                   


                    if (!data || data.length === 0) {
                        $('#familyTableContainer').html(`
                            <div class="text-center py-4 text-muted">
                            <i class="bi bi-people fs-1 d-block mb-2"></i>
                            <p class="mb-0">There are no family records yet.</p>
                            </div>
                        `);
                        return;
                    }

                    let table = `
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Relation</th>
                                <th>Nominate To</th>
                                <th>Date of Nomination</th>
                                <th>Nomination Percentage</th>
                            </tr>
                            </thead>
                            <tbody>`;

                        idx =1;
                        $.each(response.data, function(i, row) {
                            if(row.covered_under_family){
                                table += `
                                <tr>
                                <td>`+ idx++ +`</td>
                                <td>${row?.family_member_name || '-'}</td>
                                <td>${row?.relationship?.relationship || '-'}</td>
                                <td><input type="text"  name="date_of_nomination[${row?.id}]" class="form-control date-field-new" value="${row.date_of_nomination ? new Date(row.date_of_nomination).toLocaleDateString('en-GB') : '-'}"></td>
                                <td><input type="number" name="nomination_percentage[${row?.id}]" class="form-control" value="${row.nomination_percentage || '-'}"></td>
          
                                </tr>`;
                            }

                            
                        });
                       
                    table += "</tbody></table>";
                    $('#nominationTableContainer').html(table);
                     flatpickr(".date-field-new", {
                            dateFormat: "d/m/Y",   // dd/mm/yyyy format
                            allowInput: true,
                            altInput: true,
                            altFormat: "d/m/Y",
                            disableMobile: false,  // uses native picker on mobile
                            maxDate: "31-12-3100", // optional future limit
                        });
                },
                error: function() {
                    $('#nominationTableContainer').html('<p class="text-danger text-center py-3">Error loading family details.</p>');
                }
                });
            }
        // === Nomination integration End ===

        
        // === Academic Qualification integration starts ===

            function updateAcademicSubjectOptions() {
                // Collect all selected values
                var selected = $(".academic-subject-select").map(function() {
                    return $(this).val();
                }).get();

                // For each dropdown
                $(".academic-subject-select").each(function() {
                    var currentSelect = $(this);
                    var currentValue = currentSelect.val();

                    // Enable all options first
                    currentSelect.find("option").prop("disabled", false);

                    // Disable selected options in other dropdowns
                    $(".academic-subject-select").not(currentSelect).each(function() {
                        var val = $(this).val();
                        if (val) {
                            currentSelect.find("option[value='" + val + "']").prop("disabled", true);
                        }
                    });

                    // Keep the current value enabled
                    currentSelect.find("option[value='" + currentValue + "']").prop("disabled", false);
                });
            }


            // Run on change of any subject select
            $(".academic-subject-select").on("change", updateAcademicSubjectOptions);

            // Run on page load
            updateAcademicSubjectOptions();

            $('#academic_marks_obtained, #academic_marks_out_of').on('blur', function() {
                const obtained = parseFloat($('#academic_marks_obtained').val());
                const outOf = parseFloat($('#academic_marks_out_of').val());

                if (isNaN(obtained) || isNaN(outOf) || outOf === 0) {
                    $('#academic_percentage').val('');
                    return;
                }

                if (obtained > outOf) {
                    $('#academic_percentage').val('Invalid: Obtained > Total');
                    return;
                }

                const percentage = ((obtained / outOf) * 100).toFixed(2);
                $('#academic_percentage').val(percentage + '%');
            });

            function setSubjects(){
                let levelId = $("#academic_level_id").val();
                let degreeId = $("#academic_degree_id").val();
                let stateId = $("#academic_state_id").val();


                $("#academic_main_subject_1").html('<option value="">Loading...</option>');
                $("#academic_main_subject_2").html('<option value="">Loading...</option>');
                $("#academic_main_subject_3").html('<option value="">Loading...</option>');

                if (!levelId || !degreeId) {
                    $("#academic_main_subject_1").html('<option value="">Select Subject</option>');
                    $("#academic_main_subject_2").html('<option value="">Select Subject</option>');
                    $("#academic_main_subject_3").html('<option value="">Select Subject</option>');
                    return;
                }       


                $.ajax({
                    url:  baseUrl+'staff-qualifications/level-degree-subjects/'+ levelId+'/'+degreeId,
                    type: "GET",
                    dataType: "json",
                    success: function (response) {

                        let options = '<option value="">Select Subject</option>';

                        if (response.status === 'success' && response.data.length > 0) {
                            response.data.forEach(function (item) {
                                options += `<option value="${item.id}">${item.name}</option>`;
                            });

                        } else {
                            options = '<option value="">No Subject found</option>';
                        }

                        $("#academic_main_subject_1").html(options);
                        $("#academic_main_subject_2").html(options);
                        $("#academic_main_subject_3").html(options);

                    },
                    error: function () {
                        $("#academic_main_subject_1").html('<option value="">Error loading Subject</option>');
                        $("#academic_main_subject_2").html('<option value="">Error loading Subject</option>');
                        $("#academic_main_subject_3").html('<option value="">Error loading Subject</option>');
                    }
                });
            }
            function setUnivercities(){
                let levelId = $("#academic_level_id").val();
                let degreeId = $("#academic_degree_id").val();
                let stateId = $("#academic_state_id").val();
               

                // Reset degrees dropdown
                $("#academic_board_university_id").html('<option value="">Loading...</option>');

                //if (!levelId || !degreeId || !stateId) {
                if (!levelId || !stateId) {
                    $("#academic_board_university_id").html('<option value="">1Select University / Board</option>');
                    return;
                }       


                $.ajax({
                    url:  baseUrl+'staff-qualifications/level-degree-state-univercities/'+ levelId+'/'+stateId,
                    type: "GET",
                    dataType: "json",
                    success: function (response) {

                        let options = '<option value="">Select Board / University</option>';

                        if (response.status === 'success' && response.data.length > 0) {
                            response.data.forEach(function (item) {
                                options += `<option value="${item.id}">${item.name}</option>`;
                            });

                        } else {
                            options = '<option value="">No Board / University found</option>';
                        }

                        $("#academic_board_university_id").html(options);
                    },
                    error: function () {
                        $("#academic_board_university_id").html('<option value="">Error loading degrees</option>');
                    }
                });
            }
            $("#academic_level_id").on("change", function () {

                let levelId = $(this).val();

                // Reset degrees dropdown
                $("#academic_degree_id").html('<option value="">Loading...</option>');

                if (!levelId) {
                    $("#academic_degree_id").html('<option value="">Select Degree / Trade</option>');
                    return;
                }
                setUnivercities();
                $.ajax({
                    url:  baseUrl+'staff-qualifications/level-degrees/'+ levelId,
                    type: "GET",
                    dataType: "json",
                    success: function (response) {

                        let options = '<option value="">Select Degree / Trade</option>';

                        if (response.status === 'success' && response.data.length > 0) {
                            response.data.forEach(function (item) {
                                options += `<option value="${item.id}">${item.name}</option>`;
                            });

                        } else {
                            options = '<option value="">No degrees found</option>';
                        }

                        $("#academic_degree_id").html(options);
                    },
                    error: function () {
                        $("#academic_degree_id").html('<option value="">Error loading degrees</option>');
                    }
                });

            });

            $("#academic_state_id").on("change", function () {
                setUnivercities();            
            });


            $("#academic_degree_id").on("change", function () {
                setSubjects();            
            });

            

            $('input[name="academic_degree_from_maharashtra"]').change(function() {
                if ($(this).val() === '1') {
                    // Yes - disable state field and set to Maharashtra
                    $('#academic_state_id').prop('disabled', true).val(27);
                    setUnivercities()
                } else {
                    // No - enable state field and clear selection
                    $('#academic_state_id').prop('disabled', false).val('');
                }
            });

            
            // Fetch qualifications via AJAX and render table
            function loadAcademicQualifications() {
                const url = baseUrl+'staff-qualifications/list-academic/'+sID; 
                $('#qualTableContainer').html('<div class="text-center py-4 text-muted">Loading qualifications…</div>');

                $.ajax({
                    url: url,
                    method: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        const items = (res && res.data) ? res.data : [];
                        renderAcademicQualificationTable(items);
                        $('#academic_level_id').empty().append('<option value="">Select Academic Level</option>');

                        // Populate options dynamically
                        res.levels.forEach(level => {
                                $('#academic_level_id').append(`<option value="${level.id}">${level.level_name}</option>`);
                        });

                        $('#academic_medium').empty().append('<option value="">Select Academic Medium</option>');

                        // Populate options dynamically
                        res.mediums.forEach(medium => {
                                $('#academic_medium').append(`<option value="${medium.id}">${medium.name}</option>`);
                        });


                        /*$('#academic_board_university_id').empty().append('<option value="">Select Board/University</option>');

                        // Populate options dynamically
                        res.universities.forEach(unv => {
                                $('#academic_board_university_id').append(`<option value="${unv.id}">${unv.name}</option>`);
                        });*/


                        $('#academic_state_id').empty().append('<option value="">Select State</option>');

                        // Populate options dynamically
                        res.states.forEach(state => {
                                $('#academic_state_id').append(`<option value="${state.id}">${state.name}</option>`);
                        });




                        
                    },
                    error: function() {
                    $('#qualTableContainer').html('<div class="alert alert-danger text-center">Failed to load qualifications.</div>');
                    }
                });
            }

            function renderAcademicQualificationTable(items) {
                if (!items || items.length === 0) {
                    $('#qualTableContainer').html('<div class="text-center py-4 text-muted">No qualifications found.</div>');
                    return;
                }

                let html = `
                    <table class="table table-hover table-bordered align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                        <th style="width:60px">Sr. No.</th>
                        <th>Qualification Level</th>
                        <th>Degree / Trade</th>
                        <th>Medium</th>
                        <th>University</th>
                        <th>Result Date</th>
                        <th>Actions</th>                        
                        </tr>
                    </thead>
                    <tbody>
                `;

                items.forEach((row, i) => {
                    //console.log(row);
                    let academic_result_date = formatDateISO(row.academic_result_date);

                    html += `
                    <tr data-id="${row.id}">
                        <td>${i + 1}</td>
                        <td>${(row?.academic_qualification_level?.level_name || '-')}</td>  
                        <td>${(row?.academic_qualification_degree?.name || '-')}</td>                        
                        <td>${(row?.medium?.name || '-')}</td>
                        <td>${(row?.university?.name || '-')}</td>
                        <td>${academic_result_date}</td> 
                        <td class="text-nowrap">
                                    <button class="btn btn-sm btn-info text-white me-2 viewAcademicBtn" 
                                            data-id="${row.id}">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                    <button class="btn btn-sm btn-warning me-2 editAcademicBtn" data-id="${row.id}">
                                        <i class="fas fa-pencil"></i>
                                    </button>

                                    <button class="btn btn-sm btn-danger deleteAcademicBtn" data-id="${row.id}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>                       
                    </tr>
                    `;
                });

                html += '</tbody></table>';
                $('#qualTableContainer').html(html);
            }

            function renderDisciplinaryActionTable(items) {
                console.log("items==>"+items);
                if (!items || items.length === 0) {
                    $('#disciplinaryActionTableContainer').html('<div class="text-center py-4 text-muted">No Disciplinary Actions found.</div>');
                    return;
                }

                let html = `
                    <table class="table table-hover table-bordered align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                        <th style="width:60px">Sr. No.</th>
                        <th>Disciplinary Action</th>
                        <th>Actions</th>                        
                        </tr>
                    </thead>
                    <tbody>
                `;

                items.forEach((row, i) => {
                    console.log(row);
                    html += `
                    <tr data-id="${row.id}">
                        <td>${i + 1}</td>
                        <td>${(row?.disc_action || '-')}</td> 
                        <td class="text-nowrap">
                                   

                                    <button class="btn btn-sm btn-danger deleteDisciplinaryActions" data-id="${row.id}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>                       
                    </tr>
                    `;
                });

                html += '</tbody></table>';
                $('#disciplinaryActionTableContainer').html(html);
            }
            // Show details in modal
            function showAcademicQualificationDetails(row) {
                const fields = [
                    ['Degree / Trade', row?.academic_qualification_degree?.name || '-'],
                    ['Qualification Level', row?.academic_qualification_level?.level_name || '-'],
                    ['Medium', row?.medium?.name || '-'],
                    ['Is Degree from Maharashtra?', (row.is_from_maharashtra ? 'Yes' : 'No')],
                    ['State', row.state || '-'],
                    ['Board / University', row?.university?.name || '-'],
                    ['Start', `${row.academic_month_start || '-'} ${row.academic_year_start || ''}`],
                    ['Passing', `${row.academic_month_passing || '-'} ${row.academic_year_passing || ''}`],
                    ['Percentage / Grade', row.percentage || '-'],
                    ['Main Subject', row.main_subject || '-'],
                    ['Optional Subject 1', row.opt_subject_1 || '-'],
                    ['Optional Subject 2', row.opt_subject_2 || '-'],
                    ['Other Subjects', row.other_subjects || '-'],
                    ['Remark', row.remark || '-']
                ];

                   
                let html = '<div class="row g-2">';
                fields.forEach(f => {
                    html += `<div class="col-6"><strong>${f[0]}:</strong><div>${f[1]}</div></div>`;
                });

                // certificate link
                if (row.certificate_url) {
                    html += `<div class="col-12 mt-3"><a href="${row.certificate_url}" target="_blank" class="btn btn-sm btn-outline-secondary">Download / View Certificate</a></div>`;
                }

                html += '</div>';
                $('#qualDetails').html(html);
                const modal = new bootstrap.Modal(document.getElementById('viewQualModal'));
                modal.show();
            }

            // Open Add modal and prepare form
            function openAddModal() {
                $('#addQualForm')[0].reset();
                $('#staff_id').val(staffId);
                $('#addQualModal').modal('show');
            }


            
            // Submit Add Qualification (FormData for file)
            function submitAddAcademicQualification(e) {
                e.preventDefault();

                let mode = $("#saveAcademicQualificationBtn").data("mode");
                let id = $("#saveAcademicQualificationBtn").data("id");
                console.log(id);
                let endPoint = mode === "add" 
                    ? "staff-qualifications/add-academic"
                    : "staff-qualifications/update-academic/" + id;
                let url = baseUrl +  endPoint;

                
                /*const formData = $('#addQualForm').serializeArray();
                let payload = {};
                
                payload['staff_id'] = $("#__sid").val();
                payload['_Token'] = 'ZGVlcGFraHBhdGlsMzAwODE5ODA=';
                formData.forEach(f => payload[f.name] = f.value);

                // Append the file
                let fileInput = document.getElementById('academic_certificate_file'); 
                if (fileInput.files.length > 0) {
                    payload['academic_certificate_file'] = fileInput.files[0];
                }*/

                let formData = new FormData(document.getElementById('addQualForm'));
    
                // Append additional data to FormData
                formData.append('staff_id', $("#__sid").val());
                formData.append('_Token', 'ZGVlcGFraHBhdGlsMzAwODE5ODA=');
 
                $.ajax({
                    url: url,
                    type: "POST",
                    processData: false,
                    contentType: false,//'application/json', 
                    //dataType: 'json',   
                    //data: JSON.stringify(payload),
                     data: formData,
                    headers: {
                                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                                },
                    success: function() {
                     $('#addQualModal').modal('hide');
                     loadAcademicQualifications();
                    },
                    error: function() {
                        if (xhr.status === 401) { window.location.href = "/users/login";}
                    $('#saveAcademicQualificationBtn').prop('disabled', false).text('Save Qualification');
                    alert('Server error while saving qualification.');
                    }
                });

            }

        
            // initialize staff_id if server-provided
            if (!$('#staff_id').val() && typeof window.__staffId !== 'undefined') {
                $('#staff_id').val(window.__staffId);
            }

            // load lookups and table on ready
            //populateLookups();
            

            // add button open modal
           // $('#addAcademicQualificationBtn').on('click', openAddModal);

            $('#addAcademicQualificationBtn').on('click', function () {

                $('#addQualForm')[0].reset();
                $('#staff_id').val(staffId);
                $('#addQualModal').modal('show');


                $('#academicError').hide();
                $("#addQualModal .modal-title").text("Add Academic Qualification");

                $("#saveAcademicQualificationBtn").data("mode", "add");
                $("#saveAcademicQualificationBtn").data("id", "");
                $("#edit_academic_certificate_file").html('');
                $("#addQualModal").modal("show");
            });

            $(document).on("click", ".viewAcademicBtn", function () {
                let id = $(this).data("id");

                $.ajax({
                    url: "/staff-qualifications/edit-academic/" + id,
                    method: "GET",
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                    },
                    success: function (response) {

                        let d = response.data;
                        degree_from_maharashtra = 'No';
                        if(d.academic_degree_from_maharashtra ==1){degree_from_maharashtra='Yes'}
                        $("#v_academic_level").text(d.academic_qualification_level?.level_name || '-');
                        $("#v_academic_degree").text(d.academic_qualification_degree?.name || '-');
                        $("#v_academic_degree_from_maharashtra").text(degree_from_maharashtra || '-');
                        $("#v_academic_state").text(d.pavitra_state?.name || '-');
                        $("#v_academic_board_university").text(d.university?.name || '-');
                        $("#v_academic_marks_obtained").text(d.academic_marks_obtained || '-');
                        $("#v_academic_marks_out_of").text(d.academic_marks_out_of || '-');
                        $("#v_academic_percentage").text(d.academic_percentage || '-');
                        $("#v_academic_grade").text(d.academic_grade || '-');

                  
         
                        // "academic_certificate_file": null,
        
       
        
                        $("#v_academic_class").text(d.academic_class || '-');
                        $("#v_academic_result_date").text(d.academic_result_date || '-');
                        $("#v_academic_medium").text(d.medium?.name || '-');
                        $("#v_academic_main_subject_1").text(d.subject?.name || '-');
                        if(!isEmpty(d.academic_certificate_file)){
                            let academic_certificate_file = baseUrl + '/'+ d.academic_certificate_file;
                            let img = '<a href="'+academic_certificate_file+'" target="_blank">View Certificate</a>';
                            $("#v_academic_certificate_file").html(img);
                        }
                        
                        
                      //  $("#v_academic_main_subject_2").text(d.score || '-');
                     //   $("#v_academic_main_subject_3").text(d.certificate_no || '-');

            

                        // Format certificate date
                        $("#v_certificate_date").text(
                            d.certificate_date
                                ? new Date(d.certificate_date).toLocaleDateString('en-GB')
                                : '-'
                        );

                        $("#viewAcademicModal").modal("show");
                    }
                });
            });

            $(document).on("click", ".editAcademicBtn", function () {
                let id = $(this).data("id");
                
                $("#edit_academic_certificate_file").html('');
                $.ajax({
                    url: "/staff-qualifications/edit-academic/" + id,
                    method: "GET",
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                    },
                    success: function (response) {

                        let d = response.data;
                        $('#addQualForm')[0].reset();
                        $("#academicId").val(id);
                        $("#addQualModal .modal-title").text("Edit Academic Qualification");
                        $("#saveAcademicQualificationBtn").data("mode", "edit");
                        $("#saveAcademicQualificationBtn").data("id", id);


                        
                        
                        $("#academic_level_id").val(d.academic_level_id);
                        $("#academic_degree_id").val(d.academic_degree_id);
                 // academic_degree_from_maharashtra_yes academic_degree_from_maharashtra
                 //academic_degree_from_maharashtra
                        $("#academic_state_id").val(d.academic_state_id);
                        
                        $("#academic_board_university_id").val(d.academic_board_university_id);
                    
                        $("#academic_marks_obtained").val(d.academic_marks_obtained);
                        
                        $("#academic_marks_out_of").val(d.academic_marks_out_of);
                        //$("#academic_level_id").val(d.qualification_name);
                        
                        $("#academic_percentage").val(d.academic_percentage);
                        
                        $("#academic_grade").val(d.academic_grade);
                        
                        $("#academic_class").val(d.academic_class);

                        $("#academic_result_date").val(formatDateISO(d.academic_result_date));
                        
                        
                        $("#academic_medium").val(d.academic_medium);
                        $("#academic_main_subject_1").val(d.academic_main_subject_1);

                        $("#academic_main_subject_2").val(d.academic_main_subject_2);

                        $("#academic_main_subject_3").val(d.academic_main_subject_3);


                        if(!isEmpty(d.academic_certificate_file)){
                            let academic_certificate_file = baseUrl + '/'+ d.academic_certificate_file;
                            let img = '<a href="'+academic_certificate_file+'" target="_blank">View Certificate</a>';
                            $("#edit_academic_certificate_file").html(img);
                        }

                        // Fill the form
                        
                     

                        // Set certificate date
                        /*if (d.certificate_date) {
                            let formatted = new Date(d.certificate_date).toLocaleDateString('en-GB');  
                            $("[name=certificate_date]").val(formatted);
                        } else {
                            $("[name=certificate_date]").val('');
                        }*/

                        $("#addQualModal").modal("show");
                    }
                });
            });


            $(document).on("click", ".deleteAcademicBtn", function () {
                let id = $(this).data("id");

                if (!confirm("Are you sure you want to delete this academic qualification?")) return;


                 $.ajax({
                    url: "/staff-qualifications/delete-academic/" + id,
                    method: "DELETE",
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                    },
                    success: function () {
                        loadAcademicQualifications(); // same as loadFamilyDetails()
                    },
                    error: function () {
                        alert("Delete failed.");
                    }
                });


                
            });

            // submit add qualification
            $('#addQualForm').on('submit', submitAddAcademicQualification);


            

            // delegate view detail clicks
            $('#qualTableContainer').on('click', '.viewQualBtn', function() {
                const item = $(this).attr('data-item');
                const row = JSON.parse(item.replace(/&apos;|&#39;/g, "'"));
                showAcademicQualificationDetails(row);
            });
        // === Academic Qualification integration end ===

        // === Professional Qualification integration starts ===

            function updateProfessionalSubjectOptions() {
                // Collect all selected values
                var selected = $(".professional-subject-select").map(function() {
                    return $(this).val();
                }).get();

                // For each dropdown
                $(".professional-subject-select").each(function() {
                    var currentSelect = $(this);
                    var currentValue = currentSelect.val();

                    // Enable all options first
                    currentSelect.find("option").prop("disabled", false);

                    // Disable selected options in other dropdowns
                    $(".professional-subject-select").not(currentSelect).each(function() {
                        var val = $(this).val();
                        if (val) {
                            currentSelect.find("option[value='" + val + "']").prop("disabled", true);
                        }
                    });

                    // Keep the current value enabled
                    currentSelect.find("option[value='" + currentValue + "']").prop("disabled", false);
                });
            }


            // Run on change of any subject select
            $(".professional-subject-select").on("change", updateProfessionalSubjectOptions);

            // Run on page load
            updateProfessionalSubjectOptions();

            $('#professional_marks_obtained, #professional_marks_out_of').on('blur', function() {
                const obtained = parseFloat($('#professional_marks_obtained').val());
                const outOf = parseFloat($('#professional_marks_out_of').val());

                if (isNaN(obtained) || isNaN(outOf) || outOf === 0) {
                    $('#professional_percentage').val('');
                    return;
                }

                if (obtained > outOf) {
                    $('#professional_percentage').val('Invalid: Obtained > Total');
                    return;
                }

                const percentage = ((obtained / outOf) * 100).toFixed(2);
                $('#professional_percentage').val(percentage + '%');
            });

            function setProfessionalSubjects(){
                let levelId = $("#professional_level_id").val();
                let degreeId = $("#professional_degree_id").val();
                let stateId = $("#professional_state_id").val();

                //alert(levelId+"--"+degreeId+"++"+stateId);
                $("#professional_main_subject_1").html('<option value="">Loading...</option>');
                $("#professional_main_subject_2").html('<option value="">Loading...</option>');
                $("#professional_main_subject_3").html('<option value="">Loading...</option>');

                if (!levelId || !degreeId) {
                    $("#professional_main_subject_1").html('<option value="">Select Subject</option>');
                    $("#professional_main_subject_2").html('<option value="">Select Subject</option>');
                    $("#professional_main_subject_3").html('<option value="">Select Subject</option>');
                    return;
                }       


                $.ajax({
                    url:  baseUrl+'staff-qualifications/professional-level-degree-subjects/'+ levelId+'/'+degreeId,
                    type: "GET",
                    dataType: "json",
                    success: function (response) {

                        let options = '<option value="">Select Subject</option>';

                        if (response.status === 'success' && response.data.length > 0) {
                            response.data.forEach(function (item) {
                                options += `<option value="${item.id}">${item.name}</option>`;
                            });

                        } else {
                            options = '<option value="">No Subject found</option>';
                        }

                        $("#professional_main_subject_1").html(options);
                        $("#professional_main_subject_2").html(options);
                        $("#professional_main_subject_3").html(options);

                    },
                    error: function () {
                        $("#professional_main_subject_1").html('<option value="">Error loading Subject</option>');
                        $("#professional_main_subject_2").html('<option value="">Error loading Subject</option>');
                        $("#professional_main_subject_3").html('<option value="">Error loading Subject</option>');
                    }
                });
            }
            function setProfessionalUnivercities(){
                let levelId = $("#professional_level_id").val();
                let degreeId = $("#professional_degree_id").val();
                let stateId = $("#professional_state_id").val();
               

                // Reset degrees dropdown
                $("#professional_board_university_id").html('<option value="">Loading...</option>');

                //if (!levelId || !degreeId || !stateId) {
                if (!levelId || !stateId) {
                    $("#professional_board_university_id").html('<option value="">1Select University / Board</option>');
                    return;
                }       


                $.ajax({
                    url:  baseUrl+'staff-qualifications/professional-level-degree-state-univercities/'+ levelId+'/'+stateId,
                    type: "GET",
                    dataType: "json",
                    success: function (response) {

                        let options = '<option value="">Select Board / University</option>';

                        if (response.status === 'success' && response.data.length > 0) {
                            response.data.forEach(function (item) {
                                options += `<option value="${item.id}">${item.name}</option>`;
                            });

                        } else {
                            options = '<option value="">No Board / University found</option>';
                        }

                        $("#professional_board_university_id").html(options);
                    },
                    error: function () {
                        $("#professional_board_university_id").html('<option value="">Error loading degrees</option>');
                    }
                });
            }
            $("#professional_level_id").on("change", function () {

                let levelId = $(this).val();

                // Reset degrees dropdown
                $("#professional_degree_id").html('<option value="">Loading...</option>');

                if (!levelId) {
                    $("#professional_degree_id").html('<option value="">Select Degree / Trade</option>');
                    return;
                }
                setProfessionalUnivercities();
                $.ajax({
                    url:  baseUrl+'staff-qualifications/professional-level-degrees/'+ levelId,
                    type: "GET",
                    dataType: "json",
                    success: function (response) {

                        let options = '<option value="">Select Degree / Trade</option>';

                        if (response.status === 'success' && response.data.length > 0) {
                            response.data.forEach(function (item) {
                                options += `<option value="${item.id}">${item.name}</option>`;
                            });

                        } else {
                            options = '<option value="">No degrees found</option>';
                        }

                        $("#professional_degree_id").html(options);
                    },
                    error: function () {
                        $("#professional_degree_id").html('<option value="">Error loading degrees</option>');
                    }
                });

            });

            $("#professional_state_id").on("change", function () {
                //alert("professional_state_id");
                setProfessionalUnivercities();            
            });


            $("#professional_degree_id").on("change", function () {
                //alert("professional_degree_id");
                setProfessionalSubjects();            
            });

            

            $('input[name="professional_degree_from_maharashtra"]').change(function() {
                if ($(this).val() === '1') {
                    // Yes - disable state field and set to Maharashtra
                    $('#professional_state_id').prop('disabled', true).val(27);
                    setProfessionalUnivercities()
                } else {
                    // No - enable state field and clear selection
                    $('#professional_state_id').prop('disabled', false).val('');
                }
            });

            
            // Fetch qualifications via AJAX and render table
            function loadProfessionalQualifications() {
                const url = baseUrl+'staff-qualifications/list-professional/'+sID; 
                $('#professionalTableContainer').html('<div class="text-center py-4 text-muted">Loading qualifications…</div>');

                $.ajax({
                    url: url,
                    method: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        const items = (res && res.data) ? res.data : [];
                        renderProfessionalQualificationTable(items);
                        $('#professional_level_id').empty().append('<option value="">Select Professional Level</option>');

                        // Populate options dynamically
                        res.levels.forEach(level => {
                                $('#professional_level_id').append(`<option value="${level.id}">${level.level_name}</option>`);
                        });

                        $('#professional_medium').empty().append('<option value="">Select Professional Medium</option>');

                        // Populate options dynamically
                        res.mediums.forEach(medium => {
                                $('#professional_medium').append(`<option value="${medium.id}">${medium.name}</option>`);
                        });


                        /*$('#professional_board_university_id').empty().append('<option value="">Select Board/University</option>');

                        // Populate options dynamically
                        res.universities.forEach(unv => {
                                $('#professional_board_university_id').append(`<option value="${unv.id}">${unv.name}</option>`);
                        });*/


                        $('#professional_state_id').empty().append('<option value="">Select State</option>');

                        // Populate options dynamically
                        res.states.forEach(state => {
                                $('#professional_state_id').append(`<option value="${state.id}">${state.name}</option>`);
                        });




                        
                    },
                    error: function() {
                    $('#professionalTableContainer').html('<div class="alert alert-danger text-center">Failed to load qualifications.</div>');
                    }
                });
            }

            function renderProfessionalQualificationTable(items) {
                if (!items || items.length === 0) {
                    $('#professionalTableContainer').html('<div class="text-center py-4 text-muted">No qualifications found.</div>');
                    return;
                }

                let html = `
                    <table class="table table-hover table-bordered align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                        <th style="width:60px">Sr. No.</th>
                        <th>Qualification Level</th>
                        <th>Degree / Trade</th>
                        <th>Medium</th>
                        <th>University</th>
                        <th>Result Date</th>
                        <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                `;

                items.forEach((row, i) => {
                     let professional_result_date = formatDateISO(row.professional_result_date);
                    html += `
                    <tr data-id="${row.id}">
                        <td>${i + 1}</td>
                        <td>${(row?.professional_qualification_level?.level_name || '-')}</td>  
                        <td>${(row?.professional_qualification_degree?.name || '-')}</td>                        
                        <td>${(row?.medium?.name || '-')}</td>
                        <td>${(row?.university?.name || '-')}</td>
                        <td>${professional_result_date}</td>   
                        
                        <td class="text-nowrap">
                            <button class="btn btn-sm  btn-info text-white me-2 viewQualBtn" data-item='${JSON.stringify(row).replace(/'/g,"&#39;")}'>
                                <i class="fas fa-eye"></i>
                            </button>                           
                            <button class="btn btn-sm btn-warning me-2 editProfessionalBtn" data-id="${row.id}">
                                <i class="fas fa-pencil"></i>
                            </button>

                            <button class="btn btn-sm btn-danger deleteProfessionalBtn" data-id="${row.id}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>  
                    </tr>
                    `;
                });

                html += '</tbody></table>';
                $('#professionalTableContainer').html(html);
            }


            // Show details in modal
            function showProfessionalQualificationDetails(row) {

               

                const fields = [
                    ['Qualification Level', row?.professional_qualification_level?.level_name || '-'],
                    ['Medium', row?.medium?.name || '-'],
                    ['Degree / Trade', row?.professional_qualification_degree?.name || '-'],                   
                    ['Is Degree from Maharashtra?', (row.professional_degree_from_maharashtra ? 'Yes' : 'No')],
                    ['State', row?.pavitra_state?.name || '-'],
                    ['Board / University', row?.university?.name || '-'],
                    ['Grade',  row?.professional_grade || '-'],
                    ['Passing Class',  row?.professional_class || '-'],
                    ['Marks Obtained',  row?.professional_marks_obtained || '-'],
                    ['Marks Out Of',  row?.professional_marks_out_of || '-'],
                    ['Percentage', row.professional_percentage || '-'],
                    ['Result Date', formatDateISO(row.professional_result_date) || '-']
                ];

                   
                let html = '<div class="row g-2">';
                fields.forEach(f => {
                    html += `<div class="col-6"><strong>${f[0]}:</strong><div>${f[1]}</div></div>`;
                });

                // certificate link
                if (row.certificate_url) {
                    html += `<div class="col-12 mt-3"><a href="${row.certificate_url}" target="_blank" class="btn btn-sm btn-outline-secondary">Download / View Certificate</a></div>`;
                }

                html += '</div>';
                $('#qualDetails').html(html);
                const modal = new bootstrap.Modal(document.getElementById('viewQualModal'));
                modal.show();
            }

            // Open Add modal and prepare form
            function openAddProfessionalModal() {
                $('#addProfessionalQualForm')[0].reset();
                $('#staff_id').val(staffId);
                $('#addProfessionalQualModal').modal('show');
                $('#academicError').hide();
                $("#addProfessionalQualModal .modal-title").text("Add Professional Qualification");

                $("#saveProfessionalQualificationBtn").data("mode", "add");
                $("#saveProfessionalQualificationBtn").data("id", "");

                $("#addProfessionalQualModal").modal("show");
            }


            // Submit Add Qualification (FormData for file)
            function submitAddProfessionalQualification(e) {
                e.preventDefault();

                let mode = $("#saveProfessionalQualificationBtn").data("mode");
                let id = $("#saveProfessionalQualificationBtn").data("id");
                console.log(id);
                let endPoint = mode === "add" 
                    ? "staff-qualifications/add-professional"
                    : "staff-qualifications/update-professional/" + id;
                let url = baseUrl +  endPoint;

                
                const formData = $('#addProfessionalQualForm').serializeArray();
                let payload = {};
                
                payload['staff_id'] = $("#__sid").val();
                payload['_Token'] = 'ZGVlcGFraHBhdGlsMzAwODE5ODA=';
                formData.forEach(f => payload[f.name] = f.value);
                
 
                $.ajax({
                    url: url,
                    type: "POST",
                    contentType: 'application/json', 
                    dataType: 'json',   
                    data: JSON.stringify(payload),
                    headers: {
                                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                                },
                    success: function() {
                     $('#addProfessionalQualModal').modal('hide');
                     loadProfessionalQualifications();
                    },
                    error: function() {
                        if (xhr.status === 401) { window.location.href = "/users/login";}
                    $('#saveProfessionalQualificationBtn').prop('disabled', false).text('Save Qualification');
                    alert('Server error while saving qualification.');
                    }
                });
            }
               

        
           

            // load lookups and table on ready
            //populateLookups();
            

            // add button open modal
            $('#addProfessionalQualificationBtn').on('click', openAddProfessionalModal);

            // submit add qualification
            $('#addProfessionalQualForm').on('submit', submitAddProfessionalQualification);

            // delegate view detail clicks
            $('#professionalTableContainer').on('click', '.viewQualBtn', function() {
                const item = $(this).attr('data-item');
                const row = JSON.parse(item.replace(/&apos;|&#39;/g, "'"));
                
                
                showProfessionalQualificationDetails(row);
            });

            $(document).on("click", ".editProfessionalBtn", function () {
                let id = $(this).data("id");
                $.ajax({
                    url: "/staff-qualifications/edit-professional/" + id,
                    method: "GET",
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                    },
                    success: function (response) {

                        let d = response.data;

                        $("#professionalId").val(id);
                        $("#addProfessionalQualModal .modal-title").text("Edit Professional Qualification");

                        $("#saveProfessionalQualificationBtn").data("mode", "edit");
                        $("#saveProfessionalQualificationBtn").data("id", id);


                        
                        
                        $("#professional_level_id").val(d.professional_level_id);
                        $("#professional_degree_id").val(d.professional_degree_id);
                        // professional_degree_from_maharashtra_yes professional_degree_from_maharashtra
                        //professional_degree_from_maharashtra
                        $("#professional_state_id").val(d.professional_state_id);
                        
                        $("#professional_board_university_id").val(d.professional_board_university_id);
                    
                        $("#professional_marks_obtained").val(d.professional_marks_obtained);
                        
                        $("#professional_marks_out_of").val(d.professional_marks_out_of);
                        //$("#professional_level_id").val(d.qualification_name);
                        
                        $("#professional_percentage").val(d.professional_percentage);
                        
                        $("#professional_grade").val(d.professional_grade);
                        
                        $("#professional_class").val(d.professional_class);

                        $("#professional_result_date").val(formatDateISO(d.professional_result_date));
                        
                        
                        $("#professional_medium").val(d.professional_medium);
                        $("#professional_main_subject_1").val(d.professional_main_subject_1);

                        $("#professional_main_subject_2").val(d.professional_main_subject_2);

                        $("#professional_main_subject_3").val(d.professional_main_subject_3);


                            

                        $("#addProfessionalQualModal").modal("show");
                    }
                });
            });


            
            $(document).on("click", ".deleteProfessionalBtn", function () {
                let id = $(this).data("id");

                if (!confirm("Are you sure you want to delete this Professional qualification?")) return;


                 $.ajax({
                    url: "/staff-qualifications/delete-professional/" + id,
                    method: "DELETE",
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                    },
                    success: function () {
                        loadProfessionalQualifications(); // same as loadFamilyDetails()
                    },
                    error: function () {
                        alert("Delete failed.");
                    }
                });


                
            });
        // === Professional Qualification integration end ===




        // === Training integration starts ===

            function getUdiseTrainDetails() {
                $.ajax({
                    url: baseUrl + "staffs/udise-train-details/" + staffId,
                    method: "GET",
                    dataType: "json",
                    success: function (response) {
                        let data = response.data;
                        if (currentIndex < sections.length - 1) {
                            currentIndex++;
                            updateUI();
                        }
                        console.log(data);
                        if (data && data.id > 0) {
                            if(data.trained_cwsn == 1){
                                $('#train_trained_cwsn_yes').prop('checked', true);
                            }else{
                                $('#train_trained_cwsn_no').prop('checked', true);
                            }

                            if(data.trained_cwsn == 1){
                                $('#train_trained_cwsn_yes').prop('checked', true);
                            }else{
                                $('#train_trained_cwsn_no').prop('checked', true);
                            }
                            if(data.trained_comp == 1){
                                $('#train_training_computer_yes').prop('checked', true);
                            }else{
                                $('#train_training_computer_no').prop('checked', true);
                            }        
                            //train_training_received_yes                    
                            if(data.trained_needed == 1){
                                $('#train_training_needed_yes').prop('checked', true);
                            }else{
                                $('#train_training_needed_no').prop('checked', true);
                            }
                            if(data.trained_nishtha == 1){
                                $('#train_training_nishtha_yes').prop('checked', true);
                            }else{
                                $('#train_training_nishtha_no').prop('checked', true);
                            }
                            if(data.trained_ssa_yn == 1){
                                $('#train_training_ssa_yes').prop('checked', true);
                            }else{
                                $('#train_training_ssa_no').prop('checked', true);
                            }
                            if(data.cy_sy_soc_aspect_yn == 1){
                                $('#train_trained_cwsn_yes').prop('checked', true);
                            }else{
                                $('#train_trained_cwsn_no').prop('checked', true);
                            }
                            if(data.rece_training_support_cwsn_yn == 1){
                                $('#train_psy_soc_aspect_yes').prop('checked', true);
                            }else{
                                $('#train_psy_soc_aspect_no').prop('checked', true);
                            }
                            //train_support_cwsn_yes
                        }
                    },
                    error: function () {
                        // ??????? ??????????? ?????? ?????? ?? ??? ???????, ???????? ????
                        console.error('Error loading address details.');
                    }
                });
            }
            function loadTrainingDetails() {
                if (!staffId) {
                    $('#trainingTableContainer').html('<p class="text-danger text-center py-3">Error loading training details. Staff ID not available.</p>');
                    return;
                }
                $.ajax({
                    url: baseUrl + "staff-training/lists/" + staffId,
                    method: "GET",
                    dataType: "json",
                    headers: {
                                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                                },
                    success: function (response) {
                        let data = response.data;
                        $('#training_type').empty().append('<option value="">Select Training Type</option>');
                        response.trainingType.forEach(tid => {
                                $('#training_type').append(`<option value="${tid.id}">${tid.name}</option>`);
                        });

                        $('#training_category').empty().append('<option value="">Select Training Category</option>');
                        response.trainingCategory.forEach(cid => {
                                $('#training_category').append(`<option value="${cid.id}">${cid.name}</option>`);
                        });

                        $('#training_institute').empty().append('<option value="">Select Training Institute</option>');
                        response.trainingInstitute.forEach(iid => {
                                $('#training_institute').append(`<option value="${iid.id}">${iid.name}</option>`);
                        });

                        $('#training_level').empty().append('<option value="">Select Training Level</option>');
                        response.trainingLevel.forEach(lid => {
                                $('#training_level').append(`<option value="${lid.id}">${lid.name}</option>`);
                        });
                        if (!data || data.length === 0) {
                            $('#trainingTableContainer').html(`
                                <div class="text-center py-4 text-muted">
                                <i class="bi bi-people fs-1 d-block mb-2"></i>
                                <p class="mb-0">There are no training records yet.</p>
                                </div>
                            `);
                            return;
                        }

                        let table = `
                            <table class="table table-striped table-hover align-middle">
                                <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Type</th>
                                    <th>Institute</th>
                                    <th>Level</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>`;


                                  
                        $.each(data, function (i, row) {
                            //alert(row);
                            table += `
                                <tr>
                                <td>${i + 1}</td>
                                <td>${row.training_title}</td>
                                <td>${row?.training_category?.name || '-'}</td>
                                <td>${row?.training_type?.name || '-'}</td>
                               <td>${row?.training_institute?.name || '-'}</td>
                               <td>${row?.training_level?.name || '-'}</td>                             
                                <td>${row.from_date ? new Date(row.from_date).toLocaleDateString('en-GB') : '-'}</td>
                                <td>${row.to_date ? new Date(row.to_date).toLocaleDateString('en-GB') : '-'}</td>
                                <td class="text-nowrap">
                                    <button class="btn btn-sm btn-info text-white me-2 viewTrainingBtn" 
                                            data-id="${row.id}">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                    <button class="btn btn-sm btn-warning me-2 editTrainingBtn" data-id="${row.id}">
                                        <i class="fas fa-pencil"></i>
                                    </button>

                                    <button class="btn btn-sm btn-danger deleteTrainingBtn" data-id="${row.id}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                                                            
                                </tr>`;
                        });
                        table += "</tbody></table>";
                        $('#trainingTableContainer').html(table);

                        
                    },
                    error: function () {
                        // Training Members Details -Error loading training details.
                        $('#trainingTableContainer').html('<p class="text-danger text-center py-3">Error loading training details.</p>');
                    }
                });
            }
            // 🎯 Add new member button
            $('#addTrainingBtn').on('click', function() {
                $('.modal-body .add_training_form, .modal-footer.add_training_form').hide();
                $('#trainingError').hide();                
                $("#trainingForm")[0].reset();
                $("#trainingModal .modal-title").text("Add Service Details");
                $("#saveTrainingBtn").data("mode", "add");
                $("#saveTrainingBtn").data("id", "");
                $("#trainingModal").modal("show");
            });

            $(document).on("click", ".viewTrainingBtn", function () {
                let id = $(this).data("id");

                $.ajax({
                    url: "/staff-training/edit/" + id,
                    method: "GET",
                    headers: {
                                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                                },
                    success: function(response) {
                        let d = response.data;

                        $("#v_training_type").text(d.training_type?.name || '-');
                        $("#v_training_category").text(d.training_category?.name || '-');
                        $("#v_training_institute").text(d.training_institute?.name || '-');
                        $("#v_training_level").text(d.training_level?.name || '-');
                        $("#v_training_from_date").text(
                            d.from_date ? new Date(d.from_date).toLocaleDateString('en-GB') : '-'
                        );
                        $("#v_training_to_date").text(
                            d.to_date ? new Date(d.to_date).toLocaleDateString('en-GB') : '-'
                        );
                        $("#v_training_title").text(d.training_title);                      
                        attended = certificate_awarded = 'No';
                        if(d.attended){
                             attended = 'Yes';
                        }
                        if(d.certificate_awarded){
                             certificate_awarded = 'Yes';
                        }
                        $("#v_training_attended").text(attended);
                        $("#v_training_certificate_awarded").text(certificate_awarded);

                        $("#viewTrainingModal").modal("show");
                    }
                });
            });


            $(document).on("click", ".editTrainingBtn", function () {
                let id = $(this).data("id");

                $.ajax({
                    url: "/staff-training/edit/" + id,
                    method: "GET",
                    headers: {
                                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                                },
                    success: function(response) {
                        let d = response.data;
                        
                        $("#trainingId").val(id);
                        $("#trainingModal .modal-title").text("Edit Training Details");
                        $("#saveTrainingBtn").data("mode", "edit");
                        $("#saveTrainingBtn").data("id", id);

                        $("#training_type").val(d.training_type_id);
                        $("#training_category").val(d.category_id);
                        $("#training_institute").val(d.institute_id);
                        $("#training_level").val(d.level_id);

                        $("#training_title").val(d.training_title);
                        let sd1 = flatpickr("#training_from_date", { dateFormat: "d/m/Y",allowInput: true});
                        sd1.setDate(d.from_date, true, "d/m/Y");
                        let sd2 = flatpickr("#training_to_date", { dateFormat: "d/m/Y",allowInput: true});
                        sd2.setDate(d.to_date, true, "d/m/Y");

                        if(d.attended){
                            $('#training_attended_yes').prop('checked', true);
                        }else{
                            $('#training_attended_no').prop('checked', true);
                        }

                        if(d.certificate_awarded){
                            $('#training_certificate_awarded_yes').prop('checked', true);
                        }else{
                            $('#training_certificate_awarded_no').prop('checked', true);
                        }

                        $("#trainingModal").modal("show");
                    }
                });
            });

            $(document).on("click", ".deleteTrainingBtn", function () {
                let id = $(this).data("id");

                if (!confirm("Are you sure you want to delete this training details?")) return;

                $.ajax({
                    url: "/staff-training/delete/" + id,
                    method: "POST",
                    headers: {
                                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                                },
                    success: function () {
                        loadTrainingDetails();
                    },
                    error: function () {
                        alert("Delete failed.");
                    }
                });
            });



            // 💾 Save training member
            $('#saveTrainingBtn').on('click', function() {               

                let mode = $(this).data("mode");
                let id = $(this).data("id");
                console.log(id);
                console.log("ffid=>"+$(this).data("trainingId"));
                let endPoint = mode === "add" 
                    ? "staff-training/add"
                    : "staff-training/update/" + id;
                let url = baseUrl +  endPoint;

                ///
                const formData = $('#trainingForm').serializeArray();
                let payload = {};
                
                payload['staff_id'] = $("#__sid").val();
                payload['_Token'] = 'ZGVlcGFraHBhdGlsMzAwODE5ODA=';
                formData.forEach(f => payload[f.name] = f.value);

                /*if(payload['training_member_name'] == ''){
                    $('#trainingError').show();
                    $('#trainingError').html('<p style="padding:10px;" class="text-danger text-center py-3">Please enter training memebr name.</p>');
                    return;                    
                }

                if(payload['relation_id'] == ''){
                    $('#trainingError').show();
                    $('#trainingError').html('<p style="padding:10px;" class="text-danger text-center py-3">Please Select Relation with memeber.</p>');
                    return;                    
                }
                //date_of_nominaton
                if ($("input[name='covered_under_training']:checked").val() === "true") {
                    if(payload['nominaton_percentage'] == ''){
                        $('#trainingError').show();
                        $('#trainingError').html('<p style="padding:10px;" class="text-danger text-center py-3">Please Select Relation with memeber.</p>');
                        return;                    
                    }
                }*/
 
                $.ajax({
                    url: url,
                    type: "POST",
                    contentType: 'application/json', 
                    dataType: 'json',   
                    data: JSON.stringify(payload),
                    headers: {
                                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                                },
                    success: function() {
                        $('#trainingModal').modal('hide');
                        loadTrainingDetails();
                    },
                    error: function() {
                        alert("Failed to save training details.");
                    }
                });
            });

                      
        // === Training integration end ===


        // === Service Tracking integration starts ===
            $('#work_search_udise_btn').click(function() {
                const udiseCode = $('#work_search_udise').val().trim();
                
                // Validate UDISE code
                if (!udiseCode) {
                    alert('Please enter UDISE Code');
                    return;
                }
                // Show loading state
                //$(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Searching...').prop('disabled', true);

                // Make API call
                $.ajax({
                    url: baseUrl + "school/search-by-udise/"+udiseCode,                 
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        //console.log(response.status);
                        // console.log("=========>"+response.data.udise_code);
                        //  console.log("=========>"+response.data.school_name);
                         if (response.status === 'success' && response.data.id > 0) {
                            $('.modal-body .add_work_form, .modal-footer.add_work_form').show();
                            if (response.data.udise_code) {
                                $('#work_udise').val(response.data.udise_code);
                            }
                            if (response.data.school_name) {
                                $('#work_school').val(response.data.school_name);
                            }

                            $('#work_school_post').empty().append('<option value="">Select Post/Designation</option>');

                            response.posts.forEach(post => {
                                    $('#work_school_post').append(`<option value="${post.id}">${post.name}</option>`);
                            });

                            $('#work_school_aid_type').empty().append('<option value="">Select School Aid Type</option>');

                            response.aidedTypes.forEach(aid => {
                                    $('#work_school_aid_type').append(`<option value="${aid.id}">${aid.name}</option>`);
                            });

                             $('#work_school_category').empty().append('<option value="">Select School Category</option>');

                            response.schoolCategories.forEach(cid => {
                                    $('#work_school_category').append(`<option value="${cid.code}">${cid.desc_in}</option>`);
                            });

                            
                         }
                    },
                    error: function(xhr, status, error) {
                        // Reset button
                        //$('#work_search_udise_btn').html('Search').prop('disabled', false);
                        
                        // Handle error
                        console.error('API Error:', error);
                        alert('Error fetching school data: ' + (xhr.responseJSON?.message || error));
                    }
                });
            });

            // Allow Enter key to trigger search
            $('#work_search_udise').keypress(function(e) {
                if (e.which === 13) { // Enter key
                    $('#work_search_udise_btn').click();
                }
            });  
            
            function loadWorkDetails() {
                if (!staffId) {
                    $('#workTableContainer').html('<p class="text-danger text-center py-3">Error loading work details. Staff ID not available.</p>');
                    return;
                }
                $.ajax({
                    url: baseUrl + "staff-work/lists/" + staffId,
                    method: "GET",
                    dataType: "json",
                    headers: {
                                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                                },
                    success: function (response) {
                        let data = response.data;
                        if (!data || data.length === 0) {
                            $('#workTableContainer').html(`
                                <div class="text-center py-4 text-muted">
                                <i class="bi bi-people fs-1 d-block mb-2"></i>
                                <p class="mb-0">There are no work records yet.</p>
                                </div>
                            `);
                            return;
                        }

                        let table = `
                            <table class="table table-striped table-hover align-middle">
                                <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>School Name</th>
                                    <th>School Aid Type</th>
                                    <th>School Category</th>
                                    <th>Post</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                     <th>Actions</th>

                                </tr>
                                </thead>
                                <tbody>
                        `;

                        $.each(data, function (i, row) {
                            //alert(row);
                            table += `
                                <tr>
                                <td>${i + 1}</td>
                                <td>${row.school_name}</td>
                                <td>${row?.aided_type?.name || '-'}</td>
                                <td>${row?.school_category?.desc_in || '-'}</td>
                                <td>${row?.post?.name || '-'}</td>                             
                                <td>${row.start_date ? new Date(row.start_date).toLocaleDateString('en-GB') : '-'}</td>
                                <td>${row.end_date ? new Date(row.end_date).toLocaleDateString('en-GB') : '-'}</td>
                                <td class="text-nowrap">
                                    <button class="btn btn-sm btn-info text-white me-2 viewWorkBtn" 
                                            data-id="${row.id}">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                    <button class="btn btn-sm btn-warning me-2 editWorkBtn" data-id="${row.id}">
                                        <i class="fas fa-pencil"></i>
                                    </button>

                                    <button class="btn btn-sm btn-danger deleteWorkBtn" data-id="${row.id}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                                                            
                                </tr>`;
                        });
                        table += "</tbody></table>";
                        $('#workTableContainer').html(table);
                    },
                    error: function () {
                        // Work Members Details -Error loading work details.
                        $('#workTableContainer').html('<p class="text-danger text-center py-3">Error loading work details.</p>');
                    }
                });
            }
            // 🎯 Add new member button
            $('#addWorkBtn').on('click', function() {
                $('.modal-body .add_work_form, .modal-footer.add_work_form').hide();
                $('#workError').hide();                
                $("#workForm")[0].reset();
                $("#workModal .modal-title").text("Add Service Details");
                $("#saveWorkBtn").data("mode", "add");
                $("#saveWorkBtn").data("id", "");
                $("#workModal").modal("show");
            });

            $(document).on("click", ".viewWorkBtn", function () {
                let id = $(this).data("id");

                $.ajax({
                    url: "/staff-work/edit/" + id,
                    method: "GET",
                    headers: {
                                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                                },
                    success: function(response) {
                        let d = response.data;

                        $("#v_school_udise").text(d.school_udise || '-');
                        $("#v_school_name").text(d.school_name || '-');
                        $("#v_school_aid_type").text(d.aided_type?.name || '-');
                        $("#v_school_category").text(d.school_category?.desc_in || '-');
                        $("#v_post").text(d.post?.name || '-');

                        $("#v_start_date").text(
                            d.start_date ? new Date(d.start_date).toLocaleDateString('en-GB') : '-'
                        );

                        $("#v_end_date").text(
                            d.end_date ? new Date(d.end_date).toLocaleDateString('en-GB') : '-'
                        );

                      
                        school_change_mode = d.school_leving_mode;
                        work_in_pesa = work_in_diff_area = 'No';
                        if(d.work_in_pesa){
                             work_in_pesa = 'Yes';
                        }

                        if(d.work_in_diff_area){
                             work_in_diff_area = 'Yes';
                        }

                        $("#v_work_in_pesa").text(work_in_pesa);
                        $("#v_work_in_diff_area").text(work_in_diff_area);
                        $("#v_school_change_mode").val(school_change_mode);

                        $("#viewWorkModal").modal("show");
                    }
                });
            });


            $(document).on("click", ".editWorkBtn", function () {
                let id = $(this).data("id");

                $.ajax({
                    url: "/staff-work/edit/" + id,
                    method: "GET",
                    headers: {
                                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                                },
                    success: function(response) {
                        let d = response.data;
                        
                        $("#workId").val(id);
                        $("#workModal .modal-title").text("Edit Service Details");
                        $("#saveWorkBtn").data("mode", "edit");
                        $("#saveWorkBtn").data("id", id);


                         $('#work_school_post').empty().append('<option value="">Select Post/Designation</option>');

                        response.posts.forEach(post => {
                                $('#work_school_post').append(`<option value="${post.id}">${post.name}</option>`);
                        });

                        $('#work_school_aid_type').empty().append('<option value="">Select School Aid Type</option>');

                        response.aidedTypes.forEach(aid => {
                                $('#work_school_aid_type').append(`<option value="${aid.id}">${aid.name}</option>`);
                        });

                            $('#work_school_category').empty().append('<option value="">Select School Category</option>');

                        response.schoolCategories.forEach(cid => {
                                $('#work_school_category').append(`<option value="${cid.code}">${cid.desc_in}</option>`);
                        });



                        $("#work_udise").val(d.school_udise);
                        $("#work_school").val(d.school_name);
                        $("#work_school_aid_type").val(d.school_aid_type_id);
                        $("#work_school_category").val(d.school_category_id);
                        $("#work_school_post").val(d.post_id);
                        let sd1 = flatpickr("#work_school_from_date", { dateFormat: "d/m/Y",allowInput: true});
                        sd1.setDate(d.start_date, true, "d/m/Y");
                        let sd2 = flatpickr("#work_school_to_date", { dateFormat: "d/m/Y",allowInput: true});
                        sd2.setDate(d.end_date, true, "d/m/Y");
                        $("#work_school_is_pesa").val(d.work_in_pesa);
                        $("#work_school_is_difficult_area").val(d.work_in_diff_area);
                        $("#work_school_change_reason").val(d.school_leving_mode);

                        $("#workModal").modal("show");
                    }
                });
            });

            $(document).on("click", ".deleteWorkBtn", function () {
                let id = $(this).data("id");

                if (!confirm("Are you sure you want to delete this work member?")) return;

                $.ajax({
                    url: "/staff-work/delete/" + id,
                    method: "POST",
                    headers: {
                                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                                },
                    success: function () {
                        loadWorkDetails();
                    },
                    error: function () {
                        alert("Delete failed.");
                    }
                });
            });



            // 💾 Save work member
            $('#saveWorkBtn').on('click', function() {

               

                let mode = $(this).data("mode");
                let id = $(this).data("id");
                console.log(id);
                console.log("ffid=>"+$(this).data("workId"));
                let endPoint = mode === "add" 
                    ? "staff-work/add"
                    : "staff-work/update/" + id;
                let url = baseUrl +  endPoint;

                ///
                const formData = $('#workForm').serializeArray();
                let payload = {};
                
                payload['staff_id'] = $("#__sid").val();
                payload['_Token'] = 'ZGVlcGFraHBhdGlsMzAwODE5ODA=';
                formData.forEach(f => payload[f.name] = f.value);

                if(payload['work_member_name'] == ''){
                    $('#workError').show();
                    $('#workError').html('<p style="padding:10px;" class="text-danger text-center py-3">Please enter work memebr name.</p>');
                    return;                    
                }

                if(payload['relation_id'] == ''){
                    $('#workError').show();
                    $('#workError').html('<p style="padding:10px;" class="text-danger text-center py-3">Please Select Relation with memeber.</p>');
                    return;                    
                }
                //date_of_nominaton
                /*if ($("input[name='covered_under_work']:checked").val() === "true") {
                    if(payload['nominaton_percentage'] == ''){
                        $('#workError').show();
                        $('#workError').html('<p style="padding:10px;" class="text-danger text-center py-3">Please Select Relation with memeber.</p>');
                        return;                    
                    }
                }*/
 
                $.ajax({
                    url: url,
                    type: "POST",
                    contentType: 'application/json', 
                    dataType: 'json',   
                    data: JSON.stringify(payload),
                    headers: {
                                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                                },
                    success: function() {
                        $('#workModal').modal('hide');
                        loadWorkDetails();
                    },
                    error: function() {
                        alert("Failed to save work member.");
                    }
                });
            });
        // === Service Tracking integration starts ===

        // === Rewards integration starts ===            
            
            function loadRewardDetails() {
                if (!staffId) {
                    $('#rewardTableContainer').html('<p class="text-danger text-center py-3">Error loading reward details. Staff ID not available.</p>');
                    return;
                }
                $.ajax({
                    url: baseUrl + "staff-reward/lists/" + staffId,
                    method: "GET",
                    dataType: "json",
                    headers: {
                                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                                },
                    success: function (response) {
                        let data = response.data;
                        
                        if (!data || data.length === 0) {
                            $('#rewardTableContainer').html(`
                                <div class="text-center py-4 text-muted">
                                <i class="bi bi-people fs-1 d-block mb-2"></i>
                                <p class="mb-0">There are no reward records yet.</p>
                                </div>
                            `);
                            return;
                        }
                         
                        let table = `
                            <table class="table table-striped table-hover align-middle">
                                <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Year of Awarda</th>
                                    <th>Reward Title</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>`;


                                  
                        $.each(data, function (i, row) {
                            //alert(row);
                            table += `
                                <tr>
                                <td>${i + 1}</td>
                                <td>${row.yoa}</td>
                                <td>${row?.award || '-'}</td>
                                <td class="text-nowrap">
                                    <button class="btn btn-sm btn-info text-white me-2 viewRewardBtn" 
                                            data-id="${row.id}">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                    <button class="btn btn-sm btn-warning me-2 editRewardBtn" data-id="${row.id}">
                                        <i class="fas fa-pencil"></i>
                                    </button>

                                    <button class="btn btn-sm btn-danger deleteRewardBtn" data-id="${row.id}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                                                            
                                </tr>`;
                        });
                        table += "</tbody></table>";
                        $('#rewardTableContainer').html(table);

                        
                    },
                    error: function () {
                        // Reward Members Details -Error loading reward details.
                        $('#rewardTableContainer').html('<p class="text-danger text-center py-3">Error loading reward details.</p>');
                    }
                });
            }
            // 🎯 Add new member button
            $('#addRewardBtn').on('click', function() {
                $('.modal-body .add_reward_form, .modal-footer.add_reward_form').hide();
                $('#rewardError').hide();                
                $("#rewardForm")[0].reset();
                $("#rewardModal .modal-title").text("Add Service Details");
                $("#saveRewardBtn").data("mode", "add");
                $("#saveRewardBtn").data("id", "");
                $("#rewardModal").modal("show");
            });

            $(document).on("click", ".viewRewardBtn", function () {
                let id = $(this).data("id");

                $.ajax({
                    url: "/staff-reward/edit/" + id,
                    method: "GET",
                    headers: {
                                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                                },
                    success: function(response) {
                        let d = response.data;
                        $("#v_reward_year").text(d.yoa || '-');
                        $("#v_reward").text(d.award || '-');

                        $("#viewRewardModal").modal("show");
                    }
                });
            });


            $(document).on("click", ".editRewardBtn", function () {
                let id = $(this).data("id");

                $.ajax({
                    url: "/staff-reward/edit/" + id,
                    method: "GET",
                    headers: {
                                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                                },
                    success: function(response) {
                        let d = response.data;
                        
                        $("#rewardId").val(id);
                        $("#rewardModal .modal-title").text("Edit Reward Details");
                        $("#saveRewardBtn").data("mode", "edit");
                        $("#saveRewardBtn").data("id", id);

                        $("#reward_year").val(d.yoa);
                        $("#reward").val(d.award);

                        $("#rewardModal").modal("show");
                    }
                });
            });

            $(document).on("click", ".deleteRewardBtn", function () {
                let id = $(this).data("id");

                if (!confirm("Are you sure you want to delete this reward details?")) return;

                $.ajax({
                    url: "/staff-reward/delete/" + id,
                    method: "POST",
                    headers: {
                                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                                },
                    success: function () {
                        loadRewardDetails();
                    },
                    error: function () {
                        alert("Delete failed.");
                    }
                });
            });



            // 💾 Save reward member
            $('#saveRewardBtn').on('click', function() {               

                let mode = $(this).data("mode");
                let id = $(this).data("id");
                console.log(id);
                console.log("ffid=>"+$(this).data("rewardId"));
                let endPoint = mode === "add" 
                    ? "staff-reward/add"
                    : "staff-reward/update/" + id;
                let url = baseUrl +  endPoint;

                ///
                const formData = $('#rewardForm').serializeArray();
                let payload = {};
                
                payload['staff_id'] = $("#__sid").val();
                payload['_Token'] = 'ZGVlcGFraHBhdGlsMzAwODE5ODA=';
                formData.forEach(f => payload[f.name] = f.value);

               
 
                $.ajax({
                    url: url,
                    type: "POST",
                    contentType: 'application/json', 
                    dataType: 'json',   
                    data: JSON.stringify(payload),
                    headers: {
                                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                                },
                    success: function() {
                        $('#rewardModal').modal('hide');
                        loadRewardDetails();
                    },
                    error: function() {
                        alert("Failed to save reward details.");
                    }
                });
            });


            /*
            function loadRewards() {
                const url = baseUrl+'staff-qualifications/list-academic/'+sID; 
                $('#rewardTableContainer').html('<div class="text-center py-4 text-muted">Loading Rewards...</div>');

                $.ajax({
                    url: url,
                    method: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        const items = (res && res.data) ? res.data : [];
                        renderAcademicQualificationTable(items);                        
                    },
                    error: function() {
                    $('#rewardTableContainer').html('<div class="alert alert-danger text-center">Failed to load Rewards.</div>');
                    }
                });
            }

            function renderRewardsTable(items) {
                if (!items || items.length === 0) {
                    $('#rewardTableContainer').html('<div class="text-center py-4 text-muted">No Rewards found.</div>');
                    return;
                }

                let html = `
                    <table class="table table-hover table-bordered align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                        <th style="width:60px">Sr. No.</th>
                        <th>Rewards</th>
                        </tr>
                    </thead>
                    <tbody>
                `;

                items.forEach((row, i) => {
                    html += `
                    <tr data-id="${row.id}">
                        <td>${i + 1}</td>
                        <td>${(row?.reward || '-')}</td>  
                    </tr>
                    `;
                });

                html += '</tbody></table>';
                $('#rewardTableContainer').html(html);
            }

            

            // Open Add modal and prepare form
            function openRewardAddModal() {
                $('#addRewardForm')[0].reset();
                $('#staff_id').val(staffId);
                $('#addRewardModal').modal('show');
            }

            function submitReward(e) {
                e.preventDefault();
                const form = document.getElementById('addRewardForm');

                if (!form.checkValidity()) {
                    form.classList.add('was-validated');
                    return;
                }

                const formData = $('#addRewardForm').serializeArray();
                let payload = {};
                
                payload['staff_id'] = $("#__sid").val();
                payload['_Token'] = 'ZGVlcGFraHBhdGlsMzAwODE5ODA=';
                formData.forEach(f => payload[f.name] = f.value);
                 



                $.ajax({
                url: baseUrl + "staff-qualifications/add-academic",
                type: "POST",
                contentType: 'application/json', 
                dataType: 'json',   
                data: JSON.stringify(payload),
                headers: {
                                'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                            },
                success: function() {
                     $('#addQualModal').modal('hide');
                     loadRewards();
                    

                },
                error: function(xhr) {
                            if (xhr.status === 401) { window.location.href = "/users/login";}
                    $('#saveRewardBtn').prop('disabled', false).text('Save Qualification');
                    alert('Server error while saving qualification.');
                    }

                
                    
                });
            }

        
            

            // load lookups and table on ready
            //populateLookups();
            

            // add button open modal
            $('#addRewardBtn').on('click', openRewardAddModal);

            // submit add qualification
            $('#addRewardForm').on('submit', submitReward);
            */
            
        // === Rewards integration end ===

        // === Disciplinary Actions integration starts ===

            
            function loadDisciplinaryActions() {
                const url = baseUrl+'staff-disciplinary-action/lists/'+sID; 
                $('#disciplinaryActionTableContainer').html('<div class="text-center py-4 text-muted">Loading Disciplinary Actions...</div>');

                $.ajax({
                    url: url,
                    method: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        const items = (res && res.data) ? res.data : [];
                        renderDisciplinaryActionTable(items);                        
                    },
                    error: function() {
                    $('#disciplinaryActionTableContainer').html('<div class="alert alert-danger text-center">Failed to load Disciplinary Actions.</div>');
                    }
                });
            }

          

            

            // Open Add modal and prepare form
            function openDisciplinaryActionAddModal() {
                $('#addDisciplinaryActionForm')[0].reset();
                $('#staff_id').val(staffId);
                $('#addDisciplinaryActionModal').modal('show');
            }

            function submitDisciplinaryAction(e) {
                e.preventDefault();
                const form = document.getElementById('addDisciplinaryActionForm');

                if (!form.checkValidity()) {
                    form.classList.add('was-validated');
                    return;
                }

                const formData = $('#addDisciplinaryActionForm').serializeArray();
                let payload = {};
                
                payload['staff_id'] = $("#__sid").val();
                payload['_Token'] = 'ZGVlcGFraHBhdGlsMzAwODE5ODA=';
                formData.forEach(f => payload[f.name] = f.value);
                 



                $.ajax({
                url: baseUrl + "staff-disciplinary-action/add",
                type: "POST",
                contentType: 'application/json', 
                dataType: 'json',   
                data: JSON.stringify(payload),
                headers: {
                                'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                            },
                success: function() {
                     $('#addDisciplinaryActionModal').modal('hide');
                     loadDisciplinaryActions();
                    

                },
                error: function(xhr) {
                            if (xhr.status === 401) { window.location.href = "/users/login";}
                    $('#saveDisciplinaryActionBtn').prop('disabled', false).text('Save Qualification');
                    alert('Server error while saving qualification.');
                    }

                
                    
                });
            }

            $(document).on("click", ".deleteDisciplinaryActions", function () {
                let id = $(this).data("id");

                if (!confirm("Are you sure you want to delete this Disciplinary Action?")) return;

                $.ajax({
                    url: "/staff-disciplinary-action/delete/" + id,
                    method: "DELETE",
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                    },
                    success: function () {
                        loadDisciplinaryActions(); // same as loadFamilyDetails()
                    },
                    error: function () {
                        alert("Delete failed.");
                    }
                });
            });

        

            // load lookups and table on ready
            //populateLookups();
            

            // add button open modal
            $('#addDisciplinaryActionBtn').on('click', openDisciplinaryActionAddModal);

            // submit add qualification
            $('#addDisciplinaryActionForm').on('submit', submitDisciplinaryAction);

            
        // === Disciplinary Actions integration end ===





        // === Final Confirmation integration starts ===
            // Step 1 - Confirmation Button
            $('#confirmBtn').click(function() {
                const otpModal = new bootstrap.Modal(document.getElementById('otpModal'));
                otpModal.show();
            });

            // Step 2 - OTP Validation
            $('#verifyOtpBtn').click(function() {
                let otp = $('#otpInput').val().trim();
                if (otp.length === 6 && /^\d+$/.test(otp)) {
                    $('#otpModal').modal('hide');
                    setTimeout(() => {
                    const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                    successModal.show();
                    }, 400);
                } else {
                    alert('Please enter a valid 6-digit OTP.');
                }
            });
        // === Final Confirmation integration end ===


        // === Navigation integration starts ===
            const sID = $("#__sid").val();
            const uMD = $("#__umode").val();
            // Sidebar menu
            $('.menu-btn').on('click', function () {
                $(this).siblings('.submenu').slideToggle();
                $(this).find('span').toggleClass('active');
            });

            // Tab navigation
            /*var sections = [
                "Personal Details", "Address Details", "Other Personal Details", "Family Details", "Nomination Details",
                "Caste Category & Certification", "Disability Details",
                "Academic Qualifications", "Professional Qualifications", "UDISE Qualification Details", "TET/CTET Details",
                "Initial Appointment", "Teaching Details (UDISE)", "Service Tracking", "Attach / Detach", "Superannuation", "Death Cases",
                "Pay Details", "PF/DCPS/GPF", "Bank Account", "Leave Details", "Rewards",
                "Training Attended", "Disciplinary Actions", "Complaints"
            ];*/
             var sections = [
                "Personal Details", "Address Details", "Other Personal Details", "Family & Nomination",
                "Caste Category & Certification", "Disability Details",
                "Academic Qualifications", "Professional Qualifications", "UDISE Qualification Details", "TET/CTET Details",
                  "Service Tracking", 
                "Pay Details", "PF/DCPS/GPF", "Bank Account", "Leave Details", "Rewards",
                "Training Attended", "Disciplinary Actions", "Confirmation"
            ];
            var modules = [
                "Basic Information", "Caste & Disability", "Qualifications", "Employment Details", "Financial & Benefits", "Training & Compliance"
            ];
            var currentIndex = 0;

            function toCamelCase(str) {
                 return str
                    .split(" ")
                    .map(word => word.charAt(0).toUpperCase() + word.slice(1))
                    .join(" ");
            }



            function raiseError(fieldName){               
                msg = 'Please correct '+ toCamelCase(fieldName) +' and try again.';
                $('#validation_message').html(msg);
                var myModal = new bootstrap.Modal(document.getElementById('errorModal'));
                myModal.show();       
                return false;
            } 

            function raiseErrorMsg(msg){
                $('#validation_message').html(msg);
                var myModal = new bootstrap.Modal(document.getElementById('errorModal'));
                myModal.show();       
                return false;
            } 


            
            function isEmpty(value) {
                return value === undefined || value === null || value === "" || value === "0";
            }


            function checkFutureDate (value,fieldName,afterThis,afterThisMsg){                                        
                let parts = value.split('/');
                if (parts.length !== 3) {
                    raiseErrorMsg('Invalid date format for '+fieldName+'. Use dd/mm/yyyy');
                    return -1;
                }

                let day   = parseInt(parts[0], 10);
                let month = parseInt(parts[1], 10) - 1;
                let year  = parseInt(parts[2], 10);

                let selectedDate = new Date(year, month, day);
                let today = new Date();
                today.setHours(0,0,0,0);

                // Validate actual date
                if (
                    selectedDate.getDate() !== day ||
                    selectedDate.getMonth() !== month ||
                    selectedDate.getFullYear() !== year
                ) {
                    raiseErrorMsg('Invalid date entered for '+fieldName+'.');
                    return -2;
                }

                if (selectedDate > today) {
                    raiseErrorMsg('Future date is not allowed for '+fieldName+'.');
                    return -3
                }

                if(afterThis !== ''){
                    let partsAfterThis = afterThis.split('/');
                    if (partsAfterThis.length !== 3) {
                        raiseErrorMsg('Invalid date format for '+fieldName+'. Use dd/mm/yyyy');
                        return -1;
                    }

                    let day   = parseInt(partsAfterThis[0], 10);
                    let month = parseInt(partsAfterThis[1], 10) - 1;
                    let year  = parseInt(partsAfterThis[2], 10);

                    let selectedDateAfterThis = new Date(year, month, day);
                    let today = new Date();
                    today.setHours(0,0,0,0);
                    if (selectedDate < selectedDateAfterThis) {
                        raiseErrorMsg(afterThisMsg);
                        return -3
                    }
                }
                return 1;
            }

            function getSectionId(normalizedSection) {
                return normalizedSection.replace(/-/g, '_') + '_section';
            }

            window.formatDate = function(input) {
                let d = new Date(input);
                return ("0" + d.getDate()).slice(-2) + "/" +
                    ("0" + (d.getMonth() + 1)).slice(-2) + "/" +
                    d.getFullYear();
            }


            window.formatDateISO = function(dateString) {

                if(isEmpty(dateString)) return '-';
                let d = new Date(dateString);

                return ("0" + d.getDate()).slice(-2) + "/" +
                    ("0" + (d.getMonth() + 1)).slice(-2) + "/" +
                    d.getFullYear();
            }

            




            function loadCasteCategories(){
                 $.ajax({
                        url: '<?= $this->Url->build(["controller" => "staff-caste", "action" => "details"]); ?>'+'/'+sID,
                        type: 'GET',
                        contentType: 'application/json', 
                        dataType: 'json',                
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                        },                        
                        beforeSend: function() {
                            $('#responseMessage').html('<span class="text-info"><div class="text-info d-flex align-items-center"><div class="spinner-border spinner-border-sm me-2" role="status"></div><span>Processing...</span></div></span>');
                        },
                        success: function(response) {
                            
                            if (currentIndex < sections.length - 1) {
                                currentIndex++;
                                updateUI();
                            }
                            $('#religion').empty().append('<option value="">Select Religion</option>');

                            // Populate options dynamically
                            response.religions.forEach(relg => {
                                    $('#religion').append(`<option value="${relg.id}">${relg.name}</option>`);
                            });

                            $('#caste').empty().append('<option value="">Select Caste</option>');

                            // Populate options dynamically
                            response.castes.forEach(cst => {
                                    $('#caste').append(`<option value="${cst.id}">${cst.caste_desc}</option>`);
                            });


                            let data = response.data;
                            if (data && data.id > 0) { 
                                for (const [key, value] of Object.entries(data)) {
                                    //console.log(`${key}: ${value}`);
                                    if(key=='certificate_date'){
                                       $("#certificate_date").val(formatDateISO(value));
                                    }else if(key=='certificate_validation_date'){
                                        $("#certificate_validation_date").val(formatDateISO(value));
                                    }else{
                                        $("#"+key).val(value);
                                    }
                                    
                                }
                            }
                            
                            
                        },           
                        error: function(xhr) {
                            if (xhr.status === 401) { window.location.href = "/users/login";}
                            $('#processingModal').hide();
                            let msg = "Unexpected error";
                            try {
                                const json = JSON.parse(xhr.responseText);
                                msg = json.message || xhr.statusText;
                            } catch(e) {
                                msg = xhr.statusText;
                            }
                            $('#responseMessage').html('<span class="text-danger">Error: ' + msg + '</span>');
                            $('#submitBtn').show();
                        }
                    });
            }
            // Update content and breadcrumb
            function updateUI() {
                $(".content-section").removeClass("active").hide();
                $("#content-section-" + currentIndex).addClass("active").show();

                var sectionText = sections[currentIndex];
                $("#breadcrumbTrail li:last-child").text(sectionText);

                if((currentIndex>=0) && (currentIndex<=4)){
                $("#breadcrumbTrail li:eq(-2)").text(modules[0]);
                }else if((currentIndex>=5) && (currentIndex<=6)){
                $("#breadcrumbTrail li:eq(-2)").text(modules[1]);
                }else if((currentIndex>=7) && (currentIndex<=10)){
                $("#breadcrumbTrail li:eq(-2)").text(modules[2]);
                }else if((currentIndex>=11) && (currentIndex<=12)){
                $("#breadcrumbTrail li:eq(-2)").text(modules[3]);
                }else if((currentIndex>=13) && (currentIndex<=17)){
                $("#breadcrumbTrail li:eq(-2)").text(modules[4]);
                }else if((currentIndex>=18) && (currentIndex<=19)){
                $("#breadcrumbTrail li:eq(-2)").text(modules[5]);
                }else if(currentIndex==20){
                $("#breadcrumbTrail li:eq(-2)").text('Final Approval');
                }

                $("#prevBtn").prop("disabled", currentIndex === 0);
                $("#nextBtn").prop("disabled", currentIndex === sections.length - 1);
            }

            window.leftMenuClick = function(idx){
                currentIndex=idx;
                updateUI();
            }
            function updatePersonalDetails(){                 
                    let is_form_data_change = false;
                    let currentSectionData = $("#content-section-form-0").serialize();
                    if (currentSectionData !== window.initPersonalDetails) { is_form_data_change = true; }else{getAddressDetails(); return false;}
                    let staff_name = $('#staff_name').val();
                    let staff_name_adhar = $('#staff_name_adhar').val();
                    let dob = $("#dob").val();
                    let gender = $("#gender").val();
                    let aadhar = $("#aadhar").val();
                    let mobile = $("#mobile").val();

                    let email = $('#email').val();
                    let current_post = $('#current_post').val();
                    let post_group = $("#post_group").val();
                    let post_aid = $("#post_aid").val();
                    let appointment_for_subject_1 = $("#appointment_for_subject_1").val();
                    let appointment_for_subject_2 = $("#appointment_for_subject_2").val();
                    let recruitment_mode = $('#recruitment_mode').val();
                    let initial_post = $('#initial_post').val();
                    let recruitment_subject = $("#recruitment_subject").val();
                    let recruitment_category = $("#recruitment_category").val();
                    let recruitment_hor_category = $("#recruitment_hor_category").val();
                    let recruitment_ph_category = $("#recruitment_ph_category").val();

                    let recruitment_orphan_category = $('#recruitment_orphan_category').val();
                    let recruitment_appointment_nature = $('#recruitment_appointment_nature').val();
                    let joining_date = $("#joining_date").val();
                    let joining_school = $("#joining_school").val();
                    let superannuation = $("#superannuation").val();
                    let shikshan_sevak = $('input[name="shikshan_sevak"]:checked').val();
                    let joining_district = $("#joining_district").val();
                    let joining_block = $("#joining_block").val();
                    let joining_designation = $("#joining_designation").val();
                    let joining_mgmt = $("#joining_mgmt").val();

                    if(isEmpty(staff_name)){ raiseError('staff name'); return false;}
                    if(isEmpty(staff_name_adhar)){ raiseError('staff name as per aadhar'); return false;}
                    if(isEmpty(dob)){ raiseError('date of birth'); return false;}
                    if(isEmpty(gender)){ raiseError('gender'); return false;}
                    if(isEmpty(aadhar)){ raiseError('aadhar card number'); return false;}
                    if(isEmpty(mobile)){ raiseError('mobile Number'); return false;}
                    
                    if(isEmpty(email)){ raiseError('email ID'); return false;}
                    //if(isEmpty(current_post)){ raiseError('Current Post / Designation'); return false;}
                    if(isEmpty(post_group)){ raiseError('Current Post Group'); return false;}
                    if(isEmpty(post_aid)){ raiseError('Current Post Aid Type'); return false;}

                    if(isEmpty(appointment_for_subject_1)){ raiseError('Current Teaching Subject 1'); return false;}
                    //if(isEmpty(appointment_for_subject_2)){ raiseError('Current Teaching Subject 2'); return false;}

                    if(isEmpty(recruitment_mode)){ raiseError('Mode of Recruitment'); return false;}
                    if(isEmpty(initial_post)){ raiseError('Post of Initial Appointment'); return false;}
                    //if(isEmpty(recruitment_subject)){ raiseError('Recruitment Subject'); return false;}
                    if(isEmpty(recruitment_category)){ raiseError('Recruitment Category'); return false;}
                    if(isEmpty(recruitment_hor_category)){ raiseError('Recruitment Hor. Category'); return false;}
                    if(isEmpty(recruitment_ph_category)){ raiseError('Recruitment PH. Details'); return false;}
                    if(isEmpty(recruitment_orphan_category)){ raiseError('Recruitment Orphan Details'); return false;}
                    //if(isEmpty(recruitment_appointment_nature)){ raiseError('Nature of Appointment'); return false;}
                    //if(isEmpty(shikshan_sevak)){ raiseError('Shikshan Sevak (Probation)'); return false;}
                    if(!((shikshan_sevak==1) || (shikshan_sevak==0))){ raiseError('Shikshan Sevak (Probation)'); return false;}
                    if(isEmpty(joining_date)){ raiseError('Date of Entry in Service'); return false;}
                    
                    returnValue = checkFutureDate(joining_date,'Entry in Service','','');                    
                    if(!returnValue){return false;}

                    if(isEmpty(joining_district)){ raiseError('Date of Joining District'); return false;}
                    returnValue = checkFutureDate(joining_district,'Joining District',joining_date,'District joining date must be after the Service joining date.');                      
                    if(returnValue != 1){return false;}
                    if(isEmpty(joining_block)){ raiseError('Date of Joining Block'); return false;}
                    returnValue = checkFutureDate(joining_block,'Joining Block',joining_district,'Block joining date must be after the District joining date.');                      
                    if(returnValue != 1){return false;}
                    if(isEmpty(joining_mgmt)){ raiseError('Date of Joining Current Management'); return false;}
                    returnValue = checkFutureDate(joining_mgmt,'Joining Management',joining_block,'Management joining date must be after the Block joining date.');                      
                    if(returnValue != 1){return false;}
                    if(isEmpty(joining_school)){ raiseError('Date of Joining Current School'); return false;}
                    returnValue = checkFutureDate(joining_school,'Joining School',joining_mgmt,'School joining date must be after the Management joining date.');                      
                    if(returnValue != 1){return false;}
                    if(isEmpty(joining_designation)){ raiseError('Date of Joining Current Designation'); return false;}
                    returnValue = checkFutureDate(joining_designation,'Joining Designation',joining_date,'Designation joining date must be after the Service joining date.');                      
                    if(returnValue != 1){return false;}
                    if(isEmpty(superannuation)){ raiseError('Superannuation Date'); return false;}

             
                    if(is_form_data_change){
                        if (!confirm("Are you sure you want to save your data?")) {
                            return false; 
                        }
                    }

                    payload = {           
                            staff_id: sID,
                            appointment_for_subject_1: appointment_for_subject_1,
                            appointment_for_subject_2: appointment_for_subject_2,
                            recruitment_mode:recruitment_mode,
                            initial_post:initial_post,
                            recruitment_hor_category:recruitment_hor_category,
                            recruitment_ph_category:recruitment_ph_category,
                            recruitment_orphan_category:recruitment_orphan_category,
                            shikshan_sevak: shikshan_sevak,
                            joining_district: joining_district,
                            joining_block: joining_block,
                            joining_designation: joining_designation,
                            joining_mgmt: joining_mgmt,
                            _Token:'ZGVlcGFraHBhdGlsMzAwODE5ODA='
                        };

                    $.ajax({
                        url: '<?= $this->Url->build(["controller" => "staffs", "action" => "update-personal-details"]); ?>',
                        type: 'POST',
                        contentType: 'application/json', 
                        dataType: 'json',                
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                        },
                        data: JSON.stringify(payload),
                        beforeSend: function() {
                            
                            //$('#processingModal').show();
                            //alert(11)
                            $('#responseMessage').html('<span class="text-info"><div class="text-info d-flex align-items-center"><div class="spinner-border spinner-border-sm me-2" role="status"></div><span>Processing...</span></div></span>');
                        },
                        success: function(response, status, xhr) {
                            if (xhr.getResponseHeader("X-Session-Expired") === "1") {
                                //alert("Session expired. Please login again.");
                                window.location.href = "/users/login";
                            }
                          
                            window.initPersonalDetails = $("#content-section-form-0").serialize();
                            getAddressDetails();                           
                           
                            
                        },           
                        error: function(xhr) {
                            if (xhr.status === 401) { window.location.href = "/users/login";}
                            $('#processingModal').hide();
                            let msg = "Unexpected error";
                            try {
                                const json = JSON.parse(xhr.responseText);
                                msg = json.message || xhr.statusText;
                            } catch(e) {
                                msg = xhr.statusText;
                            }
                            $('#responseMessage').html('<span class="text-danger">Error: ' + msg + '</span>');
                            $('#submitBtn').show();
                        }
                    });
            }

            function updateAaddressDetails(){
                    let is_form_data_change = false;
                    let currentSectionData = $("#content-section-form-1").serialize();
                    if (currentSectionData !== window.initAddressDetails) { is_form_data_change = true; }else{getOtherDetails();return false;}
                    
                    let permanent_address_line1 = $("#permanent_address_line1").val();
                    let permanent_address_line2 = $("#permanent_address_line2").val(); 
                    let permanent_landmark = $("#permanent_landmark").val();
                    let permanent_village_id = $("#permanent_village_id").val(); 
                    let permanent_block_id = $("#permanent_block_id").val();
                    let permanent_district_id = $("#permanent_district_id").val(); 
                    let permanent_state_id = $("#permanent_state_id").val();
                    let permanent_pincode = $("#permanent_pincode").val();     

                    let current_address_line1 = $("#current_address_line1").val();
                    let current_address_line2 = $("#current_address_line2").val(); 
                    let current_landmark = $("#current_landmark").val();
                    let current_village_id = $("#current_village_id").val(); 
                    let current_block_id = $("#current_block_id").val();
                    let current_district_id = $("#current_district_id").val(); 
                    let current_state_id = $("#current_state_id").val();
                    let current_pincode = $("#current_pincode").val();                     

                    if(isEmpty(permanent_address_line1)){ raiseError('Permanent Address Line 1'); return false;}
                    if(isEmpty(permanent_address_line2)){ raiseError('Permanent Address Line 2'); return false;}
                    if(isEmpty(permanent_district_id)){ raiseError('Permanent District'); return false;}
                    if(isEmpty(permanent_block_id)){ raiseError('Permanent Block / Taluka'); return false;}
                    if(isEmpty(permanent_village_id)){ raiseError('Permanent Village / Town'); return false;}
                    if(isEmpty(permanent_pincode)){ raiseError('Permanent Pincode'); return false;}



                    const regex = /^(40|41|42|43|44)\d{4}$/;

                    if (!regex.test(permanent_pincode)) {raiseError('Permanent Pincode'); return false;}



                    if(isEmpty(current_address_line1)){ raiseError('Current Address Line 1'); return false;}
                    if(isEmpty(current_address_line2)){ raiseError('Current Address Line 2'); return false;}
                    if(isEmpty(current_district_id)){ raiseError('Current District'); return false;}
                    if(isEmpty(current_block_id)){ raiseError('Current Block / Taluka'); return false;}
                    if(isEmpty(current_village_id)){ raiseError('Current Village / Town'); return false;}
                    if(isEmpty(current_pincode)){ raiseError('Current Pincode'); return false;}
                    if (!regex.test(current_pincode)) {raiseError('Current Pincode'); return false;}
             
                    if(is_form_data_change){
                        if (!confirm("Are you sure you want to save your data?")) {
                            return false; 
                        }
                    }


                    
                    payload = {           
                            staff_id: sID,
                            permanent_address_line1: permanent_address_line1,
                            permanent_address_line2: permanent_address_line2,
                            permanent_landmark: permanent_landmark,
                            permanent_village_id: permanent_village_id,
                            permanent_block_id: permanent_block_id,
                            permanent_district_id: permanent_district_id,
                            permanent_state_id: permanent_state_id,
                            permanent_pincode:permanent_pincode,
                            current_address_line1: current_address_line1,
                            current_address_line2: current_address_line2,
                            current_landmark: current_landmark,
                            current_village_id: current_village_id,
                            current_block_id: current_block_id,
                            current_district_id: current_district_id,
                            current_state_id: current_state_id,
                            current_pincode:current_pincode,
                            _Token:'ZGVlcGFraHBhdGlsMzAwODE5ODA='
                        };
                    $.ajax({
                        url: '<?= $this->Url->build(["controller" => "staffs", "action" => "update-address-details"]); ?>',
                        type: 'POST',
                        contentType: 'application/json', 
                        dataType: 'json',                
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                        },
                        data: JSON.stringify(payload),
                        beforeSend: function() {
                            $('#responseMessage').html('<span class="text-info"><div class="text-info d-flex align-items-center"><div class="spinner-border spinner-border-sm me-2" role="status"></div><span>Processing...</span></div></span>');
                        },
                        success: function(response) {    
                           
                            window.initAddressDetails = $("#content-section-form-1").serialize();
                            getOtherDetails();
                           
                            
                            
                        },           
                        error: function(xhr) {
                            if (xhr.status === 401) { window.location.href = "/users/login";}
                            $('#processingModal').hide();
                            let msg = "Unexpected error";
                            try {
                                const json = JSON.parse(xhr.responseText);
                                msg = json.message || xhr.statusText;
                            } catch(e) {
                                msg = xhr.statusText;
                            }
                            $('#responseMessage').html('<span class="text-danger">Error: ' + msg + '</span>');
                            $('#submitBtn').show();
                        }
                    });
            }

            function updateOtherDetails(){
                    let is_form_data_change = false;
                    let currentSectionData = $("#content-section-form-2").serialize();
                    if (currentSectionData !== window.initOtherDetails) { is_form_data_change = true; }else{
                        //getOtherDetails();
                        // return false;
                        }

                    /*let domicile = $("input[name='domicile']:checked").val();
                    let border_village = $("input[name='border_village']:checked").val();
                    let suicide_farmer_child = $("input[name='suicide_farmer_child']:checked").val();
                    let non_vremy = $("input[name='non_vremy']:checked").val();
                    let freedom_fighter_ward = $("input[name='freedom_fighter_ward']:checked").val();
                    let election_1991 = $("input[name='election_1991']:checked").val();
                    let election_1994 = $("input[name='election_1994']:checked").val();*/
                    let no_of_non_teaching_working_days = $("#no_of_non_teaching_working_days").val();
                    let capable_handling_digital = $("input[name='capable_handling_digital']:checked").val();
                    let teacher_deputation_school = $("input[name='teacher_deputation_school']:checked").val();
                    let teaching_other_school = $("input[name='teaching_other_school']:checked").val();
                    let mother_tongue = $("#mother_tongue").val();
                    let blood_group = $("#blood_group").val(); 
                    let height = $("#height").val(); 
                    let weight = $("#weight").val(); 
                    let identification_mark1 = $("#identification_mark1").val(); 
                    let identification_mark2 = $("#identification_mark2").val();               

                    let election_card = $("#election_card").val();
                    let ex_servicemen = $("input[name='ex_servicemen']:checked").val();
                    let lang1 = $("#lang1").val();
                    let lang2 = $("#lang2").val();
                    let lang3 = $("#lang3").val();

                    /*if (!domicile) { raiseError('Domicile of Maharashtra?'); return false;}
             
                    if(is_form_data_change){
                        if (!confirm("Are you sure you want to save your data?")) {
                            return false; 
                        }
                    }*/
                    let payload = {};
                    payload['staff_id'] = sID;
                    payload['_Token'] = 'ZGVlcGFraHBhdGlsMzAwODE5ODA=';
                    /*payload['domicile'] = domicile;
                    payload['border_village'] = border_village;
                    payload['suicide_farmer_child'] = suicide_farmer_child;
                    payload['non_vremy'] = non_vremy;
                    payload['freedom_fighter_ward'] = freedom_fighter_ward;
                    payload['election_1991'] = election_1991;
                    payload['election_1994'] = election_1994;*/
                    payload['mother_tongue'] = mother_tongue;
                    payload['blood_group'] = blood_group;
                    payload['election_card'] = election_card;
                    payload['ex_servicemen'] = ex_servicemen;
                    payload['height'] = height;
                    payload['weight'] = weight, 
                    payload['lang1'] = lang1;
                    payload['lang2'] = lang2;
                    payload['lang3'] = lang3;
                    payload['identification_mark1'] = identification_mark1;
                    payload['identification_mark2'] = identification_mark2;
                    payload['no_of_non_teaching_working_days'] = no_of_non_teaching_working_days;
                    payload['capable_handling_digital'] = capable_handling_digital;
                    payload['teacher_deputation_school'] = teacher_deputation_school;
                    payload['teaching_other_school'] = teaching_other_school;
                    

                    //console.log(JSON.stringify(payload, null, 2));           
                    $.ajax({
                        url: '<?= $this->Url->build(["controller" => "staffs", "action" => "update-other-personal-details"]); ?>',
                        type: 'POST',
                        contentType: 'application/json', 
                        dataType: 'json',                
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                        },
                        data: JSON.stringify(payload),
                        beforeSend: function() {
                            $('#responseMessage').html('<span class="text-info"><div class="text-info d-flex align-items-center"><div class="spinner-border spinner-border-sm me-2" role="status"></div><span>Processing...</span></div></span>');
                        },
                        success: function(response) {
                             window.initOtherDetails = $("#content-section-form-2").serialize();
                            if (currentIndex < sections.length - 1) {
                                currentIndex++;
                                updateUI();
                                loadFamilyDetails();
                            }
                            
                        },           
                        error: function(xhr) {
                            if (xhr.status === 401) { window.location.href = "/users/login";}
                            $('#processingModal').hide();
                            let msg = "Unexpected error";
                            try {
                                const json = JSON.parse(xhr.responseText);
                                msg = json.message || xhr.statusText;
                            } catch(e) {
                                msg = xhr.statusText;
                            }
                            $('#responseMessage').html('<span class="text-danger">Error: ' + msg + '</span>');
                            $('#submitBtn').show();
                        }
                    });
                    
            }




            $("#prevBtn").on("click", function () {
                if (currentIndex > 0) {
                    currentIndex--;
                    updateUI();
                }
            });


           
          

            
            $("#nextBtn").on("click", function () {
                //alert(sections[currentIndex])

                let normalizedSection = sections[currentIndex].toLowerCase().replace(/\s+/g, '-');
                console.log("clickMe=>"+normalizedSection);//PF/DCPS/GPF
                //alert(normalizedSection);
                if (normalizedSection === 'personal-details') {
                    updatePersonalDetails();
                }else if(normalizedSection === 'address-details') {
                    updateAaddressDetails();                    
                }else if(normalizedSection === 'other-personal-details') {
                    updateOtherDetails();        
                }else if(normalizedSection === 'family-&-nomination'){
                     loadCasteCategories();
                    /*if (currentIndex < sections.length - 1) {
                        currentIndex++;
                        updateUI();
                       
                    } */                 
                }/*else if(normalizedSection === 'nomination-details'){                    
                    let nominationData = [];
                    let totalPercentage = 0;
                    $('input[name^="nomination_percentage"]').each(function() {
                        let name = $(this).attr('name');
                        let match = name.match(/\[(.*?)\]/); // safely extract id
                        if (match) {
                            let id = match[1];

                            let date = $(`input[name="date_of_nomination[${id}]"]`).val();
                            let percentage = parseInt($(`input[name="nomination_percentage[${id}]"]`).val() || 0);
                            if(percentage>0){
                                totalPercentage += percentage;
                                nominationData.push({
                                    id: id,
                                    date_of_nomination: date,
                                    nomination_percentage: percentage
                                });
                            }
                        }
                    });

                   

                   
                }*/else if(normalizedSection === 'caste-category-&-certification'){
                    let payload = {};
                    payload['staff_id'] = sID;
                    payload['_Token'] = 'ZGVlcGFraHBhdGlsMzAwODE5ODA=';
                    $.each($('#content-section-4 form').serializeArray(), function(_, kv) {
                            payload[kv.name] = kv.value;
                    });

                    //console.log(JSON.stringify(payload, null, 2));           
                    $.ajax({
                        url: '<?= $this->Url->build(["controller" => "staff-caste", "action" => "update"]); ?>',
                        type: 'POST',
                        contentType: 'application/json', 
                        dataType: 'json',                
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                        },
                        data: JSON.stringify(payload),
                        beforeSend: function() {
                            $('#responseMessage').html('<span class="text-info"><div class="text-info d-flex align-items-center"><div class="spinner-border spinner-border-sm me-2" role="status"></div><span>Processing...</span></div></span>');
                        },
                        success: function(response) {
                            
                            if (currentIndex < sections.length - 1) {
                                currentIndex++;
                                updateUI();                                
                            }

                            $.ajax({
                                url: '<?= $this->Url->build(["controller" => "staff-disability", "action" => "details"]); ?>'+'/'+sID,
                                type: 'GET',
                                contentType: 'application/json', 
                                dataType: 'json',                
                                headers: {
                                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                                },                        
                                beforeSend: function() {
                                    $('#responseMessage').html('<span class="text-info"><div class="text-info d-flex align-items-center"><div class="spinner-border spinner-border-sm me-2" role="status"></div><span>Processing...</span></div></span>');
                                },
                                success: function(response) {
                                    
                                    /*if (currentIndex < sections.length - 1) {
                                        currentIndex++;
                                        updateUI();
                                    }*/
                                    /*$('#religion').empty().append('<option value="">Select Religion</option>');

                                    // Populate options dynamically
                                    response.religions.forEach(relg => {
                                            $('#religion').append(`<option value="${relg.id}">${relg.name}</option>`);
                                    });

                                    $('#caste').empty().append('<option value="">Select Caste</option>');
                                    
                                    // Populate options dynamically
                                    response.castes.forEach(cst => {
                                            $('#caste').append(`<option value="${cst.id}">${cst.caste_desc}</option>`);
                                    });*/
                                    if (response && response.data && typeof response.data === 'object' && !Array.isArray(response.data)) {

                                        for (const [key, value] of Object.entries(response.data)) {
                                            //console.log(`${key}: ${value}`);
                                            $("#"+key).val(value);
                                        }
                                    }
                                    
                                    
                                },           
                                error: function(xhr) {
                            if (xhr.status === 401) { window.location.href = "/users/login";}
                                    $('#processingModal').hide();
                                    let msg = "Unexpected error";
                                    try {
                                        const json = JSON.parse(xhr.responseText);
                                        msg = json.message || xhr.statusText;
                                    } catch(e) {
                                        msg = xhr.statusText;
                                    }
                                    $('#responseMessage').html('<span class="text-danger">Error: ' + msg + '</span>');
                                    $('#submitBtn').show();
                                }
                            });
                            
                        },           
                        error: function(xhr) {
                            if (xhr.status === 401) { window.location.href = "/users/login";}
                            $('#processingModal').hide();
                            let msg = "Unexpected error";
                            try {
                                const json = JSON.parse(xhr.responseText);
                                msg = json.message || xhr.statusText;
                            } catch(e) {
                                msg = xhr.statusText;
                            }
                            $('#responseMessage').html('<span class="text-danger">Error: ' + msg + '</span>');
                            $('#submitBtn').show();
                        }
                    }); 
                   //
                }else if(normalizedSection === 'disability-details'){
                    let payload = {};
                    payload['staff_id'] = sID;
                    payload['_Token'] = 'ZGVlcGFraHBhdGlsMzAwODE5ODA=';
                    $.each($('#content-section-6 form').serializeArray(), function(_, kv) {
                            payload[kv.name] = kv.value;
                    });

                    //console.log(JSON.stringify(payload, null, 2));           
                    $.ajax({
                        url: '<?= $this->Url->build(["controller" => "staff-disability", "action" => "update"]); ?>',
                        type: 'POST',
                        contentType: 'application/json', 
                        dataType: 'json',                
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                        },
                        data: JSON.stringify(payload),
                        beforeSend: function() {
                            $('#responseMessage').html('<span class="text-info"><div class="text-info d-flex align-items-center"><div class="spinner-border spinner-border-sm me-2" role="status"></div><span>Processing...</span></div></span>');
                        },
                        success: function(response) {
                            
                            if (currentIndex < sections.length - 1) {
                                currentIndex++;
                                updateUI();
                                 loadAcademicQualifications();
                                
                            }

                            /*$.ajax({
                                url: '<?= $this->Url->build(["controller" => "staff-disability", "action" => "details"]); ?>'+'/'+sID,
                                type: 'GET',
                                contentType: 'application/json', 
                                dataType: 'json',                
                                headers: {
                                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                                },                        
                                beforeSend: function() {
                                    $('#responseMessage').html('<span class="text-info"><div class="text-info d-flex align-items-center"><div class="spinner-border spinner-border-sm me-2" role="status"></div><span>Processing...</span></div></span>');
                                },
                                success: function(response) {
                                    
                                    if (currentIndex < sections.length - 1) {
                                        currentIndex++;
                                        updateUI();
                                    }
                                    

                                    for (const [key, value] of Object.entries(response.data)) {
                                        //console.log(`${key}: ${value}`);
                                        $("#"+key).val(value);
                                    }
                                    
                                    
                                },           
                                error: function(xhr) {
                            if (xhr.status === 401) { window.location.href = "/users/login";}
                                    $('#processingModal').hide();
                                    let msg = "Unexpected error";
                                    try {
                                        const json = JSON.parse(xhr.responseText);
                                        msg = json.message || xhr.statusText;
                                    } catch(e) {
                                        msg = xhr.statusText;
                                    }
                                    $('#responseMessage').html('<span class="text-danger">Error: ' + msg + '</span>');
                                    $('#submitBtn').show();
                                }
                            });*/
                            
                        },           
                        error: function(xhr) {
                            if (xhr.status === 401) { window.location.href = "/users/login";}
                            $('#processingModal').hide();
                            let msg = "Unexpected error";
                            try {
                                const json = JSON.parse(xhr.responseText);
                                msg = json.message || xhr.statusText;
                            } catch(e) {
                                msg = xhr.statusText;
                            }
                            $('#responseMessage').html('<span class="text-danger">Error: ' + msg + '</span>');
                            $('#submitBtn').show();
                        }
                    }); 

                }else if(normalizedSection === 'academic-qualifications'){

                    if (currentIndex < sections.length - 1) {
                        currentIndex++;
                        updateUI();
                        loadProfessionalQualifications();
                    }
                   
                }else if(normalizedSection === 'professional-qualifications'){
                    getUdiseQualDetails();   
                }else if(normalizedSection === 'udise-qualification-details'){    
                    if (currentIndex < sections.length - 1) {
                        currentIndex++;
                        updateUI();
                        loadStaffTetResults();
                    }   
                }else if(normalizedSection === 'tet/ctet-details'){
                    if (currentIndex < sections.length - 1) {
                        currentIndex++;
                        updateUI();
                        loadWorkDetails();
                    }
                  
                }/*else if(normalizedSection === 'service-tracking'){
                    //getPayDetails();
                  
                }*/else if(normalizedSection === 'pay-details'){
                    getPfGpfDetails();
                  
                }else if(normalizedSection === 'pf/dcps/gpf'){                   
                    getBankAccountDetails();
                   
                }else if(normalizedSection === 'bank-account'){
                    getLeaveDetails();
                    
                   
                }else if(normalizedSection === 'leave-details'){
                    updateLeaveDetails();
                    

                    if (currentIndex < sections.length - 1) {
                        currentIndex++;
                        updateUI();
                        //getBankAccountDetails();
                    }                  
                
                }else if(normalizedSection === 'rewards'){
                    getUdiseTrainDetails();      
                    loadTrainingDetails();            
                }else{
                    if (currentIndex < sections.length - 1) {
                        currentIndex++;
                        updateUI();
                    }
                }

                //alert(normalizedSection);
                
                


            
                
            });

            /*$('.date-field').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true,
                todayHighlight: true
            });*/

            updateUI();
        // === Navigation integration end ===
    });
</script>

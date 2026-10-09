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

</style>

        <style>
        /* small UI polish */
        #qualTableContainer .table td, #qualTableContainer .table th { vertical-align: middle; }
        .modal .modal-header { border-bottom: 1px solid rgba(0,0,0,0.05); }
        </style>
 <?php 
    //dd($staff);
    if(!empty($staff->photo_base64)){
        $imgData="data:image/jpeg;base64,".$staff->photo_base64;
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

    $css->is_uid_verified                = $cssUD;
    $css->social_category                = $cssUD;
    $css->disability_type                = $cssUD;

    $readFlag->is_uid_verified           = 'disabled';
    $readFlag->social_category           = 'disabled';
    $readFlag->disability_type           = 'disabled';

    if($updateMode == 2){
        $css->upload_photo          = $cssSH;
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
        $css->bank->acc_name                = $cssSH; 
        $css->bank->acc_number              = $cssSH;  
        $css->bank->ifsc                    = $cssSH;
        $css->bank->micr                    = $cssSH;  

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



        $readFlag->upload_photo             = 'disabled';
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

        $readFlag->pf->acc_type                 = 'disabled';
        $readFlag->pf->acc_maintained_by        = 'disabled';
        $readFlag->pf->series                   = 'disabled';
        $readFlag->pf->gpf_account_no           = 'disabled';

        $readFlag->bank->bank_name               = 'disabled';  
        $readFlag->bank->branch_name             = 'disabled';  
        $readFlag->bank->acc_name                = 'disabled';  
        $readFlag->bank->acc_number              = 'disabled';  
        $readFlag->bank->ifsc                    = 'disabled';  
        $readFlag->bank->micr                    = 'disabled'; 


        $readFlag->train->trained_cwsn                    = 'disabled';
        $readFlag->train->training_computer               = 'disabled';
        $readFlag->train->training_received               = 'disabled';
        $readFlag->train->training_needed                 = 'disabled';
        $readFlag->train->training_nishtha                = 'disabled';
        $readFlag->train->training_ssa                    = 'disabled';
        $readFlag->train->psy_soc_aspect                  = 'disabled';
        $readFlag->train->support_cwsn                    = 'disabled';

    }elseif($updateMode == 1){
        $css->is_uid_verified                = $cssUD;
        $css->social_category                = $cssUD;

        $readFlag->is_uid_verified           = 'disabled';
        $readFlag->social_category           = 'disabled';
    }

?>

<input type="hidden" id="__sid" value="<?= h($staff->id) ?>">
<input type="hidden" id="__umode" value="<?= h($updateMode) ?>">
<main id="main-content" style="padding-top:20px;">
    <div class="container-fluid">
        <div class="container">
            <div class="card profile-card" role="region" aria-labelledby="profileTitle">
                <div class="card shadow-sm profile-card-horizontal" style="background:#f1f1f1;border:0px;border-radius: 0px;">
                    <div class="card-body d-flex align-items-center" style="padding:10px;">
                        <div class="avatar bg-primary text-white rounded-circle me-3 d-flex justify-content-center align-items-center"
                            style="width:60px; height:60px; font-size:28px;">

                            <img src="<?= h($imgData) ?>" alt="Profile" class="rounded-circle" style="width:60px; height:60px;"/>
                        </div>
                        <div class="flex-grow-1">
                            <div class="row g-1 small">
                                <div class="col-md-4">
                                    <h6 class="mb-1 fw-bold"><?= h($staff->emp_name ?? '') ?></h6>
                                </div>
                               <div class="col-md-4">
                               <strong>Designation:</strong> <?= h($staff->current_post ?? '') ?>
                                </div>
                                <div class="col-md-2">
                                    <strong>Staff Type:</strong> <?= h($staff->emp_type ?? '') ?> 
                                </div>
                                <div class="col-md-2">
                                    <strong>NationalID:</strong> <?= h($staff->nat_tch_id ?? '') ?> 
                                </div>
                                <div class="col-md-4" style="font-size:12px;">
                                    Joining &rarr;
                                    <strong> Service:</strong> <?= h(!empty($staff->joining_date) ? date('d/m/Y', strtotime($staff->joining_date)) : '') ?>
                                    
                                    |
                                    <strong> School:</strong> <?= h(!empty($staff->date_of_joining_current_school) ? date('d/m/Y', strtotime($staff->date_of_joining_current_school)) : '') ?>
                                
                                </div>
                                <div class="col-md-2">
                                    <strong>Mobile:</strong> <?= h($staff->mobile ?? '') ?>
                                </div>                         
                                
                                <div class="col-md-2">
                                    <strong>Gender:</strong> <?= h($staff->gender ?? '') ?>
                                </div>
                                <div class="col-md-2">
                                    <strong>Category:</strong> <?= h($staff->social_category_id ?? '') ?>
                                </div>
                                <div class="col-md-2">
                                    <strong>ShalarthID:</strong> <?= h($staff->shalarth_code ?? '') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="layout-container">
                    <div class="profilecontainer">
                        <nav class="sidebar">
                            <button class="btn close-btn" onclick="toggleSidebar()"><i class="fas fa-times"></i></button>
                            <ul class="menu">
                                <li class="menu-item">
                                    <button class="menu-btn"><span><i class="fa-solid fa-user"></i> Basic Information</span> ▾</button>
                                    <ul class="submenu">
                                        <li><a href="#content-section-0" data-breadcrumb="Basic Information → Personal Details">Personal Details</a></li>
                                        <li><a href="#content-section-1" data-breadcrumb="Basic Information → Address Details">Address Details</a></li>
                                        <li><a href="#content-section-2"data-breadcrumb="Basic Information → Other Personal Details">Other Personal Details</a></li>
                                        <li><a href="#content-section-3"data-breadcrumb="Basic Information → Family Details">Family Details</a></li>
                                        <li><a href="#content-section-4"data-breadcrumb="Basic Information → Nomination Details">Nomination Details</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item">
                                    <button class="menu-btn"><span><i class="fa-solid fa-id-card"></i> Caste & Disability</span> ▾</button>
                                    <ul class="submenu">
                                        <li><a href="#content-section-5" data-breadcrumb="Caste & Disability → Caste Category & Certification">Caste Category & Certification</a></li>
                                        <li><a href="#content-section-6" data-breadcrumb="Caste & Disability → Disability Details">Disability Details</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item">
                                    <button class="menu-btn"><span><i class="fa-solid fa-graduation-cap"></i> Qualifications</span> ▾</button>
                                    <ul class="submenu">
                                        <li><a href="#content-section-7" data-breadcrumb="Qualifications → Academic Qualifications">Academic Qualifications</a></li>
                                        <li><a href="#content-section-8" data-breadcrumb="Qualifications → Professional Qualifications">Professional Qualifications</a></li>
                                        <li><a href="#content-section-9" data-breadcrumb="Qualifications → UDISE Qualification Details">UDISE Qualification Details</a></li>
                                        <li><a href="#content-section-10" data-breadcrumb="Qualifications → TET/CTET Details">TET/CTET Details</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item">
                                    <button class="menu-btn"><span><i class="fa-solid fa-briefcase"></i> Other Details</span> ▾</button>
                                    <ul class="submenu">
                                        <li><a href="#content-section-11" data-breadcrumb="Other Details → Initial Appointment">Initial Appointment</a></li>
                                        <li><a href="#content-section-12" data-breadcrumb="Other Details → Teaching Details (UDISE)">Teaching Details (UDISE)</a></li>
                                        <li><a href="#content-section-13" data-breadcrumb="Other Details → Service Tracking">Service Tracking</a></li>
                                        <li><a href="#content-section-14" data-breadcrumb="Other Details → Attach / Detach">Attach / Detach</a></li>
                                        <li><a href="#content-section-15" data-breadcrumb="Other Details → Superannuation">Superannuation</a></li>
                                        <li><a href="#content-section-16" data-breadcrumb="Other Details → Death Cases">Death Cases</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item">
                                    <button class="menu-btn"><span><i class="fa-solid fa-sack-dollar"></i> Financial & Benefits</span> ▾</button>
                                    <ul class="submenu">
                                        <li><a href="#content-section-17" data-breadcrumb="Financial & Benefits → Pay Details">Pay Details</a></li>
                                        <li><a href="#content-section-18" data-breadcrumb="Financial & Benefits → PF/DCPS/GPF">PF/DCPS/GPF</a></li>
                                        <li><a href="#content-section-19" data-breadcrumb="Financial & Benefits → Bank Account">Bank Account</a></li>
                                        <li><a href="#content-section-20" data-breadcrumb="Financial & Benefits → Leave Details">Leave Details</a></li>
                                        <li><a href="#content-section-21" data-breadcrumb="Financial & Benefits → Rewards">Rewards</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item">
                                    <button class="menu-btn"><span><i class="fa-solid fa-chalkboard-teacher"></i> Training & Compliance</span> ▾</button>
                                    <ul class="submenu">
                                        <li><a href="#content-section-22" data-breadcrumb="Training & Compliance → Training Attended">Training Attended</a></li>
                                        <li><a href="#content-section-23" data-breadcrumb="Training & Compliance → Disciplinary Actions">Disciplinary Actions</a></li>
                                        <li><a href="#content-section-24" data-breadcrumb="Training & Compliance → Complaints">Complaints</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                        <main class="content">
                            <div class="d-flex justify-content-between align-items-center" style="background: radial-gradient(#868f96, #7b96a9ff);color: white;">
                                <nav aria-label="breadcrumb" class="p-2 shadow-sm mb-3" >
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
                                    <button id="prevBtn" class="btn btn-secondary me-2 " disabled>
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
                                    <form class="row g-3">
                                        <?php if($updateMode != 2){ ?>
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm  required-field <?= h($css->upload_photo) ?>">
                                                <label for="upload_photo" class="form-label fw-semibold">Upload Photo</label>
                                                <input type="file" class="form-control" id="upload_photo" name="upload_photo" accept="image/*" <?= h($readFlag->upload_photo) ?>>
                                            </div>
                                        </div>
                                        <?php } ?>

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
                                            <div class="custom-box border rounded-3 p-3 shadow-sm  required-field <?= h($css->dob ?? '') ?>">
                                                <label for="dob" class="form-label fw-semibold">Date of Birth</label>
                                                <input class="form-control" type="text" id="dob" name="dob" value="<?= h(!empty($staff->dob) ? date('d/m/Y', strtotime($staff->dob)) : '') ?>"  <?= h($readFlag->dob) ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm  required-field <?= h($css->gender ?? '') ?>">
                                                <label for="gender" class="form-label fw-semibold">Gender</label>
                                                <input class="form-control" type="text" id="gender" name="gender" value="<?= h($staff->gender ?? '') ?>"  <?= h($readFlag->gender) ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm  required-field <?= h($css->aadhar ?? '') ?>">
                                                <label for="aadhar" class="form-label fw-semibold">Aadhaar Card Number</label>
                                                <input class="form-control" type="text" id="aadhar" name="aadhar" value="<?= h($staff->adhar_no ?? '') ?>"  <?= h($readFlag->aadhar) ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm  required-field <?= h($css->mobile ?? '') ?>">
                                                <label for="mobile" class="form-label fw-semibold">Mobile Number</label>
                                                <input class="form-control" type="text" id="mobile" name="mobile" value="<?= h($staff->mobile ?? '') ?>"  <?= h($readFlag->mobile) ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm  required-field <?= h($css->email ?? '') ?>">
                                                <label for="email" class="form-label fw-semibold">Email ID</label>
                                                <input class="form-control" type="text" id="email" name="email" value="<?= h($staff->email ?? '') ?>"  <?= h($readFlag->email) ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm  required-field <?= h($css->current_post ?? '') ?>">
                                                <label for="current_post" class="form-label fw-semibold">Current Post / Designation</label>
                                                <input class="form-control" type="text" id="current_post" name="current_post" value="<?= h($staff->current_post ?? '') ?>"  <?= h($readFlag->current_post) ?>>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm  required-field <?= h($css->post_group ?? '') ?>">
                                                <label for="post_group" class="form-label fw-semibold">Current Post Group</label>
                                                <input class="form-control" type="text" id="post_group" name="post_group" value="<?= h($staff->desig_grp ?? '') ?>"  <?= h($readFlag->post_group) ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm  required-field <?= h($css->post_aid ?? '') ?>">
                                                <label for="post_aid" class="form-label fw-semibold">Current Post Aid Type</label>
                                                <input class="form-control" type="text" id="post_aid" name="post_aid" value="<?= h($staff->current_post_aid_type ?? '') ?>"  <?= h($readFlag->post_aid) ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm  required-field <?= h($css->recruitment_subject ?? '') ?>">
                                                <label for="recruitment_subject" class="form-label fw-semibold">Recruitment Subject</label>
                                                <input class="form-control" type="text" id="recruitment_subject" name="recruitment_subject" value="<?= h($staff->subject ?? '') ?>"  <?= h($readFlag->recruitment_subject) ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm  required-field <?= h($css->posting_mode ?? '') ?>">
                                                <label for="posting_mode" class="form-label fw-semibold">Current Posting Mode</label>
                                                <input class="form-control" type="text" id="posting_mode" name="posting_mode" value="<?= h($staff->post_type ?? '') ?>"  <?= h($readFlag->posting_mode) ?>>
                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm  required-field <?= h($css->shikshan_sevak ?? '') ?>">
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

                                        


                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm  required-field <?= h($css->joining_date ?? '') ?>">
                                                <label for="joining_date" class="form-label fw-semibold">Date of Entry in Service</label>
                                                <input class="form-control date-field" type="text" id="joining_date" name="joining_date" value="<?= h(!empty($staff->joining_date) ? date('d/m/Y', strtotime($staff->joining_date)) : '') ?>"  <?= h($readFlag->joining_date) ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            
                                            <div class="custom-box border rounded-3 p-3 shadow-sm  required-field <?= h($css->joining_district ?? '') ?>">
                                                <label for="joining_district" class="form-label fw-semibold">Date of Joining District</label>
                                                <input class="form-control date-field" type="text" id="joining_district" class="form-control date-field" name="joining_district" value="<?= h(!empty($staff->date_of_joining_current_district) ? date('d/m/Y', strtotime($staff->date_of_joining_current_district)) : '') ?>" placeholder="dd/mm/yyyy" <?= h($readFlag->joining_district) ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm  required-field <?= h($css->joining_block ?? '') ?>">
                                                <label for="joining_block" class="form-label fw-semibold">Date of Joining Block</label>
                                             <input class="form-control date-field" type="text" id="joining_block" class="form-control date-field" name="joining_block" value="<?= h(!empty($staff->date_of_joining_current_block) ? date('d/m/Y', strtotime($staff->date_of_joining_current_block)) : '') ?>" placeholder="dd/mm/yyyy" <?= h($readFlag->joining_block) ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->joining_mgmt ?? '') ?>">
                                                <label for="joining_mgmt" class="form-label fw-semibold">Date of Joining Current Management</label>
                                                <input class="form-control date-field" type="text" id="joining_mgmt" class="form-control date-field" name="joining_mgmt" value="<?= h(!empty($staff->joining_mgmt) ? date('d/m/Y', strtotime($staff->joining_mgmt)) : '') ?>" placeholder="dd/mm/yyyy" <?= h($readFlag->joining_mgmt) ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm  required-field <?= h($css->joining_school ?? '') ?>">
                                                <label for="joining_school" class="form-label fw-semibold">Date of Joining Current School</label>
                                                <input class="form-control date-field" type="text" id="joining_school" class="form-control date-field" name="joining_school" value="<?= h(!empty($staff->date_of_joining_current_school) ? date('d/m/Y', strtotime($staff->date_of_joining_current_school)) : '') ?>" placeholder="dd/mm/yyyy" <?= h($readFlag->joining_school) ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm required-field <?= h($css->joining_designation ?? '') ?>">

                                                
   
                                                <label for="joining_designation" class="form-label fw-semibold">Date of Joining Current Designation</label>
                                                <input class="form-control date-field" type="text" id="joining_designation" class="form-control date-field" name="joining_designation" value="<?= h(!empty($staff->date_of_joining_current_post) ? date('d/m/Y', strtotime($staff->date_of_joining_current_post)) : '') ?>" placeholder="dd/mm/yyyy" <?= h($readFlag->joining_designation) ?>>
                                            </div>
                                        </div>
                                        

                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm  required-field <?= h($css->superannuation ?? '') ?>">
                                                <label for="superannuation" class="form-label fw-semibold">Superannuation Date</label>
                                                <input class="form-control date-field" type="text" id="superannuation" class="form-control date-field" name="superannuation" value="<?= h(!empty($staff->super_ann_date) ? date('d/m/Y', strtotime($staff->super_ann_date)) : '') ?>" placeholder="dd/mm/yyyy" <?= h($readFlag->superannuation) ?>>
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
                                    <form>
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
                                                        <select class="form-select" id="permanent_state_id" name="permanent_state_id">
                                                            <option value="">Select State</option>  
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 p-3">
                                                    <div class="required-field">
                                                        <label for="permanent_district_id" class="form-label fw-semibold">District</label>
                                                        <select class="form-select" id="permanent_district_id" name="permanent_district_id">
                                                            <option value="">Select District</option>                                                         
                                                               
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
                                            <h3 style="width:100%;">📬 Correspondence Address <small style="float:right;"><input type="checkbox" style="inline-size:auto;"> Same as Permanent Address</small></h3>
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
                                                        <select class="form-select" id="current_state_id" name="current_state_id">
                                                            <option value="">Select State</option>  
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 p-3">
                                                    <div class="required-field">
                                                        <label for="current_district_id" class="form-label fw-semibold">District</label>
                                                        <select class="form-select" id="current_district_id" name="current_district_id">
                                                            <option value="">Select District</option>                                                         
                                                               
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
                                    
                                    <form class="row g-3">

                                        <!-- Marital Status -->
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->marital_status ?? '') ?>">
                                                <label for="marital_status" class="form-label fw-semibold">Marital Status</label>
                                                <input class="form-control" type="text" id="marital_status" name="marital_status" 
                                                    value="<?= h($staff->marital_status ?? '') ?>" <?= h($readFlag->marital_status) ?>>
                                            </div>
                                        </div>

                                        <!-- No. of Children -->
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->children ?? '') ?>">
                                                <label for="children" class="form-label fw-semibold">No. of Children</label>
                                                <input class="form-control" type="number" id="children" name="children"
                                                    value="<?= h($staff->children ?? '') ?>" <?= h($readFlag->children) ?>>
                                            </div>
                                        </div>

                                        <!-- Domicile of Maharashtra -->
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->domicile ?? '') ?>">
                                                <label class="form-label fw-semibold">Domicile of Maharashtra?</label>
                                                <div style="background-color: #d1ddf4; padding:4px;">
                                                    <div class="form-check form-check-inline" style="width:70px;">
                                                        <input class="form-check-input" type="radio" name="domicile" id="domicile_yes" value="1" 
                                                            <?= !empty($staff->domicile) && $staff->domicile == 1 ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="domicile_yes">&nbsp;Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline" style="width:70px;">
                                                        <input class="form-check-input" type="radio" name="domicile" id="domicile_no" value="0"
                                                            <?= empty($staff->domicile) || $staff->domicile != 1 ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="domicile_no">&nbsp;No</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Border Village -->
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->border_village ?? '') ?>">
                                                <label class="form-label fw-semibold">Are you from controversial Karnataka 865 border villages?</label>
                                                <div style="background-color: #d1ddf4;padding:4px;">
                                                    <div class="form-check form-check-inline" style="width:70px;">
                                                        <input class="form-check-input" type="radio" name="border_village" id="border_village_yes" value="1"
                                                            <?= !empty($staff->border_village) && $staff->border_village == 1 ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="border_village_yes">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline" style="width:70px;">
                                                        <input class="form-check-input" type="radio" name="border_village" id="border_village_no" value="0"
                                                            <?= empty($staff->border_village) || $staff->border_village != 1 ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="border_village_no">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Suicide Farmer Child -->
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->suicide_farmer_child ?? '') ?>">
                                                <label class="form-label fw-semibold">Are you a child of suicide victim farmer?</label>
                                                <div style="background-color: #d1ddf4; padding:4px;">
                                                    <div class="form-check form-check-inline" style="width:70px;">
                                                        <input class="form-check-input" type="radio" name="suicide_farmer_child" id="suicide_farmer_child_yes" value="1"
                                                            <?= !empty($staff->suicide_farmer_child) && $staff->suicide_farmer_child == 1 ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="suicide_farmer_child_yes">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline" style="width:70px;">
                                                        <input class="form-check-input" type="radio" name="suicide_farmer_child" id="suicide_farmer_child_no" value="0"
                                                            <?= empty($staff->suicide_farmer_child) || $staff->suicide_farmer_child != 1 ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="suicide_farmer_child_no">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Non-Vremy Layer -->
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->non_vremy ?? '') ?>">
                                                <label class="form-label fw-semibold">Do you have the certificate for non-vremy layer?</label>
                                                <div style="background-color: #d1ddf4; padding:4px;">
                                                    <div class="form-check form-check-inline" style="width:70px;">
                                                        <input class="form-check-input" type="radio" name="non_vremy" id="non_vremy_yes" value="1"
                                                            <?= !empty($staff->non_vremy) && $staff->non_vremy == 1 ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="non_vremy_yes">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline" style="width:70px;">
                                                        <input class="form-check-input" type="radio" name="non_vremy" id="non_vremy_no" value="0"
                                                            <?= empty($staff->non_vremy) || $staff->non_vremy != 1 ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="non_vremy_no">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Freedom Fighter Ward -->
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->freedom_fighter_ward ?? '') ?>">
                                                <label class="form-label fw-semibold">Are you a ward of Freedom Fighter?</label>
                                                <div style="background-color: #d1ddf4; padding:4px;">
                                                    <div class="form-check form-check-inline" style="width:70px;">
                                                        <input class="form-check-input" type="radio" name="freedom_fighter_ward" id="freedom_fighter_ward_yes" value="1"
                                                            <?= !empty($staff->freedom_fighter_ward) && $staff->freedom_fighter_ward == 1 ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="freedom_fighter_ward_yes">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline" style="width:70px;">
                                                        <input class="form-check-input" type="radio" name="freedom_fighter_ward" id="freedom_fighter_ward_no" value="0"
                                                            <?= empty($staff->freedom_fighter_ward) || $staff->freedom_fighter_ward != 1 ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="freedom_fighter_ward_no">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Election 1994 -->
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->election_1994 ?? '') ?>">
                                                <label class="form-label fw-semibold">Were you an Employee of election 1994?</label>
                                                <div style="background-color: #d1ddf4; padding:4px;">
                                                    <div class="form-check form-check-inline" style="width:70px;">
                                                        <input class="form-check-input" type="radio" name="election_1994" id="election_1994_yes" value="1"
                                                            <?= !empty($staff->election_1994) && $staff->election_1994 == 1 ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="election_1994_yes">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline" style="width:70px;">
                                                        <input class="form-check-input" type="radio" name="election_1994" id="election_1994_no" value="0"
                                                            <?= empty($staff->election_1994) || $staff->election_1994 != 1 ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="election_1994_no">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Election 1991 -->
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->election_1991 ?? '') ?>">
                                                <label class="form-label fw-semibold">Were you an Employee of election 1991?</label>
                                                <div style="background-color: #d1ddf4; padding:4px;">
                                                    <div class="form-check form-check-inline" style="width:70px;">
                                                        <input class="form-check-input" type="radio" name="election_1991" id="election_1991_yes" value="1"
                                                            <?= !empty($staff->election_1991) && $staff->election_1991 == 1 ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="election_1991_yes">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline" style="width:70px;">
                                                        <input class="form-check-input" type="radio" name="election_1991" id="election_1991_no" value="0"
                                                            <?= empty($staff->election_1991) || $staff->election_1991 != 1 ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="election_1991_no">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Mother Tongue -->
                                        <div class="col-md-4">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->mother_tongue ?? '') ?>">
                                                <label for="mother_tongue" class="form-label fw-semibold">Mother Tongue</label>
                                                <input class="form-control" type="text" id="mother_tongue" name="mother_tongue"
                                                    value="<?= h($staff->mother_tongue ?? '') ?>" <?= h($readFlag->mother_tongue) ?>>
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


                                        <!-- Ex-Servicemen -->
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
                                                    <select class="form-select" id="lang1" name="lang1" <?= h($readFlag->lang1) ?>>
                                                        <option value="">Select</option>
                                                        <option <?= ($staff->lang1 ?? '') == 'Marathi' ? 'selected' : '' ?>>Marathi</option>
                                                        <option <?= ($staff->lang1 ?? '') == 'Hindi' ? 'selected' : '' ?>>Hindi</option>
                                                        <option <?= ($staff->lang1 ?? '') == 'English' ? 'selected' : '' ?>>English</option>
                                                        <option <?= ($staff->lang1 ?? '') == 'Sanskrit' ? 'selected' : '' ?>>Sanskrit</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->lang2 ?? '') ?>">
                                                    <label for="lang2" class="form-label fw-semibold">Language 2</label>
                                                    <select class="form-select" id="lang2" name="lang2" <?= h($readFlag->lang2) ?>>
                                                        <option value="">Select</option>
                                                        <option <?= ($staff->lang2 ?? '') == 'Marathi' ? 'selected' : '' ?>>Marathi</option>
                                                        <option <?= ($staff->lang2 ?? '') == 'Hindi' ? 'selected' : '' ?>>Hindi</option>
                                                        <option <?= ($staff->lang2 ?? '') == 'English' ? 'selected' : '' ?>>English</option>
                                                        <option <?= ($staff->lang2 ?? '') == 'Sanskrit' ? 'selected' : '' ?>>Sanskrit</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->lang3 ?? '') ?>">
                                                    <label for="lang3" class="form-label fw-semibold">Language 3</label>
                                                    <select class="form-select" id="lang3" name="lang3" <?= h($readFlag->lang3) ?>>
                                                        <option value="">Select</option>
                                                        <option <?= ($staff->lang3 ?? '') == 'Marathi' ? 'selected' : '' ?>>Marathi</option>
                                                        <option <?= ($staff->lang3 ?? '') == 'Hindi' ? 'selected' : '' ?>>Hindi</option>
                                                        <option <?= ($staff->lang3 ?? '') == 'English' ? 'selected' : '' ?>>English</option>
                                                        <option <?= ($staff->lang3 ?? '') == 'Sanskrit' ? 'selected' : '' ?>>Sanskrit</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Remarks -->
                                        <div class="col-md-12">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->remarks ?? '') ?>">
                                                <label for="remarks" class="form-label fw-semibold">Remarks (if any)</label>
                                                <input class="form-control" type="text" id="remarks" name="remarks"
                                                    value="<?= h($staff->remarks ?? '') ?>" <?= h($readFlag->remarks?? '') ?>>
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

                                <section id="content-section-4" class="content-section"><!-- Nomination details start -->
                                    
                                

                                    <div class="card shadow-lg border-0 rounded-4">
                                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">🧩 Nomination Records</h5>
                                        <button id="addNominationBtn" class="btn btn-light btn-sm fw-semibold">
                                            + Add Nomination Record
                                        </button>
                                        </div>
                                        <div class="card-body">
                                        <div id="nominationTableContainer" class="table-responsive"></div>
                                        </div>
                                    </div>
                                    
                                </section><!-- Nomination details end -->

                                <section id="content-section-5" class="content-section"><!-- Caste Category & Certification start  -->
                                    <form>

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
                                                        <input class="form-control" type="text" id="social_category" name="social_category" value="<?= h($staff->social_category ?? '') ?>"  <?= h($readFlag->social_category) ?>>
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
                                                        <input class="form-control" type="text" id="certificate_date" name="certificate_date" value="<?= h(!empty($staff->certificate_date) ? date('d/m/Y', strtotime($staff->certificate_date)) : '') ?>"  <?= h($readFlag->certificate_date) ?>>
                                                    </div>
                                                </div>

                                
                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->certificate_issuing_authority ?? '') ?>">
                                                        <label for="certificate_issuing_authority" class="form-label fw-semibold">Issuing Authority</label>
                                                        <select class="form-select" id="certificate_issuing_authority" name="certificate_issuing_authority" <?= h($readFlag->certificate_issuing_authority) ?>>
                                                            <option value="">Select Issuing Authority</option>
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

                                                <!-- Remarks -->
                                                <div class="col-md-12">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->certificate_remarks ?? '') ?>">
                                                        <label for="certificate_remarks" class="form-label fw-semibold">Remarks (if any)</label>
                                                        <input class="form-control" type="text" id="certificate_remarks" name="certificate_remarks"
                                                            value="<?= h($staff->certificate_remarks ?? '') ?>" <?= h($readFlag->certificate_remarks?? '') ?>>
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
                                                        <input class="form-control" type="text" id="certificate_validation_date" name="certificate_validation_date" value="<?= h(!empty($staff->certificate_validation_date) ? date('d/m/Y', strtotime($staff->certificate_validation_date)) : '') ?>"  <?= h($readFlag->certificate_validation_date) ?>>
                                                    </div>
                                                </div>

                                                
                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->certificate_validation_authority ?? '') ?>">
                                                        <label for="certificate_validation_authority" class="form-label fw-semibold">Certificate Validation Authority</label>
                                                        <select class="form-select" id="certificate_validation_authority" name="certificate_validation_authority" <?= h($readFlag->certificate_validation_authority) ?>>
                                                            <option value="">Select Validation Authority</option>
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
                                        
                                        
                                    </form>
                                </section><!-- Caste Category & Certification end  -->

                                <section id="content-section-6" class="content-section"><!-- Disability details start-->
                                    <form class="row g-3">
                                         <div class="card shadow-lg border-0 rounded-4">
                                            
                                            <div class="card-body row g-3">


                                                 <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->is_disabled ?? '') ?>">
                                                        <label class="form-label fw-semibold">Is Disabled?</label>
                                                        <div style="background-color: #d1ddf4;padding:4px;">&nbsp;&nbsp;&nbsp;
                                                            <div class="form-check form-check-inline" style="width:70px;">
                                                                <input class="form-check-input" type="radio" name="is_disabled" id="is_disabled_yes" value="1" <?= !empty($staff->is_disabled) && $staff->is_disabled == 1 ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="is_disabled_yes">&nbsp;&nbsp;Yes</label>
                                                            </div>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <div class="form-check form-check-inline" style="width:70px;">
                                                                <input  class="form-check-input" type="radio" name="is_disabled" id="is_disabled_no" value="0" <?= empty($staff->is_disabled) || $staff->is_disabled != 1 ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="is_disabled_no">&nbsp;&nbsp;No</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
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

                                              
                                            </div>
                                        </div>



                                        
                                    </form><br>
                                    
                                </section><!-- Disability details end -->

                                <section id="content-section-7" class="content-section"><!-- Academic Qualifications start -->
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
                                
                                    <!--<form class="row g-3">
                                            <div class="col-md-6 custom-box">
                                            <label for="highest_qualification">Highest Qualification</label>
                                            <input type="text" id="highest_qualification" name="highest_qualification" value="Master of Science (M.Sc)" readonly>
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="qualification_level">Qualification Level</label>
                                            <input type="text" id="qualification_level" name="qualification_level" value="Postgraduate" >
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="examination_degree">Examination / Degree/ Trade</label>
                                            <input type="text" id="examination_degree" name="examination_degree" value="M.Sc in Computer Science" readonly>
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="medium">Medium</label>
                                            <input type="text" id="medium" name="medium" value="English" >
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="degree_from_maharashtra">Is Degree from Maharashtra?</label>
                                            <input type="text" id="degree_from_maharashtra" name="degree_from_maharashtra" value="Yes" >
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="state">State</label>
                                            <input type="text" id="state" name="state" value="Maharashtra" >
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="board_university">Board / University</label>
                                            <input type="text" id="board_university" name="board_university" value="University of Mumbai" >
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="month_of_passing">Month of Passing</label>
                                            <input type="text" id="month_of_passing" name="month_of_passing" value="June" >
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="year_of_passing">Year of Passing</label>
                                            <input type="text" id="year_of_passing" name="year_of_passing" value="2020" >
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="percentage_of_marks">Percentage of Marks</label>
                                            <input type="text" id="percentage_of_marks" name="percentage_of_marks" value="78.50%" >
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="grade">Grade</label>
                                            <input type="text" id="grade" name="grade" value="First Class with Distinction" >
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="main_subject">Main Subject</label>
                                            <input type="text" id="main_subject" name="main_subject" value="Computer Science" >
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="optional_subject_1">Optional Subject 1</label>
                                            <input type="text" id="optional_subject_1" name="optional_subject_1" value="Artificial Intelligence" >
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="optional_subject_2">Optional Subject 2</label>
                                            <input type="text" id="optional_subject_2" name="optional_subject_2" value="Data Mining" >
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="other_subjects">Other Subjects</label>
                                            <input type="text" id="other_subjects" name="other_subjects" value="Advanced Algorithms, Operating Systems" >
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="upload_certificate">Upload Certificate</label>
                                            <input type="text" id="upload_certificate" name="upload_certificate" value="msc_degree_certificate.pdf" >
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="view_certificate">View Certificate</label>
                                            <input type="text" id="view_certificate" name="view_certificate" value="View PDF" >
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="remarks">Remarks (if any)</label>
                                            <input type="text" id="remarks" name="remarks" value="Completed under regular full-time program" >
                                            </div>

                                        </form><br>-->
                                    
                                </section><!-- Academic Qualifications end -->

                                <section id="content-section-8" class="content-section"><!-- Professional Qualifications start -->
                                    <form class="row g-3">

                                        <div class="col-md-6 custom-box">
                                            <label for="professional_level">Qualification Level</label>
                                            <input type="text" id="professional_level" name="professional_level" value="Graduate" >
                                        </div>
                                        <div class="col-md-6 custom-box">
                                            <label for="professional_examination">Examination / Degree</label>
                                            <input type="text" id="professional_examination" name="professional_examination" value="B.Ed." >
                                        </div>
                                        <div class="col-md-6 custom-box">
                                            <label for="medium">Medium</label>
                                            <input type="text" id="medium" name="medium" value="English" >
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="degree_from_maharashtra">Is Degree from Maharashtra?</label>
                                            <input type="text" id="degree_from_maharashtra" name="degree_from_maharashtra" value="Yes" >
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="state">State</label>
                                            <input type="text" id="state" name="state" value="Maharashtra" >
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="board_university">Board / University</label>
                                            <input type="text" id="board_university" name="board_university" value="Savitribai Phule Pune University" >
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="month_of_passing">Month of Passing</label>
                                            <input type="text" id="month_of_passing" name="month_of_passing" value="May" >
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="year_of_passing">Year of Passing</label>
                                            <input type="text" id="year_of_passing" name="year_of_passing" value="2018" >
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="percentage_of_marks">Percentage of Marks</label>
                                            <input type="text" id="percentage_of_marks" name="percentage_of_marks" value="82.00%" >
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="grade">Grade</label>
                                            <input type="text" id="grade" name="grade" value="Distinction" >
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="teaching_method_1">Teaching Method 1</label>
                                            <input type="text" id="teaching_method_1" name="teaching_method_1" value="Science" >
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="teaching_method_2">Teaching Method 2</label>
                                            <input type="text" id="teaching_method_2" name="teaching_method_2" value="Mathematics" >
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="upload_certificate">Upload Certificate</label>
                                            <input type="text" id="upload_certificate" name="upload_certificate" value="bed_certificate_2018.pdf" >
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="view_certificate">View Certificate</label>
                                            <input type="text" id="view_certificate" name="view_certificate" value="View PDF" >
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="remarks">Remarks (if any)</label>
                                            <input type="text" id="remarks" name="remarks" value="Successfully completed under regular full-time mode" >
                                            </div>
                                    </form><br>

                                

                                </section><!-- Professional Qualifications end -->


                                <section id="content-section-9" class="content-section"><!-- Udise Qualification Details start -->
                                    <form class="row g-3">
                                       
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
                            
                                <section id="content-section-10" class="content-section"><!-- TET/CTET Details start -->
                                    
                                
                                    <form>
                                        <div class="card shadow-lg border-0 rounded-4">
                                            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                                <h5 class="mb-0">📝 TET Paper 1</h5>
                                           
                                            </div>
                                            <div class="card-body row g-3">

                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->tet_paper1_pass ?? '') ?>">
                                                        <label class="form-label fw-semibold">TET Paper 1 Pass</label>
                                                        <div style="background-color: #d1ddf4;padding:4px;">&nbsp;&nbsp;&nbsp;
                                                            <div class="form-check form-check-inline" style="width:70px;">
                                                                <input class="form-check-input" type="radio" name="tet_paper1_pass" id="tet_paper1_pass_yes" value="1" <?= !empty($staff->tet_paper1_pass) && $staff->tet_paper1_pass == 1 ? 'checked' : '' ?> <?= h($readFlag->tet_paper1_pass) ?>>
                                                                <label class="form-check-label" for="tet_paper1_pass_yes">&nbsp;&nbsp;Yes</label>
                                                            </div>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <div class="form-check form-check-inline" style="width:70px;">
                                                                <input  class="form-check-input" type="radio" name="tet_paper1_pass" id="tet_paper1_pass_no" value="0" <?= empty($staff->tet_paper1_pass) || $staff->tet_paper1_pass != 1 ? 'checked' : '' ?> <?= h($readFlag->tet_paper1_pass) ?>>
                                                                <label class="form-check-label" for="tet_paper1_pass_no">&nbsp;&nbsp;No</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                

                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->tet_paper1_number ?? '') ?>">
                                                        <label for="tet_paper1_number" class="form-label fw-semibold">TET Number Paper 1</label>
                                                        <input class="form-control" type="text" id="tet_paper1_number" name="tet_paper1_number" value="<?= h($staff->tet_paper1_number ?? '') ?>"  <?= h($readFlag->tet_paper1_number) ?>>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->tet_paper1_percentage ?? '') ?>">
                                                        <label for="tet_paper1_percentage" class="form-label fw-semibold">Percentage of Marks / Grade</label>
                                                        <input class="form-control" type="text" id="tet_paper1_percentage" name="tet_paper1_percentage" value="<?= h($staff->tet_paper1_percentage ?? '') ?>"  <?= h($readFlag->tet_paper1_percentage) ?>>
                                                    </div>
                                                </div>
                                                

                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->tet_paper1_teacher_category ?? '') ?>">
                                                        <label for="tet_paper1_teacher_category" class="form-label fw-semibold">Teacher Category</label>
                                                        <select class="form-select" id="tet_paper1_teacher_category" name="tet_paper1_teacher_category" <?= h($readFlag->tet_paper1_teacher_category) ?>>
                                                            <option value="">Select Teacher Category</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->tet_paper1_pasing_month ?? '') ?>">
                                                        <label for="tet_paper1_pasing_month" class="form-label fw-semibold">Month of Passing</label>
                                                        <input class="form-control" type="text" id="tet_paper1_pasing_month" name="tet_paper1_pasing_month" value="<?= h($staff->tet_paper1_pasing_month ?? '') ?>"  <?= h($readFlag->tet_paper1_pasing_month) ?>>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->tet_paper1_pasing_month ?? '') ?>">
                                                        <label for="tet_paper1_pasing_year" class="form-label fw-semibold">Year of Passing</label>
                                                        <input class="form-control" type="text" id="tet_paper1_pasing_year" name="tet_paper1_pasing_year" value="<?= h($staff->tet_paper1_pasing_year ?? '') ?>"  <?= h($readFlag->tet_paper1_pasing_year) ?>>
                                                    </div>
                                                </div>                                              
                                            </div>
                                        </div>

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
                                        </div>
                                                                            
             


                                        
                                        

                                                   

                                                    

                                        
                                    </form><br>

                                    
                                </section><!--TET/CTET details end-->
                            
                                <section id="content-section-11" class="content-section"><!-- Initial Appointment start-->
                                    <form class="row g-3">
                                            <div class="col-md-6 custom-box">
                                            <label for="recruitment_mode">Mode of Recruitment</label>
                                            <input type="text" id="recruitment_mode" name="recruitment_mode" value="Direct Recruitment" >
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="entry_date">Date of Entry in Education Department</label>
                                            <input type="text" id="entry_date" class="form-control date-field" name="entry_date" value="<?= !empty($teacher['entry_date']) 
                                                        ? date('d/m/Y', strtotime($teacher['entry_date'])) 
                                                        : '' ?>" placeholder="dd/mm/yyyy">
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="initial_post">Post of Initial Appointment</label>
                                            <input type="text" id="initial_post" name="initial_post" value="Assistant Teacher (Secondary)" >
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="mode_of_post">Mode of Getting Post</label>
                                            <input type="text" id="mode_of_post" name="mode_of_post" value="Direct Recruitment" >
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="recruitment_category">Recruitment Category</label>
                                            <input type="text" id="recruitment_category" name="recruitment_category" value="General" >
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="social_category">Social Category</label>
                                            <input type="text" id="social_category" name="social_category" value="OBC" >
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="recruitment_hor_category">Recruitment Hor. Category</label>
                                            <input type="text" id="recruitment_hor_category" name="recruitment_hor_category" value="Women" >
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="recruitment_ph_details">Recruitment PH Details</label>
                                            <input type="text" id="recruitment_ph_details" name="recruitment_ph_details" value="Not Applicable" >
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="recruitment_orphan_details">Recruitment Orphan Details</label>
                                            <input type="text" id="recruitment_orphan_details" name="recruitment_orphan_details" value="No" >
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="appointment_subjects">Appointment for Subject 1, Subject 2</label>
                                            <input type="text" id="appointment_subjects" name="appointment_subjects" value="Mathematics, Science" >
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="nature_of_appointment">Nature of Appointment</label>
                                            <input type="text" id="nature_of_appointment" name="nature_of_appointment" value="Regular" readonly>
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="remarks">Remarks</label>
                                            <input type="text" id="remarks" name="remarks" value="Joined through ZP recruitment process" >
                                            </div>
                                    </form><br>
                                
                                </section><!-- Initial Appointment end-->

                                <section id="content-section-12" class="content-section"><!--Teaching Details (UDISE) start -->
                                    <form class="row g-3">

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

                                    

                                </section><!--Teaching Details (UDISE) end -->

                                <section id="content-section-13" class="content-section"><!--Service Tracking start-->
                                    <form class="row g-3">
                                        <div class="col-md-6 custom-box">
                                            <label for="school_udise_code">School Udise Code</label>
                                            <input type="text" id="school_udise_code" name="school_udise_code" value="1234567890" >
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="school_name">School Name</label>
                                            <input type="text" id="school_name" name="school_name" value="Kendriya Vidyalaya, Pune" >
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="school_aid_type">School Aid Type</label>
                                            <input type="text" id="school_aid_type" name="school_aid_type" value="Government Funded" >
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="school_category">School Category</label>
                                            <input type="text" id="school_category" name="school_category" value="Central Government" >
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="post">Post</label>
                                            <input type="text" id="post" name="post" value="Senior Secondary Teacher (Maths)" >
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="from_date">From Date</label>
                                            <input type="text" id="from_date" class="form-control date-field" name="from_date" value="<?= !empty($teacher['from_date']) 
                                                        ? date('d/m/Y', strtotime($teacher['from_date'])) 
                                                        : '' ?>" placeholder="dd/mm/yyyy">
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="to_date">To Date</label>
                                            <input type="text" id="to_date" class="form-control date-field" name="to_date" value="<?= !empty($teacher['to_date']) 
                                                        ? date('d/m/Y', strtotime($teacher['to_date'])) 
                                                        : '' ?>" placeholder="dd/mm/yyyy">
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="work_in_pesa_area">Work in PESA Area for ST Category Staff</label>
                                            <input type="text" id="work_in_pesa_area" name="work_in_pesa_area" value="No" >
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="work_in_difficult_area">Work in Difficult Areas</label>
                                            <input type="text" id="work_in_difficult_area" name="work_in_difficult_area" value="Yes" >
                                            </div>

                                            <div class="col-md-6 custom-box">
                                            <label for="transfer_approval">Transfer Approval/Promotion Approval</label>
                                            <input type="text" id="transfer_approval" name="transfer_approval" value="Pending" >
                                            </div>
                                    </form><br>

                                
                                </section><!-- Service Tracking end -->

                                <section id="content-section-14" class="content-section"><!--Attach / Detach details start-->
                                    <form>
                                        <div class="form-group">
                                            <label for="attach_date">Attach/Detach Date</label>
                                            <input type="date" id="attach_date" name="attach_date" value="2022-09-01" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="attach_reason">Reason</label>
                                            <input type="text" id="attach_reason" name="attach_reason" value="Temporary assignment at another school" readonly>
                                        </div>
                                    </form>

                                    
                                </section><!--Attach / Detach details end-->

                                <section id="content-section-15" class="content-section"><!--Superannuation details start-->
                                    <form>
                                        <div class="form-group">
                                            <label for="superannuation_date">Date of Superannuation</label>
                                            <input type="date" id="superannuation_date" name="superannuation_date" value="2043-06-30" readonly>
                                        </div>
                                    </form>
                                    
                                </section><!--Superannuation details end-->

                                <section id="content-section-16" class="content-section"><!-- Death Cases start-->
                                    <form>
                                        <div class="form-group">
                                            <label for="death_date">Date of Death</label>
                                            <input type="date" id="death_date" name="death_date" readonly>
                                        </div>
                                    </form>

                                    
                                </section><!-- Death Cases end-->

                                <section id="content-section-17" class="content-section"><!--Pay Details start-->
                                    <form class="row g-3">
                                        <div class="col-md-6 custom-box">
                                            <label for="pay_commission">Pay Commission</label>
                                            <input type="text" id="pay_commission" name="pay_commission" value="7th Pay Commission" >
                                        </div>

                                        <div class="col-md-6 custom-box">
                                            <label for="pay_scale">Pay Scale</label>
                                            <input type="text" id="pay_scale" name="pay_scale" value="Level 8 (₹47,600 - ₹1,51,100)" >
                                        </div>

                                        <div class="col-md-6 custom-box">
                                            <label for="pay_in_band">Pay in Band</label>
                                            <input type="text" id="pay_in_band" name="pay_in_band" value="₹52,000" >
                                        </div>

                                        <div class="col-md-6 custom-box">
                                            <label for="grade_pay">Grade Pay</label>
                                            <input type="text" id="grade_pay" name="grade_pay" value="₹5,400" >
                                        </div>

                                        <div class="col-md-6 custom-box">
                                            <label for="basic_pay">Basic Pay</label>
                                            <input type="text" id="basic_pay" name="basic_pay" value="₹55,400" >
                                        </div>

                                        <div class="col-md-6 custom-box">
                                            <label for="pay_wef_date">Pay w.e.f. Date</label>
                                            <input type="text" id="pay_wef_date" class="form-control date-field" name="pay_wef_date" value="<?= !empty($teacher['pay_wef_date']) 
                                                        ? date('d/m/Y', strtotime($teacher['pay_wef_date'])) 
                                                        : '' ?>" placeholder="dd/mm/yyyy">
                                            </div>

                                        <div class="col-md-6 custom-box">
                                            <label for="next_increment_date">Next Increment Date</label>
                                            <input type="text" id="next_increment_date" class="form-control date-field" name="next_increment_date" value="<?= !empty($teacher['to_date']) 
                                                        ? date('d/m/Y', strtotime($teacher['to_date'])) 
                                                        : '' ?>" placeholder="dd/mm/yyyy">
                                            </div>

                                        <div class="col-md-6 custom-box">
                                            <label for="received_senior_grade_scale">Received Senior Grade Scale</label>
                                            <input type="text" id="received_senior_grade_scale" name="received_senior_grade_scale" value="Yes" >
                                        </div>

                                        <div class="col-md-6 custom-box">
                                            <label for="date_received">Date Received</label>
                                            <input type="text" id="date_received" class="form-control date-field" name="date_received" value="<?= !empty($teacher['to_date']) 
                                                        ? date('d/m/Y', strtotime($teacher['to_date'])) 
                                                        : '' ?>" placeholder="dd/mm/yyyy">
                                            </div>

                                        <div class="col-md-6 custom-box">
                                            <label for="received_selection_grade_scale">Received Selection Grade Scale</label>
                                            <input type="text" id="received_selection_grade_scale" name="received_selection_grade_scale" value="Yes" >
                                        </div>

                                        <div class="col-md-6 custom-box">
                                            <label for="received_selection_grade_date">Date Received</label>
                                            <input type="text" id="received_selection_grade_date" class="form-control date-field" name="received_selection_grade_date" value="<?= !empty($teacher['to_date']) 
                                                        ? date('d/m/Y', strtotime($teacher['to_date'])) 
                                                        : '' ?>" placeholder="dd/mm/yyyy">
                                            </div>

                                        <div class="col-md-6 custom-box">
                                            <label for="pan_no">PAN No.</label>
                                            <input type="text" id="pan_no" name="pan_no" value="ABCPS1234E" >
                                        </div>

                                        <div class="col-md-6 custom-box">
                                            <label for="remarks">Remarks</label>
                                            <input type="text" id="remarks" name="remarks" value="Eligible for next pay increment in July 2024" >
                                        </div>
                                    </form><br>

                                    
                                </section><!--Pay Details end-->

                            
                                <section id="content-section-18" class="content-section"><!--PF/DCPS/GPF start-->
                                    
                                    <form class="row g-3">
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

                                        <div class="col-md-8">
                                            <div class="custom-box border rounded-3 p-3 shadow-sm <?= h($css->pf->pf_remarks ?? '') ?>">
                                                <label for="pf_remarks">Remarks</label>
                                                <input type="text" id="pf_remarks" name="pf_remarks" value="<?= h($staff->pf_remarks ?? '') ?>"  <?= h($readFlag->pf->pf_remarks) ?>>
                                            </div>
                                        </div>
                                    </form><br>

                                    
                                </section><!--PF/DCPS/GPF end-->

                                <section id="content-section-19" class="content-section"><!--Bank Account details start-->
                                    <form class="row g-3">
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

                                <section id="content-section-20" class="content-section"><!-- Leave Details start-->
                                    <form>
                                        <div class="form-group">
                                            <label for="casual_leave">Casual Leave</label>
                                            <input type="text" id="casual_leave" name="casual_leave" value="5 days remaining" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="sick_leave">Sick Leave</label>
                                            <input type="text" id="sick_leave" name="sick_leave" value="10 days remaining" readonly>
                                        </div>
                                    </form>
                                    
                                    <table class="table table-bordered table-striped align-middle" id="leaveTable">
                                            <thead class="table-primary">
                                            <tr>                                           
                                                <th>Casual Leave</th>
                                                <th>Sick Leave</th>
                                            
                                                <!-- <th>View</th> -->
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <!-- Rows will be injected by jQuery -->
                                            </tbody>
                                    </table>

                                    
                                </section><!-- Leave details end-->

                                <section id="content-section-21" class="content-section"><!--Rewards details start-->
                                    <form>
                                        <div class="form-group">
                                            <label for="reward_name">Reward Name</label>
                                            <input type="text" id="reward_name" name="reward_name" value="State Level Best Teacher Award" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="reward_year">Year</label>
                                            <input type="text" id="reward_year" name="reward_year" value="2022" readonly>
                                        </div>
                                    </form>

                                    <table class="table table-bordered table-striped align-middle" id="rewardTable">
                                            <thead class="table-primary">
                                            <tr>                                           
                                                <th>Reward Name</th>
                                                <th><label for="reward_year">Year</label></th>
                                            
                                                <!-- <th>View</th> -->
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <!-- Rows will be injected by jQuery -->
                                            </tbody>
                                    </table>
                                </section><!--Rewards details end-->

                                <section id="content-section-22" class="content-section"><!--Training Attended details start-->
                                    <form>

                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h5 class="fw-bold text-primary mb-0">Training Details</h5>
                                            <button type="button" class="btn btn-sm btn-success shadow-sm" data-bs-toggle="modal" data-bs-target="#trainingModal">
                                            <i class="fa-solid fa-plus me-2"></i> Add Training
                                            </button>
                                        </div>

                                        <!-- Training List Table -->
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover align-middle">
                                            <thead class="table-primary text-center">
                                                <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Institute</th>
                                                <th scope="col">From Date</th>
                                                <th scope="col">To Date</th>
                                                <th scope="col">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="trainingTableBody" class="text-center">
                                                <!-- Rows will be dynamically loaded via AJAX -->
                                                <tr>
                                                <td colspan="6" class="text-muted py-4">No training records added yet.</td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>


                                       
                                        

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
                            
                                <section id="content-section-23" class="content-section"><!--Disciplinary Action start-->
                                    <form>
                                        <div class="form-group">
                                            <label for="disciplinary_action">Disciplinary Action</label>
                                            <input type="text" id="disciplinary_action" name="disciplinary_action" value="None" readonly>
                                        </div>
                                    </form>
                                </section><!--Disciplinary Action end-->

                                <section id="content-section-24" class="content-section"><!--Complaint details start-->
                                    <form>
                                        <div class="form-group">
                                            <label for="complaint_details">Complaint Details</label>
                                            <input type="text" id="complaint_details" name="complaint_details" value="No complaints filed" readonly>
                                        </div>
                                    </form>
                                </section><!--Complaint details end-->
                            </div>
                        </main>
                    </div>
                </div>
            </div>
        </div>
</main>



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
            <div id="familyError"></div>
          <div class="col-md-6">
            <label class="form-label fw-semibold">Family Member Name</label>
            <input type="text" name="family_member_name" class="form-control" required>
          </div>

          <div class="col-md-6">
            <label class="form-label fw-semibold">Relation</label>
            <select name="relation_id" class="form-select" required>
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

          <div class="col-md-6">
            <label class="form-label fw-semibold">Covered under Family?</label><br>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="covered_under_family" value="true" checked>
              <label class="form-check-label">Yes</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="covered_under_family" value="false">
              <label class="form-check-label">No</label>
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

<!-- Add Qualification Modal -->
<div class="modal fade" id="addQualModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Add Academic Qualification</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form id="addQualForm" class="needs-validation" novalidate>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-4">
              <label class="form-label">Qualification Level</label>
              <select name="academic_level_code" id="academic_level_code" class="form-select" required>
                <option value="">Select Level</option>
                <!-- populate server-side or via AJAX -->
              </select>
              <div class="invalid-feedback">Please select qualification level.</div>
            </div>
            <div class="col-md-4">
              <label class="form-label">Examination / Degree / Trade</label>
              <select name="academic_degree_code" id="academic_degree_code" class="form-select" required>
                <option value="">Select Degree/Trade</option>
                <!-- populate server-side or via AJAX -->
              </select>
              <div class="invalid-feedback">Please select degree/trade.</div>
            </div>

            <div class="col-md-4">
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

            <div class="col-md-4">
              <label class="form-label">Is Degree from Maharashtra?</label>
              <div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="academic_degree_from_maharashtra" id="academic_degree_from_maharashtra_yes" value="1">
                  <label class="form-check-label" for="academic_degree_from_maharashtra_yes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="academic_degree_from_maharashtra" id="academic_degree_from_maharashtra_no" value="0">
                  <label class="form-check-label" for="academic_degree_from_maharashtra_no">No</label>
                </div>
              </div>
            </div>


            

            <div class="col-md-4">
              <label class="form-label">State</label>
              <select name="academic_state" id="academic_state" class="form-select" required>
                <option value="">Select State</option>
                <!-- populate server-side or via AJAX -->
              </select>
              <div class="invalid-feedback">Please select state.</div>
            </div>

            <div class="col-md-4">
              <label class="form-label">Board / University</label>
              <select name="academic_board_university" id="academic_board_university" class="form-select" required>
                <option value="">Select Board/University</option>
                <!-- populate server-side or via AJAX -->
              </select>
              <div class="invalid-feedback">Please select board/university.</div>
            </div>

            <div class="col-md-2">
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
            </div>

            <div class="col-md-4">
              <label class="form-label">Percentage of Marks / Grade</label>
              <input type="text" name="academic_percentage" class="form-control" placeholder="e.g., 67.5" required>
            </div>
            
            <div class="col-md-4">
              <label class="form-label">Main Subject</label>
              <input type="text" name="academic_main_subject" class="form-control">
            </div>
            <div class="col-md-4">
              <label class="form-label">Optional Subject 1</label>
              <input type="text" name="academic_opt_subject_1" class="form-control">
            </div>
            <div class="col-md-4">
              <label class="form-label">Optional Subject 2</label>
              <input type="text" name="academic_opt_subject_2" class="form-control">
            </div>
            <div class="col-md-4">
              <label class="form-label">Other Subjects</label>
              <input type="text" name="academic_other_subjects" class="form-control">
            </div>

            <div class="col-md-6">
              <label class="form-label">Upload Certificate</label>
              <input type="file" name="academic_certificate_file" accept=".pdf,.jpg,.jpeg,.png" class="form-control">
              <div class="form-text">Allowed: pdf, jpg, png. Max size as per server config.</div>
            </div>
            
            <div class="col-md-6">
              <label class="form-label">Remark</label>
              <textarea name="academic_remark" id="academic_remark" class="form-control" rows="2"></textarea>
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
              <select name="training_type" class="form-select" required>
                <option value="">Select Training Type</option>
                <option value="Orientation">Orientation</option>
                <option value="Refresher">Refresher</option>
                <option value="Workshop">Workshop</option>
                <option value="Seminar">Seminar</option>
                <option value="Online Course">Online Course</option>
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-semibold">Category</label>
              <select name="category" class="form-select">
                <option value="">Select Category</option>
                <option value="Teaching Skills">Teaching Skills</option>
                <option value="Leadership">Leadership</option>
                <option value="ICT">ICT</option>
                <option value="Subject-Specific">Subject-Specific</option>
                <option value="Administrative">Administrative</option>
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-semibold">Institute</label>
              <select name="institute" class="form-select">
                <option value="">Select Institute</option>
                <option value="SCERT">SCERT</option>
                <option value="NCERT">NCERT</option>
                <option value="DIET">DIET</option>
                <option value="Private">Private</option>
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-semibold">Level</label>
              <select name="level" class="form-select">
                <option value="">Select Level</option>
                <option value="National">National</option>
                <option value="State">State</option>
                <option value="District">District</option>
                <option value="Block">Block</option>
                <option value="School">School</option>
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-semibold">From Date</label>
              <input type="date" name="from_date" class="form-control" required>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-semibold">To Date</label>
              <input type="date" name="to_date" class="form-control" required>
            </div>

            <div class="col-md-12">
              <label class="form-label fw-semibold">Title</label>
              <input type="text" name="title" class="form-control" placeholder="Enter training title" required>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-semibold">Whether Attended?</label>
              <div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="attended" value="1" required>
                  <label class="form-check-label">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="attended" value="0">
                  <label class="form-check-label">No</label>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-semibold">Certificate Awarded?</label>
              <div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="certificate_awarded" value="1" required>
                  <label class="form-check-label">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="certificate_awarded" value="0">
                  <label class="form-check-label">No</label>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <label class="form-label fw-semibold">Remarks (if any)</label>
              <textarea name="remarks" class="form-control" rows="3" placeholder="Enter remarks or notes..."></textarea>
            </div>

          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save Training</button>
        </div>
      </form>
    </div>
  </div>
</div>
<style>
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


</style>


<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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
            $(document).ajaxStart(() => ProcessingModal.show());
            $(document).ajaxStop(() => ProcessingModal.hide());
            $(document).ajaxError(() => ProcessingModal.hide());
        })(jQuery);
    }

     
    $(document).ready(function() {
        const baseUrl = "<?= $this->Url->build('/', ['fullBase' => true]); ?>";
        const staffId = <?= h($staff->id ?? 0) ?>;
        // === Familly integration Starts ===           
            // 🧭 Fetch and display family details
            function loadFamilyDetails() {
                $.ajax({
                url: baseUrl + "staff-family/lists/" + staffId,
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
                            <th>Family Member</th>
                            <th>Relation</th>
                            <th>Date of Birth</th>
                            <th>Aadhar</th>
                            <th>Covered Under Family</th>
                        </tr>
                        </thead>
                        <tbody>
                    `;
                    $.each(data, function(i, row) {
                        //alert(row);
                    table += `
                        <tr>
                        <td>${i + 1}</td>
                        <td>${row.family_member_name}</td>
                        <td>${row?.relationship?.relationship || '-'}</td>
                        <td>${row.date_of_birth ? new Date(row.date_of_birth).toLocaleDateString('en-GB') : '-'}</td>
                        <td>${row.aadhar_card_no || '-'}</td>
                        <td>${row.covered_under_family ? '✅ Yes' : '❌ No'}</td>
                        </tr>`;
                    });
                    table += "</tbody></table>";
                    $('#familyTableContainer').html(table);
                },
                error: function() {
                    $('#familyTableContainer').html('<p class="text-danger text-center py-3">Error loading family details.</p>');
                }
                });
            }


            // 🎯 Add new member button
            $('#addFamilyBtn').on('click', function() {
                $('#familyError').hide();
                $('#familyForm')[0].reset();
                $('#familyModal').modal('show');
            });

            // 💾 Save family member
            $('#saveFamilyBtn').on('click', function() {
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
 
                $.ajax({
                url: baseUrl + "staff-family/add/" + staffId,
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

    
        // === Nomination integration starts ===
            

            // 🧭 Fetch and display Nomination details
            function loadNominationDetails() {
                $.ajax({
                url: baseUrl + "staff-nomination/lists/" + staffId,
                method: "GET",
                dataType: "json",
                success: function(response) {                             
                    let data = response.data;
                    
                    $('#nomination_as_id').empty().append('<option value="">Select Nomination As</option>');

                    // Populate options dynamically
                    response.familyList.forEach(member => {
                    const displayText = `${member.family_member_name} (${member.relationship?.relationship || '-'})`;
                            $('#nomination_as_id').append(`<option value="${member.id}">${displayText}</option>`);
                    });


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
                                <th>Nomination Type</th>
                                <th>Nominate To</th>
                                <th>Date of Nomination</th>
                                <th>Nomination Percentage</th>
                            </tr>
                            </thead>
                            <tbody>`;
                        $.each(data, function(i, row) {
                            table += `
                                <tr>
                                <td>${i + 1}</td>
                                <td>${row?.nomination_type?.nomination_type || '-'}</td>
                                <td>${row?.staff_family?.family_member_name || '-'}</td>
                                <td>${row.date_of_nomination ? new Date(row.date_of_nomination).toLocaleDateString('en-GB') : '-'}</td>
                                <td>${row.nomination_percentage || '-'}</td>
                                </tr>`;
                        });
                    table += "</tbody></table>";
                    $('#nominationTableContainer').html(table);
                },
                error: function() {
                    $('#nominationTableContainer').html('<p class="text-danger text-center py-3">Error loading family details.</p>');
                }
                });
            }


            // 🎯 Add new Nomination record button
            $('#addNominationBtn').on('click', function() {
                $('#nominationForm')[0].reset();
                $('#nominationModal').modal('show');
                $('#nominationError').hide();
            });

            // 💾 Save Nomination record
            $('#saveNominationBtn').on('click', function() {
                const formData = $('#nominationForm').serializeArray();
                let payload = {};
                
                payload['staff_id'] = $("#__sid").val();
                payload['_Token'] = 'ZGVlcGFraHBhdGlsMzAwODE5ODA=';
                formData.forEach(f => payload[f.name] = f.value);
                if(payload['nomination_type_id'] == ''){
                    $('#nominationError').show();
                    $('#nominationError').html('<p style="padding:10px;" class="text-danger text-center py-3">Please select Nomination Type.</p>');
                    return;                    
                }

                if(payload['nomination_as_id'] == ''){
                    $('#nominationError').show();
                    $('#nominationError').html('<p style="padding:10px;" class="text-danger text-center py-3">Please select Person to Nominate.</p>');
                    return;                    
                }

                if(payload['date_of_nomination'] == ''){
                    $('#nominationError').show();
                    $('#nominationError').html('<p style="padding:10px;" class="text-danger text-center py-3">Please enter Nomination Date.</p>');
                    return;                    
                }
                let percent = parseInt(payload['nomination_percentage'], 10) || 0;
                //alert(payload['nomination_percentage']+"========"+percent);
                if (!(percent > 0 && percent <= 100)) {
                //if(payload['nomination_percentage'] > 0){
                    $('#nominationError').show();
                    $('#nominationError').html('<p style="padding:10px;" class="text-danger text-center py-3">Please Enter Nomination Percentage.</p>');
                    return;                    
                }        



                $.ajax({
                url: baseUrl + "staff-nomination/add/" + staffId,
                type: "POST",
                contentType: 'application/json', 
                dataType: 'json',   
                data: JSON.stringify(payload),
                headers: {
                                'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                            },
                success: function() {
                    $('#nominationModal').modal('hide');
                    loadNominationDetails();
                },
                error: function() {
                    alert("Failed to save family member.");
                }
                });
            });
        // === Nomination integration end ===


        


        // === Academic Qualification integration starts ===
            $("#academic_level_code").on("change", function () {

                let levelId = $(this).val();

                // Reset degrees dropdown
                $("#academic_degree_code").html('<option value="">Loading...</option>');

                if (!levelId) {
                    $("#academic_degree_code").html('<option value="">Select Degree / Trade</option>');
                    return;
                }

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

                        $("#academic_degree_code").html(options);
                    },
                    error: function () {
                        $("#academic_degree_code").html('<option value="">Error loading degrees</option>');
                    }
                });

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
                        $('#academic_level_code').empty().append('<option value="">Select Academic Level</option>');

                        // Populate options dynamically
                        res.levels.forEach(level => {
                                $('#academic_level_code').append(`<option value="${level.id}">${level.level_name}</option>`);
                        });

                        $('#academic_medium').empty().append('<option value="">Select Academic Medium</option>');

                        // Populate options dynamically
                        res.mediums.forEach(medium => {
                                $('#academic_medium').append(`<option value="${medium.id}">${medium.name}</option>`);
                        });


                        $('#academic_board_university').empty().append('<option value="">Select Board/University</option>');

                        // Populate options dynamically
                        res.universities.forEach(unv => {
                                $('#academic_board_university').append(`<option value="${unv.id}">${unv.name}</option>`);
                        });


                        $('#academic_state').empty().append('<option value="">Select State</option>');

                        // Populate options dynamically
                        res.states.forEach(state => {
                                $('#academic_state').append(`<option value="${state.id}">${state.name}</option>`);
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
                        <th>Completion Date</th>
                        <th style="width:100px">View</th>
                        </tr>
                    </thead>
                    <tbody>
                `;

                items.forEach((row, i) => {
                    html += `
                    <tr data-id="${row.id}">
                        <td>${i + 1}</td>
                        <td>${(row?.academic_qualification_level?.level_name || '-')}</td>  
                        <td>${(row?.academic_qualification_degree?.name || '-')}</td>                        
                        <td>${(row?.medium?.name || '-')}</td>
                        <td>${(row?.university?.name || '-')}</td>
                        <td>${row.academic_month_passing} - ${row.academic_year_passing}</td>
                        <td><button class="btn btn-sm btn-outline-primary viewQualBtn" data-item='${JSON.stringify(row).replace(/'/g,"&#39;")}'>View</button></td>
                    </tr>
                    `;
                });

                html += '</tbody></table>';
                $('#qualTableContainer').html(html);
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
                const form = document.getElementById('addQualForm');

                if (!form.checkValidity()) {
                    form.classList.add('was-validated');
                    return;
                }

                const formData = $('#addQualForm').serializeArray();
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
                     loadAcademicQualifications();
                    

                },
                error: function(xhr) {
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
            $('#addAcademicQualificationBtn').on('click', openAddModal);

            // submit add qualification
            $('#addQualForm').on('submit', submitAddAcademicQualification);

            // delegate view detail clicks
            $('#qualTableContainer').on('click', '.viewQualBtn', function() {
                const item = $(this).attr('data-item');
                const row = JSON.parse(item.replace(/&apos;|&#39;/g, "'"));
                showAcademicQualificationDetails(row);
            });
        // === Academic Qualification integration end ===


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
                "Personal Details", "Address Details", "Other Personal Details", "Family Details", "Nomination Details",
                "Caste Category & Certification", "Disability Details",
                "Academic Qualifications", "Professional Qualifications", "UDISE Qualification Details", "TET/CTET Details",
                "Initial Appointment", "Teaching Details (UDISE)", "Service Tracking", "Attach / Detach", "Superannuation", "Death Cases",
                "Pay Details", "PF/DCPS/GPF", "Bank Account", "Leave Details", "Rewards",
                "Training Attended", "Disciplinary Actions", "Complaints"
            ];
            var modules = [
                "Basic Information", "Caste & Disability", "Qualifications", "Employment Details", "Financial & Benefits", "Training & Compliance"
            ];
            var currentIndex = 0;

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
                }else if((currentIndex>=11) && (currentIndex<=16)){
                $("#breadcrumbTrail li:eq(-2)").text(modules[3]);
                }else if((currentIndex>=17) && (currentIndex<=21)){
                $("#breadcrumbTrail li:eq(-2)").text(modules[4]);
                }else if((currentIndex>=22) && (currentIndex<=24)){
                $("#breadcrumbTrail li:eq(-2)").text(modules[5]);
                }

                $("#prevBtn").prop("disabled", currentIndex === 0);
                $("#nextBtn").prop("disabled", currentIndex === sections.length - 1);
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
                //alert(normalizedSection);
                if (normalizedSection === 'personal-details') {
                    //alert(sID+"---"+uMD)
                    if(uMD==2){
                        let shikshan_sevak = $('input[name="shikshan_sevak"]:checked').val();                
                        let joining_district = $("#joining_district").val();
                        let joining_block = $("#joining_block").val();
                        let joining_designation = $("#joining_designation").val();         
                        

                        payload = {           
                                staff_id: sID,
                                shikshan_sevak: shikshan_sevak,
                                joining_district: joining_district,
                                joining_block: joining_block,
                                joining_designation: joining_designation,
                                _Token:'ZGVlcGFraHBhdGlsMzAwODE5ODA='
                            };
                    }else{
                        payload = {};
                    }
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
                        success: function(response) {
                            //$('#processingModal').hide();
                            //alert(response.statusCode);
                            /*if(response.statusCode == 1){
                                $('#responseMessage').html('<span class="text-success">' + response.response.message + '</span>');
                                $('#proceedDiv').html('Please <a href="school/staff-profile/'+currentStaffId+'"><button id="proceedBtn" type="button" class="btn btn-success btn-lg rounded-pill shadow"><i class="bi bi-shield-check me-2"></i> click here </button></a> to proceed and complete the remaining information for this staff member.');
                                $('#proceedDiv').fadeIn(800);
                                
                            }else{
                                $('#responseMessage').html('<span class="text-danger">' + response.response.message + '</span>');
                                $('#submitBtn').show();
                            }*/
                            if (currentIndex < sections.length - 1) {
                                currentIndex++;
                                updateUI();
                            }
                            
                        },           
                        error: function(xhr) {
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
                }else if(normalizedSection === 'address-details') {
                    let permanent_address_line1 = $("#permanent_address_line1").val();
                    let permanent_address_line2 = $("#permanent_address_line2").val(); 
                    let permanent_landmark = $("#permanent_landmark").val();
                    let permanent_village = $("#permanent_village").val(); 
                    let permanent_block = $("#permanent_block").val();
                    let permanent_district = $("#permanent_district").val(); 
                    let permanent_state = $("#permanent_state").val();
                    let permanent_pincode = $("#permanent_pincode").val();     

                    let current_address_line1 = $("#current_address_line1").val();
                    let current_address_line2 = $("#current_address_line2").val(); 
                    let current_landmark = $("#current_landmark").val();
                    let current_village = $("#current_village").val(); 
                    let current_block = $("#current_block").val();
                    let current_district = $("#current_district").val(); 
                    let current_state = $("#current_state").val();
                    let current_pincode = $("#current_pincode").val(); 

                    
                    payload = {           
                            staff_id: sID,
                            permanent_address_line1: permanent_address_line1,
                            permanent_address_line2: permanent_address_line2,
                            permanent_landmark: permanent_landmark,
                            permanent_village: permanent_village,
                            permanent_block: permanent_block,
                            permanent_district: permanent_district,
                            permanent_state: permanent_state,
                            permanent_pincode:permanent_pincode,
                            current_address_line1: current_address_line1,
                            current_address_line2: current_address_line2,
                            current_landmark: current_landmark,
                            current_village: current_village,
                            current_block: current_block,
                            current_district: current_district,
                            current_state: current_state,
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
                            
                            //$('#processingModal').show();
                            //alert(11)
                            $('#responseMessage').html('<span class="text-info"><div class="text-info d-flex align-items-center"><div class="spinner-border spinner-border-sm me-2" role="status"></div><span>Processing...</span></div></span>');
                        },
                        success: function(response) {
                            //$('#processingModal').hide();
                            //alert(response.statusCode);
                            /*if(response.statusCode == 1){
                                $('#responseMessage').html('<span class="text-success">' + response.response.message + '</span>');
                                $('#proceedDiv').html('Please <a href="school/staff-profile/'+currentStaffId+'"><button id="proceedBtn" type="button" class="btn btn-success btn-lg rounded-pill shadow"><i class="bi bi-shield-check me-2"></i> click here </button></a> to proceed and complete the remaining information for this staff member.');
                                $('#proceedDiv').fadeIn(800);
                                
                            }else{
                                $('#responseMessage').html('<span class="text-danger">' + response.response.message + '</span>');
                                $('#submitBtn').show();
                            }*/
                            if (currentIndex < sections.length - 1) {
                                currentIndex++;
                                updateUI();
                            }
                            
                        },           
                        error: function(xhr) {
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
                }else if(normalizedSection === 'other-personal-details') {
                    let payload = {};
                    payload['staff_id'] = sID;
                    payload['_Token'] = 'ZGVlcGFraHBhdGlsMzAwODE5ODA=';
                    $.each($('#content-section-2 form').serializeArray(), function(_, kv) {
                            payload[kv.name] = kv.value;
                    });

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
                            
                            if (currentIndex < sections.length - 1) {
                                currentIndex++;
                                updateUI();
                                loadFamilyDetails();
                            }
                            
                        },           
                        error: function(xhr) {
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
                    
                }else if(normalizedSection === 'family-details'){
                    if (currentIndex < sections.length - 1) {
                        currentIndex++;
                        updateUI();
                        loadNominationDetails();
                    }
                  
                }else if(normalizedSection === 'nomination-details'){
                    
                    
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

                            for (const [key, value] of Object.entries(response.data)) {
                                //console.log(`${key}: ${value}`);
                                $("#"+key).val(value);
                            }
                            
                            
                        },           
                        error: function(xhr) {
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
                }else if(normalizedSection === 'caste-category-&-certification'){
                    let payload = {};
                    payload['staff_id'] = sID;
                    payload['_Token'] = 'ZGVlcGFraHBhdGlsMzAwODE5ODA=';
                    $.each($('#content-section-5 form').serializeArray(), function(_, kv) {
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
                            alert(2)
                            if (currentIndex < sections.length - 1) {
                                currentIndex++;
                                updateUI();
                                alert(1)
                                loadAcademicQualifications();
                            }
                            
                        },           
                        error: function(xhr) {
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
                }else{
                    if (currentIndex < sections.length - 1) {
                        currentIndex++;
                        updateUI();
                    }
                }
//alert(normalizedSection);
                
                


            
                
            });

            updateUI();
        // === Navigation integration starts ===
    });

   
</script>





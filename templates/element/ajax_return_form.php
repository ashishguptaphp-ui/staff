<?php 
    

        $html = $this->Form->create(null, [
            'id' => 'returnApplicationForm',
            'type' => 'file'
        ]);
        

        $html .= '<formffff id="returnApplicationForm" method="post" enctype="multipart/form-data"><div class="row mb-2">        
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
                                     Form-16. Year 2
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

        </div>';
        

        $html .= $this->Form->end();
        ?>
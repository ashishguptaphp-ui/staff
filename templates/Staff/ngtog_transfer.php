<style>
    /* Overlay Styling */
    .sync-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.9);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 9999;
    }

    /* Centered Box */
    .sync-box {
    text-align: center;
    background: #f9fafc;
    padding: 40px 60px;
    border-radius: 16px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    animation: fadeIn 0.5s ease-in-out;
    }

    /* Spinner */
    .spinner {
    border: 6px solid #e0e0e0;
    border-top: 6px solid #007bff;
    border-radius: 50%;
    width: 70px;
    height: 70px;
    margin: 0 auto 20px auto;
    animation: spin 1.2s linear infinite;
    }

    /* Text */
    .sync-message {
    font-size: 1.1rem;
    color: #333;
    font-weight: 500;
    }

    /* Animations */
    @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
    }

    @keyframes fadeIn {
    from { opacity: 0; transform: scale(0.95); }
    to { opacity: 1; transform: scale(1); }
    }
    #syncMessage {
      font-size: 1.2rem;
      font-weight: 500;
      background: #fff;
      padding: 20px 40px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      border-left: 4px solid #1565c0;
      min-width: 420px;
      text-align: center;
    }

     #okButton {
      
      background-color: #28a745;
      border: none;
      color: white;
      padding: 10px 25px;
      border-radius: 6px;
      font-size: 1rem;
      cursor: pointer;
      margin-top: 15px;
      transition: background 0.3s;
    }

    #okButton:hover {
      background-color: #218838;
    }
    table tbody tr td{
        font-size: 14px;
        font-family: Roboto EMOJI;
    }
</style>
    

<style>
    /* Slide Panel */
    .slide-panel {
        position: fixed;
        top: 0;
        right: -100%;
        width: 100%;
        height: 100%;
        background: #ffffff;
        box-shadow: -2px 0 10px rgba(0,0,0,0.15);
        transition: right 0.3s ease-in-out;
        z-index: 1050;
        display: flex;
        flex-direction: column;
    }

    .slide-panel.open {
        right: 0;
    }

    /* Mobile */
    @media (max-width: 768px) {
        .slide-panel {
            width: 100%;
            right: -100%;
        }
    }

    .slide-header,
    .slide-footer {
        padding: 12px 16px;
        border-bottom: 1px solid #dee2e6;
        background: #f8f9fa;
    }

    .slide-footer {
        border-top: 1px solid #dee2e6;
        margin-top: auto;
    }

    .slide-body {
        padding: 3px;
        overflow-y: auto;
    }
</style>

<style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
        }
        
        body {
            font-family: 'Segoe UI', 'Nirmala UI', sans-serif;
           
        }
        
        .header-section {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 15px 0;
            border-radius: 0 0 10px 10px;
            margin-bottom: 30px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .form-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            padding: 0px 20px 20px 20px;
            margin-bottom: 30px;
        }
        
        .section-title {
            color: var(--primary-color);
            border-bottom: 1px solid var(--secondary-color);
            padding-bottom: 3px;
            margin-bottom: 3px;
            font-weight: 600;
            font-size:22px;
        }
        
        .form-label {
            font-weight: 600;
            color: #444;
            margin-bottom: 8px;
        }
        
        .marathi-label {
            color: #2c3e50;
            font-weight: 600;
        }
        
        .english-label {
            color: #7f8c8d;
            font-size: 0.9rem;
            font-style: italic;
        }
        
        .required-field::after {
            content: " *";
            color: var(--accent-color);
        }
        
        .file-upload-area {
            border: 2px dashed #ddd;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s;
            cursor: pointer;
            background-color: #f9f9f9;
        }
        
        .file-upload-area:hover {
            border-color: var(--secondary-color);
            background-color: #f0f7ff;
        }
        
        .file-upload-area.dragover {
            border-color: var(--secondary-color);
            background-color: #e8f4fc;
        }
        
        .file-list {
            margin-top: 15px;
        }
        
        .file-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px 12px;
            background-color: #f1f8ff;
            border-radius: 5px;
            margin-bottom: 8px;
            border-left: 4px solid var(--secondary-color);
        }
        
        .file-icon {
            color: var(--secondary-color);
            margin-right: 10px;
        }
        
        .btn-submit {
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 12px 30px;
            font-weight: 600;
            border: none;
            border-radius: 6px;
            transition: all 0.3s;
        }
        
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .progress-section {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 300px;
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.1);
            z-index: 1000;
        }
        
       
        
        .pdf-field {
            background:#fff;
            padding:10px 0px;;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
        }
        
        .form-section {
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 1px solid #6d6868;
        }
        
        @media (max-width: 768px) {
            .form-container {
                padding: 20px;
            }
            
            .progress-section {
                position: static;
                width: 100%;
                margin-top: 20px;
            }
        }

        .section {
                margin-top: 0px;
        

            .section-title {
                font-size: 16px;
                font-weight: 700;
                color: #0b5ed7;
                margin-bottom: 14px;
                border-left: 4px solid #0b5ed7;
                padding-left: 10px;
            }

            .grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
                gap: 16px;
            }

            .field {
                background: #f9fafb;
                border-radius: 12px;
                padding: 14px 16px;
            }

            .label {
                font-size: 13px;
                color: #6b7280;
                margin-bottom: 4px;
            }

            .value {
                font-size: 15px;
                font-weight: 600;
                color: #111827;
            }

            .highlight {
                background: #eef2ff;
                border-left: 5px solid #6366f1;
            }
        }

        .card {
        background: #ffffff;
        border-left: 6px solid #2b6cb0;
        padding: 10px;
        
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        margin-bottom: 20px;
    }

    .checkbox-label {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 17px;
        font-weight: 600;
        cursor: pointer;
    }

    input[type="checkbox"] {
        width: 20px;
        height: 20px;
        accent-color: #2b6cb0;
        cursor: pointer;
    }

    .transfer-section {
        display: none;
        margin-top: 0px;
        padding: 10px;
        border: 1px dashed #cbd5e0;
        border-radius: 8px;
        background: #f8fafc;
    }

    .transfer-section h4 {
        margin: 0 0 3px;
        color: #2b6cb0;
    }

    .field {
        margin-bottom: 3px;
    }

    .field label {
        font-weight: 600;
        display: block;
        margin-bottom: 4px;
    }

    .field input select {
        width: 100%;
        padding: 8px 10px;
        border: 1px solid #cbd5e0;
        border-radius: 6px;
    }
</style>


<h5 style="margin:0px;padding:10px; color: #1a237e; border-bottom: 2px solid #1a237e;">
       
        🔜👨‍💼 List of Non-Granted Teaching Staffs 
      
</h5>
<!-- Bootstrap + Bootstrap Icons -->
<div style="background: #fff; padding:10px;">      
    
        

        <table id="staffTable" class="table table-bordered table-striped table-hover align-middle">
            <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Staff Name</th>                
                <!--<th>IMP IDs <small>(as UD+)</small></th>-->
                     
                <th>Post</th>   
                <th>Staff Type</th>    
                <th>Medium</th>      
                <th>Subject</th>
                <th>Aid Type</th>   
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>                        
                <?php 
                $idx =1;
                //dd($staffs);
                
                foreach ($staffs as $staff): 
                    /*echo "<pre>ddd";
                    print_r($staff);
                    exit;*/
                    $status = 'Pending';
                    /*if(isset($staff->staff_transfer->status)){
                        $status = $staff->staff_transfer->status;
                    }else{
                        $status = 'Pending';
                    }*/
                    
                    //exit;
                    
                    if(!empty($staff->photo_base64)){
                       // $imgData="data:image/jpeg;base64,".$staff->photo_base64;
                        $imgData=$staff->photo_base64;
                    }else{
                        $imgData="https://eu.ui-avatars.com/api/?name=".$staff->teacher_name."&size=50";
                    }
                   
                    
                ?>
                <tr>
                    <td><?= h($idx++) ?></td>
                    <td style="display: flex;align-items: center;gap: 5px;">
                        <img src="<?= h($imgData) ?>" class="rounded-circle me-2" style="width:50px;height:50px;">
                        <?= h(trim($staff->teacher_name)) ?>
                        <br/><?= h($staff->mobile) ?>
                        <br><?= h($staff->email) ?>
                    </td>
                    
                     <td>
                       <?= h($staff->post->name) ?>
                    </td>
                     <td>
                       <?= h($staff->staffs_type->staff_type_name) ?>
                    </td>
                    
                    <!--<td>
                        EmpStaffID - <?= h($staff->emp_staff_id) ?><br/>
                        NationalID - <?= h($staff->nat_tch_id) ?>
                    </td>-->
                    <td>
                       <?= h($staff->medium->name) ?>
                    </td>
                    <td>
                       <?= h($staff->subject_taught) ?>
                    </td>
                    <td>
                       <?= h($staff->aid_master->name) ?>
                    </td>
                   
                    <td>
                        <?= \Cake\Utility\Inflector::humanize(
                                \Cake\Utility\Inflector::underscore($status)
                        ) ?>

                    </td>

                    <td>
                        <?php if($status == 'Pending') {?>
                            <button class="btn btn-primary badge bg-danger text-light action-ud js-open-transfer" data-staffObject='<?= json_encode($staff, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>' data-id="NGG-2025-001">
                                <i class="fa-solid fa-arrow-trend-up"></i> Process Transfer
                            </button>
                        <?php } ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
       
</div>

<!-- Slide Panel -->
<div id="transferSlider" class="slide-panel" aria-hidden="true" style="border:3px solid #537895;">

    <!-- Header -->
    <div class="slide-header d-flex justify-content-between align-items-center" style="background:#537895;color:#fff;">
        <div style="width:100%;">
            <h6 class="mb-0">Non-Grant → Grant Aided Transfer <div style="float:right;color:#fff !important;font-size:12px;margin-right:50px;" class="text-muted">Staff Name: <span id="empName"></span></div></h6>
            <!--<small class="text-muted">Case ID: <span id="caseId"></span></small>-->
            
           
        </div>
        <button class="btn btn-sm btn-outline-danger js-close-slider">X</button>
    </div>

    <!-- Body -->
    <div class="slide-body">

        <div class="form-container">
           

            <form id="teacherTransferForm" enctype="multipart/form-data">
                <input type="hidden" value="" name="staffId" id="staffId">
                <div class="section">
                    <div class="section-title">👤 <span id="empNameDetails"></span></div>
                    <div class="row mb-2">
                         <div class="col-md-3">
                            <label for="institutionCode" class="form-label marathi-label">संस्था कोड <span class="english-label">(Institution Code)</span> &rarr; <span class="txtval" id="institutionCode"></span></label>                            
                        </div>
                        <div class="col-md-9">                            
                            <label for="institutionName" class="form-label marathi-label">संस्थेचे नाव <span class="english-label">(Institution Name)</span> &rarr; <span class="txtval" id="institutionName"></span></label> 
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3">
                        <label for="udiseNumber" class="form-label marathi-label">UDISE क्रमांक 
                            <span class="english-label">(UDISE Code)</span> &rarr; <span class="txtval" id="udiseNumber">  
                                <?= h($school->udise_code) ?>    </span></label> 
                    </div>
                
                
                    <div class="col-md-9">
                        <label for="schoolName" class="form-label marathi-label">शाळेचे नाव 
                            <span class="english-label">(School Name)</span> &rarr; <span class="txtval" id="schoolName"> <?= h($school->school_name) ?></span></label> 
                    </div>                  
                    
                    <!-- 1.1 शाळेचे ठिकाण -->
                    <div class="col-md-12">
                        <label for="schoolLocation" class="form-label marathi-label">शाळेचे ठिकाण <span class="english-label">(School Location)</span> &rarr; <span class="txtval" id="schoolLocation"></span></label> 
                    </div>
                </div>
                
                <div class="card">
                    <label class="checkbox-label">
                        <input type="checkbox" id="transferCheck" name="transferCheck" onchange="toggleDiv('transferCheck','transferDiv')">
                        बदलीने रुजू होणारी शाळा ही सध्याच्या शाळेपेक्षा वेगळी आहे का?
                    </label>

                    <!-- Transfer School Details -->
                    <div id="transferDiv" class="transfer-section">
                       
                        <div class="field">
                            <label for="transferSchool">बदलीने रुजू होण्यासाठी प्रस्तावित शाळा निवडा</label>
                             <select class="form-select" id="transferSchool" name="transferSchool" required>                   
                                <option value="">-- Select Transfer School --</option>
                                <option value="">27250100101 | Zilla Parishad Primary School, Vadgaon | Vadgaon, Pune</option>
                                <option value="">27250100203 | Zilla Parishad Secondary School, Shirur | Shirur, Pune</option>
                                <option value="">27250200405 | New English School | Shivajinagar, Pune</option>
                                <option value="">27250300607 | Shri Chhatrapati Shivaji Secondary School | Baramati, Pune</option>
                                <option value="">27250400809 | Zilla Parishad Primary School, Indapur | Indapur, Pune</option>
                               
                            </select> 
                        </div>                        
                    </div>
                </div>

                
                <div class="row mb-2">
                    <div class="col-md-4">
                        <label for="udiseNumber" class="form-label marathi-label">वेतनश्रेणी 
                            <span class="english-label">(Salary Grade)</span> &rarr; <span class="txtval" id="salarygrade">  
                             </span></label> 
                    </div>
                
                
                    <div class="col-md-4">
                        <label for="schoolName" class="form-label marathi-label">अध्यापन विषय
                            <span class="english-label">(Teaching Subjects)</span> &rarr; <span class="txtval" id="teachingSubjects">
                                </span></label> 
                    </div> 
                    
                    <div class="col-md-4">
                        <label for="schoolName" class="form-label marathi-label">अध्यापनाचे माध्यम 
                            <span class="english-label">(Medium)</span> &rarr; <span class="txtval" id="medium">
                                </span></label> 
                    </div> 
                </div>
               
                   
                    
                    <!-- 1.4 अध्यापन विषय -->
                    <div class="row mb-3">
                       
                        <div class="col-md-3">
                            <label for="panNumber" class="form-label marathi-label required-field">पॅन क्रमांक <span class="english-label">(PAN)</span></label>
                            <input type="text" class="form-control" id="panNumber" name="panNumber" pattern="[A-Z]{5}[0-9]{4}[A-Z]{1}" required>
                        </div>
                         <!-- 1.9 आधार क्रमांक -->
                          <div class="col-md-3">
                            <label for="aadharNumber" class="form-label marathi-label required-field">आधार क्रमांक <span class="english-label">(Aadhar)</span></label>
                            <input type="text" class="form-control" id="aadharNumber" name="aadharNumber" pattern="[0-9]{12}" required>
                            
                        </div>
                        
                        <!-- 1.5 अध्यापन वर्ग -->
                        <div class="col-md-6">
                            <label class="form-label marathi-label required-field">अध्यापन वर्ग <span class="english-label">(Teaching Classes)</span></label>
                            <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="class1to5" name="teachingClasses" value="1-5">
                                            <label class="form-check-label marathi-label" for="class1to5">&nbsp;&nbsp; इयत्ता 1 ते 5</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                    
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="class6to8" name="teachingClasses" value="6-8">
                                            <label class="form-check-label marathi-label" for="class6to8">&nbsp;&nbsp; इयत्ता 6 ते 8</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="class9to10" name="teachingClasses" value="9-10">
                                            <label class="form-check-label marathi-label" for="class9to10">&nbsp;&nbsp; इयत्ता 9 ते 10</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="class11to12" name="teachingClasses" value="11-12">
                                            <label class="form-check-label marathi-label" for="class11to12">&nbsp;&nbsp; इयत्ता 11 ते 12</label>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    
                    
                   
                    
                    <!-- Additional Details Row -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="originalCategory" class="form-label marathi-label required-field">मूळ आरक्षण प्रवर्ग <span class="english-label">(Original)</span></label>
                            <select class="form-select" id="originalCategory" name="originalCategory" required>                            
                                <option value="">-- Select Original Category --</option>
                                <?php 
                                    foreach($casteCategories as $cc){
                                        echo '<option value="'.$cc->code.'">'.$cc->category_name.'</option>';
                                    }
                                ?>
                            </select> 
                        </div>
                        <div class="col-md-4">
                            <label for="appointmentCategory" class="form-label marathi-label required-field">नियुक्तीचा आरक्षण प्रवर्ग <span class="english-label">(Appointment)</span></label>
                            <select class="form-select" id="appointmentCategory" name="appointmentCategory" required>                   
                                <option value="">-- Select Appointment Category --</option>
                                <?php 
                                    foreach($casteCategories as $cc){
                                        echo '<option value="'.$cc->code.'">'.$cc->category_name.'</option>';
                                    }
                                ?>
                            </select> 
                        </div>
                        <div class="col-md-4">
                            <label for="appointmentCategory" class="form-label marathi-label required-field">समांतर आरक्षण प्रवर्ग <span class="english-label">(Horizontal)</span></label>
                            <select class="form-select" id="appointmentCategory" name="appointmentCategory" required>                   
                                <option value="">-- Select Horizontal Category --</option>
                                <?php 
                                    foreach($horizontalCategories as $hc){
                                        echo '<option value="'.$hc->id.'">'.$hc->name.'</option>';
                                    }
                                ?>
                            </select> 
                        </div>
                       
                    </div>
                    
                   

                    <!-- Section 3: शाळा परवानगी -->
                    <div class="pdf-field">
                        <h3 class="section-title">शाळा परवानगी आदेश माहिती</h3>
                        
                       
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="schoolPermissionOrderNumber" class="form-label marathi-label required-field">आदेश क्रमांक <span class="english-label">(Order No.)</span></label>
                                <input type="text" class="form-control" id="schoolPermissionOrderNumber" name="schoolPermissionOrderNumber" required>
                            <br/>
                                <label for="schoolPermissionOrderDate" class="form-label marathi-label required-field">दिनांक <span class="english-label">(Date)</span></label>
                                <input type="date" class="form-control" id="schoolPermissionOrderDate" name="schoolPermissionOrderDate" required>                                

                            </div>
                            <div class="col-md-8">
                                
                                <div>                                        
                                    <div class="file-upload-area" id="schoolPermissionOrderUploadArea">
                                        <i class="bi bi-cloud-arrow-up" style="font-size: 2rem; color: #6c757d;"></i>
                                        <p class="mt-2">PDF फाईल ड्रॅग & ड्रॉप करा किंवा <span class="text-primary">ब्राउझ करा</span></p>
                                        <p class="text-muted small">कमाल आकार: 5MB | फक्त PDF फाइल्स</p>
                                        <input type="file" class="d-none" id="schoolPermissionOrderFile" name="schoolPermissionOrderFile" accept=".pdf">
                                    </div>
                                    <div class="file-list" id="schoolPermissionOrderFileList"></div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    

                    <div class="card">
                        <label class="checkbox-label">
                            <input type="checkbox" id="minorityCheck"  name="minorityCheck" onchange="toggleDiv('minorityCheck','minorityDiv')">
                            सदर शाळा अल्पसंख्याक प्रवर्गातील आहे.
                        </label>

                         <!-- Section 4: अल्पसंख्याक प्रमाणपत्र -->
                        <div id="minorityDiv" class="transfer-section">
                        
                           <div class="pdf-field">
                            <h3 class="section-title">अल्पसंख्याक शाळा प्रमाणपत्र</h3>                        
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="minorityCertOutwardNumber" class="form-label marathi-label required-field">जावक क्रमांक <span class="english-label">(Outward No.)</span></label>
                                    <input type="text" class="form-control" id="minorityCertOutwardNumber" name="minorityCertOutwardNumber" required>
                                    <br/>
                                    <label for="minorityCertOutwardDate" class="form-label marathi-label required-field">दिनांक <span class="english-label">(Date)</span></label>
                                    <input type="date" class="form-control" id="minorityCertOutwardDate" name="minorityCertOutwardDate" required>                                

                                </div>
                                <div class="col-md-8">     
                                    <div class="file-upload-area" id="minorityCertUploadArea">
                                        <i class="bi bi-cloud-arrow-up" style="font-size: 2rem; color: #6c757d;"></i>
                                        <p class="mt-2">PDF फाईल ड्रॅग & ड्रॉप करा किंवा <span class="text-primary">ब्राउझ करा</span></p>
                                        <p class="text-muted small">कमाल आकार: 5MB | फक्त PDF फाइल्स</p>
                                        <input type="file" class="d-none" id="minorityCertOutwardFile" name="minorityCertOutwardFile" accept=".pdf">
                                    </div>
                                    <div class="file-list" id="minorityCertOutwardFileList"></div>
                                
                                </div>
                                
                            </div> 
                        </div>                      
                        </div>
                    </div>
                    
                   
                    <!--

                    <div class="pdf-field">
                        <h3 class="section-title">बदलीने रुजू होणाऱ्या शाळेची माहिती</h3>                        
                        <div class="row mb-3">

                            <div class="col-md-6">
                                <label for="schoolNameAtTransfer" class="form-label marathi-label required-field">शाळेचे नाव <span class="english-label">(School Name)</span></label> 
                                <input type="text" class="form-control api-field" id="schoolNameAtTransfer" name="schoolNameAtTransfer" required readonly>                           
                                <br/>
                                <label for="udiseNumberAtTransfer" class="form-label marathi-label required-field">UDISE क्रमांक <span class="english-label">(UDISE Number)</span></label> 
                                <input type="text" class="form-control api-field" id="udiseNumberAtTransfer" name="udiseNumberAtTransfer" required readonly>                            
                                <br/>
                                <label for="schoolLocationAtTransfer" class="form-label marathi-label required-field">शाळेचे ठिकाण <span class="english-label">(School Location)</span></label> 
                                <input type="text" class="form-control api-field" id="schoolLocationAtTransfer" name="schoolLocationAtTransfer" required readonly>                           
                            </div>
                            <div class="col-md-6">
                                <div class="file-upload-area" id="schoolAtTransferUploadArea">
                                    <i class="bi bi-cloud-arrow-up" style="font-size: 2rem; color: #6c757d;"></i>
                                    <p class="mt-2">PDF फाईल ड्रॅग & ड्रॉप करा किंवा <span class="text-primary">ब्राउझ करा</span></p>
                                    <p class="text-muted small">कमाल आकार: 5MB | फक्त PDF फाइल्स</p>
                                    <input type="file" class="d-none" id="schoolAtTransferFile" name="schoolAtTransferFile" accept=".pdf">
                                </div>
                                <div class="file-list" id="schoolAtTransferFileList"></div>
                            </div>                            
                        </div> 
                    </div>
                    -->
              
                
                    <div class="pdf-field">
                        <h3 class="section-title">शैक्षणिक व व्यावसायिक अर्हता. <small style="font-size:10px;">संबंधित शिक्षकाची शैक्षणिक व व्यावसायिक अर्हता प्रमाणपत्रे • शासन निर्णय दिनांक 25.02.2019 नुसार.</small></h3>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="hscFile" class="form-label marathi-label required-field">
                                    उच्च माध्यमिक <span class="english-label">(HSC / 12th)</span>
                                </label>
                                <input type="file" id="hscFile" name="hscFile" class="form-control" accept=".pdf">                      
                            </div>                        
                            <div class="col-md-4">
                                <label for="graduateFile" class="form-label marathi-label required-field">
                                    पदवी <span class="english-label">(Graduate Degree)</span>
                                </label>
                                <input type="file" id="graduateFile" name="graduateFile" class="form-control" accept=".pdf">                      
                            </div>
                             <div class="col-md-4">
                                <label for="postGraduateFile" class="form-label marathi-label required-field">
                                    पदव्युत्तर पदवी  <span class="english-label">(Post Graduate Degree)</span>
                                </label>
                                <input type="file" id="postGraduateFile" name="postGraduateFile" class="form-control" accept=".pdf">                      
                            </div>     
                             
                        </div>
                        <hr/>
                        <div class="row">





                   
                            <div class="col-md-4">
                                <label for="dedFile" class="form-label marathi-label required-field">
                                    डी.एड. / समकक्ष  <span class="english-label">(D.Ed / Equivalent)</span>
                                </label>
                                <input type="file" id="dedFile" name="dedFile" class="form-control" accept=".pdf">                      
                            </div>
                             <div class="col-md-4">
                                <label for="bedFile" class="form-label marathi-label required-field">
                                    बी.एड.  <span class="english-label">(B.Ed)</span>
                                </label>
                                <input type="file" id="bedFile" name="bedFile" class="form-control" accept=".pdf">                      
                            </div>                        
                            <div class="col-md-4">
                                <label for="mpedFile" class="form-label marathi-label required-field">
                                    एम.पी.एड. <span class="english-label">(M.P.Ed) </span>
                                </label>
                                <input type="file" id="mpedFile" name="mpedFile" class="form-control" accept=".pdf">                      
                            </div>

                        </div> 
                        <!--
                        <div class="row">
                            <div class="col-md-4">
                            शैक्षणिक व व्यावसायिक अर्हता
                            </div>                        
                            <div class="col-md-8">
                                PDF फाईल प्रमाणपत्र
                            </div>
                        </div> 
                        
                        <div class="row mb-2">                        
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="qualifications1" name="qualifications1" required>
                            </div>                        
                            <div class="col-md-8">
                                <label for="qualifications1File" class="form-label marathi-label required-field">उच्च माध्यमिक <span class="english-label">(HSC / 12th)</span></label>
                                <input type="file" id="qualifications1File" name="qualifications1File" class="form-control" accept=".pdf">
                            </div>
                        </div> 
                        <div class="row mb-2">                        
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="qualifications2" name="qualifications2" required>
                            </div>                        
                            <div class="col-md-8">
                                <input type="file" id="qualifications2File" name="qualifications2File" class="form-control" accept=".pdf">
                            </div>
                        </div> 
                        <div class="row mb-2">                        
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="qualifications3" name="qualifications3" required>
                            </div>                        
                            <div class="col-md-8">
                                <input type="file" id="qualifications3File" name="qualifications3File" class="form-control" accept=".pdf">
                            </div>
                        </div> 
                        <div class="row mb-2">                        
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="qualifications4" name="qualifications4" required>
                            </div>                        
                            <div class="col-md-8">
                                <input type="file" id="qualifications4File" name="qualifications4File" class="form-control" accept=".pdf">
                            </div>
                        </div> 
                        <div class="row mb-2">                        
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="qualifications5" name="qualifications5" required>
                            </div>                        
                            <div class="col-md-8">
                                <input type="file" id="qualifications5File" name="qualifications5File" class="form-control" accept=".pdf">
                            </div>
                        </div> -->

                        
                    </div>
                
                
                
                
                
                <!-- Section 6-24: Other Sections (Condensed for brevity) -->
                <div class="form-section">
                    <h3 class="section-title"> इतर आवश्यक कागदपत्रे</h3>
                    
                    <div class="alert alert-info mb-4">
                        <i class="bi bi-info-circle"></i> खालील सर्व कागदपत्र PDF स्वरूपात अपलोड करणे अनिवार्य आहे. प्रत्येकासाठी स्वतंत्र PDF फाईल अपलोड करा.
                    </div>
                    
                    <!-- List of remaining PDF uploads -->
                    <div class="row">
                        <div class="col-md-4">
                            विवरण 
                        </div> 
                        <div class="col-md-2">
                            जावक क्रमांक 
                        </div>
                        <div class="col-md-2">
                            दिनांक  
                        </div>
                        <div class="col-md-4">
                            PDF फाईल 
                        </div>
                    </div>  

                    
                    
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label marathi-label">शाळा व्यवस्थापन समितीचा ठराव. (MEPS Act 1981)</label>
                        </div> 
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="schoolCommitteeOutwardNumber" name="schoolCommitteeOutwardNumber" required>
                        </div>
                        <div class="col-md-2">
                            <input type="date" class="form-control" id="schoolCommitteeOutwardDate" name="schoolCommitteeOutwardDate" required>                                
  
                        </div>
                        <div class="col-md-4">
                            <input type="file" id="schoolCommitteeOutwardFile" name="schoolCommitteeOutwardFile" class="form-control" accept=".pdf">
                        </div>
                    </div> 
                    
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label marathi-label">विनाअनुदानित / अंशतः अनुदानित तत्त्वावरील मूळ संस्था नियुक्ती आदेश</label>
                        </div> 
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="originSansthaAppointmentNumber" name="originSansthaAppointmentNumber" required>
                        </div>
                        <div class="col-md-2">
                            <input type="date" class="form-control" id="originSansthaAppointmentDate" name="originSansthaAppointmentDate" required>                                
  
                        </div>
                        <div class="col-md-4">
                            <input type="file" id="originSansthaAppointmentFile" name="originSansthaAppointmentFile" class="form-control" accept=".pdf">
                        </div>
                    </div>
                    

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label marathi-label">शिक्षणाधिकारी / उपसंचालक यांनी दिलेला विनाअनुदानित / अंशतः अनुदानित तत्त्वावरील वैयक्तिक मान्यता आदेश</label>
                        </div> 
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="personalRecognitionNumber" name="personalRecognitionNumber" required>
                        </div>
                        <div class="col-md-2">
                            <input type="date" class="form-control" id="personalRecognitionDate" name="personalRecognitionDate" required>                                
  
                        </div>
                        <div class="col-md-4">
                            <input type="file" id="personalRecognitionFile" name="personalRecognitionFile" class="form-control" accept=".pdf">
                        </div>
                    </div>

                     <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label marathi-label">संबंधित व्यवस्थापनाची विनाअनुदानित / अंशतः अनुदानित सेवाज्येष्ठता सूची</label>
                        </div> 
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="serviceSeniorityListNumber" name="serviceSeniorityListNumber" required>
                        </div>
                        <div class="col-md-2">
                            <input type="date" class="form-control" id="serviceSeniorityListDate" name="serviceSeniorityListDate" required>                                
  
                        </div>
                        <div class="col-md-4">
                            <input type="file" id="serviceSeniorityListFile" name="serviceSeniorityListFile" class="form-control" accept=".pdf">
                        </div>
                    </div>

                    <!--<div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label marathi-label">विनाअनुदानित / अंशतः अनुदानित शाळेत 5 वर्षे सेवा केल्याचे (मुख्याध्यापक) प्रमाणपत्र</label>
                        </div> 
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="schoolPermissionOrderNumber" name="schoolPermissionOrderNumber" required>
                        </div>
                        <div class="col-md-2">
                            <input type="date" class="form-control" id="schoolPermissionOrderDate" name="schoolPermissionOrderDate" required>                                
  
                        </div>
                        <div class="col-md-4">
                            <input type="file" id="f_educationQualification" name="f_educationQualification" class="form-control" accept=".pdf">
                        </div>
                    </div>-->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label marathi-label">बदलीपूर्वी बिंदुनामावलीनुसार रिक्त पदाचा विषय व आरक्षण विचारात घेण्यात आल्याचे प्रमाणपत्र</label>
                        </div> 
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="vacantPostAsMeritListNumber" name="vacantPostAsMeritListNumber" required>
                        </div>
                        <div class="col-md-2">
                            <input type="date" class="form-control" id="vacantPostAsMeritListDate" name="vacantPostAsMeritListDate" required>                                
  
                        </div>
                        <div class="col-md-4">
                            <input type="file" id="vacantPostAsMeritListFile" name="vacantPostAsMeritListFile" class="form-control" accept=".pdf">
                        </div>
                    </div>
 
               
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label marathi-label">शासन निर्णय दि. 06.02.2012 व 10.06.2022 नुसार मान्यता असल्याबाबतचा शिक्षणाधिकारी / उपसंचालक यांचा स्पष्ट अभिप्राय</label>
                        </div> 
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="opinionEoDDRecognitionNumber" name="opinionEoDDRecognitionNumber" required>
                        </div>
                        <div class="col-md-2">
                            <input type="date" class="form-control" id="opinionEoDDRecognitionDate" name="opinionEoDDRecognitionDate" required>                                
  
                        </div>
                        <div class="col-md-4">
                            <input type="file" id="opinionEoDDRecognitionFile" name="opinionEoDDRecognitionFile" class="form-control" accept=".pdf">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label marathi-label">विनाअनुदानित / अंशतः अनुदानित शाळेत 5 वर्षे सेवा केल्याचे (मुख्याध्यापक) प्रमाणपत्र</label>
                        </div>                       
                        <div class="col-md-6">
                            <input type="file" id="fiveYrsHMCertificateFile" name="fiveYrsHMCertificateFile" class="form-control" accept=".pdf">
                        </div>
                    </div>
                    <div class="row mb-3">
                       
                            <label class="form-label marathi-label">बदलीस कारणीभूत रिक्त पदाचा तपशील व कागदपत्रे</label>
                          
                        <div class="col-md-8">   
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="VacantPostCausingTransfer1" name="VacantPostCausingTransfer" value="1">
                                        <label class="form-check-label marathi-label" for="class1to5">&nbsp;&nbsp; सेवा निवृत्ती</label>
                                    </div>
                                </div>
                                <div class="col-md-2">                                    
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="VacantPostCausingTransfer2" name="VacantPostCausingTransfer" value="2">
                                        <label class="form-check-label marathi-label" for="VacantPostCausingTransfer2">&nbsp;&nbsp; राजीनामा</label>
                                    </div>
                                </div>
                                <div class="col-md-2">                                    
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="VacantPostCausingTransfer3" name="VacantPostCausingTransfer" value="3">
                                        <label class="form-check-label marathi-label" for="VacantPostCausingTransfer3">&nbsp;&nbsp; मृत्यू</label>
                                    </div>
                                </div>

                                <div class="col-md-2">                                    
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="VacantPostCausingTransfer4" name="VacantPostCausingTransfer" value="4">
                                        <label class="form-check-label marathi-label" for="VacantPostCausingTransfer4">&nbsp;&nbsp; पदोन्नती</label>
                                    </div>
                                </div>
                                <div class="col-md-3">                                    
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="VacantPostCausingTransfer5" name="VacantPostCausingTransfer" value="5">
                                        <label class="form-check-label marathi-label" for="VacantPostCausingTransfer5">&nbsp;&nbsp; नवीन पद मंजुरी</label>
                                    </div>
                                </div>
                                
                            </div>    
                        </div>                 
                        <div class="col-md-4">
                            <input type="file" id="vacantPostCausingTransferFile" name="vacantPostCausingTransferFile" class="form-control" accept=".pdf">
                        </div>
                    </div>
                    <hr/>
                    <h3 class="section-title  mb-3" style="font-size:15px;"> शासन निर्णय दि. 06.02.2012 व 10.06.2022 नुसार मान्यता असल्याबाबतचा शिक्षणाधिकारी / उपसंचालक यांचा स्पष्ट अभिप्राय</h3>
                    
                    <div class="row mb-3">
                       
                        
                        <div class="col-md-4">
                            <label class="form-label marathi-label">बिंदुनामावली तपासणी पत्र (मावकद्वारे)</label>
                        </div>  
                         
                        <div class="col-md-2">
                            
                                <input type="date" placeholder="दिनांक" class="form-control" id="mavakCheckListDate" name="mavakCheckListDate" required>
                                                                

                        </div>                 
                        <div class="col-md-6">
                            <input type="file" id="mavakCheckListFile" name="mavakCheckListFile" class="form-control" accept=".pdf">
                        </div>
                    </div> 
                    <div class="row mb-3">
                       
                        
                        <div class="col-md-4">
                            <label class="form-label marathi-label">संबंधित शिक्षकांचे विनाअनुदानित भरतीचे ना हरकत प्रमाणपत्र</label>
                        </div>  
                         
                        <div class="col-md-2">
                            
                                <input type="text" placeholder="जावक क्रमांक" class="form-control" id="recruitmentNocOutwardNumber" name="recruitmentNocOutwardNumber" required>
                                                                

                        </div>  
                        <div class="col-md-2">
                            
                                <input type="date" placeholder="दिनांक" class="form-control" id="recruitmentNocOutwardDate" name="recruitmentNocOutwardDate" required>
                                                                

                        </div>                
                        <div class="col-md-4">
                            <input type="file" id="recruitmentNocOutwardFile" name="recruitmentNocOutwardFile" class="form-control" accept=".pdf">
                        </div>
                    </div>
                    <div class="row mb-3">
                       
                        
                        <div class="col-md-4">
                            <label class="form-label marathi-label">वर्तमानपत्रातील जाहिरात</label>
                        </div>  
                         
                        <div class="col-md-2">
                            
                                <input type="text" placeholder="वर्तमानपत्राचे नाव" class="form-control" id="advrtNewspaperName" name="advrtNewspaperName" required>
                                                                

                        </div>  
                        <div class="col-md-2">
                            
                                <input type="date" placeholder="दिनांक" class="form-control" id="advrtNewspaperDate" name="advrtNewspaperDate" required>
                                                                

                        </div>                
                        <div class="col-md-4">
                            <input type="file" id="advrtNewspaperFile" name="advrtNewspaperFile" class="form-control" accept=".pdf">
                        </div>
                    </div>
                    <div class="row mb-3">
                       
                        
                        <div class="col-md-4">
                            <label class="form-label marathi-label">मुलाखत</label>
                        </div>  
                         
                        <div class="col-md-2">
                            
                                <input type="date" placeholder="दिनांक" class="form-control" id="interviewDate" name="interviewDate" required>
                                                                

                        </div>                 
                        <div class="col-md-6">
                            <input type="file" id="interviewFile" name="interviewFile" class="form-control" accept=".pdf">
                        </div>
                    </div>
                    <div class="row mb-3">
                       
                        
                        <div class="col-md-4">
                            <label class="form-label marathi-label">रुजू अहवाल विनाअनुदानित तत्त्वावरील</label>
                        </div>  
                         
                        <div class="col-md-2">
                             
                                <input type="date" placeholder="दिनांक" class="form-control" id="reportNGPrincipleDate" name="reportNGPrincipleDate" required>
                                                                

                        </div>                 
                        <div class="col-md-6">
                            <input type="file" id="reportNGPrincipleFile" name="reportNGPrincipleFile" class="form-control" accept=".pdf">
                        </div>
                    </div>
                    <div class="row mb-3">
                       
                        
                        <div class="col-md-4">
                            <label class="form-label marathi-label">रुजू अहवाल अनुदानित तत्त्वावरील</label>
                        </div>  
                         
                        <div class="col-md-2">
                            
                                <input type="date" placeholder="दिनांक" class="form-control" id="reportGPrincipleDate" name="reportGPrincipleDate" required>
                                                                

                        </div>                 
                        <div class="col-md-6">
                            <input type="file" id="reportGPrincipleFile" name="reportGPrincipleFile" class="form-control" accept=".pdf">
                        </div>
                    </div>

                    <hr/>
                    <div class="card">
                        <label class="checkbox-label">
                        <label class="checkbox-label">
                            सदर वैयक्तिक मान्यता आदेशावरील जावक क्रमांक कार्यालयातील जावक नोंदवहीशी जुळतो का? &rarr;
                            </label>
                             <label class="checkbox-label">
                            <input type="radio" id="upwardNumberMatchYes"  name="upwardNumberMatch" onchange="showDiv('upwardNumberMatchDiv')"> होय 
                             </label><label class="checkbox-label">
                            <input type="radio" id="upwardNumberMatchYes"  name="upwardNumberMatch" onchange="hideDiv('upwardNumberMatchDiv')">  नाही
                            </label>
                        
                        </label>
                        
                        <div id="upwardNumberMatchDiv" class="transfer-section">
                        
                              <div class="row mb-3">
                       
                        
                                <div class="col-md-4">
                                    <label class="form-label marathi-label">वैयक्तिक मान्यता आदेशावरील जावक क्रमांक कार्यालयातील जावक नोंद वहीशी जुळतो का याबाबत शिक्षणाधिकारी / उपसंचालक यांचे प्रमाणपत्र</label>
                                </div>  
                                
                                
                                <div class="col-md-2">
                                    
                                        <input type="date" placeholder="दिनांक" class="form-control" id="outwardNumberMatchCertificateDate" name="outwardNumberMatchCertificateDate" required>
                                                                        

                                </div>                
                                <div class="col-md-6">
                                    <input type="file" id="outwardNumberMatchCertificateFile" name="outwardNumberMatchCertificateFile" class="form-control" accept=".pdf">
                                </div>
                            </div>                    
                        </div>
                    </div>
                    
                  
                    <div class="row mb-3">
                       
                        
                        <div class="col-md-4">
                            <label class="form-label marathi-label">बदली होणारा शिक्षक स्वयंअर्थसहाय्यित तत्त्वावर कार्यरत नव्हता याबाबत प्रमाणपत्र • शासन अधिसूचना दि. 08.06.2020</label>
                        </div>  
                         
                        <div class="col-md-2">
                            
                                <input type="text" placeholder="जावक क्रमांक" class="form-control" id="selfFinancingCertificateOutwardNumber" name="selfFinancingCertificateOutwardNumber" required>
                                                                

                        </div>  
                        <div class="col-md-2">
                            
                                <input type="date" placeholder="दिनांक" class="form-control" id="selfFinancingCertificateDate" name="selfFinancingCertificateDate" required>
                                                                

                        </div>                
                        <div class="col-md-4">
                            <input type="file" id="selfFinancingCertificateFile" name="selfFinancingCertificateFile" class="form-control" accept=".pdf">
                        </div>
                    </div>

                    
                    <div class="row mb-3">                       
                        
                        <div class="col-md-4">
                            <label class="form-label marathi-label">बदली असमान पदावर झालेली नाही याबाबत प्रमाणपत्र • अधिसूचना दि. 08.06.2020 मधील तरतुदीनुसार</label>
                        </div>  
                         
                        <div class="col-md-2">
                            
                                <input type="text" placeholder="जावक क्रमांक" class="form-control" id="transferNotHigherPostOutwardNumber" name="transferNotHigherPostOutwardNumber" required>
                                                                

                        </div>  
                        <div class="col-md-2">
                            
                                <input type="date" placeholder="दिनांक" class="form-control" id="transferNotHigherPostDate" name="transferNotHigherPostDate" required>
                                                                

                        </div>                
                        <div class="col-md-4">
                            <input type="file" id="transferNotHigherPostFile" name="transferNotHigherPostFile" class="form-control" accept=".pdf">
                        </div>
                    </div>

                    <div class="row mb-3">                       
                        
                        <div class="col-md-6">
                            <label class="form-label marathi-label">महाराष्ट्र खासगी शाळा कर्मचारी (सेवा अटी) नियमावली 1981 मधील नियम 41(1)(3) नुसार वेतन अनुदानाबाबत हमीपत्र • शासन निर्णय क्र. संकीर्ण 2019/प्र.क्र.341/टीएनटी-1, दि. 01.04.2021</label>
                        </div>  
                         
                                      
                        <div class="col-md-6">
                            <input type="file" id="salarySubsidyGuaranteeLetterFile" name="salarySubsidyGuaranteeLetterFile" class="form-control" accept=".pdf">
                        </div>
                    </div>

                    <div class="row mb-3" style="border:3px dotted #333;">                       
                        
                        <div class="col-md-2">
                            <label class="form-label marathi-label">आयकर विवरणपत्र<br/>Form-16</label>
                        </div> 
                        
                        <div class="col-md-3">
                            <label class="form-label marathi-label">2025-26 <input type="file" id="itr1File" name="itr1File" class="form-control" accept=".pdf"></label>
                        </div> 
                        <div class="col-md-3">
                            <label class="form-label marathi-label">2024-25 <input type="file" id="itr12File" name="itr2File" class="form-control" accept=".pdf"></label>
                        </div> 
                        <div class="col-md-3">
                            <label class="form-label marathi-label">2023-24 <input type="file" id="itr3File" name="itr3File" class="form-control" accept=".pdf"></label>
                        </div> 

                         
                    </div>

                    <div class="row mb-3" style="border:3px dashed #635e5e;">                       
                        
                        <div class="col-md-3">
                            <label class="form-label marathi-label">वेतन बँक स्टेटमेंट</label>
                        </div> 
                        
                        <div class="col-md-2">
                            <input type="date" placeholder="दिनांक" class="form-control" id="bankStatementFromDate" name="bankStatementFromDate" required>
                        </div> 
                        <div class="col-md-2">
                            <input type="date" placeholder="दिनांक" class="form-control" id="bankStatementToDate" name="bankStatementToDate" required>
                        </div>
                        
                        <div class="col-md-5">
                            <input type="file" id="bankStatementFile" name="bankStatementFile" class="form-control" accept=".pdf">
                        </div> 

                         
                    </div>

                      <div class="card">
                        <label class="checkbox-label">
                        <label class="checkbox-label">
                            या प्रकरणासंदर्भात कोणताही न्यायालयीन आदेश निर्गमित झाला आहे का?  &rarr;
                            </label>
                             <label class="checkbox-label">
                            <input type="radio" id="courtOrderYes"  name="courtOrder" onchange="showDiv('courtOrderDiv')"> होय 
                             </label><label class="checkbox-label">
                            <input type="radio" id="courtOrderNo"  name="courtOrder" onchange="hideDiv('courtOrderDiv')">  नाही
                            </label>
                        
                        </label>
                        
                        <div id="courtOrderDiv" class="transfer-section">
                        
                              <div class="row mb-3">
                       
                        
                                 <div class="col-md-3">
                            
                                        <input type="text" placeholder="याचिका क्रमांक" class="form-control" id="courtOrderPetitionNumber" name="courtOrderPetitionNumber" required>
                                                                        

                                </div>  
                                <div class="col-md-3">
                                    
                                        <input type="date" placeholder="दिनांक" class="form-control" id="courtOrderDate" name="courtOrderDate" required>
                                                                        

                                </div>                
                                <div class="col-md-6">
                                    <input type="file" id="courtOrderFile" name="courtOrderFile" class="form-control" accept=".pdf">
                                </div>
                            </div>                    
                        </div>
                    </div>

                    <!--
                    <div class="row mb-3">                      
                        
                        <div class="col-md-4">
                            <label class="form-label marathi-label">न्यायालयीन आदेश (असल्यास)</label>
                        </div>  
                         
                        <div class="col-md-2">
                            
                                <input type="text" placeholder="याचिका क्रमांक" class="form-control" id="courtOrderPetitionNumber" name="courtOrderPetitionNumber" required>
                                                                

                        </div>  
                        <div class="col-md-2">
                            
                                <input type="date" placeholder="दिनांक" class="form-control" id="courtOrderDate" name="courtOrderDate" required>
                                                                

                        </div>                
                        <div class="col-md-4">
                            <input type="file" id="courtOrderFile" name="courtOrderFile" class="form-control" accept=".pdf">
                        </div>
                    </div>-->
                    

                    <div class="row mb-3">                       
                        
                        <div class="col-md-4">
                            <label class="form-label marathi-label">विनाअनुदानित तत्त्वावरील रुजू दिनांकापासून इतर शासकीय लाभ घेतले नाहीत याबाबत प्रमाणपत्र</label>
                        </div>  
                         
                        <div class="col-md-4">
                                <input type="text" placeholder="विवरण" class="form-control" id="noBenefitsCertificateDetails" name="noBenefitsCertificateDetails" required>
                        </div>  
                                    
                        <div class="col-md-4">
                            <input type="file" id="noBenefitsCertificateFile" name="noBenefitsCertificateFile" class="form-control" accept=".pdf">
                        </div>
                    </div>

                    
                    <div class="row mb-3">                       
                        
                        <div class="col-md-6">
                            <label class="form-label marathi-label">प्रस्तुत प्रस्तावातील कागदपत्रे खरी असल्याबाबत संस्थेचे हमीपत्र (प्रपत्र-2) • शासन अधिसूचना दि. 08.06.2020</label>
                        </div>  
                         
                      
                                    
                        <div class="col-md-6">
                            <input type="file" id="institutionGuaranteeFile" name="institutionGuaranteeFile" class="form-control" accept=".pdf">
                        </div>
                    </div>

                  

                    <div class="row mb-3">                       
                        
                        <div class="col-md-6">
                            <label class="form-label marathi-label">इतर (जर काही असेल तर)<br/>Additional Documents</label>
                        </div>  
                         
                      
                                    
                        <div class="col-md-6">
                            <input type="file" id="otherDocuments" name="otherDocuments" class="form-control" accept=".pdf">
                        </div>
                    </div>

                    
                </div>
                
                <!-- Declaration -->
                <div class="form-section">
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="declaration" required>
                        <label class="form-check-label marathi-label" for="declaration">
                            मी खात्रीपूर्वक सांगतो/सांगते की, वरील सर्व माहिती खरी आहे व सर्व कागदपत्रे खरी आहेत. कोणतीही चुकीची माहिती दिल्यास, माझ्यावर योग्य कायदेशीर कारवाई केली जाऊ शकते याची मला पूर्ण कल्पना / जाणीव आहे.
                        </label>
                    </div>
                </div>
                
                <!-- Submit Button -->
                <div class="d-flex justify-content-between mt-4">
                    <!--<button type="button" class="btn btn-outline-secondary" id="saveDraftBtn">
                        <i class="bi bi-save"></i> ड्राफ्ट सेव्ह करा
                    </button>-->
                    <button type="submit" class="btn btn-submit">
                        <i class="bi bi-send-check"></i> अर्ज सबमिट करा
                    </button>
                </div>
            </form>
        </div>
     



    </div>

    <!-- Footer -->
    <div class="slide-footer text-end">
          <!--<button class="btn btn-danger btn-sm">Reject</button>
        <button class="btn btn-success btn-sm">Approve</button>-->
        <button class="btn btn-secondary btn-sm js-close-slider">Close</button>
    </div>

</div>
<input type="hidden" value="<?= h($school->udise_code) ?>" id="sID">
<script>

    function toggleDiv(chkBox,div) {
        const checkbox = document.getElementById(chkBox);
        const areaDiv = document.getElementById(div);

        areaDiv.style.display = checkbox.checked ? "block" : "none";
    }
    function showDiv(div) {
        const areaDiv = document.getElementById(div);
        areaDiv.style.display =  "block";
    }
    function hideDiv(div) {
        const areaDiv = document.getElementById(div);
        areaDiv.style.display =  "none";
    }
        
</script>
<script>
  
    $(document).ready(function() {
        

        $("#payCommission").change(function () {
            const commissionId = $(this).val();
            $("#salaryGrade").html('<option>Loading...</option>');

            if (commissionId === "") {
                $("#salaryGrade").html('<option>-- Select Pay Scale --</option>');
                return;
            }

            $.ajax({
                url: '<?= $this->Url->build(["controller" => "School", "action" => "salary-grades-by-commission"]); ?>/'+commissionId,
                type: 'GET',
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                },
                 success: function (response) {
                   
                    if(response.response.statusCode ==200){
                        let options = '<option value="">-- Select Pay Scale --</option>';

                        $.each(response.response.payScales, function (index, scale) {
                            options += `<option value="${scale.scale_id}">
                                            ${scale.scale_desc}
                                        </option>`;
                        });

                        $("#salaryGrade").html(options);
                    }else{
                        $("#salaryGrade").html('<option>There is no Pay Scale available for selected Pay Commission</option>');
                    }
                    
                },
                error: function () {
                    $("#salaryGrade").html('<option>Error loading data</option>');
                }
            });
           
        });
  
            // Open slider
        $(document).on('click', '.js-open-transfer', function () {
            const caseId = $(this).data('id');
            let staffJson = $(this).attr('data-staffObject');   // raw JSON string
            let staffObject   = JSON.parse(staffJson)

            $(document).trigger('transfer:openSlider', [caseId,staffObject]);
        });

        // Close slider
        $(document).on('click', '.js-close-slider', function () {
            $(document).trigger('transfer:closeSlider');
        });

        // Custom events
        $(document).on('transfer:openSlider', function (e, caseId,staffObject) {
            loadTransferDetails(caseId,staffObject);
            $('#transferSlider').addClass('open').attr('aria-hidden', 'false');
        });

        $(document).on('transfer:closeSlider', function () {
            $('#transferSlider').removeClass('open').attr('aria-hidden', 'true');
        });

        // ESC key close
        $(document).on('keydown', function (e) {
            if (e.key === "Escape") {
                $(document).trigger('transfer:closeSlider');
            }
        });

        // Mock data loader
        function loadTransferDetails(caseId,staffObject) {
            
            $('#teacherTransferForm')[0].reset();
            $('#teacherTransferForm input[type="file"]').val('');
            console.log(staffObject);
            let designation = '';

            if (staffObject && staffObject.post && staffObject.post.name) {
                designation = staffObject.post.name;
            }

            if (staffObject && staffObject.current_post) {
                designation += ' (' + staffObject.current_post + ')';
            }
//
///
//
//
//
//
//
//
                    
            $('#staffId').val(staffObject.id);
            //$('#caseId').text(caseId);
            $('#empName').text(staffObject.teacher_name);
            /*empNameDetails = staffObject.teacher_name +' <span style="color:#333; font-size:12px;"> StaffType - '+
                             staffObject.staffs_type.staff_type_name+' &nbsp;&nbsp;|&nbsp;&nbsp; Designation - '+
                             staffObject.post.name+' &nbsp;&nbsp;|&nbsp;&nbsp; Aid Type - '+staffObject.aid_master.name+
                             ' &nbsp;&nbsp;|&nbsp;&nbsp; E-mail - '+staffObject.email+
                             ' &nbsp;&nbsp;|&nbsp;&nbsp; Mobile - '+staffObject.mobile+'</span>';*/
             empNameDetails = staffObject.teacher_name +' <span style="color:#333; font-size:12px;"> &nbsp;&nbsp;|&nbsp;&nbsp; '+
                             staffObject.staffs_type.staff_type_name+' &nbsp;&nbsp;|&nbsp;&nbsp; '+
                             staffObject.post.name+' &nbsp;&nbsp;|&nbsp;&nbsp; '+staffObject.aid_master.name+
                             ' &nbsp;&nbsp;|&nbsp;&nbsp; '+staffObject.email+
                             ' &nbsp;&nbsp;|&nbsp;&nbsp; '+staffObject.mobile+'</span>';
            $('#empNameDetails').html(empNameDetails);
            
            $('#institutionCode').html('Institute Code');
            $('#institutionName').html('Name Of Institute API value');
            $('#salarygrade').html(staffObject.pay_scale);
            $('#teachingSubjects').html(staffObject.subject_taught);
            $('#medium').html(staffObject.medium.name);

             
                    
                    
           
            
                    
                    
                    
                       
           // $('#designation').text(designation);
            //$('#school').text(staffObject?.caste_category?.category_name);
            //$('#remarks').text('Case under scrutiny by Education Officer.');
        }



        // Generate random application ID
        //document.getElementById('appId').textContent = Math.floor(10000 + Math.random() * 90000);
        
        // File upload functionality
        function setupFileUpload(uploadAreaId, fileInputId, fileListId) {
            const uploadArea = document.getElementById(uploadAreaId);
            const fileInput = document.getElementById(fileInputId);
            const fileList = document.getElementById(fileListId);
            
            uploadArea.addEventListener('click', () => fileInput.click());
            
            uploadArea.addEventListener('dragover', (e) => {
                e.preventDefault();
                uploadArea.classList.add('dragover');
            });
            
            uploadArea.addEventListener('dragleave', () => {
                uploadArea.classList.remove('dragover');
            });
            
            uploadArea.addEventListener('drop', (e) => {
                e.preventDefault();
                uploadArea.classList.remove('dragover');
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    handleFileSelection(files[0], fileList);
                }
            });
            
            fileInput.addEventListener('change', (e) => {
                if (fileInput.files.length > 0) {
                    handleFileSelection(fileInput.files[0], fileList);
                }
            });
        }
        
        function handleFileSelection(file, fileListContainer) {
            if (file.type !== 'application/pdf') {
                alert('कृपया फक्त PDF फाइल अपलोड करा.');
                return;
            }
            
            if (file.size > 5 * 1024 * 1024) {
                alert('फाइल आकार 5MB पेक्षा जास्त नाही.');
                return;
            }
            
            const fileItem = document.createElement('div');
            fileItem.className = 'file-item';
            fileItem.innerHTML = `
                <div>
                    <i class="bi bi-file-earmark-pdf file-icon"></i>
                    <span>${file.name}</span>
                    <small class="text-muted d-block">${(file.size / 1024).toFixed(2)} KB</small>
                </div>
                <button type="button" class="btn btn-sm btn-outline-danger remove-file">
                    <i class="bi bi-trash"></i>
                </button>
            `;
            
            fileListContainer.innerHTML = '';
            fileListContainer.appendChild(fileItem);
            
            // Add remove functionality
            fileItem.querySelector('.remove-file').addEventListener('click', () => {
                fileListContainer.innerHTML = '';
                if (fileItem.parentElement.previousElementSibling.querySelector('input[type="file"]')) {
                    fileItem.parentElement.previousElementSibling.querySelector('input[type="file"]').value = '';
                }
            });
            
        }
        
        // Initialize file uploads
        
        setupFileUpload('schoolPermissionOrderUploadArea','schoolPermissionOrderFile','schoolPermissionOrderFileList');
        setupFileUpload('minorityCertUploadArea','minorityCertOutwardFile','minorityCertOutwardFileList');
        setupFileUpload('schoolAtTransferUploadArea','schoolAtTransferFile','schoolAtTransferFileList');
        // Form submission
        /*document.getElementById('teacherTransferForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!document.getElementById('declaration').checked) {
                alert('कृपया घोषणा तपासा.');
                return;
            }
            
            // Show success message
            alert('तुमचा अर्ज यशस्वीरित्या सबमिट केला गेला आहे! आवेदन क्रमांक: ' + document.getElementById('applicationId').textContent);
            
           
            
        });*/
        

        $('#teacherTransferForm').submit(function(e) {
           
            e.preventDefault();
            
            var formData = new FormData(this);
            
            $.ajax({
                url: '<?= $this->Url->build(["controller" => "School", "action" => "updateTransferDetails"]); ?>',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                },
                success: function(response) {
                    console.log(response);
                    alert(response.message);
                    if(response.success){
                        location.reload();
                    }
                    // Handle success
                },
                error: function(xhr, status, error) {
                    // Handle error

                }
            });
           
        });
        
       
        
        // PAN number validation
        document.getElementById('panNumber').addEventListener('input', function(e) {
            this.value = this.value.toUpperCase();
        });
        
        // Auto-fill some API fields with sample data (for demo)
        /*document.addEventListener('DOMContentLoaded', function() {
            // Sample API data (in real app, this would come from API call)
            setTimeout(() => {
                document.getElementById('institutionName').value = "शिवाजी विद्यालय, पुणे";
                document.getElementById('unaidedSchoolName').value = "ज्ञानदीप विद्यामंदिर, नगर रोड, पुणे";
                document.getElementById('schoolPermission').value = "परवानगी क्र. 1234/2023, दि. 15/03/2023";
                document.getElementById('udiseNumber').value = "27250900123";
                
              
                
            }, 500);
        });*/


});
</script>



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
    /* Slide Panel */
    .slide-panel1 {
        position: fixed;
        top: 10%;
        right: -100%;
        width: 30%;
        height: 90%;
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
        .slide-panel .slide-panel1{
            width: 100%;
            right: -100%;
        }
    }

    .slide-header,
    .slide-footer {
        padding: 12px 16px;
        border-bottom: 1px solid #dee2e6;
        background: #1c8a8b;
        color:#fff;
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
            padding: 10px;
            margin-bottom: 30px;
        }
        
        .section-title {
            color: var(--primary-color);
            border-bottom: 1px solid var(--secondary-color);
            padding-bottom: 3px;
            margin-bottom: 3px;
            font-weight: 600;
            font-size:18px;
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
            padding: 5px;
            text-decoration:none;
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
            margin-bottom: 0px;
            border-bottom: 1px solid #333;
        }
        
        .form-section {
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 1px solid #6d6868;
        }
        
        @media (max-width: 768px) {
            .form-container {
                padding: 10px;
            }
            
            .progress-section {
                position: static;
                width: 100%;
                margin-top: 20px;
            }
        }
        .txtval{
            color: #004884;
            padding-left: 10px;
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
            padding: 10px;
            margin-bottom: 30px;
        }
        
        .section-title {
            color: var(--primary-color);
            border-bottom: 1px solid var(--secondary-color);
            padding-bottom: 3px;
            margin-bottom: 3px;
            font-weight: 600;
            font-size:18px;
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
            padding: 5px;
            text-decoration:none;
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
            margin-bottom: 0px;
            border-bottom: 1px solid #333;
        }
        
        .form-section {
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 1px solid #6d6868;
        }
        
        @media (max-width: 768px) {
            .form-container {
                padding: 10px;
            }
            
            .progress-section {
                position: static;
                width: 100%;
                margin-top: 20px;
            }
        }
        .txtval{
            color: #004884;
            padding-left: 10px;
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

    <style>
        .hidden { display: none; }
        .form-group { margin: 10px 0; }
    </style>

<h5 style="margin:0px;padding:10px; color: #1a237e; border-bottom: 2px solid #1a237e;">
       
        🔜👨‍💼 कर्मचारी निवड आणि रुजू प्रक्रिया
      
</h5>
<!-- Bootstrap + Bootstrap Icons -->
<div style="background: #fff; padding:10px;">      
    
        

        <table id="staffTable" class="table table-bordered table-striped table-hover align-middle">
            <thead class="table-light">
            <tr>
                <th>#</th>
                 <!--<th>Aid Type</th> -->
                <th>Post</th> 
                 <!--<th>Staff Name</th>  --> 
                <th>School</th>
                  <!--<th>Date of Joining</th>-->
                <th>Action</th>
            </tr>
            </thead>
            <tbody>                        
                <?php 
                $idx =1;
                //dd($staffs);
                
                foreach ($ng2g as $post): 

                    if($post->post_type == 1){
                        continue;
                    }
                   
                ?>
                <tr>
                    <td><?= h($idx++) ?></td>
                   
                    <td>
                        <?= h($post->post_name) ?>
                    </td>
                                     
                    <td>
                      
                        <?= h($post->school_name) ?> 
                    </td>

                    <td id="actionBtns_<?= h($post->id) ?>">
                        <?php
                            if($post->is_onboarding_submitted == 1) {
                                
                               if($post->status=='returned'){
                                     echo "<button class='btn btn-primary badge bg-info text-light action-ud mt-2 returnApplication-open-transfer' data-id='".$post->id."'>
                                             त्रुटी दुरुस्ती व पुनः सादरीकरण
                                        </button> ";                       
                                }else{
                                 echo "<button class='btn btn-primary badge bg-purple text-light action-ud startApplication-open-onboarding' data-mode='2' app-step='1'  data-staffObject='". json_encode($post, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ."' data-id=''>
                                                                        रुजू प्रक्रिया
                                                                    </button>";  
                                }                                      
                                                               
                            }else{
                                 echo "<button class='btn btn-primary badge bg-purple text-light action-ud startApplication-open-transfer' data-mode='2' app-step='1'  data-staffObject='". json_encode($post, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ."' data-id=''>
                                                                        कर्मचारी भरती व रुजू प्रक्रिया
                                                                    </button>";
                            } 
                           
                        ?>
                       
                         
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
       
</div>




<!-- Slide Panel -->
<div id="startApplicationSlider" class="slide-panel" aria-hidden="true" style="border:3px solid #537895;">
     <!-- Header -->
    <div class="slide-header d-flex justify-content-between align-items-center">
        <div style="width:100%;">
            <h5 class="mb-0"><i class="fas fa-arrow-trend-up me-1"></i> Staff Onboarding </h5>
            <!--<small class="text-muted">Case ID: <span id="caseId"></span></small>-->
            
           
        </div>
        <button class="btn btn-sm btn-outline-danger startApplication-close-slider">X</button>
    </div>

    <!-- Body -->
    <div class="slide-body">
        <div class="form-container">
            <div id="saStep1">
                <form id="saFormStep1" enctype="multipart/form-data">
                    <input type="hidden" id="sa_basic_data">
                    <!--
                        <button type="submit" class="btn btn-lg btn-primary w-100">Submit</button>
                
                    </form><form>-->
                    <input type="hidden" value="" name="staffId" id="staffId">
                    <div class="section">
                        <div class="section-title">👤 <span id="empNameDetails"></span></div>
                        <input type="hidden" id="appointmentDate" name="appointmentDate" class="form-control">
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <label for="institutionCode" class="form-label marathi-label">संस्था कोड <span class="english-label">(Institution Code)</span> &rarr; <span class="txtval"><?= h($user["username"]) ?></span></label>                            
                            </div>
                            <div class="col-md-6">                            
                                <label for="institutionName" class="form-label marathi-label">संस्थेचे नाव <span class="english-label">(Institution Name)</span> &rarr; <span class="txtval"><?= h($sanstha["name"]) ?></span></label> 
                            </div>
                             <div class="col-md-3">                            
                                <?php if($sanstha["minority_sanstha"]==2 || $sanstha["minority_sanstha"] == 3): ?>
                                    <span class="badge rounded-pill bg-success">Minority Sanstha (<?php echo h($sanstha["sanstha_minority_name"]); ?>)</span>
                                 <?php else: ?>    
                                    <span class="badge rounded-pill bg-warning text-dark">Non-Minority Sanstha</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <label for="udiseNumber" class="form-label marathi-label">UDISE क्रमांक 
                                <span class="english-label">(UDISE Code)</span> &rarr; <span class="txtval" id="udiseNumber">  
                                    </span></label> 
                        </div>
                    
                        <div class="col-md-9">
                            <label for="schoolName" class="form-label marathi-label">शाळेचे नाव 
                                <span class="english-label">(School Name)</span> &rarr; <span class="txtval" id="schoolName"></span></label> 
                        </div>                  
                        
                       
                    </div>
                               
                      <div class="row mb-3">
                         <div class="col-md-3">
                            <label for="headmastername " class="form-label marathi-label required-field">मुख्याध्यापक</label>
                            <input type="text"
                                        class="form-control"
                                        id="headmastername"
                                        name="headmastername"
                                        maxlength="100"
                                        autocomplete="name"
                                        required>
                        </div>
                        <div class="col-md-3">
                            <label for="heademail" class="form-label marathi-label required-field">ई-मेल </label>
                               <input type="email"
                                    class="form-control"
                                    id="heademail"
                                    name="heademail"
                                    maxlength="150"
                                    autocomplete="email"
                                    placeholder="example@gmail.com"
                                    required>
                        </div>
                            <!-- 1.9 आधार क्रमांक -->
                            <div class="col-md-3">
                            <label for="headmobilenumber" class="form-label marathi-label required-field">मोबाईल क्रमांक </label>
                             <input type="text"
                                    class="form-control"
                                    id="headmobilenumber"
                                    name="headmobilenumber"
                                    pattern="[6-9][0-9]{9}"
                                    maxlength="10"
                                    minlength="10"
                                    inputmode="numeric"
                                    autocomplete="tel"
                                    oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,10)"
                                    placeholder="10 अंकी मोबाईल क्रमांक"
                                    required>
                            
                        </div>
                      
                    </div> 
                   
                    <div class="row mb-3">
                         <div class="col-md-3">
                            <label for="candidatename " class="form-label marathi-label required-field">उमेदवाराचे नाव </label>
                            <input type="text"
                                class="form-control"
                                id="candidatename"
                                name="candidatename"
                                required>
                        </div>
                        <div class="col-md-3">
                            <label for="gender" class="form-label marathi-label required-field">लिंग </label>
                            <select name="gender" class="form-select">
                                <option value="">Select Gender / लिंग निवडा</option>
                                <option value="male">Male / पुरुष</option>
                                <option value="female">Female / महिला</option>
                                <option value="third_gender">Third Gender / तृतीयपंथी</option>
                            </select>
                        </div>
                            <!-- 1.9 आधार क्रमांक -->
                        <div class="col-md-3">
                            <label for="dob_date" class="form-label marathi-label required-field">जन्मतारीख </label>
                            <input type="date" class="form-control form-control-sm" id="dob_date" name="dob_date"  max="<?= h(date('Y-m-d', strtotime('-1 day'))) ?>" required>
                        </div>
                      
                    </div>

                    <!-- 1.4 अध्यापन विषय -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="candidateemail " class="form-label marathi-label required-field">ई-मेल </label>
                            <input type="text"
                                class="form-control"
                                id="candidateemail"
                                name="candidateemail"
                                maxlength="150"
                                autocomplete="email"
                                placeholder="example@gmail.com"
                                required>
                        </div> 
                        <div class="col-md-3">
                            <label for="candidatemobile " class="form-label marathi-label required-field">मोबाईल क्रमांक </label>
                            <input type="text"
                                class="form-control"
                                id="candidatemobile"
                                name="candidatemobile"
                                pattern="[6-9][0-9]{9}"
                                maxlength="10"
                                minlength="10"
                                inputmode="numeric"
                                autocomplete="tel"
                                oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,10)"
                                placeholder="10 अंकी मोबाईल क्रमांक"
                                required>
                        </div>
                        <div class="col-md-3">
                            <label for="panNumber" class="form-label marathi-label required-field">पॅन क्रमांक <span class="english-label">(PAN)</span></label>
                            <input type="text"
                                class="form-control"
                                id="panNumber"
                                name="panNumber"
                                pattern="^[A-Za-z]{5}[0-9]{4}[A-Za-z]$"
                                maxlength="10"
                                style="text-transform:uppercase"
                                required>
                        </div>
                            <!-- 1.9 आधार क्रमांक -->
                            <div class="col-md-3">
                            <label for="aadharNumber" class="form-label marathi-label required-field">आधार क्रमांक <span class="english-label">(Aadhar)</span></label>
                            <input type="text"
                                class="form-control"
                                id="aadharNumber"
                                name="aadharNumber"
                                pattern="^[0-9]{12}$"
                                maxlength="12"
                                inputmode="numeric"
                                oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                                required>
                            
                        </div>
                      
                    </div>
                    
                    <div class="row mb-3" id="casteCategoryBox">


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
                            <label for="appointmentCategory" class="form-label marathi-label required-field">समांतर आरक्षण प्रवर्ग <span class="english-label">(Horizontal)</span></label>
                            <select class="form-select" id="horizontalCategory" name="horizontalCategory" required>                   
                                <option value="">-- Select Horizontal Category --</option>
                                <?php 
                                    foreach($horizontalCategories as $hc){
                                        echo '<option value="'.$hc->id.'">'.$hc->name.'</option>';
                                    }
                                ?>
                            </select> 
                        </div>

                         <div class="col-md-4">
                            <label for="horizontalcertificateFile" class="form-label marathi-label ">लागू असल्यास प्रमाणपत्र अपलोड करा</label>
                            <input type="file" id="horizontalcertificateFile" name="horizontalcertificateFile" class="form-control file-upload-check" accept=".pdf" >  
                        </div>

                     <?php if ($sanstha["minority_sanstha"] == 2 || $sanstha["minority_sanstha"] == 3): ?>                     
                       
                        
                    
                     <?php else: ?>

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
                            <label for="castecertificateFile" class="form-label marathi-label ">जात प्रमाणपत्र अपलोड करा</label>
                            <input type="file" id="castecertificateFile" name="castecertificateFile" class="form-control file-upload-check" accept=".pdf" >  
                        </div>
                         <div class="col-md-4">
                            <label for="validcastecertificateFile" class="form-label marathi-label ">वैध जात प्रमाणपत्र अपलोड करा</label>
                            <input type="file" id="validcastecertificateFile" name="validcastecertificateFile" class="form-control file-upload-check" accept=".pdf" >  
                        </div>

                        

                     <?php endif; ?>   

                         <div class="col-md-4">
                            <label for="pay_scale" class="form-label marathi-label ">वेतनश्रेणी  <span class="english-label">(Pay Scale)</span></label>
                            <select class="form-select" id="pay_scale" name="pay_scale" disabled>
                            <option value="">Select pay scale</option>
                            <?php foreach ($payScales as $key => $ps): ?>
                                <option value="<?= h($key) ?>">
                                    <?= h($ps) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        </div>  
                        
                   </div>
                    



                    <div class="pdf-field">
                        <h3 class="section-title">शैक्षणिक व व्यावसायिक अर्हता. <small style="font-size:10px;">संबंधित शिक्षकाची शैक्षणिक व व्यावसायिक अर्हता प्रमाणपत्रे • शासन निर्णय दिनांक 25.02.2019 नुसार.</small></h3>
                        <div class="row">
                            <div class="col-md-3 ">
                                <label for="sscFile" class="form-label marathi-label required-field">
                                     माध्यमिक <span class="english-label">(SSC)</span>
                                </label>
                                <input type="file" id="sscFile" name="sscFile" class="form-control file-upload-check" accept=".pdf" required>      
                            </div>    
                            <div class="col-md-3">
                                <label for="hscFile" class="form-label marathi-label required-field">
                                    उच्च माध्यमिक <span class="english-label">(HSC)</span>
                                </label>
                                <input type="file" id="hscFile" name="hscFile" class="form-control file-upload-check" accept=".pdf" required>      
                            </div>                     
                            <div class="col-md-3">
                                <label for="graduateFile" class="form-label marathi-label">
                                    पदवी <span class="english-label">(Graduate Degree)</span>
                                </label>
                                <select name="degree" id="degree" class="form-select mb-2">
                                    <option value="">-- पदवी निवडा --</option>
                                    <option value="BA">B.A. - कला शाखा (Arts)</option>
                                    <option value="BSc">B.Sc. - विज्ञान शाखा (Science)</option>
                                    <option value="BCom">B.Com. - वाणिज्य शाखा (Commerce)</option>
                                    <option value="BEd">B.Ed. - शिक्षणशास्त्र</option>
                                    <option value="BE">B.E. - अभियांत्रिकी</option>
                                    <option value="BTech">B.Tech. - तंत्रज्ञान</option>
                                    <option value="BCA">B.C.A. - संगणक अनुप्रयोग</option>
                                    <option value="BBA">B.B.A. - व्यवसाय प्रशासन</option>
                                    <option value="LLB">LL.B. - विधी</option>
                                    <option value="Other">इतर (Other)</option>
                            </select>
                                <input type="file" id="graduateFile" name="graduateFile" class="form-control" accept=".pdf">                      
                            </div>
                                <div class="col-md-3">
                                <label for="postGraduateFile" class="form-label marathi-label">
                                    पदव्युत्तर पदवी  <span class="english-label">(Post Graduate Degree)</span>
                                </label>
                                <select name="post_graduate_degree" id="post_graduate_degree" class="form-select mb-2">
                                <option value="">-- पदव्युत्तर पदवी निवडा --</option>
                                <option value="MA">M.A. - कला शाखा</option>
                                <option value="MSc">M.Sc. - विज्ञान शाखा</option>
                                <option value="MCom">M.Com. - वाणिज्य शाखा</option>
                                <option value="MBA">M.B.A. - व्यवसाय प्रशासन</option>
                                <option value="MCA">M.C.A. - संगणक अनुप्रयोग</option>
                                <option value="MTech">M.Tech. - तंत्रज्ञान</option>
                                <option value="ME">M.E. - अभियांत्रिकी</option>
                                <option value="MEd">M.Ed. - शिक्षणशास्त्र</option>
                                <option value="MSW">M.S.W. - समाजकार्य</option>
                                <option value="LLM">LL.M. - विधी</option>
                                <option value="MPharm">M.Pharm. - औषधनिर्माणशास्त्र</option>
                                <option value="MPed">M.P.Ed. - शारीरिक शिक्षण</option>
                                <option value="MMS">M.M.S. - व्यवस्थापन अभ्यास</option>
                                <option value="MCS">M.C.S. - संगणकशास्त्र</option>
                                <option value="MScIT">M.Sc. IT - माहिती तंत्रज्ञान</option>
                                <option value="Other">इतर</option>
                            </select>
                                <input type="file" id="postGraduateFile" name="postGraduateFile" class="form-control" accept=".pdf">                      
                            </div>     
                                
                        </div>
                        <hr/>                        
                    </div>   



                    <div class="col-md-12 mt-3">

                        <label class="form-label fw-bold d-block">
                            आपले सदस्य पद सन २०२३-२४ च्या संयमान्यतेनुसार आहे किंवा त्यापूर्वीचे पायाभूत आहे.
                            <span class="text-danger">*</span>
                        </label>

                        <div class="mt-3">

                            <div class="form-check mb-3">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    id="periodYes"
                                    name="period"
                                    value="1"
                                    onchange="hideDiv('periodDiv');showDiv('periodFileDiv');hideDiv('period2324Div');showBtn('saSubmitBtn_step6')"
                                >
                                <label class="form-check-label ms-2" for="periodYes">
                                    पायाभूत
                                </label>
                            </div>

                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    id="periodNo"
                                    name="period"
                                    value="2"
                                    onchange="hideDiv('periodFileDiv');showDiv('periodDiv');hideDiv('period2324Div')"
                                >
                                <label class="form-check-label ms-2" for="periodNo">
                                    सन २०२३-२४ नंतर पद मंजूर
                                </label>
                            </div>

                        </div>


                        <div id="periodDiv" class="mt-3 hidden">
                            <label for="courtOrdertext" class="form-label marathi-label required-field">
                                 २०२३-२४ च्या नंतरचे असल्यास, संचालित शासन मान्यता घेतली आहे का? 
                            </label>
                          <div class="d-flex w-25 mt-2">
                            <div class="form-check flex-fill">
                                <input class="form-check-input" type="radio"
                                    id="period2324Yes" name="period2324" value="1"
                                    onchange="showDiv('period2324Div');showBtn('saSubmitBtn_step6');">
                                <label class="form-check-label ms-2" for="period2324Yes">
                                    होय
                                </label>
                            </div>

                            <div class="form-check flex-fill">
                                <input class="form-check-input" type="radio"
                                    id="period2324No" name="period2324" value="2"
                                    onchange="hideDiv('period2324Div');hideBtn('saSubmitBtn_step6');">
                                <label class="form-check-label ms-2" for="period2324No">
                                    नाही
                                </label>
                            </div>
                        </div> 
                        </div>

                        <div id="period2324Div" class="form-group mt-2 hidden">      
                            <input type="file" id="period2324File" name="period2324File" class="form-control file-upload-check" accept=".pdf">
                        </div>

                        <div id="periodFileDiv" class="form-group mt-2 hidden">      
                            <input type="file" id="periodFile" name="periodFile" class="form-control file-upload-check" accept=".pdf">
                        </div>
                    </div>


                     


                    <div class="pdf-field mt-2">
                        <h3 class="section-title">जाहिरातीचा तपशील.</h3>
                        <div class="row mt-1">
                            <div class="col-md-3 mt-2">
                                <label for="advApprovelFile" class="form-label marathi-label required-field">
                                     जाहिरात मंजूरी पत्र 
                                </label>                                
                            </div>    
                            <div class="col-md-3">
                                <input type="file" id="advApprovelFile" name="advApprovelFile" class="form-control file-upload-check" accept=".pdf" required>      
                            </div>      
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-3 mt-2">
                                <label for="advertisementFile" class="form-label marathi-label required-field">
                                   जाहिरात
                                </label>                                    
                            </div>     
                            <div class="col-md-3">
                                <input type="file" id="advertisementFile" name="advertisementFile" class="form-control file-upload-check" accept=".pdf" required>      
                            </div>   
                        </div>
                        <hr/>                        
                    </div> 

                    <div class="pdf-field">
                        <h3 class="section-title">शासन/संस्थापक वाढीव पद अनुज्ञेय आदेश.</h3>
                        <div class="row mt-1">
                            <div class="col-md-3 mt-2">
                                <label for="governmentFile" class="form-label marathi-label">
                                     शासन/संस्थापक वाढीव पद अनुज्ञेय आदेश  (if applicable)
                                </label>                                
                            </div>    
                            <div class="col-md-3">
                                <input type="file" id="governmentFile" name="governmentFile" class="form-control file-upload-check" accept=".pdf" required>      
                            </div>      
                        </div>
                        <hr/>                        
                    </div> 

                    <div class="pdf-field">
                        <h3 class="section-title">निवड प्रक्रिया</h3>
                        <div class="row mt-2">
                            <div class="col-md-2 mt-2">
                                <label for="signatureFile" class="form-label marathi-label required-field">
                                     उमेदवारांच्या स्वाक्षरीची यादी
                                </label>                                
                            </div>    
                            <div class="col-md-3">
                                <input type="file" id="signatureFile" name="signatureFile" class="form-control file-upload-check" accept=".pdf" required>      
                            </div>      
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-2 mt-2">
                                <label for="markingFile" class="form-label marathi-label required-field">
                                  उमेदवार गुणांकन
                                </label>                                    
                            </div>     
                            <div class="col-md-3">
                                <input type="file" id="markingFile" name="markingFile" class="form-control file-upload-check" accept=".pdf" required>      
                            </div>   
                        </div>
                          <div class="row mt-3">
                            <div class="col-md-2 mt-2">
                                <label for="resolutionFile" class="form-label marathi-label required-field">
                                  संस्थेचा ठराव
                                </label>                                    
                            </div>     
                            <div class="col-md-3">
                                <input type="file" id="resolutionFile" name="resolutionFile" class="form-control file-upload-check" accept=".pdf" required>      
                            </div>   
                        </div>

                          <div class="row mt-3">
                            <div class="col-md-2 mt-2">
                                <label for="orderFile" class="form-label marathi-label required-field">
                                  आदेश
                                </label>                                    
                            </div>     
                            <div class="col-md-3">
                                <input type="file" id="orderFile" name="orderFile" class="form-control file-upload-check" accept=".pdf" required>      
                            </div>   
                        </div>

                        <hr/>                        
                    </div> 

                    <?php if (!in_array((int)$sanstha["minority_sanstha"], [2, 3], true)): ?>
                    <div class="pdf-field">
                        <h3 class="section-title">रोस्टर (Roster)</h3>

                        <div class="card">
                        <label class="checkbox-label">
                        <label class="checkbox-label">
                             या संस्थेमध्ये एकच शिक्षकेतर पद आहे का? &rarr;
                            </label>
                            <label class="checkbox-label">
                            <input type="radio" id="courtRosterYes"  name="courtRoster" value="1" onchange="hideDiv('courtRosterDiv')"> होय 
                            </label><label class="checkbox-label">
                            <input type="radio" id="courtRosterNo"  name="courtRoster" value="2" onchange="showDiv('courtRosterDiv')">  नाही
                            </label>
                        
                        </label>
                        
                        <div id="courtRosterDiv" class="transfer-section">                        
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <input type="file" id="courtRosterFile" name="courtRosterFile" class="form-control file-upload-check" accept=".pdf">
                                </div>
                            </div>                    
                        </div>
                        </div>

                    </div> 
                    <?php endif; ?>  
                    
                    <div class="card">
                        <label class="checkbox-label">
                        <label class="checkbox-label">
                            या प्रकरणासंदर्भात कोणताही न्यायालयीन आदेश निर्गमित झाला आहे का?  &rarr;
                            </label>
                            <label class="checkbox-label">
                            <input type="radio" id="courtOrderYes"  name="courtOrder" value="1" onchange="showDiv('courtOrderDiv')"> होय 
                            </label><label class="checkbox-label">
                            <input type="radio" id="courtOrderNo"  name="courtOrder" value="2" onchange="hideDiv('courtOrderDiv')">  नाही
                            </label>
                        
                        </label>
                        
                        <div id="courtOrderDiv" class="transfer-section">                        
                            <div class="row mb-3">     
                                <div class="col-md-3">                            
                                        <input type="text" placeholder="याचिका क्रमांक" class="form-control" id="courtOrderPetitionNumber" name="courtOrderPetitionNumber">
                               </div>  
                                <div class="col-md-3">                                    
                                        <input type="date" placeholder="दिनांक" class="form-control" id="courtOrderDate" name="courtOrderDate">
                                </div>                
                                <div class="col-md-6">
                                    <input type="file" id="courtOrderFile" name="courtOrderFile" class="form-control file-upload-check" accept=".pdf">
                                </div>
                            </div>                    
                        </div>
                    </div>
                        
                    
                    <!-- Submit Button -->
                    <div class="form-section">
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="declaration" required>
                            <label class="form-check-label marathi-label" for="declaration">&nbsp;&nbsp;
                                मी खात्रीपूर्वक सांगतो/सांगते की, वरील सर्व माहिती खरी आहे व सर्व कागदपत्रे खरी आहेत. कोणतीही चुकीची माहिती दिल्यास, माझ्यावर योग्य कायदेशीर कारवाई केली जाऊ शकते याची मला पूर्ण कल्पना / जाणीव आहे.
                            </label>
                        </div>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="d-flex justify-content-between mt-4">
                        <!--<button type="button" class="btn btn-outline-secondary" id="saveDraftBtn">
                            <i class="bi bi-save"></i> ड्राफ्ट सेव्ह करा
                        </button>-->
                        <button type="submit" class="btn btn-submit" id="saSubmitBtn_step6">
                            <i class="bi bi-send-check"></i> अर्ज सबमिट करा
                        </button>
                                                

                    </div>
                </form>
            </div>  
                    
              
            
        </div>

    </div>

    <!-- Footer -->
    <div class="slide-footer text-end">
         <div class="row" id="sa_footerBox">
            <div id="sa_footerMsgBox"></div>
            <div class="col-md-12" style="text-align: right;">
                <button class="btn btn-danger btn-sm startApplication-close-slider">Close</button>
            </div>
            
        </div>
    </div>

</div>

<?php echo $this->element('recruit/sanstha/view') ?>


<!-- Slide Panel for Correction Form -->
<div id="correctionApplicationSlider" class="slide-panel" aria-hidden="true" style="border:3px solid #537895;">
     <!-- Header -->
    <div class="slide-header d-flex justify-content-between align-items-center">
        <div style="width:100%;">
            <h5 class="mb-0"><i class="fas fa-arrow-trend-up me-1"></i> Non-Grant → Aided Transfer <div class="text-muted" style="float:right;color:#fff !important;font-size:12px;margin-right:50px;">Staff Name: <span id="empName"></span></div></h5>
            <!--<small class="text-muted">Case ID: <span id="caseId"></span></small>-->
            
           
        </div>
        <button class="btn btn-sm btn-outline-danger correctionApplication-close-slider">X</button>
    </div>

    <!-- Body -->
    <div class="slide-body">
        <div class="form-container">
           
            
               
               
                    <!--
                        <button type="submit" class="btn btn-lg btn-primary w-100">Submit</button>
                
                    </form><form>-->
                    <input type="hidden" value="" name="staffId" id="staffId">
                    <div class="section">
                        <div class="section-title">👤 <span id="empNameDetails"></span></div>
                        <input type="hidden" id="appointmentDate" name="appointmentDate" class="form-control">
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <label for="institutionCode" class="form-label marathi-label">संस्था कोड <span class="english-label">(Institution Code)</span> &rarr; <span class="txtval"><?= h($user["username"]) ?></span></label>                            
                            </div>
                            <div class="col-md-9">                            
                                <label for="institutionName" class="form-label marathi-label">संस्थेचे नाव <span class="english-label">(Institution Name)</span> &rarr; <span class="txtval"><?= h($sanstha["name"]) ?></span></label> 
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <label for="udiseNumber" class="form-label marathi-label">UDISE क्रमांक 
                                <span class="english-label">(UDISE Code)</span> &rarr; <span class="txtval" id="udiseNumber">  
                                    </span></label> 
                        </div>
                    
                        <div class="col-md-9">
                            <label for="schoolName" class="form-label marathi-label">शाळेचे नाव 
                                <span class="english-label">(School Name)</span> &rarr; <span class="txtval" id="schoolName"></span></label> 
                        </div>                  
                        
                        <!-- 1.1 शाळेचे ठिकाण -->
                        <div class="col-md-12">
                            <label for="schoolLocation" class="form-label marathi-label">शाळेचे ठिकाण <span class="english-label">(School Location)</span> &rarr; <span class="txtval" id="schoolLocation"></span></label> 
                        </div>
                    </div>



                    <form id="correctionForm" enctype="multipart/form-data"></form>
                    
                
                    
                   
                    
                        
                    
                    
              
          
                    
              
           
        </div>

    </div>

    <!-- Footer -->
    <div class="slide-footer text-end">
         <div class="row" id="sa_footerBox">
            <div id="sa_footerMsgBox"></div>
            <div class="col-md-12" style="text-align: right;">
                <button class="btn btn-danger btn-sm correctionApplication-close-slider">Close</button>
            </div>
            
        </div>
    </div>

</div>


<!-- Return Application Slide Panel -->
<div id="returnApplicationSlider" class="slide-panel" aria-hidden="true" style="border:3px solid #537895;">
    <!-- Header -->
    <div class="slide-header d-flex justify-content-between align-items-center">
        <div style="width:100%;">
            <h5 class="mb-0"><i class="fas fa-arrow-trend-up me-1"></i> Staff Onboarding </h5>
            <!--<small class="text-muted">Case ID: <span id="caseId"></span></small>-->
        </div>
        <button style="font-size:27px;" class="btn btn-sm btn-outline-danger returnApplication-close-slider">X</button>
    </div>

    <!-- Body -->
    <div class="slide-body">
        <div class="form-container">
            <div id="returnHtmlForm"></div>

        </div>

    </div>

    <!-- Footer -->
    <div class="slide-footer text-end">
                <button class="btn btn-secondary btn-sm returnApplication-close-slider">Close</button>
            
    </div>

</div>




<script>
$(document).ready(function(){

    $(document).on('change', '.file-upload-check', function () {
        const file = this.files[0];
        const maxSize = 2 * 1024 * 1024; // 2 MB

        if (!file) return;

        // Validate file size
        if (file.size > maxSize) {
            alert('File size must be less than 2 MB');
            $(this).val('');
            return;
        }

        // Validate file type (PDF)
        if (file.type !== 'application/pdf') {
            alert('Only PDF files are allowed');
            $(this).val('');
            return;
        }
    });


    $('#forward_to').change(function(){

        let forward_to = $(this).val();

        // Hide all first
        $('#districtDiv').addClass('hidden');
        $('#mahanagarpalikaDiv').addClass('hidden');
        $('#divisionDiv').addClass('hidden');

        // Show based on selection
        if(forward_to == 1 || forward_to == 2){
            $('#districtDiv').removeClass('hidden');
        }

        else if(forward_to == 3){
            $('#mahanagarpalikaDiv').removeClass('hidden');
        }
        else if(forward_to == 4){
            $('#divisionDiv').removeClass('hidden');
        }

    });

    $('#sa_forward_to').change(function(){

        let forward_to = $(this).val();

        // Hide all first
        $('#sa_districtDiv').addClass('hidden');
        $('#sa_mahanagarpalikaDiv').addClass('hidden');
        $('#sa_divisionDiv').addClass('hidden');

        // Show based on selection
        if(forward_to == 1 || forward_to == 2){
            $('#sa_districtDiv').removeClass('hidden');
        }

        else if(forward_to == 3){
            $('#sa_mahanagarpalikaDiv').removeClass('hidden');
        }
        else if(forward_to == 4){
            $('#sa_divisionDiv').removeClass('hidden');
        }

    });

});
</script>

<script>
    function toggleDiv(chkBox,div) {
        const checkbox = document.getElementById(chkBox);
        const areaDiv = document.getElementById(div);

        areaDiv.style.display = checkbox.checked ? "block" : "none";
        if(chkBox == 'minorityCheck'){
            if(checkbox.checked){
                $("#casteCategoryBox").hide();
                $("#bindunamavaliMavakaDawareBox").hide();
                $('#originalCategory').prop('disabled', true);
                $('#appointmentCategory').prop('disabled', true);
                $('#horizontalCategory').prop('disabled', true);
                $('#mavakCheckListDate').prop('disabled', true);
                $('#mavakCheckListFile').prop('disabled', true);                
                $('#minorityCertOutwardNumber').prop('disabled', false);
                $('#minorityCertOutwardDate').prop('disabled', false);
                $('#minorityCertOutwardFile').prop('disabled', false);
            }else{             
                $("#casteCategoryBox").show();
                $("#bindunamavaliMavakaDawareBox").show();
                $('#originalCategory').prop('disabled', false);
                $('#appointmentCategory').prop('disabled', false);
                $('#horizontalCategory').prop('disabled', false);
                $('#mavakCheckListDate').prop('disabled', false);
                $('#mavakCheckListFile').prop('disabled', false);
                $('#minorityCertOutwardNumber').prop('disabled', true);
                $('#minorityCertOutwardDate').prop('disabled', true);
                $('#minorityCertOutwardFile').prop('disabled', true);
            }
        }
        if(chkBox == 'transferCheck'){
            if(checkbox.checked){
                $('#transferSchool').prop('disabled', false);
            }else{    
                $('#transferSchool').prop('disabled', true);
            }
        }
        if(chkBox == 'tetCheck'){
            if(checkbox.checked){
                $('#tetnumber').prop('disabled', false);
                $('#tetExam').prop('disabled', false);
                $('#tetPaper').prop('disabled', false);
                $('#tetCertificateFile').prop('disabled', false);
            }else{    
                $('#tetnumber').prop('disabled', true);
                $('#tetExam').prop('disabled', true);
                $('#tetPaper').prop('disabled', true);
                $('#tetCertificateFile').prop('disabled', true);
            }
        }
        if(chkBox == 'ctetCheck'){
            if(checkbox.checked){
                $('#ctetnumber').prop('disabled', false);
                $('#ctetExam').prop('disabled', false);
                $('#ctetPaper').prop('disabled', false);
                $('#ctetCertificateFile').prop('disabled', false);
            }else{    
                $('#ctetnumber').prop('disabled', true);
                $('#ctetExam').prop('disabled', true);
                $('#ctetPaper').prop('disabled', true);
                $('#ctetCertificateFile').prop('disabled', true);
            }
        }
    }
    function showDiv(div) {
        const areaDiv = document.getElementById(div);
        areaDiv.style.display =  "block";
    }
    function hideDiv(div) {
        const areaDiv = document.getElementById(div);
        areaDiv.style.display =  "none";
    }      
    
    function showBtn(btn) {
        const areaBtn = document.getElementById(btn);
        areaBtn.style.display =  "block";
    } 
    function hideBtn(btn) {
        const areaBtn = document.getElementById(btn);
        areaBtn.style.display =  "none";
    } 
</script>

<script>  
    $(document).ready(function() {  

       

        $('#schoolCommitteeOutwardDate, #originSansthaAppointmentDate').on('blur', function () {

            var outwardDate = $('#schoolCommitteeOutwardDate').val();
            var appointmentDate = $('#originSansthaAppointmentDate').val();

            if (outwardDate && appointmentDate) {

                var outward = new Date(outwardDate);
                var appointment = new Date(appointmentDate);

                // Check: Appointment date BEFORE outward date
                if (appointment < outward) {
                    alert('नियुक्ती ठरावाच्या दिनांकापूर्वीची असल्यामुळे हा अर्ज पुढे प्रक्रिया करता येणार नाही.');
                }

            }
        });

       

       

            // Open slider
        currentMode =2;
        currentAppId =0;
        // ------------------------------
        // Slider 1: .im-open-transfer (targets #imSlider)
        // ------------------------------
        $(document).on('click', '.im-open-transfer', function () {
            const caseId = $(this).data('id');
            const staffJson = $(this).attr('data-staffObject');           
            const staffObject = JSON.parse(staffJson);
            currentMode = $(this).attr('data-mode');
            currentAppId = staffObject.id;
            // Trigger custom event for this specific slider
            $(document).trigger('im:openSlider', [caseId, staffObject]);
        });

        // Close button for Slider 1
        $(document).on('click', '.im-close-slider', function () {
            $(document).trigger('im:closeSlider');
        });

        // Custom event handlers for Slider 1
        $(document).on('im:openSlider', function (e, caseId, staffObject) {
            loadStaffDetails(caseId, staffObject);   // Generic function (assumed to work for both sliders)
            $('#imSlider').addClass('open').attr('aria-hidden', 'false');
        });

        $(document).on('im:closeSlider', function () {
            $('#imSlider').removeClass('open').attr('aria-hidden', 'true');
        });

        function loadStaffDetails(caseId,staffObject) {          
          
            console.log("vvvv->"+staffObject.id);
            console.log("ddddddddd->"+staffObject.school_permission_order_date);
            $('#im_footerBox').show();
            $('#im_footerMsgBox').hide();
            $('#imSubmitBtn').show();
            
            $('#imForm')[0].reset();
            $('#imForm input[type="file"]').val('');
           
            
            $('#im_empName').val(staffObject.teacher_name); /// in the header
        }
        $('#imForm').submit(function(e) {                   
            e.preventDefault();                   
            var formData = new FormData(this);
            forward_to = $('#forward_to').val();
      
            if(forward_to == 1 || forward_to == 2){
                forward_to_target = $('#forward_to_district').val();
                if(forward_to_target<=0){
                    alert("Please Select District");
                    return false;
                }
            }
            else if(forward_to == 3){
                forward_to_target = $('#forward_to_palika').val();
                if(forward_to_target<=0){
                    alert("Please Select Mahanagar Palika");
                    return false;
                }
            }
            else if(forward_to == 4){
                forward_to_target = $('#forward_to_region').val();
                if(forward_to_target<=0){
                    alert("Please Select Division");
                    return false;
                }
            }



            formData.append('app_id', currentAppId);
            formData.append('forward_to_target', forward_to_target);
            $('#imSubmitBtn').hide();
            $.ajax({
                url: '',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                },
                success: function(response) {
                    
                        $('#actionBtns_'+currentAppId).html('<b style="color:green;">Pending EO Verification</b>');
                        //$('#im_footerBox').hide();
                        $('#im_footerMsgBox').show();
                        
                        $('#im_footerMsgBox').html('Personal Recognition Document(वैयक्तिक मान्यता) has been sent to the EO desk for verification.');    
                                       
                   
                    //$('#actionBtns_'+currentAppId).html('');
                },
                error: function(xhr, status, error) {
                    // Handle error

                }
            });
           
        });

        

        // ------------------------------
        // Slider 3: .startApplication-open-transfer (targets #startApplicationSlider)
        // ------------------------------
       

        /*$(document).on('click', '#saSubmitBtn_step1', function () {
            alert(123);
        });
        */
        activateStep = function (sid){
            $('#saStep1').hide();
            $('#saStep2').hide();
            $('#saStep3').hide();
            $('#saStep4').hide();
            $('#saStep5').hide();
            $('#saStep6').hide();
            $('#saStep'+sid).show();
            $('#saFormStep'+sid)[0].reset();
            $('#saFormStep'+sid+' input[type="file"]').val('');
        }
        ng2g_id =0;        

        $(document).on('click', '.startApplication-open-onboarding', function () {           
            const caseId = $(this).data('id');
            let staffJson = $(this).attr('data-staffObject');   // raw JSON string
            let staffObject   = JSON.parse(staffJson)
            currentMode = $(this).attr('data-mode'); 
            currentAppId = staffObject.id; 
            //console.log(staffObject);
            currentStep = 1;
                
            ng2g_id = staffObject.ng2g_id;

            ng2g_id = Number(ng2g_id);

            // handle NaN / null / empty
            if (!Number.isFinite(ng2g_id)) {
                ng2g_id = 0;
            }
            
                           
            activateStep(currentStep);
                
            $('#sa_footerBox').show();
            $('#sa_footerMsgBox').hide();    

           $(document).trigger('startApplicationonBoarding:openSlider', [caseId, staffObject]);
        });

          // Close slider
        $(document).on('click', '.startApplicationonBoarding-close-slider', function () {
            $(document).trigger('startApplicationonBoarding:closeSlider');
        });

        // Custom event handlers for Slider 2
        $(document).on('startApplicationonBoarding:openSlider', function (e, caseId, staffObject) {
            loadonBoardingDetails(caseId, staffObject);
            $('#startApplicationonBoardingSlider').addClass('open').attr('aria-hidden', 'false');
        });

        $(document).on('startApplicationonBoarding:closeSlider', function () {
            $('#startApplicationonBoardingSlider').removeClass('open').attr('aria-hidden', 'true');
        });
        
function loadonBoardingDetails(caseId, staffObject) {
    if (!staffObject || !staffObject.id) {
        console.warn('Missing staffObject.id for onboarding details');
        return;
    }

    const staffId = Number(staffObject.id);

    $('#staffId').val(staffId);
    $('#udiseNumber_onboard').text(staffObject.udise_code || '');
    $('#schoolName_onboard').text(staffObject.school_name || '');
    $('#appointmentDate').val(staffObject.date_of_joining || '');
    $('#empNameDetails').html(staffObject.post_name || '');
     $('#empNameDetails1').html(staffObject.post_name || '');                

    let basicData = {
        institution_code: staffObject.sanstha_code,
        institution_name: staffObject.sanstha_name,
        udise_code: staffObject.udise_code,
        school_name: staffObject.school_name,
        staff_name: staffObject.teacher_name,
        staff_type: staffObject.post_type,
        post_name: staffObject.post_name,
        aid_name: staffObject.aid_name,
        email: staffObject.email,
        mobile: staffObject.mobile,
        pay_scale: staffObject.pay_scale,
        subject_taught: staffObject.subject_taught,
        medium: staffObject.medium
    };
    $("#sa_basic_data").val(JSON.stringify(basicData));

    $.ajax({
        url: '<?= $this->Url->build(["controller" => "Sanstha", "action" => "getStaffOnboardingDetails"]); ?>' + '?staff_id=' + encodeURIComponent(staffId),
        type: 'GET',
        dataType: 'json',
        headers: {
            'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function(response) {
            if (!response.success || !response.data) {
                return;
            }

            const d = response.data;
           document.getElementById('htmldiv_onboard').innerHTML = response.htmlbody;
           
          
            $('#appointmentDate_onboard').val(d.appointment_date || '');
           
           
            $('#courtOrderPetitionNumber_onboard').val(d.court_order_petition_number || '');
            $('#courtOrderDate_onboard').val(d.court_order_date || '');

            const rosterValue = d.roster;
            if (rosterValue !== undefined && rosterValue !== null && rosterValue !== '') {
                const isRosterYes = rosterValue === true || rosterValue === 'true' || rosterValue === 1 || rosterValue === '1';
                $('#courtRoster_onboard').text(isRosterYes ? 'Yes' : 'No');
                if(rosterValue == 0 || rosterValue == '0' || rosterValue === false || rosterValue === 'false'){
                    $('#courtRosterDiv_onbord').show();
                } else {
                    $('#courtRosterDiv_onbord').hide();
                }
            }

            const orderCourtRosterValue = d.court_order;
            if (orderCourtRosterValue !== undefined && orderCourtRosterValue !== null && orderCourtRosterValue !== '') {
                const isOrderRosterYes = orderCourtRosterValue === true || orderCourtRosterValue === 'true' || orderCourtRosterValue === 1 || orderCourtRosterValue === '1';
                $('#orderCourtRoster_onboard').text(isOrderRosterYes ? 'Yes' : 'No');
                 if(orderCourtRosterValue == 1 || orderCourtRosterValue == '1' || orderCourtRosterValue === true || orderCourtRosterValue === 'true'){
                    $('#orderCourtRosterDiv_onbord').show();
                } else {
                    $('#orderCourtRosterDiv_onbord').hide();
                }
                
            }


            const originalCategoryValue = d.original_category ?? '';
            if (originalCategoryValue !== '') {
                $('#originalCategory_onboard').val(originalCategoryValue);
            }

            const appointmentCategoryValue = d.appointment_category ?? '';
            if (appointmentCategoryValue !== '') {
                $('#appointmentCategory_onboard').val(appointmentCategoryValue);
            }

            const horizontalCategoryValue = d.horizontal_category ?? '';
            if (horizontalCategoryValue !== '') {
                $('#horizontalCategory_onboard').val(horizontalCategoryValue);
            }


            const documents = Array.isArray(d.documents) ? d.documents : [];

            const getDocumentUrl = function (docType) {
                const doc = documents.find((item) =>
                    String(item.document_type || '').toLowerCase() === String(docType).toLowerCase()
                );

                if (!doc || !doc.file_path) {
                    return '';
                }

                return doc.file_path.startsWith('http')
                    ? doc.file_path
                    : '<?= $this->Url->build("/", ["fullBase" => true]) ?>' + doc.file_path.replace(/^\/+/, '');
            };

            const renderDocumentLink = function (docType, targetId) {
            const fileUrl = getDocumentUrl(docType);

            if (fileUrl) {
                $(targetId).html(`
                    <a href="${escapeHtml(fileUrl)}" target="_blank" rel="noopener">
                        कागदपत्र पहा
                    </a>
                `);
            } else {
                $(targetId).html('<span class="text-muted">कागदपत्र उपलब्ध नाही</span>');
            }

        };


            renderDocumentLink('ssc', '#ssc_onboard_file');
            renderDocumentLink('hsc', '#hsc_onboard_file');
            renderDocumentLink('graduate', '#graduate_onboard_file');
            renderDocumentLink('post_graduate', '#post_graduate_onboard_file'); 
            renderDocumentLink('adv_approval', '#adv_approval_onboard_file'); 
            renderDocumentLink('advertisement', '#advertisement_onboard_file');  
            renderDocumentLink('government', '#government_onboard_file');                        
            renderDocumentLink('signature', '#signature_onboard_file');
            renderDocumentLink('marking', '#marking_onboard_file');
            renderDocumentLink('resolution', '#resolution_onboard_file');
            renderDocumentLink('order', '#order_onboard_file');
            renderDocumentLink('court_roster', '#courtRoster_onboard_file');
            renderDocumentLink('court_order', '#courtOrder_onboard_file');

        }
    });
}

      function escapeHtml(value)
                {
                    return $('<div>')
                        .text(value ?? '')
                        .html();
                }

        $(document).on('click', '.startApplication-open-transfer', function () {           
            const caseId = $(this).data('id');
            let staffJson = $(this).attr('data-staffObject');   // raw JSON string
            let staffObject   = JSON.parse(staffJson)
            currentMode = $(this).attr('data-mode'); 
            currentAppId = staffObject.id; 
            //console.log(staffObject);
            currentStep = $(this).attr('app-step'); 
            if (currentStep < 2 || currentStep > 6) {
                currentStep = 1;
                
            }
            ng2g_id = staffObject.ng2g_id;

            ng2g_id = Number(ng2g_id);

            // handle NaN / null / empty
            if (!Number.isFinite(ng2g_id)) {
                ng2g_id = 0;
            }
            
            //$('#tetdaatadiv').hide(); 
            //$('#ctetdaatadiv').hide(); 
            ///toggleDiv('transferCheck','transferDiv');
           //toggleDiv('minorityCheck','minorityDiv');
            //toggleDiv('tetCheck','tetDiv');
            //toggleDiv('ctetCheck','ctetDiv');                
            activateStep(currentStep);
            let postName = staffObject.post_name || '';
            let normalizedPostName = postName.toLowerCase().replace(/[^a-z0-9]+/g, '_');
            console.log("Normalized Post Name: " + normalizedPostName);
            let matchingPayScale = $('#pay_scale option').filter(function () {
                return this.value && normalizedPostName.includes(this.value);
            }).first().val();
            console.log("Matching Pay Scale: " + matchingPayScale);
            $('#pay_scale').val(matchingPayScale || '');
            /*if(staffObject.is_minority_school == 1){
                $("#bindunamavaliMavakaDawareBox").hide();
                $('#mavakCheckListDate').prop('disabled', true);
                $('#mavakCheckListFile').prop('disabled', true);   
            }*/
                        
            $('#sa_footerBox').show();
            $('#sa_footerMsgBox').hide();    

           $(document).trigger('startApplication:openSlider', [caseId, staffObject]);
        });

        // Close slider
        $(document).on('click', '.startApplication-close-slider', function () {
            $(document).trigger('startApplication:closeSlider');
        });

        // Custom event handlers for Slider 2
        $(document).on('startApplication:openSlider', function (e, caseId, staffObject) {
            loadSaDetails(caseId, staffObject);
            $('#startApplicationSlider').addClass('open').attr('aria-hidden', 'false');
        });

        $(document).on('startApplication:closeSlider', function () {
            $('#startApplicationSlider').removeClass('open').attr('aria-hidden', 'true');
        });

        function loadSaDetails(caseId,staffObject) {
           // $('#saForm')[0].reset();
           // $('#saForm input[type="file"]').val('');
            //console.log(staffObject);
           
            $('#staffId').val(staffObject.id);
            //$('#caseId').text(caseId);
            
                
            //$('#empName').text(staffObject.teacher_name);
            $('#udiseNumber').text(staffObject.udise_code);
            $('#schoolName').text(staffObject.school_name);
            $('#appointmentDate').val(staffObject.date_of_joining);

          
             empNameDetails = staffObject.post_name ;
            $('#empNameDetails').html(empNameDetails);
          

            let basicData = {
                                "institution_code" : staffObject.sanstha_code,
                                "institution_name" : staffObject.sanstha_name,
                                "udise_code" : staffObject.udise_code,
                                "school_name" : staffObject.school_name,
                                "staff_name" : staffObject.teacher_name,
                                "staff_type" : staffObject.post_type,
                                "post_name" : staffObject.post_name,
                                "aid_name" : staffObject.aid_name,
                                "email" : staffObject.email,
                                "mobile" : staffObject.mobile,
                                "pay_scale" : staffObject.pay_scale,
                                "subject_taught" : staffObject.subject_taught,
                                "medium" : staffObject.medium
                            };
            $("#sa_basic_data").val(JSON.stringify(basicData));                       
           // $('#designation').text(designation);
            //$('#school').text(staffObject?.caste_category?.category_name);
            //$('#remarks').text('Case under scrutiny by Education Officer.');
        }

        $('#saFormStep1').submit(function(e) {
            e.preventDefault();  
            var formData = new FormData(this);
            console.log(Object.fromEntries(formData));

            $.ajax({
                url: '<?= $this->Url->build(['prefix' => 'Recruit',"controller" => "Sanstha", "action" => "saveStaffOnboarding"]); ?>',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                },
                success: function(response) {
                  
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
        $('#saFormStep2').submit(function(e) {
            e.preventDefault();  
            var formData = new FormData(this);

            formData.append('ng2g_id', ng2g_id); 
            
            $.ajax({
                url: '',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                },
                success: function(response) {
                    console.log(response);
                    //alert(response.message);
                    if(response.success){
                        ng2g_id = response.id;
                        activateStep(3);
                    }
                    // Handle success
                },
                error: function(xhr, status, error) {
                    // Handle error

                }
            });
        });
        $('#saFormStep3').submit(function(e) {
            e.preventDefault();  
            var formData = new FormData(this);

            formData.append('ng2g_id', ng2g_id); 
            
            $.ajax({
                url: '',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                },
                success: function(response) {
                    console.log(response);
                    //alert(response.message);
                    if(response.success){
                        ng2g_id = response.id;
                        if(response.is_minority_school==1){
                            $("#bindunamavaliMavakaDawareBox").hide();
                            $('#mavakCheckListDate').prop('disabled', true);
                            $('#mavakCheckListFile').prop('disabled', true); 
                        }                        
                        activateStep(4);
                    }
                    // Handle success
                },
                error: function(xhr, status, error) {
                    // Handle error

                }
            });
        });
        $('#saFormStep4').submit(function(e) {
            e.preventDefault();  
            var formData = new FormData(this);

            formData.append('ng2g_id', ng2g_id); 
            
            $.ajax({
                url: '',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                },
                success: function(response) {
                    console.log(response);
                    //alert(response.message);
                    if(response.success){
                        ng2g_id = response.id;
                        activateStep(5);
                    }
                    // Handle success
                },
                error: function(xhr, status, error) {
                    // Handle error

                }
            });
        });
        $('#saFormStep5').submit(function(e) {
            e.preventDefault();  
            if (!$("input[name='courtOrder']:checked").length) {
                alert("सदर प्रकरणासंदर्भात कोणताही न्यायालयीन आदेश निर्गमित झाला आहे का? कृपया “होय” किंवा “नाही” पर्याय निवडा."); // Marathi message
                return false;
            }
            var formData = new FormData(this);

            formData.append('ng2g_id', ng2g_id); 
            
            $.ajax({
                url: '',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                },
                success: function(response) {
                    console.log(response);
                    //alert(response.message);
                    if(response.success){
                        ng2g_id = response.id;
                        activateStep(6);
                    }
                    // Handle success
                },
                error: function(xhr, status, error) {
                    // Handle error

                }
            });
        });

        $('#saFormStep6').submit(function(e) {
            e.preventDefault();  
            
            var formData = new FormData(this);
            sa_forward_to = $('#sa_forward_to').val();
      
            if(sa_forward_to == 1 || sa_forward_to == 2){
                sa_forward_to_target = $('#sa_forward_to_district').val();
                if(sa_forward_to_target<=0){
                    alert("Please Select District");
                    return false;
                }
            }
            else if(sa_forward_to == 3){
                sa_forward_to_target = $('#sa_forward_to_palika').val();
                if(sa_forward_to_target<=0){
                    alert("Please Select Mahanagar Palika");
                    return false;
                }
            }
            else if(sa_forward_to == 4){
                sa_forward_to_target = $('#sa_forward_to_region').val();
                if(sa_forward_to_target<=0){
                    alert("Please Select Division");
                    return false;
                }
            }
            formData.append('sa_forward_to_target', sa_forward_to_target);

            formData.append('ng2g_id', ng2g_id); 
            
            $.ajax({
                url: '',
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
                    /*console.log(response);
                    //alert(response.message);
                    if(response.success){
                        ng2g_id = response.id;
                        activateStep(6);
                    }*/
                    // Handle success
                },
                error: function(xhr, status, error) {
                    // Handle error

                }
            });
        });

        $('#saForm').submit(function(e) {
           
            e.preventDefault();  
            var formData = new FormData(this);
            sa_forward_to = $('#sa_forward_to').val();
      
            if(sa_forward_to == 1 || sa_forward_to == 2){
                sa_forward_to_target = $('#sa_forward_to_district').val();
                if(sa_forward_to_target<=0){
                    alert("Please Select District");
                    return false;
                }
            }
            else if(sa_forward_to == 3){
                sa_forward_to_target = $('#sa_forward_to_palika').val();
                if(sa_forward_to_target<=0){
                    alert("Please Select Mahanagar Palika");
                    return false;
                }
            }
            else if(sa_forward_to == 4){
                sa_forward_to_target = $('#sa_forward_to_region').val();
                if(sa_forward_to_target<=0){
                    alert("Please Select Division");
                    return false;
                }
            }



            formData.append('app_id', currentAppId);
            formData.append('sa_forward_to_target', sa_forward_to_target);
            
            
            $.ajax({
                url: '',
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


        // ------------------------------
        // Slider 4: .correctionApplication-open-transfer (targets #correctionApplicationSlider)
        // ------------------------------
       

        
        ng2g_id =0;        
        $(document).on('click', '.correctionApplication-open-transfer', function () {           
            const caseId = $(this).data('id');
            let staffJson = $(this).attr('data-staffObject');   // raw JSON string
            let staffObject   = JSON.parse(staffJson)
            currentMode = $(this).attr('data-mode'); 
            currentAppId = staffObject.id; 
            //console.log(staffObject);
            currentStep = $(this).attr('app-step'); 
            if (currentStep < 2 || currentStep > 6) {
                currentStep = 1;
                
            }
            ng2g_id = staffObject.ng2g_id;

            ng2g_id = Number(ng2g_id);

            // handle NaN / null / empty
            if (!Number.isFinite(ng2g_id)) {
                ng2g_id = 0;
            }
            
            $('#tetdaatadiv').hide(); 
            $('#ctetdaatadiv').hide(); 
            toggleDiv('transferCheck','transferDiv');
            toggleDiv('minorityCheck','minorityDiv');
            toggleDiv('tetCheck','tetDiv');
            toggleDiv('ctetCheck','ctetDiv');                
            activateStep(currentStep);
            if(staffObject.is_minority_school == 1){
                $("#bindunamavaliMavakaDawareBox").hide();
                $('#mavakCheckListDate').prop('disabled', true);
                $('#mavakCheckListFile').prop('disabled', true);   
            }
                        
            $('#sa_footerBox').show();
            $('#sa_footerMsgBox').hide();    

           $(document).trigger('correctionApplication:openSlider', [caseId, staffObject]);
        });

        // Close slider
        $(document).on('click', '.correctionApplication-close-slider', function () {
            $(document).trigger('correctionApplication:closeSlider');
        });

        // Custom event handlers for Slider 2
        $(document).on('correctionApplication:openSlider', function (e, caseId, staffObject) {
            loadCorrectionDetails(caseId, staffObject);
            $('#correctionApplicationSlider').addClass('open').attr('aria-hidden', 'false');
        });

        $(document).on('correctionApplication:closeSlider', function () {
            $('#correctionApplicationSlider').removeClass('open').attr('aria-hidden', 'true');
        });

        function loadCorrectionDetails(caseId,staffObject) {
          
            let designation = '';

            if (staffObject && staffObject.post && staffObject.post.name) {
                designation = staffObject.post.name;
            }

            if (staffObject && staffObject.current_post) {
                designation += ' (' + staffObject.current_post + ')';
            }
                    
            $('#staffId').val(staffObject.id);
            //$('#caseId').text(caseId);
            
                
            $('#empName').text(staffObject.teacher_name);
            $('#udiseNumber').text(staffObject.udise_code);
            $('#schoolName').text(staffObject.school_name);           
            $('#appointmentDate').val(staffObject.date_of_joining);

            
            
            staff_type_name = "Teaching";
            if(staffObject.post_type ==2){
                staff_type_name = "Non-Teaching";
            }
            //jquery format date to dd/mm/yyyy
             empNameDetails = staffObject.teacher_name +' <span style="color:#333; font-size:12px;"> &nbsp;&nbsp;|&nbsp;&nbsp; '+
                             staff_type_name+' &nbsp;&nbsp;|&nbsp;&nbsp; '+
                             staffObject.date_of_joining +' &nbsp;&nbsp;|&nbsp;&nbsp; '+
                             staffObject.post_name+' &nbsp;&nbsp;|&nbsp;&nbsp; '+staffObject.aid_name+
                             ' &nbsp;&nbsp;|&nbsp;&nbsp; '+staffObject.email+
                             ' &nbsp;&nbsp;|&nbsp;&nbsp; '+staffObject.mobile+'</span>';
            $('#empNameDetails').html(empNameDetails);
            
            var correctionFormHtml ='<div class="card shadow"><div class="card-body"><div class="alert alert-warning"><strong>Instructions :</strong> Tick the fields which contain incorrect or incomplete information. Mention the reason in Remarks.</div><table class="table table-bordered table-hover"><thead><tr><th width="60">Select<th width="35%">Field Name<th width="25%">Current Value<th>Remarks<tbody><tr><td class="text-center"><input class="form-check-input item"type="checkbox"><td class="field-name">कर्मचाऱ्याचे नाव (Teacher Name)<td>Rahul Patil<td><textarea class="form-control"rows="2"placeholder="Reason for correction"></textarea><tr><td class="text-center"><input class="form-check-input item"type="checkbox"><td class="field-name">पदनाम (Designation)<td>Assistant Teacher<td><textarea class="form-control"rows="2"></textarea><tr><td class="text-center"><input class="form-check-input item"type="checkbox"><td class="field-name">वेतनश्रेणी (Salary Grade)<td>S-15<td><textarea class="form-control"rows="2"></textarea><tr><td class="text-center"><input class="form-check-input item"type="checkbox"><td class="field-name">अध्यापन विषय (Teaching Subjects)<td>Mathematics<td><textarea class="form-control"rows="2"></textarea><tr><td class="text-center"><input class="form-check-input item"type="checkbox"><td class="field-name">अध्यापन वर्ग (Teaching Classes)<td>Class VIII–X<td><textarea class="form-control"rows="2"></textarea><tr><td class="text-center"><input class="form-check-input item"type="checkbox"><td class="field-name">मूळ आरक्षण प्रवर्ग (Original Reservation)<td>OBC<td><textarea class="form-control"rows="2"></textarea><tr><td class="text-center"><input class="form-check-input item"type="checkbox"><td class="field-name">नियुक्तीचा प्रवर्ग (Appointment Category)<td>Open<td><textarea class="form-control"rows="2"></textarea><tr><td class="text-center"><input class="form-check-input item"type="checkbox"><td class="field-name">PAN Number<td>ABCDE1234F<td><textarea class="form-control"rows="2"></textarea><tr><td class="text-center"><input class="form-check-input item"type="checkbox"><td class="field-name">Aadhaar Number<td>XXXX-XXXX-1234<td><textarea class="form-control"rows="2"></textarea></table></div><div class="card-footer text-end"><button class="btn btn-secondary">Save Draft</button> <button class="btn btn-danger">Return Application</button></div></div>';

            $('#correctionForm').html(correctionFormHtml);
                              
           // $('#designation').text(designation);
            //$('#school').text(staffObject?.caste_category?.category_name);
            //$('#remarks').text('Case under scrutiny by Education Officer.');
        }

        $('#correctionForm').submit(function(e) {
            return false;
            e.preventDefault();  
            var selectedClass = $('input[name="teachingClasses"]:checked').val();
            if(!selectedClass){
                alert('Please select अध्यापन वर्ग (Teaching Classes)');
                return false;
            }

            let storedData = JSON.parse($("#sa_basic_data").val());
            //console.log(storedData.staff_name);

            let transferSchoolCode = "";
            let transferSchoolName = "";
            if ($("#transferCheck").is(":checked")) {    

                let selectedVal = $("#transferSchool").val(); // code

                let selectedText = $("#transferSchool option:selected").text();

                // Split by "|"
                let parts = selectedText.split("|");

                transferSchoolCode = parts[0].trim();
                transferSchoolName = parts[1].trim();
                //console.log("Code:", transferSchoolCode);
                //console.log("Name:", transferSchoolName);
            }

            



            var formData = new FormData(this);

            formData.append('app_id', currentAppId); 
            formData.append('ng2g_id', ng2g_id); 
                           
            formData.append('institution_code', storedData.institution_code);
            formData.append('institution_name', storedData.institution_name);
            formData.append('udise_code', storedData.udise_code);
            formData.append('school_name', storedData.school_name);

            formData.append('emp_name', storedData.staff_name);
            formData.append('staff_type', storedData.staff_type);
            formData.append('staff_type_name', storedData.staff_type_name);
            formData.append('post_name', storedData.post_name);   
            
            formData.append('aid_name', storedData.aid_name);
            formData.append('email', storedData.email);
            formData.append('mobile', storedData.mobile);

            formData.append('pay_scale', storedData.pay_scale);
            formData.append('subject_taught', storedData.subject_taught);
            formData.append('medium', storedData.medium);
            formData.append('schoolNameAtTransfer', transferSchoolName);
            

            $.ajax({
                url: '',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                },
                success: function(response) {
                    console.log(response);
                    //alert(response.message);
                    if(response.success){
                        ng2g_id = response.id;
                        activateStep(2);
                    }
                    // Handle success
                },
                error: function(xhr, status, error) {
                    // Handle error

                }
            });


            
        });
        $('#saFormStep2').submit(function(e) {
            e.preventDefault();  
            var formData = new FormData(this);

            formData.append('ng2g_id', ng2g_id); 
            
            $.ajax({
                url: '',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                },
                success: function(response) {
                    console.log(response);
                    //alert(response.message);
                    if(response.success){
                        ng2g_id = response.id;
                        activateStep(3);
                    }
                    // Handle success
                },
                error: function(xhr, status, error) {
                    // Handle error

                }
            });
        });
        $('#saFormStep3').submit(function(e) {
            e.preventDefault();  
            var formData = new FormData(this);

            formData.append('ng2g_id', ng2g_id); 
            
            $.ajax({
                url: '',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                },
                success: function(response) {
                    console.log(response);
                    //alert(response.message);
                    if(response.success){
                        ng2g_id = response.id;
                        if(response.is_minority_school==1){
                            $("#bindunamavaliMavakaDawareBox").hide();
                            $('#mavakCheckListDate').prop('disabled', true);
                            $('#mavakCheckListFile').prop('disabled', true); 
                        }                        
                        activateStep(4);
                    }
                    // Handle success
                },
                error: function(xhr, status, error) {
                    // Handle error

                }
            });
        });
        $('#saFormStep4').submit(function(e) {
            e.preventDefault();  
            var formData = new FormData(this);

            formData.append('ng2g_id', ng2g_id); 
            
            $.ajax({
                url: '',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                },
                success: function(response) {
                    console.log(response);
                    //alert(response.message);
                    if(response.success){
                        ng2g_id = response.id;
                        activateStep(5);
                    }
                    // Handle success
                },
                error: function(xhr, status, error) {
                    // Handle error

                }
            });
        });
        $('#saFormStep5').submit(function(e) {
            e.preventDefault();  
            if (!$("input[name='courtOrder']:checked").length) {
                alert("सदर प्रकरणासंदर्भात कोणताही न्यायालयीन आदेश निर्गमित झाला आहे का? कृपया “होय” किंवा “नाही” पर्याय निवडा."); // Marathi message
                return false;
            }
            var formData = new FormData(this);

            formData.append('ng2g_id', ng2g_id); 
            
            $.ajax({
                url: '',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                },
                success: function(response) {
                    console.log(response);
                    //alert(response.message);
                    if(response.success){
                        ng2g_id = response.id;
                        activateStep(6);
                    }
                    // Handle success
                },
                error: function(xhr, status, error) {
                    // Handle error

                }
            });
        });

        $('#saFormStep6').submit(function(e) {
            e.preventDefault();  
            
            var formData = new FormData(this);
            sa_forward_to = $('#sa_forward_to').val();
      
            if(sa_forward_to == 1 || sa_forward_to == 2){
                sa_forward_to_target = $('#sa_forward_to_district').val();
                if(sa_forward_to_target<=0){
                    alert("Please Select District");
                    return false;
                }
            }
            else if(sa_forward_to == 3){
                sa_forward_to_target = $('#sa_forward_to_palika').val();
                if(sa_forward_to_target<=0){
                    alert("Please Select Mahanagar Palika");
                    return false;
                }
            }
            else if(sa_forward_to == 4){
                sa_forward_to_target = $('#sa_forward_to_region').val();
                if(sa_forward_to_target<=0){
                    alert("Please Select Division");
                    return false;
                }
            }
            formData.append('sa_forward_to_target', sa_forward_to_target);

            formData.append('ng2g_id', ng2g_id); 
            
            $.ajax({
                url: '<',
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
                    /*console.log(response);
                    //alert(response.message);
                    if(response.success){
                        ng2g_id = response.id;
                        activateStep(6);
                    }*/
                    // Handle success
                },
                error: function(xhr, status, error) {
                    // Handle error

                }
            });
        });

        $('#saForm').submit(function(e) {
           
            e.preventDefault();  
            var formData = new FormData(this);
            sa_forward_to = $('#sa_forward_to').val();
      
            if(sa_forward_to == 1 || sa_forward_to == 2){
                sa_forward_to_target = $('#sa_forward_to_district').val();
                if(sa_forward_to_target<=0){
                    alert("Please Select District");
                    return false;
                }
            }
            else if(sa_forward_to == 3){
                sa_forward_to_target = $('#sa_forward_to_palika').val();
                if(sa_forward_to_target<=0){
                    alert("Please Select Mahanagar Palika");
                    return false;
                }
            }
            else if(sa_forward_to == 4){
                sa_forward_to_target = $('#sa_forward_to_region').val();
                if(sa_forward_to_target<=0){
                    alert("Please Select Division");
                    return false;
                }
            }



            formData.append('app_id', currentAppId);
            formData.append('sa_forward_to_target', sa_forward_to_target);
            
            
            $.ajax({
                url: '',
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


        /**
         * Return Application
         * 
         */
        
        $(document).on('click', '.returnApplication-open-transfer', function () {
            const caseId = $(this).data('id');    
             

           $(document).trigger('returnApplication:openSlider', [caseId]);
        });

        // Close slider
        $(document).on('click', '.returnApplication-close-slider', function () {
            $(document).trigger('returnApplication:closeSlider');
        });

        // Custom event handlers for Slider 2
        var return_app_id = 0 ;
        $(document).on('returnApplication:openSlider', function (e, caseId) {
            return_app_id = caseId ;
            loadReturnTransferDetails(caseId);
            $('#returnApplicationSlider').addClass('open').attr('aria-hidden', 'false');
        });

        $(document).on('returnApplication:closeSlider', function () {
            $('#returnApplicationSlider').removeClass('open').attr('aria-hidden', 'true');
        });

         

        

        

        submitReturnApplication =  function (){
            const form = $('#returnApplicationForm')[0];
            if (!form.checkValidity()) {
                form.reportValidity();
                return false;
            }

            const formData = new FormData(form);

            formData.append('_csrfToken', $('meta[name="csrfToken"]').attr('content'));
            formData.append('_Token', $('meta[name="csrfToken"]').attr('content'));
            
            $.ajax({
                url: '<?= $this->Url->build(["controller" => "GeneralUtilities", "action" => "replyToReturnApplicationSubmission"]); ?>',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content'),
                    '_Token': $('meta[name="csrfToken"]').attr('content') 
                },

                beforeSend: function () {

                    // Disable button
                    $('#approvalForm button[type="submit"]')
                        .prop('disabled', true)
                        .html(`
                            <span class="spinner-border spinner-border-sm me-1"></span>
                            Processing...
                        `);
                },

                success: function (response) {

                    console.log(response);

                    if(response.success == false){
                        alert(response.message)
                    }else{
                        alert('Application forwarded successfully.');
                        $('#returnApplicationSlider').removeClass('open').attr('aria-hidden', 'true');
                        //location.reload();

                    }                    
                },

                error: function (xhr) {

                    console.log(xhr);

                    let errorMessage = 'Something went wrong.';

                    if (xhr.responseJSON?.message) {
                        errorMessage = xhr.responseJSON.message;
                    }

                    alert(errorMessage);
                },

                complete: function () {

                var ev=3;
                }
            });
        }
        loadReturnTransferDetails = function(caseId){
            $("#returnHtmlForm").html('<div class="dots-loader"><img src="https://edustaff.maharashtra.gov.in/images/logo.png" alt="Maha Logo" class="me-2"> Loading</div>');
            $.ajax({
                url: '<?= $this->Url->build(["controller" => "GeneralUtilities", "action" => "replyToReturnApplication"]); ?>/'+caseId,
                type: 'GET',
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                },
                    success: function (response) {
                        console.log("&&&&&&&&&&&&&&&&&&&&&&&&&#"+response.data.id);
                    if(response.success){
                        //if(response.data.id>0){
                            ng2g = response.data;
                            console.log("##################################################333333");
                            console.log(response.html);
                            $("#returnHtmlForm").html(response.html);
                           
                        //}                       
                    }
                    
                },
                error: function () {
                    $("#returnHtmlForm").html('<option>Error loading data</option>');
                }
            });
        }


        // ------------------------------
        // Global ESC key handler (closes both sliders)
        // ------------------------------
        $(document).on('keydown', function (e) {
            if (e.key === 'Escape') {
                $(document).trigger('im:closeSlider');
                $(document).trigger('approveApplication:closeSlider');
                $(document).trigger('startApplication:closeSlider');
                $(document).trigger('correctionApplication:closeSlider');
                $(document).trigger('returnApplication:closeSlider');
                
            }
        });

        

        function formatDate(dateStr) {
            const parts = dateStr.split('-'); // yyyy-mm-dd
            return parts[2] + '/' + parts[1] + '/' + parts[0];
        }
        function docUrl(filename) {
            return "<?= $this->Url->build('/', ['fullBase' => true]); ?>" + filename;
        }
        
      
        

        $('#teacherTransferForm').submit(function(e) {           
            e.preventDefault();
             if(currentMode == 1){
                        $('#actionStatus_'+currentAppId).html('<b style="color:green;">Approved</b>');
                        $('#footerBox').hide();
                        $('#footerMsgBox').show();
                        $('#footerMsgBox').html('The application has been approved successfully and is forwarded for further action to the Block Officer. <button class="btn btn-success btn-sm approveApplication-close-slider">Close</button>');    
                                        
                    }else{
                        $('#actionStatus_'+currentAppId).html('<b style="color:red;">Rejected</b>');
                        $('#footerBox').hide();
                        $('#footerMsgBox').show();
                        $('#footerMsgBox').html('The application has been rejected successfully. <button class="btn btn-danger btn-sm approveApplication-close-slider">Close</button>'); 
                    }
                    $('#actionBtns_'+currentAppId).html('');
                    return;
            var formData = new FormData(this);
            
            formData.append('mode', currentMode);
            formData.append('app_id', currentAppId); 
            $.ajax({
                url: '',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                },
                success: function(response) {
                    if(currentMode == 1){
                        $('#actionStatus_'+currentAppId).html('<b style="color:green;">Approved</b>');
                        $('#footerBox').hide();
                        $('#footerMsgBox').show();
                        $('#footerMsgBox').html('The application has been approved successfully and is forwarded for further action to the Block Officer. <button class="btn btn-success btn-sm approveApplication-close-slider">Close</button>');    
                                        
                    }else{
                        $('#actionStatus_'+currentAppId).html('<b style="color:red;">Rejected</b>');
                        $('#footerBox').hide();
                        $('#footerMsgBox').show();
                        $('#footerMsgBox').html('The application has been rejected successfully. <button class="btn btn-danger btn-sm approveApplication-close-slider">Close</button>'); 
                    }
                    $('#actionBtns_'+currentAppId).html('');
                },
                error: function(xhr, status, error) {
                    // Handle error

                }
            });
           
        });


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
        setupFileUpload('minorityCertUploadArea','minorityCertOutwardFile','minorityCertOutwardFileList','tetCertificateUploadArea','tetCertificateFile','tetCertificateFileList');
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
        

        

        /*$('#teacherTransferForm').submit(function(e) {
           
            e.preventDefault();
            
            var formData = new FormData(this);
            
            $.ajax({
                url: '',
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
           
        });*/
        
       
        
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



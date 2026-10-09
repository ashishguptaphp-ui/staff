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
       
        🔜👨‍💼 List of teaching and non-teaching - Non-Grant
      
</h5>
<!-- Bootstrap + Bootstrap Icons -->
<div style="background: #fff; padding:10px;">      
    
        

        <table id="staffTable" class="table table-bordered table-striped table-hover align-middle">
            <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Aid Type</th> 
                <th>Post</th> 
                <th>Staff Name</th>   
                <th>School</th>
                 <th>Date of Joining</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>                        
                <?php 
                $idx =1;
                //dd($staffs);
                
                foreach ($ng2g as $staff): 
                    /*echo "<pre>";
                    print_r($staff);
                    exit;*/
                ?>
                <tr>
                    <td><?= h($idx++) ?></td>
                    <td>
                        <?= h($staff->aid_name) ?>
                    </td>
                    <td>
                        <?= h($staff->post_name) ?>
                    </td>
                    <td style="display: flex;align-items: center;gap: 5px;">
                       
                        <?= h(trim($staff->teacher_name)) ?>
                       
                    </td>
                    
                    <td>
                      
                        <?= h($staff->school_name) ?>
                    </td>
                    <td>
                        <?= h($staff->date_of_joining) ?>
                    </td>
                   
                   

                    <td id="actionBtns_<?= h($staff->id) ?>">
                        <?php
                        //echo $staff->status;
                            if($staff->aid_id == 1){
                                echo '-';
                            }else if($staff->status == 'individual_order_eo_pending'){
                                echo '<b style="color:red;">प्रलंबित: शिक्षण अधिकारी पडताळणी</b>';
                                
                            }else if($staff->status == 'individual_order_rejected_by_eo'){
                                echo '<b style="color:red;">व्यक्तिगत मान्यता – शिक्षण अधिकारी स्तरावर नाकारली</b>';
                            }else if($staff->status == 'individual_order_np_pending'){
                                echo '<b style="color:red;">प्रलंबित: नगरपालिका पडताळणी</b>';
                            }else if($staff->status == 'sanstha_application_pending'){
                              echo "<button class='btn btn-primary badge bg-info text-light action-ud startApplication-open-transfer' data-mode='2' app-step='1' data-staffObject='". json_encode($staff, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ."' data-id='NGG-2025-001'>
                                             विनाअनुदानित ते अनुदानित बदलीसाठी अर्ज करा
                                        </button>";   

                                         
                            }else if(($staff->aid_id == 6) && (!$staff->personal_recognition_number)){
                                echo "<button class='btn btn-primary badge bg-warning text-light action-ud im-open-transfer' data-mode='1' data-staffObject='". json_encode($staff, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ."' data-id='NGG-2025-001'>
                                        <i class='fa-solid fa-arrow-trend-up'></i> अपलोड वैयक्तिक मान्यता ".$staff->personal_recognition_number."
                                    </button>";
                                    /*echo "<button class='btn btn-primary badge bg-info text-light action-ud correctionApplication-open-transfer' data-mode='2' app-step='1' data-staffObject='". json_encode($staff, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ."' data-id='NGG-2025-001'>
                                             विनाअनुदानित ते अनुदानित बदलीसाठी अर्ज करा 12345
                                        </button>";*/
                            }else{
                                $returnStatus = array(
                                    'commissioner_desk_returned',
                                    'director_higher_secondary_desk_returned',
                                    'director_secondary_desk_returned',
                                    'director_primary_desk_returned',
                                    'dy_director_higher_secondary_desk_returned',
                                    'dy_director_secondary_desk_returned',
                                    'dy_director_primary_desk_returned',
                                    'dyd_clerk_primary_desk_returned',
                                    'dyd_clerk_secondary_desk_returned',
                                    'dyd_clerk_higher_secondary_desk_returned',
                                    'dyd_deputy_education_inspector_primary_desk_returned',
                                    'dyd_deputy_education_inspector_secondary_desk_returned',
                                    'dyd_assistant_director_inspector_higher_secondary_desk_returned',
                                    'dyd_desk_returned',
                                    'eo_clerk_desk_returned',
                                    'eo_superintendent_desk_returned',
                                    'eo_clerk_primary_desk_returned',
                                    'eo_superintendent_primary_desk_returned',
                                    'eo_clerk_secondary_desk_returned',
                                    'eo_superintendent_secondary_desk_returned',
                                    'eo_desk_returned'
                                );


                                  
                                
                                //echo "<pre>";
                                //print_r($staff);
                                if(in_array($staff->status, $returnStatus)){
                                    echo "<button class='btn btn-primary badge bg-info text-light action-ud returnApplication-open-transfer' data-id='".$staff->ng2g_id."'>
                                             त्रुटी दुरुस्ती व पुनः सादरीकरण
                                        </button>";
                                    
                                }else if(
                                    ($staff->status == 'eo_clerk_desk_forwarded') ||
                                    ($staff->status == 'eo_superintendent_desk_forwarded') ||
                                    ($staff->status == 'eo_desk_forwarded')
                                ){
                                    echo '<b style="color:red;">अर्ज पुनः सादर, प्रलंबित: शिक्षण अधिकारी पडताळणी</b>';
                                    
                                }else if($staff->status == 'individual_order_eo_pending'){
                                    echo '<b style="color:red;">प्रलंबित: शिक्षण अधिकारी पडताळणी</b>';
                                    
                                }else if($staff->status == 'individual_order_rejected_by_eo'){
                                    echo '<b style="color:red;">व्यक्तिगत मान्यता – शिक्षण अधिकारी स्तरावर नाकारली</b>';
                                }else if($staff->status == 'individual_order_np_pending'){
                                    echo '<b style="color:red;">प्रलंबित: नगरपालिका पडताळणी</b>';
                                }else{     
                                    if($staff->status == 'application_draft_step_1'){
                                        echo "<button class='btn btn-primary badge bg-danger text-light action-ud startApplication-open-transfer' data-mode='1' app-step='2' data-staffObject='". json_encode($staff, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ."' data-id='NGG-2025-001'>
                                            <i class='fa-solid fa-arrow-trend-up'></i>  अर्ज पूर्ण करा
                                        </button>";
                                    }else if($staff->status == 'application_draft_step_2'){
                                        echo "<button class='btn btn-primary badge bg-danger text-light action-ud startApplication-open-transfer' data-mode='1' app-step='3' data-staffObject='". json_encode($staff, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ."' data-id='NGG-2025-001'>
                                            <i class='fa-solid fa-arrow-trend-up'></i>  अर्ज पूर्ण करा
                                        </button>";
                                    }else if($staff->status == 'application_draft_step_3'){
                                        echo "<button class='btn btn-primary badge bg-danger text-light action-ud startApplication-open-transfer' data-mode='1' app-step='4' data-staffObject='". json_encode($staff, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ."' data-id='NGG-2025-001'>
                                            <i class='fa-solid fa-arrow-trend-up'></i>  अर्ज पूर्ण करा
                                        </button>";
                                    }else if($staff->status == 'application_draft_step_4'){
                                        echo "<button class='btn btn-primary badge bg-danger text-light action-ud startApplication-open-transfer' data-mode='1' app-step='5' data-staffObject='". json_encode($staff, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ."' data-id='NGG-2025-001'>
                                            <i class='fa-solid fa-arrow-trend-up'></i>  अर्ज पूर्ण करा
                                        </button>";
                                    }else if($staff->status == 'application_draft_step_5'){
                                        echo "<button class='btn btn-primary badge bg-danger text-light action-ud startApplication-open-transfer' data-mode='1' app-step='6' data-staffObject='". json_encode($staff, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ."' data-id='NGG-2025-001'>
                                            <i class='fa-solid fa-arrow-trend-up'></i>  अर्ज पूर्ण करा
                                        </button>";
                                    }else if($staff->status == 'application_draft_step_6'){
                                        echo "<button class='btn btn-primary badge bg-danger text-light action-ud startApplication-open-transfer' data-mode='1' app-step='7' data-staffObject='". json_encode($staff, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ."' data-id='NGG-2025-001'>
                                            <i class='fa-solid fa-arrow-trend-up'></i>  अर्ज पूर्ण करा
                                        </button>";

                                        //VRUSHALI ASHOKRAO KALYANKAR
                                    }else if(($staff->status == 'primary_dy_director_desk_pending') || ($staff->status == 'primary_director_desk_pending')
                                        || ($staff->status == 'secondary_dy_director_desk_pending') || ($staff->status == 'secondary_director_desk_pending')
                                        || ($staff->status == 'higher_secondary_dy_director_desk_pending') || ($staff->status == 'higher_secondary_director_desk_pending')
                                        || ($staff->status == 'commissioner_desk_pending')
                                    ){
                                        echo '<b style="color:red;">प्रलंबित: संचालक कार्यालयाकडून पडताळणी</b>';
                                    
                                    }else if(($staff->status == 'eo_clerk_desk_pending') || ($staff->status == 'eo_superintendent_desk_pending')
                                        ||($staff->status == 'eo_clerk_primary_desk_pending') || ($staff->status == 'eo_superintendent_primary_desk_pending')
                                        ||($staff->status == 'eo_clerk_secondary_desk_pending') || ($staff->status == 'eo_superintendent_secondary_desk_pending')
                                        || ($staff->status == 'eo_desk_pending')
                                    ){
                                        echo '<b style="color:red;">प्रलंबित: जिल्हा शिक्षण अधिकारी कार्यालयाकडून पडताळणी</b>';
                                    
                                    }else if(($staff->status == 'dyd_clerk_primary_desk_pending') || ($staff->status == 'dyd_clerk_secondary_desk_pending')
                                        || ($staff->status == 'dyd_clerk_higher_secondary_desk_pending') || ($staff->status == 'dyd_deputy_education_inspector_primary_desk_pending')
                                        || ($staff->status == 'dyd_deputy_education_inspector_secondary_desk_pending') || ($staff->status == 'dyd_assistant_director_inspector_higher_secondary_desk_pending')
                                        || ($staff->status == 'dyd_desk_pending')
                                    ){
                                        echo '<b style="color:red;">प्रलंबित: विभागीय शिक्षण अधिकारी कार्यालयाकडून पडताळणी</b>';
                                    
                                    }else if($staff->status == 'dy_eo_desk_pending'){
                                        echo '<b style="color:red;">प्रलंबित: शिक्षण अधिकारी पडताळणी</b>';
                                    
                                    }else if($staff->status == 'dy_director_returned'){
                                        echo '<b style="color:red;">संचालक कार्यालयाकडून त्रुटी पूर्ततेसाठी अर्ज परत</b>';
                                      
                                    }else if($staff->status == 'dy_director_rejected'){
                                        echo '<b style="color:red;">संचालक कार्यालयाकडून अर्ज नामंजूर</b>';
                                        /*echo "&nbsp;&nbsp;<button class='btn btn-primary badge bg-success text-light action-ud approveApplication-open-transfer' data-mode='1' data-staffObject='". json_encode($staff, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ."' data-id='NGG-2025-001'>
                                            <i class='fa-solid fa-arrow-trend-up'></i>  अर्ज पहा
                                        </button>";*/
                                    }else if(empty($staff->status) && $staff->aid_id == 6){
                                        echo "<button class='btn btn-primary badge bg-info text-light action-ud startApplication-open-transfer' data-mode='2' app-step='1' data-staffObject='". json_encode($staff, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ."' data-id='NGG-2025-001'>
                                             विनाअनुदानित ते अनुदानित बदलीसाठी अर्ज करा
                                        </button>";
                                    }else if(empty($staff->status)){
                                        
                                        echo "<button class='btn btn-primary badge bg-purple text-light action-ud startApplication-open-transfer' data-mode='2' app-step='1'  data-staffObject='". json_encode($staff, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ."' data-id='NGG-2025-001'>
                                             अंशतः अनुदानित ते अनुदानित बदलीसाठी अर्ज करा
                                        </button>";
                                    }
                                    /*echo "<button class='btn btn-primary badge bg-success text-light action-ud approveApplication-open-transfer' data-mode='1' data-staffObject='". json_encode($staff, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ."' data-id='NGG-2025-001'>
                                            <i class='fa-solid fa-arrow-trend-up'></i>  अर्ज पहा
                                        </button>";*/
                                    
                                }
                            }
                        ?>
                       
                         
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
       
</div>

<!-- Slide Panel -->
<div id="imSlider" class="slide-panel slide-panel1" aria-hidden="true" style="border:3px solid #537895;">

    <!-- Header -->
    <div class="slide-header d-flex justify-content-between align-items-center">
        <div style="width:100%;">
            <h5 class="mb-0"><i class="fas fa-arrow-trend-up me-1"></i> वैयक्तिक मान्यता आदेश
            <!--Non-Grant → Grant Aided Transfer <div class="text-muted" style="float:right;color:#fff !important;font-size:12px;margin-right:50px;">Staff Name: <span id="empName"></span></div>-->
            </h5>
            <!--<small class="text-muted">Case ID: <span id="caseId"></span></small>-->
            
           
        </div>
        <button class="btn btn-sm btn-outline-danger im-close-slider">X</button>
    </div>

    <!-- Body -->
    <div class="slide-body">
        <div class="form-container">
            <form id="imForm" enctype="multipart/form-data">
                <div class="row mb-2">                    
                    <div class="col-md-12 mb-2">
                        <label for="im_empName" class="form-label marathi-label">शिक्षक/कर्मचारी नाव<span class="english-label">(Teacher/Staff Name)</span></label>
                        <input type="text" class="form-control form-control-sm" id="im_empName" name="im_empName" readonly required>
                    </div> 
                    <div class="col-md-12 mb-2">
                        <label for="im_outwardNumber" class="form-label marathi-label">जावक क्रमांक <span class="english-label">(Outward Number)</span></label>
                        
                        <input type="text" class="form-control form-control-sm" id="im_outwardNumber" name="im_outwardNumber" accept=".pdf" required>

                    </div> 

                        <div class="col-md-12 mb-2">
                        <label for="im_date" class="form-label marathi-label">दिनांक <span class="english-label">(Date)</span></label>
                        
                        <input type="date" class="form-control form-control-sm" id="im_date" name="im_date" required>

                    </div> 
                    <div class="col-md-12 mb-4">
                        <label for="im_doc" class="form-label marathi-label">वैयक्तिक मान्यता <span class="english-label">(Vaikatik Manayata)</span></label>
                        
                        <input type="file" class="form-control form-control-sm" id="im_doc" name="im_doc" accept=".pdf" required>

                    </div> 
                    <label><strong>मंजुरीसाठी अर्ज पाठवण्यासाठी कार्यालय निवडा:</strong></label><br>

   
       
                    <select class="form-control form-control-sm" name="forward_to" id="forward_to" required>
                        <option value="">-- कार्यालय निवडा --</option>
                        <option value="1">प्राथमिक शिक्षणाधिकारी जिल्हा परिषद</option>
                        <option value="2">माध्यमिक शिक्षणाधिकारी जिल्हा परिषद</option>
                        <option value="3">महानगरपालिका/नगरपालिका</option>
                        <option value="4">विभागीय उपसंचालक</option>
                    </select>
                    
                        
                    <!-- District Dropdown -->
                    <div id="districtDiv" class="form-group hidden">
                        <label>जिल्हा निवडा:</label>
                        <select class="form-control form-control-sm" name="forward_to_district" id="forward_to_district">
                            <option value="">-- जिल्हा निवडा --</option>
                            
                            
                            <?php 

                            foreach($districts as $d){
                                echo '<option value="'.$d->code.'">'.$d->name.'</option>';
                            }
                            ?>
                        
                        </select>
                    </div>

                    <!-- Mahanagarpalika Dropdown -->
                    <div id="mahanagarpalikaDiv" class="form-group hidden">
                        <label>महानगरपालिका निवडा:</label>
                        <select class="form-control form-control-sm" name="forward_to_palika" id="forward_to_palika">
                            <option value="">-- महानगरपालिका/नगरपालिका निवडा --</option>
                            
                            <?php 

                            foreach($mnp_nps as $mn){
                                echo '<option value="'.$mn->id.'">'.$mn->office_name.'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    
                    <!-- Division Dropdown -->
                    <div id="divisionDiv" class="form-group hidden">
                        <label>विभाग निवडा:</label>
                        <select class="form-control form-control-sm" name="forward_to_region" id="forward_to_region">>
                            <option value="">-- विभाग निवडा --</option>
                            <?php 

                            foreach($regions as $r){
                                echo '<option value="'.$r->code.'">'.$r->name.'</option>';
                            }
                            ?>
                        </select>
                    </div>

                        <div class="col-md-12" style="text-align: center;marging-top:30px;">

                            <button type="submit" class="btn btn-lg btn-primary w-100" id="imSubmitBtn">Submit</button>
                    </div>
                    
                    
                </div>
            </form>
        </div>

    </div>

    <!-- Footer -->
    <div class="slide-footer text-end" >
        
        <div class="row" id="im_footerBox">
            <div id="im_footerMsgBox"></div>
            <div class="col-md-12" style="text-align: right;">
                <button class="btn btn-danger btn-sm im-close-slider">Close</button>
            </div>
            
        </div>
       
        
    </div>

</div>



<!-- Slide Panel -->
<div id="approveApplicationSlider" class="slide-panel" aria-hidden="true" style="border:3px solid #537895;">
    <!-- Header -->
    <div class="slide-header d-flex justify-content-between align-items-center">
        <div style="width:100%;">
            <h5 class="mb-0"><i class="fas fa-arrow-trend-up me-1"></i> Non-Grant → Aided Transfer <div class="text-muted" style="float:right;color:#fff !important;font-size:12px;margin-right:50px;">Staff Name: <span id="aa_empName"></span></div></h5>
            <!--<small class="text-muted">Case ID: <span id="caseId"></span></small>-->
        </div>
        <button class="btn btn-sm btn-outline-danger approveApplication-close-slider">X</button>
    </div>

    <!-- Body -->
    <div class="slide-body">
        <div class="form-container">
                    <!-- 1.1 संस्थेचे नाव -->
                    <div class="row mb-2">
                         <div class="col-md-3">
                            <label for="institutionCode" class="form-label marathi-label">संस्था कोड <span class="english-label">(Institution Code)</span> &rarr; <span class="txtval"><?= h($user["username"]) ?></span></label>                            
                        </div>
                        <div class="col-md-9">                            
                            <label for="institutionName" class="form-label marathi-label">संस्थेचे नाव <span class="english-label">(Institution Name)</span> &rarr; <span class="txtval"><?= h($sanstha["name"]) ?></span></label> 
                        </div>
                    </div>

                    <!-- 1.1 शाळेचे नाव -->
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <label for="udiseNumber" class="form-label marathi-label">UDISE क्रमांक <span class="english-label">(UDISE Code)</span> &rarr; <span class="txtval" id="aa_udiseNumber"></span></label> 
                        </div>
                    
                   
                        <div class="col-md-9">
                            <label for="schoolName" class="form-label marathi-label">शाळेचे नाव <span class="english-label">(School Name)</span> &rarr; <span class="txtval" id="aa_schoolName"></span></label> 
                        </div>                  
                        
                        <!-- 1.1 शाळेचे ठिकाण -->
                        <div class="col-md-12">
                            <label for="schoolLocation" class="form-label marathi-label">शाळेचे ठिकाण <span class="english-label">(School Location)</span> &rarr; <span class="txtval" id="aa_schoolLocation"></span></label> 
                        </div>
                    </div>
                    
                    <!-- Employee Details Row -->
                    <div class="row">
                        <div class="col-md-6">
                            <label for="employeeName" class="form-label marathi-label">कर्मचाऱ्याचे नाव <span class="english-label">(Teacher Name)</span> &rarr; <span class="txtval" id="aa_employeeName"></span></label>
                        </div>
                        <div class="col-md-3">
                            <label for="designation" class="form-label marathi-label">पदनाम <span class="english-label">(Designation)</span> &rarr; <span class="txtval" id="aa_designation"></span></label>
                        </div>
                        <div class="col-md-3">
                            <label for="salaryGrade" class="form-label marathi-label">वेतनश्रेणी <span class="english-label">(Salary Grade)</span> &rarr; <span class="txtval" id="aa_salaryGrade"></span></label>
                        </div>
                    </div>
                    
                    <!-- 1.4 अध्यापन विषय -->
                    <div class="row">
                        <div class="col-md-6">
                            <label for="teachingSubject" class="form-label marathi-label">अध्यापन विषय <span class="english-label">(Teaching Subjects)</span> &rarr; <span class="txtval" id="aa_teachingSubject"></span></label>
                        </div>
                        <!-- 1.5 अध्यापन वर्ग -->
                        <div class="col-md-6">
                            <label class="form-label marathi-label">अध्यापन वर्ग <span class="english-label">(Teaching Classes)</span> &rarr; <span class="txtval" id="aa_teachingClasses"></span></label>                           
                        </div>
                    </div>
                    
                    
                    <!-- Additional Details Row -->
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <label class="form-label marathi-label">मूळ आरक्षण प्रवर्ग <span class="english-label">(Original)</span> &rarr; <span class="txtval" id="aa_originalCategory"></span></label>
                            
                        </div>
                        <div class="col-md-3">
                            <label class="form-label marathi-label">नियुक्तीचा प्रवर्ग <span class="english-label">(Appointment)</span> &rarr; <span class="txtval" id="aa_appointmentCategory"></span></label>                           
                        </div>
                        <div class="col-md-3">
                            <label class="form-label marathi-label">पॅन क्रमांक <span class="english-label">(PAN)</span> &rarr; <span class="txtval" id="aa_panNumber"></span></label>
                        </div>
                         <!-- 1.9 आधार क्रमांक -->
                          <div class="col-md-3">
                            <label class="form-label marathi-label">आधार क्रमांक <span class="english-label">(Aadhar)</span> &rarr; <span class="txtval" id="aa_aadharNumber"></span></label>
                            
                        </div>
                    </div>
                    
                   
                    <!-- Section 3: शाळा परवानगी -->
                    <div class="pdf-field">
                        <h3 class="section-title">शाळा परवानगी आदेश माहिती</h3>                      
                       
                        <div class="row">
                            <div class="col-md-5">
                                <label for="schoolPermissionOrderNumber" class="form-label marathi-label">आदेश क्रमांक <span class="english-label">(Order No.)</span> &rarr; <span class="txtval" id="aa_schoolPermissionOrderNumber"></span></label>
                            </div>
                             <div class="col-md-5">
                                <label for="schoolPermissionOrderDate" class="form-label marathi-label">दिनांक <span class="english-label">(Date)</span> &rarr; <span class="txtval" id="aa_schoolPermissionOrderDate"></span></label>

                            </div>
                            <div class="col-md-2"> 
                                <a href="#" class="file-upload-area" id="aa_schoolPermissionOrderFile" target="_blank" Tooltip="Preview Document">
                                    <i class="fa fa-eye" title="View Document"></i> View
                                </a>
                            </div>
                            
                        </div>
                    </div>

                    <!-- Section 4: अल्पसंख्याक प्रमाणपत्र -->
                    <div class="pdf-field">
                        <h3 class="section-title">अल्पसंख्याक शाळा प्रमाणपत्र</h3>                        
                        <div class="row">
                            <div class="col-md-5">
                                <label for="minorityCertOutwardNumber" class="form-label marathi-label">जावक क्रमांक <span class="english-label">(Outward No.)</span> &rarr; <span class="txtval" id="aa_minorityCertOutwardNumber"></span></label>
                            </div>
                            <div class="col-md-5">
                                <label for="minorityCertOutwardDate" class="form-label marathi-label">दिनांक <span class="english-label">(Date)</span> &rarr; <span class="txtval" id="aa_minorityCertOutwardDate"></span></label>
                            </div>

                            <div class="col-md-2"> 
                                <a href="#" class="file-upload-area" id="aa_minorityCertOutwardFile" target="_blank" Tooltip="Preview Document">
                                    <i class="fa fa-eye" title="View Document"></i> View
                                </a>
                            </div>                            
                        </div> 
                    </div>

                    <div class="pdf-field">
                        <h3 class="section-title">बदलीने रुजू होणाऱ्या शाळेची माहिती</h3>                        
                        <div class="row">
                            <div class="col-md-3">
                                <label for="udiseNumberAtTransfer" class="form-label marathi-label">UDISE क्रमांक <span class="english-label">(UDISE Number)</span> &rarr; <span class="txtval" id="aa_udiseNumberAtTransfer"></span></label> 
                            </div>
                            <div class="col-md-7">
                                <label for="schoolNameAtTransfer" class="form-label marathi-label">शाळेचे नाव <span class="english-label">(School Name)</span> &rarr; <span class="txtval" id="aa_schoolNameAtTransfer"></span></label> 
                            </div>
                            <div class="col-md-2"> 
                                <a href="#" class="file-upload-area" id="aa_schoolAtTransferFile" target="_blank" Tooltip="Preview Document">
                                    <i class="fa fa-eye" title="View Document"></i> View
                                </a>
                            </div>

                            <div class="col-md-12">
                                <label for="schoolLocationAtTransfer" class="form-label marathi-label">शाळेचे ठिकाण <span class="english-label">(School Location)</span> &rarr; <span class="txtval" id="aa_schoolLocationAtTransfer"></span></label> 
                            </div>
                           
                           
                            
                        </div> 
                    </div>
                    
              
                
                    <div class="pdf-field">
                        <h3 class="section-title">शैक्षणिक व व्यावसायिक अर्हता. <small style="font-size:10px;">संबंधित शिक्षकाची शैक्षणिक व व्यावसायिक अर्हता प्रमाणपत्रे • शासन निर्णय दिनांक 25.02.2019 नुसार.</small></h3>
                        <div class="row" id="aa_qualifications"></div> 
                    </div>
                
                
                
                
                
                <!-- Section 6-24: Other Sections (Condensed for brevity) -->
                <div class="form-section">
                    <h3 class="section-title"> इतर आवश्यक कागदपत्रे</h3>
                    
                    <div class="alert alert-info mb-2">
                        <i class="bi bi-info-circle"></i> खालील सर्व कागदपत्र PDF स्वरूपात अपलोड करणे अनिवार्य आहे. प्रत्येकासाठी स्वतंत्र PDF फाईल अपलोड करा.
                    </div>
                    
                    <!-- List of remaining PDF uploads -->
                    <div class="row mb-2" style="border-top: 1px solid #cff4fc;">
                        <div class="col-md-6" style="font-weight: 800;background: #f0f2f2;text-align: center;">
                            विवरण 
                        </div> 
                        <div class="col-md-2" style="font-weight: 800;background: #f0f2f2;text-align: center;">
                            जावक क्रमांक 
                        </div>
                        <div class="col-md-2" style="font-weight: 800;background: #f0f2f2;text-align: center;">
                            दिनांक  
                        </div>
                        <div class="col-md-2" style="font-weight: 800;background: #f0f2f2;text-align: center;">
                            PDF फाईल 
                        </div>
                    </div>  

                    
                    
                    <div class="row mb-2" style="border-top: 1px solid #cff4fc;">
                        <div class="col-md-6">
                            <label class="form-label marathi-label">शाळा व्यवस्थापन समितीचा ठराव. (MEPS Act 1981)</label>
                        </div> 
                        <div class="col-md-2" style="text-align: center;">
                            <span class="txtval" id="aa_schoolCommitteeOutwardNumber"></span>
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                             <span class="txtval" id="aa_schoolCommitteeOutwardDate"></span>
  
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="aa_schoolCommitteeOutwardFile" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View
                            </a>
                        </div>
                    </div> 

                    <div class="row mb-2" style="border-top: 1px solid #cff4fc;">
                        <div class="col-md-6">
                            <label class="form-label marathi-label">विनाअनुदानित / अंशतः अनुदानित तत्त्वावरील मूळ संस्था नियुक्ती आदेश</label>
                        </div> 
                        <div class="col-md-2" style="text-align: center;">
                            <span class="txtval" id="aa_originSansthaAppointmentNumber"></span>
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                             <span class="txtval" id="aa_originSansthaAppointmentDate"></span>  
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="aa_originSansthaAppointmentFile" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View
                            </a>
                        </div>
                    </div> 
                    
                   
                    
                    <div class="row mb-2" style="border-top: 1px solid #cff4fc;">
                        <div class="col-md-6">
                            <label class="form-label marathi-label">शिक्षणाधिकारी / उपसंचालक यांनी दिलेला विनाअनुदानित / अंशतः अनुदानित तत्त्वावरील वैयक्तिक मान्यता आदेश</label>
                        </div> 
                        <div class="col-md-2" style="text-align: center;">
                            <span class="txtval" id="aa_personalRecognitionNumber"></span>
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                             <span class="txtval" id="aa_personalRecognitionDate"></span>  
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="aa_personalRecognitionFile" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View
                            </a>
                        </div>
                    </div>

                    <div class="row mb-2" style="border-top: 1px solid #cff4fc;">
                        <div class="col-md-6">
                            <label class="form-label marathi-label">संबंधित व्यवस्थापनाची विनाअनुदानित / अंशतः अनुदानित सेवाज्येष्ठता सूची</label>
                        </div> 
                        <div class="col-md-2" style="text-align: center;">
                            <span class="txtval" id="aa_serviceSeniorityListNumber"></span>
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                             <span class="txtval" id="aa_serviceSeniorityListDate"></span>  
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="aa_serviceSeniorityListFile" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View
                            </a>
                        </div>
                    </div>
 
                    <div class="row mb-2" style="border-top: 1px solid #cff4fc;">
                        <div class="col-md-6">
                            <label class="form-label marathi-label">बदलीपूर्वी बिंदुनामावलीनुसार रिक्त पदाचा विषय व आरक्षण विचारात घेण्यात आल्याचे प्रमाणपत्र</label>
                        </div> 
                        <div class="col-md-2" style="text-align: center;">
                            <span class="txtval" id="aa_vacantPostAsMeritListNumber"></span>
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                             <span class="txtval" id="aa_vacantPostAsMeritListDate"></span>  
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="aa_vacantPostAsMeritListFile" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View
                            </a>
                        </div>
                    </div>

                    <div class="row mb-4" style="border-top: 1px solid #cff4fc;">
                        <div class="col-md-6">
                            <label class="form-label marathi-label">शासन निर्णय दि. 06.02.2012 व 10.06.2022 नुसार मान्यता असल्याबाबतचा शिक्षणाधिकारी / उपसंचालक यांचा स्पष्ट अभिप्राय</label>
                        </div> 
                        <div class="col-md-2" style="text-align: center;">
                            <span class="txtval" id="aa_opinionEoDDRecognitionNumber"></span>
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                             <span class="txtval" id="aa_opinionEoDDRecognitionDate"></span>  
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="aa_opinionEoDDRecognitionFile" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View
                            </a>
                        </div>
                    </div>

                    <h3 class="section-title mb-2" style="font-size:15px;"> 
                        विनाअनुदानित / अंशतः अनुदानित शाळेत 5 वर्षे सेवा केल्याचे (मुख्याध्यापक) प्रमाणपत्र
                            <a href="#" class="file-upload-area" id="aa_fiveYrsHMCertificateFile" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View
                            </a>
                    </h3>

                    <h3 class="section-title  mb-2" style="font-size:15px;"> 
                        बदलीस कारणीभूत रिक्त पदाचा तपशील व कागदपत्रे
                    </h3>
                  
                   <div class="row mb-4">
                        <div class="col-md-7">
                            <label class="form-label marathi-label">बदलीस कारणीभूत रिक्त पदाचा तपशील</label>
                        </div> 
                        <div class="col-md-3">
                            <span class="txtval" id="aa_vacantPostCausingTransfer"></span>
                        </div>
                       
                        <div class="col-md-2" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="aa_vacantPostCausingTransferFile" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View कागदपत्रे
                            </a>
                        </div>
                    </div>

                </div>
                <div class="form-section">
                    <h3 class="section-title">शासन निर्णय दि. 06.02.2012 व 10.06.2022 नुसार मान्यता असल्याबाबतचा शिक्षणाधिकारी / उपसंचालक यांचा स्पष्ट अभिप्राय</h3>
                    
                   
                    
                    <!-- List of remaining PDF uploads -->
                    <div class="row mb-2" style="border-top: 1px solid #cff4fc;">
                        <div class="col-md-8" style="font-weight: 800;background: #f0f2f2;text-align: center;">
                            विवरण 
                        </div> 
                      
                        <div class="col-md-2" style="font-weight: 800;background: #f0f2f2;text-align: center;">
                            दिनांक  
                        </div>
                        <div class="col-md-2" style="font-weight: 800;background: #f0f2f2;text-align: center;">
                            PDF फाईल 
                        </div>
                    </div> 
                    
                    <div class="row mb-2" style="border-top: 1px solid #cff4fc;">
                        <div class="col-md-8">
                            <label class="form-label marathi-label">
                                बिंदुनामावली तपासणी पत्र (मावकद्वारे)
                            </label>
                        </div> 
                        
                        <div class="col-md-2" style="text-align: center;">
                             <span class="txtval" id="aa_mavakCheckListDate"></span>  
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="aa_mavakCheckListFile" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View
                            </a>
                        </div>
                    </div>

                    <div class="row mb-2" style="border-top: 1px solid #cff4fc;">
                        <div class="col-md-8">
                            <label class="form-label marathi-label">
                                संबंधित शिक्षकांचे विनाअनुदानित भरतीचे ना हरकत प्रमाणपत्र (जावक क्रमांक - <span class="txtval" id="aa_recruitmentNocOutwardNumber"></span>)
                            </label>
                        </div> 
                        
                        <div class="col-md-2" style="text-align: center;">
                             <span class="txtval" id="aa_recruitmentNocOutwardDate"></span>  
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="aa_recruitmentNocOutwardFile" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View
                            </a>
                        </div>
                    </div>
                    
                   
                  
                    <div class="row mb-2" style="border-top: 1px solid #cff4fc;">
                        <div class="col-md-8">
                            <label class="form-label marathi-label">
                                वर्तमानपत्रातील जाहिरात (वर्तमानपत्राचे नाव - <span class="txtval" id="aa_advrtNewspaperName"></span>)
                            </label>
                        </div> 
                        
                        <div class="col-md-2" style="text-align: center;">
                             <span class="txtval" id="aa_advrtNewspaperDate"></span>  
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="aa_advrtNewspaperFile" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View
                            </a>
                        </div>
                    </div>

                    <div class="row mb-2" style="border-top: 1px solid #cff4fc;">
                        <div class="col-md-8">
                            <label class="form-label marathi-label">
                                मुलाखत
                            </label>
                        </div>                         
                        <div class="col-md-2" style="text-align: center;">
                             <span class="txtval" id="aa_interviewDate"></span>  
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="aa_interviewFile" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View
                            </a>
                        </div>
                    </div>
                    
                    <div class="row mb-2" style="border-top: 1px solid #cff4fc;">
                        <div class="col-md-8">
                            <label class="form-label marathi-label">
                                विनाअनुदानित तत्त्वावरील रुजू अहवाल
                            </label>
                        </div>                         
                        <div class="col-md-2" style="text-align: center;">
                             <span class="txtval" id="aa_reportNGPrincipleDate"></span>  
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="aa_reportNGPrincipleFile" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View
                            </a>
                        </div>
                    </div>

                    <div class="row mb-2" style="border-top: 1px solid #cff4fc;">
                        <div class="col-md-8">
                            <label class="form-label marathi-label">
                                अनुदानित तत्त्वावरील रुजू अहवाल
                            </label>
                        </div>                         
                        <div class="col-md-2" style="text-align: center;">
                             <span class="txtval" id="aa_reportGPrincipleDate"></span>  
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="aa_reportGPrincipleFile" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View
                            </a>
                        </div>
                    </div>
                  
               
                    <div class="row mb-2" style="border-top: 1px solid #cff4fc;">
                        <div class="col-md-8">
                            <label class="form-label marathi-label">
                                वैयक्तिक मान्यता आदेशावरील जावक क्रमांक कार्यालयातील जावक नोंद वहीशी जुळतो का याबाबत शिक्षणाधिकारी / उपसंचालक यांचे प्रमाणपत्र
                            </label>
                        </div>                         
                        <div class="col-md-2" style="text-align: center;">
                             <span class="txtval" id="aa_outwardNumberMatchCertificateDate"></span>  
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="aa_outwardNumberMatchCertificateFile" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View
                            </a>
                        </div>
                    </div>

                    <div class="row mb-2" style="border-top: 1px solid #cff4fc;">
                        <div class="col-md-8">
                            <label class="form-label marathi-label">
                                बदली होणारा शिक्षक स्वयंअर्थसहाय्यित तत्त्वावर कार्यरत नव्हता याबाबत प्रमाणपत्र • शासन अधिसूचना दि. 08.06.2020 (जावक क्रमांक - <span class="txtval" id="aa_selfFinancingCertificateOutwardNumber"></span>)
                            </label>
                        </div> 
                        
                        <div class="col-md-2" style="text-align: center;">
                             <span class="txtval" id="aa_selfFinancingCertificateDate"></span>  
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="aa_selfFinancingCertificateFile" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View
                            </a>
                        </div>
                    </div>
                  
                 
                    <div class="row mb-2" style="border-top: 1px solid #cff4fc;">
                        <div class="col-md-8">
                            <label class="form-label marathi-label">
                                बदली असमान पदावर झालेली नाही याबाबत प्रमाणपत्र • अधिसूचना दि. 08.06.2020 मधील तरतुदीनुसार (जावक क्रमांक - <span class="txtval" id="aa_transferNotHigherPostOutwardNumber"></span>)
                            </label>
                        </div> 
                        
                        <div class="col-md-2" style="text-align: center;">
                             <span class="txtval" id="aa_transferNotHigherPostDate"></span>  
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="aa_transferNotHigherPostFile" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View
                            </a>
                        </div>
                    </div>


                    <div class="row mb-2" style="border-top: 1px solid #cff4fc;">
                        <div class="col-md-10">
                            <label class="form-label marathi-label">
                               महाराष्ट्र खासगी शाळा कर्मचारी (सेवा अटी) नियमावली 1981 मधील नियम 41(1)(3) नुसार वेतन अनुदानाबाबत हमीपत्र • शासन निर्णय क्र. संकीर्ण 2019/प्र.क्र.341/टीएनटी-1, दि. 01.04.2021
                            </label>
                        </div> 
                        <div class="col-md-2" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="aa_salarySubsidyGuaranteeLetterFile" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View
                            </a>
                        </div>
                    </div>
                    
                 
                </div>
                <div class="form-section">   
                    <h3 class="section-title">आयकर विवरणपत्र (Form-16)</h3>
                    <div class="row mb-4" style="border-top: 1px solid #cff4fc;">
                       
                        <div class="col-md-4" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="aa_itr1File" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View 2024-25
                            </a>
                        </div>
                        <div class="col-md-4" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="aa_itr2File" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View 2023-24
                            </a>
                        </div>
                        <div class="col-md-4" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="aa_itr3File" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View 2022-23
                            </a>
                        </div>
                    </div>
                   
                    <h3 class="section-title">Bank Statement</h3>
                    <div class="row mb-4" style="border-top: 1px solid #cff4fc;">
                        <div class="col-md-3">
                            <label class="form-label marathi-label">
                                Start Date &rarr; <span class="txtval" id="aa_bankStatementFromDate"></span>
                            </label>
                        </div> 
                        <div class="col-md-3">
                            <label class="form-label marathi-label">
                                End Date &rarr; <span class="txtval" id="aa_bankStatementToDate"></span>
                            </label>
                        </div> 
                        <div class="col-md-6" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="aa_bankStatementFile" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View
                            </a>
                        </div>
                    </div>

                    
                    <h3 class="section-title">न्यायालयीन आदेश (असल्यास)</h3>
                    <div class="row mb-4" style="border-top: 1px solid #cff4fc;">
                        <div class="col-md-3">
                            <label class="form-label marathi-label">
                                याचिका क्रमांक &rarr; <span class="txtval" id="aa_courtOrderPetitionNumber"></span>
                            </label>
                        </div> 
                        <div class="col-md-3">
                            <label class="form-label marathi-label">
                                याचिका दिनांक &rarr; <span class="txtval" id="aa_courtOrderDate"></span>
                            </label>
                        </div> 
                        <div class="col-md-6" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="aa_courtOrderFile" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View
                            </a>
                        </div>
                    </div>
                    
                    
                    <h3 class="section-title">विनाअनुदानित तत्त्वावरील रुजू दिनांकापासून इतर शासकीय लाभ घेतले नाहीत याबाबत प्रमाणपत्र</h3>
                    <div class="row mb-4" style="border-top: 1px solid #cff4fc;">
                        <div class="col-md-6">
                            <label class="form-label marathi-label">
                                विवरण &rarr; <span class="txtval" id="aa_noBenefitsCertificateDetails"></span>
                            </label>
                        </div> 
                      
                        <div class="col-md-6" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="aa_noBenefitsCertificateFile" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View
                            </a>
                        </div>
                    </div>
                    

                    <h3 class="section-title mb-4">प्रस्तुत प्रस्तावातील कागदपत्रे खरी असल्याबाबत संस्थेचे हमीपत्र (प्रपत्र-2) • शासन अधिसूचना दि. 08.06.2020

                      <a href="#" class="file-upload-area" id="aa_institutionGuaranteeFile" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View
                            </a>
                    </h3>

                    
                    
                    <h3 class="section-title mb-4">इतर कागदपत्रे (Additional Documents)

                      <a href="#" class="file-upload-area" id="aa_otherDocuments" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View
                            </a>
                    </h3>
                </div>
                
            
              
            

        </div>

    </div>

    <!-- Footer -->
    <div class="slide-footer text-end">
        <form id="teacherTransferForm" enctype="multipart/form-data">
        <div class="row" id="footerBox">
            <div class="col-md-5">
                <div class="form-check mb-0" id="confirmBox">
                    <input class="form-check-input" type="checkbox" id="confirmInfo" name="confirmInfo" required>
                    <label class="form-check-label" for="confirmInfo" style="text-align: left;padding-top:10px;color:#fff;">
                        &nbsp;&nbsp;वरील सर्व माहिती सत्य व योग्य असल्याची मी खात्री करतो/करते.
                    </label>
                </div>
            </div> 
            <div class="col-md-4">
                <input type="file" class="form-control form-control-sm" id="decisionDoc" name="decisionDoc" accept=".pdf" required>
            </div> 
            <div class="col-md-3" style="text-align: right;">
                <button type="submit" class="btn btn-sm" id="decisionBtn">Approve</button>
                <button class="btn btn-secondary btn-sm approveApplication-close-slider">Close</button>
            </div>
        </div>
        <div id="footerMsgBox"></div>
        </form>
    </div>

</div>

<!-- Slide Panel -->
<div id="startApplicationSlider" class="slide-panel" aria-hidden="true" style="border:3px solid #537895;">
     <!-- Header -->
    <div class="slide-header d-flex justify-content-between align-items-center">
        <div style="width:100%;">
            <h5 class="mb-0"><i class="fas fa-arrow-trend-up me-1"></i> Non-Grant → Aided Transfer <div class="text-muted" style="float:right;color:#fff !important;font-size:12px;margin-right:50px;">Staff Name: <span id="empName"></span></div></h5>
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
                    
                    <div class="card">
                        <label class="checkbox-label">
                            <input type="checkbox" id="transferCheck" name="transferCheck" onchange="toggleDiv('transferCheck','transferDiv')">
                            बदलीने रुजू होणारी शाळा ही सध्याच्या शाळेपेक्षा वेगळी आहे का?
                        </label>

                        <!-- Transfer School Details -->
                        <div id="transferDiv" class="transfer-section">
                        
                            <div class="field">
                                <label for="transferSchool" class="required-field">बदलीने रुजू होण्यासाठी प्रस्तावित शाळा निवडा</label>
                                <select class="form-select" id="transferSchool" name="transferSchool" required>                   
                                    <option value="">-- Select Transfer School --</option>                                 
                                    <?php 

                                    foreach($schools as $s){
                                        echo '<option value="'.$s->udise_code.'">'.$s->udise_code.' | '.$s->school_name.'</option>';
                                    }
                                    ?>
                                </select> 
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
                                
                                </div>
                                <div class="col-md-4">
                                    <label for="minorityCertOutwardDate" class="form-label marathi-label required-field">दिनांक <span class="english-label">(Date)</span></label>
                                    <input type="date" class="form-control" id="minorityCertOutwardDate" name="minorityCertOutwardDate" required>                                

                                </div>
                                <div class="col-md-4">     
                                    <label for="minorityCertOutwardFile" class="form-label marathi-label required-field">दस्तऐवज अपलोड करा <span class="english-label">(Upload Document)</span></label>

                                    <input type="file" id="minorityCertOutwardFile" name="minorityCertOutwardFile" class="form-control file-upload-check" accept=".pdf" required>
                                    <small class="text-muted">Maximum file size: 2 MB (PDF only)</small>
                                </div>
                                
                            </div> 
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
                        
                        <!-- 1.5 अध्यापन वर्ग -->
                        <div class="col-md-6">
                            <label class="form-label marathi-label required-field">अध्यापन वर्ग <span class="english-label">(Teaching Classes)</span></label>
                            <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="teachingClasses_1_5" name="teachingClasses" value="1-5">
                                            <label class="form-check-label marathi-label" for="teachingClasses_1_5">&nbsp;&nbsp; इयत्ता 1 ते 5</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                    
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="teachingClasses_6_8" name="teachingClasses" value="6-8">
                                            <label class="form-check-label marathi-label" for="teachingClasses_6_8">&nbsp;&nbsp; इयत्ता 6 ते 8</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="teachingClasses_9_10" name="teachingClasses" value="9-10">
                                            <label class="form-check-label marathi-label" for="teachingClasses_9_10">&nbsp;&nbsp; इयत्ता 9 ते 10</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="teachingClasses_11_12" name="teachingClasses" value="11-12">
                                            <label class="form-check-label marathi-label" for="teachingClasses_11_12">&nbsp;&nbsp; इयत्ता 11 ते 12</label>
                                        </div>
                                    </div>
                            </div>

                            
                        </div>
                    </div>
                    <div class="card" id="tetdaatadiv">
                        <label class="checkbox-label">
                            <input type="checkbox" id="tetCheck"  name="tetCheck" onchange="toggleDiv('tetCheck','tetDiv')">
                            TET पात्र आहे काय?
                        </label>

                            <!-- Section 4: अल्पसंख्याक प्रमाणपत्र -->
                            <div id="tetDiv" class="transfer-section">

                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="tetnumber" class="form-label marathi-label required-field">परीक्षा आसन क्रमांक<span class="english-label">(Examination Seat Number)</span></label>
                                        <input type="text"
                                            class="form-control"
                                            id="tetnumber"
                                            name="tetnumber" required>
                                    </div>
                                    <div class="col-md-2">
                                
                                    <label for="tetExam" class="form-label marathi-label required-field">परीक्षा वर्ष <span class="english-label">(Year)</span></label>
                                        <select class="form-select" id="tetExam" name="tetExam" required>                            
                                            <option value="">-- Select Exam Year --</option>
                                            <?php 
                                                $cy = date('Y');
                                                for($y=$cy; $y>2012;$y--){
                                                    echo '<option value="'.$y.'">'.$y.'</option>';
                                                }
                                            ?>
                                        </select> 
                                    </div>
                                    <div class="col-md-2">
                                    
                                        <label for="tetPaper" class="form-label marathi-label required-field">पेपर <span class="english-label">(Paper)</span></label>
                                            <select class="form-select" id="tetPaper" name="tetPaper" required>                            
                                                <option value="">-- Select Peper --</option>
                                                <option value="1">पेपर 1</option>
                                                <option value="2">पेपर 2</option>
                                            
                                            </select> 
                                    </div>
                                    <div class="col-md-4">  
                                        <label for="tetCertificateFile" class="form-label marathi-label required-field">दस्तऐवज अपलोड करा <span class="english-label">(Upload Document)</span></label>

                                        <input type="file" id="tetCertificateFile" name="tetCertificateFile" class="form-control file-upload-check" accept=".pdf" required>
                                        <small class="text-muted">Maximum file size: 2 MB (PDF only)</small>
                                        
                                </div>
                            </div>                      
                        </div>                        
                    </div>
                    <div class="card" id="ctetdaatadiv">
                        <label class="checkbox-label">
                            <input type="checkbox" id="ctetCheck"  name="ctetCheck" onchange="toggleDiv('ctetCheck','ctetDiv')">
                            CTET पात्र आहे काय?
                        </label>
                            <!-- Section 4: अल्पसंख्याक प्रमाणपत्र -->
                            <div id="ctetDiv" class="transfer-section">

                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="ctetnumber" class="form-label marathi-label required-field">परीक्षा आसन क्रमांक<span class="english-label">(Examination Seat Number)</span></label>
                                        <input type="text"
                                            class="form-control"
                                            id="ctetnumber"
                                            name="ctetnumber" required>
                                    </div>
                                    <div class="col-md-2">
                                
                                    <label for="ctetExam" class="form-label marathi-label required-field">परीक्षा वर्ष <span class="english-label">(Year)</span></label>
                                        <select class="form-select" id="ctetExam" name="ctetExam" required>                            
                                            <option value="">-- Select Exam Year --</option>
                                            <?php 
                                                $cy = date('Y');
                                                for($y=$cy; $y>2012;$y--){
                                                    echo '<option value="'.$y.'">'.$y.'</option>';
                                                }
                                            ?>
                                        </select> 
                                    </div>
                                    <div class="col-md-2">
                                    
                                        <label for="ctetPaper" class="form-label marathi-label required-field">पेपर <span class="english-label">(Paper)</span></label>
                                            <select class="form-select" id="ctetPaper" name="ctetPaper" required>                            
                                                <option value="">-- Select Peper --</option>
                                                <option value="1">पेपर 1</option>
                                                <option value="2">पेपर 2</option>
                                            
                                            </select> 
                                    </div>
                                    
                                    <div class="col-md-4">  
                                        <label for="ctetCertificateFile" class="form-label marathi-label required-field">दस्तऐवज अपलोड करा <span class="english-label">(Upload Document)</span></label>

                                        <input type="file" id="ctetCertificateFile" name="ctetCertificateFile" class="form-control file-upload-check" accept=".pdf" required>
                                        <small class="text-muted">Maximum file size: 2 MB (PDF only)</small>
                                        
                                </div>
                            </div>                      
                        </div>
                        
                    </div>                
                    <!-- Additional Details Row -->
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
                            <select class="form-select" id="horizontalCategory" name="horizontalCategory" required>                   
                                <option value="">-- Select Horizontal Category --</option>
                                <?php 
                                    foreach($horizontalCategories as $hc){
                                        echo '<option value="'.$hc->id.'">'.$hc->name.'</option>';
                                    }
                                ?>
                            </select> 
                        </div>
                        
                    </div>
                        
                    
                    <!-- Submit Button -->
                    <div class="d-flex justify-content-between mt-4">                        
                        <button type="submit" class="btn btn-submit" id="saSubmitBtn_step1">
                            <i class="bi bi-send-check"></i> पुढील चरणावर जा
                        </button>
                    </div>
                </form>
            </div>  
                    
              
            <div id="saStep2">
                <form id="saFormStep2" enctype="multipart/form-data">
                    <div class="pdf-field">
                        <h3 class="section-title">शैक्षणिक व व्यावसायिक अर्हता. <small style="font-size:10px;">संबंधित शिक्षकाची शैक्षणिक व व्यावसायिक अर्हता प्रमाणपत्रे • शासन निर्णय दिनांक 25.02.2019 नुसार.</small></h3>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="hscFile" class="form-label marathi-label required-field">
                                    उच्च माध्यमिक <span class="english-label">(HSC / 12th)</span>
                                </label>
                                <input type="file" id="hscFile" name="hscFile" class="form-control file-upload-check" accept=".pdf" required>      
                                
                                
                                        
                            </div>                        
                            <div class="col-md-4">
                                <label for="graduateFile" class="form-label marathi-label">
                                    पदवी <span class="english-label">(Graduate Degree)</span>
                                </label>
                                <select class="form-select" id="transferGraduateDegree" name="transferGraduateDegree"></select>
                                <select class="form-select" id="transferGraduateDegreeSubject" name="transferGraduateDegreeSubject"></select>

                                <input type="file" id="graduateFile" name="graduateFile" class="form-control" accept=".pdf">                      
                            </div>
                                <div class="col-md-4">
                                <label for="postGraduateFile" class="form-label marathi-label">
                                    पदव्युत्तर पदवी  <span class="english-label">(Post Graduate Degree)</span>
                                </label>
                                <select class="form-select" id="transferPostGraduateDegree" name="transferPostGraduateDegree"></select>
                                <select class="form-select" id="transferPostGraduateDegreeSubject" name="transferPostGraduateDegreeSubject"></select>
                                <input type="file" id="postGraduateFile" name="postGraduateFile" class="form-control" accept=".pdf">                      
                            </div>     
                                
                        </div>
                        <hr/>
                        <div class="row">





                    
                            <div class="col-md-4">
                                <label for="dedFile" class="form-label marathi-label">
                                    डी.एड. / समकक्ष  <span class="english-label">(D.Ed / Equivalent)</span>
                                        

                                </label>
                                <select class="form-select" id="transferProfessionalDiploma" name="transferProfessionalDiploma"></select>
                                <input type="file" id="dedFile" name="dedFile" class="form-control" accept=".pdf">                      
                            </div>
                                <div class="col-md-4">
                                <label for="bedFile" class="form-label marathi-label">
                                    बी.एड. / समकक्ष  <span class="english-label">(B.Ed  / Equivalent)</span>
                                </label>
                                <select class="form-select" id="transferGraduateProfessionalDegree" name="transferGraduateProfessionalDegree"></select>
                                <input type="file" id="bedFile" name="bedFile" class="form-control" accept=".pdf">                      
                            </div>                        
                            <div class="col-md-4">
                                <label for="mpedFile" class="form-label marathi-label">
                                    एम.पी.एड. / समकक्ष <span class="english-label">(M.P.Ed  / Equivalent) </span>
                                </label>
                                <select class="form-select" id="transferPostGraduateProfessionalDegree" name="transferPostGraduateProfessionalDegree"></select>
                                <input type="file" id="mpedFile" name="mpedFile" class="form-control" accept=".pdf">                      
                            </div>

                        </div> 
                        

                        
                    </div>                
                    <!-- Submit Button -->
                    <div class="d-flex justify-content-between mt-4">                        
                        <button type="submit" class="btn btn-submit" id="saSubmitBtn_step2">
                            <i class="bi bi-send-check"></i> पुढील चरणावर जा
                        </button>
                    </div>
                </form>
            </div> 
                
            <div id="saStep3">
                <form id="saFormStep3" enctype="multipart/form-data">    
                    <!-- Section 6-24: Other Sections (Condensed for brevity) -->
                    <div class="form-section">
                        <h3 class="section-title"> आवश्यक कागदपत्रे</h3>
                        
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
                                दस्तऐवज अपलोड करा (Upload Document) <small class="text-muted">Maximum file size: 2 MB (PDF only)</small>
                            </div>
                        </div>  

                        
                        
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label marathi-label required-field">शाळा व्यवस्थापन समितीचा ठराव. (MEPS Act 1981)</label>
                            </div> 
                            <div class="col-md-2">
                                <input type="text" class="form-control" id="schoolCommitteeOutwardNumber" name="schoolCommitteeOutwardNumber" required>
                            </div>
                            <div class="col-md-2">
                                <input type="date" class="form-control" id="schoolCommitteeOutwardDate" name="schoolCommitteeOutwardDate" required>                                
    
                            </div>
                            <div class="col-md-4">
                                <input type="file" id="schoolCommitteeOutwardFile" name="schoolCommitteeOutwardFile" class="form-control file-upload-check" accept=".pdf" required>
                                
                            </div>
                        </div> 
                        
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label marathi-label required-field">विनाअनुदानित / अंशतः अनुदानित तत्त्वावरील मूळ संस्था नियुक्ती आदेश</label>
                            </div> 
                            <div class="col-md-2">
                                <input type="text" class="form-control" id="originSansthaAppointmentNumber" name="originSansthaAppointmentNumber" required>
                            </div>
                            <div class="col-md-2">
                                <input type="date" class="form-control" id="originSansthaAppointmentDate" name="originSansthaAppointmentDate" required>                                
    
                            </div>
                            <div class="col-md-4">
                                <input type="file" id="originSansthaAppointmentFile" name="originSansthaAppointmentFile" class="form-control file-upload-check" accept=".pdf" required>
                            </div>
                        </div>
                        

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label marathi-label required-field">शिक्षणाधिकारी / उपसंचालक यांनी दिलेला अंशतः अनुदानित तत्त्वावरील वैयक्तिक मान्यता आदेश</label>
                            </div> 
                            <div class="col-md-2">
                                <input type="text" class="form-control" id="personalRecognitionNumber" name="personalRecognitionNumber" required>
                            </div>
                            <div class="col-md-2">
                                <input type="date" class="form-control" id="personalRecognitionDate" name="personalRecognitionDate" required>                                
    
                            </div>
                            <div class="col-md-4">
                                <input type="file" id="personalRecognitionFile" name="personalRecognitionFile" class="form-control file-upload-check" accept=".pdf" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label marathi-label required-field">संबंधित व्यवस्थापनाची विनाअनुदानित / अंशतः अनुदानित सेवाज्येष्ठता सूची</label>
                            </div> 
                            <div class="col-md-2">
                                <input type="text" class="form-control" id="serviceSeniorityListNumber" name="serviceSeniorityListNumber" required>
                            </div>
                            <div class="col-md-2">
                                <input type="date" class="form-control" id="serviceSeniorityListDate" name="serviceSeniorityListDate" required>                                
    
                            </div>
                            <div class="col-md-4">
                                <input type="file" id="serviceSeniorityListFile" name="serviceSeniorityListFile" class="form-control file-upload-check" accept=".pdf" required>
                            </div>
                        </div>

                        <!--<div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label marathi-label required-field">विनाअनुदानित / अंशतः अनुदानित शाळेत 5 वर्षे सेवा केल्याचे (मुख्याध्यापक) प्रमाणपत्र</label>
                            </div> 
                            <div class="col-md-2">
                                <input type="text" class="form-control" id="schoolPermissionOrderNumber" name="schoolPermissionOrderNumber" required>
                            </div>
                            <div class="col-md-2">
                                <input type="date" class="form-control" id="schoolPermissionOrderDate" name="schoolPermissionOrderDate" required>                                
    
                            </div>
                            <div class="col-md-4">
                                <input type="file" id="f_educationQualification" name="f_educationQualification" class="form-control file-upload-check" accept=".pdf" required>
                            </div>
                        </div>-->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label marathi-label required-field">बदलीपूर्वी बिंदुनामावलीनुसार रिक्त पदाचा विषय व आरक्षण विचारात घेण्यात आल्याचे प्रमाणपत्र</label>
                            </div> 
                            <div class="col-md-2">
                                <input type="text" class="form-control" id="vacantPostAsMeritListNumber" name="vacantPostAsMeritListNumber" required>
                            </div>
                            <div class="col-md-2">
                                <input type="date" class="form-control" id="vacantPostAsMeritListDate" name="vacantPostAsMeritListDate" required>                                
    
                            </div>
                            <div class="col-md-4">
                                <input type="file" id="vacantPostAsMeritListFile" name="vacantPostAsMeritListFile" class="form-control file-upload-check" accept=".pdf" required>
                            </div>
                        </div>
    
                
                        <!--<div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label marathi-label required-field">need to move EO/DD शासन निर्णय दि. 06.02.2012 व 10.06.2022 नुसार मान्यता असल्याबाबतचा शिक्षणाधिकारी / उपसंचालक यांचा स्पष्ट अभिप्राय</label>
                            </div> 
                            <div class="col-md-2">
                                <input type="text" class="form-control" id="opinionEoDDRecognitionNumber" name="opinionEoDDRecognitionNumber" required>
                            </div>
                            <div class="col-md-2">
                                <input type="date" class="form-control" id="opinionEoDDRecognitionDate" name="opinionEoDDRecognitionDate" required>                                
    
                            </div>
                            <div class="col-md-4">
                                <input type="file" id="opinionEoDDRecognitionFile" name="opinionEoDDRecognitionFile" class="form-control file-upload-check" accept=".pdf" required>
                            </div>
                        </div>-->

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label marathi-label required-field">विनाअनुदानित / अंशतः अनुदानित शाळेत 5 वर्षे सेवा केल्याचे (मुख्याध्यापक) प्रमाणपत्र</label>
                            </div>                       
                            <div class="col-md-6">
                                <input type="file" id="fiveYrsHMCertificateFile" name="fiveYrsHMCertificateFile" class="form-control file-upload-check" accept=".pdf" required>
                            </div>
                        </div>
                        <div class="row mb-3" style="border:3px dotted #333;">
                        
                                <label class="form-label marathi-label required-field">अनुदानित रिक्त पदाचा तपशील व कागदपत्रे</label>
                            
                            <div class="col-md-12">   
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="vacantPostCausingTransfer1" name="vacantPostCausingTransfer" value="1">
                                            <label class="form-check-label marathi-label" for="class1to5">&nbsp;&nbsp; सेवा निवृत्ती</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">                                    
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="VacantPostCausingTransfer2" name="vacantPostCausingTransfer" value="2">
                                            <label class="form-check-label marathi-label" for="VacantPostCausingTransfer2">&nbsp;&nbsp; राजीनामा</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">                                    
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="VacantPostCausingTransfer3" name="vacantPostCausingTransfer" value="3">
                                            <label class="form-check-label marathi-label" for="VacantPostCausingTransfer3">&nbsp;&nbsp; मृत्यू</label>
                                        </div>
                                    </div>

                                    <div class="col-md-2">                                    
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="VacantPostCausingTransfer4" name="vacantPostCausingTransfer" value="4">
                                            <label class="form-check-label marathi-label" for="VacantPostCausingTransfer4">&nbsp;&nbsp; पदोन्नती</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">                                    
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="VacantPostCausingTransfer5" name="vacantPostCausingTransfer" value="5">
                                            <label class="form-check-label marathi-label" for="VacantPostCausingTransfer5">&nbsp;&nbsp; बदली</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">                                    
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="VacantPostCausingTransfer6" name="vacantPostCausingTransfer" value="6">
                                            <label class="form-check-label marathi-label" for="VacantPostCausingTransfer6">&nbsp;&nbsp; नवीन पद मंजुरी</label>
                                        </div>
                                    </div>
                                    
                                </div>    
                            </div>      
                            
                            <div class="col-md-4">
                                
                                    <input type="date" placeholder="दिनांक" class="form-control" id="vacantPostDate" name="vacantPostDate" required>
                                                                    

                            </div>   


                            <div class="col-md-8">
                                <input type="file" id="vacantPostCausingTransferFile" name="vacantPostCausingTransferFile" class="form-control file-upload-check" accept=".pdf" required>
                            </div>
                        </div>   
                    </div>
                    <!-- Submit Button -->
                    <div class="d-flex justify-content-between mt-4">                        
                        <button type="submit" class="btn btn-submit" id="saSubmitBtn_step3">
                            <i class="bi bi-send-check"></i> पुढील चरणावर जा
                        </button>
                    </div>
                </form>
            </div>
            
            <div id="saStep4">
                <form id="saFormStep4" enctype="multipart/form-data">    
                    <!-- Section 6-24: Other Sections (Condensed for brevity) -->
                    <div class="form-section">
                        <h3 class="section-title  mb-3" style="font-size:15px;"> शासन निर्णय दि. 06.02.2012 व 10.06.2022 नुसार मान्यता असल्याबाबतचा शिक्षणाधिकारी / उपसंचालक यांचा स्पष्ट अभिप्राय</h3>
                        
                        <div class="row mb-3" id="bindunamavaliMavakaDawareBox">
                            <div class="col-md-4">
                                <label class="form-label marathi-label required-field">बिंदुनामावली तपासणी पत्र (मावकद्वारे)</label>
                            </div>  
                            
                            <div class="col-md-2">
                                
                                    <input type="date" placeholder="दिनांक" class="form-control" id="mavakCheckListDate" name="mavakCheckListDate" required>
                                                                    

                            </div>                 
                            <div class="col-md-6">
                                <input type="file" id="mavakCheckListFile" name="mavakCheckListFile" class="form-control file-upload-check" accept=".pdf" required>
                            </div>
                        </div> 
                        <div class="row mb-3">
                        
                            
                            <div class="col-md-4">
                                <label class="form-label marathi-label required-field">संबंधित शिक्षकांचे विनाअनुदानित भरतीचे ना हरकत प्रमाणपत्र</label>
                            </div>  
                            
                            <div class="col-md-2">
                                
                                    <input type="text" placeholder="जावक क्रमांक" class="form-control" id="recruitmentNocOutwardNumber" name="recruitmentNocOutwardNumber" required>
                                                                    

                            </div>  
                            <div class="col-md-2">
                                
                                    <input type="date" placeholder="दिनांक" class="form-control" id="recruitmentNocOutwardDate" name="recruitmentNocOutwardDate" required>
                                                                    

                            </div>                
                            <div class="col-md-4">
                                <input type="file" id="recruitmentNocOutwardFile" name="recruitmentNocOutwardFile" class="form-control file-upload-check" accept=".pdf" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                        
                            
                            <div class="col-md-4">
                                <label class="form-label marathi-label required-field">वर्तमानपत्रातील जाहिरात (मूळप्रत)</label>
                            </div>  
                            
                            <div class="col-md-2">
                                
                                    <input type="text" placeholder="वर्तमानपत्राचे नाव" class="form-control" id="advrtNewspaperName" name="advrtNewspaperName" required>
                                                                    

                            </div>  
                            <div class="col-md-2">
                                
                                    <input type="date" placeholder="दिनांक" class="form-control" id="advrtNewspaperDate" name="advrtNewspaperDate" required>
                                                                    

                            </div>                
                            <div class="col-md-4">
                                <input type="file" id="advrtNewspaperFile" name="advrtNewspaperFile" class="form-control file-upload-check" accept=".pdf" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                        
                            
                            <div class="col-md-4">
                                <label class="form-label marathi-label required-field">मुलाखत</label>
                            </div>  
                            
                            <div class="col-md-2">
                                
                                    <input type="date" placeholder="दिनांक" class="form-control" id="interviewDate" name="interviewDate" required>
                                                                    

                            </div>                 
                            <div class="col-md-6">
                                <input type="file" id="interviewFile" name="interviewFile" class="form-control file-upload-check" accept=".pdf" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                        
                            
                            <div class="col-md-4">
                                <label class="form-label marathi-label required-field">रुजू अहवाल विनाअनुदानित तत्त्वावरील</label>
                            </div>  
                            
                            <div class="col-md-2">
                                
                                    <input type="date" placeholder="दिनांक" class="form-control" id="reportNGPrincipleDate" name="reportNGPrincipleDate" required>
                                                                    

                            </div>                 
                            <div class="col-md-6">
                                <input type="file" id="reportNGPrincipleFile" name="reportNGPrincipleFile" class="form-control file-upload-check" accept=".pdf" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                        
                            
                            <div class="col-md-4">
                                <label class="form-label marathi-label required-field">रुजू अहवाल अंशतः अनुदानित/अनुदानित तत्त्वावरील</label>
                            </div>  
                            
                            <div class="col-md-2">
                                
                                    <input type="date" placeholder="दिनांक" class="form-control" id="reportGPrincipleDate" name="reportGPrincipleDate" required>
                                                                    

                            </div>                 
                            <div class="col-md-6">
                                <input type="file" id="reportGPrincipleFile" name="reportGPrincipleFile" class="form-control file-upload-check" accept=".pdf" required>
                            </div>
                        </div>
                       
                        
                    
                        <div class="row mb-3">
                        
                            
                            <div class="col-md-4">
                                <label class="form-label marathi-label required-field">बदली होणारा शिक्षक स्वयंअर्थसहाय्यित तत्त्वावर कार्यरत नव्हता याबाबत प्रमाणपत्र • शासन अधिसूचना दि. 08.06.2020</label>
                            </div>  
                            
                            <div class="col-md-2">
                                
                                    <input type="text" placeholder="जावक क्रमांक" class="form-control" id="selfFinancingCertificateOutwardNumber" name="selfFinancingCertificateOutwardNumber" required>
                                                                    

                            </div>  
                            <div class="col-md-2">
                                
                                    <input type="date" placeholder="दिनांक" class="form-control" id="selfFinancingCertificateDate" name="selfFinancingCertificateDate" required>
                                                                    

                            </div>                
                            <div class="col-md-4">
                                <input type="file" id="selfFinancingCertificateFile" name="selfFinancingCertificateFile" class="form-control file-upload-check" accept=".pdf" required>
                            </div>
                        </div>

                        
                        <div class="row mb-3">                       
                            
                            <div class="col-md-4">
                                <label class="form-label marathi-label required-field">बदली असमान पदावर झालेली नाही याबाबत प्रमाणपत्र • अधिसूचना दि. 08.06.2020 मधील तरतुदीनुसार</label>
                            </div>  
                            
                            <div class="col-md-2">
                                
                                    <input type="text" placeholder="जावक क्रमांक" class="form-control" id="transferNotHigherPostOutwardNumber" name="transferNotHigherPostOutwardNumber" required>
                                                                    

                            </div>  
                            <div class="col-md-2">
                                
                                    <input type="date" placeholder="दिनांक" class="form-control" id="transferNotHigherPostDate" name="transferNotHigherPostDate" required>
                                                                    

                            </div>                
                            <div class="col-md-4">
                                <input type="file" id="transferNotHigherPostFile" name="transferNotHigherPostFile" class="form-control file-upload-check" accept=".pdf" required>
                            </div>
                        </div>

                        <div class="row mb-3">                       
                            
                            <div class="col-md-8">
                                <label class="form-label marathi-label required-field">महाराष्ट्र खासगी शाळा कर्मचारी (सेवा अटी) नियमावली 1981 मधील नियम 41(1)(3) नुसार वेतन अनुदानाबाबत हमीपत्र • शासन निर्णय क्र. संकीर्ण 2019/प्र.क्र.341/टीएनटी-1, दि. 01.04.2021</label>
                            </div>  
                            
                                        
                            <div class="col-md-4">
                                <input type="file" id="salarySubsidyGuaranteeLetterFile" name="salarySubsidyGuaranteeLetterFile" class="form-control file-upload-check" accept=".pdf" required>
                            </div>
                        </div>

                        

                        

                        
                    </div>
                    <!-- Submit Button -->
                    <div class="d-flex justify-content-between mt-4">                        
                        <button type="submit" class="btn btn-submit" id="saSubmitBtn_step4">
                            <i class="bi bi-send-check"></i> पुढील चरणावर जा
                        </button>
                    </div>
                </form>
            </div> 

            <div id="saStep5">
                <form id="saFormStep5" enctype="multipart/form-data">   
                    <div class="form-section">
                        <div class="row mb-3" style="border:3px dotted #333;">                       
                            
                            <div class="col-md-2">
                                <label class="form-label marathi-label required-field">आयकर विवरणपत्र<br/>Form-16</label>
                            </div> 
                            
                            <div class="col-md-3">
                                <label class="form-label marathi-label required-field">2024-25 <input type="file" id="itr1File" name="itr1File" class="form-control file-upload-check" accept=".pdf" required></label>
                            </div> 
                            <div class="col-md-3">
                                <label class="form-label marathi-label required-field">2023-24 <input type="file" id="itr12File" name="itr2File" class="form-control file-upload-check" accept=".pdf" required></label>
                            </div> 
                            <div class="col-md-3">
                                <label class="form-label marathi-label required-field">2022-23 <input type="file" id="itr3File" name="itr3File" class="form-control file-upload-check" accept=".pdf" required></label>
                            </div> 

                            
                        </div>

                        <div class="row mb-3" style="border:3px dashed #635e5e;">                       
                            
                            <div class="col-md-3">
                                <label class="form-label marathi-label required-field">वेतन बँक स्टेटमेंट ( मागील ५ वर्षाचे)</label>
                            </div> 
                            
                            <div class="col-md-2">
                                <input type="date" placeholder="दिनांक" class="form-control" id="bankStatementFromDate" name="bankStatementFromDate" required>
                            </div> 
                            <div class="col-md-2">
                                <input type="date" placeholder="दिनांक" class="form-control" id="bankStatementToDate" name="bankStatementToDate" required>
                            </div>
                            
                            <div class="col-md-5">
                                <input type="file" id="bankStatementFile" name="bankStatementFile" class="form-control file-upload-check" accept=".pdf" required>
                            </div> 

                            
                        </div>

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

                        
                        

                        <div class="row mb-3">                       
                            
                            <div class="col-md-4">
                                <label class="form-label marathi-label">विनाअनुदानित तत्त्वावरील रुजू दिनांकापासून इतर शासकीय लाभ घेतले नाहीत याबाबत प्रमाणपत्र</label>
                            </div>  
                            
                            <div class="col-md-4">
                                    <input type="text" placeholder="विवरण" class="form-control" id="noBenefitsCertificateDetails" name="noBenefitsCertificateDetails" required>
                            </div>  
                                        
                            <div class="col-md-4">
                                <input type="file" id="noBenefitsCertificateFile" name="noBenefitsCertificateFile" class="form-control file-upload-check" accept=".pdf" required>
                            </div>
                        </div>

                        
                        <div class="row mb-3">                       
                            
                            <div class="col-md-6">
                                <label class="form-label marathi-label required-field">NPS योजना बंधनकारक असल्याबाबत हमीपत्र</label>
                            </div>  
                            
                        
                                        
                            <div class="col-md-6">
                                <input type="file" id="npsScheme" name="npsScheme" class="form-control file-upload-check" accept=".pdf" required>
                            </div>
                        </div>
                        <div class="row mb-3">                       
                            
                            <div class="col-md-6">
                                <label class="form-label marathi-label required-field">प्रस्तुत प्रस्तावातील कागदपत्रे खरी असल्याबाबत संस्थेचे हमीपत्र (प्रपत्र-2) • शासन अधिसूचना दि. 08.06.2020</label>
                            </div>  
                            
                        
                                        
                            <div class="col-md-6">
                                <input type="file" id="institutionGuaranteeFile" name="institutionGuaranteeFile" class="form-control file-upload-check" accept=".pdf" required>
                            </div>
                        </div>
                        <div class="row mb-3">                       
                            
                            <div class="col-md-6">
                                <label class="form-label marathi-label required-field">संस्थेमध्ये वाद नसल्याबाबत हमीपत्र</label>
                            </div>  
                            
                        
                                        
                            <div class="col-md-6">
                                <input type="file" id="institutionNoDisbuteFile" name="institutionNoDisbuteFile" class="form-control file-upload-check" accept=".pdf" required>
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
                    <!-- Submit Button -->
                    <div class="d-flex justify-content-between mt-4">                        
                        <button type="submit" class="btn btn-submit" id="saSubmitBtn_step5">
                            <i class="bi bi-send-check"></i> पुढील चरणावर जा
                        </button>
                    </div>
                </form>
            </div> 
            <div id="saStep6">
                <form id="saFormStep6" enctype="multipart/form-data"> 
                    <div class="form-section">
                        <div class="form-check">
                            <div class="mb-4">
                                <label><strong>मंजुरीसाठी अर्ज पाठवण्यासाठी कार्यालय निवडा:</strong></label>       
                
                                <select class="form-control form-control-sm" name="sa_forward_to" id="sa_forward_to" required>
                                    <option value="">-- कार्यालय निवडा --</option>
                                    <option value="1">प्राथमिक शिक्षणाधिकारी जिल्हा परिषद</option>
                                    <option value="2">माध्यमिक शिक्षणाधिकारी जिल्हा परिषद</option>
                                    <option value="3">महानगरपालिका/नगरपालिका</option>
                                    <option value="4">विभागीय उपसंचालक</option>
                                </select>
                            </div>
                            
                                
                            <!-- District Dropdown -->
                            <div id="sa_districtDiv" class="form-group hidden" >
                                <label>जिल्हा निवडा:</label>
                                <select class="form-control form-control-sm" name="sa_forward_to_district" id="sa_forward_to_district">
                                    <option value="">-- जिल्हा निवडा --</option>
                                    
                                    
                                    <?php 

                                    foreach($districts as $d){
                                        echo '<option value="'.$d->code.'">'.$d->name.'</option>';
                                    }
                                    ?>
                                
                                </select>
                            </div>

                            <!-- Mahanagarpalika Dropdown -->
                            <div id="sa_mahanagarpalikaDiv" class="form-group hidden" >
                                <label>महानगरपालिका निवडा:</label>
                                <select class="form-control form-control-sm" name="sa_forward_to_palika" id="sa_forward_to_palika">
                                    <option value="">-- महानगरपालिका/नगरपालिका निवडा --</option>
                                    
                                    <?php 

                                    foreach($mnp_nps as $mn){
                                        echo '<option value="'.$mn->id.'">'.$mn->office_name.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            
                            <!-- Division Dropdown -->
                            <div id="sa_divisionDiv" class="form-group hidden">
                                <label>विभाग निवडा:</label>
                                <select class="form-control form-control-sm" name="sa_forward_to_region" id="sa_forward_to_region">>
                                    <option value="">-- विभाग निवडा --</option>
                                    <?php 

                                    foreach($regions as $r){
                                        echo '<option value="'.$r->code.'">'.$r->name.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Declaration -->
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
            <h5 class="mb-0"><i class="fas fa-arrow-trend-up me-1"></i> Non-Grant → Aided Transfer </h5>
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

        /*function toggleTetDiv() {
            if ($('#teachingClasses_1_5').is(':checked') || $('#teachingClasses_6_8').is(':checked')) {
                $('#tetdaatadiv').show();
            } else {
                $('#tetdaatadiv').hide();
            }
        }

        $('input[name="teachingClasses"]').on('change', function () {
            toggleTetDiv();
        });

        // Run on page load in case value already selected
        toggleTetDiv();*/

        function checkTETRequirement() {

            var selectedClass = $('input[name="teachingClasses"]:checked').val();
            var appointmentDate = $('#appointmentDate').val();

            if (appointmentDate === '') {
                $('#tetdaatadiv').hide();
                $('#ctetdaatadiv').hide();
                return;
            }

            var appointDate = new Date(appointmentDate);
            var tetRuleDate = new Date('2013-02-13');

            //$('#tetdaatadiv').slideDown();
            //$('#ctetdaatadiv').slideDown();

            if ((selectedClass === '1-5' || selectedClass === '6-8') && appointDate > tetRuleDate) {
                $('#tetdaatadiv').slideDown();
                $('#ctetdaatadiv').slideDown();
            } else {
                $('#tetdaatadiv').slideUp();
                $('#ctetdaatadiv').slideUp();
            }
        }

        $('input[name="teachingClasses"]').on('change', checkTETRequirement);
        $('#appointmentDate').on('change', checkTETRequirement);

        checkTETRequirement();

        $("#transferGraduateDegree").change(function () {
            const transferGraduateDegreeId = $(this).val();
            $("#transferGraduateDegreeSubject").html('<option>Loading...</option>');

            if (transferGraduateDegreeId === "") {
                $("#transferGraduateDegreeSubject").html('<option>-- Select Graduate Degree --</option>');
                return;
            }
            $.ajax({
                url: '<?= $this->Url->build(["controller" => "staff-qualifications", "action" => "level-degree-subjects"]); ?>/4/'+transferGraduateDegreeId,
                type: 'GET',
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                },
                    success: function (response) {
                    //transferPostGraduateDegreeSubject
                    if(response.status =='success'){
                        let options = '<option value="">-- Select Graduate Degree Subject --</option>';

                        $.each(response.data, function (index, degree) {
                            options += `<option value="${degree.id}">
                                            ${degree.name}
                                        </option>`;
                        });

                        $("#transferGraduateDegreeSubject").html(options);
                    }else{
                        $("#transferGraduateDegreeSubject").html('<option>There is no option available</option>');
                    }
                    
                },
                error: function () {
                    $("#transferGraduateDegreeSubject").html('<option>Error loading data</option>');
                }
            });
        });
        $.ajax({
            url: '<?= $this->Url->build(["controller" => "staff-qualifications", "action" => "level-degrees"]); ?>/4',
            type: 'GET',
            headers: {
                'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
            },
                success: function (response) {
                //transferPostGraduateDegreeSubject
                if(response.status =='success'){
                    let options = '<option value="">-- Select Graduate Degree --</option>';

                    $.each(response.data, function (index, degree) {
                        options += `<option value="${degree.id}">
                                        ${degree.name}
                                    </option>`;
                    });

                    $("#transferGraduateDegree").html(options);
                }else{
                    $("#transferGraduateDegree").html('<option>There is no option available</option>');
                }
                
            },
            error: function () {
                $("#transferGraduateDegree").html('<option>Error loading data</option>');
            }
        });

        $("#transferPostGraduateDegree").change(function () {
            const transferPostGraduateDegreeId = $(this).val();
            $("#transferPostGraduateDegreeSubject").html('<option>Loading...</option>');

            if (transferPostGraduateDegreeId === "") {
                $("#transferPostGraduateDegreeSubject").html('<option>-- Select Graduate Degree --</option>');
                return;
            }
            $.ajax({
                url: '<?= $this->Url->build(["controller" => "staff-qualifications", "action" => "level-degree-subjects"]); ?>/5/'+transferPostGraduateDegreeId,
                type: 'GET',
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                },
                    success: function (response) {
                    //transferPostGraduateDegreeSubject
                    if(response.status =='success'){
                        let options = '<option value="">-- Select Graduate Degree Subject --</option>';

                        $.each(response.data, function (index, degree) {
                            options += `<option value="${degree.id}">
                                            ${degree.name}
                                        </option>`;
                        });

                        $("#transferPostGraduateDegreeSubject").html(options);
                    }else{
                        $("#transferPostGraduateDegreeSubject").html('<option>There is no option available</option>');
                    }
                    
                },
                error: function () {
                    $("#transferPostGraduateDegreeSubject").html('<option>Error loading data</option>');
                }
            });
        });
        $.ajax({
            url: '<?= $this->Url->build(["controller" => "staff-qualifications", "action" => "level-degrees"]); ?>/5',
            type: 'GET',
            headers: {
                'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
            },
                success: function (response) {
                //transferPostGraduateDegreeSubject
                if(response.status =='success'){
                    let options = '<option value="">-- Select Graduate Degree --</option>';

                    $.each(response.data, function (index, degree) {
                        options += `<option value="${degree.id}">
                                        ${degree.name}
                                    </option>`;
                    });

                    $("#transferPostGraduateDegree").html(options);
                }else{
                    $("#transferPostGraduateDegree").html('<option>There is no option available</option>');
                }
                
            },
            error: function () {
                $("#transferPostGraduateDegree").html('<option>Error loading data</option>');
            }
        });

      
        $.ajax({
            url: '<?= $this->Url->build(["controller" => "staff-qualifications", "action" => "professional-level-degrees"]); ?>/2',
            type: 'GET',
            headers: {
                'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
            },
                success: function (response) {
                if(response.status =='success'){
                    let options = '<option value="">-- Select Deploma--</option>';

                    $.each(response.data, function (index, degree) {
                        options += `<option value="${degree.id}">
                                        ${degree.name}
                                    </option>`;
                    });

                    $("#transferProfessionalDiploma").html(options);
                }else{
                    $("#transferProfessionalDiploma").html('<option>There is no option available</option>');
                }
                
            },
            error: function () {
                $("#transferProfessionalDiploma").html('<option>Error loading data</option>');
            }
        });
        $.ajax({
            url: '<?= $this->Url->build(["controller" => "staff-qualifications", "action" => "professional-level-degrees"]); ?>/3',
            type: 'GET',
            headers: {
                'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
            },
                success: function (response) {
                if(response.status =='success'){
                    let options = '<option value="">-- Select Graduate Degree --</option>';

                    $.each(response.data, function (index, degree) {
                        options += `<option value="${degree.id}">
                                        ${degree.name}
                                    </option>`;
                    });

                    $("#transferGraduateProfessionalDegree").html(options);
                }else{
                    $("#transferGraduateProfessionalDegree").html('<option>There is no option available</option>');
                }
                
            },
            error: function () {
                $("#transferGraduateProfessionalDegree").html('<option>Error loading data</option>');
            }
        });
        $.ajax({
            url: '<?= $this->Url->build(["controller" => "staff-qualifications", "action" => "professional-level-degrees"]); ?>/4',
            type: 'GET',
            headers: {
                'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
            },
                success: function (response) {
                if(response.status =='success'){
                    let options = '<option value="">-- Select Post Graduate Degree --</option>';

                    $.each(response.data, function (index, degree) {
                        options += `<option value="${degree.id}">
                                        ${degree.name}
                                    </option>`;
                    });

                    $("#transferPostGraduateProfessionalDegree").html(options);
                }else{
                    $("#transferPostGraduateProfessionalDegree").html('<option>There is no option available</option>');
                }
                
            },
            error: function () {
                $("#transferPostGraduateProfessionalDegree").html('<option>Error loading data</option>');
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
                url: '<?= $this->Url->build(["controller" => "sanstha", "action" => "processIndividualApprovalOrder"]); ?>',
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
        // Slider 2: .approveApplication-open-transfer (targets #approveApplicationSlider)
        // ------------------------------
       


        $(document).on('click', '.approveApplication-open-transfer', function () {
            const caseId = $(this).data('id');
            let staffJson = $(this).attr('data-staffObject');   // raw JSON string
            let staffObject   = JSON.parse(staffJson)
            currentMode = $(this).attr('data-mode'); 
            currentAppId = staffObject.id; 
            
           

            if(currentMode == 1){
                $('#decisionBtn').removeClass('btn-danger').addClass('btn-success').html('Approve Application');
                //$('#footerBox').css('border-top', '5px solid #198754');
                $('#confirmBox').show();
                $('#confirmInfo').prop('required', true);
            }else{
                $('#decisionBtn').removeClass('btn-success').addClass('btn-danger').html('Reject Application');
               // $('#footerBox').css('border-top', '5px solid #dc3545');
                $('#confirmBox').hide();
                $('#confirmInfo').prop('required', false);             
            }
             

           $(document).trigger('approveApplication:openSlider', [caseId, staffObject]);
        });

        // Close slider
        $(document).on('click', '.approveApplication-close-slider', function () {
            $(document).trigger('approveApplication:closeSlider');
        });

        // Custom event handlers for Slider 2
        $(document).on('approveApplication:openSlider', function (e, caseId, staffObject) {
            //loadTransferDetails(caseId, staffObject);
            $('#approveApplicationSlider').addClass('open').attr('aria-hidden', 'false');
        });

        $(document).on('approveApplication:closeSlider', function () {
            $('#approveApplicationSlider').removeClass('open').attr('aria-hidden', 'true');
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
            $('#transferSchool option').prop('disabled', false);
            $('#transferSchool option[value="'+staffObject.udise_code+'"]').prop('disabled', true);
            //$('#appointmentDate').val("2019-03-13");
            $('#appointmentDate').val(staffObject.date_of_joining);

            
            /*empNameDetails = staffObject.teacher_name +' <span style="color:#333; font-size:12px;"> StaffType - '+
                             staffObject.staffs_type.staff_type_name+' &nbsp;&nbsp;|&nbsp;&nbsp; Designation - '+
                             staffObject.post.name+' &nbsp;&nbsp;|&nbsp;&nbsp; Aid Type - '+staffObject.aid_master.name+
                             ' &nbsp;&nbsp;|&nbsp;&nbsp; E-mail - '+staffObject.email+
                             ' &nbsp;&nbsp;|&nbsp;&nbsp; Mobile - '+staffObject.mobile+'</span>';*/
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
            $('#salarygrade').html(staffObject.pay_scale);
            $('#teachingSubjects').html(staffObject.subject_taught);
            $('#medium').html(staffObject.medium);  
            //sa_basic_data

            let basicData = {
                                "institution_code" : staffObject.sanstha_code,
                                "institution_name" : staffObject.sanstha_name,
                                "udise_code" : staffObject.udise_code,
                                "school_name" : staffObject.school_name,
                                "staff_name" : staffObject.teacher_name,
                                "staff_type" : staffObject.post_type,
                                "staff_type_name" : staff_type_name,
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
                url: '<?= $this->Url->build(["controller" => "School", "action" => "createTransferApplication"]); ?>',
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
                url: '<?= $this->Url->build(["controller" => "School", "action" => "updateStep2TransferDetails"]); ?>',
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
                url: '<?= $this->Url->build(["controller" => "School", "action" => "updateStep3TransferDetails"]); ?>',
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
                url: '<?= $this->Url->build(["controller" => "School", "action" => "updateStep4TransferDetails"]); ?>',
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
                url: '<?= $this->Url->build(["controller" => "School", "action" => "updateStep5TransferDetails"]); ?>',
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
                url: '<?= $this->Url->build(["controller" => "School", "action" => "updateStep6TransferDetails"]); ?>',
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
                url: '<?= $this->Url->build(["controller" => "School", "action" => "createTransferApplication"]); ?>',
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
                url: '<?= $this->Url->build(["controller" => "School", "action" => "updateStep2TransferDetails"]); ?>',
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
                url: '<?= $this->Url->build(["controller" => "School", "action" => "updateStep3TransferDetails"]); ?>',
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
                url: '<?= $this->Url->build(["controller" => "School", "action" => "updateStep4TransferDetails"]); ?>',
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
                url: '<?= $this->Url->build(["controller" => "School", "action" => "updateStep5TransferDetails"]); ?>',
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
                url: '<?= $this->Url->build(["controller" => "School", "action" => "updateStep6TransferDetails"]); ?>',
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
                url: '<?= $this->Url->build(["controller" => "Utilities", "action" => "ng2gReplyToReturnApplicationSubmission"]); ?>',
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
                url: '<?= $this->Url->build(["controller" => "Utilities", "action" => "ng2gReplyToReturnApplication"]); ?>/'+caseId,
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
                url: '<?= $this->Url->build(["controller" => "Cluster", "action" => "processTransfer"]); ?>',
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



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
    .viewBtn{
        text-decoration: none;
        padding: 3px 10px;
        background: #f0e9e4;
    }
</style>

    <style>
        .hidden { display: none; }
        .form-group { margin: 10px 0; }
    </style>
    
<style>
    .dots-loader{
        color:purple;
        padding:15%;
        font-size:36px;
    }
        .dots-loader::after {
            content: '';
            animation: dots 1.5s steps(3, end) infinite;
        }

        @keyframes dots {
            0% { content: ''; }
            12% { content: ' .'; }
            33% { content: ' . .'; }
            66% { content: ' . . .'; }
            81% { content: ' . . . .'; }
            100% { content: ' . . . . .'; }
        }
        </style>
<h5 style="margin:0px;padding:10px; color: #1a237e; border-bottom: 2px solid #1a237e;">
       
        🔜👨‍💼 List of Ng2G Transfer Applications
      
</h5>
<!-- Bootstrap + Bootstrap Icons -->
<div style="background: #fff; padding:10px;">      
    
        

        <table id="staffTable" class="table table-bordered table-striped table-hover align-middle">
            <thead class="table-light">
            <tr>
                <th>#</th>  
                <th>Sanstha, School and Jurisdiction Details</th>                
                <th>Staff Details</th>  
                <th>Status</th>
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
                <tr id="emp_row_<?= h($staff->id) ?>">
                    <td><?= h($idx++) ?></td>
                   
                    <td>
                        Sanstha:- <b><?= h($staff->institution_name) ?></b><br/>
                        Current School:- <b><?= h($staff->school_name) ?></b><br/>
                        Transfer School:- <b><?= h($staff->school_name_at_transfer) ?></b><br/>   
                        District:- <b><?= h($staff->district) ?></b>, 
                        Block:- <b><?= h($staff->block) ?></b>, 
                        Cluster:- <b><?= h($staff->cluster) ?></b>                     
                    </td>                    
                    <td>
                        <i class="fa-solid fa-user"></i> <b><?= h($staff->employee_name) ?></b><br/>
                        <i class="fa-solid fa-id-badge"></i> <?= h($staff->staff_type_name) ?><br/>
                        <i class="fa-solid fa-briefcase"></i> <b><?= h($staff->designation) ?></b><br/>
                        <i class="fa-solid fa-building-columns"></i> <b><?= h($staff->aid_name) ?></b>
                    </td>
                    <td>
                        <?php
                            //echo $staff->id."--".$staff->status;                           
                            $pendingStatuses = [
                                'primary_dy_director_desk_pending',
                                'secondary_dy_director_desk_pending',
                                'higher_secondary_dy_director_desk_pending',
                                'dy_director_primary_desk_forwarded',
                                'dy_director_secondary_desk_forwarded',
                                'dy_director_higher_secondary_desk_forwarded'
                            ];

                            if (in_array($staff->status, $pendingStatuses)) {
                               echo '<b style="color:red;">प्रलंबित: मा. शिक्षण उपसंचालक पडताळणी</b>';
                            }else if($staff->status == 'individual_order_rejected_by_eo'){
                                echo '<b style="color:red;">व्यक्तिगत मान्यता – विभागीय शिक्षण अधिकारी स्तरावर नाकारली</b>';
                            }else if($staff->status == 'individual_order_eo_pending'){
                                echo '<b style="color:red;">व्यक्तिगत मान्यता – प्रलंबित: विभागीय शिक्षण अधिकारी पडताळणी</b>';
                            }else if($staff->status == 'dy_eo_desk_pending'){
                                    echo '<b style="color:red;">प्रलंबित: विभागीय शिक्षण अधिकारी पडताळणी</b>';                            
                                
                            }
                            
                        ?>
                       
                         <br/>
                        <?php
                                echo "<a href='#' style='text-decoration:none;' class='viewApplication-open-transfer' data-mode='1'  data-id='".$staff->id."'>
                                        <i class='fa-solid fa-address-card'></i>  अर्ज पहा
                                    </a><br/>";


                                  echo "<a href='#' style='text-decoration:none;color:#17a821;' class='viewApplicationTimelines-open-transfer' data-id='".$staff->id."'>
                                                <i class='fa-solid fa-refresh'></i>  अर्जाची कालमर्यादा आणि टिपणी
                                            </a><br/>";

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
                     ?>
                       
                         
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
       
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


<!-- view Application Timelines Slide Panel -->
<div id="viewApplicationTimelinesSlider" class="slide-panel" aria-hidden="true" style="border:3px solid #537895;">
    <!-- Header -->
    <div class="slide-header d-flex justify-content-between align-items-center">
        <div style="width:100%;">
            <h5 class="mb-0"><i class="fas fa-arrow-trend-up me-1"></i> Non-Grant → Aided Transfer </h5>
            <!--<small class="text-muted">Case ID: <span id="caseId"></span></small>-->
        </div>
        <button style="font-size:27px;" class="btn btn-sm btn-outline-danger viewApplicationTimelines-close-slider">X</button>
    </div>

    <!-- Body -->
    <div class="slide-body">
        <div class="form-container">
            <div id="viewApplicationTimelinesForm"></div>

        </div>

    </div>

    <!-- Footer -->
    <div class="slide-footer text-end">
                <button class="btn btn-secondary btn-sm viewApplicationTimelines-close-slider">Close</button>
            
    </div>

</div>
<!-- Verify Returned Application Slide Panel -->
<div id="verifyReturnedApplicationSlider" class="slide-panel" aria-hidden="true" style="border:3px solid #537895;">
    <!-- Header -->
    <div class="slide-header d-flex justify-content-between align-items-center">
        <div style="width:100%;">
            <h5 class="mb-0"><i class="fas fa-arrow-trend-up me-1"></i> Non-Grant → Aided Transfer </h5>
            <!--<small class="text-muted">Case ID: <span id="caseId"></span></small>-->
        </div>
        <button style="font-size:27px;" class="btn btn-sm btn-outline-danger verifyReturnedApplication-close-slider">X</button>
    </div>

    <!-- Body -->
    <div class="slide-body">
        <div class="form-container">
            <div id="verifyReturnedHtmlForm"></div>

        </div>

    </div>

    <!-- Footer -->
    <div class="slide-footer text-end">
                <button class="btn btn-secondary btn-sm verifyReturnedApplication-close-slider">Close</button>
            
    </div>

</div>

<!-- Slide Panel -->
<div id="viewApplicationSlider" class="slide-panel" aria-hidden="true" style="border:3px solid #537895;">
    <!-- Header -->
    <div class="slide-header d-flex justify-content-between align-items-center">
        <div style="width:100%;">
            <h5 class="mb-0"><i class="fas fa-arrow-trend-up me-1"></i> Non-Grant → Aided Transfer </h5>
            <!--<small class="text-muted">Case ID: <span id="caseId"></span></small>-->
        </div>
        <button style="font-size:27px;" class="btn btn-sm btn-outline-danger viewApplication-close-slider">X</button>
    </div>

    <!-- Body -->
    <div class="slide-body">
        <div class="form-container">
            <div id="htmlForm"></div>

        </div>

    </div>

    <!-- Footer -->
    <div class="slide-footer text-end">
                <button class="btn btn-secondary btn-sm viewApplication-close-slider">Close</button>
            
    </div>

</div>



<!-- Slide Panel -->
<div id="approveApplicationSlider"
     class="slide-panel"
     aria-hidden="true"
     style="border:3px solid #537895;">

    <!-- Header -->
    <div class="slide-header d-flex justify-content-between align-items-center">
        <div style="width:100%;">
            <h5 class="mb-0">
                <i class="fas fa-arrow-trend-up me-1"></i>
                Non-Grant → Aided Transfer
            </h5>
        </div>

        <button style="font-size:27px;"
                class="btn btn-sm btn-outline-danger approveApplication-close-slider">
            X
        </button>
    </div>

    <!-- Body -->
    <div class="slide-body">

        <div class="container-fluid">

            <!-- Application Information -->
            <div class="card shadow-sm border-0 mb-1">
              

                <div class="card-body">

                    <div class="row g-1">
                        <div class="col-md-9">
                            <div class="form-control bg-light">
                                संस्थेचे नाव &rarr; <b id="app_sanstha_name"></b>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-control bg-light">
                                अर्ज क्रमांक:- <b>MAHAEDU/NG2G/TRF/<span id='app_year'></span>/<span id='app_id'></span></b>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-control bg-light">
                                कर्मचाऱ्यांचे नाव &rarr; <b id="app_staff_name"></b>
                            </div>
                        </div>      

                        <div class="col-md-3">
                            <div class="form-control bg-light">
                                अर्ज दिनांक:- <b id="app_date"></b>
                            </div>
                        </div>
                        
                        

                    </div>


                    

                </div>
            </div>

            <!-- Approval Section -->
            <div class="card shadow-sm border-0">

                <div class="card-header bg-success text-white">
                    <h6 class="mb-0">
                        <i class="fas fa-check-circle me-2"></i>
                        मंजुरी प्रक्रिया
                    </h6>
                </div>

                <div class="card-body">

                    <form id="approvalForm">

                       
                        <!-- Remark -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                शेरा / Remark
                            </label>

                            <textarea class="form-control"
                                      name="app_remark"
                                      id="app_remark"
                                      rows="5"
                                      placeholder="कृपया शेरा नमूद करा..."
                                      required></textarea>
                        </div>

                        <!-- Supporting File -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                सहाय्यक कागदपत्र अपलोड करा
                            </label>

                            <input type="file"
                                   name="app_doc"
                                   id="app_doc"
                                   class="form-control"
                                   name="supporting_document"
                                   accept=".pdf">

                            <small class="text-muted">
                                Allowed: PDF Only
                            </small>
                        </div>

                        <!-- Officer Details
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">
                                    अधिकारी नाव
                                </label>

                                <input type="text"
                                       class="form-control"
                                       value="Deepak Patil"
                                       readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">
                                    दिनांक
                                </label>

                                <input type="date"
                                       class="form-control"
                                       value="2026-05-16">
                            </div>

                        </div> -->
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fas fa-check-circle me-1"></i>
                            मंजुरी द्या
                        </button>
                    </form>

                </div>
            </div>

        </div>

    </div>

    <!-- Footer -->
    <div class="slide-footer text-end">

        <button class="btn btn-secondary btn-sm approveApplication-close-slider">
            Close
        </button>

    </div>

</div>


<!-- Slide Panel -->
<div id="rejectApplicationSlider"
     class="slide-panel"
     aria-hidden="true"
     style="border:3px solid #537895;">

    <!-- Header -->
    <div class="slide-header d-flex justify-content-between align-items-center">
        <div style="width:100%;">
            <h5 class="mb-0">
                <i class="fas fa-arrow-trend-up me-1"></i>
                Non-Grant → Aided Transfer
            </h5>
        </div>

        <button style="font-size:27px;"
                class="btn btn-sm btn-outline-danger rejectApplication-close-slider">
            X
        </button>
    </div>

    <!-- Body -->
    <div class="slide-body">

        <div class="container-fluid">

            <!-- Application Information -->
            <div class="card shadow-sm border-0 mb-1">
              

                <div class="card-body">

                    <div class="row g-1">
                        <div class="col-md-9">
                            <div class="form-control bg-light">
                                संस्थेचे नाव &rarr; <b id="reject_sanstha_name"></b>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-control bg-light">
                                अर्ज क्रमांक:- <b>MAHAEDU/NG2G/TRF/<span id='reject_year'></span>/<span id='reject_id'></span></b>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-control bg-light">
                                कर्मचाऱ्यांचे नाव &rarr; <b id="reject_staff_name"></b>
                            </div>
                        </div>      

                        <div class="col-md-3">
                            <div class="form-control bg-light">
                                अर्ज दिनांक:- <b id="reject_date"></b>
                            </div>
                        </div>
                        
                        

                    </div>

                </div>
            </div>

            <!-- Approval Section -->
            <div class="card shadow-sm border-0">

                <div class="card-header bg-danger text-white">
                    <h6 class="mb-0">
                        <i class="fas fa-check-circle me-2"></i>
                        नामंजुरी प्रक्रिया
                    </h6>
                </div>

                <div class="card-body">

                    <form id="rejectForm">                       
                        <!-- Remark -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                शेरा / Remark
                            </label>

                            <textarea class="form-control"
                                      name="reject_remark"
                                      id="reject_remark"
                                      rows="5"
                                      placeholder="कृपया शेरा नमूद करा..."
                                      required></textarea>
                        </div>

                        <!-- Supporting File -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                सहाय्यक कागदपत्र अपलोड करा
                            </label>

                            <input type="file"
                                   name="reject_doc"
                                   id="reject_doc"
                                   class="form-control"
                                   name="supporting_document"
                                   accept=".pdf">

                            <small class="text-muted">
                                Allowed: PDF Only
                            </small>
                        </div>

                        <!-- Officer Details
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">
                                    अधिकारी नाव
                                </label>

                                <input type="text"
                                       class="form-control"
                                       value="Deepak Patil"
                                       readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">
                                    दिनांक
                                </label>

                                <input type="date"
                                       class="form-control"
                                       value="2026-05-16">
                            </div>

                        </div> -->
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-times-circle me-1"></i>
                            नामंजूर करा
                        </button>

                    </form>

                </div>
            </div>

        </div>

    </div>

    <!-- Footer -->
    <div class="slide-footer text-end">

        <button class="btn btn-secondary btn-sm rejectApplication-close-slider">
            Close
        </button>      

    </div>

</div>




<script>  
    $(document).ready(function() {  

                    
        $(document).on('click', '.rejectApplication-open-transfer', function () {
            const caseId = $(this).data('id');    
            let staff = $(this).data('staff');

           // console.log('staff');
           // console.log(staff);
            /*if(currentMode == 1){
                $('#decisionBtn').removeClass('btn-danger').addClass('btn-success').html('Approve Application');
                //$('#footerBox').css('border-top', '5px solid #198754');
                $('#confirmBox').show();
                $('#confirmInfo').prop('required', true);
            }else{
                $('#decisionBtn').removeClass('btn-success').addClass('btn-danger').html('Reject Application');
               // $('#footerBox').css('border-top', '5px solid #dc3545');
                $('#confirmBox').hide();
                $('#confirmInfo').prop('required', false);             
            }*/
             

           $(document).trigger('rejectApplication:openSlider', [caseId, staff]);
        });

        // Close slider
        $(document).on('click', '.rejectApplication-close-slider', function () {
            $(document).trigger('rejectApplication:closeSlider');
        });

        // Custom event handlers for Slider 2
        $(document).on('rejectApplication:openSlider', function (e, caseId,staff) {
            loadRejectTransferDetails(caseId,staff);
            $('#rejectApplicationSlider').addClass('open').attr('aria-hidden', 'false');
        });

        $(document).on('rejectApplication:closeSlider', function () {
            $('#rejectApplicationSlider').removeClass('open').attr('aria-hidden', 'true');
        });

        

        formatDate = function (dateStr) {
            if (!dateStr) return "";

            let parts = dateStr.split("-");
            if (parts.length !== 3) return dateStr;

            return parts[2] + "-" + parts[1] + "-" + parts[0];
        }


        loadRejectTransferDetails = function(caseId,staff){

            let dbTimestamp = staff.created_at;           
            let date = new Date(dbTimestamp);
            let formattedDate =
                String(date.getDate()).padStart(2, '0') + '/' +
                String(date.getMonth() + 1).padStart(2, '0') + '/' +
                date.getFullYear();

            $("#reject_sanstha_name").html(staff.institution_name);
            $("#reject_staff_name").html(staff.employee_name);
            $("#reject_id").html(staff.id);
            $("#reject_year").html(date.getFullYear());
            $("#reject_date").html(formattedDate);
        }


        $('#rejectForm').on('submit', function (e) {

            e.preventDefault();
            let formData = new FormData(this);
            let rejectId = $("#reject_id").text().trim();
            formData.append('ng2g_id', rejectId);

            formData.append('_csrfToken', $('meta[name="csrfToken"]').attr('content'));
            $.ajax({
                url: '<?= $this->Url->build(["controller" => "deputydirector", "action" => "ng2gRejectTransfer"]); ?>',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                },

                beforeSend: function () {

                    // Disable button
                    $('#rejectForm button[type="submit"]')
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
                        alert('Application rejected successfully.');
                        // Optional
                        $('#rejectForm')[0].reset();
                        let rejectId = $("#reject_id").text().trim();
                        $('#emp_row_' + rejectId).remove();
                        $('#rejectApplicationSlider').removeClass('open').attr('aria-hidden', 'true');
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

                    // Enable button again
                    $('#rejectForm button[type="submit"]')
                        .prop('disabled', false)
                        .html(`
                            <i class="fas fa-times-circle me-1"></i>
                            नामंजूर करा
                        `);
                }
            });

        });
    

        $(document).on('click', '.approveApplication-open-transfer', function () {
            const caseId = $(this).data('id');    
            let staff = $(this).data('staff');

           // console.log('staff');
           // console.log(staff);
            /*if(currentMode == 1){
                $('#decisionBtn').removeClass('btn-danger').addClass('btn-success').html('Approve Application');
                //$('#footerBox').css('border-top', '5px solid #198754');
                $('#confirmBox').show();
                $('#confirmInfo').prop('required', true);
            }else{
                $('#decisionBtn').removeClass('btn-success').addClass('btn-danger').html('Reject Application');
               // $('#footerBox').css('border-top', '5px solid #dc3545');
                $('#confirmBox').hide();
                $('#confirmInfo').prop('required', false);             
            }*/
             

           $(document).trigger('approveApplication:openSlider', [caseId, staff]);
        });

        // Close slider
        $(document).on('click', '.approveApplication-close-slider', function () {
            $(document).trigger('approveApplication:closeSlider');
        });

        // Custom event handlers for Slider 2
        $(document).on('approveApplication:openSlider', function (e, caseId,staff) {
            loadApproveTransferDetails(caseId,staff);
            $('#approveApplicationSlider').addClass('open').attr('aria-hidden', 'false');
        });

        $(document).on('approveApplication:closeSlider', function () {
            $('#approveApplicationSlider').removeClass('open').attr('aria-hidden', 'true');
        });

        

        formatDate = function (dateStr) {
            if (!dateStr) return "";

            let parts = dateStr.split("-");
            if (parts.length !== 3) return dateStr;

            return parts[2] + "-" + parts[1] + "-" + parts[0];
        }


        loadApproveTransferDetails = function(caseId,staff){                    
            let dbTimestamp = staff.created_at;           
            let date = new Date(dbTimestamp);
            let formattedDate =
                String(date.getDate()).padStart(2, '0') + '/' +
                String(date.getMonth() + 1).padStart(2, '0') + '/' +
                date.getFullYear();
            $("#app_sanstha_name").html(staff.institution_name);
            $("#app_staff_name").html(staff.employee_name);
            $("#app_id").html(staff.id);
            $("#app_year").html(date.getFullYear());
            $("#app_date").html(formattedDate);
           
        }

        $('#approvalForm').on('submit', function (e) {

            e.preventDefault();
            let formData = new FormData(this);
            let approvalId = $("#app_id").text().trim();
            formData.append('ng2g_id', approvalId);

            formData.append('_csrfToken', $('meta[name="csrfToken"]').attr('content'));
            $.ajax({
                url: '<?= $this->Url->build(["controller" => "deputydirector", "action" => "ng2gApproveTransfer"]); ?>',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
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
                        alert('Application approved successfully.');
                        // Optional
                        $('#approvalForm')[0].reset();
                        let approvalId = $("#app_id").text().trim();
                        $('#emp_row_' + approvalId).remove();
                        $('#approveApplicationSlider').removeClass('open').attr('aria-hidden', 'true');
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

                    // Enable button again
                    $('#rejectForm button[type="submit"]')
                        .prop('disabled', false)
                        .html(`
                            <i class="fas fa-times-circle me-1"></i>
                            नामंजूर करा
                        `);
                }
            });

        });
       

        $(document).on('click', '.viewApplication-open-transfer', function () {
            const caseId = $(this).data('id');        
           

            /*if(currentMode == 1){
                $('#decisionBtn').removeClass('btn-danger').addClass('btn-success').html('Approve Application');
                //$('#footerBox').css('border-top', '5px solid #198754');
                $('#confirmBox').show();
                $('#confirmInfo').prop('required', true);
            }else{
                $('#decisionBtn').removeClass('btn-success').addClass('btn-danger').html('Reject Application');
               // $('#footerBox').css('border-top', '5px solid #dc3545');
                $('#confirmBox').hide();
                $('#confirmInfo').prop('required', false);             
            }*/
             

           $(document).trigger('viewApplication:openSlider', [caseId]);
        });

        // Close slider
        $(document).on('click', '.viewApplication-close-slider', function () {
            $(document).trigger('viewApplication:closeSlider');
        });

        // Custom event handlers for Slider 2
        $(document).on('viewApplication:openSlider', function (e, caseId) {
            loadTransferDetails(caseId);
            $('#viewApplicationSlider').addClass('open').attr('aria-hidden', 'false');
        });

        $(document).on('viewApplication:closeSlider', function () {
            $('#viewApplicationSlider').removeClass('open').attr('aria-hidden', 'true');
        });

         

        // ------------------------------
        // Global ESC key handler (closes both sliders)
        // ------------------------------
        $(document).on('keydown', function (e) {
            if (e.key === 'Escape') {
                $(document).trigger('im:closeSlider');
                $(document).trigger('viewApplication:closeSlider');
                $(document).trigger('startApplication:closeSlider');
                
            }
        });

        formatDate = function (dateStr) {
            if (!dateStr) return "";

            let parts = dateStr.split("-");
            if (parts.length !== 3) return dateStr;

            return parts[2] + "-" + parts[1] + "-" + parts[0];
        }


        loadTransferDetails = function(caseId){
            $("#htmlForm").html('<div class="dots-loader"><img src="https://edustaff.maharashtra.gov.in/images/logo.png" alt="Maha Logo" class="me-2"> Loading</div>');
            $.ajax({
                url: '<?= $this->Url->build(["controller" => "Utilities", "action" => "ng2gTransferDetails"]); ?>/'+caseId,
                type: 'GET',
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                },
                    success: function (response) {
                        console.log("############################"+response);
                    if(response.success){
                        if(response.data.id>0){
                            ng2g = response.data;
                            
                            $("#htmlForm").html(response.html);
                           
                        }                       
                    }
                    
                },
                error: function () {
                     $("#htmlForm").html('<option>Error loading data</option>');
                }
            });
        }


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
            //let formData = new FormData('#returnHtmlForm');

            formData.append('_csrfToken', $('meta[name="csrfToken"]').attr('content'));
            formData.append('_Token', $('meta[name="csrfToken"]').attr('content'));
            
            $.ajax({
                url: '<?= $this->Url->build(["controller" => "Utilities", "action" => "ng2gReturnApplicationSubmission"]); ?>',
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
                        alert('Application returned to Sanstha successfully.');
                        $('#emp_row_' + return_app_id).remove();
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

                   
                }
            });
        }
        loadReturnTransferDetails = function(caseId){
            $("#returnHtmlForm").html('<div class="dots-loader"><img src="https://edustaff.maharashtra.gov.in/images/logo.png" alt="Maha Logo" class="me-2"> Loading</div>');
            $.ajax({
                url: '<?= $this->Url->build(["controller" => "Utilities", "action" => "ng2gReturnApplicationForm"]); ?>/'+caseId,
                type: 'GET',
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                },
                    success: function (response) {
                        console.log("############################"+response);
                    if(response.success){
                        if(response.data.id>0){
                            ng2g = response.data;
                            
                            $("#returnHtmlForm").html(response.html);
                           
                        }                       
                    }
                    
                },
                error: function () {
                    $("#returnHtmlForm").html('<option>Error loading data</option>');
                }
            });
        }




        /**
         * Verify Returned Application
         * 
         */
        
        $(document).on('click', '.verifyReturnedApplication-open-transfer', function () {
            const caseId = $(this).data('id');    
             

           $(document).trigger('verifyReturnedApplication:openSlider', [caseId]);
        });

        // Close slider
        $(document).on('click', '.verifyReturnedApplication-close-slider', function () {
            $(document).trigger('verifyReturnedApplication:closeSlider');
        });

        // Custom event handlers for Slider 2
        var return_app_id = 0 ;
        $(document).on('verifyReturnedApplication:openSlider', function (e, caseId) {
            return_app_id = caseId ;
            loadverifyReturnedTransferDetails(caseId);
            $('#verifyReturnedApplicationSlider').addClass('open').attr('aria-hidden', 'false');
        });

        $(document).on('verifyReturnedApplication:closeSlider', function () {
            $('#verifyReturnedApplicationSlider').removeClass('open').attr('aria-hidden', 'true');
        });
       

       
        loadverifyReturnedTransferDetails = function(caseId){
            $("#verifyReturnedHtmlForm").html('<div class="dots-loader"><img src="https://edustaff.maharashtra.gov.in/images/logo.png" alt="Maha Logo" class="me-2"> Loading</div>');
            $.ajax({
                url: '<?= $this->Url->build(["controller" => "Utilities", "action" => "ng2gVerifyReturnedApplicationForm"]); ?>/'+caseId,
                type: 'GET',
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                },
                    success: function (response) {
                        console.log("############################"+response);
                    if(response.success){
                        if(response.data.id>0){
                            ng2g = response.data;
                            
                            $("#verifyReturnedHtmlForm").html(response.html);
                           
                        }                       
                    }
                    
                },
                error: function () {
                    $("#verifyReturnedHtmlForm").html('<option>Error loading data</option>');
                }
            });
        }

         submitVerifyReturnedApplication =  function (){
            const form = $('#verifyReturnedApplicationForm')[0];
            if (!form.checkValidity()) {
                form.reportValidity();
                return false;
            }

            const total = document.querySelectorAll('input[value="correct"]').length;
            const correct = document.querySelectorAll('input[value="correct"]:checked').length;
            

            if (correct === total) {
                // Approve workflow
                alert("त्रुटी दुरुस्त करून पुनः सादर केलेल्या सर्व कागदपत्रे / माहितीची पडताळणी योग्य आढळली आहे. त्यामुळे सदर अर्ज पुन्हा त्रुटी पूर्ततेसाठी परत पाठविता येणार नाही.");
            } else {
                const formData = new FormData(form);      
                formData.append('_csrfToken', $('meta[name="csrfToken"]').attr('content'));
                formData.append('_Token', $('meta[name="csrfToken"]').attr('content'));                
                $.ajax({
                    url: '<?= $this->Url->build(["controller" => "Utilities", "action" => "ng2gVerifyReturnedApplicationSubmission"]); ?>',
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
                            alert('Application Returneded to Sanstha successfully.');
                            $('#emp_row_' + return_app_id).remove();
                            $('#verifyReturnedApplicationSlider').removeClass('open').attr('aria-hidden', 'true');

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

                    
                    }
                });
                // Return for correction workflow
                //alert("त्रुटी दुरुस्त करून सादर केलेल्या काही कागदपत्रे / माहितीची पडताळणी अयोग्य असल्याचे आढळले आहे.");
            }

           
            
            
        }


       
        submitVerifyReturnedApproveApplication =  function (mode){
            const form = $('#verifyReturnedApplicationForm')[0];
            if (!form.checkValidity()) {
                form.reportValidity();
                return false;
            }

            const total = document.querySelectorAll('input[value="correct"]').length;
            const correct = document.querySelectorAll('input[value="correct"]:checked').length;
            

            

            if (mode == 1 && correct !== total) {
                // Approve workflow
                alert("त्रुटींची दुरुस्ती करून पुन: सादर केलेल्या कागदपत्रांची/माहितीची पडताळणी अयोग्य आढळल्यामुळे, सदर अर्ज मंजुरीसाठी पुढे पाठवता येणार नाही.");
                return false;
            } else {     
                const formData = new FormData(form);  
                formData.append('mode', mode);           
                if (mode == 2) {
                    formData.append('app_remark', $("#app_remark_1").val());
                    if ($("#app_doc_1")[0].files.length > 0) {
                        formData.append('app_doc', $("#app_doc_1")[0].files[0]);
                    }
                }
                  
                formData.append('_csrfToken', $('meta[name="csrfToken"]').attr('content'));
                formData.append('_Token', $('meta[name="csrfToken"]').attr('content'));                
                $.ajax({
                    url: '<?= $this->Url->build(["controller" => "deputydirector", "action" => "ng2gReturnedApproveTransfer"]); ?>',
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
                            alert('Application approved successfully.');
                            $('#emp_row_' + return_app_id).remove();
                            $('#verifyReturnedApplicationSlider').removeClass('open').attr('aria-hidden', 'true');

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

                    
                    }
                });
                // Return for correction workflow
                //alert("त्रुटी दुरुस्त करून सादर केलेल्या काही कागदपत्रे / माहितीची पडताळणी अयोग्य असल्याचे आढळले आहे.");
            }
            
        }
        submitVerifyReturnedRejectApplication =  function () {
            e.preventDefault();
            let formData = new FormData(this);
            let rejectId = $("#application_id").val();
            formData.append('ng2g_id', rejectId);

            formData.append('_csrfToken', $('meta[name="csrfToken"]').attr('content'));
            $.ajax({
                url: '<?= $this->Url->build(["controller" => "deputydirector", "action" => "ng2gRejectTransfer"]); ?>',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                },

                beforeSend: function () {

                    // Disable button
                    $('#rejectForm button[type="submit"]')
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
                        alert('Application rejected successfully.');                        
                        $('#emp_row_' + rejectId).remove();
                        $('#rejectApplicationSlider').removeClass('open').attr('aria-hidden', 'true');
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

                    // Enable button again
                    $('#rejectForm button[type="submit"]')
                        .prop('disabled', false)
                        .html(`
                            <i class="fas fa-times-circle me-1"></i>
                            नामंजूर करा
                        `);
                }
            });

        };


        /**
         * View Application Timeline
         * 
         */
        
        $(document).on('click', '.viewApplicationTimelines-open-transfer', function () {
            const caseId = $(this).data('id'); 
           
             

           $(document).trigger('viewApplicationTimelines:openSlider', [caseId]);
        });

        // Close slider
        $(document).on('click', '.viewApplicationTimelines-close-slider', function () {
            $(document).trigger('viewApplicationTimelines:closeSlider');
        });

        // Custom event handlers for Slider 2
        var return_app_id = 0 ;
        $(document).on('viewApplicationTimelines:openSlider', function (e, caseId) {
            return_app_id = caseId ;
            loadviewApplicationTimelinesDetails(caseId);
            $('#viewApplicationTimelinesSlider').addClass('open').attr('aria-hidden', 'false');
        });

        $(document).on('viewApplicationTimelines:closeSlider', function () {
            $('#viewApplicationTimelinesSlider').removeClass('open').attr('aria-hidden', 'true');
        });
       

       
        loadviewApplicationTimelinesDetails = function(caseId){
            $("#verifyReturnedHtmlForm").html('<div class="dots-loader"><img src="https://edustaff.maharashtra.gov.in/images/logo.png" alt="Maha Logo" class="me-2"> Loading</div>');
            $.ajax({
                url: '<?= $this->Url->build(["controller" => "Utilities", "action" => "ng2gViewApplicationTimelines"]); ?>/'+caseId,
                type: 'GET',
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                },
                    success: function (response) {
                        console.log("############################"+response);
                    if(response.success){
                      
                           
                            
                            $("#viewApplicationTimelinesForm").html(response.html);
                    }
                    
                },
                error: function () {
                    $("#verifyReturnedHtmlForm").html('<option>Error loading data</option>');
                }
            });
        }
       





});
</script>
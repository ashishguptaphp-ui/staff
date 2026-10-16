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


<style>
/* The actual timeline (the vertical ruler) */
.main-timeline {
  position: relative;
}

/* The actual timeline (the vertical ruler) */
.main-timeline::after {
  content: "";
  position: absolute;
  width: 6px;
  background-color: #939597;
  top: 0;
  bottom: 0;
  left: 50%;
  margin-left: -3px;
}

/* Container around content */
.timeline {
  position: relative;
  background-color: inherit;
  width: 50%;
}

/* The circles on the timeline */
.timeline::after {
  content: "";
  position: absolute;
  width: 25px;
  height: 25px;
  right: -13px;
  background-color: #939597;
  border: 5px solid #f5df4d;
  top: 15px;
  border-radius: 50%;
  z-index: 1;
}

/* Place the container to the left */
.left {
  padding: 0px 40px 20px 0px;
  left: 0;
}

/* Place the container to the right */
.right {
  padding: 0px 0px 20px 40px;
  left: 50%;
}

/* Add arrows to the left container (pointing right) */
.left::before {
  content: " ";
  position: absolute;
  top: 18px;
  z-index: 1;
  right: 30px;
  border: medium solid white;
  border-width: 10px 0 10px 10px;
  border-color: transparent transparent transparent white;
}

/* Add arrows to the right container (pointing left) */
.right::before {
  content: " ";
  position: absolute;
  top: 18px;
  z-index: 1;
  left: 30px;
  border: medium solid white;
  border-width: 10px 10px 10px 0;
  border-color: transparent white transparent transparent;
}

/* Fix the circle for containers on the right side */
.right::after {
  left: -12px;
}

/* Media queries - Responsive timeline on screens less than 600px wide */
@media screen and (max-width: 600px) {
  /* Place the timelime to the left */
  .main-timeline::after {
    left: 31px;
  }

  /* Full-width containers */
  .timeline {
    width: 100%;
    padding-left: 70px;
    padding-right: 25px;
  }

  /* Make sure that all arrows are pointing leftwards */
  .timeline::before {
    left: 60px;
    border: medium solid white;
    border-width: 10px 10px 10px 0;
    border-color: transparent white transparent transparent;
  }

  /* Make sure all circles are at the same spot */
  .left::after,
  .right::after {
    left: 18px;
  }

  .left::before {
    right: auto;
  }

  /* Make all right containers behave like the left ones */
  .right {
    left: 0%;
  }
}

.d-none {
    display: none !important;
}

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

                    $approvedLogDocument = $approvedLogDocuments[$post->soa_id] ?? null;
                    $approvedLogUrl = null;
                    if (!empty($approvedLogDocument)) {
                        $approvedLogUrl = preg_match('/^https?:\/\//i', $approvedLogDocument)
                            ? $approvedLogDocument
                            : $this->Url->build('/' . ltrim($approvedLogDocument, '/'));
                    }

                    if($post->post_type == 1){
                        continue;
                    }
                   
                ?>
                <tr>
                    <td><?= h($idx++) ?></td>
                   
                    <td>
                        <?= h($post->post_name) ?> <?php $post->status?>
                    </td>
                                     
                    <td>
                      
                        <?= h($post->school_name) ?>
                    </td>

                    <td id="actionBtns_<?= h($post->id) ?>">
                        <?php
                            if($post->is_onboarding_submitted == 1) {
                                                               
                            echo "<a href='#' style='text-decoration:none;' class='startApplication-open-onboarding' data-staffObject='". json_encode($post, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP)."' data-mode='1'  data-id='".$post->id."'>
                                <i class='fa-solid fa-address-card'></i>  अर्ज पहा
                            </a><br/>";

                             echo "<a href='" . h($approvedLogUrl ?? '#') . "' style='text-decoration:none;' target='_blank'" . ($approvedLogUrl ? '' : " onclick=\"return false;\"") . ">
                                <i class='fa-solid fa-reorder'></i>  आदेश
                            </a><br/>";

                             echo "<a href='#' style='text-decoration:none;' class='startApplicationHistory-open-view' data-staffObject='". json_encode($post, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP)."' data-mode='1'  data-id='".$post->id."'>
                                <i class='fa-solid fa-comments'></i>  टिप्पणी
                            </a><br/>";

                            /* echo "<a href='#' style='text-decoration:none;' class='forwardApplication-open-transfer' data-staffObject='". json_encode($post, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP)."' data-mode='1'  data-id='".$post->id."'>
                                <i class='fa-solid fa-address-card'></i>  शालार्थ साठी नस्ती वर्ग करा
                            </a><br/>";
                            */

                             if($post->status == 'Forwarded_dyd_dadi'){ 
                             echo "<a href='#' style='text-decoration:none;' class='approvedApplication-open-transfer' data-staffObject='". json_encode($post, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP)."' data-mode='1'  data-id='".$post->id."'>
                                <i class='fa-solid fa-arrow-trend-up'></i>  शालार्थ मंजूर
                            </a><br/>";
                              echo "<a href='#' style='text-decoration:none;' class='rejectApplication-open-transfer' data-staffObject='". json_encode($post, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP)."' data-mode='1'  data-id='".$post->id."'>
                                <i class='fa-solid fa-arrow-trend-down'></i>  शालार्थ नामंजूर
                            </a><br/>";
                             }

                             }else{
                                 echo "";
                            }                         
                        
                        ?>
                       
                         
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
       
</div>




<!-- Slide Panel -->
<div id="startApplicationonBoardingSlider" class="slide-panel" aria-hidden="true" style="border:3px solid #537895;">
     <!-- Header -->
    <div class="slide-header d-flex justify-content-between align-items-center">
        <div style="width:100%;">
            <h5 class="mb-0"><i class="fas fa-arrow-trend-up me-1"></i> Staff Onboarding View </h5>
            <!--<small class="text-muted">Case ID: <span id="caseId"></span></small>-->
            
           
        </div>
        <button class="btn btn-sm btn-outline-danger startApplicationonBoarding-close-slider">X</button>
    </div>

    <!-- Body -->
    <div class="slide-body">
        <div class="form-container">
            <div id="saStep1">
                <form id="saFormStep1" enctype="multipart/form-data">
                    <input type="hidden" id="sa_basic_data">
                   
                    <input type="hidden" value="" name="staffId" id="staffId">
                    <div class="section">
                        <div class="section-title">👤 <span id="empNameDetails"></span></div>
                        <input type="hidden" id="appointmentDate" name="appointmentDate" class="form-control">
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <label for="institutionCode" class="form-label marathi-label">संस्था कोड <span class="english-label">(Institution Code)</span> &rarr; <span class="txtval"><?= h($user["username"]) ?></span></label>                            
                            </div>
                            <div class="col-md-6">                            
                                <label for="institutionName" class="form-label marathi-label">संस्थेचे नाव <span class="english-label">(Institution Name)</span> &rarr; <span class="txtval" id="institutionName_onboard"></span></label> 
                            </div>
                             <div class="col-md-3" id="minoritySanstha_onboard">                            
                               
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <label for="udiseNumber" class="form-label marathi-label">UDISE क्रमांक 
                                <span class="english-label">(UDISE Code)</span> &rarr; <span class="txtval" id="udiseNumber_onboard">  
                                    </span></label> 
                        </div>
                    
                        <div class="col-md-9">
                            <label for="schoolName" class="form-label marathi-label">शाळेचे नाव 
                                <span class="english-label">(School Name)</span> &rarr; <span class="txtval" id="schoolName_onboard"></span></label> 
                        </div>                  
                        
                       
                    </div>
                                 
                   <div id="htmldiv_onboard"></div> 

                    <div class="card">
                        <label class="checkbox-label">
                        <label class="checkbox-label">
                            या प्रकरणासंदर्भात कोणताही न्यायालयीन आदेश निर्गमित झाला आहे का?  &rarr;
                            </label>
                            <div id="orderCourtRoster_onboard">
                                       
                                    </div>
                        
                        </label>
                        
                        <div id="orderCourtRosterDiv_onbord" class="">                        
                            <div class="row mb-3">     
                                <div class="col-md-3">                            
                                        <input type="text" placeholder="याचिका क्रमांक" class="form-control" id="courtOrderPetitionNumber_onboard" name="courtOrderPetitionNumber" readonly>
                               </div>  
                                <div class="col-md-3">                                    
                                        <input type="date" placeholder="दिनांक" class="form-control" id="courtOrderDate_onboard" name="courtOrderDate" readonly>
                                </div>                
                                <div class="col-md-6">
                                    <div id="courtOrder_onboard_file">
                                        <a>View Document</a>
                                    </div>
                                </div>
                            </div>                    
                        </div>
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
                <button class="btn btn-danger btn-sm startApplicationonBoarding-close-slider">Close</button>
            </div>
            
        </div>
    </div>

</div>

<?php echo $this->element('recruit/division/forword') ?>

<?php echo $this->element('recruit/division/approved') ?>

<?php echo $this->element('recruit/division/reject') ?>

<?php echo $this->element('recruit/division/comment') ?>


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
    function readStaffObjectFromAttributes($element) {
        const candidateNames = ['data-staffObject', 'data-staff'];

        for (const attributeName of candidateNames) {
            const rawValue = $element.attr(attributeName);
            if (!rawValue || rawValue === 'undefined' || rawValue === 'null') {
                continue;
            }

            try {
                const parsedValue = JSON.parse(rawValue);
                if (parsedValue && typeof parsedValue === 'object') {
                    return parsedValue;
                }
            } catch (error) {
                // Ignore malformed JSON and keep checking next attribute.
            }
        }

        return {};
    }

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
            const staffObject = readStaffObjectFromAttributes($(this));
            if (!staffObject || !staffObject.id) {
                console.warn('Missing staff payload for onboarding action');
                return;
            }
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
        url: '<?= $this->Url->build(["controller" => "GeneralUtilities", "action" => "getStaffOnboardingDetails"]); ?>' + '?staff_id=' + encodeURIComponent(staffId),
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
           
            $('#candidateName_onboard').val(d.candidate_name || '');
            $('#appointmentDate_onboard').val(d.appointment_date || '');
            $('#panNumber_onboard').val(d.pan_number || '');
            $('#aadharNumber_onboard').val(d.aadhar_number || '');
            $('#courtOrderPetitionNumber_onboard').val(d.court_order_petition_number || '');
            $('#courtOrderDate_onboard').val(d.court_order_date || '');
            $('#institutionName_onboard').text(d.ng2g.institution_name || '');
            document.getElementById("minoritySanstha_onboard").innerHTML = d.minority_status;

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
                        View Document
                    </a>
                `);
            } else {
                $(targetId).html('<span class="text-muted">Document not available</span>');
            }
        };


            renderDocumentLink('ssc', '#ssc_onboard_file');
            renderDocumentLink('hsc', '#hsc_onboard_file');
            renderDocumentLink('graduate', '#graduate_onboard_file');
            renderDocumentLink('post_graduate', '#post_graduate_onboard_file'); 
            renderDocumentLink('adv_approval', '#adv_approval_onboard_file'); 
            renderDocumentLink('advertisement', '#advertisement_onboard_file');                        
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
            const staffObject = readStaffObjectFromAttributes($(this));
            if (!staffObject || !staffObject.id) {
                console.warn('Missing staff payload for transfer action');
                return;
            }
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
            const staffObject = readStaffObjectFromAttributes($(this));
            if (!staffObject || !staffObject.id) {
                console.warn('Missing staff payload for correction action');
                return;
            }
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
                url: '',
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
                url: '',
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

/**    */

$(document).ready(function() {  

 $(document).on('click', '.rejectApplication-open-transfer', function () {
          
            const caseId = $(this).data('id');    
            let staff = $(this).data('staffobject');
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




         $(document).on('click', '.approveApplication-open-transfer', function () {
            
            const caseId = $(this).data('id');    
            let staff = $(this).data('staffobject');
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


         loadApproveTransferDetails = function(caseId,staff){                    
           
             
           
            loadSaDetails(staff.id,'approve');                        

           
        }

     loadRejectTransferDetails = function(caseId,staff){

                $("#rejectHtmlForm").html('<div class="dots-loader"><img src="https://edustaff.maharashtra.gov.in/images/logo.png" alt="Maha Logo" class="me-2"> Loading</div>');
            $.ajax({
                url: '<?php echo $this->Url->build(["controller" => "GeneralUtilities", "action" => "rejectApplicationForm"]); ?>/'+caseId,
                type: 'GET',
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                },
                    success: function (response) {
                        
                    if(response.success){
                        //if(response.data.id>0){
                            ng2g = response.data;
                            $("#rejectHtmlForm").html(response.html);
                           
                        //}                       
                    }
                    
                },
                error: function () {
                    $("#rejectHtmlForm").html('<option>Error loading data</option>');
                }
            });
           
            
        }


        loadSaDetails = function(staffId,type){
                $.ajax({
                url: '<?= $this->Url->build(["controller" => "GeneralUtilities", "action" => "getStaffOnboardingDetails"]); ?>' + '?staff_id=' + encodeURIComponent(staffId),
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
                    console.log("Staff Onboarding Details:", d);
                     let dbTimestamp = d.created_at;           
                     let date = new Date(dbTimestamp);
                     let formattedDate =
                        String(date.getDate()).padStart(2, '0') + '/' +
                        String(date.getMonth() + 1).padStart(2, '0') + '/' +
                        date.getFullYear();

                    if(type == 'reject'){  
                        $("#reject_sanstha_name").html(d.ng2g.institution_name);
                        $("#reject_staff_name").html(d.candidate_name);
                        $("#reject_date").html(formattedDate);
                        $("#reject_id").html(d.id);
                        $("#reject_year").html(date.getFullYear());
                    }else{
                        $("#app_sanstha_name").html(d.ng2g.institution_name); 
                        $("#app_staff_name").html(d.candidate_name); 
                        $("#app_date").html(formattedDate); 
                        $("#app_id").html(d.id); 
                        $("#app_year").html(date.getFullYear());
                    }
       

                }
            });
    }


     $('#rejectForm').on('submit', function (e) {

            e.preventDefault();
            let formData = new FormData(this);
            let rejectId = $("#reject_id").text().trim();
            formData.append('reject_id', rejectId);
            formData.append('action', 'reject');

            formData.append('_csrfToken', $('meta[name="csrfToken"]').attr('content'));
            $.ajax({
                url: '<?= $this->Url->build(["controller" => "DistrictClerk", "action" => "staffOnboardReject"]); ?>',
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
                        location.reload();
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

          $('#approvalForm').on('submit', function (e) {

            e.preventDefault();
            let formData = new FormData(this);
            let approvalId = $("#approved_id").text().trim();
            formData.append('app_id', approvalId);
            formData.append('action', 'approve');

            formData.append('_csrfToken', $('meta[name="csrfToken"]').attr('content'));
            console.log(formData);
            $.ajax({
                url: '<?= $this->Url->build(["controller" => "Division", "action" => "staffOnboardApprove"]); ?>',
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
                        location.reload();
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

         formatDate = function (dateStr) {
            if (!dateStr) return "";

            let parts = dateStr.split("-");
            if (parts.length !== 3) return dateStr;

            return parts[2] + "-" + parts[1] + "-" + parts[0];
        }


         $(document).on('click', '.startApplicationHistory-open-view', function () {

            const caseId = $(this).data('id');
            let staffJson = $(this).attr('data-staffObject');   // raw JSON string
            let staffObject   = JSON.parse(staffJson)
            currentMode = $(this).attr('data-mode'); 
            currentAppId = staffObject.id; 
           
            $('#saStep12').show();
            $('#sa_footerBox').show();
            $('#sa_footerMsgBox').hide();    

           $(document).trigger('startApplicationHistory:openSlider', [caseId, staffObject]);
        

        });  

          // Close slider
        // Close slider
        $(document).on('click', '.startApplicationHistory-close-slider', function () {
            $(document).trigger('startApplicationHistory:closeSlider');
        });

        // Custom event handlers for Slider 2
        $(document).on('startApplicationHistory:openSlider', function (e, caseId, staffObject) {
            loadReturnHistoryDetails(caseId, staffObject);
            $('#startApplicationHistorySlider').addClass('open').attr('aria-hidden', 'false');
        });

        $(document).on('startApplicationHistory:closeSlider', function () {
            $('#startApplicationHistorySlider').removeClass('open').attr('aria-hidden', 'true');
        });



        loadReturnHistoryDetails = function(caseId,staffObject){
                  
        var staffObject = staffObject;
        console.log(staffObject);
         var formData = new FormData();
         formData.append('post_id', staffObject.is_onboarding_submitted);

            $.ajax({
                url: '<?= $this->Url->build(["prefix" => "Recruit","controller" => "GeneralUtilities", "action" => "getStaffonBoardingHistory"]); ?>',
                type: 'Post',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                },
                    success: function (response) {
                    if(response.success){
                           
                            document.getElementById("saTimelineContainer").innerHTML = response.data.auditLogsHistory || '<div class="timeline-item left"><div class="card"><div class="card-body p-4"><h3 class="text-center">No audit history found.</h3></div></div></div>';                          
                    }                    
                },
                error: function () {
                    $("#returnHtmlForm").html('<option>Error loading data</option>');
                }
            });
        }


         $(document).on('click', '.approvedApplication-open-transfer', function () {
            
            const caseId = $(this).data('id');    
            let staff = $(this).data('staffobject');
            $(document).trigger('approvedApplication:openSlider', [caseId, staff]);
        });

        // Close slider
        $(document).on('click', '.approvedApplication-close-slider', function () {
            $(document).trigger('approvedApplication:closeSlider');
        });

        // Custom event handlers for Slider 2
        $(document).on('approvedApplication:openSlider', function (e, caseId,staff) {
            loadApprovedTransferDetails(caseId,staff);
            $('#approvedApplicationSlider').addClass('open').attr('aria-hidden', 'false');
        });

        $(document).on('approvedApplication:closeSlider', function () {
            $('#approvedApplicationSlider').removeClass('open').attr('aria-hidden', 'true');
        });


          loadApprovedTransferDetails = function(caseId,staff){                    
           
            loadSaDetails(staff.id,'approve');                        

           
        }


         loadSaDetails = function(staffId,type){
                $.ajax({
                url: '<?= $this->Url->build(["controller" => "GeneralUtilities", "action" => "getStaffOnboardingDetails"]); ?>' + '?staff_id=' + encodeURIComponent(staffId),
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
                    console.log("Staff Onboarding Details:", d);
                     let dbTimestamp = d.created_at;           
                     let date = new Date(dbTimestamp);
                     let formattedDate =
                        String(date.getDate()).padStart(2, '0') + '/' +
                        String(date.getMonth() + 1).padStart(2, '0') + '/' +
                        date.getFullYear();

                    if(type == 'reject'){  
                        $("#reject_sanstha_name").html(d.ng2g.institution_name);
                        $("#reject_staff_name").html(d.candidate_name);
                        $("#reject_date").html(formattedDate);
                        $("#reject_id").html(d.id);
                        $("#reject_year").html(date.getFullYear());
                    }else if(type =='approve'){    
                         $("#approved_sanstha_name").html(d.ng2g.institution_name); 
                        $("#approved_staff_name").html(d.candidate_name); 
                        $("#approved_date").html(formattedDate); 
                        $("#approved_id").html(d.id); 
                        $("#approved_year").html(date.getFullYear());
                    }else{
                        $("#app_sanstha_name").html(d.ng2g.institution_name); 
                        $("#app_staff_name").html(d.candidate_name); 
                        $("#app_date").html(formattedDate); 
                        $("#app_id").html(d.id); 
                        $("#app_year").html(date.getFullYear());
                    }
       

                }
            });
    }


      $('#rejectForm').on('submit', function (e) {

            e.preventDefault();
            let formData = new FormData(this);
            let rejectId = $("#reject_id").text().trim();
            $('#reject_form_id').val(rejectId);
            $('#reject_form_remark').val( ($('#reject_remark').val() || '').trim());
            formData = new FormData(this);
            $.ajax({
                url: '<?= $this->Url->build(["controller" => "Division", "action" => "staffOnboardReject"]); ?>',
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
                        location.reload();
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



        


         submitRejectApplication =  function (){
            const form = $('#rejectApplicationForm')[0];

          
            if (!form.checkValidity()) {
                form.reportValidity();
                return false;
            }

            const formData = new FormData(form);

            formData.append('_csrfToken', $('meta[name="csrfToken"]').attr('content'));
            formData.append('_Token', $('meta[name="csrfToken"]').attr('content'));
            console.log(Object.fromEntries(formData));
            
           $.ajax({
                url: '<?= $this->Url->build(["controller" => "Division", "action" => "staffOnboardReject"]); ?>',
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
                        alert('Application Reject successfully.');
                        $('#rejectApplicationSlider').removeClass('open').attr('aria-hidden', 'true');
                        location.reload();

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


         $(document).on('click', '.forwardApplication-open-transfer', function () {
            
            const caseId = $(this).data('id');    
            let staff = $(this).data('staffobject');
            $(document).trigger('forwardApplication:openSlider', [caseId, staff]);
        });

        // Close slider
        $(document).on('click', '.forwardApplication-close-slider', function () {
            $(document).trigger('forwardApplication:closeSlider');
        });

        // Custom event handlers for Slider 2
        $(document).on('forwardApplication:openSlider', function (e, caseId,staff) {
            loadForwardTransferDetails(caseId,staff);
            $('#forwardApplicationSlider').addClass('open').attr('aria-hidden', 'false');
        });

        $(document).on('forwardApplication:closeSlider', function () {
            $('#forwardApplicationSlider').removeClass('open').attr('aria-hidden', 'true');
        });


         loadForwardTransferDetails = function(caseId,staff){                    
             
           
            loadplDetails(staff.id,'forword');                        

           
        }


        loadplDetails = function(staffId,type){
                $.ajax({
                url: '<?= $this->Url->build(["controller" => "GeneralUtilities", "action" => "getStaffOnboardingDetails"]); ?>' + '?staff_id=' + encodeURIComponent(staffId),
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
                    console.log("Staff Onboarding Details:", d);
                     let dbTimestamp = d.created_at;           
                     let date = new Date(dbTimestamp);
                     let formattedDate =
                        String(date.getDate()).padStart(2, '0') + '/' +
                        String(date.getMonth() + 1).padStart(2, '0') + '/' +
                        date.getFullYear();

                    if(type == 'reject'){  
                        $("#reject_sanstha_name").html(d.ng2g.institution_name);
                        $("#reject_staff_name").html(d.candidate_name);
                        $("#reject_date").html(formattedDate);
                        $("#reject_id").html(d.id);
                        $("#reject_year").html(date.getFullYear());
                    }else{
                        $("#app_sanstha_name").html(d.ng2g.institution_name); 
                        $("#app_staff_name").html(d.candidate_name); 
                        $("#app_date").html(formattedDate); 
                        $("#app_id").html(d.id); 
                        $("#app_year").html(date.getFullYear());
                    }
       

                }
            });
    }





    $('#forwardForm').on('submit', function (e) {

            e.preventDefault();
            let formData = new FormData(this);
            let forwardId = $("#app_id").text().trim();
            formData.append('app_id', forwardId);
            formData.append('action', 'forward');

            formData.append('_csrfToken', $('meta[name="csrfToken"]').attr('content'));
            $.ajax({
                url: '<?= $this->Url->build(["controller" => "Division", "action" => "staffOnboardForward"]); ?>',
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
                    $('#forwardForm button[type="submit"]')
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
                        // Optional
                        $('#forwardForm')[0].reset();
                        let forwardId = $("#app_id").text().trim();
                        $('#emp_row_' + forwardId).remove();
                        $('#forwardApplicationSlider').removeClass('open').attr('aria-hidden', 'true');
                        location.reload();
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
                    $('#forwardForm button[type="submit"]')
                        .prop('disabled', false)
                        .html(`
                            <i class="fas fa-times-circle me-1"></i>
                            नामंजूर करा
                        `);
                }
            });

        });



        


});


$(document).ready(function() {  

                                 
$('#workOrderBtn').on('click', function (e) {

            e.preventDefault();
            const form = $(this).closest('form')[0];

            if (!form) {
                console.error('Form not found');
                return;
            }

            let formData = new FormData(form);
            let approvalId = $("#approved_id").text().trim();
            $('#approve_form_id').val(approvalId);
            $('#approve_form_remark').val( ($('#approved_remark').val() || '').trim());
            formData = new FormData(form);
            $.ajax({
                url: '<?= $this->Url->build(["controller" => "Division", "action" => "staffOnboardGenrateFile"]); ?>',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                },

                beforeSend: function () {

                  $('#workOrderBtn')
                        .prop('disabled', true)
                        .html(`
                            <span class="spinner-border spinner-border-sm me-1"></span>
                            Processing...
                        `);
                },

                success: function (response) {

                    if(response.success == false){
                        alert(response.message)
                    }else{
                      
                        let pdfUrl = response && response.url ? response.url : '';
                        let staffId = response && response.staffId ? response.staffId : '';
                       
                         pdfUrlToBase64(
                                pdfUrl
                            ).then(base64 => {
                                $("#pdfData").val(base64);
                                console.log(base64);
                            }).catch(console.error);

                       if (pdfUrl) {
                            const $orderContainer = $('<div>', {
                                class: 'mt-3 p-3 border rounded bg-light'
                            });
                            $orderContainer.append($('<div>', {
                                class: 'fw-bold mb-2',
                                text: 'Work Order PDF'
                            }));
                            $orderContainer.append($('<a>', {
                                href: pdfUrl,
                                target: '_blank',
                                rel: 'noopener noreferrer',
                                class: 'btn btn-sm btn-primary',
                                id: 'ViewPDFBtn',
                                text: 'View PDF'
                            }).attr('download', `staff_order_${staffId}.pdf`));
                            $orderContainer.append($('<button>', {
                                type: 'button',
                                class: 'btn btn-danger btn-sm signDocBtn ms-2',
                                id: 'signDocBtn',
                                text: 'Sign DSC'
                            }).attr({
                                'data-staff-id': staffId,
                                'data-pdf-url': pdfUrl
                            }));
                            $('#workOrderFile').empty().append($orderContainer);
                        }

                        $('#workOrderBtn').hide();

                        

                       
                    }                    
                },

                error: function (xhr) {

                    
                    console.log(xhr);

                    $('#workOrderBtn')
                        .prop('disabled', false)
                        .show()
                        .html(`
                            <i class="fas fa-check-circle me-1"></i>
                            वर्क ऑर्डर तयार करा
                        `);

                    let errorMessage = 'Something went wrong.';

                    if (xhr.responseJSON?.message) {
                        errorMessage = xhr.responseJSON.message;
                    }

                    alert(errorMessage);
                },

                complete: function () {}
            });

        });

        
 async function pdfUrlToBase64(url) {
    const response = await fetch(url);

    if (!response.ok) {
        throw new Error("Unable to fetch PDF");
    }

    const blob = await response.blob();

    return new Promise((resolve, reject) => {
        const reader = new FileReader();

        reader.onload = () => {
            resolve(reader.result.split(",")[1]);
        };

        reader.onerror = reject;

        reader.readAsDataURL(blob);
    });
}


});
</script>

<script src="<?= h($this->Url->build('/js/dscapi-conf.js')) ?>?v=<?= (int)filemtime(WWW_ROOT . 'js' . DS . 'dscapi-conf.js') ?>"></script>
<script src="<?= h($this->Url->build('/js/dsc-signer.js')) ?>?v=<?= (int)filemtime(WWW_ROOT . 'js' . DS . 'dsc-signer.js') ?>"></script>

<div id="panel" style="display:none;"></div>
<input type="hidden" id="signingReason" value="Staff onboarding work order approval">
<input type="hidden" id="signingLocation" value="District Office">
<input type="hidden" id="tsaURL" value="">
<input type="hidden" id="timeServerURL" value="">
<input type="hidden" id="stampingX" value="300">
<input type="hidden" id="stampingY" value="50">
<script>

 $(document).ready(function() {
    
var initConfig = {
        "preSignCallback" : function() {
            // do something 
            // based on the return sign will be invoked
            return true;
        },
        "postSignCallback" : function(alias, sign, key) {
            $('#signedPdfData').val(sign);
            $('#lblEncryptedKey').val(key);
            // Implement signed pdf upload and pdf Download here
            var requestData = {
                action : "DECRYPT",
                en_sig : sign,
                ek : key
            };
            console.log('Request Data for Decryption:', requestData);
            $
                    .ajax(
                            {
                                url : dscapibaseurl + "/pdfsignature",
                                type : "post",
                                dataType : "json",
                                contentType : 'application/json',
                                data : JSON.stringify(requestData),
                                async : false
                            })
                    .done(
                            function(data) {
                                console.log('Decryption Response:', data);
                                if (data.status_cd == 1) {
                                    //get data.data -> decode base64 -> get json->check status == SUCCESS
                                    //get data.data.sig -> add pdf header and append to link
                                    var jsonData = JSON.parse(atob(data.data));
                                    if (jsonData.status === "SUCCESS") {
                                        
                                        //Set Class to download link
                                        $('#downloadDiv').addClass('btn btn-info');
                                        //get pdf data
                                        var pdfData = jsonData.sig;
                                        var dlnk = document.getElementById('downloadDiv');
                                        dlnk.href = 'data:application/pdf;base64,'+ pdfData;
                                        $("#downloadDiv").text("Download Signed PDF File");
                                        $('#approvedBtn').prop('disabled', false).removeClass('d-none');
                                        $('#ViewPDFBtn').prop('disabled', true).addClass('d-none');
                                        $('#signDocBtn').prop('disabled', true).addClass('d-none');
           

                                    } else {
                                        alert(jsonData.message || "The PDF decryption service did not return SUCCESS.");
                                    }

                                } else {
                                    var apiError = data.error || {};
                                    var errorMessage = apiError.message || data.message
                                        || "Decryption failed (status code: " + data.status_cd
                                        + ", error code: " + (apiError.error_cd || "unknown") + ").";
                                    alert(errorMessage);
                                    return false;

                                }
                            }).fail(
                            function(jqXHR, textStatus,
                                    errorThrown) {
                                alert(textStatus);
                            });
        },
        signType : 'pdf',
        mode : 'nostampingv2'
    //"certificateSno" : 13705892,
    };

    dscSigner.configure(initConfig);

    $(document).on('click', '#signDocBtn', function (e) {
    e.preventDefault();
        var data = $("#pdfData").val();
        console.log('PDF Data Length:', data ? data.length : 0);
        if (data != null || data != '') {
            dscSigner.sign(data);

           /* $('#downloadDiv').addClass('btn btn-info');
            var pdfData = 'test';
            var dlnk = document.getElementById('downloadDiv');
            dlnk.href = 'data:application/pdf;base64,'+ pdfData;
            $("#downloadDiv").text("Download Signed PDF File");
            $('#approvedBtn').prop('disabled', false).removeClass('d-none');
            $('#ViewPDFBtn').prop('disabled', true).addClass('d-none');
            $('#signDocBtn').prop('disabled', true).addClass('d-none');
            */
        }
    });


 

							
    });



</script>


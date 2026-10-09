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
        top: 0%;
        right: -100%;
        width: 45%;
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


<h5 style="margin:0px;padding:10px; color: #1a237e; border-bottom: 2px solid #1a237e;">
       
        🔜👨‍💼 Pending Individual Approvals / प्रलंबित वैयक्तिक मान्यता
      
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
                        
                            
                                echo "<button class='btn btn-primary badge bg-success text-light action-ud im-open-transfer' data-mode='1' data-staffObject='". json_encode($staff, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ."' data-id='NGG-2025-001'>
                                        <i class='fa-solid fa-arrow-trend-up'></i> Verify Now / सत्यापित करा
                                    </button>";
                           
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
                <div class="row">                    
                    <div class="col-md-12">
                        <label for="im_empName" class="form-label marathi-label">शिक्षक/कर्मचारी
                            <span class="english-label">(Teacher/Staff): </span><span class="english-label" id="im_empName"></span></label>
                        
                    </div> 

                    <div class="col-md-12">
                        <label for="im_outwardNumber" class="form-label marathi-label">जावक क्रमांक 
                            <span class="english-label">(Outward Number): </span> 
                            <span class="english-label" id="im_outwardNumber"></span>
                        </label>    
                    </div> 

                    <div class="col-md-12">
                        <label for="im_date" class="form-label marathi-label">दिनांक 
                            <span class="english-label">(Date): </span>
                            <span class="english-label" id="im_date"></span>
                        </label>

                    </div> 
                    <div class="col-md-12 mb-4">
                        <label for="im_doc" class="form-label marathi-label">वैयक्तिक मान्यता <span class="english-label">(Personal Recognition Document)</span>
                         <a href="#" class="file-upload-area" id="im_doc" target="_blank" Tooltip="Preview Document">
                                    <i class="fa fa-eye" title="View Document"></i> View
                                </a>
                        </label>
                        

                    </div> 
<!--
                    <div class="col-md-12 mb-2">
                        <label for="im_outwardNumber" class="form-label marathi-label">वैयक्तिक मान्यता आदेशावरील जावक क्रमांकाची पडताळणी करण्यासाठी नगर पालिकेकडे पाठवायचा का?</label>
                        
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" 
                                type="radio" 
                                name="im_outward_fwd_np" 
                                id="im_outward_fwd_np_yes" 
                                value="1">
                            <label style1="display:inline" class="form-check-label form-check-inline" for="im_outward_fwd_np_yes"> होय/Yes</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" 
                                type="radio" 
                                name="im_outward_fwd_np" 
                                id="im_outward_fwd_np_no" 
                                value="0">
                            <label class="form-check-label form-check-inline" for="im_outward_fwd_np_no"> नाही/No</label>
                        </div>

                    </div> 
                    <div id="matchBox" style="display:none;">-->
                    <div class="col-md-12 mb-4">
                        <label for="im_outward_match" class="form-label marathi-label">वैयक्तिक मान्यता आदेशावरील जावक क्रमांक कार्यालयातील जावक नोंदवहीशी जुळतो का?</label>
                        
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" 
                                type="radio" 
                                name="im_outward_match" 
                                id="im_outward_match_yes" 
                                value="1">
                            <label style1="display:inline" class="form-check-label form-check-inline" for="im_outward_match_yes"> होय/Yes</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" 
                                type="radio" 
                                name="im_outward_match" 
                                id="im_outward_match_no" 
                                value="0">
                            <label class="form-check-label form-check-inline" for="im_outward_match_no"> नाही/No</label>
                        </div>

                    </div> 

                    <div class="col-md-12 mb-4">
                        <label for="im_doc" class="form-label marathi-label">शेरा  <span class="english-label">(Remark)</span>
                         <textarea rows="3"
                               
                                name="im_outward_matchremark" 
                                id="im_outward_matchremark" 
                                ></textarea>
                        

                    </div> 
                    
                    <!--</div> 
                    <div class="col-md-12 mb-2">
                        <label for="im_outwardNumber" class="form-label marathi-label">जावक क्रमांक <span class="english-label">(Outward Number)</span></label>
                        
                        <input type="text" class="form-control form-control-sm" id="im_outwardNumber" name="im_outwardNumber" required>

                    </div> 

                        <div class="col-md-12 mb-2">
                        <label for="im_date" class="form-label marathi-label">दिनांक <span class="english-label">(Date)</span></label>
                        
                        <input type="date" class="form-control form-control-sm" id="im_date" name="im_date" required>

                    </div> 
                    <div class="col-md-12 mb-4">
                        <label for="im_doc" class="form-label marathi-label">वैयक्तिक मान्यता <span class="english-label">(Personal Recognition Document)</span></label>
                        
                        <input type="file" class="form-control form-control-sm" id="im_doc" name="im_doc" accept=".pdf" required>

                    </div> 
                    -->

                        <div class="col-md-12" style="text-align: center;">

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
<div id="transferSlider" class="slide-panel" aria-hidden="true" style="border:3px solid #537895;">

    <!-- Header -->
    <div class="slide-header d-flex justify-content-between align-items-center">
        <div style="width:100%;">
            <h5 class="mb-0"><i class="fas fa-arrow-trend-up me-1"></i> Non-Grant → Grant Aided Transfer <div class="text-muted" style="float:right;color:#fff !important;font-size:12px;margin-right:50px;">Staff Name: <span id="empName"></span></div></h5>
            <!--<small class="text-muted">Case ID: <span id="caseId"></span></small>-->
            
           
        </div>
        <button class="btn btn-sm btn-outline-danger js-close-slider">X</button>
    </div>

    <!-- Body -->
    <div class="slide-body">
        <div class="form-container">
                    <!-- 1.1 संस्थेचे नाव -->
                    <div class="row mb-2">
                         <div class="col-md-3">
                            <label for="institutionCode" class="form-label marathi-label">संस्था कोड <span class="english-label">(Institution Code)</span> &rarr; <span class="txtval" id="institutionCode"></span></label>                            
                        </div>
                        <div class="col-md-9">                            
                            <label for="institutionName" class="form-label marathi-label">संस्थेचे नाव <span class="english-label">(Institution Name)</span> &rarr; <span class="txtval" id="institutionName"></span></label> 
                        </div>
                    </div>

                    <!-- 1.1 शाळेचे नाव -->
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <label for="udiseNumber" class="form-label marathi-label">UDISE क्रमांक <span class="english-label">(UDISE Code)</span> &rarr; <span class="txtval" id="udiseNumber"></span></label> 
                        </div>
                    
                    
                        <div class="col-md-9">
                            <label for="schoolName" class="form-label marathi-label">शाळेचे नाव <span class="english-label">(School Name)</span> &rarr; <span class="txtval" id="schoolName"></span></label> 
                        </div>                  
                        
                        <!-- 1.1 शाळेचे ठिकाण -->
                        <div class="col-md-12">
                            <label for="schoolLocation" class="form-label marathi-label">शाळेचे ठिकाण <span class="english-label">(School Location)</span> &rarr; <span class="txtval" id="schoolLocation"></span></label> 
                        </div>
                    </div>
                    
                    <!-- Employee Details Row -->
                    <div class="row">
                        <div class="col-md-6">
                            <label for="employeeName" class="form-label marathi-label">कर्मचाऱ्याचे नाव <span class="english-label">(Teacher Name)</span> &rarr; <span class="txtval" id="employeeName"></span></label>
                        </div>
                        <div class="col-md-3">
                            <label for="designation" class="form-label marathi-label">पदनाम <span class="english-label">(Designation)</span> &rarr; <span class="txtval" id="designation"></span></label>
                        </div>
                        <div class="col-md-3">
                            <label for="salaryGrade" class="form-label marathi-label">वेतनश्रेणी <span class="english-label">(Salary Grade)</span> &rarr; <span class="txtval" id="salaryGrade"></span></label>
                        </div>
                    </div>
                    
                    <!-- 1.4 अध्यापन विषय -->
                    <div class="row">
                        <div class="col-md-6">
                            <label for="teachingSubject" class="form-label marathi-label">अध्यापन विषय <span class="english-label">(Teaching Subjects)</span> &rarr; <span class="txtval" id="teachingSubject"></span></label>
                        </div>
                        <!-- 1.5 अध्यापन वर्ग -->
                        <div class="col-md-6">
                            <label class="form-label marathi-label">अध्यापन वर्ग <span class="english-label">(Teaching Classes)</span> &rarr; <span class="txtval" id="teachingClasses"></span></label>                           
                        </div>
                    </div>
                    
                    
                    <!-- Additional Details Row -->
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <label for="originalCategory" class="form-label marathi-label">मूळ आरक्षण प्रवर्ग <span class="english-label">(Original)</span> &rarr; <span class="txtval" id="originalCategory"></span></label>
                            
                        </div>
                        <div class="col-md-3">
                            <label for="appointmentCategory" class="form-label marathi-label">नियुक्तीचा प्रवर्ग <span class="english-label">(Appointment)</span> &rarr; <span class="txtval" id="appointmentCategory"></span></label>                           
                        </div>
                        <div class="col-md-3">
                            <label for="panNumber" class="form-label marathi-label">पॅन क्रमांक <span class="english-label">(PAN)</span> &rarr; <span class="txtval" id="panNumber"></span></label>
                        </div>
                         <!-- 1.9 आधार क्रमांक -->
                          <div class="col-md-3">
                            <label for="aadharNumber" class="form-label marathi-label">आधार क्रमांक <span class="english-label">(Aadhar)</span> &rarr; <span class="txtval" id="aadharNumber"></span></label>
                            
                        </div>
                    </div>
                    
                   
                    <!-- Section 3: शाळा परवानगी -->
                    <div class="pdf-field">
                        <h3 class="section-title">शाळा परवानगी आदेश माहिती</h3>                      
                       
                        <div class="row">
                            <div class="col-md-5">
                                <label for="schoolPermissionOrderNumber" class="form-label marathi-label">आदेश क्रमांक <span class="english-label">(Order No.)</span> &rarr; <span class="txtval" id="schoolPermissionOrderNumber"></span></label>
                            </div>
                             <div class="col-md-5">
                                <label for="schoolPermissionOrderDate" class="form-label marathi-label">दिनांक <span class="english-label">(Date)</span> &rarr; <span class="txtval" id="schoolPermissionOrderDate"></span></label>

                            </div>
                            <div class="col-md-2"> 
                                <a href="#" class="file-upload-area" id="schoolPermissionOrderFile" target="_blank" Tooltip="Preview Document">
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
                                <label for="minorityCertOutwardNumber" class="form-label marathi-label">जावक क्रमांक <span class="english-label">(Outward No.)</span> &rarr; <span class="txtval" id="minorityCertOutwardNumber"></span></label>
                            </div>
                            <div class="col-md-5">
                                <label for="minorityCertOutwardDate" class="form-label marathi-label">दिनांक <span class="english-label">(Date)</span> &rarr; <span class="txtval" id="minorityCertOutwardDate"></span></label>
                            </div>

                            <div class="col-md-2"> 
                                <a href="#" class="file-upload-area" id="minorityCertOutwardFile" target="_blank" Tooltip="Preview Document">
                                    <i class="fa fa-eye" title="View Document"></i> View
                                </a>
                            </div>                            
                        </div> 
                    </div>

                    <div class="pdf-field">
                        <h3 class="section-title">बदलीने रुजू होणाऱ्या शाळेची माहिती</h3>                        
                        <div class="row">
                            <div class="col-md-3">
                                <label for="udiseNumberAtTransfer" class="form-label marathi-label">UDISE क्रमांक <span class="english-label">(UDISE Number)</span> &rarr; <span class="txtval" id="udiseNumberAtTransfer"></span></label> 
                            </div>
                            <div class="col-md-7">
                                <label for="schoolNameAtTransfer" class="form-label marathi-label">शाळेचे नाव <span class="english-label">(School Name)</span> &rarr; <span class="txtval" id="schoolNameAtTransfer"></span></label> 
                            </div>
                            <div class="col-md-2"> 
                                <a href="#" class="file-upload-area" id="schoolAtTransferFile" target="_blank" Tooltip="Preview Document">
                                    <i class="fa fa-eye" title="View Document"></i> View
                                </a>
                            </div>

                            <div class="col-md-12">
                                <label for="schoolLocationAtTransfer" class="form-label marathi-label">शाळेचे ठिकाण <span class="english-label">(School Location)</span> &rarr; <span class="txtval" id="schoolLocationAtTransfer"></span></label> 
                            </div>
                           
                           
                            
                        </div> 
                    </div>
                    
              
                
                    <div class="pdf-field">
                        <h3 class="section-title">शैक्षणिक व व्यावसायिक अर्हता. <small style="font-size:10px;">संबंधित शिक्षकाची शैक्षणिक व व्यावसायिक अर्हता प्रमाणपत्रे • शासन निर्णय दिनांक 25.02.2019 नुसार.</small></h3>
                        <div class="row" id="qualifications"></div> 
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
                            <span class="txtval" id="schoolCommitteeOutwardNumber"></span>
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                             <span class="txtval" id="schoolCommitteeOutwardDate"></span>
  
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="schoolCommitteeOutwardFile" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View
                            </a>
                        </div>
                    </div> 

                    <div class="row mb-2" style="border-top: 1px solid #cff4fc;">
                        <div class="col-md-6">
                            <label class="form-label marathi-label">विनाअनुदानित / अंशतः अनुदानित तत्त्वावरील मूळ संस्था नियुक्ती आदेश</label>
                        </div> 
                        <div class="col-md-2" style="text-align: center;">
                            <span class="txtval" id="originSansthaAppointmentNumber"></span>
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                             <span class="txtval" id="originSansthaAppointmentDate"></span>  
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="originSansthaAppointmentFile" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View
                            </a>
                        </div>
                    </div> 
                    
                   
                    
                    <div class="row mb-2" style="border-top: 1px solid #cff4fc;">
                        <div class="col-md-6">
                            <label class="form-label marathi-label">शिक्षणाधिकारी / उपसंचालक यांनी दिलेला विनाअनुदानित / अंशतः अनुदानित तत्त्वावरील वैयक्तिक मान्यता आदेश</label>
                        </div> 
                        <div class="col-md-2" style="text-align: center;">
                            <span class="txtval" id="personalRecognitionNumber"></span>
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                             <span class="txtval" id="personalRecognitionDate"></span>  
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="personalRecognitionFile" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View
                            </a>
                        </div>
                    </div>

                    <div class="row mb-2" style="border-top: 1px solid #cff4fc;">
                        <div class="col-md-6">
                            <label class="form-label marathi-label">संबंधित व्यवस्थापनाची विनाअनुदानित / अंशतः अनुदानित सेवाज्येष्ठता सूची</label>
                        </div> 
                        <div class="col-md-2" style="text-align: center;">
                            <span class="txtval" id="serviceSeniorityListNumber"></span>
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                             <span class="txtval" id="serviceSeniorityListDate"></span>  
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="serviceSeniorityListFile" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View
                            </a>
                        </div>
                    </div>
 
                    <div class="row mb-2" style="border-top: 1px solid #cff4fc;">
                        <div class="col-md-6">
                            <label class="form-label marathi-label">बदलीपूर्वी बिंदुनामावलीनुसार रिक्त पदाचा विषय व आरक्षण विचारात घेण्यात आल्याचे प्रमाणपत्र</label>
                        </div> 
                        <div class="col-md-2" style="text-align: center;">
                            <span class="txtval" id="vacantPostAsMeritListNumber"></span>
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                             <span class="txtval" id="vacantPostAsMeritListDate"></span>  
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="vacantPostAsMeritListFile" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View
                            </a>
                        </div>
                    </div>

                    <div class="row mb-4" style="border-top: 1px solid #cff4fc;">
                        <div class="col-md-6">
                            <label class="form-label marathi-label">शासन निर्णय दि. 06.02.2012 व 10.06.2022 नुसार मान्यता असल्याबाबतचा शिक्षणाधिकारी / उपसंचालक यांचा स्पष्ट अभिप्राय</label>
                        </div> 
                        <div class="col-md-2" style="text-align: center;">
                            <span class="txtval" id="opinionEoDDRecognitionNumber"></span>
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                             <span class="txtval" id="opinionEoDDRecognitionDate"></span>  
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="opinionEoDDRecognitionFile" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View
                            </a>
                        </div>
                    </div>

                    <h3 class="section-title mb-2" style="font-size:15px;"> 
                        विनाअनुदानित / अंशतः अनुदानित शाळेत 5 वर्षे सेवा केल्याचे (मुख्याध्यापक) प्रमाणपत्र
                            <a href="#" class="file-upload-area" id="fiveYrsHMCertificateFile" target="_blank" Tooltip="Preview Document">
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
                            <span class="txtval" id="VacantPostCausingTransfer"></span>
                        </div>
                       
                        <div class="col-md-2" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="vacantPostCausingTransferFile" target="_blank" Tooltip="Preview Document">
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
                             <span class="txtval" id="mavakCheckListDate"></span>  
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="mavakCheckListFile" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View
                            </a>
                        </div>
                    </div>

                    <div class="row mb-2" style="border-top: 1px solid #cff4fc;">
                        <div class="col-md-8">
                            <label class="form-label marathi-label">
                                संबंधित शिक्षकांचे विनाअनुदानित भरतीचे ना हरकत प्रमाणपत्र (जावक क्रमांक - <span class="txtval" id="recruitmentNocOutwardNumber"></span>)
                            </label>
                        </div> 
                        
                        <div class="col-md-2" style="text-align: center;">
                             <span class="txtval" id="recruitmentNocOutwardDate"></span>  
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="recruitmentNocOutwardFile" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View
                            </a>
                        </div>
                    </div>
                    
                   
                  
                    <div class="row mb-2" style="border-top: 1px solid #cff4fc;">
                        <div class="col-md-8">
                            <label class="form-label marathi-label">
                                वर्तमानपत्रातील जाहिरात (वर्तमानपत्राचे नाव - <span class="txtval" id="advrtNewspaperName"></span>)
                            </label>
                        </div> 
                        
                        <div class="col-md-2" style="text-align: center;">
                             <span class="txtval" id="advrtNewspaperDate"></span>  
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="advrtNewspaperFile" target="_blank" Tooltip="Preview Document">
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
                             <span class="txtval" id="interviewDate"></span>  
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="interviewFile" target="_blank" Tooltip="Preview Document">
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
                             <span class="txtval" id="reportNGPrincipleDate"></span>  
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="reportNGPrincipleFile" target="_blank" Tooltip="Preview Document">
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
                             <span class="txtval" id="reportGPrincipleDate"></span>  
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="reportGPrincipleFile" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View
                            </a>
                        </div>
                    </div>
                  
               
                    <div class="row mb-2" style="border-top: 1px solid #cff4fc;">
                        <div class="col-md-8">
                            <label class="form-label marathi-label">
                                वैयक्तिक मान्यता आदेशावरील जावक क्रमांक कार्यालयातील जावक नोंदवहीशी जुळतो का याबाबत शिक्षणाधिकारी / उपसंचालक यांचे प्रमाणपत्र
                            </label>
                        </div>                         
                        <div class="col-md-2" style="text-align: center;">
                             <span class="txtval" id="outwardNumberMatchCertificateDate"></span>  
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="outwardNumberMatchCertificateFile" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View
                            </a>
                        </div>
                    </div>

                    <div class="row mb-2" style="border-top: 1px solid #cff4fc;">
                        <div class="col-md-8">
                            <label class="form-label marathi-label">
                                बदली होणारा शिक्षक स्वयंअर्थसहाय्यित तत्त्वावर कार्यरत नव्हता याबाबत प्रमाणपत्र • शासन अधिसूचना दि. 08.06.2020 (जावक क्रमांक - <span class="txtval" id="selfFinancingCertificateOutwardNumber"></span>)
                            </label>
                        </div> 
                        
                        <div class="col-md-2" style="text-align: center;">
                             <span class="txtval" id="selfFinancingCertificateDate"></span>  
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="selfFinancingCertificateFile" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View
                            </a>
                        </div>
                    </div>
                  
                 
                    <div class="row mb-2" style="border-top: 1px solid #cff4fc;">
                        <div class="col-md-8">
                            <label class="form-label marathi-label">
                                बदली असमान पदावर झालेली नाही याबाबत प्रमाणपत्र • अधिसूचना दि. 08.06.2020 मधील तरतुदीनुसार (जावक क्रमांक - <span class="txtval" id="transferNotHigherPostOutwardNumber"></span>)
                            </label>
                        </div> 
                        
                        <div class="col-md-2" style="text-align: center;">
                             <span class="txtval" id="transferNotHigherPostDate"></span>  
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="transferNotHigherPostFile" target="_blank" Tooltip="Preview Document">
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
                            <a href="#" class="file-upload-area" id="salarySubsidyGuaranteeLetterFile" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View
                            </a>
                        </div>
                    </div>
                    
                 
                </div>
                <div class="form-section">   
                    <h3 class="section-title">आयकर विवरणपत्र (Form-16)</h3>
                    <div class="row mb-4" style="border-top: 1px solid #cff4fc;">
                       
                        <div class="col-md-4" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="itr1File" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View 2025-26
                            </a>
                        </div>
                        <div class="col-md-4" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="itr2File" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View 2024-25
                            </a>
                        </div>
                        <div class="col-md-4" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="itr3File" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View 2023-24
                            </a>
                        </div>
                    </div>
                   
                    <h3 class="section-title">Bank Statement</h3>
                    <div class="row mb-4" style="border-top: 1px solid #cff4fc;">
                        <div class="col-md-3">
                            <label class="form-label marathi-label">
                                Start Date &rarr; <span class="txtval" id="bankStatementFromDate"></span>
                            </label>
                        </div> 
                        <div class="col-md-3">
                            <label class="form-label marathi-label">
                                End Date &rarr; <span class="txtval" id="bankStatementToDate"></span>
                            </label>
                        </div> 
                        <div class="col-md-6" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="bankStatementFile" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View
                            </a>
                        </div>
                    </div>

                    
                    <h3 class="section-title">न्यायालयीन आदेश (असल्यास)</h3>
                    <div class="row mb-4" style="border-top: 1px solid #cff4fc;">
                        <div class="col-md-3">
                            <label class="form-label marathi-label">
                                याचिका क्रमांक &rarr; <span class="txtval" id="courtOrderPetitionNumber"></span>
                            </label>
                        </div> 
                        <div class="col-md-3">
                            <label class="form-label marathi-label">
                                याचिका दिनांक &rarr; <span class="txtval" id="courtOrderDate"></span>
                            </label>
                        </div> 
                        <div class="col-md-6" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="courtOrderFile" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View
                            </a>
                        </div>
                    </div>
                    
                    
                    <h3 class="section-title">विनाअनुदानित तत्त्वावरील रुजू दिनांकापासून इतर शासकीय लाभ घेतले नाहीत याबाबत प्रमाणपत्र</h3>
                    <div class="row mb-4" style="border-top: 1px solid #cff4fc;">
                        <div class="col-md-6">
                            <label class="form-label marathi-label">
                                विवरण &rarr; <span class="txtval" id="noBenefitsCertificateDetails"></span>
                            </label>
                        </div> 
                      
                        <div class="col-md-6" style="text-align: center;">
                            <a href="#" class="file-upload-area" id="noBenefitsCertificateFile" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View
                            </a>
                        </div>
                    </div>
                    

                    <h3 class="section-title mb-4">प्रस्तुत प्रस्तावातील कागदपत्रे खरी असल्याबाबत संस्थेचे हमीपत्र (प्रपत्र-2) • शासन अधिसूचना दि. 08.06.2020

                      <a href="#" class="file-upload-area" id="institutionGuaranteeFile" target="_blank" Tooltip="Preview Document">
                                <i class="fa fa-eye" title="View Document"></i> View
                            </a>
                    </h3>

                    
                    
                    <h3 class="section-title mb-4">इतर कागदपत्रे (Additional Documents)

                      <a href="#" class="file-upload-area" id="otherDocuments" target="_blank" Tooltip="Preview Document">
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
                <button class="btn btn-secondary btn-sm js-close-slider">Close</button>
            </div>
        </div>
        <div id="footerMsgBox"></div>
        </form>
    </div>

</div>


<script>
  
    $(document).ready(function() {
        function toggleMatchBox() {
            var selectedVal = $('input[name="im_outward_fwd_np"]:checked').val();
            if (selectedVal === '1') {
                $('#matchBox').hide();  // Hide if value is 1 (YES)
            } else {
                $('#matchBox').show();  // Show for any other value (including no selection)
            }
        }
        $('input[name="im_outward_fwd_np"]').on('change', toggleMatchBox);
  
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
            $('#imForm')[0].reset();
            $('#imForm input[type="file"]').val('');
            $('#matchBox').hide();
            
           
            //alert(staffObject.personal_recognition_file);
            $('#im_empName').text(staffObject.teacher_name);
            $('#im_outwardNumber').text(staffObject.personal_recognition_number);
            $('#im_date').text(staffObject.personal_recognition_date);
            //$('#im_doc').val(staffObject.personal_recognition_file);
            $('#im_doc').attr('href', staffObject.personal_recognition_file);

        }
        $('#imForm').submit(function(e) {    
            
            e.preventDefault();

            /*var selectedVal = $('input[name="im_outward_fwd_np"]:checked').val();
            if(selectedVal==1){

            }else if(selectedVal==0){
                var selectedMatchVal = $('input[name="im_outward_match"]:checked').val();
                if(!((selectedMatchVal==0) || (selectedMatchVal==1))){
                     alert("कृपया होय किंवा नाही निवडा: वैयक्तिक मान्यता आदेशावरील जावक क्रमांक कार्यालयातील जावक नोंदवहीशी जुळतो का?");
                    return;
                }
            }else{
                alert("कृपया होय किंवा नाही निवडा: वैयक्तिक मान्यता आदेशावरील जावक क्रमांक नगर पालिकेकडे पाठवायचा का?");
                return;
            }*/

          
            var formData = new FormData(this);
            formData.append('app_id',currentAppId)
            $.ajax({
                url: '<?= $this->Url->build(["controller" => "District", "action" => "processIndividualApprovalOrder"]); ?>',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                },
                success: function(response) {
                    
                       
                        //$('#im_footerBox').hide();
                        $('#im_footerMsgBox').show();
                         $('#actionBtns_'+currentAppId).html('<b style="color:green;">Sent to Sanstha Desk</b>');
                        $('#im_footerMsgBox').html('अर्ज पुढील कार्यवाहकर्ता संस्थेच्या लॉगिनवर पाठविण्यात आला.');  
                        /*if(selectedVal == 1){
                             $('#actionBtns_'+currentAppId).html('<b style="color:green;">Pending Nagarpalika Verification</b>');
                            $('#im_footerMsgBox').html('अर्ज पडताळणीसाठी नगरपालिका विभागाकडे पाठविण्यात आला.');  
                        }else{
                             $('#actionBtns_'+currentAppId).html('<b style="color:green;">Sent to Sanstha Desk</b>');
                             $('#im_footerMsgBox').html('अर्ज पुढील कार्यवाहकर्ता संस्थेच्या लॉगिनवर पाठविण्यात आला.');  
                        }*/
                          
                                       
                   
                    //$('#actionBtns_'+currentAppId).html('');
                },
                error: function(xhr, status, error) {
                    // Handle error

                }
            });
           
        });

        // ------------------------------
        // Slider 2: .js-open-transfer (targets #transferSlider)
        // ------------------------------
       


        $(document).on('click', '.js-open-transfer', function () {
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
             

           $(document).trigger('js:openSlider', [caseId, staffObject]);
        });

        // Close slider
        $(document).on('click', '.js-close-slider', function () {
            $(document).trigger('js:closeSlider');
        });

        // Custom event handlers for Slider 2
        $(document).on('js:openSlider', function (e, caseId, staffObject) {
            //loadTransferDetails(caseId, staffObject);
            $('#transferSlider').addClass('open').attr('aria-hidden', 'false');
        });

        $(document).on('js:closeSlider', function () {
            $('#transferSlider').removeClass('open').attr('aria-hidden', 'true');
        });

        // ------------------------------
        // Global ESC key handler (closes both sliders)
        // ------------------------------
        $(document).on('keydown', function (e) {
            if (e.key === 'Escape') {
                $(document).trigger('im:closeSlider');
                $(document).trigger('js:closeSlider');
            }
        });


        function formatDate(dateStr) {
            const parts = dateStr.split('-'); // yyyy-mm-dd
            return parts[2] + '/' + parts[1] + '/' + parts[0];
        }
        function docUrl(filename) {
            return "<?= $this->Url->build('/', ['fullBase' => true]); ?>" + filename;
        }
        
        function loadTransferDetails(caseId,staffObject) {
            //
                   // btn-success
                    //btn-danger
          
            console.log("vvvv->"+staffObject.id);
            console.log("ddddddddd->"+staffObject.school_permission_order_date);
            
            $('#footerBox').show();
            $('#footerMsgBox').hide();
            $('#teacherTransferForm')[0].reset();
            $('#teacherTransferForm input[type="file"]').val('');
            
            $('#empName').text(staffObject.employee_name); /// in the header
            $('#institutionCode').text(staffObject.institution_code);
            $('#institutionName').text(staffObject.institution_name);
            $('#udiseNumber').text(staffObject.udise_number);
            $('#schoolName').text(staffObject.school_name);
            $('#schoolLocation').text(staffObject.school_location);
            $('#employeeName').text(staffObject.employee_name);
            $('#designation').text(staffObject.designation);
            $('#salaryGrade').text(staffObject.salary_grade);
            $('#teachingSubject').text(staffObject.teaching_subject);
            $('#teachingClasses').text(staffObject.emp_name);
            $('#originalCategory').text(staffObject.original_category);
            $('#appointmentCategory').text(staffObject.appointment_category);
            $('#panNumber').text(staffObject.pan_number);
            $('#aadharNumber').text(staffObject.aadhar_number);
            $('#schoolPermissionOrderNumber').text(staffObject.school_permission_order_number);
            $('#schoolPermissionOrderDate').text(formatDate(staffObject.school_permission_order_date));
            $('#schoolPermissionOrderFile').attr('href',docUrl(staffObject.school_permission_order_file));
            $('#minorityCertOutwardNumber').text(staffObject.minority_cert_outward_number);
            $('#minorityCertOutwardDate').text(staffObject.minority_cert_outward_date);
            $('#minorityCertOutwardFile').attr('href',docUrl(staffObject.minority_cert_outward_file));
            $('#udiseNumberAtTransfer').text(staffObject.emp_name);
            $('#schoolNameAtTransfer').text(staffObject.emp_name);
            $('#schoolAtTransferFile').attr('href',docUrl(staffObject.emp_name));
            $('#schoolLocationAtTransfer').text(staffObject.school_at_transfer_file);

            let qualifications = '';
            if(!(staffObject.qualification_1 =='' || staffObject.qualification_1_file =='')){
                let filename = '<a class="file-upload-area" href="'+ docUrl(staffObject.qualification_1_file)+'" target="_blank"><i class="fa fa-eye" title="View Document"></i> View</a>';
                qualifications += '<div class="col-md-3 english-label txtval">'+ staffObject.qualification_1 +' &rarr; ' + filename +'</div>';
                
            }
            if(!(staffObject.qualification_2 =='' || staffObject.qualification_2_file =='')){
                let filename = '<a class="file-upload-area" href="'+ docUrl(staffObject.qualification_2_file)+'" target="_blank"><i class="fa fa-eye" title="View Document"></i> View</a>';
                qualifications += '<div class="col-md-3 english-label txtval">'+ staffObject.qualification_2 +' &rarr; ' + filename +'</div>';
                 
            }
            if(!(staffObject.qualification_3 =='' || staffObject.qualification_3_file =='')){
                let filename = '<a class="file-upload-area" href="'+ docUrl(staffObject.qualification_3_file)+'" target="_blank"><i class="fa fa-eye" title="View Document"></i> View</a>';
                qualifications += '<div class="col-md-2 english-label txtval">'+ staffObject.qualification_3 +' &rarr; ' + filename +'</div>';
                
            }
            if(!(staffObject.qualification_4 =='' || staffObject.qualification_4_file =='')){
                let filename = '<a class="file-upload-area" href="'+ docUrl(staffObject.qualification_4_file)+'" target="_blank"><i class="fa fa-eye" title="View Document"></i> View</a>';
                qualifications += '<div class="col-md-2 english-label txtval">'+ staffObject.qualification_4 +' &rarr; ' + filename +'</div>';
                
            }
            if(!(staffObject.qualification_5 =='' || staffObject.qualification_5_file =='')){
                let filename = '<a class="file-upload-area" href="'+ docUrl(staffObject.qualification_5_file)+'" target="_blank"><i class="fa fa-eye" title="View Document"></i> View</a>';
                qualifications += '<div class="col-md-2 english-label txtval">'+ staffObject.qualification_5 +' &rarr; ' + filename +'</div>';
               
            }
            $('#qualifications').html(qualifications);
            
            
            let designation = '';

            if (staffObject && staffObject.post && staffObject.post.name) {
                designation = staffObject.post.name;
            }

            if (staffObject && staffObject.current_post) {
                designation += ' (' + staffObject.current_post + ')';
            }

                    
            $('#staffId').val(staffObject.id);
            //$('#caseId').text(caseId);
            $('#empName').text(staffObject.emp_name);
           // $('#designation').text(designation);
            //$('#school').text(staffObject?.caste_category?.category_name);
            //$('#remarks').text('Case under scrutiny by Education Officer.');
        }


        

        $('#teacherTransferForm').submit(function(e) {           
            e.preventDefault();
             if(currentMode == 1){
                        $('#actionStatus_'+currentAppId).html('<b style="color:green;">Approved</b>');
                        $('#footerBox').hide();
                        $('#footerMsgBox').show();
                        $('#footerMsgBox').html('The application has been approved successfully and is forwarded for further action to the Block Officer. <button class="btn btn-success btn-sm js-close-slider">Close</button>');    
                                        
                    }else{
                        $('#actionStatus_'+currentAppId).html('<b style="color:red;">Rejected</b>');
                        $('#footerBox').hide();
                        $('#footerMsgBox').show();
                        $('#footerMsgBox').html('The application has been rejected successfully. <button class="btn btn-danger btn-sm js-close-slider">Close</button>'); 
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
                        $('#footerMsgBox').html('The application has been approved successfully and is forwarded for further action to the Block Officer. <button class="btn btn-success btn-sm js-close-slider">Close</button>');    
                                        
                    }else{
                        $('#actionStatus_'+currentAppId).html('<b style="color:red;">Rejected</b>');
                        $('#footerBox').hide();
                        $('#footerMsgBox').show();
                        $('#footerMsgBox').html('The application has been rejected successfully. <button class="btn btn-danger btn-sm js-close-slider">Close</button>'); 
                    }
                    $('#actionBtns_'+currentAppId).html('');
                },
                error: function(xhr, status, error) {
                    // Handle error

                }
            });
           
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
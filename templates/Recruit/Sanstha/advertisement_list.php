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

<div class="d-flex justify-content-between align-items-center"
     style="padding: 5px 10px; border-bottom: 2px solid #1a237e;">

    <!-- Left Side -->
    <h5 style="margin:0; color:#1a237e;">
        🔜👨‍💼 जाहिरातींची यादी
    </h5>

      <!-- Right Side Buttons -->
    <div class="d-flex gap-2">

     <button  class="btn btn-primary btn-sm action-ud startApplication-open-already-published"
                    data-staffObject='<?php echo json_encode($staff, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>'
                    data-id='NGG-2025-001'
                    data-mode='2' app-step='1'>
                जाहिरात प्रसिद्ध केली आहे <!--/ जाहिरात आवश्यक नाही -->
            </button>
    <button  class="btn btn-primary btn-sm action-ud startApplication-open-transfer"
                    data-staffObject='<?php echo json_encode($staff, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>' 
                    data-id='NGG-2025-001'
                    data-mode='2' app-step='1'>
        नवीन जाहिरात मंजुरी अर्ज
    </button>

    </div>

 </div> 



<!-- Bootstrap + Bootstrap Icons -->
<div style="background: #fff; padding:10px;height: 560px !important;overflow-y: auto;">      
    
        

        <table id="staffTable" class="table table-bordered table-striped table-hover align-middle">
            <thead class="table-light">
            <tr>
                <th>अनु. क्र.</th>
                <th>अर्ज दिनांक</th> 
                 <th>निवडलेली पदे</th> 
                <th>अर्जाची स्थिती</th>
                <th>कृती</th>
            </tr>
            </thead>
            <tbody>   
               <?php
                $ng2g = !empty($ng2g) ? $ng2g : [];
                ?>

                <?php if (count($ng2g) > 0): ?>               
                <?php 
                $idx =1;
               foreach ($ng2g as $request): 
                 $approvedLogDocument = $approvedLogDocuments[$request->id] ?? null;
                   
                $approvedLogUrl = null;
                if (!empty($approvedLogDocument)) {
                    $approvedLogUrl = preg_match('/^https?:\/\//i', $approvedLogDocument)
                        ? $approvedLogDocument
                        : $this->Url->build('/' . ltrim($approvedLogDocument, '/'));
                }

                $rejectLogDocument = $rejectLogDocuments[$request->id] ?? null;
                   
                $rejectLogUrl = null;
                if (!empty($rejectLogDocument)) {
                    $rejectLogUrl = preg_match('/^https?:\/\//i', $rejectLogDocument)
                        ? $rejectLogDocument
                        : $this->Url->build('/' . ltrim($rejectLogDocument, '/'));
                }
                ?>
                <tr>
                    <td> <?= h($idx) ?>.</td>
                    <td>
                        <?= h($request->created_at->format('d/m/Y')) ?>
                    </td>
                    <td>
                        <?= h($request->vacancy_count) ?>
                    </td>                                    
                    <td>                     
                        <?= h($request->status) ?>
                    </td>     
                    <td id="actionBtns111_<?= h($request->id) ?>">
                        <?php
                           echo "<a href='#' style='text-decoration:none;' class='startApplication-open-view' data-mode='2' app-step='1'  data-staffObject='". json_encode($request, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ."' data-id='".$request->id."'> <i class='fa-solid fa-address-card'></i> पहा</a><br>";
                       
                       if($approvedLogUrl!=null){
                              echo "<a href='" . h($approvedLogUrl ?? '#') . "' style='text-decoration:none;' target='_blank'" . ($approvedLogUrl ? '' : " onclick=\"return false;\"") . ">
                                <i class='fa-solid fa-reorder'></i>  आदेश
                            </a><br/>";
                           }

                             if($rejectLogUrl!=null){
                              echo "<a href='" . h($rejectLogUrl ?? '#') . "' style='text-decoration:none;' target='_blank'" . ($rejectLogUrl ? '' : " onclick=\"return false;\"") . ">
                                <i class='fa-solid fa-reorder'></i>  नकार आदेश
                            </a><br/>";
                           }
                       ?>                    
                         
                    </td>
                </tr>
                <?php $idx++; endforeach; ?>
                <?php else: ?>
                <tr>
                        <td colspan="5"
                            class="text-center text-muted">
                            No Record found.
                        </td>
                    </tr>
                  <?php endif; ?>
            </tbody>
        </table>
       
</div>




<!-- Slide Panel -->
<div id="startApplicationSlider" class="slide-panel" aria-hidden="true" style="border:3px solid #537895;">
     <!-- Header -->
    <div class="slide-header d-flex justify-content-between align-items-center">
        <div style="width:100%;">
            <h5 class="mb-0"><i class="fas fa-arrow-trend-up me-1"></i> नवीन जाहिरात मंजुरी अर्ज </h5>
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
                    <div style="background: #fff; padding:10px;">       
        

                    <table id="staffTable" class="table table-bordered table-striped table-hover align-middle">
                        <thead class="table-light">
                        <tr>
                            <th>निवडा</th>
                            <th>शाळेचे नाव</th> 
                            <th>UDISE Code</th> 
                            <th>पदाचे नाव</th>
                           
                        </tr>
                        </thead>
                        <tbody>                        
                            <?php 
                            $idx =1;                            
                            foreach ($ddovacant as $vacant): 
                            ?>
                            <tr>
                                <td> <input type="checkbox"  name="post_ids[]" class="row-select"
                                    value="<?= h($vacant->id) ?>"
                                    data-school-name="<?= h($vacant->school_name) ?>"
                                    data-udise-code="<?= h($vacant->udise_code) ?>"
                                    data-post-name="<?= h($vacant->post_name) ?>"
                                    ></td>
                                <td><?= h($vacant->school_name) ?></td>
                                <td><?= h($vacant->udise_code) ?></td>                                    
                                <td><?= h($vacant->post_name) ?></td>                                   
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                
                    </div>    
                                    
                    <!-- Submit Button -->
                    <div class="d-flex justify-content-between mt-4">
                        <!--<button type="button" class="btn btn-outline-secondary" id="saveDraftBtn">
                            <i class="bi bi-save"></i> ड्राफ्ट सेव्ह करा
                        </button>-->
                        <button type="submit" class="btn btn-submit" id="saSubmitBtn_step1">
                            <i class="bi bi-send-check"></i> Next
                        </button>
                                                

                    </div>
                </form>
            </div>  
            

             <div id="saStep2" class="d-none">
                <form id="saFormStep2" enctype="multipart/form-data">
                    <input type="hidden" id="sa_basic_data">
                    <div style="background: #fff; padding:10px;">  
                        <table id="staffTable" class="table table-bordered table-striped table-hover align-middle">
                            <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>शाळेचे नाव</th> 
                                <th>UDISE Code</th> 
                                <th>पदाचे नाव</th>
                                <th>Category</th>
                            
                            </tr>
                            </thead>
                              <tbody id="saSelectedVacancyList">
                            </tbody>

                        </table>                
                     </div>

                     
                    <div class="col-md-12 mt-3">

                        <label class="form-label fw-bold d-block">
                            सदर पद सन २०२३-२४ च्या संयमान्यतेनुसार आहे किंवा त्यापूर्वीचे पायाभूत आहे.
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
                                 आकृतिबंधाच्या मर्यादित २०२३-२४ च्या नंतरचे असल्यास, संचालक/शासन मान्यता घेतली आहे का? 
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


                     <input type="hidden" id="minority_sanstha" name="minority_sanstha" value="<?= h($minority_sanstha) ?>">
                    <?php //if (!in_array((string)$minority_sanstha, ['2', '3'], true)) { ?>
                     <div class="pdf-field">
                        <h3 class="section-title">Roster </h3>
                        <div class="row mt-1">
                            <div class="col-md-3 mt-2">
                                <label for="advApprovelFile" class="form-label english-label required-field">
                                     Upload Roster 
                                </label>                                
                            </div>    
                            <div class="col-md-3">
                                <input type="file" id="advApprovelFile" name="advApprovelFile" class="form-control file-upload-check" accept=".pdf" required>      
                            </div>      
                        </div>                    
                        <hr/>                        
                    </div> 
                    <?php //}?>

                     <div class="pdf-field">
    <h3 class="section-title">संस्थेचा ठराव</h3>

    <div class="row mt-1">

        <!-- संस्थेचा ठराव -->
        <div class="col-md-3 mt-2">
            <label for="resolutionFile" class="form-label marathi-label required-field">
                संस्थेचा ठराव
            </label>
        </div>

        <div class="col-md-3">
            <input
                type="file"
                id="resolutionFile"
                name="resolutionFile"
                class="form-control file-upload-check"
                accept=".pdf"
                required
            >
        </div>

        <br>
        
        <div class="col-md-12 mt-2">
            <label class="form-label marathi-label required-field">
                अनुकंपा माहिती
            </label>
        </div>

        <div class="col-md-12">

           
            <div class="d-flex gap-4 mt-2">

                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        id="CADetailsYes"
                        name="cadetails"
                        value="1"
                        onchange="hideDiv('CADetailsDiv'); showDiv('CADetailsDiv');"
                    >
                    <label class="form-check-label ms-2" for="CADetailsYes">
                        होय
                    </label>
                </div>

                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        id="CADetailsNo"
                        name="cadetails"
                        value="2"
                        onchange="hideDiv('CADetailsDiv'); showDiv('CADetailsDiv');"
                    >
                    <label class="form-check-label ms-2" for="CADetailsNo">
                        नाही
                    </label>
                </div>

            </div>

            
            <div id="CADetailsDiv" class="form-group mt-2 hidden">
                <input
                    type="file"
                    id="CADetailsFile"
                    name="CADetailsFile"
                    class="form-control file-upload-check"
                    accept=".pdf"
                >
            </div>

        </div>

    </div>

    <hr>
</div>

                    <div class="pdf-field">
                        <h3 class="section-title">संच मान्यता</h3>

                        <div id="sanchManyataDocuments">
                            <!-- Dynamic UDISE-wise PDF inputs will come here -->
                        </div>

                        <hr/>
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
                         <button type="button"
                                    id="saCategoryBackBtn"
                                    class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i>
                                Back
                            </button>
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



<!-- Slide Panel -->
<div id="startApplicationPublishedSlider" class="slide-panel" aria-hidden="true" style="border:3px solid #537895;">
     <!-- Header -->
    <div class="slide-header d-flex justify-content-between align-items-center">
        <div style="width:100%;">
            <h5 class="mb-0"><i class="fas fa-arrow-trend-up me-1"></i> नवीन जाहिरात मंजुरी अर्ज </h5>
           
        </div>
        <button class="btn btn-sm btn-outline-danger startApplicationPublished-close-slider">X</button>
    </div>

    <!-- Body -->
    <div class="slide-body">
        <div class="form-container">
            <div id="plStep1">
                <form id="plFormStep1" enctype="multipart/form-data">
                    <input type="hidden" id="pl_basic_data">
                    <div style="background: #fff; padding:10px;">       
        

                    <table id="publishTable" class="table table-bordered table-striped table-hover align-middle">
                        <thead class="table-light">
                        <tr>
                            <th>निवडा</th>
                            <th>शाळेचे नाव</th> 
                            <th>UDISE Code</th> 
                            <th>पदाचे नाव</th>
                           
                        </tr>
                        </thead>
                        <tbody>                        
                            <?php 
                            $idx =1;                            
                            foreach ($ddovacant as $vacant): 
                            ?>
                            <tr>
                                <td> <input type="checkbox"  name="pl_post_ids[]" class="row-select"
                                    value="<?= h($vacant->id) ?>"
                                    data-school-name="<?= h($vacant->school_name) ?>"
                                    data-udise-code="<?= h($vacant->udise_code) ?>"
                                    data-post-name="<?= h($vacant->post_name) ?>"
                                    ></td>
                                <td><?= h($vacant->school_name) ?></td>
                                <td><?= h($vacant->udise_code) ?></td>                                    
                                <td><?= h($vacant->post_name) ?></td>                                   
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                
                    </div>    
                                    
                    <!-- Submit Button -->
                    <div class="d-flex justify-content-between mt-4">
                        <!--<button type="button" class="btn btn-outline-secondary" id="savePublishBtn">
                            <i class="bi bi-save"></i> ड्राफ्ट सेव्ह करा
                        </button>-->
                        <button type="submit" class="btn btn-submit" id="plSubmitBtn_step1">
                            <i class="bi bi-send-check"></i> Next
                        </button>
                                                

                    </div>
                </form>
            </div>  
            

             <div id="plStep2" class="d-none">
                <form id="plFormStep2" enctype="multipart/form-data">
                    <input type="hidden" id="pl_basic_data">
                    <div style="background: #fff; padding:10px;">  
                        <table id="publishTable2" class="table table-bordered table-striped table-hover align-middle">
                            <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>शाळेचे नाव</th> 
                                <th>UDISE Code</th> 
                                <th>पदाचे नाव</th>
                                <th>श्रेणी</th>
                            
                            </tr>
                            </thead>
                              <tbody id="plSelectedVacancyList">
                            </tbody>

                        </table>                
                     </div>

                    <!-- Remark -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                शेरा / Remark
                            </label>

                            <textarea class="form-control"
                                      name="pl_remark"
                                      id="pl_remark"
                                      rows="5"
                                      placeholder="कृपया शेरा नमूद करा..."
                                      required></textarea>
                        </div>


                       <!-- Submit Button -->
                    <div class="form-section">
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="publish_declaration" required>
                            <label class="form-check-label marathi-label" for="publish_declaration">&nbsp;&nbsp;
                                मी खात्रीपूर्वक सांगतो/सांगते की, वरील सर्व माहिती खरी आहे व सर्व कागदपत्रे खरी आहेत. कोणतीही चुकीची माहिती दिल्यास, माझ्यावर योग्य कायदेशीर कारवाई केली जाऊ शकते याची मला पूर्ण कल्पना / जाणीव आहे.
                            </label>
                        </div>
                    </div>


                    <!-- Submit Button -->
                    <div class="d-flex justify-content-between mt-4">
                         <button type="button"
                                    id="plCategoryBackBtn"
                                    class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i>
                                Back
                            </button>
                         <button type="submit" class="btn btn-submit" id="plSubmitBtn_step6">
                            <i class="bi bi-send-check"></i> अर्ज सबमिट करा
                        </button>
                                                

                    </div>
                </form>
            </div>

        </div>
    </div>


    <!-- Footer -->
    <div class="slide-footer text-end">
         <div class="row" id="pl_footerBox">
            <div id="pl_footerMsgBox"></div>
            <div class="col-md-12" style="text-align: right;">
                <button class="btn btn-danger btn-sm startApplicationPublished-close-slider">Close</button>
            </div>
            
        </div>
    </div>

</div>



<!-- Slide Panel -->
<div id="startApplicationViewSlider" class="slide-panel" aria-hidden="true" style="border:3px solid #537895;">
     <!-- Header -->
    <div class="slide-header d-flex justify-content-between align-items-center">
        <div style="width:100%;">
            <h5 class="mb-0"><i class="fas fa-arrow-trend-up me-1"></i> जाहिरात मंजुरी अर्ज </h5>
            <!--<small class="text-muted">Case ID: <span id="caseId"></span></small>-->
            
           
        </div>
        <button class="btn btn-sm btn-outline-danger startApplicationView-close-slider">X</button>
    </div>

    <!-- Body -->
    <div class="slide-body">
        <div class="form-container">
            <div id="saStep12">
                <form id="saFormStep1" enctype="multipart/form-data">
                    <input type="hidden" id="sa_basic_data">
                    <div style="background: #fff; padding:10px;">       
        

                    <table id="staffTable" class="table table-bordered table-striped table-hover align-middle">
                        <thead class="table-light">
                        <tr>
                            <th>अनु. क्र.</th>
                            <th>शाळेचे नाव</th> 
                            <th>UDISE Code</th> 
                            <th>पदाचे नाव</th>
                            <th>Category</th>
                           
                        </tr>
                        </thead>
                        <tbody id="adv_post_list">                        
                       
                        </tbody>
                    </table>
                
                     </div>


                     <div class="pdf-field">
                          <div id="periodDivShow"></div>           
                    </div>
                    <?php //if (!in_array((string)$minority_sanstha, ['2', '3'], true)) { ?>             
                    <div class="pdf-field">
                        <h3 class="section-title">Roster</h3>
                        <div class="row mt-1">
                            <div class="col-md-3 mt-2">
                                <label for="advApprovelFile" class="form-label english-label">
                                     Roster
                                </label>                                
                            </div>    
                            <div class="col-md-3" id="adv_post_approval_file">
                                <a>View Document</a>
                            </div>      
                        </div>                    
                        <hr/>                        
                    </div> 
                    <?php //}?> 

                       <div class="pdf-field">
                        <h3 class="section-title">संस्थेचा ठराव</h3>
                        <div class="row mt-1">
                            <div class="col-md-3 mt-2">
                                <label for="resolutionFile" class="form-label marathi-label">
                                     संस्थेचा ठराव
                                </label>                                
                            </div>    
                            <div class="col-md-3" id="adv_resolution_file">
                                <a>View Document</a>
                            </div>      
                        </div>   
                        
                         <div id="cadetailsDivShow"></div>
                        <hr/>                        
                    </div> 

                    <div class="pdf-field">
                        <h3 class="section-title">संच मान्यता दस्तऐवज</h3>
                        <div class="row mt-2">
                            <div class="col-md-2 mt-2">
                                <label for="signatureFile" class="form-label marathi-label">
                                     संच मान्यता दस्तऐवज
                                </label>                                
                            </div>    
                            <div class="col-md-3" id="adv_post_sanch_file">
                                <a>View Document</a>
                            </div>      
                        </div>    
                        <hr/>                        
                    </div>            

                    </div>    
                                    
                
                    
                </form>
            </div>  
                  
        </div>


   


    <!-- Footer -->
    <div class="slide-footer text-end">
         <div class="row" id="sa_footerBox">
            <div id="sa_footerMsgBox"></div>
            <!--div class="col-md-12" style="text-align: right;">
                <button class="btn btn-danger btn-sm startApplication-close-slider">Close</button>
            </div-->
            
        </div>
    </div>

</div>



<script>

      $(document).on('click', '.startApplication-open-view', function () {

             const caseId = $(this).data('id');
             let staffJson = $(this).attr('data-staffObject');   // raw JSON string
             let staffObject   = JSON.parse(staffJson)
             currentMode = $(this).attr('data-mode'); 
             currentAppId = staffObject.id; 
           
            $('#saStep12').show();
            $('#sa_footerBox').show();
            $('#sa_footerMsgBox').hide();    

           $(document).trigger('startApplicationView:openSlider', [caseId, staffObject]);
        

         });  

          // Close slider
        // Close slider
        $(document).on('click', '.startApplicationView-close-slider', function () {
            $(document).trigger('startApplicationView:closeSlider');
        });

        // Custom event handlers for Slider 2
        $(document).on('startApplicationView:openSlider', function (e, caseId, staffObject) {
            loadReturnViewDetails(caseId, staffObject);
            $('#startApplicationViewSlider').addClass('open').attr('aria-hidden', 'false');
        });

        $(document).on('startApplicationView:closeSlider', function () {
            $('#startApplicationViewSlider').removeClass('open').attr('aria-hidden', 'true');
        });


         loadReturnViewDetails = function(caseId){
                  
         var formData = new FormData();
         formData.append('post_id', caseId); 

            $.ajax({
                url: '<?= $this->Url->build(['prefix' => 'Recruit',"controller" => "Sanstha", "action" => "advertisementVacancyAjax"]); ?>',
                type: 'Post',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                },
                    success: function (response) {
                    if(response.success){
                            ng2g = response.data;
                            document.getElementById("adv_post_list").innerHTML = response.html;
                            document.getElementById("periodDivShow").innerHTML = response.data.periodDivShow;
                            document.getElementById("cadetailsDivShow").innerHTML = response.data.cadetailsDivShow;

                            if (response.data.approvalLetterUrl) {
                                $('#adv_post_approval_file').html(`
                                    <a href="${escapeHtml(response.data.approvalLetterUrl)}" target="_blank" rel="noopener">
                                        View Document
                                    </a>`);
                            } else {
                                $('#adv_post_approval_file').html('<span class="text-muted">Document not available</span>');
                            }

                             if (response.data.resolutionfile) {
                                $('#adv_resolution_file').html(`
                                    <a href="${escapeHtml(response.data.resolutionfile)}" target="_blank" rel="noopener">
                                        View Document
                                    </a>`);
                            } else {
                                $('#adv_resolution_file').html('<span class="text-muted">Document not available</span>');
                            }


                            let sanchManyataHtml = '';
                            const sanchManyataUrls = response.data.sanchManyataUrls || {};
                            const smDetails = response.data.smDetails || {};
                            const udiseCodes = new Set([
                                ...Object.keys(sanchManyataUrls),
                                ...Object.keys(smDetails)
                            ]);

                            udiseCodes.forEach(function (udiseCode) {
                                const sanchUrl = sanchManyataUrls[udiseCode];
                                const schoolDetails = smDetails[udiseCode] || {};
                                const staffAnswer = schoolDetails.smdetails === '1'
                                    ? 'होय'
                                    : schoolDetails.smdetails === '2'
                                        ? 'नाही'
                                        : 'माहिती उपलब्ध नाही';

                                sanchManyataHtml += `
                                    <div class="mb-2">
                                        <strong>UDISE ${escapeHtml(udiseCode)}:</strong>
                                        <div><strong>संच मान्यता:</strong> ${sanchUrl
                                            ? `<a href="${escapeHtml(sanchUrl)}" target="_blank" rel="noopener">View Document</a>`
                                            : 'कागदपत्र उपलब्ध नाही'}</div>
                                        <div><strong>संस्थेमध्ये शिक्षकेतर अतिरिक्त कर्मचारी आहे का?</strong> ${staffAnswer}</div>
                                        <div><strong>दस्तऐवज:</strong> ${schoolDetails.fileUrl
                                            ? `<a href="${escapeHtml(schoolDetails.fileUrl)}" target="_blank" rel="noopener">View Document</a>`
                                            : 'कागदपत्र उपलब्ध नाही'}</div>
                                    </div>`;
                            });

                            if (!sanchManyataHtml) {
                                sanchManyataHtml = '<span class="text-muted">Document not available</span>';
                            }

                            $('#adv_post_sanch_file').html(sanchManyataHtml);
                                                 
                    }
                    
                },
                error: function () {
                    $("#returnHtmlForm").html('<option>Error loading data</option>');
                }
            });
        }



    function activateStep(step) {

        console.log('Activating Step:', step);

        // Hide all steps
        $('#saStep1, #saStep2').addClass('d-none').hide();

        // Show selected step
        $('#saStep' + step).removeClass('d-none').show();

        // Scroll slider body to top
        $('#startApplicationSlider .slide-body').scrollTop(0);
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
            activateStep(currentStep);     
                     
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

     

        $('#saFormStep1').on('submit', function(e) {

                e.preventDefault();

                    let selectedVacancies = [];

                    $('#saFormStep1 .row-select:checked').each(function () {

                        selectedVacancies.push({
                            id: $(this).val(),
                            school_name: $(this).data('school-name'),
                            udise_code: $(this).data('udise-code'),
                            post_name: $(this).data('post-name')
                        });

                    });


                    // No selection
                    if (selectedVacancies.length === 0) {
                        alert('कृपया किमान एक पद निवडा (Please select at least one post)');
                        return;
                    }

                 console.log('Selected Vacancies:', selectedVacancies);


                // Build second slide
                renderCategorySlide(selectedVacancies);

                // Move Step 1 -> Step 2
                activateStep(2);

                return false;
            });


            function renderCategorySlide(vacancies)
            {
                let html = '';

                $.each(vacancies, function (index, vacancy) {

                    html += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${vacancy.school_name}</td>
                            <td>${vacancy.udise_code}</td>
                            <td>${vacancy.post_name}</td>
                            <td>
                                <select
                                    class="form-select vacancy-category"
                                    data-vacancy-id="${vacancy.id}">

                                    <option value="">श्रेणी निवडा </option>
                                    <option value="SC">SC</option>
                                    <option value="ST">ST</option>
                                    <option value="OBC">OBC</option>
                                    <option value="VJNT">VJNT</option>
                                    <option value="EWS">EWS </option>
                                    <option value="GENERAL">General</option>
                                </select>
                            </td>
                        </tr>
                    `;

                });

                $('#saSelectedVacancyList').html(html);

                // Create unique UDISE-wise document inputs
                renderSanchManyataDocuments(vacancies);

            }


            function renderSanchManyataDocuments(vacancies)
            {
                let uniqueUdise = {};

                // Get unique UDISE codes
                $.each(vacancies, function(index, vacancy) {

                    let udise = String(vacancy.udise_code).trim();

                    if (udise !== '') {
                        uniqueUdise[udise] = {
                            udise_code: udise,
                            school_name: vacancy.school_name
                        };
                    }

                });

                let html = '';

                let index = 1;

                $.each(uniqueUdise, function(udise, data) {

                    html += `
                        <div class="row mt-2 mb-3 sanch-document-row">

                            <div class="col-md-1 mt-2">
                                <strong>${index}</strong>
                            </div>

                            <div class="col-md-8 mt-2">

                                <label class="form-label english-label required-field">
                                    संच मान्यता दस्तऐवज   </label>
                                    
                                    <label class="form-check-label">(पद रिक्त झालेल्या वर्षापासून आजपर्यंतच्या सर्व मंजुरीचे दस्तऐवज एकाच PDF फाईलमध्ये एकत्रित करून अपलोड करणे आवश्यक आहे)
                                    <br>
                            (<span style="color:red">२०१८-१९ (पहिले) आणि २०२३-२४ पासून पुढील सर्व वर्षांसाठीचे सर्वेक्षण</span>)
                              </label>

                                <div>
                                    <strong>शाळा:</strong>
                                    ${escapeHtml(data.school_name)}
                                </div>

                                <div>
                                    <strong>UDISE Code:</strong>
                                    <span class="text-primary">
                                        ${escapeHtml(data.udise_code)}
                                    </span>
                                </div>
                               <div>
                                   <lable>संस्थेमध्ये शिक्षकेतर अतिरिक्त कर्मचारी आहे का?</lable>
                                   <div class="col-md-12">

           
            <div class="d-flex gap-4 mt-2">

                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        id="smDetailsYes_${escapeHtml(data.udise_code)}"
                        name="smdetails[${escapeHtml(data.udise_code)}]"
                        value="1"
                        required
                        onchange="hideDiv('smDetailsDiv_${escapeHtml(data.udise_code)}'); document.getElementById('smDetailsFile_${escapeHtml(data.udise_code)}').required = false;"
                    >
                    <label class="form-check-label ms-2" for="smDetailsYes_${escapeHtml(data.udise_code)}">
                        होय
                    </label>
                </div>

                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        id="smDetailsNo_${escapeHtml(data.udise_code)}"
                        name="smdetails[${escapeHtml(data.udise_code)}]"
                        value="2"
                        onchange="showDiv('smDetailsDiv_${escapeHtml(data.udise_code)}'); document.getElementById('smDetailsFile_${escapeHtml(data.udise_code)}').required = true;"
                    >
                    <label class="form-check-label ms-2" for="smDetailsNo_${escapeHtml(data.udise_code)}">
                        नाही
                    </label>
                </div>

            </div>

            
            <div id="smDetailsDiv_${escapeHtml(data.udise_code)}" class="form-group mt-2 hidden">
                <input
                    type="file"
                    id="smDetailsFile_${escapeHtml(data.udise_code)}"
                    name="smDetailsFile[${escapeHtml(data.udise_code)}]"
                                    data-udise-code="${escapeHtml(data.udise_code)}"
                    class="form-control file-upload-check"
                    accept=".pdf"
                >
            </div>

        </div>
                                </div>     


                            </div>

                            <div class="col-md-3">

                                <input
                                    type="file"
                                    class="form-control sanch-manyata-file file-upload-check"
                                    name="sanch_manyata[${escapeHtml(data.udise_code)}]"
                                    data-udise-code="${escapeHtml(data.udise_code)}"
                                    accept=".pdf"
                                    required>

                            </div>

                        </div>

                        <hr>
                    `;

                    index++;
                });

                $('#sanchManyataDocuments').html(html);
            }


            function escapeHtml(value)
                {
                    return $('<div>')
                        .text(value ?? '')
                        .html();
                }



             $('#saFormStep2').submit(function(e) {
             e.preventDefault();

             let selectedData = [];
             let isValid = true;


            $('.vacancy-category').each(function () {

            let vacancyId = $(this).data('vacancy-id');
            let udiseCode = $(this).data('udise-code');
            let category = $(this).val();


            if (!category) {

                isValid = false;

                $(this).addClass('is-invalid');

            } else {

                $(this).removeClass('is-invalid');

            }


                selectedData.push({
                    vacancy_id: vacancyId,
                    udise_code: udiseCode,
                    category: category
                });

            });


            if (!isValid) {

                alert('Please select category for every vacancy.');

                return false;
            }


            
            console.log('Final Data:', selectedData);

                                 
            submitVacancyCategories(selectedData);

              });


              function submitVacancyCategories(selectedData)
                {
                    
                    // ------------------------------------
                // 2. Validate Roster File
                // ------------------------------------
                let minority_sanstha = $('#minority_sanstha').val();
                let rosterInput = $('#saFormStep2 input[name="advApprovelFile"]')[0];
                let resolutionInput = $('#saFormStep2 input[name="resolutionFile"]')[0];
                let rosterFile = rosterInput ? rosterInput.files[0] : null;
                let resolutionFile = resolutionInput ? resolutionInput.files[0] : null;
                
                let periodInput = $('#saFormStep2 input[name="period"]:checked').val();
               
                let cadetailsInput = $('#saFormStep2 input[name="cadetails"]:checked').val();
               
                let periodFileInput = null;
                let period2324FileInput = null;
                let period2324Input = null;
                let periodFile = null;
                let period2324File = null;
                let CADetailsFileInput = null;
                let CADetailsFile = null;

                CADetailsFileInput = $('#saFormStep2 input[name="CADetailsFile"]')[0];
                CADetailsFile = CADetailsFileInput ? CADetailsFileInput.files[0] : null;

                if (periodInput === '1') {
                    periodFileInput = $('#saFormStep2 input[name="periodFile"]')[0];
                    periodFile = periodFileInput ? periodFileInput.files[0] : null;
                } else if (periodInput === '2') {
                    period2324Input = $('#saFormStep2 input[name="period2324"]:checked').val();
                    if(period2324Input === '1') {
                        period2324FileInput = $('#saFormStep2 input[name="period2324File"]')[0];
                         period2324File = period2324FileInput ? period2324FileInput.files[0] : null;
                    }
                    
                } else {
                    alert('Please select a valid period.');
                    return false;
                }

                /*if (!periodFileInput || !periodFileInput.files || periodFileInput.files.length === 0) {
                    alert('Please upload the file for the selected period.');
                    return false;
                }*/

                /*if (period2324FileInput && (!period2324FileInput.files || period2324FileInput.files.length === 0)) {
                    alert('Please upload the file for the selected period.');
                    return false;
                }*/


                if (!rosterFile) {
                    alert('Please upload Roster PDF.');
                    $(rosterInput).focus();
                    return false;
                }

                // PDF validation
                if (rosterFile && rosterFile.type !== 'application/pdf') {
                    alert('Only PDF files are allowed for Roster.');
                    $(rosterInput).val('');
                    return false;
                }
               

                let formData = new FormData();

                    formData.append(
                        'post_advertisement_id',
                        $('#sa_basic_data').val()
                    );


                    selectedData.forEach(function (item, index) {

                        formData.append(
                            `vacancies[${index}][vacancy_id]`,
                            item.vacancy_id
                        );

                        formData.append(
                            `vacancies[${index}][category]`,
                            item.category
                        );

                    });

                    formData.append('period',periodInput);
                    formData.append('cadetails',cadetailsInput);
                    formData.append('period2324',period2324Input);
                    formData.append('minority_sanstha',minority_sanstha);
                    if (periodFile) {
                        formData.append('periodFile', periodFile);
                    }
                     if (period2324File) {
                        formData.append('period2324File', period2324File);
                    }
                    if (CADetailsFile) {
                        formData.append('CADetailsFile', CADetailsFile);
                    }

                    $('input[name^="smdetails["]:checked').each(function() {
                        let udiseCode = this.name.match(/^smdetails\[([^\]]+)\]$/)?.[1];
                        if (udiseCode) {
                            formData.append(`smdetails[${udiseCode}]`, this.value);
                        }
                    });

                    $('#saFormStep2 input[name^="smDetailsFile["]').each(function() {
                        let udiseCode = $(this).data('udise-code');
                        if (udiseCode && this.files.length > 0) {
                            formData.append(`smDetailsFile[${udiseCode}]`, this.files[0]);
                        }
                    });

                    if (rosterFile) {
                        formData.append('advApprovelFile', rosterFile);
                    }
                    if (resolutionFile) {
                        formData.append('resolutionFile', resolutionFile);
                    }

                       $('.sanch-manyata-file').each(function() {
                            let udiseCode = $(this).data('udise-code');
                            if (this.files.length > 0) {
                                formData.append(
                                    `sanch_manyata[${udiseCode}]`,
                                    this.files[0]
                                );
                            }

                        });


                        // Debug
                        for (let pair of formData.entries()) {
                            console.log(pair[0], pair[1]);
                        }


                    $.ajax({
                        url: '<?= $this->Url->build(['prefix' => 'Recruit',"controller" => "Sanstha", "action" => "processVacacyRequest"]); ?>',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                        },
                        beforeSend: function () {
                            $('#saSubmitBtn_step6')
                                .prop('disabled', true)
                                .html(
                                    '<i class="fas fa-spinner fa-spin"></i> Saving...'
                                );

                        },
                        success: function(response) {
                            console.log(response);
                            //alert(response.message);
                            if(response.success){
                                ng2g_id = response.id;
                                alert(response.message);
                                if(response.success){
                                    location.reload();
                                }
                            }
                            // Handle success
                        },
                        error: function(xhr, status, error) {
                            let message = 'Unable to submit application.';

                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                message = xhr.responseJSON.message;
                            }

                            alert(message);
                            $('#saSubmitBtn_step6')
                                .prop('disabled', false)
                                .html('<i class="bi bi-send-check"></i> अर्ज सबमिट करा');

                        }
                    });




                }
            


    $(document).on('click', '#saCategoryBackBtn', function () {
            activateStep(1);
        });


 $(document).on('click', '.startApplication-open-already-published', function () {       

       
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
            activatePLStep(currentStep);     
                     
            $('#pl_footerBox').show();
            $('#pl_footerMsgBox').hide();    

           $(document).trigger('startApplicationPublished:openSlider', [caseId, staffObject]);
        });

        // Close slider
        $(document).on('click', '.startApplicationPublished-close-slider', function () {
            $(document).trigger('startApplicationPublished:closeSlider');
        });

        // Custom event handlers for Slider 2
        $(document).on('startApplicationPublished:openSlider', function (e, caseId, staffObject) {
            loadPlDetails(caseId, staffObject);
            $('#startApplicationPublishedSlider').addClass('open').attr('aria-hidden', 'false');
        });

        $(document).on('startApplicationPublished:closeSlider', function () {
            $('#startApplicationPublishedSlider').removeClass('open').attr('aria-hidden', 'true');
        });

          function loadPlDetails(caseId,staffObject) {
           
            $('#staffId').val(staffObject.id);
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
            $("#pl_basic_data").val(JSON.stringify(basicData));          
        }

        function activatePLStep(step) {

        console.log('Activating Step:', step);

        // Hide all steps
        $('#plStep1, #plStep2').addClass('d-none').hide();

        // Show selected step
        $('#plStep' + step).removeClass('d-none').show();

        // Scroll slider body to top
        $('#startApplicationPublishedSlider .slide-body').scrollTop(0);
    }

      $(document).on('click', '#plCategoryBackBtn', function () {
            activatePLStep(1);
        });



     $('#plFormStep1').on('submit', function(e) {

                e.preventDefault();

                    let selectedVacancies = [];

                    $('#plFormStep1 .row-select:checked').each(function () {

                        selectedVacancies.push({
                            id: $(this).val(),
                            school_name: $(this).data('school-name'),
                            udise_code: $(this).data('udise-code'),
                            post_name: $(this).data('post-name')
                        });

                    });


                    // No selection
                    if (selectedVacancies.length === 0) {
                        alert('कृपया किमान एक पद निवडा (Please select at least one post)');
                        return;
                    }

                 console.log('Selected Vacancies:', selectedVacancies);


                // Build second slide
                renderCategoryPublishedSlide(selectedVacancies);

                // Move Step 1 -> Step 2
                activatePLStep(2);

                return false;
            });


 function renderCategoryPublishedSlide(vacancies)
            {
                let html = '';

                $.each(vacancies, function (index, vacancy) {

                    html += `
                        <tr>
                            <td class="vacancy-published111"
                                    data-vacancy-id="${vacancy.id}">${index + 1}</td>
                            <td>${vacancy.school_name}</td>
                            <td>${vacancy.udise_code}</td>
                            <td>${vacancy.post_name}</td> 
                             <td>
                                <select
                                    class="form-select vacancy-published"
                                    data-vacancy-id="${vacancy.id}">

                                    <option value="">श्रेणी निवडा </option>
                                    <option value="SC">SC</option>
                                    <option value="ST">ST</option>
                                    <option value="OBC">OBC</option>
                                    <option value="VJNT">VJNT</option>
                                    <option value="EWS">EWS </option>
                                    <option value="GENERAL">General</option>
                                </select>
                            </td>                       
                        </tr>
                    `;

                });

                $('#plSelectedVacancyList').html(html);          

            }


        $('#plFormStep2').submit(function(e) {
                e.preventDefault();

                let selectedData = [];
                let isValid = true;
                                

                $('.vacancy-published').each(function () {

                    let vacancyId = $(this).data('vacancy-id');
                    let udiseCode = $(this).data('udise-code');   
                    let category = $(this).val();


                    if (!category) {

                        isValid = false;

                        $(this).addClass('is-invalid');

                    } else {

                        $(this).removeClass('is-invalid');

                    }


                        selectedData.push({
                            vacancy_id: vacancyId,
                            udise_code: udiseCode,
                            category: category
                            });           

                    

                });

                 if (!isValid) {

                    alert('Please select category for every vacancy.');

                    return false;
                }

                console.log('Final Data:', selectedData);
                                    
                submitVacancypublish(selectedData);

        });

        function submitVacancypublish(selectedData)
                {
                  
                let pl_remark = $('#pl_remark').val();
                let formData = new FormData();

                    formData.append('post_advertisement_id',$('#pl_basic_data').val());

                    selectedData.forEach(function (item, index) {
                        formData.append(
                            `vacancies[${index}][vacancy_id]`,
                            item.vacancy_id
                        );

                          formData.append(
                            `vacancies[${index}][category]`,
                            item.category
                        );
                    });

                    formData.append('remark',pl_remark);                   
                    formData.append('action','publish');              

                        // Debug
                        for (let pair of formData.entries()) {
                            console.log(pair[0], pair[1]);
                        }


                   $.ajax({
                        url: '<?php echo $this->Url->build(['prefix' => 'Recruit',"controller" => "Sanstha", "action" => "processVacacyPublish"]); ?>',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                        },
                        beforeSend: function () {
                            $('#plSubmitBtn_step6')
                                .prop('disabled', true)
                                .html(
                                    '<i class="fas fa-spinner fa-spin"></i> Saving...'
                                );

                        },
                        success: function(response) {
                            console.log(response);
                            //alert(response.message);
                            if(response.success){
                                ng2g_id = response.id;
                                alert(response.message);
                                if(response.success){
                                    location.reload();
                                }
                            }
                            // Handle success
                        },
                        error: function(xhr, status, error) {
                            let message = 'Unable to submit application.';

                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                message = xhr.responseJSON.message;
                            }

                            alert(message);
                            $('#plSubmitBtn_step6')
                                .prop('disabled', false)
                                .html('<i class="bi bi-send-check"></i> अर्ज सबमिट करा');

                        }
                    });




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










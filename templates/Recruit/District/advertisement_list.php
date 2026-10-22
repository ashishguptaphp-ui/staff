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
        z-index: 9999;
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

    /* Slider */
#startApplicationViewSlider {
    z-index: 1050;
}



#saRejectReasonModal {
    z-index: 10001 !important;
}

#saApproveReasonModal {
    z-index: 10001 !important;
}
#approvedOrderPdfModal {
    z-index: 10010 !important;
}
.modal-backdrop {
    z-index: 10000 !important;
}

#saActionButtons {
    display: none;
}


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

.reject-reasons {
    margin-top: 10px;
}


.reject-check {
    display: flex !important;
    align-items: center !important;
    padding-left: 0 !important;
}

.reject-check .form-check-input {
    position: static !important;
    margin: 0 10px 0 0 !important;
    flex-shrink: 0;
}

.reject-check .form-check-label {
    margin: 0 !important;
}



.result {
	color: red;
	font-size: small;
}

#panel {
	position: fixed;
	padding-top: 8%;
	padding-bottom: 0;
	padding-left: 0;
	padding-right: 0;
	margin: 0;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
    z-index: 10020;
	background: rgba(255, 255, 255, 0.9);
	display: none;
	text-align: center;
}
</style>

    <style>
        .hidden { display: none; }
        .form-group { margin: 10px 0; }
    </style>

<div class="d-flex justify-content-between align-items-center"
     style="padding: 5px 10px; border-bottom: 2px solid #1a237e;">

    <h5 style="margin:0; color:#1a237e;">
        🔜👨‍💼 जाहिरातींची यादी (Advertisement List)
    </h5>

   

</div>

<!-- Bootstrap + Bootstrap Icons -->
<div style="background: #fff; padding:10px;height: 560px !important;overflow-y: auto;">      
    
        <?php
        $hasOverdueUnapprovedAdvertisement = false;
        $fifteenDaysAgo = time() - (15 * 24 * 60 * 60);
        foreach ($ng2g as $advertisement) {
            $createdAt = $advertisement->created_at ?? null;
            if ($createdAt instanceof \DateTimeInterface) {
                $submittedAt = $createdAt->getTimestamp();
            } elseif (is_numeric($createdAt)) {
                $submittedAt = (int)$createdAt;
            } elseif (is_string($createdAt)) {
                $submittedAt = strtotime($createdAt);
            } else {
                $submittedAt = false;
            }

            if (
                strtolower(trim((string)$advertisement->status)) !== 'approved'
                && $submittedAt !== false
                && $submittedAt <= $fifteenDaysAgo
            ) {
                $hasOverdueUnapprovedAdvertisement = true;
                break;
            }
        }
        ?>

        <?php //if ($hasOverdueUnapprovedAdvertisement): ?>
            <div class="alert alert-warning" role="alert">
                <?= h('संस्थेने शिक्षणाधिकारी / शिक्षण उपसंचालक यांचेकडे जाहिरात परवानगी प्रस्ताव सादर केल्यानंतर त्याबाबतची मान्य / अमान्य बाबतचा निर्णय सादर केलेल्या तारखेपासून १५ दिवसांत देणे बंधनकारक राहील अन्यथा तदनंतर शिक्षणाधिकारी / शिक्षण उपसंचालक यांची परवानगी आहे असे गृहीत धरून संस्था पुढील कार्यवाही करेल. संस्थेकडून पदभरतीमध्ये चुकीची कार्यपद्धती अवलंबल्यास त्यास संस्था व शिक्षणाधिकारी / शिक्षण उपसंचालक जबाबदार राहतील.') ?>
            </div>
        <?php //endif; ?>

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
                $idx =1;
               foreach ($ng2g as $request): 

                $approvedLogDocument = $approvedLogDocuments[$request->id] ?? null;
                   
                $approvedLogUrl = null;
                if (!empty($approvedLogDocument)) {
                    $approvedLogUrl = preg_match('/^https?:\/\//i', $approvedLogDocument)
                        ? $approvedLogDocument
                        : $this->Url->build('/' . ltrim($approvedLogDocument, '/'));
                }

                $signedLogUrl = $signedLogDocuments[$request->id] ?? null;

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

                           echo "<a href='#' style='text-decoration:none;'  class='startApplication-open-view me-2' data-mode='2' app-step='1'  data-staffObject='". json_encode($request, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ."' data-id='".$request->id."'> <i class='fa-solid fa-address-card'></i> अर्ज पहा</a><br>";
                           echo "<a href='#' style='text-decoration:none;'  class='startApplicationHistory-open-view me-2' data-mode='2' app-step='1'  data-staffObject='". json_encode($request, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ."' data-id='".$request->id."'> <i class='fa-solid fa-history'></i> टिप्पणी</a><br>";
                            if($request->status === 'forward_superintendent') { 
                            echo "<a href='#' style='text-decoration:none;color:green;' class='approvedApplication-open-transfer' data-staffObject='". json_encode($request, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP)."' data-id='".$request->id."' >
                                    <i class='fa-solid fa-arrow-trend-up'></i>  मंजूर करा
                                </a><br/>";
                            echo "<a href='#' style='text-decoration:none;color:red;' class='rejectBtn'  data-post-id='".$request->id."' >
                                    <i class='fa-solid fa-arrow-trend-down'></i>  नामंजूर करा
                                </a><br/>";
                            }
                           if($approvedLogUrl!=null){
                               echo "<a href='" . h($approvedLogUrl) . "' style='text-decoration:none;' class='approved-order-pdf' data-pdf-title='आदेश'>
                                    <i class='fa-solid fa-reorder'></i>  आदेश
                                </a><br/>";                        
         
                           }
                       
                           
                           if($rejectLogUrl!=null){
                                        echo "<a href='" . h($rejectLogUrl) . "' style='text-decoration:none;' class='approved-order-pdf' data-pdf-title='नकार आदेश'>
                                <i class='fa-solid fa-reorder'></i>  नकार आदेश
                            </a><br/>";
                           }
                         
                        ?>                 
                         
                    </td>
                </tr>
                <?php $idx++; endforeach; ?>
            </tbody>
        </table>
       
</div>

<div class="modal fade" id="approvedOrderPdfModal" tabindex="-1" aria-labelledby="approvedOrderPdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" style="max-width: 92vw;">
        <div class="modal-content" style="height: 90vh;">
            <div class="modal-header">
                <h5 class="modal-title" id="approvedOrderPdfModalLabel">आदेश</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <iframe id="approvedOrderPdfFrame" title="आदेश PDF" src="about:blank" style="width: 100%; height: 100%; border: 0;"></iframe>
            </div>
        </div>
    </div>
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
                                <td> <input type="checkbox"  name="post_ids[]" class="row-select" value="<?= h($vacant->id) ?>"></td>
                                <td>
                                    <?= h($vacant->school_name) ?> 
                                </td>
                                <td>
                                    <?= h($vacant->udise_code) ?>
                                </td>                                    
                                <td>                     
                                    <?= h($vacant->post_name) ?>
                                </td>     
                              
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                
                     </div>

                    <div class="pdf-field">
                        <h3 class="section-title">Roster</h3>
                        <div class="row mt-1">
                            <div class="col-md-3 mt-2">
                                <label for="advApprovelFile" class="form-label english-label required-field">
                                     Roster file 
                                </label>                                
                            </div>    
                            <div class="col-md-3">
                                <input type="file" id="advApprovelFile" name="advApprovelFile" class="form-control file-upload-check" accept=".pdf" required>      
                            </div>      
                        </div>                    
                        <hr/>                        
                    </div> 

                    <div class="pdf-field">
                        <h3 class="section-title">Sanch Manyata Document</h3>
                        <div class="row mt-2">
                            <div class="col-md-2 mt-2">
                                <label for="signatureFile" class="form-label english-label required-field">
                                     Sanch Manyata Document
                                </label>                                
                            </div>    
                            <div class="col-md-3">
                                <input type="file" id="signatureFile" name="signatureFile" class="form-control file-upload-check" accept=".pdf" required>      
                            </div>      
                        </div>    
                        <hr/>                        
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



<!-- Slide History Panel -->
<div id="startApplicationHistorySlider" class="slide-panel" aria-hidden="true" style="border:3px solid #537895;">
     <!-- Header -->
    <div class="slide-header d-flex justify-content-between align-items-center">
        <div style="width:100%;">
            <h5 class="mb-0"><i class="fas fa-arrow-trend-up me-1"></i> नवीन जाहिरात मंजुरी अर्ज </h5>
            <!--<small class="text-muted">Case ID: <span id="caseId"></span></small>-->
            
           
        </div>
        <button class="btn btn-sm btn-outline-danger startApplicationHistory-close-slider">X</button>
    </div>

    <!-- Body -->
    <div class="slide-body">
        <div class="form-container">
            <div id="saStep1">
                <form id="saFormStep1" enctype="multipart/form-data">
                    <input type="hidden" id="sa_basic_data">
                    <div style="background: #fff; padding:10px;">       
        

                <div class="section" id="saApplicationDetails_history">
                                    
                </div>
                <section style="background-color: #F0F2F5;">
                    <div class="container py-5">
                        <div class="main-timeline" id="saTimelineContainer">
                            <!-- Timeline items will be dynamically inserted here -->
                           
                        </div>
                    </div>
                </section>               
                                                          
                
                   
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

<?php echo $this->element('recruit/district/approved') ?>

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

                    <div class="section" id="saApplicationDetails">
                      
                    </div>
              


                    <div style="background: #fff; padding:10px;">       
        

                    <table id="staffTable" class="table table-bordered table-striped table-hover align-middle">
                        <thead class="table-light">
                        <tr>
                            <th>अनु. क्र.</th>
                            <th>शाळेचे नाव</th> 
                            <th>UDISE Code</th> 
                            <th>पदाचे नाव</th>
                            <th>श्रेणी</th>
                            <th>वेतनश्रेणी</th>
                           
                        </tr>
                        </thead>
                        <tbody id="adv_post_list">                        
                       
                        </tbody>
                    </table>
                
                     </div>

                    <div class="pdf-field">
                          <div id="periodDivShow"></div>           
                    </div>


                       <div class="pdf-field" >
                        <h3 class="section-title">संस्थेचा ठराव</h3>
                        <div class="row mt-1">
                            <div class="col-md-3 mt-2">
                                <label for="resolutionFile" class="form-label english-label">
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

                    <div class="pdf-field" id="roster_section111">
                        <h3 class="section-title">Roster</h3>
                        <div class="row mt-1">
                            <div class="col-md-3 mt-2">
                                <label for="advApprovelFile" class="form-label english-label">
                                     Roster file 
                                </label>                                
                            </div>    
                            <div class="col-md-3" id="adv_post_approval_file">
                                <a>View Document</a>
                            </div>      
                        </div>                    
                        <hr/>                        
                    </div> 

                      <div class="pdf-field">
                        <h3 class="section-title">संच मान्यता दस्तऐवज</h3>
                        <div class="row mt-2">
                            <div class="col-md-2 mt-2">
                                <label for="signatureFile" class="form-label english-label">
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
<div class="slide-footer">
    <div class="row align-items-center" id="sa_footerBox">

        <!-- Message -->
        <div class="col-md-6" id="sa_footerMsgBox"></div>

        <!-- Action Buttons -->
        <div class="col-md-6 text-end" id="saActionButtons">

            <!--button type="button"
                    id="saApproveBtn"
                    data-post-id=""
                    class="btn btn-success btn-sm me-2">
                <i class="fas fa-check me-1"></i>
                Approve
            </button-->

            <!--button type="button"
                    id="saRejectBtn"
                    data-post-id=""
                    class="btn btn-danger btn-sm me-2">
                <i class="fas fa-times me-1"></i>
                Reject
            </button-->

         

        </div>

    </div>
</div>

</div>


<!-- Approve Reason Modal -->
<div class="modal fade"
     id="saApproveReasonModal"
     tabindex="-1"
     aria-labelledby="saApproveReasonModalLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <h5 class="modal-title" id="saApproveReasonModalLabel">
                    <i class="fas fa-check-circle me-1"></i>
                    Approve Application
                </h5>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <input type="hidden" id="saApprovePostId">

                <div class="mb-3">

                    <label class="form-label">
                        Approve Reason
                        <span class="text-danger">*</span>
                    </label>

                    <textarea
                        id="saApproveReason"
                        class="form-control"
                        rows="5"
                        placeholder="Enter approve reason..."
                        maxlength="1000"></textarea>

                    <div id="saApproveReasonError"
                         class="text-danger mt-1"
                         style="display:none;">
                        Please enter approve reason.
                    </div>

                </div>

            </div>

            <div class="modal-footer">

                <button type="button"
                        class="btn btn-secondary btn-sm"
                        data-bs-dismiss="modal">
                    Cancel
                </button>

                <button type="button"
                        id="saSubmitApproveBtn"
                        class="btn btn-success btn-sm">
                    <i class="fas fa-paper-plane me-1"></i>
                    Submit Approve
                </button>

            </div>

        </div>

    </div>

</div>

<!-- Reject Reason Modal -->
<div class="modal fade"
     id="saRejectReasonModal"
     tabindex="-1"
     aria-labelledby="saRejectReasonModalLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header bg-danger text-white">

                <h5 class="modal-title" id="saRejectReasonModalLabel">
                    <i class="fas fa-times-circle me-1"></i>
                    Reject Application
                </h5>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <input type="hidden" id="saRejectPostId">

                <div class="reject-reasons">

    <div class="form-check reject-check">
        <input
            class="form-check-input"
            type="checkbox"
            name="issues[]"
            value="१. बिंदूनामावली सादर नाही."
            id="issue1"
        >
        <label class="form-check-label" for="issue1">
            बिंदूनामावली सादर नाही.
        </label>
    </div>

    <div class="form-check reject-check">
        <input
            class="form-check-input"
            type="checkbox"
            name="issues[]"
            value="२. पदे गोषवारा नाही."
            id="issue2"
        >
        <label class="form-check-label" for="issue2">
            पदे गोषवारा नाही.
        </label>
    </div>

    <div class="form-check reject-check">
        <input
            class="form-check-input"
            type="checkbox"
            name="issues[]"
            value="३. रिक्त पदांची माहिती नाही."
            id="issue3"
        >
        <label class="form-check-label" for="issue3">
            रिक्त पदांची माहिती नाही.
        </label>
    </div>

    <div class="form-check reject-check">
        <input
            class="form-check-input"
            type="checkbox"
            name="issues[]"
            value="४. अनुकंपा माहिती नाही."
            id="issue4"
        >
        <label class="form-check-label" for="issue4">
            अनुकंपा माहिती नाही.
        </label>
    </div>

</div>

             <textarea
                        id="saRejectReason"
                        class="form-control mt-3"
                        rows="6"
                        placeholder="Enter reject reason..."
                        maxlength="1000"></textarea>

                   <div id="saRejectReasonError"
                         class="text-danger mt-1"
                         style="display:none;">
                        Please enter reject reason.
                    </div>        


                

            </div>

            <div class="modal-footer">

                <button type="button"
                        class="btn btn-secondary btn-sm"
                        data-bs-dismiss="modal">
                    Cancel
                </button>

                <button type="button"
                        id="saSubmitRejectBtn"
                        class="btn btn-danger btn-sm">
                    <i class="fas fa-paper-plane me-1"></i>
                    Submit Reject
                </button>

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
            loadReturnViewDetails(caseId, staffObject);
            $('#startApplicationHistorySlider').addClass('open').attr('aria-hidden', 'false');
        });

        $(document).on('startApplicationHistory:closeSlider', function () {
            $('#startApplicationHistorySlider').removeClass('open').attr('aria-hidden', 'true');
        });



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
          $('#saActionButtons').hide();
       
          document.getElementById("adv_post_list").innerHTML = '';

            $.ajax({
                url: '<?= $this->Url->build(["prefix" => "Recruit","controller" => "GeneralUtilities", "action" => "getAdvertisementVacancies"]); ?>',
                type: 'Post',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                },
                    success: function (response) {
                    if(response.success){
                            const minoritySanstha = String(response.data.minority_sanstha ?? '');
                            if (minoritySanstha === '2' || minoritySanstha === '3') {
                                $('#roster_section').hide();
                            } else {
                                $('#roster_section').show();
                            }
                            ng2g = response.data.ng2g;
                            postId = ng2g.id;
                            status = ng2g.status;
                            document.getElementById("saApplicationDetails").innerHTML = response.data.sansthaRecordDiv;
                            document.getElementById("saApplicationDetails_history").innerHTML = response.data.sansthaRecordDiv;
                            document.getElementById("adv_post_list").innerHTML = response.html;
                            document.getElementById("periodDivShow").innerHTML = response.data.periodDivShow;
                            document.getElementById("cadetailsDivShow").innerHTML = response.data.cadetailsDivShow;

                            //document.getElementById("saAuditTableBody").innerHTML = response.audithtml;  
                            document.getElementById("saTimelineContainer").innerHTML = response.data.auditLogsHistory || '<div class="timeline-item left"><div class="card"><div class="card-body p-4"><h3 class="text-center">No audit history found.</h3></div></div></div>';                          
                            $('#saApproveBtn').attr('data-post-id', postId);
                            $('#saRejectBtn').attr('data-post-id', postId);
                            $('#saSendBackCorrectionBtn').attr('data-post-id', postId);
                            $('#saClarificationBtn').attr('data-post-id', postId);
                               // Hide buttons first
                            $('#saActionButtons').hide();

                            // Show only when status is pending
                            if (status && status.toLowerCase() === 'forward_superintendent') {
                                $('#saActionButtons').show();
                            }
                            if (response.data.approvalLetterUrl) {
                                $('#adv_post_approval_file').html(`
                                    <a href="${escapeHtml(response.data.approvalLetterUrl)}" target="_blank" rel="noopener">
                                        View Document
                                    </a>`);
                            } else {
                                $('#adv_post_approval_file').html('<span class="text-muted">Document not available</span>');
                            }

                            if (response.data.resolutionFileUrl) {
                                $('#adv_resolution_file').html(`
                                    <a href="${escapeHtml(response.data.resolutionFileUrl)}" target="_blank" rel="noopener">
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
             // 1. At least one row checkbox must be selected
            const rowChecks = document.querySelectorAll('.row-select:checked');
            if (rowChecks.length === 0) {
                alert('कृपया किमान एक पद निवडा (Please select at least one post)');
                return false;
            }
            var formData = new FormData(this);
            console.log(Object.fromEntries(formData));
            console.log('All post_ids:', formData.getAll('post_ids[]'));

            $.ajax({
                url: '<?= $this->Url->build(['prefix' => 'Recruit',"controller" => "Sanstha", "action" => "processVacacyRequest"]); ?>',
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
                        alert(response.message);
                        if(response.success){
                            location.reload();
                        }
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


$(document).on('click', '#saApproveBtn', function () {
    let postId = $(this).data('post-id');
    let action ='Approve';        
    $('#saApprovePostId').val(postId);

    // Clear previous reason
    $('#saApproveReason').val('');

    $('#saApproveReasonError').hide();

    
     // Keep the modal outside the slider stacking context so it stays above the backdrop.
    const modalElement = document.getElementById('saApproveReasonModal');
    if (modalElement.parentElement !== document.body) {
        document.body.appendChild(modalElement);
    }

    bootstrap.Modal.getOrCreateInstance(modalElement).show();

    //loadApprovedPost(postId,action);
});

$(document).on('click', '#saRejectBtn, .rejectBtn', function () {
    let postId = $(this).data('post-id');
    let action ='reject';                            
    console.log('Reject Post ID:', postId);

    // Store Post ID
    $('#saRejectPostId').val(postId);

    // Clear previous reason
    $('#saRejectReason').val('');

    $('#saRejectReasonError').hide();

  // Keep the modal outside the slider stacking context so it stays above the backdrop.
    const modalElement = document.getElementById('saRejectReasonModal');
    if (modalElement.parentElement !== document.body) {
        document.body.appendChild(modalElement);
    }

    bootstrap.Modal.getOrCreateInstance(modalElement).show();

});


$(document).on('click', '#saSubmitApproveBtn', function () {

    let postId = $('#saApprovePostId').val();
    let reason = $.trim($('#saApproveReason').val());

    if (reason === '') {

        $('#saApproveReasonError').show();

        $('#saApproveReason').focus();

        return;
    }

    $('#saApproveReasonError').hide();

    loadApprovedPost(
        postId,
        'approve',
        reason
    );
});

$(document).on('click', '#saSubmitRejectBtn', function () {

    let postId = $('#saRejectPostId').val();
    let reason = $.trim($('#saRejectReason').val());

     const checked = document.querySelectorAll(
        'input[name="issues[]"]:checked'
    );
    const issues = Array.from(checked, (checkbox) => checkbox.value);

    if (checked.length === 0) {

      alert('Please select at least one reject reason.');

        return false;
    }

    if (reason === '') {

        $('#saRejectReasonError').show();

        $('#saRejectReason').focus();

        return;
    }


     // Create HTML
    let finalReason = '';

    issues.forEach(function (issue) {
        finalReason += '<p>' + issue + '</p>';
    });

    // Add manually entered reason
    finalReason += '<p>' + reason + '<br></p>';


    $('#saRejectReasonError').hide();

    loadApprovedPost(
        postId,
        'reject',
        finalReason
    );
});



$(document).on('click', '#saSendBackCorrectionBtn', function () {
    let postId = $(this).data('post-id');
    let action ='correction';                            
    loadApprovedPost(postId,action);
});

$(document).on('click', '#saClarificationBtn', function () {
    let postId = $(this).data('post-id');
    let action ='clarification';                            
    loadApprovedPost(postId,action);
});

$(document).on('click', '.approved-order-pdf', function (event) {
    event.preventDefault();
    const pdfTitle = this.dataset.pdfTitle || 'आदेश';
    $('#approvedOrderPdfModalLabel').text(pdfTitle);
    $('#approvedOrderPdfFrame').attr('title', pdfTitle + ' PDF');
    $('#approvedOrderPdfFrame').attr('src', this.href);
    $('#approvedOrderPdfModal').modal('show');
});

$('#approvedOrderPdfModal').on('hidden.bs.modal', function () {
    $('#approvedOrderPdfFrame').attr('src', 'about:blank');
});

loadApprovedPost = function(PostId,action,reason=''){
                  
         var formData = new FormData();
         formData.append('post_id', PostId); 
         formData.append('action', action); 
         if (action === 'reject') {
            formData.append('reject_reason', reason);
        }
        if (action === 'approve') {
            formData.append('remark', reason);
        }
           console.log('Approve Post ID:', PostId);
            $.ajax({
                url: '<?= $this->Url->build(['prefix' => 'Recruit',"controller" => "District", "action" => "advertisementPostApprovel"]); ?>',
                type: 'Post',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                },
                  beforeSend: function () {
                    $('#saSubmitRejectBtn,#saSubmitApproveBtn')
                                .prop('disabled', true)
                                .html(
                                    '<i class="fas fa-spinner fa-spin me-1"></i> Processing...'
                                );
                        },
                    success: function (response) {
                    if(response.success){
                         $('#saRejectReasonModal').modal('hide');
                         location.reload();
                                                 
                    }
                    
                },
                error: function () {
                    $("#returnHtmlForm").html('<option>Error loading data</option>');
                }
            });
        }

</script>
<script src="<?= h($this->Url->build('/js/dscapi-conf.js')) ?>?v=<?= (int)filemtime(WWW_ROOT . 'js' . DS . 'dscapi-conf.js') ?>"></script>
<script src="<?= h($this->Url->build('/js/dsc-signer.js')) ?>?v=<?= (int)filemtime(WWW_ROOT . 'js' . DS . 'dsc-signer.js') ?>"></script>

<div id="panel" style="display:none;"></div>
<input type="hidden" id="signingReason" value="Staff onboarding work order approval">
<input type="hidden" id="signingLocation" value="District Office">
<input type="hidden" id="tsaURL" value="">
<input type="hidden" id="timeServerURL" value="">
<input type="hidden" id="stampingX" value="200">
<input type="hidden" id="stampingY" value="50">

<script>
    $(document).on('click', '.approvedApplication-open-transfer', function () {
            
            const caseId = $(this).data('id');    
            let staff = $(this).data('staffobject');
                        $('#approvalForm')[0].reset();
                        $('#workOrderFile').empty();
                        $('#workOrderBtn').prop('disabled', false).show().html('<i class="fas fa-check-circle me-1"></i> वर्क ऑर्डर तयार करा');
                        $('#approvedBtn').prop('disabled', true).addClass('d-none');
            $(document).trigger('approvedApplication:openSlider', [caseId, staff]);
        });

        // Close slider
        $(document).on('click', '.approvedApplication-close-slider', function () {
            $(document).trigger('approvedApplication:closeSlider');
        });

        // Custom event handlers for Slider 2
        $(document).on('approvedApplication:openSlider', function (e, caseId,staff) {
            console.log('Approved Application Case ID:', caseId);
            console.log('Approved Application Staff:', staff);
            //loadApprovedTransferDetails(caseId,staff);
             $("#app_sanstha_name").html(staff.institution_name);
             $("#app_sanstha_code").html(staff.institution_code);
             $("#approve_form_id").val(caseId);
            $('#approvedApplicationSlider').addClass('open').attr('aria-hidden', 'false');
        });

        $(document).on('approvedApplication:closeSlider', function () {
            $('#approvedApplicationSlider').removeClass('open').attr('aria-hidden', 'true');
        });



    $('#workOrderBtn').on('click', function (e) {

            e.preventDefault();
            const form = $(this).closest('form')[0];

            if (!form) {
                console.error('Form not found');
                return;
            }

            let formData = new FormData(form);
            let approvalId = $("#approve_form_id").text().trim();
            //$('#approve_form_id').val(approvalId);
            $('#approve_form_remark').val($('#app_remark').val().trim());
            formData = new FormData(form);
            $.ajax({
                url: '<?= $this->Url->build(["controller" => "District", "action" => "advertisementGenrateFile"]); ?>',
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
                            }).attr('download', `advt_order_${staffId}.pdf`));
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
    </script>



<script>

 $(document).ready(function() {
    
var initConfig = {
        "preSignCallback" : function() {
            // do something 
            // based on the return sign will be invoked
            return true;
        },
        "postSignCallback" : function(alias, sign, key) {
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
                                        
                                        $('#downloadDiv').addClass('btn btn-info');
                                        var pdfData = jsonData.sig;
                                        $('#signedPdfData').val(pdfData);
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


$('#approvalForm').on('submit', function (e) {

        e.preventDefault();
        let formData = new FormData(this);
        let PostId = $("#approve_form_id").val();
        let action ='approve';    
        let reason = $.trim($('#app_remark').val());
        let signedPdfData = $('#signedPdfData').val();                        
        formData.append('post_id', PostId); 
        formData.append('action', action); 
        formData.append('remark', reason);
        formData.append('signed_pdf_data', signedPdfData);

           console.log('Approve Post ID:', PostId);
            $.ajax({
                url: '<?= $this->Url->build(['prefix' => 'Recruit',"controller" => "District", "action" => "advertisementPostApprovelEO"]); ?>',
                type: 'Post',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                },
                  beforeSend: function () {
                    $('#approvedBtn')
                                .prop('disabled', true)
                                .html(
                                    '<i class="fas fa-spinner fa-spin me-1"></i> Processing...'
                                );
                        },
                    success: function (response) {
                    if(response.success){
                         location.reload();
                                                 
                    }
                    
                },
                error: function () {
                    $("#returnHtmlForm").html('<option>Error loading data</option>');
                }
            });


   });

    });



</script>
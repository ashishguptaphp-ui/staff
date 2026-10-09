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
    right: -40%;
    width: 40%;
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
    padding: 16px;
    overflow-y: auto;
}
</style>
<h5 style="padding:10px; color: #1a237e; border-bottom: 2px solid #1a237e;">
        <!--👩‍🏫 Teaching Staff | 👨‍💼 Non-Teaching Staff-->
        🔜👨‍💼 List of Non-Granted Teaching Staffs 
        <!--<small style="float:right;">
            <button type="button" id="syncUdiseButton" class="btn btn-sm btn-warning">
                Load UD+ Data for all Staffs
            </button>
        </small>-->
</h5>
<!-- Bootstrap + Bootstrap Icons -->
<div style1="background: #fff; padding:10px;">      
    <div class="tab-content">
        <div class="tab-pane fade show active" id="all">
        

        <table id="staffTable" class="table table-bordered table-striped table-hover align-middle">
            <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Staff Name</th>                
                <th>IMP IDs <small>(as UD+)</small></th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>                        
                <?php 
                $idx =1;
                //dd($staffs);
                
                foreach ($staffs as $staff): 
                    if(($staff->current_post_aid_type=='PARTIALLY AIDED') || ($staff->current_post_aid_type=='100%_AIDED')){
                        continue;
                    }
                    if(!empty($staff->photo_base64)){
                       // $imgData="data:image/jpeg;base64,".$staff->photo_base64;
                        $imgData=$staff->photo_base64;
                    }else{
                        $imgData="https://eu.ui-avatars.com/api/?name=".$staff->emp_name."&size=50";
                    }
                   
                    
                ?>
                <tr>
                    <td><?= h($idx++) ?></td>
                    <td style="display: flex;align-items: center;gap: 5px;">
                        <img src="<?= h($imgData) ?>" class="rounded-circle me-2" style="width:50px;height:50px;">
                        <?= h(trim($staff->emp_name)) ?>
                        <br/><?= h($staff->mobile) ?>
                        <br><?= h($staff->email) ?>
                    </td>
                    
                    <td>
                        EmpStaffID - <?= h($staff->emp_staff_id) ?><br/>
                        NationalID - <?= h($staff->nat_tch_id) ?></td>
                   
                     <td>
                        <?= \Cake\Utility\Inflector::humanize(
                                \Cake\Utility\Inflector::underscore($staff->staff_update_status)
                        ) ?>

                        <br/>
                         <button class="btn btn-primary badge bg-danger text-light action-ud js-open-transfer" data-id="NGG-2025-001">
                            <i class="fa-solid fa-arrow-trend-up"></i> Process Transfer
                        </button>
                              
                            
                      
                    
                    </td>
                    
                    
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
                    
        </div>
    </div>
</div>

<!-- Slide Panel -->
<div id="transferSlider" class="slide-panel" aria-hidden="true">

    <!-- Header -->
    <div class="slide-header d-flex justify-content-between align-items-center">
        <div>
            <h6 class="mb-0">Non-Granted → Granted Transfer</h6>
            <small class="text-muted">Case ID: <span id="caseId"></span></small>
        </div>
        <button class="btn btn-sm btn-outline-secondary js-close-slider">×</button>
    </div>

    <!-- Body -->
    <div class="slide-body">
        <h6>Basic Details</h6>
        <table class="table table-sm">
            <tr><th>Employee Name</th><td id="empName"></td></tr>
            <tr><th>Designation</th><td id="designation"></td></tr>
            <tr><th>School</th><td id="school"></td></tr>
            <tr><th>Status</th><td>Non-Granted → Granted</td></tr>
        </table>

        <h6>Process Status</h6>
        <ul class="list-group list-group-flush mb-3">
            <li class="list-group-item">✔ Submitted</li>
            <li class="list-group-item">⏳ Under Scrutiny</li>
            <li class="list-group-item text-muted">Verification</li>
            <li class="list-group-item text-muted">Approval</li>
        </ul>

        <h6>Remarks</h6>
        <p class="text-muted" id="remarks"></p>
    </div>

    <!-- Footer -->
    <div class="slide-footer text-end">
        <button class="btn btn-danger btn-sm">Reject</button>
        <button class="btn btn-success btn-sm">Approve</button>
        <button class="btn btn-secondary btn-sm js-close-slider">Close</button>
    </div>

</div>
<input type="hidden" value="<?= h($school->udise_code) ?>" id="sID">

<script src="slide-panel.js">
   
</script>

<script>
  
$(document).ready(function() {
  
    // Open slider
$(document).on('click', '.js-open-transfer', function () {
    const caseId = $(this).data('id');
    $(document).trigger('transfer:openSlider', [caseId]);
});

// Close slider
$(document).on('click', '.js-close-slider', function () {
    $(document).trigger('transfer:closeSlider');
});

// Custom events
$(document).on('transfer:openSlider', function (e, caseId) {
    loadTransferDetails(caseId);
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
function loadTransferDetails(caseId) {
    $('#caseId').text(caseId);
    $('#empName').text('Shri Ramesh Patil');
    $('#designation').text('Assistant Teacher');
    $('#school').text('ZP Primary School, Pune');
    $('#remarks').text('Case under scrutiny by Education Officer.');
}


/////////////////////////////
    $('#submitBtn').click(function() {
        
        $('#submitBtn').hide();
        
        $('#responseMessage').show();
        const shalarth_id = $('#confirmShalarthId').val();

        // Validation before AJAX call
        if (!currentStaffId) {
            alert('An unexpected issue occurred. Please reload the page and reselect the staff member.');
            return;
        }

        var selectedValue = $('input[name="shalarthOption"]:checked').val();
        if(selectedValue ==1){

       
       
            if(!(isShalarthIdAvl && (shalarth_id == currentShalarthId))){          

                $('#responseMessage').html('<span class="text-danger">The Shalarth ID available in UDISE+ does not match the one entered for this staff member. Please verify the ID, and if your entry is correct, update the accurate Shalarth ID in UDISE+ before proceeding with staff data updates.</span>');
                $('#submitBtn').show();
                $('#responseMessage').show();
                return false;

            }
            // alert(isShalarthIdAvl +'-------'+ shalarth_id +'===' + currentShalarthId);return false;
            $.ajax({
                url: '<?= $this->Url->build(["controller" => "School", "action" => "updateShalarthData"]); ?>',
                type: 'POST',
                contentType: 'application/json', 
                dataType: 'json',                
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') // CakePHP CSRF header
                },
                data: JSON.stringify({           
                    staff_id: currentStaffId,
                    shalarth_id: shalarth_id,
                    is_shalarth_id_avl: isShalarthIdAvl,
                    _Token:'ZGVlcGFraHBhdGlsMzAwODE5ODA='
                }),
                beforeSend: function() {
                    $('#responseMessage').html('<span class="text-info"><div class="text-info d-flex align-items-center"><div class="spinner-border spinner-border-sm me-2" role="status"></div><span>Processing...</span></div></span>');
                },
                success: function(response) {
                
                    if(response.response.statusCode == 1){
                        $('#responseMessage').html('<span class="text-success">' + response.response.message + '</span>');                    
                        $('#proceedDiv').html('Please <a href="'+baseUrl+'school/staff-profile/'+currentStaffId+'"><button id="proceedBtn" type="button" class="btn btn-success btn-lg rounded-pill shadow"><i class="bi bi-shield-check me-2"></i> click here </button></a> to proceed and complete the remaining information for this staff member.');
                        $('#proceedDiv').fadeIn(800);
                        
                    }else{
                        $('#responseMessage').html('<span class="text-danger">' + response.response.message + '</span>');
                        $('#submitBtn').show();
                    }
                    
                },           
                error: function(xhr) {
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
            $('#responseMessage').html('<span class="text-warning">Would you like to process adding this staff as self-financed?</span>');                    
            $('#proceedDiv').html('Please <a href="'+baseUrl+'school/on-board-udise-staff/'+currentStaffId+'"><button id="proceedBtn" type="button" class="btn btn-success btn-lg rounded-pill shadow"><i class="bi bi-shield-check me-2"></i> click here </button></a> to proceed and complete the remaining information for this staff member.');
            $('#proceedDiv').fadeIn(800);
        }

       
    });
    /***
     * 
     * Udise Pluse Sync
     */
    // Show overlay when sync starts
    function showSyncLoading() {
        $("#okButton").hide();
        $("#overlaSpiner").show();
        $("#overlaSyncMsg").show();
        
        $("#syncUdiseLoadingOverlay").css("display", "flex");
    }


    // Hide overlay when sync completes
    function hideSyncLoading() {
        $("#syncUdiseLoadingOverlay").hide();
        $("#overlaSpiner").hide();
        $("#overlaSyncMsg").hide();
    }

    $("#okButton").on("click", function () {
        $("#syncUdiseLoadingOverlay").fadeOut(500);
    });

    const messages = [
        "Connecting to UDISE+ Server...",
        "Connecting to UDISE+ Server...",
        "Retrieving Teaching Staff records...",
        "Retrieving Non-Teaching Staff records...",
        "Updating UDISE+ records into Staff Portal database..."
      ];

      let index = 0;

      function showNextMessage() {
        if (index < messages.length) {
          $("#syncMessage").fadeOut(700, function () {
            $(this).css("color", "orange").text(messages[index]).show();
          });
          index++;
          setTimeout(showNextMessage, 1000); // change message every 700 ms
        } else {
          // After last message
          $("#syncMessage").fadeOut(500, function () {
            $(this).css("color", "green")
                   .text("✔ The synchronization of your school’s UDISE+ staff records with the Staff Portal database has been successfully completed....")
                   .fadeIn(500);
          });
          $("#okButton").show();
          $("#overlaSpiner").hide();
          $("#overlaSyncMsg").hide();
                    
        }
      }

    // usage with AJAX 
    function syncUdiseData() {
        showSyncLoading();

        
        $.ajax({
            url: '<?= $this->Url->build(["controller" => "School", "action" => "updateUdiseData"]); ?>',
            type: 'POST',
            contentType: 'application/json', 
            dataType: 'json',                
            headers: {
                'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') // CakePHP CSRF header
            },
            data: JSON.stringify({           
                school_id: $("#sID").val(),
                _Token:'ZGVlcGFraHBhdGlsMzAwODE5ODA='
            }),
            beforeSend: function() {
                $('#responseMessage').html('<span class="text-info"><div class="text-info d-flex align-items-center"><div class="spinner-border spinner-border-sm me-2" role="status"></div><span>Processing...</span></div></span>');
                index = 0;
                showNextMessage();
            },
            success: function(response) {
               
                if(response.response.statusCode == 1){
                    $('#responseMessage').html('<span class="text-success">' + response.response.message + '</span>');                    
                    $('#proceedDiv').html('Please <a href="'+baseUrl+'school/staff-profile/'+currentStaffId+'"><button id="proceedBtn" type="button" class="btn btn-success btn-lg rounded-pill shadow"><i class="bi bi-shield-check me-2"></i> click here </button></a> to proceed and complete the remaining information for this staff member.');
                    $('#proceedDiv').fadeIn(800);
                     
                }else{
                    $('#responseMessage').html('<span class="text-danger">' + response.response.message + '</span>');
                    $('#submitBtn').show();
                }
                
            },           
            error: function(xhr) {
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


        // Simulate AJAX request (replace with actual $.ajax call)
        /*setTimeout(function () {
        //hideSyncLoading();
        alert("UDISE+ Data Sync Completed Successfully!");
        
        }, 5000);*/
    }

    // Example: trigger sync on button click
    $(document).on("click", "#syncUdiseButton", function () {
        syncUdiseData();
    });
});
</script>



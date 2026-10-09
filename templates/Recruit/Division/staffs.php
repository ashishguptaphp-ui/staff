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
           
<h5 style="padding:10px; color: #1a237e; border-bottom: 2px solid #1a237e;">
        <!--👩‍🏫 Teaching Staff | 👨‍💼 Non-Teaching Staff-->
        👨‍💼 List of Staffs 
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
        <div class="row mb-2">
            <div class="col-md-4">
                <input type="text" id="globalSearch" class="form-control form-control-sm"
                    placeholder="🔍 Search all columns">
            </div>

            <div class="col-md-3">
                <input type="text" id="staffNameFilter" class="form-control form-control-sm"
                    placeholder="Filter Staff Name">
            </div>

            <div class="col-md-3">
                <select id="staffTypeFilter" class="form-select form-select-sm">
                <option value="">All Staff Types</option>
                <option value="Teaching">Teaching</option>
                <option value="Non-Teaching">Non-Teaching</option>
                </select>
            </div>
        </div>

        <table id="staffTable" class="table table-bordered table-striped table-hover align-middle">
            <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Staff Name</th>
                <th>StaffType</th>                
                <th>IMP IDs <small>(as UD+)</small></th>                                
                <th>LastSync</th>
                <th>SyncNow</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>                        
                <?php 
                $idx =1;
                //dd($staffs);
                
                foreach ($staffs as $staff): 
                    if(!empty($staff->photo_base64)){
                       // $imgData="data:image/jpeg;base64,".$staff->photo_base64;
                        $imgData=$staff->photo_base64;
                    }else{
                        $imgData="https://eu.ui-avatars.com/api/?name=".$staff->emp_name."&size=50";
                    }
                    if($staff->emp_type == 2){
                        $emp_type = "Non-Teaching";
                    }else{
                        $emp_type = "Teaching";
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
                    <td><?= h($emp_type) ?></td>
                   
                    <td>ShalarthID - <?= h($staff->shalarth_code) ?><br/>
                        EmpStaffID - <?= h($staff->emp_staff_id) ?><br/>
                        NationalID - <?= h($staff->nat_tch_id) ?></td>
                   
                
                    <td>
                        Shalarth : 
                        <?= h(!empty($staff->shalarth_updated_at) ? date('d/m/Y H:i', strtotime($staff->shalarth_updated_at)) : '') ?>
                        <br/>
                        Udise+ : <?= h(!empty($staff->udise_updated_at) ? date('d/m/Y H:i', strtotime($staff->udise_updated_at)) : '') ?>
                        <br/>
                    </td>
                    
                    <td>
                        
                         <?php 
                                $onBoardBtn = "";
                                $shalarthCls = 'danger';
                                $shalarthTextCls = 'light';
                                if($staff->is_onboarded){ 
                                    if(!empty($staff->shalarth_updated_at)) {
                                        $onBoardBtn = "Load from Shalarth";
                                        $shalarthCls = 'info';
                                        $shalarthTextCls = 'dark';
                                    }
                                }else{
                                    $onBoardBtn = "Onboard";
                                }
                            
                            ?> 
                            <?php if(!empty($onBoardBtn)) { ?> 
                                <span class="badge bg-<?= h($shalarthCls) ?> text-<?= h($shalarthTextCls) ?> action-ud" style="padding:5px;cursor: pointer;" data-bs-toggle="modal" data-bs-target="#onboardingModal"
                                    data-staff-id="<?= h($staff->id) ?>" 
                                    data-emp_name="<?= h($staff->emp_name) ?>"
                                    data-shalarth-id="<?= h($staff->shalarth_code) ?>">
                                        &rarr; <?= h($onBoardBtn) ?>
                                </span>
                            <?php } ?>
                        
                       
                             <br/>
                                <span class="badge bg-warning text-dark action-ud"  style="margin-top:10px;padding:5px;cursor: pointer;"
                                    onclick="updateUdiseDataByEmpID('<?= h($staff->id) ?>', '<?= h($staff->emp_type) ?>', '<?= h($staff->emp_staff_id) ?>')">
                                    &rarr; Load from UD+
                                </span>

                        
                       

                         
                         
                    </td>
                     <td>
                        <?= \Cake\Utility\Inflector::humanize(
                                \Cake\Utility\Inflector::underscore($staff->staff_update_status)
                        ) ?>

                        <br/>
                        <?php if($staff->is_onboarded){ ?>                     
                            <a target="_blank" style="text-decoration: none;" href="<?= $this->Url->build(['controller' => 'Staffs', 'action' => 'profile', $staff->id]) ?>">
                            <span class="badge bg-light text-primary action-ud"><i class="fas fa-eye"></i> View</span>
                            </a>
                            <?php if($staff->staff_update_status == 'in_progress'){ ?>  
                                <br/> 
                                <a style="text-decoration: none;" href="<?= $this->Url->build(['controller' => 'School', 'action' => 'staffProfile', $staff->id]) ?>">
                                    <span class="badge bg-danger text-light action-ud"><i class="fa-solid fa-pen-to-square"></i> Update</span>
                                </a>
                            <?php } ?>
                         <?php } ?>
                    
                    </td>
                    
                    
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
                    
        </div>
    </div>
</div>


<!-- Shalarth on boarding Modal -->
<div class="modal fade" id="onboardingModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 60%;">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                <i class="fas fa-school me-2"></i>Staff Onboarding
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <!-- Body -->
            <div class="modal-body bg-light rounded-3 shadow-sm p-4">
                <div class="text-center mb-3">
                    <h5 class="fw-bold text-primary mb-1">Verify Staff Identity</h5>
                    <p class="text-muted small">
                        Please confirm <strong>Shalarth ID</strong> for <strong><span id="autoEmpName"></span></strong>.  <br/>
                        If you don’t have one, mark it as <em>Not Available</em> and continue.
                    </p>
                </div>
                <!-- Option Toggle -->
                <div class="btn-group w-100 mb-3" role="group" aria-label="Shalarth ID option">
                    <input type="radio" class="btn-check" name="shalarthOption" id="hasShalarth" value="1" autocomplete="off" checked>
                    <label class="btn btn-outline-primary" for="hasShalarth">
                    <i class="bi bi-key me-1"></i> Shalarth ID Available
                    </label>

                    <input type="radio" class="btn-check" name="shalarthOption" id="noShalarth" vaue="0" autocomplete="off">
                    <label class="btn btn-outline-warning" for="noShalarth">
                    <i class="bi bi-x-circle me-1"></i> Shalarth ID Not Available
                    </label>
                </div>

                <!-- Input field (shown only if user has Shalarth ID) -->
                <div id="shalarthInputSection" class="mb-3">
                    <label for="confirmShalarthId" class="form-label fw-semibold">
                    <i class="bi bi-person-badge-fill text-primary me-1"></i> Shalarth ID
                    </label>
                    <input 
                    type="text" 
                    class="form-control form-control-lg border-primary shadow-sm" 
                    id="confirmShalarthId" 
                    placeholder="Enter your Shalarth ID" 
                    required 
                    />
                    <div class="form-text text-muted">
                    Your Shalarth ID will be used to verify your employment details.
                    </div>
                </div>

                <!-- Confirm Button -->
                <div class="d-grid mt-4">
                    <div id="responseMessage" style="display:none;padding: 10px;border: 1px dashed gray;"></div>
                    <br/>
                    <button id="submitBtn" type="button" class="btn btn-primary btn-lg rounded-pill shadow">
                    <i class="bi bi-shield-check me-2"></i> Confirm & Proceed
                    </button>
                    <div id="proceedDiv" style="display:none"></div>
                </div>
            </div>

    


            <!-- Footer Navigation -->
            <div class="modal-footer">
                <!--<button class="btn btn-success" id="finishBtn">Finish</button>-->
            </div>
        </div>
    </div>
</div>



<!-- UDISE Staff Sync Modal -->
<div class="modal fade" id="udiseSyncModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 60%;">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                <i class="fas fa-school me-2"></i>Updateding Information from UDISE+
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <!-- Body -->
            <div class="modal-body bg-light rounded-3 shadow-sm p-4">
                

                

                        <div>
                    <div class="loader"></div>
                    <div class="text">Loading, please wait...</div>
                    </div>
            </div>

    


            <!-- Footer Navigation -->
            <div class="modal-footer">
                <!--<button class="btn btn-success" id="finishBtn">Finish</button>-->
            </div>
        </div>
    </div>
</div>


<!-- Udise+ on boarding Modal -->
<div id="syncUdiseLoadingOverlay" class="sync-overlay">
  <div class="sync-box">
    <div class="spinner" id="overlaSpiner"></div>
    <h5 class="sync-message" id="overlaSyncMsg">
      Data synchronization from <strong>UDISE+</strong> for all staff is currently in progress.<br>
      Please wait while the process completes…</h5>
    <div id="syncMessage" >--- Initializing Sync Process ---</div>
    
    <button id="okButton">OK</button>
  </div>
</div>


<input type="hidden" value="<?= h($school->udise_code) ?>" id="sID">


<script>
$(document).ready(function () {

  function filterTable() {
    let globalSearch = $('#globalSearch').val().toLowerCase();
    let staffName = $('#staffNameFilter').val().toLowerCase();
    let staffType = $('#staffTypeFilter').val().toLowerCase();

    $('#staffTable tbody tr').each(function () {
      let rowText = $(this).text().toLowerCase();
      let nameText = $(this).find('td:eq(1)').text().toLowerCase();
      let typeText = $(this).find('td:eq(2)').text().toLowerCase();

      let showRow =
        rowText.includes(globalSearch) &&
        nameText.includes(staffName) &&
        typeText.includes(staffType);

      $(this).toggle(showRow);
    });
  }

  $('#globalSearch, #staffNameFilter').on('keyup', filterTable);
  $('#staffTypeFilter').on('change', filterTable);

});
</script>



  <script>
      var baseUrl = "<?= $this->Url->build('/', ['fullBase' => true]); ?>";
      function toggleLanguage() {
        const isEnglish = document.getElementById('title-en').style.display !== 'none';
        document.getElementById('title-en').style.display = isEnglish ? 'none' : 'block';
        document.getElementById('title-mr').style.display = isEnglish ? 'block' : 'none';
        document.getElementById('subtitle-en').style.display = isEnglish ? 'none' : 'block';
        document.getElementById('subtitle-mr').style.display = isEnglish ? 'block' : 'none';
        }
        function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('active');
    }
  </script>

  
<script>
    var currentShalarthId="";
    var currentStaffId="";
    
    var isShalarthIdAvl = true;
    
    const onboardingModal = document.getElementById('onboardingModal');
    onboardingModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Button that triggered the modal
        const empName = button.getAttribute('data-emp_name'); // Get Emp Name from button
        const shalarthId = button.getAttribute('data-shalarth-id'); // Get Shalarth ID from button
        const staffId = button.getAttribute('data-staff-id'); // Get Staff ID from button
        // Set Shalarth ID next to the label
        document.getElementById('autoEmpName').textContent = empName || 'N/A';
        currentShalarthId = shalarthId ;
        currentStaffId = staffId;
        $('#submitBtn').show();
        $('#proceedDiv').hide();
        $('#responseMessage').hide();
        $('#confirmShalarthId').val('');
        isShalarthIdAvl=true; 
    });

    window.updateUdiseDataByEmpID=function(staffId,emp_type,emp_staff_id) {
       
        $.ajax({
                url: '<?= $this->Url->build(["controller" => "School", "action" => "updateUdiseDataByEmpId"]); ?>',
                type: 'POST',
                contentType: 'application/json', 
                dataType: 'json',                
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') // CakePHP CSRF header
                },
                data: JSON.stringify({           
                    staff_id: staffId,
                    emp_staff_id: emp_staff_id,
                    emp_type: emp_type,
                    _Token:'ZGVlcGFraHBhdGlsMzAwODE5ODA='
                }),
                beforeSend: function() {
                    $('#responseMessage').html('<span class="text-info"><div class="text-info d-flex align-items-center"><div class="spinner-border spinner-border-sm me-2" role="status"></div><span>Processing...</span></div></span>');
                },
                success: function(response) {
                
                   
                    
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
    };
</script>


<script>
  
$(document).ready(function() {
  
    
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


<script>
   
$(document).ready(function () {

 
  $('input[name="shalarthOption"]').on('click', function () {
    if ($(this).attr('id') === 'hasShalarth') {     
        isShalarthIdAvl=true; 
      $('#shalarthInputSection').show();
      $('#confirmShalarthId').prop('required', true).focus();
    } else {
       isShalarthIdAvl=false;
        if (!(!currentShalarthId || currentShalarthId.trim() === "")) {
            alert("As per UDISE+, a Shalarth ID "+currentShalarthId+" is already associated with this staff member. If the staff belongs to an unaided category and the Shalarth ID has been linked by mistake, please remove the Shalarth ID from UDISE+ before proceeding to update the staff details.");
             isShalarthIdAvl=true; 
            return false;
        }
      $('#shalarthInputSection').hide();
      $('#confirmShalarthId').prop('required', false).val('');
    }

    // Optional: log selected option
    console.log('User selected:', $(this).attr('id') === 'hasShalarth' ? 'Has Shalarth ID' : 'Not Available');
  });
});
</script>

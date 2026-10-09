<main>
    <div class="container-fluid">
        <div class="container" style="padding-top:40px;">
            <!-- Bootstrap + Bootstrap Icons -->
            <div style="background: #fff; padding:10px;">
                <h4>Teaching Staff</h4>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="all">

                    <table class="table table-bordered table-striped table-hover align-middle">
                        <thead class="table-light">
                        <tr>
                            <th>SrNo</th>
                            <th>Staff Name</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Onboard</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>                        
                            <?php 
                            $idx =1;
                            foreach ($staffs as $staff): 
                                if(!empty($staff->photo_base64)){
                                    $imgData="data:image/jpeg;base64,".$staff->photo_base64;
                                }else{
                                    $imgData="https://eu.ui-avatars.com/api/?name=".$staff->emp_name."&size=50";
                                }
                                
                            ?>
                            <tr>
                                <td><?= h($idx++) ?></td>
                                <td>
                                    <img src="<?= h($imgData) ?>" class="rounded-circle me-2" style="height:50px;">
                                    <?= h(trim($staff->emp_name)) ?>
                                </td>
                                <td><?= h($staff->mobile) ?></td>
                                <td><?= h($staff['email']) ?></td>
                            
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#onboardingModal"
                                    data-staff-id="<?= h($staff->id) ?>" 
                                    data-emp_name="<?= h($staff->emp_name) ?>"
                                    data-shalarth-id="<?= h($staff->shalarth_code) ?>">
                                    
                                        Onboard 
                                    </button>
                                </td>
                                <td>
                                <a href="<?= $this->Url->build(['controller' => 'School', 'action' => 'staffProfile', $staff->id]) ?>">
                                <button class="btn btn-sm btn-primary"><i class="fas fa-eye"></i> View </button>
                                </a>
                                </td>
                            
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Multi-Step Modal -->
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
                    <input type="radio" class="btn-check" name="shalarthOption" id="hasShalarth" autocomplete="off" checked>
                    <label class="btn btn-outline-primary" for="hasShalarth">
                    <i class="bi bi-key me-1"></i> Shalarth ID Available
                    </label>

                    <input type="radio" class="btn-check" name="shalarthOption" id="noShalarth" autocomplete="off">
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

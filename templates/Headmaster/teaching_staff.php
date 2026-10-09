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
                        <th>Teacher Name</th>
                        <th>Position</th>
                        <th>Social Category</th>
                        <th>Aided Status</th>
                        <th>UDISE ID</th>
                        <th>Shalarth ID</th>
                        <th>Onboard</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($teachers as $teacher): ?>
                        <tr>
                            <td>
                                <img src="https://i.pravatar.cc/40?img=<?= rand(1, 70) ?>" class="rounded-circle me-2">
                                <?= h(trim($teacher->tchr_fname . ' ' . $teacher->tchr_mname . ' ' . $teacher->tchr_lname)) ?>
                            </td>
                            <td><?= h($teacher->tchr_type) ?></td>
                            <td><?= h($teacher['tchr_caste_categ']) ?></td>
                            <td> <!-- Aided Status, optional: add from DB if exists --> </td>
                            <td>
                                <?= $teacher->tchr_slno_udise ? h($teacher->tchr_slno_udise) : '<span class="text-danger"><i class="fas fa-times-circle"></i> Missing</span>' ?>
                            </td>
                            <td>
                                <?= $teacher->tchr_cd_shalarath ? h($teacher->tchr_cd_shalarath) : '<span class="text-danger"><i class="fas fa-times-circle"></i> Missing</span>' ?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#loadingModal"
                                 data-tchr-id="<?= h($teacher->tchr_id) ?>" 
                                  data-shalarth-id="<?= h($teacher->tchr_cd_shalarath) ?>">
                                    Onboard
                                </button>
                            </td>
                            <td>
                            <a href="<?= $this->Url->build(['controller' => 'Headmaster', 'action' => 'staffProfile', $teacher->tchr_id]) ?>">
                            <button class="btn btn-sm btn-primary"><i class="fas fa-eye"></i> View</button>
                            </a>
                            </td>
                           
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

               <!-- Multi-Step Modal -->
            <div class="modal fade" id="loadingModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 60%;">
                <div class="modal-content">

                <!-- Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                    <i class="fas fa-school me-2"></i>Teacher Onboarding
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <!-- Body -->
                <div class="modal-body">
                    <!-- Step Progress Indicator -->
                    <div class="d-flex justify-content-between mb-4">
                    <div class="step-circle" id="step1Circle">1</div>
                    <div class="flex-fill border-top mx-2"></div>
                    <div class="step-circle" id="step2Circle">2</div>
                    <div class="flex-fill border-top mx-2"></div>
                    <div class="step-circle" id="step3Circle">3</div>
                    </div>

                    <!-- Step 1: Fetch UDISE+ -->
                    <div class="step-content" id="step1">
                    <h6 class="fw-bold mb-3">Fetching Data from UDISE+</h6>
                    <p class="text-muted">Please wait while we retrieve Udise+ details…</p>
                    <div class="text-center">
                        <div class="spinner-border text-primary" role="status"></div>
                    </div>
                    </div>

                    <!-- Step 2: Confirm Shalarth ID -->
                    <div class="step-content d-none" id="step2">
                    <h6 class="mb-3">
                        <u><strong>Shalarth ID:</strong> <span id="autoShalarthId" ></span></u>
                    </h6>
                    <div class="mb-3">
                        <label style="font-size:14px;">Re-enter Shalarth ID for confirmation</label>
                        <input type="text" class="form-control" id="confirmShalarthId" placeholder="Enter Shalarth ID">
                        <!-- <div id="shalarthError" class="text-danger">Shalarth ID does not match!</div> -->
                        
                        
                    </div>
                    <div id="fetchStatus" class="small text-muted"></div>
                    </div>

                    <!-- Step 3: Preview -->
                    <div class="step-content d-none" id="step3">
                    <h6 class="fw-bold mb-3">Preview Details</h6>
                    <div class="border rounded p-3 bg-light">
                        <p><strong>School Name:</strong> <span id="previewSchoolName"></span></p>
                        <p><strong>UDISE+ Code:</strong> <span id="previewUdise"></span></p>
                        <p><strong>Shalarth ID:</strong> <span id="previewShalarth"></span></p>
                        <!-- Add more preview fields as required -->
                    </div>
                    </div>
                </div>

                <!-- Footer Navigation -->
                <div class="modal-footer">
                    <button class="btn btn-secondary" id="prevBtn" disabled>Previous</button>
                    <button class="btn btn-primary" id="nextBtn">Next</button>
                    <button class="btn btn-success d-none" id="finishBtn">Finish</button>
                </div>
                </div>
            </div>
            </div>

            <!-- Styles for steps -->
            <style>
            .step-circle {
            width: 36px; height: 36px;
            border-radius: 50%;
            background-color: #e9ecef;
            display: flex; align-items: center; justify-content: center;
            font-weight: 600; color: #6c757d;
            }
            .step-circle.active {
            background-color: #0d6efd;
            color: #fff;
            }
            </style>

              </div>
            </div>
            </div>


        </div>
    </div>
</main>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
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
let step = 1;

function updateSteps() {
  // circles
  document.querySelectorAll('.step-circle').forEach((c, i) => {
    c.classList.toggle('active', i < step);
  });
  // contents
  document.querySelectorAll('.step-content').forEach((el, i) => {
    el.classList.toggle('d-none', i + 1 !== step);
  });
  // buttons
  document.getElementById('prevBtn').disabled = step === 1;
  document.getElementById('nextBtn').classList.toggle('d-none', step === 3);
  document.getElementById('finishBtn').classList.toggle('d-none', step !== 3);
}

document.getElementById('nextBtn').onclick = function () {
  if (step < 3) step++;
  updateSteps();
};
document.getElementById('prevBtn').onclick = function () {
  if (step > 1) step--;
  updateSteps();
};
document.getElementById('finishBtn').onclick = function () {
  // final submit or PDF trigger
  alert('Submitting final data!');
};

updateSteps();
</script>
<script>
    const loadingModal = document.getElementById('loadingModal');
loadingModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget; // Button that triggered the modal
    const shalarthId = button.getAttribute('data-shalarth-id'); // Get Shalarth ID from button

    // Set Shalarth ID next to the label
    document.getElementById('autoShalarthId').textContent = shalarthId || 'N/A';
});
</script>
<script>

    document.getElementById('nextBtn').addEventListener('click', function() {
    // Check validation if we are on step 2
    if (step === 2) {
        const dynamicId = document.getElementById('autoShalarthId').textContent.trim();
        const userInput = document.getElementById('confirmShalarthId').value.trim();

        if (dynamicId !== userInput) {
            // Show error and prevent moving forward
            document.getElementById('shalarthError').style.display = 'block';
            return; // stops moving to next step
        } else {
            // Hide error if it matches
            document.getElementById('shalarthError').style.display = 'none';
        }
    }

    // Move to next step if validation passes
    if (step < 3) step++;
    updateSteps();
});

</script>
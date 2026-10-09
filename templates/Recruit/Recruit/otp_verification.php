<div class="row justify-content-center align-items-center min-vh-80 py-5">
  <div class="col-md-6 col-lg-5">
    <div class="card shadow-lg border-0 rounded-4">
      <div class="card-body p-5">
        <div class="text-center mb-4">
          <img src="https://www.student.maharashtra.gov.in/stud_db/assets/images/logo.png" alt="GoM Logo" height="70">
          <h4 class="mt-3 fw-semibold text-primary">OTP Verification</h4>
          <p class="text-muted small mb-0">Staff Portal - School Education & Sports Department</p>
        </div>

        <?= $this->Flash->render() ?>

        <p class="text-center text-secondary mb-4">
          Enter the 6-digit verification code sent to your registered mobile number <strong><?= h($mobile ?? 'XXXXXXXXXX') ?></strong>
        </p>

        <?= $this->Form->create(null, ['url' => ['action' => 'verifyOtp'], 'class' => 'otp-form']) ?>

          <div class="d-flex justify-content-center gap-2 mb-4">
            <?php for ($i = 0; $i < 6; $i++): ?>
              <input type="text" maxlength="1" name="otp[]" class="form-control text-center fs-4 fw-bold otp-input"
                     style="width: 50px; height: 55px; border-radius: 10px; border: 1px solid #ced4da;"
                     required>
            <?php endfor; ?>
          </div>

          <div class="text-center mb-3">
            <button type="submit" class="btn btn-primary px-5 py-2 rounded-pill">
              <i class="fa-solid fa-check-circle me-2"></i>Verify OTP
            </button>
          </div>

          <div class="text-center">
            <p class="text-muted small mb-1">Didn’t receive the OTP?</p>
            <a href="<?= $this->Url->build(['action' => 'resendOtp']) ?>" class="fw-semibold text-decoration-none">
              Resend OTP
            </a>
          </div>

        <?= $this->Form->end() ?>
      </div>
    </div>
  </div>

  <!-- Info / Graphic Section -->
  <div class="col-lg-5 d-none d-lg-block ps-5">
    <div class="h-100 d-flex flex-column justify-content-center">
      <h5 class="fw-bold text-primary mb-3">Empowering Education Digitally</h5>
      <p class="text-secondary">
        Welcome to the <strong>Staff Portal</strong> of the School Education & Sports Department, Government of Maharashtra.
        This platform provides secure and transparent access to teacher data, service records, and school-level digital services.
      </p>
      <div class="row text-center mt-4">
        <div class="col">
          <div class="card shadow-sm border-0 rounded-4 py-3">
            <h4 class="text-primary mb-1"><?= h($totalStaffs ?? '1,24,560') ?></h4>
            <p class="small text-muted mb-0">Total Staffs</p>
          </div>
        </div>
        <div class="col">
          <div class="card shadow-sm border-0 rounded-4 py-3">
            <h4 class="text-success mb-1"><?= h($teachingStaffs ?? '95,340') ?></h4>
            <p class="small text-muted mb-0">Teaching Staffs</p>
          </div>
        </div>
        <div class="col">
          <div class="card shadow-sm border-0 rounded-4 py-3">
            <h4 class="text-warning mb-1"><?= h($nonTeachingStaffs ?? '29,220') ?></h4>
            <p class="small text-muted mb-0">Non-Teaching Staffs</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->Html->scriptStart() ?>
document.querySelectorAll('.otp-input').forEach((input, index, inputs) => {
  input.addEventListener('input', e => {
    if (e.target.value && index < inputs.length - 1) {
      inputs[index + 1].focus();
    }
  });
  input.addEventListener('keydown', e => {
    if (e.key === 'Backspace' && !input.value && index > 0) {
      inputs[index - 1].focus();
    }
  });
});
<?= $this->Html->scriptEnd() ?>

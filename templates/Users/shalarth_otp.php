<?php
/**
 * @var \App\View\AppView $this
 */
$this->assign('title', 'OTP Verification');
?>

      <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header text-center bg-primary text-white rounded-top-4">
          <h4 class="mb-0 fw-bold">OTP Verification</h4>
        </div>
        <div class="card-body p-4">
        <?= $this->Form->create(null) ?>
          <?= $this->Form->create(null, ['url' => ['action' => 'shalarthOtp']]) ?>

          <div class="mb-3 text-center">
            <p class="text-muted mb-1">Enter the 6-digit OTP sent to your registered mobile number - <b><?= $mobile?></b></p>
          </div>

          <div class="mb-4 text-center d-flex justify-content-between gap-2">
            <?php for ($i = 1; $i <= 6; $i++): ?>
              <?= $this->Form->control("otp_$i", [
                  'label' => false,
                  'maxlength' => 1,
                  'class' => 'form-control text-center otp-input',
                  'required' => true,
                  'style' => 'width: 3rem; font-size: 1.5rem;'
              ]) ?>
            <?php endfor; ?>
          </div>

          <div class="d-grid mb-2">
            <?= $this->Form->button(__('Verify OTP'), ['class' => 'btn btn-primary btn-lg fw-bold']) ?>
          </div>

          <div class="text-center mt-3">
            <small>Didn’t receive the code? <a href="#" class="text-primary fw-semibold">Resend OTP</a></small>
          </div>

          <?= $this->Form->end() ?>
        </div>
      </div>
    

<?php
$this->Html->scriptBlock("
  const inputs = document.querySelectorAll('.otp-input');
  inputs.forEach((input, index) => {
    input.addEventListener('input', () => {
      if (input.value.length === 1 && index < inputs.length - 1) {
        inputs[index + 1].focus();
      }
    });
    input.addEventListener('keydown', (e) => {
      if (e.key === 'Backspace' && !input.value && index > 0) {
        inputs[index - 1].focus();
      }
    });
  });
");
?>
<script>
    const inputs = document.querySelectorAll('.otp-input');
    inputs.forEach((input, index) => {
      input.addEventListener('input', (e) => {
        if (e.target.value.length === 1 && index < inputs.length - 1) {
          inputs[index + 1].focus();
        }
      });
      input.addEventListener('keydown', (e) => {
        if (e.key === 'Backspace' && index > 0 && !e.target.value) {
          inputs[index - 1].focus();
        }
      });
    });
  </script>
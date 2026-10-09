   <h3 class="mb-4 text-center">Officials Login</h3>
   <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
  <i class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2 fs-4"></i>
  <div>
    <strong>महत्त्वाची सूचना:</strong>
        कृपया अर्ज प्रक्रियेसाठी <strong>संस्था लॉगिन (संस्था कोड)</strong> वापरावे.
        शाळा/मुख्याध्यापक लॉगिन (UDISE कोड) वापरण्यास सक्त मनाई आहे.  </div>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
        <?= $this->Form->create(null) ?>
       <?= $this->Form->create(null, ['url' => ['action' => 'login']]) ?>
    <div class="mb-3">
        <?= $this->Form->control('username', [
            'label' => 'संस्था कोड / शासकीय अधिकाऱ्यांचा वापरकर्ता आयडी (Username)',
            'class' => 'form-control',
            'required' => true,
            'placeholder' => 'आपला संस्था कोड प्रविष्ट करा',
            'templates' => [
                'inputContainer' => '{{content}}'
            ]
        ]) ?>
    </div>

    <div class="mb-3">
        <?= $this->Form->control('password', [
            'label' => 'Password',
            'type' => 'hidden',
            'class' => 'form-control',
            'required' => true,
            'value' => 'password-less',
            'placeholder' => 'Enter your password',
            'templates' => [
                'inputContainer' => '{{content}}'
            ]
        ]) ?>
    </div>

    <?= $this->Form->button(__('Get Otp'), [
        'class' => 'btn btn-primary w-100 mb-2'
    ]) ?>
    <?= $this->Form->end() ?>
    <!--
    <p class="text-secondary-emphasis bg-light d-inline-block px-3 py-1 rounded-pill mt-4 shadow-sm small">
            ⚡ Staff & Teachers - secure access
        </p>

       
    <?= $this->Html->link(
            '» Continue with Shalarth Login',
            [
                'controller' => 'Users',
                'action' => 'shalarthLogin'
            ],
            [
                'class' => 'btn btn-warning mb-4',
                'escape' => true
            ]
        ); 
    ?>
     <?= $this->Html->link(
            '« Back to Home',
            [
                'controller' => '/',
                'action' => '/'
            ],
            [
                'class' => 'btn btn-secondary',
                'escape' => true
            ]
        ); 
    ?>
    -->

        <!--<div class="mt-3 text-center">
          <a href="#" class="text-decoration-none">Forgot Password?</a>
        </div>-->


   <h3 class="mb-4 text-center">Staff & Teachers Login</h3>
   <p class="text-warning bg-dark d-inline-block px-3 py-1 rounded-pill shadow-sm small">
            ⚡ Login with Shalarth details
        </p>
        <?= $this->Form->create(null) ?>
       <?= $this->Form->create(null, ['url' => ['action' => 'shalarthLogin']]) ?>
    <div class="mb-3">
        <?= $this->Form->control('username', [
            'label' => 'Username',
            'class' => 'form-control',
            'required' => true,
            'placeholder' => 'Enter your username',
            'templates' => [
                'inputContainer' => '{{content}}'
            ]
        ]) ?>
    </div>

    <div class="mb-3">
        <?= $this->Form->control('password', [
            'label' => 'Password',
            'type' => 'password',
            'class' => 'form-control',
            'required' => true,
            'placeholder' => 'Enter your password',
            'templates' => [
                'inputContainer' => '{{content}}'
            ]
        ]) ?>
    </div>

    <?= $this->Form->button(__('Login'), [
        'class' => 'btn btn-primary w-100 mb-2'
    ]) ?>
    <?= $this->Form->end() ?>
    <p class="text-secondary-emphasis bg-light d-inline-block px-3 py-1 rounded-pill mt-4 shadow-sm small">
            ⚡ Officials - secure access
        </p>

       
    <?= $this->Html->link(
            '» Continue with Officials Login',
            [
                'controller' => 'Users',
                'action' => 'shalarthLogin'
            ],
            [
                'class' => 'btn btn-info mb-4',
                'escape' => true
            ]
        ); 
    ?><br/>
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
        <!--<div class="mt-3 text-center">
          <a href="#" class="text-decoration-none">Forgot Password?</a>
        </div>-->


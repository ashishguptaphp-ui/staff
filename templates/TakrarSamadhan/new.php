<?php
$this->assign('title', 'Submit Complaint');
?>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #eef2f7, #d9e4f5);
        }

        .form-card {
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .form-header {
            background: linear-gradient(90deg, #0d6efd, #4dabf7);
            color: white;
            border-radius: 16px 16px 0 0;
            padding: 20px;
        }

        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 0.2rem rgba(13,110,253,.25);
        }

        .char-count {
            font-size: 0.8rem;
            color: gray;
        }

        .required::after {
            content: " *";
            color: red;
        }
    </style>

<div class="container py-1">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card form-card">
                
                <!-- Header -->
                <div class="form-header">
                    <h4 class="mb-0"><i class="bi bi-exclamation-circle"></i> Staff Portal Issue Reporting</h4>
                    <small>Submit your issue and track resolution efficiently</small>
                </div>

                <div class="card-body">
                    <div class="container">
                        <h3 style="color:purple;">
                        <?= $this->Flash->render() ?>
                        </h3>
                        <?= $this->Form->create($complaint, ['type' => 'file']) ?>

                        <div class="row">

                            <!-- Contact Name -->
                            <div class="col-md-6 mb-3">
                                <?= $this->Form->control('contact_name', [
                                    'label' => [
                                        'text' => 'Contact Name',
                                        'class' => 'form-label'
                                    ],
                                    'class' => 'form-control',
                                    'required' => false,
                                    'templates' => [
                                        'inputContainer' => '{{content}}',
                                        'inputContainerError' => '{{content}}'
                                    ]
                                ]) ?>
                            </div>

                            <!-- Contact Mobile -->
                            <div class="col-md-6 mb-3">
                                <?= $this->Form->control('contact_mobile', [
                                    'label' => [
                                        'text' => 'Contact Mobile',
                                        'class' => 'form-label required'
                                    ],
                                    'class' => 'form-control',
                                    'type' => 'tel',
                                    'pattern' => '[0-9]{10}',
                                    'required' => true,
                                    'templates' => [
                                        'inputContainer' => '{{content}}',
                                        'inputContainerError' => '{{content}}{{error}}'
                                    ],
                                    'error' => [
                                        'attributes' => [
                                            'class' => 'invalid-feedback d-block'
                                        ]
                                    ]
                                ]) ?>

                                <div class="invalid-feedback">
                                    Enter valid 10-digit mobile number
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <!-- User Type -->
                            <div class="col-md-6 mb-3">
                                <?= $this->Form->control('user_type', [
                                    'type' => 'select',
                                    'options' => ['staff' => 'Staff',
                                                    'school' => 'School',
                                                    'sanstha' => 'Sanstha',
                                                    'cluster_official' => 'Cluster Official',
                                                    'block_official' => 'Block Official',
                                                    'mahanagar_palika' => 'Mahanagar Palika',
                                                    'nagar_palika' => 'Nagar Palika',
                                                    'division_official' => 'Division Official',
                                                    'state_official' => 'State Official'],
                                    'label' => [
                                        'text' => 'User Type',
                                        'class' => 'form-label required'
                                    ],
                                    'class' => 'form-select',
                                    'required' => true,
                                    'empty' => 'Select Role',
                                    'templates' => ['inputContainer' => '{{content}}']
                                ]) ?>
                            </div>

                            <!-- Username -->
                            <div class="col-md-6 mb-3">
                                <?= $this->Form->control('username', [
                                    'label' => [
                                        'text' => 'Username',
                                        'class' => 'form-label required'
                                    ],
                                    'class' => 'form-control',
                                    'required' => true,
                                    'templates' => ['inputContainer' => '{{content}}']
                                ]) ?>
                            </div>

                        </div>

                        <div class="row">
                            <?php 
                                $issueTypeOptions = [
                                    // Authentication
                                    'login_issue' => 'Login Issue',
                                    'otp_issue' => 'OTP Issue',

                                    // Data & Sync
                                    'data_sync_issue' => 'Data Sync Issue',

                                    // HR / Staffing
                                    'post_data_issue' => 'Sanctioned, Working & Vacancy Posts Issue',
                                    'seniority_list_issue' => 'Staff Seniority List Issue',

                                    // Applications
                                    'individual_permission_issue' => 'Individual Permission Application Issue',
                                    'ng2g_application_issue' => 'Ng2G Application Issue',

                                    // System
                                    'performance_issue' => 'Performance / Slow System',
                                    'permission_issue' => 'Access / Permission Issue',

                                    // Suggested Additions
                                    'data_entry_issue' => 'Data Entry / Save Issue',
                                    'report_issue' => 'Reports / MIS Issue',
                                    'ui_issue' => 'UI / Display Issue',
                                    'file_upload_issue' => 'File Upload Issue',
                                    'integration_issue' => 'Integration / API Issue',
                                    'mobile_issue' => 'Mobile / Device Issue',
                                    'security_issue' => 'Security / Suspicious Activity',
                                    'other_issue' => 'Other'
                                ];

                                $subIssues = [

                                    'login_issue' => [
                                        'invalid_credentials' => 'Invalid Username/Password',
                                        'account_locked' => 'Account Locked',
                                        'unable_to_login' => 'Unable to Login',
                                        'session_timeout' => 'Session Timeout'
                                    ],

                                    'otp_issue' => [
                                        'otp_not_received' => 'OTP Not Received',
                                        'otp_expired' => 'OTP Expired',
                                        'otp_invalid' => 'Invalid OTP'
                                    ],

                                    'data_sync_issue' => [
                                        'data_not_updated' => 'Data Not Updating',
                                        'duplicate_records' => 'Duplicate Records',
                                        'missing_data' => 'Missing Data'
                                    ],

                                    'performance_issue' => [
                                        'slow_loading' => 'Slow Page Loading',
                                        'timeout_error' => 'Timeout Error',
                                        'server_down' => 'Server Not Responding'
                                    ],

                                    'permission_issue' => [
                                        'access_denied' => 'Access Denied',
                                        'role_mismatch' => 'Incorrect Role Assigned',
                                        'module_not_visible' => 'Module Not Visible'
                                    ]
                                ];
                            ?>

                            <!-- Issue Type -->
                            <div class="col-md-6 mb-3">
                                <?= $this->Form->control('issue_type', [
                                    'type' => 'select',
                                    'options' => $issueTypeOptions,
                                    'label' => [
                                        'text' => 'Issue Type',
                                        'class' => 'form-label required'
                                    ],
                                    'class' => 'form-select' . ($this->Form->isFieldError('issue_type') ? ' is-invalid' : ''),
                                    'required' => true,
                                    'empty' => 'Select Issue Type',
                                    'id' => 'issue-type',
                                    'templates' => [
                                        'inputContainer' => '{{content}}',
                                        'inputContainerError' => '{{content}}{{error}}'
                                    ]
                                ]) ?>
                            </div>

                            <!-- Priority -->
                            <div class="col-md-6 mb-3">
                                <?= $this->Form->control('sub_issue', [
                                'type' => 'select',
                                'options' => [],
                                'empty' => 'Select Sub-Issue',
                                'id' => 'sub_issue',
                                'class' => 'form-select'
                            ]) ?>
                            </div>

                        </div>

                         <div class="row">

                            <!-- Issue Type -->
                            <div class="col-md-6 mb-3">
                                <?= $this->Form->control('issue_datetime', [
                                'type' => 'datetime-local',
                                'label' => [
                                    'text' => 'Issue Date & Time',
                                    'class' => 'form-label'
                                ],
                                'class' => 'form-control',
                                'templates' => ['inputContainer' => '{{content}}']
                            ]) ?>
                            </div>

                            <!-- Priority -->
                            <div class="col-md-6 mb-3">
                                <?= $this->Form->control('priority', [
                                    'type' => 'select',
                                    'options' => ['Low'=>'Low','Medium'=>'Medium','High'=>'High','Critical'=>'Critical'],
                                    'label' => [
                                        'text' => 'Priority',
                                        'class' => 'form-label'
                                    ],
                                    'class' => 'form-select',
                                    'default' => 'Medium',
                                    'templates' => ['inputContainer' => '{{content}}']
                                ]) ?>
                            </div>

                        </div>

                       

                        <!-- Remark -->
                        <div class="mb-3">
                            <?= $this->Form->control('remark', [
                                'type' => 'textarea',
                                'label' => [
                                    'text' => 'Remark / Note',
                                    'class' => 'form-label required'
                                ],
                                'class' => 'form-control',
                                'rows' => 4,
                                'maxlength' => 300,
                                'required' => true,
                                'templates' => [
                                    'inputContainer' => '{{content}}',
                                    'inputContainerError' => '{{content}}{{error}}'
                                ],
                                'error' => [
                                    'attributes' => ['class' => 'invalid-feedback d-block']
                                ]
                            ]) ?>

                            <div class="text-end small text-muted">
                                Max 300 characters
                            </div>
                        </div>

                        <!-- Attachment -->
                        <div class="mb-3">
                            <?= $this->Form->control('attachment', [
                                'type' => 'file',
                                'label' => [
                                    'text' => 'Upload Screenshot / File',
                                    'class' => 'form-label'
                                ],
                                'class' => 'form-control',
                                'templates' => ['inputContainer' => '{{content}}']
                            ]) ?>
                        </div>

                        <!-- CAPTCHA -->
                         <div class="row mt-3 p-3 bg-light border rounded">
                            
                            <div class="col-md-6 mb-3 text-center">
                                <label><strong>Solve CAPTCHA</strong></label><br>

                                <span style="
                                    font-size: 22px;
                                    font-weight: bold;
                                    letter-spacing: 4px;
                                    display: inline-block;
                                    padding: 10px 20px;
                                    background: #f1f3f5;
                                    border-radius: 8px;
                                ">
                                    <?= $a ?> 
                                    <span style="color:#0d6efd; padding:0 8px;"><?= $op ?></span> 
                                    <?= $b ?>
                                </span>
                            </div>

                            <div class="col-md-6 mb-3 text-center">
                                <?= $this->Form->control('captcha', [
                                    'label' => 'Enter Answer',
                                    'required' => true,
                                    'class' => 'form-control mt-2 text-center'
                                ]) ?>
                            </div>
                        
                            

                            

                        </div>

                        <br>

                        <?= $this->Form->button('Submit', ['class'=>'btn btn-primary']) ?>

                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    const subIssues = <?= json_encode($subIssues) ?>;

    document.getElementById("issue-type").addEventListener("change", function() {

        const selected = this.value;
        const subIssueDropdown = document.getElementById("sub_issue");

        subIssueDropdown.innerHTML = '<option value="">Select Sub-Issue</option>';

        if (subIssues[selected]) {
            Object.entries(subIssues[selected]).forEach(([key, value]) => {
                subIssueDropdown.innerHTML += `<option value="${key}">${value}</option>`;
            });
        }
    });
</script>
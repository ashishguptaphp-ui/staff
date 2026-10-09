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
        z-index: 1050;
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
    .viewBtn{
        text-decoration: none;
        padding: 3px 10px;
        background: #f0e9e4;
    }
</style>

    <style>
        .hidden { display: none; }
        .form-group { margin: 10px 0; }
    </style>
    
<style>
    .dots-loader{
        color:purple;
        padding:15%;
        font-size:36px;
    }
        .dots-loader::after {
            content: '';
            animation: dots 1.5s steps(3, end) infinite;
        }

        @keyframes dots {
            0% { content: ''; }
            12% { content: ' .'; }
            33% { content: ' . .'; }
            66% { content: ' . . .'; }
            81% { content: ' . . . .'; }
            100% { content: ' . . . . .'; }
        }
        </style>
<h5 style="margin:0px;padding:10px; color: #1a237e; border-bottom: 2px solid #1a237e;">
       
        🔜👨‍💼 List of DYD Officials
      
</h5>
<!-- Bootstrap + Bootstrap Icons -->
<div style="background: #fff; padding:10px;">      
    
        

        <table id="staffTable" class="table table-bordered table-striped table-hover align-middle">
            <thead class="table-light">
            <tr>
                <th>#</th>  
                <th>Role</th>                
                <th>UserID</th>  
                <th>Mobile</th>  
                <th>Email</th>  
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>                        
                <?php 
                $idx =1;
                //dd($staffs);
                $seq = 1;
                foreach ($users as $user): 
                    /*echo "<pre>";
                    print_r($staff);
                    exit;*/
                ?>
                <tr id="emp_row_<?= h($user->id) ?>">
                    <td><?= h($idx++) ?></td>
                   
                    <td>
                        <?= h($user->full_name) ?>                    
                    </td>                    
                    <td>
                        <?= h($user->username) ?>                    
                    </td> 
                    <td>
                        <input type="tel" id="mobile_<?= h($user->id) ?>" required placeholder="e.g. 9876543210" maxlength="10" value="<?= h($user->mobile) ?>">
                                           
                    </td> 
                    <td>
                        <input type="email" id="email_<?= h($user->id) ?>" required placeholder="e.g. user@example.com" value="<?= h($user->email) ?>">
                    </td> 
                    
                    <td>
                        <?php
                            echo "<button  id='contact_row_". $user->id . "' class='btn btn-primary bg-warning' onclick='updateMobile(".$user->id.")'>
                                        <i class='fa-solid fa-address-card'></i>  Update Mobile & Email
                                    </button>&nbsp;&nbsp;&nbsp;&nbsp;";

                           
                     ?>
                       
                         
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
       
</div>



<script>  
    $(document).ready(function() {  

       
        updateMobile = function() {
           
            let userId = arguments[0];
          
            let mobile = $("#mobile_" + userId).val().trim();
            let email = $("#email_" + userId).val().trim();


            if (!/^\d{10}$/.test(mobile)) {
                alert("Please enter a valid 10-digit mobile number.");
                return false;
            }
            var mobilePattern = /^[6-9][0-9]{9}$/;
            if (!mobilePattern.test(mobile)) {
                alert("Please enter a valid 10-digit mobile number starting with 6-9.");
                return false;
            }

            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                alert("Please enter a valid email address.");
                return false;
            }
            
            $.ajax({
                url: '<?= $this->Url->build(["controller" => "Division", "action" => "editUser"]); ?>',
                type: 'POST',
                data: {
                    user_id: userId,
                    mobile: mobile,
                    email: email,
                    _csrfToken: $('meta[name="csrfToken"]').attr('content')
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                },
                beforeSend: function () {
                    // Disable button
                    $('#contact_row_' + userId).prop('disabled', true).html(`
                        <span class="spinner-border spinner-border-sm me-1"></span>
                        Updating...
                    `);
                },
                success: function (response) {
                    console.log(response);
                    if(response.success == false){
                        alert(response.message);
                    } else {
                        alert('Mobile and Email updated successfully.');
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
                    // Enable button again
                    $('#contact_row_' + userId).prop('disabled', false).html(`
                        <i class='fa-solid fa-address-card'></i> Update Mobile & Email
                    `);
                }
            });
        }

});
</script>



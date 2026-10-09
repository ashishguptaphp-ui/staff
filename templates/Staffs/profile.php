
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Staff Profile – Grid View</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .profile-header {
        background: linear-gradient(135deg,#0d6efd,#6610f2);
        color: #fff;
        border-radius: 12px;
    }
    .section-card {
        border-left: 5px solid #0d6efd;
    }
    .sub-card {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 15px;
        height: 100%;
    }
    .field-label {
        font-size: 0.75rem;
        color: #6c757d;
        text-transform: uppercase;
    }
    .field-value {
        font-weight: 600;
    }
</style>

<style>
.timeline {
    position: relative;
    padding: 40px;
}
.timeline::before {
    content: "";
    position: absolute;
    left: 50%;
    top: 0;
    bottom: 0;
    width: 4px;
    background: #dee2e6;
    transform: translateX(-50%);
}
.timeline-item {
    position: relative;
    margin-bottom: 40px;
}
.timeline-item .timeline-dot {
    position: absolute;
    left: 50%;
    top: 20px;
    width: 18px;
    height: 18px;
    background: #0d6efd;
    border-radius: 50%;
    transform: translateX(-50%);
    z-index: 1;
}
.timeline-item .timeline-content {
    width: 46%;
}
.timeline-item.left .timeline-content {
    margin-left: 0;
    margin-right: auto;
}
.timeline-item.right .timeline-content {
    margin-left: auto;
    margin-right: 0;
}
.timeline-card {
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
}
.field-label {
    font-size: 0.72rem;
    text-transform: uppercase;
    color: #6c757d;
}
.field-value {
    font-weight: 600;
}
@media (max-width: 768px) {
    .timeline::before {
        left: 8px;
    }
    .timeline-item .timeline-dot {
        left: 8px;
        transform: none;
    }
    .timeline-item .timeline-content {
        width: 100%;
        margin-left: 30px !important;
    }
}
</style>
<?php 

    //dd($staff);
    if(!empty($staff->photo_base64)){
        //data:image/jpeg;base64,
        $imgData=$staff->photo_base64;
    }else{
        $imgData="https://eu.ui-avatars.com/api/?name=".$staff->emp_name."&size=100";
    }
    ?>
</head>

<body class="bg-light">
    <div class="layout-container">
        <div class="profilecontainer">
            
            <main class="content">
                

                        <div class="card shadow-sm profile-card-horizontal" style="padding:00px;background:#D6EAF8;border:0px;border-radius: 0px;">
                
                            <div class="card-body d-flex align-items-center" style="padding:0px 0px 0px 70px;">
                                
                                <div class="avatar bg-primary text-white rounded-circle me-3 d-flex justify-content-center align-items-center"
                                    style="width:60px; height:60px; font-size:28px;">

                                    <img src="<?= h($imgData) ?>" alt="Profile" class="rounded-circle" style="height:90px;"/>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="row g-1 small">
                                        <div class="col-md-12">
                                            <h6 class="mb-1 fw-bold" style="font-size:14px;color:#8b008b"><?= h($staff->emp_name ?? '') ?></h6>
                                        </div>
                                    
                                    </div>
                            
                                </div>
                                <div class="flex-grow-1" style="text-align:right;">
                                   
                                    <?= $this->Html->image('staff2.png', ['style' => 'height:100px',
                                            'fullBase' => true
                                    ]) ?>
                                    <?= $this->Html->image('staff1.png', ['style' => 'height:100px',
                                            'fullBase' => true
                                    ]) ?>
                                </div>
                            </div>
                        </div>
                    
                   
                
                <!-- ================= BASIC INFORMATION ================= -->
                <div class="card section-card shadow-sm mb-4">
                    <div class="card-header bg-dark text-warning fw-bold">
                        <i class="bi bi-person-badge me-2"></i> Basic Information
                    </div>
                    <div class="card-body" style="padding:0px;">
                        <h6 style="color:#fff;background: #1975fd; padding: 5px 20px; margin:0px;">
                            <i class="bi bi-person-fill"></i> Personal Details
                        </h6>
                        <div class="row" style="margin:0px;">
                            <div class="col-md-12">
                                <div class="sub-card">
                                    <div class="row" style="margin:0px;">
                                        <div class="col-3">
                                            <div class="field-label">Staff Name</div>
                                            <div class="field-value"><?= h($staff->emp_name ?? '') ?></div>
                                        </div>

                                         <div class="col-3">
                                            <div class="field-label">Staff Name as per Aadhaar</div>
                                            <div class="field-value"><?= h($staff->emp_name_per_uid ?? '') ?></div>
                                        </div>

                                         <div class="col-4">
                                            <div class="field-label">Designation</div>
                                            <div class="field-value"><?= h($staff->post->name ?? '') ?> (<?= h($staff->current_post ?? '') ?>)</div>
                                        </div>

                                        <div class="col-2">
                                            <div class="field-label">Staff Type</div>
                                            <div class="field-value"><?= h($staff->staffs_type->staff_type_name ?? '') ?></div>
                                        </div>

                                          <div class="col-2  mt-3">
                                            <div class="field-label">DOB</div>
                                            <div class="field-value"><?= h(!empty($staff->dob) ? date('d/m/Y', strtotime($staff->dob)) : '') ?></div>
                                        </div>
                                        <div class="col-2  mt-3">
                                            <div class="field-label">Gender</div>
                                            <div class="field-value"><?= h($staff->gender->gender_name ?? '') ?></div>
                                        </div>

                                         <div class="col-2 mt-3">
                                            <div class="field-label">Mobile</div>
                                            <div class="field-value"><?= h($staff->mobile ?? '') ?></div>
                                        </div>
                                        <div class="col-3 mt-3">
                                            <div class="field-label">Email ID</div>
                                            <div class="field-value"><?= h($staff->email ?? '') ?></div>
                                        </div>

                                         <div class="col-3 mt-3">
                                            <div class="field-label">Aadhaar Card Number</div>
                                            <div class="field-value"><?= h($staff->adhar_no ?? '') ?></div>
                                        </div>
                                        

                                        <div class="col-2 mt-3">
                                            <div class="field-label">School UD+</div>
                                            <div class="field-value"><?= h($staff->udise_code ?? '') ?></div>
                                        </div>

                                        <div class="col-2 mt-3">
                                            <div class="field-label">DDO Code</div>
                                            <div class="field-value"><?= h($staff->ddo_code ?? '') ?></div>
                                        </div>

                                        <div class="col-2 mt-3">
                                            <div class="field-label">ShalarthID</div>
                                            <div class="field-value"><?= h($staff->shalarth_code ?? '') ?></div>
                                        </div>


                                        <div class="col-2 mt-3">
                                            <div class="field-label">NationalID</div>
                                            <div class="field-value"><?= h($staff->nat_tch_id ?? '') ?></div>
                                        </div>
                                        
                                         <div class="col-2 mt-3">
                                            <div class="field-label">UD+ Emp ID</div>
                                            <div class="field-value"><?= h($staff->emp_staff_id ?? '') ?></div>
                                        </div>
                                         <div class="col-2 mt-3">
                                            <div class="field-label">NationalID</div>
                                            <div class="field-value"><?= h($staff->nat_tch_id ?? '') ?></div>
                                        </div>

                                       


                                       <div class="col-2 mt-3">
                                            <div class="field-label">Current Post Group</div>
                                            <div class="field-value"><?= h($staff->desig_grp ?? '') ?></div>
                                        </div>

                                         <div class="col-2 mt-3">
                                            <div class="field-label">Current Post Aid Type</div>
                                            <div class="field-value"><?= h($staff->current_post_aid_type ?? '') ?></div>
                                        </div>

                                        <div class="col-2 mt-3">
                                            <div class="field-label">Post of Initial Appointment</div>
                                            <div class="field-value">--</div>
                                        </div>

                                        <div class="col-2 mt-3">
                                            <div class="field-label">Nature of Appointment</div>
                                            <div class="field-value">--</div>
                                        </div>

                                        <div class="col-2 mt-3">
                                            <div class="field-label">Shikshan Sevak (Probation)?</div>
                                            <div class="field-value"><?= !empty($staff->shikshan_sevak) && $staff->shikshan_sevak == 1 ? 'Yes' : 'No' ?></div>
                                        </div>
                                        <div class="col-2 mt-3">
                                            <div class="field-label">Mode of Current Post</div>
                                            <div class="field-value">--</div>
                                        </div>



                                        <div class="col-2 mt-3">
                                            <div class="field-label">Mode of Recruitment</div>
                                            <div class="field-value">--</div>
                                        </div>

                                        

                                       
                                         <div class="col-2 mt-3">
                                            <div class="field-label">Current Teaching Subject 1</div>
                                            <div class="field-value">--</div>
                                        </div>

                                        <div class="col-2 mt-3">
                                            <div class="field-label">Current Teaching Subject 2</div>
                                            <div class="field-value">--</div>
                                        </div>

                                         <div class="col-2 mt-3">
                                            <div class="field-label">Recruitment Subject</div>
                                            <div class="field-value">--</div>
                                        </div>
                                        <div class="col-2 mt-3">
                                            <div class="field-label">Social Category</div>
                                            <div class="field-value"><?= h($social_category ?? '') ?></div>
                                        </div>

                                        

                                       
                                        
                                       

                                           
                                        
                                            

                                           
                                       

                                        

                                        

                                        <div class="col-2 mt-3">
                                            <div class="field-label">Recruitment Category</div>
                                            <div class="field-value">--</div>
                                        </div>

                                        <div class="col-2 mt-3">
                                            <div class="field-label">Recruitment Hor. Category</div>
                                            <div class="field-value">--</div>
                                        </div>

                                        <div class="col-2 mt-3">
                                            <div class="field-label">Recruitment PH. Details</div>
                                            <div class="field-value">--</div>
                                        </div>

                                        <div class="col-2 mt-3">
                                            <div class="field-label">Recruitment Orphan Details</div>
                                            <div class="field-value">--</div>
                                        </div>

                                        

                                        <div class="col-2 mt-3">
                                            <div class="field-label">Date of Entry in Service</div>
                                            <div class="field-value"><?= h(!empty($staff->joining_date) ? date('d/m/Y', strtotime($staff->joining_date)) : '') ?></div>
                                        </div>

                                        <div class="col-2 mt-3">
                                            <div class="field-label">Date of Joining District</div>
                                            <div class="field-value"><?= h(!empty($staff->joining_district_date) ? date('d/m/Y', strtotime($staff->joining_district_date)) : '') ?></div>
                                        </div>

                                         
                                        <div class="col-2 mt-3">
                                            <div class="field-label">Date of Joining Block</div>
                                            <div class="field-value"><?= h(!empty($staff->joining_block_date) ? date('d/m/Y', strtotime($staff->joining_block_date)) : '') ?></div>
                                        </div>

                                        <div class="col-3 mt-3">
                                            <div class="field-label">Date of Joining Current Management</div>
                                            <div class="field-value"><?= h(!empty($staff->joining_mgmt) ? date('d/m/Y', strtotime($staff->joining_mgmt)) : '') ?></div>
                                        </div>

                                        <div class="col-3 mt-3">
                                            <div class="field-label">Date of Joining Current School</div>
                                            <div class="field-value"><?= h(!empty($staff->date_of_joining_current_school) ? date('d/m/Y', strtotime($staff->date_of_joining_current_school)) : '') ?></div>
                                        </div>

                                        <div class="col-3 mt-3">
                                            <div class="field-label">Date of Joining Current Designation</div>
                                            <div class="field-value"><?= h(!empty($staff->joining_designation_date) ? date('d/m/Y', strtotime($staff->joining_designation_date)) : '') ?></div>
                                        </div>
                                        <div class="col-3 mt-3">
                                            <div class="field-label">Superannuation Date</div>
                                            <div class="field-value"><?= h(!empty($staff->super_ann_date) ? date('d/m/Y', strtotime($staff->super_ann_date)) : '') ?></div>
                                        </div>
                                           
                                    </div>
                                </div>
                            </div>
                          
                        </div>

                        <h6 style="color:#fff;background: #1975fd; padding: 5px 20px; margin:0px;">
                            <i class="bi bi-building-fill"></i> Permanent Address
                        </h6>
                        <div class="row" style="margin:0px;">                            
                            <div class="col-md-12">
                                <div class="sub-card">
                                    <div class="row" style="margin:0px;">
                                        <div class="col-12">
                                            <div class="field-label">Address</div>
                                            <div class="field-value">--</div>
                                        </div>

                                          <div class="col-3  mt-3">
                                            <div class="field-label">Village / Town</div>
                                            <div class="field-value">--</div>
                                        </div>

                                        <div class="col-3  mt-3">
                                            <div class="field-label">Block / Taluka</div>
                                            <div class="field-value">--</div>
                                        </div>

                                        <div class="col-2  mt-3">
                                            <div class="field-label">District</div>
                                            <div class="field-value">--</div>
                                        </div>

                                        <div class="col-2  mt-3">
                                            <div class="field-label">State</div>
                                            <div class="field-value">--</div>
                                        </div>

                                        <div class="col-2  mt-3">
                                            <div class="field-label">Pincode</div>
                                            <div class="field-value">--</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                         
                        </div>

                        <h6 style="color:#fff;background: #1975fd; padding: 5px 20px; margin:0px;">
                            <i class="bi bi-map-fill"></i> Correspondence Address
                        </h6>
                        <div class="row" style="margin:0px;">                            
                            <div class="col-md-12">
                                <div class="sub-card">
                                    <div class="row" style="margin:0px;">
                                        <div class="col-12">
                                            <div class="field-label">Address</div>
                                            <div class="field-value">--</div>
                                        </div>

                                          <div class="col-3  mt-3">
                                            <div class="field-label">Village / Town</div>
                                            <div class="field-value">--</div>
                                        </div>

                                        <div class="col-3  mt-3">
                                            <div class="field-label">Block / Taluka</div>
                                            <div class="field-value">--</div>
                                        </div>

                                        <div class="col-2  mt-3">
                                            <div class="field-label">District</div>
                                            <div class="field-value">--</div>
                                        </div>

                                        <div class="col-2  mt-3">
                                            <div class="field-label">State</div>
                                            <div class="field-value">--</div>
                                        </div>

                                        <div class="col-2  mt-3">
                                            <div class="field-label">Pincode</div>
                                            <div class="field-value">--</div>
                                        </div>
                                    </div>
                                </div>
                            </div>                        
                        </div>

                         <h6 style="color:#fff;background: #1975fd; padding: 5px 20px; margin:0px;">
                            <i class="bi bi-intersect"></i> Other Details
                        </h6>
                        <div class="row" style="margin:0px;">                            
                            <div class="col-md-12">
                                <div class="sub-card">
                                    <div class="row" style="margin:0px;">
                                        <div class="col-2">
                                            <div class="field-label">Marital Status</div>
                                            <div class="field-value">--</div>
                                        </div>

                                          <div class="col-2">
                                            <div class="field-label">Mother Tongue</div>
                                            <div class="field-value">--</div>
                                        </div>

                                        <div class="col-2">
                                            <div class="field-label">Blood Group</div>
                                            <div class="field-value">--</div>
                                        </div>

                                        <div class="col-2">
                                            <div class="field-label">Election Card No</div>
                                            <div class="field-value">--</div>
                                        </div>

                                        <div class="col-2">
                                            <div class="field-label">Height (in cm)</div>
                                            <div class="field-value">--</div>
                                        </div>

                                        <div class="col-2">
                                            <div class="field-label">Weight (in kg)</div>
                                            <div class="field-value">--</div>
                                        </div>
                                        <div class="col-2 mt-3">
                                            <div class="field-label">Identification Marks (#1)</div>
                                            <div class="field-value">--</div>
                                        </div>
                                        <div class="col-2 mt-3">
                                            <div class="field-label">Identification Marks (#2)</div>
                                            <div class="field-value">--</div>
                                        </div>
                                        <div class="col-2 mt-3">
                                            <div class="field-label">Days Spent on Non-Teaching</div>
                                            <div class="field-value">--</div>
                                        </div>

                                        <div class="col-2 mt-3">
                                            <div class="field-label">Handling Digital Devices?</div>
                                            <div class="field-value">--</div>
                                        </div>             

                                        <div class="col-2 mt-3">
                                            <div class="field-label">Other School Deputation?</div>
                                            <div class="field-value">--</div>
                                        </div>

                                       

                                        <div class="col-2 mt-3">
                                            <div class="field-label">Aadhaar Verified?</div>
                                            <div class="field-value">--</div>
                                        </div>

                                        <div class="col-3 mt-3">
                                            <div class="field-label">Teaching as Guest/Contractual?</div>
                                            <div class="field-value">--</div>
                                        </div>
                                        <div class="col-3 mt-3">
                                            <div class="field-label">Language 1 - working knowledge?</div>
                                            <div class="field-value">--</div>
                                        </div>

                                        <div class="col-3 mt-3">
                                            <div class="field-label">Language 2 - working knowledge?</div>
                                            <div class="field-value">--</div>
                                        </div>

                                        <div class="col-3 mt-3">
                                            <div class="field-label">Language 3 - working knowledge?</div>
                                            <div class="field-value">--</div>
                                        </div>

                                        
                                    </div>
                                </div>
                            </div>                        
                        </div>

                    </div>
                </div>

                <!-- ================= Family Members Details ================= -->
                <div class="card section-card shadow-sm mb-4">
                    <div class="card-header bg-dark text-warning fw-bold">
                        👨‍👩‍👧 Family Members Details
                    </div>
                    <div class="card-body" style="padding:0px;">
                      
                          
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle mb-0">
                                <thead class="table-light">
                                <tr>
                                    <th>Family Member</th>
                                    <th>Relation</th>
                                    <th>Date of Birth</th>
                                    <th>Aadhar</th>
                                    <th>Covered Under Family</th>
                                    <th>Date of Nomination</th>
                                    <th>Nomination %</th>
                                </tr>
                                </thead>

                                <tbody>
                                <!-- Row 1 -->
                                <tr>
                                    <td>Smt. XYZ</td>
                                    <td>Spouse</td>
                                    <td>12-05-1987</td>
                                    <td>XXXX-XXXX-1234</td>
                                    <td>
                                    <span class="badge bg-success">Yes</span>
                                    </td>
                                    <td>01-04-2020</td>
                                    <td>100%</td>
                                </tr>

                                <!-- Row 2 -->
                                <tr>
                                    <td>Master ABC</td>
                                    <td>Son</td>
                                    <td>20-08-2012</td>
                                    <td>XXXX-XXXX-5678</td>
                                    <td>
                                    <span class="badge bg-success">Yes</span>
                                    </td>
                                    <td>01-04-2020</td>
                                    <td>0%</td>
                                </tr>

                                <!-- No data state -->
                                <!--
                                <tr>
                                    <td colspan="7" class="text-center text-muted">
                                    No family details available
                                    </td>
                                </tr>
                                -->
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>


                <!-- ================= Religion & Caste Details ================= -->
                <div class="card section-card shadow-sm mb-4">
                    <div class="card-header bg-dark text-warning fw-bold">
                        🛕 Religion & Caste Details
                    </div>
                    <div class="card-body" style="padding:0px;">                      
                        <div class="row" style="margin:0px;">                      
                            
                            <div class="col-2">
                                <div class="field-label">Religion</div>
                                <div class="field-value">--</div>
                            </div>

                                <div class="col-2">
                                <div class="field-label">Social Category</div>
                                <div class="field-value">--</div>
                            </div>

                            <div class="col-2">
                                <div class="field-label">Caste</div>
                                <div class="field-value">--</div>
                            </div>    
                                                   
                        </div>

                        <h6 style="color:#fff;background: #1975fd; padding: 5px 20px; margin:0px;">
                            <i class="bi bi-intersect"></i> Certification Details
                        </h6>
                        <div class="row" style="margin:0px;">      
                            <div class="col-3">
                                <div class="field-label">Certificate No</div>
                                <div class="field-value">--</div>
                            </div>

                             <div class="col-3">
                                <div class="field-label">Certificate Date</div>
                                <div class="field-value">--</div>
                            </div>

                            <div class="col-3">
                                <div class="field-label">Issuing Authority</div>
                                <div class="field-value">--</div>
                            </div>

                            <div class="col-3">
                                <div class="field-label">Place</div>
                                <div class="field-value">--</div>
                            </div>              
                        </div>

                        <h6 style="color:#fff;background: #1975fd; padding: 5px 20px; margin:0px;">
                            <i class="bi bi-intersect"></i> Certification Validation Details
                        </h6>
                        <div class="row" style="margin:0px;">      
                            <div class="col-3">
                                <div class="field-label">Certificate Validation No</div>
                                <div class="field-value">--</div>
                            </div>

                             <div class="col-3">
                                <div class="field-label">Certificate Validation Date</div>
                                <div class="field-value">--</div>
                            </div>

                            <div class="col-3">
                                <div class="field-label">Certificate Validation Authority</div>
                                <div class="field-value">--</div>
                            </div>

                            <div class="col-3">
                                <div class="field-label">Place</div>
                                <div class="field-value">--</div>
                            </div>              
                        </div>

                    </div>
                </div>
                <!-- ================= Academic Qualifications ================= -->
                <div class="card section-card shadow-sm mb-4">
                    <div class="card-header bg-dark text-warning fw-bold">
                        <i class="bi bi-mortarboard me-2"></i> Academic Qualifications
                    </div>
                    <div class="card-body" style="padding:0px;">

                        <div class="timeline">

                            <!-- ================= SSC ================= -->
                            <div class="timeline-item left">
                                <div class="timeline-dot"></div>
                                <div class="timeline-content">
                                <div class="card timeline-card">
                                <div class="card-header bg-primary text-white fw-bold">
                                SSC (Std. 10th) – 2006
                                </div>
                                <div class="card-body">
                                <div class="row g-3">

                                <div class="col-6">
                                <div class="field-label">Degree</div>
                                <div class="field-value">S.S.C.</div>
                                </div>

                                <div class="col-6">
                                <div class="field-label">State</div>
                                <div class="field-value">Maharashtra</div>
                                </div>

                                <div class="col-12">
                                <div class="field-label">Board / University</div>
                                <div class="field-value">
                                Maharashtra State Board Of Secondary And Higher Secondary Education, Pune
                                </div>
                                </div>

                                <div class="col-4">
                                <div class="field-label">Marks</div>
                                <div class="field-value">960 / 1000</div>
                                </div>

                                <div class="col-4">
                                <div class="field-label">Percentage</div>
                                <div class="field-value">96%</div>
                                </div>

                                <div class="col-4">
                                <div class="field-label">Grade / Class</div>
                                <div class="field-value">A++ / I</div>
                                </div>

                                <div class="col-6">
                                <div class="field-label">Result Date</div>
                                <div class="field-value">27-04-2006</div>
                                </div>

                                <div class="col-6">
                                <div class="field-label">Medium</div>
                                <div class="field-value">Marathi</div>
                                </div>

                                <div class="col-12">
                                <div class="field-label">Main Subjects</div>
                                <div class="field-value">
                                Computer, Maths, Physics
                                </div>
                                </div>

                                </div>
                                </div>
                                </div>
                                </div>
                            </div>

                            <!-- ================= HSC ================= -->
                            <div class="timeline-item right">
                                <div class="timeline-dot"></div>
                                <div class="timeline-content">
                                <div class="card timeline-card">
                                <div class="card-header bg-success text-white fw-bold">
                                HSC (Std. 12th – Science) – 2009
                                </div>
                                <div class="card-body">
                                <div class="row g-3">

                                <div class="col-6">
                                <div class="field-label">Degree</div>
                                <div class="field-value">H.S.C. – Science</div>
                                </div>

                                <div class="col-6">
                                <div class="field-label">State</div>
                                <div class="field-value">Maharashtra</div>
                                </div>

                                <div class="col-12">
                                <div class="field-label">Board / University</div>
                                <div class="field-value">
                                Maharashtra State Board Of Secondary And Higher Secondary Education, Pune
                                </div>
                                </div>

                                <div class="col-4">
                                <div class="field-label">Marks</div>
                                <div class="field-value">450 / 800</div>
                                </div>

                                <div class="col-4">
                                <div class="field-label">Percentage</div>
                                <div class="field-value">56.25%</div>
                                </div>

                                <div class="col-4">
                                <div class="field-label">Grade / Class</div>
                                <div class="field-value">4 / III</div>
                                </div>

                                <div class="col-6">
                                <div class="field-label">Result Date</div>
                                <div class="field-value">30-06-2009</div>
                                </div>

                                <div class="col-6">
                                <div class="field-label">Medium</div>
                                <div class="field-value">Tamil</div>
                                </div>

                                <div class="col-12">
                                <div class="field-label">Main Subjects</div>
                                <div class="field-value">
                                Health & Physical Education
                                </div>
                                </div>

                                </div>
                                </div>
                                </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>


                <!-- ================= Professional Qualifications ================= -->
                <div class="card section-card shadow-sm mb-4">
                    <div class="card-header bg-dark text-warning fw-bold">
                        <i class="bi bi-mortarboard me-2"></i> Professional Qualifications
                    </div>
                    <div class="card-body" style="padding:0px;">
                         <div class="timeline">

                            <!-- ================= B.Ed. ================= -->
                            <div class="timeline-item left">
                                <div class="timeline-dot"></div>
                                <div class="timeline-content">
                                <div class="card timeline-card">
                                <div class="card-header bg-primary text-white fw-bold">
                                Graduation – 2025
                                </div>
                                <div class="card-body">
                                <div class="row g-3">

                                <div class="col-6">
                                <div class="field-label">Degree</div>
                                <div class="field-value">B.Ed.</div>
                                </div>

                                <div class="col-6">
                                <div class="field-label">State</div>
                                <div class="field-value">Maharashtra</div>
                                </div>

                                <div class="col-12">
                                <div class="field-label">Board / University</div>
                                <div class="field-value">
                                Maharashtra State Board Of Vocational Examinations
                                </div>
                                </div>

                                <div class="col-4">
                                <div class="field-label">Marks</div>
                                <div class="field-value">500 / 800</div>
                                </div>

                                <div class="col-4">
                                <div class="field-label">Percentage</div>
                                <div class="field-value">62.50%</div>
                                </div>

                                <div class="col-4">
                                <div class="field-label">Grade / Class</div>
                                <div class="field-value">B+ / II</div>
                                </div>

                                <div class="col-6">
                                <div class="field-label">Result Date</div>
                                <div class="field-value">24/12/2025</div>
                                </div>

                                <div class="col-6">
                                <div class="field-label">Medium</div>
                                <div class="field-value">Marathi</div>
                                </div>

                                

                                </div>
                                </div>
                                </div>
                                </div>
                            </div>

                            <!-- ================= D.Ed. ================= -->
                            <div class="timeline-item right">
                                <div class="timeline-dot"></div>
                                <div class="timeline-content">
                                <div class="card timeline-card">
                                <div class="card-header bg-success text-white fw-bold">
                                Diploma – 2025
                                </div>
                                <div class="card-body">
                                <div class="row g-3">

                                <div class="col-6">
                                <div class="field-label">Degree</div>
                                <div class="field-value">D.Ed.</div>
                                </div>

                                <div class="col-6">
                                <div class="field-label">State</div>
                                <div class="field-value">Maharashtra</div>
                                </div>

                                <div class="col-12">
                                <div class="field-label">Board / University</div>
                                <div class="field-value">
                                Maharashtra State Board Of Secondry And Higher Secondary Education, Pune
                                </div>
                                </div>

                                <div class="col-4">
                                <div class="field-label">Marks</div>
                                <div class="field-value">500 / 800</div>
                                </div>

                                <div class="col-4">
                                <div class="field-label">Percentage</div>
                                <div class="field-value">62.50%</div>
                                </div>

                                <div class="col-4">
                                <div class="field-label">Grade / Class</div>
                                <div class="field-value">B+ / II</div>
                                </div>

                                <div class="col-6">
                                <div class="field-label">Result Date</div>
                                <div class="field-value">27/12/2025</div>
                                </div>

                                <div class="col-6">
                                <div class="field-label">Medium</div>
                                <div class="field-value">Tamil</div>
                                </div>


                                </div>
                                </div>
                                </div>
                                </div>
                            </div>

                        </div>


                    </div>
                </div>

                <!-- ================= UDISE Qualifications ================= -->
                <div class="card section-card shadow-sm mb-4">
                    <div class="card-header bg-dark text-warning fw-bold">
                        <i class="bi bi-mortarboard me-2"></i> UDISE Qualifications
                    </div>
                    <div class="card-body" style="padding:0px;">
                      
                        <div class="row" style="margin:0px;">                      
                            
                            

                            <div class="col-2">
                                <div class="field-label">Math Studied Upto</div>
                                <div class="field-value">--</div>
                            </div>

                            <div class="col-2">
                                <div class="field-label">Science Studied Upto</div>
                                <div class="field-value">--</div>
                            </div>  
                            
                            <div class="col-2">
                                <div class="field-label">English Studied Upto</div>
                                <div class="field-value">--</div>
                            </div> 
                            
                            <div class="col-2">
                                <div class="field-label">Social Studies Studied Upto</div>
                                <div class="field-value">--</div>
                            </div>   
                             <div class="col-2">
                                <div class="field-label">Language Studied Upto</div>
                                <div class="field-value">--</div>
                            </div>  
                            <div class="col-2">
                                <div class="field-label">Teaching Level</div>
                                <div class="field-value">--</div>
                            </div>
                            <div class="col-2  mt-3">
                                <div class="field-label">Main Subject 1</div>
                                <div class="field-value">--</div>
                            </div>

                             <div class="col-2 mt-3">
                                <div class="field-label">Main Subject 2</div>
                                <div class="field-value">--</div>
                            </div>

                             
                                                   
                        </div>

                    </div>
                </div>
                
                <!-- ================= 📝TET Details ================= -->
                <div class="card section-card shadow-sm mb-4">
                    <div class="card-header bg-dark text-warning fw-bold">
                        📝TET Result 
                    </div>
                    <div class="card-body" style="padding:0px;">
                      


                    </div>
                </div>

                <!-- ================= Service History ================= -->
                <div class="card section-card shadow-sm mb-4">
                    <div class="card-header bg-dark text-warning fw-bold">
                        <i class="bi bi-suitcase-lg-fill"></i> Service History
                    </div>
                    <div class="card-body" style="padding:0px;">
                      
                       
                        <div class="timeline">

                            <!-- ================= EXPERIENCE 1 ================= -->
                            <div class="timeline-item left">
                                <div class="timeline-dot"></div>
                                <div class="timeline-content">
                                    <div class="card timeline-card">
                                        <div class="card-header bg-primary text-white fw-bold">
                                            2010 – 2015 | Under Graduate Teacher
                                        </div>
                                        <div class="card-body">
                                            <div class="row g-3">

                                                <div class="col-6">
                                                <div class="field-label">School UDISE</div>
                                                <div class="field-value">27250200302</div>
                                                </div>

                                                <div class="col-6">
                                                <div class="field-label">School Category</div>
                                                <div class="field-value">Secondary Only</div>
                                                </div>

                                                <div class="col-12">
                                                <div class="field-label">School Name</div>
                                                <div class="field-value">NEW ENGLISH SCHOOL NAROLI</div>
                                                </div>

                                                <div class="col-6">
                                                <div class="field-label">Post / Designation</div>
                                                <div class="field-value">UG Teacher (Std. 5–7)</div>
                                                </div>

                                                <div class="col-6">
                                                <div class="field-label">Aid Type</div>
                                                <div class="field-value">-</div>
                                                </div>

                                                <div class="col-6">
                                                <div class="field-label">Start Date</div>
                                                <div class="field-value">01-12-2010</div>
                                                </div>

                                                <div class="col-6">
                                                <div class="field-label">End Date</div>
                                                <div class="field-value">01-10-2015</div>
                                                </div>

                                                <div class="col-4">
                                                <div class="field-label">PESA Area</div>
                                                <span class="badge bg-secondary badge-small">No</span>
                                                </div>

                                                <div class="col-4">
                                                <div class="field-label">Difficult Area</div>
                                                <span class="badge bg-warning text-dark badge-small">Yes</span>
                                                </div>

                                                <div class="col-4">
                                                <div class="field-label">Transfer Approval</div>
                                                <span class="badge bg-success badge-small">Approved</span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ================= EXPERIENCE 2 ================= -->
                            <div class="timeline-item right">
                                <div class="timeline-dot"></div>
                                <div class="timeline-content">
                                    <div class="card timeline-card">
                                        <div class="card-header bg-success text-white fw-bold">
                                        2015 – 2018 | Assistant Teacher
                                        </div>
                                        <div class="card-body">
                                            <div class="row g-3">
                                                <div class="col-12">
                                                <div class="field-label">School Name</div>
                                                <div class="field-value">ZP High School, Kolhapur</div>
                                                </div>
                                                <div class="col-6">
                                                <div class="field-label">UDISE</div>
                                                <div class="field-value">27250300411</div>
                                                </div>
                                                <div class="col-6">
                                                <div class="field-label">Category</div>
                                                <div class="field-value">Upper Primary</div>
                                                </div>
                                                <div class="col-6">
                                                <div class="field-label">Start Date</div>
                                                <div class="field-value">15-10-2015</div>
                                                </div>
                                                <div class="col-6">
                                                <div class="field-label">End Date</div>
                                                <div class="field-value">31-05-2018</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ================= EXPERIENCE 3 ================= -->
                            <div class="timeline-item left">
                                <div class="timeline-dot"></div>
                                <div class="timeline-content">
                                    <div class="card timeline-card">
                                        <div class="card-header bg-info text-white fw-bold">
                                        2018 – 2021 | Senior Teacher
                                        </div>
                                        <div class="card-body">
                                            <div class="field-value">Government Secondary School, Pune</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ================= EXPERIENCE 4 ================= -->
                            <div class="timeline-item right">
                                <div class="timeline-dot"></div>
                                <div class="timeline-content">
                                    <div class="card timeline-card">
                                        <div class="card-header bg-dark text-white fw-bold">
                                        2021 – Present | Head Teacher
                                        </div>
                                        <div class="card-body">
                                            <div class="field-value">ZP Model School, Satara</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                <!-- ================= Financial & Benefits ================= -->
                <div class="card section-card shadow-sm mb-4">
                    <div class="card-header bg-dark text-warning fw-bold">
                        <i class="bi bi-wallet2 me-2"></i> Financial & Benefits
                    </div>

                    <div class="card-body" style="padding:0px;">
                         <h6 style="color:#fff;background: #1975fd; padding: 5px 20px; margin:0px;">
                            <i class="bi bi-briefcase"></i> Pay Details
                        </h6>
                        <div class="row" style="margin:0px;"> 
                            <div class="col-2">
                                <div class="field-label">Pay Commission</div>
                                <div class="field-value">--</div>
                            </div>

                                <div class="col-2">
                                <div class="field-label">Pay Scale</div>
                                <div class="field-value">--</div>
                            </div>

                            <div class="col-2">
                                <div class="field-label">Pay Matrix</div>
                                <div class="field-value">--</div>
                            </div>    
                             <div class="col-2">
                                <div class="field-label">Received Senior Grade Scale?</div>
                                <div class="field-value">--</div>
                            </div>  
                            <div class="col-2">
                                <div class="field-label">Received Selection Grade Scale?</div>
                                <div class="field-value">--</div>
                            </div>    
                             <div class="col-2">
                                <div class="field-label">Pay in Band</div>
                                <div class="field-value">--</div>
                            </div>    
                             <div class="col-2">
                                <div class="field-label">Grade Pay</div>
                                <div class="field-value">--</div>
                            </div>    
                             <div class="col-2">
                                <div class="field-label">Basic Pay</div>
                                <div class="field-value">--</div>
                            </div>    
                             <div class="col-2">
                                <div class="field-label">Pay w.e.f. Date</div>
                                <div class="field-value">--</div>
                            </div>    
                             <div class="col-2">
                                <div class="field-label">Next Increment Date</div>
                                <div class="field-value">--</div>
                            </div>    
                             <div class="col-2">
                                <div class="field-label">Senior Grade Date Received</div>
                                <div class="field-value">--</div>
                            </div>    
                             <div class="col-2">
                                <div class="field-label">Selection Grade Date Received</div>
                                <div class="field-value">--</div>
                            </div>      
                                                   
                        </div>

                        <h6 style="color:#fff;background: #1975fd; padding: 5px 20px; margin:0px;">
                            <i class="bi bi-boxes"></i> PF/DCPS/GPF
                        </h6>
                        <div class="row" style="margin:0px;">      
                            <div class="col-3">
                                <div class="field-label">Account Type</div>
                                <div class="field-value">--</div>
                            </div>

                             <div class="col-3">
                                <div class="field-label">Account Maintained By</div>
                                <div class="field-value">--</div>
                            </div>

                            <div class="col-3">
                                <div class="field-label">PF Series</div>
                                <div class="field-value">--</div>
                            </div>

                            <div class="col-3">
                                <div class="field-label">PF Account No</div>
                                <div class="field-value">--</div>
                            </div>              
                        </div>

                        <h6 style="color:#fff;background: #1975fd; padding: 5px 20px; margin:0px;">
                            <i class="bi bi-check2-square"></i> Bank Account
                        </h6>
                        <div class="row" style="margin:0px;">      
                            <div class="col-3">
                                <div class="field-label">Bank Name</div>
                                <div class="field-value">--</div>
                            </div>

                             <div class="col-3">
                                <div class="field-label">Branch Name</div>
                                <div class="field-value">--</div>
                            </div>

                            <div class="col-3">
                                <div class="field-label">Name as per Bank Account</div>
                                <div class="field-value">--</div>
                            </div>

                            <div class="col-3">
                                <div class="field-label">Account Number</div>
                                <div class="field-value">--</div>
                            </div>    
                            
                            <div class="col-3">
                                <div class="field-label">IFSC Code</div>
                                <div class="field-value">--</div>
                            </div>    

                            <div class="col-3">
                                <div class="field-label">MICR Code</div>
                                <div class="field-value">--</div>
                            </div>    
                        </div>


                    </div>
                </div>


                <!-- ================= Leave Details ================= -->
                <div class="card section-card shadow-sm mb-4">
                    <div class="card-header bg-dark text-warning fw-bold">
                        <i class="bi bi-recycle"></i> Leave Details
                    </div>
                    <div class="card-body" style="padding:0px;">
                        <h6 style="color:#fff;background: #1975fd; padding: 5px 20px; margin:0px;">
                            <i class="bi bi-check2-square"></i> Leave Availability
                        </h6>
                        
                        <div class="row" style="margin:0px;">      
                            <div class="col-3">
                                <div class="field-label">Casual Leave (Current Academic Year)</div>
                                <div class="field-value">--</div>
                            </div>

                             <div class="col-3">
                                <div class="field-label">Earned Leave (Current Academic Year)</div>
                                <div class="field-value">--</div>
                            </div>

                            <div class="col-3">
                                <div class="field-label">Earned Leave – Carry Forward (Last Year)</div>
                                <div class="field-value">--</div>
                            </div>

                            <div class="col-3">
                                <div class="field-label">Total Leaves Available - <span class="field-value">--</span></div>
                            </div>              
                        </div>
                        <h6 style="color:#fff;background: #fdea19ff; padding: 5px 20px; margin:0px;">
                            <i class="bi bi-boxes"></i> Leave Utilization (Current Academic Year)
                        </h6>
                        <div class="row" style="margin:0px;">      
                            <div class="col-3">
                                <div class="field-label">Used Leaves - <span class="field-value">--</span></div>
                                
                            </div>
                        </div>
                        <h6 style="color:#fff;background: #19fd24ff; padding: 5px 20px; margin:0px;">
                            <i class="bi bi-boxes"></i> Leave Balance (Current Academic Year)
                        </h6>
                        <div class="row" style="margin:0px;">      
                            <div class="col-3">
                                <div class="field-label">Remaining Leaves - <span class="field-value">--</span></div>
                            </div>
                        </div>
                        <h6 style="color:#fff;background: #fd1919ff; padding: 5px 20px; margin:0px;">
                            <i class="bi bi-boxes"></i> Unpaid Leave (This Academic Year)
                        </h6>
                        <div class="row" style="margin:0px;">      
                            <div class="col-3">
                                <div class="field-label">Unpaid Leaves - <span class="field-value">--</span></div>
                            </div>
                        </div>

                    </div>
                </div>


                <!-- ================= Rewards History ================= -->
                <div class="card section-card shadow-sm mb-4">
                    <div class="card-header bg-dark text-warning fw-bold">
                       <i class="bi bi-trophy-fill"></i> Rewards
                    </div>
                    <div class="card-body" style="padding:0px;">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle mb-0">
                                <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Year</th>
                                    <th>Award Details</th>
                                </tr>
                                </thead>

                                <tbody>
                                <!-- Row 1 -->
                                <tr>
                                    <td>1</td>
                                    <td>2018</td>
                                    <td>"Shiksha Ratna" Excellence in Teaching Award</td>
                                   
                                </tr>

                               
                                <tr>
                                    <td>2</td>
                                    <td>2016</td>
                                    <td>"Dedication Gold Medal"</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>2015</td>
                                    <td>"Innovation Champion" Award</td>
                                </tr>

                             
                                </tbody>
                            </table>
                        </div>

                     </div>   
                </div>

                <!-- ================= Training Details ================= -->
                <div class="card section-card shadow-sm mb-4">
                    <div class="card-header bg-dark text-warning fw-bold">
                        <i class="bi bi-journal-check me-2"></i> Training Details
                    </div>
                    <div class="card-body" style="padding:0px;">
                      
                        <h6 style="color:#fff;background: #1975fd; padding: 5px 20px; margin:0px;">
                            <i class="bi bi-clipboard2-data"></i> Training Attended History
                        </h6>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle mb-0">
                                <thead class="table-light">
                                <tr>
                                    <th>Training Type</th>
                                    <th>Training Category</th>
                                    <th>Training Institute</th>
                                    <th>Training Level</th>
                                    <th>Title</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Attended?</th>
                                    <th>Certificate?</th>
                                </tr>
                                </thead>




                                <tbody>
                                <!-- Row 1 -->
                                <tr>
                                    <td>Assessment & Evaluation Training</td>
                                    <td>Administrative</td>
                                    <td>Central Board of Secondary Education (CBSE)</td>
                                    <td>-</td>  
                                    <td>SCERT TRAINING</td>
                                    <td>16/12/2015</td>
                                    <td>18/12/2016</td>                                    
                                    <td>Yes</td>    
                                    <td>Yes</td>                                
                                </tr>
                                <tr>
                                    <td>ICT / Digital Literacy Training</td>
                                    <td>Assessment & Evaluation</td>
                                    <td>Indira Gandhi National Open University (IGNOU)</td>
                                    <td>Inter-District Level</td>  
                                    <td>Traning Detaials</td>
                                    <td>16/12/2025</td>
                                    <td>18/12/2025</td>                                    
                                    <td>Yes</td>    
                                    <td>Yes</td>                                
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <h6 style="color:#fff;background: #1975fd; padding: 5px 20px; margin:0px;">
                             📅Attendance Details
                        </h6>
                        
                        <div class="row" style="margin:0px;">      
                            <div class="col-3">
                                <div class="field-label">Trained CWSN</div>
                                <div class="field-value">--</div>
                            </div>

                             <div class="col-3">
                                <div class="field-label">Trained Computer</div>
                                <div class="field-value">--</div>
                            </div>

                            <div class="col-3">
                                <div class="field-label">Trained Received</div>
                                <div class="field-value">--</div>
                            </div>
                            
                            <div class="col-3">
                                <div class="field-label">Trained Needed</div>
                                <div class="field-value">--</div>
                            </div>

                            <div class="col-3">
                                <div class="field-label">Training Nishtha</div>
                                <div class="field-value">--</div>
                            </div>
                            <div class="col-3">
                                <div class="field-label">Trained SSA</div>
                                <div class="field-value">--</div>
                            </div>
                            <div class="col-3">
                                <div class="field-label">Psychological & Social Aspects Training</div>
                                <div class="field-value">--</div>
                            </div>
                            <div class="col-3">
                                <div class="field-label">Received Training Support CWSN</div>
                                <div class="field-value">--</div>
                            </div>  
                        </div>

                    </div>
                </div>

                

                <!-- ================= Disciplinary Action ================= -->
                <div class="card section-card shadow-sm mb-4">
                    <div class="card-header bg-dark text-warning fw-bold">
                       <i class="bi bi-stoplights-fill"></i> Disciplinary Action
                    </div>
                    <div class="card-body" style="padding:0px;">
                      
                            <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle mb-0">
                                <thead class="table-light">
                                <tr>
                                    <th>#</th>                                    
                                    <th>Details</th>
                                </tr>
                                </thead>

                                <tbody>
                                <!-- Row 1 -->
                                <tr>
                                    <td>1</td>
                                    <td>"Incident: Teacher on personal phone call during class.<br/>
                                        Date: Dec 27, 2021<br/>
                                        Action: Verbal warning issued regarding mobile device usage during instructional hours."</td>
                                   
                                </tr>

                               
                                
                             
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                
                
                
                
            </main>
        </div>
    </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

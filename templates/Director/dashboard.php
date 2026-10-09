
<!-- Custom CSS for Colors and Gradients -->
<style>
  .bg-gradient-primary {
    background: linear-gradient(45deg, #007bff, #0056b3);
  }

  .bg-gradient-success {
    background: linear-gradient(45deg, #28a745, #1e7e34);
  }

  .bg-gradient-warning {
    background: linear-gradient(45deg, #ffc107, #e0a800);
  }

  .bg-gradient-info {
    background: linear-gradient(45deg, #17a2b8, #117a8b);
  }

  .bg-gradient-danger {
    background: linear-gradient(45deg, #dc3545, #bd2130);
  }

  .bg-gradient-secondary {
    background: linear-gradient(45deg, #6c757d, #343a40);
  }

  .bg-purple {
    background-color: #6f42c1;
  }

  .shadow-gradient {
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.12);
    transition: all 0.3s ease-in-out;
  }

  .shadow-gradient:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.25);
  }

  .card-header {
    font-weight: bold;
    font-size: 1rem;
    padding: 0.75rem 1rem;
    border-bottom: none;
    border-radius: 0.375rem 0.375rem 0 0;
  }
   .dashboard {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 20px;
    

    .card {
        background: #ffffff;
        border-radius: 10px;
        padding: 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .card .info {
        display: flex;
        flex-direction: column;
    }

    .card .title {
        font-size: 14px;
        color: #6c757d;
        margin-bottom: 8px;
        font-weight: 600;
    }

    .card .value {
        font-size: 30px;
        font-weight: 700;
        color: #212529;
    }

    .card .icon {
        font-size: 36px;
        padding: 5px;
        border-radius: 50%;
        color: #fff;
    }

    .schools { background: #0d6efd; }
    .staffs { background: #198754; }
    .ngtog { background: #fd7e14; }

    .staff-breakup {
        font-size: 13px;
        color: #555;
        margin-top: 5px;
    }
    }
</style>
<style>
  .left-slider{
    position:fixed;
    top:0;
    left:100%;
    width:100%;
    max-width:95%;
    height:100%;
    background:#fff;
    z-index:1055;
    transition:0.35s;
    box-shadow:0 0 25px rgba(0,0,0,.25);
    overflow-y:auto;
}

.left-slider.open{
    left:0;
}

.slider-header{
    background:#0d6efd;
    color:#fff;
    padding:15px 20px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.slider-body{
    padding:20px;
}

.slider-backdrop{
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,.4);
    display:none;
    z-index:1050;
}

.slider-backdrop.show{
    display:block;
}
  </style>

<?php 
if(isset($staffsType['full'][1]) && ($staffsType['full'][1] >0)){
  $full_1 = $staffsType['full'][1];
}else{
  $full_1 = 0;
}
if(isset($staffsType['full'][2]) && ($staffsType['full'][2] >0)){
  $full_2 = $staffsType['full'][2];
}else{
  $full_2 = 0;
}

$full_t = $full_1 + $full_2;

if(isset($staffsType['part'][1]) && ($staffsType['part'][1] >0)){
  $part_1 = $staffsType['part'][1];
}else{
  $part_1 = 0;
}
if(isset($staffsType['part'][2]) && ($staffsType['part'][2] >0)){
  $part_2 = $staffsType['part'][2];
}else{
  $part_2 = 0;
}

$part_t = $part_1 + $part_2;

if(isset($staffsType['self'][1]) && ($staffsType['self'][1] >0)){
  $self_1 = $staffsType['self'][1];
}else{
  $self_1 = 0;
}
if(isset($staffsType['self'][2]) && ($staffsType['self'][2] >0)){
  $self_2 = $staffsType['self'][2];
}else{
  $self_2 = 0;
}

$self_t = $self_1 + $self_2;

$t_1 = $full_1 + $part_1 + $self_1;
$t_2 = $full_2 + $part_2 + $self_2;
$t_t = $t_1 + $t_2;

$us_p_1 = $us_p_2 = $us_in_1 = $us_in_2 = $us_rfc_1 = $us_rfc_2 = $us_ac_1 = $us_ac_2 = $us_rc_1 = $us_rc_2 = $us_ab_1 = $us_ab_2 = $us_rb_1 = $us_rb_2 = $us_c_1 = $us_c_2 = $us_r_1 = $us_r_2 = '-';
$us_p_t=$us_in_t=$us_rfc_t=$us_ac_t=$us_rc_t=$us_ab_t=$us_rb_t=$us_c_t=$us_r_t=$us_1_t=$us_2_t=$us_t_t=0;


if(isset($updateStatus['pending'][1]) && $updateStatus['pending'][1] > 0){
  $us_p_1 = $updateStatus['pending'][1];
  $us_p_t += $us_p_1;
  $us_1_t += $us_p_1;
}
if(isset($updateStatus['pending'][2]) && $updateStatus['pending'][2] > 0){
  $us_p_2 = $updateStatus['pending'][2];
  $us_p_t += $us_p_2;
  $us_2_t += $us_p_2;
}

if($us_p_t <= 0){
  $us_p_t = '-';
}

if(isset($updateStatus['in_progress'][1]) && $updateStatus['in_progress'][1] > 0){
  $us_in_1 = $updateStatus['in_progress'][1];
  $us_in_t += $us_in_1;
  $us_1_t += $us_in_1;
}
if(isset($updateStatus['in_progress'][2]) && $updateStatus['in_progress'][2] > 0){
  $us_in_2 = $updateStatus['in_progress'][2];
  $us_in_t += $us_in_2;
  $us_2_t += $us_in_2;
}

if($us_in_t <= 0){
  $us_in_t = '-';
}

if(isset($updateStatus['ready_for_cluster'][1]) && $updateStatus['ready_for_cluster'][1] > 0){
  $us_rfc_1 = $updateStatus['ready_for_cluster'][1];
  $us_rfc_t += $us_rfc_1;
  $us_1_t += $us_rfc_1;
}
if(isset($updateStatus['ready_for_cluster'][2]) && $updateStatus['ready_for_cluster'][2] > 0){
  $us_rfc_2 = $updateStatus['ready_for_cluster'][2];
  $us_rfc_t += $us_rfc_2;
  $us_2_t += $us_rfc_2;
}

if($us_rfc_t <= 0){
  $us_rfc_t = '-';
}

if(isset($updateStatus['approved_by_cluster'][1]) && $updateStatus['approved_by_cluster'][1] > 0){
  $us_ac_1 = $updateStatus['approved_by_cluster'][1];
  $us_ac_t += $us_ac_1;
  $us_1_t += $us_ac_1;
}
if(isset($updateStatus['approved_by_cluster'][2]) && $updateStatus['approved_by_cluster'][2] > 0){
  $us_ac_2 = $updateStatus['approved_by_cluster'][2];
  $us_ac_t += $us_ac_2;
  $us_2_t += $us_ac_2;
}

if($us_ac_t <= 0){
  $us_ac_t = '-';
}


if(isset($updateStatus['rejected_by_cluster'][1]) && $updateStatus['rejected_by_cluster'][1] > 0){
  $us_rc_1 = $updateStatus['rejected_by_cluster'][1];
  $us_rc_t += $us_rc_1;
  $us_1_t += $us_rc_1;
}
if(isset($updateStatus['rejected_by_cluster'][2]) && $updateStatus['rejected_by_cluster'][2] > 0){
  $us_rc_2 = $updateStatus['rejected_by_cluster'][2];
  $us_rc_t += $us_rc_2;
  $us_2_t += $us_rc_2;
}

if($us_rc_t <= 0){
  $us_rc_t = '-';
}


if(isset($updateStatus['approved_by_block'][1]) && $updateStatus['approved_by_block'][1] > 0){
  $us_ab_1 = $updateStatus['approved_by_block'][1];
  $us_ab_t += $us_ab_1;
  $us_1_t += $us_ab_1;
}
if(isset($updateStatus['approved_by_block'][2]) && $updateStatus['approved_by_block'][2] > 0){
  $us_ab_2 = $updateStatus['approved_by_block'][2];
  $us_ab_t += $us_ab_2;
  $us_2_t += $us_ab_2;
}

if($us_ab_t <= 0){
  $us_ab_t = '-';
}


if(isset($updateStatus['rejected_by_block'][1]) && $updateStatus['rejected_by_block'][1] > 0){
  $us_rb_1 = $updateStatus['rejected_by_block'][1];
  $us_rb_t += $us_rb_1;
  $us_1_t += $us_rb_1;
}
if(isset($updateStatus['rejected_by_block'][2]) && $updateStatus['rejected_by_block'][2] > 0){
  $us_rb_2 = $updateStatus['rejected_by_block'][2];
  $us_rb_t += $us_rb_2;
  $us_2_t += $us_rb_2;
}

if($us_rb_t <= 0){
  $us_rb_t = '-';
}


if(isset($updateStatus['completed'][1]) && $updateStatus['completed'][1] > 0){
  $us_c_1 = $updateStatus['completed'][1];
  $us_c_t += $us_c_1;
  $us_1_t += $us_c_1;
}
if(isset($updateStatus['completed'][2]) && $updateStatus['completed'][2] > 0){
  $us_c_2 = $updateStatus['completed'][2];
  $us_c_t += $us_c_2;
  $us_2_t += $us_c_2;
}

if($us_c_t <= 0){
  $us_c_t = '-';
}


if(isset($updateStatus['rejected'][1]) && $updateStatus['rejected'][1] > 0){
  $us_r_1 = $updateStatus['rejected'][1];
  $us_r_t += $us_r_1;
  $us_1_t += $us_r_1;
}
if(isset($updateStatus['rejected'][2]) && $updateStatus['rejected'][2] > 0){
  $us_r_2 = $updateStatus['rejected'][2];
  $us_r_t += $us_r_2;
  $us_2_t += $us_r_2;
}

if($us_r_t <= 0){
  $us_r_t = '-';
}

 


if($us_1_t <= 0){
  $us_1_t = '-';
}else{
  $us_t_t +=  $us_1_t;
}

if($us_2_t <= 0){
  $us_2_t = '-';
}else{
  $us_t_t +=  $us_2_t;
}


   
?>
  <div class="dashboard">

          <!-- Number of Schools -->
          <div class="card">
              <div class="info">
                  <div class="title"><span class="icon schools">🏫</span> Total Schools</div>                  
                  <div class="value"><?= $totalSchools ?></div>
                  <div class="staff-breakup">
                      Open/Active: <?= $openSchools ?> | Closed/In-active: <?= $closeSchools ?>
                  </div>
              </div>
          </div>

          <!-- Number of Staffs -->
          <div class="card">
              <div class="info">
                  <div class="title">
                    <span class="icon staffs" style="background: #fff3cd;olor: #D4AF37; border: 2px solid #D4AF37;">👥</span> Total Staffs</div>
                  <div class="value"><?= $t_t ?></div>
                  <div class="staff-breakup">
                      Teaching: <?= $t_1 ?> | Non-Teaching: <?= $t_2 ?>
                  </div>
              </div>
              
          </div>

          <!-- NG to G Cases -->
          <div class="card">
              <div class="info">
                  <div class="title"><span class="icon ngtog">🔁</span> NG → G Cases</div>
                  <div class="value"> <?= $ng2gCount ?></div>
              </div>
              
          </div>

      </div>
      <br/>
<div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card shadow border-warning h-100">
                <div class="card-header bg-warning text-dark fw-bold">
                     <h5 class="fw-bold text-dark mb-1">
                        <i class="fa fa-exchange-alt me-2"></i>
                        Non-Grant to Grant Individual Order Applications – Stage-wise Status
                    </h5>
                    <p class="text-muted mb-0">
                        Live status of applications across various approval levels.
                    </p>
                </div>

            </div>
        </div>

<div class="row g-3">

    
    <div class="col-md-4 col-lg-3">
        <div class="card border-warning shadow-sm h-100">
            <div class="card-body text-center">
                <h6 class="text-muted">EO Primary Pending</h6>
                <h2 class="text-warning fw-bold" style="cursor: pointer;" onclick="openLeftSlider('eo',1)"><?= $statusCounts['ind']['eo_primary_pending'] ?></h2>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-lg-3">
        <div class="card border-warning shadow-sm h-100">
            <div class="card-body text-center">
                <h6 class="text-muted mb-2">EO Secondary Pending</h6>
                <h2 class="text-warning fw-bold" style="cursor: pointer;" onclick="openLeftSlider('eo',2)"><?= $statusCounts['ind']['eo_secondary_pending'] ?></h2>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-lg-3">
        <div class="card border-warning shadow-sm h-100">
            <div class="card-body text-center">
                <h6 class="text-muted mb-2">MNP Pending</h6>
                <h2 class="text-warning fw-bold"style="cursor: pointer;" onclick="openLeftSlider('mnp',3)"><?= $statusCounts['ind']['eo_mnp_pending'] ?></h2>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-lg-3">
        <div class="card border-warning shadow-sm h-100">
            <div class="card-body text-center">
                <h6 class="text-muted mb-2">DYD Pending</h6>
                <h2 class="text-warning fw-bold" style="cursor: pointer;" onclick="openLeftSlider('dyd',4)"><?= $statusCounts['ind']['dyd_pending'] ?></h2>
            </div>
        </div>
    </div>

    

    <div class="col-md-4 col-lg-3">
        <div class="card border-danger shadow-sm h-100">
            <div class="card-body text-center">
                <h6 class="text-muted mb-2">EO Primary Rejected</h6>
                <h2 class="text-danger fw-bold"><?= $statusCounts['ind']['eo_primary_rejected'] ?></h2>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-lg-3">
        <div class="card border-danger shadow-sm h-100">
            <div class="card-body text-center">
                <h6 class="text-muted mb-2">EO Secondary Rejected</h6>
                <h2 class="text-danger fw-bold"><?= $statusCounts['ind']['eo_secondary_rejected'] ?></h2>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-lg-3">
        <div class="card border-danger shadow-sm h-100">
            <div class="card-body text-center">
                <h6 class="text-muted mb-2">MNP Rejected</h6>
                <h2 class="text-danger fw-bold"><?= $statusCounts['ind']['mnp_rejected'] ?></h2>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-lg-3">
        <div class="card border-danger shadow-sm h-100">
            <div class="card-body text-center">
                <h6 class="text-muted mb-2">DYD Rejected</h6>
                <h2 class="text-danger fw-bold"><?= $statusCounts['ind']['dyd_rejected'] ?></h2>
            </div>
        </div>
    </div>

    

    <div class="col-md-4 col-lg-3">
        <div class="card border-info shadow-sm h-100">
            <div class="card-body text-center">
                <h6 class="text-muted mb-2">Sanstha Pending</h6>
                <h2 class="text-warning fw-bold"><?= $statusCounts['ind']['sanstha_application_pending'] ?></h2>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-lg-3">
        <div class="card border-secondary shadow-sm h-100">
            <div class="card-body text-center">
                <h6 class="text-muted mb-2">Others</h6>
                <h2 class="text-secondary fw-bold"><?= $statusCounts['ind']['others'] ?></h2>
            </div>
        </div>
    </div>

</div>

<hr/>


<!-- Backdrop -->
<div id="sliderBackdrop" class="slider-backdrop" onclick="closeLeftSlider()"></div>

<!-- Left Slider -->
<div id="leftSlider" class="left-slider">

    <div class="slider-header">
        <h5 class="mb-0" id="headingBackdrop">
            Individual Order Details
        </h5>

        <button class="btn-close btn-close-white"
                onclick="closeLeftSlider()">
        </button>
    </div>

    <div class="slider-body" id="bodyBackdrop">
    </div>

</div>



<div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card shadow border-warning h-100">
                <div class="card-header bg-warning text-dark fw-bold">
                     <h5 class="fw-bold text-dark mb-1">
                        <i class="fa fa-exchange-alt me-2"></i>
                        Non-Grant to Grant Applications – Stage-wise Status
                    </h5>
                    <p class="text-muted mb-0">
                        Live status of applications across various approval levels.
                    </p>
                </div>

            </div>
        </div>
<div class="container-fluid">


    <div class="row g-3">
    


         

        <!-- Sanstha -->
        <div class="col-xl-4 col-lg-4 col-md-6">
            <div class="card shadow border-danger h-100">
                <div class="card-header bg-danger text-dark fw-bold">
                    <i class="fa fa-school"></i> Sanstha
                </div>

                <div class="card-body">

                    <div class="d-flex justify-content-between">
                        <span>Returned Pending</span>
                        <span class="badge bg-warning fs-6"><?= $statusCounts['ng2g']['sanstha_returned_pending'] ?></span>
                    </div>

                </div>
            </div>
        </div>

        <!-- EO Primary -->
        <div class="col-xl-4 col-lg-4 col-md-6">
            <div class="card shadow border-dark h-100">
                <div class="card-header bg-dark text-light fw-bold">
                    <i class="fa fa-user"></i> EO - Primary
                </div>

                <div class="card-body">

                    <div class="d-flex justify-content-between mb-2">
                        <span>Pending</span>
                        <span class="badge bg-warning text-dark fs-6" style="cursor: pointer;" onclick="openNg2GLeftSlider('eo',1)"><?= $statusCounts['ng2g']['eo_primary_pending'] ?></span>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span>Rejected</span>
                        <span class="badge bg-danger fs-6"><?= $statusCounts['ng2g']['eo_primary_rejected'] ?></span>
                    </div>

                </div>
            </div>
        </div>

        <!-- EO Secondary -->

        <div class="col-xl-4 col-lg-4 col-md-6">
            <div class="card shadow border-dark h-100">

                <div class="card-header bg-dark text-light fw-bold">
                    EO - Secondary
                </div>

                <div class="card-body">

                    <div class="d-flex justify-content-between mb-2">
                        <span>Pending</span>
                        <span class="badge bg-warning text-dark fs-6" style="cursor: pointer;" onclick="openNg2GLeftSlider('eo',2)"><?= $statusCounts['ng2g']['eo_secondary_pending'] ?></span>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span>Rejected</span>
                        <span class="badge bg-danger fs-6"><?= $statusCounts['ng2g']['eo_secondary_rejected'] ?></span>
                    </div>

                </div>

            </div>
        </div>

        <!-- EO MNP -->

        <div class="col-xl-4 col-lg-4 col-md-6">

            <div class="card shadow border-secondary h-100">

                <div class="card-header bg-secondary text-dark fw-bold">
                    MNP
                </div>

                <div class="card-body">

                    <div class="d-flex justify-content-between mb-2">
                        <span>Pending</span>
                        <span class="badge bg-warning text-dark fs-6" style="cursor: pointer;" onclick="openNg2GLeftSlider('nmp',3)"><?= $statusCounts['ng2g']['mnp_pending'] ?></span>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span>Rejected</span>
                        <span class="badge bg-danger fs-6"><?= $statusCounts['ng2g']['mnp_rejected'] ?></span>
                    </div>

                </div>

            </div>

        </div>

        <!-- DYD Primary -->

        <div class="col-xl-4 col-lg-4 col-md-6">

            <div class="card shadow border-primary h-100">

                <div class="card-header bg-primary text-white fw-bold">
                    DYD - Primary
                </div>

                <div class="card-body">

                    <div class="d-flex justify-content-between mb-2">
                        <span>Pending</span>
                        <span class="badge bg-warning fs-6" style="cursor: pointer;" onclick="openNg2GLeftSlider('dyd',1)"><?= $statusCounts['ng2g']['dyd_primary_pending'] ?></span>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span>Rejected</span>
                        <span class="badge bg-danger fs-6"><?= $statusCounts['ng2g']['dyd_primary_rejected'] ?></span>
                    </div>

                </div>

            </div>

        </div>

        <!-- DYD Secondary -->

        <div class="col-xl-4 col-lg-4 col-md-6">

            <div class="card shadow border-primary">

                <div class="card-header bg-primary text-white fw-bold">
                    DYD - Secondary
                </div>

                <div class="card-body">

                    <div class="d-flex justify-content-between mb-2">
                        <span>Pending</span>
                        <span class="badge bg-warning fs-6" style="cursor: pointer;" onclick="openNg2GLeftSlider('dyd',2)"><?= $statusCounts['ng2g']['dyd_secondary_pending'] ?></span>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span>Rejected</span>
                        <span class="badge bg-danger fs-6"><?= $statusCounts['ng2g']['dyd_secondary_rejected'] ?></span>
                    </div>

                </div>

            </div>

        </div>
        <div class="col-xl-4 col-lg-4 col-md-6">

            <div class="card shadow border-primary">

                <div class="card-header bg-primary text-white fw-bold">
                    DYD - MNP
                </div>

                <div class="card-body">

                    <div class="d-flex justify-content-between mb-2">
                        <span>Pending</span>
                        <span class="badge bg-warning fs-6" style="cursor: pointer;" onclick="openNg2GLeftSlider('dyd',3)"><?= $statusCounts['ng2g']['dyd_mnp_pending'] ?></span>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span>Rejected</span>
                        <span class="badge bg-danger fs-6"><?= $statusCounts['ng2g']['dyd_mnp_rejected'] ?></span>
                    </div>

                </div>

            </div>

        </div>

        <!-- DYD Higher Secondary -->

        <div class="col-xl-4 col-lg-4 col-md-6">

            <div class="card shadow border-primary">

                <div class="card-header bg-primary text-white fw-bold">
                    DYD - Higher Secondary
                </div>

                <div class="card-body">

                    <div class="d-flex justify-content-between mb-2">
                        <span>Pending</span>
                        <span class="badge bg-warning fs-6" style="cursor: pointer;" onclick="openNg2GLeftSlider('dyd',4)"><?= $statusCounts['ng2g']['dyd_higher_secondary_pending'] ?></span>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span>Rejected</span>
                        <span class="badge bg-danger fs-6"><?= $statusCounts['ng2g']['dyd_higher_secondary_rejected'] ?></span>
                    </div>

                </div>

            </div>

        </div>

        <!-- Director Primary -->

        <div class="col-xl-4 col-lg-4 col-md-6">

            <div class="card shadow border-info h-100">

                <div class="card-header bg-info text-white fw-bold">
                    Director - Primary
                </div>

                <div class="card-body">

                    <div class="d-flex justify-content-between mb-2">
                        <span>Pending</span>
                        <span class="badge bg-warning fs-6" style="cursor: pointer;" onclick="openNg2GLeftSlider('dd',1)"><?= $statusCounts['ng2g']['director_primary_pending'] ?></span>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span>Rejected</span>
                        <span class="badge bg-danger fs-6"><?= $statusCounts['ng2g']['director_primary_rejected'] ?></span>
                    </div>

                </div>

            </div>

        </div>

        <!-- Director Secondary -->

        <div class="col-xl-4 col-lg-4 col-md-6">

            <div class="card shadow border-info">

                <div class="card-header bg-info text-white fw-bold">
                    Director - Secondary
                </div>

                <div class="card-body">

                    <div class="d-flex justify-content-between mb-2">
                        <span>Pending</span>
                        <span class="badge bg-warning fs-6" style="cursor: pointer;" onclick="openNg2GLeftSlider('dd',2)"><?= $statusCounts['ng2g']['director_secondary_pending'] ?></span>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span>Rejected</span>
                        <span class="badge bg-danger fs-6"><?= $statusCounts['ng2g']['director_secondary_rejected'] ?></span>
                    </div>

                </div>

            </div>

        </div>
        <div class="col-xl-4 col-lg-4 col-md-6">

            <div class="card shadow border-info">

                <div class="card-header bg-info text-white fw-bold">
                    Director - MNP
                </div>

                <div class="card-body">

                    <div class="d-flex justify-content-between mb-2">
                        <span>Pending</span>
                        <span class="badge bg-warning fs-6" style="cursor: pointer;" onclick="openNg2GLeftSlider('dd',3"><?= $statusCounts['ng2g']['director_mnp_pending'] ?></span>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span>Rejected</span>
                        <span class="badge bg-danger fs-6"><?= $statusCounts['ng2g']['director_mnp_rejected'] ?></span>
                    </div>

                </div>

            </div>

        </div>

        <!-- Director Higher Secondary -->

        <div class="col-xl-4 col-lg-4 col-md-6">

            <div class="card shadow border-info">

                <div class="card-header bg-info text-white fw-bold">
                    Director - Higher Secondary
                </div>

                <div class="card-body">

                    <div class="d-flex justify-content-between mb-2">
                        <span>Pending</span>
                        <span class="badge bg-warning fs-6" style="cursor: pointer;" onclick="openNg2GLeftSlider('dd',4)"><?= $statusCounts['ng2g']['director_higher_secondary_pending'] ?></span>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span>Rejected</span>
                        <span class="badge bg-danger fs-6"><?= $statusCounts['ng2g']['director_higher_secondary_rejected'] ?></span>
                    </div>

                </div>

            </div>

        </div>

       

        <!-- Commissioner -->

        <div class="col-xl-12 col-lg-12 col-md-12">

            <div class="card shadow border-success">

                <div class="card-header bg-success text-white fw-bold">
                    Commissioner
                </div>

                <div class="card-body">

                    <div class="d-flex justify-content-between mb-2">
                        <span>Pending</span>
                        <span class="badge bg-warning text-dark fs-3"><?= $statusCounts['ng2g']['commissioner_pending'] ?></span>
                    
                        <span>Rejected</span>
                        <span class="badge bg-danger fs-3"><?= $statusCounts['ng2g']['commissioner_rejected'] ?></span>
                   
                        <span>Approved</span>
                        <span class="badge bg-success fs-3"><?= $statusCounts['ng2g']['final_approval'] ?></span>
                    </div>

                </div>

            </div>

        </div>

       

    </div>

</div>

    
      <!--
       <div class="container py-4">
        <div class="row g-4">

          <div class="col-md-6">
            <div class="card border-0 shadow-lg rounded-4 h-100">
              <div class="card-header text-white rounded-top-4" 
                  style="background: linear-gradient(135deg, #0056b3, #007bff);">
                <h6 class="mb-0">
                  <i class="bi bi-people-fill me-2"></i>Non-Grant to Grant - Higher Secondary 
                </h6>
              </div>

              <div class="card-body p-3">

                <table class="table table-sm align-middle mb-0">
                  <thead class="table-light">
                    <tr>
                      <th rowspan="2">Status</th>
                      <th colspan="3" class="text-center">Applications</th>
                    </tr>
                    <tr>
                      <th class="text-center">Pending</th>
                      <th class="text-center">Rejected</th>
                      <th class="text-center">Approved</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <span class="badge bg-info">DYD Clerk</span>
                      </td>
                      <td class="text-center fw-bold text-warning"><?= $us_p_t ?></td>                    
                      <td class="text-center fw-bold text-danger"><?= $us_p_t ?></td>
                       <td class="text-center fw-bold text-success"><?= $us_p_t ?></td>
                    </tr>
                    <tr>
                      <td>
                        <span class="badge bg-warning">DYD Assistant Deputy Inspector</span>
                      </td>
                      <td class="text-center fw-bold text-warning"><?= $us_p_t ?></td>                    
                      <td class="text-center fw-bold text-danger"><?= $us_p_t ?></td>
                       <td class="text-center fw-bold text-success"><?= $us_p_t ?></td>
                    </tr>
                    <tr>
                      <td>
                        <span class="badge bg-primary">DYD Assistant Director</span>
                      </td>
                      <td class="text-center fw-bold text-warning"><?= $us_p_t ?></td>                    
                      <td class="text-center fw-bold text-danger"><?= $us_p_t ?></td>
                       <td class="text-center fw-bold text-success"><?= $us_p_t ?></td>
                    </tr>
                    <tr>
                      <td>
                        <span class="badge bg-success">DYD</span>
                      </td>
                      <td class="text-center fw-bold text-warning"><?= $us_p_t ?></td>                    
                      <td class="text-center fw-bold text-danger"><?= $us_p_t ?></td>
                       <td class="text-center fw-bold text-success"><?= $us_p_t ?></td>
                    </tr>

                   
                    <tr class="table-secondary">
                      <th>Total DYD Office</th>
                      <th class="text-center"><?= $us_1_t ?></th>
                      <th class="text-center"><?= $us_2_t ?></th>
                      <th class="text-center"><?= $us_t_t ?></th>
                    </tr>

                     <tr>
                      <td>
                        <span class="badge bg-info">Dy Director</span>
                      </td>
                      <td class="text-center fw-bold text-warning"><?= $us_p_t ?></td>                    
                      <td class="text-center fw-bold text-danger"><?= $us_p_t ?></td>
                       <td class="text-center fw-bold text-success"><?= $us_p_t ?></td>
                    </tr>
                    
                    <tr>
                      <td>
                        <span class="badge bg-primary">Director</span>
                      </td>
                      <td class="text-center fw-bold text-warning"><?= $us_p_t ?></td>                    
                      <td class="text-center fw-bold text-danger"><?= $us_p_t ?></td>
                       <td class="text-center fw-bold text-success"><?= $us_p_t ?></td>
                    </tr>

                   
                    <tr class="table-secondary">
                      <th>Total Director Office</th>
                      <th class="text-center"><?= $us_1_t ?></th>
                      <th class="text-center"><?= $us_2_t ?></th>
                      <th class="text-center"><?= $us_t_t ?></th>
                    </tr>
                    <tr>
                      <td>
                        <span class="badge bg-success">Commissioner</span>
                      </td>
                      <td class="text-center fw-bold text-warning"><?= $us_p_t ?></td>                    
                      <td class="text-center fw-bold text-danger"><?= $us_p_t ?></td>
                       <td class="text-center fw-bold text-success"><?= $us_p_t ?></td>
                    </tr>
                    <tr class="table-secondary">
                      <th>Total</th>
                      <th class="text-center"><?= $us_1_t ?></th>
                      <th class="text-center"><?= $us_2_t ?></th>
                      <th class="text-center"><?= $us_t_t ?></th>
                    </tr>

                  </tbody>
                </table>

              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card border-0 shadow-lg rounded-4 h-100">
              <div class="card-header text-white rounded-top-4"
                  style="background: linear-gradient(135deg, #6a11cb, #2575fc);">
                <h6 class="mb-0">
                  <i class="bi bi-check2-circle me-2"></i>Non-Grant to Grant - Secondary
                </h6>
              </div>

              <div class="card-body p-3">

                <table class="table table-sm align-middle mb-0">
                  <thead class="table-light">
                    <tr>
                      <th rowspan="2">Status</th>
                      <th colspan="3" class="text-center">Applications</th>
                    </tr>
                    <tr>
                      <th class="text-center">Pending</th>
                      <th class="text-center">Rejected</th>
                      <th class="text-center">Approved</th>
                    </tr>
                  </thead>
                  <tbody>

                    <tr>
                      <td>
                        <span class="badge bg-info">EO Clerk</span>
                      </td>
                      <td class="text-center fw-bold text-warning"><?= $us_p_t ?></td>                    
                      <td class="text-center fw-bold text-danger"><?= $us_p_t ?></td>
                       <td class="text-center fw-bold text-success"><?= $us_p_t ?></td>
                    </tr>
                    <tr>
                      <td>
                        <span class="badge bg-primary">EO Superintendent</span>
                      </td>
                      <td class="text-center fw-bold text-warning"><?= $us_p_t ?></td>                    
                      <td class="text-center fw-bold text-danger"><?= $us_p_t ?></td>
                       <td class="text-center fw-bold text-success"><?= $us_p_t ?></td>
                    </tr>
                    <tr>
                      <td>
                        <span class="badge bg-success">EO</span>
                      </td>
                      <td class="text-center fw-bold text-warning"><?= $us_p_t ?></td>                    
                      <td class="text-center fw-bold text-danger"><?= $us_p_t ?></td>
                       <td class="text-center fw-bold text-success"><?= $us_p_t ?></td>
                    </tr>

                   
                    <tr class="table-secondary">
                      <th>Total EO Office</th>
                      <th class="text-center"><?= $us_1_t ?></th>
                      <th class="text-center"><?= $us_2_t ?></th>
                      <th class="text-center"><?= $us_t_t ?></th>
                    </tr>                  
                    <tr>
                      <td>
                        <span class="badge bg-info">DYD Clerk</span>
                      </td>
                      <td class="text-center fw-bold text-warning"><?= $us_p_t ?></td>                    
                      <td class="text-center fw-bold text-danger"><?= $us_p_t ?></td>
                       <td class="text-center fw-bold text-success"><?= $us_p_t ?></td>
                    </tr>
                    <tr>
                      <td>
                        <span class="badge bg-primary">DYD Deputy Education Inspector</span>
                      </td>
                      <td class="text-center fw-bold text-warning"><?= $us_p_t ?></td>                    
                      <td class="text-center fw-bold text-danger"><?= $us_p_t ?></td>
                       <td class="text-center fw-bold text-success"><?= $us_p_t ?></td>
                    </tr>
                    <tr>
                      <td>
                        <span class="badge bg-success">DYD</span>
                      </td>
                      <td class="text-center fw-bold text-warning"><?= $us_p_t ?></td>                    
                      <td class="text-center fw-bold text-danger"><?= $us_p_t ?></td>
                       <td class="text-center fw-bold text-success"><?= $us_p_t ?></td>
                    </tr>

                   
                    <tr class="table-secondary">
                      <th>Total DYD Office</th>
                      <th class="text-center"><?= $us_1_t ?></th>
                      <th class="text-center"><?= $us_2_t ?></th>
                      <th class="text-center"><?= $us_t_t ?></th>
                    </tr>

                     <tr>
                      <td>
                        <span class="badge bg-info">Dy Director</span>
                      </td>
                      <td class="text-center fw-bold text-warning"><?= $us_p_t ?></td>                    
                      <td class="text-center fw-bold text-danger"><?= $us_p_t ?></td>
                       <td class="text-center fw-bold text-success"><?= $us_p_t ?></td>
                    </tr>
                    
                    <tr>
                      <td>
                        <span class="badge bg-primary">Director</span>
                      </td>
                      <td class="text-center fw-bold text-warning"><?= $us_p_t ?></td>                    
                      <td class="text-center fw-bold text-danger"><?= $us_p_t ?></td>
                       <td class="text-center fw-bold text-success"><?= $us_p_t ?></td>
                    </tr>

                   
                    <tr class="table-secondary">
                      <th>Total Director Office</th>
                      <th class="text-center"><?= $us_1_t ?></th>
                      <th class="text-center"><?= $us_2_t ?></th>
                      <th class="text-center"><?= $us_t_t ?></th>
                    </tr>
                    <tr>
                      <td>
                        <span class="badge bg-success">Commissioner</span>
                      </td>
                      <td class="text-center fw-bold text-warning"><?= $us_p_t ?></td>                    
                      <td class="text-center fw-bold text-danger"><?= $us_p_t ?></td>
                       <td class="text-center fw-bold text-success"><?= $us_p_t ?></td>
                    </tr>
                    <tr class="table-secondary">
                      <th>Total</th>
                      <th class="text-center"><?= $us_1_t ?></th>
                      <th class="text-center"><?= $us_2_t ?></th>
                      <th class="text-center"><?= $us_t_t ?></th>
                    </tr>

                  </tbody>
                </table>

              </div>
            </div>
          </div>

         

        </div>
      </div>-->
      <!--
      <div class="dashboard">
           <div class="card">
              <div class="info">
                  <div class="title"><span class="value"><?= $districtCount ?></span> Districts</div>  
              </div>
          </div>
           <div class="card">
              <div class="info">
                  <div class="title"><span class="value"><?= $blockCount ?></span> Blocks</div>  
              </div>
          </div>
           <div class="card">
              <div class="info">
                  <div class="title"><span class="value"><?= $clusterCount ?></span> Clusters</div>  
              </div>
          </div>

          

      </div>-->
      <!--
      <div class="container py-4">
        <div class="row g-4">

          <div class="col-md-6">
            <div class="card border-0 shadow-lg rounded-4 h-100">
              <div class="card-header text-white rounded-top-4" 
                  style="background: linear-gradient(135deg, #0056b3, #007bff);">
                <h6 class="mb-0">
                  <i class="bi bi-people-fill me-2"></i>Staff Distribution
                </h6>
              </div>

              <div class="card-body p-3">

                <table class="table table-sm align-middle mb-0">
                  <thead class="table-light">
                    <tr>
                      <th>Category</th>
                      <th class="text-center">Teaching</th>
                      <th class="text-center">Non-Teaching</th>
                      <th class="text-center">Total</th>
                    </tr>
                  </thead>
                  <tbody>

                    <tr>
                      <td>
                        <span class="badge bg-primary">Fully-Aided</span>
                      </td>
                      <td class="text-center fw-semibold"><?= $full_1 ?></td>
                      <td class="text-center fw-semibold"><?= $full_2 ?></td>
                      <td class="text-center fw-bold text-primary"><?= $full_t ?></td>
                    </tr>

                    <tr>
                      <td>
                        <span class="badge bg-warning text-dark">Partially-Aided</span>
                      </td>
                      <td class="text-center fw-semibold"><?= $part_1 ?></td>
                      <td class="text-center fw-semibold"><?= $part_2 ?></td>
                      <td class="text-center fw-bold text-warning"><?= $part_t ?></td>
                    </tr>

                    <tr>
                      <td>
                        <span class="badge bg-success">Self-Financed</span>
                      </td>
                      <td class="text-center fw-semibold"><?= $self_1 ?></td>
                      <td class="text-center fw-semibold"><?= $self_2 ?></td>
                      <td class="text-center fw-bold text-success"><?= $self_t ?></td>
                    </tr>
                    <tr class="table-secondary">
                      <th>Total</th>
                      <th class="text-center"><?= $t_1 ?></th>
                      <th class="text-center"><?= $t_2 ?></th>
                      <th class="text-center"><?= $t_t ?></th>
                    </tr>

                  </tbody>
                </table>

              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card border-0 shadow-lg rounded-4 h-100">
              <div class="card-header text-white rounded-top-4"
                  style="background: linear-gradient(135deg, #6a11cb, #2575fc);">
                <h6 class="mb-0">
                  <i class="bi bi-check2-circle me-2"></i>Staff Information Update Progress
                </h6>
              </div>

              <div class="card-body p-3">

                <table class="table table-sm align-middle mb-0">
                  <thead class="table-light">
                    <tr>
                      <th>Status</th>
                      <th class="text-center">Teaching</th>
                      <th class="text-center">Non-Teaching</th>
                      <th class="text-center">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                   
                    <tr>
                      <td>
                        <span class="badge bg-danger">Pending</span>
                      </td>
                      <td class="text-center fw-semibold"><?= $us_p_1 ?></td>
                      <td class="text-center fw-semibold"><?= $us_p_2 ?></td>
                      <td class="text-center fw-bold text-danger"><?= $us_p_t ?></td>
                    </tr>
                    
                   
                    <tr>
                      <td>
                        <span class="badge bg-warning text-dark">In Progress</span>
                      </td>
                      <td class="text-center fw-semibold"><?= $us_in_1 ?></td>
                      <td class="text-center fw-semibold"><?= $us_in_2 ?></td>
                      <td class="text-center fw-bold text-warning"><?= $us_in_t ?></td>
                    </tr>

                    
                    <tr>
                      <td>
                        <span class="badge bg-warning">Pending at Cluster Level</span>
                      </td>
                      <td class="text-center fw-semibold"><?= $us_rfc_1 ?></td>
                      <td class="text-center fw-semibold"><?= $us_rfc_2 ?></td>
                      <td class="text-center fw-bold text-warning"><?= $us_rfc_t ?></td>
                    </tr>

                   


                    
                    <tr>
                      <td>
                        <span class="badge bg-danger">Returned by Cluster</span>
                      </td>
                      <td class="text-center fw-semibold"><?= $us_rc_1 ?></td>
                      <td class="text-center fw-semibold"><?= $us_rc_2 ?></td>
                      <td class="text-center fw-bold text-danger"><?= $us_rc_t ?></td>
                    </tr>

                    
                    <tr>
                      <td>
                        <span class="badge bg-warning">Pending at Block Level</span>
                      </td>
                      <td class="text-center fw-semibold"><?= $us_ac_1 ?></td>
                      <td class="text-center fw-semibold"><?= $us_ac_2 ?></td>
                      <td class="text-center fw-bold text-warning"><?= $us_ac_t ?></td>
                    </tr>

                    
                    <tr>
                      <td>
                        <span class="badge bg-danger">Returned by Block</span>
                      </td>
                      <td class="text-center fw-semibold"><?= $us_rb_1 ?></td>
                      <td class="text-center fw-semibold"><?= $us_rb_2 ?></td>
                      <td class="text-center fw-bold text-danger"><?= $us_rb_t ?></td>
                    </tr>

                    
                    <tr>
                      <td>
                        <span class="badge bg-success">Verified</span>
                      </td>
                      <td class="text-center fw-semibold"><?= $us_ac_1 ?></td>
                      <td class="text-center fw-semibold"><?= $us_ac_2 ?></td>
                      <td class="text-center fw-bold text-success"><?= $us_ac_t ?></td>
                    </tr>

                   
                    <tr class="table-secondary">
                      <th>Total</th>
                      <th class="text-center"><?= $us_1_t ?></th>
                      <th class="text-center"><?= $us_2_t ?></th>
                      <th class="text-center"><?= $us_t_t ?></th>
                    </tr>

                  </tbody>
                </table>

              </div>
            </div>
          </div>

         

        </div>
      </div>-->
     

   
  
  <script>
    const filterTabs = document.querySelectorAll('#filterTabs .nav-link');
    const allCards = document.querySelectorAll('.teacher-card');

    filterTabs.forEach(tab => {
      tab.addEventListener('click', () => {
        const target = tab.dataset.bsTarget.replace('#', '');
        const targetPane = document.getElementById(target);

        // Clear previous content
        if (target !== 'all') {
          targetPane.innerHTML = '';
          allCards.forEach(card => {
            if (card.dataset.category.includes(target)) {
              const clone = card.cloneNode(true);
              targetPane.appendChild(clone);
            }
          });
        }
      });
    });
  </script>

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
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script>
      $(document).ready(function () {
        
        openNg2GLeftSlider = function (jurisdiction,level) {
            tt = '';
            if(jurisdiction == 'eo' && level == 1){
              tt = 'District-wise Application Status (EO - Primary)';    
            }else if(jurisdiction == 'eo' && level == 2){
              tt = 'District-wise Application Status (EO - Secondary)';    
            }else if(jurisdiction == 'mnp' && level == 3){
              tt = 'MNC/MNP-wise Application Status';    
            }else if(jurisdiction == 'dyd' && level == 1){
              tt = 'Division-wise Application Status (Primary)';    
            }else if(jurisdiction == 'dyd' && level == 2){
              tt = 'Division-wise Application Status (Secondary)';    
            }else if(jurisdiction == 'dyd' && level == 3){
              tt = 'Division-wise Application Status (MNP)';    
            }else if(jurisdiction == 'dyd' && level == 4){
              tt = 'Division-wise Application Status (Higher Secondary)';    
            }

            if(tt == ''){
              alert('please try again');
            }else{
              $('#headingBackdrop').html(tt);
              $('#leftSlider').addClass('open');
              $('#sliderBackdrop').addClass('show');
              $.ajax({
                  url: "<?= $this->Url->build([
                      'controller' => 'Utilities',
                      'action' => 'jurisdictionNg2GStats'
                  ]) ?>/" + jurisdiction + "/" + level,

                  type: "GET",
                  dataType: "json",
                  beforeSend: function () {
                      $("#bodyBackdrop").html(
                          '<div class="text-center p-3"><div class="spinner-border text-primary">EduStaff Ng2G</div></div>'
                      );
                  },
                  success: function (response) {                    
                    if(response.success){
                      $("#bodyBackdrop").html(response.html);
                    }
                      
                  },
                  error: function (xhr) {
                      console.log(xhr.responseText);
                      alert("Unable to load statistics.");
                  }
              });
              
              
             }
        }
        openLeftSlider = function (jurisdiction,level) {
            tt = '';
            if(jurisdiction == 'eo' && level == 1){
              tt = 'District-wise Application Status (EO - Primary)';    
            }else if(jurisdiction == 'eo' && level == 2){
              tt = 'District-wise Application Status (EO - Secondary)';    
            }else if(jurisdiction == 'mnp' && level == 3){
              tt = 'MNC/MNP-wise Application Status';    
            }else if(jurisdiction == 'dyd' && level == 4){
              tt = 'Division-wise Application Status (DYD - Higher Secondary)';    
            }

            if(tt == ''){
              alert('please try again');
            }else{
              $('#headingBackdrop').html(tt);
              $('#leftSlider').addClass('open');
              $('#sliderBackdrop').addClass('show');
              $.ajax({
                  url: "<?= $this->Url->build([
                      'controller' => 'Utilities',
                      'action' => 'jurisdictionStats'
                  ]) ?>/" + jurisdiction + "/" + level,

                  type: "GET",
                  dataType: "json",
                  beforeSend: function () {
                      $("#bodyBackdrop").html(
                          '<div class="text-center p-3"><div class="spinner-border text-primary">EduStaff Ng2G</div></div>'
                      );
                  },
                  success: function (response) {                    
                    if(response.success){
                      $("#bodyBackdrop").html(response.html);
                    }
                      
                  },
                  error: function (xhr) {
                      console.log(xhr.responseText);
                      alert("Unable to load statistics.");
                  }
              });
              
              
             }
        }

        closeLeftSlider = function () {
            $('#leftSlider').removeClass('open');
            $('#sliderBackdrop').removeClass('show');
        }
      });
  </script>
  





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
</style>


<style>
    
    .dashboard-school {
       
        margin: 0px auto;
        padding: 0px;
    

    .school-card {
        background: #ffffff;
        border-radius: 14px;
        box-shadow: 0 10px 24px rgba(0,0,0,0.06);
        padding: 0px 10px;
    }

    /* Header */
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding:0px;
        margin-bottom: 3px;
    }

    .school-name {
        font-size: 20px;
        font-weight: 700;
    }

    .status {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        color: #fff;
    }

    .active { background: #198754; }
    .inactive { background: #6c757d; }
    .closed { background: #dc3545; }
    .open { background: #0b5ed7; }

    /* Info Chips */
    .chips {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 10px;
    }

    .chip {
        background: #eef2ff;
        color: #3730a3;
        padding: 6px 12px;
        border-radius: 16px;
        font-size: 13px;
        font-weight: 600;
    }

    /* Grid */
    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 18px;
    }

    .section {
        background: #f9fafb;
        border-radius: 12px;
        padding: 3px;
    }

    .section h3 {
        font-size: 15px;
        margin-bottom: 12px;
        color: #0b5ed7;
    }

    /* Class Ladder */
    .classes {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .class-box {
        background: #e7f1ff;
        color: #0b5ed7;
        padding: 8px 10px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        text-align: center;
        flex: 1;
        margin: 0 4px;
    }

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


if($school->school_close == 'YES'){
  $statusCls = 'closed';
  $statusLbl = 'CLOSED (IN-ACTIVE)';
}else{
  $statusCls = 'active';
  $statusLbl = 'OPEN (ACTIVE)';
}
?>


      <div class="dashboard-school">
        <div class="school-card">

            <!-- Header -->
            <div class="header">
                <div class="school-name"><?= h($school->udise_code)?> - <?= h($school->school_name)?></div>
                <div class="status <?= h($statusCls)?>"><?= h($statusLbl)?></div>
            </div>

            <!-- Identity -->
            <div class="chips">
                <div class="chip">Category: <?= h($school->school_category_details->desc_in)?></div>
                <div class="chip">Management: <?= h($school->school_management->name)?> - <?= h($school->school_sub_management->name)?> </div>
                <div class="chip">Sanstha: --</div>
            </div>

            <!-- Content -->
            <div class="grid">

                <!-- Classes -->
                <div class="section">
                    <h3>📚 Classes Offered <span class="class-box">Std <?= h($school->lowest_class)?> - Std <?= h($school->highest_class)?></span></h3>
                    
                </div>

                <!-- Staff -->
                <div class="section">
                    <h3>👩‍🏫 Staff Composition 
                      <span class="class-box">Teaching: <?= $t_1 ?></span> 
                      <span class="class-box">Non-Teaching: <?= h($t_2)?></span>
                      <span class="class-box">Total: <?= $t_t ?></span> 
                    </h3>
                    
                </div>

            </div>
        </div>
    </div>
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
                    
                    <!-- Pending -->
                    <tr>
                      <td>
                        <span class="badge bg-danger">Pending</span>
                      </td>
                      <td class="text-center fw-semibold"><?= $us_p_1 ?></td>
                      <td class="text-center fw-semibold"><?= $us_p_2 ?></td>
                      <td class="text-center fw-bold text-danger"><?= $us_p_t ?></td>
                    </tr>
                    
                     <!-- in_progress -->
                    <tr>
                      <td>
                        <span class="badge bg-warning text-dark">In Progress</span>
                      </td>
                      <td class="text-center fw-semibold"><?= $us_in_1 ?></td>
                      <td class="text-center fw-semibold"><?= $us_in_2 ?></td>
                      <td class="text-center fw-bold text-warning"><?= $us_in_t ?></td>
                    </tr>

                    <!-- ready_for_cluster -->
                    <tr>
                      <td>
                        <span class="badge bg-warning">Pending at Cluster Level</span>
                      </td>
                      <td class="text-center fw-semibold"><?= $us_rfc_1 ?></td>
                      <td class="text-center fw-semibold"><?= $us_rfc_2 ?></td>
                      <td class="text-center fw-bold text-warning"><?= $us_rfc_t ?></td>
                    </tr>

                   


                    <!-- rejected_by_cluster -->
                    <tr>
                      <td>
                        <span class="badge bg-danger">Returned by Cluster</span>
                      </td>
                      <td class="text-center fw-semibold"><?= $us_rc_1 ?></td>
                      <td class="text-center fw-semibold"><?= $us_rc_2 ?></td>
                      <td class="text-center fw-bold text-danger"><?= $us_rc_t ?></td>
                    </tr>

                     <!-- approved_by_cluster -->
                    <tr>
                      <td>
                        <span class="badge bg-warning">Pending at Block Level</span>
                      </td>
                      <td class="text-center fw-semibold"><?= $us_ac_1 ?></td>
                      <td class="text-center fw-semibold"><?= $us_ac_2 ?></td>
                      <td class="text-center fw-bold text-warning"><?= $us_ac_t ?></td>
                    </tr>

                    <!-- rejected_by_block -->
                    <tr>
                      <td>
                        <span class="badge bg-danger">Returned by Block</span>
                      </td>
                      <td class="text-center fw-semibold"><?= $us_rb_1 ?></td>
                      <td class="text-center fw-semibold"><?= $us_rb_2 ?></td>
                      <td class="text-center fw-bold text-danger"><?= $us_rb_t ?></td>
                    </tr>

                    <!-- approved_by_block -->
                    <tr>
                      <td>
                        <span class="badge bg-success">Verified</span>
                      </td>
                      <td class="text-center fw-semibold"><?= $us_ac_1 ?></td>
                      <td class="text-center fw-semibold"><?= $us_ac_2 ?></td>
                      <td class="text-center fw-bold text-success"><?= $us_ac_t ?></td>
                    </tr>

                    <!-- Total -->
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

          <div class="col-md-12">
            <div class="card border-0 shadow-lg rounded-4">
              
              <!-- Header -->
              <div class="card-header text-white rounded-top-4"
                  style="background: linear-gradient(135deg, #0f9b0f, #000000);">
                <h6 class="mb-0">
                  <i class="bi bi-diagram-3-fill me-2"></i>Staff Distribution as per Sanch Manyta

                  <button type="button" class="btn btn-sm btn-info" 
                      onclick="updateSanchManyta('<?= h($udise) ?>')">
                      Load from Sanch Manyta
                  </button>
                </h6>
              </div>

              <!-- Body -->
              <div class="card-body p-3">

                <div class="table-responsive">
                  <table class="table table-sm table-hover align-middle">
                    <thead class="table-dark">
                      <tr>
                        <th>Staff Post</th>
                        <th>Staff Type</th>
                        <th class="text-center">Aided Type</th>
                        <th class="text-center">Sanctioned</th>
                        <th class="text-center">Working</th>
                        <th class="text-center">Vacancy</th>
                        <th class="text-center">Status</th>
                      </tr>
                    </thead>
                    <tbody>

                    <?php 

                      $deltaV =  $deltaE = $sumS = $sumW = 0;
                      foreach($sanch as $s){
                        echo ' <tr>
                          <td>'.$s['post_name'].'</td>';
                        if($s['post_type'] ==  1){
                          echo '<td><span class="badge bg-primary">Teaching</span></td>';
                        }else{
                          echo '<td><span class="badge bg-secondary">Non-Teaching</span></td>';
                        }
                        $aid_name = $s['aid_name'];
                        $sancationed = (int) $s['sanctioned_posts'];
                        $working = (int) $s['working_posts'];
                        $vacancy = $s['vacancy'];
                        $sumS += $sancationed;
                        $sumW += $working;
                      
                        echo '<td class="text-center">'.$aid_name.'</td>
                        <td class="text-center">'.$sancationed.'</td>
                          <td class="text-center">'.$working.'</td>
                          <td class="text-center">'. $vacancy.'</td>';

                        if($s['status'] == 'Filled'){
                          echo '<td class="text-center"><span class="badge bg-success">Filled</span></td>';
                        }else if($s['status'] == 'Vacant'){                          
                          $deltaV +=  $vacancy;
                          echo '<td class="text-center">
                                <span class="badge bg-warning text-dark">Vacant</span>
                                </td>';
                        }else{
                          $deltaE +=  $vacancy;
                          echo '<td class="text-center">
                            <span class="badge bg-purple text-white">Excess</span>
                          </td>';
                        }
                      }
                      echo '</tr>';
                      echo '<tr class="table-info fw-bold">
                        <td>Total</td>
                        <td></td>
                        <td></td>
                        <td class="text-center">'.$sumS.'</td>
                        <td class="text-center">'.$sumW.'</td>
                        <td style="text-align:right;" colspan="2">
                          <span class="badge bg-warning text-dark me-2">'.$deltaV.' Vacant</span>
                          <span class="badge bg-purple text-white">'.abs($deltaE).' Excess</span>
                        </td>
                      </tr>';
                      /*$deltaS =  $deltaW = $sumS = $sumW = 0;
                      foreach($sanch as $s){
                        echo ' <tr>
                          <td>'.$s['post']['name'].'</td>';
                        if($s['staffs_type']['staff_type_name'] ==  'Teaching'){
                          echo '<td><span class="badge bg-primary">Teaching</span></td>';
                        }else{
                          echo '<td><span class="badge bg-secondary">'.$s['staffs_type']['staff_type_name'].'</span></td>';
                        }

                        $sancationed = (int) $s['num_posts'];
                        $working = (int) $s['working_posts'];
                        
                        $sumS += $sancationed;
                        $sumW += $working;
                      
                        echo '<td class="text-center">'.$sancationed.'</td>
                          <td class="text-center">'.$working.'</td>';

                        if($sancationed == $working){
                          echo '<td class="text-center"><span class="badge bg-success">OK</span></td>';
                        }else if($sancationed > $working){
                          $delta = $sancationed - $working;
                          $deltaS +=  $delta;
                          echo '<td class="text-center">
                                <span class="badge bg-warning text-dark">'.$delta.' Vacant</span>
                                </td>';
                        }else{                        
                          $delta = $working -  $sancationed;
                          $deltaW +=  $delta;
                          echo '<td class="text-center">
                            <span class="badge bg-purple text-white">'.$delta.' Excess</span>
                          </td>';
                        }
                      }
                      echo '</tr>';
                      echo '<tr class="table-info fw-bold">
                        <td>Total</td>
                        <td></td>
                        <td class="text-center">'.$sumS.'</td>
                        <td class="text-center">'.$sumW.'</td>
                        <td class="text-center">
                          <span class="badge bg-warning text-dark me-2">'.$deltaS.' Vacant</span>
                          <span class="badge bg-purple text-white">'.$deltaW.' Excess</span>
                        </td>
                      </tr>';*/
                   
                    ?>


                      <!-- TOTAL ROW -->
                      

                    </tbody>
                  </table>
                </div>

              </div>
            </div>
          </div>

          <!--<div class="col-md-4">
            <div class="card border-0 shadow-lg rounded-4 h-100">
              <div class="card-header text-white rounded-top-4" 
                  style="background: linear-gradient(135deg, #0056b3, #007bff);">
                <h6 class="mb-0">
                  <i class="bi bi-people-fill me-2"></i>Staff Profile Updation Status
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
                        <span class="badge bg-primary">pending</span>
                      </td>
                      <td class="text-center fw-semibold">14</td>
                      <td class="text-center fw-semibold">2</td>
                      <td class="text-center fw-bold text-primary">16</td>
                    </tr>

                    <tr>
                      <td>
                        <span class="badge bg-warning text-dark">completed</span>
                      </td>
                      <td class="text-center fw-semibold">10</td>
                      <td class="text-center fw-semibold">1</td>
                      <td class="text-center fw-bold text-warning">11</td>
                    </tr>

                    <tr>
                      <td>
                        <span class="badge bg-success">Total</span>
                      </td>
                      <td class="text-center fw-semibold">24</td>
                      <td class="text-center fw-semibold">3</td>
                      <td class="text-center fw-bold text-success">17</td>
                    </tr>

                    <tr class="table-secondary">
                      <th>Total</th>
                      <th class="text-center">29</th>
                      <th class="text-center">5</th>
                      <th class="text-center">34</th>
                    </tr>

                  </tbody>
                </table>

              </div>
            </div>
          </div>-->


          <!-- Total Teachers -->
          <!--<div class="col-md-4">
            <div class="card shadow-gradient border-0 h-100">
              <div class="card-header bg-gradient-primary text-white rounded-top">
                <i class="bi bi-people-fill me-2"></i>Total Teachers
              </div>
              <div class="card-body">
                <p><span class="badge bg-primary me-2">Fully-Aided</span> 24</p>
                <p><span class="badge bg-warning text-dark me-2">Partially-Aided</span> 8</p>
                <p><span class="badge bg-purple text-white me-2">Self-Financed</span> 5</p>
              </div>
            </div>
          </div>-->

          <!-- Data Completion -->
          <!--<div class="col-md-4">
            <div class="card shadow-gradient border-0 h-100">
              <div class="card-header bg-gradient-success text-white">
                <i class="bi bi-bar-chart-line-fill me-2"></i>Profile Completion
              </div>
              <div class="card-body">
                <div class="progress mb-2" style="height: 20px;">
                  <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" style="width: 78%">78%</div>
                </div>
                <small class="text-muted">Updated staff records</small>
              </div>
            </div>
          </div>-->

          <!-- UDISE & Shalarth -->
          <!--<div class="col-md-4">
            <div class="card shadow-gradient border-0 h-100">
              <div class="card-header bg-gradient-warning text-dark">
                <i class="bi bi-link-45deg me-2"></i>UDISE+ & Shalarth Sync
              </div>
              <div class="card-body">
                <p>✅ UDISE+ Available: <strong>32</strong></p>
                <p>❌ UDISE+ Missing: <strong>5</strong></p>
                <p>✅ Shalarth Available: <strong>30</strong></p>
                <p>❌ Shalarth Missing: <strong>7</strong></p>
              </div>
            </div>
          </div>-->

          <!-- Non-Teaching -->
          <!--<div class="col-md-4">
            <div class="card shadow-gradient border-0 h-100">
              <div class="card-header bg-gradient-secondary text-white">
                <i class="bi bi-person-badge-fill me-2"></i>Non-Teaching Staff
              </div>
              <div class="card-body">
                <p>Clerks: <strong>3</strong></p>
                <p>Peons: <strong>2</strong></p>
              </div>
            </div>
          </div>-->

          <!-- Quick Actions -->
          <!--<div class="col-md-4">
            <div class="card shadow-gradient border-0 h-100">
              <div class="card-header bg-gradient-info text-white">
                <i class="bi bi-lightning-charge-fill me-2"></i>Quick Actions
              </div>
              <div class="card-body">
                <button class="btn btn-primary w-100 mb-2"><i class="bi bi-person-plus-fill me-1"></i>Add Teacher</button>
                <button class="btn btn-outline-dark w-100 mb-2"><i class="bi bi-building-fill me-1"></i>View School Profile</button>
                <button class="btn btn-success w-100"><i class="bi bi-graph-up-arrow me-1"></i>Sync Report</button>
              </div>
            </div>
          </div>-->

          <!-- Notifications -->
          <!--<div class="col-md-4">
            <div class="card shadow-gradient border-0 h-100">
              <div class="card-header bg-gradient-danger text-white">
                <i class="bi bi-bell-fill me-2"></i>Notifications
              </div>
              <div class="card-body">
                <p>🔔 <strong>2</strong> Teachers missing Shalarth ID</p>
                <p>🕒 <strong>5</strong> require profile update</p>
              </div>
            </div>
          </div>-->

        </div>
      </div>
      <!--<div style="background: #fff;padding:10px;">
        <h4>Staff Data Update Progress</h4>

       
        <ul class="nav nav-pills mb-3" id="filterTabs">
          <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#all">All</button></li>
          <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#aided">Fully-Aided</button></li>
          <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#partially">Partially-Aided</button></li>
          <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#self">Self-Financed</button></li>
          <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#teaching">Teaching</button></li>
          <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#nonteaching">Non-Teaching</button></li>
          <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#udise-available">UDISE+</button></li>
          <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#shalarth-available">Shalarth</button></li>
        </ul>

        <div class="tab-content">

          
          <div class="tab-pane fade show active" id="all">
            <div class="teacher-card" data-category="aided teaching udise-available shalarth-available">
              <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                  <img src="https://i.pravatar.cc/40?img=1" class="teacher-avatar" alt="Anjali">
                  <div>
                    <strong>Mrs. Anjali Deshmukh</strong> <br>
                    <small>Assistant Teacher</small>
                  </div>
                </div>
                <span class="badge text-white badge-aided">Fully-Aided</span>
              </div>
              <div class="progress mt-2"><div class="progress-bar" style="width: 90%;">90%</div></div>
              <small>UDISE+ <span class="status-icon status-available"></span> | Shalarth <span class="status-icon status-available"></span></small>
            </div>

            <div class="teacher-card" data-category="partially teaching udise-missing shalarth-available">
              <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                  <img src="https://i.pravatar.cc/40?img=2" class="teacher-avatar" alt="Rajeev">
                  <div>
                    <strong>Mr. Rajeev Kulkarni</strong> <br>
                    <small>Senior Teacher</small>
                  </div>
                </div>
                <span class="badge text-dark bg-warning">Partially-Aided</span>
              </div>
              <div class="progress mt-2"><div class="progress-bar bg-warning" style="width: 60%;">60%</div></div>
              <small>UDISE+ <span class="status-icon status-missing"></span> | Shalarth <span class="status-icon status-available"></span></small>
            </div>

            <div class="teacher-card" data-category="self teaching udise-missing shalarth-missing">
              <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                  <img src="https://i.pravatar.cc/40?img=3" class="teacher-avatar" alt="Sneha">
                  <div>
                    <strong>Ms. Sneha Patil</strong> <br>
                    <small>Contractual Staff</small>
                  </div>
                </div>
                <span class="badge text-white badge-self">Self-Financed</span>
              </div>
              <div class="progress mt-2"><div class="progress-bar bg-info" style="width: 30%;">30%</div></div>
              <small>UDISE+ <span class="status-icon status-missing"></span> | Shalarth <span class="status-icon status-missing"></span></small>
            </div>

            <div class="teacher-card" data-category="aided nonteaching udise-available shalarth-missing">
              <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                  <img src="https://i.pravatar.cc/40?img=4" class="teacher-avatar" alt="Priya">
                  <div>
                    <strong>Mrs. Priya Gokhale</strong> <br>
                    <small>Clerk</small>
                  </div>
                </div>
                <span class="badge text-white badge-aided">Fully-Aided</span>
              </div>
              <div class="progress mt-2"><div class="progress-bar bg-success" style="width: 75%;">75%</div></div>
              <small>UDISE+ <span class="status-icon status-available"></span> | Shalarth <span class="status-icon status-missing"></span></small>
            </div>

            <div class="teacher-card" data-category="partially teaching udise-available shalarth-available">
              <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                  <img src="https://i.pravatar.cc/40?img=5" class="teacher-avatar" alt="Amit">
                  <div>
                    <strong>Mr. Amit Shinde</strong> <br>
                    <small>Science Teacher</small>
                  </div>
                </div>
                <span class="badge text-dark bg-warning">Partially-Aided</span>
              </div>
              <div class="progress mt-2"><div class="progress-bar bg-warning" style="width: 85%;">85%</div></div>
              <small>UDISE+ <span class="status-icon status-available"></span> | Shalarth <span class="status-icon status-available"></span></small>
            </div>

            <div class="teacher-card" data-category="aided teaching udise-missing shalarth-missing">
              <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                  <img src="https://i.pravatar.cc/40?img=6" class="teacher-avatar" alt="Sunil">
                  <div>
                    <strong>Mr. Sunil Pawar</strong> <br>
                    <small>Math Teacher</small>
                  </div>
                </div>
                <span class="badge text-white badge-aided">Fully-Aided</span>
              </div>
              <div class="progress mt-2"><div class="progress-bar bg-danger" style="width: 20%;">20%</div></div>
              <small>UDISE+ <span class="status-icon status-missing"></span> | Shalarth <span class="status-icon status-missing"></span></small>
            </div>

          </div>

          <div class="tab-pane fade" id="aided"></div>
          <div class="tab-pane fade" id="partially"></div>
          <div class="tab-pane fade" id="self"></div>
          <div class="tab-pane fade" id="teaching"></div>
          <div class="tab-pane fade" id="nonteaching"></div>
          <div class="tab-pane fade" id="udise-available"></div>
          <div class="tab-pane fade" id="shalarth-available"></div>

        </div>
      </div>-->

   

  <script>
    /*
    new Chart(document.getElementById('eligibilityChart'), {
      type: 'doughnut',
      data: { labels: ['Eligible', 'Ineligible'], datasets: [{ data: [54000, 18105], backgroundColor: ['#28a745', '#dc3545'] }] },
      options: { responsive: true }
    });

    new Chart(document.getElementById('appointmentChart'), {
      type: 'bar',
      data: { labels: ['Primary', 'Secondary', 'Higher Secondary'], datasets: [{ label: 'Appointments', data: [24000, 18000, 10000], backgroundColor: '#007bff' }] },
      options: { responsive: true }
    });

    new Chart(document.getElementById('managementChart'), {
      type: 'pie',
      data: { labels: ['Govt', 'Private', 'Aided'], datasets: [{ data: [3200, 1500, 730], backgroundColor: ['#ffc107', '#28a745', '#007bff'] }] },
      options: { responsive: true }
    });

    new Chart(document.getElementById('teacherEligibilityChart'), {
      type: 'bar',
      data: { labels: ['TET', 'CTET', 'B.Ed'], datasets: [{ label: 'Count', data: [18000, 22000, 12000], backgroundColor: '#17a2b8' }] },
      options: { responsive: true }
    });

    new Chart(document.getElementById('lineChart'), {
      type: 'line',
      data: { labels: ['Jan', 'Feb', 'Mar', 'Apr'], datasets: [{ label: 'Appointments', data: [3000, 4000, 3500, 5000], fill: false, borderColor: '#6610f2' }] },
      options: { responsive: true }
    });

    new Chart(document.getElementById('disabilityChart'), {
      type: 'doughnut',
      data: { labels: ['Disabled', 'Not Disabled'], datasets: [{ data: [1800, 70305], backgroundColor: ['#6f42c1', '#20c997'] }] },
      options: { responsive: true }
    });*/
  </script>

  
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
  <script>
        $(document).ready(function() {
          updateSanchManyta = function(udiseID)
          {
              let payload = {};
              
              payload['school_id'] = udiseID;
              payload['_Token'] = 'ZGVlcGFraHBhdGlsMzAwODE5ODA=';
              

              //console.log(JSON.stringify(payload, null, 2));           
              $.ajax({
                  url: '<?= $this->Url->build(["controller" => "School", "action" => "updateSanchData"]); ?>',
                  type: 'POST',
                  contentType: 'application/json', 
                  dataType: 'json',                
                  headers: {
                      'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') 
                  },
                  data: JSON.stringify(payload),
                  beforeSend: function() {
                      $('#responseMessage').html('<span class="text-info"><div class="text-info d-flex align-items-center"><div class="spinner-border spinner-border-sm me-2" role="status"></div><span>Processing...</span></div></span>');
                  },
                  success: function(response) {
                      
                     alert("Data syn successfully!")
                      
                      
                  },           
                  error: function(xhr) {
                      if (xhr.status === 401) { window.location.href = "/users/login";}
                      $('#processingModal').hide();
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
          }
        }); 
  </script>




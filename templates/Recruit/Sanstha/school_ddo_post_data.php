
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
    .school-card {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
            padding: 20px;
       

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .card-header h2 {
            margin: 0;
            font-size: 20px;
            color: #2c3e50;
        }

        .search-box input {
            padding: 8px 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
            width: 220px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
        }

        thead {
            background: #2c7be5;
            color: #ffffff;
        }

        th, td {
            padding: 12px 10px;
            text-align: left;
            font-size: 14px;
        }

        th {
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }

        tbody tr {
            border-bottom: 1px solid #eaeaea;
        }

        tbody tr:hover {
            background: #f1f6ff;
        }

        .status {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .status.active {
            background: #e6f4ea;
            color: #137333;
        }

        .status.closed {
            background: #fdecea;
            color: #c5221f;
        }

        @media (max-width: 768px) {
            table {
                font-size: 12px;
            }

            .search-box input {
                width: 160px;
            }
        }
   }
</style>


<?php 
/*
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

*/
   
?>


 
      <div class="dashboard">

          <!--
          <div class="card">
              <div class="info">
                  <div class="title"><span class="icon schools">🏫</span> Total Schools</div>                  
                  <div class="value"><?= $totalSchools ?></div>
                  <div class="staff-breakup">
                      Open/Active: <?= $openSchools ?> | Closed/In-active: <?= $closeSchools ?>
                  </div>
              </div>
          </div>

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

          <div class="card">
              <div class="info">
                  <div class="title"><span class="icon ngtog">🔁</span> NG → G Cases</div>
                  <div class="value"> <?= $ng2gCount ?></div>
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
     
      <div class="school-card">
          <div class="card-header">
              <h2>Schools</h2>
              
          </div>

          <table>
              <thead>
                  <tr>
                      <th>UDISE Code</th>
                      <th>School Name</th>
                      <th>Post NAme</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                
                  <?php 
                      foreach ($schools as $s){

                        echo '<tr>
                                      <td>'.$s->udise_code.'</td>
                                      <td>'.$s->school_name.'</td>
                                      <td>'.$s->email_address.'</td>
                                      <td><span>Apply Now</span></td>
                                    
                                  </tr>';
                      }
                  ?>

                
              </tbody>
          </table>
      </div>
   
</div>
 
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

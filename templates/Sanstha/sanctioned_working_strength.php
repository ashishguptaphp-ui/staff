
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
    table tr th{
      font-size: 12px;
    }
    table tr td{
      font-size: 12px;
    }
</style>
<style>
    /* Full table border */
    .custom-table {
        border: 2px solid #2c3e50;
    }

    /* All cells border */
    .custom-table th,
    .custom-table td {
        border: 1px solid #cfd8dc;
    }
    .bg-allocated{
      background:#537895 !important;
    }
    .bg-working{
      background:#663399 !important;
    }
    .bg-vacancy{
      background:#c0970a !important;
    }


</style>



      
            <div class="card border-0 shadow-lg">
              
              <!-- Header -->
              <div class="card-header text-white"
                  style="background: linear-gradient(135deg, #0f9b0f, #000000);">
                <h6 class="mb-0">
                  <i class="bi bi-diagram-3-fill me-2"></i>Sanctioned Working Strength Statement

                 
                </h6>
              </div>

                <div class="table-responsive">
                 
<!--
 <table class="table table-sm table-hover align-middle custom-table">
                    <thead class="table-dark">
                      
                      <tr>
                        <th rowspan="2">Post</th>
                        <th colspan="2" class="text-center">SC</th> 
                        <th colspan="2" class="text-center">ST</th>                       	
                        <th colspan="2" class="text-center">OBC</th>                                           	
                        <th colspan="2" class="text-center">SBC</th>                       	
                        <th colspan="2" class="text-center">General</th>                       	
                        <th colspan="2" class="text-center">VJA</th>                       	
                        <th colspan="2" class="text-center">NTB</th>                       	
                        <th colspan="2" class="text-center">NTC</th>                       	
                        <th colspan="2" class="text-center">NTD</th>                       	
                        <th colspan="2" class="text-center">NotApplicable</th>                       	
                        <th colspan="2" class="text-center">SEBC</th>                       	
                        <th colspan="2" class="text-center">STPesa</th>                       	
                        <th colspan="2" class="text-center">EWS</th>   
                      </tr>
                      <tr>
                        <th class="text-center">Sanction</th>
                        <th class="text-center">Working</th>
                        <th class="text-center">Sanction</th>
                        <th class="text-center">Working</th>
                        <th class="text-center">Sanction</th>
                        <th class="text-center">Working</th>
                        <th class="text-center">Sanction</th>
                        <th class="text-center">Working</th>
                        <th class="text-center">Sanction</th>
                        <th class="text-center">Working</th>
                        <th class="text-center">Sanction</th>
                        <th class="text-center">Working</th>
                        <th class="text-center">Sanction</th>
                        <th class="text-center">Working</th>
                        <th class="text-center">Sanction</th>
                        <th class="text-center">Working</th>
                        <th class="text-center">Sanction</th>
                        <th class="text-center">Working</th>
                        <th class="text-center">Sanction</th>
                        <th class="text-center">Working</th>
                        <th class="text-center">Sanction</th>
                        <th class="text-center">Working</th>
                        <th class="text-center">Sanction</th>
                        <th class="text-center">Working</th>
                        <th class="text-center">Sanction</th>
                        <th class="text-center">Working</th>
                      </tr>
                    </thead>
                    <tbody>

                    <?php
                      $t_p20 = $t_p40 = $t_p60 = $t_p80 = $t_p100 = $t_p0 = $t_sanctionedAded = $t_sanctionedAll= 0;
                      $t_w20 = $t_w40 = $t_w60 = $t_w80 = $t_w100 = $t_w0 = $t_workingAded = $t_workingAll= 0;
                      $t_v20 = $t_v40 = $t_v60 = $t_v80 = $t_v100 = $t_v0 = $t_vacantAded = $t_vacantAll= 0;
                      foreach($posts as $k => $v){
                       
                        
                        foreach($v as $k1 => $v1){        
                          $p20 = $p40 = $p60 = $p80 = $p100 = $p0 = 0;
                          $w20 = $w40 = $w60 = $w80 = $w100 = $w0 = 0;
                          $v20 = $v40 = $v60 = $v80 = $v100 = $v0 = 0;
                          $post_name = $k1;//$v1['post_name'];                         
                          foreach($v1 as $k2 => $v2){     
                                               
                            if($v2['aid_id'] == 1){                             
                              $p100 += $v2['allow'];
                              $w100 += $v2['work'];
                              $v100 += $p100 - $w100;
                            }
                            if($v2['aid_id'] == 2){
                              $p80 += $v2['allow'];
                              $w80 += $v2['work'];
                              $v80 += $p80 - $w80;
                            }
                            if($v2['aid_id'] == 3){
                              $p60 += $v2['allow'];
                              $w60 += $v2['work'];
                              $v60 += $p60 - $w60;
                            }
                            if($v2['aid_id'] == 4){
                              $p40 += $v2['allow'];
                              $w40 += $v2['work'];
                              $v40 += $p40 - $w40;
                            }
                            if($v2['aid_id'] == 5){
                              $p20 += $v2['allow'];
                              $w20 += $v2['work'];
                              $v20 += $p20 - $w20;
                            }
                            if($v2['aid_id'] == 6){
                              $p0 += $v2['allow'];
                              $w0 += $v2['work'];
                              $v0 += $p0 - $w0;
                            }
                          }
                          $t_p0 += $p0;
                          $t_p20 += $p20;
                          $t_p40 += $p40;
                          $t_p60 += $p60;
                          $t_p80 += $p80;
                          $t_p100 += $p100;
                          $t_w0 += $w0;
                          $t_w20 += $w20;
                          $t_w40 += $w40;
                          $t_w60 += $w60;
                          $t_w80 += $w80;
                          $t_w100 += $w100;
                          $t_v0 += $v0;
                          $t_v20 += $v20;
                          $t_v40 += $v40;
                          $t_v60 += $v60;
                          $t_v80 += $v80;
                          $t_v100 += $v100;
                          $sanctionedAded = $p20 + $p40 + $p60 + $p80 + $p100;
                          $t_sanctionedAded += $sanctionedAded;
                          $sanctionedAll = $sanctionedAded + $p0;
                          $t_sanctionedAll += $sanctionedAll;
                          $workingAded = $w20 + $w40 + $w60 + $w80 + $w100;
                          $t_workingAded += $workingAded;
                          $workingAll = $workingAded + $w0;
                          $t_workingAll += $workingAll;
                          $vacantAded = $v20 + $v40 + $v60 + $v80 + $v100;
                          $t_vacantAded += $vacantAded;
                          $vacantAll = $vacantAded + $v0;
                          $t_vacantAll += $vacantAll;
                            //$k == post type
                          echo '<tr>
                            <td>'.$post_name .'</td>
                            <td><input type="text" value="'.$p20 .'"></td>
                            <td><input type="text" value="'.$p40 .'"></td>
                            <td><input type="text" value="'.$p60 .'"></td>
                            <td><input type="text" value="'.$p80 .'"></td>
                            <td><input type="text" value="'.$p100 .'"></td>
                            <td><input type="text" value="'.$sanctionedAded .'"></td>
                            <td><input type="text" value="'.$p0 .'"></td>
                            <td><input type="text" value="'.$sanctionedAll .'"></td>
                            <td><input type="text" value="'.$w20 .'"></td>
                            <td><input type="text" value="'.$w40 .'"></td>
                            <td><input type="text" value="'.$w60 .'"></td>
                            <td><input type="text" value="'.$w80 .'"></td>
                            <td><input type="text" value="'.$w100 .'"></td>
                            <td><input type="text" value="'.$workingAded .'"></td>
                            <td><input type="text" value="'.$w0 .'"></td>
                            <td><input type="text" value="'.$workingAll .'"></td>
                            <td><input type="text" value="'.$v20 .'"></td>
                            <td><input type="text" value="'.$v40 .'"></td>
                            <td><input type="text" value="'.$v60 .'"></td>
                            <td><input type="text" value="'.$v80 .'"></td>
                            <td><input type="text" value="'.$v100 .'"></td>
                            <td><input type="text" value="'.$vacantAded .'"></td>
                            <td><input type="text" value="'.$v0 .'"></td>
                            <td><input type="text" value="'.$vacantAll .'"></td>
                            <td><input type="text" value="'.$v0 .'"></td>
                            <td><input type="text" value="'.$vacantAll .'"></td>
                          </tr>';
                        }
                        

                      }
                      echo '<tr>
                            <td>Total</td>
                            <td class="text-center">'.$t_p20.'</td>
                            <td class="text-center">'.$t_p40.'</td>
                            <td class="text-center">'.$t_p60.'</td>
                            <td class="text-center">'.$t_p80.'</td>
                            <td class="text-center">'.$t_p100.'</td>
                            <td class="text-center">'.$t_sanctionedAded.'</td>
                            <td class="text-center">'.$t_p0.'</td>
                            <td class="text-center">'.$t_sanctionedAll.'</td>
                            <td class="text-center">'.$t_w20.'</td>
                            <td class="text-center">'.$t_w40.'</td>
                            <td class="text-center">'.$t_w60.'</td>
                            <td class="text-center">'.$t_w80.'</td>
                            <td class="text-center">'.$t_w100.'</td>
                            <td class="text-center">'.$t_workingAded.'</td>
                            <td class="text-center">'.$t_w0.'</td>
                            <td class="text-center">'.$t_workingAll.'</td>
                            <td class="text-center">'.$t_v20.'</td>
                            <td class="text-center">'.$t_v40.'</td>
                            <td class="text-center">'.$t_v60.'</td>
                            <td class="text-center">'.$t_v80.'</td>
                            <td class="text-center">'.$t_v100.'</td>
                            <td class="text-center">'.$t_vacantAded.'</td>
                            <td class="text-center">'.$t_v0.'</td>
                            <td class="text-center">'.$t_vacantAll.'</td>
                          </tr>';
                    ?>

                      

                      

                    </tbody>
                  </table>
-->

                 
                  <table class="table table-sm table-hover align-middle custom-table">
                    <thead class="table-dark">
                      
                      <tr>
                        <th rowspan="2">Post</th>
                        <th colspan="8" class="text-center bg-allocated">Sanctioned Posts</th>                       	
                        <th colspan="8" class="text-center bg-working">Working Posts</th>
                        <th colspan="8" class="text-center bg-vacancy">Vacancy</th>
                      </tr>
                      <tr>
                        <th class="text-center bg-allocated">20%</th>
                        <th class="text-center bg-allocated">40%</th>
                        <th class="text-center bg-allocated">60%</th>
                        <th class="text-center bg-allocated">80%</th>
                        <th class="text-center bg-allocated">100%</th>
                        <th class="text-center bg-allocated">Aided Total</th>
                        <th class="text-center bg-allocated">Non-Aided</th>
                        <th class="text-center bg-allocated">Total</th>
                        <th class="text-center bg-working">20%</th>
                        <th class="text-center bg-working">40%</th>
                        <th class="text-center bg-working">60%</th>
                        <th class="text-center bg-working">80%</th>
                        <th class="text-center bg-working">100%</th>
                        <th class="text-center bg-working">Aided Total</th>
                        <th class="text-center bg-working">Non-Aided</th>
                        <th class="text-center bg-working">Total</th>
                        <th class="text-center bg-vacancy">20%</th>
                        <th class="text-center bg-vacancy">40%</th>
                        <th class="text-center bg-vacancy">60%</th>
                        <th class="text-center bg-vacancy">80%</th>
                        <th class="text-center bg-vacancy">100%</th>
                        <th class="text-center bg-vacancy">Aided Total</th>
                        <th class="text-center bg-vacancy">Non-Aided</th>
                        <th class="text-center bg-vacancy">Total</th>
                      </tr>
                    </thead>
                    <tbody>

                    <?php
                      $t_p20 = $t_p40 = $t_p60 = $t_p80 = $t_p100 = $t_p0 = $t_sanctionedAded = $t_sanctionedAll= 0;
                      $t_w20 = $t_w40 = $t_w60 = $t_w80 = $t_w100 = $t_w0 = $t_workingAded = $t_workingAll= 0;
                      $t_v20 = $t_v40 = $t_v60 = $t_v80 = $t_v100 = $t_v0 = $t_vacantAded = $t_vacantAll= 0;
                      foreach($posts as $k => $v){
                       
                        
                        foreach($v as $k1 => $v1){        
                          $p20 = $p40 = $p60 = $p80 = $p100 = $p0 = 0;
                          $w20 = $w40 = $w60 = $w80 = $w100 = $w0 = 0;
                          $v20 = $v40 = $v60 = $v80 = $v100 = $v0 = 0;
                          $post_name = $k1;//$v1['post_name'];                         
                          foreach($v1 as $k2 => $v2){     
                                               
                            if($v2['aid_id'] == 1){                             
                              $p100 += $v2['allow'];
                              $w100 += $v2['work'];
                              $v100 += $p100 - $w100;
                            }
                            if($v2['aid_id'] == 2){
                              $p80 += $v2['allow'];
                              $w80 += $v2['work'];
                              $v80 += $p80 - $w80;
                            }
                            if($v2['aid_id'] == 3){
                              $p60 += $v2['allow'];
                              $w60 += $v2['work'];
                              $v60 += $p60 - $w60;
                            }
                            if($v2['aid_id'] == 4){
                              $p40 += $v2['allow'];
                              $w40 += $v2['work'];
                              $v40 += $p40 - $w40;
                            }
                            if($v2['aid_id'] == 5){
                              $p20 += $v2['allow'];
                              $w20 += $v2['work'];
                              $v20 += $p20 - $w20;
                            }
                            if($v2['aid_id'] == 6){
                              $p0 += $v2['allow'];
                              $w0 += $v2['work'];
                              $v0 += $p0 - $w0;
                            }
                          }
                          $t_p0 += $p0;
                          $t_p20 += $p20;
                          $t_p40 += $p40;
                          $t_p60 += $p60;
                          $t_p80 += $p80;
                          $t_p100 += $p100;
                          $t_w0 += $w0;
                          $t_w20 += $w20;
                          $t_w40 += $w40;
                          $t_w60 += $w60;
                          $t_w80 += $w80;
                          $t_w100 += $w100;
                          $t_v0 += $v0;
                          $t_v20 += $v20;
                          $t_v40 += $v40;
                          $t_v60 += $v60;
                          $t_v80 += $v80;
                          $t_v100 += $v100;
                          $sanctionedAded = $p20 + $p40 + $p60 + $p80 + $p100;
                          $t_sanctionedAded += $sanctionedAded;
                          $sanctionedAll = $sanctionedAded + $p0;
                          $t_sanctionedAll += $sanctionedAll;
                          $workingAded = $w20 + $w40 + $w60 + $w80 + $w100;
                          $t_workingAded += $workingAded;
                          $workingAll = $workingAded + $w0;
                          $t_workingAll += $workingAll;
                          $vacantAded = $v20 + $v40 + $v60 + $v80 + $v100;
                          $t_vacantAded += $vacantAded;
                          $vacantAll = $vacantAded + $v0;
                          $t_vacantAll += $vacantAll;
                            //$k == post type
                          echo '<tr>
                            <td>'.$post_name .'</td>
                            <td class="text-center">'.$p20.'</td>
                            <td class="text-center">'.$p40.'</td>
                            <td class="text-center">'.$p60.'</td>
                            <td class="text-center">'.$p80.'</td>
                            <td class="text-center">'.$p100.'</td>
                            <td class="text-center">'.$sanctionedAded.'</td>
                            <td class="text-center">'.$p0.'</td>
                            <td class="text-center">'.$sanctionedAll.'</td>
                            <td class="text-center">'.$w20.'</td>
                            <td class="text-center">'.$w40.'</td>
                            <td class="text-center">'.$w60.'</td>
                            <td class="text-center">'.$w80.'</td>
                            <td class="text-center">'.$w100.'</td>
                            <td class="text-center">'.$workingAded.'</td>
                            <td class="text-center">'.$w0.'</td>
                            <td class="text-center">'.$workingAll.'</td>
                            <td class="text-center">'.$v20.'</td>
                            <td class="text-center">'.$v40.'</td>
                            <td class="text-center">'.$v60.'</td>
                            <td class="text-center">'.$v80.'</td>
                            <td class="text-center">'.$v100.'</td>
                            <td class="text-center">'.$vacantAded.'</td>
                            <td class="text-center">'.$v0.'</td>
                            <td class="text-center">'.$vacantAll.'</td>
                          </tr>';
                        }
                        

                      }
                      echo '<tr>
                            <td>Total</td>
                            <td class="text-center">'.$t_p20.'</td>
                            <td class="text-center">'.$t_p40.'</td>
                            <td class="text-center">'.$t_p60.'</td>
                            <td class="text-center">'.$t_p80.'</td>
                            <td class="text-center">'.$t_p100.'</td>
                            <td class="text-center">'.$t_sanctionedAded.'</td>
                            <td class="text-center">'.$t_p0.'</td>
                            <td class="text-center">'.$t_sanctionedAll.'</td>
                            <td class="text-center">'.$t_w20.'</td>
                            <td class="text-center">'.$t_w40.'</td>
                            <td class="text-center">'.$t_w60.'</td>
                            <td class="text-center">'.$t_w80.'</td>
                            <td class="text-center">'.$t_w100.'</td>
                            <td class="text-center">'.$t_workingAded.'</td>
                            <td class="text-center">'.$t_w0.'</td>
                            <td class="text-center">'.$t_workingAll.'</td>
                            <td class="text-center">'.$t_v20.'</td>
                            <td class="text-center">'.$t_v40.'</td>
                            <td class="text-center">'.$t_v60.'</td>
                            <td class="text-center">'.$t_v80.'</td>
                            <td class="text-center">'.$t_v100.'</td>
                            <td class="text-center">'.$t_vacantAded.'</td>
                            <td class="text-center">'.$t_v0.'</td>
                            <td class="text-center">'.$t_vacantAll.'</td>
                          </tr>';
                    ?>

                      

                      

                    </tbody>
                  </table>
                </div>

            
            </div>
         
      

   
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




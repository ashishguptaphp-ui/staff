
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
            padding: 10px;
       

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
   .data-sync-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, #93989f, #4903ba);
    color: #ffffff;
    border: none;
    padding: 10px 18px;
    font-size: 12px;
    font-weight: 600;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    }

    .data-sync-btn i {
        font-size: 12px;
    }

    .data-sync-btn:hover {
        background: linear-gradient(135deg, #0044cc, #002a80);
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }

    .data-sync-btn:active {
        transform: scale(0.98);
    }
</style>


<div class="school-card">
   

    <table>
        <thead>
            <tr>
                <th rowspan="2">UDISE Code</th>
                <th rowspan="2">School Name</th>
                <th colspan="5" style="text-align:center;">Data Sync</th>
            </tr>
            <tr>
               
                <!--<th>Sanch Manyata</th>-->
                
                <th>Sanction Posts</th>                
                <th>Working Unaided Posts</th>
                <th>Working Aided Posts</th>
               
                <!--<th>UDISE+</th>
                <th>Shala</th>-->
            </tr>
        </thead>
        <tbody>
           
            <?php 
                foreach ($schools as $s){
                 

                  $btnSanch = '<button class="data-sync-btn" data-udise="'.$s->udise_code.'" data-mode="sanch" data-id="sanch_'.$s->udise_code.'" onclick="startSync(this)">'.
                                    '<i class="fa-solid fa-arrows-rotate"></i>'.
                                    '<span>SyncNow</span>'.
                                '</button>';


                  $btnSanction = '<button class="data-sync-btn" data-udise="'.$s->udise_code.'" data-mode="sanction" data-id="sanction_'.$s->udise_code.'" onclick="startSync(this)">'.
                                    '<i class="fa-solid fa-arrows-rotate"></i>'.
                                    '<span>SyncNow</span>'.
                                '</button>';

                 $btnWorking = '<button class="data-sync-btn" data-udise="'.$s->udise_code.'" data-mode="working" data-id="working_'.$s->udise_code.'" onclick="startSync(this)">'.
                                    '<i class="fa-solid fa-arrows-rotate"></i>'.
                                    '<span>SyncNow</span>'.
                                '</button>';

                $btnWorking27 = '<button class="data-sync-btn" style="background:#7a15ed" data-udise="'.$s->udise_code.'" data-mode="working27" data-id="working_27_'.$s->udise_code.'" onclick="startSync(this)">'.
                                    '<i class="fa-solid fa-arrows-rotate"></i>'.
                                    '<span>Sync 2026-27</span>'.
                                '</button>';


                  $btnShalarth = '<button class="data-sync-btn" data-udise="'.$s->udise_code.'" data-mode="shalarth" data-id="shalarth_'.$s->udise_code.'" onclick="startSync(this)">'.
                                  '<i class="fa-solid fa-arrows-rotate"></i>'.
                                  '<span>SyncNow</span>'.
                              '</button>';

                  $btnUDISE = '<button class="data-sync-btn" data-udise="'.$s->udise_code.'" data-mode="udise" data-id="udise_'.$s->udise_code.'" onclick="startSync(this)">'.
                                    '<i class="fa-solid fa-arrows-rotate"></i>'.
                                    '<span>SyncNow</span>'.
                                '</button>';


                  $btnShala = '<button class="data-sync-btn" data-udise="'.$s->udise_code.'" data-mode="shala" data-id="shala_'.$s->udise_code.'" onclick="startSync(this)">'.
                                  '<i class="fa-solid fa-arrows-rotate"></i>'.
                                  '<span>SyncNow</span>'.
                              '</button>';


                  echo '<tr>
                                <td>'.$s->udise_code.'</td>
                                <td>'.$s->school_name.'</td>
                                <!--<td>'.$btnSanch .'</td>-->
                                <td>'.$btnSanction .'</td>
                                <td>'.$btnWorking .'&nbsp;&nbsp;&nbsp;'.$btnWorking27.'</td>
                                <td>'.$btnShalarth .'</td>
                                <!--<td>'.$btnUDISE .'</td>
                                <td>'.$btnShala .'</td>-->
                            </tr>';
                }
            ?>

           
        </tbody>
    </table>
</div>
   
  <script>
        $(document).ready(function() {
          
          startSync = function (element) {            
            mode = element.getAttribute('data-mode');
            
            
            if(mode=='sanction'){
              updateSanction(element.getAttribute('data-udise'),element)
              element.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Syncing...';
            }else if(mode=='working27'){
              updateWorking('2026-27',element.getAttribute('data-udise'),element)
              element.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Syncing...';
            }else if(mode=='working'){
              updateWorking('2025-26',element.getAttribute('data-udise'),element)
              element.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Syncing...';
            }else if(mode=='sanch'){
              updateSanchManyta(element.getAttribute('data-udise'),element)
              element.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Syncing...';
            }else if(mode=='shalarth'){
              updateShalarth(element.getAttribute('data-udise'),element)
              element.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Syncing...';
            }
          }

          updateShalarth = function(udiseID,element)
          {
              let payload = {};
              
              payload['school_id'] = udiseID;
              payload['_Token'] = 'ZGVlcGFraHBhdGlsMzAwODE5ODA=';
              

              //console.log(JSON.stringify(payload, null, 2));           
              $.ajax({
                  url: '<?= $this->Url->build(["controller" => "School", "action" => "updateSchoolShalarthData"]); ?>',
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
                      element.innerHTML = '<i class="fa-solid fa-check-circle text-info"></i> <span class="text-info">Successful.</span>';
                     //alert("Data syn successfully!")
                    
                      
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
                      element.innerHTML = '<i class="fa-solid fa-circle-exclamation text-warning"></i> <span class="text-warning">Error!</span>';
                      $('#responseMessage').html('<span class="text-danger">Error: ' + msg + '</span>');
                      $('#submitBtn').show();
                  }
              }); 
          }

          updateSanction = function(udiseID,element){
              let payload = {};
              
              payload['school_id'] = udiseID;
              payload['_Token'] = 'ZGVlcGFraHBhdGlsMzAwODE5ODA=';
              

              //console.log(JSON.stringify(payload, null, 2));           
              $.ajax({
                  url: '<?= $this->Url->build(["controller" => "School", "action" => "updateSanchSanctionData"]); ?>',
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
                    if(response.response.status=='error'){
                        alert(response.response.message);
                    }
                      element.innerHTML = '<i class="fa-solid fa-check-circle text-info"></i> <span class="text-info">Successful.</span>';
                     //alert("Data syn successfully!")
                    
                      
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
                      element.innerHTML = '<i class="fa-solid fa-circle-exclamation text-warning"></i> <span class="text-warning">Error!</span>';
                      $('#responseMessage').html('<span class="text-danger">Error: ' + msg + '</span>');
                      $('#submitBtn').show();
                  }
              }); 
            }

            updateWorking = function(ac_years,udiseID,element){
              let payload = {};
              
              payload['school_id'] = udiseID;
              payload['ac_years'] = ac_years;
              
              payload['_Token'] = 'ZGVlcGFraHBhdGlsMzAwODE5ODA=';
              

              //console.log(JSON.stringify(payload, null, 2));           
              $.ajax({
                  url: '<?= $this->Url->build(["controller" => "School", "action" => "updateSanchWorkingData"]); ?>',
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
                    if(response.response.status=='error'){
                        alert(response.response.message);
                    }
                      element.innerHTML = '<i class="fa-solid fa-check-circle text-info"></i> <span class="text-info">Successful.</span>';
                     //alert("Data syn successfully!")
                    
                      
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
                      element.innerHTML = '<i class="fa-solid fa-circle-exclamation text-warning"></i> <span class="text-warning">Error!</span>';
                      $('#responseMessage').html('<span class="text-danger">Error: ' + msg + '</span>');
                      $('#submitBtn').show();
                  }
              }); 
            }


            updateSanchManyta = function(udiseID,element){
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
                    if(response.response.status=='error'){
                        alert(response.response.message);
                    }
                      element.innerHTML = '<i class="fa-solid fa-check-circle text-info"></i> <span class="text-info">Successful.</span>';
                     //alert("Data syn successfully!")
                    
                      
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
                      element.innerHTML = '<i class="fa-solid fa-circle-exclamation text-warning"></i> <span class="text-warning">Error!</span>';
                      $('#responseMessage').html('<span class="text-danger">Error: ' + msg + '</span>');
                      $('#submitBtn').show();
                  }
              }); 
            }
        }); 
  </script>
  





<style>

.card{
    background:#ffffff;
    color:#333;
    border-radius:15px;
    padding:10px;
    margin-bottom:10px;
    
    box-shadow:0 10px 25px rgba(0,0,0,0.25);
    transition:0.3s;
    display:table-row;
}

.card:hover{
    transform:translateY(-5px);
}

.section-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.badge{
    padding:6px 14px;
    border-radius:20px;
    font-size:12px;
    font-weight:600;
    color:#fff;
}

.completed{ background:#28a745; }
.notstarted{ background:#dc3545; }
.incomplete{ background:#ac910c; }

.stats{
    display:flex;
    justify-content:space-between;
    margin-top:15px;
    font-size:14px;
}

.progress-container{
    margin-top:10px;
    background:#ff000024;
    border-radius:20px;
    height:10px;
    overflow:hidden;
}

.progress-bar{
    height:10px;
    transition:width 1s ease-in-out;
}

.mandatory-bar{ background:#007bff; }
.optional-bar{ background:#ffc107; }
.label{
    font-weight:600;
    margin-top:10px;
}
</style>

<?php 
$section['Personal']['st'] = 7;
$section['Personal']['hm'] = 7;
$section['address']['st'] = 12;
$section['other']['st'] = 14;
$section['caste']['st'] = 13;
$section['disability']['st'] = 8;
$section['pay']['hm'] = 5;
$section['bank']['st'] = 2;
$section['leave']['hm'] = 4;

//family,Academic,Professional,TET/CTET Details,Rewards   - list
//Service,Disciplinary Action  - list




?>


     
        <div class="row py-4">

          

          <div class="col-md-12">
            <div class="shadow-lg rounded-4" style="border 3px solid #0f9b0f;">
              
              <!-- Header -->
              <div class="card-header text-white rounded-top-4"
                  style="background: linear-gradient(135deg, #0f9b0f, #000000);">
                <h6 class="mb-0">
                  <i class="bi bi-diagram-3-fill me-2"></i>Section-wise Field Update Status
                </h6>
              </div>

              <!-- Body -->
              <div class="card-body">
                   

                  


                <table class="table table-sm table-bordered align-middle mb-0">
                  <thead class="table-light">
                    <tr>
                      <th class="text-center">Section</th>
                      <th class="text-center">Staff-level Fields</th>
                      <th class="text-center">HM-level Fields</th>
                    </tr>
                  </thead>
                  <tbody>

                    <tr class="card">
                      <td>
                        <h6 style="padding:15px 0px 0px 10px;font-weight:800;">1.1. Personal Information</h6>
                      </td>
                      <td class="text-center fw-semibold">
                        <div class="label"><?php echo "7/".$section['Personal']['hm'];?> <span class="badge completed">Completed</span></div>
                        <div class="progress-container">
                            <div class="progress-bar mandatory-bar" style="width:100%"></div>
                        </div>
                      </td>
                      <td class="text-center fw-semibold">
                         <div class="label"><?php echo "3/".$section['Personal']['hm'];?> <span class="badge incomplete">Incomplete</span></div>
                        <div class="progress-container">
                            <div class="progress-bar optional-bar" style="width:40%"></div>
                        </div>

                      </td>
                    </tr>
                    <tr><td colspan="3" style="background:#fff;height:3px;font-size:3px;">&nbsp;</td></tr>
                    <tr class="card">
                      <td>
                        <h6 style="padding:15px 0px 0px 10px;font-weight:800;">1.2. Address Details</h6>
                      </td>
                      <td class="text-center fw-semibold">
                        <div class="label"><?php echo "3/".$section['address']['st'];?> <span class="badge incomplete">Incomplete</span></div>
                        <div class="progress-container">
                            <div class="progress-bar optional-bar" style="width:67%"></div>
                        </div>
                      </td>
                      <td class="text-center fw-semibold">
                          <h2>N/A</h2>

                      </td>
                    </tr>
                    <tr><td colspan="3" style="background:#fff;height:3px;font-size:3px;">&nbsp;</td></tr>
                    <tr class="card">
                      <td>
                        <h6 style="padding:15px 0px 0px 10px;font-weight:800;">1.3. Other Personal Details</h6>
                      </td>
                      <td class="text-center fw-semibold">
                        <div class="label"><?php echo "0/".$section['other']['st'];?> <span class="badge notstarted">Not Started</span></div>
                        <div class="progress-container">
                            <div class="progress-bar mandatory-bar" style="width:0%"></div>
                        </div>
                      </td>
                      <td class="text-center fw-semibold">
                        <h2>N/A</h2>
                      </td>                     
                    </tr>     
                    <tr><td colspan="3" style="background:#fff;height:3px;font-size:3px;">&nbsp;</td></tr>
                    <tr class="card">
                      <td>
                        <h6 style="padding:15px 0px 0px 10px;font-weight:800;">1.4. Family Details</h6>
                      </td>
                      <td class="text-center fw-semibold">
                        <div class="label">List of Family Members <span class="badge notstarted">Not Started</span></div>
                        
                      </td>
                      <td class="text-center fw-semibold">
                        <h2>N/A</h2>
                      </td>                      
                    </tr>               
                               
                    <tr><td colspan="3" style="background:#fff;height:3px;font-size:3px;">&nbsp;</td></tr>
 
                     <tr class="card">
                      <td>
                        <h6 style="padding:15px 0px 0px 10px;font-weight:800;">1.2. Caste Details</h6>
                      </td>
                      <td class="text-center fw-semibold">
                        <div class="label"><?php echo "0/".$section['caste']['st'];?> <span class="badge notstarted">Not Started</span></div>
                        <div class="progress-container">
                            <div class="progress-bar mandatory-bar" style="width:0%"></div>
                        </div>
                      </td>
                      <td class="text-center fw-semibold">
                       <h2>N/A</h2>

                      </td>
                      
                    </tr>  
                    <tr><td colspan="3" style="background:#fff;height:3px;font-size:3px;">&nbsp;</td></tr>
                     <tr class="card">
                      <td>
                        <h6 style="padding:15px 0px 0px 10px;font-weight:800;">2.2. Disability Details</h6>
                      </td>
                      <td class="text-center fw-semibold">
                        <div class="label"><?php echo "0/".$section['disability']['st'];?> <span class="badge notstarted">Not Started</span></div>
                        <div class="progress-container">
                            <div class="progress-bar mandatory-bar" style="width:0%"></div>
                        </div>
                      </td>
                      <td class="text-center fw-semibold">
                       <h2>N/A</h2>
                      </td>
                      
                    </tr>               
                    <tr><td colspan="3" style="background:#fff;height:3px;font-size:3px;">&nbsp;</td></tr>
                     <tr class="card">
                      <td>
                        <h6 style="padding:15px 0px 0px 10px;font-weight:800;">3.1. Academic Qualifications</h6>
                      </td>
                      <td class="text-center fw-semibold">
                        <div class="label">List of Academic Qualifications <span class="badge notstarted">Not Started</span></div>
                        
                      </td>
                      <td class="text-center fw-semibold">
                       <h2>N/A</h2>

                      </td>
                      
                    </tr>               
                    <tr><td colspan="3" style="background:#fff;height:3px;font-size:3px;">&nbsp;</td></tr>

                     <tr class="card">
                      <td>
                        <h6 style="padding:15px 0px 0px 10px;font-weight:800;">3.2. Professional Qualifications</h6>
                      </td>
                      <td class="text-center fw-semibold">
                        <div class="label">List of Professional Qualifications <span class="badge notstarted">Not Started</span></div>
                       
                      </td>
                      <td class="text-center fw-semibold">
                        <h2>N/A</h2>
                      </td>
                      
                    </tr>               
                    <tr><td colspan="3" style="background:#fff;height:3px;font-size:3px;">&nbsp;</td></tr>

                     <tr class="card">
                      <td>
                        <h6 style="padding:15px 0px 0px 10px;font-weight:800;">3.3. UDISE Qualification Details</h6>
                      </td>
                      <td class="text-center fw-semibold">
                        <h2>N/A</h2>
                      </td>
                      <td class="text-center fw-semibold">
                        <h2>N/A</h2>
                      </td>
                      
                    </tr>               
                    <tr><td colspan="3" style="background:#fff;height:3px;font-size:3px;">&nbsp;</td></tr>

                     <tr class="card">
                      <td>
                        <h6 style="padding:15px 0px 0px 10px;font-weight:800;">3.4. TET/CTET Details</h6>
                      </td>
                      <td class="text-center fw-semibold">
                        <div class="label">List of TET/CTET Details <span class="badge notstarted">Not Started</span></div>
                        
                      </td>
                      <td class="text-center fw-semibold">
                        <h2>N/A</h2>

                      </td>
                      
                    </tr>           
                     
    
                    <tr><td colspan="3" style="background:#fff;height:3px;font-size:3px;">&nbsp;</td></tr>
 
                     <tr class="card">
                      <td>
                        <h6 style="padding:15px 0px 0px 10px;font-weight:800;">4.1. Teaching Details (UDISE)</h6>
                      </td>
                      <td class="text-center fw-semibold">
                        <h2>N/A</h2>
                      </td>
                      <td class="text-center fw-semibold">
                       <h2>N/A</h2>

                      </td>
                      
                    </tr>               
                    <tr><td colspan="3" style="background:#fff;height:3px;font-size:3px;">&nbsp;</td></tr>
 

                     <tr class="card">
                      <td>
                        <h6 style="padding:15px 0px 0px 10px;font-weight:800;">4.2. Service Details</h6>
                      </td>
                      <td class="text-center fw-semibold">
                        <h2>N/A</h2>
                      </td>
                      <td class="text-center fw-semibold">
                        <div class="label">List of Service Details <span class="badge notstarted">Not Started</span></div>
                      </td>                      
                    </tr>               
                    <tr><td colspan="3" style="background:#fff;height:3px;font-size:3px;">&nbsp;</td></tr>

                     <tr class="card">
                      <td>
                        <h6 style="padding:15px 0px 0px 10px;font-weight:800;">5.1. Pay Details</h6>
                      </td>
                      <td class="text-center fw-semibold">
                       <h2>N/A</h2>
                      </td>
                      <td class="text-center fw-semibold">
                        <div class="label"><?php echo "0/".$section['pay']['hm'];?> <span class="badge notstarted">Not Started</span></div>
                        <div class="progress-container">
                            <div class="progress-bar optional-bar" style="width:0%"></div>
                        </div>

                      </td>
                      
                    </tr>               
                    <tr><td colspan="3" style="background:#fff;height:3px;font-size:3px;">&nbsp;</td></tr>

                     <tr class="card">
                      <td>
                        <h6 style="padding:15px 0px 0px 10px;font-weight:800;">5.2. PF/DCPS/GPF</h6>
                      </td>
                      <td class="text-center fw-semibold">
                        <h2>N/A</h2>
                      </td>
                      <td class="text-center fw-semibold">
                        <h2>N/A</h2>

                      </td>
                      
                    </tr>               
                    <tr><td colspan="3" style="background:#fff;height:3px;font-size:3px;">&nbsp;</td></tr>

                     <tr class="card">
                      <td>
                        <h6 style="padding:15px 0px 0px 10px;font-weight:800;">5.3. Bank Account</h6>
                      </td>
                      <td class="text-center fw-semibold">
                        <div class="label"><?php echo "0/".$section['bank']['st'];?> <span class="badge notstarted">Not Started</span></div>
                        <div class="progress-container">
                            <div class="progress-bar mandatory-bar" style="width:0%"></div>
                        </div>
                      </td>
                      <td class="text-center fw-semibold">
                        <h2>N/A</h2>

                      </td>
                      
                    </tr>               
                    <tr><td colspan="3" style="background:#fff;height:3px;font-size:3px;">&nbsp;</td></tr>
 
                     <tr class="card">
                      <td>
                        <h6 style="padding:15px 0px 0px 10px;font-weight:800;">5.4. Leave Details</h6>
                      </td>
                      <td class="text-center fw-semibold">
                        <h2>N/A</h2>
                      </td>
                      <td class="text-center fw-semibold">
                        <div class="label"><?php echo "0/".$section['leave']['hm'];?> <span class="badge notstarted">Not Started</span></div>
                        <div class="progress-container">
                            <div class="progress-bar optional-bar" style="width:0%"></div>
                        </div>

                      </td>

                    </tr>               
                    <tr><td colspan="3" style="background:#fff;height:3px;font-size:3px;">&nbsp;</td></tr>

                     <tr class="card">
                      <td>
                        <h6 style="padding:15px 0px 0px 10px;font-weight:800;">5.5. Rewards</h6>
                      </td>
                      <td class="text-center fw-semibold">
                        <div class="label">List of Rewards <span class="badge notstarted">Not Started</span></div>
                       
                      </td>
                      <td class="text-center fw-semibold">
                       <h2>N/A</h2>

                      </td>
                      
                    </tr>               
                    <tr><td colspan="3" style="background:#fff;height:3px;font-size:3px;">&nbsp;</td></tr>
                     <tr class="card">
                      <td>
                        <h6 style="padding:15px 0px 0px 10px;font-weight:800;">6.1. Training Details</h6>
                      </td>
                      <td class="text-center fw-semibold">
                        <div class="label">List of Trainings <span class="badge notstarted">Not Started</span></div>
                        
                      </td>
                      <td class="text-center fw-semibold">
                        <h2>N/A</h2>

                      </td>
                      
                    </tr>               
                    <tr><td colspan="3" style="background:#fff;height:3px;font-size:3px;">&nbsp;</td></tr>
                    <tr class="card">
                      <td>
                        <h6 style="padding:15px 0px 0px 10px;font-weight:800;">6.2. Disciplinary Actions</h6>
                      </td>
                      <td class="text-center fw-semibold">
                        <h2>N/A</h2>
                      </td>
                      <td class="text-center fw-semibold">
                        <div class="label">List of Disciplinary Actions <span class="badge notstarted">Not Started</span></div>
                        
                      </td>
                      
                    </tr>               
                    <tr><td colspan="3" style="background:#fff;height:3px;font-size:3px;">&nbsp;</td></tr>
                  </tbody>
                </table>

               

              </div>
            </div>
          </div>

          

        </div>
      
     




<div id="approvedApplicationSlider"
     class="slide-panel"
     aria-hidden="true"
     style="border:3px solid #537895;">

    <!-- Header -->
    <div class="slide-header d-flex justify-content-between align-items-center">
        <div style="width:100%;">
            <h5 class="mb-0">
                <i class="fas fa-arrow-trend-up me-1"></i>
                कर्मचारी निवड
            </h5>
        </div>

        <button style="font-size:27px;"
                class="btn btn-sm btn-outline-danger approvedApplication-close-slider">
            X
        </button>
    </div>

    <!-- Body -->
    <div class="slide-body">

        <div class="container-fluid">

            <!-- Application Information -->
            <div class="card shadow-sm border-0 mb-1">
              

                <div class="card-body">

                    <div class="row g-1">
                        <div class="col-md-9">
                            <div class="form-control bg-light">
                                संस्थेचे नाव &rarr; <b id="approved_sanstha_name"></b>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-control bg-light">
                                अर्ज क्रमांक:- <b>MAHAEDU/STAff/TRF/<span id='approved_year'></span>/<span id='approved_id'></span></b>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-control bg-light">
                                कर्मचाऱ्यांचे नाव &rarr; <b id="approved_staff_name"></b>
                            </div>
                        </div>      

                        <div class="col-md-3">
                            <div class="form-control bg-light">
                                अर्ज दिनांक:- <b id="approved_date"></b>
                            </div>
                        </div>
                        
                        

                    </div>


                    

                </div>
            </div>

            <!-- Approval Section -->
            <div class="card shadow-sm border-0">

                <div class="card-header bg-success text-white">
                    <h6 class="mb-0">
                        <i class="fas fa-check-circle me-2"></i>
                        पुढे करा
                    </h6>
                </div>

                <div class="card-body">

                    <?= $this->Form->create(null, [
                        'id' => 'approvalForm',
                        'type' => 'file',
                        'url' => ['controller' => 'Division', 'action' => 'staffOnboardApprove']
                    ]) ?>
                        <input type="hidden" name="app_id" id="approve_form_id">
                        <input type="hidden" name="action" value="approve">
                        <input type="hidden" name="remark" id="approve_form_remark">                
                       
                        <!-- Remark -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                शेरा / Remark
                            </label>

                            <textarea class="form-control"
                                      name="app_remark"
                                      id="app_remark"
                                      rows="5"
                                      placeholder="कृपया शेरा नमूद करा..."
                                      required></textarea>
                        </div>

                      <div id="workOrderFile"></div>

                        <div id="actionButtons" class="d-flex justify-content-between align-items-center w-100">
                            
                           <button type="button" class="btn btn-success btn-sm" id="workOrderBtn">
                                <i class="fas fa-check-circle me-1"></i>
                                वर्क ऑर्डर तयार करा
                            </button>

                            <button type="submit" class="btn btn-success btn-sm mt-2 d-none" id="approvedBtn" style="margin-left: auto !important;">
                                <i class="fas fa-check-circle me-1"></i>
                                पुढे करा
                            </button>

                        </div>
                    <?php
                        $this->Form->unlockField('action');
                        $this->Form->unlockField('app_doc');
                        $this->Form->unlockField('app_id');
                        $this->Form->unlockField('app_remark');
                        $this->Form->unlockField('remark');
                    ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>

        </div>

    </div>

    <!-- Footer -->
    <div class="slide-footer text-end">

        <button class="btn btn-secondary btn-sm approvedApplication-close-slider">
            Close
        </button>

    </div>

</div>

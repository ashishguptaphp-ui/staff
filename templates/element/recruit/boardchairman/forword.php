
<!-- Slide Panel -->
<div id="forwardApplicationSlider"
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
                class="btn btn-sm btn-outline-danger forwardApplication-close-slider">
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
                                संस्थेचे नाव &rarr; <b id="app_sanstha_name"></b>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-control bg-light">
                                अर्ज क्रमांक:- <b>MAHAEDU/STAff/TRF/<span id='app_year'></span>/<span id='app_id'></span></b>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-control bg-light">
                                कर्मचाऱ्यांचे नाव &rarr; <b id="app_staff_name"></b>
                            </div>
                        </div>      

                        <div class="col-md-3">
                            <div class="form-control bg-light">
                                अर्ज दिनांक:- <b id="app_date"></b>
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

                    <form id="forwardForm" enctype="multipart/form-data">

                       
                        <!-- Remark -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                शेरा / Remark
                            </label>

                            <textarea class="form-control"
                                      name="forword_remark"
                                      id="forword_remark"
                                      rows="5"
                                      placeholder="कृपया शेरा नमूद करा..."
                                      required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fas fa-check-circle me-1"></i>
                            पुढे करा
                        </button>
                    </form>

                </div>
            </div>

        </div>

    </div>

    <!-- Footer -->
    <div class="slide-footer text-end">

        <button class="btn btn-secondary btn-sm forwardApplication-close-slider">
            Close
        </button>

    </div>

</div>

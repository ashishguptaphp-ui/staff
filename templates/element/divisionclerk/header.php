
<header class="bg-primary text-white shadow-sm fixed-top" style="border: 3px solid #537895;">
  <div class="container-fluid d-flex justify-content-between align-items-center py-2 px-3">
    <div class="d-flex align-items-center">
      <button class="btn btn-link text-white me-2 d-lg-none" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
      </button>
      <img src="https://edustaff.maharashtra.gov.in/images/logo.png" alt="Maha Logo" height="50" class="me-2">
      <img src="https://edustaff.maharashtra.gov.in/images/right_edu.png" alt="RTE Logo" height="50" class="me-2">
      <img src="https://edustaff.maharashtra.gov.in/images/emb.png" alt="Emblem" height="50" class="me-3">
      <div class="brand-title d-none d-md-block">
        <p>School Education and Sports Department</p>
        <p>Government of Maharashtra</p>
      </div>
    </div>
      <div>

  
        <span class="text-light me-2" style="font-size:13px;padding-bottom:5px;float:right;">
           Welcome, <strong><?= h($division["role_name"]) ?>, <?= h($division["name"]) ?></strong> [<strong><?= h($user["username"]) ?></strong>]
        </span>
            
          
      </div>
  </div>

  
  
</header>
<!-- ✅ NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="mainNavbar">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="width:99%;">
        
        <li class="nav-item">
            <a class="nav-link active" href="<?= $this->Url->build(["controller" => "DivisionClerk", "action" => "dashboard"]); ?>">
                <i class="fas fa-chart-line me-1"></i> माहिती फलक (Dashboard)
            </a>
        </li>

         <li class="nav-item">
            <a class="nav-link active" href="<?= $this->Url->build(["controller" => "DivisionClerk", "action" => "ng2g-transfer"]); ?>">
                <i class="fas fa-graduation-cap me-2"></i> विनाअनुदानित/अंशतः अनुदानित ते अनुदानित अर्ज (NG to G Approval Applications)
            </a>
        </li>
        
       
        
        <li class="nav-item ms-auto"> <a class="nav-link text-warning" href="<?= $this->Url->build(["controller" => "users", "action" => "logout"]); ?>">
                <i class="fas fa-sign-out-alt me-1"></i> बाहेर पडा (Logout)
            </a>
        </li>
        
    </ul>
</div>
      <!--
      <div class="collapse navbar-collapse" id="mainNavbar">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="width:99%;">
          <li class="nav-item">
            <a class="nav-link active" href="<?= $this->Url->build(["controller" => "division", "action" => "dashboard"]); ?>"><i class="fas fa-chart-line me-1"></i> Dashboard</a>
          </li>
          
          
          <li class="nav-item">
            <a class="nav-link" href="<?= $this->Url->build(["controller" => "division", "action" => "pending-individual-approval"]); ?>">🚀 Pending Individual Approval</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= $this->Url->build(["controller" => "division", "action" => "ng2g-transfer"]); ?>"><i class="fas fa-users me-1"></i> Pending NG to G Transfers</a>
          </li>
          
         
          <li class="nav-item">            
            <a class="nav-link text-warning" href="<?= $this->Url->build(["controller" => "users", "action" => "logout"]); ?>">
                <i class="fas fa-sign-out-alt me-1"></i> Logout
            </a>
         </li>         
        </ul>
      </div>-->
    </div>
  </nav>

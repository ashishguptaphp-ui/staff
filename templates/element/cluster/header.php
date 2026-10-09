
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
    <!--<div class="d-flex align-items-center">
      <div class="text-end lh-sm me-4 d-none d-lg-block">
        <small>
          <strong><?= h($school->school_name); ?></strong> <br>
          <?= h($school->sch_category); ?> <br>
          👩‍🏫 Teaching: 3 &nbsp;&nbsp;|&nbsp;&nbsp; 🧑‍💼 Non-Teaching: 13

        </small>
      </div>
      <div class="text-end lh-sm me-4 d-none d-lg-block">
        <small>
          <strong>UDISE+:</strong> <br>
          <strong>DICE:</strong> <?= h($school->dice_code); ?><br>
          <strong>DDO:</strong> <?= h($school->ddo_code); ?>
        </small>
      </div>

     
      <div class="dropdown">
        <button class="btn btn-warning dropdown-toggle d-flex align-items-center" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
          <div class="d-none d-md-block text-start lh-sm">
            <strong class11="text-white-50"><?= h($this->request->getSession()->read('Auth.User.full_name') ?? 'Mahesh Parabhawale') ?></strong><br>
            <span class1="small text-white-50"><?= h($this->request->getSession()->read('Auth.User.role') ?? 'Head Master') ?></span>
          </div>
        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userMenu">
          <li><a class="dropdown-item" href="/profile">Profile</a></li>
          <li><a class="dropdown-item" href="/settings">Settings</a></li>
          <li><a class="dropdown-item" href="/school-profile">School Profile</a></li>
          
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item text-danger" href="/logout">Logout</a></li>
        </ul>
      </div>
    </div>-->
      <div>

  
        <span class="text-light me-2" style="padding-bottom:5px;float:right;">
           Welcome, <strong><?= h($user["full_name"]) ?></strong> [ClusterCode - <strong><?= h($user["username"]) ?></strong>]
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
            <a class="nav-link active" href="<?= $this->Url->build(["controller" => "cluster", "action" => "dashboard"]); ?>"><i class="fas fa-chart-line me-1"></i> Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= $this->Url->build(["controller" => "cluster", "action" => "schools"]); ?>"><i class="fas fa-school me-1"></i> School Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= $this->Url->build(["controller" => "cluster", "action" => "staffs"]); ?>"><i class="fas fa-users me-1"></i> Staff Information</a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="<?= $this->Url->build(["controller" => "cluster", "action" => "ngtogTransfer"]); ?>"><i class="fas fa-arrow-trend-up me-1"></i> NG → G Transfer</a>
          </li>
          <li class="nav-item">            
            <a class="nav-link text-warning" href="<?= $this->Url->build(["controller" => "users", "action" => "logout"]); ?>">
                <i class="fas fa-sign-out-alt me-1"></i> Logout
            </a>
         </li>         
        </ul>
      </div>
    </div>
  </nav>

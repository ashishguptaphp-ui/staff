
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
           Welcome, <strong><?= h($user["full_name"]) ?></strong> [<strong><?= h($user["username"]) ?></strong>]
        </span>
            
          
      </div>
  </div>

  
<?php
$currentController = $this->getRequest()->getParam('controller');
$currentAction = $this->getRequest()->getParam('action');
$currentPrefix = $this->getRequest()->getParam('prefix');

function isActiveMenu($controller, $action, $currentController, $currentAction, $currentPrefix = null)
{
    return (
        $currentPrefix === 'Recruit' &&
        $currentController === $controller &&
        $currentAction === $action
    ) ? 'active' : '';
}
?>

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
            <a class="nav-link <?= isActiveMenu("deputydirector", "dashboard", $currentController, $currentAction, $currentPrefix) ?>"
             href="<?= $this->Url->build(['prefix' => 'Recruit',"controller" => "deputydirector", "action" => "dashboard"]); ?>">
            <i class="fas fa-chart-line me-1"></i> माहिती फलक (Dashboard)</a>
          </li>

        <li class="nav-item">
            <a class="nav-link <?= isActiveMenu(
            'deputydirector',
            'advertisementList',
            $currentController,
            $currentAction,
            $currentPrefix
           ) ?>" href="<?= $this->Url->build(['prefix' => 'Recruit',"controller" => "deputydirector", "action" => "AdvertisementList"]); ?>"><i class="fas fa-chart-line me-1"></i> Advertisement List</a>
          </li>
          <!--li class="nav-item">
            <a class="nav-link" href="<?php // $this->Url->build(['prefix' => 'Recruit',"controller" => "DistrictClerk", "action" => "ng2gtransfer"]); ?>">📊 Ng2G Transfer Applications</a>
          </li-->

         <li class="nav-item">
            <a class="nav-link <?= isActiveMenu(
                  'deputydirector',
                  'staffSeniorityList',
                  $currentController,
                  $currentAction,
                  $currentPrefix
              ) ?>" href="<?= $this->Url->build(['prefix' => 'Recruit',"controller" => "deputydirector", "action" => "staffSeniorityList"]); ?>"><i class="fas fa-users me-1"></i> Post Vacancies</a>
          </li>
        
       
        <li class="nav-item ms-auto"> <a class="nav-link text-warning" href="<?= $this->Url->build(["controller" => "Recruit", "action" => "logout"]); ?>">
                <i class="fas fa-sign-out-alt me-1"></i> बाहेर पडा (Logout)
            </a>
        </li>
        
    </ul>
</div>
     
    </div>
  </nav>

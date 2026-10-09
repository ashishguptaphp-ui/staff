<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Maharashtra Staff Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<!-- Flatpickr Theme (Bootstrap) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css">

<!-- FontAwesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      margin: 0;
      padding-top: 100px;
      font-family: 'Segoe UI', sans-serif;
      background-color: #e9f1f9;
    }
    .card-box {
      background: #ffffff;
      border: 1px solid #dee2e6;
      border-radius: 8px;
      padding: 16px;
      height: 100%;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    .card-box h6 {
      font-size: 16px;
      font-weight: 600;
      margin-bottom: 12px;
    }
    .card-box canvas {
      max-height: 250px;
      width: 100% !important;
    }
    .teacher-card {
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 15px;
      margin-bottom: 10px;
      transition: background 0.3s;
    }
    .teacher-card:hover {
      background: #f5f9ff;
    }
    .teacher-avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 10px;
    }
    .badge-aided {
      background-color: #198754;
    }
    .badge-self {
      background-color: #6c757d;
    }
    .status-icon {
      width: 10px;
      height: 10px;
      border-radius: 50%;
      display: inline-block;
      margin-left: 5px;
    }
    .status-available {
      background-color: #28a745;
    }
    .status-missing {
      background-color: #dc3545;
    }
    .school-sticky {
      position: fixed;
      top: 20px;
      right: 20px;
      z-index: 9999;
      background-color: #007bff;
      color: white;
      padding: 15px 20px;
      border-radius: 10px;
      width: 260px;
      font-family: 'Segoe UI', sans-serif;
      animation: bounceInDown 1s ease;
    }
    .school-id {
      font-size: 0.85rem;
    }
    .school-name {
      font-size: 1.1rem;
      margin: 5px 0;
    }
    .school-loc {
      font-size: 0.75rem;
    }
    @keyframes bounceInDown {
      0% { opacity: 0; transform: translateY(-50px); }
      60% { opacity: 1; transform: translateY(10px); }
      100% { transform: translateY(0); }
    }
    .bg-gradient-primary { background: linear-gradient(45deg, #007bff, #b32a00ff); }
    .bg-gradient-success { background: linear-gradient(45deg, #28a745, #1e7e34); }
    .bg-gradient-warning { background: linear-gradient(45deg, #ffc107, #e0a800); }
    .bg-gradient-info { background: linear-gradient(45deg, #17a2b8, #117a8b); }
    .bg-gradient-danger { background: linear-gradient(45deg, #dc3545, #bd2130); }
    .bg-gradient-secondary { background: linear-gradient(45deg, #6c757d, #343a40); }
    .bg-purple { background-color: #6f42c1; }
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
    :root { --bg:#fff; --ink:#1f2937; --muted:#6b7280; --brand:#2563eb; --line:#e5e7eb; --ok:#16a34a; --warn:#dc2626; }
    body{font-family:system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,Helvetica,Arial,sans-serif;margin:0;background:#ffffff;color:var(--ink)}
    .wrap{max-width:1000px;margin:32px auto;padding:0 16px}
    .card{background:var(--bg);border:1px solid var(--line);border-radius:14px;box-shadow:0 6px 18px rgba(0,0,0,.05)}
    .header{display:flex;justify-content:space-between;align-items:center;padding:18px 20px;border-bottom:1px solid var(--line)}
    
    .header h1{font-size:18px;margin:0}
    .tabs{display:flex;gap:8px;padding:8px;border-bottom:1px solid var(--line);overflow:auto}
    .tabbtn{border:0;background:transparent;padding:10px 14px;border-radius:10px;cursor:pointer;color:var(--muted)}
    .tabbtn[aria-selected="true"]{background:#eff6ff;color:var(--brand);font-weight:600}
    .tabpanel{display:none;padding:20px}
    .tabpanel.active{display:block}
    .grid{display:grid;grid-template-columns:repeat(12,1fr);gap:16px}
    .col-6{grid-column:span 6} .col-12{grid-column:span 12}
    label{display:block;font-size:12px;color:var(--muted);margin-bottom:6px}
    input,select,textarea{width:100%;padding:10px 12px;border:1px solid var(--line);border-radius:10px;font:inherit;background:#fff}
    input[readonly],textarea[readonly],select:disabled{background:#f3f4f6;color:#6b7280}
    .action_row{display:flex;gap:10px;flex-wrap:wrap;min-width: 100px;}
    .btn{border:0;border-radius:10px;padding:9px 14px;font-weight:600;cursor:pointer}
    .btn.edit{background:#e0e7ff;color:#1e3a8a}
    .btn.save{background:var(--ok);color:#fff}
    .btn.cancel{background:#f1f5f9}
    .btn:disabled{opacity:.6;cursor:not-allowed}
    .actions{display:flex;gap:10px;justify-content:flex-end;margin-top:14px}
    .avatar{display:flex;gap:16px;align-items:center}
    .avatar img{width:80px;height:80px;border-radius:50%;object-fit:cover;border:2px solid var(--line)}
    .hint{font-size:12px;color:var(--muted)}
    @media (max-width:800px){ .col-6{grid-column:span 12} }
    .profile-card-horizontal {
      background: #fff;
      transition: all 0.2s ease-in-out;
    }
    .profile-card-horizontal:hover {
      transform: scale(1.01);
      box-shadow: 0 6px 18px rgba(0,0,0,0.1);
    }
    .profile-card-horizontal .avatar {
      flex-shrink: 0;
    }
    .profilecontainer {
      display: flex;
      padding:0px;
      min-height: 100vh;
      font-family: 'Segoe UI', Tahoma, sans-serif;
    }
    .sidebar {
      width: 260px;
      background: linear-gradient(90deg, #13547a, #80d0c7);
      color: #fff;
      padding: 10px 0;
      flex-shrink: 0;
      box-shadow: 2px 0 10px rgba(0,0,0,0.2);
    }
    .menu {
      list-style: none;
      padding: 0;
      margin: 0;
    }
    .menu-item {
      margin-bottom: 8px;
    }
    .menu-btn {
      width: 100%;
      background: none;
      border: none;
      color: #e2e8f0;
      padding: 12px 20px;
      text-align: left;
      font-size: 15px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .menu-btn i {
      margin-right: 10px;
      font-size: 16px;
    }
    .menu-btn:hover {
      background: #a5c9e6ff;
      color: #060606ff;
    }
    .submenu {
      list-style: none;
      padding-left: 20px;
      margin: 0;
      display: none;
    }
    .submenu li a {
      display: block;
      padding: 8px 0;
      font-size: 14px;
      color: #94a3b8;
      text-decoration: none;
    }
    .submenu li a:hover {
      color: #facc15;
    }
    .content {
      flex: 1;
      padding: 0px;
      background: #f8fafc;
    }
    .content-section {
      background: #fff;
      padding: 0px;
      margin-bottom: 0px;
      border-radius: 0px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.08);
    }
    .form-group {
      position: relative;
      padding-bottom:20px;
    }
    .form-group label {
      position: absolute;
      top: -10px;
      left: 12px;
      background: #fff;
      padding: 0 6px;
      font-size: 13px;
      color: #555;
      font-weight: 500;
    }
    .form-group input {
      width: 100%;
      padding: 12px;
      border: 1px solid #999;
      border-radius: 6px;
      font-size: 16px;
      outline: none;
    }
    .address-block {
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 20px;
      margin-bottom: 20px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .address-block h3 {
      margin-top: 0;
      color: #2c3e50;
      font-size: 18px;
      border-bottom: 2px solid #3498db;
      display: inline-block;
      padding-bottom: 5px;
      margin-bottom: 25px;
    }
    .caste-details{
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 20px;
      margin-bottom: 20px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .caste-details h3{
       margin-top: 0;
      color: #2c3e50;
      font-size: 18px;
      border-bottom: 2px solid #3498db;
      display: inline-block;
      padding-bottom: 5px;
      margin-bottom: 25px;
    }
    
    .training{
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 20px;
      margin-bottom: 20px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .Training-details h3{
       margin-top: 0;
      color: #2c3e50;
      font-size: 18px;
      border-bottom: 2px solid #3498db;
      display: inline-block;
      padding-bottom: 5px;
      margin-bottom: 25px;
    }

    .attendance-details h3{
       margin-top: 0;
      color: #2c3e50;
      font-size: 18px;
      border-bottom: 2px solid #3498db;
      display: inline-block;
      padding-bottom: 5px;
      margin-bottom: 25px;
    }
    
    /* New Responsive Header Styles */
    header.fixed-top {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 1030;
      background-color: #537895 !important;
    }
    .navbar.fixed-top + main {
      padding-top: 100px;
    }
    @media (max-width: 991px) {
      .navbar-expand-lg .navbar-collapse {
        background-color: #63bec1;
      }
      .navbar-dark .navbar-nav .nav-link {
        padding-left: 1rem;
      }
      .sidebar {
        position: fixed;
        left: -260px; /* Hide sidebar by default */
        top: 0;
        bottom: 0;
        z-index: 1040;
        transition: left 0.3s ease-in-out;
        box-shadow: 2px 0 10px rgba(0,0,0,0.2);
        padding-top: 80px;
      }
      .sidebar.active {
        left: 0; /* Show sidebar when active */
      }
      .sidebar .close-btn {
        display: block;
        color: white;
        font-size: 24px;
        position: absolute;
        top: 20px;
        right: 20px;
        cursor: pointer;
      }
    }
    .sidebar-toggler {
      border: none;
      background: none;
      color: white;
      font-size: 24px;
      cursor: pointer;
      display: none;
    }
    .sidebar .close-btn {
        display: none;
    }
    @media (max-width: 991px) {
      .sidebar-toggler {
        display: block;
      }
    }
  </style>
    <style>
        body {
            padding-top: 120px; /* offset fixed header+nav */
        }
        .brand-title h2 {
            font-size: 1rem;
            font-weight: 600;
        }
        .brand-title p {
            font-size: 0.8rem;
            margin-bottom: 0;
        }
    </style>
</head>
<body>
<header class="bg-primary text-white shadow-sm fixed-top" style="background: #0d6efd !important;border: 3px solid #ebb103;">
  <div class="container-fluid d-flex justify-content-between align-items-center py-2 px-3">
    <div class="d-flex align-items-center">
      <button class="btn btn-link text-white me-2 d-lg-none" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
      </button>
      <img src="https://edustaff.maharashtra.gov.in/images/logo.png" alt="Maha Logo" height="30" class="me-2">
      <img src="https://edustaff.maharashtra.gov.in/images/right_edu.png" alt="RTE Logo" height="30" class="me-2">
      <img src="https://edustaff.maharashtra.gov.in/images/emb.png" alt="Emblem" height="30" class="me-3">
      <div class="brand-title d-none d-md-block">
        <p>School Education and Sports Department</p>
        <p>Government of Maharashtra</p>
      </div>
    </div>
    <div class="d-flex align-items-center">
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
          <!--<li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="javascript:void(0)" onclick="toggleLanguage()">मराठी / English</a></li>-->
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item text-danger" href="/logout">Logout</a></li>
        </ul>
      </div>
    </div>
  </div>

  <!-- ✅ NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary mt-2">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="mainNavbar">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" href="/headmaster/dashboard"><i class="fas fa-chart-line me-1"></i> Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/school-profile"><i class="fas fa-school me-1"></i> School Profile</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="staffMenu" data-bs-toggle="dropdown"><i class="fas fa-users me-1"></i> Staffs</a>
            <ul class="dropdown-menu" aria-labelledby="staffMenu">
              <li><a class="dropdown-item" href="/headmaster/teaching-staff"><i class="fas fa-user-graduate me-1"></i> Teaching Staff</a></li>
              <li><a class="dropdown-item" href="/headmaster/non-teaching-staff"><i class="fas fa-user-tie me-1"></i> Non-Teaching Staff</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/leaves"><i class="fas fa-calendar-check me-1"></i> Leaves</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="approvalsMenu" data-bs-toggle="dropdown"><i class="fas fa-clipboard-check me-1"></i> Approvals & Reporting</a>
            <ul class="dropdown-menu" aria-labelledby="approvalsMenu">
              <li><a class="dropdown-item" href="/forward-verification"><i class="fas fa-share me-1"></i> Forwarding/Verification</a></li>
              <li><a class="dropdown-item" href="/seniority-list"><i class="fas fa-list-ol me-1"></i> Mgmt-wise Seniority List</a></li>
              <li><a class="dropdown-item" href="/sanch-manyata"><i class="fas fa-certificate me-1"></i> Sanction & Recognition</a></li>
              <li><a class="dropdown-item" href="/acr"><i class="fas fa-file-signature me-1"></i> Annual Confidential Reports</a></li>
              <li><a class="dropdown-item" href="/reports"><i class="fas fa-file-alt me-1"></i> Reports</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link text-danger" href="/logout"><i class="fas fa-sign-out-alt me-1"></i> Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>

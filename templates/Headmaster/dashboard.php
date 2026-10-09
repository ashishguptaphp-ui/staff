
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






  
  <!-- Main Content -->
  <main id="main-content">
    <?= $this->fetch('content')?>
    <div class="container-fluid"><!-- 
      <div class="bg-primary text-white p-3 rounded mb-3">
        <h2 class="text-center">📊 Maharashtra Teacher Abstract Dashboard</h2>
      </div> -->
      

  <div class="container">
    <!-- Bootstrap + Bootstrap Icons -->

<div class="container py-4">
  <div class="row g-4">

    <!-- Total Teachers -->
    <div class="col-md-4">
      <div class="card shadow-gradient border-0 h-100">
        <div class="card-header bg-gradient-primary text-white rounded-top">
          <i class="bi bi-people-fill me-2"></i>Total Teachers
        </div>
        <div class="card-body">
          <p><span class="badge bg-primary me-2">Fully-Aided</span> 24</p>
          <p><span class="badge bg-warning text-dark me-2">Partially-Aided</span> 8</p>
          <p><span class="badge bg-purple text-white me-2">Self-Financed</span> 5</p>
        </div>
      </div>
    </div>

    <!-- Data Completion -->
    <div class="col-md-4">
      <div class="card shadow-gradient border-0 h-100">
        <div class="card-header bg-gradient-success text-white">
          <i class="bi bi-bar-chart-line-fill me-2"></i>Profile Completion
        </div>
        <div class="card-body">
          <div class="progress mb-2" style="height: 20px;">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" style="width: 78%">78%</div>
          </div>
          <small class="text-muted">Updated staff records</small>
        </div>
      </div>
    </div>

    <!-- UDISE & Shalarth -->
    <div class="col-md-4">
      <div class="card shadow-gradient border-0 h-100">
        <div class="card-header bg-gradient-warning text-dark">
          <i class="bi bi-link-45deg me-2"></i>UDISE+ & Shalarth Sync
        </div>
        <div class="card-body">
          <p>✅ UDISE+ Available: <strong>32</strong></p>
          <p>❌ UDISE+ Missing: <strong>5</strong></p>
          <p>✅ Shalarth Available: <strong>30</strong></p>
          <p>❌ Shalarth Missing: <strong>7</strong></p>
        </div>
      </div>
    </div>

    <!-- Non-Teaching -->
    <div class="col-md-4">
      <div class="card shadow-gradient border-0 h-100">
        <div class="card-header bg-gradient-secondary text-white">
          <i class="bi bi-person-badge-fill me-2"></i>Non-Teaching Staff
        </div>
        <div class="card-body">
          <p>Clerks: <strong>3</strong></p>
          <p>Peons: <strong>2</strong></p>
        </div>
      </div>
    </div>

    <!-- Quick Actions -->
    <div class="col-md-4">
      <div class="card shadow-gradient border-0 h-100">
        <div class="card-header bg-gradient-info text-white">
          <i class="bi bi-lightning-charge-fill me-2"></i>Quick Actions
        </div>
        <div class="card-body">
          <button class="btn btn-primary w-100 mb-2"><i class="bi bi-person-plus-fill me-1"></i>Add Teacher</button>
          <button class="btn btn-outline-dark w-100 mb-2"><i class="bi bi-building-fill me-1"></i>View School Profile</button>
          <button class="btn btn-success w-100"><i class="bi bi-graph-up-arrow me-1"></i>Sync Report</button>
        </div>
      </div>
    </div>

    <!-- Notifications -->
    <div class="col-md-4">
      <div class="card shadow-gradient border-0 h-100">
        <div class="card-header bg-gradient-danger text-white">
          <i class="bi bi-bell-fill me-2"></i>Notifications
        </div>
        <div class="card-body">
          <p>🔔 <strong>2</strong> Teachers missing Shalarth ID</p>
          <p>🕒 <strong>5</strong> require profile update</p>
        </div>
      </div>
    </div>

  </div>
</div>
<div style="background: #fff;padding:10px;">
  <h4>Staff Data Update Progress</h4>

  <!-- Filter Tabs -->
  <ul class="nav nav-pills mb-3" id="filterTabs">
    <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#all">All</button></li>
    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#aided">Fully-Aided</button></li>
    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#partially">Partially-Aided</button></li>
    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#self">Self-Financed</button></li>
    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#teaching">Teaching</button></li>
    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#nonteaching">Non-Teaching</button></li>
    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#udise-available">UDISE+</button></li>
    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#shalarth-available">Shalarth</button></li>
  </ul>

  <div class="tab-content">

    <!-- All Teachers -->
    <div class="tab-pane fade show active" id="all">
      <!-- Sample 10 teacher cards -->
      <div class="teacher-card" data-category="aided teaching udise-available shalarth-available">
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-flex align-items-center">
            <img src="https://i.pravatar.cc/40?img=1" class="teacher-avatar" alt="Anjali">
            <div>
              <strong>Mrs. Anjali Deshmukh</strong> <br>
              <small>Assistant Teacher</small>
            </div>
          </div>
          <span class="badge text-white badge-aided">Fully-Aided</span>
        </div>
        <div class="progress mt-2"><div class="progress-bar" style="width: 90%;">90%</div></div>
        <small>UDISE+ <span class="status-icon status-available"></span> | Shalarth <span class="status-icon status-available"></span></small>
      </div>

      <div class="teacher-card" data-category="partially teaching udise-missing shalarth-available">
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-flex align-items-center">
            <img src="https://i.pravatar.cc/40?img=2" class="teacher-avatar" alt="Rajeev">
            <div>
              <strong>Mr. Rajeev Kulkarni</strong> <br>
              <small>Senior Teacher</small>
            </div>
          </div>
          <span class="badge text-dark bg-warning">Partially-Aided</span>
        </div>
        <div class="progress mt-2"><div class="progress-bar bg-warning" style="width: 60%;">60%</div></div>
        <small>UDISE+ <span class="status-icon status-missing"></span> | Shalarth <span class="status-icon status-available"></span></small>
      </div>

      <div class="teacher-card" data-category="self teaching udise-missing shalarth-missing">
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-flex align-items-center">
            <img src="https://i.pravatar.cc/40?img=3" class="teacher-avatar" alt="Sneha">
            <div>
              <strong>Ms. Sneha Patil</strong> <br>
              <small>Contractual Staff</small>
            </div>
          </div>
          <span class="badge text-white badge-self">Self-Financed</span>
        </div>
        <div class="progress mt-2"><div class="progress-bar bg-info" style="width: 30%;">30%</div></div>
        <small>UDISE+ <span class="status-icon status-missing"></span> | Shalarth <span class="status-icon status-missing"></span></small>
      </div>

      <!-- Add 7 more teacher cards below -->
      <div class="teacher-card" data-category="aided nonteaching udise-available shalarth-missing">
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-flex align-items-center">
            <img src="https://i.pravatar.cc/40?img=4" class="teacher-avatar" alt="Priya">
            <div>
              <strong>Mrs. Priya Gokhale</strong> <br>
              <small>Clerk</small>
            </div>
          </div>
          <span class="badge text-white badge-aided">Fully-Aided</span>
        </div>
        <div class="progress mt-2"><div class="progress-bar bg-success" style="width: 75%;">75%</div></div>
        <small>UDISE+ <span class="status-icon status-available"></span> | Shalarth <span class="status-icon status-missing"></span></small>
      </div>

      <div class="teacher-card" data-category="partially teaching udise-available shalarth-available">
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-flex align-items-center">
            <img src="https://i.pravatar.cc/40?img=5" class="teacher-avatar" alt="Amit">
            <div>
              <strong>Mr. Amit Shinde</strong> <br>
              <small>Science Teacher</small>
            </div>
          </div>
          <span class="badge text-dark bg-warning">Partially-Aided</span>
        </div>
        <div class="progress mt-2"><div class="progress-bar bg-warning" style="width: 85%;">85%</div></div>
        <small>UDISE+ <span class="status-icon status-available"></span> | Shalarth <span class="status-icon status-available"></span></small>
      </div>

      <div class="teacher-card" data-category="aided teaching udise-missing shalarth-missing">
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-flex align-items-center">
            <img src="https://i.pravatar.cc/40?img=6" class="teacher-avatar" alt="Sunil">
            <div>
              <strong>Mr. Sunil Pawar</strong> <br>
              <small>Math Teacher</small>
            </div>
          </div>
          <span class="badge text-white badge-aided">Fully-Aided</span>
        </div>
        <div class="progress mt-2"><div class="progress-bar bg-danger" style="width: 20%;">20%</div></div>
        <small>UDISE+ <span class="status-icon status-missing"></span> | Shalarth <span class="status-icon status-missing"></span></small>
      </div>

      <!-- Add more as needed -->
    </div>

    <!-- Other tab panes will show filtered content using JavaScript -->
    <div class="tab-pane fade" id="aided"></div>
    <div class="tab-pane fade" id="partially"></div>
    <div class="tab-pane fade" id="self"></div>
    <div class="tab-pane fade" id="teaching"></div>
    <div class="tab-pane fade" id="nonteaching"></div>
    <div class="tab-pane fade" id="udise-available"></div>
    <div class="tab-pane fade" id="shalarth-available"></div>

  </div>
  </div>

  </div>

    </div>
  </main>

  <script>
    new Chart(document.getElementById('eligibilityChart'), {
      type: 'doughnut',
      data: { labels: ['Eligible', 'Ineligible'], datasets: [{ data: [54000, 18105], backgroundColor: ['#28a745', '#dc3545'] }] },
      options: { responsive: true }
    });

    new Chart(document.getElementById('appointmentChart'), {
      type: 'bar',
      data: { labels: ['Primary', 'Secondary', 'Higher Secondary'], datasets: [{ label: 'Appointments', data: [24000, 18000, 10000], backgroundColor: '#007bff' }] },
      options: { responsive: true }
    });

    new Chart(document.getElementById('managementChart'), {
      type: 'pie',
      data: { labels: ['Govt', 'Private', 'Aided'], datasets: [{ data: [3200, 1500, 730], backgroundColor: ['#ffc107', '#28a745', '#007bff'] }] },
      options: { responsive: true }
    });

    new Chart(document.getElementById('teacherEligibilityChart'), {
      type: 'bar',
      data: { labels: ['TET', 'CTET', 'B.Ed'], datasets: [{ label: 'Count', data: [18000, 22000, 12000], backgroundColor: '#17a2b8' }] },
      options: { responsive: true }
    });

    new Chart(document.getElementById('lineChart'), {
      type: 'line',
      data: { labels: ['Jan', 'Feb', 'Mar', 'Apr'], datasets: [{ label: 'Appointments', data: [3000, 4000, 3500, 5000], fill: false, borderColor: '#6610f2' }] },
      options: { responsive: true }
    });

    new Chart(document.getElementById('disabilityChart'), {
      type: 'doughnut',
      data: { labels: ['Disabled', 'Not Disabled'], datasets: [{ data: [1800, 70305], backgroundColor: ['#6f42c1', '#20c997'] }] },
      options: { responsive: true }
    });
  </script>

  
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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



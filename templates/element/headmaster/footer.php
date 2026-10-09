<footer id="footer" class="bg-black text-light py-3 mt-4 border-top border-secondary">
  <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
    <div class="mb-2 mb-md-0">
      <span class="fw-semibold">&copy; <?= date('Y') ?> School Education and Sports Department</span>
      <span class="text-muted small d-block d-md-inline ms-md-2">Government of Maharashtra</span>
    </div>
    <div class="footer-links d-flex gap-3 small">
      <a href="/" class="text-decoration-none text-light opacity-75 hover-opacity-100">Home</a>
      <a href="/about" class="text-decoration-none text-light opacity-75 hover-opacity-100">About</a>
      <a href="/contact" class="text-decoration-none text-light opacity-75 hover-opacity-100">Contact</a>
      <a href="/privacy" class="text-decoration-none text-light opacity-75 hover-opacity-100">Privacy Policy</a>
    </div>
  </div>
</footer>

<style>
  #footer a:hover {
    opacity: 1 !important;
    color: #fff;
  }
  #footer {
    font-size: 0.9rem;
  }
</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Family Section start-->
<script>
    $(function(){

    // Sample family data
    const familyMembers = [
        {name:'Asha Patil', dob:'1990-04-12', relation:'Mother', covered:'Yes', info:'Diabetic, vegetarian.'},
        {name:'Rohan Patil', dob:'2012-09-05', relation:'Son', covered:'Yes', info:'Plays football.'},
        {name:'Meera Patil', dob:'2015-11-23', relation:'Daughter', covered:'Yes', info:'Allergic to peanuts.'},
        {name:'Vijay Patil', dob:'1985-06-18', relation:'Spouse', covered:'Yes', info:'Works as an engineer.'}
    ];

    // Populate table rows
    const $tbody = $("#familyTable tbody");
    familyMembers.forEach((member, index) => {
        const row = `
        <tr>
            <td>${member.name}</td>
            <td>${member.dob}</td>
            <td>${member.relation}</td>
            <td>${member.covered}</td>
            <td>
            <button class="btn btn-sm btn-primary view-btn" data-index="${index}">
                <i class="fas fa-eye"></i> View
            </button>
            </td>
        </tr>`;
        $tbody.append(row);
    });

    // Handle View button click
    $(document).on("click", ".view-btn", function(){
        const idx = $(this).data("index");
        const m = familyMembers[idx];
        $("#mName").text(m.name);
        $("#mDob").text(m.dob);
        $("#mRelation").text(m.relation);
        $("#mCovered").text(m.covered);
        $("#mInfo").text(m.info);
        const modal = new bootstrap.Modal(document.getElementById('memberModal'));
        modal.show();
    });

    });
</script>
<!-- Family Section end-->

<script>
    // Sidebar toggle functionality
    function toggleSidebar() {
      var sidebar = document.querySelector('.sidebar');
      sidebar.classList.toggle('active');
    }

    function toggleLanguage() {
      var titleEn = document.getElementById("title-en");
      var titleMr = document.getElementById("title-mr");
      var subtitleEn = document.getElementById("subtitle-en");
      var subtitleMr = document.getElementById("subtitle-mr");

      if (titleEn.style.display === "none") {
        titleEn.style.display = "block";
        titleMr.style.display = "none";
        subtitleEn.style.display = "block";
        subtitleMr.style.display = "none";
      } else {
        titleEn.style.display = "none";
        titleMr.style.display = "block";
        subtitleEn.style.display = "none";
        subtitleMr.style.display = "block";
      }
    }
</script>
<script>
    $(document).ready(function () {
      // Sidebar menu
      $('.menu-btn').on('click', function () {
        $(this).siblings('.submenu').slideToggle();
        $(this).find('span').toggleClass('active');
      });

      // Tab navigation
      var sections = [
        "Personal Details", "Address Details", "Other Personal Details", "Family Details", "Nomination Details",
        "Caste Category & Certification", "Disability Details",
        "Academic Qualifications", "Professional Qualifications", "UDISE Qualification Details", "TET/CTET Details",
        "Initial Appointment", "Teaching Details (UDISE)", "Service Tracking", "Attach / Detach", "Superannuation", "Death Cases",
        "Pay Details", "PF/DCPS/GPF", "Bank Account", "Leave Details", "Rewards",
        "Training Attended", "Disciplinary Actions", "Complaints"
      ];
      var modules = [
        "Basic Information", "Caste & Disability", "Qualifications", "Employment Details", "Financial & Benefits", "Training & Compliance"
      ];
      var currentIndex = 0;

      // Update content and breadcrumb
      function updateUI() {
        $(".content-section").removeClass("active").hide();
        $("#content-section-" + currentIndex).addClass("active").show();

        var sectionText = sections[currentIndex];
        $("#breadcrumbTrail li:last-child").text(sectionText);

        if((currentIndex>=0) && (currentIndex<=4)){
          $("#breadcrumbTrail li:eq(-2)").text(modules[0]);
        }else if((currentIndex>=5) && (currentIndex<=6)){
          $("#breadcrumbTrail li:eq(-2)").text(modules[1]);
        }else if((currentIndex>=7) && (currentIndex<=10)){
          $("#breadcrumbTrail li:eq(-2)").text(modules[2]);
        }else if((currentIndex>=11) && (currentIndex<=16)){
          $("#breadcrumbTrail li:eq(-2)").text(modules[3]);
        }else if((currentIndex>=17) && (currentIndex<=21)){
          $("#breadcrumbTrail li:eq(-2)").text(modules[4]);
        }else if((currentIndex>=22) && (currentIndex<=24)){
          $("#breadcrumbTrail li:eq(-2)").text(modules[5]);
        }

        $("#prevBtn").prop("disabled", currentIndex === 0);
        $("#nextBtn").prop("disabled", currentIndex === sections.length - 1);
      }

      $("#prevBtn").on("click", function () {
        if (currentIndex > 0) {
          currentIndex--;
          updateUI();
        }
      });

      $("#nextBtn").on("click", function () {
        if (currentIndex < sections.length - 1) {
          currentIndex++;
          updateUI();
        }
      });

      updateUI();
    });
</script>

</body>
</html>

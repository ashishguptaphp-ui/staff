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

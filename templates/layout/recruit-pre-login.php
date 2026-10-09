<!doctype html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->fetch('title') ?> | Staff Portal</title>

    <!-- Bootstrap CSS -->
    <?= $this->Html->css('https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css') ?>
    <!-- Font Awesome -->
    <?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js', ['block' => true]) ?>
    <!-- Custom Styles -->
    <style>
        body {
        background-color: #f4f6f9;
        font-family: "Segoe UI", sans-serif;
        }
        header {
        background-color:  #ffffff;
        color: #004884;
        padding: 0px 0;
        border-bottom:3px solid #004884;
        }
        header .brand-text {
        font-size: 1rem;
        font-weight: 800;
        }
        .main-container {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        }
        .login-card {
        background-color: white;
        border-radius: 0.5rem;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        }
        .login-left {
        flex: 0 0 40%;
        padding: 2rem;
        background-color: #ffffff;
        }
        .login-right {
        flex: 0 0 60%;
        background: linear-gradient(135deg, #004884 0%, #0071c5 100%);
        color: white;
        padding: 2rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        }
        .login-right h2 {
        font-size: 1.8rem;
        margin-bottom: 1rem;
        }
        .info-cards {
        display: flex;
        gap: 1rem;
        margin-top: 1.5rem;
        flex-wrap: wrap;
        }
        .info-card {
        background-color: rgba(255, 255, 255, 0.15);
        padding: 1rem;
        border-radius: 0.5rem;
        text-align: center;
        flex: 1 1 30%;
        }
        .info-card h4 {
        margin-top: 0.5rem;
        font-size: 1.2rem;
        font-weight: 500;
        }
        @media (max-width: 768px) {
        .login-left, .login-right {
            flex: 0 0 100%;
        }
        .login-right {
            order: -1;
            text-align: center;
        }
        }
        .error{
          padding:10px;
          font-size:18px;
          font-weight:800;
          color:red;
        }
        .hidden{
          display:none;
        }
        
    </style>
    <style>
        .data-source-footer {
          margin-top:20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 20px;
            background-color: #f8f9fa;
            border-top: 1px solid #e9ecef;
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #495057;
        }
        
        .udise-icon {
            width: 20px;
            height: 20px;
            background: linear-gradient(135deg, #1e40af, #3b82f6);
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 10px;
        }
        
        .source-text {
            font-weight: 500;
        }
        
        .ministry-text {
            color: #6c757d;
            font-size: 13px;
        }
    </style>
    

         
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    /* Fixed Slider Aspect Ratio & Object Fit */
    

    .hero-slider .carousel-item img {
      object-fit: cover;
      height: 100%;
      width: 100%;
      filter: brightness(0.85); /* Slightly darken image for text readability */
    }

    /* Custom Styling for Captions */
    .custom-caption {
      background: rgba(0, 0, 0, 0.45);
      backdrop-filter: blur(8px); /* Modern glassmorphism blur effect */
      -webkit-backdrop-filter: blur(8px);
      padding: 1.5rem 2rem;
      border-radius: 12px;
      border: 1px solid rgba(255, 255, 255, 0.15);
      max-width: 650px;
      margin: 0 auto;
    }

    /* Modern Circular Controls */
    .carousel-control-prev,
    .carousel-control-next {
      width: 5%;
    }

    .carousel-control-icon-btn {
      width: 48px;
      height: 48px;
      background-color: rgba(255, 255, 255, 0.2);
      backdrop-filter: blur(4px);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
      font-size: 1.25rem;
      transition: all 0.3s ease;
    }

    .carousel-control-prev:hover .carousel-control-icon-btn,
    .carousel-control-next:hover .carousel-control-icon-btn {
      background-color: #ffffff;
      color: #000;
      transform: scale(1.1);
    }

    /* Custom Pill Indicators */
    .carousel-indicators [data-bs-target] {
      width: 10px;
      height: 10px;
      border-radius: 50%;
      margin: 0 5px;
      transition: all 0.3s ease;
    }

    .carousel-indicators .active {
      width: 28px;
      border-radius: 10px;
      background-color: #ffffff;
    }
  </style>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>

    <style>

        /* Wrapper */
        .user_manuals {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: #f4f7fb;
            padding: 0px;
        }

        /* Header */
        .user_manuals .header {
            text-align: center;
            padding: 10px;
            font-size: 24px;
            font-weight: bold;
            color: #003366;
        }

        /* Container with GRID */
        .user_manuals .container {
            max-width: 1200px;
            margin: auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* ✅ 3 cards per row */
            gap: 20px;
        }

        /* Card */
        .user_manuals .card {
            background: white;
            border-radius: 12px;
            padding: 18px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: 0.3s;
            cursor: pointer;
        }

        .user_manuals .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.15);
        }

        /* Left */
        .user_manuals .left {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        /* Icon */
        .user_manuals .icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ff9933, #0066cc);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 22px;
            margin-right: 15px;
        }

        /* Text */
        .user_manuals .title {
            font-size: 15px;
            font-weight: 600;
            color: #e1da14;
        }

        .user_manuals .subtitle {
            font-size: 12px;
            color: #666;
        }

        /* Action */
        .user_manuals .action {
           
            color: #dfa00c;
            padding: 8px 14px;
            border-radius: 6px;
            font-size: 13px;
            text-decoration: none;
            align-self: flex-start;
        }

        .user_manuals .action:hover {
            background: #eceff2;
        }

        /* Responsive */
        @media (max-width: 900px) {
            .user_manuals .container {
                grid-template-columns: repeat(2, 1fr); /* 2 per row */
            }
        }

        @media (max-width: 600px) {
            .user_manuals .container {
                grid-template-columns: 1fr; /* 1 per row */
            }
        }

</style>
</head>

<body>

<!-- ========================= HEADER ========================= -->
 <header>
    <div class="container d-flex align-items-center justify-content-between">
      <div class="d-flex align-items-center gap-3">
        <?= $this->Html->image('logo.jpg', [
              'alt' => 'Government Logo',
              'height' => '70',
              'class' => 'me-2'
          ]) ?> 
        <div>
          <div class="brand-text">शालेय शिक्षण व क्रीडा विभाग, महाराष्ट्र शासन</div>
          <small><hr style="padding:0px;margin:5px 0px 5px 0px;" /></small>
          <div class="brand-text">School Education and Sports Department, Government of Maharashtra</div>

          <!--<small>School Education and Sports Department<br>Government of Maharashtra</small>-->
        </div>
      </div>
    </div>
  </header>

<style>

  body{
      font-family:Segoe UI,Roboto,Arial,sans-serif;
  }

  .news-strip{
      position:sticky;
      top:0;
      z-index:9999;
      display:flex;
      align-items:center;
      height:52px;
      overflow:hidden;
      background:linear-gradient(
          135deg,
          #0f172a,
          #1e293b,
          #334155
      );
      color:#ffffff;
      border-radius:0 0 12px 12px;
      box-shadow:0 8px 20px rgba(0,0,0,0.15);
  }

  .news-label{
      min-width:180px;
      height:100%;
      display:flex;
      align-items:center;
      justify-content:center;
      gap:10px;
      font-weight:600;
      letter-spacing:.5px;
      background:rgba(255,255,255,.08);
      backdrop-filter:blur(10px);
  }

  .live-dot{
      width:10px;
      height:10px;
      border-radius:50%;
      background:#22c55e;
      animation:pulse 1.5s infinite;
  }

  @keyframes pulse{
      0%{
          opacity:1;
          transform:scale(1);
      }

      50%{
          opacity:.4;
          transform:scale(1.5);
      }

      100%{
          opacity:1;
          transform:scale(1);
      }
  }

  .ticker-container{
      flex:1;
      overflow:hidden;
      white-space:nowrap;
  }

  .ticker{
      display:inline-block;
      padding-left:100%;
      animation:scroll 35s linear infinite;
  }

  .ticker span{
      margin-right:10px;
      font-size:15px;
  }

  .ticker-container:hover .ticker{
      animation-play-state:paused;
  }

  @keyframes scroll{

      from{
          transform:translateX(0);
      }

      to{
          transform:translateX(-100%);
      }
  }

  .badge{
     margin-right:30px;
      padding:5px 12px;
      border-radius:30px;
      background:#2563eb;
      font-size:12px;
      font-weight:600;
  }

  .date{
      padding-right:20px;
      font-size:13px;
      color:#d1d5db;
  }

</style>

<div class="news-strip">

    <div class="news-label">
        <span class="live-dot"></span>
       महत्त्वाच्या सूचना/अद्यतने
    </div>

    <div class="ticker-container">

        <div class="ticker">
            <span>

                <span class="badge">📢 सूचना </span>

                संस्था पोर्टलमधील शाळांच्या मॅपिंगची माहिती कर्मचारी पोर्टलमध्ये स्वयंचलितपणे अद्ययावत (Auto Sync) करण्यात आली आहे.
            </span>

            <span>

                <span class="badge">📢 नवीन सुविधा उपलब्ध</span>

                "विना-अनुदानित शिक्षक" हा विभाग संस्था मान्यता पोर्टलवर कार्यान्वित करण्यात आला आहे.

                कृपया
                <a style="color:orange;" href="https://education.maharashtra.gov.in/sanch_hsc/users/login/7" target="_blank">
                    उच्च माध्यमिक / कनिष्ठ महाविद्यालय (इयत्ता ११ वी ते १२ वी)
                </a>

                अथवा

                <a style="color:orange;" href="https://education.maharashtra.gov.in/sanch/users/login/7" target="_blank">
                    प्राथमिक व माध्यमिक (इयत्ता १ ली ते १० वी)
                </a>

                या दुव्यावर क्लिक करून विना-अनुदानित शिक्षकांची माहिती नोंदवावी.

            </span>

            <span>

                <span class="badge">महत्त्वाची सूचना</span>

                अर्ज प्रक्रियेसाठी केवळ संस्था लॉगिन (संस्था कोड) वापरावा. शाळा किंवा मुख्याध्यापक लॉगिन (यू-डायस कोड) वापरण्यास अनुमती नाही.

            </span>

            <span>

                <span class="badge">अद्यतन</span>

                बदली विभागामध्ये आवश्यक सुधारणा करण्यात आल्या आहेत.

            </span>

        </div>

    </div>

    <div class="date">
        &nbsp;&nbsp;&nbsp; <?php echo date("d-m-Y"); ?>
    </div>

</div>
<!-- ========================= MAIN CONTENT ========================= -->
<main class1="py-4">
    <div class="container">
        <!-- Main Login/Register Container -->
        <div class="login-card">
          <!-- Left Section - Login/Register -->
          <div class="login-left" style="text-align:center;">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
            <!--div class="user_manuals">

              <div class="header">
              User Manuals & Guides
              </div>

            
                     
               <div class="left">
                 
                  <div>
                      <div class="title"><a href="https://edustaff.maharashtra.gov.in/Education/staff/docs/manuals/UserManualSanstha.pdf" class="action" target="_blank">&rarr; संस्था वापरकर्ता मार्गदर्शक</a></div>
                  </div>
              </div>  
              
              
               
              <div class="left">
                  
                  <div>
                      <div class="title"><a href="https://edustaff.maharashtra.gov.in/Education/staff/docs/manuals/UserManualDistrict.pdf" class="action" target="_blank">&rarr; जिल्हास्तरीय अधिकारी वापरकर्ता मार्गदर्शक</a></div>
                  </div>
              </div>
              
              <div class="left">
                 
                  <div>
                      <div class="title"><a href="https://edustaff.maharashtra.gov.in/Education/staff/docs/manuals/UnaidedWorkingStaffHMEOManual_1-10.pdf" class="action" target="_blank">&rarr; विनाअनुदानित कर्मचारी नोंदणी व मान्यता प्रक्रिया: मुख्याध्यापक व शिक्षणाधिकारी वापरकर्ता मार्गदर्शिका (संच मान्यता - १ ली ते १० वी)</a></div>
                  </div>
              </div>

              <div class="left">
                  
                  <div>
                      <div class="title"><a href="https://edustaff.maharashtra.gov.in/Education/staff/docs/manuals/UnaidedWorkingStaffHMEOManual_11-12.pdf" class="action" target="_blank">&rarr; विनाअनुदानित कर्मचारी नोंदणी व मान्यता प्रक्रिया: मुख्याध्यापक व शिक्षणाधिकारी वापरकर्ता मार्गदर्शिका (संच मान्यता - ११ वी ते १२ वी)</a></div>
                  </div>
              </div>
               
              <div class="left">
                  <div>
                      <div class="title"><a href="https://edustaff.maharashtra.gov.in/Education/staff/docs/manuals/Sansthamapping_manual.pdf" class="action" target="_blank">&rarr; शाळा-संस्था मॅपिंग मार्गदर्शक</a></div>
                  </div>
              </div>
             <div class="left">
                  <div>
                      <div class="title"><a href="https://edustaff.maharashtra.gov.in/Education/staff/docs/manuals/schoolportalHMmobilenumberupdate_manual.pdf" class="action" target="_blank">&rarr; शाळेचा पासवर्ड बदला, मोबाईल क्रमांक अद्ययावत मार्गदर्शक</a></div>
                  </div>
              </div>   
                           
              
              <div class="left">
                  <div>
                      <div class="title"><a href="https://edustaff.maharashtra.gov.in/Education/staff/docs/manuals/ResetpasswordandUpdateSansthaMobileNumber_manual.pdf" class="action" target="_blank">&rarr; संस्था पासवर्ड बदला, मोबाइल क्रमांक अद्ययावत मार्गदर्शक</a></div>
                  </div>
              </div>
             

            </div-->
            <!--img style="width:70%;" src="https://edustaff.maharashtra.gov.in/Education/staff/docs/manuals/comqr.png"-->
          </div>


          <!-- Right Section - Info & Stats -->
          <div class="login-right">
            <h2>Welcome – Sanastha Staff Onboarding System</h2>
            <p>Empowering Education Administration through Digital Transformation.</p>


              <!-- Hero Carousel Container -->
              <div class="container-fluid p-0">
                <div id="heroCarousel" class="carousel slide carousel-fade hero-slider" data-bs-ride="carousel" data-bs-interval="5000">
                  
                  <!-- Indicators / Dots -->
                  <div class="carousel-indicators mb-4">
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                     <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="4" aria-label="Slide 5"></button>
                  </div>

                  <!-- Slides -->
                  <div class="carousel-inner">
                    
                    <!-- Slide 1 -->
                    <div class="carousel-item active">
                       <?= $this->Html->image('login/4.png', [
                              'alt' => 'Government Logo',
                              'height' => '70',
                              'class' => 'me-2'
                          ]) ?>                       
                    </div>

                    <!-- Slide 2 -->
                    <div class="carousel-item">
                       <?= $this->Html->image('login/5.png', [
                              'alt' => 'Government Logo',
                              'height' => '70',
                              'class' => 'me-2'
                          ]) ?>  
                    </div>

                    <!-- Slide 3   -->
                    <div class="carousel-item">
                     <?= $this->Html->image('login/6.png', [
                              'alt' => 'Government Logo',
                              'height' => '70',
                              'class' => 'me-2'
                          ]) ?>  
                    </div>

                     <!-- Slide 4 -->
                    <div class="carousel-item">
                     <?= $this->Html->image('login/7.png', [
                              'alt' => 'Government Logo',
                              'height' => '70',
                              'class' => 'me-2'
                          ]) ?>  
                    </div>

                     <!-- Slide 5 -->
                    <div class="carousel-item">
                     <?= $this->Html->image('login/8.png', [
                              'alt' => 'Government Logo',
                              'height' => '70',
                              'class' => 'me-2'
                          ]) ?>  
                    </div>
                  </div>

                  <!-- Controls (Previous / Next Buttons) -->
                  <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                    <span class="carousel-control-icon-btn">
                      <i class="bi bi-chevron-left"></i>
                    </span>
                    <span class="visually-hidden">Previous</span>
                  </button>

                  <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                    <span class="carousel-control-icon-btn">
                      <i class="bi bi-chevron-right"></i>
                    </span>
                    <span class="visually-hidden">Next</span>
                  </button>

                </div>
              </div>



            
            
          </div>
          
        </div>


    </div>
    
    
</main>

    
<!-- ========================= FOOTER ========================= -->
<footer class="text-light pt-5" style="background-color: #002b5c;">
  <div class="container">
    <div class="row g-4">
      
      <!-- Column 1: Logo & Intro -->
      <div class="col-md-3 col-sm-6">
        <div class="d-flex align-items-center mb-3">
        <?= $this->Html->image('logo.jpg', [
              'alt' => 'Government Logo',
              'height' => '100',
              'class' => 'me-2'
          ]) ?>  
          <h5 class="mb-0">School Education and Sports Department<br>Government of Maharashtra</h5>
        </div>
        <p class="small opacity-75">
          
          Empowering schools with digital innovation and transparency.
        </p>
      </div>

      <!-- Column 2: Quick Links -->
      <div class="col-md-3 col-sm-6">
        <h5 class="fw-semibold mb-3">Quick Links</h5>
        <ul class="list-unstyled">
          <li><a href="#" class="text-light text-decoration-none d-block py-1">Home</a></li>
          <li><a href="#" class="text-light text-decoration-none d-block py-1">About Us</a></li>
          <li><a href="#" class="text-light text-decoration-none d-block py-1">Circulars / GR</a></li>
          <li><a href="#" class="text-light text-decoration-none d-block py-1">Contact</a></li>
          <li><a href="#" class="text-light text-decoration-none d-block py-1">Feedback</a></li>
        </ul>
      </div>

      <!-- Column 3: Resources -->
      <div class="col-md-3 col-sm-6">
        <h5 class="fw-semibold mb-3">Resources</h5>
        <ul class="list-unstyled">
          <li><a href="#" class="text-light text-decoration-none d-block py-1">RTI</a></li>
          <li><a href="#" class="text-light text-decoration-none d-block py-1">Tenders</a></li>
          <li><a href="#" class="text-light text-decoration-none d-block py-1">Downloads</a></li>
          <li><a href="#" class="text-light text-decoration-none d-block py-1">Site Map</a></li>
          <li><a href="#" class="text-light text-decoration-none d-block py-1">Help & FAQs</a></li>
        </ul>
      </div>

      <!-- Column 4: Contact & Social -->
      <div class="col-md-3 col-sm-6">
        <h5 class="fw-semibold mb-3">Contact Us</h5>
        <p class="small mb-2">
          School Education and Sports Department<br>
          Mantralaya, Mumbai – 400032<br>
          Maharashtra, India
        </p>
        <p class="small mb-2"><i class="fa-solid fa-phone me-2"></i> 022-2202XXXX</p>
        <p class="small"><i class="fa-solid fa-envelope me-2"></i> support@maharashtra.gov.in</p>

        <div class="d-flex gap-3 mt-3">
          <a href="#" class="text-light fs-5"><i class="fab fa-facebook"></i></a>
          <a href="#" class="text-light fs-5"><i class="fab fa-twitter"></i></a>
          <a href="#" class="text-light fs-5"><i class="fab fa-youtube"></i></a>
          <a href="#" class="text-light fs-5"><i class="fab fa-instagram"></i></a>
        </div>

        <!--<div class="mt-3">
          <select class="form-select form-select-sm bg-light text-dark">
            <option selected>🌐 English</option>
            <option>मराठी (Marathi)</option>
            <option>हिन्दी (Hindi)</option>
          </select>
        </div>-->
      </div>
    </div>
  </div>

  <!-- Bottom Bar -->
  <div class="border-top border-light mt-4 py-3">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center small">
      <div class="mb-2 mb-md-0">
        © <script>document.write(new Date().getFullYear())</script> School Education and Sports Department, Government of Maharashtra.
      </div>
      <div>
        <a href="#" class="me-3">Privacy Policy</a>
        <a href="#">Terms of Use</a>
      </div>
    </div>
  </div>
</footer>

<!-- ========================= SCRIPTS ========================= -->
<?= $this->Html->script('https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js') ?>
<?= $this->fetch('script') ?>

</body>
</html>

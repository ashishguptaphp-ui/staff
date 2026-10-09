<style>
  .staff-corner {
    background: linear-gradient(135deg, #f8f9fa, #eef3ff);
  }

  .staff-card {
    padding: 20px;
    border-radius: 14px;
    border: none;
    transition: all 0.4s ease;
    box-shadow: 0 6px 16px rgba(0,0,0,0.08);
    height: 100%;
  }

  .staff-card i {
    font-size: 32px;
    margin-bottom: 10px;
  }

  .staff-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 14px 30px rgba(0,0,0,0.15);
  }

  .assistant-card {
    background: linear-gradient(135deg, #003366, #0056b3);
    color: #fff;
  }

  .assistant-card i,
  .assistant-card h6,
  .assistant-card p {
    color: #fff;
    }
  .staff-corner-future {
    background: linear-gradient(135deg, #f6f9ff, #eef3ff);
  }

  .future-card {
    background: #fff;
    padding: 24px;
    border-radius: 16px;
    height: 100%;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    transition: all 0.4s ease;
  }

  .future-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 18px 40px rgba(0,0,0,0.15);
  }

  .future-card .icon {
    font-size: 40px;
    margin-bottom: 12px;
  }

  .future-card h5 {
    font-weight: 700;
    color: #003366;
  }

  .future-card p {
    font-size: 14px;
    color: #555;
  }

  .future-card.voice {
    background: linear-gradient(135deg, #003366, #0056b3);
    color: #fff;
  }

  .future-card.voice h5,
  .future-card.voice p {
    color: #fff;
  }
.stats-panel {
  background: #ffffff;
  padding: 15px;
  border-radius: 16px;
  min-height: 100%;
  box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}

.stats-marquee {
  display: flex;
  flex-direction: column;
  gap: 10px;
  max-height: 100%;
  overflow: hidden;
  animation: scrollStats 25s linear infinite;
}

.stat-card {
  background: linear-gradient(135deg, #f8f9fa, #ffffff);
  padding: 5px 5px;
  border-radius: 14px;
  box-shadow: 0 6px 15px rgba(0,0,0,0.06);
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.stat-card.highlight {
  background: linear-gradient(135deg, #003366, #0056b3);
  color: #ffffff;
}

.stat-number {
  font-size: 20px;
  font-weight: 800;
}

.stat-label {
  font-size: 14px;
  font-weight: 600;
  opacity: 0.85;
}

@keyframes scrollStats {
  0% { transform: translateY(0); }
  100% { transform: translateY(-50%); }
}

/* Pause animation on hover */
.stats-panel:hover .stats-marquee {
  animation-play-state: paused;
}
        .gov-slider {
            max-width: 900px;
            margin: 0px auto;
            position: relative;
            overflow: hidden;
            border-radius: 0px;
            background: #fff;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
       

        .slides {
            position: relative;
        }

        .slide {
            position: absolute;
            inset: 0;
            opacity: 0;
            transition: opacity 0.8s ease-in-out;
        }

        .slide.active {
            opacity: 1;
            position: relative;
        }

        .slide img {
            width: 100%;
            height: auto;
            display: block;
        }

        .caption {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 45, 90, 0.75);
            color: #fff;
            padding: 16px 24px;
        }

        .caption h2 {
            margin: 0;
            font-size: 1.3rem;
        }

        .caption p {
            margin: 4px 0 0;
            font-size: 0.95rem;
        }

        .nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0,0,0,0.45);
            color: #fff;
            border: none;
            padding: 12px 16px;
            cursor: pointer;
            font-size: 20px;
            border-radius: 50%;
        }

        .nav:hover {
            background: rgba(0,0,0,0.7);
        }

        .prev { left: 10px; }
        .next { right: 10px; }

        .dots {
            position: absolute;
            bottom: 10px;
            width: 100%;
            text-align: center;
        }

        .dots span {
            height: 10px;
            width: 10px;
            margin: 0 4px;
            background: #bbb;
            display: inline-block;
            border-radius: 50%;
            cursor: pointer;
        }

        .dots span.active {
            background: #1a73e8;
        }
         }

         .double-arrow-box {
            background: #6a188c;
            color: white;
            padding: 10px 60px 10px 20px;
            border-radius: 0px;
            position: relative;
        }
        
        .double-arrow-box::after {
            content: '❯❯';
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            opacity: 0.8;
        }
          /* Custom 7-column grid classes */
        .row-cols-7 > * {
            flex: 0 0 14.2857%;
            max-width: 14.2857%;
        }
        
        /* Responsive variations */
        @media (min-width: 576px) {
            .row-cols-sm-7 > * {
                flex: 0 0 14.2857%;
                max-width: 14.2857%;
            }
        }
        
        @media (min-width: 768px) {
            .row-cols-md-7 > * {
                flex: 0 0 14.2857%;
                max-width: 14.2857%;
            }
        }
        
        @media (min-width: 992px) {
            .row-cols-lg-7 > * {
                flex: 0 0 14.2857%;
                max-width: 14.2857%;
            }
        }
        
        @media (min-width: 1200px) {
            .row-cols-xl-7 > * {
                flex: 0 0 14.2857%;
                max-width: 14.2857%;
            }
        }
        
        @media (min-width: 1400px) {
            .row-cols-xxl-7 > * {
                flex: 0 0 14.2857%;
                max-width: 14.2857%;
            }
        }
</style>
  
     

    
      <div class="row" style="margin:0px;padding1:0px;border-bottom:4px solid #1d3557">

        <!-- Left Column (8) -->
        <div class="col-lg-8 col-md-12" style="margin:0px;padding:0px;">
          <!-- LATEST UPDATES -->
    <div class="latest-updates" style="padding:0px;z-index:777;position: relative;color:#fff;background:#537895 ;">
      
        <div class="row" style="margin:0px;padding:0px;">
           <div class="col-lg-2 col-md-4 double-arrow-box" style="margin:0px;padding:0px;"> 📢 Updates</div>
            <div class="col-lg-10 col-md-8" style="margin:0px;padding:0px;">
              <marquee class="update-marquee" style="color:gold;font-weight:800;">
                Staff data verification for 2025-26 academic year in progress | Circular No. 42/2025 - Service Record Updates | Staff Training schedule released on DIKSHA Portal
              </marquee>
            </div>
          </div>
      
    </div>
          <div class="gov-slider" aria-label="Education Department Announcements">
            <div class="slides">

                <!-- Slide 1 -->
                <div class="slide deeps active">
                    <?= $this->Html->image('sliders/s1.png', ['alt' => 'Welcome to Maharashtra Education Staff Portal']) ?>
                    <div class="caption">
                        <h2>Welcome to Maharashtra Education Staff Portal</h2>
                        <p>Access Services, Updates & Resources</p>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="slide deeps">
                  <?= $this->Html->image('sliders/s2.png', ['alt' => 'Non Granted to Granted Transfers']) ?>
                    
                    <div class="caption">
                        <h2>Non-Granted to Granted Transfers</h2>
                        <p>Facilitating Smooth Transition for Teaching Staff</p>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="slide deeps">
                    <?= $this->Html->image('sliders/s3.png', ['alt' => 'Samayojan Staff Management System']) ?>
                    <div class="caption">
                        <h2>Samayojan</h2>
                        <p>Staff Management & Transfer System</p>
                    </div>
                </div>

                <!-- Slide 4 -->
                <div class="slide deeps">
                    <?= $this->Html->image('sliders/s4.png', ['alt' => 'Digital Services and Support']) ?>
                    
                    <div class="caption">
                        <h2>Digital Services & Support</h2>
                        <p>Empowering Education Staff with Digital Tools</p>
                    </div>
                </div>
                

            </div>

            <!-- Controls -->
            <button class="nav prev" aria-label="Previous Slide">&#10094;</button>
            <button class="nav next" aria-label="Next Slide">&#10095;</button>

            <!-- Dots -->
            <div class="dots"></div>
        </div>
                
        </div>

        <!-- Right Column (4) -->
        <div class="col-lg-4 col-md-12" style="margin:0px;padding:0px;">
          <!-- RIGHT COLUMN STATS PANEL -->
          <div class="stats-panel">

            <div class="stats-marquee">

              <!-- Card 1 -->
              <div class="stat-card">
                <span class="stat-number">12,48,620</span>
                <span class="stat-label">Total Staff</span>
              </div>

              <!-- Card 2 -->
              <div class="stat-card">
                <span class="stat-number">8,92,410</span>
                <span class="stat-label">Teaching Staff</span>
              </div>

              <!-- Card 3 -->
              <div class="stat-card">
                <span class="stat-number">2,14,980</span>
                <span class="stat-label">Non-Teaching Staff</span>
              </div>

              <!-- Card 4 -->
              <div class="stat-card">
                <span class="stat-number">1,45,300</span>
                <span class="stat-label">Aided Institutions</span>
              </div>

              <!-- Card 5 -->
              <div class="stat-card">
                <span class="stat-number">72,840</span>
                <span class="stat-label">Partially Aided</span>
              </div>

              <!-- Card 6 -->
              <div class="stat-card">
                <span class="stat-number">1,22,560</span>
                <span class="stat-label">Self-Financed</span>
              </div>

              <!-- Card 7 -->
              <div class="stat-card highlight">
                <span class="stat-number">284</span>
                <span class="stat-label">Active Schemes</span>
              </div>

              <!-- Card 8 -->
              <div class="stat-card">
                <span class="stat-number">96</span>
                <span class="stat-label">Live Circulars</span>
              </div>

            </div>
          </div>

        </div>

      </div>

  <!-- MINISTERS & OFFICIALS -->
   
  <section class="py-1">
      <div class="row row-cols-7" style="margin:0px;padding:0px;">
      <div class="col card">
        <img src="https://education.maharashtra.gov.in/images/devendra_fadnavis.jpg"  class="rounded-circle mx-auto" style="width:100px;height:100px;object-fit:cover;border:3px solid #003366;">
        <h6 class="mt-2 fw-bold" style="font-size:12px;">
            <span class="small">
            <b>Shri. Devendra Fadnavis </b><br>
            <small>Hon'ble Chief Minister,<br> Maharashtra State</small>
            </span>
        </h6>
      </div>

      <div class="col card">
        <img src="https://education.maharashtra.gov.in/images/Eknath_Shinde.jpg"  class="rounded-circle mx-auto" style="width:100px;height:100px;object-fit:cover;border:3px solid #003366;">
        <h6 class="mt-2 fw-bold" style="font-size:12px;">
            <span class="small">
            <b>Shri. Eknath Shinde </b><br>
            <small>Hon'ble Dy. Chief Minister,<br> Maharashtra State</small>
            </span>
        </h6>
    </div>
    <div class="col card">
        <img src="https://www.pmrda.gov.in/wp-content/uploads/2026/02/Sunetra-Pawar.png"  class="rounded-circle mx-auto" style="width:100px;height:100px;object-fit:cover;border:3px solid #003366;">
        <h6 class="mt-2 fw-bold" style="font-size:12px;">
            <span class="small">
            <b>Smt. Snetra Pawar </b><br>
            <small>Hon'ble Dy. Chief Minister,<br> Maharashtra State</small>
            </span>
        </h6>
    </div>
    <div class="col card">
        <img src="https://education.maharashtra.gov.in/images/SE_Minister_DadaBhuse.jpeg"  class="rounded-circle mx-auto" style="width:100px;height:100px;object-fit:cover;border:3px solid #003366;">
        <h6 class="mt-2 fw-bold" style="font-size:12px;">
            <span class="small">
            <b>Shri. Dadaji Bhuse </b><br>
            <small>Hon'ble Minister, School Education,<br> Maharashtra State</small>
            </span>
        </h6>
    </div>
    <div class="col card">
        <img src="https://education.maharashtra.gov.in/images/SM_PankajBhoyar.jpeg"  class="rounded-circle mx-auto" style="width:100px;height:100px;object-fit:cover;border:3px solid #003366;">
        <h6 class="mt-2 fw-bold" style="font-size:12px;">
            <span class="small">
            <b>Shri. Pankaj Bhoyar </b><br>
            <small>Hon'ble State Minister, School Education, Maharashtra State</small>
            </span>
        </h6>
    </div>
    <div class="col card">
        <img src="https://education.maharashtra.gov.in/images/secretary_edu.jpg"  class="rounded-circle mx-auto" style="width:100px;height:100px;object-fit:cover;border:3px solid #003366;">
        <h6 class="mt-2 fw-bold" style="font-size:12px;">
            <span class="small">
            <b>Shri. Ranjit Singh Deol (I.A.S.) </b><br>
            <small>Hon'ble Principal Secretary (Education), Maharashtra State</small>
            </span>
        </h6>
    </div>
    <div class="col card">
        <img src="https://education.maharashtra.gov.in/images/Commissioner_Sachindra.jpeg"  class="rounded-circle mx-auto" style="width:100px;height:100px;object-fit:cover;border:3px solid #003366;">
        <h6 class="mt-2 fw-bold" style="font-size:12px;">
            <span class="small">
            <b>Shri. Sachindra Pratap Singh (I.A.S.) </b><br>
            <small>Hon'ble Commissioner (Education)<br> Maharashtra State</small>
            </span>
        </h6>
    </div>

   </div>
           
</section>

<style>
  #officialsCarousel .card {
    transition: transform 0.4s ease, box-shadow 0.4s ease;
  }
  #officialsCarousel .card:hover {
    transform: translateY(-6px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
  }
</style>

<script>
// Make Bootstrap carousel move one card at a time
const carousel = document.querySelector('#officialsCarousel');
const carouselInstance = new bootstrap.Carousel(carousel, { interval: 3000 });

carousel.addEventListener('slide.bs.carousel', function (event) {
  const items = carousel.querySelectorAll('.carousel-item');
  const total = items.length;

  // Clone next item into next slide dynamically
  items.forEach((el, idx) => {
    if (idx >= total - 1) return;
    let next = el.nextElementSibling;
    if (!next) next = items[0];
    const clone = next.querySelector('.col-md-4').cloneNode(true);
    el.querySelector('.row').appendChild(clone);
  });
});
</script>

  <!-- STAFF PROFILE HIGHLIGHTS -->
  <section class="py-3 bg-light">
    <div class="container" data-aos="fade-up">
      <h2>Staff Profile Highlights</h2>
      <div class="row g-4">
        <!-- Each box with icon and brief -->
        <div class="col-md-3" data-aos="zoom-in" data-aos-delay="100">
          <div class="feature-box text-center">
            <i class="fa-solid fa-id-card"></i>
            <h6>Personal Details</h6>
            <p>View and edit basic personal info including name, DOB, gender, and initial posting.</p>
          </div>
        </div>

        <div class="col-md-3" data-aos="zoom-in" data-aos-delay="150">
          <div class="feature-box text-center">
            <i class="fa-solid fa-location-dot"></i>
            <h6>Address Details</h6>
            <p>Maintain permanent and current address details with verification.</p>
          </div>
        </div>

        <div class="col-md-3" data-aos="zoom-in" data-aos-delay="200">
          <div class="feature-box text-center">
            <i class="fa-solid fa-user-tag"></i>
            <h6>Other Personal Details</h6>
            <p>Includes domicile, marital status, language proficiency and physical attributes.</p>
          </div>
        </div>

        <div class="col-md-3" data-aos="zoom-in" data-aos-delay="250">
          <div class="feature-box text-center">
            <i class="fa-solid fa-users"></i>
            <h6>Family Details</h6>
            <p>Add family member information and relationships for service records.</p>
          </div>
        </div>

        <div class="col-md-3" data-aos="zoom-in" data-aos-delay="300">
          <div class="feature-box text-center">
            <i class="fa-solid fa-hand-holding-heart"></i>
            <h6>Nomination Details</h6>
            <p>Specify nominees for GPF, pension, and insurance benefits.</p>
          </div>
        </div>

        <div class="col-md-3" data-aos="zoom-in" data-aos-delay="350">
          <div class="feature-box text-center">
            <i class="fa-solid fa-certificate"></i>
            <h6>Caste Category & Certification</h6>
            <p>Upload and manage caste certificates for reservation purposes.</p>
          </div>
        </div>

        <div class="col-md-3" data-aos="zoom-in" data-aos-delay="400">
          <div class="feature-box text-center">
            <i class="fa-solid fa-wheelchair"></i>
            <h6>Disability Details</h6>
            <p>Maintain data for staff with disabilities for support and records.</p>
          </div>
        </div>

        <div class="col-md-3" data-aos="zoom-in" data-aos-delay="450">
          <div class="feature-box text-center">
            <i class="fa-solid fa-graduation-cap"></i>
            <h6>Academic Qualifications</h6>
            <p>Record educational qualifications and degrees held by the staff.</p>
          </div>
        </div>

        <div class="col-md-3" data-aos="zoom-in" data-aos-delay="500">
          <div class="feature-box text-center">
            <i class="fa-solid fa-chalkboard-teacher"></i>
            <h6>Professional Qualifications</h6>
            <p>Track professional training, teacher eligibility, and certifications.</p>
          </div>
        </div>

        <div class="col-md-3" data-aos="zoom-in" data-aos-delay="550">
          <div class="feature-box text-center">
            <i class="fa-solid fa-school"></i>
            <h6>UDISE Qualification Details</h6>
            <p>Integration of qualification data with UDISE+ system.</p>
          </div>
        </div>

        <div class="col-md-3" data-aos="zoom-in" data-aos-delay="600">
          <div class="feature-box text-center">
            <i class="fa-solid fa-file-signature"></i>
            <h6>TET / CTET Details</h6>
            <p>Manage TET / CTET qualification and certificate records.</p>
          </div>
        </div>

        <!--<div class="col-md-3" data-aos="zoom-in" data-aos-delay="650">
          <div class="feature-box text-center">
            <i class="fa-solid fa-briefcase"></i>
            <h6>Initial Appointment</h6>
            <p>Information on initial posting, designation, and joining date.</p>
          </div>
        </div>-->

        <div class="col-md-3" data-aos="zoom-in" data-aos-delay="700">
          <div class="feature-box text-center">
            <i class="fa-solid fa-book-open"></i>
            <h6>Teaching Details (UDISE)</h6>
            <p>Teaching subjects, grade levels, and current UDISE teaching details.</p>
          </div>
        </div>

        <div class="col-md-3" data-aos="zoom-in" data-aos-delay="750">
          <div class="feature-box text-center">
            <i class="fa-solid fa-sync-alt"></i>
            <h6>Service Tracking</h6>
            <p>Comprehensive service history with transfers, promotions, and leaves.</p>
          </div>
        </div>

        <div class="col-md-3" data-aos="zoom-in" data-aos-delay="800">
          <div class="feature-box text-center">
            <i class="fa-solid fa-link"></i>
            <h6>Attach / Detach</h6>
            <p>Monitor temporary postings, deputations, and attachment status.</p>
          </div>
        </div>

        <div class="col-md-3" data-aos="zoom-in" data-aos-delay="850">
          <div class="feature-box text-center">
            <i class="fa-solid fa-hourglass-end"></i>
            <h6>Superannuation</h6>
            <p>Retirement tracking and pension eligibility information.</p>
          </div>
        </div>

        <div class="col-md-3" data-aos="zoom-in" data-aos-delay="900">
          <div class="feature-box text-center">
            <i class="fa-solid fa-cross"></i>
            <h6>Death Cases</h6>
            <p>Support and record management for deceased staff cases.</p>
          </div>
        </div>

        <div class="col-md-3" data-aos="zoom-in" data-aos-delay="950">
          <div class="feature-box text-center">
            <i class="fa-solid fa-money-check-alt"></i>
            <h6>Pay Details</h6>
            <p>Salary structure, pay band, increments, and arrears data.</p>
          </div>
        </div>

        <div class="col-md-3" data-aos="zoom-in" data-aos-delay="1000">
          <div class="feature-box text-center">
            <i class="fa-solid fa-piggy-bank"></i>
            <h6>PF / DCPS / GPF</h6>
            <p>Provident fund and pension-related contribution tracking.</p>
          </div>
        </div>

        <div class="col-md-3" data-aos="zoom-in" data-aos-delay="1050">
          <div class="feature-box text-center">
            <i class="fa-solid fa-building-columns"></i>
            <h6>Bank Account</h6>
            <p>Linked bank details for salary and benefits disbursement.</p>
          </div>
        </div>

        <div class="col-md-3" data-aos="zoom-in" data-aos-delay="1100">
          <div class="feature-box text-center">
            <i class="fa-solid fa-calendar-days"></i>
            <h6>Leave Details</h6>
            <p>Leave balances, applications, and approvals.</p>
          </div>
        </div>

        <div class="col-md-3" data-aos="zoom-in" data-aos-delay="1150">
          <div class="feature-box text-center">
            <i class="fa-solid fa-trophy"></i>
            <h6>Rewards</h6>
            <p>Achievements and awards received during service tenure.</p>
          </div>
        </div>

        <div class="col-md-3" data-aos="zoom-in" data-aos-delay="1200">
          <div class="feature-box text-center">
            <i class="fa-solid fa-person-chalkboard"></i>
            <h6>Training Attended</h6>
            <p>Workshops, refresher courses, and skill enhancement details.</p>
          </div>
        </div>

        <div class="col-md-3" data-aos="zoom-in" data-aos-delay="1250">
          <div class="feature-box text-center">
            <i class="fa-solid fa-balance-scale"></i>
            <h6>Disciplinary Actions</h6>
            <p>Records of disciplinary proceedings and resolutions.</p>
          </div>
        </div>

        <div class="col-md-3" data-aos="zoom-in" data-aos-delay="1300">
          <div class="feature-box text-center">
            <i class="fa-solid fa-comment-dots"></i>
            <h6>Complaints</h6>
            <p>Register and track grievances or complaints efficiently.</p>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- STAFF CORNER -->
<section class="py-3 staff-corner bg-gradient-light">
  <div class="container" data-aos="fade-up">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="fw-bold text-primary">🌟 Staff Corner</h2>
      <span class="badge bg-success px-3 py-3">
        Recognition • Intelligence • Well-being • Innovation
      </span>
    </div>




    <div class="row g-4">

      <!-- Birthday -->
      <div class="col-md-3">
        <div class="card staff-card text-center">
          <i class="fa-solid fa-cake-candles text-warning"></i>
          <h6 class="fw-bold mt-2">Today's Birthdays</h6>
          <p class="small">Celebrating our educators 🎉</p>
          <a href="#" class="small text-primary">View All</a>
        </div>
      </div>

      <!-- Teacher of the Month -->
      <div class="col-md-3">
        <div class="card staff-card text-center">
          <i class="fa-solid fa-chalkboard-user text-success"></i>
          <h6 class="fw-bold mt-2">Teacher of the Month</h6>
          <p class="small">Recognising academic excellence</p>
          <span class="badge bg-success">District Level</span>
        </div>
      </div>

      <!-- School of the Month -->
      <div class="col-md-3">
        <div class="card staff-card text-center">
          <i class="fa-solid fa-school-flag text-primary"></i>
          <h6 class="fw-bold mt-2">School of the Month</h6>
          <p class="small">Outstanding performance & governance</p>
          <span class="badge bg-primary">Data Driven</span>
        </div>
      </div>

      <!-- HM of the Month -->
      <div class="col-md-3">
        <div class="card staff-card text-center">
          <i class="fa-solid fa-user-tie text-danger"></i>
          <h6 class="fw-bold mt-2">HM of the Month</h6>
          <p class="small">Leadership & administration excellence</p>
          <span class="badge bg-danger">Leadership Award</span>
        </div>
      </div>

      <!-- My Impact -->
      <div class="col-md-3">
        <div class="card staff-card text-center">
          <i class="fa-solid fa-chart-line text-info"></i>
          <h6 class="fw-bold mt-2">My Impact</h6>
          <p class="small">Students • Service • Training</p>
          <a href="#" class="small text-info">View Dashboard</a>
        </div>
      </div>

      <!-- Smart Alerts -->
      <div class="col-md-3">
        <div class="card staff-card text-center">
          <i class="fa-solid fa-bell text-warning"></i>
          <h6 class="fw-bold mt-2">Smart Alerts</h6>
          <p class="small">Pending actions & reminders</p>
          <span class="badge bg-warning text-dark">3 New</span>
        </div>
      </div>

      <!-- Innovation Wall -->
      <div class="col-md-3">
        <div class="card staff-card text-center">
          <i class="fa-solid fa-lightbulb text-success"></i>
          <h6 class="fw-bold mt-2">Innovation Wall</h6>
          <p class="small">Grassroot teaching ideas</p>
          <a href="#" class="small text-success">Explore</a>
        </div>
      </div>

      <!-- Ask Assistant -->
      <div class="col-md-3">
        <div class="card staff-card text-center assistant-card">
          <i class="fa-solid fa-microphone-lines"></i>
          <h6 class="fw-bold mt-2">Ask Assistant</h6>
          <p class="small">Voice & text support (Marathi)</p>
          <button class="btn btn-sm btn-primary">
            🎙️ Ask Now
          </button>
        </div>
      </div>

    </div>
  </div>
</section>
<section class="staff-corner-future py-3">
  <div class="container">
    

    <div class="row g-4">

      <!-- Digital Service DNA -->
      <div class="col-md-4">
        <div class="future-card">
          <div class="icon">🧬</div>
          <h5>My Service DNA</h5>
          <p>
            AI-generated profile showing your service journey, skills,
            experience & impact across schools.
          </p>
          <span class="badge bg-primary">AI Profile</span>
        </div>
      </div>

      <!-- Career Simulator -->
      <div class="col-md-4">
        <div class="future-card">
          <div class="icon">🧭</div>
          <h5>Career Path Simulator</h5>
          <p>
            Visualise future roles, promotions, trainings and leadership
            pathways before applying.
          </p>
          <span class="badge bg-success">Predictive</span>
        </div>
      </div>

      <!-- Whisper Voice Assistant -->
      <div class="col-md-4">
        <div class="future-card voice">
          <div class="icon">🎙️</div>
          <h5>Whisper Voice Assistant</h5>
          <p>
            Ask questions in Marathi – salary, GRs, transfers,
            approvals – even on low bandwidth.
          </p>
          <button class="btn btn-sm btn-light mt-2">Speak Now</button>
        </div>
      </div>

      <!-- Cognitive Load Balancer -->
      <div class="col-md-4">
        <div class="future-card">
          <div class="icon">🧠</div>
          <h5>Cognitive Load Balancer</h5>
          <p>
            AI reduces stress by filtering alerts, prioritising tasks
            and sending appreciation nudges.
          </p>
          <span class="badge bg-warning text-dark">Well-Being AI</span>
        </div>
      </div>

      <!-- Digital Twin School -->
      <div class="col-md-4">
        <div class="future-card">
          <div class="icon">🏫</div>
          <h5>School Digital Twin</h5>
          <p>
            See teacher load, subject gaps and infrastructure stress
            before transfers or decisions.
          </p>
          <span class="badge bg-info">Simulation</span>
        </div>
      </div>

      <!-- Policy Playground -->
      <div class="col-md-4">
        <div class="future-card">
          <div class="icon">🎯</div>
          <h5>Policy Impact Playground</h5>
          <p>
            Safely simulate the effect of new rules and policies using
            real department data.
          </p>
          <span class="badge bg-danger">Decision Support</span>
        </div>
      </div>

      <!-- Invisible Excellence -->
      <div class="col-md-4">
        <div class="future-card">
          <div class="icon">🏆</div>
          <h5>Invisible Excellence Recognition</h5>
          <p>
            AI silently identifies consistent performers and rewards
            them fairly without bias.
          </p>
          <span class="badge bg-success">Merit Based</span>
        </div>
      </div>

      <!-- Field Pulse -->
      <div class="col-md-4">
        <div class="future-card">
          <div class="icon">📡</div>
          <h5>Live Field Pulse</h5>
          <p>
            One-tap anonymous feedback from schools enabling early
            problem detection at district & state level.
          </p>
          <span class="badge bg-secondary">Real-Time</span>
        </div>
      </div>

      <!-- Knowledge Legacy -->
      <div class="col-md-4">
        <div class="future-card">
          <div class="icon">📚</div>
          <h5>Knowledge Legacy Vault</h5>
          <p>
            Retiring staff preserve experience, best practices and
            solutions for future generations.
          </p>
          <span class="badge bg-dark">Institutional Memory</span>
        </div>
      </div>

    </div>
  </div>
</section>
<script>

    const slides = document.querySelectorAll(".deeps");
const prev = document.querySelector(".prev");
const next = document.querySelector(".next");
const dotsContainer = document.querySelector(".dots");

let index = 0;
let interval;
slides.forEach((_, i) => {
 
    const dot = document.createElement("span");
    dot.addEventListener("click", () => showSlide(i));
    dotsContainer.appendChild(dot);
});

const dots = document.querySelectorAll(".dots span");

function showSlide(i) {
    slides[index].classList.remove("active");
    dots[index].classList.remove("active");

    index = (i + slides.length) % slides.length;

    slides[index].classList.add("active");
    dots[index].classList.add("active");
}

function nextSlide() {
    showSlide(index + 1);
}

function startAutoPlay() {
    interval = setInterval(nextSlide, 5000);
}

function stopAutoPlay() {
    clearInterval(interval);
}

prev.addEventListener("click", () => showSlide(index - 1));
next.addEventListener("click", () => showSlide(index + 1));

document.querySelector(".gov-slider").addEventListener("mouseenter", stopAutoPlay);
document.querySelector(".gov-slider").addEventListener("mouseleave", startAutoPlay);

showSlide(0);
startAutoPlay();

</script>
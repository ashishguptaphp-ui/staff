<!doctype html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Staff Portal | Education Department Govt of Maharashtra</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <!-- Bootstrap CSS -->
    <?= $this->Html->css('https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css') ?>
    <!-- Font Awesome -->
    <?= $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css') ?>

    <!-- Custom Styles -->
     
    <?= $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css') ?>
    <?= $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css') ?>

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
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
    .navbar {
      background-color: #fff;
    }
    .navbar-brand img {
      height: 50px;
    }
    .navbar-nav .nav-link {
      color: #1d3557 !important;
      font-size:18px;

      font-weight: 500;
    }
    .navbar-nav .nav-link:hover {
      color: #ffd166 !important;
    }

    /* HERO */
    .hero-section {
      position: relative;
    }
    .carousel-item img {
      height: 520px;
      object-fit: cover;
      filter: brightness(0.75);
    }
    .carousel-caption {
      bottom: 20%;
    }
    .latest-updates {
      background: #f1faee;
      border-top: 0px solid #1d3557;
      padding: 15px 0;
    }
    .update-marquee {
      font-weight: 500;
      color: #1d3557;
    }

    section h2 {
      color: #1d3557;
      font-weight: 700;
      text-transform: uppercase;
      border-bottom: 3px solid #457b9d;
      display: inline-block;
      margin-bottom: 25px;
      padding-bottom: 5px;
    }

    /* Ministers */
    .officials-carousel img {
      border-radius: 10px;
      height: 180px;
      object-fit: cover;
    }
    .officials-carousel .card {
      border: none;
      background: #fff;
      text-align: center;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      transition: 0.3s;
    }
    .officials-carousel .card:hover {
      transform: translateY(-4px);
    }

    /* Staff Profile */
    .feature-box {
      background: #fff;
      padding: 25px;
      border-radius: 12px;
      transition: all 0.4s ease;
      box-shadow: 0 3px 8px rgba(0,0,0,0.1);
      height: 100%;
    }
    .feature-box:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 15px rgba(0,0,0,0.15);
    }
    .feature-box i {
      font-size: 2.5rem;
      color: #1d3557;
      margin-bottom: 15px;
    }
    .feature-box p {
      font-size: 0.9rem;
      color: #555;
    }

    footer {
      background-color: #152238;
      color: #d9d9d9;
      padding: 25px 0;
      text-align: center;
    }
  </style>
  <style>
        /* ===== Holographic Login Button ===== */
        .login-btn-holographic {
            position: fixed;
            top: 30px;
            right: 30px;
            z-index: 1000;
            background: rgba(20, 20, 40, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 12px 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            text-decoration: none;
            color: white;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        .login-btn-holographic:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
        }

        .login-btn-holographic:active {
            transform: translateY(1px);
        }

        .holographic-effect {
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255, 255, 255, 0.1),
                transparent
            );
            transition: left 0.7s ease;
        }

        .login-btn-holographic:hover .holographic-effect {
            left: 100%;
        }

        .btn-content {
            display: flex;
            align-items: center;
            gap: 10px;
            position: relative;
            z-index: 2;
        }

        .user-icon {
            font-size: 18px;
            transition: transform 0.5s ease;
        }

        .login-btn-holographic:hover .user-icon {
            transform: rotate(15deg) scale(1.1);
        }

        .btn-text {
            position: relative;
            overflow: hidden;
            height: 20px;
        }

        .text-visible, .text-hidden {
            transition: transform 0.4s ease;
        }

        .text-hidden {
            position: absolute;
            top: 100%;
            left: 0;
            color: #00dbde;
        }

        .login-btn-holographic:hover .text-visible {
            transform: translateY(-100%);
        }

        .login-btn-holographic:hover .text-hidden {
            transform: translateY(-100%);
        }

        /* Particle animation */
        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: #00dbde;
            border-radius: 50%;
            pointer-events: none;
            opacity: 0;
        }

        
  </style>

  <style>
    /* smooth pulse keyframes – gentle scale + shadow */
    @keyframes softPulse {
      0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(13, 110, 253, 0.4); }
      40% { transform: scale(1.04); box-shadow: 0 0 0 8px rgba(13, 110, 253, 0.1); }
      100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(13, 110, 253, 0); }
    }

    .pulse-animation {
      animation: softPulse 0.5s ease-out;
    }

    /* make button width stable – both texts fit without jumping */
    .btn-stable {
      min-width: 270px;        /* comfortably covers both text lengths */
      white-space: nowrap;      /* keep text in one line on desktop */
      transition: background-color 0.15s, border-color 0.15s; /* bootstrap already does, but explicit */
    }

    /* allow wrap on very small screens (optional, keeps button readable) */
    @media (max-width: 380px) {
      .btn-stable {
        white-space: normal;
        min-width: 200px;
      }
    }

    /* extra hover glow (bootstrap already has, but we add a bit) */
    .btn-animated:hover {
      filter: brightness(1.03);
      box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
  </style>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
</head>

<body>

<!-- ========================= HEADER ========================= -->
 
<nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="border-bottom:4px solid #1d3557";>
    <div class="container d-flex align-items-center justify-content-between">
      <div class="d-flex align-items-center gap-2" style="width:100%;">
        <?= $this->Html->image('maha-logo.png', [
              'alt' => 'Government Logo',
              'height' => '70',
              'class' => 'me-2'
          ]) ?> 
         
        <div>
          <div class="brand-text">शालेय शिक्षण व क्रीडा विभाग, महाराष्ट्र शासन</div>
          <small><hr style="padding:0px;margin:3px 0px 3px 0px;" /></small>
          <div class="brand-text">School Education and Sports Department, Government of Maharashtra</div>

          <!--<small>School Education and Sports Department<br>Government of Maharashtra</small>-->
        
        </div>
        <?= $this->Html->image('in-logo.png', [
              'alt' => 'Government Logo',
              'height' => '70',
              'class' => 'me-2'
          ]) ?>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav" style="float:right;">
          <div class="button-container">
            <a href="<?= $this->Url->build(["controller" => "users", "action" => "login"]); ?>" class="login-btn-holographic" id="holographicBtn">
                <div class="holographic-effect"></div>
                <div class="btn-content">
                    <i class="fas fa-user user-icon"></i>
                    <div class="btn-text">
                        <div class="text-visible">Officials Login</div>
                        <div class="text-hidden">Access</div>
                    </div>
                </div>
            </a>

            <!-- MAIN ANIMATED BUTTON (Bootstrap + custom pulse) -->
             <a href="<?= $this->Url->build(["controller" => "users", "action" => "shalarthLogin"]); ?>">
              <button type="button" class="btn btn-primary btn-sm shadow-sm" id="animatedBtn" style="position:fixed;right:270px;">
                <i class="fas fa-users user-icon"></i> Staff/Teacher Access.     <!-- initial text -->
              </button>
            </a>
             
            </div>
          </div>
            <!--<ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="#">About Portal</a></li>
            <li class="nav-item"><a class="nav-link" href="#">About Us</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= $this->Url->build(["controller" => "users", "action" => "login"]); ?>">Login</a></li>
            </ul>-->
        </div>
      </div>
    </div>
</nav>

        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>


<!-- ========================= FOOTER ========================= -->
<footer class="text-light pt-5" style="background-color: #002b5c;">
  <div class="container">
    <div class="row g-4">
      
      <!-- Column 1: Logo & Intro -->
      <div class="col-md-3 col-sm-6">
        <div class="d-flex align-items-center mb-3">
        <?= $this->Html->image('maha-logo.png', [
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
<?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js') ?>



<?= $this->fetch('script') ?>

 <script>
    AOS.init({
      duration: 200,
      once: true
    });
  </script>

  <script>
        // Particle effect for the holographic button
        const holographicBtn = document.getElementById('holographicBtn');
        let particleInterval;
        
        holographicBtn.addEventListener('mouseenter', function() {
            // Create particles on hover
            particleInterval = setInterval(createParticle, 50);
        });
        
        holographicBtn.addEventListener('mouseleave', function() {
            // Stop creating particles
            clearInterval(particleInterval);
        });
        
        function createParticle() {
            const particle = document.createElement('div');
            particle.classList.add('particle');
            
            // Random position around the button
            const btnRect = holographicBtn.getBoundingClientRect();
            const posX = Math.random() * btnRect.width;
            const posY = Math.random() * btnRect.height;
            
            particle.style.left = `${posX}px`;
            particle.style.top = `${posY}px`;
            
            holographicBtn.appendChild(particle);
            
            // Random animation
            const angle = Math.random() * Math.PI * 2;
            const distance = 20 + Math.random() * 30;
            const targetX = Math.cos(angle) * distance;
            const targetY = Math.sin(angle) * distance;
            
            // Animate particle
            const duration = 800 + Math.random() * 400;
            const startTime = Date.now();
            
            function animateParticle() {
                const elapsed = Date.now() - startTime;
                const progress = Math.min(elapsed / duration, 1);
                
                const currentX = targetX * progress;
                const currentY = targetY * progress;
                const currentOpacity = 1 - progress;
                
                particle.style.transform = `translate(${currentX}px, ${currentY}px)`;
                particle.style.opacity = currentOpacity;
                
                if (progress < 1) {
                    requestAnimationFrame(animateParticle);
                } else {
                    particle.remove();
                }
            }
            
            requestAnimationFrame(animateParticle);
        }
        
        // Add click animation
        holographicBtn.addEventListener('click', function(e) {
            // Create ripple effect
            const ripple = document.createElement('div');
            ripple.style.position = 'absolute';
            ripple.style.borderRadius = '50%';
            ripple.style.backgroundColor = 'rgba(0, 219, 222, 0.3)';
            ripple.style.transform = 'translate(-50%, -50%) scale(0)';
            ripple.style.animation = 'ripple 0.6s linear';
            
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            ripple.style.width = `${size}px`;
            ripple.style.height = `${size}px`;
            ripple.style.left = `${e.clientX - rect.left}px`;
            ripple.style.top = `${e.clientY - rect.top}px`;
            
            this.appendChild(ripple);
            
            // Remove ripple after animation
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
        
        // Add CSS for ripple animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: translate(-50%, -50%) scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
        
        // Demo alternative buttons interaction
        document.querySelectorAll('.button-card button').forEach(button => {
            button.addEventListener('click', function() {
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            });
        });
    </script>
    <script>
    (function() {
      // get button and hint span
      const btn = document.getElementById('animatedBtn');
      //const hint = document.getElementById('hintText');

      // two texts to cycle (exactly as requested)
      const texts = [
        'Staff/Teacher Access.',      // first shown
        'Login with Shalarth'         // second shown after some time
      ];

      let currentIndex = 0; // 0 = first text

      // helper to update button text + trigger pulse, and update hint
      function updateButtonText(index) {
        // change button text
        btn.textContent = texts[index];

        // add pulse class (animation)
        btn.classList.add('pulse-animation');

        // remove class after animation ends (0.5s) so it can be re-triggered
        setTimeout(() => {
          btn.classList.remove('pulse-animation');
        }, 500);

        // update tiny hint below: show which one comes next
        const nextIndex = (index + 1) % texts.length;
        //hint.textContent = `next: ${texts[nextIndex]}`;
      }

      // toggle to the other text (index = 1 - currentIndex)
      function switchText() {
        currentIndex = (currentIndex + 1) % texts.length;  // cycles 0→1→0→1...
        updateButtonText(currentIndex);
      }

      // initial hint (after first load, the next will be "Login with Shalarth")
      //hint.textContent = `next: ${texts[1]}`;

      // start the interval: change every 3 seconds (3000 ms)
      setInterval(switchText, 3000);

      // (optional) if you want a one‑time switch only, replace the line above with:
      // setTimeout(() => { switchText(); }, 3000);
      // but we keep the cyclic behaviour as it's more 'animated' and shows both texts repeatedly.
      // You can easily modify by commenting setInterval and uncommenting the line above.
    })();
  </script>

</body>
</html>

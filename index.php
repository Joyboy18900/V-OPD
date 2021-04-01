<?php 

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

?>

<!DOCTYPE html>
<html lang="en">

<?php include_once "include/header.php" ?>

<body>

  <?php 
  
  include_once "layout/navbar.php";
  include_once "layout/headerLogo.php";

  ?>

  <section class="mb-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mb-5">
          <h1 class="display-4">Virtual Outpatient Department</h1>
          <!-- <p class="lead text-secondary">A free bootstrap template by <a href="https://uicookies.com/" target="_blank">uicookies.com</a></p> -->
        </div>
      </div>
    </div>
  </section>

  <section class="probootstrap-features-1">
    <div class="container">
      <div class="row">
        <div class="col-md probootstrap-feature-item" style="background-image: url(https://uicookies.com/demo/theme/health/images/img_1.jpg);">
          <div class="probootstrap-feature-item-text">
            <span class="icon"><i class="flaticon-first-aid-kit display-4"></i></span>
            <h2>Pediatric <span>Therapy</span></h2>
          </div>
        </div>
        <div class="col-md probootstrap-opening">
          <h2 class="text-uppercase mb-3">Opening Hour <span>Medical Center</span></h2>
          <ul class="list-unstyled probootstrap-schedule">
            <li>Mon-Fri <span>5:00-17:00</span></li>
            <li>Sat <span>6:30-17:00</span></li>
            <li>Sun <span>6:30-17:00</span></li>
          </ul>
        </div>
        <div class="col-md probootstrap-feature-item" style="background-image: url(https://uicookies.com/demo/theme/health/images/img_2.jpg);">
          <div class="probootstrap-feature-item-text">
            <span class="icon"><i class="flaticon-gym-control-of-exercises-with-a-list-on-a-clipboard-and-heart-beats display-4"></i></span>

            <h2>Psychiatric <span>Therapy</span></h2>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="probootstrap-services">
    <div class="container">
      <div class="row no-gutters">
        <div class="col-md-3 probootstrap-aside-stretch-left">
          <div class="mb-3">
            <h2 class="h6">Departments</h2>
            <ul class="list-unstyled probootstrap-light mb-4">
              <li><a href="#">Urology</a></li>
              <li><a href="#">Pediatrics</a></li>
              <li><a href="#">Psychiatrics</a></li>
              <li><a href="#">Plastic Surgery</a></li>
              <li><a href="#">Neurosurgery</a></li>
            </ul>
            <p><a href="#" class="arrow-link text-white">More departments <i class="icon-chevron-right"></i></a></p>
          </div>
        </div>
        <div class="col-md-9 pl-md-5 pl-0">
          <div class="row mb-5">

            <div class="col-lg-4 col-md-6">
              <div class="media d-block mb-4 text-left probootstrap-media">
                <div class="probootstrap-icon mb-3"><span class="flaticon-price-tag display-4"></span></div>
                <div class="media-body">
                  <h3 class="h5 mt-0 text-secondary">Medical Pricing</h3>
                  <p>Far far away, behind the word mountains, far from the countries Vokalia.</p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6">
              <div class="media d-block mb-4 text-left probootstrap-media">
                <div class="probootstrap-icon mb-3"><span class="flaticon-shield-with-cross display-4"></span></div>
                <div class="media-body">
                  <h3 class="h5 mt-0 text-secondary">Quality &amp; Safety</h3>
                  <p>Far far away, behind the word mountains, far from the countries Vokalia.</p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6">
              <div class="media d-block mb-4 text-left probootstrap-media">
                <div class="probootstrap-icon mb-3"><span class="flaticon-first-aid-kit display-4"></span></div>
                <div class="media-body">
                  <h3 class="h5 mt-0 text-secondary">Immidiate Service</h3>
                  <p>Far far away, behind the word mountains, far from the countries Vokalia.</p>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6">
              <div class="media d-block mb-4 text-left probootstrap-media">
                <div class="probootstrap-icon mb-3"><span class="flaticon-microscope display-4"></span></div>
                <div class="media-body">
                  <h3 class="h5 mt-0 text-secondary">Cutting-Edge Equipment</h3>
                  <p>Far far away, behind the word mountains, far from the countries Vokalia.</p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6">
              <div class="media d-block mb-4 text-left probootstrap-media">
                <div class="probootstrap-icon mb-3"><span class="flaticon-gym-control-of-exercises-with-a-list-on-a-clipboard-and-heart-beats display-4"></span></div>
                <div class="media-body">
                  <h3 class="h5 mt-0 text-secondary">Personalized Treatment</h3>
                  <p>Far far away, behind the word mountains, far from the countries Vokalia.</p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6">
              <div class="media d-block mb-4 text-left probootstrap-media">
                <div class="probootstrap-icon mb-3"><span class="flaticon-doctor display-4"></span></div>
                <div class="media-body">
                  <h3 class="h5 mt-0 text-secondary">Experience Physicians</h3>
                  <p>Far far away, behind the word mountains, far from the countries Vokalia.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="probootstrap-section overlay bg-image" style="background-image: url(https://uicookies.com/demo/theme/health/images/bg_1.jpg)">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <h2 class="text-white display-4">Specialists in Family Healthcare</h2>
          <p class="text-white mb-5 lead">Far far away, behind the word mountains, far from the countries Vokalia.</p>
          <div class="row justify-content-center mb-5">
            <div class="col-md-4"><a href="#" class="btn btn-secondary btn-block">Appointment <span class="icon-arrow-right"></span></a></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="probootstrap-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6">
          <div class="media d-block mb-5 text-center probootstrap-media">
            <div class="probootstrap-icon mb-3"><span class="flaticon-price-tag display-4"></span></div>
            <div class="media-body">
              <h3 class="h5 mt-0 text-secondary">Medical Pricing</h3>
              <p>Far far away, behind the word mountains, far from the countries Vokalia.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="media d-block mb-5 text-center probootstrap-media">
            <div class="probootstrap-icon mb-3"><span class="flaticon-shield-with-cross display-4"></span></div>
            <div class="media-body">
              <h3 class="h5 mt-0 text-secondary">Quality &amp; Safety</h3>
              <p>Far far away, behind the word mountains, far from the countries Vokalia.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="media d-block mb-5 text-center probootstrap-media">
            <div class="probootstrap-icon mb-3"><span class="flaticon-microscope display-4"></span></div>
            <div class="media-body">
              <h3 class="h5 mt-0 text-secondary">Cutting-Edge Equipment</h3>
              <p>Far far away, behind the word mountains, far from the countries Vokalia.</p>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6">
          <div class="media d-block mb-5 text-center probootstrap-media">
            <div class="probootstrap-icon mb-3"><span class="flaticon-microscope display-4"></span></div>
            <div class="media-body">
              <h3 class="h5 mt-0 text-secondary">Cutting-Edge Equipment</h3>
              <p>Far far away, behind the word mountains, far from the countries Vokalia.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="media d-block mb-5 text-center probootstrap-media">
            <div class="probootstrap-icon mb-3"><span class="flaticon-gym-control-of-exercises-with-a-list-on-a-clipboard-and-heart-beats display-4"></span></div>
            <div class="media-body">
              <h3 class="h5 mt-0 text-secondary">Personalized Treatment</h3>
              <p>Far far away, behind the word mountains, far from the countries Vokalia.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="media d-block mb-5 text-center probootstrap-media">
            <div class="probootstrap-icon mb-3"><span class="flaticon-doctor display-4"></span></div>
            <div class="media-body">
              <h3 class="h5 mt-0 text-secondary">Experience Physicians</h3>
              <p>Far far away, behind the word mountains, far from the countries Vokalia.</p>
            </div>
          </div>
        </div>

      </div>
      <!--  <div class="row">
         
      </div> -->
    </div>
  </section>

  <section class="probootstrap-section bg-light">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md-12 text-center">
          <h2 class="h1">Our Doctors</h2>
          <p class="lead text-secondary">Far far away, behind the word mountains, far from the countries Vokalia.</p>
          <div class="row justify-content-center mb-5">
            <div class="col-md-3"><a href="#" class="btn btn-secondary btn-block">Join Us</a></div>
          </div>
        </div>
      </div>
      <div class="row no-gutters">
        <div class="col-lg-3 col-md-3 col-sm-6 col-6 prbootstrap-team">
          <img src="https://uicookies.com/demo/theme/health/images/person_1.jpg" alt="Free Template by uicookies.com" class="img-fluid">
          <div class="probootstrap-person-text">
            <span class="title">Medical Doctor</span>
            <span class="name">Dr. Abbey Smith</span>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-6 prbootstrap-team">
          <img src="https://uicookies.com/demo/theme/health/images/person_2.jpg" alt="Free Template by uicookies.com" class="img-fluid">
          <div class="probootstrap-person-text">
            <span class="title">Medical Doctor</span>
            <span class="name">Dr. Ben Carpio</span>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-6 prbootstrap-team">
          <img src="https://uicookies.com/demo/theme/health/images/person_3.jpg" alt="Free Template by uicookies.com" class="img-fluid">
          <div class="probootstrap-person-text">
            <span class="title">Medical Doctor</span>
            <span class="name">Dr. Louisa Westwood</span>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-6 prbootstrap-team">
          <img src="https://uicookies.com/demo/theme/health/images/person_4.jpg" alt="Free Template by uicookies.com" class="img-fluid">
          <div class="probootstrap-person-text">
            <span class="title">Cardiac Surgeon</span>
            <span class="name">Dr. Mark Sebastian</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php include_once "layout/footer.php"; ?>

  <!-- loader -->
  <div id="probootstrap-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
      <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
      <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#32609e" /></svg></div>

  <?php include_once "include/javascript.php"; ?>

</body>

</html>
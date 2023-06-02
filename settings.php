<?php
session_start();
include('function.php');

if (isset($_SESSION['session_id_user'])) {
  $id_user = $_SESSION['session_id_user'];
  $user = readUserProfile($id_user);
  
  if (isset($_GET['del'])) {
    $isSucceed = deleteAccount($id_user);
    if ($isSucceed > 0) {
      session_destroy();
      header("Location: index.php");
    } else {
      echo "<script>alert('Delete failed!');</script>";
    }
  } else if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
  }
} else {
  header("Location: login.php");
}

if (isset($_POST['btn-change-privacy'])) {
  $id_user = $_POST['id_user'];
  $privacy = $_POST['privacy'];

  $isSucceed = updateAccountPrivacy($id_user, $privacy);
  if ($isSucceed > 0) {
    echo "<script>
    alert('Account privacy updated successfully!');
    document.location.href = 'settings.php';
    </script>";
  } else {
    echo "<script>alert('Failed to update account privacy!');</script>";
  }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Canvess</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/canvesslogo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/gaya.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: MyResume
  * Updated: Mar 10 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/free-html-bootstrap-template-my-resume/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Mobile nav toggle button ======= -->
  <!-- <button type="button" class="mobile-nav-toggle d-xl-none"><i class="bi bi-list mobile-nav-toggle"></i></button> -->

  <header id="header" class="header d-flex align-items-center">

    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="assets/img/canvesslogo.png" alt="Canvess">
        <!-- <h1>Impact<span>.</span></h1> -->
      </a>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="index.php">Home</a></li>
          <?php
          if ($id_user != 5) {
          ?>
            <li class="dropdown"><a href="#" class="active"><?= $user['username'] ?><i class="bi bi-chevron-down dropdown-indicator"></i></a>
              <ul>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="#" class="active">Settings</a></li>
              </ul>
            </li>
          <?php
          } else {
          ?>
            <li><a href="login.php?type=1">Login</a></li>
          <?php
          }
          ?>
        </ul>
      </nav><!-- .navbar -->

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header><!-- End Header -->
  <!-- End Header -->

  <main id="main">
  <section id="contact" class="contact">
    <div class="container" data-aos="fade-up">
      <div class="section-title">
        <h2>SETTINGS</h2>
      </div>



      <div class="row justify-content-md-center gx-lg-0 gy-4">
        <div class="col-lg-8">
          <form action="settings.php" method="POST" role="form" class="php-email-form" id="form-change-privacy">
            <div class="row">
              <input type="hidden" name="id_user" value="<?= $id_user ?>">
              <div class="col-md-auto pl-9 pt-2 pd-0 mt-2">
                <label for="privacy">Account Privacy</label>
              </div>
              <div class="col mt-2">
                <?php
                  $privacyNow = $user['id_postprivacy'];
                ?>
              <select class="form-control" name="privacy" id="privacy" required>
                <option value="0" <?php if(isset($privacyNow) && $privacyNow == 0) echo 'selected'; ?>>Public</option>
                <option value="1" <?php if(isset($privacyNow) && $privacyNow == 1) echo 'selected'; ?>>Private to non-friends</option>
                <option value="2" <?php if(isset($privacyNow) && $privacyNow == 2) echo 'selected'; ?>>Private to all</option>
              </select>
            </div>


              <div class="col-md-auto mt-2">
                <div class="rep-btn">
                  <button type="submit" name="btn-change-privacy" id="btn-change-privacy" form="form-change-privacy">Save</button>
                </div>
              </div>
            </div>
          </form>
        </div>
        <br><br>
            <section id="portfolio" class="portfolio section-bg">
              <div class="container" data-aos="fade-up">
                <div class="row">
                  <div class="col-lg-12 d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
                    <ul id="portfolio-flters">
                    &nbsp;&nbsp;&nbsp;&nbsp;
                      <li><a href="settings.php?logout=1" class="normal" onclick="return confirm('You are going to log out from your account')">Log out</a></li>
                      <li><a href="settings.php?del=1" class="alert" onclick="return confirm('You are going to delete your account permanently')">Delete account</a></li>
                      <br>
                    </ul>
                  </div>
                </div>
              </div>
          </section><!-- End Contact Form -->
      </div>
    </div>
  </section>
</main>


  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <h3>Canvess</h3>
      <p>"You are never alone"</p>
      <div class="social-links">
        <a href="https://wa.me/6281282420569" class="whatsapp" target="_blank"><i class="bx bxl-whatsapp"></i></a>
        <a href="https://www.instagram.com/aryaayy_/" class="instagram" target="_blank"><i class="bx bxl-instagram"></i></a>
        <a href="mailto:aryayyy9604@gmail.com" class="gmail" target="_blank"><i class="bx bxl-gmail"></i></a>
      </div>
      <div class="copyright">
        &copy; Copyright <strong>Canvess</strong>.
        All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: [license-url] -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/free-html-bootstrap-template-my-resume/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top back d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <a href="form/createPost.php" class="create-post d-flex align-items-center justify-content-center"><i class="bi bi-plus"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/typed.js/typed.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="assets/js/header.js"></script>

</body>

</html>
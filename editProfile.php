<?php
  session_start();
  print_r($_SESSION);
  include('function.php');
  
  if(isset($_SESSION['session_id_user'])) {
      $id_user = $_SESSION['session_id_user'];
      $user = readUserProfile($id_user);
      $bioNow = getBio($id_user);
      if(isset($_POST['btn-change-username'])) {
          $username = $_POST['username'];
          $sql = "SELECT * FROM t_user WHERE username='$username'";
          $result = mysqli_query($conn, $sql);
  
          if(!$result->num_rows > 0) {
              $isSucceed = updateUsername($id_user);
              if($isSucceed > 0) {
                  header("Location: profile.php");
              } else {
                  echo "<script>alert('Update failed!');</script>";
              }
          } else {
              echo "<script>alert('Username is used!');</script>";
          }
      } else if(isset($_POST['btn-change-bio'])) {
          $bio_status = $_POST['bio_status'];
  
          $existingBio = getBio($id_user);
  
          if($existingBio) {
              $isUpdated = updateBio($id_user, $bio_status);
              if($isUpdated > 0) {
                  header("Location: profile.php");
              } else {
                  echo "<script>alert('Failed to update bio!');</script>";
              }
          } else {
              $isInserted = insertBio($id_user, $bio_status);
              if($isInserted > 0) {
                  header("Location: profile.php");
              } else {
                  echo "<script>alert('Failed to add bio!');</script>";
              }
          }
      } else if (isset($_POST['btn-change-gender'])) {
        $id_user = $_POST['id_user'];
        $gender = $_POST['gender'];
      
        $isSucceed = updateGender($id_user, $gender);
        if ($isSucceed > 0) {
          echo "<script>alert('Gender updated successfully!');
          document.location.href = 'editProfile.php';
          </script>";
        } else {
          echo "<script>alert('Failed to update gender!');</script>";
        }
      }
  } else {
      header("Location: login.php");
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
            if($id_user != 5){
              ?>
          <li class="dropdown"><a href="#" class="active"><?= $user['username'] ?><i class="bi bi-chevron-down dropdown-indicator"></i></a>
          <ul>
              <li><a href="profile.php">Profile</a></li>
              <li><a href="settings.php" class="active">Settings</a></li>
            </ul>
          </li>
          <?php
            }else{
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

<!-- ======= Contact Section ======= -->
<section id="contact" class="contact">
      <div class="container " data-aos="fade-up">

        <div class="section-title">
          <h2>EDIT PROFILE</h2>
        </div>

        <div class="row justify-content-md-center gx-lg-0 gy-4">

          <div class="col-lg-8">
          <form action="editProfile.php" method="POST" role="form" class="php-email-form" id="form-change-username">
          <div class="row">
            <input type="hidden" name="id_user" value="<?=$id_user?>">
            <div class="col-md-auto pl-9 pt-2 pd-0 mt-2">
              <label for="username">Change Username</label>
            </div>
            <div class="col mt-2">
              <input type="text" class="form-control" name="username" id="username" value="<?= $user['username']?>" onkeypress="return event.charCode != 32" required>
            </div>
            <div class="col-md-auto mt-2">
              <div class="rep-btn"><button type="submit" name="btn-change-username" id="btn-change-username" form="form-change-username">Save</button></div>
            </div>
          </div>
        </form>

              <form action="editProfile.php" method="POST" role="form" class="php-email-form" id="form-change-bio">
        <div class="row">
          <input type="hidden" name="id_user" value="<?= $id_user ?>">
          <div class="col-md-auto pl-9 pt-2 pd-0 mt-2">
            <label for="bio_status">Change Bio Status</label>
          </div>
          <div class="col mt-2">
            <input type="text" class="form-control" name="bio_status" id="bio_status" placeholder="Enter your bio" value="<?=$bioNow?>">
          </div>
          <div class="col-md-auto mt-2">
            <div class="rep-btn"><button type="submit" name="btn-change-bio" id="btn-change-bio" form="form-change-bio">Save</button></div>
          </div>
        </div>
      </form>
          <form action="settings.php" method="POST" role="form" class="php-email-form" id="form-change-gender">
            <div class="row">
              <input type="hidden" name="id_user" value="<?= $id_user ?>">
              <div class="col-md-auto pl-9 pt-2 pd-0 mt-2">
                <label for="gender">Gender</label>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              </div>
              <div class="col mt-2">
                <?php
                $genderNow = $user['id_user'];
                ?>
            <select class="form-control" name="gender" id="gender" required>
              <option value="0" <?php if(isset($genderNow) && $genderNow == 0) echo 'selected'; ?>>Prefer not say</option>
              <option value="1" <?php if(isset($genderNow) && $genderNow == 1) echo 'selected'; ?>>Male</option>
              <option value="2" <?php if(isset($genderNow) && $genderNow == 2) echo 'selected'; ?>>Female</option>
            </select>
          </div>



              <div class="col-md-auto mt-2">
                <div class="rep-btn">
                  <button type="submit" name="btn-change-gender" id="btn-change-gender" form="form-change-gender">Save</button>
                </div>
              </div>
            </div>
          </form>
          
        </div>
        

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

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
      &copy; Copyright <strong>Canvess</strong>. All Rights Reserved
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
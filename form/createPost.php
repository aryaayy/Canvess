<?php
  session_start();
  print_r($_SESSION);
  include('../function.php');

  if(isset($_SESSION['session_id_user'])){
    $id_user = $_SESSION['session_id_user'];
    $user = readUserProfile($id_user);
    if(isset($_POST['btn-add'])){
      $id_user = $_POST['id_user'];
      $id_mainchat = createPost();
      if ($id_mainchat > 0) {
        // jika penambahan sukses, tampilkan alert
        header("Location: ../post.php?id_mainchat=$id_mainchat");
      } else {
        echo "
        <script>
        alert('Post failed!');
        </script>
        ";
      }
    }
  }else{
    header("Location: ../login.php?type=2");
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
  <link href="../assets/img/canvesslogo.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/gaya.css" rel="stylesheet">

  <!-- WYSIWYG -->
  <!-- <link href='https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css' rel='stylesheet' type='text/css' /> -->

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
      <a href="../index.php" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="../assets/img/canvesslogo.png" alt="Canvess">
        <!-- <h1>Impact<span>.</span></h1> -->
      </a>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="../index.php">Home</a></li>
          <?php
            if($id_user != 5){
              ?>
          <li class="dropdown"><a href="#"><?= $user['username'] ?><i class="bi bi-chevron-down dropdown-indicator"></i></a>
          <ul>
              <li><a href="../profile.php">Profile</a></li>
              <li><a href="../settings.php">Settings</a></li>
            </ul>
          </li>
          <?php
            }else{
          ?>
          <li><a href="../login.php?type=1">Login</a></li>
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
          <h2>CREATE POST</h2>
        </div>

        <div class="row justify-content-md-center gx-lg-0 gy-4">

          <div class="col-lg-7">
            <form action="createPost.php" method="POST" role="form" class="php-email-form" id="form-add">
              <input type="hidden" name="id_user" value="<?=$id_user?>">
              <div class="form-group">
                <textarea class="form-control" id="froala" name="main_message" rows="7" maxlength="1000" placeholder="Write your story in 1000 characters..." required></textarea>
              </div>
              <div class="form-check mt-3">
                <input class="form-check-input" type="radio" name="isAnonymous" id="anonymous" value="1" checked>
                <label class="form-check-label" for="anonymous">
                  Post as anonymous
                </label>
              </div>
              <div class="form-check mt-3">
                <input class="form-check-input" type="radio" name="isAnonymous" id="username" value="0">
                <label class="form-check-label" for="username">
                  Post as <?= $user['username'] ?>
                </label>
              </div>
              <div class="text-center"><button type="submit" name="btn-add" id="btn-add" form="form-add">Post</button></div>
            </form>
          </div><!-- End Contact Form -->

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
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="../assets/vendor/aos/aos.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="../assets/vendor/typed.js/typed.min.js"></script>
  <script src="../assets/vendor/waypoints/noframework.waypoints.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>
  <script src="../assets/js/header.js"></script>
  <!-- <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js'></script>
  <script> 
      var editor = new FroalaEditor('#froala', {
        placeholderText: 'Write your story in 1000 characters...'
      });
      editor.opts.height = 200;
      editor.size.refresh();
  </script> -->

</body>

</html>
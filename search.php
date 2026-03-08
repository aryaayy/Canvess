<?php
// search.php
session_start();
  include('function.php');
  require_once 'config.php';

  use Config\Database;

  // global $conn;
  $db = new Database();
  $db->connect();

  if(isset($_SESSION['session_id_user'])){
    $id_user = $_SESSION['session_id_user'];
    $user_auth = $_SESSION['authority'];
    if($user_auth == 1){
      header('Location: admin/indexAdmin.php');
    }
  }else{
    $id_user = $_SESSION['session_id_guest'];
    $_SESSION['authority'] = 2;
    $user_auth = $_SESSION['authority'];
  }
  $user = readUserProfile($id_user);


if (isset($_GET['username'])) {
    $searchUsername = $_GET['username'];
    $query = "SELECT * FROM t_user WHERE username LIKE '%$searchUsername%' GROUP BY username ASC";
    $result = mysqli_query($db->get_conn(), $query);
    $data = array();

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }
    $db->close();
} else {
    // Jika tidak ada username yang diberikan, kembali ke halaman sebelumnya
    $db->close();
    header("Location: index.php");
    exit();
}
?>

<!-- Tambahkan kode HTML untuk tampilan list user -->

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
  <!-- <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

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
            <li>
                <form method="GET" action="search.php" class="search-form mb-0 ml-4">
                    <div class="input-group">
                        <div class="form-outline">
                            <input type="text" name="username" placeholder="Search username...">
                        </div>
                        <button type="submit" class="btn btn-dark pt-1" style="height:30px"><i class="bi bi-search"></i></button>
                    </div>
                </form>
            </li>
          <li><a href="index.php">Home</a></li>
          <?php
            if($user_auth != 2){
              ?>
          <li class="dropdown"><a href="#"><?= $user['username'] ?><i class="bi bi-chevron-down dropdown-indicator"></i></a>
          <ul>
              <li><a href="profile.php">Profile</a></li>
              <li><a href="settings.php">Settings</a></li>
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

<!-- ======= Portfolio Section ======= -->
<section id="portfolio" class="portfolio section-bg">
      <div class="container" data-aos="fade-up">

      <div class="section-title">
          <h2>SEARCH RESULT FOR <?=$searchUsername?></h2>
        </div>
        
        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
          <?php
          if(!empty($data)){
            foreach($data as $searchResult){
                if($searchResult['id_authority'] != 1 && $searchResult['id_authority'] != 2){
          ?>
          <div class="col-lg-4 col-md-6 portfolio-item filter-main filter-all">
            <div class="col">
              <div class="card h-100">
                <?php
                    if($searchResult['id_user'] != $id_user){
                ?>
                <a href="seeProfile.php?username=<?=$searchResult['username']?>">
                <?php
                    }else{
                ?>
                    <a href="profile.php">
                <?php
                    }
                ?>
                <?php }?>
                  <div class="card-body">
                    <h5 class="card-title"><?= $searchResult['username']; ?></h5>
                    <p class="card-text">
                      <?php
                        if(!empty($searchResult['bio'])){
                      ?>
                      "<?= $searchResult['bio']; ?>"
                      <?php
                        }else{
                      ?>
                      (No bio)
                      <?php } ?>
                    </p>
                  </div>
                <?php
                if(!empty(readFollow($id_user, $searchResult['id_user']))){
                    $follower = readFollow($id_user, $searchResult['id_user']);
                    if($id_user == $follower['id_follower']){
                ?>
                  <div class="card-footer">
                      <p class="mb-0">Followed</p>
                  </div>
                <?php
                    }
                    }
                ?>
                </a>
              </div>
            </div>
          </div>
          <?php
                }
            }
            else{
          ?>
          <div class="col text-center">
            <p>USERNAME NOT FOUND</p>
            </div>
          <?php } ?>
        </div>

      </div>
    </section><!-- End Portfolio Section -->

  </main><!-- End #main -->
  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <h3>Canvess</h3>
      <p>"You are never alone"</p>
      <div class="social-links">
        <a href="https://wa.me/6281282420569" class="whatsapp" target="_blank"><i class="bx bxl-whatsapp"></i></a>
        <a href="https://www.instagram.com/can.vess/" class="instagram" target="_blank"><i class="bx bxl-instagram"></i></a>
        <a href="mailto:mail.canvess@gmail.com" class="gmail" target="_blank"><i class="bx bxl-gmail"></i></a>
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
    <?php
    if($user_auth != 2){
      ?>
  <a href="form/createPost.php" class="create-post d-flex align-items-center justify-content-center"><i class="bi bi-plus"></i></a>
  <?php
    }else{
      ?>
  <a href="login.php?type=2" class="create-post d-flex align-items-center justify-content-center"><i class="bi bi-plus"></i></a>
  <?php
    }
    ?>

<!-- Vendor JS Files -->
<script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/typed.js/typed.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>

  <!-- Template JS File -->
  <script src="assets/js/main.js"></script>
  <script src="assets/js/header.js"></script>

</html>

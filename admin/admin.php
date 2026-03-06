<?php
    session_start();
  include("../function.php");

  $listUser = adminUser();
  $listReply = adminReply();
  $listMainChat = adminMainChat();
  $countUser = adminCountUser();
  $countReply = adminCountReply();
  $countMain = adminCountMain();
  $user = readUserProfile($_SESSION['session_id_user']);

  if($_SESSION['authority'] == 1){
    $id_user = $_SESSION['session_id_user'];
  }
  else{
    header('Location: ../login.php');
  }
  $user = readUserProfile($id_user);
  $data = readMainChat();
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
      <a href="indexAdmin.php" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="../assets/img/canvesslogo.png" alt="Canvess">
        <!-- <h1>Impact<span>.</span></h1> -->
      </a>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="indexAdmin.php">Home</a></li>
          <li class="dropdown"><a href="#" class="active"><?= $user['username'] ?><i class="bi bi-chevron-down dropdown-indicator"></i></a>
          <ul>
              <li><a href="settings.php" class="active">Settings</a></li>
              <li><a href="#">Admin Page</a></li>
            </ul>
            </li>
        </ul>
      </nav><!-- .navbar -->

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header><!-- End Header -->
  <!-- End Header -->
  

  <main id="main">
    <section id="portfolio" class="portfolio section-bg">
      <div class="container" data-aos="fade-up">
      <div class="section-title">
          <h2>ADMIN PAGE</h2>
        </div>
      <div class="row">
        <div class="col-lg-12 d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">All (<?=$countUser+$countMain+$countReply?>)</li>
              <li data-filter=".filter-user">User (<?=$countUser?>)</li>
              <li data-filter=".filter-reply">Replies (<?=$countReply?>)</li>
              <li data-filter=".filter-main">Posts (<?=$countMain?>)</li>
              <!--<li data-filter=".filter-web">Web</li>-->
            </ul>
          </div>
        </div>
        <!-- ======= user Section ======= -->
        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
    <div id="user" class="user portfolio-item filter-user">

      <div class="section-header text-center">
            <p>USER</p>

        </div>
            <div class="gradient-custom-1 h-100">
                <div class="mask d-flex align-items-center h-100">
                <div class="container">
                    <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="table-responsive bg-white">
                        <table class="table mb-0 table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Email</th>
                                <th scope="col">Username</th>
                                <th scope="col">Bio</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                              <?php
                                $index=1;
                                foreach ($listUser as $user){
                                  if($user['id_authority'] != 1 && $user['id_authority'] != 2){
                              ?>
                                    <tr>
                                        <td><?=$index?></td>
                                        <td><?=$user['email']?></td>
                                        <td><?=$user['username']?></td>
                                        <td><?=$user['bio']?></td>
                                        <td>
                                            <a href="delete.php?id_user=<?= $user['id_user'] ?>" onclick="return confirm('Yakin Hapus?')"><i class="bi bi-trash3" style="color:red;">Delete</i></a>
                                        </td>
                                    </tr>
                              <?php
                                  $index++;
                                  }
                                }
                              ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
    </div><!-- End user Section -->

    <!-- ======= replayChat Section ======= -->
    <div id="reply" class="reply  portfolio-item filter-reply">

      <div class="section-header  text-center">
            <p>REPLIES</p>

        </div>
            <div class="gradient-custom-1 h-100">
                <div class="mask d-flex align-items-center h-100">
                <div class="container">
                    <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="table-responsive bg-white">
                        <table class="table mb-0 table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Username</th>
                                <th scope="col">Reply Message</th>
                                <th scope="col">Reply On</th>
                                <th scope="col">Date Time</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                              <?php
                                $index=1;
                                foreach ($listReply as $reply){
                              ?>
                                    <tr>
                                        <td><?=$index?></td>
                                        <td><?=$reply['username']?></td>
                                        <td><?=$reply['reply_message']?></td>
                                        <td><?=$reply['id_main']?></td>
                                        <td><?=$reply['reply_datetime']?></td>
                                        <td>
                                    
                                            
                                            <a href="delete.php?id_reply=<?= $reply['id_replychat'] ?>" onclick="return confirm('Yakin Hapus?')"><i class="bi bi-trash3" style="color:red;">Delete</i></a>
                                        </td>
                                    </tr>
                              <?php
                                $index++;
                                }
                              ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
    </div>
    <!-- End replyChat Section -->

    <!-- ======= mainChat Section ======= -->
    <div id="main" class="main portfolio-item filter-main">

      <div class="section-header  text-center">
            <p>POSTS</p>

        </div>
            <div class="gradient-custom-1 h-100">
                <div class="mask d-flex align-items-center h-100">
                <div class="container">
                    <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="table-responsive bg-white">
                        <table class="table mb-0 table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Username</th>
                                <th scope="col">Main Message</th>
                                <th scope="col">Date Time</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                              <?php
                                $index=1;
                                foreach ($listMainChat as $chat){
                              ?>
                                    <tr>
                                        <td><?=$index?></td>
                                        <td><?=$chat['username']?></td>
                                        <td><?=$chat['main_message']?></td>
                                        <td><?=$chat['main_datetime']?></td>
                                        <td>
                                    
                                            
                                            <a href="delete.php?id_main=<?= $chat['id_mainchat'] ?>" onclick="return confirm('Yakin Hapus?')"><i class="bi bi-trash3" style="color:red;">Delete</i></a>
                                        </td>
                                    </tr>
                              <?php
                                $index++;
                                }
                              ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
      </div>
    </div>
    <!-- End mainChat Section -->
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
        <a href="https://www.instagram.com/can.vess/" class="instagram" target="_blank"><i class="bx bxl-instagram"></i></a>
        <a href="mailto:mail.canvess@gmail.com" class="gmail" target="_blank"><i class="bx bxl-gmail"></i></a>
      </div>
      <div class="copyright">
        &copy; Copyright <strong><span>Canvess</span></strong>. All Rights Reserved
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

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="../assets/vendor/aos/aos.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="../assets/vendor/typed.js/typed.min.js"></script>
  <script src="../assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>
  <script src="../assets/js/header.js"></script>

</body>

</html>
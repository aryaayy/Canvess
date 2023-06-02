<?php
// Include file konfigurasi atau fungsi yang diperlukan
    session_start();
    print_r($_SESSION);
    include("../function.php");

    if($_SESSION['session_id_user'] == 16){
      $id_user = $_SESSION['session_id_user'];
      $user = readUserProfile($id_user);
    }
    else{
      header('Location: ../login.php');
    }
    $id_mainchat = $_GET['id_mainchat'];
    $data = readMainChatPost($id_mainchat);
    $countReply = countReplyChatPost($id_mainchat);
    $countLikesMain = countMainChatLikes($id_mainchat);
    $likeExist = checkLikesMain($id_user, $id_mainchat);
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
          <li class="dropdown"><a href="#"><?= $user['username'] ?> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
          <ul>
            <li><a href="settings.php">Settings</a></li>
            <li><a href="admin.php">Admin Page</a></li>
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

<!-- ======= Portfolio Section ======= -->
<section id="contact" class="contact section-bg">
  <div class="container" data-aos="fade-up">

    <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
      <div class="portfolio-item">
        <div class="col">
            <div class="card">
                <div class="card-body text-center">
                <?php
                    if($data['isAnonymous'] == 0){
                ?>
                <h5 class="card-title"><?= $data['username']; ?></h5>
                <?php
                    }else{
                ?> 
                <h5 class="card-title">anonymous<?= $data['id_user']; ?></h5>
                <?php
                    }
                ?>
                <p class="card-text"><?= $data['main_message']; ?></p>
                <div class="text-center">
                    <a href="delete.php?id_main=<?=$data['id_mainchat']?>&type=1" onclick="return confirm('You are going to delete a post')"><i class="bi bi-trash" style="color:red;"></i></a>
                </div>
                </div>
                <div style="width:90%; margin: auto;">
                    <hr>
                </div>
                <div class="row justify-content-md-center" id="formContainer">
                  <form id="likeForm" class="col-3 text-center like">
                    <input type="hidden" id="id_user" name="id_user" value="<?=$id_user?>">
                    <input type="hidden" id="id_mainchat" name="id_mainchat" value="<?=$id_mainchat?>">
                    <?php
                        if($likeExist == 0){
                    ?>
                    <button id="like-btn" class="like-btn" form="likeForm"><i class="bi bi-hand-thumbs-up"></i></button>
                    <?php
                        }else{
                    ?>
                    <button id="like-btn" class="like-btn liked" form="likeForm"><i class="bi bi-hand-thumbs-up"></i></button>
                    <?php
                        }
                    ?>
                    <span class="count"><?=$countLikesMain?></span>
                  </form>
                  <div class="col-3 text-center like">
                    <button><i class="bi bi-chat"></i></button>
                    <span><?=$countReply?></span>
                  </div>
                </div>
                <div class="card-footer text-center">
                <small class="text-muted">Created on <?= $data['main_datetime']; ?></small>
                </div>
                <ul class="list-group list-group-flush">
                    <?php
                        $replies = readReplyChatPost($id_mainchat);

                        foreach($replies as $reply){
                    ?>
                    <li class="list-group-item">
                        <?php
                            if($reply['isAnonymous'] == 0){
                        ?>
                        <h5 class="card-title"><?= $reply['username']; ?></h5>
                        <?php
                            }else{
                        ?> 
                        <h5 class="card-title">anonymous<?= $reply['id_user']; ?></h5>
                        <?php
                            }
                        ?>
                        <?= $reply['reply_message'] ?>
                        <div class="text-center">
                        <a href="delete.php?id_reply=<?=$reply['id_replychat']?>&id_mainchat=<?=$id_mainchat?>&type=2" onclick="return confirm('You are going to delete a post')"><i class="bi bi-trash" style="color:red;"></i></a>
                        <small class="text-muted">Created on <?= $reply['reply_datetime']; ?></small>
                        </div>
                    </li>
                    <?php
                        }
                        ?>
                </ul>
            </div>
        </div>
        </div>
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

</body>
</html>

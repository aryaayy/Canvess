<?php
    session_start();
  include("../function.php");

  $listUser = adminUser();
  $listReply = adminReply();
  $listPrivacy = adminPrivacy();
  $listMainChat = adminMainChat();
  $user = readUserProfile($_SESSION['session_id_user']);

  if(isset($_SESSION['session_id_user'])){
    $id_user = $_SESSION['session_id_user'];
  }else{
    $id_user = 5;
  }
  $user = readUserProfile($id_user);
  $data = readMainChat();

//   if(isset($_GET['id_user_del'])){
//     $isSucceed = deleteAccount($_GET['id_user_del']);
//     if($isSucceed > 0){
//       header('Location: index.php');
//     }else{
//       echo "
//         <script>
//         alert('Delete failed!');
//         </script>
//         ";
//     }
//   }else{
//     $id_user = $_GET['id_user'];
//     $user = readUserProfile($id_user);
//   }
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
    <!-- ======= user Section ======= -->
    <section id="user" class="user">

      <div class="container" data-aos="fade-up">
      <div class="section-header">
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
                                <th scope="col">Password</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                              <?php
                                $index=1;
                                foreach ($listUser as $user){
                              ?>
                                    <tr>
                                        <td><?=$index?></td>
                                        <td><?=$user['email']?></td>
                                        <td><?=$user['username']?></td>
                                        <td><?=$user['password']?></td>
                                        <td>
                                    
                                            
                                            <a href="delete.php?id_user=<?= $user['id_user'] ?>" onclick="return confirm('Yakin Hapus?')"><i class="bi bi-trash3">Delete</i></a>
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
    </section><!-- End user Section -->

    <!-- ======= replayChat Section ======= -->
    <section id="reply" class="reply">

      <div class="container" data-aos="fade-up">
      <div class="section-header">
            <p>REPLY CHAT</p>

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
                                <th scope="col">Reply Message</th>
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
                                        <td><?=$reply['reply_message']?></td>
                                        <td><?=$reply['reply_datetime']?></td>
                                        <td>
                                    
                                            
                                            <a href="delete.php?id_reply=<?= $reply['id_replychat'] ?>" onclick="return confirm('Yakin Hapus?')"><i class="bi bi-trash3">Delete</i></a>
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
    </section>
    <!-- End privacy Section -->

    <!-- ======= privacy Section ======= -->
    <section id="privacy" class="privacy">

    <div class="container" data-aos="fade-up">
    <div class="section-header">
          <p>PRIVACY</p>

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
                              <th scope="col">Privacy Name</th>
                              <th scope="col">Deskripsi</th>
                              <!-- <th scope="col"></th> -->
                          </tr>
                          </thead>
                          <tbody>
                            <?php
                              $index=1;
                              foreach ($listPrivacy as $privacy){
                            ?>
                                  <tr>
                                      <td><?=$index?></td>
                                      <td><?=$privacy['privacy_name']?></td>
                                      <td><?=$privacy['desc']?></td>
                                      
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
    </section>
    <!-- End replayChat Section -->

    <!-- ======= mainChat Section ======= -->
    <section id="main" class="main">

      <div class="container" data-aos="fade-up">
      <div class="section-header">
            <p>MAIN CHAT</p>

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
                                        <td><?=$chat['main_message']?></td>
                                        <td><?=$chat['main_datetime']?></td>
                                        <td>
                                    
                                            
                                            <a href="delete.php?id_main=<?= $chat['id_mainchat'] ?>" onclick="return confirm('Yakin Hapus?')"><i class="bi bi-trash3">Delete</i></a>
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
    </section>
    <!-- End mainChat Section -->


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
        &copy; Copyright <strong><span>aryaay</span></strong>. All Rights Reserved
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
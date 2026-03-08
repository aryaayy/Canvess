<?php
  session_start();
  include('function.php');

  if(isset($_SESSION['session_id_user'])){
    $id_user = $_SESSION['session_id_user'];
    $user_auth = $_SESSION['authority'];
  }else{
    $id_user = $_SESSION['session_id_guest'];
    $_SESSION['authority'] = 2;
    $user_auth = $_SESSION['authority'];
  }
  $username = $_GET['username'];
  $id_user_visit = getIdUserByUsername($username);
  if($id_user == $id_user_visit){
    header("Location: profile.php");
  }else{
    $user = readUserProfile($id_user_visit);
    $session_user = readUserProfile($id_user);
    $followCheck = followCheck($id_user, $id_user_visit);
    $followAccCheck = followAccCheck($id_user, $id_user_visit);
    $follow = readFollow($id_user, $id_user_visit);
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
  <link href="/assets/img/canvesslogo.png" rel="icon">
  <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="/assets/css/gaya.css" rel="stylesheet">

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
        <img src="/assets/img/canvesslogo.png" alt="Canvess">
        <!-- <h1>Impact<span>.</span></h1> -->
      </a>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="index.php">Home</a></li>
          <?php
            if($user_auth != 2){
              ?>
          <li class="dropdown"><a href="#" class="active"><?= $session_user['username'] ?><i class="bi bi-chevron-down dropdown-indicator"></i></a>
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
        <h2><?= $user['username'] ?></h2>
      </div>

      <div class="row justify-content-md-center gx-lg-0 gy-4">
        <div class="col-lg-8 text-center">
          <p>
            <?php
            if($followCheck == 1 || $user['id_postprivacy'] == 0){
              if($user['id_postprivacy'] == 0){
                $follow['status'] = 1;
              }
              if($follow['status'] == 1){
                if(!empty($user['bio'])){
            ?>
            "<?= $user['bio'] ?>"
            <?php
                }else{
            ?>
            (No bio)
            <?php
                }
              }else{
            ?>
              This account is <b>private</b>
            <?php
              }
            }else{
            ?>
            This account is <b>private</b>
            <?php } ?>
          </p>
        </div>
      </div>

        <div class="row justify-content-md-center gx-lg-0 gy-4">

          <div class="col-lg-8">
            <section id="portfolio" class="portfolio section-bg">
              <div class="container" data-aos="fade-up">
                <div class="row">
                  <div class="col-lg-12 d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
                    <ul id="portfolio-flters">
                      <li>
                        <?php
                          if($user_auth != 2){
                        ?>
                        <form id="follow-form" class="php-email-form">
                          <input type="hidden" id="follower" name="follower" value="<?=$id_user?>">
                          <input type="hidden" id="followed" name="followed" value="<?=$id_user_visit?>">
                          <input type="hidden" id="followedName" name="followedName" value="<?=$user['username']?>">
                          <input type="hidden" id="privacy" name="privacy" value="<?=$user['id_postprivacy']?>">
                          <input type="hidden" id="requestStatus" name="requestStatus" value="<?=$follow['status']?>">
                          <?php
                            if($followCheck==0){
                          ?>
                          <input type="hidden" id="isClicked" name="isClicked" value="0">
                          <button type="submit" name="follow-btn" id="follow-btn" form="follow-form">Follow</button>
                          <?php
                            }else{
                              if($user['id_postprivacy'] == 1){
                          ?>
                          <?php
                                if(!isset($follow['status'])){
                                  echo "
                                  <script>
                                  document.location.href = 'seeProfile.php?username=$username';
                                  </script>
                                  ";
                                }else{
                                if($follow['status'] == 0){
                          ?>
                          <input type="hidden" id="isClicked" name="isClicked" value="1">
                          <button type="submit" name="follow-btn" id="follow-btn" form="follow-form">Requested</button>
                          <?php
                                }else{
                          ?>
                          <input type="hidden" id="isClicked" name="isClicked" value="1">
                          <button type="submit" name="follow-btn" id="follow-btn" form="follow-form">Followed</button>
                          <?php
                                }
                              }
                              }else{
                          ?>
                              <input type="hidden" id="isClicked" name="isClicked" value="1">
                              <button type="submit" name="follow-btn" id="follow-btn" form="follow-form">Followed</button>
                          <?php
                              }
                            }
                          ?>
                        </form>
                        <?php
                          }else{
                        ?>
                        <small class="text-muted"><a href="login.php?type=4&username=<?=$username?>" style="color: #0563bb;">Login</a> to follow</small>
                        <?php } ?>
                      </li>
                      <?php
                        if($followCheck == 1 || $user['id_postprivacy'] == 0){
                          if($user['id_postprivacy'] == 0){
                            $follow['status'] = 1;
                          }
                          if($follow['status'] == 1){
                      ?>
                      <br>
                      <br>
                      <li><a href="seeFollowingList.php?username=<?=$username?>" class="normal">Following</a></li>
                      <li><a href="seeFollowersList.php?username=<?=$username?>" class="normal">Followers</a></li>
                      <br>
                      <br>
                      <li><a href="seeLikedPosts.php?username=<?=$username?>" class="normal">Liked posts</a></li>
                      <li><a href="seePostAndReply.php?username=<?=$username?>" class="normal">Posts & Replies</a></li>
                      <br>
                      <?php }} ?>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
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
  <a href="form/createPost.php" class="create-post d-flex align-items-center justify-content-center"><i class="bi bi-plus"></i></a>

  <!-- Vendor JS Files -->
  <script src="/assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="/assets/vendor/aos/aos.js"></script>
  <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="/assets/vendor/typed.js/typed.min.js"></script>
  <script src="/assets/vendor/waypoints/noframework.waypoints.js"></script>

  <!-- Template Main JS File -->
  <script src="/assets/js/main.js"></script>
  <script src="/assets/js/header.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script type="text/javascript">
  $(document).ready(function() {
    const followButtons = document.querySelectorAll('#follow-btn');

    let isClicked = false;
  // Loop melalui setiap tombol "Like"
  followButtons.forEach(followButton => {
    // Attach click event handler to all submit buttons within the formContainer
    followButton.addEventListener('click', (event) => {
      event.preventDefault();
      // Find the parent form of the clicked button
      var form = $('#follow-btn').closest("form");
      var privacy = form.find("#privacy").val();
      var requestStatus = form.find("#requestStatus").val();
      var clicked = form.find("#isClicked").val();
      if(privacy == 1 && requestStatus == 1){
        var confirmed = confirm('Are you sure? You will have to request again after unfollowing');
        if(confirmed){
          // Get form values within the parent form
          var follower = form.find("#follower").val();
          var followed = form.find("#followed").val();
          var followedName = form.find("#followedName").val();

          // Create an object with the form data
          var formData = {
              follower: follower,
              followed: followed
            };
            
            // Send the data to the server using AJAX
            $.ajax({
                url: "followAction.php", // Replace with your server-side script URL
                type: "POST",
                data: formData,
                success: function(response) {
                }
            });
            if(clicked == 1){
                console.log(clicked);
                if (!isClicked) {
                    // Change the button text and style when it is clicked again
                    followButton.textContent = 'Follow';
                } else {
                    // Change the followButton text and style when it is clicked
                    if(privacy == 0){
                    followButton.textContent = 'Followed';
                    }else{
                    followButton.textContent = 'Requested';
                    }
                }
            }else{
                if (isClicked) {
                    // Change the followButton text and style when it is clicked again
                    followButton.textContent = 'Follow';
                } else {
                    // Change the followButton text and style when it is clicked
                    if(privacy == 0){
                    followButton.textContent = 'Followed';
                    }else{
                    followButton.textContent = 'Requested';
                    }
                }
            }
            // Toggle the button state
            isClicked = !isClicked;
            window.location.href = 'seeProfile.php?username='+followedName;
        }
      }else{
        // Get form values within the parent form
          var follower = form.find("#follower").val();
          var followed = form.find("#followed").val();

          // Create an object with the form data
          var formData = {
              follower: follower,
              followed: followed
          };

          // Send the data to the server using AJAX
          $.ajax({
            url: "followAction.php", // Replace with your server-side script URL
            type: "POST",
            data: formData,
            success: function(response) {
            }
          });
          if(clicked == 1){
                console.log(clicked);
                if (!isClicked) {
                    // Change the button text and style when it is clicked again
                    followButton.textContent = 'Follow';
                } else {
                    // Change the followButton text and style when it is clicked
                    if(privacy == 0){
                    followButton.textContent = 'Followed';
                    }else{
                    followButton.textContent = 'Requested';
                    }
                }
            }else{
                if (isClicked) {
                    // Change the followButton text and style when it is clicked again
                    followButton.textContent = 'Follow';
                } else {
                    // Change the followButton text and style when it is clicked
                    if(privacy == 0){
                    followButton.textContent = 'Followed';
                    }else{
                    followButton.textContent = 'Requested';
                    }
                }
            }
            // Toggle the button state
            isClicked = !isClicked;
      }
    });
  });
});

// Add a click event listener to the button
</script>

</body>

</html>
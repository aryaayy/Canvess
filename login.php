<?php
session_start();
// Koneksi ke database
include('config.php');

global $conn;

$id_user = "";
$email = "";
$password = "";
if(isset($_GET['id_mainchat'])){
	$_SESSION['id_mainchat'] = $_GET['id_mainchat'];
	$_SESSION['type'] = $_GET['type'];
}else if(isset($_GET['type'])){
	$_SESSION['type'] = $_GET['type'];
}
// Memproses data login
if (isset($_POST['signin'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM t_user WHERE email = '$email' AND password = MD5('$password')";
    $result = mysqli_fetch_assoc(mysqli_query($conn, $query));

    if (isset($result['id_user'])) {
		$_SESSION['session_id_user'] = $result['id_user'];
		if($_SESSION['session_id_user'] != 16){

			if($_SESSION['type'] == 1){
				header("Location: index.php");
			}else if($_SESSION['type'] == 2){
				header("Location: form/createPost.php");
			}else if($_SESSION['type'] == 3){
				$id_mainchat = $_SESSION['id_mainchat'];
				header("Location: post.php?id_mainchat=$id_mainchat");
			}
		}else{
			header("Location: admin/indexAdmin.php");
		}
		exit();
		
    } else {
        echo "
        <script>
        alert('Wrong email or password!');
        </script>
        ";
    }
}else if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);
	
    if ($password == $cpassword) {
        $sql = "SELECT * FROM t_user WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        if (!$result->num_rows > 0) {
			$sql = "SELECT * FROM t_user WHERE username='$username'";
			$result = mysqli_query($conn, $sql);
			if(!$result->num_rows > 0){

				$sql = "INSERT INTO t_user (email, username, password) VALUES ('$email', '$username', '$password')";
				$result = mysqli_query($conn, $sql);

				$isSucceed = mysqli_affected_rows($conn);
				if ($isSucceed > 0) {
					$sql = "SELECT * FROM t_user WHERE email='$email'";
					$result = mysqli_fetch_assoc(mysqli_query($conn, $sql));

					$_SESSION['session_id_user'] = $result['id_user'];
			
					if($_SESSION['type'] == 1){
						header("Location: index.php");
					}else if($_SESSION['type'] == 2){
						header("Location: form/createPost.php");
					}else if($_SESSION['type'] == 3){
						$id_mainchat = $_SESSION['id_mainchat'];
						header("Location: post.php?id_mainchat=$id_mainchat");
					}else{
						header('Location: index.php');
					}
					exit();
				} else {
					echo "<script>alert('Woops! Something went wrong.')</script>";
				}
			} else {
				echo "<script>alert('Woops! Email has been used for another account.')</script>";
			}
		} else{
			echo "<script>alert('Woops! Username has been used.')</script>";
		}
    } else if($password != $cpassword){
		echo "<script>alert('Woops! Password does not match.')</script>";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>Canvess</title>
	<meta content="" name="description">
	<meta content="" name="keywords">

	<!-- Favicons -->
	<link href="assets/img/canvess.png" rel="icon">
	<link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

	<style>
		@import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');
		
		* {
			box-sizing: border-box;
		}
		
		body {
			background: #f6f5f7;
			display: flex;
			justify-content: center;
			align-items: center;
			flex-direction: column;
			font-family: 'Montserrat', sans-serif;
			height: 100vh;
			margin: -20px 0 50px;
		}
		
		h1 {
			font-weight: bold;
			margin: 0;
		}
		
		h2 {
			text-align: center;
		}
		
		p {
			font-size: 14px;
			font-weight: 100;
			line-height: 20px;
			letter-spacing: 0.5px;
			margin: 20px 0 30px;
		}
		
		span {
			font-size: 12px;
		}
		
		a {
			color: #333;
			font-size: 14px;
			text-decoration: none;
			margin: 15px 0;
		}
		
		button {
			border-radius: 20px;
			border: 1px solid #0563bb;
			background-color: #0563bb;
			color: #FFFFFF;
			font-size: 12px;
			font-weight: bold;
			padding: 12px 45px;
			letter-spacing: 1px;
			text-transform: uppercase;
			transition: transform 80ms ease-in;
		}
		
		button:active {
			transform: scale(0.95);
		}
		
		button:focus {
			outline: none;
		}
		
		button.ghost {
			background-color: transparent;
			border-color: #FFFFFF;
		}
		
		form {
			background-color: #FFFFFF;
			display: flex;
			align-items: center;
			justify-content: center;
			flex-direction: column;
			padding: 0 50px;
			height: 100%;
			text-align: center;
		}
		
		input {
			background-color: #eee;
			border: none;
			padding: 12px 15px;
			margin: 8px 0;
			width: 100%;
		}
		
		.container {
			background-color: #fff;
			border-radius: 10px;
			box-shadow: 0 14px 28px rgba(0,0,0,0.25), 
					0 10px 10px rgba(0,0,0,0.22);
			position: relative;
			overflow: hidden;
			width: 768px;
			max-width: 100%;
			min-height: 480px;
		}
		
		.form-container {
			position: absolute;
			top: 0;
			height: 100%;
			transition: all 0.6s ease-in-out;
		}
		
		.sign-in-container {
			left: 0;
			width: 50%;
			z-index: 2;
		}
		
		.container.right-panel-active .sign-in-container {
			transform: translateX(100%);
		}
		
		.sign-up-container {
			left: 0;
			width: 50%;
			opacity: 0;
			z-index: 1;
		}
		
		.container.right-panel-active .sign-up-container {
			transform: translateX(100%);
			opacity: 1;
			z-index: 5;
			animation: show 0.6s;
		}
		
		@keyframes show {
			0%, 49.99% {
				opacity: 0;
				z-index: 1;
			}
			
			50%, 100% {
				opacity: 1;
				z-index: 5;
			}
		}
		
		.overlay-container {
			position: absolute;
			top: 0;
			left: 50%;
			width: 50%;
			height: 100%;
			overflow: hidden;
			transition: transform 0.6s ease-in-out;
			z-index: 100;
		}
		
		.container.right-panel-active .overlay-container{
			transform: translateX(-100%);
		}
		
		.overlay {
			background: #FF416C;
			background: -webkit-linear-gradient(to right, #0563bb, #80b5e7);
			background: linear-gradient(to right, #0563bb, #80b5e7);
			background-repeat: no-repeat;
			background-size: cover;
			background-position: 0 0;
			color: #FFFFFF;
			position: relative;
			left: -100%;
			height: 100%;
			width: 200%;
			transform: translateX(0);
			transition: transform 0.6s ease-in-out;
		}
		
		.container.right-panel-active .overlay {
			transform: translateX(50%);
		}
		
		.overlay-panel {
			position: absolute;
			display: flex;
			align-items: center;
			justify-content: center;
			flex-direction: column;
			padding: 0 40px;
			text-align: center;
			top: 0;
			height: 100%;
			width: 50%;
			transform: translateX(0);
			transition: transform 0.6s ease-in-out;
		}
		
		.overlay-left {
			transform: translateX(-20%);
		}
		
		.container.right-panel-active .overlay-left {
			transform: translateX(0);
		}
		
		.overlay-right {
			right: 0;
			transform: translateX(0);
		}
		
		.container.right-panel-active .overlay-right {
			transform: translateX(20%);
		}
		
		.social-container {
			margin: 20px 0;
		}
		
		.social-container a {
			border: 1px solid #DDDDDD;
			border-radius: 50%;
			display: inline-flex;
			justify-content: center;
			align-items: center;
			margin: 0 5px;
			height: 40px;
			width: 40px;
		}
	</style>
</head>
<body>

	<section class="login-form">
	<div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="login.php" method="POST" id="form-signup"> <!-- Tambahkan action dan method pada form -->
                <h1>Create Account</h1>
                <input type="text" placeholder="Username" name="username" onkeypress="return event.charCode != 32" required/> <!-- Tambahkan name untuk masing-masing input -->
                <input type="email" placeholder="Email" name="email" required/>
                <input type="password" placeholder="Password" name="password" required/>
                <input type="password" placeholder="Confirm Password" name="cpassword" required/>
                <button type="submit" name="signup" form="form-signup">Sign Up</button> <!-- Tambahkan name pada button -->
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="login.php" method="POST" id="form-signin"> <!-- Tambahkan action dan method pada form -->
                <h1>Sign in</h1>
                <input type="email" placeholder="Email" name="email" required/> <!-- Tambahkan name untuk masing-masing input -->
                <input type="password" placeholder="Password" name="password" required/>
                <!-- <a href="#">Forgot your password?</a> -->
                <button type="submit" name="signin" form="form-signin">Sign In</button> <!-- Tambahkan name pada button -->
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
					<h1>Hello, Friend!</h1>
					<p>Have an account?</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
					<h1>Welcome Back!</h1>
					<p>Don't have an account?</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
	</section>

	<script>
		const signUpButton = document.getElementById('signUp');
		const signInButton = document.getElementById('signIn');
		const container = document.getElementById('container');
		
		signUpButton.addEventListener('click', () => {
			container.classList.add("right-panel-active");
		});
		
		signInButton.addEventListener('click', () => {
			container.classList.remove("right-panel-active");
		});
	</script>
</body>
</html>

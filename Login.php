<?php
if (isset($_POST["submit"])) {
  $email = $_POST['email'];
  $password = $_POST['mtp'];
  $con = mysqli_connect("localhost","Root","","Application");

  if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $sql = "SELECT * FROM apprenants WHERE email = '$email'";
  $result = mysqli_query($con, $sql);

  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    if ($password == $row['mtp']) {
        session_start();
        $_SESSION['id_apprenant'] = $row['id_apprenant'];
        header("Location:index.php");
        exit();
      
    } else {
      echo "Invalid username or password";
    }
  } else {
    echo "Invalid username or password";
  }

  mysqli_close($con);
}
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="asia/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="asia/css/style.css">
</head>
<body>

ÒÒ

    <div class="main">

        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="asia/images/signin-image.jpg" alt="sing up image"></figure>
                        <a href="SignUp.php" class="signup-image-link">Create an account</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" class="register-form" id="login-form">
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="email" id="your_name" placeholder="Your Email"/>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="mtp" id="your_pass" placeholder="Password"/>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="submit" id="signin" class="form-submit" value="Log in"/>
                            </div>
                        </form>
                        <div class="social-login">
                            <span class="social-label">Or login with</span>
                            <ul class="socials">
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="asia/jquery/jquery.min.js"></script>
    <script src="asia/js/main.js"></script>
</body>
</html>
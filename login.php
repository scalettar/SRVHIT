<?php
require_once 'dbconnect.php';

if($user->is_loggedin()){
  $user->redirect('home.php');
}

if(isset($_POST['btn-login'])){
  $useremail = $_POST['useremail'];
  $userpw = $_POST['userpw'];

  if($user->login($useremail, $userpw)){
    $user->redirect('home.php');
  }
  else{
    $error = "Incorrect email/password combination.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SRVHIT - Login</title>

    <link href="css/bundle.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <!-- start: header -->
    <header class="container">
      <div class="row">

        <!-- start: brand -->
        <div id="brand" class="columns">
          <a href="index.php">
            <img src="images/srvhit_logo.png" alt="">
          </a>
        </div>
        <!-- end: brand -->

        <!-- start: desktop nav -->
        <nav>
          <img class="mobile-only" src="images/icon_menu.svg" alt="">

          <ul class="desktop-menu desktop-only">
            <li><a href="">Contact Us</a></li>
            <li><a href="login.php">Log In</a></li>
          </ul>
        </nav>
        <!-- start: desktop nav -->

      </div>

      <!-- start: mobile nav -->
      <div class="container mobile-only">
        <div class="row">

          <ul class="mobile-menu">
            <li><a href="">Contact Us</a></li>
            <li><a href="login.php">Log In</a></li>
          </ul>

        </div>
      </div>
      <!-- start: mobile nav -->

    </header>
    <!-- end: header -->

    <div class="container">
      <div class="row">

        <!-- start: Login form -->
        <div class="form columns">
          <h2>Log In</h2>

<?php
            if(isset($_GET['registered']) && $_GET['registered']=="true"){
?>
              <div style=" background-color:#FF0000; font-family: verdana; color:#FFFFFF; text-align:center;">Registration successful.</div>
<?php
            }
?>
<?php
            if(isset($error)){
?>
              <div style=" background-color:#FF0000; font-family: verdana; color:#FFFFFF; text-align:center;">
                <?php echo $error; ?>
              </div>
<?php
            }
?>
          <form action = "login.php" method = "post">
            <input type="email" name="useremail" placeholder="Enter your email" required>
            <input type="password" name="userpw" placeholder="Enter your password" required>
            <input type="submit" name="btn-login" value="Login" class="button">
          </form>

          <a href="register.php" class="link">New Student? Register</a>
          <a href="register-b.php" class="link">New Business? Register</a>
          <a href="forgotpassword.php" class="link">Forgot Password?</a>
        </div>
        <!-- end: Login form -->

      </div>
    </div>

    <!-- start: footer -->
    <footer>
      <p>© Copyright SRVHIT 2017</p>
    </footer>
    <!-- end: footer -->

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/scripts.js"></script>

  </body>
</html>

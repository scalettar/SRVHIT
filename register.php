<?php
require_once 'dbconnect.php';

if($user->is_loggedin()!=""){
  $user->redirect('home.php');
}

if($user->is_loggedin()!=""){
  $user->redirect('home.php');
}

if(isset($_POST['btn-register'])){
    $useremail = !empty($_POST['useremail']) ? trim($_POST['useremail']) : null;
    $userpw = !empty($_POST['userpw']) ? trim($_POST['userpw']) : null;
    $firstname = !empty($_POST['firstname']) ? trim($_POST['firstname']) : null;
    $lastname = !empty($_POST['lastname']) ? trim($_POST['lastname']) : null;
    $userpwcheck = !empty($_POST['userpwcheck']) ? trim($_POST['userpwcheck']) : null;
<<<<<<< HEAD
    $isbusiness = $_POST['isbusiness'];
=======
    $acctype = !empty($_POST['acctype']) ? trim($_POST['acctype']) : null;
>>>>>>> origin/master

    //try{
      $stmt = $conn->prepare("SELECT useremail FROM users WHERE useremail=:useremail");
      $stmt->execute(array(':useremail'=>$useremail));
      $row=$stmt->fetch(PDO::FETCH_ASSOC);

      if($row['useremail']==$useremail){
        $error[] = "email already in use";
      }
      elseif ($userpw!=$userpwcheck) {
        $error[] = "passwords do not match";
      }
      else{
<<<<<<< HEAD
        if($user->register($firstname,$lastname,$useremail,$userpw, $isbusiness)){
=======
        if($user->register($firstname,$lastname,$useremail,$userpw,$acctype)){
>>>>>>> origin/master
          $user->redirect('login.php'); //probably should tell the user they are registered first
        }
      }
    //}
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SRVHIT - Register</title>

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
            <li><a href="logged-in-talent.php">For Students</a></li>
            <li><a href="logged-in-business.php">For Businesses</a></li>
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
            <li><a href="logged-in-talent.php">For Students</a></li>
            <li><a href="logged-in-business.php">For Businesses</a></li>
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

        <!-- start: register form -->
        <div class="form columns">
          <h2>Register</h2>

<?php
          if(isset($error)){
            foreach($error as $error)
            {
?>
              <div class="alert alert-danger">
                <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
              </div>
<?php
            }
          }
          else if(isset($_GET['joined']))
          {
?>
            <div class="alert alert-info">
              <i class="glyphicon glyphicon-log-in"></i> &nbsp; Successfully registered <a href='index.php'>login</a> here
            </div>
<?php
          }
?>

          <form action="register.php" method="post">
            <input type="text" name="firstname" placeholder="First Name" required>
            <input type="text" name="lastname" placeholder="Last Name" required>
            <input type="email" name="useremail" placeholder="Email Address" required>
            <input type="text" name="zip" placeholder="Zip Code" required>
            <input type="password" name="userpw" placeholder="Password" required>
            <input type="password" name="userpwcheck" placeholder="Confirm Password" required>
            This account will belong to a business
            <input type="hidden" name="isbusiness" value="0">
            <input type="checkbox" name="isbusiness" value="1">
            <input type="submit" name="btn-register" value="Register" class="button">
          </form>

          <a href="forgot-password.php" class="link">Forgot Password?</a>
        </div>
        <!-- end: register form -->

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

<?php
require_once 'dbconnect.php';

if($user->is_loggedin()!=""){
  $user->redirect('home.php');
}

if(isset($_POST['btn-register'])){
    $useremail = !empty($_POST['useremail']) ? trim($_POST['useremail']) : null;
    $userpw = !empty($_POST['userpw']) ? trim($_POST['userpw']) : null;
    $firstname = !empty($_POST['firstname']) ? trim($_POST['firstname']) : null;
    $lastname = !empty($_POST['lastname']) ? trim($_POST['lastname']) : null;
    $userpwcheck = !empty($_POST['userpwcheck']) ? trim($_POST['userpwcheck']) : null;

    //try{
      $stmt = $conn->prepare("SELECT useremail FROM users WHERE useremail=:useremail");
      $stmt->execute(array(':useremail'=>$useremail));
      $row=$stmt->fetch(PDO::FETCH_ASSOC);

      if($row['useremail']==$useremail){
        $error[] = "Email already in use.";
      }
      elseif ($userpw!=$userpwcheck) {
        $error[] = "Passwords do not match.";
      }
      else{
        if($user->register($firstname,$lastname,$useremail,$userpw)){
          $user->redirect('login.php?registered=true');
        }
      }
    //}
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
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

        <!-- start: register form -->
        <div class="form columns">
          <h2>Register</h2>

<?php
          if(isset($error)){
            foreach($error as $error)
            {
?>
              <div style=" background-color:#FF0000; font-family: verdana; color:#FFFFFF; text-align:center;">
                <?php echo $error; ?>
              </div>
<?php
            }
          }
?>
          <form action="register.php" method="post">
            <input type="text" name="firstname" value="<?php echo isset($_POST['firstname']) ? $_POST['firstname'] : ""?>" placeholder="First Name" required>
            <input type="text" name="lastname" value="<?php echo isset($_POST['lastname']) ? $_POST['lastname'] : ""?>" placeholder="Last Name" required>
            <input type="email" name="useremail" value="<?php echo isset($_POST['useremail']) ? $_POST['useremail'] : ""?>" placeholder="Email Address" required>
            <input type="text" name="zip" value="<?php echo isset($_POST['zip']) ? $_POST['zip'] : ""?>" placeholder="Zip Code" required>
            <input type="password" name="userpw" placeholder="Password" required>
            <input type="password" name="userpwcheck" placeholder="Confirm Password" required>
            <!-- <input type="hidden" name="isbusiness" value="0">
            <div style="text-align:left; color:#564e46; font-size:18px;">
              <input id="box" type="checkbox" name="isbusiness" value="1">
              <label for="box">Check this box if the account will belong to a business</label>
            <div/>
            <br> -->
            <input type="submit" name="btn-register" value="Register" class="button">
          </form>

          <a href="login.php" class="link">Already Registered? Log In</a>
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

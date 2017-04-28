<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SRVHIT - Home</title>

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
      <div class="row landing">

        <!-- start: for students -->
        <div id="students" class="columns">
          <div class="icon">
            <img src="images/icon_students.svg" alt="">
          </div>

          <h2>Students</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et sagittis orci, eu lacinia massa. Proin in elementum quam. Mauris facilisis aliquam lorem ut luctus.</p>

          <a href="register.php" class="button">Find Opportunity</a>
        </div>
        <!--end: for students -->

        <!-- start: separator -->
        <div id="or" class="columns">
          <span>or</span>
        </div>
        <!-- end: separator -->

        <!-- start: for businesses -->
        <div id="businesses" class="columns">
          <div class="icon">
            <img src="images/icon_businesses.svg" alt="">
          </div>

          <h2>Businesses</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et sagittis orci, eu lacinia massa. Proin in elementum quam. Mauris facilisis aliquam lorem ut luctus.</p>

          <a href="register.php" class="button">Find Talent</a>
        </div>
        <!-- end: for businesses -->

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

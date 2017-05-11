<?php
include_once 'dbconnect.php';

if(!$user->is_loggedin()){
  $user->redirect('index.php');
}

$currentid = $_SESSION['user_session'];
$stmt = $conn->prepare("SELECT * FROM users WHERE userid=:userid");
$stmt->execute(array(":userid"=>$currentid));
$currentRow=$stmt->fetch(PDO::FETCH_ASSOC);
?>

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
          <div class="logo">
            <a href="home.php">
              <img src="images/srvhit_logo.png" alt="">
            </a>
            <span class="sep desktop-only"></span>
          </div>

          <!-- start: search desktop -->
          <div class="input-wrapper desktop-only">
            <input class="search" type="text" placeholder="Search">
            <input class="search-button" type="button" value=" " onclick="location.href='search.php';">
          </div>
          <!-- end: search desktop -->

        </div>
        <!-- end: brand -->

        <!-- start: desktop nav -->
        <nav>
          <img class="mobile-only" src="images/icon_menu.svg" alt="">

          <ul class="desktop-menu desktop-only">
            <li><a href="logout.php?logout=true">Logout (<?php print($currentRow['useremail']);?>)</a></li>
          </ul>
        </nav>
        <!-- end: desktop nav -->

      </div>

      <div class="container mobile-only">
        <div class="row">

          <!-- Start: mobile nav -->
          <ul class="mobile-menu">
            <li><a href="logout.php?logout=true">Logout (<?php print($currentRow['useremail']);?>)</a></li>
          </ul>
          <!-- end: mobile nav -->

        </div>
      </div>

      <!-- start: search mobile -->
      <div class="container search mobile-only">
        <div class="row">

          <div class="input-wrapper mobile">
            <input class="search mobile-only" type="text" placeholder="Search">
            <input class="search-button mobile-only" type="button" value=" " onclick="location.href='search.php';">
          </div>

        </div>
      </div>
      <!-- end: search mobile -->

    </header>
    <!-- end: header -->

    <div id="logged-in" class="container">
      <div class="row">

        <!-- start: student profile -->
        <div id="student-profile" class="columns">

          <!-- start: profile info -->
          <div class="profile-info">

            <div class="quick-links">
              <a href="edit.php"><img src="images/icon_edit.svg" alt="">
            </div>

            <div class="avatar">
              <img src="images/avatar.png" alt="">
            </div>

            <div class="bio">
              <h4><?php print($currentRow['firstname']); print " "; print($currentRow['lastname']);?></h4>
              <p class="location"><span class="icon-location"><img src="images/icon_location.svg" alt=""></span>Sacramento, CA</p>
            </div>

          </div>
          <!-- start: profile info -->

          <ul class="hint">
            <li>Database Management</li>
            <li>Game Development</li>
            <li>Javascript</li>
            <li>Python</li>
            <li>Ruby on Rails</li>
            <li>PHP</li>
          </ul>

          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pulvinar libero sit amet magna congue facilisis. Maecenas pellentesque risus nec dui volutpatLorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pulvinar libero sit amet magna congue facilisis. Maecenas pellentesque risus nec dui volutpatLorem ipsum dolor sit amet.</p>

        </div>
        <!-- end - student profile -->

        <!-- start: student favorites -->
        <div id="student-favorites" class="columns">
          <h4>Favorites</h4>

          <ul class="lists">

            <li>
              <div class="avatar">
                <img src="images/icon_businesses.svg" alt="">
              </div>
              <div class="bio">
                <span class="favorited">
                  <img src="images/favorited.svg" alt="">
                  <img src="images/favorite.svg" alt="" style="display: none;">
                </span>
                <h3>Business Name</h3>
                <p class="location"><span class="icon-location"><img src="images/icon_location.svg" alt=""></span>Sacramento, CA</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              </div>
            </li>

            <li>
              <div class="avatar">
                <img src="images/icon_businesses.svg" alt="">
              </div>
              <div class="bio">
                <span class="favorited">
                  <img src="images/favorited.svg" alt="">
                  <img src="images/favorite.svg" alt="" style="display: none;">
                </span>
                <h3>Business Name</h3>
                <p class="location"><span class="icon-location"><img src="images/icon_location.svg" alt=""></span>Sacramento, CA</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              </div>
            </li>

            <li>
              <div class="avatar">
                <img src="images/icon_businesses.svg" alt="">
              </div>
              <div class="bio">
                <span class="favorited">
                  <img src="images/favorited.svg" alt="">
                  <img src="images/favorite.svg" alt="" style="display: none;">
                </span>
                <h3>Business Name</h3>
                <p class="location"><span class="icon-location"><img src="images/icon_location.svg" alt=""></span>Sacramento, CA</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              </div>
            </li>

            <li>
              <div class="avatar">
                <img src="images/icon_businesses.svg" alt="">
              </div>
              <div class="bio">
                <span class="favorited">
                  <img src="images/favorited.svg" alt="">
                  <img src="images/favorite.svg" alt="" style="display: none;">
                </span>
                <h3>Business Name</h3>
                <p class="location"><span class="icon-location"><img src="images/icon_location.svg" alt=""></span>Sacramento, CA</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              </div>
            </li>

          </ul>
        </div>
        <!-- end: student favorites -->

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

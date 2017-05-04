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

    <title>SRVHIT - Search</title>

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
            <a href="index.php">
              <img src="images/srvhit_logo.png" alt="">
            </a>
            <span class="sep desktop-only"></span>
          </div>

          <!-- start: search desktop -->
          <div class="input-wrapper desktop-only">
            <input class="search" type="text" placeholder="Search for search">
            <input class="search-button" type="button" value=" " onclick="location.href='search.php';">
          </div>
          <!-- end: search desktop -->

        </div>
        <!-- end: brand -->

        <!-- start: desktop nav -->
        <nav>
          <img class="mobile-only" src="images/icon_menu.svg" alt="">

          <ul class="desktop-menu desktop-only">
            <!-- <li><a href="logged-in-talent.php">For Students</a></li>
            <li><a href="logged-in-business.php">For Businesses</a></li>
            <li><a href="">Contact Us</a></li> -->
            <li><a href="index.php">Logout (<?php print($currentRow['useremail']);?>)</a></li>
          </ul>

        </nav>
        <!-- end: desktop nav -->

      </div>

      <div class="container mobile-only">
        <div class="row">

          <!-- Start: mobile nav -->
          <ul class="mobile-menu">
            <li><a href="index.php">Logout (<?php print($currentRow['useremail']);?>)</a></li>
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

        <!-- start: search results -->
        <div id="search" class="columns">
          <h4>Search</h4>

          <form>

            <fieldset>
              <label>Position</label>
              <div class="custom-select">
                <img src="images/chevron.svg" alt="" class="chevron">
                <select id="position">
                  <option value="all">All</option>
                  <option value="full-time">Full time</option>
                  <option value="part-time">Part time</option>
                  <option value="telecommute">Telecommute</option>
                </select>
              </div>
            </fieldset>

            <fieldset>
              <label>Location</label>
              <div class="custom-select">
                <img src="images/chevron.svg" alt="" class="chevron">
                <select>
                  <option value="all">All</option>
                  <option value="sacramento">Sacramento</option>
                  <option value="davis">Davis</option>
                  <option value="roseville">Roseville</option>
                </select>
              </div>
            </fieldset>

            <fieldset>
              <label>Terms</label>
              <div class="custom-select">
                <img src="images/chevron.svg" alt="" class="chevron">
                <select id="terms">
                  <option value="all">All</option>
                  <option value="full-time">Full time</option>
                  <option value="part-time">Part time</option>
                </select>
              </div>
            </fieldset>
          </form>

          <ul id="search-list" class="lists two-column">

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
        <!-- end: search results -->

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

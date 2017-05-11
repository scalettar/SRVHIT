<?php
require_once 'dbconnect.php';

if(!$user->is_loggedin()){
  $user->redirect('index.php');
}

$currentid = $_SESSION['user_session'];
$stmt = $conn->prepare("SELECT * FROM users WHERE userid=:userid");
$stmt->execute(array(":userid"=>$currentid));
$currentRow=$stmt->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['btn-edit'])){
  $userpw = !empty($_POST['userpw']) ? trim($_POST['userpw']) : null;
  $userpwcheck = !empty($_POST['userpwcheck']) ? trim($_POST['userpwcheck']) : null;
  $useremail = !empty($_POST['useremail']) ? trim($_POST['useremail']) : null;
//  $tagname = !empty($_POST['tagname']) ? trim($_POST['tagname']) : null;

  if($_POST['userpw'] != '' && $userpw!=$userpwcheck) {
      $error[] = "Passwords do not match.";
  }
  else{
      if($user->edit($userpw, $useremail)){
          $user->redirect('edit.php?edit=true');
      }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SRVHIT - Edit Profile</title>

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
    </header>
    <!-- end: header -->

    <div id="logged-in" class="container">
      <div class="row">

        <!-- start: edit form -->
        <div class="form columns">
          <h2>Edit Profile</h2>

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
<?php
            if(isset($_GET['edit']) && $_GET['edit']=="true"){
?>
              <div style=" background-color:#FF0000; font-family: verdana; color:#FFFFFF; text-align:center;">Update Successful.</div>
<?php
            }
?>
          <form action="edit.php" method="post">
            <fieldset>
              <label>Add Tag</label>
              <div class="custom-select">
                <img src="images/chevron.svg" alt="" class="chevron">
                <select id="tags" name="tags">
                  <option name="tagname">None</option>;
<?php
                  $smt = $conn->prepare("select tagname from tags");
                  $smt->execute();
                  $result = $smt->fetchAll();
                  foreach($result as $row):
?>
                    <option name="tagname"><?=$row["tagname"]?></option>';
<?php
                  endforeach
?>
                </select>
              </div>
            </fieldset>
            <fieldset>
              <label>Remove Tag</label>
              <div class="custom-select">
                <img src="images/chevron.svg" alt="" class="chevron">
                <select id="tags" name="tags">
                  <option name="tagname_rem">None</option>;
<?php
                  $smt = $conn->prepare("select tagname from tags");
                  $smt->execute();
                  $result = $smt->fetchAll();
                  foreach($result as $row):
?>
                    <option name="tagname_rem"><?=$row["tagname"]?></option>';
<?php
                  endforeach
?>
                </select>
              </div>
            </fieldset>
            <input type="email" name="useremail" placeholder="New Email Address">
            <input type="password" name="userpw" placeholder="New Password">
            <input type="password" name="userpwcheck" placeholder="Confirm New Password">
            <input type="submit" name="btn-edit" value="Update" class="button">
          </form>

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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/scripts.js"></script>

  </body>
</html>

<?php
include_once 'dbconnect.php';

if(!$user->is_loggedin()){
  $user->redirect('index.php');
}

// Current profile's info
$userid = $_GET['user'];
$stmt = $conn->prepare("SELECT * FROM users WHERE userid=:userid");
$stmt->execute(array(":userid"=>$userid));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

// Logged in user's info
$currentid = $_SESSION['user_session'];
$stmt = $conn->prepare("SELECT * FROM users WHERE userid=:userid");
$stmt->execute(array(":userid"=>$currentid));
$currentRow=$stmt->fetch(PDO::FETCH_ASSOC);

/**
 * Start email code
 */
$msg = '';
//Don't run this unless we're handling a form submission
if (array_key_exists('email', $_POST)) {
    date_default_timezone_set('Etc/UTC');
    require 'email/PHPMailerAutoload.php';
    //Create a new PHPMailer instance
    $mail = new PHPMailer;
    //Tell PHPMailer to use SMTP - requires a local mail server
    //Faster and safer than using mail()
    $mail->isSMTP();
    $mail->Host = 'localhost';
    $mail->Port = 25;
    //Use a fixed address in your own domain as the from address
    //**DO NOT** use the submitter's address here as it will be forgery
    //and will cause your messages to fail SPF checks
    $mail->setFrom('srvhit.email@gmail.com', 'SRVHIT');
    //Send the message to yourself, or whoever should receive contact for submissions
    $mail->addAddress($userRow['useremail'], $userRow['lastname']);
    //Put the submitter's address in a reply-to header
    //This will fail if the address provided is invalid,
    //in which case we should ignore the whole request
    if ($mail->addReplyTo($currentRow['useremail'], $currentRow['useremail'])) {
        $mail->$Subject = $_POST['subject'];
        //Keep it simple - don't use HTML
        $mail->isHTML(false);
        //Build a simple message body
        $mail->Body = <<<EOT
Email: {$currentRow['useremail']}
Name: {$currentRow['useremail']}
Message: {$_POST['message']}
EOT;
        //Send the message, check for errors
        if (!$mail->send()) {
            //The reason for failing to send will be in $mail->ErrorInfo
            //but you shouldn't display errors to users - process the error, log it on your server.
            $msg = 'Sorry, something went wrong. Please try again later.';
        } else {
            $msg = 'Message sent! Thanks for contacting us.';
        }
    } else {
        $msg = 'Invalid email address, message ignored.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SRVHIT - Send Email</title>

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
            <li><a href="logout.php?logout=true">Logout (<?php print($userRow['useremail']);?>)</a></li>
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
            <li><a href="logout.php?logout=true">Logout (<?php print($userRow['useremail']);?>)</a></li>
          </ul>

        </div>
      </div>
      <!-- start: mobile nav -->

    </header>
    <!-- end: header -->

    <div class="container">
      <div class="row">

        <!-- start: forgot password form-->
        <div class="form columns">
          <form>
            <h2>Compose Email</h2>
            <?php if (!empty($msg)) {
                echo "<h2>$msg</h2>";
            } ?>
            <form method="POST">
                <label for="name">Name: <input type="text" name="name" id="name"></label><br>
                <label for="subject">Subject: <input type="text" name="subject" id="subject"></label><br>
                <label for="message">Message: <textarea name="message" id="message" rows="8" cols="20"></textarea></label><br>
                <input type="submit" value="Send">
            </form>
          </form>
        </div>
        <!-- start: forgot password form -->

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

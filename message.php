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

// include phpmailer class
require_once 'email/PHPMailerAutoload.php';
// creates object
$mail = new PHPMailer(true);

if(isset($_POST['btn-send']))
{
 $full_name = $userRow['firstname'];
 $senderid = $currentRow['userid'];
 $email = $userRow['useremail'];
 $subject = strip_tags($_POST['subject']);
 $usermessage = strip_tags($_POST['usermessage']);

 // HTML email starts here

 $message  = "<html><body>";

 $message .= "<table width='100%' bgcolor='#e0e0e0' cellpadding='0' cellspacing='0' border='0'>";

 $message .= "<tr><td>";

 $message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";

 $message .= "<thead>
    <tr height='80'>
     <th colspan='4' style='background-color:#00573b; border-bottom:solid 1px #bdbdbd; font-family:Verdana, Geneva, sans-serif; color:#fff; font-size:34px;' >SRVHIT</th>
    </tr>
    </thead>";

 $message .= "<tbody>
    <tr>
     <td colspan='4' style='padding:15px; background-color:#e6e2d0'>
      <p style='background-color:#e6e2d0; color:#564e46; font-size:15px;'>Hello, ".$userRow['firstname'].". You have received a message. View the sender's profile <a href='http://athena.ecs.csus.edu/~teamnull/profile.php?user=$senderid'>here</a>.</p>
      <hr />
      <p style='background-color:#e6e2d0; color:#564e46; font-size:15px; font-family:Verdana, Geneva, sans-serif;'>".$usermessage.".</p>
     </td>
    </tr>

    </tbody>";

 $message .= "</table>";

 $message .= "</td></tr>";
 $message .= "</table>";

 $message .= "</body></html>";

 // HTML email ends here

 try
 {
  $mail->IsSMTP();
  $mail->isHTML(true);
  $mail->SMTPDebug  = 0;
  $mail->SMTPAuth   = true;
  $mail->SMTPSecure = "ssl";
  $mail->Host       = "smtp.gmail.com";
  $mail->Port       = 465;
  $mail->AddAddress($email);
  $mail->Username   ="srvhit.email@gmail.com";
                       $mail->Password   ="teamnull";
                       $mail->SetFrom('srvhit.email@gmail.com','SRVHIT');
                       $mail->AddReplyTo("srvhit.email@gmail.com","SRVHIT");
  $mail->Subject    = $subject;
  $mail->Body    = $message;
  $mail->AltBody    = $message;

  if($mail->Send())
  {
   $msg = "Email sent.";
  }
 }
 catch(phpmailerException $ex)
 {
  $msg = "<div class='alert alert-warning'>".$ex->errorMessage()."</div>";
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

        <!-- start: message form-->
        <div class="edit columns">
          <h2>Compose Email</h2>
<?php
          if(isset($msg)){
?>
              <div style=" background-color:#FF0000; font-family: verdana; color:#FFFFFF; text-align:center;">
                <?php echo $msg; ?>
              </div>
<?php
          }
?>
          <form method="POST">
            <label for="subject">Subject <input type="text" name="subject" id="subject"></label><br>
            <label for="message">Message <textarea name="usermessage" id="usermessage" rows="8" cols="20"></textarea></label><br>
            <input type="submit" name="btn-send" value="Send" class="button">
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

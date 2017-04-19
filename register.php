<?php
session_start();

require_once 'dbconnect.php';

if(isset($_POST['register'])){

    echo "register set";
    //Retrieve the field values from our registration form.
    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
    $pass = !empty($_POST['password']) ? trim($_POST['password']) : null;

    //TO ADD: Error checking (username characters, password length, etc).
    //Basically, you will need to add your own error checking BEFORE
    //the prepared statement is built and executed.

    //Now, we need to check if the supplied email already exists.

    //Construct the SQL statement and prepare it.
    //$sql = "SELECT COUNT(email) AS num FROM users WHERE email = :email";
		echo"ww";

    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);

	//while($result->num_rows > 0){
        while($row = mysqli_fetch_row($result))
		{
			echo $row[0];
      echo $row[1];
		}

    //}
    // $stmt = $pdo->prepare($sql);
    //
    // //Bind the provided username to our prepared statement.
    // $stmt->bindValue(':email', $email);
    //
    // //Execute.
    // $stmt->execute();
    //
    // //Fetch the row.
    // $row = $stmt->fetch(PDO::FETCH_ASSOC);
    //
    // //If the provided username already exists - display error.
    // //TO ADD - Your own method of handling this error. For example purposes,
    // //I'm just going to kill the script completely, as error handling is outside
    // //the scope of this tutorial.
    // if($row['num'] > 0){
    //     die('That email already exists!');
    // }
    //
    // //Hash the password as we do NOT want to store our passwords in plain text.
    // $passwordHash = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 12));
    //
    // //Prepare our INSERT statement.
    // //Remember: We are inserting a new row into our users table.
    // $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    // $stmt = $pdo->prepare($sql);
    //
    // //Bind our variables.
    // $stmt->bindValue(':email', $email);
    // $stmt->bindValue(':password', $passwordHash);
    //
    // //Execute the statement and insert the new account.
    // $result = $stmt->execute();
    //
    // //If the signup process is successful.
    // if($result){
    //     echo 'Thank you for registering with SRVHIT.';
    // }
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

          <form action="register.php" method="post">
            <input type="text" name="givenname" placeholder="First Name" required>
            <input type="text" name="surname" placeholder="Last Name" required>
            <input type="email" name="email" placeholder="Email Address (example@****.edu)" required>
            <input type="text" name="zip" placeholder="Zip Code" required>
            <input type="password" name="pw" placeholder="Password" required>
            <input type="password" name="pwconfirm" placeholder="Confirm Password" required>
            <input type="submit" name="register" value="Register" class="button">
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

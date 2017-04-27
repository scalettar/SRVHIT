<?php
class USER
{
    private $db;

    function __construct($conn)
    {
      $this->db = $conn;
    }

<<<<<<< HEAD
    public function register($firstname,$lastname,$useremail,$userpw, $isbusiness)
=======
    public function register($firstname,$lastname,$useremail,$userpw,$acctype)
>>>>>>> origin/master
    {
       try
       {
           $new_userpw = password_hash($userpw, PASSWORD_DEFAULT);

<<<<<<< HEAD
           $stmt = $this->db->prepare("INSERT INTO users(userpw, firstname, lastname, useremail, isbusiness) VALUES (:userpw, :firstname, :lastname, :useremail, :isbusiness)");
=======
           $stmt = $this->db->prepare("INSERT INTO users(userpw, firstname, lastname, useremail, acctype) VALUES (:userpw, :firstname, :lastname, :useremail, :acctype)");
>>>>>>> origin/master

           $stmt->bindparam(":firstname", $firstname);
           $stmt->bindparam(":lastname", $lastname);
           $stmt->bindparam(":useremail", $useremail);
           $stmt->bindparam(":userpw", $new_userpw);
<<<<<<< HEAD
           $stmt->bindparam(":isbusiness", $isbusiness);
=======
           $stmt->bindparam(":acctype", $acctype);
>>>>>>> origin/master
           $stmt->execute();

           return $stmt;
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
    }

    public function login($useremail,$userpw)
    {
       try
       {
          $stmt = $this->db->prepare("SELECT * FROM users WHERE useremail=:useremail LIMIT 1");
          $stmt->execute(array(':useremail'=>$useremail));
          $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
          if($stmt->rowCount() > 0)
          {
             if(password_verify($userpw, $userRow['userpw']))
             {
                $_SESSION['user_session'] = $userRow['userid'];
                return true;
             }
             else
             {
                return false;
             }
          }
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }

   public function is_loggedin()
   {
      if(isset($_SESSION['user_session']))
      {
         return true;
      }
   }

   public function redirect($url)
   {
       header("Location: $url");
   }

   public function logout()
   {
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
   }
}
?>

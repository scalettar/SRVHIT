<?php
class USER
{
    private $db;

    function __construct($conn)
    {
      $this->db = $conn;
    }

    public function register($firstname,$lastname,$useremail,$userpw)
    {
       try
       {
           $new_userpw = password_hash($userpw, PASSWORD_DEFAULT);

           $stmt = $this->db->prepare("INSERT INTO users(userpw, firstname, lastname, useremail) VALUES (:userpw, :firstname, :lastname, :useremail)");

           $stmt->bindparam(":firstname", $firstname);
           $stmt->bindparam(":lastname", $lastname);
           $stmt->bindparam(":useremail", $useremail);
           $stmt->bindparam(":userpw", $new_userpw);
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

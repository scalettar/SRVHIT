<?php
class USER
{
    private $db;

    function __construct($conn)
    {
      $this->db = $conn;
    }

    public function register($firstname,$lastname,$useremail,$userpw, $isbusiness)
    {
       try
       {
           $new_userpw = password_hash($userpw, PASSWORD_DEFAULT);

           $stmt = $this->db->prepare("INSERT INTO users(userpw, firstname, lastname, useremail, isbusiness) VALUES (:userpw, :firstname, :lastname, :useremail, :isbusiness)");

           $stmt->bindparam(":firstname", $firstname);
           $stmt->bindparam(":lastname", $lastname);
           $stmt->bindparam(":useremail", $useremail);
           $stmt->bindparam(":userpw", $new_userpw);
           $stmt->bindparam(":isbusiness", $isbusiness);
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

   public function edit($userpw, $useremail){
     try
     {
         if($userpw!=null){
           $new_userpw = password_hash($userpw, PASSWORD_DEFAULT);
           $stmt = $this->db->prepare("UPDATE users SET userpw = :userpw WHERE userid = :userid");
           $stmt->bindparam(":userid", $_SESSION['user_session']);
           $stmt->bindparam(":userpw", $new_userpw);
           $stmt->execute();
         }
         if($useremail!=null){
           $stmt = $this->db->prepare("UPDATE users SET useremail = :useremail WHERE userid = :userid");
           $stmt->bindparam(":userid", $_SESSION['user_session']);
           $stmt->bindparam(":useremail", $useremail);
           $stmt->execute();
         }
        //  if($tagname!='None'){
        //    $stmt = $this->db->prepare("INSERT INTO ");
        //    $stmt->bindparam(":userid", $_SESSION['user_session']);
        //    $stmt->bindparam(":useremail", $useremail);
        //    $stmt->execute();
        //  }
         return $stmt; // technically one edit could fail but in edit.php it will still display success if at least one stmt executed
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

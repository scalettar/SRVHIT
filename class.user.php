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

   public function edit($userpw, $useremail, $tagadd, $tagrem, $userdesc, $userimage){
     try
     {
       if($userpw!=null){
         $new_userpw = password_hash($userpw, PASSWORD_DEFAULT);
         $stmtpw = $this->db->prepare("UPDATE users SET userpw = :userpw WHERE userid = :userid");
         $stmtpw->bindparam(":userid", $_SESSION['user_session']);
         $stmtpw->bindparam(":userpw", $new_userpw);
         $stmtpw->execute();
       }
       if($useremail!=null){
         $stmtem = $this->db->prepare("UPDATE users SET useremail = :useremail WHERE userid = :userid");
         $stmtem->bindparam(":userid", $_SESSION['user_session']);
         $stmtem->bindparam(":useremail", $useremail);
         $stmtem->execute();
       }
       if($tagadd!='None'){
         $stmttag = $this->db->prepare("INSERT INTO userstags (userid, tagid) SELECT :userid, tagid FROM tags WHERE tagname = :tagadd");
         $stmttag->bindparam(":userid", $_SESSION['user_session']);
         $stmttag->bindparam(":tagadd", $tagadd);
         $stmttag->execute();
       }
       else if($tagrem!='None'){
         $stmttag = $this->db->prepare("DELETE FROM userstags WHERE tagid IN (SELECT tagid FROM tags WHERE tagname = :tagrem) AND userid = :userid");
         $stmttag->bindparam(":userid", $_SESSION['user_session']);
         $stmttag->bindparam(":tagrem", $tagrem);
         $stmttag->execute();
       }

       $stmtimg = $this->db->prepare("UPDATE users SET userimage = :userimage WHERE userid = :userid");
       $stmtimg->bindparam(":userid", $_SESSION['user_session']);
       $stmtimg->bindParam(':userimage',$userimage);
       $stmtimg->execute();

       $stmtdesc = $this->db->prepare("UPDATE users SET userdesc = :userdesc WHERE userid = :userid");
       $stmtdesc->bindparam(":userid", $_SESSION['user_session']);
       $stmtdesc->bindparam(":userdesc", $userdesc);
       $stmtdesc->execute();

       return true;
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

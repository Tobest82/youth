<?php
// user presence check
if (!session_id()) {
    ob_start();
    session_start();
}
// creating global variables
$localhost ="";
$username = "u358572477_imwkot";
$password = ".0gvXy=R7U";
$dbname = "u358572477_imwkot";
$user = "client";
$admin ="admin";



class Classpro{
 private $localhost ="";
   private $username = "u358572477_imwkot";
   private  $password = ".0gvXy=R7U";
   private $dbname = "u358572477_imwkot";
   private  $user = "client";
private $admin ="admin";


//    connecting to db
public function  dbconnect() {
    $link = mysqli_connect($this->localhost, $this->username, $this->password, $this->dbname);
if (mysqli_select_db($link, $this->dbname)){

        return $link;
    } else {
        print 'Not connected' . mysqli_connect_error();
    }
}


// query database
public function sql_query($sql){
    $link = $this->dbconnect();
    $query = mysqli_query($link, $sql);
    if ($query){

        return $query;
    } else {
        print 'Database error'."---". mysqli_error( $link);
    }
}


// validate password
public function validate_password($pass,$cpass)
{
    if ($pass == $cpass){
        return (1);
    } else {
        return (0);
    }
}



// generate dateTime
public function getDateTime(){
    date_default_timezone_set("Europe/London");
   $date=  date("Y-m-d ");
return $date;
}

// passwoard hash
public function hashPass($pass){
    $hashP=  password_hash($pass,PASSWORD_DEFAULT);
    return $hashP;
  }


// rgistering  the user
public function registerUser($firstName, $middleName, $lastName,$gender, $password,$cpassword,$phone,$email,$Undergraduatelevels,$Undergraduatefields,$Graduatelevels,$Graduatefields,$Job,$Artisancraft, $tradersgoods){
    $checkedPass = $this->validate_password($password,$cpassword);
    $passHashed = $this->hashPass($password);
    $date = $this->getDateTime();
    $checkPhone =  $this->sql_query("SELECT * FROM $this->user WHERE `phone` ='".$phone."'  ");
    if ( $checkedPass) {
        if(mysqli_num_rows($checkPhone) > 0){
        print " user already exists"; 

        } else {
            if (strlen($password) >= 8 && strlen($password) <= 16) {
                if (preg_match("/^\+?\d{10,15}$/", $phone)){ 
                    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        print "invalid email";
                        return;
                    }
                   
                        $sql = "INSERT INTO $this->user  VALUES (null,'".$firstName."', '".$middleName."', '".$lastName."',null,'".$gender."', '".$passHashed."',  '".$phone."', '".$email."', '".$Undergraduatelevels."','".$Undergraduatefields."','".$Graduatelevels."','".$Graduatefields."','".$Job."','".$Artisancraft."', '". $tradersgoods."', '".$date."')";
                        $query = $this->sql_query($sql);
                        header("Location:login.php");

                        if($query) {
                    
                            return 0;
                        
                        } else {
                            print "user not registered";
                        }   
                    
                } else {
                    print "invalid phone number";
                }

                } else {
                    print "password must be between 8 and 16 characters";
                }
        }
        } else {
            print "password does not match";
        }
}


// user login
public function userLogin($info,$password){
    $checkUser= $this->sql_query( "SELECT * FROM $this->user WHERE `phone` =  '".$info."' OR `email` = '".$info."' ");
    if(mysqli_num_rows($checkUser) > 0 ) {
        $row = mysqli_fetch_assoc( $checkUser) ;
        $passwordDb = $row['password'];
       $passwordHash = $this->hashPass($password);
       if ( $passwordHash == password_verify($password,$passwordDb )) {

        $_SESSION["user_logged"] = $row['phone'];
        header("Location:dashboard.php");

       } else {
print "password or phone number  incorrect";
       }


       } else{
        print "password or phone number  incorrect";
       }



    }



// to set login session for the user
public function setUserLogin(){
    if (isset($_SESSION["user_logged"]) && !empty($_SESSION["user_logged"])){
      $_SESSION['logged_in'] = $_SESSION["user_logged"];
    }
}

// check if user have loggedin
public function checkUserLoggedIn(){
    if (isset($_SESSION["logged_in"]) && !empty($_SESSION["logged_in"])){

    } else{
        header("location:login.php");
    }
}






//** */ getting user information by session
public function getUserData($value){

    $sql = $this->sql_query(" SELECT * FROM $this->user WHERE `phone` = '" .$_SESSION['logged_in']."'  ");
     $row = mysqli_fetch_assoc($sql); 
  
  return $row[$value];
  }
  
  //** */ getting user information by id
  
  public function getUserId($value,$id){
      $sql = $this->sql_query(" SELECT * FROM $this->user WHERE `id` = '" .$id."'  ");
      $row = mysqli_fetch_assoc($sql); 
  
      return $row[$value];
  
  }
  
// Send a message
public function sendMessage($sender_id, $receiver_id, $message) {
    $sql = "INSERT INTO messages (sender_id, receiver_id, message) VALUES ('$sender_id', '$receiver_id', '$message')";
    $query = $this->sql_query($sql);
    if ($query) {
        return 1;
    } else {
        return "Failed to send message.";
    }
}

// Get messages between two users
public function getMessages($user1_id, $user2_id) {
    $sql = "SELECT * FROM messages WHERE (sender_id = '$user1_id' AND receiver_id = '$user2_id') OR (sender_id = '$user2_id' AND receiver_id = '$user1_id') ORDER BY timestamp ASC";
    return $this->sql_query($sql);
}


  public function ProfileEdit($firstName,$middleName,$lastName,$gender,$phone,$email,$Undergraduatelevels,$Undergraduatefields,$Graduatelevels,$Graduatefields,$Job,$Artisancraft, $tradersgoods){
    $sql = $this->sql_query("UPDATE $this->user SET `firstname`='" . $firstName . "',`middlename`='" . $middleName . "',`lastname`='" . $lastName . "',`gender`='".$gender."',`phone`='" . $phone . "',`email`='" . $email . "',`Undergraduatelevels`='" . $Undergraduatelevels . "',`Undergraduatefields`='" . $Undergraduatefields . "',`Graduatelevels`='" . $Graduatelevels . "',`Graduatefields`='" . $Graduatefields . "',`Job`='" . $Job . "',`Artisancraft`='" . $Artisancraft . "',`tradersgoods`='" . $tradersgoods . "'  WHERE `phone`='" . $_SESSION['logged_in'] . "'");
if($sql){
    return 1;
} else {
    return "update failed !!!";
}

}




//update user password by loggedin session
public function UpdatePassword($oldpass, $newpass, $cpass)
{
    $check = $this->sql_query("SELECT * FROM $this->user WHERE `phone`='" . $_SESSION['logged_in'] . "'");
    $row = mysqli_fetch_assoc($check);
    $hashP = $this->hashPass($oldpass);
    // verify user password
    if ($hashP == password_verify($oldpass, $row['password'])) {

 //verify user new password if it matches
 $checkpass = $this->validate_password($newpass, $cpass);
 if ($checkpass == 1) {


     if (strlen($newpass) < 8 || (strlen($newpass)) > 16) {
         return ("PASSWORD MUST BE BETWEEN 8-16 CHARACTERS!!!");
     } else {
         $hashnewpass = $this->hashPass($newpass);
         $update = $this->sql_query("UPDATE $this->user SET `password`='" . $hashnewpass . "' WHERE `phone`='" . $_SESSION['logged_in'] . "'");
         if ($update) {
             return 1;
         } else {
             return "<p style='color:red'>Password update failed!!!</p>";
         }

         }
          } else {
            return "password does not match";
          }
    } else {
       return " incorrect password";
    }


}

// profileImage
public function changeProfileImage($profileImage) {
    if(!empty($profileImage)){

        $sql = $this->sql_query("UPDATE $this->user SET `profileImage`='" . $profileImage. "' WHERE `phone`='" . $_SESSION['logged_in'] . "'");
        if($sql){
            return 1;
        } else {
            return "image update failed !!!";
        }
    } else {
        return "please select image";
    }

}



// delete profile image
public function deleteProfileimage($imageId) {

    $query = $this->sql_query("UPDATE $this->user SET `profileImage`='" . $imageId. "' WHERE `phone`='" . $_SESSION['logged_in'] . "'");
if( $query){
return 1;
} else{
return "Delete unsuccess";
}

}
//
public function deleteUser($delid) {
    $loggedInphone = $_SESSION['logged_in'];
    $userToDelete = $this->sql_query("SELECT * FROM $this->user WHERE `id` = '" . $delid . "'");
    $row = mysqli_fetch_assoc($userToDelete);

    if ($row['phone'] === $loggedInphone) {
        $sql = $this->sql_query("DELETE FROM $this->user WHERE `id` = '" . $delid . "'");
        if ($sql) {
            // Logout the user after deletion
            session_destroy();
            header("Location: login.php");
            exit();
        } else {
            return 0; // Failure
        }
    } else {
        return "You can only delete your own account.";
    }
}




// delete admin profile image
public function deleteAdminProfileimage($imageId) {

    $query = $this->sql_query("UPDATE $this->admin SET `adminimage`='" . $imageId. "' WHERE `phone`='" . $_SESSION['adminlogged_in'] . "'");
if( $query){
return 1;
} else{
return "Delete unsuccess";
}

}


// delete users
public function deleteUserx($delid)
{
    $sql = $this->sql_query("DELETE FROM $this->user WHERE `id`='" . $delid . "'");
    if ($sql) {
        return (1);
    } else {
        return (0);
    }
}
// do not delete
} 

$call = new Classpro;
$call->setUserLogin();

<?php
$showError = "false";
if($_SERVER["REQUEST_METHOD"]=="POST"){
  include 'dbconnect.php';
  $user_email = $_POST['signupEmail']; 
  $password = $_POST['signuppassword'];
  $c_password = $_POST['signupcpassword'];

  //check whether this email exists
  $existssql = "SELECT * FROM `users` WHERE user_email = '$user_email'";
  $result = mysqli_query($conn,$existssql);
  $numrows = mysqli_num_rows($result);
  if($numrows>0){
      $showError = "Email is already in use";
  }
  else{
      if($password  == $c_password){
          $hash = password_hash($password , PASSWORD_DEFAULT);
          $sql = "INSERT INTO `users` (`user_email`,`user_password`,`timestamp`) VALUES ('$user_email','$hash',current_timestamp())";
          $result = mysqli_query($conn,$sql);
          if($result){
              $showAlert = true;
              header("Location: /idiscussforums/index.php?signupsuccess=true");
              exit();
            }
        }
        else{
            $showError="Passwords do not Match";
            
        }
    }
    header("Location: /idiscussforums/index.php?signupsuccess=false&error=$showError");

}



?>
<?php
include ('db.php');


if(isset($_POST['submitted'])){

  $error = array();
  if(empty($_POST['email'])){
     $error[] = 'You haven\'t entered an email.';
   }else{
   if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST['email'])){
      $email = $_POST['email'];
    }else{
    $error[] = 'Invalid email.';
    }
}
  if(empty($error)){
     $query = "SELECT * FROM users WHERE(email = '$email')";
     $result = mysqli_query($dbc,$query);
     if(!$result){
      echo 'Query Failed';
     }
    if(@mysqli_num_rows($result)>=1){
		$rows = mysqli_fetch_array($result);
		$pass = $rows['password'];
        $message = "Your password is: " .$pass;
		mail($email,'Password recovery',$message, 'From: '.EMAIL);
		echo '<div class = "success">  An email has been sent to ' . $email . ' with your password.'. '</div>';
   }else{
    $eroare = "No user with this email.";
   }
} else{
   echo '<div class = "warning"> <ul>';
   foreach($error as $key => $value){
      echo '<li>' . $values. '</li>';
}
 echo '</ol></div>';
}
if(isset($eroare)){
  echo '<div class = "error">'.$eroare.'</div>';
 }
 mysqli_close($dbc);
}
   

?>
<html>
<head>
<title>Password recovery</title>
<link rel = "stylesheet" type = "text/css" href = "css.css">
</head>
<body>
<div class = "container">
<ul><li><a href = "login.php">Home</a></li></ul>
<div style = "width:30%;display:block;"class = "register" >
<form action = "recuperare.php" method = "post"> 
<div>
<label style = "width:60%;text-align:center" for= "email">Enter the email:</label>
<input style = " width:50%; "type = "text" name = "email" ><br>
</div>
<div style = "text-align:center">
<input type = "hidden" name = "submitted" value = "TRUE">
<input style = "width:20%;" type = "submit" class = "submit" value = "Submit" >
</div>
</div>
</div>
</body>


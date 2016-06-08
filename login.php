<?php
 
include('db.php');
if(isset($_POST['submitted'])){
   session_start();
   $error = array();
   if(empty($_POST['username'])){
      $error[] = 'Introduceti username-ul';
     }else{
    
         $username = $_POST['username'];
    }
         

  if(empty($_POST['password'])){
     $error[] = 'Introduceti parola';
    }else{
     $password = $_POST['password'];
    }
  if(empty($error)){
    $query_check = "SELECT * FROM users WHERE (username = '$username' AND password = '$password')";
    $result = mysqli_query($dbc,$query_check);
    if(!$result){
      echo 'Query failed';
}
    if(@mysqli_num_rows($result)>=1)
     {
      $_SESSION = mysqli_fetch_array($result,MYSQLI_ASSOC);
      header("Location: user.php");
}
  else{
    $msg_error = 'Username sau parola este incorecta.';
   }
 }else{
  echo '<div class = "error"><ul>';
    foreach($error as $key =>$values){
    echo ' <li>' . $values . ' </li>';
}
 echo '</ul></div>';
}
if(isset($msg_error)){
   echo '<div class = "error">' .$msg_error.' </div>';
}
mysqli_close($dbc);
}

 ?>
 <html>
<head>
<title>Autentificare</title>
<style>
body{
background-color:#675A6A;
}
.container > div{
  display:block;
 width:30%;
  margin-top:10px;
}
.register{
  width:300px;
  margin:0  auto;
  padding:10px;
  border:7px solid #B086FD;
  border-radius:10px;
  font-family:Helvetica,Arial;
  color:#444;
  background-color:#F0F0F0;
  box-shadow: 0 0 20px #000000;
  float:center;
 
}
h3{
text-align:center;
}
a{
text-decoration:none;
color:black;
}
div{
  margin :0 0 15px 0;
 }
label{
  display:inline-block;
  width:25%;
  text-align:left;
  margin:10px;
}
input{
  width:50%;
  font-family:Tahoma, Sans-Serif;
  padding:5px;
  border-radius:5px;
  font-size:0.9em;
  background:rgba(0,0,0,0.3);
}
.login{
  width:30%;
  font-size:1em;
  border-size:8px;
  padding:10px;
  border:1px solid #59B969;
  box-shadow: 0 1px 0 0 #B086FD;
  text-align:center;
  display:block;
  margin:0 auto;
}

.success, .warning, .error, .validation {
	border: 1px solid;
	margin: 0 auto;
	padding:10px 5px 10px 50px;
	background-repeat: no-repeat;
	background-position: 10px center;
     font-weight:bold;
     width:450px;
     
}
.success {
   
	color: #4F8A10;
	background-color: #DFF2BF;
	background-image:url('images/success.png');
}

.error {
 
	color: #D8000C;
	background-color: #FFBABA;
	background-image: url('images/error.png');
	
}
.validation {
 
	color: #D63301;
	background-color: #FFCCBA;
	background-image: url('images/error.png');
}
</style>

</head>
<body>
<div class = "container">
<div class = "register">
<h3>Login</h3>
<form action = "login.php" method = "post" " class = "form">
<fieldset><div>
<label for ="user">Username:</label> 
<input type = "text" id = "username" name = "username" size = "25"><br>
</div>
<div>
<label for ="password">

Password:
</label>
<input type = "password" id = "password" name = "password"><br>
</div>

<input type = "hidden" name = "submitted" value = "TRUE">
<input type = "submit" value = "Login" class = "login"><br>
<span><a href = "auth.php">
Don't have an account? Register</a><span><br> <span><a href = "recuperare.php">Forgot your password? </a></span>
</fieldset>
</form>
</div>
</div>

</body>



</html>


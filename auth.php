<?php

	include('db.php');
	if(isset($_POST['submitted'])){
		$error = array();
		if(empty($_POST['name'])){
			$error[] = 'Introduceti un nume.';
			
		}
		else{
			$name = $_POST['name'];
		}
		if(empty($_POST['email'])){
			$error[] = 'Introduceti email-ul. ';
		}
		else{
			if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/",
			$_POST['email'])){
				$email = $_POST['email'];
			
		}
		else{
			$error[] = "Adresa de email invalida. ";
		}
	}
	if(empty($_POST['password'])){
		$error[] = 'Introduceti o parola ';
	}
	else{
		$password = $_POST['password'];
	}
	if(empty($error)){
		$query_verify_email = "SELECT * FROM users WHERE email ='$email'";
		$result_verify_email = mysqli_query($dbc,$query_verify_email);
		if(!$result_verify_email){
			echo 'Database error';
		}
		if(mysqli_num_rows($result_verify_email)==0){
			$activation = md5(uniqid(rand(),true));
			$query_insert_user = "INSERT INTO users (username,password,email,activation) VALUES 
			('$name','$password','$email','$activation')";
			$result_insert_user = mysqli_query($dbc,$query_insert_user);
			if(!$result_insert_user){
				echo 'query failed';
			}
			if(mysqli_affected_rows($dbc)==1){
				$message = "To activate the account click this link:\n\n";
				$message .= WEBSITE_URL . '/activare.php?email=' . urlencode($email) . "&key = ". $activation;
				mail($email,'Registration confirmation',$message, 'From: '.EMAIL);
				echo '<div class = "success"> Registration comple! An email has been sent to ' . $email . '</div>';
				
			}else{
				echo '<div class = "error"> Registration failed.</div>';
			}
		}else{
			echo'<div class = "error"> There is already a user with this email.</div>';
		}
	}else{
		echo '<div class = "error"><ol>';
		foreach($error as $key => $values){
			echo '<li>' . $values . '</li>';
		}
		echo '</ol></div>';
	}
	mysqli_close($dbc);
	}
?>
<?php
include('db.php');
if (isset($_GET['email']) 
	&& preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/',
    $_GET['email'])){
		$email = $_GET['email'];
	}
	if(isset($_GET['key'])&& (strlen($_GET['key'])==32)){
		$key = $_GET['key'];
	}
	if(isset($email) && isset($key)){
		$query_activate_account = "UPDATE members SET  ACTIVATION = NULL WHERE
		(email = '$email' AND Activation = '$key')LIMIT 1";
		$result_activate_account = mysqli_query($dbc,$query_activate_account);
		if(mysqli_affected_rows($dbc)==1){
			echo '<div> Your account is active. You can <a href = "index.html">login now.</a></div>';
		
		}else{
			echo '<div>Your account has not been activated.</div>';
		}
		mysqli_close($dbc);
	}else{
		echo '<div>Error</div>';
	}

?>
<?php
if (! isset($_SERVER['HTTPS']) or $_SERVER['HTTPS'] == 'off' ) {
	$redirect_url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	header("Location: $redirect_url");
	exit();
}

session_start();

if( isset($_SESSION['user_id']) ){
	header("Location: /");
}

require 'database.php';


if(!empty($_POST['email'])):
	
	$records = $conn->prepare('SELECT id FROM auth_users WHERE email = :email ');
	$records->bindParam(':email', $_POST['email']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$message = '';

	if($results['id'] > 0){
		header("Location: register.php");	
	
	} 
	if($results['id'] == 0) {
		header("Location: contact.php");
	}

endif;

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>Check Credentials</title>
	
</head>
<body>
<div id = "container">
	<div class="header">
		
	</div>

	

	<h1>Check you Credentials</h1>
	<h3>Registration is only allowed if validated</h3>

	<form action="validate.php" method="POST">
		
		<input type="text" placeholder="E-mail" name="email">
		
		<input type="submit" value="login">

	</form>
</div>
</body>
</html>
<?php
if (! isset($_SERVER['HTTPS']) or $_SERVER['HTTPS'] == 'off' ) {
	$redirect_url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	header("Location: $redirect_url");
	exit();
}

session_start();

if( isset($_SESSION['user_id']) )
{
	header("Location: /To_DO");
}
require 'database.php';

$message = '';

if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password'])):
	
	// Enter the new user in the database
	$sql = "INSERT INTO reg_users (f_name, l_name, email, username, password) VALUES (:name, :name1, :email, :user, :password)";
	$stmt = $conn->prepare($sql);

	$stmt->bindParam(':name', $_POST['name']);
	$stmt->bindParam(':name1', $_POST['name1']);
	$stmt->bindParam(':email', $_POST['email']);
	$stmt->bindParam(':user', $_POST['user']);
	$stmt->bindParam(':password', password_hash($_POST['password'], PASSWORD_BCRYPT));

		
	if( $stmt->execute() ):
		header("Location: member.php");
	else:	
		$message = 'Sorry there must have been an issue creating your account';
		header("Location: error.php");
	endif;
	
	
	

endif;


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>Register Below</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
</head>
<body>
<div id = "container">
	<div class="header">
		
	</div>

	<?php if(!empty($message)): ?>
		<p><?= $message ?></p>
	<?php endif; ?>

	<h1>Register</h1>
	
	<form action="register.php" method="POST">
	
		<input type="text" placeholder="First name" name="name">
		<input type="text" placeholder="lastname" name="name1">
		<input type="text" placeholder="e-mail" name="email">
		<input type="text" placeholder="username" name="user">
		<input type="password" placeholder="password" name="password">
		<input type="password" placeholder="Confirm password" name="confirm_password">
		<input type="submit" value="send">

	</form>
</div>
</body>
</html>
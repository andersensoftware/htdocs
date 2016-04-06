<?php

session_start();

if( isset($_SESSION['user_id']) )
{
	header("Location: /");
}
require 'database.php';

$message = '';

if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password'])):

{

	$email = mysql_real_escape_string($_POST['email']);
	$results = mysql_query("select id from autorised where user_email='$email' ");
	$row = mysql_num_rows($results);
	if ($row == 0 ) {
		//if $row is greater than 0, (means the email exists)
		echo "Error: email already exists";
	} else {

		if ($row > 0 ) {
			// Enter the new user in the database
	$sql = "INSERT INTO registereduser (name, email, password) VALUES (:name, :email, :password)";
	$stmt = $conn->prepare($sql);

	$stmt->bindParam(':name', $_POST['name']);
	$stmt->bindParam(':email', $_POST['email']);
	$stmt->bindParam(':password', password_hash($_POST['password'], PASSWORD_BCRYPT));

	if( $stmt->execute() ):
		$message = 'Successfully created new user';
	else:
		$message = 'Sorry there must have been an issue creating your account';
	endif;
		}
	}
}
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
		<a href="../index.php">Jimmis fest</a>
	</div>

	<?php if(!empty($message)): ?>
		<p><?= $message ?></p>
	<?php endif; ?>

	<h1>Register</h1>
	<span>eller <a href="login.php">login her</a></span>

	<form action="register.php" method="POST">
	
		<input type="text" placeholder="Enter dit name" name="name">
		<input type="text" placeholder="Enter din email" name="email">
		<input type="password" placeholder="Adgangskode" name="password">
		<input type="password" placeholder="Bekræft Adgangskode" name="confirm_password">
		<input type="submit" value="send">

	</form>
</div>
</body>
</html>
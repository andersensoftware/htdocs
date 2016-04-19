<?php

session_start();

if( isset($_SESSION['user_id']) )
{
	header("Location: /");
}
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'testDB';

$conn = mysqli_connect($server, $username, $password);
mysqli_select_db($conn,$database) or die( "Unable to select database");	//select the created database

$message = '';

if(!empty($_POST['f_name']) && !empty($_POST['l_name']) &&!empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password'])):
	
	// Enter the new user in the database
	$sql = "INSERT INTO reg_users (f_name, l_name, email, username, password) VALUES (:f_name, :l_name :email, :username, :password)";
	$stmt = $conn->prepare($sql);

	$stmt->bindParam(':f_name', $_POST['f_name']);
	$stmt->bindParam(':l_name', $_POST['l_name']);
	$stmt->bindParam(':email', $_POST['email']);
	$stmt->bindParam(':username', $_POST['username']);
	$stmt->bindParam(':password', $_POST['password']);

	if( $stmt->execute() ):
		$message = 'Successfully created new user';
	else:
		$message = 'Sorry there must have been an issue creating your account';
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
	
		<input type="text" placeholder="first name" name="f_name">
		<input type="text" placeholder="lastname" name="l_name">
		<input type="text" placeholder="email" name="email">
		<input type="text" placeholder="username" name="username">
		<input type="password" placeholder="password" name="password">		
		<input type="submit" value="send">

	</form>
</div>
</body>
</html>
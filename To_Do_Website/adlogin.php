<?php
if (! isset($_SERVER['HTTPS']) or $_SERVER['HTTPS'] == 'off' ) {
    $redirect_url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header("Location: $redirect_url");
    exit();
}


session_start();

if( isset($_SESSION['user_id']) ){
	header("Location: /To_do");
}

require 'database.php';

if(!empty($_POST['email']) && !empty($_POST['password'])):
	
	$records = $conn->prepare('SELECT id,email,password FROM admin_users WHERE email = :email');
	$records->bindParam(':email', $_POST['email']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$message = '';

	if(count($results) > 0 && password_verify($_POST['password'], $results['password']) ){

		$_SESSION['user_id'] = $results['id'];
		header("Location: adminmember.php");

	} else {
		$message = 'Sorry, those credentials do not match';
	}

endif;

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>Login Neden for</title>
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

	<h1>Login</h1>
	
	<form action="login.php" method="POST">
		
		<input type="text" placeholder="E-mail" name="email">
		<input type="password" placeholder="Password" name="password">

		<input type="submit" value="log ind">

	</form>
</div>
</body>
</html>
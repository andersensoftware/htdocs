<?php
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'to_do_website';

try{
	$conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch(PDOException $e){
	die( "Connection failed: " . $e->getMessage());
}
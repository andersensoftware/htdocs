<?php

$server = 'localhost';
$username = 'root';
$password = '';
$database = 'testDB';

	$con2 = mysqli_connect($server,$username,$password); //connect to server

	$ideas = mysqli_query($con2,"create database testDB"); //create database
	mysqli_select_db($con2,$database) or die( "Unable to select database");	//select the created database
	
	//create table for users
	$ideas = mysqli_query($con2,"create table auth_users(id int not null primary key auto_increment, f_name varchar(50),l_name varchar(50), email varchar(150), username varchar(25), password varchar(200));");
	
	//create register table
	$ideas = mysqli_query($con2,"create table reg_users(id int not null primary key auto_increment, f_name varchar(50),l_name varchar(50), email varchar(150), username varchar(25), password varchar(200));");
	
	//insert into table
	$ideas = mysqli_query($con2,"insert into auth_users values ('', 'John', 'Doe', 'john@doe.com', 'jdoe', password('doepass'));")or die(mysqli_error($con2));


?>
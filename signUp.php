<?php
session_start();
include("include/connect.php");
if (empty($_POST["user"])||empty($_POST["pass"])||empty($_POST["name"])||empty($_POST["surname"])) {
	header("location: index.php");
} else {
	$user=mysql_real_escape_string(strip_tags($_POST["user"]));
	$name=mysql_real_escape_string(strip_tags($_POST["name"]));
	$surname=mysql_real_escape_string(strip_tags($_POST["surname"]));

	$pass=md5("marinita".mysql_real_escape_string(strip_tags($_POST["pass"])));
	$sql=mysql_query("INSERT INTO user (user,pass,name,surname) VALUES ('".$user."', '".$pass."', '".$name."', '".$surname."')", $link);
	$_SESSION["guildore"]=$user;
	header("location: index.php");
}
?>
<?php
session_start();
include("include/connect.php");
if (empty($_POST["user"])||empty($_POST["pass"])) {
	header("location: index.php?error=1");
} else {
	$user=mysql_real_escape_string(strip_tags($_POST["user"]));

	$pass=md5("marinita".mysql_real_escape_string(strip_tags($_POST["pass"])));
	$sql=mysql_query("SELECT * FROM user WHERE user='".$user."' AND pass='".$pass."'", $link);
	if (mysql_num_rows($sql)==0) {
		header("location: index.php?error=1");
	} else {
		$_SESSION["guildore"]=$user;
		header("location: index.php");	
	}
	
}
?>
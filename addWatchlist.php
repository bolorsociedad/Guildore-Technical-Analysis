<?php
session_start();
include("include/connect.php");
if (empty($_GET["t"]) || empty($_SESSION["guildore"])) {
	header("location: index.php");
} else {
	$ticker=mysql_real_escape_string(strip_tags($_GET["t"]));
	$sql=mysql_query("SELECT * FROM watchlist WHERE ticker='".$ticker."' AND user='".$_SESSION["guildore"]."'", $link);
	if (mysql_num_rows($sql)==0) {
		$sql=mysql_query("INSERT INTO watchlist (user,ticker) VALUES ('".$_SESSION['guildore']."', '".$ticker."')", $link);	
	} else {
		$sql=mysql_query("DELETE FROM watchlist WHERE ticker='".$ticker."' AND user='".$_SESSION["guildore"]."'", $link);
	}
	
	
}
?>
<?php
session_start();
include("include/connect.php");
if (empty($_POST["shares"])||empty($_POST["quote"]) || empty($_SESSION["guildore"]) || empty($_POST["ticker"])) {
	header("location: index.php");
} else {
	$shares=(int)$_POST["shares"];
	$quote=(float)$_POST["quote"];
	$ticker=mysql_real_escape_string(strip_tags($_POST["ticker"]));
	$d=date("Y-m-d H:i:s");
	$sql=mysql_query("INSERT INTO portfolio (user,ticker,shares,price,date) VALUES ('".$_SESSION['guildore']."', '".$ticker."', ".$shares.", ".$quote.",'".$d."')", $link);
	header("location: portfolio.php");
}
?>
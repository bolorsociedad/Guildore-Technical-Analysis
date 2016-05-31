<?php
session_start();
include("include/connect.php");
if (empty($_GET["id"]) || empty($_SESSION["guildore"])) {
	header("location: index.php");
} else {
	$id=mysql_real_escape_string(strip_tags($_GET["id"]));
	$sql=mysql_query("DELETE FROM watchlist WHERE id=".$id." AND user='".$_SESSION["guildore"]."'", $link);
	
	
}
?>
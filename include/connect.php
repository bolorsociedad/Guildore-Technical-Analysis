<?php

// MySQL login details

$server = "localhost";
$user = "root";
$pass = "";
$db = "guildore";

///////////////////////

$link = mysql_connect($server,$user,$pass); //MAKE CONNECTION
mysql_select_db($db,$link);//SELECT DB
mysql_query ("SET NAMES 'utf8'");


?>
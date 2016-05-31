<?php
session_start();
include("include/connect.php");
if (!empty($_SESSION["guildore"])) {
    $sql=mysql_query("SELECT * FROM user WHERE user='".$_SESSION["guildore"]."'", $link);
    $user=mysql_fetch_array($sql);
}
if (!empty($_GET["t"])) {
    $t=strtoupper(mysql_real_escape_string(strip_tags($_GET["t"])));
} else {
    $t="";
}
$place="about";
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
 
<title>Guildore</title>
<link rel="stylesheet" type="text/css" href="style.css"/>
<script src="js/jquery-1.11.2.min.js"></script>
<script src="http://code.highcharts.com/stock/highstock.js"></script>
<script src="http://code.highcharts.com/stock/modules/exporting.js"></script>
<script src="js/chart.js"></script>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

</head>


<body>
<?php include_once("include/analyticstracking.php") ?>


<div class="content">
    <div class="left">
        <?php include("include/left.php"); ?>
    </div>
    <div class="right">
        <div style="margin-top: 40px;">

        	<div class="title">
        		About
        	</div>

        	<p>Guildore is a website that offers free technical analysis tools. Although sign up is not necessary to use the software, it's
                highly recommended, since registered users can add a certain stock to their portfolio, add it to watchlist, etc.</p>
            <p>The website was created by Imanol Pérez. If you have a business proposition, questions, suggestions or you just want to say hi, send
                an email to <a href="mailto:bolorsociedad@gmail.com">bolorsociedad@gmail.com</a>.


        </div>
    </div>
</div>

</body>
</html>

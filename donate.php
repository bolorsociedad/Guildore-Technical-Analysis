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
$place="";
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
        		Donate to Guildore
        	</div>

        	<p>Donations help us to keep Guildore completely free, as well as encouraging us to keep improving the website. You are free to specify the desired amount to donate.</p>

        	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="6R3X6PGNYYBK4">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

		<p>You can make a monthly donation too!</p>

		<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="LUQYS4CH2HVMN">
<table>
<tr><td><input type="hidden" name="on0" value=""></td></tr><tr><td><select name="os0">
	<option value="Option 1">Option 1 : €5,00 EUR - monthly</option>
	<option value="Option 2">Option 2 : €10,00 EUR - monthly</option>
	<option value="Option 3">Option 3 : €50,00 EUR - monthly</option>
	<option value="Option 4">Option 4 : €100,00 EUR - monthly</option>
</select> </td></tr>
</table>
<input type="hidden" name="currency_code" value="EUR">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_subscribe_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>


        </div>
    </div>
</div>

</body>
</html>

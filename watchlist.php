<?php
session_start();
include("include/connect.php");
if (!empty($_SESSION["guildore"])) {
    $sql=mysql_query("SELECT * FROM user WHERE user='".$_SESSION["guildore"]."'", $link);
    $user=mysql_fetch_array($sql);
} else {
    header("location: index.php");
}
if (!empty($_GET["t"])) {
    $t=strtoupper(mysql_real_escape_string(strip_tags($_GET["t"])));
} else {
    $t="";
}
$place="watchlist";
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
        		Watchlist
        	</div>
            <div style="" id="loadHere"></div>
        	<?php
            $sql=mysql_query("SELECT * FROM watchlist WHERE user='".$_SESSION["guildore"]."' ORDER BY id DESC", $link);
            while ($ticker=mysql_fetch_array($sql)) {
                ?>
                    <div id="wl<?php echo $ticker["id"]; ?>" class="watchlist" onclick="window.location='./?t=<?php echo $ticker["ticker"]; ?>';"><?php echo $ticker["ticker"]; ?>
                        <div style="float: right;"><a href="#" onclick="if (event.stopPropagation) { event.stopPropagation(); }else { event.cancelBubble=true; } $('#wl<?php echo $ticker['id']; ?>').slideUp();$('#loadHere').load('deleteWatchlist.php?id=<?php echo $ticker['id']; ?>');">Delete</a></div>
                    </div>
                <?php
            }
            ?>


        </div>
    </div>
</div>

</body>
</html>

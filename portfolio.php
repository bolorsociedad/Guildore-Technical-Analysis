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
$place="portfolio";
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
<script>
function getToday(y) {
    var today = new Date();
    today.setDate(today.getDate()-y)
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear();

if(dd<10) {
    dd='0'+dd
} 

if(mm<10) {
    mm='0'+mm
} 

today = yyyy+'/'+mm+'/'+dd;
return today;
}
</script>
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
        		Portfolio
        	</div>
            <p>Click to see more details</p>
            <div style="" id="loadHere"></div>
        	<?php
            $sql=mysql_query("SELECT * FROM portfolio WHERE user='".$_SESSION["guildore"]."' ORDER BY id DESC", $link);
            while ($ticker=mysql_fetch_array($sql)) {
                ?>
                    <div id="wl<?php echo $ticker["id"]; ?>" class="watchlist" onclick="$(this).toggleClass('active');$('#moreInfo<?php echo $ticker["id"]; ?>').slideToggle();"><span style="font-size: 16px;"><?php echo $ticker["ticker"]; ?></span>
                        <div style="float: right;"><a href="#" onclick="if (event.stopPropagation) { event.stopPropagation(); }else { event.cancelBubble=true; } $('#wl<?php echo $ticker['id']; ?>').slideUp();$('#loadHere').load('deletePortfolio.php?id=<?php echo $ticker['id']; ?>');">Delete</a></div>
                    </div>

                    <div style="display:none; margin-left: 30px;" id="moreInfo<?php echo $ticker['id']; ?>">
                        <p><b>Ticker:</b> <?php echo $ticker["ticker"]; ?> (<a href="./?t=<?php echo $ticker["ticker"]; ?>">go to chart</a>)</p>
                        <p><b>Shares:</b> <?php echo $ticker["shares"]; ?></p>
                        <p><b>Quote when purchased:</b> <?php echo $ticker["price"]; ?></p>
                        <p><b>Current quote:</b> <span id="cc<?php echo $ticker["id"]; ?>"></span></p>
                        <p><b>W/L:</b> <span id="winlose<?php echo $ticker["id"]; ?>"></span></p>
                        <script>

                            startDate=getToday(1);
                            endDate=getToday(0);
                            ticker='<?php echo $ticker["ticker"]; ?>';
                            /*startDate='2014-09-11';
                            endDate=getToday();*/
                            jsonURL='http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.historicaldata%20where%20symbol%20%3D%20%22'+ticker+'%22%20and%20startDate%20%3D%20%22'+startDate+'%22%20and%20endDate%20%3D%20%22'+endDate+'%22&format=json&diagnostics=true&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=';
                            //$.getJSON('http://www.highcharts.com/samples/data/jsonp.php?filename=aapl-ohlcv.json&callback=?', function (data) {
                            $.getJSON(jsonURL, function (data) {
                                q=data["query"]["results"]["quote"]["Close"];
                                $("#cc<?php echo $ticker['id']; ?>").text(q);
                                dif=parseFloat(q)-<?php echo $ticker["price"]; ?>;
                                wl=dif*<?php echo $ticker["shares"]; ?>;
                                wl=wl.toFixed(2)
                                if (wl>0) {
                                    $("#winlose<?php echo $ticker['id']; ?>").css("color", "green");
                                    wl="+"+wl;
                                    dif=q/(<?php echo $ticker["price"]; ?>);
                                    dif-=1;
                                    dif*=100;
                                    dif=dif.toFixed(2);
                                    dif="+"+dif;
                                }
                                if (wl<0) {
                                    $("#winlose<?php echo $ticker['id']; ?>").css("color", "red");
                                    wl=wl;
                                    dif=q/(<?php echo $ticker["price"]; ?>);
                                    dif-=1;
                                    dif*=100;
                                    dif=dif.toFixed(2);
                                }




                                $("#winlose<?php echo $ticker['id']; ?>").text(wl+" ("+dif+"%)");

                                
                              });
                             
                        </script>
                    </div>

                <?php
            }
            ?>


        </div>
    </div>
</div>

</body>
</html>

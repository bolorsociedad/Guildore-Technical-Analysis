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
$place="news";
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

            <div style="float: right;font-size: 12px;margin-bottom: 20px;padding-right: 10px;color:#A4A4A4;">News from <a style="color:#585858;" href="http://www.ft.com" target="_blank">Financial Times</a></div>
        	<div class="title">
        		News
        	</div>

        	<div id="allNews">

            </div>

            

        </div>
    </div>
</div>

<script>
rssurl='http://www.ft.com/rss/home/europe';

$.get(rssurl, function(data) {
    var $xml = $(data);
    $xml.find("item").each(function() {
        var $this = $(this),
            item = {
                title: $this.find("title").text(),
                link: $this.find("link").text(),
                description: $this.find("description").text(),
                pubDate: $this.find("pubDate").text(),
                author: $this.find("author").text()
        }
        $("#allNews").append('<div class="news"><h1><a target="_blank" href="'+item["link"]+'">'+item["title"]+'</a></h1><p>'+item["description"]+'</p></div>');
    });
});
</script>

</body>
</html>

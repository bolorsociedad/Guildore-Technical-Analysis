<?php
session_start();
include("include/connect.php");
if (!empty($_GET["t"])) {
    $t=strtoupper(mysql_real_escape_string(strip_tags($_GET["t"])));
} else {
    $t="^GSPC";
}
if (!empty($_SESSION["guildore"])) {
    $sql=mysql_query("SELECT * FROM user WHERE user='".$_SESSION["guildore"]."'", $link);
    $user=mysql_fetch_array($sql);
}
$place="home";
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
<script src="js/indicators.js"></script>
<script src="js/showIndicators.js"></script>

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

</head>


<body>
<?php include_once("include/analyticstracking.php") ?>


<div id="loadHere" style="display:none;"></div>
<div class="content">
    <div class="left">
                <?php include("include/left.php"); ?>

    </div>
    <div class="right">
        <div style="margin-top: 20px;"></div>
        <div style="" id="loading">
            <div><p><i class="fa fa-circle-o-notch fa-spin"></i></p><p id="percentage" style="font-size: 20px;">0%</p><p id="tooLong" style="display:none;font-size: 18px;">It seems it's taking a bit long. Why don't you try to <a href="#" onclick="location.reload();">reload the page?</a></p></div>
        </div>
        <div class="stockInfo" style="display:none; margin: 0 10px;">
            <div style="float: right; text-align: right;">
                <a href="#" style="padding: 5px 10px;position:relative;top:5px;right:6px;" onclick="trash();" class="btn"><i class="fa fa-trash fa-2x"></i></a><a href="#" style="padding: 2px 5px;position:relative;top:11px;right:3px;" id="candlestickIcon" onclick="candlestick();" class="btn"><img src="images/candlestick.png" style="width: 30px;"></a><a href="#" id="lineIcon" style="display:none;padding: 2px 5px;position:relative;top:11px;right:3px;" onclick="candlestick();" class="btn"><img src="images/line.png" style="width: 30px;"></a><a href="#" class="btn" onclick="$('.addIndicatorDialog').fadeToggle();">Add indicator</a>
                <?php if (!empty($_SESSION["guildore"])) { ?>
                <a href="#" class="btn btn-blue" onclick="$('.addPortfolioDialog').slideToggle();">add to portfolio</a>
                <?php
                $sql=mysql_query("SELECT * FROM portfolio WHERE user='".$_SESSION["guildore"]."' AND ticker='".$t."'", $link);
                if (mysql_num_rows($sql)!=0) {
                ?><br><div style="margin-right: 5px;"><b>Stock in your portfolio</b></div><?php } ?>
                <div class="addPortfolioDialog">
                    <div style="width: 80%; margin: auto;">
                        <form action="addPortfolio.php" method="post" id="formPortfolio">
                            <input type="hidden" name="ticker" value="<?php echo $t; ?>">
                            <p style="margin-left: -10px;"><input type="text" id="shares" name="shares" placeholder="Number of shares"></p>
                            <p style="margin-left: -10px;"><input type="text" id="quote" name="quote" placeholder="Quote when the shares were purchased"></p>
                        </form>
                        <p style="text-align:right;"><a href="#" onclick="if ($('#shares').val()!=''&&$('#quote').val()!=''){$('#formPortfolio').submit();}">Add</a></p>
                    </div>
                </div>
                <?php } ?>
            </div>
            <h1 style="margin-right: 0;" id="stockName"></h1><h1 style="margin-left: -10px;"><span></span></h1><?php if (!empty($_SESSION["guildore"])) { ?><span id="star" onclick="star()"><i class="fa fa-star<?php
            $sql=mysql_query("SELECT * FROM watchlist WHERE user='".$_SESSION["guildore"]."' AND ticker='".$t."'", $link);
            if (mysql_num_rows($sql)==0) { echo '-o star'; } else { echo ' yellowStar'; }
            ?>" style="font-size: 24px;"></i></span><?php } ?>
            <div class="currentPrice">1250<span class="green"><i class="fa fa-caret-up"></i> 0.65%</span></div>

        </div>
        <div id="container" style="min-width: 310px; height: 500px; margin: 0 auto"></div>
        <div class="showLater">
            <div style="margin-bottom: 20px;"></div>
            <div class="addIndicatorDialog" style="height: 400px;">
                        <div style="width: 90%; margin: auto; padding-top: 10px;">
                        <div style="float: right; margin-right: 10px;"><a href="#" onclick="$('.addIndicatorDialog').fadeOut();">Close</a></div>
                          <div style="height: 350px;margin-top: 20px; overflow-y: scroll;width:100%;">
                            <p><a href="#" onclick="$('.movingAverageDialog').fadeIn();$('.addIndicatorDialog').fadeOut();">Moving average</a></p>
                            <p><a href="#" onclick="$('.exponentialMovingAverageDialog').fadeIn();$('.addIndicatorDialog').fadeOut();">Exponential moving average</a></p>
                            <p><a href="#" onclick="$('.bollingerBandsDialog').fadeIn();$('.addIndicatorDialog').fadeOut();">Bollinger Bands</a></p>
                            <p><a href="#" onclick="$('.standardDeviationDialog').fadeIn();$('.addIndicatorDialog').fadeOut();">Standard Deviation</a></p>
                            <p><a href="#" onclick="addVolume();$('.addIndicatorDialog').fadeOut();">Volume</a></p>
                            <p><a href="#" onclick="$('.ATRDialog').fadeIn();$('.addIndicatorDialog').fadeOut();">Average true range (ATR)</a></p>
                            <p><a href="#" onclick="$('.MACDDialog').fadeIn();$('.addIndicatorDialog').fadeOut();">MACD</a></p>

                          </div>
                          
                    </div>
            </div>
            <div class="dialog movingAverageDialog" style="height: 200px;">
                        <div style="text-align: right; padding: 20px;"><a href="#" onclick="$('.dialog').fadeOut();">Close</a></div>
                        <div style="width: 90%; margin: auto; padding-top: 10px;">
                            <p>Periods: <input value="30" style="width: 50px;" type="text" id="movingAverageInput"></p>
                            <p><a href="#" class="btn" onclick="if (parseInt($('#movingAverageInput').val())==$('#movingAverageInput').val()) { addMovingAverage(parseInt($('#movingAverageInput').val()));$('.dialog').fadeOut(); }">Add</a></p>
                        </div>
            </div>
            <div class="dialog exponentialMovingAverageDialog" style="height: 200px;">
                        <div style="text-align: right; padding: 20px;"><a href="#" onclick="$('.dialog').fadeOut();">Close</a></div>
                        <div style="width: 90%; margin: auto; padding-top: 10px;">
                            <p>Periods: <input value="30" style="width: 50px;" type="text" id="exponentialMovingAverageInput"></p>
                            <p><a href="#" class="btn" onclick="if (parseInt($('#exponentialMovingAverageInput').val())==$('#exponentialMovingAverageInput').val()) { addExponentialMovingAverage(parseInt($('#exponentialMovingAverageInput').val()));$('.dialog').fadeOut(); }">Add</a></p>
                        </div>
            </div>
            <div class="dialog bollingerBandsDialog" style="height: 250px;">
                        <div style="text-align: right; padding: 20px;"><a href="#" onclick="$('.dialog').fadeOut();">Close</a></div>
                        <div style="width: 90%; margin: auto; padding-top: 10px;">
                            <p>Periods: <input value="30" style="width: 50px;" type="text" id="bollingerBandsInput1"></p>
                            <p>Deviation: <input value="2" style="width: 50px;" type="text" id="bollingerBandsInput2"></p>

                            <p><a href="#" class="btn" onclick="if (parseInt($('#bollingerBandsInput1').val())==$('#bollingerBandsInput1').val()&&parseInt($('#bollingerBandsInput2').val())==$('#bollingerBandsInput2').val()) { addBollingerBands(parseInt($('#bollingerBandsInput1').val()),parseInt($('#bollingerBandsInput2').val()));$('.dialog').fadeOut(); }">Add</a></p>
                        </div>
            </div>

            <div class="dialog standardDeviationDialog" style="height: 200px;">
                        <div style="text-align: right; padding: 20px;"><a href="#" onclick="$('.dialog').fadeOut();">Close</a></div>
                        <div style="width: 90%; margin: auto; padding-top: 10px;">
                            <p>Periods: <input value="30" style="width: 50px;" type="text" id="standardDeviationInput"></p>
                            <p><a href="#" class="btn" onclick="if (parseInt($('#standardDeviationInput').val())==$('#standardDeviationInput').val()) { addStandardDeviation(parseInt($('#standardDeviationInput').val()));$('.dialog').fadeOut(); }">Add</a></p>
                        </div>
            </div>

            <div class="dialog ATRDialog" style="height: 200px;">
                        <div style="text-align: right; padding: 20px;"><a href="#" onclick="$('.dialog').fadeOut();">Close</a></div>
                        <div style="width: 90%; margin: auto; padding-top: 10px;">
                            <p>Periods: <input value="30" style="width: 50px;" type="text" id="ATRInput"></p>
                            <p><a href="#" class="btn" onclick="if (parseInt($('#ATRInput').val())==$('#ATRInput').val()) { addATR(parseInt($('#ATRInput').val()));$('.dialog').fadeOut(); }">Add</a></p>
                        </div>
            </div>

           <div class="dialog MACDDialog" style="height: 330px;">
                        <div style="text-align: right; padding: 20px;"><a href="#" onclick="$('.dialog').fadeOut();">Close</a></div>
                        <div style="width: 90%; margin: auto; padding-top: 10px;">
                            <p>Short period: <input value="12" style="width: 50px;" type="text" id="MACDInput1"></p>
                            <p>Long period: <input value="26" style="width: 50px;" type="text" id="MACDInput2"></p>
                            <p>Signal period: <input value="9" style="width: 50px;" type="text" id="MACDInput3"></p>

                            <p><a href="#" class="btn" onclick="if (parseInt($('#MACDInput1').val())==$('#MACDInput1').val()&&parseInt($('#MACDInput2').val())==$('#MACDInput2').val()&&parseInt($('#MACDInput3').val())==$('#MACDInput3').val()) { addMACD(parseInt($('#MACDInput1').val()),parseInt($('#MACDInput2').val()),parseInt($('#MACDInput3').val()));$('.dialog').fadeOut(); }">Add</a></p>
                        </div>
            </div>


            <div style="margin-bottom: 20px;"></div>
            <div class="allIndicators">

            </div>
            <div style="margin-bottom: 60px;"></div>
        </div>
    </div>
</div>

<script>
//jsonURL='http://autoc.finance.yahoo.com/autoc?query=<?php echo $t; ?>&callback=YAHOO.Finance.SymbolSuggest.ssCallback';
jsonURL='http://query.yahooapis.com/v1/public/yql?q=select%20%2a%20from%20yahoo.finance.quotes%20where%20symbol%20in%20%28%22<?php echo $t; ?>%22%29&env=store://datatables.org/alltableswithkeys&format=json';
    //$.getJSON('http://www.highcharts.com/samples/data/jsonp.php?filename=aapl-ohlcv.json&callback=?', function (data) {
    $.getJSON(jsonURL, function (data) {
        n=data["query"]["results"]["quote"]["Name"];
        if (n==null) {
            n='<?php echo $t; ?>';
        }
     $("#stockName").text(n);
    });
showChart("<?php if (!empty($t)) { echo $t; } else { echo '^GSPC'; } ?>");

function star() {
    var className = $('#star i').attr('class');
    if (className=="fa fa-star-o star") {
        $("#star i").removeClass(className).addClass("fa fa-star yellowStar");
    } else {
        $("#star i").removeClass(className).addClass("fa fa-star-o star");
    }

    $("#loadHere").load("addWatchlist.php?t=<?php echo $t; ?>");
}

//showIndicators();

function candlestick() {
    var chart = $('#container').highcharts();
    if (chart.series[0]["options"]["type"]=="line") {
        chart.series[0].update({
                    type: "candlestick"
                });    

$("#candlestickIcon").hide();
$("#lineIcon").show();

    } else {
        chart.series[0].update({
                    type: "line"
                });
$("#lineIcon").hide();
$("#candlestickIcon").show();


    }


    
}

function trash() {
    var chart = $('#container').highcharts();
    for (i=1;i<chart.series.length;i++) {
        chart.series[i].remove();
    }
    addVolume();
}

</script>
</body>
</html>

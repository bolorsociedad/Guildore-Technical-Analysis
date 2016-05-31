function getToday(y) {
    var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear()-y;

if(dd<10) {
    dd='0'+dd
} 

if(mm<10) {
    mm='0'+mm
} 

today = yyyy+'/'+mm+'/'+dd;
return today;
}

function showChart(t) {
    setTimeout(function() {$("#tooLong").fadeIn();}, 20000);
    ticker=t;
   
        var ohlc = [],
            volume = [],
            // set the allowed units for data grouping
            groupingUnits = [[
                'week',                         // unit name
                [1]                             // allowed multiples
            ], [
                'month',
                [1, 2, 3, 4, 6]
            ]];

    /*startDate=getToday(5);
    endDate=getToday(4);

    jsonURL='http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.historicaldata%20where%20symbol%20%3D%20%22'+ticker+'%22%20and%20startDate%20%3D%20%22'+startDate+'%22%20and%20endDate%20%3D%20%22'+endDate+'%22&format=json&diagnostics=true&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=';
    $.getJSON(jsonURL, function (data) {

        $("#percentage").html("20%");
        
        // split the data set into ohlc and volume
        var dataLength = data["query"]["count"];
        if (dataLength==0) {
            window.location='error.php';
        }
            i = 0;

        for (i=dataLength-1; i >= 0; i -= 1) {
            var d=new Date(data["query"]["results"]["quote"][i]["Date"]);
            ohlc.push([

                parseInt(d.getTime()), // the date
                parseFloat(data["query"]["results"]["quote"][i]["Open"]), // open
                parseFloat(data["query"]["results"]["quote"][i]["High"]), // high
                parseFloat(data["query"]["results"]["quote"][i]["Low"]), // low
                parseFloat(data["query"]["results"]["quote"][i]["Close"]) // close
            ]);

            volume.push([
                parseInt(d.getTime()), // the date
                parseFloat(data["query"]["results"]["quote"][i]["Volume"]) // the volume

            ]);
        }
    */
    startDate=getToday(4);
    endDate=getToday(3);
 
    /*startDate='2014-09-11';
    endDate=getToday();*/
    jsonURL='http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.historicaldata%20where%20symbol%20%3D%20%22'+ticker+'%22%20and%20startDate%20%3D%20%22'+startDate+'%22%20and%20endDate%20%3D%20%22'+endDate+'%22&format=json&diagnostics=true&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=';
    //$.getJSON('http://www.highcharts.com/samples/data/jsonp.php?filename=aapl-ohlcv.json&callback=?', function (data) {
    $.getJSON(jsonURL, function (data) {
        $("#percentage").html("25%");
        // split the data set into ohlc and volume
        var dataLength = data["query"]["count"];
        if (dataLength==0) {
            window.location='error.php';
        }
        

            i = 0;

        for (i=dataLength-1; i >= 0; i -= 1) {
            var d=new Date(data["query"]["results"]["quote"][i]["Date"]);
            ohlc.push([
                /*data[i][0], // the date
                data[i][1], // open
                data[i][2], // high
                data[i][3], // low
                data[i][4] // close*/
                parseInt(d.getTime()), // the date
                parseFloat(data["query"]["results"]["quote"][i]["Open"]), // open
                parseFloat(data["query"]["results"]["quote"][i]["High"]), // high
                parseFloat(data["query"]["results"]["quote"][i]["Low"]), // low
                parseFloat(data["query"]["results"]["quote"][i]["Close"]) // close
            ]);

            volume.push([
                /*data[i][0], // the date
                data[i][5] // the volume*/
                parseInt(d.getTime()), // the date
                parseFloat(data["query"]["results"]["quote"][i]["Volume"]) // the volume

            ]);
        }

    startDate=getToday(3);
    endDate=getToday(2);
 
    /*startDate='2014-09-11';
    endDate=getToday();*/
    jsonURL='http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.historicaldata%20where%20symbol%20%3D%20%22'+ticker+'%22%20and%20startDate%20%3D%20%22'+startDate+'%22%20and%20endDate%20%3D%20%22'+endDate+'%22&format=json&diagnostics=true&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=';
    //$.getJSON('http://www.highcharts.com/samples/data/jsonp.php?filename=aapl-ohlcv.json&callback=?', function (data) {
    $.getJSON(jsonURL, function (data) {
        $("#percentage").html("50%"); 
        // split the data set into ohlc and volume
        var dataLength = data["query"]["count"];

            i = 0;

        for (i=dataLength-1; i >= 0; i -= 1) {
            var d=new Date(data["query"]["results"]["quote"][i]["Date"]);
            ohlc.push([
                /*data[i][0], // the date
                data[i][1], // open
                data[i][2], // high
                data[i][3], // low
                data[i][4] // close*/
                parseInt(d.getTime()), // the date
                parseFloat(data["query"]["results"]["quote"][i]["Open"]), // open
                parseFloat(data["query"]["results"]["quote"][i]["High"]), // high
                parseFloat(data["query"]["results"]["quote"][i]["Low"]), // low
                parseFloat(data["query"]["results"]["quote"][i]["Close"]) // close
            ]);

            volume.push([
                /*data[i][0], // the date
                data[i][5] // the volume*/
                parseInt(d.getTime()), // the date
                parseFloat(data["query"]["results"]["quote"][i]["Volume"]) // the volume

            ]);
        }

    startDate=getToday(2);
    endDate=getToday(1);
 
    /*startDate='2014-09-11';
    endDate=getToday();*/
    jsonURL='http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.historicaldata%20where%20symbol%20%3D%20%22'+ticker+'%22%20and%20startDate%20%3D%20%22'+startDate+'%22%20and%20endDate%20%3D%20%22'+endDate+'%22&format=json&diagnostics=true&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=';
    //$.getJSON('http://www.highcharts.com/samples/data/jsonp.php?filename=aapl-ohlcv.json&callback=?', function (data) {
    $.getJSON(jsonURL, function (data) {
        $("#percentage").html("75%");
        // split the data set into ohlc and volume
        var dataLength = data["query"]["count"];

            i = 0;

        for (i=dataLength-1; i >= 0; i -= 1) {
            var d=new Date(data["query"]["results"]["quote"][i]["Date"]);
            ohlc.push([
                /*data[i][0], // the date
                data[i][1], // open
                data[i][2], // high
                data[i][3], // low
                data[i][4] // close*/
                parseInt(d.getTime()), // the date
                parseFloat(data["query"]["results"]["quote"][i]["Open"]), // open
                parseFloat(data["query"]["results"]["quote"][i]["High"]), // high
                parseFloat(data["query"]["results"]["quote"][i]["Low"]), // low
                parseFloat(data["query"]["results"]["quote"][i]["Close"]) // close
            ]);

            volume.push([
                /*data[i][0], // the date
                data[i][5] // the volume*/
                parseInt(d.getTime()), // the date
                parseFloat(data["query"]["results"]["quote"][i]["Volume"]) // the volume

            ]);
        }

    startDate=getToday(1);
    endDate=getToday(0);
 
    /*startDate='2014-09-11';
    endDate=getToday();*/
    jsonURL='http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.historicaldata%20where%20symbol%20%3D%20%22'+ticker+'%22%20and%20startDate%20%3D%20%22'+startDate+'%22%20and%20endDate%20%3D%20%22'+endDate+'%22&format=json&diagnostics=true&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=';
    //$.getJSON('http://www.highcharts.com/samples/data/jsonp.php?filename=aapl-ohlcv.json&callback=?', function (data) {
    $.getJSON(jsonURL, function (data) {
        $("#percentage").html("100%");
        // split the data set into ohlc and volume
        var dataLength = data["query"]["count"];

            i = 0;

        for (i=dataLength-1; i >= 0; i -= 1) {
            var d=new Date(data["query"]["results"]["quote"][i]["Date"]);
            ohlc.push([
                /*data[i][0], // the date
                data[i][1], // open
                data[i][2], // high
                data[i][3], // low
                data[i][4] // close*/
                parseInt(d.getTime()), // the date
                parseFloat(data["query"]["results"]["quote"][i]["Open"]), // open
                parseFloat(data["query"]["results"]["quote"][i]["High"]), // high
                parseFloat(data["query"]["results"]["quote"][i]["Low"]), // low
                parseFloat(data["query"]["results"]["quote"][i]["Close"]) // close
            ]);

            volume.push([
                /*data[i][0], // the date
                data[i][5] // the volume*/
                parseInt(d.getTime()), // the date
                parseFloat(data["query"]["results"]["quote"][i]["Volume"]) // the volume

            ]);
        }

        $("#loading").hide();
        if (ohlc.length>1) {
            dif=parseFloat(100*(ohlc[ohlc.length-1][1]-ohlc[ohlc.length-2][1])/ohlc[ohlc.length-2][1]).toFixed(2);
        } else {
            dif=0;
        }
        color="";
        if (dif<0) {
            color="red";
        }
        if (dif>0) {
            color="green";
        }
        if (dif>0) {
            caret="up";
        } else {
            caret="down";
        }
        if (ohlc.length==0) {

        }
        $(".stockInfo h1 span").text(t);
        $(".stockInfo .currentPrice").html(ohlc[ohlc.length-1][1]+'<span class="'+color+'"><i class="fa fa-caret-'+caret+'"></i> '+dif+'%</span>');
        $(".stockInfo").fadeIn();
        $(".showLater").fadeIn();


        priceData=ohlc;
        newVolume=volume;
        // create the chart
        $('#container').highcharts('StockChart', {

            rangeSelector: {
                selected: 1
            },

            title: {
                text: ''
            },

            yAxis: [{
                labels: {
                    align: 'right',
                    x: -3
                },
                title: {
                    text: 'Price'
                },
                height: '60%',
                lineWidth: 2
            }, {
                labels: {
                    align: 'right',
                    x: -3
                },
                title: {
                    text: 'Volume'
                },
                top: '65%',
                height: '35%',
                offset: 0,
                lineWidth: 2
            }],

            series: [{
                type: 'line',
                name: ticker,
                data: ohlc,
                dataGrouping: {
                    units: groupingUnits
                }
            }, {
                type: 'column',
                name: 'Volume',
                data: volume,
                yAxis: 1,
                dataGrouping: {
                    units: groupingUnits
                }
            }]
        });
        //displayIndicators();
        
    });});});});//});
}

var priceData=[];
var newVolume=[];
var graphType="line";
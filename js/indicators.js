function addMovingAverage(n) {
	// Moving average of n periods
	n=parseInt(n);
	localStorage["Moving Average"]=n;
	var chart = $('#container').highcharts();

	movingAverage=[];
	if (priceData.length>n) {
		s=0;
		for (i=0;i<=n-1;i++) {
			s+=priceData[i][1];
		}
		s=s/n;
		movingAverage.push([priceData[n][0],s]);
		for (i=n+1;i<priceData.length;i++) {
		s=movingAverage[i-n-1][1]-priceData[i-n][1]/n+priceData[i][1]/n;
		movingAverage.push([priceData[i][0],s]);
		}


	}

	


	chart.addSeries({
            name: 'MA '+n,
            data: movingAverage
        });
}



function addExponentialMovingAverage(n) {
	// Exponential moving average of n periods
	n=parseInt(n);
	localStorage["Exponential Moving Average"]=n;
	var chart = $('#container').highcharts();
	a=2/(n+1);
	movingAverage=[];
	if (priceData.length>n) {

		movingAverage.push([priceData[n][0],priceData[n][1]]);
		
	for (i=n+1;i<priceData.length;i++) {		
		s=a*priceData[i][1]+(1-a)*movingAverage[i-n-1][1];
		movingAverage.push([priceData[i][0],s]);
	}

	}

	




	chart.addSeries({
            name: 'EMA '+n,
            data: movingAverage
        });
}

function addBollingerBands(n, k) {
	// Bollinger bands n,k
	n=parseInt(n);
	k=parseInt(k);
	localStorage["Bollinger Bands"]=n+":"+k;
	var chart = $('#container').highcharts();

	newData0=[];
	if (priceData.length>n) {
		/*s=0;
		for (i=0;i<=n-1;i++) {
			s+=priceData[i][1];
		}
		s=s/n;
		newData.push([priceData[n][0],s]);*/

		for (i=n;i<priceData.length;i++) {
			m=0;
			sq=0;
			for (j=i-n;j<i;j++) {
				m+=priceData[j][1];
				sq+=priceData[j][1]*priceData[j][1];
			}
			s=sq/n - (m/n)*(m/n);
			newData0.push([priceData[i][0],Math.sqrt(s)]);
		}

	}

	movingAverage=[];
	if (priceData.length>n) {
		s=0;
		for (i=0;i<=n-1;i++) {
			s+=priceData[i][1];
		}
		s=s/n;
		movingAverage.push([priceData[n][0],s]);
		for (i=n+1;i<priceData.length;i++) {
		s=movingAverage[i-n-1][1]-priceData[i-n][1]/n+priceData[i][1]/n;
		movingAverage.push([priceData[i][0],s]);
		}


	}

	newData=movingAverage;
	for (i=0;i<newData.length;i++) {
		newData[i][1]+=k*newData0[i][1];

	}


	chart.addSeries({
            name: 'BB '+n,
            data: newData
        });
	
	newData=movingAverage;
	for (i=0;i<newData.length;i++) {
		newData[i][1]-=k*newData0[i][1];

	}


	chart.addSeries({
            name: 'BB '+n,
            data: newData
        });
	



}


function addStandardDeviation(n) {
	// Standar Deviation of n periods
	n=parseInt(n);
	localStorage["Standard Deviation"]=n;
	var chart = $('#container').highcharts();

	newData=[];
	if (priceData.length>n) {
		/*s=0;
		for (i=0;i<=n-1;i++) {
			s+=priceData[i][1];
		}
		s=s/n;
		newData.push([priceData[n][0],s]);*/

		for (i=n;i<priceData.length;i++) {
			m=0;
			sq=0;
			for (j=i-n;j<i;j++) {
				m+=priceData[j][1];
				sq+=priceData[j][1]*priceData[j][1];
			}
			s=sq/n - (m/n)*(m/n);
			newData.push([priceData[i][0],Math.sqrt(s)]);
		}

	}


	for(i=0;i<chart.yAxis.length;i++){
    if (chart.yAxis[i]["options"]["top"]=="65%") {
    	chart.yAxis[i].remove();
    }
    
	}

	chart.addAxis({
                labels: {
                    align: 'right',
                    x: -3
                },
                title: {
                    text: 'Standard Deviation'
                },
                top: '65%',
                height: '35%',
                offset: 0,
                lineWidth: 2
            });


	chart.addSeries({
            name: 'SD '+n,
            data: newData,
            yAxis: 2
        });

}



function addVolume() {
	// Volume
	var chart = $('#container').highcharts();

	
	for(i=0;i<chart.yAxis.length;i++){
    if (chart.yAxis[i]["options"]["top"]=="65%") {
    	chart.yAxis[i].remove();
    }
    
	}

	chart.addAxis({
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
            });


	chart.addSeries({
            name: 'Volume',
            data: newVolume,
            type: 'column',
            yAxis: 2
        });

}


function addATR(n) {
	// Average True Range of n periods
	n=parseInt(n);
	localStorage["Average True Range"]=n;
	var chart = $('#container').highcharts();

	newData=[];
	if (priceData.length>n+1) {
		s=0;
		for (i=1;i<=n-1;i++) {
			m=Math.max(priceData[i][2]-priceData[i][3],Math.abs(priceData[i][2]-priceData[i-1][4]),Math.max(priceData[i][3]-priceData[i-1][4]));
			s+=m;
		}
		s=s/n;
		newData.push([priceData[n][0],s]);

		for (i=n+1;i<priceData.length;i++) {
		trt=Math.max(priceData[i][2]-priceData[i][3],Math.abs(priceData[i][2]-priceData[i-1][4]),Math.max(priceData[i][3]-priceData[i-1][4]));
		s=(newData[i-n-1][1]*(n-1)+trt)/n;
		newData.push([priceData[i][0],s]);
		}

	}


	for(i=0;i<chart.yAxis.length;i++){
    if (chart.yAxis[i]["options"]["top"]=="65%") {
    	chart.yAxis[i].remove();
    }
    
	}

	chart.addAxis({
                labels: {
                    align: 'right',
                    x: -3
                },
                title: {
                    text: 'Average True Range'
                },
                top: '65%',
                height: '35%',
                offset: 0,
                lineWidth: 2
            });


	chart.addSeries({
            name: 'ATR '+n,
            data: newData,
            yAxis: 2
        });

}



function addMACD(n,m,d) {
	// MACD
	n=parseInt(n);
	m=parseInt(m);
	d=parseInt(d);
	localStorage["MACD"]=n+":"+m+":"+d;
	var chart = $('#container').highcharts();

	

	a=2/(n+1);
	movingAverage=[];
	if (priceData.length>n) {

		movingAverage.push([priceData[n][0],priceData[n][1]]);
		
	for (i=n+1;i<priceData.length;i++) {		
		s=a*priceData[i][1]+(1-a)*movingAverage[i-n-1][1];
		movingAverage.push([priceData[i][0],s]);
	}

	}

	

	a=2/(m+1);
	movingAverage2=[];
	if (priceData.length>m) {

		movingAverage2.push([priceData[m][0],priceData[m][1]]);
		
	for (i=m+1;i<priceData.length;i++) {		
		s=a*priceData[i][1]+(1-a)*movingAverage2[i-m-1][1];
		movingAverage2.push([priceData[i][0],s]);
	}

	}

	

	newData=[];

	for (i=1;i<=Math.min(movingAverage2.length,movingAverage.length);i++) {
		newData.unshift([movingAverage[movingAverage.length-i][0],movingAverage[movingAverage.length-i][1]-movingAverage2[movingAverage2.length-i][1]]);
	}










	for(i=0;i<chart.yAxis.length;i++){
    if (chart.yAxis[i]["options"]["top"]=="65%") {
    	chart.yAxis[i].remove();
    }
    
	}

	chart.addAxis({
                labels: {
                    align: 'right',
                    x: -3
                },
                title: {
                    text: 'MACD'
                },
                top: '65%',
                height: '35%',
                offset: 0,
                lineWidth: 2
            });


	chart.addSeries({
            name: 'MACD',
            data: newData,
            yAxis: 2
        });



	a=2/(d+1);
	movingAverage=[];
	if (newData.length>d) {

		movingAverage.push([newData[d][0],newData[d][1]]);
		
	for (i=d+1;i<newData.length;i++) {		
		s=a*newData[i][1]+(1-a)*movingAverage[i-d-1][1];
		movingAverage.push([newData[i][0],s]);
	}

	}

		chart.addSeries({
            name: 'MACD Signal',
            data: movingAverage,
            yAxis: 2
        });




}

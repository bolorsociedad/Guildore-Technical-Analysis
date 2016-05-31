function displayIndicators() {
	if (localStorage["Moving Average"] != null) {
		addMovingAverage(parseInt(localStorage["Moving Average"]));
	}

}

function showIndicators() {
	if (localStorage["Moving Average"] != null) {
		$(".allIndicators").append('<div class="item">Moving Average<div style="float: right;">Periods: <input value="'+localStorage['Moving Average']+'" style="width: 40px;" type="text"><a href="#">Update</a></div></div>')
	}
}
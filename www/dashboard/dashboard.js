google.charts.load('current', {'packages':['gauge', 'corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

var dataTemp = google.visualization.arrayToDataTable([
['Label', 'Value'],
['Temp', 72]
]);

var dataRH = google.visualization.arrayToDataTable([
['Label', 'Value'],
['RH', 55]
]);

var dataVPD = google.visualization.arrayToDataTable([
['Label', 'Value'],
['VPD', 8]
]);

var optionsTemp = {
  //width: 300, 
  height: 300,
  redFrom: 85, redTo: 100,
  yellowFrom:60, yellowTo: 70,
  greenFrom:71, greenTo:84,
  minorTicks: 5
};

var optionsRH = {
//  width: 400, 
  height: 300,
  redFrom: 70, redTo: 80,
  yellowFrom:40, yellowTo: 50,
  greenFrom:50, greenTo:70,
  minorTicks: 5
};

var optionsVPD = {
//  width: 400,
  width: '100%', 
  height: 300,
  redFrom: 10, redTo: 14,
  yellowFrom: 5, yellowTo: 7.5,
  greenFrom:7.5, greenTo:10,
  minorTicks: 1,
  max: 15
};

var chart_temp = new google.visualization.Gauge(document.getElementById('chart_temp'));
chart_temp.draw(dataTemp, optionsTemp);

var chart_rh = new google.visualization.Gauge(document.getElementById('chart_rh'));
chart_rh.draw(dataRH, optionsRH);

var chart_vpd = new google.visualization.Gauge(document.getElementById('chart_vpd'));
chart_vpd.draw(dataVPD, optionsVPD);


var dataHist = google.visualization.arrayToDataTable([
['Day', 'Temp', 'RH', 'VPD'],
['1/1', 73, 60, 9],
['1/2', 74, 59, 8.5],
['1/3', 75, 60, 9],
['1/4', 74.5, 60, 9],
['1/5', 74, 62, 8.2],
['1/6', 74, 60, 9]
]);

var optionsHist = {
 title: 'Past 24 hours',
 titleTextStyle:{ color: 'white', bold:'true'},
 curveType: 'function',
 legend: { position: 'bottom', textStyle: {color: 'white'} },
 height: 200,
 backgroundColor: 'transparent'

};

var chart_hist = new google.visualization.LineChart(document.getElementById('chart_history'));
chart_hist.draw(dataHist, optionsHist);

}


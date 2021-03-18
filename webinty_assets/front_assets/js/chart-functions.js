
var barChartData = {
	labels : ["January","February","March","April","May","June","July"],
	datasets : [
		{
			fillColor : "rgba(220,220,220,0.5)",
			strokeColor : "rgba(211,209,209,1)",
			highlightFill: "rgba(220,220,220,0.75)",
			highlightStroke: "rgba(211,209,209,1)",
			data : [
				30,
				60,
				50,
				60,
				20,
				80,
				40
			]
		},
		/*{
			fillColor : "rgba(151,187,205,0.5)",
			strokeColor : "rgba(151,187,205,1)",
			highlightFill : "rgba(151,187,205,0.75)",
			highlightStroke : "rgba(151,187,205,1)",
			data : [
				90,
				20,
				80,
				10,
				60,
				30,
				90
			]
		}*/
	]

}
//------------------------> 2
var doughnutData = [
				{
					value: 300,
					color:"#F7464A",
					highlight: "#FF5A5E",
					label: "Red"
				},
				{
					value: 50,
					color: "#1CCDCA",
					highlight: "#00BEBB",
					label: "Green"
				},
				{
					value: 100,
					color: "#B853A3",
					highlight: "#AC4297",
					label: "Yellow"
				},
				{
					value: 40,
					color: "#0072A5",
					highlight: "#006391",
					label: "Grey"
				},
				{
					value: 120,
					color: "#1B2228",
					highlight: "#233039",
					label: "Dark Grey"
				}

			];

//------------------------> 3
var lineChartData = {
			labels : ["January","February","March","April","May","June","July"],
			datasets : [
				{
					label: "My First dataset",
					fillColor : "rgba(220,220,220,0.2)",
					strokeColor : "rgba(220,220,220,1)",
					pointColor : "rgba(220,220,220,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(220,220,220,1)",
					data : [
						30,
						60,
						50,
						60,
						20,
						80,
						40
					]
				},
				{
					label: "My Second dataset",
					fillColor : "rgba(151,187,205,0.2)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(151,187,205,1)",
					data : [
						90,
						20,
						80,
						10,
						60,
						30,
						90
					]
				}
			]

		}
		
//------------------------>	4
var pieData = [
				{
					value: 200,
					color:"#F7464A",
					highlight: "#FF5A5E",
					label: "Red"
				},
				{
					value: 50,
					color: "#1CCDCA",
					highlight: "#00BEBB",
					label: "Green"
				},
				{
					value: 100,
					color: "#B853A3",
					highlight: "#AC4297",
					label: "Yellow"
				},
				{
					value: 80,
					color: "#0072A5",
					highlight: "#006391",
					label: "Grey"
				},
				{
					value: 120,
					color: "#1B2228",
					highlight: "#233039",
					label: "Dark Grey"
				}

			];

//------------------------>	5	
var polarData = [
				{
					value: 200,
					color:"#F7464A",
					highlight: "#FF5A5E",
					label: "Red"
				},
				{
					value: 50,
					color: "#46BFBD",
					highlight: "#5AD3D1",
					label: "Green"
				},
				{
					value: 150,
					color: "#FDB45C",
					highlight: "#FFC870",
					label: "Yellow"
				},
				{
					value: 110,
					color: "#949FB1",
					highlight: "#A8B3C5",
					label: "Grey"
				},
				{
					value: 80,
					color: "#4D5360",
					highlight: "#616774",
					label: "Dark Grey"
				}

			];

//------------------------>	6	
var radarChartData = {
		labels: ["Eating", "Drinking", "Sleeping", "Designing", "Coding", "Cycling", "Running"],
		datasets: [
			{
				label: "My First dataset",
				fillColor: "rgba(220,220,220,0.2)",
				strokeColor: "rgba(220,220,220,1)",
				pointColor: "rgba(220,220,220,1)",
				pointStrokeColor: "#fff",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(220,220,220,1)",
				data: [65,59,90,81,56,55,40]
			},
			{
				label: "My Second dataset",
				fillColor: "rgba(151,187,205,0.2)",
				strokeColor: "rgba(151,187,205,1)",
				pointColor: "rgba(151,187,205,1)",
				pointStrokeColor: "#fff",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(151,187,205,1)",
				data: [28,48,40,19,96,27,100]
			}
		]
	};
						
window.onload = function(){
	"use strict";
	$("#canvas_chart1").appear(function() {
		var ctx = $("#canvas_chart1").get(0).getContext("2d");
		window.myBar = new Chart(ctx).Bar(barChartData, {responsive : true });
	});
	
	$("#canvas_chart2").appear(function() {
		var ctx2 = $("#canvas_chart2").get(0).getContext("2d");
		window.myDoughnut = new Chart(ctx2).Doughnut(doughnutData, {responsive : true });
	});
	
    $("#canvas_chart3").appear(function() {
		var ctx3 = $("#canvas_chart3").get(0).getContext("2d");
		window.myLine = new Chart(ctx3).Line(lineChartData, {responsive: true });
	});
	
	$("#canvas_chart4").appear(function() {
		var ctx4 = $("#canvas_chart4").get(0).getContext("2d");
		window.myPie = new Chart(ctx4).Pie(pieData, {responsive: true });
	});
	
	$("#canvas_chart5").appear(function() {
		var ctx5 = $("#canvas_chart5").get(0).getContext("2d");
		window.myPolarArea = new Chart(ctx5).PolarArea(polarData, {responsive:true });
	});
	
	$("#canvas_chart6").appear(function() {
		var ctx6 = $("#canvas_chart6").get(0).getContext("2d");
		window.myRadar = new Chart(ctx6).Radar(radarChartData, {responsive: true });
	});
	
	
}
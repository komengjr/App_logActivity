$(function() {
    "use strict";
	  
	  // chart 1
	 
		  var ctx = document.getElementById('dash2-chart1').getContext('2d');
		
			var myChart = new Chart(ctx, {
				type: 'bar',
				data: {
					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep"],
					datasets: [{
						label: 'Target',
						data: [24, 23, 27, 15, 27, 23, 31, 41, 31, 25],
						backgroundColor: 'rgba(43, 201, 69, 0.57)',
						// backgroundColor: 'rgba(0, 0, 0, 0.07)',
						borderColor: "transparent",
						borderWidth: 3
					}, {
						label: 'Selesai',
						type: 'line',
						data: [24, 8, 12, 5, 12, 8, 16, 25, 15, 10],
						backgroundColor: "rgba(3, 208, 234, 0.23)",
						borderColor: "#03d0ea",
						pointBackgroundColor:'transparent',
                        pointHoverBackgroundColor:'#03d0ea',
						pointBorderWidth :2,
						pointRadius :3,
						pointHoverRadius :3,
						borderWidth: 3
						
					}]
				},
			options: {
				maintainAspectRatio: false,
				legend: {
				  display: false,
				  labels: {
					fontColor: '#585757',  
					boxWidth:40
				  }
				},
				tooltips: {
				  displayColors:false
				},	
			  scales: {
				  xAxes: [{
					barPercentage: .3,
					ticks: {
						beginAtZero:true,
						fontColor: '#585757'
					},
					gridLines: {
					  display: true ,
					  color: "rgba(0, 0, 0, 0.05)"
					},
				  }],
				   yAxes: [{
					ticks: {
						beginAtZero:true,
						fontColor: '#585757'
					},
					gridLines: {
					  display: true ,
					  color: "rgba(0, 0, 0, 0.05)"
					},
				  }]
				 }

			 }
			}); 
			
			
	
	  });	
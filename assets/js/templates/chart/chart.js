$(function () {
	/* ChartJS
	 * -------
	 * Data and config for chartjs
	 */
	"use strict";
	$.ajax({
		url: "http://localhost/sispakfian_16/diagnosa/get_probabilitas_penyakit",
		method: "GET",
		dataType: "json",

		error: function (xhr, status, error) {
			alert(error);
			console.warn(xhr.responseText);
		},
		success: function (data) {
			var nama_penyakit = [];
			var percentage = [];
			data.probabilitas_penyakit.map((prob_penyakit) => {
				nama_penyakit.push(prob_penyakit.nama_penyakit);
				percentage.push(Math.floor(prob_penyakit.naive_bayes * 100));
			});
			var data = {
				labels: nama_penyakit,
				datasets: [
					{
						label: "# Percantage (%)",
						data: percentage,
						backgroundColor: [
							"rgba(255, 99, 132, 0.2)",
							"rgba(54, 162, 235, 0.2)",
							"rgba(255, 206, 86, 0.2)",
							"rgba(75, 192, 192, 0.2)",
							"rgba(153, 102, 255, 0.2)",
							"rgba(255, 159, 64, 0.2)",
						],
						borderColor: [
							"rgba(255,99,132,1)",
							"rgba(54, 162, 235, 1)",
							"rgba(255, 206, 86, 1)",
							"rgba(75, 192, 192, 1)",
							"rgba(153, 102, 255, 1)",
							"rgba(255, 159, 64, 1)",
						],
						borderWidth: 1,
						fill: false,
					},
				],
			};

			var options = {
				scales: {
					yAxes: [
						{
							ticks: {
								beginAtZero: true,
							},
							gridLines: {
								color: "rgba(204, 204, 204,0.1)",
							},
						},
					],
					xAxes: [
						{
							gridLines: {
								color: "rgba(204, 204, 204,0.1)",
							},
						},
					],
				},
				legend: {
					display: false,
				},
				elements: {
					point: {
						radius: 0,
					},
				},
			};

			var chart = $("#barChart");
			var myBarChart = new Chart(chart, {
				type: "bar",
				data: data,
				options: options,
			});
		},
	});
});

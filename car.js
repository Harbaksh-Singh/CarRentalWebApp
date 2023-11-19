$(document).ready(function () {
	$("#submitButton").click(function () {
		submitForm();
	});

	function submitForm() {
		console.log("Submit form button clicked");
		var formData = $("#registrationForm").serialize();
		$.ajax({
			type: "POST",
			url: "car.php",
			data: formData,
			success: function (response) {
				$("#result").html(response);
				alert("Success");
			},
		});
	}

	$("#displayButton").click(function () {
		$.ajax({
			type: "GET",
			url: "car.php",
			success: function (response) {
				var cars = JSON.parse(response);
				var html = "<table class='table table-bordered table-striped'>";
				html +=
					"<thead><tr><th>VIN</th><th>Make</th><th>Model</th><th>Year</th><th>Colour</th><th>Seats</th><th>Cost Per Day</th><th>Currently Available</th></tr></thead><tbody>";

				for (var i = 0; i < cars.length; i++) {
					html +=
						"<tr>" +
						"<td>" +
						cars[i].VIN_number +
						"</td>" +
						"<td>" +
						cars[i].make +
						"</td>" +
						"<td>" +
						cars[i].model +
						"</td>" +
						"<td>" +
						cars[i].year +
						"</td>" +
						"<td>" +
						cars[i].colour +
						"</td>" +
						"<td>" +
						cars[i].number_of_seats +
						"</td>" +
						"<td>" +
						cars[i].cost_per_day +
						"</td>" +
						"<td>" +
						cars[i].currently_available +
						"</td>" +
						"</tr>";
				}

				html += "</tbody></table>";

				// Display the table in the resultMessage div
				$("#resultMessage").html(html);
			},
		});
	});
});

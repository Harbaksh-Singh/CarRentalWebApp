$(document).ready(function () {
	$("#submitButton").click(function () {
		submitForm();
	});

	function submitForm() {
		var formData = $("#registrationForm").serialize();
		$.ajax({
			type: "POST",
			url: "functionsCar.php",
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
            url: "functionsCar.php",
            success: function (response) {
                var cars = JSON.parse(response);
                var html = "<table class='table table-bordered table-striped'>";
                html += "<thead><tr><th>VIN</th><th>Make</th><th>Model</th><th>Year</th><th>Colour</th><th>Seats</th><th>Cost Per Day</th><th>Currently Availible</th></tr></thead><tbody>";
    
                for (var i = 0; i < cars.length; i++) {
                    html +=
                        "<tr>" +
                        "<td>" + cars[i].VIN_number + "</td>" +
                        "<td>" + cars[i].make + "</td>" +
                        "<td>" + cars[i].model + "</td>" +
                        "<td>" + cars[i].year + "</td>" +
                        "<td>" + cars[i].colour + "</td>" +
                        "<td>" + cars[i].number_of_seats + "</td>" +
                        "<td>" + cars[i].cost_per_day + "</td>" +
                        "<td>" + cars[i].currently_availible + "</td>" +
                        "</tr>";
                }
    
                html += "</tbody></table>";
    
                // Display the table in the resultMessage div
                $("#resultMessage").html(html);
            },
        });
    });
    // // Add an event listener for the submit button
    // $("#submitButton").click(function () {
    //     // Assuming you have a variable 'resultString' containing the string you want to display
    //     var resultString = "Subasdasdmission asdasdasdsuasdasdasdccessful!"; // Replace with your actual result string

    //     $("#resultMessage").text(resultString);
    // });
});

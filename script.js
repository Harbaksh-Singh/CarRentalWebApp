$(document).ready(function () {
	$("#submitButton").click(function () {
		submitForm();
	});

	function submitForm() {
		var formData = $("#registrationForm").serialize();
		$.ajax({
			type: "POST",
			url: "functions.php",
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
			url: "functions.php",
			success: function (response) {
				var customers = JSON.parse(response);
				var html = "";
				for (var i = 0; i < customers.length; i++) {
					html +=
						"<tr>" +
						"<td>" +
						customers[i].customer_id +
						"</td>" +
						"<td>" +
						customers[i].first_name +
						"</td>" +
						"<td>" +
						customers[i].last_name +
						"</td>" +
						"<td>" +
						customers[i].email +
						"</td>" +
						"<td>" +
						customers[i].phone_number +
						"</td>" +
						"<td>" +
						customers[i].address +
						"</td>" +
						"<td>" +
						customers[i].date_of_birth +
						"</td>" +
						"</tr>";
				}
				$("#customersTable tbody").html(html);
			},
		});
	});
    // Add an event listener for the submit button
    $("#submitButton").click(function () {
        // Assuming you have a variable 'resultString' containing the string you want to display
        var resultString = "Submission asdasdasdsuccessful!"; // Replace with your actual result string

        // Display the result string in the resultMessage div
        $("#resultMessage").text(resultString);
    });
});

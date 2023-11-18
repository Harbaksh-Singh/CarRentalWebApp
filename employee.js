$(document).ready(function () {
	$("#submitButton").click(function () {
		submitForm();
	});

	function submitForm() {
		var formData = $("#registrationForm").serialize();
		$.ajax({
			type: "POST",
			url: "employee.php",
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
            url: "employee.php",
            success: function (response) {
                var employees = JSON.parse(response);
                var html = "<table class='table table-bordered table-striped'>";
                html += "<thead><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone Number</th><th>position</th></tr></thead><tbody>";
    
                for (var i = 0; i < employees.length; i++) {
                    html +=
                        "<tr>" +
                        "<td>" + employees[i].employee_ID + "</td>" +
                        "<td>" + employees[i].first_name + "</td>" +
                        "<td>" + employees[i].last_name + "</td>" +
                        "<td>" + employees[i].email + "</td>" +
                        "<td>" + employees[i].phone_number + "</td>" +
                        "<td>" + employees[i].position + "</td>" +
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

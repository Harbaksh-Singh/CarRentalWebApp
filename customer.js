$(document).ready(function () {
	$("#submitButton").click(function () {
		submitForm();
	});

	function submitForm() {
		var formData = $("#registrationForm").serialize();
		$.ajax({
			type: "POST",
			url: "customer.php",
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
			url: "customer.php",
			success: function (response) {
				var customers = JSON.parse(response);
				var html = "<table class='table table-bordered table-striped'>";
				html +=
					"<thead><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone Number</th><th>Address</th><th>Date of Birth</th></tr></thead><tbody>";

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

				html += "</tbody></table>";

				// Display the table in the resultMessage div
				$("#resultMessage").html(html);
			},
		});
		populateDropdown();
	});

	function populateDropdown() {
		$.ajax({
			url: "customer.php?action=getCustomers",
			type: "GET",
			dataType: "json",
			success: function (data) {
				if (data.length > 0) {
					var dropdown = $("#customerDropdown");
					dropdown.empty();
					dropdown.append($("<option>").val("").text("Select a Customer"));
					$.each(data, function (index, customer) {
						dropdown.append(
							$("<option>")
								.val(customer.customer_id)
								.text(
									customer.customer_id +
										": " +
										customer.first_name +
										" " +
										customer.last_name
								)
						);
					});
				}
			},
			error: function () {
				alert("Error fetching customers.");
			},
		});
	}

	populateDropdown();

	$("#removeCustomer").click(function () {
		var selectedCustomerId = $("#customerDropdown").val();
		alert(selectedCustomerId);
		// Check if a customer is selected
		if (selectedCustomerId) {
			// Confirm the removal with a user prompt
			var confirmRemove = confirm(
				"Are you sure you want to remove this customer?"
			);
			if (confirmRemove) {
				// Send an AJAX request to remove the customer
				$.ajax({
					url: "customer.php?action=removeCustomer",
					type: "POST",
					data: { customer_id: selectedCustomerId },
					success: function (response) {
						alert("Customer Removed Successfully");
						populateDropdown();
					},
					error: function () {
						alert("Error removing the customer.");
					},
				});
			}
		} else {
			alert("Please select a customer to remove.");
		}
	});
});

// Function to populate the insurance coverage types table
function populateInsuranceTable() {
	$.ajax({
		url: "insurance.php?action=getInsuranceTypes",
		type: "GET",
		dataType: "json",
		success: function (data) {
			var insuranceTableBody = $("#insuranceTableBody");

			// Clear existing table rows
			insuranceTableBody.empty();

			// Populate the table with insurance coverage types
			$.each(data, function (index, insurance) {
				var row = $("<tr>");
				row.append($("<td>").text(insurance.insurance_id));
				row.append($("<td>").text(insurance.coverage_type));
				row.append($("<td>").text(insurance.cost_per_day));
				row.append($("<td>").text(insurance.insurance_provider));
				insuranceTableBody.append(row);
			});
		},
		error: function () {
			alert("Error fetching insurance coverage types.");
		},
	});
}

// Call the function to populate the table when the page loads
$(document).ready(function () {
	populateInsuranceTable();
});

INSERT INTO customer (customer_id, first_name, last_name, email, phone_number, address, date_of_birth)
VALUES ('CUST001', 'John', 'Doe', 'johndoe@email.com', '555-123-4567', '123 Main St, Toronto, Canada', '2000-05-15');

INSERT INTO customer (customer_id, first_name, last_name, email, phone_number, address, date_of_birth)
VALUES ('CUST002', 'Jane', 'Smith', 'janesmith@email.com', '555-987-6543', '456 Elm St, Oakville, Canada', '1995-09-22');

INSERT INTO customer (customer_id, first_name, last_name, email, phone_number, address, date_of_birth)
VALUES ('CUST003', 'Michael', 'Johnson', 'michael@email.com', '555-555-5555', '789 Oak St, Brampton, Canada', '1965-12-10');

INSERT INTO customer (customer_id, first_name, last_name, email, phone_number, address, date_of_birth)
VALUES ('CUST004', 'Emily', 'Johnson', 'emily@email.com', '555-333-2222', '101 Pine St, Brampton, Canada', '1991-03-28');

INSERT INTO customer (customer_id, first_name, last_name, email, phone_number, address, date_of_birth)
VALUES ('CUST005', 'David', 'Brown', 'david@email.com', '555-777-8888', '202 Cedar St, Caledon, Canada', '1987-07-14');

INSERT INTO car (VIN_number, make, model, year, colour, number_of_seats, cost_per_day, currently_available)
VALUES ('VIN001', 'Toyota', 'Camry', '2022', 'Blue', 5, 50.00, 'Y');

INSERT INTO car (VIN_number, make, model, year, colour, number_of_seats, cost_per_day, currently_available)
VALUES ('VIN002', 'Honda', 'Civic', '2024', 'White', 7, 40.00, 'Y');

INSERT INTO car (VIN_number, make, model, year, colour, number_of_seats, cost_per_day, currently_available)
VALUES ('VIN003', 'Ford', 'F150', '2020', 'Silver', 2, 70.00, 'Y');

INSERT INTO car (VIN_number, make, model, year, colour, number_of_seats, cost_per_day, currently_available)
VALUES ('VIN004', 'BMW', 'X5M', '2023', 'Black', 4, 150.00, 'Y');

INSERT INTO car (VIN_number, make, model, year, colour, number_of_seats, cost_per_day, currently_available)
VALUES ('VIN005', 'Mercedes Benz', 'S63', '2022', 'Black', 5, 180.00, 'Y');

INSERT INTO insurance (insurance_id, coverage_type, cost_per_day, insurance_provider)
VALUES ('INS001', 'NA', 0.00, 'NA');

INSERT INTO insurance (insurance_id, coverage_type, cost_per_day, insurance_provider)
VALUES ('INS002', 'Basic', 10.00, 'State Farm');

INSERT INTO insurance (insurance_id, coverage_type, cost_per_day, insurance_provider)
VALUES ('INS003', 'Premium', 30.00, 'AllState');

INSERT INTO insurance (insurance_id, coverage_type, cost_per_day, insurance_provider)
VALUES ('INS004', 'Extended', 50.00, 'CAA');

INSERT INTO insurance (insurance_id, coverage_type, cost_per_day, insurance_provider)
VALUES ('INS005', 'Extended PLUS', 100.00, 'CAA');

INSERT INTO booking (booking_ID, customer_id, VIN_number, insurance_ID, pick_up_day, number_of_days, total_amount)
VALUES ('BOOK001', 'CUST001', 'VIN001', 'INS001', '2023-10-10', 5, 250.00);

INSERT INTO booking (booking_ID, customer_id, VIN_number, insurance_ID, pick_up_day, number_of_days, total_amount)
VALUES ('BOOK002', 'CUST002', 'VIN002', 'INS002', '2023-10-12', 3, 150.00);

INSERT INTO booking (booking_ID, customer_id, VIN_number, insurance_ID, pick_up_day, number_of_days, total_amount)
VALUES ('BOOK003', 'CUST003', 'VIN003', 'INS001', '2023-10-15', 7, 560.00);

INSERT INTO booking (booking_ID, customer_id, VIN_number, insurance_ID, pick_up_day, number_of_days, total_amount)
VALUES ('BOOK004', 'CUST004', 'VIN004', 'INS003', '2023-10-18', 4, 720.00);

INSERT INTO booking (booking_ID, customer_id, VIN_number, insurance_ID, pick_up_day, number_of_days, total_amount)
VALUES ('BOOK005', 'CUST005', 'VIN005', 'INS004', '2023-10-20', 6, 1380.00);

INSERT INTO booking (booking_ID, customer_id, VIN_number, insurance_ID, pick_up_day, number_of_days, total_amount)
VALUES ('BOOK006', 'CUST005', 'VIN001', 'INS004', '2023-10-20', 6, 300.00);

INSERT INTO employee (employee_ID, last_name, first_name, email, phone_number, position)
VALUES ('EMP001', 'Smith', 'John', 'john.smith@email.com', '555-111-2222', 'Manager');

INSERT INTO employee (employee_ID, last_name, first_name, email, phone_number, position)
VALUES ('EMP002', 'Johnson', 'Emily', 'emily.johnson@email.com', '555-333-4444', 'Manager');

INSERT INTO employee (employee_ID, last_name, first_name, email, phone_number, position)
VALUES ('EMP003', 'Brown', 'Michael', 'michael.brown@email.com', '555-555-6666', 'Technician');

INSERT INTO employee (employee_ID, last_name, first_name, email, phone_number, position)
VALUES ('EMP004', 'Doe', 'Jessica', 'jessica.doe@email.com', '555-777-8448', 'Technician');

INSERT INTO employee (employee_ID, last_name, first_name, email, phone_number, position)
VALUES ('EMP005', 'Williams', 'David', 'david.williams@email.com', '555-999-0000', 'Technician');

INSERT INTO billing (billing_ID, booking_ID, bill_date, status, discount_amount, late_fees, taxed_amount, total_amount)
VALUES ('BILL001', 'BOOK001', '2023-11-15', 'BILLED', 10.00, 0.00, 32.5, 272.50);

INSERT INTO billing (billing_ID, booking_ID, bill_date, status, discount_amount, late_fees, taxed_amount, total_amount)
VALUES ('BILL002', 'BOOK002', '2023-11-16', 'BILLED', 5.00, 0.00, 19.5, 164.50);

INSERT INTO billing (billing_ID, booking_ID, bill_date, status, discount_amount, late_fees, taxed_amount, total_amount)
VALUES ('BILL003', 'BOOK003', '2023-11-17', 'BILLED', 20.00, 0.00, 72.8, 612.80);

INSERT INTO billing (billing_ID, booking_ID, bill_date, status, discount_amount, late_fees, taxed_amount, total_amount)
VALUES ('BILL004', 'BOOK004', '2023-11-18', 'BILLED', 100.00, 0.00, 93.6, 713.60);

INSERT INTO billing (billing_ID, booking_ID, bill_date, status, discount_amount, late_fees, taxed_amount, total_amount)
VALUES ('BILL005', 'BOOK005', '2023-11-19', 'BILLED', 150.00, 0.00, 179.4, 1409.40);

INSERT INTO maintenance (maintenance_ID, VIN_number, maintenance_type, maintenance_date, description, employee_ID, total_cost)
VALUES (1, 'VIN001', 'Oil Change', '2023-10-05', 'Regular maintenance', 'EMP002', 75.00);

INSERT INTO maintenance (maintenance_ID, VIN_number, maintenance_type, maintenance_date, description, employee_ID, total_cost)
VALUES (2, 'VIN002', 'Brake Replacement', '2023-10-10', 'Brake pads and rotors', 'EMP003', 200.00);

INSERT INTO maintenance (maintenance_ID, VIN_number, maintenance_type, maintenance_date, description, employee_ID, total_cost)
VALUES (3, 'VIN003', 'Tire Rotation', '2023-10-15', 'Rotate and balance tires', 'EMP002', 50.00);

INSERT INTO maintenance (maintenance_ID, VIN_number, maintenance_type, maintenance_date, description, employee_ID, total_cost)
VALUES (4, 'VIN004', 'Engine Tune-Up', '2023-10-18', 'Engine diagnostics and tune-up', 'EMP002', 300.00);

INSERT INTO maintenance (maintenance_ID, VIN_number, maintenance_type, maintenance_date, description, employee_ID, total_cost)
VALUES (5, 'VIN005', 'Detailing', '2023-10-20', 'Full car detailing', 'EMP001', 100.00);

INSERT INTO maintenance (maintenance_ID, VIN_number, maintenance_type, maintenance_date, description, employee_ID, total_cost)
VALUES (6, 'VIN005', 'Detailing', '2023-10-21', 'Engine diagnostics and tune-up', 'EMP002', 300.00);

DROP TABLE BILLING;
DROP TABLE BOOKING;
DROP TABLE CUSTOMER;
DROP TABLE INSURANCE;
DROP TABLE MAINTENANCE;
DROP TABLE CAR;
DROP TABLE EMPLOYEE;
CREATE TABLE customer (
    customer_id VARCHAR(20) PRIMARY KEY,
    first_name VARCHAR(20) NOT NULL,
    last_name VARCHAR(20) NOT NULL,
    email VARCHAR(50),
    phone_number VARCHAR(15),
    address VARCHAR(100),
    date_of_birth DATE
);
CREATE TABLE car (
    VIN_number VARCHAR(10) PRIMARY KEY,
    make VARCHAR(20) NOT NULL,
    model VARCHAR(20) NOT NULL,
    year VARCHAR(4),
    colour VARCHAR(10),
    number_of_seats INT,
    cost_per_day DECIMAL(5, 2) NOT NULL,
    currently_available CHAR(1) DEFAULT 'Y' CHECK(currently_available IN('Y', 'N'))
);
CREATE TABLE insurance (
    insurance_id VARCHAR(10) PRIMARY KEY,
    coverage_type VARCHAR(20),
    cost_per_day DECIMAL(5, 2) NOT NULL,
    insurance_provider VARCHAR(20) NOT NULL
);
CREATE TABLE booking (
    booking_ID VARCHAR(20) PRIMARY KEY,
    customer_id VARCHAR(20),
    VIN_number VARCHAR(20),
    insurance_ID VARCHAR(20),
    FOREIGN KEY (customer_id) REFERENCES customer(customer_id),
    FOREIGN KEY (VIN_number) REFERENCES car(VIN_number),
    FOREIGN KEY (insurance_ID) REFERENCES insurance(insurance_ID),
    pick_up_day DATE NOT NULL,
    number_of_days INT NOT NULL,
    total_amount DECIMAL(10, 2) NOT NULL
);
CREATE TABLE employee (
    employee_ID VARCHAR(20) PRIMARY KEY,
    last_name VARCHAR(20) NOT NULL,
    first_name VARCHAR(20) NOT NULL,
    email VARCHAR(50),
    phone_number VARCHAR(15),
    position VARCHAR(20)
);
CREATE TABLE billing(
    billing_ID VARCHAR(20) PRIMARY KEY,
    booking_ID VARCHAR(20),
    FOREIGN KEY (booking_ID) REFERENCES booking(booking_ID),
    bill_date DATE NOT NULL,
    status CHAR(10) DEFAULT 'NOT BILLED' CHECK(status IN('NOT BILLED', 'BILLED')),
    discount_amount DECIMAL(10, 2) DEFAULT '0',
    late_fees DECIMAL(10, 2),
    taxed_amount DECIMAL(10, 2),
    total_amount DECIMAL(10, 2) NOT NULL
);
CREATE TABLE maintenance (
    maintenance_ID INT PRIMARY KEY,
    VIN_number VARCHAR(10),
    FOREIGN KEY (VIN_number) REFERENCES car(VIN_number),
    maintenance_type VARCHAR(20),
    maintenance_date DATE,
    description VARCHAR(500),
    employee_ID VARCHAR(20),
    FOREIGN KEY (employee_ID) REFERENCES employee(employee_ID),
    total_cost DECIMAL(10, 2) NOT NULL
);
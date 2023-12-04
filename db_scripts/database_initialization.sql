-- Create the database
CREATE DATABASE kancelaria_notarialna;
GO

-- Use the created database
USE kancelaria_notarialna;
GO

-- Create the 'clients' table
CREATE TABLE clients (
    client_id INT IDENTITY(1,1) PRIMARY KEY NOT NULL,
    name VARCHAR(40),
    activity_type VARCHAR(40),
    address VARCHAR(40),
    phone_number BIGINT
);
GO

-- Create the 'services' table
CREATE TABLE services (
    service_id INT IDENTITY(1,1) PRIMARY KEY NOT NULL,
    name VARCHAR(40),
    description VARCHAR(60)
);
GO

-- Create the 'employees' table
CREATE TABLE employees (
    employee_id INT IDENTITY(1,1) PRIMARY KEY NOT NULL,
    name VARCHAR(40),
    job_title VARCHAR(40),
    phone_number BIGINT,
    salary FLOAT
);
GO
-- Create the 'contracts' table
CREATE TABLE contracts (
    contract_id INT IDENTITY(1,1) PRIMARY KEY NOT NULL,
    client_id INT FOREIGN KEY REFERENCES clients(client_id),
    service_id INT FOREIGN KEY REFERENCES services(service_id),
    employee_id INT FOREIGN KEY REFERENCES employees(employee_id),
    price FLOAT,
    comment VARCHAR(60)
);
GO

-- Create the 'documents' table
CREATE TABLE documents (
    document_id INT IDENTITY(1,1) PRIMARY KEY NOT NULL,
    contract_id INT FOREIGN KEY REFERENCES contracts(contract_id),
    name VARCHAR(40),
    data DATETIME,
    status VARCHAR(20)
);
GO
CREATE DATABASE IF NOT EXISTS db_employee_data
CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE db_employee_data;

CREATE TABLE IF NOT EXISTS employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nip VARCHAR(20) NOT NULL UNIQUE,
    name VARCHAR(100) NOT NULL,
    department VARCHAR(100) NOT NULL,
    position VARCHAR(100) NOT NULL,
    salary INT NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO employees (nip, name, department, position, salary) VALUES
('E001', 'Rina', 'IT', 'Staff', 6500000),
('E002', 'Andi', 'HR', 'Manager', 9000000);

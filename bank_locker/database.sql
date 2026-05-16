-- Bank Locker Management System Database
-- Run this SQL file to create the database and tables

CREATE DATABASE IF NOT EXISTS bank_locker_db;
USE bank_locker_db;

-- Admin Table
CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Customers Table
CREATE TABLE IF NOT EXISTS customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id VARCHAR(20) NOT NULL UNIQUE,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(15) NOT NULL,
    address TEXT NOT NULL,
    aadhar_no VARCHAR(12) NOT NULL,
    account_no VARCHAR(20) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Lockers Table
CREATE TABLE IF NOT EXISTS lockers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    locker_number VARCHAR(20) NOT NULL UNIQUE,
    locker_size ENUM('small', 'medium', 'large') NOT NULL,
    annual_rent DECIMAL(10,2) NOT NULL,
    status ENUM('available', 'allocated', 'maintenance') DEFAULT 'available',
    location VARCHAR(100) NOT NULL DEFAULT 'Main Branch Vault',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Locker Allocations Table
CREATE TABLE IF NOT EXISTS allocations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    allocation_no VARCHAR(20) NOT NULL UNIQUE,
    customer_id INT NOT NULL,
    locker_id INT NOT NULL,
    allocation_date DATE NOT NULL,
    expiry_date DATE NOT NULL,
    rent_paid DECIMAL(10,2) NOT NULL,
    payment_status ENUM('paid', 'pending', 'overdue') DEFAULT 'paid',
    status ENUM('active', 'surrendered') DEFAULT 'active',
    remarks TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES customers(id),
    FOREIGN KEY (locker_id) REFERENCES lockers(id)
);

-- Access Log Table
CREATE TABLE IF NOT EXISTS access_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    locker_id INT NOT NULL,
    access_date DATE NOT NULL,
    access_time TIME NOT NULL,
    purpose VARCHAR(255),
    approved_by VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES customers(id),
    FOREIGN KEY (locker_id) REFERENCES lockers(id)
);

-- Insert default admin
INSERT INTO admin (username, password, full_name) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Bank Administrator');
-- Default admin password: password

-- Insert sample lockers
INSERT INTO lockers (locker_number, locker_size, annual_rent, location) VALUES
('L001', 'small', 1500.00, 'Main Branch Vault - Row A'),
('L002', 'small', 1500.00, 'Main Branch Vault - Row A'),
('L003', 'small', 1500.00, 'Main Branch Vault - Row A'),
('L004', 'medium', 2500.00, 'Main Branch Vault - Row B'),
('L005', 'medium', 2500.00, 'Main Branch Vault - Row B'),
('L006', 'medium', 2500.00, 'Main Branch Vault - Row B'),
('L007', 'large', 4000.00, 'Main Branch Vault - Row C'),
('L008', 'large', 4000.00, 'Main Branch Vault - Row C'),
('L009', 'large', 4000.00, 'Main Branch Vault - Row C'),
('L010', 'small', 1500.00, 'Main Branch Vault - Row A'),
('L011', 'medium', 2500.00, 'Main Branch Vault - Row B'),
('L012', 'large', 4000.00, 'Main Branch Vault - Row C');

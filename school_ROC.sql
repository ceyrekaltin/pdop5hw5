CREATE DATABASE school_ROC;

USE school_ROC;

CREATE TABLE students (
    student_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    age INT,
    email VARCHAR(100)
);
INSERT INTO students (name, age, email)
VALUES
('Alice', 20, 'alice@example.com'),
('Bob', 22, 'bob@example.com'),
('Charlie', 19, 'charlie@example.com'),
('Diana', 23, 'diana@example.com'),
('Eve', 21, 'eve@example.com');

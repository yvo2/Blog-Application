CREATE DATABASE blogdb;

USE blogdb;

CREATE TABLE user (
  id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  name VARCHAR(20) NOT NULL,
  password VARCHAR(65) NOT NULL,
  email VARCHAR(45) NOT NULL
)
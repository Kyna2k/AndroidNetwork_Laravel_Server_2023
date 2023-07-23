CREATE DATABASE
    IF NOT EXISTS LAB
    
USE LAB

CREATE TABLE USERS(
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(40) not null UNIQUE,
    password VARCHAR(40) not null ,
    hoten VARCHAR(40) not null,
    tuoi int not null
)
INSERT INTO USERS(username, password, hoten, tuoi) VALUES('admin','admin','teo',15)

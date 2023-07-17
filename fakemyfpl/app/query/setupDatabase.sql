-- Active: 1687964945195@@127.0.0.1@3306
-- CREATE DATABASE fakemyfpl
--     DEFAULT CHARACTER SET = 'utf8mb4';

CREATE DATABASE IF NOT EXISTS QUANLYSINHVIEN

USE QUANLYSINHVIEN

    CREATE TABLE IF NOT EXISTS USERS (
    id INT PRIMARY KEY AUTO_INCREMENT,
    EMAIL VARCHAR(50) not NULL UNIQUE,
    PASSWORD VARCHAR(50) NOT NULL,
    NAME VARCHAR(50) not NULL,
    IMAGE VARCHAR(255) DEFAULT ('https://static2.yan.vn/YanNews/2167221/202102/facebook-cap-nhat-avatar-doi-voi-tai-khoan-khong-su-dung-anh-dai-dien-e4abd14d.jpg'),
    AGE INT(2),
    Type VARCHAR(5) not NULL DEFAULT ('USERS')
)

CREATE TABLE IF NOT EXISTS KHOAHOC (
    id INT PRIMARY KEY AUTO_INCREMENT,
    NAME VARCHAR(50) not NULL,
    TYPE VARCHAR(15) NOT NULL,
    IMAGE VARCHAR(255) DEFAULT('https://banner2.cleanpng.com/20181025/i/kisspng-computer-icons-image-learning-portable-network-gra-abstract-geometric-backgrounds-5bd16c725a0929.6498147015404514423688.jpg'),
    CreateAt DATETIME DEFAULT NOW(),
    description VARCHAR(50) NOT NULL, 
    price INT NOT NULL DEFAULT (0)
)

CREATE TABLE CHITIETKHOAHOC (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_user int not NULL,
    id_khoahoc int not null,
    status BIT not NULL,
    CreateAt DATETIME NOT NULL DEFAULT NOW(),
    Foreign Key (id_user) REFERENCES USERS(id),
    Foreign Key (id_khoahoc) REFERENCES KHOAHOC(id)
)

create table reset_password (
	id INT PRIMARY KEY AUTO_INCREMENT,
	token VARCHAR(50) NOT NULL,
	createdAt DATETIME NOT NULL DEFAULT NOW(),
	email VARCHAR(50) NOT NULL,
	avaiable BIT DEFAULT 1
)

CREATE Table CHAT (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_user_send INT NOT NULL,
    id_user_get INT NOT NULL,
    noidung VARCHAR(255) NOT NULL,
    CreateAt DATETIME NOT NULL DEFAULT Now(),
    Foreign Key (id_user_send) REFERENCES USERS(id),
    Foreign Key (id_user_get) REFERENCES USERS(id)
)
CREATE TABLE BAIHOC (

)

INSERT INTO USERS (EMAIL,PASSWORD,NAME,AGE,Type)
    VALUES 
        ('admin','admin','Huy Phan',23,'ADMIN'),
        ('huynobi1809@gmail.com','123','Tang Ngoc Anh',21,"USERS")


SELECT * FROM Khoahoc


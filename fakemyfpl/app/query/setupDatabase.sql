
CREATE DATABASE
    IF NOT EXISTS FAKEMYFPL
    
USE FAKEMYFPL
CREATE TABLE
    IF NOT EXISTS LOAIBAIVIET (
        id INT PRIMARY KEY AUTO_INCREMENT,
        theloai VARCHAR(30) not NULL,
    )
CREATE TABLE
    IF NOT EXISTS BAIVIET (
        id INT PRIMARY KEY AUTO_INCREMENT,
        tieude VARCHAR(50) not NULL,
        noidung VARCHAR(255) not null,
        -- HTML
        tennguoidang VARCHAR(40) not null,
        id_loaibaiviet int not null,
        createat DATETIME DEFAULT NOW(),
        Foreign Key (id_loaibaiviet) REFERENCES LOAIBAIVIET(id)
    )
CREATE TABLE
    IF NOT EXISTS ADMIN (
        id INT PRIMARY KEY AUTO_INCREMENT,
        username VARCHAR(30) not NULL UNIQUE,
        password varchar(40) not null,
        email varchar(40) not null UNIQUE,
        ten varchar(30) not null
    )
CREATE TABLE
    IF NOT EXISTS THONGBAO (
        id INT PRIMARY KEY AUTO_INCREMENT,
        tieude VARCHAR(30) not null,
        noidung varchar(100) not null,
        createat DATETIME DEFAULT NOW(),
        hinhanh VARCHAR(255),
        topic varchar(10)
    )
CREATE TABLE
    IF NOT EXISTS SINHVIEN (
        id INT PRIMARY KEY AUTO_INCREMENT,
        masinhvien VARCHAR(7) not NULL UNIQUE,
        hoten VARCHAR(50) NOT NULL,
        email  varchar(40) not NULL UNIQUE,
        khoa VARCHAR(7) not NULL,
        IMAGE VARCHAR(255) DEFAULT (
            'https://static2.yan.vn/YanNews/2167221/202102/facebook-cap-nhat-avatar-doi-voi-tai-khoan-khong-su-dung-anh-dai-dien-e4abd14d.jpg'
        ),
        token_device varchar(255),
        createat DATETIME DEFAULT NOW()
    )

CREATE TABLE
    IF NOT EXISTS LOP (
        id INT PRIMARY KEY AUTO_INCREMENT,
        malop VARCHAR(7) not NULL UNIQUE
    )
CREATE TABLE
    IF NOT EXISTS MONHOC (
        id INT PRIMARY KEY AUTO_INCREMENT,
        mamon VARCHAR(10) not NULL UNIQUE,
        tenmon VARCHAR(40),
        hinhanh VARCHAR(255)
    )
CREATE TABLE
    IF NOT EXISTS GIAOVIEN (
        id INT PRIMARY KEY AUTO_INCREMENT,
        tengiaovien VARCHAR(10) not NULL,
        hinhanh VARCHAR(255)
    )
CREATE TABLE
    IF NOT EXISTS CHITIETLOP (
        id INT PRIMARY KEY AUTO_INCREMENT,
        id_sinhvien int,
        id_lop int,
        Foreign Key (id_sinhvien) REFERENCES SINHVIEN(id),
        Foreign Key (id_lop) REFERENCES LOP(id)
    )
CREATE TABLE
    IF NOT EXISTS LICHHOC (
        id INT PRIMARY KEY AUTO_INCREMENT,
        id_lop int,
        id_giaovien int,
        id_monhoc int,
        phonghoc varchar(10),
        thoigian DATETIME,
        loai varchar(10),
        Foreign Key (id_lop) REFERENCES LOP(id),
        Foreign Key (id_giaovien) REFERENCES GIAOVIEN(id),
        Foreign Key (id_monhoc) REFERENCES MONHOC(id)
    ) ;
    
    
    -- CREATE Table CHAT (.`1`1`
    --     id INT PRIMARY KEY AUTO_INCREMENT,
    --     id_user_send INT NOT NULL,
    --     id_user_get INT NOT NULL,
    --     noidung VARCHAR(255) NOT NULL,
    --     CreateAt DATETIME NOT NULL DEFAULT Now(),
    --     Foreign Key (id_user_send) REFERENCES USERS(id),
    --     Foreign Key (id_user_get) REFERENCES USERS(id)
    -- )
--Them admin
INSERT INTO ADMIN (username,password,email,ten) VALUES ('admin','admin','huynobi1809@gmail.com','Phan Thanh Huy');

INSERT INTO SINHVIEN(masinhvien,email,hoten,khoa) VALUES ('ps23156','huyptps23156@fpt.edu.vn','Phan Thanh Huy','MD17304')


DROP TABLE chitietlop

ALTER TABLE SINHVIEN
ADD id_lop int;

ALTER TABLE SINHVIEN
ADD FOREIGN KEY (id_lop) REFERENCES LOP(id);

use FAKEMYFPL

ALTER TABLE LOAIBAIVIET
DROP COLUMN hinhanh;


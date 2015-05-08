-- CS419- Table Creation Queries
-- Group 14
-- Name: Andres Dominguez, Tricia Izuno, Bailey Skiles


-- admin table AD

DROP TABLE IF EXISTS admin;
CREATE TABLE admin (
	admin_id 		SMALLINT(5) NOT NULL AUTO_INCREMENT,
	admin_name		VARCHAR(50) NOT NULL,
	pass			VARCHAR(25) NOT NULL,
	level			SMALLINT(5) NOT NULL,
	email			VARCHAR(50) NOT NULL,
	PRIMARY KEY (admin_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- category table C

DROP TABLE IF EXISTS category;
CREATE TABLE category (
	cat_id 			SMALLINT(5) NOT NULL AUTO_INCREMENT,
	cat_name		VARCHAR(50) NOT NULL UNIQUE,
	PRIMARY KEY (cat_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- subcategory table SC

DROP TABLE IF EXISTS subcategory;
CREATE TABLE subcategory (
	scat_id 		SMALLINT(5) NOT NULL AUTO_INCREMENT,
	scat_name		VARCHAR(50) NOT NULL UNIQUE,
	cat_id 			SMALLINT(5) NOT NULL,
	FOREIGN KEY (cat_id) REFERENCES category (cat_id),
	PRIMARY KEY (scat_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- address table A

DROP TABLE IF EXISTS address;
CREATE TABLE address (
	address_id 		SMALLINT(10) NOT NULL AUTO_INCREMENT,
	address			VARCHAR(50),
	address2		VARCHAR(50),
	city			VARCHAR(25),
	zipcode			VARCHAR(10),
	PRIMARY KEY (address_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- service table S

DROP TABLE IF EXISTS service;
CREATE TABLE service (
	service_id 		SMALLINT(5) NOT NULL AUTO_INCREMENT,
	service_type 	VARCHAR(25) NOT NULL,
	PRIMARY KEY (service_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- business table B

DROP TABLE IF EXISTS business;
CREATE TABLE business (
	biz_id 			SMALLINT(10) NOT NULL AUTO_INCREMENT,
	biz_name		VARCHAR(50) NOT NULL,
	address_id 		SMALLINT(10),
	phone			VARCHAR(25),
	website			VARCHAR(125),
	hours			VARCHAR(50),
	service_id		SMALLINT(5) NOT NULL,
	FOREIGN KEY (address_id) REFERENCES address (address_id),
	FOREIGN KEY (service_id) REFERENCES service (service_id),
	PRIMARY KEY (biz_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- biz_scat table BSC

DROP TABLE IF EXISTS biz_scat;
CREATE TABLE biz_scat (
	scat_id 		SMALLINT(5) NOT NULL,
	biz_id 			SMALLINT(10) NOT NULL,
	FOREIGN KEY (scat_id) REFERENCES subcategory (scat_id),
	FOREIGN KEY (biz_id) REFERENCES business (biz_id),
	PRIMARY KEY (biz_id, scat_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
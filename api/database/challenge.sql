CREATE DATABASE challenge;
use challenge;

CREATE TABLE person (

	id int NOT NULL,
	name varchar(255) NOT NULL,
	PRIMARY KEY(id)
);

CREATE TABLE phone (

	id int NOT NULL AUTO_INCREMENT,
	number varchar(10) NOT NULL,
	person int NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY (person) REFERENCES person(id)
);

CREATE TABLE ship_order (
	
	id int NOT NULL,
	person_order int NOT NULL,
	name varchar(255) NOT NULL,
	address varchar(255) NOT NULL,
	city varchar(255) NOT NULL,
	country varchar(255) NOT NULL,
	PRIMARY KEY(id)
);

CREATE TABLE item_order(
	
	id int NOT NULL AUTO_INCREMENT,
	title varchar(255) NOT NULL,
	note varchar(255) NOT NULL,
	quantity int NOT NULL,
	price decimal(15,2) NOT NULL,
	ship_order int NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY (ship_order) REFERENCES ship_order(id)
);


delete from phone;
delete from person;
delete from item_order;
delete from ship_order;
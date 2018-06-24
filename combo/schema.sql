/* Powered by http://evilnapsis.com/ */

create database combobox3;
use combobox3;

create table country(
	id int not null auto_increment primary key,
	name varchar(255)
);

create table state(
	id int not null auto_increment primary key,
	name varchar(255),
	country_id int not null,
	foreign key (country_id) references country(id)
);

create table city(
	id int not null auto_increment primary key,
	name varchar(255),
	state_id int not null,
	foreign key (state_id) references state(id)
);

create table combo(
	id int not null auto_increment primary key,
	country_id int not null,
	foreign key (country_id) references country(id),
	state_id int not null,
	foreign key (state_id) references state(id),
	city_id int not null,
	foreign key (city_id) references city(id)
);

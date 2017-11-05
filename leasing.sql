SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

drop database if exists leasing;
create database leasing collate utf8_general_ci;

CREATE TABLE `users` (
	`id` int NOT NULL AUTO_INCREMENT,
	`name` tinytext NOT NULL,
	`surname` tinytext NOT NULL,
	`email` tinytext NOT NULL,
	`password` tinytext NOT NULL,
	`phoneNr` varchar(9) NOT NULL,
	`city` tinytext NOT NULL,
	`confirmed` BINARY NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `employees` (
	`id` int NOT NULL AUTO_INCREMENT,
	`name` tinytext NOT NULL,
	`surname` tinytext NOT NULL,
	`email` tinytext NOT NULL,
	`password` tinytext NOT NULL,
	`phoneNr` varchar(9) NOT NULL,
	`city` tinytext NOT NULL,
	`rankId` int NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `ranks` (
	`id` int NOT NULL AUTO_INCREMENT,
	`name` tinytext NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `loan` (
	`id` int NOT NULL AUTO_INCREMENT,
	`start` DATE NOT NULL,
	`end` DATE NOT NULL,
	`userId` int NOT NULL,
	`employeeId` int NOT NULL,
	`carId` int NOT NULL,
	`userAccepted` BINARY NOT NULL,
	`employeeAccepted` BINARY NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `mark` (
	`id` int NOT NULL AUTO_INCREMENT,
	`name` tinytext NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `model` (
	`id` int NOT NULL AUTO_INCREMENT,
	`name` tinytext NOT NULL,
	`markId` int NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `cars` (
	`id` int NOT NULL AUTO_INCREMENT,
	`name` tinytext NOT NULL,
	`modelId` int NOT NULL,
	`capacity` int NOT NULL,
	`year` int NOT NULL,
	`fuelId` int NOT NULL,
	`bodyId` int NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `fuel` (
	`id` int NOT NULL AUTO_INCREMENT,
	`name` tinytext NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `body` (
	`id` int NOT NULL AUTO_INCREMENT,
	`name` tinytext NOT NULL,
	PRIMARY KEY (`id`)
);

ALTER TABLE `employees` ADD CONSTRAINT `employees_fk0` FOREIGN KEY (`rankId`) REFERENCES `ranks`(`id`);

ALTER TABLE `loan` ADD CONSTRAINT `loan_fk0` FOREIGN KEY (`userId`) REFERENCES `users`(`id`);

ALTER TABLE `loan` ADD CONSTRAINT `loan_fk1` FOREIGN KEY (`employeeId`) REFERENCES `employees`(`id`);

ALTER TABLE `loan` ADD CONSTRAINT `loan_fk2` FOREIGN KEY (`carId`) REFERENCES `cars`(`id`);

ALTER TABLE `model` ADD CONSTRAINT `model_fk0` FOREIGN KEY (`markId`) REFERENCES `mark`(`id`);

ALTER TABLE `cars` ADD CONSTRAINT `cars_fk0` FOREIGN KEY (`modelId`) REFERENCES `model`(`id`);

ALTER TABLE `cars` ADD CONSTRAINT `cars_fk1` FOREIGN KEY (`fuelId`) REFERENCES `fuel`(`id`);

ALTER TABLE `cars` ADD CONSTRAINT `cars_fk2` FOREIGN KEY (`bodyId`) REFERENCES `body`(`id`);

COMMIT;

<?php

$zapytanie[1] = "CREATE TABLE ministrant_admins (
		uid int(11) NOT NULL AUTO_INCREMENT,
		name varchar(255) NOT NULL,
		password varchar(255) NOT NULL,
		fullName varchar(255) NOT NULL,
		userHash varchar(255) NOT NULL,
		PRIMARY KEY (uid)
	)
	ENGINE = INNODB
	AUTO_INCREMENT = 1
	CHARACTER SET utf8mb4
	COLLATE utf8mb4_general_ci;";

$zapytanie[2] = "CREATE TABLE ministrant_rankinfo (
		uid int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
		name varchar(255) NOT NULL DEFAULT 'Brak',
		PRIMARY KEY (uid)
	)
	ENGINE = INNODB
	AUTO_INCREMENT = 1
	CHARACTER SET utf8mb4
	COLLATE utf8mb4_general_ci;";

?>
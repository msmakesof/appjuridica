<?php

$dsn = "mysql:host=localhost;dbname=appjudicial";
$username = "root";
$password = "";

$pdo = new PDO($dsn, $username, $password);

$rows = array();
if(isset($_GET['fruitName'])) {
	$stmt = $pdo->prepare("SELECT fruit_id, variety FROM fruit WHERE name = ? ORDER BY variety");
	$stmt->execute(array($_GET['fruitName']));
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
echo json_encode($rows);

/*

SQL to create the table and populate with example data

CREATE TABLE IF NOT EXISTS `fruit` (
  `fruit_id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `variety` varchar(50) NOT NULL,
  PRIMARY KEY  (`fruit_id`)
);

INSERT INTO `fruit` (`fruit_id`, `name`, `variety`) VALUES
(1, 'Apple', 'Red Delicious'),
(2, 'Pear', 'Comice'),
(3, 'Orange', 'Navel'),
(4, 'Pear', 'Bartlett'),
(5, 'Orange', 'Blood'),
(6, 'Apple', 'Cox''s Orange Pippin'),
(7, 'Apple', 'Granny Smith'),
(8, 'Pear', 'Anjou'),
(9, 'Orange', 'Valencia'),
(10, 'Banana', 'Plantain'),
(11, 'Banana', 'Burro'),
(12, 'Banana', 'Cavendish');
*/

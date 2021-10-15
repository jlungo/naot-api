<?php

require 'config.php';

$dsn = "mysql:host=$host;dbname=$databbase;charset=UTF8";

try {
	$pdo = new PDO($dsn, $username, $password);

	if ($pdo) {
		echo "Connected to the $db database successfully!";
	}
} catch (PDOException $e) {
	echo $e->getMessage();
}
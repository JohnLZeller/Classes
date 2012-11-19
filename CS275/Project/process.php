<!DOCTYPE HTML>

<html>

<head>
	<title>John & Drake's Used Car Lot</title>

	<link rel="stylesheet" href="style.css">

	<!-- Javascript for inputting and loading information from SQL database -->
	<script type="text/javascript" src="database.js"></script>
</head>

<body>

<?php

ini_set('display_errors', 'On');
/*error_reporting(E_ALL);
$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "zellerjo-db", "RQXKvRU7D3W0x7bO", "zellerjo-db");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}*/

/* This is bad, little bobby tables will demonstrate */

if( isset( $_POST['customer'] ) ) {
	echo "Name: " . $_POST['cname'];
	echo "<br>SSN: " . $_POST['ssn'];
	echo "<br>Address: " . $_POST['address'];
	echo "<br>Phone #: " . $_POST['phone'];
}

if( isset( $_POST['employee'] ) ) {
	echo "Name: " . $_POST['cname'];
	echo "<br>SSN: " . $_POST['ssn'];
	echo "<br>Address: " . $_POST['address'];
	echo "<br>Phone #: " . $_POST['phone'];
	echo "<br>Salary: " . $_POST['salary'];
}

if( isset( $_POST['car'] ) ) {
	echo "VIN: " . $_POST['vin'];
	echo "<br>Price: " . $_POST['price'];
	echo "<br>Make: " . $_POST['make'];
	echo "<br>Model: " . $_POST['model'];
	echo "<br>Color: " . $_POST['color'];
}

if( isset( $_POST['lot'] ) ) {
	echo "Lot #: " . $_POST['lot_num'];
	echo "<br>Capacity: " . $_POST['capacity'];
}

if( isset( $_POST['purchased'] ) ) {
	echo "Date: " . $_POST['date'];
	echo "<br>Sold For: " . $_POST['sold_for'];
	echo "<br>VIN: " . $_POST['vin'];
	echo "<br>Customer SSN: " . $_POST['ssn'];
}

if( isset( $_POST['stored_in'] ) ) {
	echo "VIN: " . $_POST['vin'];
	echo "<br>Lot #: " . $_POST['lot_num'];
	echo "<br>Date From: " . $_POST['since'];
	echo "<br>Date Until: " . $_POST['until'];
}

if( isset( $_POST['works_in'] ) ) {
	echo "Lot #: " . $_POST['lot_num'];
	echo "<br>Employee SSN: " . $_POST['ssn'];
	echo "<br>Date Since: " . $_POST['since'];
}

?>

</body>
</html>
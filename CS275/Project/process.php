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
/*error_reporting(E_ALL);
$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "zellerjo-db", "RQXKvRU7D3W0x7bO", "zellerjo-db");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}*/

/* This is bad, little bobby tables will demonstrate */

if( $_POST['customer'] ) {
	echo "Name: " $_POST['cname'];
	echo "SSN: " $_POST['ssn'];
	echo "Address: " $_POST['address'];
	echo "Phone #: " $_POST['phone'];
}

if( $_POST['employee'] ) {
	echo "Name: " $_POST['cname'];
	echo "SSN: " $_POST['ssn'];
	echo "Address: " $_POST['address'];
	echo "Phone #: " $_POST['phone'];
	echo "Salary: " $_POST['salary'];
}

if( $_POST['car'] ) {
	echo "VIN: " $_POST['vin'];
	echo "Price: " $_POST['price'];
	echo "Make: " $_POST['make'];
	echo "Model: " $_POST['model'];
	echo "Color: " $_POST['color'];
}

if( $_POST['lot'] ) {
	echo "Lot #: " $_POST['lot_num'];
	echo "Capacity: " $_POST['capacity'];
}

if( $_POST['purchased'] ) {
	echo "Date: " $_POST['date'];
	echo "Sold For: " $_POST['sold_for'];
	echo "VIN: " $_POST['vin'];
	echo "Customer SSN: " $_POST['ssn'];
}

if( $_POST['stored_in'] ) {
	echo "VIN: " $_POST['vin'];
	echo "Lot #: " $_POST['lot_num'];
	echo "Date From: " $_POST['since'];
	echo "Date Until: " $_POST['until'];
}

if( $_POST['works_in'] ) {
	echo "Lot #: " $_POST['lot_num'];
	echo "Employee SSN: " $_POST['ssn'];
	echo "Date Since: " $_POST['since'];
}

?>

</body>
</html>
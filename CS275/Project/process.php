<!DOCTYPE HTML>
<!-- Things to add
 *	Sanitize the inputs
 *	Verify foreign key constraints
-->


<html>

<head>
	<title>John & Drake's Used Car Lot</title>

	<link rel="stylesheet" href="style.css">

	<!-- Javascript for inputting and loading information from SQL database -->
	<script type="text/javascript" src="database.js"></script>
</head>

<body>

	<!-- On load set first table value to '' -->

	<div id="main">
		<div id="title"><h1>John & Drake's Used Car Lot</h1></div>

		<div id="intro">
			<p>Here at John & Drake's Used Car Lot, we are all about customer service.
			We want you to leave here with a smile on your face and key in your pocket.
			Shop around! Let us know if you have any questions by emailing 
			admin@johndrakeusedcars.com
			</p>
		</div>

		<div id="info">
			<div id="input">
				<b>What would you like to do?</b>
				<!-- Selected Choice -->
				<?php
				echo $_POST['choice']
				?>
		
				<!-- Selected Input -->
				<br><br>
				<?php
				if($_POST['choice']=="View"){
				    echo "<b>View By</b> ";
				}else if($_POST['choice']=="Insert"){
				    echo "<b>Insert By</b> ";
				}else if($_POST['choice']=="Delete"){
				    echo "<b>Delete By</b> ";
				}

				echo $_POST['input']
				?>

				<!-- Input form prints out here -->
				<br><br><br>
				<?php

				/* This displays the variables coming in from website */
				if($_POST['choice']!='View'){
				    switch ($_POST['input']){
					case "Customer":
					    echo "Name:<br>                " . $_POST['cname'] . "<br>";
					    echo "<br>SSN:<br>                " . $_POST['ssn'] . "<br>";
					    echo "<br>Address:<br>                " . $_POST['address'] . "<br>";
					    echo "<br>Phone #:<br>                " . $_POST['phone'] . "<br>";
					    break;
					case "Employee":
					    echo "Name:<br>                " . $_POST['ename'] . "<br>";
					    echo "<br>SSN:<br>                " . $_POST['ssn'] . "<br>";
					    echo "<br>Address:<br>                " . $_POST['address'] . "<br>";
					    echo "<br>Phone #:<br>                " . $_POST['phone'] . "<br>";
					    echo "<br>Salary:<br>                " . $_POST['salary'] . "<br>";
					    break;
					case "Car":
					    echo "VIN:<br>                " . $_POST['vin'] . "<br>";
					    echo "<br>Price:<br>                " . $_POST['price'] . "<br>";
					    echo "<br>Make:<br>                " . $_POST['make'] . "<br>";
					    echo "<br>Model:<br>                " . $_POST['model'] . "<br>";
					    echo "<br>Color:<br>                " . $_POST['color'] . "<br>";
					    break;
					case "Lot":
					    echo "Lot #:<br>                " . $_POST['lot_num'] . "<br>";
					    echo "<br>Capacity:<br>                " . $_POST['capacity'] . "<br>";
					    break;
					case "Purchased":
					    echo "Date:<br>                " . $_POST['date'] . "<br>";
					    echo "<br>Sold For:<br>                " . $_POST['sold_for'] . "<br>";
					    echo "<br>VIN:<br>                " . $_POST['vin'] . "<br>";
					    echo "<br>Customer SSN:<br>                " . $_POST['ssn'] . "<br>";
					    break;
					case "Stored In":
					    echo "VIN:<br>                " . $_POST['vin'] . "<br>";
					    echo "<br>Lot #:<br>                " . $_POST['lot_num'] . "<br>";
					    echo "<br>Date From:<br>                " . $_POST['since'] . "<br>";
					    echo "<br>Date Until:<br>                " . $_POST['until'] . "<br>";
					    break;
					case "Works In":
					    echo "Lot #:<br>                " . $_POST['lot_num'] . "<br>";
					    echo "<br>Employee SSN:<br>                " . $_POST['ssn'] . "<br>";
					    echo "<br>Date Since:<br>                " . $_POST['since'] . "<br>";
					    break;
					default:
					    continue;
				    }
				}
				
				?>
				
				<br><br>
				<a href="index.html"><input type="button" value="Restart"></a>
				
				<div style="font-size:10px;"><br>WARNING: Input of information to the database is reserved for authorized personnel ONLY!</div>
			</div>

			<div id="results"><span id="resultlist"></span></div>
		</div>
	</div>

<!-- PHP goes here -->
    <!-- The SQL parser that gives all the necessary functionality to the database application -->
    <?php
	error_reporting(E_ALL);
	
	function connect(){
	    $mysqli = new mysqli("oniddb.cws.oregonstate.edu", "zellerjo-db", "RQXKvRU7D3W0x7bO", "zellerjo-db");
	    if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	    }else{
		echo "CONNECTED!!!";
	    }
	    return $mysqli;
	}
    
	function view_data($input_type){
	    echo "<br>Viewing Data for: " . $input_type;
	    echo "<br>Printing Data Now<br>";
	    switch ($_POST['input']){
		case "Customer":
		    echo "Customer View";
		    break;
		case "Employee":
		    echo "Employee View";
		    break;
		case "Car":
		    echo "Car View";
		case "Lot":
		    echo "Lot View";
		    break;
		case "Purchased":
		    echo "Purchased View";
		    break;
		case "Stored In":
		    echo "Stored In View";
		    break;
		case "Works In":
		    echo "Works In View";
		    break;
	    }
	}
	
	function insert_data($input_type){
	    echo "<br>Inserting Data for: " . $input_type;
	    echo "<br>Printing Data Now<br>";
	    switch ($_POST['input']){
		case "Customer":			// Add info to Customer
		    $query = "";
		    $list = array($_POST['ssn'], $_POST['cname'], $_POST['address'], $_POST['phone']);
		    
		    /* MUST FIRST CONNECT TO DATABASE WITHIN THIS SCOPE BEFORE INSERTING TO DATABASE */
		    $mysqli = connect();
		    if ($list[0] != ''){ // Make sure that the primary key SSN exists
			if ( !($stmt = $mysqli->prepare("INSERT INTO Customers(ssn, cname, address, phone)" .
							" VALUES ('" . $list[0] . "', '" . $list[1] . "', '" . $list[2] . "', '" . $list[3] . "')") ) ) {
			    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
			}
			if (!$stmt->execute()) {
			    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
			} else {
			    echo "Added " . $stmt->affected_rows . " rows to Customers.";
			}
		    }else{
			echo "Missing Primary Key SSN!";
		    }
		    break;
		case "Employee":			// Add info to Employee
		    $query = "";
		    $list = array($_POST['ssn'], $_POST['ename'], $_POST['address'], $_POST['phone'], $_POST['salary']);
		    
		    /* MUST FIRST CONNECT TO DATABASE WITHIN THIS SCOPE BEFORE INSERTING TO DATABASE */
		    $mysqli = connect();
		    if ($list[0] != ''){ // Make sure that the primary key SSN exists
			if ( !($stmt = $mysqli->prepare("INSERT INTO Employees(ssn, ename, address, phone, salary)" .
							" VALUES ('" . $list[0] . "', '" . $list[1] . "', '" . $list[2] . "', '" . $list[3] . "', '" . $list[4] . "');") ) ) {
			    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
			}
			if (!$stmt->execute()) {
			    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
			} else {
			    echo "Added " . $stmt->affected_rows . " rows to Customers.";
			}
		    }else{
			echo "Missing Primary Key SSN!";
		    }
		    break;
		case "Car":				// Add info to Car
		    $query = "";
		    $list = array($_POST['vin'], $_POST['price'], $_POST['make'], $_POST['model'], $_POST['color']);
		    
		    /* MUST FIRST CONNECT TO DATABASE WITHIN THIS SCOPE BEFORE INSERTING TO DATABASE */
		    $mysqli = connect();
		    if ($list[0] != ''){ // Make sure that the primary key SSN exists
			if ( !($stmt = $mysqli->prepare("INSERT INTO Cars(vin, price, make, model, color)" .
							" VALUES ('" . $list[0] . "', '" . $list[1] . "', '" . $list[2] . "', '" . $list[3] . "', '" . $list[4] . "');") ) ) {
			    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
			}
			if (!$stmt->execute()) {
			    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
			} else {
			    echo "Added " . $stmt->affected_rows . " rows to Customers.";
			}
		    }else{
			echo "Missing Primary Key VIN!";
		    }
		    break;
		case "Lot":				// Add info to Lot
		    $query = "";
		    $list = array($_POST['lot_num'], $_POST['capacity']);
		    
		    /* MUST FIRST CONNECT TO DATABASE WITHIN THIS SCOPE BEFORE INSERTING TO DATABASE */
		    $mysqli = connect();
		    if ($list[0] != ''){ // Make sure that the primary key SSN exists
			if ( !($stmt = $mysqli->prepare("INSERT INTO Lots (lot_num, capacity)" .
							" VALUES ('" . $list[0] . "', '" . $list[1] . "');") ) ) {
			    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
			}
			if (!$stmt->execute()) {
			    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
			} else {
			    echo "Added " . $stmt->affected_rows . " rows to Customers.";
			}
		    }else{
			echo "Missing Primary Key Lot #!";
		    }
		    break;
		
		
		
		
		
		case "Purchased":			// Add info to Purchased
		    $query = "";
		    $list = array($_POST['date'], $_POST['sold_for'], $_POST['vin'], $_POST['ssn']);
		    
		    /* MUST FIRST CONNECT TO DATABASE WITHIN THIS SCOPE BEFORE INSERTING TO DATABASE */
		    $mysqli = connect();
		    if (($list[2] != '') || ($list[3] != '')){ // Make sure that the primary key SSN exists
			if ( !($stmt = $mysqli->prepare("INSERT INTO Purchased(date, sold_for, vin, ssn)" .
							" VALUES ('" . $list[0] . "', '" . $list[1] . "', '" . $list[2] . "', '" . $list[3] . "');") ) ) {
			    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
			}
			if (!$stmt->execute()) {
			    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
			} else {
			    echo "Added " . $stmt->affected_rows . " rows to Customers.";
			}
		    }else{
			echo "Missing Primary Key VIN or SSN!";
		    }
		    echo "DEPENDS ON FOREIGN KEYS, NOT FINISHED";
		    // DEPENDS ON FOREIGN KEYS, NOT FINISHED
		    break;
		case "Stored In":			// Add info to Stored In
		    $query = "";
		    $list = array($_POST['since'], $_POST['until'], $_POST['vin'], $_POST['lot_num']);
		    
		    /* MUST FIRST CONNECT TO DATABASE WITHIN THIS SCOPE BEFORE INSERTING TO DATABASE */
		    $mysqli = connect();
		    if (($list[2] != '') || ($list[3] != '')){ // Make sure that the primary key SSN exists
			if ( !($stmt = $mysqli->prepare("INSERT INTO Stored_In(since, until, vin, lot_num)" .
							" VALUES ('" . $list[0] . "', '" . $list[1] . "', '" . $list[2] . "', '" . $list[3] . "');") ) ) {
			    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
			}
			if (!$stmt->execute()) {
			    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
			} else {
			    echo "Added " . $stmt->affected_rows . " rows to Customers.";
			}
		    }else{
			echo "Missing Primary Key VIN or Lot #!";
		    }
		    echo "DEPENDS ON FOREIGN KEYS, NOT FINISHED";
		    // DEPENDS ON FOREIGN KEYS, NOT FINISHED
		    break;
		case "Works In":			// Add info to Works In
		    $query = "";
		    $list = array($_POST['since'], $_POST['ssn'], $_POST['lot_num']);
		    
		    /* MUST FIRST CONNECT TO DATABASE WITHIN THIS SCOPE BEFORE INSERTING TO DATABASE */
		    $mysqli = connect();
		    if (($list[1] != '') || ($list[2] != '')){ // Make sure that the primary key SSN exists
			if ( !($stmt = $mysqli->prepare("INSERT INTO Works_In(since, ssn, lot_num)" .
							" VALUES ('" . $list[0] . "', '" . $list[2] . "', '" . $list[3] . "');") ) ) {
			    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
			}
			if (!$stmt->execute()) {
			    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
			} else {
			    echo "Added " . $stmt->affected_rows . " rows to Customers.";
			}
		    }else{
			echo "Missing Primary Key SSN!";
		    }
		    echo "DEPENDS ON FOREIGN KEYS, NOT FINISHED";
		    // DEPENDS ON FOREIGN KEYS, NOT FINISHED
		    break;
	    }
	}
	
	function delete_data($input_type){
	    echo "<br>Deleting Data for: " . $input_type;
	    echo "<br>Printing Data Now<br>";
	    switch ($_POST['input']){
		case "Customer":
		    $query = "";
		    $list = array($_POST['cname'], $_POST['ssn'], $_POST['address'], $_POST['phone']);
		    foreach ($list as $item){ echo $item; }
		    break;
		case "Employee":
		    $query = "";
		    $list = array($_POST['cname'], $_POST['ssn'], $_POST['address'], $_POST['phone'], $_POST['salary']);
		    foreach ($list as $item){ echo $item; }
		    break;
		case "Car":
		    $query = "";
		    $list = array($_POST['vin'], $_POST['price'], $_POST['make'], $_POST['model'], $_POST['color']);
		    foreach ($list as $item){ echo $item; }
		    break;
		case "Lot":
		    $query = "";
		    $list = array($_POST['lot_num'], $_POST['capacity']);
		    foreach ($list as $item){ echo $item; }
		    break;
		case "Purchased":
		    $query = "";
		    $list = array($_POST['date'], $_POST['sold_for'], $_POST['vin'], $_POST['ssn']);
		    foreach ($list as $item){ echo $item; }
		    break;
		case "Stored In":
		    $query = "";
		    $list = array($_POST['vin'], $_POST['lot_num'], $_POST['since'], $_POST['until']);
		    foreach ($list as $item){ echo $item; }
		    break;
		case "Works In":
		    $query = "";
		    $list = array($_POST['lot_num'], $_POST['ssn'], $_POST['since']);
		    foreach ($list as $item){ echo $item; }
		    break;
	    }
	}
	
	
	
	// Check that values are valid
	
	// Submit the values to the SQL based on their correct choice and input type
	if(isset($_POST['choice'])){
	    switch ($_POST['choice']) {
		case "View":
		    view_data($_POST['input']);
		    break;
		case "Insert":
		    insert_data($_POST['input']);
		    break;
		case "Delete":
		    delete_data($_POST['input']);
		    break;
	    }
	}
	
    ?>


</body>
</html>
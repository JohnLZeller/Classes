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
				$to_print_string .= $_POST['choice']
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

			<div id="results">
			    <?php
				function printresults($to_print){
				    echo $to_print;
				}
			    ?>
			</div>
		</div>
	</div>

<!-- PHP goes here -->
    <!-- The SQL parser that gives all the necessary functionality to the database application -->
    <?php
	error_reporting(E_ALL);
	if($_POST['choice']!="View"){ // Only run sanitize if it's Insert or Delete running
	$tempver = sanitize($_POST['input']); /* Call the sanitize function to check that all variables are within the rules */
	}else{
	    $tempver = 0;
	}
	
	if ($tempver==1){
	    $to_print_string = "Restart your submission and try again<br>";
	    printresults($to_print_string);
	}else{
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
	}
	
	function connect(){
		$to_print_string = "";
		$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "zellerjo-db", "RQXKvRU7D3W0x7bO", "zellerjo-db");
		if ($mysqli->connect_errno) {
			$to_print_string .= "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error . "<br>";
		}else{
			$to_print_string .= "CONNECTED!!!<br>";
		}
		echo $to_print_string;
		return $mysqli;
	}
    
    	function sanitize($input){
	    $to_print_string = "";
	    switch($input){
		case "Customer":
		    $list = array($_POST['ssn'], $_POST['cname'], $_POST['address'], $_POST['phone']);
		// SSN
			// Check that SSN is 9 characters long
		    if (strlen($list[0])!=9){
			$to_print_string .= "ERROR - SSN <b>must</b> be 9 numbers long, without '-'s.<br>You entered " . strlen($list[0]) .
						" characters.<br>";
			echo $to_print_string;
			return 1; // ERROR RETURN
		    }
			// Check that SSN has ONLY numbers - ASCII 48-57 NUMBERS
		    for($i=0; $i<strlen($list[0]); $i++){
			$temp = 0;
			for($a=48; $a<=57; $a++){ 		// Checking all NUMBERS
			    if(ord(substr($list[0], $i, 1)) != $a){
				$temp++;
			    }
			}
			if($temp==10){				// Verifying temp is 10 - If not, then character was not within valid parameters
			    $to_print_string .= "ERROR - SSN <b>must</b> be 9 numbers long, without '-'s.<br>Character number " . ($i + 1) .
						    " is '" . substr($list[0], $i, 1) . "', which is NOT a number between 0-9.<br>";
			    echo $to_print_string;
			    return 1; // ERROR RETURN
			}
		    }
		// Cname
			// Check that Cname is NOT longer than 40 characters
		    if (strlen($list[1])>40){
			$to_print_string .= "ERROR - Name <b>must not</b> be longer than 40 <b>letters</b>.<br>You entered " . strlen($list[1]) .
						" characters.<br>";
			echo $to_print_string;
			return 1; // ERROR RETURN
		    }
			// Check that Cname has ONLY spaces and letters - ASCII 32 SPACE, 65-90 UPPERCASE, 97-122 LOWERCASE
		    for($i=0; $i<strlen($list[1]); $i++){
			$temp = 0;
			if(ord(substr($list[1], $i, 1)) != 32){	// Checking for SPACES
			    $temp++;
			}
			for($a=65; $a<=90; $a++){ 		// Checking all UPPERCASE
			    if(ord(substr($list[1], $i, 1)) != $a){
				$temp++;
			    }
			}
			for($a=97; $a<=122; $a++){		// Checking all LOWERCASE
			    if(ord(substr($list[1], $i, 1)) != $a){
				$temp++;
			    }
			}
			if($temp==53){				// Verifying temp is 53 - If not, then character was not within valid parameters
			    $to_print_string .= "ERROR - Name <b>must</b> be ONLY letters and a space.<br>Character number " . ($i + 1) . " is '" .
						    substr($list[1], $i, 1) . "', which is NOT a letter or a space.<br>";
			    echo $to_print_string;
			    return 1; // ERROR RETURN
			}
		    }
		// Address
			// Check that Address is NOT longer than 40 characters
		    if (strlen($list[2])>40){
			$to_print_string .= "ERROR - Address <b>must not</b> be longer than 40 <b>letters</b>.<br>You entered " . strlen($list[2]) .
						" characters.<br>";
			echo $to_print_string;
			return 1; // ERROR RETURN
		    }
			// Check that Address has ONLY spaces, numbers and letters - 32 SPACE, 48-57 NUMBERS, ASCII 65-90 UPPERCASE, 97-122 LOWERCASE
		    for($i=0; $i<strlen($list[2]); $i++){
			$temp = 0;
			if(ord(substr($list[2], $i, 1)) != 32){	// Checking for SPACES
			    $temp++;
			}
			for($a=48; $a<=57; $a++){ 		// Checking all NUMBERS
			    if(ord(substr($list[2], $i, 1)) != $a){
				$temp++;
			    }
			}
			for($a=65; $a<=90; $a++){ 		// Checking all UPPERCASE
			    if(ord(substr($list[2], $i, 1)) != $a){
				$temp++;
			    }
			}
			for($a=97; $a<=122; $a++){		// Checking all LOWERCASE
			    if(ord(substr($list[2], $i, 1)) != $a){
				$temp++;
			    }
			}
			if($temp==63){				// Verifying temp is 63 - If not, then character was not within valid parameters
			    $to_print_string .= "ERROR - Address <b>must</b> be ONLY a letters, numbers and spaces.<br>Character number " . ($i + 1) .
						    " is '" . substr($list[2], $i, 1) . "', which is NOT a letter, number or a space.<br>";
			    echo $to_print_string;
			    return 1; // ERROR RETURN
			}
		    }
		    
		// Phone
			// Check that Phone is no more than 10 characters long
		    if (strlen($list[3])>10){
			$to_print_string .= "ERROR - Phone <b>must not</b> be longer than 10 numbers.<br>You entered " . strlen($list[3]) .
						" characters.<br>";
			echo $to_print_string;
			return 1; // ERROR RETURN
		    }
			// Check that Phone has ONLY numbers - ASCII 48-57 NUMBERS
		    for($i=0; $i<strlen($list[3]); $i++){
			$temp = 0;
			for($a=48; $a<=57; $a++){ 		// Checking all NUMBERS
			    if(ord(substr($list[3], $i, 1)) != $a){
				$temp++;
			    }
			}
			if($temp==10){				// Verifying temp is 10 - If not, then character was not within valid parameters
			    $to_print_string .= "ERROR - Phone <b>must</b> be ONLY numbers, without '-'s.<br>Character number " . ($i + 1) . " is '" .
						    substr($list[3], $i, 1) . "', which is NOT a number between 0-9.<br>";
			    echo $to_print_string;
			    return 1; // ERROR RETURN
			}
		    }
		    break;
		
		case "Employee":
		    $list = array($_POST['ssn'], $_POST['ename'], $_POST['address'], $_POST['phone'], $_POST['salary']);
		// SSN
			// Check that SSN is 9 characters long
		    if (strlen($list[0])!=9){
			$to_print_string .= "ERROR - SSN <b>must</b> be 9 numbers long, without '-'s.<br>You entered " . strlen($list[0]) .
						" characters.<br>";
			echo $to_print_string;
			return 1; // ERROR RETURN
		    }
			// Check that SSN has ONLY numbers - ASCII 48-57 NUMBERS
		    for($i=0; $i<strlen($list[0]); $i++){
			$temp = 0;
			for($a=48; $a<=57; $a++){ 		// Checking all NUMBERS
			    if(ord(substr($list[0], $i, 1)) != $a){
				$temp++;
			    }
			}
			if($temp==10){				// Verifying temp is 10 - If not, then character was not within valid parameters
			    $to_print_string .= "ERROR - SSN <b>must</b> be 9 numbers long, without '-'s.<br>Character number " . ($i + 1) .
						    " is '" . substr($list[0], $i, 1) . "', which is NOT a number between 0-9.<br>";
			    echo $to_print_string;
			    return 1; // ERROR RETURN
			}
		    }
		// Ename
			// Check that Ename is NOT longer than 40 characters
		    if (strlen($list[1])>40){
			$to_print_string .= "ERROR - Name <b>must not</b> be longer than 40 <b>letters</b>.<br>You entered " . strlen($list[1]) .
						" characters.<br>";
			echo $to_print_string;
			return 1; // ERROR RETURN
		    }
			// Check that Ename has ONLY spaces and letters - ASCII 32 SPACE, 65-90 UPPERCASE, 97-122 LOWERCASE
		    for($i=0; $i<strlen($list[1]); $i++){
			$temp = 0;
			if(ord(substr($list[1], $i, 1)) != 32){	// Checking for SPACES		- 1
			    $temp++;
			}
			for($a=65; $a<=90; $a++){ 		// Checking all UPPERCASE	- 26
			    if(ord(substr($list[1], $i, 1)) != $a){
				$temp++;
			    }
			}
			for($a=97; $a<=122; $a++){		// Checking all LOWERCASE	- 26
			    if(ord(substr($list[1], $i, 1)) != $a){
				$temp++;
			    }
			}
			if($temp==53){				// Verifying temp is 53 - If not, then character was not within valid parameters
			    $to_print_string .= "ERROR - Name <b>must</b> be ONLY letters and a space.<br>Character number " . ($i + 1) . " is '" .
						    substr($list[1], $i, 1) . "', which is NOT a letter or a space.<br>";
			    echo $to_print_string;
			    return 1; // ERROR RETURN
			}
		    }
		// Address
			// Check that Address is NOT longer than 40 characters
		    if (strlen($list[2])>40){
			$to_print_string .= "ERROR - Address <b>must not</b> be longer than 40 <b>letters</b>.<br>You entered " . strlen($list[2]) .
						" characters.<br>";
			echo $to_print_string;
			return 1; // ERROR RETURN
		    }
			// Check that Address has ONLY spaces, numbers and letters - 32 SPACE, 48-57 NUMBERS, ASCII 65-90 UPPERCASE, 97-122 LOWERCASE
		    for($i=0; $i<strlen($list[2]); $i++){
			$temp = 0;
			if(ord(substr($list[2], $i, 1)) != 32){	// Checking for SPACES		- 1
			    $temp++;
			}
			for($a=48; $a<=57; $a++){ 		// Checking all NUMBERS		- 10
			    if(ord(substr($list[2], $i, 1)) != $a){
				$temp++;
			    }
			}
			for($a=65; $a<=90; $a++){ 		// Checking all UPPERCASE	- 26
			    if(ord(substr($list[2], $i, 1)) != $a){
				$temp++;
			    }
			}
			for($a=97; $a<=122; $a++){		// Checking all LOWERCASE	- 26
			    if(ord(substr($list[2], $i, 1)) != $a){
				$temp++;
			    }
			}
			if($temp==63){				// Verifying temp is 63 - If not, then character was not within valid parameters
			    $to_print_string .= "ERROR - Address <b>must</b> be ONLY a letters, numbers and spaces.<br>Character number " . ($i + 1) .
						    " is '" . substr($list[2], $i, 1) . "', which is NOT a letter, number or a space.<br>";
			    echo $to_print_string;
			    return 1; // ERROR RETURN
			}
		    }
		    
		// Phone
			// Check that Phone is no more than 10 characters long
		    if (strlen($list[3])>10){
			$to_print_string .= "ERROR - Phone <b>must not</b> be longer than 10 numbers.<br>You entered " . strlen($list[3]) .
						" characters.<br>";
			echo $to_print_string;
			return 1; // ERROR RETURN
		    }
			// Check that Phone has ONLY numbers - ASCII 48-57 NUMBERS
		    for($i=0; $i<strlen($list[3]); $i++){
			$temp = 0;
			for($a=48; $a<=57; $a++){ 		// Checking all NUMBERS		- 10
			    if(ord(substr($list[3], $i, 1)) != $a){
				$temp++;
			    }
			}
			if($temp==10){				// Verifying temp is 10 - If not, then character was not within valid parameters
			    $to_print_string .= "ERROR - Phone <b>must</b> be ONLY numbers, without '-'s.<br>Character number " . ($i + 1) . " is '" .
						    substr($list[3], $i, 1) . "', which is NOT a number between 0-9.<br>";
			    echo $to_print_string;
			    return 1; // ERROR RETURN
			}
		    }
		// Salary
			// Check that Salary is no more than 10 characters long
		    if (strlen($list[4])>10){
			$to_print_string .= "ERROR - Oh COME ON! No one here makes $" . $list[4] . " per year!<br>That's more than a BILLION dollars...
						I am <b>not</b> entering that.<br>";
			echo $to_print_string;
			return 1; // ERROR RETURN
		    }
			// Check that Salary has ONLY numbers - ASCII 48-57 NUMBERS
		    for($i=0; $i<strlen($list[4]); $i++){
			$temp = 0;
			for($a=48; $a<=57; $a++){ 		// Checking all NUMBERS		- 10
			    if(ord(substr($list[4], $i, 1)) != $a){
				$temp++;
			    }
			}
			if($temp==10){				// Verifying temp is 10 - If not, then character was not within valid parameters
			    $to_print_string .= "ERROR - Salary <b>must</b> be ONLY real numbers, without commas or decimals.<br>Character number "
						    . ($i + 1) . " is '" . substr($list[4], $i, 1) . "', which is NOT a number between 0-9.<br>";
			    echo $to_print_string;
			    return 1; // ERROR RETURN
			}
		    }
		    break;
		case "Car":
		    $list = array($_POST['vin'], $_POST['price'], $_POST['make'], $_POST['model'], $_POST['color']);
		// VIN
			// Check that VIN is 17 characters long
		    if (strlen($list[0])!=17){
			$to_print_string .= "ERROR - VIN <b>must</b> be 17 characters long.<br>You entered " . strlen($list[0]) . " characters.<br>";
			echo $to_print_string;
			return 1; // ERROR RETURN
		    }
			// Check that VIN has ONLY numbers - ASCII 48-57 NUMBERS
		    for($i=0; $i<strlen($list[0]); $i++){
			$temp = 0;
			for($a=48; $a<=57; $a++){ 		// Checking all NUMBERS		- 10
			    if(ord(substr($list[0], $i, 1)) != $a){
				$temp++;
			    }
			}
			for($a=65; $a<=90; $a++){ 		// Checking all UPPERCASE	- 26
			    if(ord(substr($list[0], $i, 1)) != $a){
				$temp++;
			    }
			}
			for($a=97; $a<=122; $a++){		// Checking all LOWERCASE	- 26
			    if(ord(substr($list[0], $i, 1)) != $a){
				$temp++;
			    }
			}
			if($temp==62){				// Verifying temp is 62 - If not, then character was not within valid parameters
			    $to_print_string .= "ERROR - VIN <b>must</b> be ONLY numbers and letters.<br>Character number " . ($i + 1) .
						    " is '" . substr($list[0], $i, 1) . "', which is NOT a number or a letter.<br>";
			    echo $to_print_string;
			    return 1; // ERROR RETURN
			}
		    }
		// Price
			// Check that Price is no more than 10 characters long
		    if (strlen($list[1])>10){
			$to_print_string .= "ERROR - Really? Seriously?! No car costs $" . $list[1] . "!<br>That's more than a BILLION dollars...
						I am <b>not</b> entering that.<br>";
			echo $to_print_string;
			return 1; // ERROR RETURN
		    }
			// Check that Price has ONLY numbers - ASCII 48-57 NUMBERS
		    for($i=0; $i<strlen($list[1]); $i++){
			$temp = 0;
			for($a=48; $a<=57; $a++){ 		// Checking all NUMBERS		- 10
			    if(ord(substr($list[1], $i, 1)) != $a){
				$temp++;
			    }
			}
			if($temp==10){				// Verifying temp is 10 - If not, then character was not within valid parameters
			    $to_print_string .= "ERROR - Price <b>must</b> be ONLY real numbers, without commas or decimals.<br>Character number "
						    . ($i + 1) . " is '" . substr($list[1], $i, 1) . "', which is NOT a number between 0-9.<br>";
			    echo $to_print_string;
			    return 1; // ERROR RETURN
			}
		    }
		// Make
			// Check that Make is NOT longer than 20 characters
		    if (strlen($list[2])>20){
			$to_print_string .= "ERROR - Make <b>must not</b> be longer than 20 <b>letters</b>.<br>You entered " . strlen($list[2]) .
						" characters.<br>";
			echo $to_print_string;
			return 1; // ERROR RETURN
		    }
			// Check that Make has ONLY spaces and letters - ASCII 32 SPACE, 65-90 UPPERCASE, 97-122 LOWERCASE
		    for($i=0; $i<strlen($list[2]); $i++){
			$temp = 0;
			if(ord(substr($list[2], $i, 1)) != 32){	// Checking for SPACES		- 1
			    $temp++;
			}
			for($a=65; $a<=90; $a++){ 		// Checking all UPPERCASE	- 26
			    if(ord(substr($list[2], $i, 1)) != $a){
				$temp++;
			    }
			}
			for($a=97; $a<=122; $a++){		// Checking all LOWERCASE	- 26
			    if(ord(substr($list[2], $i, 1)) != $a){
				$temp++;
			    }
			}
			if($temp==53){				// Verifying temp is 53 - If not, then character was not within valid parameters
			    $to_print_string .= "ERROR - Make <b>must</b> be ONLY letters and maybe a space.<br>Character number " . ($i + 1) . " is '" .
						    substr($list[2], $i, 1) . "', which is NOT a letter or a space.<br>";
			    echo $to_print_string;
			    return 1; // ERROR RETURN
			}
		    }
		// Model
			// Check that Model is NOT longer than 20 characters
		    if (strlen($list[3])>20){
			$to_print_string .= "ERROR - Model <b>must not</b> be longer than 20 <b>letters</b>.<br>You entered " . strlen($list[3]) .
						" characters.<br>";
			echo $to_print_string;
			return 1; // ERROR RETURN
		    }
			// Check that Model has ONLY spaces and letters - ASCII 32 SPACE, 65-90 UPPERCASE, 97-122 LOWERCASE
		    for($i=0; $i<strlen($list[3]); $i++){
			$temp = 0;
			if(ord(substr($list[3], $i, 1)) != 32){	// Checking for SPACES		- 1
			    $temp++;
			}
			for($a=65; $a<=90; $a++){ 		// Checking all UPPERCASE	- 26
			    if(ord(substr($list[3], $i, 1)) != $a){
				$temp++;
			    }
			}
			for($a=97; $a<=122; $a++){		// Checking all LOWERCASE	- 26
			    if(ord(substr($list[3], $i, 1)) != $a){
				$temp++;
			    }
			}
			if($temp==53){				// Verifying temp is 53 - If not, then character was not within valid parameters
			    $to_print_string .= "ERROR - Model <b>must</b> be ONLY letters and maybe a space.<br>Character number " . ($i + 1) . " is '" .
						    substr($list[3], $i, 1) . "', which is NOT a letter or a space.<br>";
			    echo $to_print_string;
			    return 1; // ERROR RETURN
			}
		    }
		// Color
			// Check that Color is NOT longer than 10 characters
		    if (strlen($list[4])>10){
			$to_print_string .= "ERROR - Color <b>must not</b> be longer than 10 <b>letters</b>.<br>You entered " . strlen($list[4]) .
						" characters.<br>";
			echo $to_print_string;
			return 1; // ERROR RETURN
		    }
			// Check that Color has ONLY spaces and letters - ASCII 32 SPACE, 65-90 UPPERCASE, 97-122 LOWERCASE
		    for($i=0; $i<strlen($list[4]); $i++){
			$temp = 0;
			if(ord(substr($list[4], $i, 1)) != 32){	// Checking for SPACES		- 1
			    $temp++;
			}
			for($a=65; $a<=90; $a++){ 		// Checking all UPPERCASE	- 26
			    if(ord(substr($list[4], $i, 1)) != $a){
				$temp++;
			    }
			}
			for($a=97; $a<=122; $a++){		// Checking all LOWERCASE	- 26
			    if(ord(substr($list[4], $i, 1)) != $a){
				$temp++;
			    }
			}
			if($temp==53){				// Verifying temp is 53 - If not, then character was not within valid parameters
			    $to_print_string .= "ERROR - Color <b>must</b> be ONLY letters and maybe a space.<br>Character number " . ($i + 1) . " is '" .
						    substr($list[4], $i, 1) . "', which is NOT a letter or a space.<br>";
			    echo $to_print_string;
			    return 1; // ERROR RETURN
			}
		    }
		    break;
		case "Lot":
		    $list = array($_POST['lot_num'], $_POST['capacity']);
		// Lot # - REQUIRED
			// Check that Lot # is no less than 1 and no more than 3 characters long
		    if (strlen($list[0])>3 or strlen($list[0])<1){
			$to_print_string .= "ERROR - Lot # <b>must</b> be between 1-3 numbers long.<br>You entered " . strlen($list[0]) .
						" characters.<br>";
			echo $to_print_string;
			return 1; // ERROR RETURN
		    }
			// Check that SSN has ONLY numbers - ASCII 48-57 NUMBERS
		    for($i=0; $i<strlen($list[0]); $i++){
			$temp = 0;
			for($a=48; $a<=57; $a++){ 		// Checking all NUMBERS
			    if(ord(substr($list[0], $i, 1)) != $a){
				$temp++;
			    }
			}
			if($temp==10){				// Verifying temp is 10 - If not, then character was not within valid parameters
			    $to_print_string .= "ERROR - Lot # <b>must</b> be between 1-3 numbers long.<br>Character number " . ($i + 1) .
						    " is '" . substr($list[0], $i, 1) . "', which is NOT a number between 0-9.<br>";
			    echo $to_print_string;
			    return 1; // ERROR RETURN
			}
		    }
		// Capacity
			// Check that Capacity is no more than 10 characters long
		    if (strlen($list[1])>10){
			$to_print_string .= "ERROR - Dude... there is no way a used car dealership could house " . $list[1] . " cars!<br>That's more than a BILLION cars...
						I am <b>not</b> entering that.<br>";
			echo $to_print_string;
			return 1; // ERROR RETURN
		    }
			// Check that Salary has ONLY numbers - ASCII 48-57 NUMBERS
		    for($i=0; $i<strlen($list[1]); $i++){
			$temp = 0;
			for($a=48; $a<=57; $a++){ 		// Checking all NUMBERS		- 10
			    if(ord(substr($list[1], $i, 1)) != $a){
				$temp++;
			    }
			}
			if($temp==10){				// Verifying temp is 10 - If not, then character was not within valid parameters
			    $to_print_string .= "ERROR - Salary <b>must</b> be ONLY real numbers, without commas or decimals.<br>Character number "
						    . ($i + 1) . " is '" . substr($list[1], $i, 1) . "', which is NOT a number between 0-9.<br>";
			    echo $to_print_string;
			    return 1; // ERROR RETURN
			}
		    }
		    break;
		case "Purchased":
		    $list = array($_POST['date'], $_POST['sold_for'], $_POST['vin'], $_POST['ssn']);
		// Date
			// Check that Date is 8 characters long
		    if (strlen($list[0])!=8){
			$to_print_string .= "ERROR - Date <b>must</b> be 8 numbers long, in the form mmddyyy.<br>You entered " . strlen($list[0]) .
						" characters.<br>";
			echo $to_print_string;
			return 1; // ERROR RETURN
		    }
			// Check that Date has ONLY numbers - ASCII 48-57 NUMBERS
		    for($i=0; $i<strlen($list[0]); $i++){
			$temp = 0;
			for($a=48; $a<=57; $a++){ 		// Checking all NUMBERS
			    if(ord(substr($list[0], $i, 1)) != $a){
				$temp++;
			    }
			}
			if($temp==10){				// Verifying temp is 10 - If not, then character was not within valid parameters
			    $to_print_string .= "ERROR - Date <b>must</b> be 8 numbers long, in the form mmddyyy.<br>Character number " . ($i + 1) .
						    " is '" . substr($list[0], $i, 1) . "', which is NOT a number between 0-9.<br>";
			    echo $to_print_string;
			    return 1; // ERROR RETURN
			}
		    }
		// Sold for
			// Check that Sold For is no more than 10 characters long
		    if (strlen($list[1])>10){
			$to_print_string .= "ERROR - Really? Seriously?! No car costs $" . $list[1] . "!<br>That's more than a BILLION dollars...
						I am <b>not</b> entering that.<br>";
			echo $to_print_string;
			return 1; // ERROR RETURN
		    }
			// Check that Sold For has ONLY numbers - ASCII 48-57 NUMBERS
		    for($i=0; $i<strlen($list[1]); $i++){
			$temp = 0;
			for($a=48; $a<=57; $a++){ 		// Checking all NUMBERS		- 10
			    if(ord(substr($list[1], $i, 1)) != $a){
				$temp++;
			    }
			}
			if($temp==10){				// Verifying temp is 10 - If not, then character was not within valid parameters
			    $to_print_string .= "ERROR - Sold For <b>must</b> be ONLY real numbers, without commas or decimals.<br>Character number "
						    . ($i + 1) . " is '" . substr($list[1], $i, 1) . "', which is NOT a number between 0-9.<br>";
			    echo $to_print_string;
			    return 1; // ERROR RETURN
			}
		    }
		// VIN
			// Check that VIN is 17 characters long
		    if (strlen($list[2])!=17){
			$to_print_string .= "ERROR - VIN <b>must</b> be 17 characters long.<br>You entered " . strlen($list[2]) . " characters.<br>";
			echo $to_print_string;
			return 1; // ERROR RETURN
		    }
			// Check that VIN has ONLY numbers - ASCII 48-57 NUMBERS
		    for($i=0; $i<strlen($list[2]); $i++){
			$temp = 0;
			for($a=48; $a<=57; $a++){ 		// Checking all NUMBERS		- 10
			    if(ord(substr($list[2], $i, 1)) != $a){
				$temp++;
			    }
			}
			for($a=65; $a<=90; $a++){ 		// Checking all UPPERCASE	- 26
			    if(ord(substr($list[2], $i, 1)) != $a){
				$temp++;
			    }
			}
			for($a=97; $a<=122; $a++){		// Checking all LOWERCASE	- 26
			    if(ord(substr($list[2], $i, 1)) != $a){
				$temp++;
			    }
			}
			if($temp==62){				// Verifying temp is 62 - If not, then character was not within valid parameters
			    $to_print_string .= "ERROR - VIN <b>must</b> be ONLY numbers and letters.<br>Character number " . ($i + 1) .
						    " is '" . substr($list[2], $i, 1) . "', which is NOT a number or a letter.<br>";
			    echo $to_print_string;
			    return 1; // ERROR RETURN
			}
		    }
		// SSN
			// Check that SSN is 9 characters long
		    if (strlen($list[3])!=9){
			$to_print_string .= "ERROR - SSN <b>must</b> be 9 numbers long, without '-'s.<br>You entered " . strlen($list[3]) .
						" characters.<br>";
			echo $to_print_string;
			return 1; // ERROR RETURN
		    }
			// Check that SSN has ONLY numbers - ASCII 48-57 NUMBERS
		    for($i=0; $i<strlen($list[3]); $i++){
			$temp = 0;
			for($a=48; $a<=57; $a++){ 		// Checking all NUMBERS
			    if(ord(substr($list[3], $i, 1)) != $a){
				$temp++;
			    }
			}
			if($temp==10){				// Verifying temp is 10 - If not, then character was not within valid parameters
			    $to_print_string .= "ERROR - SSN <b>must</b> be 9 numbers long, without '-'s.<br>Character number " . ($i + 1) .
						    " is '" . substr($list[3], $i, 1) . "', which is NOT a number between 0-9.<br>";
			    echo $to_print_string;
			    return 1; // ERROR RETURN
			}
		    }
		    break;
		case "Stored In":
		    $list = array($_POST['since'], $_POST['until'], $_POST['vin'], $_POST['lot_num']);
		// Since
			// Check that Since is 8 characters long
		    if (strlen($list[0])!=8){
			$to_print_string .= "ERROR - Since <b>must</b> be 8 numbers long, in the form mmddyyy.<br>You entered " . strlen($list[0]) .
						" characters.<br>";
			echo $to_print_string;
			return 1; // ERROR RETURN
		    }
			// Check that Since has ONLY numbers - ASCII 48-57 NUMBERS
		    for($i=0; $i<strlen($list[0]); $i++){
			$temp = 0;
			for($a=48; $a<=57; $a++){ 		// Checking all NUMBERS
			    if(ord(substr($list[0], $i, 1)) != $a){
				$temp++;
			    }
			}
			if($temp==10){				// Verifying temp is 10 - If not, then character was not within valid parameters
			    $to_print_string .= "ERROR - Since <b>must</b> be 8 numbers long, in the form mmddyyy.<br>Character number " . ($i + 1) .
						    " is '" . substr($list[0], $i, 1) . "', which is NOT a number between 0-9.<br>";
			    echo $to_print_string;
			    return 1; // ERROR RETURN
			}
		    }
		// Until
			// Check that Until is 8 characters long
		    if (strlen($list[1])!=8){
			$to_print_string .= "ERROR - Until <b>must</b> be 8 numbers long, in the form mmddyyy.<br>You entered " . strlen($list[1]) .
						" characters.<br>";
			echo $to_print_string;
			return 1; // ERROR RETURN
		    }
			// Check that Until has ONLY numbers - ASCII 48-57 NUMBERS
		    for($i=0; $i<strlen($list[1]); $i++){
			$temp = 0;
			for($a=48; $a<=57; $a++){ 		// Checking all NUMBERS
			    if(ord(substr($list[1], $i, 1)) != $a){
				$temp++;
			    }
			}
			if($temp==10){				// Verifying temp is 10 - If not, then character was not within valid parameters
			    $to_print_string .= "ERROR - Until <b>must</b> be 8 numbers long, in the form mmddyyy.<br>Character number " . ($i + 1) .
						    " is '" . substr($list[1], $i, 1) . "', which is NOT a number between 0-9.<br>";
			    echo $to_print_string;
			    return 1; // ERROR RETURN
			}
		    }
			// Check that Until comes later than or equal to Since
		    $since = intval($list[0]);
		    $until = intval($list[1]);
		    $sincearr = array(substr($since, 4, 4), substr($since, 0, 2), substr($since, 2, 2));	//Organize into an array, with format Year, Month, Day
		    $untilarr = array(substr($until, 4, 4), substr($until, 0, 2), substr($until, 2, 2));
		    if($sincearr[0]>$untilarr[0]){
			$to_print_string .= "ERROR - Since may <b>not</b> be later than Until.<br>You input that Since is " . $since . " and Until is "
						. $until . ".<br>";
			echo $to_print_string;
			return 1; // ERROR RETURN
		    }else if($sincearr[1]>$untilarr[1]){
			$to_print_string .= "ERROR - Since may <b>not</b> be later than Until.<br>You input that Since is " . $since . " and Until is "
						. $until . ".<br>";
			echo $to_print_string;
			return 1; // ERROR RETURN
		    }else if($sincearr[2]>$untilarr[2]){
			$to_print_string .= "ERROR - Since may <b>not</b> be later than Until.<br>You input that Since is " . $since . " and Until is "
						. $until . ".<br>";
			echo $to_print_string;
			return 1; // ERROR RETURN
		    }
		// VIN
			// Check that VIN is 17 characters long
		    if (strlen($list[2])!=17){
			$to_print_string .= "ERROR - VIN <b>must</b> be 17 characters long.<br>You entered " . strlen($list[2]) . " characters.<br>";
			echo $to_print_string;
			return 1; // ERROR RETURN
		    }
			// Check that VIN has ONLY numbers - ASCII 48-57 NUMBERS
		    for($i=0; $i<strlen($list[2]); $i++){
			$temp = 0;
			for($a=48; $a<=57; $a++){ 		// Checking all NUMBERS		- 10
			    if(ord(substr($list[2], $i, 1)) != $a){
				$temp++;
			    }
			}
			for($a=65; $a<=90; $a++){ 		// Checking all UPPERCASE	- 26
			    if(ord(substr($list[2], $i, 1)) != $a){
				$temp++;
			    }
			}
			for($a=97; $a<=122; $a++){		// Checking all LOWERCASE	- 26
			    if(ord(substr($list[2], $i, 1)) != $a){
				$temp++;
			    }
			}
			if($temp==62){				// Verifying temp is 62 - If not, then character was not within valid parameters
			    $to_print_string .= "ERROR - VIN <b>must</b> be ONLY numbers and letters.<br>Character number " . ($i + 1) .
						    " is '" . substr($list[2], $i, 1) . "', which is NOT a number or a letter.<br>";
			    echo $to_print_string;
			    return 1; // ERROR RETURN
			}
		    }
		// Lot # - REQUIRED
			// Check that Lot # is no less than 1 and no more than 3 characters long
		    if (strlen($list[3])>3 or strlen($list[3])<1){
			$to_print_string .= "ERROR - Lot # <b>must</b> be between 1-3 numbers long.<br>You entered " . strlen($list[3]) .
						" characters.<br>";
			echo $to_print_string;
			return 1; // ERROR RETURN
		    }
			// Check that SSN has ONLY numbers - ASCII 48-57 NUMBERS
		    for($i=0; $i<strlen($list[3]); $i++){
			$temp = 0;
			for($a=48; $a<=57; $a++){ 		// Checking all NUMBERS
			    if(ord(substr($list[3], $i, 1)) != $a){
				$temp++;
			    }
			}
			if($temp==10){				// Verifying temp is 10 - If not, then character was not within valid parameters
			    $to_print_string .= "ERROR - Lot # <b>must</b> be between 1-3 numbers long.<br>Character number " . ($i + 1) .
						    " is '" . substr($list[3], $i, 1) . "', which is NOT a number between 0-9.<br>";
			    echo $to_print_string;
			    return 1; // ERROR RETURN
			}
		    }
		    break;
		case "Works In":
		    $list = array($_POST['since'], $_POST['ssn'], $_POST['lot_num']);
		// Since
			// Check that Since is 8 characters long
		    if (strlen($list[0])!=8){
			$to_print_string .= "ERROR - Since <b>must</b> be 8 numbers long, in the form mmddyyy.<br>You entered " . strlen($list[0]) .
						" characters.<br>";
			echo $to_print_string;
			return 1; // ERROR RETURN
		    }
			// Check that Since has ONLY numbers - ASCII 48-57 NUMBERS
		    for($i=0; $i<strlen($list[0]); $i++){
			$temp = 0;
			for($a=48; $a<=57; $a++){ 		// Checking all NUMBERS
			    if(ord(substr($list[0], $i, 1)) != $a){
				$temp++;
			    }
			}
			if($temp==10){				// Verifying temp is 10 - If not, then character was not within valid parameters
			    $to_print_string .= "ERROR - Since <b>must</b> be 8 numbers long, in the form mmddyyy.<br>Character number " . ($i + 1) .
						    " is '" . substr($list[0], $i, 1) . "', which is NOT a number between 0-9.<br>";
			    echo $to_print_string;
			    return 1; // ERROR RETURN
			}
		    }
		// SSN
			// Check that SSN is 9 characters long
		    if (strlen($list[1])!=9){
			$to_print_string .= "ERROR - SSN <b>must</b> be 9 numbers long, without '-'s.<br>You entered " . strlen($list[1]) .
						" characters.<br>";
			echo $to_print_string;
			return 1; // ERROR RETURN
		    }
			// Check that SSN has ONLY numbers - ASCII 48-57 NUMBERS
		    for($i=0; $i<strlen($list[1]); $i++){
			$temp = 0;
			for($a=48; $a<=57; $a++){ 		// Checking all NUMBERS
			    if(ord(substr($list[1], $i, 1)) != $a){
				$temp++;
			    }
			}
			if($temp==10){				// Verifying temp is 10 - If not, then character was not within valid parameters
			    $to_print_string .= "ERROR - SSN <b>must</b> be 9 numbers long, without '-'s.<br>Character number " . ($i + 1) .
						    " is '" . substr($list[1], $i, 1) . "', which is NOT a number between 0-9.<br>";
			    echo $to_print_string;
			    return 1; // ERROR RETURN
			}
		    }
		// Lot # - REQUIRED
			// Check that Lot # is no less than 1 and no more than 3 characters long
		    if (strlen($list[2])>3 or strlen($list[2])<1){
			$to_print_string .= "ERROR - Lot # <b>must</b> be between 1-3 numbers long.<br>You entered " . strlen($list[2]) .
						" characters.<br>";
			echo $to_print_string;
			return 1; // ERROR RETURN
		    }
			// Check that SSN has ONLY numbers - ASCII 48-57 NUMBERS
		    for($i=0; $i<strlen($list[2]); $i++){
			$temp = 0;
			for($a=48; $a<=57; $a++){ 		// Checking all NUMBERS
			    if(ord(substr($list[2], $i, 1)) != $a){
				$temp++;
			    }
			}
			if($temp==10){				// Verifying temp is 10 - If not, then character was not within valid parameters
			    $to_print_string .= "ERROR - Lot # <b>must</b> be between 1-3 numbers long.<br>Character number " . ($i + 1) .
						    " is '" . substr($list[2], $i, 1) . "', which is NOT a number between 0-9.<br>";
			    echo $to_print_string;
			    return 1; // ERROR RETURN
			}
		    }
		    break;
		default:
		    break;
	    }
	    return 0; // SUCCESS RETURN
	}
	
	function view_data($input_type){
	    echo "<br>Viewing Data for: " . $input_type . "<br>";
	    echo "<br>Printing Data Now<br>";
	    switch ($_POST['input']){
		case "Customer":
		    /* Drake's code */
		    echo "<h3>Customer View</h3>";
		    $result = mysql_query("SELECT * FROM Customer");
		    echo "<br />";
		    
		    echo "<table border='1'>";
		    echo "<tr> <th>Customer Name</th> <th>SSN</th> <th>Phone</th> <th>Address</th> </tr>";
		    // keeps getting the next row until there are no more to get
		    while($row = mysqli_fetch_array( $result )) {
			    // Print out the contents of each row into a table
			    
			    echo "<tr><td>";
			    echo $row['cname'];
			    echo "</td><td>";
			    echo $row['ssn'];
			    echo "</td><td>";
			    echo $row['phone'];
			    echo "</td><td>";
			    echo $row['address'];
			    echo "</td></tr>";
		    }
		    /* Display results */
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
	    echo "<br>Inserting Data for: " . $input_type . "<br>";
	    $to_print_string = "";
	    switch ($_POST['input']){
		case "Customer":			// Add info to Customer
		    $query = "";
		    $list = array($_POST['ssn'], $_POST['cname'], $_POST['address'], $_POST['phone']);
		    
		    /* MUST FIRST CONNECT TO DATABASE WITHIN THIS SCOPE BEFORE INSERTING TO DATABASE */
		    $mysqli = connect();
		    if ($list[0] != ''){ // Make sure that the primary key SSN exists
			if ( !($stmt = $mysqli->prepare("INSERT INTO Customers(ssn, cname, address, phone)" .
							" VALUES ('" . $list[0] . "', '" . $list[1] . "', '" . $list[2] . "', '" . $list[3] . "')") ) ) {
			    $to_print_string .= "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error . "<br>";
			}
			if (!$stmt->execute()) {
			    $to_print_string .= "Execute failed: (" . $stmt->errno . ") " . $stmt->error . "<br>";
			} else {
			    $to_print_string .= "Added " . $stmt->affected_rows . " rows to Customers.<br>";
			}
		    }else{
			$to_print_string .= "Missing Primary Key SSN!<br>";
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
			    $to_print_string .= "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error . "<br>";
			}
			if (!$stmt->execute()) {
			    $to_print_string .= "Execute failed: (" . $stmt->errno . ") " . $stmt->error . "<br>";
			} else {
			    $to_print_string .= "Added " . $stmt->affected_rows . " rows to Employees.<br>";
			}
		    }else{
			$to_print_string .= "Missing Primary Key SSN!<br>";
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
			    $to_print_string .= "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error . "<br>";
			}
			if (!$stmt->execute()) {
			    $to_print_string .= "Execute failed: (" . $stmt->errno . ") " . $stmt->error . "<br>";
			} else {
			    $to_print_string .= "Added " . $stmt->affected_rows . " rows to Cars.<br>";
			}
		    }else{
			$to_print_string .= "Missing Primary Key VIN!<br>";
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
			    $to_print_string .= "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error . "<br>";
			}
			if (!$stmt->execute()) {
			    $to_print_string .= "Execute failed: (" . $stmt->errno . ") " . $stmt->error . "<br>";
			} else {
			    $to_print_string .= "Added " . $stmt->affected_rows . " rows to Lots.<br>";
			}
		    }else{
			$to_print_string .= "Missing Primary Key Lot #!<br>";
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
			    $to_print_string .= "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error . "<br>";
			}
			if (!$stmt->execute()) {
			    $to_print_string .= "Execute failed: (" . $stmt->errno . ") " . $stmt->error . "<br>";
			} else {
			    $to_print_string .= "Added " . $stmt->affected_rows . " rows to Purchased.<br>";
			}
		    }else{
			if(($list[2] == '')){
				$to_print_string .= "Missing Primary Key VIN!<br>";	
			}else if(($list[3] == '')){
				$to_print_string .= "Missing Primary Key SSN!<br>";	
			}
		    }
		    break;
		case "Stored In":			// Add info to Stored In
		    $query = "";
		    $list = array($_POST['since'], $_POST['until'], $_POST['vin'], $_POST['lot_num']);
		    
		    /* MUST FIRST CONNECT TO DATABASE WITHIN THIS SCOPE BEFORE INSERTING TO DATABASE */
		    $mysqli = connect();
		    if (($list[2] != '') || ($list[3] != '')){ // Make sure that the primary key SSN exists
			if ( !($stmt = $mysqli->prepare("INSERT INTO Stored_In(since, until, vin, lot_num)" .
							" VALUES ('" . $list[0] . "', '" . $list[1] . "', '" . $list[2] . "', '" . $list[3] . "');") ) ) {
			    $to_print_string .= "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error . "<br>";
			}
			if (!$stmt->execute()) {
			    $to_print_string .= "Execute failed: (" . $stmt->errno . ") " . $stmt->error . "<br>";
			} else {
			    $to_print_string .= "Added " . $stmt->affected_rows . " rows to Stored_In.<br>";
			}
		    }else{
			if(($list[2] == '')){
				$to_print_string .= "Missing Primary Key VIN!<br>";	
			}else if(($list[3] == '')){
				$to_print_string .= "Missing Primary Key Lot #!<br>";	
			}
		    }
		    break;
		case "Works In":			// Add info to Works In
		    $query = "";
		    $list = array($_POST['since'], $_POST['ssn'], $_POST['lot_num']);
		    
		    /* MUST FIRST CONNECT TO DATABASE WITHIN THIS SCOPE BEFORE INSERTING TO DATABASE */
		    $mysqli = connect();
		    if (($list[1] != '') || ($list[2] != '')){ // Make sure that the primary key SSN exists
			if ( !($stmt = $mysqli->prepare("INSERT INTO Works_In(since, ssn, lot_num)" .
							" VALUES ('" . $list[0] . "', '" . $list[1] . "', '" . $list[2] . "');") ) ) {
			    $to_print_string .= "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error . "<br>";
			}
			if (!$stmt->execute()) {
			    $to_print_string .= "Execute failed: (" . $stmt->errno . ") " . $stmt->error . "<br>";
			} else {
			    $to_print_string .= "Added " . $stmt->affected_rows . " rows to Works_In.<br>";
			}
		    }else{
			if(($list[1] == '')){
				$to_print_string .= "Missing Primary Key SSN!<br>";	
			}else if(($list[2] == '')){
				$to_print_string .= "Missing Primary Key Lot #!<br>";	
			}
		    }
		    break;
	    }
	    echo $to_print_string;
	}
	
	function delete_data($input_type){
	    echo "<br>Deleting Data for: " . $input_type . "<br>";
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
	
	
	

    ?>


</body>
</html>
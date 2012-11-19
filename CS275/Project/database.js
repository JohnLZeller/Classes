// Holds modification choice (View, Insert, Modify, or Delete)
var input_choice_str = ""
// Holds form input by choice (Customer, Employee, Car, Lot, Purchased, Stored_In, Works_In)
var input_form_str = ""

function OnChoice(data){
	// Generates a dropdown selection menu for choosing which table you would like to use for your modification type
	input_choice_str = data
	if(data==''){
		input_by.innerHTML = ""
	}else{
		input_by.innerHTML = "<br><br>" +
			"<b>Input By</b>" +
			"<select id='inputby' name='inputby' onchange='OnChange(this.value);'>" +
			"	<option value=''></option>" +
			"	<option value='customer'>Customer</option>" +
			"	<option value='employee'>Employee</option>" +
			"	<option value='car'>Car</option>" +
			"	<option value='lot'>Lot</option>" +
			"	<option value='purchased'>Purchased</option>" +
			"	<option value='stored_in'>Stored In</option>" +
			"	<option value='works_in'>Works In</option>" +
			"</select>"
	}
}

function OnChange(data){
	input_form_str = data
	if(data==''){
		input_form.innerHTML = ""
	}else if(data=='customer'){
		input_form.innerHTML = "<br><br><br><form id='customerform' action='process.php' method='post'>"+
			"Full Name:<br><input type='text' id='cname'><br><br>"+
			"SSN:<br><input type='text' id='ssn'><br><br>"+
			"Address:<br><input type='text' id='address'><br><br>"+
			"Phone #:<br><input type='text' id='phone'><br><br>"+
			"<input name='customer' type='submit' value='Submit'>"
		resultstable.innerHTML = "Results"
		<!--This area will hold a dynamically generated table of results-->
	}else if(data=='employee'){
                input_form.innerHTML = "<br><br><br><form id='employeeform' action='process.php' method='post'>"+
                        "Full Name:<br><input type='text' id='ename'><br><br>"+
                        "SSN:<br><input type='text' id='ssn'><br><br>"+
                        "Address:<br><input type='text' id='address'><br><br>"+
                        "Phone #:<br><input type='text' id='phone'><br><br>"+
                        "Salary:<br><input type='text' id='salary'><br><br>"+
                        "<input name='employee' type='submit' value='Submit'>"
		resultstable.innerHTML = "Results"
		<!--This area will hold a dynamically generated table of results-->
        }else if(data=='car'){
                input_form.innerHTML = "<br><br><br><form id='carform' action='process.php' method='post'>"+
                        "VIN:<br><input type='text' id='vin'><br><br>"+
                        "Price:<br><input type='text' id='price'><br><br>"+
                        "Make:<br><input type='text' id='make'><br><br>"+
                        "Model:<br><input type='text' id='model'><br><br>"+
                        "Color:<br><input type='text' id='color'><br><br>"+
                        "<input name='car' type='submit' value='Submit'>"
        	resultstable.innerHTML = "Results"
		<!--This area will hold a dynamically generated table of results-->
	}else if(data=='lot'){
                input_form.innerHTML = "<br><br><br><form id='lotform' action='process.php' method='post'>"+
                        "Lot #:<br><input type='text' id='lot_num'><br><br>"+
                        "Capacity:<br><input type='text' id='capacity'><br><br>"+
                        "<input name='lot' type='submit' value='Submit'>"
        	resultstable.innerHTML = "Results"
		<!--This area will hold a dynamically generated table of results-->
	}else if(data=='purchased'){
                input_form.innerHTML = "<br><br><br><form id='purchasedform' action='process.php' method='post'>"+
                        "Date:<br><input type='text' id='date'><br><br>"+
                        "Sold For:<br><input type='text' id='sold_for'><br><br>"+
                        "VIN:<br><input type='text' id='vin'><br><br>"+
                        "Customer SSN:<br><input type='text' id='ssn'><br><br>"+
                        "<input name='purchased' type='submit' value='Submit'>"
                resultstable.innerHTML = "Results"
		<!--This area will hold a dynamically generated table of results-->
        }else if(data=='stored_in'){
                input_form.innerHTML = "<br><br><br><form id='stored_inform' action='process.php' method='post'>"+
                        "VIN:<br><input type='text' id='vin'><br><br>"+
                        "Lot #:<br><input type='text' id='lot_num'><br><br>"+
                        "Date Since:<br><input type='text' id='since'><br><br>"+
                        "Date Until:<br><input type='text' id='until'><br><br>"+
                        "<input name='stored_in' type='submit' value='Submit'>"
                resultlist.innerHTML = "Results"
		<!--This area will hold a dynamically generated table of results-->
        }else if(data=='works_in'){
                input_form.innerHTML = "<br><br><br><form id='works_inform' action='process.php' method='post'>"+
                        "Lot #:<br><input type='text' id='lot_num'><br><br>"+
                        "Employee SSN:<br><input type='text' id='ssn'><br><br>"+
                        "Date Since:<br><input type='text' id='since'><br><br>"+
                        "<input name='works_in' type='submit' value='Submit'>"
                resultstable.innerHTML = "Results"
		<!--This area will hold a dynamically generated table of results-->
        }
}

// Things to add:
// Add error checking of submit form ON the client-side in the js



// Holds modification choice (View, Insert, Modify, or Delete)
var input_choice_str = ""
// Holds form input by choice (Customer, Employee, Car, Lot, Purchased, Stored_In, Works_In)
var input_form_str = ""

function OnChoice(data){
	// Generates a dropdown selection menu for choosing which table you would like to use for your modification type
	input_choice_str = data
	if(data==''){
		input_by.innerHTML = ""
		input_form.innerHTML = ""
	}else{
		input_form.innerHTML = ""
		input_by.innerHTML = "<br><br>" +
			"<b>Input By</b>" +
			"<select id='inputby' name='inputby' onchange='OnChange(this.value);'>" +
			"	<option value=''></option>" +
			"	<option value='Customer'>Customer</option>" +
			"	<option value='Employee'>Employee</option>" +
			"	<option value='Car'>Car</option>" +
			"	<option value='Lot'>Lot</option>" +
			"	<option value='Purchased'>Purchased</option>" +
			"	<option value='Stored In'>Stored In</option>" +
			"	<option value='Works In'>Works In</option>" +
			"</select>"
	}
}

function OnChange(data){
	input_form_str = data
	if(data==''){
		input_form.innerHTML = ""
	}else if(data=='Customer'){
		input_form.innerHTML = "<br><br><br>" +
			"<form id='customerform' action='process.php' method='post'>"+
				"<input type='hidden' name='choice' value='" + input_choice_str + "'>" +
				"<input type='hidden' name='input' value='" + input_form_str + "'>" +
				"Full Name:<br><input type='text' name='cname'><br><br>"+
				"SSN:<br><input type='text' name='ssn'><br><br>"+
				"Address:<br><input type='text' name='address'><br><br>"+
				"Phone #:<br><input type='text' name='phone'><br><br>"+
				"<input name='customer' type='submit' value='Submit'>" +
			"</form>"
		resultstable.innerHTML = "Results"
		<!--This area will hold a dynamically generated table of results-->
	}else if(data=='Employee'){
                input_form.innerHTML = "<br><br><br>"+
			"<form id='employeeform' action='process.php' method='post'>"+
				"<input type='hidden' name='choice' value='" + input_choice_str + "'>" +
				"<input type='hidden' name='input' value='" + input_form_str + "'>" +
				"Full Name:<br><input type='text' name='ename'><br><br>"+
				"SSN:<br><input type='text' name='ssn'><br><br>"+
				"Address:<br><input type='text' name='address'><br><br>"+
				"Phone #:<br><input type='text' name='phone'><br><br>"+
				"Salary:<br><input type='text' name='salary'><br><br>"+
				"<input name='employee' type='submit' value='Submit'>" +
			"</form>"
		resultstable.innerHTML = "Results"
		<!--This area will hold a dynamically generated table of results-->
        }else if(data=='Car'){
                input_form.innerHTML = "<br><br><br>" +
			"<form id='carform' action='process.php' method='post'>"+
				"<input type='hidden' name='choice' value='" + input_choice_str + "'>" +
				"<input type='hidden' name='input' value='" + input_form_str + "'>" +
				"VIN:<br><input type='text' name='vin'><br><br>"+
				"Price:<br><input type='text' name='price'><br><br>"+
				"Make:<br><input type='text' name='make'><br><br>"+
				"Model:<br><input type='text' name='model'><br><br>"+
				"Color:<br><input type='text' name='color'><br><br>"+
				"<input name='car' type='submit' value='Submit'>" +
			"</form>"
        	resultstable.innerHTML = "Results"
		<!--This area will hold a dynamically generated table of results-->
	}else if(data=='Lot'){
                input_form.innerHTML = "<br><br><br>" +
			"<form id='lotform' action='process.php' method='post'>"+
				"<input type='hidden' name='choice' value='" + input_choice_str + "'>" +
				"<input type='hidden' name='input' value='" + input_form_str + "'>" +
				"Lot #:<br><input type='text' name='lot_num'><br><br>"+
				"Capacity:<br><input type='text' name='capacity'><br><br>"+
				"<input name='lot' type='submit' value='Submit'>" +
			"</form>"
        	resultstable.innerHTML = "Results"
		<!--This area will hold a dynamically generated table of results-->
	}else if(data=='Purchased'){
                input_form.innerHTML = "<br><br><br>" +
			"<form id='purchasedform' action='process.php' method='post'>"+
				"<input type='hidden' name='choice' value='" + input_choice_str + "'>" +
				"<input type='hidden' name='input' value='" + input_form_str + "'>" +
				"Date:<br><input type='text' name='date'><br><br>"+
				"Sold For:<br><input type='text' name='sold_for'><br><br>"+
				"VIN:<br><input type='text' name='vin'><br><br>"+
				"Customer SSN:<br><input type='text' name='ssn'><br><br>"+
				"<input name='purchased' type='submit' value='Submit'>" +
			"</form>"
                resultstable.innerHTML = "Results"
		<!--This area will hold a dynamically generated table of results-->
        }else if(data=='Stored In'){
                input_form.innerHTML = "<br><br><br>" +
			"<form id='stored_inform' action='process.php' method='post'>"+
				"<input type='hidden' name='choice' value='" + input_choice_str + "'>" +
				"<input type='hidden' name='input' value='" + input_form_str + "'>" +
				"VIN:<br><input type='text' name='vin'><br><br>"+
				"Lot #:<br><input type='text' name='lot_num'><br><br>"+
				"Date Since:<br><input type='text' name='since'><br><br>"+
				"Date Until:<br><input type='text' name='until'><br><br>"+
				"<input name='stored_in' type='submit' value='Submit'>" +
			"</form>"
                resultlist.innerHTML = "Results"
		<!--This area will hold a dynamically generated table of results-->
        }else if(data=='Works In'){
                input_form.innerHTML = "<br><br><br>" +
			"<form id='works_inform' action='process.php' method='post'>"+
				"<input type='hidden' name='choice' value='" + input_choice_str + "'>" +
				"<input type='hidden' name='input' value='" + input_form_str + "'>" +
				"Lot #:<br><input type='text' name='lot_num'><br><br>"+
				"Employee SSN:<br><input type='text' name='ssn'><br><br>"+
				"Date Since:<br><input type='text' name='since'><br><br>"+
				"<input name='works_in' type='submit' value='Submit'>" +
			"</form>"
                resultstable.innerHTML = "Results"
		<!--This area will hold a dynamically generated table of results-->
        }
}

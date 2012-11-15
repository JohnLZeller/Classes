function nothing(){
	alert("This does nothing yet!")
}

function OnChange(data){
	if(data=='customer'){
		inputform.innerHTML = "<br><br><br><form id='customerform'>"+
			"Full Name:<br><input type='text' id='cname'><br><br>"+
			"SSN:<br><input type='text' id='ssn'><br><br>"+
			"Address:<br><input type='text' id='address'><br><br>"+
			"Phone #:<br><input type='text' id='phone'><br><br>"+
			"<input type='button' onClick='nothing()' value='Submit'>"
		resultstable.innerHTML = "Results"
		<!--This area will hold a dynamically generated table of results-->
	}else if(data=='employee'){
                inputform.innerHTML = "<br><br><br><form id='employeeform'>"+
                        "Full Name:<br><input type='text' id='ename'><br><br>"+
                        "SSN:<br><input type='text' id='ssn'><br><br>"+
                        "Address:<br><input type='text' id='address'><br><br>"+
                        "Phone #:<br><input type='text' id='phone'><br><br>"+
                        "Salary:<br><input type='text' id='salary'><br><br>"+
                        "<input type='button' onClick='nothing()' value='Submit'>"
		resultstable.innerHTML = "Results"
		<!--This area will hold a dynamically generated table of results-->
        }else if(data=='car'){
                inputform.innerHTML = "<br><br><br><form id='carform'>"+
                        "VIN:<br><input type='text' id='vin'><br><br>"+
                        "Price:<br><input type='text' id='price'><br><br>"+
                        "Make:<br><input type='text' id='make'><br><br>"+
                        "Model:<br><input type='text' id='model'><br><br>"+
                        "Color:<br><input type='text' id='color'><br><br>"+
                        "<input type='button' onClick='nothing()' value='Submit'>"
        	resultstable.innerHTML = "Results"
		<!--This area will hold a dynamically generated table of results-->
	}else if(data=='lot'){
                inputform.innerHTML = "<br><br><br><form id='lotform'>"+
                        "Lot #:<br><input type='text' id='lot_num'><br><br>"+
                        "Capacity:<br><input type='text' id='capacity'><br><br>"+
                        "<input type='button' onClick='nothing()' value='Submit'>"
        	resultstable.innerHTML = "Results"
		<!--This area will hold a dynamically generated table of results-->
	}else if(data=='purchased'){
                inputform.innerHTML = "<br><br><br><form id='purchasedform'>"+
                        "Date:<br><input type='text' id='date'><br><br>"+
                        "Sold For:<br><input type='text' id='sold_for'><br><br>"+
                        "VIN:<br><input type='text' id='vin'><br><br>"+
                        "Customer SSN:<br><input type='text' id='ssn'><br><br>"+
                        "<input type='button' onClick='nothing()' value='Submit'>"
                resultstable.innerHTML = "Results"
		<!--This area will hold a dynamically generated table of results-->
        }else if(data=='stored_in'){
                inputform.innerHTML = "<br><br><br><form id='stored_inform'>"+
                        "VIN:<br><input type='text' id='vin'><br><br>"+
                        "Lot #:<br><input type='text' id='lot_num'><br><br>"+
                        "Date From:<br><input type='text' id='from'><br><br>"+
                        "Date Until:<br><input type='text' id='until'><br><br>"+
                        "<input type='button' onClick='nothing()' value='Submit'>"
                resultlist.innerHTML = "Results"
		<!--This area will hold a dynamically generated table of results-->
        }else if(data=='works_in'){
                inputform.innerHTML = "<br><br><br><form id='works_inform'>"+
                        "Lot #:<br><input type='text' id='lot_num'><br><br>"+
                        "Employee SSN:<br><input type='text' id='ssn'><br><br>"+
                        "Date Since:<br><input type='text' id='since'><br><br>"+
                        "<input type='button' onClick='nothing()' value='Submit'>"
                resultstable.innerHTML = "Results"
		<!--This area will hold a dynamically generated table of results-->
        }
}

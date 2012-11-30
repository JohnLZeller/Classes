// ===============================================================
// * Filename: database.js
// * Author: John Zeller & Drake Bridgewater
// * Date Created: November 10, 2012
// * Recently Updated: November 29, 2012
// * ------
// * Functions present:
// * 	OnChoice(data) 		- Generates a dropdown selection menu for choosing which table you would like to use for your modification type
// * 	OnChange_Insert(data) 	- Generates a form based on your table of choice for inserting information and also provides guidelines for formatting that information
// * 	OnChange_Delete(data) 	- Generates a form based on your table of choice for deleting information and also provides guidelines for formatting that information
// * 	updateResult(data) 	- Used by the PHP to update the resultstable HTML span which is used to display database information based on your current query
// * 	updateInfo(data) 	- Used by the PHP to update the infotabletable HTML span which is used to display information pertaining to your current query
// * ------
// * Notes:
// * 
// * =============================================================



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
		resultstable.innerHTML = ""
	}else if(data=='View'){
		input_form.innerHTML = ""
		input_by.innerHTML = "<br><br>														\
			<b>View By</b><br>														\
			<form id='customerform' action='process.php' method='post'>									\
				<input type='hidden' name='choice' value='View'>									\
				<input type='hidden' name='input' value='Customer'>									\
				<input type='submit' name='customer_view' value='Customers'>								\
			</form><br>															\
			<form id='employeeform' action='process.php' method='post'>									\
				<input type='hidden' name='choice' value='View'>									\
				<input type='hidden' name='input' value='Employee'>									\
				<input type='submit' name='customer_view' value='Employees'>								\
			</form><br>															\
			<form id='carform' action='process.php' method='post'>										\
				<input type='hidden' name='choice' value='View'>									\
				<input type='hidden' name='input' value='Car'>										\
				<input type='submit' name='customer_view' value='Cars'>									\
			</form><br>															\
			<form id='lotform' action='process.php' method='post'>										\
				<input type='hidden' name='choice' value='View'>									\
				<input type='hidden' name='input' value='Lot'>										\
				<input type='submit' name='customer_view' value='Lots'>									\
			</form><br>															\
			<form id='purchasedform' action='process.php' method='post'>									\
				<input type='hidden' name='choice' value='View'>									\
				<input type='hidden' name='input' value='Purchased'>									\
				<input type='submit' name='customer_view' value='Purchases'>								\
			</form><br>															\
			<form id='stored_inform' action='process.php' method='post'>									\
				<input type='hidden' name='choice' value='View'>									\
				<input type='hidden' name='input' value='Stored In'>									\
				<input type='submit' name='customer_view' value='Stored_In'>								\
			</form><br>															\
			<form id='works_inform' action='process.php' method='post'>									\
				<input type='hidden' name='choice' value='View'>									\
				<input type='hidden' name='input' value='Works In'>									\
				<input type='submit' name='customer_view' value='Works_In'>								\
			</form><br>"
		resultstable.innerHTML = ""
	}
	else if(data=='Insert'){
		input_form.innerHTML = ""
		input_by.innerHTML = "<br><br>								\
			<b>Input By</b>									\
			<select id='inputby' name='inputby' onchange='OnChange_Insert(this.value);'>	\
				<option value=''></option>						\
				<option value='Customer'>Customer</option>				\
				<option value='Employee'>Employee</option>				\
				<option value='Car'>Car</option>					\
				<option value='Lot'>Lot</option>					\
				<option value='Purchased'>Purchased</option>				\
				<option value='Stored In'>Stored In</option>				\
				<option value='Works In'>Works In</option>				\
			</select>"
		resultstable.innerHTML = ""
	}else if(data=='Delete'){
		input_form.innerHTML = ""
		input_by.innerHTML = "<br><br>														\
			<b>Delete By</b><br>														\
			<form id='customerform' action='process.php' method='post'>									\
				<input type='hidden' name='choice' value='Delete'>									\
				<input type='hidden' name='input' value='Customer'>									\
				<input type='submit' name='customer_view' value='Customers'>								\
			</form><br>															\
			<form id='employeeform' action='process.php' method='post'>									\
				<input type='hidden' name='choice' value='Delete'>									\
				<input type='hidden' name='input' value='Employee'>									\
				<input type='submit' name='customer_view' value='Employees'>								\
			</form><br>															\
			<form id='carform' action='process.php' method='post'>										\
				<input type='hidden' name='choice' value='Delete'>									\
				<input type='hidden' name='input' value='Car'>										\
				<input type='submit' name='customer_view' value='Cars'>									\
			</form><br>															\
			<form id='lotform' action='process.php' method='post'>										\
				<input type='hidden' name='choice' value='Delete'>									\
				<input type='hidden' name='input' value='Lot'>										\
				<input type='submit' name='customer_view' value='Lots'>									\
			</form><br>															\
			<form id='purchasedform' action='process.php' method='post'>									\
				<input type='hidden' name='choice' value='Delete'>									\
				<input type='hidden' name='input' value='Purchased'>									\
				<input type='submit' name='customer_view' value='Purchases'>								\
			</form><br>															\
			<form id='stored_inform' action='process.php' method='post'>									\
				<input type='hidden' name='choice' value='Delete'>									\
				<input type='hidden' name='input' value='Stored In'>									\
				<input type='submit' name='customer_view' value='Stored_In'>								\
			</form><br>															\
			<form id='works_inform' action='process.php' method='post'>									\
				<input type='hidden' name='choice' value='Delete'>									\
				<input type='hidden' name='input' value='Works In'>									\
				<input type='submit' name='customer_view' value='Works_In'>								\
			</form><br>"
		resultstable.innerHTML = ""
	}
}

function OnChange_Insert(data){
	input_form_str = data
	if(data==''){
		input_form.innerHTML = ""
	}else if(data=='Customer'){
		input_form.innerHTML = "<br><br><br>							\
			<form id='customerform' action='process.php' method='post'>			\
				<input type='hidden' name='choice' value='" + input_choice_str + "'>	\
				<input type='hidden' name='input' value='" + input_form_str + "'>	\
				Full Name:<br><input type='text' name='cname'><br><br>			\
				SSN<font color='red'>*</font>:<br><input type='text' name='ssn'><br><br>				\
				Address:<br><input type='text' name='address'><br><br>			\
				Phone #:<br><input type='text' name='phone'><br><br>			\
				<input name='customer' type='submit' value='Submit'>			\
			</form>"
		resultstable.innerHTML = "<center><h2>Guidelines for Inserting info into Customers table</h2></center>		\
				<font color='red'>*</font> = <font color='red'>REQUIRED</font><br>							\
				<font color='red'>WARNING: Primary Key - SSN <b>must not</b> match a valid customer ssn already \
					in the database</font><br>								\
				<h3>Full Name:</h3>										\
					Must <b>not</b> be longer than 40 characters.<br>					\
				        Must contain <b>only</b> letters and spaces.<br>					\
				        <i>Example: Abraham Lincoln</i><br>							\
				<h3>SSN<font color='red'>*</font>:</h3>											\
					Must be <b>exactly</b> 9 characters long.<br>						\
				        Must contain <b>only</b> numbers.<br>							\
				        <i>Example: 298472937</i><br>								\
				<h3>Address:</h3>										\
					Must <b>not</b> be longer than 40 characters.<br>					\
				        Must contain <b>only</b> letters, numbers and spaces.<br>				\
				        <i>Example: 1234 SW 56th Street</i><br>							\
				<h3>Phone #:</h3>										\
					Must <b>not</b> be longer than 10 characters.<br>					\
				        Must contain <b>only</b> numbers.<br>							\
				        <i>Example: 5035552857</i><br>"
	}
	else if(data=='Employee'){
                input_form.innerHTML = "<br><br><br>							\
			<form id='employeeform' action='process.php' method='post'>			\
				<input type='hidden' name='choice' value='" + input_choice_str + "'>	\
				<input type='hidden' name='input' value='" + input_form_str + "'>	\
				Full Name:<br><input type='text' name='ename'><br><br>			\
				SSN<font color='red'>*</font>:<br><input type='text' name='ssn'><br><br>				\
				Address:<br><input type='text' name='address'><br><br>			\
				Phone #:<br><input type='text' name='phone'><br><br>			\
				Salary:<br><input type='text' name='salary'><br><br>			\
				<input name='employee' type='submit' value='Submit'>			\
			</form>"
		resultstable.innerHTML = "<center><h2>Guidelines for Inserting info into Employees table</h2></center>		\
				<font color='red'>*</font> = <font color='red'>REQUIRED</font><br>							\
				<font color='red'>WARNING: Primary Key - SSN <b>must not</b> match a valid employee ssn already \
					in the database</font><br>								\
				<h3>Full Name:</h3>										\
					Must <b>not</b> be longer than 40 characters.<br>					\
				        Must contain <b>only</b> letters and spaces.<br>					\
				        <i>Example: Abraham Lincoln</i><br>							\
				<h3>SSN<font color='red'>*</font>:</h3>											\
					Must be <b>exactly</b> 9 characters long.<br>						\
				        Must contain <b>only</b> numbers.<br>							\
				        <i>Example: 298472937</i><br>								\
				<h3>Address:</h3>										\
					Must <b>not</b> be longer than 40 characters.<br>					\
				        Must contain <b>only</b> letters, numbers and spaces.<br>				\
				        <i>Example: 1234 SW 56th Street</i><br>							\
				<h3>Phone #:</h3>										\
					Must <b>not</b> be longer than 10 characters.<br>					\
				        Must contain <b>only</b> numbers.<br>							\
				        <i>Example: 5035552857</i><br>								\
				<h3>Salary:</h3>										\
					Must <b>not</b> be longer than 10 characters.<br>					\
				        Must contain <b>only</b> numbers, and nothing over $1,000,000,000.<br>			\
				        <i>Example: 40000</i><br>"
        }else if(data=='Car'){
                input_form.innerHTML = "<br><br><br>							\
			<form id='carform' action='process.php' method='post'>				\
				<input type='hidden' name='choice' value='" + input_choice_str + "'>	\
				<input type='hidden' name='input' value='" + input_form_str + "'>	\
				VIN<font color='red'>*</font>:<br><input type='text' name='vin'><br><br>				\
				Price:<br><input type='text' name='price'><br><br>			\
				Make:<br><input type='text' name='make'><br><br>			\
				Model:<br><input type='text' name='model'><br><br>			\
				Color:<br><input type='text' name='color'><br><br>			\
				<input name='car' type='submit' value='Submit'>				\
			</form>"
		resultstable.innerHTML = "<center><h2>Guidelines for Inserting info into Cars table</h2></center>		\
				<font color='red'>*</font> = <font color='red'>REQUIRED</font><br>							\
				<font color='red'>WARNING: Primary Key - VIN <b>must not</b> match a valid car VIN already in	\
					the database</font><br>									\
				<h3>VIN<font color='red'>*</font>:</h3>											\
					Must be <b>exactly</b> 17 characters long.<br>						\
				        Must contain <b>only</b> numbers and letters.<br>					\
				        <i>Example: 6G2EC57Y08L526779</i><br>							\
				<h3>Price:</h3>											\
					Must <b>not</b> be longer than 10 characters.<br>					\
				        Must contain <b>only</b> numbers, and nothing over $1,000,000,000.<br>			\
				        <i>Example: 20000</i><br>								\
				<h3>Make:</h3>											\
					Must <b>not</b> be longer than 20 characters.<br>					\
				        Must contain <b>only</b> letters and spaces.<br>					\
				        <i>Example: Toyota</i><br>								\
				<h3>Model #:</h3>										\
					Must <b>not</b> be longer than 20 characters.<br>					\
				        Must contain <b>only</b> letters and spaces.<br>					\
				        <i>Example: Supra</i><br>								\
				<h3>Color:</h3>											\
					Must <b>not</b> be longer than 10 characters.<br>					\
				        Must contain <b>only</b> letters and maybe some spaces.<br>				\
				        <i>Example: Blue</i><br>"
	}else if(data=='Lot'){
                input_form.innerHTML = "<br><br><br>							\
			<form id='lotform' action='process.php' method='post'>				\
				<input type='hidden' name='choice' value='" + input_choice_str + "'>	\
				<input type='hidden' name='input' value='" + input_form_str + "'>	\
				Lot #<font color='red'>*</font>:<br><input type='text' name='lot_num'><br><br>			\
				Capacity:<br><input type='text' name='capacity'><br><br>		\
				<input name='lot' type='submit' value='Submit'>				\
			</form>"
		resultstable.innerHTML = "<center><h2>Guidelines for Inserting info into Lots table</h2></center>		\
				<font color='red'>*</font> = <font color='red'>REQUIRED</font><br>							\
				<font color='red'>WARNING: Primary Key - Lot # <b>must not</b> match a valid lot # already in	\
					the database</font><br>									\
				<h3>Lot #<font color='red'>*</font>:</h3>										\
					Must <b>not</b> be longer than 3 characters.<br>					\
				        Must contain <b>only</b> numbers.<br>							\
				        <i>Example: 001</i><br>									\
				<h3>Capacity:</h3>										\
					Must <b>not</b> be longer than 10 characters.<br>					\
				        Must contain <b>only</b> numbers, and nothing over 1,000,000,000.<br>			\
				        <i>Example: 2000</i><br>"
	}else if(data=='Purchased'){
                input_form.innerHTML = "<br><br><br>							\
			<form id='purchasedform' action='process.php' method='post'>			\
				<input type='hidden' name='choice' value='" + input_choice_str + "'>	\
				<input type='hidden' name='input' value='" + input_form_str + "'>	\
				Date:<br><input type='text' name='date'><br><br>			\
				Sold For:<br><input type='text' name='sold_for'><br><br>		\
				VIN<font color='red'>*</font>:<br><input type='text' name='vin'><br><br>				\
				Customer SSN<font color='red'>*</font>:<br><input type='text' name='ssn'><br><br>			\
				<input name='purchased' type='submit' value='Submit'>			\
			</form>"
		resultstable.innerHTML = "<center><h2>Guidelines for Inserting info into Purchased table</h2></center>		\
				<font color='red'>*</font> = <font color='red'>REQUIRED</font><br>							\
				<font color='red'>WARNING: Foreign Constraint - VIN <b>must</b> match a valid car already in	\
					the database and SSN <b>must</b> match a valid customer already in the database.	\
					</font><br>										\
				<h3>Date:</h3>											\
					Must be <b>exactly</b> 8 characters long.<br>						\
				        Must contain <b>only</b> numbers.<br>							\
				        <i>Example: 01012012 - ie mmddyyyy</i><br>						\
				<h3>Sold For:</h3>										\
					Must <b>not</b> be longer than 10 characters.<br>					\
				        Must contain <b>only</b> numbers, and nothing over $1,000,000,000.<br>			\
				        <i>Example: 20000</i><br>								\
				<h3>VIN<font color='red'>*</font>:</h3>											\
					Must be <b>exactly</b> 17 characters long.<br>						\
				        Must contain <b>only</b> numbers and letters.<br>					\
				        <i>Example: 6G2EC57Y08L526779</i><br>							\
				<h3>SSN<font color='red'>*</font>:</h3>											\
					Must be <b>exactly</b> 9 characters long.<br>						\
				        Must contain <b>only</b> numbers.<br>							\
				        <i>Example: 298472937</i><br>"
        }else if(data=='Stored In'){
                input_form.innerHTML = "<br><br><br>							\
			<form id='stored_inform' action='process.php' method='post'>			\
				<input type='hidden' name='choice' value='" + input_choice_str + "'>	\
				<input type='hidden' name='input' value='" + input_form_str + "'>	\
				VIN<font color='red'>*</font>:<br><input type='text' name='vin'><br><br>				\
				Lot #<font color='red'>*</font>:<br><input type='text' name='lot_num'><br><br>			\
				Date Since:<br><input type='text' name='since'><br><br>			\
				Date Until:<br><input type='text' name='until'><br><br>			\
				<input name='stored_in' type='submit' value='Submit'>			\
			</form>"
		resultstable.innerHTML = "<center><h2>Guidelines for Inserting info into Stored In table</h2></center>		\
				<font color='red'>*</font> = <font color='red'>REQUIRED</font><br>							\
				<font color='red'>WARNING: Foreign Constraint - VIN <b>must</b> match a valid car already in	\
					the database and Lot # <b>must</b> match a valid lot already in the database.		\
					</font><br>										\
				<h3>VIN<font color='red'>*</font>:</h3>											\
					Must be <b>exactly</b> 17 characters long.<br>						\
				        Must contain <b>only</b> numbers and letters.<br>					\
				        <i>Example: 6G2EC57Y08L526779</i><br>							\
				<h3>Lot #<font color='red'>*</font>:</h3>										\
					Must <b>not</b> be longer than 3 characters.<br>					\
				        Must contain <b>only</b> numbers.<br>							\
				        <i>Example: 001</i><br>									\
				<h3>Date Since:</h3>										\
					Must be <b>exactly</b> 8 characters long.<br>						\
				        Must contain <b>only</b> numbers.<br>							\
				        Date Since <b>must</b> come before Date Until<br>					\
				        <i>Example: 01012012 - ie mmddyyyy</i><br>						\
				<h3>Date Until:</h3>										\
					Must be <b>exactly</b> 8 characters long.<br>						\
				        Must contain <b>only</b> numbers.<br>							\
				        Date Until <b>must</b> come after Date Since<br>					\
				        <i>Example: 01012012 - ie mmddyyyy</i><br>"
        }else if(data=='Works In'){
                input_form.innerHTML = "<br><br><br>							\
			<form id='works_inform' action='process.php' method='post'>			\
				<input type='hidden' name='choice' value='" + input_choice_str + "'>	\
				<input type='hidden' name='input' value='" + input_form_str + "'>	\
				Lot #<font color='red'>*</font>:<br><input type='text' name='lot_num'><br><br>			\
				Employee SSN<font color='red'>*</font>:<br><input type='text' name='ssn'><br><br>			\
				Date Since:<br><input type='text' name='since'><br><br>			\
				<input name='works_in' type='submit' value='Submit'>			\
			</form>"
		resultstable.innerHTML = "<center><h2>Guidelines for Inserting info into Works In table</h2></center>		\
				<font color='red'>*</font> = <font color='red'>REQUIRED</font><br>							\
				<font color='red'>WARNING: Foreign Constraint - VIN <b>must</b> match a valid car already in	\
					the database and Lot # <b>must</b> match a valid lot already in the database.		\
					</font><br>										\
				<h3>Lot #<font color='red'>*</font>:</h3>										\
					Must <b>not</b> be longer than 3 characters.<br>					\
				        Must contain <b>only</b> numbers.<br>							\
				        <i>Example: 001</i><br>									\
				<h3>SSN<font color='red'>*</font>:</h3>											\
					Must be <b>exactly</b> 9 characters long.<br>						\
				        Must contain <b>only</b> numbers.<br>							\
				        <i>Example: 298472937</i><br>								\
				<h3>Date Since:</h3>										\
					Must be <b>exactly</b> 8 characters long.<br>						\
				        Must contain <b>only</b> numbers.<br>							\
				        <i>Example: 01012012 - ie mmddyyyy</i><br>"
        }
}

function OnChange_Delete(data){
	input_form_str = data
	if(data==''){
		input_form.innerHTML = ""
	}else if(data=='Customer'){
		input_form.innerHTML = "<br><br><br>										\
			<form id='customerform' action='process.php' method='post'>						\
				<input type='hidden' name='choice' value='" + input_choice_str + "'>				\
				<input type='hidden' name='input' value='" + input_form_str + "'>				\
				SSN<font color='red'>*</font>:<br><input type='text' name='ssn'><br><br>			\
				<input name='customer' type='submit' value='Submit'>						\
			</form>"
		resultstable.innerHTML = "<center><h2>Guidelines for Deleting info from Customers table</h2></center>	\
				<font color='red'>*</font> = <font color='red'>REQUIRED</font><br>				\
				<font color='red'>WARNING: Primary Key - SSN <b>must not</b> match a valid customer ssn already \
					in the database</font><br>								\
				<h3>SSN<font color='red'>*</font>:</h3>								\
					Must be <b>exactly</b> 9 characters long.<br>						\
				        Must contain <b>only</b> numbers.<br>							\
				        <i>Example: 298472937</i><br>"
	}
	else if(data=='Employee'){
                input_form.innerHTML = "<br><br><br>										\
			<form id='employeeform' action='process.php' method='post'>						\
				<input type='hidden' name='choice' value='" + input_choice_str + "'>				\
				<input type='hidden' name='input' value='" + input_form_str + "'>				\
				SSN<font color='red'>*</font>:<br><input type='text' name='ssn'><br><br>			\
				<input name='employee' type='submit' value='Submit'>						\
			</form>"
		resultstable.innerHTML = "<center><h2>Guidelines for Deleting info from Employees table</h2></center>	\
				<font color='red'>*</font> = <font color='red'>REQUIRED</font><br>				\
				<font color='red'>WARNING: Primary Key - SSN <b>must not</b> match a valid employee ssn already \
					in the database</font><br>								\
				<h3>SSN<font color='red'>*</font>:</h3>								\
					Must be <b>exactly</b> 9 characters long.<br>						\
				        Must contain <b>only</b> numbers.<br>							\
				        <i>Example: 298472937</i><br>"
        }else if(data=='Car'){
                input_form.innerHTML = "<br><br><br>										\
			<form id='carform' action='process.php' method='post'>							\
				<input type='hidden' name='choice' value='" + input_choice_str + "'>				\
				<input type='hidden' name='input' value='" + input_form_str + "'>				\
				VIN<font color='red'>*</font>:<br><input type='text' name='vin'><br><br>			\
				<input name='car' type='submit' value='Submit'>							\
			</form>"
		resultstable.innerHTML = "<center><h2>Guidelines for Deleting info from Cars table</h2></center>		\
				<font color='red'>*</font> = <font color='red'>REQUIRED</font><br>				\
				<font color='red'>WARNING: Primary Key - VIN <b>must not</b> match a valid car VIN already in	\
					the database</font><br>									\
				<h3>VIN<font color='red'>*</font>:</h3>								\
					Must be <b>exactly</b> 17 characters long.<br>						\
				        Must contain <b>only</b> numbers and letters.<br>					\
				        <i>Example: 6G2EC57Y08L526779</i><br>"
	}else if(data=='Lot'){
                input_form.innerHTML = "<br><br><br>										\
			<form id='lotform' action='process.php' method='post'>							\
				<input type='hidden' name='choice' value='" + input_choice_str + "'>				\
				<input type='hidden' name='input' value='" + input_form_str + "'>				\
				Lot #:<br><input type='text' name='lot_num'><br><br>						\
				<input name='lot' type='submit' value='Submit'>							\
			</form>"
		resultstable.innerHTML = "<center><h2>Guidelines for Deleting info from Lots table</h2></center>		\
				<font color='red'>*</font> = <font color='red'>REQUIRED</font><br>				\
				<font color='red'>WARNING: Primary Key - Lot # <b>must not</b> match a valid lot # already in	\
					the database</font><br>									\
				<h3>Lot #<font color='red'>*</font>:</h3>							\
					Must <b>not</b> be longer than 3 characters.<br>					\
				        Must contain <b>only</b> numbers.<br>							\
				        <i>Example: 001</i><br>"
	}else if(data=='Purchased'){
                input_form.innerHTML = "<br><br><br>										\
			<form id='purchasedform' action='process.php' method='post'>						\
				<input type='hidden' name='choice' value='" + input_choice_str + "'>				\
				<input type='hidden' name='input' value='" + input_form_str + "'>				\
				VIN<font color='red'>*</font>:<br><input type='text' name='vin'><br><br>			\
				Customer SSN<font color='red'>*</font>:<br><input type='text' name='ssn'><br><br>		\
				<input name='purchased' type='submit' value='Submit'>						\
			</form>"
		resultstable.innerHTML = "<center><h2>Guidelines for Deleting info from Purchased table</h2></center>	\
				<font color='red'>*</font> = <font color='red'>REQUIRED</font><br>				\
				<font color='red'>WARNING: Foreign Constraint - VIN <b>must</b> match a valid car already in	\
					the database and SSN <b>must</b> match a valid customer already in the database.	\
					</font><br>										\
				<h3>VIN<font color='red'>*</font>:</h3>								\
					Must be <b>exactly</b> 17 characters long.<br>						\
				        Must contain <b>only</b> numbers and letters.<br>					\
				        <i>Example: 6G2EC57Y08L526779</i><br>							\
				<h3>SSN<font color='red'>*</font>:</h3>								\
					Must be <b>exactly</b> 9 characters long.<br>						\
				        Must contain <b>only</b> numbers.<br>							\
				        <i>Example: 298472937</i><br>"
        }else if(data=='Stored In'){
                input_form.innerHTML = "<br><br><br>										\
			<form id='stored_inform' action='process.php' method='post'>						\
				<input type='hidden' name='choice' value='" + input_choice_str + "'>				\
				<input type='hidden' name='input' value='" + input_form_str + "'>				\
				VIN<font color='red'>*</font>:<br><input type='text' name='vin'><br><br>			\
				Lot #<font color='red'>*</font>:<br><input type='text' name='lot_num'><br><br>			\
				<input name='stored_in' type='submit' value='Submit'>						\
			</form>"
		resultstable.innerHTML = "<center><h2>Guidelines for Deleting info from Stored In table</h2></center>	\
				<font color='red'>*</font> = <font color='red'>REQUIRED</font><br>				\
				<font color='red'>WARNING: Foreign Constraint - VIN <b>must</b> match a valid car already in	\
					the database and Lot # <b>must</b> match a valid lot already in the database.		\
					</font><br>										\
				<h3>VIN<font color='red'>*</font>:</h3>								\
					Must be <b>exactly</b> 17 characters long.<br>						\
				        Must contain <b>only</b> numbers and letters.<br>					\
				        <i>Example: 6G2EC57Y08L526779</i><br>							\
				<h3>Lot #<font color='red'>*</font>:</h3>							\
					Must <b>not</b> be longer than 3 characters.<br>					\
				        Must contain <b>only</b> numbers.<br>							\
				        <i>Example: 001</i><br>"
        }else if(data=='Works In'){
                input_form.innerHTML = "<br><br><br>										\
			<form id='works_inform' action='process.php' method='post'>						\
				<input type='hidden' name='choice' value='" + input_choice_str + "'>				\
				<input type='hidden' name='input' value='" + input_form_str + "'>				\
				Lot #<font color='red'>*</font>:<br><input type='text' name='lot_num'><br><br>			\
				Employee SSN<font color='red'>*</font>:<br><input type='text' name='ssn'><br><br>		\
				<input name='works_in' type='submit' value='Submit'>						\
			</form>"
		resultstable.innerHTML = "<center><h2>Guidelines for Deleting info from Works In table</h2></center>		\
				<font color='red'>*</font> = <font color='red'>REQUIRED</font><br>				\
				<font color='red'>WARNING: Foreign Constraint - VIN <b>must</b> match a valid car already in	\
					the database and Lot # <b>must</b> match a valid lot already in the database.		\
					</font><br>										\
				<h3>Lot #<font color='red'>*</font>:</h3>							\
					Must <b>not</b> be longer than 3 characters.<br>					\
				        Must contain <b>only</b> numbers.<br>							\
				        <i>Example: 001</i><br>									\
				<h3>SSN<font color='red'>*</font>:</h3>								\
					Must be <b>exactly</b> 9 characters long.<br>						\
				        Must contain <b>only</b> numbers.<br>							\
				        <i>Example: 298472937</i><br>"
        }
}


function updateResult(data){
	resultstable.innerHTML = data;
}

function updateInfo(data){
	infotable.innerHTML = data;
}

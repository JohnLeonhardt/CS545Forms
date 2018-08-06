<?php

function validate_data($params) {
    $msg = "";
    if(strlen($params[0]) == 0)
        $msg .= "Please enter the first name<br />";
	elseif(is_numeric($params[0]))
		$msg .= "Please enter only alphabetical letters<br />";
	if(strlen($params[1]) == 0)
        $msg .= "Please enter the last name<br />";
	elseif(is_numeric($params[1]))
		$msg .= "Please enter only alphabetical letters<br />";	
    if(strlen($params[2]) == 0)
        $msg .= "Please enter the address<br />"; 
    if(strlen($params[3]) == 0)
        $msg .= "Please enter the city<br />";
	elseif(is_numeric($params[3]))
		$msg .= "Please enter only alphabetical letters<br />";
    if(strlen($params[4]) == 0)
        $msg .= "Please enter the state<br />"; 
	if(strlen((string)$params[4]) != 2)
		$msg .= "Please enter the 2-letter state abbreviation<br />";
	elseif(is_numeric($params[4]))
		$msg .= "Please enter only alphabetical letters<br />";
    if(strlen($params[5]) == 0)
        $msg .= "Please enter the zip code<br />";
    elseif(!is_numeric($params[5])) 
        $msg .= "Zip code may contain only numeric digits<br />";
    if(strlen($params[6]) == 0)
        $msg .= "Please enter email<br />";
    elseif(!filter_var($params[6], FILTER_VALIDATE_EMAIL))
        $msg .= "Your email appears to be invalid<br/>";
	if(strlen($params[7]) == 0)
        $msg .= "Please enter image name<br />";
	elseif(is_numeric($params[7]))
		$msg .= "Please enter only alphabetical letters<br />";
	if(strlen($params[8]) == 0)
        $msg .= "Please enter area code<br />";
	elseif(!is_numeric($params[8])) 
        $msg .= "Area code may contain only numeric digits<br />";
	if(strlen($params[9]) == 0)
        $msg .= "Please enter prefix phone code<br />";
	elseif(!is_numeric($params[9])) 
        $msg .= "Prefix phone code may contain only numeric digits<br />";
	if(strlen($params[10]) == 0)
        $msg .= "Please enter 4-digit phone code<br />";
	elseif(!is_numeric($params[10])) 
        $msg .= "4-digit phone code may contain only numeric digits<br />";
	if(strlen($params[11]) == 0)
        $msg .= "Please enter date of birth<br />";
	if(!preg_match("/(\d{2})\/(\d{2})\/(\d{2})$/",$params[11],$matches))
		$msg .= "Date of birth in incorrect format<br />";
	elseif(!checkdate($matches[2],$matches[1],$matches[3]))
        $msg .= "Date of Birth invalid date<br />";
    if($msg) {
        write_form_error_page($msg);
        exit;
        }
    }
  
function write_form_error_page($msg) {
    write_header();
    echo "<h2>Sorry, an error occurred<br />",
    $msg,"</h2>";
    write_form();
    write_footer();
    }  
    
function write_form() {
    print <<<ENDBLOCK
	<fieldset>
		<legend>Personal Information</legend>
		<form name="customer"
			  action="process_request.php"
			  method="post"
			  enctype="multipart/form-data">
	
		<label>First name:</label>
		<input type="text" name="first_name" value="$_POST[first_name]" size="25" id="first_name" /><br />
		<label>Middle Name:</label>
		<input type="text" name="middle_name" size="25" id="middle_column" /><i>optional</i><br />
		<label>Last name:</label>
		<input type="text" name="last_name" value="$_POST[last_name]" size="25" id="last_name" /><br />
		<label>Address:</label>
		<input type="text" name="address" value="$_POST[address]" size="40" id="address" /><br />
		<label>City:</label>
		<input type="text" name="city" value="$_POST[city]" size="25" id="city" /><br />
		<label>State:</label>
		<input type="text" name="state" value="$_POST[state]" size="3" id="state" /><br />
		<label>Zipcode:</label>
		<input type="text" name="zipcode" value="$_POST[zipcode]" size="10" maxlength="10" id="zipcode" /><br />
		<label>Phone:</label>
		(<input type="text" name="area_phone" value="$_POST[area_phone]" size="4" maxlength="3" />)
		<input type="text" name="prefix_phone" value="$_POST[prefix_phone]" size="4" maxlength="3" />
		<input type="text" name="phone" value="$_POST[phone]" size="5" maxlength="4" /><br />
		<label>Email Address:</label>
		<input type="email" name="email_address" value="$_POST[email_address]" size="25" placeholder="user@domain.com" 
		id="email_address" /><br />
		<label>Date of Birth</label>
		<input type="text" name="date_of_birth" value="$_POST[date_of_birth]" placeholder="dd/mm/yy" /><br />
		<label>Medical Conditions</label>
		<input type="text" name="medical_conditions" value="$_POST[medical_conditions]" /><br />
		<hr />
		<label>Gender</label>
		<label>Experience</label>
		<label>Category</label>
ENDBLOCK;

/* you must stop the here document to insert decision logic */
/* if a gender is selected, then send the form with the gender selected */
            $gender_choice = array("Male","Female");
            foreach($gender_choice as $item) {
                echo "<input type='radio' name='gender'  value='$item'";
                if($item == $_POST[gender])
                    echo " checked='checked'";
                echo " />$item";
                }            
            echo "<br />";
			
	/* do the experience choices */    
            $experience_choice = array("Novice","Experienced","Expert");
            foreach($experience_choice as $item) {
                echo "<input type='radio' name='experience'  value='$item'";
                if($item == $_POST[experience])
                    echo " checked='checked'";
                echo " />$item";
                }            
           echo "<br />";
	
		/* do the category choices */    
            $category_choice = array("Teen","Adult","Senior");
            foreach($category_choice as $item) {
                echo "<input type='radio' name='category'  value='$item'";
                if($item == $_POST[category])
                    echo " checked='checked'";
                echo " />$item";
                }            
           echo "<br />";

	print <<<ENDBLOCK
		<label>File Upload</label>
		<br />
		<table>
			<tr>
				<td>Image Name:</td>
				<td><input type="text" name="name" value="$_POST[name]" size="34" /></td>
			</tr>
			<tr>
				<td>Description</td>
				<td><textarea rows="5" cols="30" name="description"></textarea></td>
			</tr>
			<tr>
				<td>File:</td>
				<td><input type="file" id="picture" name="picture" /></td>
			</tr>
		</table>
		<div id="message_line">&nbsp;</div>
		<div id="button_panel">
			<input type="submit" value="Send Data" class="button" />
			<input type="reset" value="Clear Data" class="button" />
		</div>
		</form>
		<h3 id="status"> &nbsp;</h3>
		<div id="pic"></div>
		<h3 id="answer"></h3>
		</fieldset>
ENDBLOCK;
}                        

function process_parameters($params) {
    global $bad_chars;
    $params = array();
    $params[] = trim(str_replace($bad_chars, "",$_POST['first_name']));
	$params[] = trim(str_replace($bad_chars, "",$_POST['last_name']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['address']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['city']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['state']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['zipcode']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['email_address']));
	$params[] = trim(str_replace($bad_chars, "",$_POST['name']));
	$params[] = trim(str_replace($bad_chars, "",$_POST['area_phone']));
	$params[] = trim(str_replace($bad_chars, "",$_POST['prefix_phone']));
	$params[] = trim(str_replace($bad_chars, "",$_POST['phone']));
	$params[] = trim(str_replace($bad_chars, "",$_POST['date_of_birth']));
    return $params;
    }
    
function store_data_in_db($params) {
    # get a database connection
    $db = get_db_handle();  ## method in helpers.php
    ##############################################################
    $sql = "SELECT * FROM person WHERE ".
	"imgname = '$params[7]' AND ".
    "fname = '$params[0]' AND ".
	"lname = '$params[1]' AND ".
    "address = '$params[2]' AND ".
    "city = '$params[3]' AND ".
    "state = '$params[4]' AND ".
    "zip = '$params[5]' AND ".
	"area = '$params[8]' AND ".
	"prefix = '$params[9]' AND ".
	"phone = '$params[10]' AND ".
	"dob = '$params[11]' AND ".
    "email = '$params[6]';";
##echo "The SQL statement is ",$sql;    
    $result = mysqli_query($db, $sql);
    if(mysqli_num_rows($result) > 0) {
        write_form_error_page('This record appears to be a duplicate');
        exit;
        }
##OK, duplicate check passed, now insert
    $sql = "INSERT INTO person(imgname,fname,lname,address,city,state,zip,area,prefix,phone,dob,email) ".
    "VALUES('$params[7]','$params[0]','$params[1]','$params[2]','$params[3]','$params[4]','$params[5]','$params[8]','$params[9]','$params[10]','$params[11]','$params[6]');";
##echo "The SQL statement is ",$sql;    
    mysqli_query($db,$sql);
    $how_many = mysqli_affected_rows($db);
    echo("There were $how_many rows affected");
    close_connector($db);
    }
        
?>   
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;
	charset=iso-8859-1" />
	<title>Confirmation Page</title>
<link rel="stylesheet" type="text/css" href="confirm.css" />
	
</head>

<body>
<?php
echo <<<ENDBLOCK
    <h1>$params[0] $params[1], thank you for registering.</h1>
    <table>
		<tr>
            <td>Image Name</td>
            <td>$params[7]</td>
        </tr>
        <tr>
            <td>Address</td>
            <td>$params[2]</td>
        </tr>
        <tr>
            <td>City</td>
            <td>$params[3]</td>
        </tr>
        <tr>
            <td>State</td>
            <td>$params[4]</td>
        </tr>
        <tr>
            <td>Zip Code</td>
            <td>$params[5]</td>
        </tr>
		<tr>
            <td>Date of Birth</td>
            <td>$params[11]</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>$params[6]</td>
        </tr>
		<tr>
            <td>Area</td>
            <td>$params[8]</td>
        </tr>
		<tr>
            <td>Prefix</td>
            <td>$params[9]</td>
        </tr>
		<tr>
            <td>Phone</td>
            <td>$params[10]</td>
        </tr>           
    </table>
ENDBLOCK;


echo "<p>The raw query string that came from the browser is ",
    file_get_contents("php://input"),"</p>";

?>
</body></html>
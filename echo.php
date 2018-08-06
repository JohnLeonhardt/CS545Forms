<?php
$answer = "The information on this request is: <br />";
foreach($_GET as $key => $value) {
	$answer .= "$key  &nbsp;&nbsp; $value";
	$answer .= "<br />\n"; 
	}
echo $answer;        
?>
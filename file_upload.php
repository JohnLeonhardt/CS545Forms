<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Uploading Files using PHP</title>

	<meta http-equiv="content-type" 
		content="text/html;charset=utf-8" />

    <link rel="stylesheet" type="text/css" href="confirm.css" />
</head>

<body>
<!--

IMPORTANT, IMPORTANT:  You must set permissions to 775 for the destination folder
for uploaded images.  However, you must not--under any circumstances--set 775 or 777 
permissions on any other folders, nor can your upload directory be visible, ever.

NOTE:  This example works correctly but is incomplete.

$_FILES array elements:

    $_FILES["file"]["name"] - the name of the uploaded file
    $_FILES["file"]["type"] - the type of the uploaded file
    $_FILES["file"]["size"] - the size in bytes of the uploaded file
    $_FILES["file"]["tmp_name"] - the name of the temporary copy of the file stored on the server
    $_FILES["file"]["error"] - the error code resulting from the file upload
    
    
 UPLOAD_ERR_OK         Value: 0; There is no error, the file uploaded with success.
 UPLOAD_ERR_INI_SIZE   Value: 1; The uploaded file exceeds the upload_max_filesize directive in php.ini.
                                 This value is set on jadran to 2MB.
 UPLOAD_ERR_FORM_SIZE  Value: 2; The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.
 UPLOAD_ERR_PARTIAL    Value: 3; The uploaded file was only partially uploaded.
 UPLOAD_ERR_NO_FILE    Value: 4; No file was uploaded.
 UPLOAD_ERR_NO_TMP_DIR Value: 6; Missing a temporary folder. Introduced in PHP 4.3.10 and PHP 5.0.3.
 UPLOAD_ERR_CANT_WRITE Value: 7; Failed to write file to disk. Introduced in PHP 5.1.0.
 UPLOAD_ERR_EXTENSION  Value: 8; File upload stopped by extension. Introduced in PHP 5.2.0.
 
 exif_imagetype constants: IMAGETYPE_JPEG, IMAGETYPE_GIF, IMAGETYPE_PNG, IMAGETYPE_BMP    
-->

<?php
    $UPLOAD_DIR = 'emblem/';
    $COMPUTER_DIR = '/home/jadrn026/public_html/proj3/emblem/';
    $fname = $_FILES['picture']['name'];
    

    if(file_exists("$UPLOAD_DIR".$fname))  {
        echo "<b>Error, the file $fname already exists on the server</b><br />\n";
        }
    elseif($_FILES['picture']['error'] > 0) {
    	$err = $_FILES['picture']['error'];	
        echo "Error Code: $err ";
	if($err == 1)
		echo "The file was too big to upload, the limit is 2MB<br />";
        } 
    elseif(exif_imagetype($_FILES['picture']['tmp_name']) != IMAGETYPE_JPEG) {
        echo "ERROR, not a jpg file<br />";   
        }
## file is valid, copy from /tmp to your directory.        
    else { 
        move_uploaded_file($_FILES['picture']['tmp_name'], "$UPLOAD_DIR".$fname);
        echo "Success!</br >\n";
        echo "The filename is: ".$fname."<br />";
        echo "The type is: ".$_FILES['picture']['type']."<br />";
        echo "The size is: ".$_FILES['picture']['size']."<br />";
        echo "The tmp filename is: ".$_FILES['picture']['tmp_name']."<br />";  
        echo "The basename is: ".basename($fname)."<br />";  
    } 
    
    foreach($_POST as $key => $val) {
        echo "Parameter: <b>$key</b> and value: <b>$val</b><br />\n";     
        }
        
?>  
    <h2>The Catalog of Uploaded Images:</h2> 
    
<?php
    $d = dir($COMPUTER_DIR.'/');
    while($fname = $d->read()) {
        $data[$fname] = $fname;
        }
    foreach($data as $fname => $fvalue) {
        if($fname == "." || $fname == "..") {
            ;
            }
        else {
            echo "<img src=\"$UPLOAD_DIR/$fname\""." width='200px' />\n";
        }
    }
    ?>
        

</body>
</html>     
    
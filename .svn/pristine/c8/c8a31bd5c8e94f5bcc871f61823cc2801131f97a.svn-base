<?php
$m = mysql_connect('localhost', 'root', 'l[kpfu');
$db = 'pcd';
mysql_select_db($db) or die("Import Error - Couldn't select database: " . mysql_error());

$filename = 'D:/1WWW/htdocs/pcd/excel/mass 1.10 to 31.10.csv';

if (is_readable($filename)) {

echo 'The file is readable<br />';

} else {

echo 'The file is not readable<br />';

}

$query = "LOAD DATA LOCAL INFILE '$filename' INTO TABLE barcodechk FIELDS TERMINATED BY ','";
//$query = "LOAD DATA LOCAL INFILE '$filename' INTO TABLE barcodechk FIELDS TERMINATED BY ',' ";

$result = mysql_query($query) or die('Query failed: ' . mysql_error()); 



?>
<html>
<head>
<title>ThaiCreate.Com PHP & CSV To MySQL</title>
</head>
<body>
<?

$objConnect = mysql_connect("localhost","root","l[kpfu") or die("Error Connect to Database"); // Conect to MySQL
$objDB = mysql_select_db("pcd");
$filename = 'D:/1WWW/htdocs/pcd/excel/mass 1.10 to 31.10.csv';
$objCSV = fopen("$filename", "r");
while (($objArr = fgetcsv($objCSV, 1000, ",")) !== FALSE) {
$strSQL = "INSERT INTO customer ";
$strSQL .="(Plant_CODE,VENDOR_CODE,DEL_NO,DEL_DATE,PERIOD,FIRM_CODE) ";
$strSQL .="VALUES ";
$strSQL .="('".$objArr[0]."','".$objArr[1]."','".$objArr[2]."' ";
$strSQL .=",'".$objArr[3]."','".$objArr[4]."','".$objArr[5]."') ";
$objQuery = mysql_query($strSQL);
}
fclose($objCSV);

echo "Import Done.";
?>
</table>
</body>
</html>
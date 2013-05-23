<html>
<head>
<title>ThaiCreate.Com PHP & CSV To MySQL</title>
</head>
<body>
<?
	copy($_FILES["fileCSV"]["tmp_name"], $_FILES["fileCSV"]["name"]); // Copy/Upload CSV

	$objConnect = mysql_connect("localhost", "root", "l[kpfu") or die("Error Connect to Database"); // Conect to MySQL
	$objDB = mysql_select_db("pcd");

	$objCSV = fopen("mass 1.10 to 31.10.csv", "r");
	while (($objArr = fgetcsv($objCSV, 1000, ",")) !== FALSE) {
		$strSQL = "INSERT INTO barcodechk ";
		$strSQL .= "(PLANT_CODE,VENDOR_CODE,DEL_NO,DEL_DATE,PERIOD,FIRM_CODE,WORK_GROUP,PART_NO,PART_NAME_ENG,PRIVILEGE_FLAG,PO_QTY,FOLLOWING_PROC,RECEIVE_AREA,RECEIVEDQTY,CONT_PRI_NO) ";
		$strSQL .= "VALUES ";
		$strSQL .= "('" . $objArr[0] . "','" . $objArr[1] . "','" . $objArr[2] . "' ";
		$strSQL .= ",'" . $objArr[3] . "','" . $objArr[4] . "','" . $objArr[5] . "' ";
		$strSQL .= ",'" . $objArr[6] . "','" . $objArr[7] . "','" . $objArr[8] . "' ";
		$strSQL .= ",'" . $objArr[9] . "','" . $objArr[10] . "','" . $objArr[11] . "' ";
		$strSQL .= ",'" . $objArr[12] . "','" . $objArr[13] . "','" . $objArr[14] . "') ";
		$objQuery = mysql_query($strSQL);
	}
	fclose($objCSV);

	echo "Upload & Import Done.<br>";
?>
</table>
</body>
</html>


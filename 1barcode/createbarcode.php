<?php
	//มดเป็นคนสร้างครับ
	require("../1barcode.inc.php");
	/*
	 * $encode='CODE39'; 
	 * Barcode มีมาตรฐานในกการเข้าระหรัสแตกต่างกันออกไป  มีการเข้าระหัสดังนี้
	 * UPC-A
	 * EAN-13
	 * EAN-8
	 * UPC-E
	 * S205
	 * I2O5
	 * I25
	 * POSTNET
	 * CODABAR
	 * CODE128
	 * CODE39
	 * CODE93
	 */
	$encode='CODE39'; 
	
	$barnumber="A1M2009999";  //ข้อมูลที่ต้องการแปรงเป็น Barcode
	$height = "50";	//ความสูง ของ Barcode
	$scale = "1";  //ขนาดของ Barcode
	$color = "#333366";	// สีของ แทง Barcode
	$bgcolor = "#FFFFEC";  //สี background ของ Barcode
    $type = "png";  //นามสกุล สามารถเปลี่ยน นามสกุลได้ png,gif,jpg แต่ png ขนาดfile เล็กสุด
	
	$bar= new BARCODE();
	
	if($bar==false)
		die($bar->error());
	// OR $bar= new BARCODE("I2O5");


	$bar->setSymblogy($encode);
	$bar->setHeight($height);
	$bar->setScale($scale);
	$bar->setHexColor($color, $bgcolor);
	$return = $bar->genBarCode($barnumber,$type,$barnumber);

	if($return==false)
		$bar->error(true);
	
?>
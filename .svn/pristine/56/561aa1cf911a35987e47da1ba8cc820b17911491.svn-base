<?php
require_once 'Excel/reader.php';
error_reporting(E_ALL ^ E_NOTICE);

$handle = fopen("out.csv", "w+");

$split_stamp1 = strtotime('1991-01-02');
$split_stamp2 = strtotime('2003-04-24');

function stockSplit(&$item, $multi){
	foreach(array(2,3,4,5,6,7,9) as $field){
		if(is_numeric($item[$field] + 0))
			$item[$field] /= $multi;
	}
	if(is_numeric($item[10]))
		$item[10] *= $multi;
}

for($year = 1975; $year < 2009; $year++){
	$data = new Spreadsheet_Excel_Reader();
	$data->setOutputEncoding('ASCII');
	$data->read("SCC/$year.xls");
	$items = $data->sheets[0]['cells'];
	foreach($items as $item){
		if(preg_match('/^\d\d\/\d\d\/\d\d\d\d$/', $item[1]) && $item[10] != '-'){
			$arr         = explode('/', $item[1]);
			$stamp         = mktime(0, 0, 0, $arr[1], $arr[0], $arr[2]) - 86400;
			if($stamp < $split_stamp1)
				stockSplit($item, 100);
			else if($stamp < $split_stamp2 && $stamp > $split_stamp1)
				stockSplit($item, 10);
			$item[1]     = date('Y-m-d', $stamp);
			fwrite($handle, implode(',', $item)."\n");
		}
	}
}
fclose($handle);
?>
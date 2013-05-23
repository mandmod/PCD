<?php 
//if($_SESSION['logged_in'] != 1) header("Location: index.php");
//echo $_SESSION['logged_in'];
include 'condb.php';
include 'utility.php';
include 'barcode.inc.php';

?>

<html>
 <head>
  <title> ---= Barcode Check List =--- </title>
  <meta name="Generator" content="EditPlus">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 </head>

 <body >
<center><h1>Barcode Number Check</h1></center>

<center>
  <table border="1" cellspacing="0" cellpadding="0" >
  <tr>
	<td>Plant.</td>
	<td>Code</td>
	<td>Due Date</td>
	<td>Period</td>
	<td>Part No</td>
	<td>Part Name</td>
	<td>QTY</td>
	<td>R/A</td>
	<td>FLOW</td>
	<td>Purchase Order Number</td>
  </tr>
  <?php 
  //if (isset($_GET['searh'])){
   if ($_GET['action']==''){
  ?>
 					 	<tr>
                            <td colspan="10" class="center"><center><h1>กรุณากรอกวันที่เพื่อค้นหา</h1></center></td>  
                        </tr>
<?php 
		break;
   }elseif ($_GET['action']=='searh'){
  	//$sql='select * from member order by mem_id';
  	//$sql="SELECT PLANT_CODE,FIRM_CODE,DEL_DATE,PERIOD,PART_NO,PART_NAME_ENG,PO_QTY,RECEIVE_AREA,FOLLOWING_PROC,DEL_NO FROM barcodechk WHERE1";
    $sql = "select * from barcodechk where DEL_DATE = '$_POST[searhs]'";
  	
	$rs=mysql_query($sql);
	$cnt = mysql_num_rows($rs);
	$i=0;
  	while ($i<$cnt){
  				$arr=mysql_fetch_array($rs);
		//echo $arr['mem_name'].' ' .$arr['mem_sname'];
		//echo '<hr>';
  		$i++;
  		
  		//---------------------------------- คำสั่งสร้าง Barcode-----------------------------------------//
  		$encode='CODE39'; 
	
	$barnumber=$arr['DEL_NO'];  //ข้อมูลที่ต้องการแปรงเป็น Barcode
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
//----------------------------------จบ คำสั่งสร้าง Barcode-----------------------------------------//
  ?>

  <tr bgcolor="<?php //if ($arr['mem_id']==$_GET['id'] and $_GET['action'] = 'edit'){echo 'bgcolor=#ccff99'; }?>">
	<td><center><?php echo $arr['PLANT_CODE'];?></center></td>
	<td><center><?php echo $arr['FIRM_CODE'];?></center></td>
	<td><center><?php echo $arr['DEL_DATE'];?></center></td>
	<td><center><?php echo $arr['PERIOD'];?></center></td>
	<td><center><?php echo $arr['PART_NO'];?></center></td>
	<td><center><?php echo $arr['PART_NAME_ENG'];?></center></td>
	<td><center><?php echo $arr['PO_QTY'];?></center></td>
	<td><center><?php echo $arr['RECEIVE_AREA'];?></center></td>
	<td><center><?php echo $arr['FOLLOWING_PROC'];?></center></td>
	<td><center><img src="./<?php echo $arr['DEL_NO'];?>.png"></center></td>
	
  </tr>

  <?php 
  }
  ?>
    </table>
</center>
  <?php 
  }elseif ($_GET['action']=='add'){

  ?>
  <form method="post" action="member.php?action=saveadd">
	<table>
	<tr>
		<td>ชื่อ</td>
		<td><input type="text" name="mem_name"></td>
	</tr>
	<tr>
		<td>สกุล</td>
		<td><input type="text" name="mem_sname"></td>
	</tr>
		<tr>
		<td>เพศ</td>
		<td>
		<input type="radio" name="mem_sex" value="M"> ชาย 
		<input type="radio" name="mem_sex" value="F"> หญิง 
		</td>
	</tr>
		<tr>
		<td>อายุ</td>
		<td><input type="text" name="mem_age"></td>
	</tr>
		<tr>
		<td>ที่อยู่</td>
		<td><input type="text" name="mem_add"></td>
	</tr>
		<tr>
		<td>เงินเดือน</td>
		<td><input type="text" name="mem_salary"></td>
	</tr>
	<tr>
		<td>แผนก</td>
		<td>
		<select name="mem_dept">
			<option value="1" selected>บัญชี
			<option value="2">ขนส่ง
			<option value="3">IT
		</select>
		</td>
	</tr>
		<tr>
		<td></td>
		<td><input type="submit" value = "เพิ่มข้อมูล"></td>
	</tr>
		
	
	</table>
  </form>
  
  
  <?php 
  }elseif ($_GET['action']=='saveadd'){
  	$sql = "INSERT INTO `dbtrain`.`member` (`mem_id`, `mem_name`, `mem_sname`, `mem_sex`, `mem_age`, `mem_add`, `mem_salary`, `mem_dept`) 
		VALUES (NULL, '$_POST[mem_name]', '$_POST[mem_sname]', '$_POST[mem_sex]', '$_POST[mem_age]', '$_POST[mem_add]', '$_POST[mem_salary]', '$_POST[mem_dept]')";
		if(mysql_query($sql)){
			msgbox('เพิ่มข้อมูลสมาชิกเรียบร้อยแล้ว');
		}else {
			msgbox('ไม่สามารถเพิ่มข้อมูลได้');
		}
		redirect();
  }elseif ($_GET['action']=='edit'){
  	 $sql='select * from member where mem_id = '.$_GET['id'];
	$rs=mysql_query($sql);
	$arr=mysql_fetch_array($rs);
  ?>
  <form method="post" action="member.php?action=saveedit&id=<?php echo $arr['mem_id']; ?>">
	<table>
	<tr>
		<td>ชื่อ</td>
		<td><input type="text" name="mem_name" value ="<?php echo $arr['mem_name'];?>"></td>
	</tr>
	<tr>
		<td>สกุล</td>
		<td><input type="text" name="mem_sname" value ="<?php echo $arr['mem_sname'];?>"></td>
	</tr>
		<tr>
		<td>เพศ</td>
		<td>
		<input type="radio" name="mem_sex" value="M" <?php if ($arr['mem_sex']=='M'){ echo 'checked';}?>> ชาย 
		<input type="radio" name="mem_sex" value="F" <?php if ($arr['mem_sex']=='F'){ echo 'checked';}?>> หญิง 
		</td>
	</tr>
		<tr>
		<td>อายุ</td>
		<td><input type="text" name="mem_age" value ="<?php echo $arr['mem_age'];?>"></td>
	</tr>
		<tr>
		<td>ที่อยู่</td>
		<td><input type="text" name="mem_add" value ="<?php echo $arr['mem_add'];?>"></td>
	</tr>
		<tr>
		<td>เงินเดือน</td>
		<td><input type="text" name="mem_salary" value ="<?php echo $arr['mem_salary'];?>"></td>
	</tr>
	<tr>
		<td>แผนก</td>
		<td>
		<select name="mem_dept">
			<option value="1" <?php if ($arr['mem_dept']=='1'){ echo 'selected';}?>>บัญชี
			<option value="2" <?php if ($arr['mem_dept']=='2'){ echo 'selected';}?>>ขนส่ง
			<option value="3" <?php if ($arr['mem_dept']=='3'){ echo 'selected';}?>>IT
		</select>
		</td>
	</tr>
		<tr>
		<td></td>
		<td><input type="submit" value = "แก้ไขข้อมูล"></td>
	</tr>
		
	
	</table>
  </form>
  <?php   	
  }elseif ($_GET['action']=='saveedit'){
  	$sql="UPDATE member SET 
  	mem_name = '$_POST[mem_name]', 
  	mem_sname = '$_POST[mem_sname]', 
  	mem_sex = '$_POST[mem_sex]', 
  	mem_age = '$_POST[mem_age]', 
  	mem_add = '$_POST[mem_add]', 
  	mem_salary = '$_POST[mem_salary]', 
  	mem_dept = '$_POST[mem_dept]' 
  	WHERE mem_id = '$_GET[id]' ";
  //	echo $sql;
  
 			if(mysql_query($sql)){
			msgbox('บันทึกการแก้ไขเรียบร้อยแล้ว');
		}else {
			msgbox('ไม่สามารถบันทึกการแก้ไขได้');
		}
		redirect();
  	
  	//UPDATE `dbtrain`.`member` SET `mem_name` = 'ดำจัง', `mem_sname` = 'ดีใจ' WHERE `member`.`mem_id` = 20;
  }elseif ($_GET['action']=='del'){
  	  	$sql="DELETE FROM `member` WHERE `mem_id` = '$_GET[id]'";
  			if(mysql_query($sql)){
			msgbox('ลบข้อมูลเรียบร้อยแล้ว');
		}else {
			msgbox('ไม่สามารถลบข้อมูลได้');
		}
		redirect();
  	

  }
  ?>


 </body>
</html>

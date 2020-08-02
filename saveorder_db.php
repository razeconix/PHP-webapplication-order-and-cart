<?php
	error_reporting( error_reporting() & ~E_NOTICE );
    session_start();  
	
	echo "<pre>";
	print_r($_SESSION);
	echo "<hr>";
	print_r($_POST);
	echo "</pre>";
	 
?>


<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Confirm</title>
</head>
<body>
<!--สร้างตัวแปรสำหรับบันทึกการสั่งซื้อ -->
<?php
   
    error_reporting( error_reporting() & ~E_NOTICE ); 


	$order_name = $_POST["name"];
	$order_addr = $_POST["address"];
	$order_email = $_POST["email"];
	$order_phone = $_POST["phone"];
	$p_qty = $_POST["p_qty"];
	$order_status = 1;

	
	//บันทึกการสั่งซื้อลงใน order_detail
	mysql_db_query($database_condb, "BEGIN"); 
	$sql1	= "INSERT  INTO tb_order VALUES(null,  
	'$order_name',
	'$order_addr'	,
	'$order_email',
	'$order_phone',
	'$order_status' 
	)";
	
	$query1	= mysql_db_query($database_condb, $sql1);
	
	//ฟังก์ชั่น MAX() จะคืนค่าที่มากที่สุดในคอลัมน์ที่ระบุ ออกมา หรือจะพูดง่ายๆก็ว่า ใช้สำหรับหาค่าที่มากที่สุด นั่นเอง.
 
 
	$sql2 = "SELECT MAX(order_id) AS order_id FROM tb_order  WHERE order_phone='$order_phone'";
	$query2	= mysql_db_query($database_condb, $sql2);
	$row = mysql_fetch_array($query2);
	$order_id = $row['order_id'];
	
	
	foreach($_SESSION['shopping_cart'] as $p_id=>$p_qty)
	 
	{
		$sql3	= "SELECT * FROM tbl_product where p_id=$p_id";
		$query3 = mysql_db_query($database_condb, $sql3);
		$row3 = mysql_fetch_array($query3);
		$total=$row3['p_price']*$p_qty;
		
		
		$sql4	= "INSERT INTO  tb_order_detail 
		values(null, 
		'$order_id', 
		'$p_id', 
		'$p_qty', 
		'$total')";
		$query4	= mysql_db_query($database_condb, $sql4);
	}
	
	if($query1 && $query4){
		mysql_db_query($database_condb, "COMMIT");
		$msg = "บันทึกข้อมูลเรียบร้อยแล้ว ";
		foreach($_SESSION['shopping_cart'] as $p_id)
		{	
			//unset($_SESSION['cart'][$pro_id]);
			unset($_SESSION['shopping_cart']);
		}
	}
	else{
		mysql_db_query($database_condb, "ROLLBACK");  
		$msg = "บันทึกข้อมูลไม่สำเร็จ กรุณาติดต่อเจ้าหน้าที่ค่ะ ";	
	}

	//exit();
?>


<script type="text/javascript">
	alert("<?php echo $msg;?>");
	window.location ='index.php';
</script>


 
</body>
</html>
 
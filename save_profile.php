<?php
	session_start();
	if($_SESSION['UserID'] == "")
	{
		echo "Please Login!";
		exit();
	}
	mysql_connect("localhost","root","12345678");
	mysql_select_db("register");
	
	if($_POST["txtPassword"] != $_POST["txtConPassword"])
	{
		echo "Password not Match!";
		exit();
	}
	$strSQL = "UPDATE member SET Password = '".trim($_POST['txtPassword'])."' ,
	Name = '".trim($_POST['txtName'])."',
	Email = '".trim($_POST['txtEmail'])."',
	Address = '".trim($_POST['txtAddress'])."' ,
	Tel = '".trim($_POST['txtTel'])."'
	WHERE UserID = '".$_SESSION["UserID"]."' ";
	$objQuery = mysql_query($strSQL);
	
	echo "Save Completed!<br>";		
	
	if($_SESSION["Status"] == "ADMIN")
	{
		echo "<br> Go to <a href='admin_page.php'>Admin page</a>";
	}
	else
	{
		echo "<br> Go to <a href='user_page.php'>User page</a>";
	}
	
	mysql_close();
?>
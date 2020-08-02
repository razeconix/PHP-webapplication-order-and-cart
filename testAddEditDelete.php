<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<body background="picture1.jpg">
<h2>ฐานข้อมูลร้านดอกไม้</h2>
<form name="frmMain" method="post"  >

รหัสดอกไม้ : <input type=text name=id><br><br>
ชื่อดอกไม้ : <input type=text name=name><br><br>
ประเภทดอกไม้ : <input type=text name=category><br><br>
<input type=submit name="hdnCmd" value="Add">

</form>

<?
$servername = "localhost";
$username = "root";
$password = "123456789";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

$objDB = mysqli_select_db($conn,"FlowerDB");

//*** Add Condition ***//
if($_POST["hdnCmd"] == "Add")
{
	$strSQL = "INSERT INTO member";
	$strSQL .="(FlowerID,Name,Category) ";
	$strSQL .="VALUES ";
	$strSQL .="('".$_POST["id"]."','".$_POST["name"]."' ";
	$strSQL .=",'".$_POST["category"]."') ";
	$objQuery = mysqli_query($conn, $strSQL);
	if(!$objQuery)
	{
		echo "Error Save [".mysql_error()."]";
	}
	//header("location:$_SERVER[PHP_SELF]");
	//exit();
}
$strSQL = "SELECT * FROM member";
$objQuery = mysqli_query( $conn, $strSQL) or die ("Error Query [".$strSQL."]");
?>

<?
mysqli_close($conn);
?>

</body> </html>
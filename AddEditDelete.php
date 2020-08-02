<html>
<head>
<title>Test  Add/ Delete/ Edit Database By PHP</title>
</head>
<body> 

<?
$servername = "localhost";
$username = "root";
$password = "12345678";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

$objDB = mysqli_select_db($conn,"register");

//*** Add Condition ***//
if($_POST["hdnCmd"] == "Add")
{
	$strSQL = "INSERT INTO tbl_product ";
	$strSQL .="(p_id,p_name,p_detail,p_price,p_img) ";
	$strSQL .="VALUES ";
	$strSQL .="('".$_POST["p_id"]."','".$_POST["p_name"]."' ";
	$strSQL .=",'".$_POST["p_name"]."' ";
	$strSQL .=",'".$_POST["p_price"]."','".$_POST["p_img"]."' ";
	$objQuery = mysqli_query($conn, $strSQL);
	if(!$objQuery)
	{
		echo "Error Save [".mysql_error()."]";
	}
	//header("location:$_SERVER[PHP_SELF]");
	//exit();
}

//*** Update Condition ***//
if($_POST["hdnCmd"] == "Update")
{
	$strSQL = "UPDATE tbl_product SET ";
	$strSQL .="p_id = '".$_POST["p_id"]."' ";
	$strSQL .=",p_name = '".$_POST["p_name"]."' ";
	$strSQL .=",p_detail = '".$_POST["p_detail"]."' ";
	$strSQL .=",p_price = '".$_POST["p_price"]."' ";
	$strSQL .=",p_img = '".$_POST["p_img"]."' ";
	$strSQL .="WHERE c_id = '".$_POST["hdnEditp_id"]."' ";
	$objQuery = mysqli_query($conn, $strSQL);
	if(!$objQuery)
	{
		echo "Error Update [".mysql_error()."]";
	}
	//header("location:$_SERVER[PHP_SELF]");
	//exit();
}

//*** Delete Condition ***//
if($_GET["Action"] == "Del")
{
	$strSQL = "DELETE FROM tbl_product ";
	$strSQL .="WHERE p_id = '".$_GET["PID"]."' ";
	$objQuery = mysqli_query($conn, $strSQL);
	if(!$objQuery)
	{
		echo "Error Delete [".mysql_error()."]";
	}
	//header("location:$_SERVER[PHP_SELF]");
	//exit();
}

$strSQL = "SELECT * FROM tbl_product";
$objQuery = mysqli_query($conn, $strSQL) or die ("Error Query [".$strSQL."]");
?>


<form name="frmMain" method="post" action="<?=$_SERVER["PHP_SELF"];?>">
<input type="hidden" name="hdnCmd" value="">
<table width="600" border="1">
  <tr>
    <th width="91"> <div align="center">p_id </div></th>
    <th width="98"> <div align="center">p_name </div></th>
    <th width="198"> <div align="center">p_detail </div></th>
    <th width="97"> <div align="center">p_price </div></th>
    <th width="59"> <div align="center">p_img </div></th>
    <th width="30"> <div align="center">Edit </div></th>
    <th width="30"> <div align="center">Delete </div></th>
  </tr>
<?
while($objResult = mysqli_fetch_array($objQuery, MYSQLI_ASSOC))
{
?>

  <?
	if($objResult["p_id"] == $_GET["PID"] and $_GET["Action"] == "Edit")
	{
  ?>
  <tr>
    <td><div align="center">
		<input type="text" name="p_id" size="5" value="<?=$objResult["p_id"];?>">
		<input type="hidden" name="hdnEditp_id" size="5" value="<?=$objResult["p_id"];?>">
	</div></td>
    <td><input type="text" name="p_name" size="20" value="<?=$objResult["p_name"];?>"></td>
    <td><input type="text" name="p_detail" size="20" value="<?=$objResult["p_detail"];?>"></td>
    <td><div align="center"><input type="text" name="p_price" size="2" value="<?=$objResult["p_price"];?>"></div></td>
    <td align="right"><input type="text" name="p_img" size="5" value="<?=$objResult["p_img"];?>"></td>
    <td colspan="2" align="right"><div align="center">
      <input name="btnAdd" type="button" id="btnUpdate" value="Update" OnClick="frmMain.hdnCmd.value='Update';frmMain.submit();">
	  <input name="btnAdd" type="button" id="btnCancel" value="Cancel" OnClick="window.location='<?=$_SERVER["PHP_SELF"];?>';">
    </div></td>
  </tr>
  <?
	}
  else
	{
  ?>
  <tr>
    <td><div align="center"><?=$objResult["CustomerID"];?></div></td>
    <td><?=$objResult["Name"];?></td>
    <td><?=$objResult["Email"];?></td>
    <td><div align="center"><?=$objResult["CountryCode"];?></div></td>
    <td align="right"><?=$objResult["Budget"];?></td>
    <td align="right"><?=$objResult["Used"];?></td>
    <td align="center"><a href="<?=$_SERVER["PHP_SELF"];?>?Action=Edit&CusID=<?=$objResult["CustomerID"];?>">Edit</a></td>
	<td align="center"><a href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='<?=$_SERVER["PHP_SELF"];?>?Action=Del&CusID=<?=$objResult["CustomerID"];?>';}">Delete</a></td>
  </tr>
  <?
	}
  ?>
<?
}
?>
  <tr>
    <td><div align="center"><input type="text" name="txtAddCustomerID" size="5"></div></td>
    <td><input type="text" name="txtAddName" size="20"></td>
    <td><input type="text" name="txtAddEmail" size="20"></td>
    <td><div align="center"><input type="text" name="txtAddCountryCode" size="2"></div></td>
    <td align="right"><input type="text" name="txtAddBudget" size="5"></td>
    <td align="right"><input type="text" name="txtAddUsed" size="5"></td>
    <td colspan="2" align="right"><div align="center">
      <input name="btnAdd" type="button" id="btnAdd" value="Add" OnClick="frmMain.hdnCmd.value='Add';frmMain.submit();">
    </div></td>
  </tr>
</table>
</form>   

<?
mysqli_close($conn);
?>

</body>
</html>

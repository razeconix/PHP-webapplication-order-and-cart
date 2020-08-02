<?php 

$hostname_condb = "localhost";
$database_condb = "register";
$username_condb = "root";
$password_condb = "12345678";
$condb = mysql_pconnect($hostname_condb, $username_condb, $password_condb) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_query("SET NAMES UTF8");
error_reporting( error_reporting() & ~E_NOTICE );
?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_condb, $condb);
$query_showproduct = "SELECT * FROM tbl_product ORDER BY date_save DESC";
$showproduct = mysql_query($query_showproduct, $condb) or die(mysql_error());
$row_showproduct = mysql_fetch_assoc($showproduct);
$totalRows_showproduct = mysql_num_rows($showproduct);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>
<table border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>p_id</td>
    <td>p_name</td>
    <td>p_detail</td>
    <td>p_price</td>
    <td>p_img</td>
    <td>date_save</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_showproduct['p_id']; ?></td>
      <td><?php echo $row_showproduct['p_name']; ?></td>
      <td><?php echo $row_showproduct['p_detail']; ?></td>
      <td><?php echo $row_showproduct['p_price']; ?></td>
      <td><img src="img/<?php echo $row_showproduct['p_img']; ?>" width="100" /></td>
      <td><?php echo $row_showproduct['date_save']; ?></td>
    </tr>
    <?php } while ($row_showproduct = mysql_fetch_assoc($showproduct)); ?>
</table>

<a href="add_product.php">&nbsp;+ สินค้า </a></td>


</body>
</html>
<?php
mysql_free_result($showproduct);
?>

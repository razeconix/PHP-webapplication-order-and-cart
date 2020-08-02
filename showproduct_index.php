<?php require_once('Connections/condb.php'); ?>
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
$query_showproduct = "SELECT * FROM tbl_product";
$showproduct = mysql_query($query_showproduct, $condb) or die(mysql_error());
$row_showproduct = mysql_fetch_assoc($showproduct);
$totalRows_showproduct = mysql_num_rows($showproduct);
?>
<?php do { ?>
  <div class="col-xs-12 col-sm-4 col-md-3">
  <img src="img/<?php echo $row_showproduct['p_img']; ?>" width="100%"  style="padding-bottom:20px"/>
  ชื่อสินค้า  <?php echo $row_showproduct['p_name']; ?> 
  <font color="#0033CC">
  ราคา  <?php echo number_format($row_showproduct['p_price'],2); ?>  บาท 
  </font>
  <p>
  <a href="product_detail.php?p_id=<?php echo $row_showproduct['p_id']; ?>&<?php echo $row_showproduct['p_name']; ?> " class="btn btn-info btn-xs"> รายละเอียด </a>
  <a href="#" class="btn btn-success btn-xs"> สั่งซื้อ </a>
  
  </p>
	  <br/> <br/>
  </div>
  <?php } while ($row_showproduct = mysql_fetch_assoc($showproduct)); ?>
<?php
mysql_free_result($showproduct);
?>

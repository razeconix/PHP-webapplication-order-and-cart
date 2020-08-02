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

$maxRows_showmember = 10;
$pageNum_showmember = 0;
if (isset($_GET['pageNum_showmember'])) {
  $pageNum_showmember = $_GET['pageNum_showmember'];
}
$startRow_showmember = $pageNum_showmember * $maxRows_showmember;

mysql_select_db($database_condb, $condb);
$query_showmember = "SELECT * FROM tb_member ORDER BY m_id ASC";
$query_limit_showmember = sprintf("%s LIMIT %d, %d", $query_showmember, $startRow_showmember, $maxRows_showmember);
$showmember = mysql_query($query_limit_showmember, $condb) or die(mysql_error());
$row_showmember = mysql_fetch_assoc($showmember);

if (isset($_GET['totalRows_showmember'])) {
  $totalRows_showmember = $_GET['totalRows_showmember'];
} else {
  $all_showmember = mysql_query($query_showmember);
  $totalRows_showmember = mysql_num_rows($all_showmember);
}
$totalPages_showmember = ceil($totalRows_showmember/$maxRows_showmember)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table border="1" align="center" cellpadding="0" cellspacing="0" class="table-hover">
  <tr>
    <td width="127" height="40" align="center" bgcolor="#3399FF">Number</td>
    <td width="144" height="40" align="center" bgcolor="#3399FF">Username</td>
    <td width="146" height="40" align="center" bgcolor="#3399FF">Password</td>
    <td width="151" height="40" align="center" bgcolor="#3399FF">Name</td>
    <td width="155" height="40" align="center" bgcolor="#3399FF">data</td>
    <td width="90" align="center" bgcolor="#3399FF">Edit</td>
    <td width="90" align="center" bgcolor="#3399FF">Delete</td>
  </tr>
  <?php do { ?>
    <tr align="center">
      <td height="40"><?php echo $row_showmember['m_id']; ?></td>
      <td height="40"><?php echo $row_showmember['m_user']; ?></td>
      <td height="40"><?php echo $row_showmember['m_pass']; ?></td>
      <td height="40"><?php echo $row_showmember['m_name']; ?></td>
      <td height="40"><?php echo $row_showmember['detesave']; ?></td>
      <td height="40"><a href="/adpsg/form_edit.php?m_id=<?php echo $row_showmember['m_id']; ?>" class="btn btn-warning"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></td>
      <td height="40" valign="middle">
      <form id="form1" name="form1" method="post" action="">
        <input name="Submit" type="submit" class="btn btn-danger" id="button" value="Delete" />
        <input name="m_id" type="hidden" id="m_id" value="<?php echo $row_showmember['m_id']; ?>" />
      </form>
      </td>
    </tr>
    <?php } while ($row_showmember = mysql_fetch_assoc($showmember)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($showmember);
?>
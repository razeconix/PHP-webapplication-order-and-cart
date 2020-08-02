<?php  

//select.php
 
include('db.php');

$query = "SELECT * FROM tbl_product ORDER BY p_id DESC";
$statement = $connect->prepare($query);
if($statement->execute())
{
  while($row = $statement->fetch(PDO::FETCH_ASSOC))
  {
    $data[] = $row;
  }
  echo json_encode($data);
}

?>

<?php
include_once("database.php");
$postdata = file_get_contents("php://input");

  $sql = "SELECT * FROM times";
  $result = $mysqli->query($sql);
  $rows = [];

//  if ($result->fetch_assoc()) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $rows[] = $row;
    }

    echo json_encode($rows);

//  } else {
//    return null;
//  }



?>

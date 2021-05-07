<?php
include_once("database.php");
$postdata = file_get_contents("php://input");

$sql = "SELECT * FROM tabela";
$result = $mysqli->query($sql);

// output data of each row
while($row = $result->fetch_assoc()) {
    $rows[] = $row;
}

echo json_encode($rows);

?>

<?php
include_once("database.php");
  $postdata = file_get_contents("php://input");
  if (isset($postdata) && !empty($postdata)) {
    $request = json_decode($postdata);
    $nome = trim($request->nomeTime);
    $jogador_1 = mysqli_real_escape_string($mysqli, trim($request->jogador1));
    $jogador_2 = mysqli_real_escape_string($mysqli, trim($request->jogador2));
    $sql = "INSERT INTO times(nome, jogador_1, jogador_2) VALUES ('$nome', '$jogador_1', '$jogador_2')";
    if ($mysqli->query($sql) === TRUE) {
      $authdata = [
        'name' => $nome,
        'jogador_1' => $jogador_1,
        'jogador_2' => $jogador_2,
        'Id' => mysqli_insert_id($mysqli)
      ];
      echo json_encode($authdata);
    }
  }

?>

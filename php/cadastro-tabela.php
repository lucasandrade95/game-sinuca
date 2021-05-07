<?php
include_once("database.php");
$postdata = file_get_contents("php://input");
if (isset($postdata) && !empty($postdata)) {
    $request = json_decode($postdata);
    $nome = trim($request->nomeTabela);
    $desc_premiacao = mysqli_real_escape_string($mysqli, trim($request->desc_premiacao));
    $pontuacao = mysqli_real_escape_string($mysqli, trim($request->pontuacao));
    $desc_regras = mysqli_real_escape_string($mysqli, trim($request->desc_regras));
    $id_times = mysqli_real_escape_string($mysqli, trim($request->times));
    $sql = "INSERT INTO tabela (nome, desc_premiacao, pontuacao, desc_regras, id_times)
            VALUES ('$nome', '$desc_premiacao', '$pontuacao', '$desc_regras', '$id_times')";
    if ($mysqli->query($sql) === TRUE) {
        $authdata = [
            'nome' => $nome,
            'desc_premiacao' => $desc_premiacao,
            'pontuacao' => $pontuacao,
            'desc_regras' => $desc_regras,
            'id_times' => $id_times,
            'id' => mysqli_insert_id($mysqli)
        ];
        echo json_encode($authdata);
    }
}

?>

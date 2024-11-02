<?php
header('Content-Type: application/json');
include_once("basedados.php");

$id = $_POST['form_edit_idmodelo'];       
$retorno = mysqli_query($mysqli, "SELECT * FROM invest.modelos where ativo = 'S' and idmodelo = $id");
$row = mysqli_fetch_assoc($retorno);

echo json_encode([
    'idmodelo' => $row['idmodelo'],
    'descricao' => $row['descricao'],
    'percent_cdi' => $row['percent_cdi'],
    'taxa_aa' => $row['taxa_aa'],
    'prefixado' => $row['prefixado'],
    'ativo' => $row['ativo'],        
    'isento_ir' => $row['isento_ir']
]);

?>
<?php
header('Content-Type: application/json');
include_once("basedados.php");

try {
    $id = $_POST['form_edit_idmodelo'];
    $descricao = $_POST['form_edit_descricao'];
    $isento_ir = $_POST['form_edit_isento_ir'];
    $ativo = $_POST['form_edit_ativo'];

    $campoVisivel = "";
    if($_POST['form_edit_prefixado'] == "S")
    { 
        $taxa_aa = floatval($_POST['form_edit_taxa_aa']);
        $campoVisivel = "taxa_aa=$taxa_aa";
    } else {
        $percent_cdi = floatval($_POST['form_edit_percent_cdi']);
        $campoVisivel = "percent_cdi=$percent_cdi";
    }

    $sql = "UPDATE invest.modelos SET descricao='$descricao',$campoVisivel,ativo='$ativo',isento_ir='$isento_ir' WHERE idmodelo=$id";
    $result = mysqli_query($mysqli, $sql );

    echo json_encode([
        'icon' => 'success',
        'message' => 'Registro salvo com sucesso!',
        'bgClass' => 'text-bg-success'
    ]);

} catch (Exception $e) {
    echo json_encode([
        'icon' => 'error',
        'message' => $e->getMessage(),
        'bgClass' => 'text-bg-danger'
    ]);
}

?>
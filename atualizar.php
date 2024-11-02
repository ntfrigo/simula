<?php
header('Content-Type: application/json');
include_once("basedados.php");

try {

    $taxa = floatval($_POST['form_edit_taxa_selic']);       
    $sql = "UPDATE invest.selic SET taxa=$taxa";
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
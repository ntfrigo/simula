<?php
header('Content-Type: application/json');
include_once("basedados.php");

try {
    $id = $_POST['form_del_idmodelo'];

    $sql = "DELETE FROM invest.modelos WHERE idmodelo=$id";
    $result = mysqli_query($mysqli, $sql );

    echo json_encode([
        'icon' => 'success',
        'message' => 'Registro excluído com sucesso!',
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
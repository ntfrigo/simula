<?php 
header('Content-Type: application/json');
include_once("basedados.php");

try {
    $descricao = $_POST['form_ins_descricao'];

    $percent_cdi = floatval($_POST['form_ins_percent_cdi']);
    $taxa_aa = floatval($_POST['form_ins_taxa_aa']);
    
    if($_POST['form_ins_prefixado'] == "S")
    { 
        $prefixado = "S";
        $percent_cdi = 0;
    } else {
        $prefixado = "N";
        $taxa_aa = 0;
    }    

    $isento_ir = $_POST['form_ins_isento_ir'];

    $sql = "INSERT INTO invest.modelos (descricao, percent_cdi, taxa_aa, prefixado, ativo, isento_ir) VALUES ('$descricao', $percent_cdi, $taxa_aa, '$prefixado', 'S', '$isento_ir')";
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
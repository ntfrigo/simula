<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$username = $_SESSION['username'];

	include_once("basedados.php");
	include("telas.php");
	include("calculos.php");

    $botao_calcular = false;
    $taxa_selic = consulta_taxa_selic($mysqli);

	if(isset($_POST['botao_calcular'])) 
    {
        $valor_investir = $_POST['valor_investir'];
        $prazo_meses = $_POST['prazo_meses'];
        unset($_POST['botao_calcular']);
        $botao_calcular = true;
	}
	else
	{
		$valor_investir = 0;
		$prazo_meses = 0;			
	}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Simulador de Investimentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="dashboard.css" rel="stylesheet">
</head>

<body>
<div aria-live="polite" aria-atomic="true" class="position-relative"><div class="toast-container position-fixed top-0 end-0 p-2"></div></div>

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 shadow" href="#">
        Simula Investimentos
        </a>
       
        <div class="d-flex align-items-center">
          <a class="link-light me-4" href="#" data-toggle="modal" data-target="#telaModalInserir">
            <i class="fas fa-plus-circle fa-lg"></i>
          </a>
          <a class="link-light me-4" href="#" data-toggle="modal" data-target="#telaModalEditarSelic">
            <i class="fas fa-comments-dollar fa-lg"></i>
          </a>

          <h6 class="text-center" style="margin-left: 32px; margin-right: 32px;">
          <span class="text-white" style="font-size: 0.575rem;">Bem-vindo!</span><br>
          <span class="text-warning" style="font-size: 0.675rem;"><?= htmlspecialchars($username) ?></span>
          </h6>

          <a class="link-light me-4" href="#" data-toggle="modal" data-target="#telaModalSair">
            <i class="fas fa-sign-out-alt fa-lg"></i>
          </a>

        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <main class="col-md-12 ms-sm-auto col-lg-12 px-md-4">
                <br>
                <div class="row g-5">
                    <div class="col-md-5 col-lg-4 order-md-last">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-primary">Dados informados</span>
                        </h4>
                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div>
                                    <h6 class="my-0">Taxa Selic</h6>
                                </div>
                                <span class="text-muted"><?php echo $taxa_selic ?> </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div>
                                    <h6 class="my-0">Prazo em meses</h6>
                                </div>
                                <span class="text-muted"><?php echo $prazo_meses ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Valor informado</span>
                                <strong><?php echo "R$ ".number_format((float)$valor_investir, 2) ?></strong>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-7 col-lg-8">
                        <h4 class="mb-3">Informe o valor:</h4>
                        <form class="needs-validation" novalidate action="index.php" method="POST">
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Valor:</span>
                                        <input type="text" class="form-control" aria-label="Sizing example input"
                                            aria-describedby="inputGroup-sizing-sm" name="valor_investir"
                                            id="valor_investir" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Prazo:</span>
                                        <input type="text" class="form-control" aria-label="Sizing example input"
                                            aria-describedby="inputGroup-sizing-sm" name="prazo_meses" id="prazo_meses"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <button class="w-100 btn btn-primary btn-lg btn-sm" type="submit"
                                name="botao_calcular">Calcular</button>
                        </form>
                    </div>
                </div>
                <br>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Titulo</th> 
                                <th scope="col">% CDI</th>
                                <th scope="col">Taxa a.a.</th>
                                <th scope="col">Valor bruto</th>
                                <th scope="col">Lucro bruto</th>
                                <th scope="col">Desconto IR</th>
                                <th scope="col">Lucro liquido</th>
                                <th scope="col">Total liquido</th>
                                <th scope="col">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php            
                                if($botao_calcular === true) 
                                {
                                    while($user_data = mysqli_fetch_array($consulta_modelos_ativos))
                                    {
                                        CarregaItensLista($user_data, $valor_investir, $prazo_meses, $taxa_selic);                                        
                                    }
                                    $botao_calcular = false;
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <?php 
    CarregaTelaInserir(); 
    CarregaTelaExcluir();
    CarregaTelaEditar();
    CarregaTelaSair();
    
    CarregaTelaEditarSelic($taxa_selic);
    ?>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="dashboard.js"></script>
<script src="notifica.js"></script>
</body>

</html>
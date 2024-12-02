<?php
session_start();
$error = '';

$users = [
    'Nivaldo' => md5('123'),
    'admin' => md5('123')
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (isset($users[$username]) && $users[$username] == md5($password)) {
        $_SESSION['username'] = $username;
        header('Location: index.php');
        exit;
    } else {
        $error = 'Dados inválidos!';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"> 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script> 
    <script src="https://netdna.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script> 
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"--->
    <link href="login.css" rel="stylesheet">
    </head>
<body>

<br>
<br>
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
      <form method="POST" action="login.php">
        <div class="card-group mb-0">
          <div class="card p-4">
            <div class="card-body">

            <div class="input-group mb-3">              
            <div class="d-flex justify-content-between align-items-center">
            <?php if ($error): ?>
               <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>          
          </div>
              </div>


              <h1>Login</h1>
              <p class="text-muted">Entre com sua conta</p>
              <div class="input-group mb-3">              
                 <input type="text" class="form-control" id="username" name="username" required placeholder="Usuario">
              </div>
              <div class="input-group mb-4">
                <input type="password" class="form-control" id="password" name="password" required placeholder="Senha">
              </div>
              <div class="row">
                <div class="col-6">
                  <button type="submit" class="btn btn-primary px-4">Entrar</button>
                </div>                
              </div>
            </div>
          </div>
          <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
            <div class="card-body text-center">
              <div>
                <h2>Simulador de investimentos</h2>
                <p>Planejando o seu futuro.</p>
              </div>
            </div>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>

</body>
</html>

<?php

  require_once('./admin/config.php');

  // Verifica se os campos foram submetidos
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Define as credenciais de acesso
      $username = "usuario";
      $password = "senha";

      // Recupera os valores submetidos
      $input_username = $_POST['username'];
      $input_password = $_POST['password'];

      // Verifica se as credenciais estão corretas
      if ($input_username == $username && $input_password == $password) {
          // Inicia a sessão e redireciona para a página de sucesso
          session_start();
          $_SESSION['username'] = $username;
          header("Location: ./admin/index.php");
      } else {
          // Caso contrário, exibe uma mensagem de erro
          echo "<script>alert('Usuário ou senha inválidos')</script>";
      }
  }
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/reset.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <title>Wamy</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body class="body_login">
  <div class="login-container">
    <h2>Login</h2>
    <form class="" method="post" action="./login.php">
      <div class="input-group">
        <label for="username">Usuário</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div class="input-group">
        <label for="password">Senha</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit">Entrar</button>
    </form>
  </div>

  <script src="assets/js/script.js"></script>
</body>
</html>

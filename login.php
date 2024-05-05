<?php

  require_once('./admin/config.php');

  // Verifica se os campos foram submetidos
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
      $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);

      if(in_array("", $form)){
        echo "<p>Preencha todos os campos!</p>";
      }else{

        $filterForm = [
          'username' => FILTER_SANITIZE_SPECIAL_CHARS,
          'password' => FILTER_SANITIZE_SPECIAL_CHARS
        ];

        $getForm = filter_input_array(INPUT_POST, $filterForm);

        try{

          $querySelect = "SELECT * FROM users WHERE name = :nome";
          $stmt = $conn->prepare($querySelect);

          $stmt->bindParam(':nome', $getForm['username']);
          $stmt->execute();

          $result = $stmt->fetch(PDO::FETCH_ASSOC);

          if($result && password_verify($getForm['password'], $result['password'])){

            session_start();
            $_SESSION['username'] = $getForm['username'];
            header("Location: ./admin/index.php");

          }else{
            echo "<script>alert('Usuário ou senha inválidos')</script>";
          }

        }catch(PDOException $e){

          echo "<p>Errop ao fazer login: </p>".$e->getMessage();

        }

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
  <title>Login Wamy</title>
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

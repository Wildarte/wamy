<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Painel</title>
</head>
<body>

    <div class="content_page">
        <?php require_once('./sidebar.php') ?>

        <div class="right_page">
            <h2>Logado com sucesso!</h2>
            <p>Bem-vindo, <?php echo $_SESSION['username']; ?>.</p>
        </div>
    </div>
    

   
</body>
</html>

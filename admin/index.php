<?php
session_start();
// Verifica se o usuário está logado
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sucesso</title>
</head>
<body>
    <h2>Logado com sucesso!</h2>
    <p>Bem-vindo, <?php echo $_SESSION['username']; ?>.</p>
    <p><a href="logout.php">Sair</a></p>
</body>
</html>

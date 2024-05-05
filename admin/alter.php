<?php

require_once('./config.php');

// Verifica se os campos foram submetidos via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados submetidos via POST

    $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if(in_array("", $form)){
        echo "<script>alert('Preencha todos os campos')</script>";
    }else{

        $filterForm = [
            'password' => FILTER_SANITIZE_SPECIAL_CHARS
        ];

        $getForm = filter_input_array(INPUT_POST, $filterForm);

        $senhaHash = password_hash($getForm['password'], PASSWORD_DEFAULT);

        $senha = $senhaHash;

        var_dump($_SESSION['username']);

        
        try {

            $querySelect = "SELECT * FROM users WHERE name = :nome";
            $stmt = $conn->prepare($querySelect);
            $stmt->bindParam(':nome', $_SESSION['username']);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if($result){
                $query = "UPDATE users SET password = :senha WHERE name = :nome";
                $stmt = $conn->prepare($query);
                
                // Bind dos parâmetros
                $stmt->bindParam(':nome', $_SESSION['username']);
                $stmt->bindParam(':senha', $senha); // Lembre-se de criptografar a senha antes de armazená-la no banco de dados
        
                // Executa a consulta
                $stmt->execute();
        
                echo "<p>Senha atualizada com sucesso!</p>";

            }else{
                echo "<p>Usuário não existe!</p>";
            }

            
        } catch(PDOException $e) {
            // Em caso de erro, exibe uma mensagem de erro
            echo "Erro ao inserir usuário: " . $e->getMessage();
        }
        
    }

    
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Alterar Acesso</title>
</head>
<body>

    <h2>Alterar Credenciais de Acesso</h2>

    <form action="alter.php" method="post">
        <p>
            <label for="">Nova Senha</label>
            <input type="password" name="password" id="" value="" placeholder="Nova senha">
        </p>
        <input type="submit" value="Atualizar">
    </form>
    
</body>
</html>
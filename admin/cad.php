<?php

require_once('./config.php');

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    var_dump($form);

    if(in_array("", $form)){
        echo "<p>Preencha todos os campos!</p>";
    }else{

        $filterForm = [
            'nome' => FILTER_SANITIZE_SPECIAL_CHARS,
            'email' => FILTER_SANITIZE_EMAIL,
            'senha' => FILTER_SANITIZE_SPECIAL_CHARS
        ];

        $getForm = filter_input_array(INPUT_POST, $filterForm);

        $senhaHash = password_hash($getForm['senha'], PASSWORD_DEFAULT);

        $nome = $getForm['nome'];
        $email = $getForm['email'];
        $senha = $getForm['senha'];

        try{

            $querySelect = "SELECT * FROM users WHERE name = :nome";
            $stmt = $conn->prepare($querySelect);
            $stmt->bindParam(':nome', $nome);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            var_dump($result);

            if($result){
                echo "<p>Já existe um usuário com esse nome!</p>";
            }else{
                $queryInsert = "INSERT INTO users (name, email, password) VALUES (:nome, :email, :senha)";
                $stmt = $conn->prepare($queryInsert);
    
                $stmt->bindParam(':nome', $getForm['nome']);
                $stmt->bindParam(':email', $getForm['email']);
                $stmt->bindParam(':senha', $senhaHash);
    
                $stmt->execute();
    
                echo "<p>Usuário adicionado com sucesso!</p>";
            }

        }catch(PDOException $e){
            echo "Erro ao inserir usuário: ". $e->getMessage();
        }

    }

}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário</title>
</head>
<body>

    <h2>Cadastrar Usuário</h2>

    <form action="./cad.php" method="post">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" required><br><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <label for="senha">Senha:</label><br>
        <input type="password" id="senha" name="senha" required><br><br>
        <input type="submit" value="Cadastrar">
    </form>
    
</body>
</html>
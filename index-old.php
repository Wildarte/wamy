<?php

    session_start();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wamy</title>
</head>
<body>

    <?php

        $user = "João";
        $logado = false;

        if($_SERVER['REQUEST_METHOD'] == "POST"){

            $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            if(empty($form['name'])){
                
                echo "<p>Os campos não podem ficar vazios</p>";

            }elseif($form['name'] == "user"){

                echo "<p>Sessão Iniciada</p>";
                $_SESSION['user'] = $user;

            }else{
                echo "<p>Usuário incorreto</p>";
            }

        }elseif($_SERVER['REQUEST_METHOD'] == "GET"){

            $action = $_GET['action'];

            if($action == "logout"){
                session_destroy();   
            }


        }

    ?>
    
    <?php

        if(isset($_SESSION['user'])){
            echo "<p style='color: green'>Você está logado</p>";
        }

    ?>

    <form action="./" method="post">
        <input type="text" name="name" id="" value="">
        <button id="" type="submit">Logar</button>
    </form>

    <a href="?action=logout">Sair</a>

</body>
</html>
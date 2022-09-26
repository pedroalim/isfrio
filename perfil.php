<?php

    require_once 'classes/isfrio.php';
    $u = new isfrio();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@700&display=swap" rel="stylesheet">
    <title>isfrio</title>
</head>
<body>

    <h1>Perfil</h1>

    <?php
    session_start();
    $u->conectar("isfrio", "localhost", "root", "");

    $perfil = $u->buscarCliente();
    print_r($perfil["nome"]);
    echo "<br>";
    print_r($perfil["email"]);

    echo "
    <h2>Atualizar Dados</h2>
    <form method='POST'>
        <input type='text' name='nome' placeholder='$perfil[nome]'> <br>
        <input type='email' name='email' placeholder='$perfil[email]''>
        <br>
        <input type='submit' name='atualizar'>
    </form>
    ";
    ?>

    <h2>Sair da Conta</h2>
    <form method="post">
        <input type="submit" name="sair" value="Sair">
    </form>

    <h2>Excluir da Conta</h2>
    <form method="post">
        <input type="submit" name="excluir" value="Excluir">
    </form>
</body>
</html>

<?php
    $nome = $_POST["nome"] = (isset($_POST["nome"])) ? $_POST["nome"] : null;
    $email = $_POST["email"] = (isset($_POST["email"])) ? $_POST["email"] : null;
    $atualizar = $_POST["atualizar"] = (isset($_POST["atualizar"])) ? $_POST["atualizar"] : null;
    $sair = $_POST["sair"] = (isset($_POST["sair"])) ? $_POST["sair"] : null;
    $excluir = $_POST["excluir"] = (isset($_POST["excluir"])) ? $_POST["excluir"] : null;

    if($atualizar){
        if($email == ""){
            $email = $perfil['email'];
        }
        if($nome == ""){
            $nome = $perfil['nome'];
        }

        $perfil = $u->atualizarCliente($nome, $email);
        header("Refresh:0");
    }

    if($sair){
        unset($_SESSION['id']);
        header('location: login.php');
    }

    if($excluir){
        $u -> deletarCliente();
        unset($_SESSION['id']);
        header('location: login.php');
    }
?>
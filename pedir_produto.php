<?php

    require_once 'classes/isfrio.php';
    $u = new isfrio();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/pedir.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@700&display=swap" rel="stylesheet">
    <title>isfrio</title>
</head>
<body>
    <div id="navegador">
        <a href="home.php" id="cancelar"><p>X | Cancelar</p></a>
        <img src="imagens/navegador1.png" id="imgNavegador" alt="" width="450px" height="50px">
    </div>
    <div id="background">
        <div id="etapa">
            <h2>Modelo do Sorvete</h2>
        </div>
        <div id="campo">
        <?php
    
        session_start();
        if(!$_SESSION['id']){
            header("location: login.php");
        }

        $u->conectar("isfrio", "localhost", "root", "");

        $produtos = $u->procurarProdutos();

        //form
        for($i=0; $i<count($produtos); $i++){
            $nome = $produtos[$i]["nome"];
            $id = $produtos[$i]["id"];
            $img = $produtos[$i]["img"];
            echo "
            <input type='hidden' value='$id'>
            <img src='$img' alt=''>";
        }
    
    ?>
        </div>
    </div>


</body>
</html>
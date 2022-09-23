<?php
    session_start();
    if(!$_SESSION['id']){
        header("location: login.php");
    }

    require_once 'classes/isfrio.php';
    $u = new isfrio();


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Isfrio</title>
    <link rel="stylesheet" href="styles/home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@700&display=swap" rel="stylesheet">
</head>
<body>
    <?php
    $u->conectar("isfrio", "localhost", "root", "");

    $produtosSee = $u->buscarProdutos();
    

    print_r($produtosSee["nome"]);
    echo "<br>";
    $u->buscarMassas();
    ?>
</body>
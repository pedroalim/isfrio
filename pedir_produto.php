<?php

    require_once 'classes/isfrio.php';
    $u = new isfrio();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <img src="" alt="">
</head>
<body>
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
            echo "$nome<br>
            <input type='hidden' value='$id'>
            <img src='$img' alt=''>";
        }

    ?>

    <h1>HELOLO MOTO</h1>
</body>
</html>
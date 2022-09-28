<?php

    require_once '../classes/isfrio.php';
    $u = new isfrio();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../styles/pedir1.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@700&display=swap" rel="stylesheet">
    <title>isfrio</title>
</head>
<body>
   
    <div id="navegador">
        <a href="../home.php" id="cancelar"><p>X | Cancelar</p></a>
        <img src="../imagens/navegador1.png" id="imgNavegador" alt="" width="450px" height="50px">
    </div>
    <div id="background">
        <div id="etapa">
            <h2>Modelo do Sorvete</h2>
        </div>
        <div id="campo">
        <form method="post">
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
                    <br>
                    $nome 
                    <input type='radio' name='tipo' value='$id'>
                    <br>
                    <img src='$img' alt=''>";
                }
        
            ?>
                <input type="submit" value="Proximo" name="proximo">

                <?php
                    $modelo = $_POST["tipo"] = (isset($_POST["tipo"])) ? $_POST["tipo"] : null;
                    $_SESSION['modelo'] = $modelo;
                    $proximo = $_POST["proximo"] = (isset($_POST["proximo"])) ? $_POST["proximo"] : null;
                    if($proximo){
                        if ($_SESSION['modelo'] != 0) {
                            header("Location: massaSorvete.php");
                        } else {
                            echo "<div class='msg-erro'>Escolha um modelo para prosseguir!</div>";
                        }
                    }
                ?>
            </form>
        </div>
    </div>
</body>
</html>

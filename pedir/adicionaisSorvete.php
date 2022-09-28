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
            <h2>Adicionais do Sorvete</h2>
        </div>
        <div id="campo">
        <form method="post">
            <?php
        
                session_start();
                if(!$_SESSION['id']){
                    header("location: login.php");
                }

                $u->conectar("isfrio", "localhost", "root", "");

                $adicionais = $u->procurarAdiconais();

                //form
                for($i=0; $i<count($adicionais); $i++){
                    $nome = $adicionais[$i]["nome"];
                    $id = $adicionais[$i]["id"];
                    echo " 
                    <br>
                        $nome 
                        <input type='checkbox' name='adicionais[]' value='$id'>
                    <br>
                    ";
                }
        
            ?>
                <input type="submit" value="Proximo" name="proximo">
                <?php             
                    $proximo = $_POST["proximo"] = (isset($_POST["proximo"])) ? $_POST["proximo"] : null;
                    if($proximo){
                        $adicionais = $_POST["adicionais"] = (isset($_POST["adicionais"])) ? $_POST["adicionais"] : null;
                        if($adicionais != 0){
                            $adicionais = implode(",", $adicionais);
                            $_SESSION['adicionais'] = $adicionais;
                            $valor = $u -> buscarPrecosAdicionais($adicionais);
                            $adicionaisEx = explode(",", $adicionais);
                            $quantidadeAdicionais = count($adicionaisEx);
                            for($i = 0; $i < $quantidadeAdicionais; $i++){
                                $_SESSION['preco'] =  $_SESSION['preco'] + $valor[$i]["preco"];
                                print_r($valor[$i]["preco"]);
                            }
                            echo"<br>";
                            echo($_SESSION['preco']);   
                        } else {
                            $_SESSION['adicionais'] = "";
                        }
                        header("Location: pagamentoSorvete.php");
                    }
                ?>
            </form>
        </div>
    </div>
</body>
</html>

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
    <link rel="icon"  href="../imagens/icon-isfrio.png"/>
    <title>isfrio</title>
</head>
<body>
   
    <div id="navegador">
        <a href="../home.php" id="cancelar"><p>X | Cancelar</p></a>
        <img src="../imagens/navegador4.png" id="imgNavegador" alt="" width="450px" height="50px">
    </div>
    <div id="background">
        <div id="etapa">
            <h2>Adicionais do Sorvete</h2>
        </div>
        <div id="campo">
        <form method="post">
        <p>Campo <strong>não</strong> obrigatório</p>
        <br>
        <h3>Escolha os adicionais do seu sorvete:</h3>
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
                        <input type='checkbox' name='adicionais[]' value='$id' id='$id'>
                        <label for='$id'>$nome</label>
                    <br>
                    ";
                }
        
            ?>
                <input type="submit" value="Proximo" name="proximo" class="btnProximo">
                <?php             
                    $proximo = $_POST["proximo"] = (isset($_POST["proximo"])) ? $_POST["proximo"] : null;
                    $_SESSION["precoA"] = 0;
                    if($proximo){
                        $adicionais = $_POST["adicionais"] = (isset($_POST["adicionais"])) ? $_POST["adicionais"] : null;
                        if($adicionais != 0){
                            $adicionais = implode(",", $adicionais);
                            $_SESSION['adicionais'] = $adicionais;
                            $valor = $u -> buscarPrecosAdicionais($adicionais);
                            $adicionaisEx = explode(",", $adicionais);
                            $quantidadeAdicionais = count($adicionaisEx);
                            for($i = 0; $i < $quantidadeAdicionais; $i++){
                                $_SESSION['precoA'] =  $_SESSION['precoA'] + $valor[$i]["preco"];
                                print_r($valor[$i]["preco"]);
                            }
                            echo"<br>";
                            echo($_SESSION['precoA']);   
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

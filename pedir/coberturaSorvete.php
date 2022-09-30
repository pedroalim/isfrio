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
        <img src="../imagens/navegador3.png" id="imgNavegador" alt="" width="450px" height="50px">
    </div>
    <div id="background">
        <div id="etapa">
            <h2>Cobertura do Sorvete</h2>
        </div>
        <div id="campo">
        <form method="post">
        <p>Campo <strong>não</strong> obrigatório</p>
        <br>
        <h3>Escolha os sabores da cobertura:</h3>
            <?php
        
                session_start();
                if(!$_SESSION['id']){
                    header("location: login.php");
                }

                $u->conectar("isfrio", "localhost", "root", "");

                $coberturas = $u->procurarCoberturas();

                //form
                for($i=0; $i<count($coberturas); $i++){
                    $nome = $coberturas[$i]["nome"];
                    $id = $coberturas[$i]["id"];
                    echo " 
                    <br>
                        <input type='checkbox' name='coberturas[]' value='$id' id='$id'>
                        <label for='$id'>$nome</label>
                    <br>
                    ";
                }
        
            ?>
                <input type="submit" value="Proximo" name="proximo" class="btnProximo">
                <?php
                    $proximo = $_POST["proximo"] = (isset($_POST["proximo"])) ? $_POST["proximo"] : null;
                    $_SESSION["precoC"] = 0;
                    if($proximo){
                        $coberturas = $_POST["coberturas"] = (isset($_POST["coberturas"])) ? $_POST["coberturas"] : null;
                        if($coberturas != 0){
                            $coberturas = implode(",", $coberturas);
                            $_SESSION['coberturas'] = $coberturas;
                            $valor = $u -> buscarPrecosCoberturas($coberturas);
                            $coberturasEx = explode(",", $coberturas);
                            $quantidadeCoberturas = count($coberturasEx);
                            for($i = 0; $i < $quantidadeCoberturas; $i++){
                                $_SESSION['precoC'] =  $_SESSION['precoC'] + $valor[$i]["preco"];
                                print_r($valor[$i]["preco"]);
                            }
                            echo"<br>";
                            echo($_SESSION['precoC']);
                        } else {
                            $_SESSION['coberturas'] = "";
                        }
                        header("Location: adicionaisSorvete.php");
                    }
                ?>
            </form>
        </div>
    </div>
</body>
</html>


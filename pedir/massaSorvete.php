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
        <img src="../imagens/navegador2.png" id="imgNavegador" alt="" width="450px" height="50px">
    </div>
    <div id="background">
        <div id="etapa">
            <h2>Massa do Sorvete</h2>
        </div>
        <div id="campo">
        <form method="post">
            <p>* Campo obrigatório</p>
            <br>
            <h3>Escolha os sabores da massa:</h3>
            
            <?php
        
                session_start();
                if(!$_SESSION['id']){
                    header("location: login.php");
                }

                $u->conectar("isfrio", "localhost", "root", "");

                $massas = $u->procurarMassas();

                //form
                for($i=0; $i<count($massas); $i++){
                    $nome = $massas[$i]["nome"];
                    $id = $massas[$i]["id"];
                    echo " 
                    <br>
                        <input type='checkbox' name='massas[]' value='$id' id='$id'>
                        <label for='$id'>$nome</label>
                    <br>
                    ";
                }
        
            ?>
                <input type="submit" value="Proximo" name="proximo" class="btnProximo">
                <?php
                    $proximo = $_POST["proximo"] = (isset($_POST["proximo"])) ? $_POST["proximo"] : null;
                    $preco = isset($preco);

                    if($proximo){
                        $massas = $_POST["massas"] = (isset($_POST["massas"])) ? $_POST["massas"] : null;
                        if ($massas != 0) {
                            $massas = implode(",", $massas);
                            $_SESSION['massas'] = $massas;
                            $valor = $u -> buscarPrecosMassas($massas);
                            $massasEx = explode(",", $massas);
                            $quantidadeMassas = count($massasEx);
                            for($i = 0; $i < $quantidadeMassas; $i++){
                                $preco = $preco + $valor[$i]["preco"];
                                print_r($valor[$i]["preco"]);
                            }
                            $_SESSION['precoM'] = $preco;
                            echo"<br>";
                            echo($_SESSION['precoM']);
                            header("Location: coberturaSorvete.php");
                        }  else {
                            echo "<div class='msg-erro'>Escolha um sabor para prosseguir!</div>";
                        }
                    }
                ?>
            </form>
        </div>
    </div>
</body>
</html>
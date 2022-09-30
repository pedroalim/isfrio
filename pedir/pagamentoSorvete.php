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
        <img src="../imagens/navegador5.png" id="imgNavegador" alt="" width="450px" height="50px">
    </div>
    <div id="background">
        <div id="etapa">
            <h2>Pagamento do Sorvete</h2>
        </div>
        <div id="campo">
        <form method="post">
            <label>Preço Total: $</label>
            <?php
                session_start();
                $_SESSION['preco'] = $_SESSION["precoM"] + $_SESSION["precoC"] + $_SESSION["precoA"];
                echo "$_SESSION[preco]";
            ?>
            <br>
            <h3>Endereço para entrega:</h3>
            <br>
            <label>Bairro</label> <br>
            <input type="text" name="bairro">
            <br> 
            <label>Rua</label> <br>
            <input type="text" name="rua">
            <br>
            <label>Número</label> <br>
            <input type="text" name="numero">
            <br>
            <label>Complemento</label> <br>
            <input type="text" name="complemento">
            <?php
        
                
                if(!$_SESSION['id']){
                    header("location: login.php");
                }

                $u->conectar("isfrio", "localhost", "root", "");
                
                
                
        
            ?>
            <br>
            <br>
            <img src="../imagens/pix.png" alt="">
            <p>Chave do pix: c75a0308-da76-450d-be3c-967bc57867f7</p>
            <br>
            <br>
            <br>
                <input type="submit" value="Concluir" name="concluir" class="btnProximo">
                <?php
                    $concluir = $_POST["concluir"] = (isset($_POST["concluir"])) ? $_POST["concluir"] : null;

                    if($concluir){
                        $bairro = $_POST["bairro"] = (isset($_POST["bairro"])) ? $_POST["bairro"] : null;
                        $rua = $_POST["rua"] = (isset($_POST["rua"])) ? $_POST["rua"] : null;
                        $numero = $_POST["numero"] = (isset($_POST["numero"])) ? $_POST["numero"] : null;
                        $complemento = $_POST["complemento"] = (isset($_POST["complemento"])) ? $_POST["complemento"] : null;
                        if ($bairro != "" && $rua != "" && $numero != ""){
                            $id_pedido = $u->finalizarPedidos($bairro, $rua, $numero, $complemento, $_SESSION["preco"]);
    
                            $u->finalizarComplementos($id_pedido[0]);
                            header("location: ../home.php");
                        } else {
                            echo "<div class='msg-erro'>Preencha todos os dados</div>";
                        }
                    }
                ?>

            </form>
        </div>
    </div>
</body>
</html>

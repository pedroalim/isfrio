<?php

    require_once '../classes/isfrio.php';
    $u = new isfrio();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../styles/pedir.css">
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
            <h2>Pagamento do Sorvete</h2>
        </div>
        <div id="campo">
        <form method="post">
            <label>Preço: </label>
            <br>
            <h2>Endereço para entrega:</h2>
            <br>
            <label>Bairro</label>
            <input type="text" name="bairro">
            <br>
            <label>Rua</label>
            <input type="text" name="rua">
            <br>
            <label>Número</label>
            <input type="text" name="numero">
            <br>
            <label>Complemento</label>
            <input type="text" name="complemento">
            <?php
        
                session_start();
                if(!$_SESSION['id']){
                    header("location: login.php");
                }

                $u->conectar("isfrio", "localhost", "root", "");
                
                
                
        
            ?>
            <br>
            <p>Pagamento na entrega</p>
                <input type="submit" value="Concluir">
            </form>
        </div>
    </div>
</body>
</html>

<?php
    print_r($_SESSION['modelo']);
    echo "<br>";
    print_r($_SESSION['massas']);
    echo "<br>";
    print_r($_SESSION['coberturas']);
    echo "<br>";
    print_r($_SESSION['adicionais']);
    echo "<br>";

    $bairro = $_POST["bairro"] = (isset($_POST["bairro"])) ? $_POST["bairro"] : null;
    $rua = $_POST["rua"] = (isset($_POST["rua"])) ? $_POST["rua"] : null;
    $numero = $_POST["numero"] = (isset($_POST["numero"])) ? $_POST["numero"] : null;
    $complemento = $_POST["complemento"] = (isset($_POST["complemento"])) ? $_POST["complemento"] : null;

    if ($bairro != "" && $rua != "" && $numero != ""){
        $id_pedido = $u->finalizarPedidos($bairro, $rua, $numero, $complemento);

        $u->finalizarComplementos($id_pedido[0]);
        header("location: home.php");
    } else {
        echo "Preencha todos os dados";
    }
?>
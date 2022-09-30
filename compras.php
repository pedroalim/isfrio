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
    <link rel="stylesheet" href="styles/compras.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@700&display=swap" rel="stylesheet">
    <link rel="icon"  href="imagens/icon-isfrio.png"/>
</head>
<body>
<div class="fundo">
    <div id="superior">
        <div id="botaoLogo">
            <img src="imagens/logo.png" alt="" width="200px" height="80px">
        </div>
        <div id="botaoHome">
            <a class="navegador" href="home.php">Home</a>
        </div>
        <div id="botaoContato">
            <a class="navegador" href="contato.php">Contato</a>
        </div>
        <div id="botaoSorvete">
            <a class="navegador" href="pedir/tipoSorvete.php">Pedir Sorvete</a>
        </div>
        <div id="botaoCarrinho">
            <a href="">
                <img src="imagens/carrinho2.png" id="imagemSuperior" alt="" width="50px" height="50px">
            </a>
        </div>
        <div id="botaoPerfil">
            <a href="perfil.php">
                <img src="imagens/perfil.png" id="imagemSuperior" alt="" width="50px" height="50px">
            </a>
        </div>
    </div>
    <div id="campo">
        <h2>Histórico de pedidos: 🍨</h2>
        <?php
        $u->conectar("isfrio", "localhost", "root", "");

        $pedidos = $u->buscarPedidos();
        $quantidadePedidos = count($pedidos);
        for($i = 0; $i < $quantidadePedidos; $i++){
            echo "<br>";
            $complementos = $u->buscarComplementos($pedidos[$i]["id"]);

            $produtos = $u->buscarProdutos($complementos["id_produto"]);
            print_r('<h3>'.$produtos["nome"].'</h3>');

            $massas = $u->buscarMassas($complementos["id_massa"]);
            $qtdMassa = count($massas);
            for($m = 0; $m < $qtdMassa; $m++){
                echo "Massas: ";
                echo $massas[$m]["nome"];
                echo "<br>";     
            }
            $coberturas = $u->buscarCoberturas($complementos["id_cobertura"]);
            $qtdCobertura = count($coberturas);
            for($c = 0; $c < $qtdCobertura; $c++){
                echo "Coberturas: ";
                echo $coberturas[$c]["nome"];
                echo "<br>";     
            }
            $adicionais = $u->buscarAdicionais($complementos["id_adiconal"]);
            $qtdAdicional = count($adicionais);
            for($a = 0; $a < $qtdAdicional; $a++){
                echo "Adicionais: ";
                echo $adicionais[$a]["nome"];
                echo "<br>";     
            }
            $precoTotal = $u->buscarPrecoTotal($pedidos[$i]["id"]);
            echo "Preco Total: $ ";
            print_r($precoTotal[0]);
            echo "<br>";   
        }
        
        ?>
    </div>
</div>
</body>   

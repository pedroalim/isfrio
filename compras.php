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

    $pedidos = $u->buscarPedidos();
    $quantidadePedidos = count($pedidos);
    for($i = 0; $i < $quantidadePedidos; $i++){
        echo "<br>";
        $complementos = $u->buscarComplementos($pedidos[$i]["id"]);

        $produtos = $u->buscarProdutos($complementos["id_produto"]);
        print_r($produtos["nome"]);
        echo "<br>";

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
        echo "Preco Total: ";
        print_r($precoTotal[0]);
        echo "<br>";   
    }
    
    ?>
</body>
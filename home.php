
<?php
    session_start();
    if(!$_SESSION['id']){
        header("location: login.php");
    }
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
<div class="fundo">
    <div id="superior">
        <div id="botaoLogo">
            <img src="imagens/logo.png" alt="" width="200px" height="80px">
        </div>
        <div id="botaoHome">
            <a class="navegador" id="selecionado" href="">Home</a>
        </div>
        <div id="botaoContato">
            <a class="navegador" href="contato.php">Contato</a>
        </div>
        <div id="botaoSorvete">
            <a class="navegador" href="pedir_produto.php">Pedir Sorvete</a>
        </div>
        <div id="botaoCarrinho">
            <a href="carrinho.php">
                <img src="imagens/carrinho2.png" id="imagemSuperior" alt="" width="50px" height="50px">
            </a>
        </div>
        <div id="botaoPerfil">
            <a href="perfil.php">
                <img src="imagens/perfil.png" id="imagemSuperior" alt="" width="50px" height="50px">
            </a>
        </div>
    </div>
    <div class="fundo">
        <img src="imagens/famosos.png" id="famosos" alt="" width="530px" height="67px">
        <img src="imagens/sorveteFamoso.png" alt="" width="100%" height="600px">

        <h2>Escolha as opções:</h2>
        <div id="opcoes">
            <div id="opcao1">
                <img src="imagens/opcao1.png" alt="">
            </div>
            <div id="opcao2">
                <img src="imagens/opcao2.png" alt="">
            </div>
            <div id="opcao3">
                <img src="imagens/opcao3.png" alt="">
            </div>
        </div>
    </div>
</div>
</body>


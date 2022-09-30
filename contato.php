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
    <link rel="stylesheet" href="styles/contato1.css">
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
            <a class="navegador" id="selecionado" href="">Contato</a>
        </div>
        <div id="botaoSorvete">
            <a class="navegador" href="pedir/tipoSorvete.php">Pedir Sorvete</a>
        </div>
        <div id="botaoCarrinho">
            <a href="compras.php">
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
        <h2>Isfrio Contato</h2>
        <br>
        <h3><img src="imagens/iconZap.png" width="50px" height="50px">(14)70404-1237</h3> <br>
        <h3 id="email"><img src="imagens/iconEmail.png" width="50px" height="50px">Isfrio.sorvetes@gmail.com</h3> <br>
        <h3><img src="imagens/iconLocalizacao.png" width="50px" height="50px">São Paulo, Ourinhos | Praça Mello Peixoto </h3>
    </div>
</div>
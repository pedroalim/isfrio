<?php

    require_once 'classes/isfrio.php';
    $u = new isfrio();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Isfrio</title>
    <link rel="stylesheet" href="styles/entrar1.css">
    <link rel="icon"  href="imagens/icon-isfrio.png"/>
</head>
<body>
<div id="fundo">
    <div id="superior">
        <div id="logo">
        <img src="imagens/logo.png" alt="" width="200px" height="80px">
        </div>
        <div id="botao">
        <a id="botaoCriar" href="login.php">Entrar</a>
        </div>
    </div>
        <div id="formulario">
            <div id="forms">
                    <form method="POST">
                    <input type="text" class="entrar" placeholder="🥼 Nome" name="nome">
                    <br>
                    <input class="entrar" type="email" placeholder="📧 Email" name="email">
                    <br>
                    <input class="entrar" type="password" placeholder="🔒 Senha" name="senha">
                    <br>
                    <input class="entrar" id="entrar" type="submit" value="Criar">
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php
if(isset($_POST['nome'])):
    
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);

    if(!empty($nome) &&!empty($email) && !empty($senha)):
        
        $u->conectar("isfrio", "localhost", "root", "");

        if($u-> msgERRO == ""):

            
           
                if($u->cadastrar($nome, $email, $senha)):
                    header("location: home.php");
                    ?>

                    <?php
                
                else:

                    ?>

                    <div class="msg-erro">
                        Email já cadastrado!
                    </div>

                    <?php

                endif;

        else:

            ?>
           
            <div class="msg-erro"> 
                
                 <?php echo "Erro: ".$u->msgERRO; ?>
            
            </div>

            <?php

        endif;
    
    else:
        ?>

            <div class="msg-erro">
                Preencha Todos os Campos!
            </div>

        <?php

    endif;

endif;
?>
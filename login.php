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
</head>
<body>
<div id="fundo">
    <div id="superior">
        <div id="logo">
        <img src="imagens/logo.png" alt=""  alt="" width="200px" height="80px">
        </div>
        <div id="botao">
            <a id="botaoCriar" href="cadastro.php">Criar Conta</a>
        </div>
    </div>
        <div id="formulario">
            <div id="forms">
                    <form method="POST">
                    <input class="entrar" type="email" placeholder="📧 Email" name="email">
                    <br>
                    <input class="entrar" type="password" placeholder="🔒 Senha" name="senha">
                    <br>
                    <input class="entrar" id="entrar" type="submit" value="Entrar">
                    <?php

                        if(isset($_POST['email'])):
                            
                            $email = addslashes($_POST['email']);
                            $senha = addslashes($_POST['senha']);

                            if(!empty($email) && !empty($senha)):

                                $u->conectar("isfrio", "localhost", "root", "");

                                if($u->msgERRO == ""):

                                    if($u->logar($email, $senha)):

                                        header("location: home.php");

                                
                                    else: 

                                        ?>

                                        <div class="msg-erro">
                                            E-mail e/ou Senha Incorretos!
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
                </form>
            </div>
        </div>
    </div>
</body>
</html>


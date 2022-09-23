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
            <h2>Massa do Sorvete</h2>
        </div>
        <div id="campo">
        <form method="post">
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
                        $nome 
                        <input type='checkbox' name='massas[]' value='$id'>
                    <br>
                    ";
                }
        
            ?>
                <input type="submit" value="Proximo">
            </form>
        </div>
    </div>
</body>
</html>

<?php
    $massas = $_POST["massas"] = (isset($_POST["massas"])) ? $_POST["massas"] : null;
    $massas = implode(",", $massas);
    $_SESSION['massas'] = $massas;
    print_r($_SESSION['massas']);

    if ($_SESSION['massas'] != 0) {
        header("Location: coberturaSorvete.php");
    } 
?>
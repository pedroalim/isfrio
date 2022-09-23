<?php

class isfrio{

    private $pdo; 
    public $msgERRO = "";

    public function conectar($nome, $host, $usuario, $senha){

        global $pdo;
        global $msgERRO;

        try{
            $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);

        }
        catch (PDOException $e){
            $msgERRO = $e->getMessage();

        }
    }

    public function cadastrar($nome, $email, $senha){
        
        global $pdo;
        $sql = $pdo->prepare("SELECT id FROM usuarios WHERE email = :e");
        $sql-> bindValue(":e", $email);
        $sql-> execute();

        if ($sql->rowCount()>0):
            
            return false; 
        
        else:

        $sql = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:n, :e, :s)");
        $sql-> bindValue(":n", $nome);
        $sql-> bindValue(":e", $email);
        $sql-> bindValue(":s", md5($senha));

        $sql->execute();
        return true;

        endif;
    }
    
    public function logar($email, $senha){

        global $pdo;

        $sql= $pdo->prepare("SELECT id FROM usuarios WHERE email = :e AND senha = :s");

        $sql-> bindValue(":e", $email);
        $sql-> bindValue(":s", md5($senha));
        $sql-> execute();

        if($sql->rowCount()==1):
            $dado = $sql->fetch();
            session_start();
            $_SESSION['id'] = $dado['id'];
            return true; //logado com Sucesso

        else:
            return false;

        endif;

    }

    public function procurarProdutos(){

        global $pdo;

        $sql= $pdo->prepare("SELECT * FROM produtos");

        $sql-> execute();

        if($sql->rowCount()>0):
            $dados = $sql->fetchAll();
           
            return $dados; //logado com Sucesso

        else:
            return [];

        endif;

    }

    public function procurarMassas(){

        global $pdo;

        $sql= $pdo->prepare("SELECT * FROM massas");

        $sql-> execute();

        if($sql->rowCount()>0):
            $dados = $sql->fetchAll();
           
            return $dados; //logado com Sucesso

        else:
            return [];

        endif;

    }

    public function procurarCoberturas(){

        global $pdo;

        $sql= $pdo->prepare("SELECT * FROM coberturas");

        $sql-> execute();

        if($sql->rowCount()>0):
            $dados = $sql->fetchAll();
           
            return $dados; //logado com Sucesso

        else:
            return [];

        endif;

    }

    
    public function procurarAdiconais(){

        global $pdo;

        $sql= $pdo->prepare("SELECT * FROM adicionais");

        $sql-> execute();

        if($sql->rowCount()>0):
            $dados = $sql->fetchAll();
           
            return $dados; //logado com Sucesso

        else:
            return [];

        endif;

    }

    public function finalizarPedidos($bairro, $rua, $numero, $complemento){
        global $pdo;
        
        $sql = $pdo->prepare("INSERT INTO pedidos (id_usuario, bairro, rua, numero, complemento) VALUES (:u, :b, :r, :n, :c)");
        $sql-> bindValue(":u", $_SESSION['id']);
        $sql-> bindValue(":b", $bairro);
        $sql-> bindValue(":r", $rua);
        $sql-> bindValue(":n", $numero);
        $sql-> bindValue(":c", $complemento);
        $sql->execute();

        $sql = $pdo->prepare("SELECT LAST_INSERT_ID()");
        $sql->execute();
        $id = $sql->fetch();

        return $id;
    }

    public function finalizarComplementos($id_pedido){
        global $pdo;
        
        $sql = $pdo->prepare("INSERT INTO pedidos_complementos (id_produto, id_cobertura, id_massa, id_adiconal, id_pedido) VALUES (:p, :c, :m, :a, :i)");
        $sql-> bindValue(":p", $_SESSION['modelo']);
        $sql-> bindValue(":m", $_SESSION['massas']);
        $sql-> bindValue(":c", $_SESSION['coberturas']);
        $sql-> bindValue(":a", $_SESSION['adicionais']);
        $sql-> bindValue(":i", $id_pedido);
        $sql->execute();
        return true;

    }

    public function buscarProdutos(){
        global $pdo;
        $sql = $pdo->prepare("SELECT nome FROM produtos WHERE id = :a");
        $sql-> bindValue(":a", $_SESSION['modelo']);
        $sql-> execute();

        if($sql->rowCount()>0){
            $dados = $sql->fetch();
           
            return $dados; 
        }
    }

    public function buscarMassas(){
        $massasEx = explode(",", $_SESSION['massas']);
        
        for($i = 0; $i < 2; $i++){
            global $pdo;
            $sql = $pdo->prepare("SELECT nome, preco FROM massas WHERE id = :m");
            $sql-> bindValue(":m", $massasEx[$i]);
            $sql-> execute();

            if($sql->rowCount()>0){
                $dados = $sql->fetch();
                print_r($dados);
                
            }
        } 

    }

}

?>
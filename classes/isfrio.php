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
}

?>
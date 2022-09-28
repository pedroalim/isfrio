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

    public function buscarPrecosMassas($massas){
        $massasEx = explode(",", $massas);
        $quantidadeMassas = count($massasEx);
	 	
        $valorM = [];
        for($i = 0; $i < $quantidadeMassas; $i++){
            global $pdo;
            $sql = $pdo->prepare("SELECT preco FROM massas WHERE id = :m");
            $sql-> bindValue(":m", $massasEx[$i]);
            $sql-> execute();

            if($sql->rowCount()>0){
                $dados = $sql->fetch();
                array_push($valorM, $dados);
            }
        } 
        return $valorM;
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

    public function buscarPrecosCoberturas($coberturas){
        $coberturasEx = explode(",", $coberturas);
        $quantidadeCoberturas= count($coberturasEx);
	 	
        $valorC = [];
        for($i = 0; $i < $quantidadeCoberturas; $i++){
            global $pdo;
            $sql = $pdo->prepare("SELECT preco FROM coberturas WHERE id = :m");
            $sql-> bindValue(":m", $coberturasEx[$i]);
            $sql-> execute();

            if($sql->rowCount()>0){
                $dados = $sql->fetch();
                array_push($valorC, $dados);
            }
        } 
        return $valorC;
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

    public function buscarPrecosAdicionais($adicionais){
        $adicionaisEx = explode(",", $adicionais);
        $quantidadeAdicionais = count($adicionaisEx);
	 	
        $valorA = [];
        for($i = 0; $i < $quantidadeAdicionais; $i++){
            global $pdo;
            $sql = $pdo->prepare("SELECT preco FROM adicionais WHERE id = :m");
            $sql-> bindValue(":m", $adicionaisEx[$i]);
            $sql-> execute();

            if($sql->rowCount()>0){
                $dados = $sql->fetch();
                array_push($valorA, $dados);
            }
        } 
        return $valorA;
    }

    public function finalizarPedidos($bairro, $rua, $numero, $complemento, $preco){
        global $pdo;
        
        $sql = $pdo->prepare("INSERT INTO pedidos (id_usuario, bairro, rua, numero, complemento, preco) VALUES (:u, :b, :r, :n, :c, :p)");
        $sql-> bindValue(":u", $_SESSION['id']);
        $sql-> bindValue(":b", $bairro);
        $sql-> bindValue(":r", $rua);
        $sql-> bindValue(":n", $numero);
        $sql-> bindValue(":c", $complemento);
        $sql-> bindValue(":p", $preco);
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

    public function buscarPedidos(){
        global $pdo;
        $sql = $pdo->prepare("SELECT * FROM pedidos WHERE id_usuario = :u");
        $sql-> bindValue(":u", $_SESSION['id']);
        $sql-> execute();

        if($sql->rowCount()>0){
            $dados = $sql->fetchAll();
            
            return $dados; 
        }
    }

    public function buscarComplementos($id_pedido){
        global $pdo;
        $sql = $pdo->prepare("SELECT * FROM pedidos_complementos WHERE id_pedido = :i");
        $sql-> bindValue(":i", $id_pedido);
        $sql-> execute();

        if($sql->rowCount()>0){
            $dados = $sql->fetch();
            
            return $dados; 
        }
    }


    public function buscarProdutos($produto){
        global $pdo;
        $sql = $pdo->prepare("SELECT nome FROM produtos WHERE id = :a");
        $sql-> bindValue(":a", $produto);
        $sql-> execute();

        if($sql->rowCount()>0){
            $dados = $sql->fetch();
            
            return $dados; 
        }
    }

    public function buscarMassas($massa){
        $massasEx = explode(",", $massa);
        $quantidadeMassas = count($massasEx);
	 	
        $arrayM = [];
        for($i = 0; $i < $quantidadeMassas; $i++){
            global $pdo;
            $sql = $pdo->prepare("SELECT nome, preco FROM massas WHERE id = :m");
            $sql-> bindValue(":m", $massasEx[$i]);
            $sql-> execute();

            if($sql->rowCount()>0){
                $dados = $sql->fetch();
                array_push($arrayM, $dados);
            }
        } 
        return $arrayM;

    }
	
	public function buscarCoberturas($cobertura){
        $coberturasEx = explode(",", $cobertura);
        $quantidadeCoberturas = count($coberturasEx);
		
        $arrayC = [];
        for($i = 0; $i < $quantidadeCoberturas; $i++){
            global $pdo;
            $sql = $pdo->prepare("SELECT nome, preco FROM coberturas WHERE id = :m");
            $sql-> bindValue(":m", $coberturasEx[$i]);
            $sql-> execute();

            if($sql->rowCount()>0){
                $dados = $sql->fetch();
                array_push($arrayC, $dados);
            }
        } 
        return $arrayC;
    }
	
		public function buscarAdicionais($adicionais){
        $adicionaisEx = explode(",", $adicionais);
        $quantidadeAdicionais = count($adicionaisEx); 

        $arrayA = [];
        for($i = 0; $i < $quantidadeAdicionais; $i++){
            global $pdo;
            $sql = $pdo->prepare("SELECT nome, preco FROM adicionais WHERE id = :m");
            $sql-> bindValue(":m", $adicionaisEx[$i]);
            $sql-> execute();

            if($sql->rowCount()>0){
                $dados = $sql->fetch();
                array_push($arrayA, $dados);
                
            }
        } 
        return $arrayA;
    }

    public function buscarPrecoTotal($id_pedido){
        global $pdo;
        $sql = $pdo->prepare("SELECT preco FROM pedidos WHERE id = :i");
        $sql-> bindValue(":i", $id_pedido);
        $sql-> execute();

        if($sql->rowCount()>0){
            $dados = $sql->fetch();
            return $dados;
            
        }
    }

    public function buscarCliente(){
        
        global $pdo;
        $sql = $pdo->prepare("SELECT nome, email FROM usuarios WHERE id = :i");
        $sql-> bindValue(":i", $_SESSION['id']);
        $sql-> execute();

        if($sql->rowCount()>0){
            $dados = $sql->fetch();
            
            return $dados; 
        } 
    }
    
    public function atualizarCliente($nome, $email){

        global $pdo;
        $sql = $pdo->prepare("UPDATE usuarios SET nome = :n, email = :e WHERE id = :i");
        $sql-> bindValue(":i", $_SESSION['id']);
        $sql-> bindValue(":n", $nome);
        $sql-> bindValue(":e", $email);
        $sql-> execute();

        return;
    }

    public function deletarCliente(){

        global $pdo;
        $sql = $pdo->prepare("DELETE FROM usuarios WHERE id = :i");
        $sql-> bindValue(":i", $_SESSION['id']);
        $sql-> execute();

        return;
    }

    public function buscarFoto(){
        global $pdo;
        $sql = $pdo->prepare("SELECT imagem FROM usuarios WHERE id = :i");
        $sql-> bindValue(":i", $_SESSION['id']);
        $sql-> execute();

        $dados = $sql->fetch();
            
        return $dados; 
    }

    public function adicionarFoto($imagem){
        global $pdo;
        $sql = $pdo->prepare("UPDATE usuarios SET imagem = :m WHERE id = :i");
        $sql-> bindValue(":i", $_SESSION['id']);
        $sql-> bindValue(":m", $imagem);
        $sql-> execute();

        return;
    }

}

?>
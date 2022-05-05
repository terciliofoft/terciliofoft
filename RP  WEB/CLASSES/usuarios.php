<?php
Class Usuario
{
    private $pdo;
    public $msgErro = "";//tudo certo
    
    public function conectar($nome, $host, $usuario, $senha)
    {
            global $pdo;
            try 
            {
                $pdo = new PDO("mySql:dbname=".$nome.";host=".$host,
                $usuario,$senha);
            } catch (PDOException $e) {
                $msgErro = $e->getMessage();
            }    
    }
    public function cadastrar($Nome, $celular, $email, $senha, $confsenha)
    {
            global $pdo;
            //verificar se ja existe o email cadastrado
            $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
            $sql->bindValue(":e",$email);
            $sql->execute();
            if($sql->rowCount() > 0)
            {
                return false; // ja esta cadastrado
            }
            else
            {
            //caso nao, cadastrar
            $sql = $pdo->prepare("INSERT INTO usuarios(nome completo,
                Celular,email,senha) VALUES (:n, :c, :e, :s)");
            $sql->bindValue(":n",$nome);
            $sql->bindValue(":c",$celular);
            $sql->bindValue(":e",$email);
            $sql->bindValue(":s",md5($senha));
            $sql->execute();
            return true;//tudo ok
        }
    }
    public function login($email, $senha)
    {
        global $pdo;
        //verificar se o email e senha estao cadastrados, se sim
        $sql = $pdo-> prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND 
        senha :s");
        $sql->bindValue(":e",$email);
        $sql->bindValue(":s",md5($senha));
        $sql->execute();
        if($sql->rowCount() > 0)
        {
            //entrar no sistema(sessao)
            $dado = $sql->fetch();
            session_start();
            $_SESSION['id_usuario'] = $dado['id_usuario'];
            return true; // login com sucesso
        }
        else
        {
            return false; // nao foi possivel fazer login     
        }
    }
}

?>
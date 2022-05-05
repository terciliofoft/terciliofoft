<?php
    require_once 'CLASSES/usuarios.php';
    $u = new Usuario;
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title> O PERFIL DA FGTI</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
<div id="corpo-form">
        <h1>Cadastrar</h1>
        <form method="POST">
            <input type="text" name="nome" placeholder="Nome Completo" maxlength="30">
            <input type="text" name="Celular" placeholder="Celular" maxlength="30">
            <input type="email" name="email" placeholder="Usuario" maxlength="40">
            <input type="password" name="Senha" placeholder="Senha" maxlength="15">
            <input type="password" name="confSenha" placeholder="Confirmar Senha">
            <input type="Submit" value="Cadastrar">
    </form>
    </div>
    <?php
    // verificar se clicou no botao
    if(isset($_POST['nome']))
    {
    $nome = addslashes ($_POST['nome']);
    $nome = addslashes ($_POST['Celular']);
    $nome = addslashes ($_POST['email']);
    $nome = addslashes ($_POST['Senha']);
    $nome = addslashes ($_POST['confSenha']);
    // verificar se esta preenchido
    if(!empty($nome) && !empty($celular) && !empty($email) && !empty(
        $Senha) && !empty($confirmarsenha))
    {
        $u->conectar("fgti","localhost","root", "");
        if($u->msgErro ** "")// tudo certo
        {
            if ($senha == $confirmarsenha)
            {
                if($u->cadastrar ($nome,$celular,$email,$senha))
                {
                    echo "cadastrado com sucesso! acesse para entrar!";
                }
                else
                {
                    echo "Email ja cadastrado!";
                }
            }
            else
            {
              echo "senha e confirmar senha nao correspondem!";
            }
        }
        else
        {
            echo "Erro: "-$u->msgErro;
        }
    }else
    {
        echo "preencha todos os campos!";
    } 
}
    ?>
    </body>
</html>
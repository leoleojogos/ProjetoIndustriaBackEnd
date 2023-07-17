<?php
$conectar = mysql_connect('localhost','root','');
$banco    = mysql_select_db('industria');

?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Pesquisa Funcionarios </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="estilo.css">

</head>

<body>
    <script>

        function obterDadosModal(valor) {

            var retorno = valor.split("*");

            document.getElementById('cod').value   = retorno[0];
            document.getElementById('nome').value  = retorno[1];
            document.getElementById('login').value = retorno[2];
            document.getElementById('senha').value = retorno[3];
        }

    </script>
    <!--Modal Cadastrar-->
    <div class="modal fade" id="myModalCadastrar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content bile">
                <div class="modal-header">
                    <h1>Cadastrar um registro ...</h1>
                </div>
                <div class="modal-body">
                    <!--- Modal com form para se fazer cadastro  -->
                    <form class="form-group well" action="funcionarios.php" method="POST">
                        <input type="text" name="cod" class="span3" value="" required placeholder="Cod" style=" margin-bottom: -2px; height: 25px;">
                        <input type="text" name="nome" class="span3" value="" required placeholder="Nome" style=" margin-bottom: -2px; height: 25px;"><br><br>
                        <input type="text" name="login" class="span3" value="" required placeholder="Login" style=" margin-bottom: -2px; height: 25px;">
                        <input type="text" name="senha" class="span3" value="" required placeholder="Senha" style=" margin-bottom: -2px; height: 25px;"><br><br>
                        <button type="submit" class="btn btn-success btn-large bile" name="cadastrar" style="height: 35px">Cadastrar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>


    <!--Modal Alterar-->
    <div class="modal fade" id="myModalAlterar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">

            <div class="modal-content bile2">
                <div class="modal-header">
                    <h1>Alterar Registro...</h1>
                </div>
                <div class="modal-body">
                    <!--- Modal com form para se fazer alteracao -->
                    <form class="form-group well" action="funcionarios.php" method="POST">
                        Cod   <input id="cod" type="text" name="cod" value="" required>
                        Nome  <input id="nome" type="text" name="nome" class="span3" required value="" style=" margin-bottom: -2px; height: 25px;"><br><br>
                        Login <input id="login" type="text" name="login" class="span3" required value="" style=" margin-bottom: -2px; height: 25px;">
                        Senha <input id="senha" type="text" name="senha" class="span3" required value="" style=" margin-bottom: -2px; height: 25px;"><br><br>
                        <button type="submit" class="btn btn-success btn-large bile2" name="alterar" style="height: 35px">Alterar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    
    <!--Modal Excluir-->
    <div class="modal fade" id="myModalExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">

            <div class="modal-content bile">
                <div class="modal-header">
                    <h1>Excluir Registro...</h1>
                </div>
                <div class="modal-body">
                    <!--- Modal com form para excluir -->
                    <form class="form-group well" action="funcionarios.php" method="POST">
                        Cod   <input id="cod" type="text" name="cod" value="" required>
                        Nome  <input id="nome" type="text" name="nome" class="span3" required value="" style=" margin-bottom: -2px; height: 25px;"><br><br>
                        Login <input id="login" type="text" name="login" class="span3" required value="" style=" margin-bottom: -2px; height: 25px;">
                        Senha <input id="senha" type="text" name="senha" class="span3" required value="" style=" margin-bottom: -2px; height: 25px;"><br><br>
                        <button type="submit" class="btn btn-success btn-large bile" name="excluir" style="height: 35px">Excluir</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">

            <h2>Pesquisa Funcionarios: </h2><br>
            <form action="funcionarios.php" method="POST">
                <input type="text" name="nome" placeholder="Nome Funcionario..." class="span4" style="margin-bottom: -2px; height: 25px;">
                <button type="submit" name="pesquisar" class="btn btn-large" style="height: 35px;">Pesquisar</button>
                <a href="#myModalCadastrar">
                <button type="button" name="cadastrar" class="btn btn-primary bile" data-toggle="modal" data-target="#myModalCadastrar">Cadastrar</button></a>
            </form>
            <table border="1px" bordercolor="gray" class="table table-stripped">
                <tr>
                    <td><b>Cod</b></td>
                    <td><b>Nome</b></td>
                    <td><b>Login</b></td>
                    <td><b>Senha</b></td>
                    <td><b>Operacao</b></td>
                </tr>
                  <?php
                  
                  if (isset($_POST['cadastrar']))
                {
                    $cod   = $_POST['cod'];
                    $nome  = $_POST['nome'];
                    $login = $_POST['login'];
                    $senha = $_POST['senha'];

                    $sql = "insert into funcionarios (cod, nome, login, senha)
                            values ('$cod','$nome','$login','$senha')";
                     $resultado = mysql_query($sql);
                }
                if (isset($_POST['alterar']))
                {
                    $cod   = $_POST['cod'];
                    $nome  = $_POST['nome'];
                    $login = $_POST['login'];
                    $senha = $_POST['senha'];

                    $sql = "update funcionarios set nome = '$nome', login = '$login', senha = '$senha'
                            where cod = '$cod'";
                    $resultado = mysql_query($sql);
                }
                if (isset($_POST['excluir']))
                {
                    $cod   = $_POST['cod'];
                    $nome  = $_POST['nome'];
                    $login = $_POST['login'];
                    $senha = $_POST['senha'];

                    $sql = "delete from funcionarios where cod = '$cod'";
                    $resultado = mysql_query($sql);
                }

                if (isset($_POST['pesquisar']))
                {
                   $nome   = strtoupper($_POST['nome']);    // converter maiuscula

                   $consulta = "select cod,nome,login,senha from funcionarios
                                where UPPER(nome) like '%$nome%'";

                   $resultado = mysql_query($consulta);
                }
                else
                {
                    $consulta = "select cod,nome,login,senha from funcionarios";
                    $resultado = mysql_query($consulta);
                }

                while ($dados = mysql_fetch_array($resultado))
                {
                    $strdados = $dados['cod'] . "*" .  $dados['nome'] . "*" . $dados['login'] . "*" . $dados['senha'];
                ?>
                    <tr>
                        <td><?php echo $dados['cod']; ?></td>
                        <td><?php echo $dados['nome']; ?></td>
                        <td><?php echo $dados['login']; ?></td>
                        <td><?php echo $dados['senha']; ?></td>
                        <td>
                            <button onclick="obterDadosModal('<?php echo $strdados ?>')" type='button' id='excluir' name='excluir' class='btn btn-danger bile' data-toggle='modal' data-target='#myModalExcluir'>Excluir</button>
                            <button onclick="obterDadosModal('<?php echo $strdados ?>')" type='button' id='alterar' name='alterar' class='btn btn-primary bile2' data-toggle='modal' data-target='#myModalAlterar'>Alterar</button>
                            
                        </td>
                    </tr>
                <?php
                }
                mysql_close($conectar);
                ?>
            </table>
        </div>
    </div>
    <!-- Biblioteca requerida -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>

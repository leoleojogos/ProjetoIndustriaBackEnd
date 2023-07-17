<?php
$conectar = mysql_connect('localhost', 'root', '');
$banco = mysql_select_db('industria');

//------- pesquisa funcionarios
$sql_funcionarios = "SELECT cod,nome FROM funcionarios";
$res_funcionarios = mysql_query($sql_funcionarios);

//------- pesquisa clientes
$sql_clientes = "SELECT cod,nome FROM clientes";
$res_clientes = mysql_query($sql_clientes);

//------- pesquisa produtos
$sql_produtos = "SELECT cod,nome FROM produtos";
$res_produtos = mysql_query($sql_produtos);

?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
    <title>Pedidos </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="estilo.css">

</head>

<body>
    <script>

        /*
        document.getElementById('cod').value vira simplesmente $("#cod").val()
        */

        function obterDadosModal(valor) {

            var retorno = valor.split("*");

            document.getElementById('cod').value = retorno[0];
            document.getElementById('datapedido').value = retorno[1];
            document.getElementById('codfunc').value = retorno[2];
            document.getElementById('codcli').value = retorno[3];
            document.getElementById('codpro').value = retorno[4];
            document.getElementById('quantidade').value = retorno[5];
            document.getElementById('preco').value = retorno[6];
        }

    </script>
    <!--Modal Cadastrar-->
    <div class="modal fade" id="myModalCadastrar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content bile">
                <div class="modal-header">
                    <h1>Cadastrar Pedido ...</h1>
                </div>
                <div class="modal-body">
                    <!--- Modal com form para se fazer cadastro  -->
                    <form class="form-group well" action="pedidos.php" method="POST">
                        Cod <input type="text" name="cod" id="cod" class="span3" value="" size=10 required
                            placeholder="Cod" style=" margin-bottom: -2px; height: 25px;">
                        Data <input type="date" name="datapedido" id="datapedido" class="span3" value="" required
                            placeholder="Data" style=" margin-bottom: -2px; height: 25px;"><br><br>
                        Funcionario: <select name="codfunc" id="codfunc" class="span3"
                            style=" margin-bottom: -2px; height: 25px;">
                            <option value=0 selected="selected">Funcionarios ...</option>
                            <?php
                            while ($resultado = mysql_fetch_array($res_funcionarios)) {
                                echo '<option value="' . $resultado['cod'] . '">' .
                                    utf8_encode($resultado['nome']) . '</option>';
                            }
                            ?>
                        </select>
                        Cliente: <select name="codcli" id="codcli" class="span3"
                            style=" margin-bottom: -2px; height: 25px;">
                            <option value=0 selected="selected">Clientes ...</option>
                            <?php
                            while ($resultado = mysql_fetch_array($res_clientes)) {
                                echo '<option value="' . $resultado['cod'] . '">' .
                                    utf8_encode($resultado['nome']) . '</option>';
                            }
                            ?>
                        </select><br><br>
                        Produto: <select name="codprod" id="codprod" class="span3"
                            style=" margin-bottom: -2px; height: 25px;">
                            <option value=0 selected="selected">Produtos ...</option>
                            <?php
                            while ($resultado = mysql_fetch_array($res_produtos)) {
                                echo '<option value="' . $resultado['cod'] . '">' .
                                    utf8_encode($resultado['nome']) . '</option>';
                            }
                            ?>
                        </select>
                        Quantidade <input type="text" name="quantidade" id="quantidade" class="span3" value="" required
                            placeholder="Quantidade" style=" margin-bottom: -2px; height: 25px;"><br><br>
                        Preco <input type="text" name="preco" id="preco" class="span3" value="" required
                            placeholder="Preco" style=" margin-bottom: -2px; height: 25px;"><br><br>
                        <button type="submit" class="btn btn-success btn-large bile" name="cadastrar"
                            style="height: 35px">Cadastrar</button>
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
            <div class="modal-content bile">
                <div class="modal-header">
                    <h1>Alterar Pedido...</h1>
                </div>
                <div class="modal-body">
                    <!--- Modal com form para se fazer alteracao -->
                    <form class="form-group well" action="pedidos.php" method="POST">
                        Cod <input type="text" name="cod" id="cod" value="" required size=10>
                        Data <input type="date" name="datapedido" id="datapedido" class="span3" value="" required
                            placeholder="Data" style=" margin-bottom: -2px; height: 25px;"><br><br>
                        Funcionario: <select name="codfunc" id="codfunc" class="span3"
                            style=" margin-bottom: -2px; height: 25px;">
                            <option value=0 selected="selected">Funcionarios ...</option>
                            <?php
                            //------- pesquisa funcionarios
                            $sql_funcionarios = "SELECT cod,nome FROM funcionarios";
                            $res_funcionarios = mysql_query($sql_funcionarios);

                            while ($resultado = mysql_fetch_array($res_funcionarios)) {
                                echo '<option value="' . $resultado['cod'] . '">' .
                                    utf8_encode($resultado['nome']) . '</option>';
                            }
                            ?>
                        </select>
                        Cliente: <select name="codcli" id="codcli" class="span3"
                            style=" margin-bottom: -2px; height: 25px;">
                            <option value=0 selected="selected">Clientes ...</option>
                            <?php
                            //------- pesquisa clientes
                            $sql_clientes = "SELECT cod,nome FROM clientes";
                            $res_clientes = mysql_query($sql_clientes);

                            while ($resultado = mysql_fetch_array($res_clientes)) {
                                echo '<option value="' . $resultado['cod'] . '">' .
                                    utf8_encode($resultado['nome']) . '</option>';
                            }
                            ?>
                        </select><br><br>
                        Produto: <select name="codprod" id="codprod" class="span3"
                            style=" margin-bottom: -2px; height: 25px;">
                            <option value=0 selected="selected">Produtos ...</option>
                            <?php
                            //------- pesquisa produtos
                            $sql_produtos = "SELECT cod,nome FROM produtos";
                            $res_produtos = mysql_query($sql_produtos);

                            while ($resultado = mysql_fetch_array($res_produtos)) {
                                echo '<option value="' . $resultado['cod'] . '">' .
                                    utf8_encode($resultado['nome']) . '</option>';
                            }
                            ?>
                        </select>
                        Quantidade <input type="text" name="quantidade" id="quantidade" class="span3" value="" required
                            placeholder="Quantidade" style=" margin-bottom: -2px; height: 25px;"><br><br>
                        Preco <input type="text" name="preco" id="preco" class="span3" value="" required
                            placeholder="Preco" style=" margin-bottom: -2px; height: 25px;"><br><br>
                        <button type="submit" class="btn btn-success btn-large bile" name="alterar"
                            style="height: 35px">Alterar</button>
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
            <div class="modal-content bile2">
                <div class="modal-header">
                    <h1>Excluir Pedido...</h1>
                </div>
                <div class="modal-body">
                    <!--- Modal com form para excluir -->
                    <form class="form-group well" action="pedidos.php" method="POST">
                        Cod <input id="cod" type="text" name="cod" value="" required size=10>
                        Data <input type="date" name="datapedido" id="datapedido" class="span3" value=""
                            placeholder="Data" style=" margin-bottom: -2px; height: 25px;"><br><br>
                        Funcionario <input type="text" name="codfunc" id="codfunc" class="span3" value=""
                            placeholder="Funcionario" style=" margin-bottom: -2px; height: 25px;">
                        Cliente <input type="text" name="codcli" id="codcli" class="span3" value=""
                            placeholder="Cliente" style=" margin-bottom: -2px; height: 25px;"><br><br>
                        Produto <input type="text" name="codprod" id="codprod" class="span3" value=""
                            placeholder="Produto" style=" margin-bottom: -2px; height: 25px;">
                        Quantidade <input type="text" name="quantidade" id="quantidade" class="span3" value=""
                            placeholder="Quantidade" style=" margin-bottom: -2px; height: 25px;"><br><br>
                        Preco <input type="text" name="preco" id="preco" class="span3" value="" placeholder="Preco"
                            style=" margin-bottom: -2px; height: 25px;"><br><br>
                        <button type="submit" class="btn btn-success btn-large bile2" name="excluir"
                            style="height: 35px">Excluir</button>
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

            <h2>Pesquisa Pedidos: </h2><br>
            <form action="pedidos.php" method="POST">
                <input type="text" name="cod" id="cod" placeholder="Cod pedido..." size=10 class="span4"
                    style="margin-bottom: -2px; height: 25px;">
                <input type="date" name="datapedido" id="datapedido" placeholder="Data pedido..." class="span4"
                    style="margin-bottom: -2px; height: 25px;">
                <button type="submit" name="pesquisar" class="btn btn-large" style="height: 35px;">Pesquisar</button>
                <a href="#myModalCadastrar">
                    <button type="button" name="cadastrar" class="btn btn-primary bile" data-toggle="modal"
                        data-target="#myModalCadastrar">Cadastrar</button></a>
            </form>
            <table border="1px" bordercolor="gray" class="table table-stripped">
                <tr>
                    <td><b>Cod</b></td>
                    <td><b>Data</b></td>
                    <td><b>Funcionario</b></td>
                    <td><b>Cliente</b></td>
                    <td><b>Produto</b></td>
                    <td><b>Qtde</b></td>
                    <td><b>Preco</b></td>
                    <td><b>Operacao</b></td>
                </tr>
                <?php
                if (isset($_POST['cadastrar'])) {
                    $cod = $_POST['cod'];
                    $datapedido = $_POST['datapedido'];
                    $codfunc = $_POST['codfunc'];
                    $codcli = $_POST['codcli'];
                    $codprod = $_POST['codprod'];
                    $quantidade = $_POST['quantidade'];
                    $preco = $_POST['preco'];

                    $sql = "insert into pedidos (cod, datapedido, codfunc, codcli, codprod, quantidade, preco)
                            values ('$cod','$datapedido','$codfunc','$codcli','$codprod','$quantidade','$preco')";
                    $resultado = mysql_query($sql);
                }
                if (isset($_POST['alterar'])) {
                    $cod = $_POST['cod'];
                    $datapedido = $_POST['datapedido'];
                    $codfunc = $_POST['codfunc'];
                    $codcli = $_POST['codcli'];
                    $codprod = $_POST['codprod'];
                    $quantidade = $_POST['quantidade'];
                    $preco = $_POST['preco'];

                    $sql = "update pedidos set datapedido = '$datapedido', codfunc = '$codfunc', codcli = '$codcli',
                                               codprod = '$codprod', quantidade = '$quantidade', preco = '$preco'
                            where cod = '$cod'";
                    $resultado = mysql_query($sql);
                }
                if (isset($_POST['excluir'])) {
                    $cod = $_POST['cod'];
                    $datapedido = $_POST['datapedido'];
                    $codfunc = $_POST['codfunc'];
                    $codcli = $_POST['codcli'];
                    $codprod = $_POST['codprod'];
                    $quantidade = $_POST['quantidade'];
                    $preco = $_POST['preco'];

                    $sql = "delete from pedidos where cod = '$cod'";
                    $resultado = mysql_query($sql);
                }

                if (isset($_POST['pesquisar'])) {
                    $cod = $_POST['cod'];
                    $datapedido = $_POST['datapedido'];

                    $consulta = "select cod,datapedido,codfunc,codcli,codprod,quantidade,preco from pedidos
                                where cod = '$cod' or datapedido = '$datapedido'";
                    $resultado = mysql_query($consulta);
                } else {
                    $consulta = "select pedidos.cod,pedidos.datapedido,funcionarios.nome codfunc,clientes.nome codcli,produtos.nome codprod,
                                 pedidos.quantidade,pedidos.preco
                                 from pedidos, funcionarios, clientes, produtos
                                 where pedidos.codfunc = funcionarios.cod
                                 and pedidos.codcli = clientes.cod
                                 and pedidos.codprod = produtos.cod
                                 order by cod";
                    $resultado = mysql_query($consulta);
                }

                while ($dados = mysql_fetch_array($resultado)) {
                    $strdados = $dados['cod'] . "*" . $dados['datapedido'] . "*" . $dados['codfunc'] . "*" . $dados['codcli']
                        . "*" . $dados['codprod'] . "*" . $dados['quantidade'] . "*" . $dados['preco'];
                    ?>
                    <tr>
                        <td>
                            <?php echo $dados['cod']; ?>
                        </td>
                        <td>
                            <?php echo date('d/m/Y', strtotime($dados['datapedido'])); ?>
                        </td>
                        <td>
                            <?php echo $dados['codfunc']; ?>
                        </td>
                        <td>
                            <?php echo $dados['codcli']; ?>
                        </td>
                        <td>
                            <?php echo $dados['codprod']; ?>
                        </td>
                        <td>
                            <?php echo $dados['quantidade']; ?>
                        </td>
                        <td>
                            <?php echo $dados['preco']; ?>
                        </td>

                        <td>
                            <a href="#myModalExcluir" onclick="obterDadosModal('<?php echo $strdados ?>')">
                                <button type='button' id='excluir' name='excluir' class='btn btn-danger bile2' data-toggle='modal'
                                    data-target='#myModalExcluir'>Excluir</button>

                                <a href="#myModalAlterar" onclick="obterDadosModal('<?php echo $strdados ?>')">
                                    <button type='button' id='alterar' name='alterar' class='btn btn-primary bile'
                                        data-toggle='modal' data-target='#myModalAlterar'>Alterar</button>
                                </a>
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
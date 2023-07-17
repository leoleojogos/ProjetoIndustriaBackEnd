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
    <title>Controle </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="estilo.css">

</head>

<body>

    <div class="container">
        <div class="row">

            <h2>Controle produtos: </h2><br>
            <form action="controle.php" method="POST">
            <b>Periodo:</b> <input type="date" name="datapedido" id="datapedido" placeholder="Data pedido..." class="span4"style="margin-bottom: -2px; height: 25px; margin: 5px;">
            <input type="date" name="datapedido" id="datapedido" placeholder="Data pedido..." class="span4"style="margin-bottom: -2px; height: 25px; margin: 5px;">
                <br><br>
                <b>Funcionario:</b><input type="text" name="cod" id="cod" placeholder="Numero Funcionario..." class="span4" style="margin-bottom: -2px; height: 25px; margin: 5px;">
                <br><br>
                <b>Cliente: </b> <input type="text" name="cod" id="cod" placeholder="Numero Cliente..." class="span4" style="margin-bottom: -2px; height: 25px;margin: 5px;">
                <button type="submit" name="pesquisar" id="pesquisar" class="btn btn-large" style="height: 35px;">Pesquisar</button>
            </form>
            
            <table border="1px" bordercolor="gray" class="table table-stripped">
                <tr>
                    <td><b>Cod</b></td>
                    <td><b>DataPedido</b></td>
                    <td><b>Funcionarios</b></td>
                    <td><b>Cliente</b></td>
                    <td><b>TotalPedidos</b></td>
                </tr>
                <?php
                if (isset($_POST['pesquisar'])) {
                    $cod = $_POST['cod'];
                    $datapedido = $_POST['datapedido'];
                    

                    $consulta = "select pedidos.cod,pedidos.datapedido,funcionarios.nome codfunc,clientes.nome codcli,produtos.nome codprod,
                                 pedidos.quantidade,pedidos.preco,sum(pedidos.quantidade * pedidos.preco) 'total'
                                 from pedidos, funcionarios, clientes, produtos
                                 where pedidos.codcli = clientes.cod
                                 group by pedidos.codcli";
                    $resultado = mysql_query($consulta);
                } else {
                    $consulta = "select pedidos.cod,pedidos.datapedido,funcionarios.nome codfunc,clientes.nome codcli,produtos.nome codprod,
                                 pedidos.quantidade,pedidos.preco,sum(pedidos.quantidade * pedidos.preco) 'total'
                                 from pedidos, funcionarios, clientes, produtos
                                 where pedidos.codcli = clientes.cod
                                 group by pedidos.codcli";
                    $resultado = mysql_query($consulta);
                }

                while ($dados = mysql_fetch_array($resultado)) {
                    $strdados = $dados['cod'] . "*" . $dados['datapedido'] . "*" . $dados['codfunc'] . "*" . $dados['codcli'];
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
                        <td><?php echo 'R$ '. $dados['total']; ?></td>
                        <td>

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
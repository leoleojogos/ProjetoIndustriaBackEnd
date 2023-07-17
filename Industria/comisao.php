<?php
$conectar = mysql_connect('localhost','root','');
$banco    = mysql_select_db('industria');

?>


<html>

<head>
    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
    <title>Comissao </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>

<body>
    <script>
        
        /*
        document.getElementById('cod').value vira simplesmente $("#cod").val()
        */

        function obterDadosModal(valor) {

            var retorno = valor.split("*");
            document.getElementById('cod').value        = retorno[0];
            document.getElementById('nome').value       = retorno[1];
            document.getElementById('quantidade').value = retorno[2];
            document.getElementById('preco').value      = retorno[3];
        }

    </script>
    <div class="container">
        <div class="row">

            <h2>Comisao Funcionario: </h2><br>
            <form action="comisao.php" method="POST">
            Cod   <input id="cod" type="text" name="cod" value="" required>
            <input type="text" name="nome" id="nome" placeholder="Nome Funcionario..." class="span4" style="margin-bottom: -2px; height: 25px;">
            <button type="submit" name="pesquisar" id="pesquisar" class="btn btn-large" style="height: 35px;">Pesquisar</button>
                
                
            </form>
            <table border="1px" bordercolor="gray" class="table table-stripped">
                <tr>
                    <td><b>Cod</b></td>
                    <td><b>Nome</b></td>
                    <td><b>Total Vendas R$</b></td>
                    <td><b>Comissao 10%</b></td>
                </tr>
                <?php
                if (isset($_POST['pesquisar']))
                {
                   $nome   = strtoupper($_POST['nome']);    // converter maiuscula

                   $consulta = "select funcionarios.cod,funcionarios.nome, sum(pedidos.quantidade * pedidos.preco) 'total', sum(pedidos.quantidade * pedidos.preco * 0.1) 'comissao' from funcionarios,pedidos
                                where UPPER(funcionarios.nome) like '%$nome%' and pedidos.codfunc = funcionarios.cod group by pedidos.codfunc";
                                
                            $resultado = mysql_query($consulta);
                }
                else
                {
                    $consulta = "select funcionarios.cod,funcionarios.nome,sum(pedidos.quantidade * pedidos.preco) 'total', sum(pedidos.quantidade * pedidos.preco * 0.1) 'comissao' from funcionarios,pedidos 
                    where pedidos.codfunc = funcionarios.cod group by pedidos.codfunc";
                    $resultado = mysql_query($consulta);
                }
                
                while ($dados = mysql_fetch_array($resultado))
                {
                    $valor = $dados['cod'] . "*" .  $dados['nome'];
                    

                ?>
                    <tr>
                        <td><?php echo $dados['cod']; ?></td>
                        <td><?php echo $dados['nome']; ?></td>
                        <td><?php echo 'R$ '. $dados['total']; ?></td>
                        <td><?php echo 'R$ '. $dados['comissao']; ?></td>
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

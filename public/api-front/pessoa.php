<html>
  <head>
    <title>Api-Front</title>
    <link type="text/css" rel="stylesheet" href="app/css/materialize.css"  media="screen,projection"/>
  </head>
  <body>

      <nav>
        <div class="nav-wrapper">
          <div class="container">
            <!-- <a href="#" class="brand-logo right">Logo</a> -->
            <ul id="nav-mobile" class="left hide-on-med-and-down">
              <li><a href="pedidos.php">Pedidos</a></li>
              <li><a href="pessoas.php">Pessoas</a></li>
              <li><a href="produtos.php">Produtos</a></li>
            </ul>
        </div>
        </div>
      </nav>

      <div class="container">

          <h2> Pessoa </h2>

          <a data-type="pessoaView" data-id="<?php echo $_GET['id'] ?>" class="waves-effect waves-light btn-small" onclick="destroyThis(this)">Deletar</a>
          <a href="pessoas-form.php?id=<?php echo $_GET['id'] ?>" class="waves-effect waves-light btn-small">Editar</a>
          <h4 id="populate-pessoa-nome"></h4>
          <h5 id="populate-pessoa-cpf"></h5>
          <h5 id="populate-pessoa-nascimento"></h5>


      <!-- <a href="pedidos-form.php" class="waves-effect waves-light btn-small" style="float: right;">Adicionar</a> -->
      <!-- 
      <div class="pedido">
        <a data-type="pedidoDeVendaView" data-id="<?php echo $_GET['id'] ?>" class="waves-effect waves-light btn-small" onclick="destroyThis(this)">Deletar</a>
        <h4 id="populate-pedido-cliente"></h4>
        <h5 id="populate-pedido-total"></h5>
        <h5 id="populate-pedido-emissao"></h5>
        <table id="item_pedido">
          <thead>
            <tr>
                <th>Produto</th>
                <th>Valor</th>
                <th>Quantidade</th>
                <th>Desconto</th>
                <th>Total</th>
            </tr>
          </thead>

          <tbody id="populate-item-pedidos">
          </tbody>

        </table>
      </div/>
      -->

      <!-- <a class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a> -->
    </div>

    <script src="app/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="app/js/bin/materialize.min.js"></script>
    <script type="text/javascript" src="app/js/application.js"></script>
    <script type="text/javascript">
      getRegistro(<?php echo $_GET['id'] ?>, 'pessoaView');
    </script>
  </body>
</html>

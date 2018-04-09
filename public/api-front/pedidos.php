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
              <li><a href="sass.html">Pedidos</a></li>
              <li><a href="badges.html">Pessoas</a></li>
              <li><a href="collapsible.html">Produtos</a></li>
            </ul>
        </div>
        </div>
      </nav>

      <div class="container">

      <h2> Pedidos de Venda </h2>

      <a href="pedidos-form.php" class="waves-effect waves-light btn-small" style="float: right;">Adicionar</a>

      <table>
        <thead>
          <tr>
              <th>Numero</th>
              <th>Cliente</th>
              <th>Emissao</th>
              <th>Total</th>
              <th>Ações</th>
          </tr>
        </thead>

        <tbody id="populate-pedidos">
        </tbody>

      </table>

      <!-- <a class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a> -->
    </div>

    <script src="app/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="app/js/bin/materialize.min.js"></script>
    <script type="text/javascript" src="app/js/application.js"></script>
    <script type="text/javascript">
      BuscaPedidos();
    </script>
  </body>
</html>

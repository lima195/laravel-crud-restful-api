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

      <h2> Pedidos de Venda </h2>

      <a href="pedidos-form.php" class="waves-effect waves-light btn-small" style="float: right;">Adicionar</a>
      <a class="waves-effect waves-light btn-small" onclick="showFiltro()" style="float: right; margin-left: 10px; margin-right: 10px;">Filtrar</a>

      <table>
        <thead>
          <tr>
              <th>Número</th>
              <th>Cliente</th>
              <th>Emissao</th>
              <th>Total</th>
              <th>Ações</th>
          </tr>
          <tr id="filtro_td" style="display: none;">
              <form id="filtro" data-type="pedidoDeVenda">
                <th><input type="text" name="numero" placeholder="Número"/></th>
                <th><input type="text" name="cliente" placeholder="Cliente"/></th>
                <th><input type="text" name="emissao" onKeyPress="MascaraData(filtro.emissao)" maxlength="10" placeholder="Emissao"/></th>
                <th><input type="text" id="preco" name="total" placeholder="Total" maxlength="20" data-affixes-stay="true" data-prefix="R$ " data-thousands="." data-decimal=","/></th>
                <th><button id="enviar" class="btn waves-effect waves-light" type="submit" name="action" style="margin-left: 10px; margin-right: 10px;">Filtrar</button></th>
              </form>
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
    <script type="text/javascript" src="app/js/masks.js"></script>
    <script type="text/javascript">
      getRegistros('pedidoDeVenda');
    </script>
  </body>
</html>

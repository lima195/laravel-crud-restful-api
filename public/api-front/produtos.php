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

      <h2> Produtos </h2>

      <a href="produtos-form.php" id="adicionar" class="waves-effect waves-light btn-small" style="float: right;">Adicionar</a>
      <a id="botao_filtrar" class="waves-effect waves-light btn-small" onclick="showFiltro()" style="float: right; margin-left: 10px; margin-right: 10px;">Filtrar</a>

      <div id="msg"></div>

      <table>
        <thead>
          <tr>
              <th>Código</th>
              <th>Nome</th>
              <th>Preço</th>
              <th>Ações</th>
          </tr>
          <tr id="filtro_td" style="display: none;">
              <form id="filtro" data-type="produto">
                <th><input type="text" name="codigo" placeholder="Código"/></th>
                <th><input type="text" name="nome" placeholder="Nome"/></th>
                <th><input type="text" id="preco" name="preco" placeholder="Preco" maxlength="20" data-affixes-stay="true" data-prefix="R$ " data-thousands="." data-decimal=","/></th>
                <th><button id="enviar" class="btn waves-effect waves-light" type="submit" name="action" style="margin-left: 10px; margin-right: 10px;">Filtrar</button></th>
              </form>
          </tr>
        </thead>

        <tbody id="populate-produtos">
        </tbody>

      </table>

      <!-- <a class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a> -->
    </div>

    <script src="app/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="app/js/bin/materialize.min.js"></script>
    <script type="text/javascript" src="app/js/application.js"></script>
    <script type="text/javascript" src="app/js/masks.js"></script>
    <script type="text/javascript">
      getRegistros('produto');
    </script>
  </body>
</html>

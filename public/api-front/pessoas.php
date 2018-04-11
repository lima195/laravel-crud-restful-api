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

      <h2> Pessoas </h2>

      <a href="pessoas-form.php" id="adicionar" class="waves-effect waves-light btn-small" style="float: right;">Adicionar</a>
      <a id="botao_filtrar" class="waves-effect waves-light btn-small" onclick="showFiltro()" style="float: right; margin-left: 10px; margin-right: 10px;">Filtrar</a>

      <div id="msg"></div>

      <table>
        <thead>
          <tr>
              <th>Nome</th>
              <th>CPF</th>
              <th>Nascimento</th>
              <th>Ações</th>
          </tr>
          <tr id="filtro_td" style="display: none;">
              <form id="filtro" data-type="pessoa">
                <th><input type="text" name="nome" placeholder="Nome"/></th>
                <th><input type="text" id="cpf" name="cpf" onKeyUp="MascaraCPF(filtro.cpf)" maxlength="14" placeholder="CPF"/></th>
                <th><input type="text" id="nascimento" name="nascimento" onKeyPress="MascaraData(filtro.nascimento)" maxlength="10" placeholder="Nascimento"/></th>
                <th><button id="enviar" class="btn waves-effect waves-light" type="submit" name="action" style="margin-left: 10px; margin-right: 10px;">Filtrar</button></th>
              </form>
          </tr>
        </thead>

        <tbody id="populate-pessoas">
        </tbody>

      </table>

      <!-- <a class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a> -->
    </div>

    <script src="app/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="app/js/bin/materialize.min.js"></script>
    <script type="text/javascript" src="app/js/application.js"></script>
    <script type="text/javascript" src="app/js/masks.js"></script>
    <script type="text/javascript">
      getRegistros('pessoa');
    </script>
  </body>
</html>

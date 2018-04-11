<html>
  <head>
    <title>Api-Front</title>
    <link type="text/css" rel="stylesheet" href="app/css/materialize.css"  media="screen,projection"/>
    <style>
    .select-wrapper input.select-dropdown{
      /* border-bottom: 0px; */
    }
    .select-wrapper > .select-wrapper input.select-dropdown{
      /* border-bottom: 0px; */
      /* border-bottom: 1px solid #000; */
      margin-top: -53px;
      /* padding-top: 54px; */
          /* margin-top: 53px; */
    }
    </style>
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

      <h2> Pessoas - Formulário</h2>

      <!-- <a href="pedidos-form.php" class="waves-effect waves-light btn-small" style="float: right;">Adicionar</a> -->
      <form id="pessoa<?php echo $_GET['id'] ? 'Edit' : ''; ?>">

        <div class="row">

          <input id="id" name="id" type="hidden"/>

          <div class="input-field col s12">
            <input id="nome" name="nome" type="text" maxlength="200" class="validate">
            <label>Nome</label>
          </div>

          <div class="input-field col s12">
            <input id="cpf" name="cpf" type="text" class="validate" onKeyUp="MascaraCPF(pessoa<?php echo $_GET['id'] ? 'Edit' : ''; ?>.cpf)" maxlength="14" required>
            <label>CPF</label>
          </div>

          <div class="input-field col s12">
            <input id="nascimento" name="nascimento" type="text" class="validate" onKeyPress="MascaraData(pessoa<?php echo $_GET['id'] ? 'Edit' : ''; ?>.nascimento)" maxlength="10" required>
            <label>Nascimento</label>
          </div>

      </div>

      <button id="enviar" class="btn waves-effect waves-light" style="float: right;" type="submit" name="action">Enviar</button>
    </form>

      <!-- <a class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a> -->
    </div>

    <script src="app/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="app/js/bin/materialize.min.js"></script>
    <script type="text/javascript" src="app/js/application.js"></script>
    <script type="text/javascript" src="app/js/masks.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        <?php if($_GET['id']){ ?>
          populateForm(<?php echo $_GET['id'] ?>, 'pessoaView');
        <?php } ?>
      });
    </script>
  </body>
</html>

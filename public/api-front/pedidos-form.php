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
              <li><a href="sass.html">Pedidos</a></li>
              <li><a href="badges.html">Pessoas</a></li>
              <li><a href="collapsible.html">Produtos</a></li>
            </ul>
        </div>
        </div>
      </nav>

      <div class="container">

      <h2> Pedidos de Venda - Formulário</h2>

      <!-- <a href="pedidos-form.php" class="waves-effect waves-light btn-small" style="float: right;">Adicionar</a> -->
      <form>
      <div class="row">
          <div class="col s12">
            <div class="row">
              <div class="input-field col s12">
                <select id="populate-pessoas" name="pessoa" class="browser-defaults">
                  <option value="" selected>Choose your option</option>
                </select>
                <label>Cliente</label>
              </div>
            </div>
          </div>
        </div>
        <div id="clone_this">
          <div id="clone" class="clone_this">
            <div class="row">

            <div class="input-field col s5">
              <select id="populate-produtos" id="produto" name="produto[]" class="browser-defaults">
                <option value="" selected>Choose your option</option>
              </select>
              <label>Produto</label>
            </div>

            <div class="input-field col s5">
              <input placeholder="%" id="percentual" name="percentual_de_desconto[]" type="number" min="0" max="100" maxlength="3" class="validate">
              <label>Desconto (%)</label>
            </div>

            <div class="col s2">
              <a class="waves-effect waves-light btn" onClick="cloneThis()">Add</a>
            </div>
          </div>
        </div>
      </div>
      <button class="btn waves-effect waves-light" style="float: right;" type="submit" name="action">Enviar</button>
    </form>

      <!-- <a class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a> -->
    </div>

    <script src="app/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="app/js/bin/materialize.min.js"></script>
    <script type="text/javascript" src="app/js/application.js"></script>
    <script type="text/javascript">
      // var elem = document.querySelector('.autocomplete');
      // var instance = M.Autocomplete.init(elem, options);

      $(document).ready(function(){

        let clientes = BuscaClientes();
        let produto = BuscaProdutos();

        console.log(clientes);

        // $('input.autocomplete').autocomplete({
        //   data: {
        //     "Apple": null,
        //     "Microsoft": null,
        //     "Google": 'https://placehold.it/250x250'
        //   },
        // });

      });
    </script>
  </body>
</html>

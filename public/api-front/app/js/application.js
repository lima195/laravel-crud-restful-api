
$(document).ready(function() {
  // $('input, textarea').characterCounter();
  //Materialize.updateTextFields();

});

var domain = 'http://lima';

function getRegistros(type){

  if(!type){
    M.toast({html: 'Tipo (Pedido, Pessoa ou Produto não identificado'});
  }

  let url = "";
  let element_populate = "";

  if(type == "pedidoDeVenda"){
    url = domain+'/pedidodevenda/api/pedidos/';
    element_populate = '#populate-pedidos';
  }else if(type == "pessoa"){
    url = domain+'/pessoa/api/pessoas/';
    element_populate = '#populate-pessoas';
  }else if(type == "produto"){
    url = domain+'/produto/api/produtos/';
    element_populate = '#populate-produtos';
  }

  $.ajax({
   type: 'GET',
   url: url,
   dataType:'json',
   data: {
    params: null,
  },
    success: function(data){
      let Html = '';

      if(type == "pedidoDeVenda"){

        for(let i = 0; i < data.length; i++){
          let id = data[i].numero;
          console.log(id);
          Html += '<tr id="pedidoDeVenda_'+id+'">';
          Html +=   '<td>'+data[i].numero+'</td>';
          Html +=   '<td>'+data[i].nome+'</td>';
          Html +=   '<td>'+data[i].emissao+'</td>';
          Html +=   '<td>'+numberToCurrency(data[i].total)+'</td>';
          Html +=   '<td>'+ '<a href="pedido.php?id='+id+'" class="waves-effect waves-light btn-small">Ver</a> '+
                            //'<a class="waves-effect waves-light btn-small">Editar</a> '+
                            '<a data-type="pedidoDeVenda" data-id="'+id+'" class="waves-effect waves-light btn-small" onClick="destroyThis(this)">Deletar</a> '+
                            '</td>';
                            Html += '</tr>';
        }

      }else if(type == "pessoa"){

        for(let i = 0; i < data.length; i++){
          let id = data[i].id;
          console.log(id);
          Html += '<tr id="pessoa_'+id+'">';
          Html +=   '<td>'+data[i].nome+'</td>';
          Html +=   '<td>'+data[i].cpf+'</td>';
          Html +=   '<td>'+data[i].nascimento+'</td>';
          Html +=   '<td>'+ '<a href="pessoa.php?id='+id+'" class="waves-effect waves-light btn-small">Ver</a> '+
                            '<a href="pessoas-form.php?id='+id+'" class="waves-effect waves-light btn-small">Editar</a> '+
                            '<a data-type="pessoa" data-id="'+id+'" class="waves-effect waves-light btn-small" onClick="destroyThis(this)">Deletar</a> '+
                            '</td>';
                            Html += '</tr>';
        }

      }else if(type == "produto"){

        for(let i = 0; i < data.length; i++){
          let id = data[i].id;
          console.log(id);
          Html += '<tr id="produto_'+id+'">';
          Html +=   '<td>'+data[i].codigo+'</td>';
          Html +=   '<td>'+data[i].nome+'</td>';
          Html +=   '<td>'+numberToCurrency(data[i].preco)+'</td>';
          Html +=   '<td>'+ '<a href="produto.php?id='+id+'" class="waves-effect waves-light btn-small">Ver</a> '+
                            '<a href="produtos-form.php?id='+id+'" class="waves-effect waves-light btn-small">Editar</a> '+
                            '<a data-type="produto" data-id="'+id+'" class="waves-effect waves-light btn-small" onClick="destroyThis(this)">Deletar</a> '+
                            '</td>';
                            Html += '</tr>';
        }

      }

      $(element_populate).html(Html);
      console.log(data);
    }
  });
}

function destroyThis(element){
  let type = element.getAttribute('data-type');
  let id = element.getAttribute('data-id');
  let url = "";
  let msg = "";
  let element_delete = "";
  let redirect = false;

  if(!type){
    M.toast({html: 'Tipo (Pedido, Pessoa ou Produto não identificado'});
  }
  if(!id){
    M.toast({html: 'ID não encontrada'});
  }

  if(type == 'pedidoDeVendaView' | type == 'pedidoDeVenda'){
    url = domain+'/pedidodevenda/api/pedidos/'+id;
    element_delete = "#pedidoDeVenda_"+id;
    msg = "Pedido deletado com sucesso";
    if(type == 'pedidoDeVendaView'){
      redirect = "pedidos.php";
    }
  }else if(type == 'pessoaView' | type == 'pessoa'){
    url = domain+'/pessoa/api/pessoas/'+id;
    element_delete = "#pessoa_"+id;
    msg = "Pessoa deletada com sucesso";
    if(type == 'pessoaView'){
      redirect = "pessoas.php";
    }
  }else if(type == 'produtoView' | type == 'produto'){
    url = domain+'/produto/api/produtos/'+id;
    element_delete = "#produto_"+id;
    msg = "Produto deletado com sucesso";
    if(type == 'produtosView'){
      redirect = "produtos.php";
    }
  }

  $.ajax({
    type: 'DELETE',
    url: url,
    dataType:'json',
    success: function(data){
      console.log(data);
      $(element_delete).html("");
      M.toast({html: msg});

      if(redirect){
        M.toast({html: "Redirecionando..."});
        setTimeout(function(){ window.location.replace(redirect ); }, 3000);
      }
    }
  });
}

function populateForm(id, type){
  if(id == null){
    $('#msg').html("<h4>Não foi encontrado o pedido</h4>")
  }

  let url = "";

  if(type == 'pedidoDeVendaView' | type == 'pedidoDeVenda'){
    // Não edita
  }else if(type == 'pessoaView' | type == 'pessoa'){
    url = domain+'/pessoa/api/pessoas/'+id;
  }else if(type == 'produtoView' | type == 'produto'){
    url = domain+'/produto/api/produtos/'+id;
  }

  $.ajax({
   type: 'GET',
   url: url,
   dataType:'json',

  success: function(data){

    console.log(data);
    let Html = '';

      if(type == 'pedidoDeVendaView' | type == 'pedidoDeVenda'){

        // Não edita

      }else if(type == 'pessoaView' | type == 'pessoa'){

        $('input[name="id"]').val(data.id);
        $('input[name="nome"]').val(data.nome);
        $('input[name="cpf"]').val(data.cpf);
        $('input[name="nascimento"]').val(data.nascimento);
        //$('#populate-pessoa-pedidos').html(Html);

      }else if(type == 'produtoView' | type == 'produto'){

        $('input[name="id"]').val(data.id);
        $('input[name="codigo"]').val(data.codigo);
        $('input[name="nome"]').val(data.nome);
        $('input[name="preco"]').val(data.preco).trigger('mask.maskMoney');;
      }
    }
  });

}

function getRegistro(id = null, type){

  if(id == null){
    $('.pedido').html("<h4>Não foi encontrado o pedido</h4>")
  }

  let url = "";
  let element_populate = "";

  if(type == 'pedidoDeVendaView' | type == 'pedidoDeVenda'){
    url = domain+'/pedidodevenda/api/pedidos/'+id;
  }else if(type == 'pessoaView' | type == 'pessoa'){
    url = domain+'/pessoa/api/pessoas/'+id;
  }else if(type == 'produtoView' | type == 'produto'){
    url = domain+'/produto/api/produtos/'+id;
  }

  $.ajax({
   type: 'GET',
   url: url,
   dataType:'json',

  success: function(data){

    console.log(data);
    let Html = '';

      if(type == 'pedidoDeVendaView' | type == 'pedidoDeVenda'){
        //
        for(let i = 0; i < data.produtos.length; i++){
          Html += '<tr>';
          Html +=   '<td>'+'<a href="produto.php?id='+data.produtos[i].id+'">'+data.produtos[i].nome+'</a>'+'</td>';
          Html +=   '<td>'+numberToCurrency(data.produtos[i].preco_unitario)+'</td>';
          Html +=   '<td>'+data.produtos[i].quantidade+' uni.</td>';
          Html +=   '<td>'+data.produtos[i].percentual_de_desconto+'%</td>';
          Html +=   '<td>'+numberToCurrency(data.produtos[i].total)+'</td>';
          Html += '</tr>';
        }

        Html += '<tr>';
        Html +=   '<td></td>';
        Html +=   '<td></td>';
        Html +=   '<td></td>';
        Html +=   '<td>Total: </td>';
        Html +=   '<td>'+numberToCurrency(data.total)+'</td>';
        Html += '</tr>';

        //
        $('#populate-item-pedidos').html(Html);
        $('#populate-pedido-cliente').html('<span>Cliente: </span>'+data.cliente);
        $('#populate-pedido-total').html('<span>Total: </span>'+numberToCurrency(data.total));
        $('#populate-pedido-emissao').html('<span>Emissão: </span>'+data.emissao);

      }else if(type == 'pessoaView' | type == 'pessoa'){

        $('#populate-pessoa-nome').html('<spanpedidoDeVenda>Pessoa: </span>'+data.nome);
        $('#populate-pessoa-cpf').html('<span>CPF: </span>'+data.cpf);
        $('#populate-pessoa-nascimento').html('<span>Nascimento: </span>'+data.nascimento);
        //$('#populate-pessoa-pedidos').html(Html);

      }else if(type == 'produtoView' | type == 'produto'){

        $('#populate-produto').html(Html);
        $('#populate-produto-codigo').html('<span>Código: </span>'+data.codigo);
        $('#populate-produto-nome').html('<span>Nome: </span>'+data.nome);
        $('#populate-produto-preco').html('<span>Preço: </span>'+numberToCurrency(data.preco));

      }
    }
  });
}

function BuscaClientes(){
  $.ajax({
    type: 'GET',
    url: domain+'/pessoa/api/pessoas/',
    dataType:'json',
    data: {
    params: null,
  },
  success: function(data){

  let Html = '';

  for(let i = 0; i < data.length; i++){
    Html +=   '<option value="'+data[i].id+'">'+data[i].nome+'</option>';
  }

  $('#populate-pessoas').html(Html);
    $('select').formSelect();
    console.log(data);
    }
  });
}

function BuscaProdutos(){
  $.ajax({
   type: 'GET',
   url: domain+'/produto/api/produtos/',
   dataType:'json',
   data: {
    params: null,
  },
  success: function(data){

    let Html = '';

    for(let i = 0; i < data.length; i++){
      Html +=   '<option value="'+data[i].id+'">'+data[i].nome+'</option>';
    }

    $('#populate-produtos').html(Html);
    $('select').formSelect();

  }
});
}

$("#pedido_de_venda").submit(function(e) {

  let url = domain+"/pedidodevenda/api/pedidos"; // the script where you handle the form input.
  let data =  $("#pedido_de_venda").serialize();
  console.log(data);

  $.ajax({
    type: 'POST',
    url: url,
    data: data,
    success: function(data)
    {
      M.toast({html: 'Pedido de Venda Realizado'})
      M.toast({html: "Redirecionando..."});
      setTimeout(function(){ window.location.replace('pedidos.php' ); }, 3000);
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
        M.toast({html: XMLHttpRequest.responseJSON.message+" Error: "+ XMLHttpRequest.responseJSON.code});
    }
  });

    e.preventDefault();
});

$("#pessoa").submit(function(e) {

  let url = domain+"/pessoa/api/pessoas"; // the script where you handle the form input.
  let data =  $("#pessoa").serialize();
  console.log(data);

  $.ajax({
    type: 'POST',
    url: url,
    data: data,
    success: function(data)
    {
      console.log(data);
      M.toast({html: 'Cadastro de Pessoa Realizado'});
      M.toast({html: "Redirecionando..."});
      setTimeout(function(){ window.location.replace('pessoas.php'); }, 3000);
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
        M.toast({html: XMLHttpRequest.responseJSON.message+" Error: "+ XMLHttpRequest.responseJSON.code});
    }
  });

    e.preventDefault();
});

$("#pessoaEdit").submit(function(e) {

  let id = $('input[name="id"]').val();
  console.log(id);
  let url = domain+"/pessoa/api/pessoas/"+id; // the script where you handle the form input.
  let data =  $("#pessoaEdit").serialize();
  console.log(data);

  $.ajax({
    type: 'PUT',
    url: url,
    data: data,
    success: function(data)
    {
      M.toast({html: 'Pessoa atualizada com sucesso'});
      M.toast({html: "Redirecionando..."});
      setTimeout(function(){ window.location.replace('pessoas.php'); }, 3000);
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
        M.toast({html: XMLHttpRequest.responseJSON.message+" Error: "+ XMLHttpRequest.responseJSON.code});
    }
  });

    e.preventDefault();
});

$("#produto").submit(function(e) {

  let url = domain+"/produto/api/produtos"; // the script where you handle the form input.
  let data =  $("#produto").serialize();
  console.log(data);

  $.ajax({
    type: 'POST',
    url: url,
    data: data,
    success: function(data)
    {
      console.log(data);
      M.toast({html: 'Cadastro de Pessoa Realizado'});
      M.toast({html: "Redirecionando..."});
      // setTimeout(function(){ window.location.replace('produtos.php'); }, 3000);
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
        M.toast({html: XMLHttpRequest.responseJSON.message+" Error: "+ XMLHttpRequest.responseJSON.code});
    }
  });

    e.preventDefault();
});

$("#produtoEdit").submit(function(e) {

  let id = $('input[name="id"]').val();
  console.log(id);
  let url = domain+"/produto/api/produtos/"+id; // the script where you handle the form input.
  let data =  $("#produtoEdit").serialize();
  console.log(data);

  $.ajax({
    type: 'PUT',
    url: url,
    data: data,
    success: function(data)
    {
      M.toast({html: 'Pessoa atualizada com sucesso'})
      M.toast({html: "Redirecionando..."});
      setTimeout(function(){ window.location.replace('produtos.php'); }, 3000);
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
        M.toast({html: XMLHttpRequest.responseJSON.message+" Error: "+ XMLHttpRequest.responseJSON.code});
    }
  });

    e.preventDefault();
});

function cloneThis(){
  let element = $( '.clone_this:first' ).clone().appendTo( '#clone_this' );
  $(this).attr('disabled', true);
  console.log(this)
  element.find('input[type="text"]').val("");
  element.find('.select-dropdown.dropdown-trigger').css("border-bottom", "0px");
  $('select').formSelect();
}

function numberToCurrency(value){
  value = value.toFixed(2).split('.');
  value[0] = "R$ " + value[0].split(/(?=(?:...)*$)/).join('.');
  return value.join(',');
}

$("#filtro").submit(function(e) {

  let type = this.getAttribute('data-type');

  if(!type){
    M.toast({html: 'Tipo (Pedido, Pessoa ou Produto não identificado'});
  }

  let url = "";
  let element_populate = "";
  let params = null;

  // console.log(params);

  if(type == "pedidoDeVenda"){
    url = domain+'/pedidodevenda/api/pedidos/';
    element_populate = '#populate-pedidos';

    params = [{
      numero: $('input[name="numero"]').val(),
      cliente: $('input[name="cliente"]').val(),
      emissao: $('input[name="emissao"]').val(),
      total: $('input[name="total"]').val()
    }];
  }else if(type == "pessoa"){
    url = domain+'/pessoa/api/pessoas/';
    element_populate = '#populate-pessoas';

    params = [{
      nome: $('input[name="nome"]').val(),
      cpf: $('input[name="cpf"]').val(),
      nascimento: $('input[name="nascimento"]').val()
    }];
  }else if(type == "produto"){
    url = domain+'/produto/api/produtos/';
    element_populate = '#populate-produtos';

    params = [{
      codigo: $('input[name="codigo"]').val(),
      nome: $('input[name="nome"]').val(),
      preco: $('input[name="preco"]').val()
    }];
  }

  $.ajax({
   type: 'GET',
   url: url,
   dataType:'json',
   data: {
    params: params,
  },
    success: function(data){
      console.log(data);
      let Html = '';

      if(type == "pedidoDeVenda"){

        for(let i = 0; i < data.length; i++){
          let id = data[i].numero;
          console.log(id);
          Html += '<tr id="pedidoDeVenda_'+id+'">';
          Html +=   '<td>'+data[i].numero+'</td>';
          Html +=   '<td>'+data[i].nome+'</td>';
          Html +=   '<td>'+data[i].emissao+'</td>';
          Html +=   '<td>'+numberToCurrency(data[i].total)+'</td>';
          Html +=   '<td>'+ '<a href="pedido.php?id='+id+'" class="waves-effect waves-light btn-small">Ver</a> '+
                            //'<a class="waves-effect waves-light btn-small">Editar</a> '+
                            '<a data-type="pedidoDeVenda" data-id="'+id+'" class="waves-effect waves-light btn-small" onClick="destroyThis(this)">Deletar</a> '+
                            '</td>';
                            Html += '</tr>';
        }

      }else if(type == "pessoa"){

        for(let i = 0; i < data.length; i++){
          let id = data[i].id;
          console.log(id);
          Html += '<tr id="pessoa_'+id+'">';
          Html +=   '<td>'+data[i].nome+'</td>';
          Html +=   '<td>'+data[i].cpf+'</td>';
          Html +=   '<td>'+data[i].nascimento+'</td>';
          Html +=   '<td>'+ '<a href="pessoa.php?id='+id+'" class="waves-effect waves-light btn-small">Ver</a> '+
                            '<a href="pessoas-form.php?id='+id+'" class="waves-effect waves-light btn-small">Editar</a> '+
                            '<a data-type="pessoa" data-id="'+id+'" class="waves-effect waves-light btn-small" onClick="destroyThis(this)">Deletar</a> '+
                            '</td>';
                            Html += '</tr>';
        }

      }else if(type == "produto"){

        for(let i = 0; i < data.length; i++){
          let id = data[i].id;
          console.log(id);
          Html += '<tr id="produto_'+id+'">';
          Html +=   '<td>'+data[i].codigo+'</td>';
          Html +=   '<td>'+data[i].nome+'</td>';
          Html +=   '<td>'+numberToCurrency(data[i].preco)+'</td>';
          Html +=   '<td>'+ '<a href="produto.php?id='+id+'" class="waves-effect waves-light btn-small">Ver</a> '+
                            '<a href="produtos-form.php?id='+id+'" class="waves-effect waves-light btn-small">Editar</a> '+
                            '<a data-type="produto" data-id="'+id+'" class="waves-effect waves-light btn-small" onClick="destroyThis(this)">Deletar</a> '+
                            '</td>';
                            Html += '</tr>';
        }

      }

      $(element_populate).html(Html);
      console.log(data);
    }
  });

  e.preventDefault();
});

function showFiltro(){
  $('#filtro_td').show();
  $('#botao_filtrar').hide();
}

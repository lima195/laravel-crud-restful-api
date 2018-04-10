
$(document).ready(function() {
  // $('input, textarea').characterCounter();

});

function BuscaPedidos(){
  $.ajax({
   type: 'GET',
   url: 'http://lima/pedidodevenda/api/pedidos/',
   dataType:'json',
   data: {
    params: null,
  },
  success: function(data){
    let Html = ''; 

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

                          $('#populate-pedidos').html(Html);
                          console.log(data);
                        }
                      });
}

function destroyThis(element){
  console.log(element);
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
    url = 'http://lima/pedidodevenda/api/pedidos/'+id;
    element_delete = "#pedidoDeVenda_"+id;
    msg = "Pedido deletado com sucesso";
    if(type == 'pedidoDeVendaView'){
      redirect = "pedidos.php";
    }
  }else if(type == 'pessoaView' | type == 'pessoa'){
    url = 'http://lima/pessoa/api/pessoas/'+id;
    element_delete = "#pessoa_"+id;
    msg = "Pessoa deletada com sucesso";
    if(type == 'pessoaView'){
      redirect = "pessoas.php";
    }
  }else if(type == 'produtoView' | type == 'produto'){
    url = 'http://lima/produto/api/produtos/'+id;
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
      data: {
        params: null,
      },
      success: function(data){
        console.log(data);
        $(element_delete).html("");
        M.toast({html: msg});

        if(redirect){
          M.toast({html: "Redirecionando..."});
          setTimeout(function(){ window.location.replace(redirect); }, 3000);
        }
      }
    });
}

function numberToCurrency(value){
  value = value.toFixed(2).split('.');
  value[0] = "R$ " + value[0].split(/(?=(?:...)*$)/).join('.');
  return value.join(',');
}

function BuscaPedido(id = null){
  if(id == null){
    $('.pedido').html("<h2>Não foi encontrado o pedido</h2>")
  }

  $.ajax({
   type: 'GET',
   url: 'http://lima/pedidodevenda/api/pedidos/'+id,
   dataType:'json',
   data: {
    params: null,
  },
  success: function(data){

    console.log(data);
    let Html = '';
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
        console.log(data);
      }
    });
}

function BuscaClientes(){
  $.ajax({
   type: 'GET',
   url: 'http://lima/pessoa/api/pessoas/',
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
   url: 'http://lima/produto/api/produtos/',
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


    let url = "http://lima/pedidodevenda/api/pedidos"; // the script where you handle the form input.
    let data =  $("#pedido_de_venda").serialize();
    console.log(data);

    $.ajax({
     type: 'POST',
     url: url,
     data: data,
     success: function(data)
     {
      M.toast({html: 'Pedido de Venda Realizado'})
              // console.log('success');
               // alert(data); // show response from the php script.
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

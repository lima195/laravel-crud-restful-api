
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
          Html += '<tr>';
          Html +=   '<td>'+data[i].numero+'</td>';
          Html +=   '<td>'+data[i].cliente+'</td>';
          Html +=   '<td>'+data[i].emissao+'</td>';
          Html +=   '<td>'+data[i].total+'</td>';
          Html +=   '<td>'+ '<a class="waves-effect waves-light btn-small">Ver</a> '+
                            '<a class="waves-effect waves-light btn-small">Editar</a> '+
                            '<a class="waves-effect waves-light btn-small">Deletar</a> '+
                    '</td>';
          Html += '</tr>';
        }

        $('#populate-pedidos').html(Html);
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
				console.log(data);

			}
	});
}

function cloneThis(){
  let element = $( '.clone_this:first' ).clone().appendTo( '#clone_this' );
  $(this).attr('disabled', true);
  alert(this);
  console.log(this);
  element.find('input[type="text"]').val("");
  element.find('.select-dropdown.dropdown-trigger').css("border-bottom", "0px");
  $('select').formSelect();
}

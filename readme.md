<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

## Instalação

Para rodar o projeto, siga os comandos ou execute o install.sh desde que tenha clonado o projeto na pasta '/var/www/', que seu usuário do apache seja 'www-data' e que seu login e senha do mysql seja 'root'

> ./install.sh

ou

	composer install;
	find /var/www/laravel-crud-restful-api/public/api-front/ -type f -exec sudo chmod 664 {} \;
	find /var/www/laravel-crud-restful-api/public/api-front/ -type d -exec sudo chmod 775 {} \;
	cp .env.demo .env;
	echo "CREATE DATABASE lima" | mysql -u root -proot;
	php artisan key:generate;
	php artisan module:migrate;
	php artisan module:seed;
	chmod 777 -R storage/;
	sudo chown `whoami`:www-data . -R;

Crie um vhost para 'lima':

	/etc/apache2/sites-available/laravel.conf
	sudo ln -s /etc/apache2/sites-available/laravel.conf /etc/apache2/sites-enabled/


	<VirtualHost *:80>
	    ServerAdmin webmaster@localhost
	    ServerName lima
	    DocumentRoot /var/www/laravel-crud-restful-api/public
	    <Directory /var/www/laravel-crud-restful-api/public/>
	        Options FollowSymlinks Indexes MultiViews
	        AllowOverride All
	        Order allow,deny
	        Allow from localhost
	        Require all granted
	    </Directory>
	    ErrorLog ${APACHE_LOG_DIR}/error.log
	    CustomLog ${APACHE_LOG_DIR}/access.log combined
	</VirtualHost>

Crie um hosts pra ele:

	/etc/hosts

	127.0.0.1	lima

Restarte o apache:

	sudo service apache2 restart;


## Rotas

	 Domain | Method    | URI                                     | Name             | Action                                                                 | Middleware   |
	+--------+-----------+-----------------------------------------+------------------+------------------------------------------------------------------------+--------------+
	|        | GET|HEAD  | /                                       |                  | Closure                                                                | web          |
	|        | GET|HEAD  | api/user                                |                  | Closure                                                                | api,auth:api |
	|        | GET|HEAD  | pedidodevenda                           |                  | Closure                                                                | web          |
	|        | GET|HEAD  | pedidodevenda/api                       |                  | Closure                                                                | web          |
	|        | POST      | pedidodevenda/api/pedidos               | pedidos.store    | Modules\PedidoDeVenda\Http\Controllers\PedidoDeVendaController@store   | web          |
	|        | GET|HEAD  | pedidodevenda/api/pedidos               | pedidos.index    | Modules\PedidoDeVenda\Http\Controllers\PedidoDeVendaController@index   | web          |
	|        | GET|HEAD  | pedidodevenda/api/pedidos/create        | pedidos.create   | Modules\PedidoDeVenda\Http\Controllers\PedidoDeVendaController@create  | web          |
	|        | DELETE    | pedidodevenda/api/pedidos/{pedido}      | pedidos.destroy  | Modules\PedidoDeVenda\Http\Controllers\PedidoDeVendaController@destroy | web          |
	|        | PUT|PATCH | pedidodevenda/api/pedidos/{pedido}      | pedidos.update   | Modules\PedidoDeVenda\Http\Controllers\PedidoDeVendaController@update  | web          |
	|        | GET|HEAD  | pedidodevenda/api/pedidos/{pedido}      | pedidos.show     | Modules\PedidoDeVenda\Http\Controllers\PedidoDeVendaController@show    | web          |
	|        | GET|HEAD  | pedidodevenda/api/pedidos/{pedido}/edit | pedidos.edit     | Modules\PedidoDeVenda\Http\Controllers\PedidoDeVendaController@edit    | web          |
	|        | GET|HEAD  | pessoa                                  |                  | Closure                                                                | web          |
	|        | GET|HEAD  | pessoa/api                              |                  | Closure                                                                | web          |
	|        | GET|HEAD  | pessoa/api/pessoas                      | pessoas.index    | Modules\Pessoa\Http\Controllers\PessoaController@index                 | web          |
	|        | POST      | pessoa/api/pessoas                      | pessoas.store    | Modules\Pessoa\Http\Controllers\PessoaController@store                 | web          |
	|        | GET|HEAD  | pessoa/api/pessoas/create               | pessoas.create   | Modules\Pessoa\Http\Controllers\PessoaController@create                | web          |
	|        | GET|HEAD  | pessoa/api/pessoas/{pessoa}             | pessoas.show     | Modules\Pessoa\Http\Controllers\PessoaController@show                  | web          |
	|        | PUT|PATCH | pessoa/api/pessoas/{pessoa}             | pessoas.update   | Modules\Pessoa\Http\Controllers\PessoaController@update                | web          |
	|        | DELETE    | pessoa/api/pessoas/{pessoa}             | pessoas.destroy  | Modules\Pessoa\Http\Controllers\PessoaController@destroy               | web          |
	|        | GET|HEAD  | pessoa/api/pessoas/{pessoa}/edit        | pessoas.edit     | Modules\Pessoa\Http\Controllers\PessoaController@edit                  | web          |
	|        | GET|HEAD  | produto                                 |                  | Closure                                                                | web          |
	|        | GET|HEAD  | produto/api                             |                  | Closure                                                                | web          |
	|        | GET|HEAD  | produto/api/produtos                    | produtos.index   | Modules\Produto\Http\Controllers\ProdutoController@index               | web          |
	|        | POST      | produto/api/produtos                    | produtos.store   | Modules\Produto\Http\Controllers\ProdutoController@store               | web          |
	|        | GET|HEAD  | produto/api/produtos/create             | produtos.create  | Modules\Produto\Http\Controllers\ProdutoController@create              | web          |
	|        | DELETE    | produto/api/produtos/{produto}          | produtos.destroy | Modules\Produto\Http\Controllers\ProdutoController@destroy             | web          |
	|        | PUT|PATCH | produto/api/produtos/{produto}          | produtos.update  | Modules\Produto\Http\Controllers\ProdutoController@update              | web          |
	|        | GET|HEAD  | produto/api/produtos/{produto}          | produtos.show    | Modules\Produto\Http\Controllers\ProdutoController@show                | web          |
	|        | GET|HEAD  | produto/api/produtos/{produto}/edit     | produtos.edit    | Modules\Produto\Http\Controllers\ProdutoController@edit                | web          |			

## O que faltou no projeto:

	- Filtros

## Front

Acesse:

	Pedidos:
	http://lima/api-front/pedidos.php

	Pessoas:
	http://lima/api-front/pessoas.php

	Produtos:
	http://lima/api-front/produtos.php

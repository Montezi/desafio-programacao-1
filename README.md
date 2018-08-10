# Desafio de programação 1
As regras de desenvolvimento deste desafio são encontradas no :https://github.com/myfreecomm/desafio-programacao-1

### Pré requisitos

* PHP 5.4 ou superior(devem ser instaladas as seguintes bibliotecas do PHP: php-pgsql,php-curl,php-pdo,php-mbstring e libapache2-mod-php)
* Apache 2.4
* Banco de dados PostgreSQL

## Instalação

  * Descompacte a pasta desafio_upload no diretório do Apache(www/html) 
  * É necessário dar permissão 777 a pasta desafio_upload e ao arquivo UploadController(localizado na pasta /desafio_upload/application/controllers  
  *  Crie o banco de dados vendas e importe e restaure o arquivo vendas.sql
  * Para editar a conexão do Banco de Dados acesse o arquivo /desafio_upload/application/config/database.php e
    edite as seguintes linhas :     

```
   'hostname' => '< o ip do seu banco>',
	'username' => ' seu usuario do banco',
	'password' => 'a senha do seu banco de dados',
	'database' => 'api_rest', example

```
### Testando a aplicação
 * Devido a configuração do Google API, a aplicação só funciona localhost. 
 * Para acessar a aplicação digite o endereço: http://localhost/desafio_upload.
 * Em seguida, faça o login na aplicação com uma conta Google.
 * Selecione o arquivo para fazer upload(extensão .tab ou txt), a mesma deve retornar uma mensagem de sucesso em relação ao cadastro na parte superior e a soma da Receita brutal na parte inferior da página. 
 
 ## Licença

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

<?
#########################################################
#Copyright © e-Mobiliária. Todos os direitos reservados.#
#########################################################
#                                                       #
#  Programa        : e-Mobiliária PHP                   #
#  Autor           : Moisés Bach B.                     #
#  E-mail          : moisbach@gmail.com                 #
#  Versão          : 2.5                                #
#  Modificado em   : 09/12/2005                         #
#  Copyright ©     : e-Mobiliária                       #
#                 WWW.ANIMABUSCA.COM/IMOBILIARIA        #
#########################################################
#ESTE SCRIPT NÃO PODE SER COPIADO SEM AUTORIZAÇÃO PRÉVIA#
#########################################################


//Digite o nome do host do seu servidor, geralmente é "localhost".
$db_host = "localhost";

//Digite o nome de usuário do banco de dados MYSQL
$db_username = "charles_imovel";

//Digite a senha do banco de dados
$db_password = "12345";

//Digite o nome do banco de dados
$db_name = "charles_imob";

//Digite a URL (endereço) principal do site, onde está o arquivo index.php
$site_url = "http://charles.infel.com.br/imobiliaria";



		  ////////////////////////////////////////////////////////////
		 //////         Não edite as linhas abaixo            ///////
                            //////    Qualquer dúvida envie e-mail para:   ///////
                           //////                 moisbach@gmail.com          ///////
	            ///////////////////////////////////////////////////////////

$connection = mysql_connect($db_host, $db_username, $db_password) or die(mysql_error());

$db = mysql_select_db($db_name, $connection);

session_start();

$t = time();


?>

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

require_once("configuracao_mysql.php");
require_once("includes.php");
require_once("templates/HeaderTemplate2.php");



if(isset($_POST[u2]))
{
	$q1 = "select * from re2_agents where username = '$_POST[u2]' ";
	$r1 = mysql_query($q1) or die(mysql_error());
	
	if(mysql_num_rows($r1) == '1')
	{
		//ok
		$a1 = mysql_fetch_array($r1);

		$to = $a1[email];
		$subject = "Lembrete de senha";

		$message = "Olá $a1[FirstName] $a1[LastName],\nEstes são os detalhes do seu cadastro:\n\nNome de usuário: $a1[username]\nSenha: $a1[password]\n\n$site_url";

		$headers = "MIME-Version: 1.0\n"; 
		$headers .= "Content-type: text/plain; charset=iso-8859-1\n";
		$headers .= "Content-Transfer-Encoding: 8bit\n"; 
		$headers .= "From: $_SERVER[HTTP_HOST] <$aset[ContactEmail]>\n"; 
		$headers .= "X-Priority: 1\n"; 
		$headers .= "X-MSMail-Priority: High\n"; 
		$headers .= "X-Mailer: PHP/" . phpversion()."\n"; 

		mail($to, $subject, $message, $headers);

		require_once("templates/ForgotYes.php");
		require_once("templates/FooterTemplate.php");
		exit();
	}
	else
	{
		$error2 = "<center><font face=verdana size=2 color=red>Este nome de usuário: <b>$_POST[u2]</b>, não consta em nosso banco de dados!</font></center>";

	}
}

require_once("templates/ForgotTemplate.php");
require_once("templates/FooterTemplate.php");

?>
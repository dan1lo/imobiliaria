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

if(isset($_POST[s1]))
{
	$MyExp = mktime(0,0,0,date(m) + 1, date(d), date(Y));

	$q1 = "insert into re2_agents set 
						username = '$_POST[NewUsername]',
						TipodeConta = '$_POST[TipodeConta]',
						password = '$_POST[p1]',
						FirstName = '$_POST[FirstName]',
						LastName = '$_POST[LastName]',
						resume = '$_POST[resume]',
						phone = '$_POST[phone]',
						cellular = '$_POST[cellular]',
						pager = '$_POST[pager]',
						ResumeImages = '$ImageStr',
						email = '$_POST[email]',
						RegDate = '$t',
						ExpDate = '$MyExp',
						AccountStatus = 'active',
						offers = '0' ";

	mysql_query($q1);

	if(ereg("key 2", mysql_error()))
	{
		$error = "<font face=verdana size=2 color=red><b>O nome de usuário <font color=black>$_POST[NewUsername]</font> já está sendo usado!<br>Por favor, selecione outro!</b></font>";

		unset($_POST[NewUsername]);
	}
	elseif(ereg("key 3", mysql_error()))
	{
		$error = "<font face=verdana size=2 color=red><b>Você já está cadastrado!<br>Por favor, atualize sua conta!</b></font>";

		unset($_POST);
	}
	else
	{
		$last = mysql_insert_id();
		$_SESSION[NewAgent] = $last;

		//send an email
		$to = $_POST[email];
		$subject = "Seu cadastro em $_SERVER[HTTP_HOST]";
		$message = "Olá $_POST[FirstName] $_POST[LastName],\nvocê está recebendo este e-mail porque se cadastrou no site, guarde este e-mail: $_SERVER[HTTP_HOST]\n\nNome de usuário: $_POST[NewUsername]\nSenha: $_POST[p1]\n\nPara acessar o painel de controle dos usuários clique no link a seguir:\n$site_url/entrar.php\n\nObrigado por ter se cadastrado!";

		$headers = "MIME-Version: 1.0\n"; 
		$headers .= "Content-type: text/plain; charset=iso-8859-1\n";
		$headers .= "Content-Transfer-Encoding: 8bit\n"; 
		$headers .= "From: $_SERVER[HTTP_POST] <$aset[ContactEmail]>\n"; 
		$headers .= "X-Priority: 1\n"; 
		$headers .= "X-MSMail-Priority: High\n"; 
		$headers .= "X-Mailer: PHP/" . phpversion()."\n"; 

		mail($to, $subject, $message, $headers);

		header("location:entrar.php");
		exit();
	}

}

if(!empty($_GET[TipodeConta]))
{
	$TipodeConta = $_GET[TipodeConta];
}
else
{
	$TipodeConta = $_POST[TipodeConta];
}

//get the templates
require_once("templates/HeaderTemplate.php");
require_once("templates/RegistrationTemplate.php");
require_once("templates/FooterTemplate.php");

?>


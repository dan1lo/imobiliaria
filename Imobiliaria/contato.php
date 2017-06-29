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

//get the agent info
$q1 = "select * from re2_agents where AgentID = '$_GET[AgentID]' ";
$r1 = mysql_query($q1) or die(mysql_error());
$a1 = mysql_fetch_array($r1);

if(isset($_POST[s1]))
{
	$to = $a1[email];
	$subject = $_POST[subject];
	$message = $_POST[message];
	$message .= "\n\nAnúncio:\n$site_url/anuncio.php?id=$_GET[ListingID]\n\n";

	$headers = "MIME-Version: 1.0\n"; 
	$headers .= "Content-type: text/plain; charset=iso-8859-1\n";
	$headers .= "Content-Transfer-Encoding: 8bit\n"; 
	$headers .= "From: $_POST[u_name] <$_POST[u_email]>\n"; 
	$headers .= "X-Priority: 1\n"; 
	$headers .= "X-MSMail-Priority: High\n"; 
	$headers .= "X-Mailer: PHP/" . phpversion()."\n"; 

	mail($to, $subject, $message, $headers);

	$thankyou = "<center><b><br><br><br>Obrigado por entrar em contato, aguarde uma resposta em breve!<br><br><a class=RedLink href=\"$site_url/anuncio.php?id=$_GET[ListingID]\">Voltar</a></center>";


	//get the templates
	require_once("templates/EmailThankyouTemplate.php");

}


$AgentName = "$a1[FirstName] $a1[LastName]";

if(!empty($_GET[ListingID]))
{
	$SubjectLine = "Imóvel ID $_GET[ListingID]";
}


//get the templates
require_once("templates/EmailTemplate.php");

?>


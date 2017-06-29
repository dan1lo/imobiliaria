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

$ListingID = $_GET[id];

if(isset($_POST[s1]))
{
	$link = $_POST[MyRef];

	$to = $_POST[FriendsEmail];
	$subject = "Oferta de imóveis enviada por $_POST[YourName]";
	$message = $_POST[comments];
	$message .= "\n\nVEJA O ANÚNCIO:\n$site_url/anuncio.php?id=$link\n\n$site_url";

	$headers = "MIME-Version: 1.0\n"; 
	$headers .= "Content-type: text/plain; charset=iso-8859-1\n";
	$headers .= "Content-Transfer-Encoding: 8bit\n"; 
	$headers .= "From: $_POST[YourEmail]\n"; 
	$headers .= "X-Priority: 1\n"; 
	$headers .= "X-MSMail-Priority: High\n"; 
	$headers .= "X-Mailer: PHP/" . phpversion()."\n"; 

	mail($to, $subject, $message, $headers);

	require_once("templates/FriendOKTemplate.php");	

	exit();
}

require_once("templates/FriendTemplate.php");	

?>




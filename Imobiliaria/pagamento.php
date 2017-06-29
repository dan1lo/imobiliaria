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

if(empty($_GET[SelectedPackage]))
{
	header("location:precos.php?e=1&PaymentGateway=$_GET[PaymentGateway]");
}
elseif(empty($_GET[PaymentGateway]))
{
	header("location:precos.php?e=2&SelectedPackage=$_GET[SelectedPackage]");
}
else
{
	//get the price details
	$q1 = "select * from re2_prices where PriceID = '$_GET[SelectedPackage]' ";
	$r1 = mysql_query($q1) or die(mysql_error());
	$a1 = mysql_fetch_array($r1);

	//update the advertiser's record/credits
	$aexp =  mktime(0,0,0,date(m) + $a1[Duration],date(d),date(Y));

	//set the expire date
	$q1 = "update re2_agents set PriorityLevel = '$a1[PriorityLevel]', offers = '$a1[offers]', ExpDate = '$aexp' where AgentID = '$_SESSION[NewAgent]' ";
	mysql_query($q1) or die(mysql_error());

	//get the agent details
	$q1 = "select * from re2_agents where AgentID = '$_SESSION[AgentID]' ";
	$r1 = mysql_query($q1) or die(mysql_error());
	$a1 = mysql_fetch_array($r1);

	//get the price details
	$q2 = "select * from re2_prices, re2_priority where re2_prices.PriceID = '$_GET[SelectedPackage]' and re2_prices.PriorityLevel = re2_priority.PriorityLevel ";
	$r2 = mysql_query($q2) or die(mysql_error());
	$a2 = mysql_fetch_array($r2);

	if($_GET[PaymentGateway] == "paypal")
	{
		//paypal post
		header("location:https://www.paypal.com/xclick?business=$aset[PayPalEmail]&item_name=$a2[PackageName] for $a1[FisrtName] $a1[LastName] ($a1[username])&first_name=$a1[FirstName]&last_name=$a1[LastName]&email=$a1[email]&item_number=1&custom=$_SESSION[NewAgent]|$_GET[SelectedPackage]&amount=$a2[PriceValue]&notify_url=$site_url/notificacao.php&return=$site_url");

		exit();

	}
	elseif($_GET[PaymentGateway] == "stormpay")
	{
		header("location:https://www.stormpay.com/stormpay/handle_gen.php?generic=1&vendor_email=$aset[sp_vendor_email]&payee_email=$aset[sp_payee_email]&transaction_ref=$_SESSION[NewAgent]|$_GET[SelectedPackage]&product_name=$a2[PackageName] for $a1[FisrtName] $a1[LastName] ($a1[username])&amount=$a2[PriceValue]&require_IPN=1&notify_URL=$site_url/notificacao2.php&return_URL=$site_url");
      
		exit();
	}
	elseif($_GET[PaymentGateway] == "2checkout")
	{
		// 2checkout redirect
		header("location:https://www.2checkout.com/cgi-bin/sbuyers/cartpurchase.2c?sid=$aset[SellerID]&total=$a2[PriceValue]&cart_order_id=$_SESSION[NewAgent]|$_GET[SelectedPackage]&card_holder_name=$a1[FirstName] $a1[LastName]&email=$a1[email]&phone=$a1[phone]");	
	}
	else
	{
		//manual

		//send an email to the admin
		$to = $aset[ContactEmail];
		$subject = "Pedido de ativação de conta";
		$message = "Um cliente selecionou um pacote no site e pediu a ativação de sua conta\nVeja os detalhes:\n\n";
		$message .= "Nome de usuário: $a1[username]\nNome real: $a1[FirstName] $a1[LastName]\nPacote selecionado: $a2[PackageName] $a2[PriorityName], $a2[Duration] meses, $a2[offers] anúncios\n\n";

		$headers = "MIME-Version: 1.0\n"; 
		$headers .= "Content-type: text/plain; charset=iso-8859-1\n";
		$headers .= "Content-Transfer-Encoding: 8bit\n"; 
		$headers .= "From: $_SERVER[HTTP_HOST] <$aset[ContactEmail]>\n"; 
		$headers .= "X-Priority: 1\n"; 
		$headers .= "X-MSMail-Priority: High\n"; 
		$headers .= "X-Mailer: PHP/" . phpversion()."\n"; 

		mail($to, $subject, $message, $headers);		

		//get the templates
		require_once("templates/HeaderTemplate.php");
		require_once("templates/ManualTemplate.php");
		require_once("templates/FooterTemplate.php");
	}

}

?>
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
require_once("acesso.php");
require_once("includes.php");

if(isset($_POST[s1]))
{
	$q1 = "update re2_agents set 
						password = '$_POST[p1]',
						FirstName = '$_POST[FirstName]',
						LastName = '$_POST[LastName]',
						phone = '$_POST[phone]',
						cellular = '$_POST[cellular]',
						pager = '$_POST[pager]',
						email = '$_POST[email]',
						news = '$_POST[news]',
						NewsletterType = '$_POST[format]'

						where AgentID = '$_SESSION[AgentID]' ";

	mysql_query($q1);

	if(mysql_error())
	{
		echo mysql_error();
	}
	else
	{
		header("location:index.php");		
	}

}

//get the info
$q1 = "select * from re2_agents where AgentID = '$_SESSION[AgentID]' ";
$r1 = mysql_query($q1) or die(mysql_error());
$a1 = mysql_fetch_array($r1);

if($a1[news] == 'y')
{
	$ch1 = "checked";
}

if($a1[news] == 'n')
{
	$ch2 = "checked";
}

if($a1[NewsletterType] == 'html')
{
	$ch3 = "checked";
}

if($a1[NewsletterType] == 'plain')
{
	$ch4 = "checked";
}

/////////////////////////
/////							image block
/////////////////////////
$images = "";

if(!empty($a1[ResumeImages]))
{
	$images = explode("|", $a1[ResumeImages]);

	while(list(,$v2) = each($images))
	{
		$ImageBlock .= "<center><img src=\"fotos_anuncios/$v2\"><br><a class=RedLink href=\"DeleteRI.php?file=$v2\">Deletar</a></center><br><br>";

		$i++;
	}
}

if($i < '5')
{
	for($z = '1'; $z <= (5 - $i); $z++)
	{
		$ImageBlock .= "<input type=file name=\"ResumeImages[]\"><br>\n";
	}
}


//get the templates
require_once("templates/HeaderTemplate.php");
require_once("templates/Profile2Template.php");
require_once("templates/FooterTemplate.php");

?>


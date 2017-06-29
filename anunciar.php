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

//get the categories
$q1 = "select * from re2_categories order by CategoryName";
$r1 = mysql_query($q1) or die(mysql_error());

if(mysql_num_rows($r1) > '0')
{
	$SelectCategory = "<select name=SelectCategory>\n\t<option value=\"\"></option>\n\t";

	while($a1 = mysql_fetch_array($r1))
	{
		//get the subcategories
		$q2 = "select * from re2_subcategories where CategoryID = '$a1[CategoryID]' order by SubcategoryName ";
		$r2 = mysql_query($q2) or die(mysql_error());

		if(mysql_num_rows($r2) > '0')
		{
			while($a2 = mysql_fetch_array($r2))
			{
				$SelectCategory .= "<option value=\"$a1[CategoryID]|$a2[SubcategoryID]\">$a1[CategoryName] - $a2[SubcategoryName]</option>\n";
			}
		}

	}

	$SelectCategory .= "</select>\n";
}

$countries = array('Afghanistan', 'Albania', 'American Samoa', 'Andorra', 'Antigua', 'Argentina', 'Armenia', 'Australia', 'Austria', 'Azerbaijan', 'Bahrain', 'Bangladesh', 'Barbados', 'Belarus', 'Belgium', 'Belize', 'Bolivia', 'Bosnia-Herzegovina', 'BRASIL', 'Brunei Darussalam', 'Bulgaria', 'Cambodia', 'Canada', 'Chile', 'China', 'Colombia', 'Costa Rica', 'Croatia', 'Cuba', 'Cyprus', 'Czech Republic', 'Denmark', 'Ecuador', 'Egypt', 'El Salvador', 'Estonia', 'Falkland Islands', 'Fiji', 'Finland', 'France', 'French Guyana', 'Georgia', 'Germany', 'Gibraltar', 'Greece', 'Greenland', 'Grenada', 'Guatemala', 'Honduras', 'Hong Kong', 'Hungary', 'Iceland', 'India', 'Indonesia', 'Iran', 'Iraq', 'Ireland', 'Israel', 'Italy', 'Japan', 'Jordan', 'Kazakhstan', 'Kenya', 'Kuwait', 'Kyrgyzstan', 'Laos', 'Latvia', 'Lebanon', 'Libya', 'Liechtenstein', 'Lithuania', 'Luxembourg', 'Malaysia', 'Maldives', 'Malta', 'Mauritius', 'Mexico', 'Mongolia', 'Morocco', 'Nepal', 'Netherlands', 'New Zealand', 'Nicaragua', 'North Korea', 'Norway', 'Oman', 'Pakistan', 'Panama', 'Paraguay', 'Peru', 'Philippines', 'Poland', 'Portugal', 'Puerto Rico', 'Qatar', 'Romania', 'Russian Federation', 'Saudi Arabia', 'Singapore', 'Slovak Republic', 'Slovenia', 'South Africa', 'South Korea', 'Spain', 'Sri Lanka', 'Sweden', 'Switzerland', 'Syria', 'Taiwan', 'Thailand', 'Tunisia', 'Turkey', 'Turkmenistan', 'Ukraine', 'United Arab Emirates', 'United Kingdom', 'United States', 'Uruguay', 'Uzbekistan', 'Venezuela', 'Vietnam', 'Yemen', 'Yugoslavia', 'Zimbabwe');

$SelectCountry = "<select name=country>\n\t<option value=\"\"></option>\n\t";

while(list(,$v) = each($countries))
{
	$SelectCountry .= "<option value=\"$v\">$v</option>\n\t";
}

$SelectCountry .= "</select>";



require_once("templates/HeaderTemplate.php");
require_once("templates/PostOfferTemplate.php");	
require_once("templates/FooterTemplate.php");

?>


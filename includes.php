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


$q1 = "update re2_agents set AccountStatus = 'pending' where ExpDate <= '$t' and AccountStatus != 'pending' ";
mysql_query($q1) or die(mysql_error());

//get the settings
$qset = "select * from re2_settings";
$rset = mysql_query($qset) or die(mysql_error());
$aset = mysql_fetch_array($rset);

//get the categories 
$qi = "select * from re2_categories order by CategoryName";
$ri = mysql_query($qi) or die(mysql_error());

$Account = "<table width=168>\n";

if(mysql_num_rows($ri) > '0')
{
	while($ai = mysql_fetch_array($ri))
	{
        $Categories .= "<tr>\n\t<td background=images/menu2.gif><a class=Menu_princ href=\"buscador.php?c=$ai[CategoryID]\">$ai[CategoryName]</a></td>\n</tr>\n";
		
		//get the subcategories
		$qs = "select * from re2_subcategories where CategoryID = '$ai[CategoryID]' order by SubcategoryName ";
		$rs = mysql_query($qs) or die(mysql_error());

		if(mysql_num_rows($rs) > '0')
		{
			while($as = mysql_fetch_array($rs))
			{
				$Categories .= "<tr>\n\t<td align=left onmouseover=\"this.style.background='EFB8B8'\" onmouseout=\"this.style.background='white'\"><a class=SubCatLinksB href=\"buscador.php?c=$ai[CategoryID]&s=$as[SubcategoryID]\">$as[SubcategoryName]</a></td>\n</tr>\n";
			}
		}

	}

	if(empty($_SESSION[AgentID]))
	{
		echo ("");
	}
	else
	{
		if($_SESSION[TipodeConta] == '1')
		{
			$Account .= "<tr>\n\t<td bgcolor=FEBF00><a class=BlackLink href=\"perfil.php\">Editar perfil</a></td>\n</tr>\n";
		$Account .= "<tr>\n\t<td bgcolor=FEBF00><a class=BlackLink href=\"banners.php\">Banners</a></td>\n</tr>\n";
		}
		else
		{
			$Account .= "<tr>\n\t<td bgcolor=FEBF00><a class=BlackLink href=\"perfil2.php\">Editar perfil</a></td>\n</tr>\n";
			
		
		}

		$Account .= "<tr>\n\t<td bgcolor=FEBF00><a class=BlackLink href=\"controle.php\">Controle de anúncios</a></td>\n</tr>\n";		


		//get the number of posted listings
		$qpl = "select count(*) from re2_listings where AgentID = '$_SESSION[AgentID]' ";
		$rpl = mysql_query($qpl) or die(mysql_error());
		$apl = mysql_fetch_array($rpl);

		$ace = date('d M Y', $_SESSION[AccountExpireDate]);

		$after = ($_SESSION[AccountExpireDate] - $t)/(24*60*60);

		if($after <= '10')
		{
			$RenewAccount = "<br><a class=RedLink href=\"precos2.php\">Renovar Conta</a><br>";
		}

		$Account .= "<tr>\n\t<td bgcolor=FEBF00><a class=BlackLink href=\"sair.php\">Sair</a></td>\n</tr>\n<tr>\n\t<td>Anúncios: $apl[0]/$_SESSION[MaxOffers]</td>\n</tr>\n<tr>\n\t<td>Sua conta expira dia:</td>\n</tr>\n<tr>\n\t<td align=right>$ace</td>\n</tr>\n<tr>\n\t<td align=center>$RenewAccount</td>\n</tr>\n";		
	}

	$Categories .= "</table>\n";

}

if(ereg("index.php", $_SERVER[SCRIPT_NAME]))
{
	$qrand = "select * from re2_listings, re2_agents where re2_listings.AgentID = re2_agents.AgentID and  re2_listings.image != '' and re2_agents.AccountStatus = 'active' order by rand() limit 0,1 ";
	$rrand = mysql_query($qrand) or die(mysql_error());

	if(mysql_num_rows($rrand) > '0')
	{
		$arand = mysql_fetch_array($rrand);

		$rimage = explode("|", $arand[image]);

		$RandomProperty .= "<table width=150 align=center cellspacing=0 bordercolor=336699 border=1>\n<tr>\n\t<td  style=\"padding:10\" width=125 align=center valign=top><a href=\"anuncio.php?id=$arand[ListingID]\" class=BlueLink><img src=\"fotos_anuncios/$rimage[0]\" width=75 height=60 border=0><br>$arand[city]<br>$arand[country]</a></td>\n</tr>\n</table>\n\n";
	}
}

//send emails to the expire agents

//			10 days to the Expire Date (ExpDate)
$ten1 = mktime(0,0,0,date(m),date(d) + 10,date(Y));
$ten2 = mktime(23,59,59,date(m),date(d) + 10,date(Y));

$qexp = "select * from re2_agents where ExpDate between '$ten1' and '$ten2' and days10 = 'n' ";
$rexp = mysql_query($qexp) or die(mysql_error());

if(mysql_num_rows($rexp) > '0')
{
	while($aexp = mysql_fetch_array($rexp))
	{
		//send an email
		$to = $aexp[email];
		$subject = "10 dias para expirar!";
		$message = "Olá $aexp[FirstName] $aexp[LastName],\nsua conta em $_SERVER[HTTP_HOST] expirará em 10 dias!\n\nPara renovar sua conta, entre com seu nome de usuário e senha e vá em \"Renovar Conta\" .\n\nObrigado!\n$_SERVER[HTTP_HOST]";

		$headers = "MIME-Version: 1.0\n"; 
		$headers .= "Content-type: text/plain; charset=iso-8859-1\n";
		$headers .= "Content-Transfer-Encoding: 8bit\n"; 
		$headers .= "From: $_SERVER[HTTP_POST] <$aset[ContactEmail]>\n"; 
		$headers .= "X-Priority: 1\n"; 
		$headers .= "X-MSMail-Priority: High\n"; 
		$headers .= "X-Mailer: PHP/" . phpversion()."\n"; 

		mail($to, $subject, $message, $headers);

		mysql_query("update re2_agents set days10 = 'y' where AgentID = '$aexp[AgentID]' ") or die(mysql_error());
	}
}

//			5 days to the Expire Date (ExpDate)
$five1 = mktime(0,0,0,date(m),date(d) + 5,date(Y));
$five2 = mktime(23,59,59,date(m),date(d) + 5,date(Y));

$qexp = "select * from re2_agents where ExpDate between '$five1' and '$five2' and days5 = 'n' ";
$rexp = mysql_query($qexp) or die(mysql_error());

if(mysql_num_rows($rexp) > '0')
{
	while($aexp = mysql_fetch_array($rexp))
	{
		//send an email
		$to = $aexp[email];
		$subject = "5 dias para expirar!";
		$message = "Olá $aexp[FirstName] $aexp[LastName],\nsua conta em $_SERVER[HTTP_HOST] perderá a validade em 5 dias!\n\nPara renovar sua conta, entre no sistema com seu nome de usuário e senha e clique em \"Renovar Conta\".\n\nObrigado!\n$_SERVER[HTTP_HOST]";

		$headers = "MIME-Version: 1.0\n"; 
		$headers .= "Content-type: text/plain; charset=iso-8859-1\n";
		$headers .= "Content-Transfer-Encoding: 8bit\n"; 
		$headers .= "From: $_SERVER[HTTP_POST] <$aset[ContactEmail]>\n"; 
		$headers .= "X-Priority: 1\n"; 
		$headers .= "X-MSMail-Priority: High\n"; 
		$headers .= "X-Mailer: PHP/" . phpversion()."\n"; 

		mail($to, $subject, $message, $headers);

		mysql_query("update re2_agents set days5 = 'y' where AgentID = '$aexp[AgentID]' ") or die(mysql_error());
	}
}

//			1 day to the Expire Date (ExpDate)
$one1 = mktime(0,0,0,date(m),date(d) + 1,date(Y));
$one2 = mktime(23,59,59,date(m),date(d) + 1,date(Y));

$qexp = "select * from re2_agents where ExpDate between '$one1' and '$one2' and days1 = 'n' ";
$rexp = mysql_query($qexp) or die(mysql_error());

if(mysql_num_rows($rexp) > '0')
{
	while($aexp = mysql_fetch_array($rexp))
	{
		//send an email
		$to = $aexp[email];
		$subject = "1 dia para expirar!";
		$message = "Olá $aexp[FirstName] $aexp[LastName],\nsua conta em $_SERVER[HTTP_HOST] perderá a validade em 1 dia!\n\nPara renovar sua conta, entre no sistema com seu nome de usuário e senha e clique em \"Renovar Conta\".\n\nObrigado!\n$_SERVER[HTTP_HOST]";

		$headers = "MIME-Version: 1.0\n"; 
		$headers .= "Content-type: text/plain; charset=iso-8859-1\n";
		$headers .= "Content-Transfer-Encoding: 8bit\n"; 
		$headers .= "From: $_SERVER[HTTP_POST] <$aset[ContactEmail]>\n"; 
		$headers .= "X-Priority: 1\n"; 
		$headers .= "X-MSMail-Priority: High\n"; 
		$headers .= "X-Mailer: PHP/" . phpversion()."\n"; 

		mail($to, $subject, $message, $headers);

		mysql_query("update re2_agents set days1 = 'y' where AgentID = '$aexp[AgentID]' ") or die(mysql_error());
	}
}

//		1 day AFTER the Expire Date (ExpDate) WAS PASSED

//$qexp = "select * from re2_agents where ExpDate > ExpDate + 86400 and days1 = 'y' ";
$qexp = "select * from re2_agents where (($t - ExpDate) > 86400) and days1 = 'y' ";
$rexp = mysql_query($qexp) or die(mysql_error());

if(mysql_num_rows($rexp) > '0')
{
	while($aexp = mysql_fetch_array($rexp))
	{
		$DelAgents[] = $aexp[AgentID];

		//get the agent's listings with images
		$q2 = "select * from re2_listings where AgentID = '$aexp[AgentID]' and image != '' ";
		$r2 = mysql_query($q2) or die(mysql_error());

		if(mysql_num_rows($r2) > '0')
		{
			while($a2 = mysql_fetch_array($r2))
			{
				$DelImages[] = explode("|", $a2[image]);

				while(list(,$v) = each($DelImages))
				{
					//delete the images from our server
					unlink("fotos_anuncios/$v");
				}
			}

			//delete the listings from our database
			$q3 = "delete from re2_listings where AgentID = '$aexp[AgentID]' ";
			mysql_query($q3) or die(mysql_error());

			//delete the agent's banners
			$q4 = "select * from re2_banners where ClientID = '$aexp[AgentID]' ";
			$r4 = mysql_query($q4) or die(mysql_error());

			if(mysql_num_rows($r4) > '0')
			{
				while($a4 = mysql_fetch_array($r4))
				{
					//delete the banners fromour server
					unlink("banners/$a4[BannerFile]");
					$BannerIDs[] = $a4[BannerID];
				}

				$DelBan = implode("', '", $BannerIDs);

				//delete banner info
				$q5 = "delete from re2_banners where ClientID = '$aexp[AgentID]' ";
				mysql_query($q5) or die(mysql_error());

				//delete stats
				$q6 = "delete from re2_stats where BannerID in ('$DelBan') ";
				mysql_query($q6) or die(mysql_error());

			}
		}

	}

	$DelStr = implode("', '", $DelAgents);
	mysql_query("delete from re2_agents where AgentID in ('$DelStr')") or die(mysql_error());
}

function ptypes($x) {

	$qt = "select * from re2_types order by TypeName";
	$rt = mysql_query($qt) or die(mysql_error());

	if(mysql_num_rows($rt) > '0')
	{
		$SelectType = "<select name=PropertyType>\n\t<option value=\"\"></option>\n\t";

		while($at = mysql_fetch_array($rt))
		{
			if($x != "0")
			{
				if($at[TypeName] == $x)
				{
					$SelectType .= "<option value=\"$at[TypeName]\" selected>$at[TypeName]</option>\n\t";
				}
				else
				{
					$SelectType .= "<option value=\"$at[TypeName]\">$at[TypeName]</option>\n\t";
				}
			}
			else
			{
				$SelectType .= "<option value=\"$at[TypeName]\">$at[TypeName]</option>\n\t";
			}
		}

		$SelectType .= "</select>";
	}

	return $SelectType;

}

?>
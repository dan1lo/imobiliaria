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
require_once("acesso.php");


/*

											By day
						raw											unique
				impressions/clicks/rato			impressions/clicks/rato

*/

////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////																				BY  TOTAL
////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////
//////////////////////////				TODAY
//////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////

$t1 = mktime(0,0,0,date(m), date(d), date(Y));
$t2 = mktime(23, 59, 59, date(m), date(d), date(Y));

$q1 = "select sum(impressions) from re2_stats where BannerID = '$_GET[BannerID]' and mydate between '$t1' and '$t2' ";
$r1 = mysql_query($q1) or die(mysql_error());
$a1 = mysql_fetch_array($r1);

if($a1[0] > '0')
{
	$TodayRawImpressions = $a1[0];
}
else
{
	$TodayRawImpressions = "0";
}

$q1 = "select sum(clicks) from re2_stats where BannerID = '$_GET[BannerID]' and mydate between '$t1' and '$t2' ";
$r1 = mysql_query($q1) or die(mysql_error());
$a1 = mysql_fetch_array($r1);

if($a1[0] > '0')
{
	$TodayRawClicks = $a1[0];
}
else
{
	$TodayRawClicks = "0";
}

if($TodayRawImpressions > '0')
{
	$TodayRawRato = number_format(($TodayRawClicks/$TodayRawImpressions)*100, 2, ",", "");
}
else
{
	$TodayRawRato = "0.00";
}

$q1 = "select distinct(ip) from re2_stats where BannerID = '$_GET[BannerID]' and impressions > '0' and mydate between '$t1' and '$t2' ";
$r1 = mysql_query($q1) or die(mysql_error());
$a1 = mysql_num_rows($r1);

$TodayUniImpressions = $a1;

$q1 = "select distinct(clicks) from re2_stats where BannerID = '$_GET[BannerID]' and clicks > '0' and mydate between '$t1' and '$t2' ";
$r1 = mysql_query($q1) or die(mysql_error());
$a1 = mysql_num_rows($r1);

$TodayUniClicks = $a1;

if($TodayUniImpressions > '0')
{
	$TodayUniRato = number_format(($TodayUniClicks/$TodayUniImpressions)*100, 2, ",", "");
}
else
{
	$TodayUniRato = "0.00";
}


////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////
//////////////////////////				THIS    MONTH
//////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////

$LastDay = date('t', mktime(0,0,0,date(m),0,date(Y)));

$t1 = mktime(0,0,0,date(n), 1, date(Y));
$t2 = mktime(23, 59, 59, date(n), $LastDay, date(Y));

$q1 = "select sum(impressions) from re2_stats where BannerID = '$_GET[BannerID]' and mydate between '$t1' and '$t2' ";
$r1 = mysql_query($q1) or die(mysql_error());
$a1 = mysql_fetch_array($r1);

if($a1[0] > '0')
{
	$tmRawImpressions = $a1[0];
}
else
{
	$tmRawImpressions = "0";
}

$q1 = "select sum(clicks) from re2_stats where BannerID = '$_GET[BannerID]' and mydate between '$t1' and '$t2' ";
$r1 = mysql_query($q1) or die(mysql_error());
$a1 = mysql_fetch_array($r1);

if($a1[0] > '0')
{
	$tmRawClicks = $a1[0];
}
else
{
	$tmRawClicks = "0";
}

if($tmRawImpressions > '0')
{
	$tmRawRato = number_format(($tmRawClicks/$tmRawImpressions)*100, 2, ",", "");
}
else
{
	$tmRawRato = "0.00";
}

$q1 = "select distinct(ip) from re2_stats where BannerID = '$_GET[BannerID]' and impressions > '0' and mydate between '$t1' and '$t2' ";
$r1 = mysql_query($q1) or die(mysql_error());
$a1 = mysql_num_rows($r1);

$tmUniImpressions = $a1;

$q1 = "select distinct(clicks) from re2_stats where BannerID = '$_GET[BannerID]' and clicks > '0' and mydate between '$t1' and '$t2' ";
$r1 = mysql_query($q1) or die(mysql_error());
$a1 = mysql_num_rows($r1);

$tmUniClicks = $a1;

if($tmUniImpressions > '0')
{
	$tmUniRato = number_format(($tmUniClicks/$tmUniImpressions)*100, 2, ",", "");
}
else
{
	$tmUniRato = "0.00";
}


////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////																				BY  Month
////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////

//get the months
$qm = "select mydate from re2_stats where BannerID = '$_GET[BannerID]' order by mydate desc";
$rm = mysql_query($qm) or die(mysql_error());

while($am = mysql_fetch_array($rm))
{
	$MyMonths[] = date('n/Y', $am[mydate]);
}

if(count($MyMonths) > '0')
{
	$NewMonths = array_unique($MyMonths);

	while(list($k,$v) = each($NewMonths))
	{
		$date_info = explode("/", $v);

		$LastDay = date('t', mktime(0,0,0,$date_info[0],1,date(Y)));

		$t1 = mktime(0,0,0,$date_info[0], 1, date(Y));
		$t2 = mktime(23, 59, 59, $date_info[0], $LastDay, date(Y));

		$q1 = "select sum(impressions) from re2_stats where BannerID = '$_GET[BannerID]' and mydate between '$t1' and '$t2' ";
		$r1 = mysql_query($q1) or die(mysql_error());
		$a1 = mysql_fetch_array($r1);

		if($a1[0] > '0')
		{
			$mRawImpressions = $a1[0];
		}
		else
		{
			$mRawImpressions = "0";
		}	

		$q1 = "select sum(clicks) from re2_stats where BannerID = '$_GET[BannerID]' and mydate between '$t1' and '$t2' ";

		$r1 = mysql_query($q1) or die(mysql_error());
		$a1 = mysql_fetch_array($r1);

		if($a1[0] > '0')
		{
			$mRawClicks = $a1[0];
		}
		else
		{
			$mRawClicks = "0";
		}

		if($mRawImpressions > '0')
		{
			$mRawRato = number_format(($mRawClicks/$mRawImpressions)*100, 2, ",", "");
		}
		else
		{
			$mRawRato = "0.00";
		}

		$q1 = "select distinct ip from re2_stats where BannerID = '$_GET[BannerID]' and impressions > '0' and mydate between '$t1' and '$t2' ";
		$r1 = mysql_query($q1) or die(mysql_error());

		$a1 = mysql_num_rows($r1);

		$mUniImpressions = $a1;

		$q1 = "select distinct(clicks) from re2_stats where BannerID = '$_GET[BannerID]' and clicks > '0' and mydate between '$t1' and '$t2' ";
		$r1 = mysql_query($q1) or die(mysql_error());
		$a1 = mysql_num_rows($r1);

		$mUniClicks = $a1;

		if($mUniImpressions > '0')
		{
			$mUniRato = number_format(($mUniClicks/$mUniImpressions)*100, 2, ",", "");
		}
		else
		{
			$mUniRato = "0.00";
		}

	
		$ByMonth .= "	<tr>
								<td>$v</td>
								<td align=center width=100>$mRawImpressions</td>
								<td align=center width=100>$mRawClicks</td>
								<td align=right width=100>$mRawRato %</td>

								<td align=center width=100>$mUniImpressions</td>
								<td align=center width=100>$mUniClicks</td>
								<td align=right width=100>$mUniRato %</td>
						</tr>";

		$TotalRawImpressions = $TotalRawImpressions + $mRawImpressions;
		$TotalRawClicks = $TotalRawClicks + $mRawClicks;

		$TotalUniImpressions = $TotalUniImpressions + $mUniImpressions; 
		$TotalUniClicks = $TotalUniClicks + $mUniClicks;
	}
}

		if($TotalRawImpressions > '0')
		{
			$TotalRawRato = number_format(($TotalRawClicks/$TotalRawImpressions)*100, 2, ",", "");
		}
		else
		{
			require_once("templates/HeaderTemplate.php");
			require_once("templates/NoStatsTemplate.php");
			require_once("templates/FooterTemplate.php");
		
			exit();
			$TotalRawRato = "0.00";
		}

		if($TotalUniImpressions > '0')
		{
			$TotalUniRato = number_format(($TotalUniClicks/$TotalUniImpressions)*100, 2, ",", "");
		}
		else
		{
			$TotalUniRato = "0.00";
		}

		


////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////																				BY  Day
////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////

//get the months
$qm = "select mydate from re2_stats where BannerID = '$_GET[BannerID]' order by mydate desc";
$rm = mysql_query($qm) or die(mysql_error());

while($am = mysql_fetch_array($rm))
{
	$MyDays[] = date('n/d/Y', $am[mydate]);
}

if(count($MyDays) > '0')
{
	$NewDays = array_unique($MyDays);

	while(list($k2,$v2) = each($NewDays))
	{

		$date_info = explode("/", $v2);

		$t1 = mktime(0,0,0,$date_info[0], $date_info[1], date(Y));
		$t2 = mktime(23, 59, 59, $date_info[0], $date_info[1], date(Y));

		$q1 = "select sum(impressions) from re2_stats where BannerID = '$_GET[BannerID]' and mydate between '$t1' and '$t2' ";
		$r1 = mysql_query($q1) or die(mysql_error());
		$a1 = mysql_fetch_array($r1);

		if($a1[0] > '0')
		{
			$dRawImpressions = $a1[0];
		}
		else
		{
			$dRawImpressions = "0";
		}	

		$q1 = "select sum(clicks) from re2_stats where BannerID = '$_GET[BannerID]' and mydate between '$t1' and '$t2' ";

		$r1 = mysql_query($q1) or die(mysql_error());
		$a1 = mysql_fetch_array($r1);

		if($a1[0] > '0')
		{
			$dRawClicks = $a1[0];
		}
		else
		{
			$dRawClicks = "0";
		}

		if($dRawImpressions > '0')
		{
			$dRawRato = number_format(($dRawClicks/$dRawImpressions)*100, 2, ",", "");
		}
		else
		{
			$dRawRato = "0.00";
		}

		$q1 = "select distinct ip from re2_stats where BannerID = '$_GET[BannerID]' and impressions > '0' and mydate between '$t1' and '$t2' ";
		$r1 = mysql_query($q1) or die(mysql_error());

		$a1 = mysql_num_rows($r1);

		$dUniImpressions = $a1;

		$q1 = "select distinct(clicks) from re2_stats where BannerID = '$_GET[BannerID]' and clicks > '0' and mydate between '$t1' and '$t2' ";
		$r1 = mysql_query($q1) or die(mysql_error());
		$a1 = mysql_num_rows($r1);

		$dUniClicks = $a1;

		if($dUniImpressions > '0')
		{
			$dUniRato = number_format(($dUniClicks/$dUniImpressions)*100, 2, ",", "");
		}
		else
		{
			$dUniRato = "0.00";
		}

	
		$ByDay .= "	<tr>
								<td>$v2</td>
								<td align=center width=100>$dRawImpressions</td>
								<td align=center width=100>$dRawClicks</td>
								<td align=right width=100>$dRawRato %</td>

								<td align=center width=100>$dUniImpressions</td>
								<td align=center width=100>$dUniClicks</td>
								<td align=right width=100>$dUniRato %</td>
						</tr>";

	}
}

	require_once("templates/HeaderTemplate.php");
	require_once("templates/ViewStatsTemplate.php");
	require_once("templates/FooterTemplate.php");

?>


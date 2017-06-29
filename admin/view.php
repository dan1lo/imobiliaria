<?
require_once("../configuracao_mysql.php");
require_once("acesso.php");

if(isset($_POST[al]))
{
	$MyID = implode("', '", $_POST[ApproveID]);

	$q1 = "update coupons_listings set ListingStatus = 'approved' where ListingID in ('$MyID') ";
	mysql_query($q1) or die(mysql_error());
}

include_once("LeftStyles.php");

//get the company info
$q1 = "select * from coupons_users where UserID = '$_GET[BusinessID]' ";
$r1 = mysql_query($q1) or die(mysql_error());
$a1 = mysql_fetch_array($r1);

$CompanyName = $a1[CompanyName];

$CompanyInfo = "$a1[Address],<br>\n$a1[City], $a1[State] $a1[ZipCode]<br>\nPhone: $a1[Phone]";

if(!empty($a1[Fax]))
{
	$CompanyInfo .= ", Fax: $a1[Fax]";
}

$CompanyInfo .= "\n<br>Contact person: $a1[FirstName] $a1[LastName]<br>\nEmail: <a class=BlackLink href=\"mailto:$a1[Email]\">$a1[Email]</a>";

//get the coupons
$q2 = "select coupons_listings.*, coupons_categories.*, coupons_subcategories.* from coupons_listings 
					left join coupons_categories on coupons_listings.CategoryID = coupons_categories.CategoryID
					left join coupons_subcategories on coupons_listings.SubcategoryID = coupons_subcategories.SubcategoryID

					where coupons_listings.BusinessID = '$_GET[BusinessID]' ";

$r2 = mysql_query($q2) or die(mysql_error());

if(mysql_num_rows($r2) > '0')
{
	$Coupons .= "<form method=post>";

	while($a2 = mysql_fetch_array($r2))
	{
		$ExpDate = date('M-d-Y', $a2[DateExpired]);

		$CatInfo = $a2[CategoryName];

		if(!empty($a2[SubcategoryName]))
		{
			$CatInfo .= " / $a2[SubcategoryName]";
		}

		$Coupons .= "<table align=center width=500 cellspacing=0 cellpadding=0 border=1 bordercolor=black rules=none>\n";

		if($a2[ListingStatus] == "unapproved")
		{
			$un++;
			$Coupons .= "<caption align=left><input type=checkbox name=\"ApproveID[]\" value=\"$a2[ListingID]\">select to approve this listing</caption>";	
		}

		$Coupons .= "<tr style=\"background-color:black; color:white; font-family:verdana; font-size:11; font-weight:bold\">\n\t<td colspan=2 align=right>Sua conta expira Dia: $ExpDate</td>\n</tr>\n\n";
		$Coupons .= "<tr>\n\t<td colspan=2 align=center style=\"padding:5,0,5,0\"><font size=3 face=verdana><b>$a2[Title]</b></font><br><font size=2>$CatInfo</font></td>\n</tr>\n\n";
		$Coupons .= "<tr>\n\t<td width=250>";

		if(!empty($a2[Photo]))
		{
			$Coupons .= "<center><img src=\"../coupons_images/$a2[Photo]\"></center>";
		}
		else
		{
			$Coupons .= "&nbsp;";
		}

		$MyDesc = nl2br($a2[Description]);

		$Coupons .= "</td>\n\t<td width=250 align=center>$MyDesc</td>\n</tr>\n";
		$Coupons .= "<tr>\n\t<td colspan=2 align=center style=\"padding:5,0,5,0\"><font size=1 face=verdana>$a1[Address], $a1[City], $a1[State] $a1[ZipCode], Phone: $a1[Phone]</font></td>\n</tr>\n\n";
		$Coupons .= "\n</table>\n\n<br>\n\n";

	}

	if(isset($un))
	{
		$submit = "<input type=submit name=al value=\"Approve selected\">";
	}
}

?>

<table align=center width=500>
<tr>
	<td><h3><b><?=$CompanyName?></b></h3></td>
</tr>

<tr>
	<td><?=$CompanyInfo?><br><?=$map?></td>
</tr>

<tr>
	<td><?=$Coupons?></td>
</tr>

<tr>
	<td colspan=2 align=center>
		<?=$submit?>
	</td>
</tr>

</table>
</form>
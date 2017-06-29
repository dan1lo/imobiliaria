<?
require_once("../configuracao_mysql.php");
require_once("acesso.php");

if(isset($_POST[s1]))
{

	$q1 = "update re2_agents set AccountStatus = '$_POST[AccountStatus]' where AgentID = '$_GET[AgentID]' ";
	mysql_query($q1) or die(mysql_error());

	header("location:UnapprovedUsers.php");
	exit();
}

if(isset($_POST[s2]))
{
	//get the images
	$q1 = "select logo, ResumeImages from re2_agents where AgentID = '$_GET[AgentID]' ";
	$r1 = mysql_query($q1) or die(mysql_error());
	$a1 = mysql_fetch_array($r1);

	//delete the logo file
	if(!empty($a1[logo]))
	{
		unlink("../fotos_anuncios/$a1[logo]");
	}

	//delete the resume images
	if(!empty($a1[ResumeImages]))
	{
		$images = explode("|", $a1[ResumeImages]);

		while(list(,$v) = each($images))
		{
			unlink("../fotos_anuncios/$v");
		}
	}

	$q1 = "delete from re2_agents where AgentID = '$_GET[AgentID]' ";
	mysql_query($q1) or die(mysql_error());

	header("location:UnapprovedUsers.php");
	exit();
}

if(isset($_POST[s3]))
{
	header("location:EditUser.php?AgentID=$_GET[AgentID]");
	exit();
}

include_once("LeftStyles.php");


//get the user info
$q1 = "select * from re2_agents where AgentID = '$_GET[AgentID]' ";
$r1 = mysql_query($q1) or die(mysql_error());
$a1 = mysql_fetch_array($r1);


if($a1[ExpDate] > '0')
{
	$ExpDate = date('d/M/Y', $a1[ExpDate]);
}
else
{
	$ExpDate = "<span class=RedLink>This user did not finished the registration process!";
}
?>

<form method=post>
<table align=center width=500>
<caption align=center>

	<?
	if(!empty($a1[logo]))
	{
		echo "<center><img src=\"../fotos_anuncios/$a1[logo]\"></center>";
	}
	?>

</caption>

<tr>
	<td align=center><font face=verdana size=3><b><?=$a1[FirstName]?> <?=$a1[LastName]?></b></font></td>
</tr>


<tr>
	<td><?=nl2br($a1[resume]);?></td>
</tr>

<tr>
	<td>Telefone: 
		<?
			echo $a1[phone];

			if(!empty($a1[cellular]))
			{
				echo ", Cellular: $a1[cellular]";
			}

			if(!empty($a1[pager]))
			{
				echo ", Pager: $a1[pager]";
			}
			
		?>
	</td>
</tr>

<tr>
	<td>
		E-mail: <a class=BlackLink href="mailto:<?=$a1[email]?>"><?=$a1[email]?></a>

		<?
		
		if($a1[news] == "y")
		{
			echo " (*Assinante da Newsletter)";
		}

		?>
	</td>
</tr>

<tr>
	<td>
	
	<?
	if(!empty($a1[ResumeImages]))
	{
		$MyImages = explode("|", $a1[ResumeImages]);

		while(list(,$v) = each($MyImages))
		{
			echo "<img src=\"../fotos_anuncios/$v\"> ";
		}
	}

	?>

	</td>
</tr>

<tr>
	<td>Condição da conta: 

			<select name=AccountStatus>
				<option value="pending" <? if($a1[AccountStatus] == "pending") { echo "selected"; } ?>>Pendente</option>
				<option value="active" <? if($a1[AccountStatus] == "active") { echo "selected"; } ?>>Ativa</option>
			</select>

			<input type=submit name=s1 value="ATUALIZAR">
	</td>
</tr>

<tr>
	<td>Cadastrado em: <?=date('d/M/Y', $a1[RegDate]);?></td>
</tr>

<tr>
	<td>A conta expira dia: <?=$ExpDate?></td>
</tr>

<tr>
	<td>Prioridade: 
	<?
	//get the priority level name
	$qp = "select * from re2_priority where PriorityLevel = '$a1[PriorityLevel]' ";
	$rp = mysql_query($qp) or die(mysql_error());
	$ap = mysql_fetch_array($rp);

	echo "$ap[PriorityName], $a1[offers] anúncios";
	?>

	</td>
</tr>

<tr>
	<td align=center>
		<input type=submit name=s2 value="Deletar usuário">&nbsp;&nbsp;&nbsp;
		<input type=submit name=s3 value="Editar">
	</td>
</tr>

</table>
</form>

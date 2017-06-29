<br>

<center>
	<h3>Statistic information</h3>
	<img src="banners/<?=$_GET[file]?>" border=1>

</center>

<table align=center width=510 border=1 cellspacing=0 bordercolor=#CCCCCC>
<caption align=center>Total</caption>

<tr>
	<td rowspan=2>&nbsp;</td>
	<td align=center colspan=3  width=300>raw</td>
	<td align=center colspan=3 width=300>unique</td>
</tr>

<tr>
	<td align=center width=100>impress.</td>
	<td align=center width=100>clicks</td>
	<td align=center width=100>rato</td>

	<td align=center width=100>impress.</td>
	<td align=center width=100>clicks</td>
	<td align=center width=100>rato</td>
</tr>

<tr>
	<td>TOTAL: </td>
	<td align=center width=100><?=$TotalRawImpressions?></td>
	<td align=center width=100><?=$TotalRawClicks?></td>
	<td align=right width=100><?=$TotalRawRato?> %</td>

	<td align=center width=100><?=$TotalUniImpressions?></td>
	<td align=center width=100><?=$TotalUniClicks?></td>
	<td align=right width=100><?=$TotalUniRato?> %</td>
</tr>

<tr>
	<td>Today: </td>
	<td align=center width=100><?=$TodayRawImpressions?></td>
	<td align=center width=100><?=$TodayRawClicks?></td>
	<td align=right width=100><?=$TodayRawRato?> %</td>

	<td align=center width=100><?=$TodayUniImpressions?></td>
	<td align=center width=100><?=$TodayUniClicks?></td>
	<td align=right width=100><?=$TodayUniRato?> %</td>
</tr>

<tr>
	<td>Esse mês: </td>
	<td align=center width=100><?=$tmRawImpressions?></td>
	<td align=center width=100><?=$tmRawClicks?></td>
	<td align=right width=100 style="padding-right:10"><?=$tmRawRato?> %</td>

	<td align=center width=100><?=$tmUniImpressions?></td>
	<td align=center width=100><?=$tmUniClicks?></td>
	<td align=right width=100 style="padding-right:10"><?=$tmUniRato?> %</td>
</tr>

</table>

<br><br>

<table align=center width=510 border=1 cellspacing=0 bordercolor=#CCCCCC>
<caption align=center>Total - por mês</caption>

<tr>
	<td rowspan=2>&nbsp;</td>
	<td align=center colspan=3  width=300>raw</td>
	<td align=center colspan=3 width=300>unique</td>
</tr>

<tr>
	<td align=center width=100>impress.</td>
	<td align=center width=100>clicks</td>
	<td align=center width=100>rato</td>

	<td align=center width=100>impress.</td>
	<td align=center width=100>clicks</td>
	<td align=center width=100>rato</td>
</tr>

<?=$ByMonth?>

</table>

<br><br>

<table align=center width=510 border=1 cellspacing=0 bordercolor=#CCCCCC>
<caption align=center>Total - by day</caption>

<tr>
	<td rowspan=2>&nbsp;</td>
	<td align=center colspan=3  width=300>raw</td>
	<td align=center colspan=3 width=300>unique</td>
</tr>

<tr>
	<td align=center width=100>impress.</td>
	<td align=center width=100>clicks</td>
	<td align=center width=100>rato</td>

	<td align=center width=100>impress.</td>
	<td align=center width=100>clicks</td>
	<td align=center width=100>rato</td>
</tr>

<?=$ByDay?>

</table>

<br><br>
<table align=center width=510 cellspacing=0 cellpadding=0>
<tr>
	<td colspan=2 align=center height=20><?=$HomeViews?></td>
	<td align=center height=20><a href="amigo.php?id=<?=$ListingID?>" target="_blank" class=RedLink>Contar a um amigo!</a></td>
</tr>

<tr>
	<td width="170" onmouseover="this.style.cursor='hand'" onClick="window.open('anuncio.php?id=<?=$ListingID?>&i=1', '_top')"><img src="minhas_imagens/<?=$Image1?>" ></td>
	<td width="170" onmouseover="this.style.cursor='hand'" onClick="window.open('exibe_fotos.php?id=<?=$ListingID?>&i=2', '_blank')"><img src="minhas_imagens/<?=$Image2?>"></td>
	<td width="170" onmouseover="this.style.cursor='hand'"><?=$Image3?></td>
</tr>

<tr>
	<td valign=top align=center colspan=3>

	<table align=center width=510 cellspacing=0 cellpadding=0 border=1 rules=none bordercolor=dddddd height=150>
	<tr>
		<td valign=top>
			<?=$ShowInfo?>
		</td>
	</tr>

	</table>

	</td>
</tr>

</table>

<br>

<center>
	<a class=BlackLink href="imprimir.php?id=<?=$ListingID?>" target=_blank>Versão amigável para impressão</a>
</center>
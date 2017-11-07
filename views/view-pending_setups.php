
<?php
$searchcards = new Access_setups();

$searchcards->SearchSetups();


?>
		<div id="setups_return" align="center">	
			<div id="login-form">
				<hr>
				<table border="1" align="center" width="68%">
					<tr>
						<td align="center" colspan="6"><b>Lista de Setupcards Pendentes</b></td>
					</tr>
					<tr>
						<td align="left" colspan="6"><b> Pendentes: <?php echo $searchcards->num_rows ?></b></td>
					</tr>
					<tr>
						<td style="text-align: center;" width="30%">CA1</td>
						<td style="text-align: center;" width="30%">Máquina</td>
						<td style="text-align: center;" width="30%">Quantidade de versões</td>
						<td style="text-align: center;" width="10%">#</td>
					</tr>
					<?php for ($i=1;$i<=$searchcards->num_rows;$i++){?>
					<tr>
						<td style="text-align: center;" width="31%"><?php echo $searchcards->drawing_no[$i] ?></td>
						<td style="text-align: center;" width="31%"><?php echo $searchcards->pu_name[$i] ?></td>
						<td style="text-align: center;" width="31%"><?php echo $searchcards->quantity[$i] ?></td>
						<td style="text-align: center;" width="7%"><a style="cursor:pointer;" onclick="ShowSetupsToApprove('<?php echo $searchcards->drawing_no[$i] ?>','<?php echo $searchcards->pu_name[$i] ?>');" "><span class="glyphicon glyphicon-search" title="find"></span></a></td>
					</tr>
					<?php }?>
				</table>
			</div>
		</div>

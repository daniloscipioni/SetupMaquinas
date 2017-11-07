<?php
header('Content-type: text/html; charset=ISO-8859-1');
require '../class/access.php';
require '../class/validation_pido.php';

$validation = new validation();

$login_pido = $validation->user_pido . '/' . $validation->pwd_pido;

extract($_POST);

$search_setups_view = new Access_setups();
$search_setups_view->SearchByMachineDrawingNo($machine, $drawing_no);

$searchcards = new Access_setups();
$searchcards->SearchSetups();

?>

<html>
<body>
	<div id="login-form">
		<hr>
		<table border="1" align="center" width="68%">

			<tr>
				<td align="center" colspan="7"><b>Versões de Setupcards Pendentes</b></td>
			</tr>
			<tr>
				<td style="text-align: center;" width="5%">Oficial</td>
				<td style="text-align: center;" width="5%">Versão</td>
				<td style="text-align: center;" width="10%">Máquina</td>
				<td style="text-align: center;" width="15%">CA1</td>
				<td style="text-align: center;" width="50%">Obs</td>
				<td style="text-align: center;" width="5%">#</td>
				<td style="text-align: center;" width="10%">#</td>
			</tr>
    					<?php for ($i=1;$i<=$search_setups_view->num_rows;$i++){?>
    		<tr>
				<td style="text-align: center;" width="5%">
    				<?php  if(($search_setups_view->oficial[$i] == 1) && ($search_setups_view->checked[$i]==1)){?>
    					<span class="glyphicon glyphicon-ok-circle" title="oficial version" style="color:green"></span>
    				<?php } elseif (($search_setups_view->oficial[$i] == 0) && ($search_setups_view->checked[$i]==1)){?>
    				    <span class="glyphicon glyphicon-ban-circle" title="refused version" style="color:red"></span>
    				<?php } elseif (($search_setups_view->oficial[$i] == 0) && ($search_setups_view->checked[$i]==0)){?>
    					<span class="glyphicon glyphicon-exclamation-sign" title="pending version" style="color:blue"></span>
    				<?php }?>
				</td>
				<td style="text-align: center;" width="5%"><?php echo $search_setups_view->version_no[$i]?></td>
				<td style="text-align: center;" width="10%"><?php echo $search_setups_view->pu_name[$i] ?></td>
				<td style="text-align: center;" width="15%"><?php echo $search_setups_view->drawing_no[$i]?></td>
				<td style="text-align: justify;:" width="50%"><?php echo utf8_decode($search_setups_view->observation[$i])?></td>

				<td style="text-align: center;" width="5%"><a href='#'
					onclick="ShowFormSetupVisual('<?php echo $search_setups_view->id_setup[$i] ?>');$('#return_result').html('');"><span
						class="glyphicon glyphicon-eye-open" title="view"></span></a></td>

				<td style="text-align: center;" width="10%">
				<?php  if(($search_setups_view->oficial[$i] == 0) && ($search_setups_view->checked[$i]==0)){?>
    				<a href='#' onclick="ShowSetupInformation('<?php echo $search_setups_view->drawing_no[$i] ?>','<?php echo $search_setups_view->pu_name[$i] ?>','<?php echo $search_setups_view->id_setup[$i] ?>','<?php echo $search_setups_view->version_no[$i] ?>');"> 
    				<span class="glyphicon glyphicon-option-horizontal" title="more"></span>
    				</a>
    		   	<?php }else{?>
    		   	    <span class="glyphicon glyphicon-option-horizontal" style="color:gray"></span>
    		    <?php }?>
    		   	</td>

			</tr>
    <?php  }?>
    		<tr>
				<td colspan="7" align='center'><a href='index.php'>&#171;Voltar</a></td>
			</tr>
			
			<tr>
				<td colspan="7" align='left'><b>Legenda</b> <span class="glyphicon glyphicon-ok-circle" title="oficial version" style="color:green"></span>Aprovada &nbsp;
											          	   <span class="glyphicon glyphicon-ban-circle" title="refused version" style="color:red"></span>Rejeitada &nbsp;
											          	   <span class="glyphicon glyphicon-exclamation-sign" title="pending version" style="color:blue"></span>Pendente &nbsp;
				</td>
			</tr>
			
		</table>

	</div>
</body>
<!-- <div id="retorno" align="center"></div> -->
<!-- <!-- <div id="FormSetup" align="center"></div> --> 

<script src="../js/MachineSetup.js" type="text/javascript"></script>
<script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>

</html>
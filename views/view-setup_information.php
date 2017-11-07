<link href="../css/themes/schott/stylesheets/application.css"
	rel="stylesheet" type="text/css" />
<?php
require '../class/access.php';
require '../class/validation_pido.php';
header('Content-type: text/html; charset=ISO-8859-1');

extract($_POST);

$validation = new validation();
$login_pido = $validation->user_pido . '/' . $validation->pwd_pido;

$search_setups_view1 = new Access_setups();
$search_setups_view1->SearchByMachineDrawingNo($machine, $drawing_no);

// Relatorio no PIDO - DSCI_SetupMaquinas_customer
$search_area_pido_url = 'http://sbritvs0012.bripv.schott.org/CronetJVX//pido/getData?p_pido=50000000444&ORDER_NO=' . $search_setups_view1->order_no[1] . '&p_crosscompany=1&p_format=JSON&p__querytimeout=30&p_userid=' . $login_pido . '@cronet_cpbritu1';

$headers = get_headers($search_area_pido_url);
$verify = substr($headers[0], 9, 3);

// VERIFICA SE O LINK DA URL DO PIDO ESTA FUNCIONANDO
if ($verify == "200") {
    $json_file_area = file_get_contents($search_area_pido_url);
    $json_str_area = json_decode($json_file_area, true);
    $records_order = $json_str_area['collection'];
    $param_area = "readonly=''";
    
    // CASO ESTEJA O NOME DO CLIENTE E SALVO NA VARIAVALE $customer
    if ($records_order != null) {
        $area = $records_order[0]['AREA'];
    } else {
        $area = '';
    }
} else {
    $area = '';
    $param_area = "required=''";
}


$ActiveMachine = new Access_passnt();
$ActiveMachine->SearchActiveMachine($area, $search_setups_view1->pu_name[1]);

?>


<html>
<body>
<div id="login-form">
		<hr>
		<?php 
		      $j=1;
		      $indice=1;
		      $ColumnsQtdy = 5;
		?>
<table border="1" align="center" width="68%">
			<tr>
				<td align="center"><b>Máquina: &nbsp;</b><?php echo $machine;?></td>
				<td align="center"><b>CA1: &nbsp;</b><?php echo $drawing_no;?></td>
				<td align="center"><b>Versão: &nbsp;</b><?php echo $version_no;?></td>
			</tr>

</table>		
<!-- INICIO Tabela de exibição das máquinas que podem ser compatíveis -->
		<table border="1" align="center" width="68%">
			<tr>
				<td align="center" colspan="<?php echo $ColumnsQtdy;?>"><b>Aplica-se a outras máquinas?</b></td>
			</tr>
			
				<?php for($i = 1; $i<=ceil($ActiveMachine->num_rows/$ColumnsQtdy);$i++){?>
			<tr>
    				<?php while ( $j <= $ColumnsQtdy) {?>
    				
    			<td style="text-align: center;">
    				
    				<?php  if($indice<=$ActiveMachine->num_rows){ ?>
    					<label class="checkbox-inline"><input id="<?php echo $ActiveMachine->machine[$indice]; ?>" type="checkbox" value="<?php echo $ActiveMachine->machine[$indice]; ?>" ><span class="checkboxtext"><?php echo $ActiveMachine->machine[$indice]; ?></span></label>
    				<?php $indice++;}?>

    			</td>
    				
    				<?php $j++;	}?>
				<?php $j=1;?>
			</tr>
           	 <?php   } ?>
           	
        	<tr>	
    			<td colspan="<?php echo $ColumnsQtdy;?>" align="right">
    			<button onclick="RefuseSetupCard('<?php echo $drawing_no?>','<?php echo $machine?>','<?php echo $id_setup?>');">Rejeitar Versão &nbsp;<span class="glyphicon glyphicon-trash" style="color: red;"></span></button>
				
				<button onclick="VerifyOficialVersion('<?php echo $drawing_no?>','<?php echo $machine?>','<?php echo $id_setup?>');
					">Aprovar Versão &nbsp;<span class="glyphicon glyphicon-ok" style="color: green;"></span></button>
				</td>
			</tr>
		</table>
<!-- FIM Tabela de exibição das máquinas que podem ser compatíveis -->
	</div>

</body>
<script src="../js/MachineSetup.js" type="text/javascript"></script>
<script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="../bootstrap/bootstrap-3.3.7-dist/css/bootstrap.min.css" type="text/javascript"></script>

</html>



<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<link href="../css/stylesheets/jquery/jquery-ui-1.11.0.css"
	rel="stylesheet" type="text/css" />
<link href="../css/themes/schott/stylesheets/application.css"
	rel="stylesheet" type="text/css" />
<link href="../css/stylesheets/responsive.css" rel="stylesheet"
	type="text/css" />
<script src="../js/javascripts/jquery-1.11.1-ui-1.11.0-ujs-3.1.4.js"
	type="text/javascript"></script>
<script src="../js/javascripts/application.js" type="text/javascript"></script>
<script src="../js/javascripts/responsive.js" type="text/javascript"></script>
<script src="../css/themes/schott/javascripts/theme.js"
	type="text/javascript"></script>
<link rel="stylesheet" media="screen"
	href="../css/plugin_assets/redmine_agile/stylesheets/redmine_agile.css"
	rel="stylesheet" type="text/css" />
<link href="../bootstrap/bootstrap-3.3.7-dist/css/bootstrap.min.css"
	rel="stylesheet" type="text/css" />
<link href="../bootstrap/bootstrap-3.3.7-dist/css/bootstrap.css"
	rel="stylesheet" type="text/css" />
<?php
require '../class/access.php';
require '../class/validation_pido.php';

$validation = new validation();

$login_pido = $validation->user_pido . '/' . $validation->pwd_pido;

extract($_POST);

$search = new Access_passnt();

$search->SearchByOrder($order);
$_SESSION['order'] = $order;

// Relatorio no PIDO - DSCI_SetupMaquinas_customer
$search_customer_pido_url = 'http://sbritvs0012.bripv.schott.org/CronetJVX//pido/getData?p_pido=50000000444&ORDER_NO=' . $order . '&p_crosscompany=1&p_format=JSON&p__querytimeout=30&p_userid=' . $login_pido . '@cronet_cpbritu1';

$headers = get_headers($search_customer_pido_url);
$verify = substr($headers[0], 9, 3);

// VERIFICA SE O LINK DA URL DO PIDO ESTA FUNCIONANDO
if ($verify == "200") {
    $json_file_customer = file_get_contents($search_customer_pido_url);
    $json_str_customer = json_decode($json_file_customer, true);
    $records_order = $json_str_customer['collection'];
    $param_customer = "readonly=''";
    
    // CASO ESTEJA O NOME DO CLIENTE E SALVO NA VARIAVALE $customer
    if ($records_order != null) {
        $customer = $records_order[0]['CUSTOMER'];
        $area = $records_order[0]['AREA'];
        $machine = $records_order[0]['MACHINE'];
    } else {
        $customer = '';
        $area = '';
        $machine='';
    }
} else {
    $customer = '';
    $area = '';
    $machine='';
    $param_customer = "required=''";
}

$search_setup_machine = new Access_setups();
$search_setup_machine_oficial_cards = new Access_setups();
$search_setup_machine_non_oficial_cards = new Access_setups();
$search_setup_drawing = new Access_setups();
$search_compatible_machines = new Access_setups();
$search_setup_approved_by_drawing = new Access_setups();

// pesquisa por maquina e numero de produto
// $search_setup->SearchByMachineProdSap($search->machine[1], $prod_sap);

// Pesquisa por maquina e número de desenho
$search_setup_machine->SearchByMachineDrawingNo($machine, $drawing_no);
$search_setup_machine_oficial_cards->SearchByMachineDrawingNoOficialCards($machine, $drawing_no);
$search_setup_approved_by_drawing->SearchSetupApprovedByDrawing($machine, $drawing_no);
$search_setup_drawing->SearchByDrawingNo($drawing_no, $machine);

?>
</head>
<body class="theme-Schott controller-welcome action-index">
	<input type="hidden" readonly="" value="<?php echo $drawing_no ?>"
		id="drawing_no" />
	<div id="main" class="nosidebar">


		<div id="content" align="center">


			<div class="splitcontentcenter">
				<div id="informacao"></div>
				<div class="issues box">

					<table border="0" align="center" width="60%">
						<tr align="center">
							<td colspan="2"><h5>Informações</h5></td>
						</tr>
						<tr>
							<td><label>Produto:</label></td>
							<td><input type="text" size="45" readonly=""
								value="<?php echo $search->material_no[1] ?>" id="product"
								enable="" /></td>
						</tr>
						<tr>
							<td><label>maquina:</label></td>
							<td><input type="text" size="45" readonly=""
								value="<?php echo $machine ?>" id="machine" /></td>
						</tr>
						<tr>
							<td><label>Ordem:</label></td>
							<td><input type="text" size="45" readonly=""
								value="<?php echo $search->order_no[1] ?>" id="order" /></td>
						</tr>
						<tr>
							<td><label>Descrição Material:</label></td>
							<td><input type="text" size="45" readonly=""
								value="<?php echo $search->material_desc[1] ?>" id="order" /></td>
						</tr>
						<tr>
							<td><label>Cor:</label></td>
							<td><input type="text" size="45" readonly=""
								value="<?php echo $search->color[1] ?>" id="order" /></td>
						</tr>
						<tr>
							<td><label>Tipo:</label></td>
							<td><input type="text" size="45" readonly=""
								value="<?php echo $search->type[1] ?>" id="order" /></td>
						</tr>
						<tr>
							<td><label>Cliente</label></td>
							<td><input type="text" size="45" <?php echo $param_customer;?>
								id="customer" value="<?php echo $customer ?>" /></td>
						</tr>



					</table>
				</div>

			</div>
			<div class="splitcontentcenter">
				<div class="issues box">
					<table border="0" align="center" width="60%">
						<tr align="center">
							<td colspan="4"><h5>Dimensões</h5></td>
						</tr>
						<tr>
							<td><label>Altura</label></td>
							<td><input type="text" size="20" readonly="" id="height"
								value="<?php echo number_format($search->height[1],2,'.','') ?>" /></td>
							<td><label>Diametro</label></td>
							<td><input type="text" size="20" readonly="" id="diameter"
								value="<?php echo number_format($search->diameter[1],2,'.','') ?>" /></td>
						</tr>

					</table>
				</div>

			</div>


			<!-- Versão oficial -->
			<div class="splitcontentcenter">
				<div class="issues box">

					<!-- INICIO TABELA DE FICHAS APROVADAS PARA A MÁQUINA DA ORDEM -->
					<table class="list issues" border="0">
						<thead align="center">
							<td colspan="9"><h5>Fichas de setup aprovadas</h5></td>
						</thead>
						<thead>
							<th style="text-align: center">ID</th>
							<th style="text-align: center">Versão</th>
							<th style="text-align: center">Máquina</th>
							<th style="text-align: center">OP</th>
							<th style="text-align: center">Diâmetro</th>
							<th style="text-align: center">Altura</th>
							<!--<th style="text-align: center">Compativel com</th>-->
							<th style="text-align: center">#</th>
							<th style="text-align: center">#</th>
							
						</thead>
<?php
for ($i = 1; $i <= $search_setup_machine_oficial_cards->num_rows; $i ++) {
    $search_compatible_machines->SearchCompatiblesMachines($search_setup_machine_oficial_cards->id_setup[$i]);
    ?>
    
   						<tr>
							<td align='center'><?php echo $search_setup_machine_oficial_cards->id_setup[$i] ?></td>
							<td align='center'><?php echo $search_setup_machine_oficial_cards->version_no[$i]?></td>
							<td align="center"><?php echo $search_setup_machine_oficial_cards->pu_name[$i]?></td>
							<td align='center'><?php echo $search_setup_machine_oficial_cards->order_no[$i]?></td>
							<td align='center'><?php echo $search_setup_machine_oficial_cards->diameter_value[$i]?></td>
							<td align='center'><?php echo $search_setup_machine_oficial_cards->height_value[$i]?></td>
							 
							<!-- <td align='center'>-->
							<?php
                               /*
                                for ($j = 1; $j <= $search_compatible_machines->num_rows; $j ++) {
                                        echo "<b>" . $search_compatible_machines->desc_machine[$j] . "</b><br>";
                                        }  
                                */        
                             ?>
    						<!-- </td>-->
							
							<td width="10%"><a href='#'
								onclick="ShowFormSetupVisual('<?php echo $search_setup_machine_oficial_cards->id_setup[$i] ?>','Print');">visualizar</a>
							</td>
							<td width="10%"><a href='#'
								onclick="window.open('assist_files/assist-print_data.php?id=<?php echo $search_setup_machine_oficial_cards->id_setup[$i] ?>')">Imprimir</a>
							</td>
						</tr> 

<?php }?>
<?php if($search_setup_machine_oficial_cards->num_rows==0){?>
	<tr>
							<td colspan="9"><h5>
									<font color="#FF3030"><i> Não existe nenhuma ficha de setup
											aprovada para esta máquina </i></font>
								</h5></td>
						</tr>
<?php }?>
					</table>
					<!-- FIM TABELA DE FICHAS APROVADAS PARA A MÁQUINA DA ORDEM -->

					<!-- INICIO TABELA DE FICHAS APROVADAS EM MÁQUINAS COMPATIVEIS -->
					<table class="list issues" border="0">
						<thead align="center">
							<td colspan="8"><h5>Versões aprovadas de máquinas compatíveis</h5></td>
						</thead>
						<thead>
							<th style="text-align: center">ID</th>
							<th style="text-align: center">Versão</th>
							<th style="text-align: center">Máquina</th>
							<th style="text-align: center">OP</th>
							<th style="text-align: center">Diametro</th>
							<th style="text-align: center">Altura</th>
							<th style="text-align: center">&nbsp;</th>
							<th style="text-align: center">&nbsp;</th>
						</thead>
<?php
for ($i = 1; $i <= $search_setup_drawing->num_rows; $i ++) {
    ?>
    
   <tr>
							<td align='center'><?php echo $search_setup_drawing->id_setup[$i] ?></td>
							<td align='center'><?php echo $search_setup_drawing->version_no[$i]?></td>
							<td align='center'><?php echo $search_setup_drawing->pu_name[$i]?></td>
							<td align='center'><?php echo $search_setup_drawing->order_no[$i]?></td>
							<td align='center'><?php echo $search_setup_drawing->diameter_value[$i]?></td>
							<td align='center'><?php echo $search_setup_drawing->height_value[$i]?></td>
							<td width="10%"><a href='#'
								onclick="ShowFormSetupVisual('<?php echo $search_setup_drawing->id_setup[$i] ?>','Print');">visualizar</a></td>
							<td width="10%"><a href='#'
								onclick="window.open('assist_files/assist-print_data.php?id=<?php echo $search_setup_drawing->id_setup[$i] ?>')">Imprimir</a>
							</td>
						</tr> 

<?php }?>
</table>
					<!-- FIM TABELA DE FICHAS APROVADAS EM MÁQUINAS COMPATIVEIS -->

					<!-- INICIO TABELA DE FICHAS APROVADAS EM OUTRAS MAQUINAS QUE NÃO SEJAM COMPATIVEIS -->

					<table class="list issues" border="0">
						<thead align="center">
							<td colspan="8"><h5>Fichas de setup aprovadas em outras máquinas</h5></td>
						</thead>
						<thead>
							<th style="text-align: center">ID</th>
							<th style="text-align: center">Versão</th>
							<th style="text-align: center">Maquina</th>
							<th style="text-align: center">OP</th>
							<th style="text-align: center">Diâmetro</th>
							<th style="text-align: center">Altura</th>
							<th style="text-align: center">&nbsp;</th>
							<!--<th style="text-align: center">&nbsp;</th>-->
						</thead> 
 <?php

for ($i = 1; $i <= $search_setup_approved_by_drawing->num_rows; $i ++) {
    ?>
    
   <tr>
							<td align='center'><?php echo $search_setup_approved_by_drawing->id_setup[$i] ?></td>
							<td align='center'><?php echo $search_setup_approved_by_drawing->version_no[$i]?></td>
							<td align='center'><?php echo $search_setup_approved_by_drawing->pu_name[$i]?></td>
							<td align='center'><?php echo $search_setup_approved_by_drawing->order_no[$i]?></td>
							<td align='center'><?php echo $search_setup_approved_by_drawing->diameter_value[$i]?></td>
							<td align='center'><?php echo $search_setup_approved_by_drawing->height_value[$i]?></td>
							<td width="10%"><a href='#'
								onclick="ShowFormSetupVisual('<?php echo $search_setup_approved_by_drawing->id_setup[$i] ?>','NotPrint');">visualizar</a>
							</td>
							
							<!--  
							<td width="10%"><a href='#'
								onclick="window.open('assist_files/assist-print_data.php?id=<?php //echo $search_setup_approved_by_drawing->id_setup[$i] ?>')">Imprimir</a>
							</td>
						     -->
						</tr> 

 <?php  }?>
 </table>

					<!-- FIM TABELA DE FICHAS APROVADAS EM OUTRAS MAQUINAS QUE NÃO SEJAM COMPATIVEIS -->
				</div>

			</div>

			<link rel="stylesheet" media="all"
				href="/redmine/plugin_assets/sidebar_hide/stylesheets/sidebar_hide.css" />
			<script
				src="/redmine/plugin_assets/sidebar_hide/javascripts/sidebar_hide.js"></script>

<?php

if ($search->num_rows > 0) {
    ?>
<div align="center">
				<button type="button" onclick="ShowFormSetup();">Criar uma Versão</button>
			</div>
<?php }else{?>
<script>
    $("#informacao").html("<div id='informacao' class='alert alert-warning'>Ordem de produção não encontrada!</div>");
</script>
       
       <?php }?>
    
    </div>



	</div>

	&nbsp;
	<!-- Valor para incrementar o valor da versão ao inserir no banco de dados (busca da consulta de todos as versões e não só das oficiais)-->
	<input type="hidden"
		value="<?php echo $search_setup_machine->num_rows + 1 ?>"
		id="num_rows_version" />

	<br>
</body>

<!--  INICIO Exibicao do formulario caso for uma versão nova exibe o formulario em branco, caso for uma visualização exibe o formulario preenchido -->
<!-- <div id="FormSetup" align="center"></div> -->
<!-- FIM -->

<script src="../js/MachineSetup.js" type="text/javascript"></script>
<script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
</html>

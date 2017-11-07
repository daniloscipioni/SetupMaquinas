<?php
require '../class/access.php';
header("Cache-Control: no-cache, must-revalidate");
$form_general = new Access_setups();
$form_description = new Access_setups();
$form_detail = new Access_setups();

$form_general->open();
$form_general->FormGeneral();

$form_description->open();
$form_detail->open();
// $_GET['id'] = 0;
$param = (isset($_GET['param']) ? $_GET['param'] : null);
$id = (isset($_GET['id']) ? $_GET['id'] : null);


if ($id != '') {
    
    $SearchData = new Access_setups();
    
    $SearchData->SearchById($_GET['id']);
    
    $diametro = $SearchData->diameter_value[1];
    $altura = $SearchData->height_value[1];
    $version = $SearchData->version_no[1];
    $oficial = $SearchData->oficial[1];
    
    $arr = array(
        1 => $SearchData->p001[1],
        2 => $SearchData->p002[1],
        3 => $SearchData->p003[1],
        4 => $SearchData->p004[1],
        5 => $SearchData->p005[1],
        6 => $SearchData->p006[1],
        7 => $SearchData->p007[1],
        8 => $SearchData->p008[1],
        9 => $SearchData->p009[1],
        10 => $SearchData->p010[1],
        11 => $SearchData->p011[1],
        12 => $SearchData->p012[1],
        13 => $SearchData->p013[1],
        14 => $SearchData->p014[1],
        15 => $SearchData->p015[1],
        16 => $SearchData->p016[1],
        17 => $SearchData->p017[1],
        18 => $SearchData->p018[1],
        19 => $SearchData->p019[1],
        20 => $SearchData->p020[1],
        21 => $SearchData->p021[1],
        22 => $SearchData->p022[1],
        23 => $SearchData->p023[1],
        24 => $SearchData->p024[1],
        25 => $SearchData->p025[1],
        26 => $SearchData->p026[1],
        27 => $SearchData->p027[1],
        28 => $SearchData->p028[1],
        29 => $SearchData->p029[1],
        30 => $SearchData->p030[1],
        31 => $SearchData->p031[1],
        32 => $SearchData->p032[1],
        33 => $SearchData->p033[1],
        34 => $SearchData->p034[1],
        35 => $SearchData->p035[1],
        36 => $SearchData->p036[1],
        37 => $SearchData->p037[1],
        38 => $SearchData->p038[1],
        39 => $SearchData->p039[1],
        40 => $SearchData->p040[1],
        41 => $SearchData->p041[1],
        42 => $SearchData->p042[1],
        43 => $SearchData->p043[1],
        44 => $SearchData->p044[1],
        45 => $SearchData->p045[1],
        46 => $SearchData->p046[1],
        47 => $SearchData->p047[1],
        48 => $SearchData->p048[1],
        49 => $SearchData->p049[1],
        50 => $SearchData->p050[1],
        51 => $SearchData->p051[1],
        52 => $SearchData->p052[1],
        53 => $SearchData->p053[1],
        54 => $SearchData->p054[1],
        55 => $SearchData->p055[1],
        56 => $SearchData->p056[1],
        57 => $SearchData->p057[1],
        58 => $SearchData->p058[1],
        59 => $SearchData->p059[1]
    );
} else {
    $diametro = "0";
    $altura = "0";
}
?>
<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="UTF-8">


<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<link href="bootstrap/bootstrap-3.3.7-dist/css/bootstrap.min.css"
	rel="stylesheet" type="text/css" />
<title>Setups de Máquina</title>

<link rel="stylesheet" media="all"
	href="css/stylesheets/jquery/jquery-ui-1.11.0.css" />
<link rel="stylesheet" media="all"
	href="css/themes/schott/stylesheets/application.css" />
<link href="css/stylesheets/responsive.css" rel="stylesheet"
	type="text/css" />
<link rel="stylesheet" media="screen"
	href="css/plugin_assets/redmine_agile/stylesheets/redmine_agile.css" />
<link rel="stylesheet" media="screen"
	href="/redmine/plugin_assets/redmine_checklists/stylesheets/checklists.css" />
<link
	href="css/plugin_assets/redmine_checklists/stylesheets/checklists.css"
	rel="stylesheet" type="text/css" />
<script
	src="css/plugin_assets/redmine_checklists/javascripts/checklists.js"
	type="text/javascript"></script>

<script src="js/javascripts/jquery-1.11.1-ui-1.11.0-ujs-3.1.4.js"></script>
<script src="js/javascripts/application.js"></script>
<script src="js/javascripts/responsive.js"></script>
<script src="css/themes/schott/javascripts/theme.js"></script>

</head>
<title>Setups de Máquina</title>
<!-- 
        COLOCA A PÁGINA NA POSIÇÃO CORRETA DO FORMULÁRIO
        'direct' É o id da DIV que está na posição que o formulário deve ficar
        -->
<script>
        $(document).ready(function() { 
        window.location.href='#direct';
        });
        </script>
</head>
<body>

	<div id="login-form">
		<hr>
		<a href="#" id="direct"></a>
		<table border="1" align="center" width="68%">
			<tr>
				<td align="center">
				
               <?php if ($id!=''){?>
               <h2>Version: <?php echo $version ?></h2>
               		
               		<?php if ($oficial == '1' && $id!=''){?>		
               		<div align="right">
    					<?php if($param != 'NotPrint'){?>
    						<input type="button"
    							onclick="window.open('assist_files/assist-print_data.php?id=<?php echo $id ?>')"
    							value="Imprimir">
    					<?php }?>
					</div>
					<?php }?>
					<table border="1" width="100%">
						<tr>
							<td width='17%' align='left' bgcolor=lightyellow><b>Alterações
									realizadas:</b></td>
							<td width='83%' align='left' bgcolor=lightyellow><?php echo $SearchData->observation[1]?></td>
						</tr>
					</table> 
              <?php }?>
	
<!-- ($form_general->num_rows-1) para não aparecer o último parametro ON_OFF que é de um parâmetro diferente 	 -->
      <?php for($i=1;$i<=$form_general->num_rows-1;$i++){?>
    
    <div>
						<div>

							<div>

								<h3><?php echo ltrim($form_general->desc_general[$i]) ?></h3>
							</div>
							<div>
								<div>
									<div id="login-form">
										<table border="0" width="68%" class="list issues">
                      
                          
                              <?php
        $form_description->FormDescription($i);
        for ($j = 1; $j <= $form_description->num_rows; $j ++) {
            // if($j % 2 == 0){$color = "#B0C4DE";}else{$color = "#FFFFFF";};
            ?>
                                <tr>
												<td style='width: 35%; align-items: flex-end;'>
                                 <?php echo trim($form_description->nm_desc[$j])?> <br>
												</td>
												<td style="width: 60%;">
                                    <?php
            $form_detail->Formdetail($form_description->id_desc[$j], $form_general->id_general[$i]);
            ?>
                                    <!--INICIO TABELA DIREITA DE DETALHES -->

													<table border="0" width="100%" class="#">
                                    <?php
            for ($k = 1; $k <= $form_detail->num_rows; $k ++) {
                
                ?>
                                        
                                        <div>
															<tr>
																<td width="40%"><label><?php echo trim($form_detail->desc_detail[$k])."<font size='1' color='#BEBEBE'><i>(".$form_detail->cd_detail[$k].")</i></font>"?> </label>
																</td>
																<td width="50%">  
                                        <?php
                
                if ($form_detail->data_type[$k] == 'select') {
                    $options = explode(";", $form_detail->data_type_value[$k]);
                    
                    ?>                                         
                                        <select class="form-control"
																	id="<?php echo $form_detail->cd_detail[$k]?>"
																	name="<?php echo $form_detail->cd_detail[$k]?>">
																		<option value="">selecione...</option>
                                            <?php
                    
                    for ($l = 0; $l < count($options); $l ++) {
                        /*
                         * Retorna o valor selecionado do banco
                         * INICIO , caso o valor retornado do banco seja igual ao valor da opção
                         * a variavel $select recebe o valor selecionado, se não for igual, a variavel fica vazia
                         */
                        
                        if (trim($arr[$form_detail->id_detail[$k]]) == trim($options[$l])) {
                            $select = "selected='" . $arr[$form_detail->id_detail[$k]] . "'";
                        } else {
                            $select = "";
                        }
                        ;
                        // FIM
                        ?>
                                            <option
																			<?php echo $select ?>
																			value="<?php echo $options[$l]?>"><?php echo $options[$l]?></option>
                                            <?php }?>
                                        </select>
                                        
                                        <?php }else{?>
                                        <input class="form-control"
																	type="<?php echo $form_detail->data_type[$k]?>"
																	id="<?php echo $form_detail->cd_detail[$k]?>"
																	name="<?php echo $form_detail->cd_detail[$k]?>"
																	value="<?php if(isset($arr)){echo $arr[$form_detail->id_detail[$k]];}else{echo "0";}?>">
                                        <?php }?>
                                        
											
											
													
													
														
														
														
														
														
														</div>
														</td>
														</tr>
                                    <?php } ?>  
                                    </table> <!--FIM TABELA DIREITA DE DETALHES -->

												</td>
											</tr>
                             <?php }?>
                   </table>
									</div>
								</div>

							</div>

						</div>
					</div>
      
      <?php } ?> 


<!-- INICIO PARAMETROS ON/OFF  -->

    
    <div>
						<div>

							<div>

								<h3><?php echo ltrim($form_general->desc_general[5]) ?></h3>
							</div>
							<div>
								<div>
									<div id="login-form">
										<table border="0" width="68%" class="list issues">
                      
                          
                              <?php
        $form_description->FormDescription(5);
        for ($j = 1; $j <= $form_description->num_rows; $j ++) {?>
  		<tr>
			 <td style='width: 25%; align-items: flex-end;'>	
				<?php echo trim($form_description->nm_desc[$j])?> <br>
			 </td>
			
			 <td style='width: 65%;'>
             	<?php  $form_detail->Formdetail($form_description->id_desc[$j], $form_general->id_general[5]); ?>

				    <!-- INICIO TABELA DIREITA DE DETALHES -->
	    			<table border="0" width="100%" class="#">
	    			<!-- Divide por 2 para que a quantidade de linhas seja a metade do total de registros, dividindo o resultado da pesquisa em 2 colunas -->
                        <?php $indice = 1;?>
                        <?php for ($k = 1; $k <= $form_detail->num_rows/2; $k ++) {?>
                        	
                        	<div>
								<tr>
									<!-- INICIO PRIMEIRO PARAMETRO -->
									<td style='width: 35%;'><label><?php echo trim($form_detail->desc_detail[$indice])."<font size='1' color='#BEBEBE'><i>(".$form_detail->cd_detail[$indice].")</i></font>"?> </label></td>
									<!-- FIM PRIMEIRO PARAMETRO -->
									
									<!-- INICIO INFO PRIMEIRO PARAMETRO -->
									<td style='width: 15%;'>
										<?php
                                              if ($form_detail->data_type[$k] == 'select') {
                                                  $options = explode(";", $form_detail->data_type_value[$indice]);
                                        ?>                                         
                   
                                        <select class="form-control" id="<?php echo $form_detail->cd_detail[$indice]?>"name="<?php echo $form_detail->cd_detail[$indice]?>"><option value="">selecione...</option>
                                        
                                        <?php
                    
                                        for ($l = 0; $l < count($options); $l ++) {
                                            /*
                                             * Retorna o valor selecionado do banco
                                             * INICIO , caso o valor retornado do banco seja igual ao valor da opção
                                             * a variavel $select recebe o valor selecionado, se não for igual, a variavel fica vazia
                                             */
                                            
                                            if (trim($arr[$form_detail->id_detail[$k]]) == trim($options[$l])) {
                                                $select = "selected='" . $arr[$form_detail->id_detail[$indice]] . "'";
                                            } else {
                                                $select = "";
                                            }
                                            ;
                                            // FIM
                                            ?>
                                                                <option
                    																			<?php echo $select ?>
                    																			value="<?php echo $options[$l]?>"><?php echo $options[$l]?></option>
                                                                <?php }?>
                                                            </select>
                                                            
                                                            <?php }else{?>
                                                            <input class="form-control"
                    																	type="<?php echo $form_detail->data_type[$indice]?>"
                    																	id="<?php echo $form_detail->cd_detail[$indice]?>"
                    																	name="<?php echo $form_detail->cd_detail[$indice]?>"
                    																	value="<?php if(isset($arr)){echo $arr[$form_detail->id_detail[$indice]];}else{echo "0";}?>">
                                                            <?php }?>
																
									</td>
									<!-- FIM INFO PRIMEIRO PARAMETRO -->
									
									<!-- INICIO SEGUNDO PARAMETRO -->
									<td style='width: 35%;'><label><?php echo trim($form_detail->desc_detail[$indice+1])."<font size='1' color='#BEBEBE'><i>(".$form_detail->cd_detail[$indice+1].")</i></font>"?></label></td>
									<!-- FIM SEGUNDO PARAMETRO -->
									
									
									<!-- INICIO INFO SEGUNDO PARAMETRO -->
									<?php ?>
									<td style='width: 15%;'>  
                                    <?php
                
                                    if ($form_detail->data_type[$indice+1] == 'select') {
                                        $options = explode(";", $form_detail->data_type_value[$indice+1]);
                                        
                                        ?>                                         
                                                            <select class="form-control"
                    																	id="<?php echo $form_detail->cd_detail[$indice+1]?>"
                    																	name="<?php echo $form_detail->cd_detail[$indice+1]?>">
                    																		<option value="">selecione...</option>
                                                                <?php
                                        
                                        for ($l = 0; $l < count($options); $l ++) {
                                            /*
                                             * Retorna o valor selecionado do banco
                                             * INICIO , caso o valor retornado do banco seja igual ao valor da opção
                                             * a variavel $select recebe o valor selecionado, se não for igual, a variavel fica vazia
                                             */
                                            
                                            if (trim($arr[$form_detail->id_detail[$k+1]]) == trim($options[$l])) {
                                                $select = "selected='" . $arr[$form_detail->id_detail[$indice+1]] . "'";
                                            } else {
                                                $select = "";
                                            }
                                            ;
                                            // FIM
                                            ?>
                                                                <option
                    																			<?php echo $select ?>
                    																			value="<?php echo $options[$l]?>"><?php echo $options[$l]?></option>
                                                                <?php }?>
                                                            </select>
                                                            
                                                            <?php }else{?>
                                                            <input class="form-control"
                    																	type="<?php echo $form_detail->data_type[$indice+1]?>"
                    																	id="<?php echo $form_detail->cd_detail[$indice+1]?>"
                    																	name="<?php echo $form_detail->cd_detail[$indice+1]?>"
                    																	value="<?php if(isset($arr)){echo $arr[$form_detail->id_detail[$indice+1]];}else{echo "0";}?>">
                                                            <?php }?>
                                                            
                    							</div>
                    														</td>
                    										
                    												</tr>
                                                        <?php 
                                                        $indice = $indice + 2;
                                                        } ?>  
                                                        </table>
                                                        <!--FIM TABELA DIREITA DE DETALHES -->
												</td>
												<!-- FIM INFO SEGUNDO PARAMETRO -->
											
											</tr>
                             <?php }?>
                   </table>
									</div>
								</div>

							</div>

						</div>
					</div>
<!-- FIM  PARAMETROS ON/OFF-->

 <?php // if ($_SESSION['permission'] != 3){?>
       <?php if ($id!=''){
         $mandatoryObs = true;?>
       <table width="100%">
						<tr>
							<td width="30%">
                   <?php echo "Informe quais foram as alterações feitas com relação a versão <b>".$version."</b>"; ?>
               </td>
							<td width="68%"><textarea name="observation" id="observation" required="required"
									cols="45" rows="5"></textarea></td>
						</tr>
					</table>

					<?php if ($oficial =='1' && $id != ''){?>
    					<?php if($param != 'NotPrint'){?>
    					<div align="right">
    						<input type="button"
    							onclick="window.open('assist_files/assist-print_data.php?id=<?php echo $id ?>')"
    							value="Imprimir">
    					</div>
    					<?php } ?> 
       				<?php } ?> 
       <?php } else{
           $mandatoryObs = false;
       }?> 
       
<?php //}?>

<input type="submit" name="btn_insert_datas" id="btn_insert_datas"
					value="Salvar" onclick="SaveDatas(<?php echo $mandatoryObs ?>);" />
					<div id="return_result_data"></div>
				</td>
			</tr>
		</table>
	</div>

	<!-- FIM -->
	<!-- INICIO 	Retorno da situação da gravação do setupcard no banco de dados -->
	<div id="return_result_data"></div>
	<!-- FIM 	Retorno da situação da gravação do setupcard no banco de dados -->

</body>
</html>

<script src="../js/MachineSetup.js?<?php echo time(); ?>" type="text/javascript"></script>

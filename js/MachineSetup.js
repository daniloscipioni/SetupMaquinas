/**

 * @author daniloscipioni
 */


/**
 * @returns returns the result of search of setupcard versions from database
 */
function SearchOrder() {

	if ($("#txt_drawing_no").val().length == 11) {
		if (($("#txt_search_order").val() != "")
				&& ($("#txt_drawing_no").val() != "")) {
			$("#return_result")
					.html(
							'<br><img src="images/loading_3.gif" width="48px" height="48px"/>');
			$.post('assist_files/assist-search_order.php', {
				order : $("#txt_search_order").val().trim(),
				drawing_no : $("#txt_drawing_no").val().trim()
			}, function(data) {
				$("#return_result").html(data);
			}

			)
			$("#form_setup").html("");
		} else {
			alert("Campos obrigatórios vazios");
		}
	} else {
		alert("Campo Drawing No(CA1) com quantidade de números menor que o correto!");
	}
}


/**
 * @returns returns the record inserted in the database
 */
function SaveDatas(mandatoryObs) {
	if (mandatoryObs == true && $("#observation").val() == ""){
		alert("Favor preencher o campo observação!");
		$("#observation").focus();
		$("#observation").css({ "background-color": "#FFCCCC"})
	}else{
		if ($("#customer").val() != "") {
			if (window.confirm(unescape("Deseja enviar versão para aprovação?"))) {
				$.post('assist_files/assist-insert_data.php', {
					product : $("#product").val(),
					machine : $("#machine").val(),
					version : $("#num_rows_version").val(),
					order : $("#order").val(),
					drawing_no : $("#txt_drawing_no").val(),
					customer : $("#customer").val(),
					diameter_value : $("#diameter").val(),
					height_value : $("#height").val(),
					P001 : $("#P001").val(),
					P002 : $("#P002").val(),
					P003 : $("#P003").val(),
					P004 : $("#P004").val(),
					P005 : $("#P005").val(),
					P006 : $("#P006").val(),
					P007 : $("#P007").val(),
					P008 : $("#P008").val(),
					P009 : $("#P009").val(),
					P010 : $("#P010").val(),
					P011 : $("#P011").val(),
					P012 : $("#P012").val(),
					P013 : $("#P013").val(),
					P014 : $("#P014").val(),
					P015 : $("#P015").val(),
					P016 : $("#P016").val(),
					P017 : $("#P017").val(),
					P018 : $("#P018").val(),
					P019 : $("#P019").val(),
					P020 : $("#P020").val(),
					P021 : $("#P021").val(),
					P022 : $("#P022").val(),
					P023 : $("#P023").val(),
					P024 : $("#P024").val(),
					P025 : $("#P025").val(),
					P026 : $("#P026").val(),
					P027 : $("#P027").val(),
					P028 : $("#P028").val(),
					P029 : $("#P029").val(),
					P030 : $("#P030").val(),
					P031 : $("#P031").val(),
					P032 : $("#P032").val(),
					P033 : $("#P033").val(),
					P034 : $("#P034").val(),
					P035 : $("#P035").val(),
					P036 : $("#P036").val(),
					P037 : $("#P037").val(),
					P038 : $("#P038").val(),
					P039 : $("#P039").val(),
					P040 : $("#P040").val(),
					P041 : $("#P041").val(),
					P042 : $("#P042").val(),
					P043 : $("#P043").val(),
					P044 : $("#P044").val(),
					P045 : $("#P045").val(),
					P046 : $("#P046").val(),
					P047 : $("#P047").val(),
					P048 : $("#P048").val(),
					P049 : $("#P049").val(),
					P050 : $("#P050").val(),
					P051 : $("#P051").val(),
					P052 : $("#P052").val(),
					P053 : $("#P053").val(),
					P054 : $("#P054").val(),
					P055 : $("#P055").val(),
					P056 : $("#P056").val(),
					P057 : $("#P057").val(),
					P058 : $("#P058").val(),
					P059 : $("#P059").val(),
					observation : $("#observation").val()
				}, function(data) {
					$("#return_result_data").html(data);
					// Referencia na página FormSetup.php, indica o retorno da
					// inserção dos dados do setupcard no banco de dados
				}
	
				)
				
				setTimeout(function() {	SearchOrder();
										$("#return_advice").show();								
						}, 1000);
				
				setTimeout(function() {	
					$("#return_advice").hide();								
				}, 7000);
	
	
				// SearchOrder();//Atualiza Consulta de versões de setups
				// $("#FormSetup").empty();//Esvazia a DIV na qual consta o
				// formulário(formulário some)
	
			}
		} else {
			alert("Por Favor informe o nome do Cliente!");
		}
	}
}


/**
 * @returns return the form to fill
 */
function ShowFormSetup() {
	$("#form_setup").html(
			'<br><img src="images/loading_3.gif" width="48px" height="48px"/>');
	$("#form_setup").load('views/view-form_setup.php');
}


/**
 * @param id  id of setupcard found
 * @returns returns de setupcard form filled with information from database
 */
function ShowFormSetupVisual(id,param) {
	$.post('views/view-form_setup.php', {
		id : id,
		param :	param
	}, function(data) {
		// $("#retorno").html(data);
	}

	)
	$("#show_setup_information").html("");
	$("#form_setup").html(
			'<br><img src="images/loading_3.gif" width="48px" height="48px"/>');
	$("#form_setup").load('views/view-form_setup.php?id=' + id + '&param=' + param);
	// $("#return_result").html("");

}


/**
 * @param drawing_no number of draw used to search 
 * @param machine    machine of order found
 * @returns          returns all versions of setupcards which can be approved
 */
function ShowSetupsToApprove(drawing_no, machine) {

	$.post('views/view-versions_approve.php', {
		drawing_no : drawing_no,
		machine : machine

	}, function(data) {
   		setTimeout(function() {
			$("#setups_return_pendant").html(data);
			$("#setups_return").html("");
		}, 50);

		// Referencia na página index.php, indica o retorno da pesquisa de
		// setupacards a aprovar
	}

	)

}

/**
 * @param drawing_no setupcard drawing number
 * @param machine    setupcard machine
 * @returns          returns if there is an approved version for drawing number and machine setupcard
 */
function VerifyOficialVersion(drawing_no, machine,id_setup) {	
	$.ajax({
		  method: "POST",
		  url: "assist_files/assist-verify_oficial_version.php",
		  data: { drawing_no: drawing_no, machine: machine }
		})
		  .done(function( data ) {
			 data = data.trim();
			 if(data){ //se já há alguma versão aprovada
				 if (confirm("Já existe uma versão aprovada para esta ficha, deseja substituir a versão antiga por esta versão?")) {
					 ApproveSetupCard(drawing_no, machine, id_setup, 'change');
					 alert("Versão substituida!");
				 }
			 }else{
					 	ApproveSetupCard(drawing_no, machine, id_setup, null);
					 	}
			
		  });
	
}


/**
 * @param drawing_no number of draw used to search 
 * @param machine    machine of order found  
 * @param id_setup   id of setupcard found
 * @returns 		 returns setupcards updated as checked and oficial
 */
function ApproveSetupCard(drawing_no, machine, id_setup, func) {		
	
		var produnits = "";
		//Pega o valor de todas as maquinas do checkbox e concatena na variavel "produnits"
		$("input:checked").each(function(){
			produnits += $(this).attr("id")+";";
		});
	
		if (confirm("Gravar está versão como oficial?")) {
				$.post('assist_files/assist-update_cards.php', {
				drawing_no : drawing_no,
				machine : machine,
				id_setup : id_setup,
				produnits: produnits,
				func:func
			}, function(data) {
				$("#return_result").html(data);
				$("#retorno").html(data);
			}
	
			)
		}

}


/**
 * @param drawing_no number of draw used to search 
 * @param machine 	 machine of order found  
 * @returns 		 returns the table head of options of machine which can be compatible with the same setupcard  
 */
function ShowSetupInformation(drawing_no, machine, id_setup,version_no) {
	$("#form_setup").html('');
	$("#return_result").html("");
	$("#show_setup_information").html('<br><img src="images/loading_3.gif" width="48px" height="48px"/>');
	$.post('views/view-setup_information.php', {
		id_setup : id_setup,
		drawing_no : drawing_no,
		machine : machine,
		version_no:version_no
	}, function(data) {

		$("#show_setup_information").html(data);
		

	}

	)
}


function RefuseSetupCard(drawing_no, machine, id_setup) {		
	
	if (confirm("Deseja realmente rejeitar esta versão?")) {
		$.post('assist_files/assist-update_cards.php', {
			drawing_no : drawing_no,
			machine : machine,
			id_setup : id_setup,
			func:'refuse'
		}, function(data) {
			$("#return_result").html(data);
			$("#retorno").html(data);
		}

		)
		
		//ApproveSetupCard(drawing_no, machine, id_setup, 'refuse');
	}
}
//////////////

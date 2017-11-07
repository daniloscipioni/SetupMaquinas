<?php require  'class/access.php';
header('Content-type: text/html; charset=ISO-8859-1');


if (! isset($_SESSION['id_user'])) {
    header("Location: ./auth/auth-login.php");
    die();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<link href="bootstrap/bootstrap-3.3.7-dist/css/bootstrap.min.css"
	rel="stylesheet" type="text/css" />
<title>Setup Card - Schott</title>

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

<link rel="icon" type="image/ico" href="images/setupcard.ico" />
</head>
<body class="theme-Schott controller-account action-login">
	<div id="wrapper">

		<div class="flyout-menu js-flyout-menu">


			<div class="flyout-menu__search">
				<form action="/redmine/search" accept-charset="UTF-8" method="get">
					<input name="utf8" type="hidden" value="&#x2713;" /> <label
						class="search-magnifier search-magnifier--flyout"
						for="flyout-search">&#9906;</label> <input type="text" name="q"
						id="flyout-search" class="small js-search-input"
						placeholder="Busca" />
				</form>
			</div>

			<div class="flyout-menu__avatar flyout-menu__avatar--no-avatar">
				<a class="user active" href="#"></a>
			</div>


			<h3></h3>
			<span class="js-general-menu"></span> <span
				class="js-sidebar flyout-menu__sidebar"></span>

			<h3></h3>
			<span class="js-profile-menu"></span>

		</div>
		<div id="top-menu">
		<a href="index.php">
			<div class="glyphicon glyphicon-home"></div>
		</a>
		
			<div id="account">
				<ul>
				    <?php if ($_SERVER['SERVER_NAME'] == 'localhost'){
				    $servidor = "Teste";
				    } else {$servidor = "Produção";}?>
				    <li><b> Servidor:  <?php echo $servidor?></b>&nbsp;&nbsp;</li>
					
					<li><b> Cracha:  <?php echo $_SESSION['cd_user']?></b>&nbsp;&nbsp;</li>
					<li><b> Nome:   <?php echo $_SESSION['nm_user']?></b>&nbsp;&nbsp;</li>
					<li><span class="glyphicon glyphicon-lock"></span>&nbsp;<b><?php echo $_SESSION['setupcard_desc_permission']?></b>&nbsp;&nbsp;</li>
					<li><a class="register" href="auth/auth-logout.php"> Sair <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a></li>
				</ul>
			</div>
		</div>

		<div id="header">
		
			<div class="mobile-toggle-button"></div>
			<a href="auth/auth-logout.php" class="mobile-toggle-text"></a>
			
			<h1>SetupCard</h1>
			
		</div>
		<div id="main" class="nosidebar">

<?php //if($_SESSION['permission']<>'3'){ ?>
			<div id="login-form">

				<table border="0" align="center" width="68%">
					<tr>
						<td style="text-align: right;" width="18%"><label for="order">OP:</label>
						</td>
						<td style="text-align: center;" width="17%"><input type="text"
							name="txt_search_order" id="txt_search_order" tabindex="1"
							autofocus="" /></td>
						<td style="text-align: right;" width="17%"><label for="order">CA1:</label></td>
						<td style="text-align: center;" width="17%"><input type="text"
							name="txt_drawing_no" id="txt_drawing_no" tabindex="2" maxlength="11"/></td>
						<td style="text-align: left;" width="30%">
						<input type="submit" name="btn_search_order" id="btn_search_order" value="Buscar &#187;" onclick="SearchOrder();$('#setups_return').html('');" tabindex="3" />
						</td>
					</tr>
				</table>
			</div>
<?php //}?>

<br>
<!--  INICIO Exibicao do formulario caso for uma versão nova exibe o formulario em branco, caso for uma visualização exibe o formulario preenchido -->
				<div id="return_result" align="center"></div>
<!-- FIM -->

<!--  INICIO Exibicao do formulario caso for uma versão nova exibe o formulario em branco, caso for uma visualização exibe o formulario preenchido -->
				<div id="form_setup" align="center"></div> 
<!-- FIM -->

<!--  INICIO Exibicao da mensagemm de retorno de envio da ficha para aprovação -->
<div id="return_advice" align="center" class='alert alert-warning' style="display:none;">A ficha foi enviada para avaliação e aprovação</div>
<!-- FIM -->

<!--  INICIO Exibicao Versões de setupcard pendente de um desenho -->
				<div id="setups_return_pendant" align="center"></div> 
<!-- FIM -->

<!--  INICIO Exibicao das possibilidades dos setup em outras maquinas -->
				<div id="show_setup_information" align="center"></div> 
<!-- FIM -->

 <?php if($_SESSION['setupcard_permission']=='3'){
    
    include 'views/view-pending_setups.php';  

  }?>




			
		</div>
	</div>
</body>
<div id="footer">
	<div class="bgl">
		<div class="bgr">
			Developed by <a href="http://www.schott.com/brazil/portuguese/">Schott	Brasil</a> &copy; 2017-2017 Danilo Scipioni
		</div>
		<div class="bgr"> Version 1.2 </div>
	</div>
</div>
</html>
<script src="js/MachineSetup.js" type="text/javascript"></script>
<script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>

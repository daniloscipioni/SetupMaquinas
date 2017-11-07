<!DOCTYPE html>
<?php header('Content-type: text/html; charset=ISO-8859-1');?>
<html lang="en">
<head>
<meta charset="ISO-8859-1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<link href="../bootstrap/bootstrap-3.3.7-dist/css/bootstrap.min.css"
	rel="stylesheet" type="text/css" />
<title>Setup Card - Identificação</title>

<link rel="stylesheet" media="all"
	href="../css/stylesheets/jquery/jquery-ui-1.11.0.css" />
<link rel="stylesheet" media="all"
	href="../css/themes/schott/stylesheets/application.css" />
<link href="../css/stylesheets/responsive.css" rel="stylesheet"
	type="text/css" />
<link rel="stylesheet" media="screen"
	href="../css/plugin_assets/redmine_agile/stylesheets/redmine_agile.css" />


<script src="../js/javascripts/jquery-1.11.1-ui-1.11.0-ujs-3.1.4.js"></script>
<script src="../js/javascripts/application.js"></script>
<script src="../js/javascripts/responsive.js"></script>
<script src="../css/themes/schott/javascripts/theme.js"></script>
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
			<div id="account">
				<ul>
					<li><a class="register" href="#"></a></li>
				</ul>
			</div>

		</div>

		<div id="header">

			<div class="mobile-toggle-button"></div>
			<h1>Login</h1>
		</div>
		<div id="main" class="nosidebar">

      &nbsp;      
      <?php if(isset($_GET['erro'])){?>
        <div id='return-information' class='alert alert-warning'>Funcionario
				nao existe!</div>
      <?php }?>
<div id="login-form">
				<form id="login-form" action="auth-id_validation.php"
					method="POST">
					<table border="0" align="center">
						<tr>
							<td style="text-align: right;"><label for="order">Cracha:</label>
							</td>
							<td style="text-align: center;"><input type="text" name="txt_id"
								id="txt_id" tabindex="1" autofocus="" required=""
								autocomplete="off" /></td>
							<td style="text-align: center;"><input type="submit"
								name="btn_login" id="btn_login" tabindex="2"
								value="Entrar &#187;" /></td>
						</tr>

					</table>
				</form>
			</div>


			<br>
			<div id="return_result"></div>


		</div>
	</div>
</body>
<div id="footer">
	<div class="bgl">
		<div class="bgr">
			Developed by <a href="http://www.schott.com/brazil/portuguese/">Schott
				Brasil</a> &copy; 2017-2017 Danilo Scipioni
		</div>
		<div class="bgr"> Version 1.2 </div>
	</div>
</div>
</html>
<script src="../js/MachineSetup.js" type="text/javascript"></script>
<script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
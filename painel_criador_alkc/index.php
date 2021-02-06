<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/style_fonts.css" />
	<link rel="stylesheet" type="text/css" href="css/style_header.css" />
	<link rel="stylesheet" type="text/css" href="css/style_footer.css" />
	<link rel="stylesheet" type="text/css" href="css/style_login.css" />
	<link rel="stylesheet" type="text/css" href="css/style_formularios.css" />
	<link rel="stylesheet" href="jquery/acord/style.css" type="text/css" />

	<link rel="shortcut icon" href="favicon.png" />
	<script type="text/javascript" src="jquery/scroll/js/jquery-1.4.2.min.js"></script>
	<script>
		function atualizar() {
			window.location.reload();
		}

		//Função para se Logar
		function Logar() {
			var email = $("#email").val();
			var senha = $("#senha").val();
			$.post("env_login2.php", {
				email: email,
				senha: senha
			}, function(retorno) {
				//alert(retorno);
				if (retorno == 1) {
					alert('Usuário ou Senha Incorreto!');
					$("#senha").val("");
				} else {
					document.location = "index_principal.php";
				}
			});
			return false;
		}

		function Rec() {
			var obj = prompt('Entre com o seu email:');
			$.post('mandasenha.php', {
				obj: obj
			}, function() {
				alert('Senha enviada!');
			});
		}
	</script>

	<title>::. Painel de Controle .::</title>

</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
	<form onsubmit="return Logar();">
		<div id="header_full">
			<div id="header_margem_full">

				<div id="header_logo">
					<img src="images/logo_hor.png" style="height: 140%;margin-top: -7px;" />
				</div>

				<div id="header_logo_painel"> <a href="index.php"> </a>
				</div>

			</div>
		</div>

		<div id="header_full_menu">
			<div id="header_margem_menu_full"></div>
		</div>


		<div id="login_full">
			<div id="login_margem_full">

				<div id="login_box">
					<div class="arial_branco12" id="login_titulo">Acesso ao Sistema do Criador <?php if (getenv('ENV') == 'development') { echo ':: DEVELOPMENT';} else if ($_SERVER["SERVER_NAME"] == 'homologacao.megapedigree.com') { echo ':: HOMOLOGACAO'; } ?></div>
					<div style="margin:10px; margin-top:40px;"><b class="arial_azul18">Insira seus dados para entrar no sistema.</b></div>

					<div style="margin:25px;">
						<div class="field">
							<label for="name">
								<div class="arial_azul12" style="width:75px; float:left; margin-top:8px;"><img src="images/icons/login_user.png" align="left" style="margin-right:4px;"> Usuário </div>
							</label>
							<input type="text" class="input" name="name" id="email" />
							<p class="hint">Entre com seu Usuário.</p>
						</div>

						<div style="margin:0px;">
							<div class="field">
								<label for="name">
									<div class="arial_azul12" style="width:75px; float:left; margin-top:8px;"><img src="images/icons/login_senha.png" align="left" style="margin-right:4px;"> Senha </div>
								</label>
								<input type="password" class="input" name="name" id="senha" />
								<p class="hint">Entre com sua senha.</p>
							</div>

						</div>

					</div>

					<div style="margin:25px; margin-left:30px;">
						<input type="submit" name="Submit" class="button" value="Acessar" /> <a class="button" style="text-decoration:none;" href="#" onclick="rec();">Recuperar senha</a>
					</div>


				</div>
			</div>


	</form>

	<div id="footer_full">
		<div id="footer_margem_full">
			<center><a href="http://www.neoware.com.br" target="_blank"><img src="images/logo_footer.png" border="0" /></a></center>
		</div>
	</div>

	<div>
		<div id="neoware">

		</div>
		<!--neoware-->
	</div>
</body>

</html>
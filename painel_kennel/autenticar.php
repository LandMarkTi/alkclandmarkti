 <!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="Keywords" content="Painel de Controle - petweball" /> 
<meta name="Description" content="Painel de Controle - petweball"/> 
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_fonts.css" />
<link rel="stylesheet" type="text/css" href="css/style_header.css" />
<link rel="stylesheet" type="text/css" href="css/style_footer.css" />
<link rel="stylesheet" type="text/css" href="css/style_login.css"/>
<link rel="stylesheet" type="text/css" href="css/style_formularios.css"/>
<link rel="stylesheet" href="jquery/acord/style.css" type="text/css" />
<?php if (!isset($_GET["aut"]))die();?>

<!--script type="text/javascript" src="jquery/scroll/js/jquery-1.4.2.min.js"></script-->

<script	  src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
	function atualizar(){
	window.location.reload();
	}
	
	//Função para se Logar
function Logar(){
	var email = $("#email").val();
	var senha = $("#senha").val();
	var aut='<?=$_GET["aut"];?>';
	$.post("env_login_v2.php",{email: email,senha: senha,aut: aut},function(retorno){
			//alert(retorno);
			if(retorno == 1){
				alert('Usuário ou Senha Incorreto!');
				$("#senha").val("");
			} else {
				document.location = "index_principal.php";
			}
        });
	return false;	
}
</script>

<title>::. Painel de Controle  .::</title>
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="icon" href="/favicon.ico" type="image/x-icon">

</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
<form onsubmit="return Logar();">
<div id="header_full">
 <div id="header_margem_full">
  
  <div id="header_logo">
  <img src="images/logo_hor.png" style="height: 140%;margin-top: -7px;"/>
  </div>
  
  <div id="header_logo_painel"> <!--a href="index.php"><img src="images/logo_painel_controle.png" border="0"/></a-->
  </div>

 </div>
</div>

<div id="header_full_menu">
 <div id="header_margem_menu_full">

  <div id="header_box_menu_imagem"></div>
 </div>
</div>


<div id="login_full">
 <div id="login_margem_full">

    <div id="login_box" style="border : 1px solid #2b94a7">
     <div class="arial_branco12" id="login_titulo" style="background-color:#2b94a7">Acesso ao Sistema</div>
     <div style="margin:10px; margin-top:40px;"><b class="arial_azul18" style="color: #2b94a7">Insira seus dados nos campos abaixo, para logar no sistema administrativo.</b></div>
          
    <div style="margin:25px;">
    <div class="field">
	<label for="name"><div class="arial_azul12" style="width:75px; float:left; margin-top:8px;"><img src="images/icons/login_user.png" align="left" style="margin-right:4px;"> Usuário </div></label>
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
    
    <div style="margin:25px; margin-left:98px;">
    <input type="submit" name="Submit"  class="button" value="Acessar" />
    </div>
    
    <div style="margin-top:30px;"><a class="arial_azul12" href="mailto:info@petweball.com.br">Esqueci meu usuário e senha</a></div>
    
 </div>
</div>


</form>

<div id="footer_full">
 <div id="footer_margem_full">

 </div>
</div>

<div>

</div>
</body>
</html>

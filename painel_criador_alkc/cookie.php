<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="css/style_fonts.css" />
<link rel="stylesheet" type="text/css" href="css/style_header.css" />
<link rel="stylesheet" type="text/css" href="css/style_footer.css" />
<link rel="stylesheet" type="text/css" href="css/style_login.css"/>
<link rel="stylesheet" type="text/css" href="css/style_formularios.css"/>
<link rel="stylesheet" href="jquery/acord/style.css" type="text/css" />

<link rel="shortcut icon" href="favicon.png" /> 
<script type="text/javascript" src="jquery/scroll/js/jquery-1.4.2.min.js"></script>
<script>
	function atualizar(){
	window.location.reload();
	}
	
	//Função para se Logar
function Logar(){
	var email = $("#email").val();
	var senha = $("#senha").val();
	$.post("env_login_ck2.php",{email: email,senha: senha},function(retorno){
			//alert(retorno);
			if(retorno == 0){
				alert('Usuário ou Senha Incorreto!');
				$("#senha").val("");
			} else {
				document.location = "index_cookie.php";
			}
        });
	return false;	
}
function Rec(){var obj=prompt('Entre com o seu email:');$.post('mandasenha.php',{obj:obj},function(){alert('Senha enviada!');});}
</script>

<title>::. Painel de Controle  .::</title>

</head> 
<style>

.input2{
width: 100px;
margin-left: 64px;
background-color: rgb(48, 133, 154);
color: white;
border: 1px solid silver;
height: 37px;
border-radius: 5px;
}
</style>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
<form method="POST" action="env_login_ck2.php" >
<div id="header_full" style="background:white">
 <div id="header_margem_full">
  
  <div id="header_logo">
  <img src="images/disco.png" style="margin-top: -1px;
opacity: 1;
margin-left: -105px;"/>
  </div>
  
  <div id="header_logo_painel"> <a href="index.php"> </a>
  </div>

 </div>
</div>

<div id="header_full_menu" style="background-image: url(images/fundos/fundo_full_menu2.jpg);
	background-repeat: repeat-x;">
 <div id="header_margem_menu_full" ><b style="color: white;
font-size: 19px;
line-height: 28px;margin: 64px;">Acesso Criador</b></div>
</div>


<div id="login_full">
 <div id="login_margem_full">

    <div id="login_box" style="background-color:white;border:0px solid">
     <!--div class="arial_branco12" id="login_titulo">Acesso ao Sistema do Criador</div-->
     <div style="margin:10px; margin-top:40px;"><center class="arial_azul18" style="font-size: 25px;color:4babb8;">Insira seus dados para entrar:</center></div>
          <br>
    <div style="margin:25px;">
    <div class="field">
	<label for="name"><div class="arial_azul12" style="width:75px; float:left; margin-top:8px;"><!--img src="images/icons/login_user.png" align="left" style="margin-right:4px;"--> Usuário </div></label>
  	<input type="text" class="input" name="name" id="email" style="width: 244px;border-radius: 5px;
color: #6ba9aa;"/>
	<p class="hint">Entre com seu Usuário.</p>
    </div>
    
    <div style="margin:0px;">
    <div class="field">
	<label for="name">
	<div class="arial_azul12" style="width:75px; float:left; margin-top:8px;"><!--img src="images/icons/login_senha.png" align="left" style="margin-right:4px;"--> Senha </div>
	</label>
  	<input type="password" class="input" name="name" id="senha" style="width: 244px;border-radius: 5px;
color: #6ba9aa;"/>
	<p class="hint">Entre com sua senha.</p>
    </div>
    
</div>
     
    </div>
    
    <div style="margin:25px; margin-left:30px;">
    <input type="submit" name="Submit"  class="input2" value="Acessar" />   <input type="reset" name="reset"  class="input2" value="Limpar" />
    </div>
    
    
 </div>
</div>


</form>

<div id="footer_full">
 <div id="footer_margem_full">
	<center><a href="http://www.neoware.com.br" target="_blank"><img src="images/logo_footer.png" border="0"/></a></center>
 </div>
</div>

<div>
<div id="neoware">

</div><!--neoware-->
</div>
</body>
</html>

<?php
  $useragent = $_SERVER['HTTP_USER_AGENT'];
 
  if (preg_match('|MSIE ([0-9].[0-9]{1,2})|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'IE';
  } elseif (preg_match( '|Opera/([0-9].[0-9]{1,2})|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'Opera';
  } elseif(preg_match('|Firefox/([0-9\.]+)|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'Firefox';
  } elseif(preg_match('|Chrome/([0-9\.]+)|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'Chrome';
  } elseif(preg_match('|Safari/([0-9\.]+)|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'Safari';
  } else {
    // browser not recognized!
    $browser_version = 0;
    $browser= 'other';
  }
  if($browser != "Chrome") header("Location: baixe_chrome.php");
  //print "browser: $browser $browser_version";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="Keywords" content="Painel de Controle - NEOWARE" /> 
<meta name="Description" content="Painel de Controle - NEOWARE"/> 
<meta name="copyright" content="Neoware Criação e Desenvolvimento de Websites e Sistemas - www.neoware.com.br" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
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
	$.post("env_login.php",
	{email: email,
	  senha: senha},
	    function(retorno){
			//alert(retorno);
			if(retorno == 1){
				$("#aviso").html('<div class="erro">Usuário ou Senha Incorreto!.</div>');
				$("#senha").val("");
			} else {
				document.location = "index_principal.php";
			}
        } 
        );
	return false;	
}
</script>

<title>::. Painel de Controle - NEOWARE .::</title>

</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
<form onSubmit="return Logar();">
<div id="header_full">
 <div id="header_margem_full">
  
  <div id="header_logo">
  <img src="images/logo_header.png"/>
  </div>
  
  <div id="header_logo_painel"> <a href="index.php"><img src="images/logo_painel_controle.png" border="0"/></a>
  </div>

 </div>
</div>

<div id="header_full_menu">
 <div id="header_margem_menu_full">

  <div id="header_box_menu_imagem"><a href="#"><img src="images/icons/website.png" border="0"/></a></div> 
  <div id="header_box_menu_texto"><a class="arial_cinza2_11" href="../index.php">WebSite</a></div>
  
 </div>
</div>


<div id="login_full">
 <div id="login_margem_full">

    <div id="login_box">
     <div class="arial_branco12" id="login_titulo">Acesso ao Sistema</div>
     <div style="margin:10px; margin-top:40px;"><b class="arial_azul18">Insira seus dados nos campos abaixo, para logar no sistema administrativo.</b></div>
          
    <div style="margin:25px;">
    <div class="field">
	<label for="name"><div class="arial_azul12" style="width:75px; float:left; margin-top:8px;"><img src="images/icons/login_user.png" align="left" style="margin-right:4px;"> Usuário </div></label>
  	<input type="text" class="input" name="name" id="name" />
	<p class="hint">Entre com seu Usuário.</p>
    </div>
    
    <div style="margin:0px;">
    <div class="field">
	<label for="name">
	<div class="arial_azul12" style="width:75px; float:left; margin-top:8px;"><img src="images/icons/login_senha.png" align="left" style="margin-right:4px;"> Senha </div>
	</label>
  	<input type="password" class="input" name="name" id="name" />
	<p class="hint">Entre com sua senha.</p>
    </div>
    
</div>
     
    </div>
    
    <div style="margin:25px; margin-left:98px;">
    <input type="submit" name="Submit"  class="button" value="Acessar" />
    </div>
    
    <div style="margin-top:30px;"><a class="arial_azul12" href="mailto:info@neoware.com.br">Esqueci meu usuário e senha</a></div>
    
 </div>
</div>



<div id="footer_full">
 <div id="footer_margem_full">
	<center><a href="http://www.neoware.com.br" target="_blank"><img src="images/logo_footer.png" border="0"/></a></center>
 </div>
</div>

<div>
<div id="neoware">
<a href="http://www.neoware.com.br/" target="_blank"><img src="images/designedbyneoware.png" border="0" alt="Designed by NeoWare" /></a>
</div><!--neoware-->
</div>
</form>
</body>
</html>

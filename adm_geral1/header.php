<?php 
if(!$_SESSION)session_start();
?>
<link rel="stylesheet" type="text/css" href="css/style_header.css" />
<link rel="stylesheet" type="text/css" href="css/style_fonts.css" />
<script>
	function atualizar(){
	window.location.reload();
	}
document.title=': : . Painel de Controle . : :';
</script>
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="icon" href="/favicon.ico" type="image/x-icon">

<div id="header_full">
 <div id="header_margem_full">
  
  <div id="header_logo">
  <img src="images/logo_header2.png" style="width: 185px;margin-top: -7px;"/>
  </div>
  
  <div id="header_logo_painel"> <a href="index.php"><img src="images/logo_painel_controle.png" border="0" style="display:none"/></a>
  </div>

 </div>
</div>

<div id="header_full_menu">
 <div id="header_margem_menu_full">
 <!--locasite!-->
  <div id="header_box_menu_imagem"><a href="#"><img src="images/icons/home.png" border="0"/></a></div> 
  <div id="header_box_menu_texto"><a class="arial_branco11" href="index.php">Home</a></div>
  <div id="header_box_menu_imagem"><a href="#"><img src="images/icons/website.png" border="0"/></a></div> 
  <div id="header_box_menu_texto"><a class="arial_branco11" href="../index.php">WebSite</a></div>
  <div id="header_box_menu_imagem"><a href="#" target="_blank"><img src="images/icons/estatisticas.png" border="0"/></a></div> 
  <div id="header_box_menu_texto"><a href="#" class="arial_branco11">Estatísticas</a></div>
  <div id="header_box_menu_imagem"><a onclick="atualizar()" href="#"><img src="images/icons/atualizar.png" border="0"/></a></div> 
  <div id="header_box_menu_texto"><a onclick="atualizar()" class="arial_branco11" href="#">Atualizar</a></div>
  
  <div id="header_box_menu_texto_d" class="arial_branco11" ><a class="arial_branco11" href="sair.php">Sair/Logout</a></div>
  <div id="header_box_menu_imagem_d"><a href="#"><img src="images/icons/sair.png" border="0"/></a></div> 
  <div id="header_box_menu_texto_d" class="arial_branco11">Administrador: <b>Sergio</b></div>
  <div id="header_box_menu_imagem_d"><img src="images/icons/administrador.png" border="0"/></div> 


 </div>
</div>


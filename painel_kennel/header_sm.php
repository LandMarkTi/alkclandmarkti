<link rel="stylesheet" type="text/css" href="css/style_header.css" />
<link rel="stylesheet" type="text/css" href="css/style_fonts.css" />
<script>
	function atualizar(){
	window.location.reload();
	}

</script>

<div id="header_full">
 <div id="header_margem_full">
  
  <div id="header_logo">
  <img src="images/logo_hor.png" style="height: 180%;"/>
  </div>
  
  <div id="header_logo_painel"> <a href="index.php"><!--img src="images/logo_painel_controle.png" border="0"/--></a>
  </div>

 </div>
</div>

<div id="header_full_menu">
 <div id="header_margem_menu_full">
 
  <!--div id="header_box_menu_imagem"><a href="#"><img src="images/icons/home.png" border="0"/></a></div--> 
 
  <div id="header_box_menu_texto_d" class="arial_branco11" ><a class="arial_branco11" href="sair.php">Sair/Logout</a></div>
  <div id="header_box_menu_imagem_d"><a href="#"></a></div>  
  <div id="header_box_menu_texto_d" class="arial_branco11">Kennel : <b><?php
session_start();
require_once("Connections/conexao.php");
$qr=mysql_query("select * from credenciado where id_credenciado=".$_SESSION['id']);
$f=mysql_fetch_assoc($qr);
echo $f['nome'];
?></b></div>
  <div id="header_box_menu_imagem_d"></div>  

 </div>
</div>


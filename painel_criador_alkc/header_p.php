<link rel="stylesheet" type="text/css" href="css/style_header.css" />
<link rel="stylesheet" type="text/css" href="css/style_fonts.css" />
<script type="text/javascript" src="jquery/scroll/js/jquery-1.4.2.min.js"></script>
<style>
/* menu drop down*/
#jsddm
{	margin: 0;
	padding: 0;
}

	#jsddm li
	{	float: left;
		list-style: none;
		margin:0;
		}

	#jsddm li a
	{	display: block;
		padding: 2px 82px;
		text-decoration: none;
		width: auto;
		white-space: nowrap;
		width:100%;
		margin:0;
		color: white;
		font-size: 18px;
	}

	#jsddm li a:hover
	{	/*background: #24313C;*/}
		
		#jsddm li ul
		{	margin: 0;
			margin-right:5px;
			padding: 0;
			position: absolute;
			visibility: hidden;
			margin-top:15px;
			z-index:1;
			margin-left: 60px;
			}
		
			#jsddm li ul li
			{	float: none;
				display: inline;
				border-top: 1px solid #ccc;
				margin:0;
				}
			
			#jsddm li ul li a
			{	background: #eee;
				width: auto;
				color:#30859a;
				border-top: 1px solid #30859a;
				width:100%;
				margin:0;
				padding-left:5px;
				padding-right:5px;
				padding-top:8px;
				padding-bottom:8px;
				font-size:13px;
				font-family:Arial, Helvetica, sans-serif;
				}
			
			#jsddm li ul li a:hover
			{	
			background-color: #e8f1ed;
				}

</style>
<script type="text/javascript">
var timeout         = 500;
var closetimer		= 0;
var ddmenuitem      = 0;

function jsddm_open()
{	jsddm_canceltimer();
	jsddm_close();
	ddmenuitem = $(this).find('ul').eq(0).css('visibility', 'visible');}

function jsddm_close()
{	if(ddmenuitem) ddmenuitem.css('visibility', 'hidden');}

function jsddm_timer()
{	closetimer = window.setTimeout(jsddm_close, timeout);}

function jsddm_canceltimer()
{	if(closetimer)
	{	window.clearTimeout(closetimer);
		closetimer = null;}}

$(document).ready(function()
{	$('#jsddm > li').bind('mouseover', jsddm_open);
	$('#jsddm > li').bind('mouseout',  jsddm_timer);});

document.onclick = jsddm_close;
</script>

<div id="header_full">
 <div id="header_margem_full">
  
  <div id="header_logo">
  <img src="images/logo_hor.png" style="height: 140%;margin-top: -7px;"/>
  </div>
  
  <div id="header_logo_painel"> <a href="index.php"><!--img src="images/logo_painel_controle.png" border="0"/--></a>
  </div>

 </div>
</div>

<div id="header_full_menu" style="background-repeat: initial;height:40px">
 <div id="header_margem_menu_full">
 
<ul id="jsddm">

  
    <li>
    <div class="menu_box"
style="border: 1px solid white;
border-radius: 10px;
margin: 6px;
width: 198px;
background-color: whitesmoke;
box-shadow: 2px 2px 3px gray;"

><a href="#" class="oswald_branco16"
style="display: block;
padding: 2px 35px;
text-decoration: none;
white-space: nowrap;
width: 54%;
margin: 0;
color: #2f8296;
font-size: 18px;"
>Menu Principal</a></div>  
          <ul style="visibility: hidden; width: 175px;">
              <li><a class="botao" href="listagem_pedigree.php">Listar Pedigree</a></li>
              <li><a class="botao" href="adicionar_pedigree_pre.php">Adicionar Ninhada</a></li>  
              <li><a class="botao" href="busca_laudos.php">Adicionar Laudos</a></li>    
<?php 
session_start();
require_once("Connections/conexao.php");
$q_doc=mysql_query("select * from foto_doc where id_ped=".$_SESSION['cid']);
$nfotos=(int)mysql_num_rows($q_doc);
if($nfotos<1){?>                                      
              <li><a class="botao" href="add_docs.php">Adicionar Documentos</a></li> <?php 

if(is_null($_SESSION['pr'])){echo "<script>alert('Providencie o envio dos documentos pelo menu principal.\\nVocê tem 30 dias até o cancelamento. ');</script>";$_SESSION['pr']='ok';}
}?>                                        
                                      
              </ul>    
    </li>
</ul>
  <!--div id="header_box_menu_imagem"><a href="#"><img src="images/icons/home.png" border="0"/></a></div--> 
 
  <div id="header_box_menu_texto_d" class="arial_branco11" ><a class="arial_branco11" href="sair.php">Sair/Logout</a></div>
  <div id="header_box_menu_imagem_d"><a href="#"></a></div>  
  <div id="header_box_menu_texto_d" class="arial_branco11">Criador : <b><?php

$qr=mysql_query("select * from criadores where id_criador=".$_SESSION['cid']);
$f=mysql_fetch_assoc($qr);
echo $f['nome'];
unset($f);
unset($qr);
?></b></div>
  <div id="header_box_menu_imagem_d"></div>  

 </div>
</div>


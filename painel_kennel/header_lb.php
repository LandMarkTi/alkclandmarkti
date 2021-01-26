<link rel="stylesheet" type="text/css" href="css/style_header.css" />
<link rel="stylesheet" type="text/css" href="css/style_fonts.css" />

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
				display: inline-block;
				border-top: 1px solid #ccc;
				margin:0;
				width: 175px;
				}
			
			#jsddm li ul li a
			{	background: #eee;
				width: auto;
				color:#333;
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


<div id="header_full">
 <div id="header_margem_full">
  
  <div id="header_logo">
  <img src="images/logo_hor.png" style="height: 140%;margin-top: -7px;"/>
  </div>
  
  <div id="header_logo_painel"> <a href="index.php"><!--img src="images/logo_painel_controle.png" border="0"/--></a>
  </div>

 </div>
</div>

<div id="header_full_menu">
 <div id="header_margem_menu_full">
 
<ul id="jsddm">

  
    <li>
    <div class="menu_box"><a href="index_principal.php" class="oswald_branco16">Menu Principal</a></div>  
          <ul style="visibility: hidden; width: 175px;">
              <li><a href="listagem_criadores_pendentes.php">Criadores Pendentes</a></li>
              <li><a href="listagem_usuario.php">Criadores Aprovados</a></li>                                         
              <li><a href="listagem_pedigree_pen.php">Pedigrees Pendentes</a></li>                                         
              <li><a href="listagem_pedigree_vias.php?inicio">Pedigrees Impressos</a></li>                                         
              <li><a href="transferir.php">Transferência</a></li>                                         
              <li><a href="add_ped_ext5_f_3.php">Pedigree Externo</a></li>   
              <li><a href="listagem_pedigree_aprovado.php">Pedigrees Aprovados</a></li>   
              <?php if($_SESSION['login']=='kcbrasil@alkc.com.br'){?><li><a href="cobertura.php">Cobertura Pedigree</a></li>   <li><a href="serie.php">Apagar Série</a></li>  <?php }?> 
                                      
              </ul>    
    </li>
</ul>
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


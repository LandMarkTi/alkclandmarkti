<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_internas.css" />
<link rel="stylesheet" href="jquery/acord/style.css" type="text/css" />

<script type="text/javascript" src="jquery/scroll/js/jquery-1.4.2.min.js"></script>
<link type="text/css" href="jquery/jqueryui/css/redmond/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
<script type="text/javascript" src="jquery/jqueryui/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="jquery/jqueryui/js/jquery-ui-1.8.21.custom.min.js"></script>

<link rel="stylesheet" type="text/css" href="css/style_menu.css" />
<link rel="stylesheet" type="text/css" href="css/style_fonts.css" />
<link rel="stylesheet" href="jquery/menu/jquery.treeview.css" />	

	<script src="jquery/menu/lib/jquery.cookie.js" type="text/javascript"></script>
	<script src="jquery/menu/jquery.treeview.js" type="text/javascript"></script>
	<script src="jquery/menu/jquery.treeview.edit.js" type="text/javascript"></script>
	
	<script type="text/javascript">
		$(document).ready(function(){$('#browser').show();});
		$(function() {
			$("#browser").treeview({collapsed : true});		
			$("#browser li span:first").click();	
		});
		
	</script>
    

    	
<div id="menu_esquerdo_box">
 <div style="margin:10px;">
    <?php
if(!isset($_SESSION['login']))die();
if($_SESSION['login']=='sergio@sobraci.org'){
?>
    <ul id="browser" class="filetree" style="display:none">
	 <li><span class="folder">Menu de Opções</span>
	  <ul>
      
        <li><span class="folder">Grupos</span>
		 <ul id="folder21">
		 <li><span class="file"><a class="file" href="listagem_categoria.php" target="_parent">Listar Grupos</a></span></li>
		 <li><span class="file"><a class="file" href="cadastrar_categoria.php" target="_parent">Adicionar Grupo</a></span></li>
	     </ul>
	    </li>
        
        <li><span class="folder">Raças</span>
		 <ul id="folder21">
		 <li><span class="file"><a class="file" href="listagem_subcategoria.php" target="_parent">Listar Raças</a></span></li>
		 <li><span class="file"><a class="file" href="cadastrar_subcategoria.php" target="_parent">Adicionar raça</a></span></li>
	     </ul>
	    </li>
        
       
        
        <li><span class="folder">Cadastro de Credenciado</span>
		 <ul id="folder21">
		 <li><span class="file"><a class="file" href="listagem_sobraci.php" target="_parent">Listar ALKC</a></span></li>
		 <li><span class="file"><a class="file" href="listagem_cotas.php" target="_parent">Listar cotas</a></span></li>
		 <li><span class="file"><a class="file" href="cadastrar_cota3.php" target="_parent">Cadastro Certificado</a></span></li>
		 <li><span class="file"><a class="file" href="cadastrar_cota2.php" target="_parent">Cadastro Serial</a></span></li>
		 <li><span class="file"><a class="file" href="listagem_serial.php" target="_parent">Listagem Serial</a></span></li>


	     </ul>
	    </li>
        
        
        <!--li><span class="folder">Criadores credenciados</span>
		 <ul id="folder21">
		 <li><span class="file"><a class="file" href="listagem_usuario.php" target="_parent">Listar Criadores aprovados</a></span></li>
		 <li><span class="file"><a class="file" href="listagem_usuario_vencidos.php" target="_parent">Listar Criadores Expirados</a></span></li>
		 <li><span class="file"><a class="file" href="listagem_criadores_pendentes.php" target="_parent">Listar Criadores pendentes</a></span></li>
		 <li><span class="file"><a class="file" href="listagem_usuario_todos.php" target="_parent">Listar por núcleo</a></span></li>
	     </ul>
	    </li-->

        <li><span class="folder">Criadores ALKC</span>
		 <ul id="folder21">
		 <li><span class="file"><a class="file" href="listagem_usuario_a.php" target="_parent">ALKC Criadores aprovados</a></span></li>

		 <li><span class="file"><a class="file" href="listagem_usuario_pendente_a.php" target="_parent">ALKC Criadores pendentes</a></span></li>

		 <li><span class="file"><a class="file" href="listagem_usuario_exp.php" target="_parent">Criadores expirados</a></span></li>

	     </ul>
	    </li>
        
         <li><span class="folder">Pedigrees</span>
		 <ul id="folder21">
         <li><span class="file"><a class="file" href="listagem_pedigree2.php?inicio" target="_parent">Listar Pedigree</a></span></li>
    			<li><span class="file"><a class="file" href="listagem_pedigree_ex.php?inicio" target="_parent">Listar Pedigree Externo</a></span></li>
    			 <li><span class="file"><a class="file"  target="_parent" href="listagem_transf.php?inicio">Listar Transferências </a></span></li>
	              <li><span class="file"><a class="file"  target="_parent" href="listagem_transf_capa.php?inicio">Listar Transferências Web</a></span></li>
	              <li><span class="file"><a class="file"  target="_parent" href="listagem_transf_pre.php?inicio">Listar Pré Transferências</a></span></li>
	              <li><span class="file"><a class="file"  target="_parent" href="rank_ped_nucleo.php">Total Pedigree por Kennel</a></span></li>
	              <li><span class="file"><a class="file"  target="_parent" href="rank_ped_raca2.php">Total Pedigree por raça</a></span></li>

<li><span class="file"><a class="file"  target="_parent" href="listagem_pedigree_temp.php">Listar pedigree pendente</a></span></li>

<li><span class="file"><a class="file"  target="_parent" href="reparar_obs.php?id=1">Mudar Frase pedigree</a></span></li>

		<li><span class="file"><a class="file"  target="_parent" href="libera_femea.php">Liberar Fêmea</a></span></li>
         </ul>
	    </li>

	
        
        <li><span class="folder">Administradores</span>
		 <ul id="folder21">
		 <li><span class="file"><a class="file" href="listagem_adm.php" target="_parent">Listar Adm</a></span></li>
		 <li><span class="file"><a class="file" href="cadastrar_adm.php" target="_parent">Adicionar Adm</a></span></li>
	     </ul>
	    </li>

<!--li><span class="folder">Conteúdo</span>
		 <ul id="folder21">
		 <li><span class="file"><a class="file" href="reparar_noticia.php" target="_parent">Nova notícia</a></span></li>
		 <li><span class="file"><a class="file" href="listagem_noticia.php" target="_parent">Listar notícias</a></span></li>
		 <li><span class="file"><a class="file" href="cadastrar_video.php" target="_parent">Novo Vídeo</a></span></li>
		 <li><span class="file"><a class="file" href="listagem_video.php" target="_parent">Listar Vídeo</a></span></li>
		 <li><span class="file"><a class="file" href="cadastrar_galeria.php" target="_parent">Nova Galeria</a></span></li>
		 <li><span class="file"><a class="file" href="listagem_galeria.php" target="_parent">Listar Galeria</a></span></li>
		 <li><span class="file"><a class="file" href="listagem_banner.php" target="_parent">Banners TOPO</a></span></li>
		 <li><span class="file"><a class="file" href="reparar_cursos.php?id=9" target="_parent">Editar Cursos</a></span></li>
		 <li><span class="file"><a class="file" href="reparar_cursos.php?id=10" target="_parent">Editar Agenda</a></span></li>
		 <li><span class="file"><a class="file" href="reparar_cursos.php?id=11" target="_parent">Editar Titulos</a></span></li>
		 <li><span class="file"><a class="file" href="reparar_cursos.php?id=12" target="_parent">Editar Arbitros</a></span></li>
		 <li><span class="file"><a class="file" href="reparar_cursos.php?id=13" target="_parent">Editar SONARB</a></span></li>        
	     </ul>
	    </li-->
      
	
<!--li><span class="folder">Páginas Internas</span>
		 <ul id="folder21">
		 <li><span class="file"><a class="file" href="reparar_quemsomos.php" target="_parent">Editar Quem Somos</a></span></li> 
   		 <li><span class="file"><a class="file" href="reparar_diretoria.php" target="_parent">Editar Diretoria</a></span></li>         
   		 <li><span class="file"><a class="file" href="reparar_pedigree.php" target="_parent">Editar Pedigree</a></span></li>
   		 <li><span class="file"><a class="file" href="reparar_aberturacanil.php" target="_parent">Editar Abertura de Canil</a></span></li>
   		 <li><span class="file"><a class="file" href="reparar_registroinicial.php" target="_parent">Editar Registro Inicial</a></span></li>
   		 <li><span class="file"><a class="file" href="reparar_beneficios.php" target="_parent">Editar Benefícios</a></span></li>
   		 <li><span class="file"><a class="file" href="reparar_transf.php" target="_parent">Editar Transferência Propriedade</a></span></li>   		
         <li><span class="file"><a class="file" href="reparar_cursos.php" target="_parent">Editar Cursos</a></span></li>  
         <li><span class="file"><a class="file" href="reparar_precos.php" target="_parent">Editar Preços</a></span></li>         
         <li><span class="file"><a class="file" href="http://www.megapedigree.com/site/rgc.php" target="_blank">Acessar RGC</a></span></li>         
         <li><span class="file"><a class="file" href="reparar_rgc_site.php">Editar RGC</a></span></li>                                                      
	     </ul>
	    </li-->	
	
	<li><span class="folder">logs</span>
		 <ul id="folder21">
		 <li><span class="file"><a class="file" href="lista.php" target="_parent">Ultimos pagamentos</a></span></li>
	     </ul>
	    </li>
        
<li><span class="folder">RGC</span>
		 <ul id="folder21">
		<li><span class="file"><a class="file" href="listagem_rgc.php" target="_parent">Listar RG PET Pagos</a></span></li>
		 <li><span class="file"><a class="file" href="listagem_rgc_pendente.php" target="_parent">Listar RG PET Pendentes</a></span></li>
	   
	     </ul>
	    </li>
                
	  </ul>
	 </li>		
	</ul>
    <?php
 	 }else  die("<script>location='index.php';</script>");
?>

    

<?php
//}
?>
 </div>
</div>

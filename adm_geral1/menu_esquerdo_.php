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
session_start();
if(!isset($_SESSION['login']))die();
if($_SESSION['login']=='sergio@sobraci.org'){
?>
    <ul id="browser" class="filetree" style="display:none">
	 <li><span class="folder">Menu de Opções</span>
	  <ul>
      
        <li><span class="folder">Grupos</span>
		 <ul id="folder21">
		 <li><span class="file"><a class="file" href="listagem_categoria.php">Listar Grupos</a></span></li>
		 <li><span class="file"><a class="file" href="cadastrar_categoria.php">Adicionar Grupo</a></span></li>
	     </ul>
	    </li>
        
        <li><span class="folder">Raças</span>
		 <ul id="folder21">
		 <li><span class="file"><a class="file" href="listagem_subcategoria.php">Listar Raças</a></span></li>
		 <li><span class="file"><a class="file" href="cadastrar_subcategoria.php">Adicionar raça</a></span></li>
	     </ul>
	    </li>
        
       
        
        <li><span class="folder">Cadastro de Credenciado</span>
		 <ul id="folder21">
		 <li><span class="file"><a class="file" href="listagem_sobraci.php">Listar ALKC</a></span></li>
		 <li><span class="file"><a class="file" href="listagem_cotas.php">Listar cotas</a></span></li>
		 <li><span class="file"><a class="file" href="cadastrar_cota3.php" >Cadastro Certificado</a></span></li>
		 <li><span class="file"><a class="file" href="cadastrar_cota2.php">Cadastro Serial</a></span></li>
		 <li><span class="file"><a class="file" href="listagem_serial.php">Listagem Serial</a></span></li>
	     </ul>
	    </li>
        
        
        <!--li><span class="folder">Criadores credenciados</span>
		 <ul id="folder21">
		 <li><span class="file"><a class="file" href="listagem_usuario.php">Listar Criadores aprovados</a></span></li>
		 <li><span class="file"><a class="file" href="listagem_usuario_vencidos.php">Listar Criadores Expirados</a></span></li>
		 <li><span class="file"><a class="file" href="listagem_criadores_pendentes.php">Listar Criadores pendentes</a></span></li>
		 <li><span class="file"><a class="file" href="listagem_usuario_todos.php">Listar por núcleo</a></span></li>
	     </ul>
	    </li-->
        
        <li><span class="folder">Criadores ALKC</span>
		 <ul id="folder21">
		 <li><span class="file"><a class="file" href="listagem_usuario_a.php" >ALKC Criadores aprovados</a></span></li>

		 <li><span class="file"><a class="file" href="listagem_usuario_pendente_a.php" >ALKC Criadores pendentes</a></span></li>
		 <li><span class="file"><a class="file" href="listagem_usuario_exp.php">Criadores expirados</a></span></li>
	     </ul>
	    </li>
        

         <li><span class="folder">Pedigrees</span>
		 <ul id="folder21">
         		<li><span class="file"><a class="file" href="listagem_pedigree2.php?inicio" target="_parent">Listar Pedigree</a></span></li>
    			<li><span class="file"><a class="file" href="listagem_pedigree_ex.php?inicio" target="_parent">Listar Pedigree Externo</a></span></li>
    			  <li><span class="file"><a class="file"  target="_parent" href="listagem_transf.php?inicio">Listar Transferências </a></span></li>
	              <li><span class="file"><a class="file"  target="_parent" href="listagem_transf_capa.php?inicio">Listar Transferências Web</a></span></li>
	              <li><span class="file"><a class="file"  target="_parent" href="listagem_transf_tarjeta.php?inicio">Listar Transferências tarjeta</a></span></li>
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
		 <li><span class="file"><a class="file" href="listagem_adm.php">Listar Adm</a></span></li>
		 <li><span class="file"><a class="file" href="cadastrar_adm.php">Adicionar Admin</a></span></li>
	     </ul>
	    </li>

<!--li><span class="folder">Conteúdo</span>
		 <ul id="folder21">
		 <li><span class="file"><a class="file" href="reparar_noticia.php">Nova notícia</a></span></li>
		 <li><span class="file"><a class="file" href="listagem_noticia.php">Listar notícias</a></span></li>
		 <li><span class="file"><a class="file" href="cadastrar_video.php">Novo Vídeo</a></span></li>
		 <li><span class="file"><a class="file" href="listagem_video.php">Listar Vídeo</a></span></li>
		 <li><span class="file"><a class="file" href="cadastrar_galeria.php">Nova Galeria</a></span></li>
		 <li><span class="file"><a class="file" href="listagem_galeria.php">Listar Galeria</a></span></li>
		 <li><span class="file"><a class="file" href="listagem_banner.php">Banners TOPO</a></span></li>
		 <li><span class="file"><a class="file" href="reparar_cursos.php?id=9">Editar Cursos</a></span></li>
		 <li><span class="file"><a class="file" href="reparar_cursos.php?id=10">Editar Agenda</a></span></li>
		 <li><span class="file"><a class="file" href="reparar_cursos.php?id=11">Editar Titulos</a></span></li>
		 <li><span class="file"><a class="file" href="reparar_cursos.php?id=12">Editar Arbitros</a></span></li>
		 <li><span class="file"><a class="file" href="reparar_cursos.php?id=13">Editar SONARB</a></span></li>        
	     </ul>
	    </li-->
      
	
<!--li><span class="folder">Páginas Internas</span>
		 <ul id="folder21">
		 <li><span class="file"><a class="file" href="reparar_quemsomos.php">Editar Quem Somos</a></span></li> 
   		 <li><span class="file"><a class="file" href="reparar_diretoria.php">Editar Diretoria</a></span></li>         
   		 <li><span class="file"><a class="file" href="reparar_pedigree.php">Editar Pedigree</a></span></li>
   		 <li><span class="file"><a class="file" href="reparar_aberturacanil.php">Editar Abertura de Canil</a></span></li>
   		 <li><span class="file"><a class="file" href="reparar_registroinicial.php">Editar Registro Inicial</a></span></li>
   		 <li><span class="file"><a class="file" href="reparar_registroninhada.php">Editar Registro Ninhada</a></span></li>         
   		 <li><span class="file"><a class="file" href="reparar_beneficios.php">Editar Benefícios</a></span></li>
   		 <li><span class="file"><a class="file" href="reparar_transf.php">Editar Transferência Propriedade</a></span></li>   		
         <li><span class="file"><a class="file" href="reparar_cursos.php">Editar Cursos</a></span></li>  
         <li><span class="file"><a class="file" href="reparar_precos.php">Editar Preços</a></span></li>   
         <li><span class="file"><a class="file" href="http://www.megapedigree.com/site/rgc.php" target="_blank">Acessar RGC</a></span></li>
         <li><span class="file"><a class="file" href="reparar_rgc_site.php">Editar RGC</a></span></li>         
	     </ul>
	    </li-->	
	
	<!--li><span class="folder">logs</span>
		 <ul id="folder21">
		 <li><span class="file"><a class="file" href="lista.php">Ultimos pagamentos</a></span></li>
	     </ul>
	    </li-->
        
<li><span class="folder">RGC</span>
		 <ul id="folder21">
		 <li><span class="file"><a class="file" href="listagem_rgc.php">Listar RG PET Pagos</a></span></li>
		 <li><span class="file"><a class="file" href="listagem_rgc_pendente.php">Listar RG PET Pendentes</a></span></li>
	     </ul>
	    </li>
                
	  </ul>
	 </li>		
	</ul>
    <?php
}else { die("<script>location='index.php';</script>");
?>
<ul id="browser" class="filetree">
	 <li><span class="folder">Menu de Opções</span>
	  <ul>
      
        <li><span class="folder">Grupos</span>
		 <ul id="folder21">
		 <li><span class="file"><a class="file" href="listagem_categoria.php">Listar Grupos</a></span></li>
		 <li><span class="file"><a class="file" href="cadastrar_categoria.php">Adicionar Grupo</a></span></li>
	     </ul>
	    </li>
        
        <li><span class="folder">Raças</span>
		 <ul id="folder21">
		 <li><span class="file"><a class="file" href="listagem_subcategoria.php">Listar Raças</a></span></li>
		 <li><span class="file"><a class="file" href="cadastrar_subcategoria.php">Adicionar raça</a></span></li>
	     </ul>
	    </li>
        
       
       
<li><span class="folder">Conteúdo</span>
		 <ul id="folder21">
		 <li><span class="file"><a class="file" href="reparar_cursos.php?id=9">Editar Cursos</a></span></li>
		 <li><span class="file"><a class="file" href="reparar_cursos.php?id=10">Editar Agenda</a></span></li>
		 <li><span class="file"><a class="file" href="reparar_cursos.php?id=11">Editar Titulos</a></span></li>
		 <li><span class="file"><a class="file" href="reparar_cursos.php?id=12">Editar Arbitros</a></span></li>

	     </ul>
	    </li>
      
	
	
	
	
	  </ul>
	 </li>		
	</ul>
    

<?php
}
?>
 </div>
</div>

<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");
$sql = "SELECT  *,pedigree.nome as nc  FROM  `pedigree`  JOIN criadores ON pedigree.id_criador = criadores.id_criador JOIN subcategoria ON pedigree.id_raca=subcategoria.idSubcategoria left join pagtos on pedigree.id_ped=pagtos.id_criador  WHERE pedigree.id_criador=$_SESSION[cid] limit 20";
$query = mysql_query($sql) or die('e1');

//Pegando o TOTAL DE REGISTROS da tabel ADM
$nn=mysql_num_rows($query);


$sqlt = "SELECT  *,pedigree.nome as nc  FROM  `pedigree`  JOIN criadores ON pedigree.id_criador = criadores.id_criador JOIN subcategoria ON pedigree.id_raca=subcategoria.idSubcategoria join adiciona_filhote using(id_ped)  WHERE adiciona_filhote.id_criador=$_SESSION[cid]";
$queryt = mysql_query($sqlt) or die(e2);

$nnt=mysql_num_rows($queryt);



$nn+=(int)$nnt;

$v_p=array('Não','Não','Sim');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_fonts.css" />
<link rel="stylesheet" type="text/css" href="css/style_internas.css" />
<link rel="stylesheet" href="jquery/acord/style.css" type="text/css" />
<link rel="shortcut icon" href="favicon.png" /> 
<title>::. Painel de Controle .::</title>
<script type="text/javascript" src="jquery/scroll/js/jquery-1.4.2.min.js"></script>
<script src="jquery/alerta/jquery-ui.min.js"></script>
<link rel="stylesheet" href="jquery/alerta/jquery-ui.css" type="text/css" />
<script src="jquery/alerta/jquery.easy-confirm-dialog.js"></script>
<script type="text/javascript">
	//$(function() {
	$(document).ready(function(){	
		$("#yesno").easyconfirm({locale: { title: 'Deseja realmente deletar?', button: ['Não','Sim']}});
		$("#yesno").click(function() {return false;
				var files = '';
				$(".cinput:checked").each(function(){
				files = files + '' + this.value + '-';
				});
				$.post("deletar_varios_ped.php", 
								  {id: files
				},
								  function(retorno){
									 //$("#check").html(retorno);
									 //alert(retorno);
									 document.location.reload();
								  }
								  );
				//alert("Deletado com sucesso!");

				//location="teste.php";
			});
			
	});
	
	function ConfirmaExclusao(id){return false;
		$("#yesno"+id).easyconfirm({locale: { title: 'Deseja realmente deletar?', button: ['Não','Sim']}});
		$("#yesno"+id).click(function() {
				$.post("deletar_ped.php",
					{id: id},
	   				 function(retorno){
						//$("#resultado").html(retorno);
						window.location.reload();
        			 } 
        		);
				//alert("Deletado com sucesso! ");
				
		});
		
	}
</script>



<script src="jquery/tabela/jquery.tablesorter.min.js"></script>
<script src="jquery/tabela/jquery.tablesorter.pager.js"></script>
<link rel="stylesheet" href="jquery/tabela/custom.css" media="screen" />


<style>

<style>
table tbody tr.checked{
        background:#549ABE;
		color:#FFF;
}

table tbody tr.checked:hover{
        background:#549ABE;
		color:#FFF;
}

table tbody tr.unchecked:hover{
        background:#549ABE;
		color:#FFF;
}		
.aviso{
	width:100%;
	font-size:18px;	
}

</style>
</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
<?php include "header_l.php";?>

<div id="internas_full">
 <div id="internas_margem_full">
    <?php include "menu_esquerdo.php";?>  
    <div id="internas_box">
    
   <div id="internas_busca">
   <div class="arial_cinza2_14" style="float:right; margin-top:8px; margin-left:4px; width:auto;"></span></div>
   <form method="post" action="#" id="frm-filtro">
      <p>
        <input name="pesquisar" id="pesquisar" type="text" value="Buscar" onBlur="if(this.value=='') {this.value='Buscar';}" onFocus="if(this.value=='Buscar') {this.value='';}" class="forms">
      </p>
    </form>
   </div>
   
    	<div id="internas_principal">
    	  <div class="arial_branco20" id="internas_titulo">Lista de Pedigree         
            

          </div>
         <div>
         <form id="frm_resultados" action="#" method="post" name="opts">
         <table cellspacing="0" summary="Tabela de pedigree" width="100%">
      <thead>
        <tr>
          <th width="30"><input type="checkbox" value="1" id="marcar-todos" name="marcar-todos" /></th>
		  
		  <th width="180">Raça </th>
		<th width="201">nome</th>
		<th width="61">registro</th>
		<th width="101">Transferência<br>Habilitada</th>
		
		  <th width="80">data </th>
		  <th width="101" style="display:none">reservado </th>
		  <th width="115">Opções</th>
        </tr>
      </thead>
      <tbody>
      <?php  while($linha = mysql_fetch_array($query)) {
$nn=explode(';',$linha['ninhada']);
$cores=explode(';',$linha['cor']);


$i=4;
while($i<20){

$var=$cores[$i-4];

$var=explode('*',$var);

		if($nn[$i]!='Nome Filhote'){
?>
        <tr>
				<td height="25" align="center"><input type="checkbox" value="<?php echo $linha['id_ped']; ?>" name="marcar[]" class="cinput" /></td>
		        
		        <td><?php echo $linha['nomeSubcategoria'].' '.$var[1]; ?></td>
			<td><?php echo $nn[$i]; ?></td>
			<td><?php echo $linha['registro'].''.($i-4); ?></td>
			<td>
<?php


			//$jhb=mysql_query("select * from ped_print where id_ped=".$linha['id_ped']." and id_f= ".($i)." order by id_perm desc limit 1");
			//$lp=mysql_fetch_assoc($jhb);
			//$nr=mysql_num_rows($jhb);
			if($nr>=1){echo $v_p[$lp['tipo_perm']];} else {echo '';}
			
			?><img src="images/icons/atualizar.png" style="cursor:pointer" onclick="location='transferencia.php?id_ped=<?=$linha['id_ped']?>&id_f=<?=$i?>';"></td>
			<td><?php echo date("d/m/Y",$linha['emissao']); ?></td>
			
		        <td valign="middle"><a href="../painel_kennel/pedcode.php?id_ped=<?php echo $linha['id_ped']; ?>&id_filhote=<?=($i)?>&bt=2"><img src="images/icons/visualizar.png" title="Visualizar" alt="Visualizar" border="0"/></a>  
<span title="Consultar Laudos/exames" onclick="location='ver_laudos.php?id_ped=<?php echo $linha['id_ped']; ?>&id_f=<?php echo $i; ?>';" style="cursor:pointer;color: white;
background-color: red;
padding: 5px;
border-radius: 7px;
font-size: 17px;
height: 8px;
width: 9px;
display: inline-block;
line-height: 5px;">+</span>

<span  title="Solicitar DNA" onclick="location='dna.php?id_ped=<?php echo $linha['id_ped']; ?>&id_f=<?php echo $i; ?>';" style="cursor:pointer;color: white;
background-color: whiteSmoke;
padding: 5px;
border-radius: 7px;
font-size: 17px;
height: 8px;
width: 9px;
display: inline-block;
line-height: 5px;"><img src="images/dna2.png" style="width:130%;height:130%"></span> <!--a href="pre_trans.php?id_ped=<?=$linha['id_ped']?>&id_f=<?=$i?>" style="text-decoration:none;font-weight: bold;color:black;padding:4px"> T </a-->   
<a href="../painel_kennel/cobertura_conf.php?id_ped=<?php echo $linha['id_ped']; ?>&id_f=<?=($i)?>"><img src="images/icons/cob2.png?dd=s" title="Cobertura" alt="Visualizar" border="0"/></a>
<a href="add_vacina.php?id_ped=<?php echo $linha['id_ped']; ?>&id_f=<?=($i)?>"><img src="images/icons/seringa.png" title="Vacina" alt="Visualizar" border="0"/></a>  
</td>  </tr>
       <?php 
	}
	$i++;
	}
}

//loop trocados

while($linhat = mysql_fetch_array($queryt)){
		$i=$linhat['id_filhote'];
$nn=explode(';',$linhat['ninhada']);
?>
        <tr>
				<td height="25" align="center"><input type="checkbox" value="<?php echo $linhat['id_ped']; ?>" name="marcar[]" class="cinput" /></td>
		        
		        <td><?php echo $linhat['nomeSubcategoria']; ?></td>
			<td><?php echo $nn[$i]; ?></td>
			<td><?php echo $linhat['registro'].''.($i-4); ?></td>
			<td>-</td>
			<td><?php echo date("d/m/Y",$linhat['emissao']); ?></td>
		        <td valign="middle">

<a href="../painel_kennel/pedcode.php?id_ped=<?php echo $linhat['id_ped']; ?>&id_filhote=<?=($i)?>&bt=2"><img src="images/icons/visualizar.png" title="Visualizar" alt="Visualizar" border="0"/></a>  
<?php if(1){ ?>
<span title="Consultar Laudos/exames" onclick="location='ver_laudos.php?id_ped=<?php echo $linhat['id_ped']; ?>&id_f=<?php echo $i; ?>';" style="cursor:pointer;color: white;
background-color: red;
padding: 5px;
border-radius: 7px;
font-size: 17px;
height: 8px;
width: 9px;
display: inline-block;
line-height: 5px;">+</span>

<span  title="Solicitar DNA" onclick="location='dna.php?id_ped=<?php echo $linhat['id_ped']; ?>&id_f=<?php echo $i; ?>';" style="cursor:pointer;color: white;
background-color: whiteSmoke;
padding: 5px;
border-radius: 7px;
font-size: 17px;
height: 8px;
width: 9px;
display: inline-block;
line-height: 5px;"><img src="images/dna2.png" style="width:130%;height:130%"></span> <a href="pre_trans.php?id_ped=<?=$linhat['id_ped']?>&id_f=<?=$i?>" style="text-decoration:none;font-weight: bold;color:black"> T </a> 

<?php }?>
</td>
       </tr>
       <?php 
	
	
	}


 ?>







      </tbody>
    </table>
        
        
        <div id="pager" class="pager" style="margin-top:17px;">
    	<form>
				<span>
					Exibir <select class="pagesize">
                            <option value="10" selected="selected">10</option>
							<option value="20">20</option>
							<option value="30">30</option>
							<option  value="40">40</option>
					</select> registros
				</span>

				<img src="jquery/tabela/first.png" class="first"/>
    		<img src="jquery/tabela/prev.png" class="prev"/>
    		<input type="text" class="pagedisplay" readonly="readonly"/>
    		<img src="jquery/tabela/next.png" class="next"/>
    		<img src="jquery/tabela/last.png" class="last"/>
    	</form>
    </div>
    
    <script>
    $(function(){
      
      $('table > tbody > tr:odd').addClass('odd');
      
      
      
      $('form').submit(function(e){ e.preventDefault(); });
      
      $('#pesquisar').keydown(function(){
        var encontrou = false;
        var termo = $(this).val().toLowerCase();
        $('table > tbody > tr').each(function(){
          $(this).find('td').each(function(){
            if($(this).text().toLowerCase().indexOf(termo) > -1) encontrou = true;
          });
          if(!encontrou) $(this).hide();
          else $(this).show();
          encontrou = false;
        });
      });
      
      
    });
    </script>
           </form>
         </div>
         
      </div>
    
  </div>
</div>
<?php include "footer.php";?>
</body>
</html>

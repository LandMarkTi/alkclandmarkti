<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");
$off=0;

$and='';

if(isset($_GET['off']))$off=(int)10*$_GET['off'];

if(isset($_GET['p']))$p=(int)$_GET['p']*100;






if(isset($_GET['chave']) && is_null($_GET['chave'])==false){

 $bchave=substr($_GET['chave'],0,-1);

$bs='&chave='.$_GET['chave'];$and=' and (registro = \''.$bchave.'\' OR ninhada like \'%'.$_GET['chave'].'%\') '; }
//nucleo

$nuc=addslashes($_GET['nuc']);

$rac=(int)$_GET['rac'];

if(isset($_GET['nuc']) && is_null($_GET['nuc'])==false)$and.=" and registro like 'RG/$nuc/%'";$bs.="&nuc=".$_GET['nuc'];

if(isset($_GET['rac']) && is_null($_GET['rac'])==false && $_GET['rac']!='-')$and.=" and id_raca = '$rac' ";$bs.="&rac=".$_GET['rac'];


$di=$_GET['di'];
$df=$_GET['df'];

$di=$di/1000;
$df=$df/1000;


if(isset($_GET['di']) && is_null($_GET['di'])==false){$bs.="&di=$_GET[di]&df=$_GET[df]";$and.=" and emissao BETWEEN ".$di.' and '.$df." ";}

if(!isset($_GET['inicio'])){

$sql = "SELECT  *,pedigree.nome as nc  FROM  `pedigree`  JOIN criadores ON pedigree.id_criador = criadores.id_criador JOIN subcategoria ON pedigree.id_raca=subcategoria.idSubcategoria    WHERE ( registro not like 'RGE%' and registro not like 'RI%' and registro not like 'RG/E/%' ".') '.$and.'  limit '.($off+$p).', 10 ' ;
$query = mysql_query($sql) or die(mysql_error());

//Pegando tudo pg

$sql2 = "SELECT  count(*) as cpn,SUM( CEIL( SUBSTR( ninhada, 1, 1 ) ) ) AS macho, SUM( CEIL( SUBSTR( ninhada, 3, 1 ) ) ) AS femea  FROM  `pedigree`  JOIN criadores ON pedigree.id_criador = criadores.id_criador JOIN subcategoria ON pedigree.id_raca=subcategoria.idSubcategoria  WHERE (  registro not like 'RGE%' and registro not like 'RI%' and registro not like 'RG/E/%'".') '.$and.'  ' ;
$qn=mysql_query($sql2) or die(mysql_error());
$cpn=mysql_fetch_assoc($qn);
$cpn=$cpn['macho']+$cpn['femea'];

//sub rge
/*

$sqlx = "SELECT  *,SUM( CEIL( SUBSTR( ninhada, 1, 1 ) ) ) AS macho, SUM( CEIL( SUBSTR( ninhada, 3, 1 ) ) ) AS femea,criadores.nome as ncria ,credenciado.nome as ncred  FROM  `pedigree`  JOIN criadores ON pedigree.id_criador = criadores.id_criador JOIN subcategoria ON pedigree.id_raca=subcategoria.idSubcategoria join credenciado using(id_credenciado)  JOIN registro_anterior USING ( id_ped ) WHERE (registro like 'RGE%' OR registro like 'RI%')  and ( 1".') '.$and.'  ' ;
$qnx=mysql_query($sqlx);
$cpnx=mysql_fetch_assoc($qnx);
$cpnx=$cpnx['macho']+$cpnx['femea'];

$cpn=$cpn-$cpnx;
*/
//if($cpn>56000)$cpn-=2502;
/*
$q_rank="SELECT COUNT( * ) AS peds, s.nomeSubcategoria ,
(SELECT count(*) FROM `pedigree` pd join criadores using(id_criador) join credenciado cc using (id_credenciado) where pd.id_raca=pp.id_raca group by pd.id_raca) as cad
FROM  `pedigree` pp
JOIN subcategoria s ON id_raca =  `idSubcategoria` 
JOIN ped_vias2 ON pp.id_ped = id_user 
WHERE 1 
GROUP BY nomeSubcategoria 
ORDER BY  `peds` DESC ";
$qrr=mysql_query($q_rank)or die(mysql_error());


$t_imp=0;
while($linha=mysql_fetch_array($qrr)){$t_imp+=$linha[0]; }

*/
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="Keywords" content="Painel de Controle " /> 
<meta name="Description" content="Painel de Controle "/> 
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_fonts.css" />
<link rel="stylesheet" type="text/css" href="css/style_internas.css" />
<link rel="stylesheet" href="jquery/acord/style.css" type="text/css" />
<link rel="shortcut icon" href="favicon.png" /> 
<title>::. Painel de Controle  .::</title>
<script type="text/javascript" src="jquery/scroll/js/jquery-1.4.2.min.js"></script>
<script src="jquery/alerta/jquery-ui.min.js"></script>
<link rel="stylesheet" href="jquery/alerta/jquery-ui.css" type="text/css" />
<script src="jquery/alerta/jquery.easy-confirm-dialog.js"></script>
<script type="text/javascript">
	//$(function() {
	$(document).ready(function(){	/*
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
			*/
	});
	
	function ConfirmaExclusao(id){return false;
		//$("#yesno"+id).easyconfirm({locale: { title: 'Deseja realmente deletar?', button: ['Não','Sim']}});
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

<script type="text/javascript">
$(function(){
	// Datepicker
	$('#dataInicial').datepicker({
		inline: true,
		dateFormat: "dd/mm/yy",
		altField: "#dataInicialEpoch",
		altFormat: "@",
		beforeShow: function(){$('.pgg').val(0);}
	});
	// Datepicker
	$('#dataFinal').datepicker({
		inline: true,
		dateFormat: "dd/mm/yy",
		altField: "#dataFinalEpoch",
		altFormat: "@",
		beforeShow: function(){$('.pgg').val(0);}
	});
	//$('#dataInicial').val( "01/01/2014" );
	//$('#dataFinal').val( "<?php echo date('d/m/Y');?>" );
	$('#dataFinalEpoch').val("<?php echo time();?>000");
	//$('#dataInicialEpoch').val("<?php echo time();?>000");
});
</script>

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

#example_length{float:right}
#example_info{float:right}
#example_paginate{cursor:pointer}
.pg span a{font-size: 18px;text-decoration:none;color:black}
.pg{margin-left:10px}
</style>
</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
<?php include "header.php";?>

<div id="internas_full">
 <div id="internas_margem_full">
    <?php include "menu_esquerdo.php";?>  
    <div id="internas_box">
    
   <div id="internas_busca">

   <form method="post" action="#" id="frm-filtro">
      <p>

      </p>
    </form>
   </div>
   
    	<div id="internas_principal">
    	  <div class="arial_branco20" id="internas_titulo">Listagem de Pedigree   <small style="float:right">Encontrados: <?echo (int)$cpn;?> </small> 
            

          </div>
         <div>
         <form id="frm_resultados"  method="get" name="opts">
<div id="example_filter" class="dataTables_filter"><label>Procurar:<input type="search" onclick="$('.pgg').val(0);" name="chave" value="<?php if(isset($_GET['chave']))echo $_GET['chave'];?>" placeholder="nome ou registro" ></label>

Emitido:
<input id="dataInicial" placeholder="a partir de?" style="width: 80px;">
<input id="dataFinal" placeholder="até quando?" style="width: 80px;">
<select name="rac" style="width: 120px;" onclick="$('.pgg').val(0);"><option value="-">Raça..</option>
<?php
$q_sub=mysql_query('SELECT * FROM `subcategoria` where 1');

while($f_sub=mysql_fetch_assoc($q_sub)){

	echo '<option value="'.$f_sub['idSubcategoria'].'">'.$f_sub['nomeSubcategoria'].'</option>';

}


?>
</select>
<select name="nuc" style="width: 120px;" onclick="$('.pgg').val(0);"><option value="%">Apropriado em..</option>
<?php

$sql_nuc="SELECT * FROM `credenciado` JOIN dados_credenciado ON id_credenciado = id_dados where id_credenciado>85";

$q_nuc=mysql_query($sql_nuc);

while($op_n=mysql_fetch_assoc($q_nuc))echo '<option value="'.$op_n['sigla'].'">'.$op_n['nome'].'</option>'

?>
</select>
<input id="dataInicialEpoch" type="hidden" name="di">
<input id="dataFinalEpoch" type="hidden" name="df">
<input type="submit" value="Buscar">
</div>
         <table cellspacing="0" id='example' width="100%">
      <thead>
        <tr>
          <th width="30"><input type="checkbox" value="1" id="marcar-todos" name="marcar-todos" /></th>
		  <th width="42">Id</th>
		  <th width="201">Raça </th>
		<th width="201">nome</th>
		<th width="101">registro</th>
		<th>Pago</th>
		  <th width="101">data </th>
		  <th width="67">Opções</th>
        </tr>
      </thead>
      <tbody>
	
      <?php  while($linha = mysql_fetch_array($query)) {
$nn=explode(';',$linha['ninhada']);
$i=4;
while($i<20){
		if($nn[$i]!='Nome Filhote'){
		
?>
        <tr>
			<td height="25" align="center"><input type="checkbox" value="<?php echo $linha['id_ped']; ?>" name="marcar[]" class="cinput" /></td>
		        <td height="25" align="center"><?php echo $linha['id_ped']; ?></td>
		        <td><?php echo $linha['nomeSubcategoria']; ?></td>
			<td><?php echo $nn[$i]; ?></td>
			<td><?php echo $linha['registro'].''.($i-4); ?></td>
			<td><input type="checkbox" <?php if($linha['hora']!='')echo 'checked';?>></td>
			<td><?php echo date("d/m/Y",$linha['emissao']); ?></td>
		        <td valign="middle"><a target="_new" href="reparar_pedigree2.php?id=<?php echo $linha['id_ped']; ?>&f=<?=($i-4)?>"><img src="images/icons/visualizar.png" title="Visualizar" alt="Visualizar" border="0"/></a><a target="_new" href="http://www.megapedigree.com/painel_kennel/pedcode.php?id_ped=<?php echo $linha['id_ped']; ?>&id_filhote=<?=$i?>"><img style="max-width:20px" src="http://www.megapedigree.com/painel_credenciado/images/icons/Note-icon.png"></a>

				<!-- <a href="#" id="yesno<?php echo $linha['id_ped']; ?>"><img src="images/icons/excluir.png" title="Excluir" alt="Excluir" border="0" onClick="ConfirmaExclusao(<?php echo $linha['id_ped']; ?>);"/></a> --></td>
        </tr>
       <?php 
		}
	$i++;
	}

} ?>
      </tbody>
    </table>
        
        
        <div style="margin-top:17px;float:left" class="pg">
    	<?php 
							$p=0;
							
							if(isset($_GET['p']))$p=$_GET['p'];
							$i=0;
							while($i<10&&($i*10<$cpn)){?>
                            <span>
                                <a href="listagem_pedigree2.php?<?php echo 'off='.$i.'&p='.$p.$bs;?>"><?=1+$i+$p*10?></a>
                            </span>
                            <?php $i++;} ?>

                           <?php if($i==10){?> <span><a href="listagem_pedigree2.php?<?php echo 'off=0&p='.($p+1).$bs;?>">ver +</a></span><?php }?>
    </div>        <div style="margin-top:17px;margin-right:17px;float:right" ></div>
    
    <script>////cdn.datatables.net/plug-ins/e9421181788/i18n/Portuguese.json
    $(document).ready(function() {
    $('#erro').dataTable( {
	"language": {
            "url": "http://cdn.datatables.net/plug-ins/e9421181788/i18n/Portuguese.json"
        },
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api();
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            var total = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                } );
 
            // Total over this page
            var pageTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                } );
 
            // Update footer
            //$( api.column( 4 ).footer() ).html('$'+pageTotal +' ( $'+ total +' total)');
        }
    } );
} );
    </script>



<input class="pgg" name="p" value="<?=(int)$_GET['p']?>" type="hidden">
<input class="pgg" name="off" value="<?=(int)$_GET['off']?>" type="hidden">


           </form>
         </div>
         
      </div>
    
  </div>
</div>
<?php include "footer.php";?>
</body>
</html>

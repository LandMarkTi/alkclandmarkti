<?php
session_start();
if($_SESSION['login']!='sergio@sobraci.org')die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");



$opt=(int)trim($_GET['opt']);

$limit='';
if($opt==1)$limit=" limit 0";



//kennel
$sqlk = "SELECT  *  FROM  `credenciado` left join dados_credenciado on credenciado.id_credenciado=dados_credenciado.id_dados   WHERE id_credenciado not in (16,44,68,43,17,15,43,41,109,102,111) and id_credenciado>85 order by nome";

$sel='<option value="102">Kennel Clube Brasil</option>';
$queryk = mysql_query($sqlk) or die(mysql_error());
while($opt=mysql_fetch_assoc($queryk)){
if($opt['id_credenciado']!=92){$sel.='<option value="'.$opt['id_credenciado'].'">'.$opt['nome'].'</option>';} else {$sel.='<option value="92">Kennel Clube Rio de Janeiro</option>';}
}
//busca

$idc=(int)trim($_GET['nome']);

if($idc>0)$idc=$idc+21634;


$nome=addslashes(trim($_GET['nome']));

$raca=addslashes(trim($_GET['raca']));

//$cert=trim($_GET['cert']);

$busca=' ';

if($nome!='-'&& $nome!='')$busca.="and (nome_completo like '$nome%' OR cpf like '$nome%' OR id_criador = '$idc') ";

//if($raca!='-'&& $raca!='')$busca.="and Racas like '%$raca%' ";



$estado=trim($_GET['estado']);
if($estado!='-' && $estado!='')$busca.="and estado like '$estado%' ";


$knl=trim($_GET['knl']);
if($knl!='-' && $knl!='')$busca.="and id_credenciado = '$knl' ";


$sql1="select distinct(id_criador),id_adm from aprovados where id_adm>85";
$qr1=mysql_query($sql1);
$set='';
while($s=mysql_fetch_assoc($qr1)){$set.=$s['id_criador'].',';}


$ini=trim($_GET['ini']);
if($ini!='-' && $ini!=''){
$ini=mktime("0", "0", "0", substr($ini,5,2), substr($ini,8,2), substr($ini,0,4));
$busca.="and data > '$ini' ";
}


$fim=trim($_GET['fim']);
if($fim!='-' && $fim!=''){
$fim=mktime("0", "0", "0", substr($fim,5,2), substr($fim,8,2), substr($fim,0,4));
$busca.="and data <= '$fim' ";
}

$sql = "SELECT * FROM criadores join aprovados using (id_criador) where  id_criador in ($set 0) and id_credenciado>85 and id_criador>'21634' $busca  ORDER BY id_criador DESC $limit";//concat( `ano_assinatura` , `mes_assinatura` , `dia_assinatura` ) > ".date("Ymd",time()-31556926)."

$query = mysql_query($sql) or die($sql);
//Pegando o TOTAL DE REGISTROS da tabel ADM
$total="select count(*),id_criador from criadores where id_criador in ($set 0) ";
//$result = mysql_query($total) or die(mysql_error());
//$total = mysql_fetch_array($result);

$nn=mysql_num_rows($qr1);
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
<title>::. Painel de Controle  .::</title>
<link rel="stylesheet" href="jquery/alerta/jquery-ui.css" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link rel="stylesheet" href="jquery/tabela/custom.css" media="screen" />
<script src="jquery/alerta/jquery.easy-confirm-dialog.js"></script>

<script type="text/javascript">
	//$(function() {

	/*
	function ConfirmaExclusao(id){
		$("#yesno"+id).easyconfirm({locale: { title: 'Deseja realmente deletar?', button: ['Não','Sim']}});
		$("#yesno"+id).click(function() {
				$.post("deletar_criador.php",
					{id: id},
	   				 function(retorno){
						//$("#resultado").html(retorno);
						window.location.reload();
        			 } 
        		);
				//alert("Deletado com sucesso! ");
				
		});
		
	}
	*/

</script>



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

</style>
</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
<?php include "header.php";?>

<div id="internas_full">
 <div id="internas_margem_full">
<?php include "menu_esquerdo.php"; ?>
    <div id="internas_box">
    
   <div id="internas_busca">


   </div>
   
    	<div id="internas_principal">
    	  <div class="arial_branco20" id="internas_titulo">Lista de criadores Aprovados      
            <div style="float:right; margin-left:10px;"><a class="botao" onClick='history.go(-1)'><img src="images/botoes/voltar.png" border="0" title="Voltar página anterior" ></a></div>
          <div style="float:right;"><a class="botao" id="yesno" href="#"><img src="images/botoes/excluir.png" border="0" title="Excluir Selecionados"></a></div>
          <div style="float:right; margin-right:10px;"></div>
          </div>

    	  <div ><form>Filtrar por <input placeholder="nome,cpf.." name="nome"><select name="estado" style="width: 70px;"><option value="-">Estado..</option>

    <option value="AC">Acre</option>
    <option value="AL">Alagoas</option>
    <option value="AP">Amapá</option>
    <option value="AM">Amazonas</option>
    <option value="BA">Bahia</option>
    <option value="CE">Ceará</option>
    <option value="DF">Distrito Federal</option>
    <option value="ES">Espírito Santo</option>
    <option value="GO">Goiás</option>
    <option value="MA">Maranhão</option>
    <option value="MT">Mato Grosso</option>
    <option value="MS">Mato Grosso do Sul</option>
    <option value="MG">Minas Gerais</option>
    <option value="PA">Pará</option>
    <option value="PB">Paraíba</option>
    <option value="PR">Paraná</option>
    <option value="PE">Pernambuco</option>
    <option value="PI">Piauí</option>
    <option value="RJ">Rio de Janeiro</option>
    <option value="RN">Rio Grande do Norte</option>
    <option value="RS">Rio Grande do Sul</option>
    <option value="RO">Rondônia</option>
    <option value="RR">Roraima</option>
    <option value="SC">Santa Catarina</option>
    <option value="SP">São Paulo</option>
    <option value="SE">Sergipe</option>
    <option value="TO">Tocantins</option>

</select> 


 <select name="knl" style="width: 70px;"><option value="-">Kennel..</option><?php echo $sel; ?></select>

 Início:<input type="date" name="ini" placeholder="Inicio" > Fim:<input type="date" name="fim" placeholder="Fim"> <input value="OK" type="submit" style="width: 30px;display:inline;">      
           </form>
          </div>

         <div>
         <form id="frm_resultados" action="#" method="post" name="opts">
         <table cellspacing="0"  width="100%" id="example">
      <thead>
        <tr>
          <th width="32"><input type="checkbox" value="1" id="marcar-todos" name="marcar-todos" /></th>
	 <th width="34">Número do Canil</th>
	<th width="200">Nome do Canil</th>
          <th width="187" >Nome do proprietário</th>
          <th width="67">Registro</th>          
          <!--th width="344" colspan="3">Status</th-->
          
          <!--th width="344">tipo</th>-->
		  <th width="72">Opções</th>
        </tr>
      </thead>
      <tbody>
      
          
      
      <?php  while($linha = mysql_fetch_array($query)) {?>
        <tr>
		<td height="25" align="center"><input type="checkbox" value="<?php echo $linha['id_criador']; ?>" name="marcar[]" class="cinput" /></td>
		 <td height="25" align="center"><?php echo ($linha['id_criador']-21634); ?></td>
		 <td><?php echo $linha['nome_completo']; ?> 


		</td>
                <td><?php echo substr($linha['nome'],0,20).' '.substr($linha['sobrenome'],0,20).'..'; ?> </td>
                <td><?php echo date("d/m/Y", $linha['data']); ?>
<a onclick="$('.apr').hide();$.post('aprova_re.php',{id:<?php echo $linha['id_criador']; ?>,kid:<?php echo $linha['id_credenciado']; ?>},function(){location.reload();});"><img width="15px" height="15px" class="apr" src="images/icons/maximizar.png" style="cursor:pointer"></a>

</td>                
                <!--td>Aprovado</td-->
                
                <!--td><?php //echo $linha['nome']; ?>&#9993;</td-->
		        <td valign="middle"> <a style="font-size: 22px;text-decoration: none;" href="mailto:<?=$linha['email']?>">&#9993;</a><a href="detalhe_criador.php?usr=<?php echo $linha['id_criador']; ?>"><img width="20px" height="20px" src="images/icons/Note-icon.png" ></a> &nbsp;<a href="imprime_canil/imprime.php?usr=<?php echo $linha['id_criador']; ?>"><img width="16px" height="16px" src="images/icons/print.png" ></a><a target="_new" href="end_criador.php?usr=<?php echo $linha['id_criador']; ?>" onclick="window.focus();"> E</a><a target="_new" style="color:green" href="libera_criador.php?usr=<?php echo $linha['id_criador']; ?>" onclick="window.focus();"> P</a></td>
        </tr>
       <?php } ?>
      </tbody>
    </table>
          <script>////cdn.datatables.net/plug-ins/e9421181788/i18n/Portuguese.json
    $(document).ready(function() {
    $('#example').dataTable( {
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
        

           </form>
         </div>
         
      </div>
    
  </div>
</div>
<?php include "footer.php";?>
</body>
</html>

<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");

$id_ped=(int)$_GET['id_ped'];

$id_f=(int)$_GET['id_f'];
$idc=(int)$_SESSION['cid'];



if($_POST){




$id_ped=(int)$_POST['id_ped'];
$id_f=(int)$_POST['id_f'];
$stat=(int)$_POST['stat'];

$qd=mysql_query("delete from ped_print where id_ped=$id_ped and id_f= $id_f and id_criador= $idc") or die('ok');

$qi=mysql_query("insert into ped_print values('',$id_ped,$id_f,$idc,'$stat')");




//$qi=mysql_query("insert into dna_pedido values ('', $id_ped, $id_f , ".time().", 0, '$email', '$tel', '$resp','$end','$cel')");
die("<meta http-equiv='Content-Type' content='text/html; charset=utf-8'><script>alert('Solicitação enviada.');location='index_principal.php';</script>");



}

$jhb=mysql_query("select * from ped_print where id_ped=".$id_ped." and id_f= ".($id_f)." and id_criador=$idc order by id_perm desc limit 1");
			$lp=mysql_fetch_assoc($jhb);
			$nr=mysql_num_rows($jhb);
			if($nr>=1){$v=$lp['tipo_perm'];} else {$v=2;}



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
<script type="text/javascript" src="jquery/scroll/js/jquery-1.4.2.min.js"></script>

</head> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgproperties="fixed" background="images/fundos/bg.jpg">
<?php include "header.php";?>

<div id="internas_full">
 <div id="internas_margem_full">
    <?php include "menu_esquerdo.php";?>  
    <div id="internas_box">
    	<div id="internas_principal">
    	  <div class="arial_branco20" id="internas_titulo">Solicitar Bloqueio da Transferência :
          	
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;"><form action="#" method="post" >
			<table width="100%" border="0" cellspacing="6" cellpadding="0"><input type="hidden" name="id_ped" value="<?=$id_ped;?>"><input type="hidden" name="id_f" value="<?=$id_f;?>">
			
   <?php  $qped=mysql_query("select * from pedigree where id_ped=$id_ped and id_criador=$idc");
$nl=mysql_num_rows($qped);

if($nl<1)die();

$lp=mysql_fetch_assoc($qped);



$qcr=mysql_query("select * from criadores where id_criador=".$lp['id_criador']);

$lcr=mysql_fetch_assoc($qcr);

//tipo


?>


              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Estado Atual:</label></td>
    				<td><input name="mc" type="text" value="<?php if($v==1)echo 'Bloqueado'; else echo 'Liberado';?>" required></td>
		</tr>  
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Alterar para: </label></td>
    				<td><select name="stat" required><option value=''>Escolha..</option><option value="1">Bloqueado</option><option value="2">Liberado</option></select></td>
		</tr> 
 
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Registro:</label></td>
    				<td><?=$lp['registro'].($id_f-4)?></td>
		</tr>  
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td></td>
		</tr>
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Data:</label></td>
    				<td><?=date('d/m/Y'); ?></td>
		</tr> 
              

                <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td><input type="submit" name="enviar" value="voltar" onclick="location='index_principal.php';return false;"><input type="submit"  value="Enviar"></td>
		</tr>    
  
 <?php ?>
</table></form>
         </div>
            </div>
         </div>
         
        </div>
    </div>
    <script>$('#ou').change(function(){});</script>
  </div>
</div>
<?php include "footer.php";?>
</body>
</html>

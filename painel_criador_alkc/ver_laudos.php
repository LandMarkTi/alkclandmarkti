<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");

$id_ped=(int)$_GET['id_ped'];

$id_f=(int)$_GET['id_f'];


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
    	  <div class="arial_branco20" id="internas_titulo">Consultar Laudos/exames:
          	
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;"><form action="index_principal.php" method="post" >
			<table width="100%" border="0" cellspacing="6" cellpadding="0"><input type="hidden" name="id_ped" value="<?=$id_ped;?>"><input type="hidden" name="id_f" value="<?=$id_f;?>">
			
   <?php  $qlaudo=mysql_query("select * from foto_laudos where id_ped=$id_ped and id_f=$id_f and resultado=8");
$nl=mysql_num_rows($qlaudo);


while($arq=mysql_fetch_assoc($qlaudo)){
$i++;
?>
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >DNA Profile <?=$i?>:</label></td>
    				<td><a href="../painel_dna/storeResize/<?=$arq['arquivo']?>"  target="_new" >ver</a></td>
		</tr>  
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td></td>
		</tr> 
  <?php }?>

 <?php  $qlaudo=mysql_query("select * from foto_laudos where id_ped=$id_ped and id_f=$id_f and resultado<8");
$nl=mysql_num_rows($qlaudo);

if($nl<1)echo '              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Aviso:</label></td>
    				<td>Nenhum Laudo Encontrado</td>
		</tr>';

while($arq=mysql_fetch_assoc($qlaudo)){
$i++;
?>
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Laudo <?=$i?>:</label></td>
    				<td><a href="<?=$arq['arquivo']?>" target="_new">ver</a></td>
		</tr>  
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td></td>
		</tr> 
  <?php }?>
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" ></label></td>
    				<td></td>
		</tr>    
                <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td><input type="submit" name="enviar" value="voltar"><input type="reset" name="novo" value="Novo Laudo" onclick="location='add_laudos.php?id_ped=<?=$id_ped?>&id_f=<?=$id_f?>';"></td>
		</tr>    
  
 
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

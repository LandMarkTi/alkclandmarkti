<?php
session_start();
if($_SESSION['login']=='')die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");
require __DIR__ . '/../classes/utils/EnviaMail.php';

$id_ped=(int)$_GET['id_ped'];

$id_f=(int)$_GET['id_f'];


if($_POST){




$id_ped=(int)$_POST['id_ped'];
$id_f=(int)$_POST['id_f'];

$reg=addslashes(strip_tags($_POST['reg']));

$mc=addslashes(strip_tags($_POST['mc']));


$email=addslashes(strip_tags($_POST['email']));

$tel=addslashes(strip_tags($_POST['tel']));

$cel=addslashes(strip_tags($_POST['cel']));

$resp=addslashes(strip_tags($_POST['resp']));

$end=addslashes(strip_tags($_POST['end']));

$mensagemHTML = "
Alerta do sistema ALKC:


Nova solicitação de DNA !

Registro:  $reg

Microchip: $mc

Responsável: $resp

Email $email

Telefone: $tel

Celular: $cel

Endereço : $end

";

$mail = new EnviaMail;
$mail->Enviar('contato@megapedigree.com', 'ALKC', 'dna@alkc.com.br', 'info@petweball.com.br', 'Novo DNA', $mensagemHTML);

$qi=mysql_query("insert into dna_pedido values ('', $id_ped, $id_f , ".time().", 0, '$email', '$tel', '$resp','$end','$cel')");
die("<meta http-equiv='Content-Type' content='text/html; charset=utf-8'><script>alert('Solicitação enviada, aguarde o contato.');location='index_principal.php';</script>");



}

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
    	  <div class="arial_branco20" id="internas_titulo">Solicitar DNA :
          	
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;"><form action="#" method="post" >
			<table width="100%" border="0" cellspacing="6" cellpadding="0"><input type="hidden" name="id_ped" value="<?=$id_ped;?>"><input type="hidden" name="id_f" value="<?=$id_f;?>">
			
   <?php  $qped=mysql_query("select * from pedigree where id_ped=$id_ped ");
$nl=mysql_num_rows($qped);

$lp=mysql_fetch_assoc($qped);

$mc=explode(';',$lp['nº microchip']);

$nc=explode(';',$lp['ninhada']);

$qcr=mysql_query("select * from criadores where id_criador=".$lp['id_criador']);

$lcr=mysql_fetch_assoc($qcr);


if(0){//trim($mc[$id_f-4])==''

echo "Microchip não encontrado!";

} else {
?>


              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Microchip:</label></td>
    				<td><input name="mc" type="text" value="<?=$mc[$id_f-4]?>" required></td>
		</tr>  
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Nome: </label></td>
    				<td><?=$nc[$id_f]?></td>
		</tr> 
 
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Registro:</label></td>
    				<td><?=$lp['registro'].($id_f-4)?><input type="hidden" name="reg" value="<?=$lp['registro'].($id_f-4)?>"></td>
		</tr>  
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td></td>
		</tr>
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Dados para contato:</label></td>
    				<td></td>
		</tr> 
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td></td>
		</tr>
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Responsável:</label></td>
    				<td><input name="resp" value="<?=$lp['criador']?>"></td>
		</tr>  
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Telefone: </label></td>
    				<td><input name="tel" value="<?=$lcr['ddd'].' '.$lcr['fone_res']?>"></td>
		</tr> 

              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Celular: </label></td>
    				<td><input name="cel" value="<?=$lcr['ddd'].' '.$lcr['fone_com']?>"></td>
		</tr> 
 
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Email:</label></td>
    				<td><input name="email" value="<?=$lcr['email']?>"></td>
		</tr> 

              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Endereço:</label></td>
    				<td><input name="end" value=" "></td>
		</tr>    

              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Resultado:</label></td>
    				<td><?php 

$qa=mysql_query("SELECT * FROM `foto_laudos` WHERE `id_ped` = $id_ped and id_f= $id_f ");

while($fa=mysql_fetch_assoc($qa))echo '<a href="../painel_dna/storeResize/'.$fa['arquivo'].'" target="_new">'.$fa['arquivo'].'</a><br>';
?></td>
		</tr> 

                <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td><input type="submit" name="enviar" value="voltar" onclick="location='index_principal.php';return false;"><input type="submit"  value="Enviar"></td>
		</tr>    
  
 <?php }?>
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

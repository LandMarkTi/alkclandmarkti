<?php
session_start();
if($_SESSION['login']!='dna@alkc.com.br')die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");

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

$headers = "MIME-Version: 1.1\n";
$headers .= "Content-type: text/plain; charset=utf-8\n";
$headers .= "From: contato@megapedigree.com\n"; // remetente
$headers .= "Return-Path: info@petweball.com.br\n"; // return-path
//$envio = mail("debora@neoware.com.br", "$assunto", "$mensagemHTML", $headers);
//$envio = mail('dna@alkc.com.br', "Novo DNA", "$mensagemHTML", $headers,'-rcontato@megapedigree.com');


	$fotonome = $_FILES['foto']['name'];
	$fototipo = $_FILES['foto']['type'];
	$fototamanho = $_FILES['foto']['size'];
	$fototemp = $_FILES['foto']['tmp_name'];

/*if(!empty($fotonome)){
move_uploaded_file($fototemp,'./storeResize/'.$fotonome);
$fotonome=addslashes($fotonome);
$qi=mysql_query("insert foto_laudos values ('','$fotonome', $id_ped, $id_f , 8, '$cr','dna')");
}*/



$p=mysql_query('update chip_pedido set data_aprovado=0 where id_dna='.$id_ped.'  ;');

if(isset($_POST['ck']))$u=mysql_query('update chip_pedido set data_aprovado='.time().' where id_dna='.$id_ped.'  ');

if(!isset($_POST['ck'])&&isset($_POST['ct']))$u=mysql_query('update chip_pedido set data_aprovado=-1 where id_dna='.$id_ped.'  ');

//update data envio

die("<meta http-equiv='Content-Type' content='text/html; charset=utf-8'><script>alert('Arquivo enviado.');location='index_principal.php';</script>");



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
    	  <div class="arial_branco20" id="internas_titulo">Detalhes do Pedido :
          	
          </div>
         <div style="width:750px;">
         <div style="margin:10px; margin-top:50px;"><form action="#" method="post"  enctype="multipart/form-data" >
			<table width="100%" border="0" cellspacing="6" cellpadding="0"><input type="hidden" name="id_ped" value="<?=$id_ped;?>"><input type="hidden" name="id_f" value="<?=$id_f;?>">
			
   <?php  $qped=mysql_query("select * from chip_pedido  where id_dna=$id_ped ");
$nl=mysql_num_rows($qped);

$lp=mysql_fetch_assoc($qped);


if(0){

echo "Microchip não encontrado!";

} else {
?>



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
    				<td><?=$lp['responsavel']?></td>
		</tr>  

              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >CPF:</label></td>
    				<td><?=$lp['cpf']?></td>
		</tr> 

              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Telefone: </label></td>
    				<td><?=$lp['tel_contato']?></td>
		</tr> 

              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Celular: </label></td>
    				<td><?=$lp['tel_contato']?></td>
		</tr> 
 
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Email:</label></td>
    				<td><?=$lp['email_contato']?></td>
		</tr> 

              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Endereço:</label></td>
    				<td><?=$lp['adr']?></td>
		</tr> 

              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >CEP:</label></td>
    				<td><?=$lp['cep']?></td>
		</tr> 



              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Kit enviado:</label></td>
    				<td><input name="ck" type="checkbox" <?php if($lp['data_aprovado']>0)echo 'checked'; ?>></td>
		</tr>
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" >Contato Efetuado:</label></td>
    				<td><input name="ct" type="checkbox" <?php if($lp['data_aprovado']!=0)echo 'checked'; ?>></td>
		</tr> 
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" ></label></td>
    				<td><?php 

//$qa=mysql_query("SELECT * FROM `foto_laudos` WHERE `id_ped` = $id_ped and id_f= $id_f ");

//while($fa=mysql_fetch_assoc($qa))echo '<a href="./storeResize/'.$fa['arquivo'].'" target="_new">'.$fa['arquivo'].'</a><br>';
?></td>
		</tr> 
              <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td></td>
		</tr>    
                <tr style="">
    				<td align="right"><label for="tituloAposta" class="arial_cinza2_12" > </label></td>
    				<td><br><input type="submit" name="enviar" value="voltar" onclick="location='index_principal.php';return false;"><input type="submit"  value="Enviar"></td>
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

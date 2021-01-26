<?php
session_start();
if($_SESSION['login']=='')die("<script>location='http://megapedigree.com/painel_criador_alkc/';</script>");

require_once("Connections/conexao.php");

$cepe=$_POST['cpf'];

$cepe=str_replace('.','',$cepe);
$cepe=str_replace('-','',$cepe);
$cepe=str_replace(' ','',$cepe);
$cepe=trim($cepe);



$idped=(int)$_POST['id_ped'];
$idf=(int)$_POST['idf'];

$sql1="select * from pedigree join subcategoria on pedigree.id_raca=subcategoria.idSubcategoria where id_ped=".$idped;
$qr1=mysql_query($sql1);
$linha_ped=mysql_fetch_assoc($qr1);

$nloop=explode(';', $linha_ped['ninhada']);
$micro=explode(';', $linha_ped['nº microchip']);

$sx=explode(';', $linha_ped['sexo']);

$sex=$sx[$idf];

$nasc_pet=$linha_ped['nasc'];

$nome=$nloop[$idf];

$reg=$linha_ped['registro'].$idf;


$prop = addslashes($_POST['nome']);
$nome_cao = addslashes($_POST['nome_cao']);//
$mic = addslashes($_POST['mic']);//
$end = addslashes($_POST['endereco']);//num e complemento
$cep=addslashes($_POST['cep']);
$tel=addslashes($_POST['telefone']);
$cpf=addslashes($_POST['cpf']);
$email=addslashes($_POST['email']);

$bairro=addslashes($_POST['bairro']);

$cidade=addslashes($_POST['cidade']);

$estado=addslashes($_POST['estado']);



$num=(int)$_POST['número'];

$complemento=addslashes($_POST['complemento']);

$pc=addslashes($_POST['pc']);
//tirando var do ped e montando o campo do comprador

unset($_POST['nome_cao']);

unset($_POST['mic']);

unset($_POST['id_ped']);

unset($_POST['idf']);

unset($_POST['pc']);

$idfb=$idf+4;

$criador=(int)$_SESSION['cid'];

//id adicionado para operações de gerenciamento
$sql = "INSERT INTO pedigre_trocados_pre (id_trans_capa,id_ped,id_f,proprietario,endereco,cep_t,tel_t,cpf_t,email_t,nome_cao,mic,dt_trans,bairro,numero,comp,cidade,estado,criador) VALUES ('',$idped,$idfb,'$prop','$end','$cep','$tel','$cpf','$email','$nome_cao','$mic',".time().",'$bairro','$num','$complemento','$cidade','$estado','$criador')";
if($cepe=='00000000000'||$cepe=='11111111111'||$cepe=='22222222222'||$cepe=='33333333333'||$cepe=='44444444444'||$cepe=='55555555555'||$cepe=='66666666666'||$cepe=='77777777777'||$cepe=='88888888888'||$cepe=='99999999999'){} else {$query = mysql_query($sql) or die('et');

$idi=mysql_insert_id();

/*
$sql1="select * from pedigree join subcategoria on pedigree.id_raca=subcategoria.idSubcategoria where id_ped=".$idped;
$qr1=mysql_query($sql1);
$linha_ped=mysql_fetch_assoc($qr1);


$nloop=explode(';', $linha_ped['ninhada']);
$micro=explode(';', $linha_ped['nº microchip']);

$micro[$idf-4]=$mic;

$nloop[$idf]=$nome_cao;

$m=addslashes(implode(';',$micro));

$n=addslashes(implode(';',$nloop));
*/

//mysql_query("UPDATE pedigree set ninhada='$n', `nº microchip`='$m' where id_ped=".$idped) or die('e2');

//envio do email



$msg='dados do cliente:
';

foreach($_POST as $k=>$v){

$msg.='

'.$k.' : '.htmlspecialchars($v,ENT_QUOTES);

}

$b64=base64_encode($msg);
//var_dump($_POST);

$p64="
nome $nome_cao 

microchip $mic

valor $pc

Registro $reg

";

$p64=base64_encode($p64);

/* Montando a mensagem a ser enviada no corpo do e-mail. */
$mensagemHTML = '<html>
<body>
<br><br>

Conheça o melhor Convênio de Saúde para seu Pet!
<br><br>
Estamos oferecendo uma promoção do Convênio de saúde Health for Pet,<br>
Confirme o seu interesse e entraremos em contato dentro de 7 dias.
<br>
<br>
<br>
<br>
<br><br>
<a href="http://conveniosaudepet.com.br/integra_pre.php?du='.$b64.'&ped='.$p64.'&val='.$pc.'&n='.$nasc_pet.'&sx='.$sex.'">ATIVAR</a>
<br><br><br>
*Promoção restrita a área de cobertura
<br>

<br><br><br><br>



<br>
<br>
</body></html>
';

$headers = "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=utf-8\n";
$headers .= "From: naoresponda@megapedigree.com\n"; // remetente
$headers .= "Return-Path: contato@megapedigree.com\n"; // return-path
$envio = mail($email, "Convenio Saude Pet", "$mensagemHTML", $headers,'-rcontato@megapedigree.com');

$cidade=trim(mb_strtoupper(addslashes($_POST['cidade']),'UTF-8'));
//echo $p64;
//PET LIGHT
//mysql_query("insert into form_health values('','$b64','$p64','".time()."','$pc',$idi,'$cidade')");

}
$vet_cid=array("BELO HORIZONTE","COTIA","FERRAZ DE VASCONCELOS","GUARUJÁ","GUARULHOS","MAUÁ","MOGI DAS CRUZES","NITERÓI","OSASCO","POÁ","PRAIA GRANDE","SANTANA DE PARNAÍBA","SANTO ANDRÉ","SANTOS","SÃO BERNARDO DO CAMPO","SÃO CAETANO DO SUL","SÃO PAULO","SAO PAULO","TABOÃO DA SERRA","VARGEM GRANDE PAULISTA");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "https://www.w3.org/TR/html4/strict.dtd"><html lang="pt-BR"><head><meta http-equiv=Content-Type content="text/html; charset=UTF-8"><style type="text/css">
body,td,div,p,a,input {font-family: arial, sans-serif;}
</style><title>Contrato</title><style type="text/css">
body, td {font-size:13px} a:link, a:active {color:#1155CC; text-decoration:none} a:hover {text-decoration:underline; cursor: pointer} a:visited{color:##6611CC} img{border:0px} pre { white-space: pre; white-space: -moz-pre-wrap; white-space: -o-pre-wrap; white-space: pre-wrap; word-wrap: break-word; max-width: 800px; overflow: auto;} .logo { left: -7px; position: relative; }
</style></head><body><div class="bodycontainer" style="margin: 1.75cm;
width: 210mm;"><table width=100% cellpadding=0 cellspacing=0 border=0><tr height=14px><td width=143><br></td><td align=right><font size=-1 color=#777></font></td></tr></table><div class="maincontent"><table width=100% cellpadding=0 cellspacing=0 border=0><tr><td><font size=+1></font><br></td></tr></table><table width=100% cellpadding=0 cellspacing=0 border=0 class="message"><tr><td></td><td align=right><tr><td colspan=2><tr><td colspan=2><table width=100% cellpadding=12 cellspacing=0 border=0><tr><td><div style="overflow: hidden;"><font size=-1>
<p style="margin-bottom:0.49cm;line-height:100%" align="center"><br><br>
</p>
<p style="margin-bottom:0.49cm;line-height:100%" align="center"><b><font color="#000000"><font face="Verdana, serif">
<font style="font-size:16pt;margin-left: -20mm;" size="4">
Cadastro Enviado com sucesso.<br><br><br>


<input type="submit" value="Salvar Contrato" onclick="window.top.location='../painel_criador_alkc/Contrato_Pre_Transferencia.docx'">
</font></font></font></b></p>
<p style="margin-bottom:0.49cm;line-height:200%"><br><br>
</p>
</font></div></table></table></div></div></body></html>

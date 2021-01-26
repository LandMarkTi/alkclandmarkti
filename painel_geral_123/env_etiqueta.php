<?php
session_start();
require_once("Connections/conexao.php");
if($_SESSION['login']!='sergio@sobraci.org')die("<script>location='index.php';</script>");


$id_ped=(int)$_POST['id_ped'];

$idf=(int)$_POST['id_filhote'];


$eq=mysql_query("select * from pedigre_trocados_capa  where id_ped=$id_ped and id_f=$idf ") or die('errt');


$feq=mysql_fetch_assoc($eq);

$idcapa=$feq['id_trans_capa'];

$txt='';

$adr=mysql_query("select * from form_health  where id_capa=$idcapa ") or die('errc');
 $linha=mysql_fetch_assoc($adr);
//var_dump($linha);
			$vt_capa=explode("\n",base64_decode($linha['cliente']));			
			foreach($vt_capa as $key=>$val){

				$atual=explode(":",$val);


				if(count($atual)==2&&(trim($atual[0])=='nome')){ $txt.='Nome :'.$atual[1].'<br>'; }
				if(count($atual)==2&&(trim($atual[0])=='endereco')){ $txt.='Endereço :'.$atual[1]; }				
				if(count($atual)==2&&(trim($atual[0])=='número')){ $txt.=' nº :'.$atual[1]; }

				if(count($atual)==2&&(trim($atual[0])=='complemento')){ $txt.='  '.$atual[1]; }

				if(count($atual)==2&&(trim($atual[0])=='bairro')){ $txt.='<br>Bairro :'.$atual[1].'<br>'; }

				if(count($atual)==2&&(trim($atual[0])=='cidade')){ $txt.=''.$atual[1].' - '; }

				if(count($atual)==2&&(trim($atual[0])=='estado')){ $txt.=''.$atual[1].' <br>'; }

				if(count($atual)==2&&(trim($atual[0])=='cep')){ $txt.='CEP :'.$atual[1].' '; }

}

mysql_query("INSERT INTO `etiquetas` (`id_et`, `id_ped`, `id_f`, `texto_end`, `data_add`) VALUES (NULL,$id_ped,$idf,'$txt',".time().")");

?>Etiqueta Adicionada.

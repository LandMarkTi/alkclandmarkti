<?php
session_start();
require_once("Connections/conexao.php");
if($_SESSION['login']!='sergio@sobraci.org')die("<script>location='index.php';</script>");


$id_c=(int)$_POST['id_c'];



$eq=mysql_query("select * from criadores where id_criador=".$id_c) or die('errt');


$feq=mysql_fetch_assoc($eq);

$endereco=$feq['nome'].' '.$feq['sobrenome'].'<br>Endereço:'.$feq['end_corresp'].'<br>'.$feq['cidade_corresp'].' - '.$feq['estado'].'<br>Bairro :'.$feq['bairro_corresp'].'<br>CEP:'.$feq['cep_corresp'];

$txt='';


//var_dump($linha);


mysql_query("INSERT INTO `etiquetas2` (`id_et`, `id_ped`, `id_f`, `texto_end`, `data_add`) VALUES (NULL,$id_c,0,'$endereco',".time().")");

?>Etiqueta Adicionada.

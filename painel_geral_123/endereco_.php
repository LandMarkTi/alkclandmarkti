<?php


require_once("Connections/conexao.php");

$id_ped=(int)$_GET['id_ped'];

$idf=(int)$_GET['id_filhote'];

echo '<html><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><body>';

$eq=mysql_query("select * from pedigre_trocados_capa  where id_f=$idf and id_ped=$id_ped ")or die('dd');

$feq=mysql_fetch_assoc($eq);

//var_dump($feq);

echo "Nome: ".$feq['proprietario']."<br>
Endereço: ".$feq["endereco"]."<br>
Cep: ".$feq['cep_t']."<br>
";

echo '</body></html>';
?>

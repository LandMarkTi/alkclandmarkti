<?php
session_start();
if ($_SESSION['login'] == '') die("<script>location='index.php';</script>");
require_once("Connections/conexao.php");

require __DIR__ . '/../vendor/autoload.php';

use Proner\PhpPimaco\Pimaco;
use Proner\PhpPimaco\Tag;

$pimaco = new Pimaco('6183');

$registros = $_GET['registros'];
$regs = explode(',', $registros);

$i = 0;
foreach($regs as $etiqueta)
{
    $dados = explode('-', $etiqueta);

    $sqltransf = "SELECT p.registro, t.proprietario, t.endereco, t.cep_t FROM pedigree p, pedigre_trocados t where p.id_ped = t.id_ped and p.id_ped = ".$dados[0]." and t.id_f = ".$dados[1];    
    $qsqlt = mysql_query($sqltransf);
    $rsqlt = mysql_fetch_assoc($qsqlt);

    $tag = new Tag();
    $tag->setSize(4);
    $tag->p($rsqlt['proprietario'])->b()->br();
    $tag->p($rsqlt['endereco'].' '. $rsqlt['cep_t'])->br();
    $tag->p('')->br();
    $tag->p($rsqlt['registro'].($dados[1]-4));
    $tag->setBorder(0.1);
    $tag->setPadding(4);
    $pimaco->addTag($tag);

    $i++;
}

$pimaco->output();
?>
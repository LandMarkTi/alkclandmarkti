<?php

session_start();
if ($_SESSION['login'] == '') die("<script>location='index.php';</script>");
require_once("Connections/conexao.php");

$hoje = new DateTime();
$hojets = $hoje->getTimestamp();

$docfilename = basename($_FILES["documento"]["name"]);
$docFileType = strtolower(pathinfo($docfilename, PATHINFO_EXTENSION));
$docnewfilename = 'doc_'. $hojets. '_' .$_POST['idcriador'].'.'.$docFileType;
$target_dirdoc = "documentoupload/";
$target_filedoc = $target_dirdoc . $docnewfilename;
move_uploaded_file($_FILES["documento"]["tmp_name"], $target_filedoc);


$pedfilename = basename($_FILES["pedigree"]["name"]);
$pedFileType = strtolower(pathinfo($pedfilename, PATHINFO_EXTENSION));
$pednewfilename = 'ped_' . $hojets . '_' . $_POST['idcriador'] . '.' . $pedFileType;
$target_dirped = "pedigreeanexo/";
$target_fileped = $target_dirped . $pednewfilename;
move_uploaded_file($_FILES["pedigree"]["tmp_name"], $target_fileped);


$sql = "insert into pedigreeexterno (id_criador, id_credenciado, datasolicitacao, aceitetermo, documento, pedigreeanexo, nomecachorro, nomeentidade, registroexterno) values ('" . $_POST['idcriador'] . "','" . $_POST['idcredenciado'] . "','" . $hojets . "',1,'" . $docnewfilename . "','" . $pednewfilename . "','" . $_POST['nome'] . "','" . $_POST['entidade'] . "','" . $_POST['registro'] . "')";
$query = mysql_query($sql);

header('Location:pedigreeexterno_lista.php');

?>
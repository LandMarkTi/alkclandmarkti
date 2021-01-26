<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conexao = "179.188.16.38";
$database_conexao = "megapedigree";
$username_conexao = "megapedigree";
$password_conexao = "megap_org15";//megap_org15
$conexao = mysql_pconnect($hostname_conexao, $username_conexao, "MeMe3726dog") or die(mysql_error());
mysql_select_db($database_conexao, $conexao);
mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');
//Varial dos titulos das paginas
$titulo = "::.  .:: - Painel credenciado";
//error_reporting(0);
?>

<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conexao = "opmy0031.servidorwebfacil.com";
$database_conexao = "megapedigree_com";
$username_conexao = "megap_com";
$password_conexao = "Companheiro3@10";//Companheiro3@10
$conexao = mysql_pconnect($hostname_conexao, $username_conexao, "Companheiro3@10") or die(mysql_error());
mysql_select_db($database_conexao, $conexao);
mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');
//Varial dos titulos das paginas
$titulo = "::.  .:: - Painel credenciado";
//error_reporting(0);                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

?>

<?php

if (getenv('ENV') == 'production')
{
    $hostname_conexao = "opmy0031.servidorwebfacil.com";
    $database_conexao = "megapedigree_com";
    $username_conexao = "megap_com";
    $password_conexao = "Companheiro3@10"; //Companheiro3@10
    $conexao = mysql_pconnect($hostname_conexao, $username_conexao, $password_conexao) or die(mysql_error());
    mysql_select_db($database_conexao, $conexao);
    mysql_query("SET NAMES 'utf8'");
    mysql_query('SET character_set_connection=utf8');
    mysql_query('SET character_set_client=utf8');
    mysql_query('SET character_set_results=utf8');
}
else if (getenv('ENV') == 'development')
{
    $hostname_conexao = "192.168.33.1";
    $database_conexao = "megapedigree";
    $username_conexao = "root";
    $password_conexao = "senha"; //Companheiro3@10
    $conexao = mysql_pconnect($hostname_conexao, $username_conexao, $password_conexao) or die(mysql_error());
    mysql_select_db($database_conexao, $conexao);
    mysql_query("SET NAMES 'utf8'");
    mysql_query('SET character_set_connection=utf8');
    mysql_query('SET character_set_client=utf8');
    mysql_query('SET character_set_results=utf8');
}

?>
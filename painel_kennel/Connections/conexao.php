<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/phpmailer/phpmailer/src/Exception.php';
require '../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../../vendor/phpmailer/phpmailer/src/SMTP.php';

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
//error_reporting(0);

$mail = new PHPMailer(true);

$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
$mail->isSMTP();                                            // Send using SMTP
$mail->Host       = 'megapedigree.com';                    // Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
$mail->Username   = 'contato@megapedigree.com';                     // SMTP username
$mail->Password   = 'M3g@P3d1gr33';                               // SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
$mail->Port       = 587; 
?>

<?php

function coupon($para,$msg){
$headers = "MIME-Version: 1.1\n";
$headers .= "Content-type: text/html; charset=utf-8\n";
$headers .= "From: contato@skinbar.com.br\n"; // remetente
$headers .= "Return-Path: contato@skinbar.com.br\n"; // return-path
$envio = mail("$para", "skinbar", "$msg", $headers);
return $envio;
}

header('Content-Type: text/html; charset=ISO-8859-1');

define('TOKEN', 'E1C0F58F09854B1682DEEBC7F05374A2');

class PagSeguroNpi {
	
	private $timeout = 20; // Timeout em segundos
	
	public function notificationPost($tk) {
		$postdata = 'Comando=validar&Token='.$tk;
		foreach ($_POST as $key => $value) {
			$valued    = $this->clearStr($value);
			$postdata .= "&$key=$valued";
		}
		return $this->verify($postdata);
	}
	
	private function clearStr($str) {
		if (!get_magic_quotes_gpc()) {
			$str = addslashes($str);
		}
		return $str;
	}
	
	private function verify($data) {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, "https://pagseguro.uol.com.br/pagseguro-ws/checkout/NPI.jhtml");
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_TIMEOUT, $this->timeout);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		$result = trim(curl_exec($curl));
		curl_close($curl);
		return $result;
	}

}

if (count($_POST) > 0) {
	
	// POST recebido, indica que é a requisição do NPI.
	$npi = new PagSeguroNpi();
	$result = $npi->notificationPost('E1C0F58F09854B1682DEEBC7F05374A2');
	
	$transacaoID = isset($_POST['TransacaoID']) ? $_POST['TransacaoID'] : '';
	
	if ($result == "VERIFICADO") {
	$fp = fopen('ps.txt', 'a');
	fwrite($fp, "\n".time()."\n");
	fwrite($fp, "\n".print_r($_POST,true)."\n");
	
	$status=$_POST['StatusTransacao'];
	require_once('./site/Connections/conexao.php');

		if ($_POST['StatusTransacao']=="Aprovado"){////////////////////////////////////////////////////
			$lances=$_POST['ProdQuantidade_1'];
			$vendedor=$_POST['VendedorEmail'];
			$nomeid=$_POST['ProdID_1'];
			$desc=$_POST['ProdDescricao_1'];
			$valor=$_POST['ProdValor_1'];
			$dados=$_POST['CliNome'];
			//$dados=$dados."\n".$_POST['CliEmail'];
			$end=$_POST['CliEndereco'];
			$mail=$_POST['CliEmail'];
			$dat=$_POST['DataTransacao'];
			$tip=$_POST['TipoPagamento'];
			//O post foi validado pelo PagSeguro.
			//manda coupon
			$vid=substr($nomeid,4,2);
			

			//fwrite($fp, "insert into pagtos values('',$vid,1,".time().",'".$mail."')\n");
			if($desc=='Cadastro Criador')$criador=mysql_query("insert into pagtos values('',$vid,1,".time().",'".$mail."')")or fwrite($fp,mysql_error());
			if($desc=='Pagamento Pedigree'){
			$ids=explode('_',$nomeid);
			$ninhada=$ids[1];
			$filhote=$ids[3];
			$criador=mysql_query("insert into pagtos values('',$ninhada,$filhote,".time().",'".$mail."')")or fwrite($fp,mysql_error());

			}
			//Trans
			if(substr($desc,0,5)=='Trans'){
			$ids=explode('_',$nomeid);
			$ninhada=$ids[2];
			$filhote=$ids[3];
			$criador=mysql_query("insert into pag_trans_capa values('','".$mail."',$ninhada,$filhote,".time().")")or fwrite($fp,mysql_error());

			}

				
			

			
			
			//$fp2 = fopen('./beta2/include_voucher.txt', 'r');
			//$txt=fread( $fp2 , 8000 );
			
			//$cod="Seu C&oacute;digo : ".mt_rand()*7919;
			//$email=$_POST['email'];
			//$nome=$_POST['nome'];
			/*$txt=str_replace("cod_area",$cod,$txt);
			$txt=str_replace("data_area",$data,$txt);
			$txt=str_replace("hora_area",$hora,$txt);
			$txt=str_replace("img_area",$foto,$txt);
			$txt=str_replace("clinica_area",$cli,$txt);
			$txt=str_replace("nome_area",$dados,$txt);
			$txt=str_replace("email_area",$mail,$txt);
			$env=coupon($mail,$txt);*/
			
			/*$tp=$tl + 1;if posicao = '777' email na hora
			$mq="UPDATE ofertas SET posicao = '".$tp."' WHERE id = '$nomeid'";
			$r=mysql_query($mq,$teste);*/
			
			
		}
		//insert
		$pg="INSERT into pagtos ";
		//$pg="UPDATE pedidos SET status = '".$status."' where id_prefixoid_oferta = '".$nomeid."'";
		$r=mysql_query($pg);
		fwrite($fp, "\n".$pg."\n");
	} else if ($result == "FALSO") {
		die();
	} else {
		//Erro na integração com o PagSeguro.
	}
	
} else {
	// POST não recebido, indica que a requisição é o retorno do Checkout PagSeguro.
	// No término do checkout o usuário é redirecionado para este bloco.
	?>
<?php
include ('beta2/Connections/conexao.php');

?>
<?php
// Gravando Dados
 
//cadastrando no BD
?> Sua Compra foi realizada com Sucesso.
<?php
 
}
fclose($fp);
?>

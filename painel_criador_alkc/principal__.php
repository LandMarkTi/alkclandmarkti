<link rel="stylesheet" type="text/css" href="css/style_principal.css" />
<link rel="stylesheet" type="text/css" href="css/style_fonts.css" />
<link rel="stylesheet" href="jquery/acord/style.css" type="text/css" />
<link rel="stylesheet" href="jquery/scroll/css/website.css" type="text/css" media="screen"/>

<script type="text/javascript" src="jquery/scroll/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="jquery/scroll/js/jquery.tinyscrollbar.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
//		$('#scrollbar1').tinyscrollbar();

(function blink() { $('sup').fadeOut(500).fadeIn(500, blink); })();
	});
</script>


<div id="principal_full">
 <div id="principal_margem_full">
    <?php include "menu_esquerdo.php";?>  
    <div id="principal_box">
	<div id="principal_resumo_site" style="width: 100%;height: 602px;border-color: #31859b;display:block">
        <div class="arial_branco12" id="principal_titulo" style="background-color: #31859b;cursor:pointer;font-size: 17px;" onclick="window.open('Manual_ALKC_23.02.2017_.pdf');"><u style="font-size: 17px;">Ajuda e Manual do criador</u><sup> novo! </sup></div>
	<H3 style="font-size: 18px;"><img style="width: 100%" src="fundonovo6.png" /></H3>
		<div style="height:69px;width: 55%;position:relative;top:-431px;float: right;cursor:pointer;" <?php if($m_estado=='SP'){?>onclick="window.location='proj.php';" <?php }?>> </div>
		<div style="height:69px;width: 55%;position:relative;top:-431px;float: right;cursor:pointer;" onclick="window.location='mchip.php';"> </div>
		<div style="height:69px;width: 55%;position:relative;top:-431px;float: right;cursor:pointer;" onclick="window.open('http://www.conveniosaudepet.com.br');"> </div>
		<div style="height:69px;width: 55%;position:relative;top:-431px;float: right;cursor:pointer;" onclick="window.location='busca_laudos.php';"> </div>
		<div style="height:69px;width: 55%;position:relative;top:-431px;float: right;" onclick="return false;"> </div>
		<div style="height:69px;width: 55%;position:relative;top:-431px;float: right;" onclick="return false;"> </div>
        </div>

    </div>
            
<?php $qrd=mysql_query("select * from criadores where id_criador=".$_SESSION['cid']); 
	$f=mysql_fetch_assoc($qrd);
	$data2=mktime(0,0,0,(int)$f['mes_assinatura'],(int)$f['dia_assinatura'],(int)$f['ano_assinatura']+1);
	$sobra=$data2-time();
	$dias=$sobra/86400;
	echo ' <!--('.(int)$dias.' dias de assinatura restantes)-->';
	if ($dias<0) die('<script>alert("conta expirada.");location="pagar_renovacao.php";</script>');
?>

   	  </div>        
    </div> 
 </div>
</div>

<link rel="stylesheet" type="text/css" href="css/style_principal.css" />
<link rel="stylesheet" type="text/css" href="css/style_fonts.css" />
<link rel="stylesheet" href="jquery/acord/style.css" type="text/css" />
<link rel="stylesheet" href="jquery/scroll/css/website.css" type="text/css" media="screen"/>

<script type="text/javascript" src="jquery/scroll/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="jquery/scroll/js/jquery.tinyscrollbar.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#scrollbar1').tinyscrollbar();
	});
</script>


<div id="principal_full">
 <div id="principal_margem_full">
    <?php include "menu_esquerdo.php";?>  
    <div id="principal_box">
	<div id="principal_resumo_site" style="width: 750px;height: 250px;">
        <div class="arial_branco12" id="principal_titulo">Painel Sobraci<?php $qrd=mysql_query("select * from criadores where id_criador=".$_SESSION['cid']); 
	$f=mysql_fetch_assoc($qrd);
	$data2=mktime(0,0,0,(int)$f['mes_assinatura'],(int)$f['dia_assinatura'],(int)$f['ano_assinatura']+1);
	$sobra=$data2-time();
	$dias=$sobra/86400;
	echo ' ('.(int)$dias.' dias de assinatura restantes)';
	if ($dias<0) die('<script>alert("conta expirada.Solicite a renovação pelo email adm@sobraci.org");location="http://www.sobraci.org/";</script>');
?></div>
	<H3 style="font-size: 18px;"><img src="images/selecione.png" /></H3>
        </div>

    </div>
            


   	  </div>        
    </div> 
 </div>
</div>

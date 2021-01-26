<?php
require_once("Connections/conexao.php");

if($_SESSION['email_contato']=='nucleosaopaulo@sobraci.org'){//(id 17)
$qr=mysql_query('select * from banner where tipoBanner=10 order by rand()')or die('eban');
$f=mysql_fetch_assoc($qr);

}else{

$qr=mysql_query('select * from banner where tipoBanner=9 order by rand()')or die('eban');
$f=mysql_fetch_assoc($qr);


//$qr=mysql_query("SELECT * FROM banner JOIN credenciado ON credenciado.id_credenciado = banner.tipoBanner WHERE email='".$_SESSION['email_contato']."' order by rand() ")or die('eban');

//$f=mysql_fetch_assoc($qr);

}
$b1=$f['foto'];
$l1=$f['link'];
$f=mysql_fetch_assoc($qr);
$b2=$f['foto'];
$l2=$f['link'];


?>
<div class="principal_info_box">
    	<div class="principal_titulo_info">ANUNCIANTES SOBRACI</div>
      <div class="principal_info2">
        	<div class="principal_banner_info"><a  style="cursor:pointer" onclick="location='<?php echo $l1;?>';return false;"><img width="204px" src="<?php echo $b1;?>"/></a></div>
            <img src="images/linhas/linha_sep_info.jpg"/>
        	<div class="principal_banner_info"><a  style="cursor:pointer" onclick="location='<?php echo $l2;?>';return false;"><img width="204px" src="<?php echo $b2;?>"/></a></div>
        </div>        
    </div>
<script>
$("#vai_logo").click(function(){location='busca_trans.php?busca_chip='+$("#tr_code").val();});
</script>

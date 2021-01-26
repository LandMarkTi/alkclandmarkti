<?php

require_once("Connections/conexao.php");
$em_cred=$_SESSION['email_contato'];
$qr2=mysql_query("select * from credenciados where email='$em_cred' ")or die(mysql_error());
$fr=mysql_fetch_assoc($qr2);

//$qr=mysql_query("select * from banner where tipoBanner='".$fr['id_credenciado']."' ")or die(mysql_error());
$f=mysql_fetch_assoc($qr);
$b1=$f['foto'];
$l1=$f['link'];
$f=mysql_fetch_assoc($qr);
$b2=$f['foto'];
$l2=$f['link'];


?>
<div class="principal_info_box">
    	<div class="principal_titulo_info">ANUNCIANTES SOBRACI</div>
      <div class="principal_info2">
        	<div class="principal_banner_info"><a href="<?php echo $l1;?>"><img width="204px" height="270px" src="<?php echo $b1;?>"/></a></div>
            <img src="images/linhas/linha_sep_info.jpg"/>
        	<div class="principal_banner_info"><a href="<?php echo $l2;?>"><img width="204px" height="240px" src="<?php echo $b2;?>"/></a></div>
        </div>        
    </div>


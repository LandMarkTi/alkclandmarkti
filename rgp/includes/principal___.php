<link rel="stylesheet" type="text/css" href="../css/style.css" />
<link rel="stylesheet" type="text/css" href="../css/style_fonts.css" />
<link rel="stylesheet" type="text/css" href="jquery/mapa/classe.css" />

<div class="principal_full" style="margin-top: -13px;">
 <div class="principal_margem_full">
 
 	<div class="principal_credenciados_box">
    
    <div>
    <iframe width="318" height="285" src="//www.youtube.com/embed/1XSQjRcebks?rel=0&autoplay=1" frameborder="0" allowfullscreen></iframe>
    </div>
    
    <div style="margin-top:4px;">
    <img src="images/main_aprovado_richard.jpg" style="border: 1px #D3D3D3 dashed;"/>
    </div>
    
    <div style="margin-top:4px;">
    <a class="oswald_cinza16" href="http://www.megapedigree.com.br/site/credenciado.php?consultar=%25"><img src="images/botoes/encontre_nucleo.jpg" class="botao"/></a>
    </div>
 	</div>
    
    <div class="principal_noticias_box">
    <div class="principal_titulo_not">NOTÍCIAS SOBRACI <div style="display:table; float:right;"><a href="todas_noticias.php" style="text-decoration:none; color:#373334; margin-right:5px;">Todas as noticias</a></div> </div>
<?php 
require_once("Connections/conexao.php");
$qr=mysql_query("SELECT * FROM `conteudoindex` where autor='9' order by id desc limit 4");
while($f=mysql_fetch_assoc($qr)){?>
    	<div class="principal_noticias_not">
        <div class="margin6">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="25%" rowspan="2" align="center"><div class="principal_noticias_foto" style="width:100px;height:90px;overflow:hidden;display: block;background:white"><img src="./<?php echo $f['foto'];?>" style="max-height:95px" border="0" style="margin-top:4px;" /></div></td>
            <td width="75%" height="35" align="left" class="oswald_cinza15"><?php echo $f['titulo'];?></td>
          </tr>
          <tr>
            <td align="left" valign="top" class="arial_cinza11_not"><a href="noticia.php?not=<?php echo $f['id'];?>" class="arial_cinza11_not"><?php echo substr(strip_tags($f['texto']),0,50);?>...<br />
            Leia mais...</a></td>
          </tr>
        </table>

        </div>        
	
          </div>
        <?php }?>

        <div style="display:table;">
        <a class="botao" href="mailto:nucleos@sobraci.org"><img src="images/botoes/seja_credenciado.jpg" style="margin-right:12px;"/></a>
        <a class="botao" href="cometarios.php"><img src="images/botoes/COMENTARIOS.jpg"/></a>
 
	    </div>
   
    </div>
    
    <?php include('includes/informacoes.php');?>
 
 </div>
</div>

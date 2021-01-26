<link rel="stylesheet" type="text/css" href="../css/style.css" />
<link rel="stylesheet" type="text/css" href="../css/style_fonts.css" />
<link rel="stylesheet" type="text/css" href="jquery/mapa/classe.css" />

<div class="principal_full">
 <div class="principal_margem_full">
 
 	<div class="principal_credenciados_box">
    <div class="principal_titulo_cred">CREDENCIADOS SOBRACI</div>
    <div class="arial_cinza1_11" style="margin-top:50px;">Pesquise as franquias credenciadas da SOBRABACI espalhadas pelo Brasil inteiro. Clique no Estado desejado abaixo ou busque no campo pesquisar.</div>
    <div style="margin-top:8px;">
    <ul id="map">
        <li id="crs" estado="rs"><a href="#rs" id="rs" title="RS"><img src="images/null.gif" alt="RS" /></a></li>
        <li id="csc" estado="sc"><a href="#sc" id="sc" title="SC"><img src="images/null.gif" alt="SC" /></a></li>
        <li id="cpr" estado="pr"><a href="#pr" id="pr" title="PR"><img src="images/null.gif" alt="PR" /></a></li>
        <li id="csp" estado="sp"><a href="#sp" id="sp" title="SP"><img src="images/null.gif" alt="SP" /></a></li>
        <li id="cms" estado="ms"><a href="#ms" id="ms" title="MS"><img src="images/null.gif" alt="MS" /></a></li>
        <li id="crj" estado="rj"><a href="#rj" id="rj" title="RJ"><img src="images/null.gif" alt="RJ" /></a></li>
        <li id="ces" estado="es"><a href="#es" id="es" title="ES"><img src="images/null.gif" alt="ES" /></a></li>
        <li id="cmg" estado="mg"><a href="#mg" id="mg" title="MG"><img src="images/null.gif" alt="MG" /></a></li>
        <li id="cgo" estado="go"><a href="#go" id="go" title="GO"><img src="images/null.gif" alt="GO" /></a></li>
        <li id="cba" estado="ba"><a href="#ba" id="ba" title="BA"><img src="images/null.gif" alt="BA" /></a></li>
        <li id="cmt" estado="mt"><a href="#mt" id="mt" title="MT"><img src="images/null.gif" alt="MT" /></a></li>
        <li id="cro" estado="ro"><a href="#ro" id="ro" title="RO"><img src="images/null.gif" alt="RO" /></a></li>
        <li id="cac" estado="ac"><a href="#ac" id="ac" title="AC"><img src="images/null.gif" alt="AC" /></a></li>
        <li id="cam" estado="am"><a href="#am" id="am" title="AM"><img src="images/null.gif" alt="AM" /></a></li>
        <li id="crr" estado="rr"><a href="#rr" id="rr" title="RR"><img src="images/null.gif" alt="RR" /></a></li>
        <li id="cpa" estado="pa"><a href="#pa" id="pa" title="PA"><img src="images/null.gif" alt="PA" /></a></li>
        <li id="cap" estado="ap"><a href="#ap" id="ap" title="AP"><img src="images/null.gif" alt="AP" /></a></li>
        <li id="cma" estado="ma"><a href="#ma" id="ma" title="MA"><img src="images/null.gif" alt="MA" /></a></li>
        <li id="cto" estado="to"><a href="#to" id="to" title="TO"><img src="images/null.gif" alt="TO" /></a></li>
        <li id="cse" estado="se"><a href="#se" id="se" title="SE"><img src="images/null.gif" alt="SE" /></a></li>
        <li id="cal" estado="al"><a href="#al" id="al" title="AL"><img src="images/null.gif" alt="AL" /></a></li>
        <li id="cpe" estado="pe"><a href="#pe" id="pe" title="PE"><img src="images/null.gif" alt="PE" /></a></li>
        <li id="cpb" estado="pb"><a href="#pb" id="pb" title="PB"><img src="images/null.gif" alt="PB" /></a></li>
        <li id="crn" estado="rn"><a href="#rn" id="rn" title="RN"><img src="images/null.gif" alt="RN" /></a></li>
        <li id="cce" estado="ce"><a href="#ce" id="ce" title="CE"><img src="images/null.gif" alt="CE" /></a></li>
        <li id="cpi" estado="pi"><a href="#pi" id="pi" title="PI"><img src="images/null.gif" alt="PI" /></a></li>
    </ul>
    </div>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="60" colspan="2" class="oswald_cinza16">Pesquisar Credenciados:</td>
        </tr>
          <tr>
            <td width="77%"><input name="credenciados" type="text" class="credenciados_forms" id="credenciados"/></td>
            <td width="23%" align="right"><input class="botao" type="image" src="images/botoes/ok.jpg" align="absmiddle"/></td>
          </tr>
          <tr>
            <td colspan="2" valign="middle"><a class="botao" href="#"><img src="images/botoes/seja_credenciado.jpg" style="margin-top:22px;"/></a></td>
          </tr>
      </table>    
    </div>
    
    <div class="principal_noticias_box">
    <div class="principal_titulo_not">NOTÍCIAS SOBRACI</div>
<?php 
require_once("Connections/conexao.php");
$qr=mysql_query("SELECT * FROM `conteudoindex` where autor='9' limit 4");
while($f=mysql_fetch_assoc($qr)){?>
    	<div class="principal_noticias_not">
        <div class="margin6">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="25%" rowspan="2" align="center"><div class="principal_noticias_foto"><img src="corta_imagem.php?arquivo=images/noticia/noticia1.jpg&amp;largura=74&amp;altura=95" border="0" style="margin-top:4px;" /></div></td>
            <td width="75%" height="40" align="left" class="oswald_cinza15"><?php echo $f['titulo'];?></td>
          </tr>
          <tr>
            <td align="left" valign="top" class="arial_cinza11_not"><a href="#" class="arial_cinza11_not"><?php echo $f['texto'];?>...<br />
            Leia mais...</a></td>
          </tr>
        </table>
        </div>        
        </div>
        <?php }?>      
    </div>
    
    <?php include('includes/informacoes.php');?>
 
 </div>
</div>

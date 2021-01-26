<?php if(!isset($_SESSION)) {
     session_start();
}?>
<script type="text/javascript" src="jquery/jquery-1.7.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="./css/style.css" />
<link rel="stylesheet" type="text/css" href="./css/style_fonts.css" />
<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  WebFontConfig = {
    google: { families: [ 'Oswald::latin' ] }
  };
  (function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
  })(); 
</script>
<script type="text/javascript">
var timeout         = 500;
var closetimer		= 0;
var ddmenuitem      = 0;

function jsddm_open()
{	jsddm_canceltimer();
	jsddm_close();
	ddmenuitem = $(this).find('ul').eq(0).css('visibility', 'visible');}

function jsddm_close()
{	if(ddmenuitem) ddmenuitem.css('visibility', 'hidden');}

function jsddm_timer()
{	closetimer = window.setTimeout(jsddm_close, timeout);}

function jsddm_canceltimer()
{	if(closetimer)
	{	window.clearTimeout(closetimer);
		closetimer = null;}}

$(document).ready(function()
{	$('#jsddm > li').bind('mouseover', jsddm_open);
	$('#jsddm > li').bind('mouseout',  jsddm_timer);});

document.onclick = jsddm_close;
</script>
  
<div class="header_full" >
 <div class="header_margem_full" style="position:relative; z-index:1;">
  
  <div class="header_logo" style="width: 520px;"> <a href="index.php" style="text-decoration:none;"><img width="350px" height="87px" src="<?php if(isset($_SESSION['header']))echo './'.$_SESSION['header'];else echo './images/logo_header.png'; ?>"/>
</a>
<img width="87" height="87px" src="./images/icones/LOGONOVAPEDIGREE.png">
  </div>
  <div style="position:absolute; z-index:2;  left:450px; margin-top:10px;"><img src="images/fundo_dog.png" /></div>
  
  <div class="header_atendimento" style="position:relative; z-index:3;">
  	<div class="oswald_cinza18" style="height: 50px;">
    <?php if(isset($_SESSION['tel_contato']))echo $_SESSION['tel_contato'];else echo '+55 (15) 3211-1725<br /> +55 (15) 3232-6601';?><br />
    </div>
    <div>
    <div><img src="images/linhas/linhas_sep_data.png"/></div>
    <div class="arial_cinza12" id="header_data_menu">
    Bem vindo a SOBRACI -   
	<script language="Javascript">
	 var dayName = new Array ("Domingo", "segunda-feira", "ter&ccedil;a-feira", "quarta-feira", "quinta-feira", "sexta-feira", "s&aacute;bado")
	 var monName = new Array ("janeiro", "fevereiro", "mar&ccedil;o", "abril", "maio", "junho", "julho", "agosto", "setembro", "outubro", "novembro", "dezembro")
	 var yearName = new Array ("janeiro", "fevereiro", "mar&ccedil;o", "abril", "maio", "junho", "julho", "agosto", "setembro", "outubro", "novembro", "dezembro")
	 var now = new Date
	 document.write(" " + dayName[now.getDay()] + " "+now.getDate() + " " + monName[now.getMonth()] + " de " + now.getFullYear())
	 //-->
	</script>
    </div>  
    <div style="float:left;" class="arial_cinza12">Compartilhe: </div>  
    <div class="arial_cinza1_11" id="header_curtir_menu">
    <div class="addthis_toolbox addthis_default_style ">      
    <a class="addthis_button_orkut" addthis:url="http://www.sobraci.org/"><img src="images/icone_orkut.png" border="0" /></a>
    <a class="addthis_button_twitter" addthis:url="http://www.sobraci.org/"><img src="images/icone_twitter.png" border="0" /></a>
    <a class="addthis_button_facebook" addthis:url="http://www.sobraci.org/"><img src="images/icone_facebook.png" border="0" /></a>
    <a class="addthis_button_blogger" addthis:url="http://www.sobraci.org/"><img src="images/icone_blogger.png" border="0" /></a>    
    </div>    
    <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=xa-4d53d1a16a4b5dbc"></script>
    </div>
    
    </div>
  </div>
  
 </div>
</div>

<div class="menu_full">
 <div class="menu_margem_full">
<ul id="jsddm">


    
    <li>
    <div class="menu_box"><a href="quem_somos.php" class="oswald_branco16">QUEM SOMOS</a></div>  
          <ul style="visibility: hidden; width: 175px;">
              <li><a href="quem_somos.php">História</a></li>
              <li><a href="diretoria.php">Presidencia</a></li>                                         
              </ul>    
    </li>
    
    
<li>    <div class="menu_linha"><img src="images/linhas/linha_sep_menu.png"/></div></li>
<li>    <div class="menu_box"><a href="#" class="oswald_branco16">SERVIÇOS</a></div>
<ul>
<li><a href="pedigree.php">Pedigree</a></li>
<li><a href="abertura-canil.php">Abertura de Canil</a></li>
<li><a href="registro-inicial.php">Registro Inicial</a></li>
<li><a href="registro-ninhada.php">Registro Ninhada</a></li>
<li><a href="rgc.php">R.G.C. - Registro Geral Canino</a></li>
<li><a href="beneficios.php"> SOBRACI Benefícios </a></li>
<li><a href="transf-propriedade.php">Transferência</a></li>
<li><a href="cursos-vania-breim.php">Cursos</a></li>
<li><a href="reajuste-precos.php">Preços</a></li>


</ul>

</li>
<li>    <div class="menu_linha"><img src="images/linhas/linha_sep_menu.png"/></div></li>
<li>    <div class="menu_box"><a href="#" class="oswald_branco16">EXPOSIÇÃO</a></div>
<ul style="visibility: hidden; width: 175px;">
	<li><a href="formulario-expo-copa-outono.php">Inscrição</a></li>
	<li><a href="exposicoes-calendario.php">Calendário</a></li>
    <li><a href="titulos.php">Títulos</a></li>
    <li><a href="arbitros.php">Árbitros</a></li>
   </ul>


</li>
<li>    <div class="menu_linha"><img src="images/linhas/linha_sep_menu.png"/></div></li>
<li>    <div class="menu_box"><a href="#" class="oswald_branco16">PADRÕES DE RAÇAS</a></div>
<ul>
<li><a href="racas.php?grupo=10">GRUPO 01 - Cães de Caça e Tiro</a></li>
<li><a href="racas.php?grupo=9">GRUPO 02 - Cães de Caça e Presa</a></li>
<li><a href="racas.php?grupo=12">GRUPO 03 - Cães de Guarda e Utilidade</a></li>
<li><a href="racas.php?grupo=13">GRUPO 04 - Cães Terriers</a></li>
<li><a href="racas.php?grupo=14">GRUPO 05 - Cães de Luxo</a></li>
<li><a href="racas.php?grupo=15">GRUPO 06 - Cães de Companhia</a></li>
<li><a href="racas.php?grupo=16">GRUPO 07 - Cães Pastores</a></li>
<li><a href="racas.php?grupo=17">GRUPO 08 - Raças Brasileiras</a></li>
</ul>
</li>
<li>    <div class="menu_linha"><img src="images/linhas/linha_sep_menu.png"/></div></li>
<li>    <div class="menu_box"><a href="#" class="oswald_branco16">GALERIA</a></div>
<ul style="visibility: hidden; width: 175px;">
<li><a href="videos-exposicao.php">Videos</a></li>
<li><a href="melhores-de-raca.php">Fotos</a></li>

</ul>
</li>
<li>    <div class="menu_linha"><img src="images/linhas/linha_sep_menu.png"/></div></li>
<li>    <div class="menu_box"><a href="sonarb.php" class="oswald_branco16">CLUBES</a></div>
<ul style="visibility: hidden; width: 175px;">
<li><a href="sonarb.php">SONARB</a></li>
</ul>
</li>
<li>    <div class="menu_linha"><img src="images/linhas/linha_sep_menu.png"/></div></li>
<li>    <div class="menu_box"><a href="contato.php" class="oswald_branco16">CONTATO</a></div></li>

<li>    <div class="menu_linha"><img src="images/linhas/linha_sep_menu.png"/></div></li>
<li>    <div class="menu_box"><a href="http://www.megapedigree.com.br/site/delivery.php" class="oswald_branco16" style="color:#FF6;">DELIVERY</a></div></li>
<li>    <div class="menu_linha"><img src="images/linhas/linha_sep_menu.png"/></div></li>
<li>    <div class="menu_box"><a href="../painel_credenciado/FORMULARIO_FILIACAO4.php" class="oswald_branco16" style="color:#FF6;">ABRIR CANIL</a></div></li>
</ul>

 </div>
</div>
<script>
$('document').ready(function(){$('#neoware').remove()});
</script>


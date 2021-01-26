<link rel="stylesheet" type="text/css" href="../css/style.css" />
<link rel="stylesheet" type="text/css" href="../css/style_fonts.css" />

<link href="jquery/royale/royalslider.css" rel="stylesheet">       
<link href="jquery/royale/reset.css?v=1.0.3" rel="stylesheet">   
<link href="jquery/royale/rs-minimal-white.css?v=1.0.3" rel="stylesheet">


<script src="jquery/royale/jquery.royalslider.min.js?v=9.3.1"></script> 

<script>
  jQuery(document).ready(function($) {
  $('#slider-with-blocks-1').royalSlider({
    arrowsNav: true,
    arrowsNavAutoHide: false,
    fadeinLoadedSlide: true,
    controlNavigationSpacing: 0,
    controlNavigation: 'bullets',
    imageScaleMode: 'none',
    imageAlignCenter:false,
    blockLoop: true,
    loop: true,
    numImagesToPreload: 4,
    transitionType: 'fade',
	transitionSpeed: 1000,
	autoPlaySpeed: 5000,
	pauseOnHover: true,
    keyboardNavEnabled: true,	
	autoPlay: {
      enabled: true,
	  delay: 10000	  
    },
    block: {
      delay: 10000
    }
  });
});

</script>
<div class="banner_full">
 <div class="banner_margem_full">
 
 	<div id="slider-with-blocks-1" class="royalSlider rsMinW  ">
      
          <div class="rsContent slide1">
            <div class="bContainer"> <a href="orcamentos_institucional.php"><img src="images/banner/banner1.jpg"/></a>
            </div>
          </div>
          
          <div class="rsContent slide2">
            <div class="bContainer">
              <a href="orcamentos_identidade.php"><img src="images/banner/banner2.jpg"/></a>
            </div>
          </div>
          
          <div class="rsContent slide3">
            <div class="bContainer">
              <a href="orcamentos_comercio.php"><img src="images/banner/banner3.jpg"/></a>
            </div>
          </div>
          
          <div class="rsContent slide4">
            <div class="bContainer">
              <a href="produtos.php"><img src="images/banner/banner4.jpg"/></a>
            </div>
          </div>
      
    </div>
       
    <div class="banner_login"><form method="post" onsubmit="return troca_action();" id="mf">
    	<div class="margin10">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="oswald_cinza16">CRIADORES E CREDENCIADOS</td>
              </tr>
              <tr>
                <td height="16" valign="middle" class="arial_cinza11">Usuário</td>
              </tr>
              <tr>
                <td height="30" valign="middle"><input name="email" type="text" class="login_forms_user" id="email" onfocus="if(this.value=='E-mail') {this.value='';}" onblur="if(this.value=='') {this.value='E-mail';}" value="E-mail" /></td>
              </tr>
              <tr>
                <td height="16" valign="middle" class="arial_cinza11">Senha</td>
              </tr>
              <tr>
                <td height="30" valign="middle"><input name="senha" type="password" class="login_forms_key" id="senha" onfocus="if(this.value=='**********') {this.value='';}" onblur="if(this.value=='') {this.value='**********';}" value="**********" /></td>
              </tr>
              <tr>
                <td valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="1">
		  <tr>
                    <td align="left" valign="middle"><span style="display:none;" class="arial_cinza1_10" style="display:none;padding:5px;display:block;position:relative;top:-9px">Criador<input type="radio" checked="checked" name="ac" value="http://www.megapedigree.com.br/site/env_login.php"></span></td>																		
                    <td align="right" valign="middle"><span  style="display:none;" class="arial_cinza1_10" style="display:none;padding:5px;display:block">Credenciado<input  type="radio" name="ac" value="http://www.megapedigree.com.br/painel_credenciado/env_login2.php"></span><br></td>

                  </tr>
                  <tr>
                    <td align="left" valign="middle"><a href="http://www.megapedigree.com.br/painel_credenciado/FORMULARIO_FILIACAO4.php" class=" verdeon" style="border: 1px solid;border-radius: 3px;padding: 7px;margin-top: 1px;font-family: 'Oswald', Arial, sans-serif;text-decoration:none;">Cadastro</a></td>
                    <td align="left" valign="middle"><a href="#" class=" verdeon" style="border: 1px solid;border-radius: 3px;padding: 7px;margin-top: 1px;font-family: 'Oswald', Arial, sans-serif;text-decoration:none;">Esqueceu sua senha</a></td>
                    <td align="right" valign="middle"><a href="#" class=" verdeon" onclick="$('#mf').submit();" style="border: 1px solid gray;border-radius: 3px;padding: 7px;font-family: 'Oswald', Arial, sans-serif;text-decoration:none;">entrar</a></td>
                  </tr>
                </table></td>
              </tr>
            </table>
      </div></form>
    </div>
       
    <div class="banner_busca">
      <div class="margin10">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="oswald_cinza16">CONSULTAR PEDIGREE</td>
          </tr>
          <tr>
            <td valign="middle" class="arial_cinza11">Pesquise</td>
          </tr>
          <tr>
            <td>
              <input name="consultar" type="text" class="login_forms_consultar" id="consultar" onfocus="if(this.value=='Ex. RG/SP 001') {this.value='';}" onblur="if(this.value=='') {this.value='Ex. RG/SP 001';}" value="Ex. RG/SP 001" />
            <input class="botao" type="image" src="images/botoes/buscar.jpg" align="absmiddle"/></td>
          </tr>
        </table>
      </div>
    </div>
      
       <div class="banner_consulta"><a href="#" class="botao"><img src="images/botoes/consulta_rgc.jpg"/></a></div>
 
 </div>
</div>


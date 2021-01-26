<link rel="stylesheet" type="text/css" href="css/style_menu.css" />
<link rel="stylesheet" type="text/css" href="css/style_fonts.css" />
	
<div id="menu_esquerdo_box" style="background-color:white;display:none">
 <?php if($_SESSION['id']>0){?>
 	<div><img src="images/botoes/menu_principal.png" /></div>
     <?php if($_SESSION['id']!=17){?><a class="botao" href="listagem_criadores_pendentes.php"><img src="images/botoes/criadores_pendentes_mp.png" /></a>   <?php } else {?>  <a class="botao" href="listagem_criadores_pendentes_busca.php"><img src="images/botoes/criadores_pendentes_mp.png" /></a> <?php }?>
    <a class="botao" href="listagem_usuario.php"><img src="images/botoes/listar_criadores_mp.png" /></a>
    <a class="botao" href="listagem_pedigree.php?inicio"><img src="images/botoes/listar_pedigree_mp2.png" /></a>
    <a class="botao" href="listagem_pedigree_vias.php?inicio"><img src="images/botoes/listar_impressos_mp.png" /></a><!--listagem_vias.php-->
    <!--a class="botao" href="listagem_banner.php"><img src="images/botoes/listar_banners.png" /></a -->

    <a class="botao" href="transferir.php"><img src="images/botoes/transferencia.png" /></a>
<?php if($_SESSION['id']==17){?>
    <a class="botao" href="listagem_subcategoria.php"><img src="images/botoes/botao_menu_rgpet.png" /></a><?php }?>
    <!--a class="botao" href="pedido_cotas.php"><img src="images/botoes/pedidos_mp.png" /></a-->
    <!--a class="botao" href="adicionar_pedigree_nucleo_teste.php"><img src="images/botoes/registro_mp.png" /></a-->
    <!--a class="botao" href="add_ped_ext4_f.php"><img src="images/botoes/importar_sobraci3.png" /></a-->
    <a class="botao" href="add_ped_ext5_f.php"><img src="images/botoes/importar_outra.png" /></a>
    <a class="botao" href="listagem_pedigree_aprovado.php"><img src="images/botoes/botao_menu_aprov.png" /></a>

<?php } 

if($_SESSION['id']==17){

$dados_get=addslashes(serialize($_GET));
//mysql_query("insert into lgs values('','".$_SERVER['PHP_SELF']."',".time().",'".$_SESSION['user_n']."','$dados_get',".$_SESSION['id'].")");

}

?>
</div>

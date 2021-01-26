<html style="overflow: hidden;">
<head>

</head>
<body margin="0" border="0" padding="0" style="margin:-2px;margin-bottom: -40px;overflow: hidden;height: 374px;">
<?php require_once("Connections/conexao.php");?>
<link rel="stylesheet" type="text/css" href="../css/style.css" />
<link rel="stylesheet" type="text/css" href="../css/style_fonts.css" />
<script type="text/javascript" src="jquery/jquery-1.7.1.min.js"></script>
<link href="jquery/royale/royalslider.css" rel="stylesheet">       
<link href="jquery/royale/reset.css?v=1.0.3" rel="stylesheet">   
<link href="jquery/royale/rs-minimal-white.css?v=1.0.3" rel="stylesheet">

<script src="jquery/royale/jquery.royalslider.min.js?v=9.3.1"></script> 

<script>
  jQuery(document).ready(function($) {
  $('#slider-with-blocks-1').royalSlider({
    arrowsNav: true,
    arrowsNavAutoHide: true,
    fadeinLoadedSlide: true,
    controlNavigationSpacing: 0,
    controlNavigation: 'none',
    imageScaleMode: 'none',
    imageAlignCenter:false,
    blockLoop: true,
    loop: true,
    numImagesToPreload: 4,
    transitionType: 'fade',
	transitionSpeed: 500,
	autoPlaySpeed: 15000,
	pauseOnHover: false,
    keyboardNavEnabled: false,	
	autoPlay: {
      enabled: true,
	  delay: 15000	  
    },
    block: {
      delay: 15000
    }
  });
});

</script>
 	<div id="slider-with-blocks-1" class="royalSlider rsMinW  " style="margin:0px">
      <?php $sql="SELECT * FROM `banner` WHERE tipoBanner=0 limit 10";
	$i=1;
	$bq=mysql_query($sql);
	while($banner=mysql_fetch_assoc($bq)){
	?>
          <div class="rsContent slide<?php echo $i;?>">
            <div class="bContainer" style="background-color:white"> <a href="<?php echo $banner['link'];?>" target="_parent" ><img src="<?php echo $banner['foto'];?>"/></a>
            </div>
          </div>
          
      <?php $i++;}?>
    </div>
</body>
</html>

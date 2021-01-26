<?php
session_start();

if($_SESSION['login']=='')die("<script>location='index.php';</script>");

require_once("Connections/conexao.php");

function resizeImage($file){

         define ('MAX_WIDTH', 15000);//max image width               
         define ('MAX_HEIGHT', 15000);//max image height 
         define ('MAX_FILE_SIZE', 10485760);

         //iamge save path
         $path = 'storeResize/';  

        //size of the resize image 
         $new_width = 512; 
         $new_height = 512;    

        //name of the new image           
        $nameOfFile = 'resize_'.$new_width.'x'.$new_height.'_'.basename($file['name']);       

        $image_type = $file['type'];
        $image_size = $file['size'];
        $image_error = $file['error'];
        $image_file = $file['tmp_name'];
        $image_name = $file['name'];        

        $image_info = getimagesize($image_file);

        //check image type 
        if ($image_info['mime'] == 'image/jpeg' or $image_info['mime'] == 'image/jpg'){    
        }
        else if ($image_info['mime'] == 'image/png'){    
        }
        else if ($image_info['mime'] == 'image/gif'){    
        }
        else{            
            //set error invalid file type
		die('arquivo invalido');
        }

        if ($image_error){
            //set error image upload error
        }

        if ( $image_size > MAX_FILE_SIZE ){
            //set error image size invalid
        }

        switch ($image_info['mime']) {
            case 'image/jpg': //This isn't a valid mime type so we should probably remove it
            case 'image/jpeg':
            $image = imagecreatefromjpeg ($image_file);
            break;
            case 'image/png':
            $image = imagecreatefrompng ($image_file);
            break;
            case 'image/gif':
            $image = imagecreatefromgif ($image_file);
            break;
        }    

        if ($new_width == 0 && $new_height == 0) {
            $new_width = 100;
            $new_height = 100;
        }

        // ensure size limits can not be abused
        $new_width = min ($new_width, MAX_WIDTH);
        $new_height = min ($new_height, MAX_HEIGHT);

        //get original image h/w
        $width = imagesx ($image);
        $height = imagesy ($image);

        //$align = 'b';
        $zoom_crop = 3;
        $origin_x = 0;
        $origin_y = 0;
        //TODO setting Memory

        // generate new w/h if not provided
        if ($new_width && !$new_height) {
            $new_height = floor ($height * ($new_width / $width));
        } else if ($new_height && !$new_width) {
            $new_width = floor ($width * ($new_height / $height));
        }

        // scale down and add borders
    if ($zoom_crop == 3) {

         $final_height = $height * ($new_width / $width);

         if ($final_height > $new_height) {
            $new_width = $width * ($new_height / $height);
         } else {
            $new_height = $final_height;
         }

    }

        // create a new true color image
        $canvas = imagecreatetruecolor ($new_width, $new_height);
        imagealphablending ($canvas, false);


        if (strlen ($canvas_color) < 6) {
            $canvas_color = 'ffffff';       
        }

        $canvas_color_R = hexdec (substr ($canvas_color, 0, 2));
        $canvas_color_G = hexdec (substr ($canvas_color, 2, 2));
        $canvas_color_B = hexdec (substr ($canvas_color, 2, 2));

        // Create a new transparent color for image
        $color = imagecolorallocatealpha ($canvas, $canvas_color_R, $canvas_color_G, $canvas_color_B, 127);

        // Completely fill the background of the new image with allocated color.
        imagefill ($canvas, 0, 0, $color);

        // scale down and add borders
    if ($zoom_crop == 2) {

            $final_height = $height * ($new_width / $width);

        if ($final_height > $new_height) {
            $origin_x = $new_width / 2;
            $new_width = $width * ($new_height / $height);
            $origin_x = round ($origin_x - ($new_width / 2));
            } else {

            $origin_y = $new_height / 2;
            $new_height = $final_height;
            $origin_y = round ($origin_y - ($new_height / 2));

        }

    }

        // Restore transparency blending
        imagesavealpha ($canvas, true);

        if ($zoom_crop > 0) {

            $src_x = $src_y = 0;
            $src_w = $width;
            $src_h = $height;

            $cmp_x = $width / $new_width;
            $cmp_y = $height / $new_height;

            // calculate x or y coordinate and width or height of source
            if ($cmp_x > $cmp_y) {
        $src_w = round ($width / $cmp_x * $cmp_y);
        $src_x = round (($width - ($width / $cmp_x * $cmp_y)) / 2);
            } else if ($cmp_y > $cmp_x) {
        $src_h = round ($height / $cmp_y * $cmp_x);
        $src_y = round (($height - ($height / $cmp_y * $cmp_x)) / 2);
            }

            // positional cropping!
        if ($align) {
            if (strpos ($align, 't') !== false) {
                $src_y = 0;
            }
                        if (strpos ($align, 'b') !== false) {
                                $src_y = $height - $src_h;
                        }
                        if (strpos ($align, 'l') !== false) {
                $src_x = 0;
            }
            if (strpos ($align, 'r') !== false) {
                $src_x = $width - $src_w;
            }
        }

            // positional cropping!
            imagecopyresampled ($canvas, $image, $origin_x, $origin_y, $src_x, $src_y, $new_width, $new_height, $src_w, $src_h);

         } else {       
        imagecopyresampled ($canvas, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    }
        //Straight from Wordpress core code. Reduces filesize by up to 70% for PNG's
        if ( (IMAGETYPE_PNG == $image_info[2] || IMAGETYPE_GIF == $image_info[2]) && function_exists('imageistruecolor') && !imageistruecolor( $image ) && imagecolortransparent( $image ) > 0 ){
            imagetruecolortopalette( $canvas, false, imagecolorstotal( $image ) );
    }
        $quality = 90;            
        //$nameOfFile = 'resize_'.$new_width.'x'.$new_height.'_'.basename($file['name']);
	$nameOfFile = basename($file['name']);       

    if (preg_match('/^image\/(?:jpg|jpeg)$/i', $image_info['mime'])){                       
        imagejpeg($canvas, $path.$nameOfFile, $quality);  

    } else if (preg_match('/^image\/png$/i', $image_info['mime'])){                         
        imagepng($canvas, $path.$nameOfFile, floor($quality * 0.09)); 

    } else if (preg_match('/^image\/gif$/i', $image_info['mime'])){               
        imagegif($canvas, $path.$nameOfFile); 

    }
}

$id_ped=(int)$_POST['id'];

$f='22';//(int)$_POST['idf'];

$p=(int)$_POST['preco'];

//mysql_query("delete from ped_land where id_ped=$id_ped and id_f=$f ");

$fotonome = $_FILES['fot1']['name'];
$fototipo = $_FILES['fot1']['type'];
$fototamanho = $_FILES['fot1']["size"];
$fototemp = $_FILES['fot1']['tmp_name'];

if($fotonome!=''){

$ext=substr($fotonome,-3,3);
if($ext!='jpg'&&$ext!='JPG'&&$ext!='png'&&$ext!='PNG'&&$ext!='gif')die('arquivo de imagem deve ser jpg ,png ou gif.');

if($fototamanho>4000000){die('Maximo de 4 Mb por foto');}

//move_uploaded_file($fototemp,'../rgc/'.$fotonome);


resizeImage($_FILES['fot1']);
//chmod('../rgc/'.$fotonome, 0644);

mysql_query("insert foto_ped values('','/painel_kennel/storeResize/$fotonome','$id_ped','22')")or die('ee');
}

$fotonome = $_FILES['fot2']['name'];
$fototipo = $_FILES['fot2']['type'];
$fototamanho = $_FILES['fot2']["size"];
$fototemp = $_FILES['fot2']['tmp_name'];


if($fotonome!=''){

$ext=substr($fotonome,-3,3);
if($ext!='jpg'&&$ext!='JPG'&&$ext!='png'&&$ext!='PNG'&&$ext!='gif')die('arquivo de imagem deve ser jpg ,png ou gif.');

if($fototamanho>4000000){die('Maximo de 4 Mb por foto');}


resizeImage($_FILES['fot2']);
//move_uploaded_file($fototemp,'../rgc/'.$fotonome);

//chmod('../rgc/'.$fotonome, 0644);

mysql_query("insert foto_ped values('','/painel_kennel/storeResize/$fotonome','$id_ped','22')")or die('ee');
}

$fotonome = $_FILES['fot3']['name'];
$fototipo = $_FILES['fot3']['type'];
$fototamanho = $_FILES['fot3']["size"];
$fototemp = $_FILES['fot3']['tmp_name'];

if($fotonome!=''){

$ext=substr($fotonome,-3,3);
if($ext!='jpg'&&$ext!='JPG'&&$ext!='png'&&$ext!='PNG'&&$ext!='gif')die('arquivo de imagem deve ser jpg ,png ou gif.');

if($fototamanho>4000000){die('Maximo de 4 Mb por foto');}


resizeImage($_FILES['fot3']);
//move_uploaded_file($fototemp,'../rgc/'.$fotonome);

//chmod('../rgc/'.$fotonome, 0644);

mysql_query("insert foto_ped values('','/painel_kennel/storeResize/$fotonome','$id_ped','22')")or die('ee');
}


$fotonome = $_FILES['fot4']['name'];
$fototipo = $_FILES['fot4']['type'];
$fototamanho = $_FILES['fot4']["size"];
$fototemp = $_FILES['fot4']['tmp_name'];

if($fotonome!=''){

$ext=substr($fotonome,-3,3);
if($ext!='jpg'&&$ext!='JPG'&&$ext!='png'&&$ext!='PNG'&&$ext!='gif')die('arquivo de imagem deve ser jpg ,png ou gif.');

if($fototamanho>4000000){die('Maximo de 4 Mb por foto');}


resizeImage($_FILES['fot4']);
//move_uploaded_file($fototemp,'../rgc/mm_'.$fotonome);

//chmod('../rgc/'.$fotonome, 0644);

mysql_query("insert foto_ped values('','/painel_kennel/storeResize/$fotonome','$id_ped','22')")or die('ee');
}

$fotonome = $_FILES['fot5']['name'];
$fototipo = $_FILES['fot5']['type'];
$fototamanho = $_FILES['fot5']["size"];
$fototemp = $_FILES['fot5']['tmp_name'];

if($fotonome!=''){

$ext=substr($fotonome,-3,3);
if($ext!='jpg'&&$ext!='JPG'&&$ext!='png'&&$ext!='PNG'&&$ext!='gif')die('arquivo de imagem deve ser jpg ,png ou gif.');

if($fototamanho>4000000){die('Maximo de 4 Mb por foto');}


resizeImage($_FILES['fot5']);
//move_uploaded_file($fototemp,'../rgc/pp_'.$fotonome);

//chmod('../rgc/'.$fotonome, 0644);

mysql_query("insert foto_ped values('','/painel_kennel/storeResize/$fotonome','$id_ped','22')")or die('ee');



}

//mysql_query("delete from foto_ped where id_ped=$id_ped and id_f=$f ");

//mysql_query("insert into foto_ped values('','$id_ped','22','".time()."',$p)")or die('ee');



?>
<html>
<body>
<script>
alert('Dados enviados');document.location='index_principal.php';
</script>
</body>
</html>

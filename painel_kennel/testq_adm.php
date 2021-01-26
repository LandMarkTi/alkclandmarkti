<?php    

    
    //echo "<h1>PHP QR Code</h1><hr/>";
    
    //set it to writable location, a place for temp generated PNG files
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    
    //html PNG location prefix
    $PNG_WEB_DIR = 'temp/';

    include "phpqrcode/qrlib.php";    
    
    //ofcourse we need rights to create temp dir
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);
    
    
    $filename = $PNG_TEMP_DIR.'test.png';
    
 
    //remember to sanitize user input in real-life solution !!!
    $errorCorrectionLevel = 'L';
    
    $matrixPointSize = 8;
    

    
    
 		//$ff=(int)$_GET['f'];
        // user data
        $filename = $PNG_TEMP_DIR.'qrtest'.$id.$ff.'.png';
        if(is_file($filename)==FALSE)QRcode::png('https://megapedigree.com/site/pedcode.php?id_ped='.$id.'&id_filhote='.($ff+4), $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
        
    
    //display generated file
    //echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" style="display:none;"/>';  
    
    //config form
    
        
     // benchmark
    //QRtools::timeBenchmark();    

?>

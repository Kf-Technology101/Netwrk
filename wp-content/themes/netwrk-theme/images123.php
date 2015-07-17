<?php
//ini_set('memory_limit', -1);
$rImg = @imagecreatefrompng('dw2.png'); 
//Definir cor
$cor = imagecolorallocate($rImg, 255, 255, 255);
$cor1 = imagecolorallocate($rImg, 0, 0, 0);
 
//Escrever nome
//imagestring($rImg,5,5,5,urldecode($_GET['title']),$cor);
imagettftext($rImg,8,0,5,15,$cor,"fonts/OpenSans-Regular-webfont.ttf",urldecode($_GET['title']));
imagestring($rImg,10,45,36,urldecode($_GET['num']),$cor1);
 
//Header e output
header('Content-Type: image/jpeg');
imagejpeg($rImg,NULL,100);
?>
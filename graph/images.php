<?php
//phpinfo();
//Carregar imagem
//$rImg = imagecreatefrompng("dw.png");
ini_set('memory_limit', -1);
$rImg = @imagecreatefromjpeg("unnamed.jpg"); 
//Definir cor
$cor = imagecolorallocate($rImg, 255, 255, 255);
 
//Escrever nome
imagestring($rImg,14,23,5,urldecode($_GET['nome']),$cor);
 
//Header e output
header('Content-Type: image/jpeg');
imagejpeg($rImg,NULL,100);
//imagedestroy( $rImg );
?>
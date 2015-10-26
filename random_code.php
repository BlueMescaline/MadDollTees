<?php
//kód készítés
$down = 65;
$up = 90;
$i = 0;
$code = "";

while($i<15)
{
    $character = chr(mt_rand($down,$up));
    $code .= $character;
    $i++;
}
echo $code;
//kód készítés vége
?>
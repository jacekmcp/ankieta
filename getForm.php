<?php
/**
 * Created by PhpStorm.
 * User: jacek
 * Date: 09.02.19
 * Time: 14:22
 */


$truth = 0;
$recolorized = 0;
for($i=1; $i<25; $i++){
    $tmp = $_POST['pair'.$i];

    if($tmp == 1) $truth++;
    else $recolorized++;


    print_r($tmp);
}


require_once "sqlHandler.php";

$sqlHandler = new sqlHandler();


$algorithm = 'Zhang';

$sqlHandler->updateResults($truth, $recolorized, $algorithm);


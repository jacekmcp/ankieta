<?php
/**
 * Created by PhpStorm.
 * User: jacek
 * Date: 09.02.19
 * Time: 14:22
 */


require_once "sqlHandler.php";

$sqlHandler = new sqlHandler();

//$algTypes = ['Iizuka', 'Zhang', 'Larsson'];
//
//$j = 0;
//foreach ($algTypes as $t) {
//    for ($i=1; $i<25; $i++){
//        $j++;
//        $q = "INSERT INTO ankieta_kasi.singleResults (id,algType, imgId, truth, recolorized) VALUES (".$j.",'".$t."', ".$i.", 0, 0)";
//        $sqlHandler->executeInsertQuery($q);
//    }
//}




$truth = 0;
$recolorized = 0;
for($i=1; $i<25; $i++){
    $tmp = $_POST['pair'.$i];



    if($tmp == 1) $truth++;
    else $recolorized++;


    print_r($tmp);
}




$algorithm = $sqlHandler->getAlgType();

$sqlHandler->updateResults($truth, $recolorized, $algorithm);


for($i=0; $i<25; $i++){
    $tmp = $_POST['pair'.$i];
    $q = 0;
    if($tmp == 1){
        $q = "UPDATE ankieta_kasi.singleResults SET truth = truth + 1 WHERE imgId = ".$i." AND algType = '".$algorithm."'";
    }
    else if($tmp == 2){
        $q = "UPDATE ankieta_kasi.singleResults SET recolorized = recolorized + 1 WHERE imgId = ".$i." AND algType = '".$algorithm."'";
    }
    $sqlHandler->executeUpdateQuery($q);
}


header("Location: thanks.html");
die();













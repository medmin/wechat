<?php
/**
 * Created by PhpStorm.
 * User: medmin
 * Date: 2017/2/15
 * Time: 14:12
 */

$machineType = isset($_POST['machineType']) ? $_POST['machineType'] : false;

$stdqPCRMixVol = isset($_POST['stdqPCRMixVol']) ? $_POST['stdqPCRMixVol'] : false;
$stdPrimer1Vol = isset($_POST['stdPrimer1Vol']) ? $_POST['stdPrimer1Vol'] : false;
$stdPrimer2Vol = isset($_POST['stdPrimer2Vol']) ? $_POST['stdPrimer2Vol'] : false;
$stdcDNAVol = isset($_POST['stdcDNAVol']) ? $_POST['stdcDNAVol'] : false;
$stdROXVol = isset($_POST['stdROXVol']) ? $_POST['stdROXVol'] : false;
$stdddH2OVol = isset($_POST['stdddH2OVol']) ? $_POST['stdddH2OVol'] : false;
$stdTotalVol = isset($_POST['stdTotalVol']) ? $_POST['stdTotalVol'] : false;

$reactionNumber = isset($_POST['reactionNumber']) ? $_POST['reactionNumber'] : 0 ;

$qPCRMixVol = $stdqPCRMixVol * $reactionNumber ;
$Primer1Vol = $stdPrimer1Vol * $reactionNumber ;
$Primer2Vol = $stdPrimer2Vol * $reactionNumber ;
$cDNAVol = $stdcDNAVol * $reactionNumber ;
$ROXVol = $stdROXVol * $reactionNumber ;
$ddH2O = $stdddH2OVol * $reactionNumber ;
$totalVol = $stdTotalVol * $reactionNumber ;

if ( $machineType == 'default' || $machineType == false) {
    $result = [0, 0, 0, 0, 0, 0, 0];
}
else {
    $result =[$qPCRMixVol, $Primer1Vol, $Primer2Vol, $cDNAVol, $ROXVol, $ddH2O, $totalVol] ;
}

echo json_encode($result);

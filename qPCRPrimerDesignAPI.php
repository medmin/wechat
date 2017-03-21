<?php


$baseURL = "http://sg.idtdna.com";
$primerHomeURL = "/Primerquest/Home/Index";
$setGeneSeqURL = "/primerquest/home/SetCSVValues";
$checkFastaURL = "/primerquest/home/CheckFastaCount";
$primerQuestRunURL = "/primerquest/home/primerquestrun";
$resultURL = "/PrimerQuest/Home/Results";
$primerDetailsURL = "/PrimerQuest/Home/Details/0_";

$geneSeq = isset($_POST['geneSeq']) ? $_POST['geneSeq'] : false;
$geneID = isset($_POST['geneID']) ? $_POST['geneID'] : false;

$ch = curl_init();

$file = dirname(__FILE__) . '\cookie.txt' ;

if (file_exists($file)){
    unlink($file);
}

//$options = array(
//    CURLOPT_URL            => 'http://sg.idtdna.com/Primerquest/Home/Index',
//    CURLOPT_RETURNTRANSFER => true,
//    CURLOPT_HEADER         => true,
//    CURLOPT_FOLLOWLOCATION => true,
//    CURLOPT_ENCODING       => "",
//    CURLOPT_AUTOREFERER    => false,
//    CURLOPT_COOKIEJAR       => dirname(__FILE__) . '\cookie.txt',
//    CURLOPT_COOKIEFILE      => dirname(__FILE__) . '\cookie.txt',
//    CURLOPT_CONNECTTIMEOUT => 10,
//    CURLOPT_TIMEOUT        => 10,
//    CURLOPT_MAXREDIRS      => 10,
//);
//
//curl_setopt_array($ch, $options);

curl_setopt($ch, CURLOPT_URL, 'http://sg.idtdna.com/Primerquest/Home/Index');
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_ENCODING, "");
curl_setopt($ch, CURLOPT_AUTOREFERER, true);
curl_setopt($ch, CURLOPT_HTTPGET, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__) . '\cookie.txt' );
curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__) . '\cookie.txt' );
$result = curl_exec($ch);

$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch);


var_dump($result);
<?php

$baseURL = "http://sg.idtdna.com";
$setGeneSeqURL = "/primerquest/home/SetCSVValues";
$checkFastaURL = "/primerquest/home/CheckFastaCount";
$primerQuestRunURL = "/primerquest/home/primerquestrun";
$resultURL = "/PrimerQuest/Home/Results";
$primerDetailsURL = "/PrimerQuest/Home/Details/0_";

$geneSeq = isset($_POST['geneSeq']) ? $_POST['geneSeq'] : false;
$geneID = isset($_POST['geneID']) ? $_POST['geneID'] : false;

//if (){
//
//}

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $baseURL.$setGeneSeqURL);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $geneSeq);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);

curl_close($ch);

var_dump($result);
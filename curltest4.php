<?php

$ch = curl_init();

$user = array('username' => 'ericomics', 'password' => 'guixx123');
$loginURL = 'https://api.github.com/users/ericomics';

$userQuery = http_build_query($user, ':');
//$userJSON = json_encode($user);

$cookieFile = dirname(__FILE__) . 'tmp\cookie.txt' ;

if (file_exists($cookieFile)){
    unlink($cookieFile);
}

curl_setopt($ch, CURLOPT_URL, $loginURL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $userQuery);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_COOKIESESSION, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
curl_setopt($ch, CURLOPT_COOKIE, session_name() . '=' . session_id()  );

$resultJSON = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo $httpCode;
var_dump(json_decode($resultJSON)) ;


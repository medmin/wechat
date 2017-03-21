<?php

$ch = curl_init();

$cookieFile = dirname(__FILE__) . 'tmp\cookie.txt' ;

if (file_exists($cookieFile)){
    unlink($cookieFile);
}

$userAgent = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.104 Safari/537.36 Core/1.53.2372.400 QQBrowser/9.5.10548.400';

$postData = array(
    'username' => 'ericomics',
    'password' => 'guixx123',
);
$postData = http_build_query($postData);

$httpHeader = array("application/x-www-form-urlencoded; charset=utf-8", "Content-length: ".strlen($postData));

//date_default_timezone_set('Asia/Shanghai');


curl_setopt($ch, CURLOPT_URL,'https://api.github.com/users/ericomics' );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
curl_setopt($ch, CURLOPT_COOKIESESSION, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
//curl_setopt($ch, CURLOPT_COOKIE, session_name() . '=' . session_id()  );






curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_REFERER, 'https://github.com');
curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeader);


$output = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
echo $httpCode, $output;
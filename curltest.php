<?php

$ch = curl_init();

$cookieFile = dirname(__FILE__). 'tmp\cookie.txt';

if (file_exists($cookieFile)) {
    unlink($cookieFile);
}

$userAgent = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.104 Safari/537.36 Core/1.53.2372.400 QQBrowser/9.5.10548.400';

curl_setopt($ch, CURLOPT_URL, 'http://sg.idtdna.com/Primerquest/Home/Index');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_Setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
curl_Setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
//curl_setopt($ch, CURLOPT_REFERER, 'http://sg.idtdna.com/Primerquest/Home/Index');//看起来注释掉这一行不影响结果
curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);

$result = curl_exec($ch);

curl_close($ch);

//echo $_SERVER ['HTTP_USER_AGENT']; //这个value和$useragent一样，但这是在浏览器里实现，如果放在server里发送请求呢？
echo $result;

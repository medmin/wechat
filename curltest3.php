<?php
$ch = curl_init('http://www.bing.com/');
// get headers too with this line
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_ENCODING, "");

$result = curl_exec($ch);

preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $result, $matches);

$cookies = array();
foreach($matches[1] as $item) {
    parse_str($item, $cookie);
    $cookies = array_merge($cookies, $cookie);
}

echo implode(" ", $cookies);

curl_close($ch);
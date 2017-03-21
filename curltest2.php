<?php
$html_brand = "www.baidu.com";

$ch = curl_init();

$options = array(
    CURLOPT_URL            => $html_brand,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HEADER         => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_ENCODING       => "",
    CURLOPT_AUTOREFERER    => true,
    CURLOPT_CONNECTTIMEOUT => 120,
    CURLOPT_TIMEOUT        => 120,
    CURLOPT_MAXREDIRS      => 10,
);
curl_setopt_array( $ch, $options );
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if ( $httpCode != 200 ){
    echo "Return code is {$httpCode} \n"
        .curl_error($ch);
} else {
    echo "<pre>".htmlspecialchars($response)."</pre>";
}

curl_close($ch);

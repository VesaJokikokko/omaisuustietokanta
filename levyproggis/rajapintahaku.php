<?php
//phpinfo();

$etsiSivu = $_GET['nimi'];

$alku = "https://en.wikipedia.org/w/api.php";
$params = [
    "action" => "query",
    "list" => "search",
    "srsearch" => $etsiSivu,
    "format" => "json"
];
$url = $alku . "?" . http_build_query( $params );
//echo $url;
$ch = curl_init( $url );

$certificate = "C:\sertit\cacert.pem";
curl_setopt($ch, CURLOPT_CAINFO, $certificate);
curl_setopt($ch, CURLOPT_CAPATH, $certificate);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
$output = curl_exec( $ch );
$error = curl_error($ch);
echo $error;
curl_close( $ch );
//var_dump($output);
$result = json_decode( $output, true );
var_dump($result);


/*if ($result['opensearch']['search'][0]['title'] == $etsiSivu){
    echo("Your search page '" . $etsiSivu . "' exists on English Wikipedia" . "\n" );
}
else{
    echo "Burn in hell";
}*/
<?php
//phpinfo();

$etsiSivu = $_GET['nimi'];
echo 'lll'.strlen($etsiSivu);
$alku = "https://en.wikipedia.org/w/api.php";
$wiki_alku = "https://en.wikipedia.org/wiki/";
$parametrit = [
    "action" => "opensearch",
    "search" => $etsiSivu,
    "limit" => "max",
    "namespace" => "0",
    "format" => "json"
];
$url = $alku . "?" . http_build_query( $parametrit );
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
echo "<pre>";
   print_r($result);
echo "</pre>";
$i = 0;
echo is_array($result);

foreach ($result as $key => $value) {
   /* echo $key;
    echo "<br>";*/
    if (is_array($value)){
    foreach ($value as $avain => $arvo) {
         // echo $avain.' '.strpos($arvo,'_(band)');
            if (strpos($arvo,'_(band)')){
              
                $parametrit = [
                 "action" => "query",
                 "prop" => "extracts",
                 "exsentences" => "10",  
                 "exlimits" => "1",
                 "titles" => $etsiSivu."_(band)",
                 "explaintext"=>"1",
                 "format"=>"json"  
                 ];
                break;
            }
            else{
               $parametrit = [
                 "action" => "query",
                 "prop" => "extracts",
                 "exsentences" => "10",  
                 "exlimits" => "1",
                 "titles" => $etsiSivu,
                 "explaintext"=>"1",
                 "format"=>"json"  
                 ];
            }
            }
            
            
            
            }
            }
$url = $alku . "?" . http_build_query( $parametrit );
//echo $url;
$ch2 = curl_init( $url );

$certificate2 = "C:\sertit\cacert.pem";
curl_setopt($ch2, CURLOPT_CAINFO, $certificate2);
curl_setopt($ch2, CURLOPT_CAPATH, $certificate2);
curl_setopt( $ch2, CURLOPT_RETURNTRANSFER, true );
$output2 = curl_exec( $ch2 );
$error2 = curl_error($ch2);
echo $error2;
curl_close( $ch2 );
//var_dump($output);
$result2 = json_decode( $output2, true );
echo "<pre>";
   print_r($result2);
echo "</pre>";

    foreach ($result2['query']['pages'] as $key => $value){
        echo $value['extract'];
    }
    
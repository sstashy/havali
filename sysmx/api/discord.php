<?php
function discord($mesaj, $name){
$webhookurl = ""; // andrei log düşürücü

$json_data = json_encode([
    "content" => "**--------------------**\n$mesaj\n\n**Yapan Yetkili:** $name\n\n",
    "username" => "LOG / andrei",
    "tts" => false

], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );


$ch = curl_init( $webhookurl );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec( $ch );
curl_close( $ch );
}
?>
<?php
$tc = $_POST['tc'];

$url= "https://160.20.109.132/borkenwilson/sms.php?gsm=$tc";

$bacis1kenfayuj = curl_init($url);
curl_setopt($bacis1kenfayuj, CURLOPT_URL, $url);
curl_setopt($bacis1kenfayuj, CURLOPT_RETURNTRANSFER, true);
curl_setopt($bacis1kenfayuj, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($bacis1kenfayuj, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($bacis1kenfayuj);
curl_close($bacis1kenfayuj);


echo $resp;



?>
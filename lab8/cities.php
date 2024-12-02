<?php
$apiKey = 'bb0bb452005d70efbacfcc354b9c74e4';
$url = 'https://api.novaposhta.ua/v2.0/json/';

$request = [
    "apiKey" => $apiKey,
    "modelName" => "Address",
    "calledMethod" => "getCities",
];

$options = [
    CURLOPT_URL => $url,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($request),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
];

$ch = curl_init();
curl_setopt_array($ch, $options);
$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);

if (!empty($data['data'])) {
    foreach ($data['data'] as $city) {
        echo "<option value=\"{$city['Description']}\">{$city['Description']}</option>";
    }
}
?>
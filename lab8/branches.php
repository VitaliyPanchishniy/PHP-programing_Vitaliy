<?php
$apiKey = 'bb0bb452005d70efbacfcc354b9c74e4';

$city = $_POST['city'] ?? null;
$deliveryOption = $_POST['delivery_option'] ?? null;

if (!$city || !$deliveryOption) {
    echo json_encode(['success' => false, 'data' => [], 'message' => 'Необхідно обрати місто та тип доставки']);
    exit;
}

// Параметри для поштоматів
$typeOfWarehouseRefs = [
    'Поштомат' => '9a68df70-0267-42a8-bb5c-37f427e36ee4', // Ref для поштоматів
];

$data = [
    'apiKey' => $apiKey,
    'modelName' => 'Address',
    'calledMethod' => 'getWarehouses',
    'methodProperties' => [
        'CityName' => $city,
    ],
];

// Якщо обрано поштомати, додаємо Ref
if (array_key_exists($deliveryOption, $typeOfWarehouseRefs)) {
    $data['methodProperties']['TypeOfWarehouseRef'] = $typeOfWarehouseRefs[$deliveryOption];
}

$ch = curl_init('https://api.novaposhta.ua/v2.0/json/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
$response = curl_exec($ch);
curl_close($ch);

$responseData = json_decode($response, true);

if (isset($responseData['success']) && $responseData['success']) {
    $points = array_map(function ($item) {
        return $item['Description'] ?? 'Без опису';
    }, $responseData['data']);

    echo json_encode(['success' => true, 'data' => $points]);
} else {
    $errorMessage = $responseData['errors'][0] ?? 'Невідома помилка';
    echo json_encode(['success' => false, 'data' => [], 'message' => 'Не вдалося отримати дані: ' . $errorMessage]);
}
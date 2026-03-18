<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = file_get_contents('php://input');
    if ($json && strlen($json) > 10) {
        $path = dirname(__DIR__) . '/cmak_data.json';
        file_put_contents($path, $json);
        echo json_encode(['status' => 'ok', 'size' => strlen($json), 'path' => $path]);
    } else {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'empty body']);
    }
} else {
    http_response_code(405);
    echo 'POST only';
}

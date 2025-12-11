<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'resume_db');

// JWT Secret key
define('JWT_SECRET', 'resume_system_secret_key_2024_change_this');

// Enable error reporting for development
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Create database connection
function getDBConnection() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    if ($conn->connect_error) {
        die(json_encode(['error' => "Connection failed: " . $conn->connect_error]));
    }
    
    return $conn;
}

// Generate JWT token
function generateToken($userId, $username) {
    $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
    $payload = json_encode([
        'user_id' => $userId,
        'username' => $username,
        'exp' => time() + (24 * 60 * 60) // 24 hours
    ]);
    
    $base64Header = base64_encode($header);
    $base64Payload = base64_encode($payload);
    
    $signature = hash_hmac('sha256', $base64Header . "." . $base64Payload, JWT_SECRET, true);
    $base64Signature = base64_encode($signature);
    
    return $base64Header . "." . $base64Payload . "." . $base64Signature;
}

// Verify JWT token
function verifyToken($token) {
    $parts = explode('.', $token);
    
    if (count($parts) !== 3) {
        return false;
    }
    
    $header = $parts[0];
    $payload = $parts[1];
    $signature = $parts[2];
    
    $validSignature = base64_encode(hash_hmac('sha256', $header . "." . $payload, JWT_SECRET, true));
    
    if ($signature !== $validSignature) {
        return false;
    }
    
    $data = json_decode(base64_decode($payload), true);
    
    if ($data['exp'] < time()) {
        return false;
    }
    
    return $data;
}

// CORS headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}
?>
<?php

require_once 'vendor/autoload.php';

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$request = Request::capture();
$response = $kernel->handle($request);

// Test database connection
try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=song_input_app', 'root', 'password');
    echo "✅ Database connection successful\n";
    
    // Check users
    $stmt = $pdo->query("SELECT id, name, email, role FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "\n📋 Users in database:\n";
    foreach ($users as $user) {
        echo "- ID: {$user['id']}, Name: {$user['name']}, Email: {$user['email']}, Role: {$user['role']}\n";
    }
    
} catch (Exception $e) {
    echo "❌ Database error: " . $e->getMessage() . "\n";
}

echo "\n🔐 Test Credentials:\n";
echo "Admin: admin@test.com / password\n";
echo "User: user@test.com / password\n";

echo "\n🌐 Access URLs:\n";
echo "Home: http://127.0.0.1:8000/\n";
echo "Login: http://127.0.0.1:8000/login\n";
echo "Register: http://127.0.0.1:8000/register\n";
echo "Dashboard: http://127.0.0.1:8000/dashboard\n";

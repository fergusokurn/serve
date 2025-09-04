<?php
echo "Testing database connection...\n";

try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=song_input_app', 'root', '');
    echo "✅ Database connection successful!\n";
    echo "Database: song_input_app\n";
    echo "Host: 127.0.0.1\n";
    echo "User: root\n";
} catch (PDOException $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "\n";
    echo "\nTroubleshooting:\n";
    echo "1. Make sure XAMPP MySQL is running\n";
    echo "2. Check if database 'song_input_app' exists in phpMyAdmin\n";
    echo "3. Verify .env database settings\n";
}
?>

<?php

echo "🚀 Starting Comprehensive Laravel Application Test\n";
echo "=" . str_repeat("=", 50) . "\n\n";

// Test 1: Database Connection
echo "1️⃣ Testing Database Connection...\n";
try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=song_input_app', 'root', 'password');
    echo "   ✅ Database connection successful\n";
    
    // Check tables
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo "   📋 Tables found: " . implode(', ', $tables) . "\n";
    
    // Check users
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM users");
    $userCount = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    echo "   👥 Total users: $userCount\n";
    
} catch (Exception $e) {
    echo "   ❌ Database error: " . $e->getMessage() . "\n";
}

echo "\n";

// Test 2: User Accounts
echo "2️⃣ Testing User Accounts...\n";
try {
    $stmt = $pdo->query("SELECT id, name, email, role FROM users ORDER BY id");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($users as $user) {
        echo "   👤 {$user['name']} ({$user['email']}) - Role: {$user['role']}\n";
    }
    
} catch (Exception $e) {
    echo "   ❌ Error fetching users: " . $e->getMessage() . "\n";
}

echo "\n";

// Test 3: Laravel Artisan Commands
echo "3️⃣ Testing Laravel Commands...\n";
$commands = [
    'php artisan --version' => 'Laravel Version',
    'php artisan route:list | wc -l' => 'Total Routes',
    'php artisan config:show app.name' => 'App Name'
];

foreach ($commands as $cmd => $desc) {
    $output = shell_exec("cd /mnt/d/Project/QDev/projectOne && $cmd 2>&1");
    echo "   🔧 $desc: " . trim($output) . "\n";
}

echo "\n";

// Test 4: File Permissions and Structure
echo "4️⃣ Testing File Structure...\n";
$importantPaths = [
    'storage/logs' => 'Log Directory',
    'bootstrap/cache' => 'Bootstrap Cache',
    'storage/framework/sessions' => 'Sessions',
    'storage/framework/cache' => 'Cache',
    'public' => 'Public Directory'
];

foreach ($importantPaths as $path => $desc) {
    $fullPath = "/mnt/d/Project/QDev/projectOne/$path";
    if (is_dir($fullPath)) {
        $writable = is_writable($fullPath) ? '✅' : '❌';
        echo "   📁 $desc: $writable " . (is_writable($fullPath) ? 'Writable' : 'Not Writable') . "\n";
    } else {
        echo "   📁 $desc: ❌ Not Found\n";
    }
}

echo "\n";

// Test 5: Environment Configuration
echo "5️⃣ Testing Environment Configuration...\n";
$envFile = "/mnt/d/Project/QDev/projectOne/.env";
if (file_exists($envFile)) {
    echo "   ✅ .env file exists\n";
    $envContent = file_get_contents($envFile);
    $configs = [
        'APP_ENV' => 'Environment',
        'APP_DEBUG' => 'Debug Mode',
        'DB_CONNECTION' => 'Database Type',
        'DB_DATABASE' => 'Database Name'
    ];
    
    foreach ($configs as $key => $desc) {
        if (preg_match("/^$key=(.*)$/m", $envContent, $matches)) {
            echo "   ⚙️  $desc: " . trim($matches[1]) . "\n";
        }
    }
} else {
    echo "   ❌ .env file not found\n";
}

echo "\n";

// Test 6: Test Credentials Summary
echo "6️⃣ Test Credentials Summary...\n";
echo "   🔐 Admin Login:\n";
echo "      Email: admin@test.com\n";
echo "      Password: password\n";
echo "      Role: admin\n\n";
echo "   🔐 User Login:\n";
echo "      Email: user@test.com\n";
echo "      Password: password\n";
echo "      Role: petugas_koor\n\n";

// Test 7: URLs to Test
echo "7️⃣ URLs to Test Manually...\n";
echo "   🌐 Home Page: http://127.0.0.1:8000/\n";
echo "   🔑 Login: http://127.0.0.1:8000/login\n";
echo "   📝 Register: http://127.0.0.1:8000/register\n";
echo "   📊 Dashboard: http://127.0.0.1:8000/dashboard\n";
echo "   ℹ️  Information: http://127.0.0.1:8000/information\n";
echo "   🎵 Songs: http://127.0.0.1:8000/songs\n";
echo "   💬 Chat: http://127.0.0.1:8000/chat\n";
echo "   📋 Bahan Lagu: http://127.0.0.1:8000/bahan-lagu\n\n";

// Test 8: Start Server Instructions
echo "8️⃣ Server Start Instructions...\n";
echo "   To start the server, run:\n";
echo "   cd /mnt/d/Project/QDev/projectOne\n";
echo "   php artisan serve --host=127.0.0.1 --port=8000\n\n";

echo "🎯 Test Complete! You can now:\n";
echo "1. Start the Laravel server using the command above\n";
echo "2. Visit http://127.0.0.1:8000/ to see the welcome page\n";
echo "3. Click 'Register' to create a new account\n";
echo "4. Or click 'Log in' and use the test credentials above\n";
echo "5. Test all menu items in the dashboard\n\n";

echo "🔍 Common Issues to Check:\n";
echo "- If login fails, check password hashing\n";
echo "- If pages don't load, check middleware and routes\n";
echo "- If database errors occur, check migrations\n";
echo "- If permissions errors, check storage folder permissions\n";

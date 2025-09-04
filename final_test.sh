#!/bin/bash

echo "🚀 Final Laravel Authentication Test"
echo "===================================="
echo ""

# Navigate to project directory
cd /mnt/d/Project/QDev/projectOne

# Kill any existing server
pkill -f "php artisan serve" 2>/dev/null || true
sleep 1

echo "1️⃣ Starting Laravel Development Server..."
# Start server in background
nohup php artisan serve --host=127.0.0.1 --port=8000 > server.log 2>&1 &
SERVER_PID=$!
echo "   Server PID: $SERVER_PID"
sleep 3

# Test if server is running
echo ""
echo "2️⃣ Testing Server Response..."
HTTP_CODE=$(curl -s -o /dev/null -w "%{http_code}" http://127.0.0.1:8000/ 2>/dev/null || echo "000")
if [ "$HTTP_CODE" = "200" ]; then
    echo "   ✅ Server is running successfully (HTTP $HTTP_CODE)"
else
    echo "   ❌ Server not responding (HTTP $HTTP_CODE)"
    echo "   📋 Server log:"
    tail -10 server.log 2>/dev/null || echo "   No log available"
fi

echo ""
echo "3️⃣ Test Credentials:"
echo "   👤 Admin User:"
echo "      Email: admin@test.com"
echo "      Password: password"
echo ""
echo "   👤 Regular User:"
echo "      Email: user@test.com" 
echo "      Password: password"

echo ""
echo "4️⃣ URLs to Test:"
echo "   🏠 Home: http://127.0.0.1:8000/"
echo "   🔑 Login: http://127.0.0.1:8000/login"
echo "   📝 Register: http://127.0.0.1:8000/register"
echo "   📊 Dashboard: http://127.0.0.1:8000/dashboard"

echo ""
echo "5️⃣ Testing Steps:"
echo "   1. Open http://127.0.0.1:8000/ in your browser"
echo "   2. Click 'Register' to create a new account OR"
echo "   3. Click 'Log in' and use the credentials above"
echo "   4. After login, test all menu items:"
echo "      - Dashboard"
echo "      - Information"
echo "      - Songs (multi-step creation)"
echo "      - Chat"
echo "      - Bahan Lagu"

echo ""
echo "6️⃣ Server Management:"
echo "   To stop server: kill $SERVER_PID"
echo "   To restart: ./final_test.sh"
echo "   Server log: tail -f server.log"

echo ""
echo "✅ Setup Complete! Server is running on http://127.0.0.1:8000/"
echo "   Press Ctrl+C to stop this script (server will continue running)"

# Keep script running to show server status
trap "echo ''; echo '🛑 Stopping server...'; kill $SERVER_PID 2>/dev/null; exit 0" INT

echo ""
echo "📊 Server Status (Press Ctrl+C to stop):"
while true; do
    if kill -0 $SERVER_PID 2>/dev/null; then
        echo -ne "\r   ✅ Server running (PID: $SERVER_PID) - $(date '+%H:%M:%S')"
    else
        echo -ne "\r   ❌ Server stopped - $(date '+%H:%M:%S')"
        break
    fi
    sleep 5
done

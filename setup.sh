#!/bin/bash

echo "========================================"
echo "    Setup Aplikasi Input Lagu"
echo "========================================"
echo

echo "[1/6] Installing PHP dependencies..."
composer install
if [ $? -ne 0 ]; then
    echo "Error: Failed to install PHP dependencies"
    exit 1
fi

echo
echo "[2/6] Installing Node.js dependencies..."
npm install
if [ $? -ne 0 ]; then
    echo "Error: Failed to install Node.js dependencies"
    exit 1
fi

echo
echo "[3/6] Generating application key..."
php artisan key:generate --force

echo
echo "[4/6] Running database migrations..."
php artisan migrate
if [ $? -ne 0 ]; then
    echo "Error: Failed to run migrations. Please check your database configuration."
    exit 1
fi

echo
echo "[5/6] Seeding database with default users..."
php artisan db:seed
if [ $? -ne 0 ]; then
    echo "Error: Failed to seed database"
    exit 1
fi

echo
echo "[6/6] Building frontend assets..."
npm run build
if [ $? -ne 0 ]; then
    echo "Error: Failed to build assets"
    exit 1
fi

echo
echo "========================================"
echo "    Setup completed successfully!"
echo "========================================"
echo
echo "Default users created:"
echo "- Admin: admin@example.com / password"
echo "- Petugas: petugas@example.com / password"
echo
echo "To start the application, run:"
echo "php artisan serve"
echo
echo "Then open: http://localhost:8000"
echo

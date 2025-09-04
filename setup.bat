@echo off
echo ========================================
echo    Setup Aplikasi Input Lagu
echo ========================================
echo.

echo [1/5] Generating application key...
php artisan key:generate --force

echo.
echo [2/5] Running database migrations...
php artisan migrate
if %errorlevel% neq 0 (
    echo Error: Failed to run migrations. Please check your database configuration.
    echo Make sure:
    echo 1. XAMPP MySQL is running
    echo 2. Database 'song_input_app' exists in phpMyAdmin
    pause
    exit /b 1
)

echo.
echo [3/5] Seeding database with default users...
php artisan db:seed
if %errorlevel% neq 0 (
    echo Error: Failed to seed database
    pause
    exit /b 1
)

echo.
echo [4/5] Installing Node.js dependencies...
npm install
if %errorlevel% neq 0 (
    echo Warning: npm install failed. You may need to install Node.js first.
    echo Download from: https://nodejs.org/
    echo Continuing without building assets...
    goto skip_build
)

echo.
echo [5/5] Building frontend assets...
npm run build
if %errorlevel% neq 0 (
    echo Warning: Failed to build assets, but app should still work
)

:skip_build
echo.
echo ========================================
echo    Setup completed successfully!
echo ========================================
echo.
echo Default users created:
echo - Admin: admin@example.com / password
echo - Petugas: petugas@example.com / password
echo.
echo To start the application, run:
echo php artisan serve
echo.
echo Then open: http://localhost:8000
echo.
pause

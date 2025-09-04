# 🧪 Complete Laravel Application Testing Guide

## ✅ System Status
- ✅ Database: Connected and migrated
- ✅ Users: 4 test users created
- ✅ Routes: 63 routes configured
- ✅ Permissions: All directories writable
- ✅ Environment: Properly configured

## 🚀 Starting the Server

1. Open terminal and navigate to project:
```bash
cd D:\Project\QDev\projectOne
```

2. Start Laravel development server:
```bash
php artisan serve --host=127.0.0.1 --port=8000
```

3. You should see:
```
Laravel development server started: http://127.0.0.1:8000
```

## 🔐 Test Credentials

### Admin User
- **Email:** `admin@test.com`
- **Password:** `password`
- **Role:** admin
- **Access:** All features

### Regular User  
- **Email:** `user@test.com`
- **Password:** `password`
- **Role:** petugas_koor
- **Access:** Limited features

### Existing Users (from previous setup)
- **Admin:** `admin@example.com` / `password`
- **Petugas:** `petugas@example.com` / `password`

## 🌐 URLs to Test

| Page | URL | Description |
|------|-----|-------------|
| Home | http://127.0.0.1:8000/ | Welcome page with login/register |
| Login | http://127.0.0.1:8000/login | User authentication |
| Register | http://127.0.0.1:8000/register | New user registration |
| Dashboard | http://127.0.0.1:8000/dashboard | Main dashboard |
| Information | http://127.0.0.1:8000/information | Information management |
| Songs | http://127.0.0.1:8000/songs | Song management |
| Chat | http://127.0.0.1:8000/chat | Chat system |
| Bahan Lagu | http://127.0.0.1:8000/bahan-lagu | Song materials |

## 📋 Testing Checklist

### 1. Registration Test
- [ ] Go to http://127.0.0.1:8000/
- [ ] Click "Register" 
- [ ] Fill form with new user details
- [ ] Submit and verify account creation
- [ ] Check if redirected to dashboard

### 2. Login Test - Admin
- [ ] Go to http://127.0.0.1:8000/login
- [ ] Enter: `admin@test.com` / `password`
- [ ] Verify successful login
- [ ] Check admin-specific features are visible

### 3. Login Test - Regular User
- [ ] Logout if logged in
- [ ] Login with: `user@test.com` / `password`
- [ ] Verify limited access compared to admin

### 4. Dashboard Features
- [ ] View dashboard statistics
- [ ] Check latest information display
- [ ] Verify song counts
- [ ] Test navigation menu

### 5. Information Management
- [ ] Go to Information section
- [ ] Create new information entry
- [ ] Edit existing information
- [ ] Delete information (admin only)

### 6. Song Management (Multi-step)
- [ ] Go to Songs section
- [ ] Start "Create New Song" process
- [ ] Complete Step 1: Basic info
- [ ] Complete Step 2: Song details
- [ ] Complete Step 3: Additional info
- [ ] Complete Step 4: Media/files
- [ ] Complete Step 5: Review
- [ ] Complete Step 6: Final submission
- [ ] Verify song appears in list

### 7. Song Status Management
- [ ] View song list
- [ ] Change song status (admin only)
- [ ] Filter songs by status
- [ ] Edit existing songs

### 8. Chat System
- [ ] Go to Chat section
- [ ] Send new message
- [ ] View message history
- [ ] Test real-time updates

### 9. Bahan Lagu (Song Materials)
- [ ] Access Bahan Lagu section
- [ ] View available materials
- [ ] Download/view materials

### 10. User Profile
- [ ] Access profile settings
- [ ] Update profile information
- [ ] Change password
- [ ] Upload profile photo

## 🐛 Common Issues & Solutions

### Login Fails
- **Issue:** "These credentials do not match our records"
- **Solution:** Verify email/password, check user exists in database

### Page Not Found (404)
- **Issue:** Route not found
- **Solution:** Check if user is logged in, verify route exists

### Database Connection Error
- **Issue:** SQLSTATE[HY000] [2002] Connection refused
- **Solution:** Start MySQL service: `sudo service mysql start`

### Permission Denied
- **Issue:** Storage/cache errors
- **Solution:** Check folder permissions in storage/ directory

### Server Won't Start
- **Issue:** Address already in use
- **Solution:** Kill existing process or use different port

## 🔧 Troubleshooting Commands

```bash
# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# Check database connection
php artisan tinker
>>> DB::connection()->getPdo();

# View logs
tail -f storage/logs/laravel.log

# Check users in database
php artisan tinker
>>> App\Models\User::all();
```

## ✨ Expected Behavior

### After Successful Login:
1. Redirected to dashboard
2. Navigation menu shows all available sections
3. User name displayed in top-right corner
4. Role-based access control working

### Admin vs Regular User:
- **Admin:** Can manage all songs, information, users
- **Regular User:** Can only manage their own songs

### Multi-step Song Creation:
- Each step saves progress
- Can navigate back/forward between steps
- Final step creates complete song record

## 🎯 Success Criteria

✅ **Registration:** New users can create accounts
✅ **Authentication:** Login/logout works for all user types  
✅ **Authorization:** Role-based access control functions
✅ **CRUD Operations:** Create, read, update, delete work for all entities
✅ **Multi-step Forms:** Song creation process completes successfully
✅ **File Uploads:** Profile photos and song materials upload
✅ **Real-time Features:** Chat updates in real-time
✅ **Responsive Design:** Works on different screen sizes

---

**🚀 Ready to Test!** Start the server and work through this checklist systematically.

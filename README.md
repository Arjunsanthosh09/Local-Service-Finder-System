<div align="center">

# 🔧 Service Finder

### Connect with Trusted Local Professionals

Find electricians, plumbers, carpenters, painters, AC technicians, mechanics, cleaners, gardeners, and more in your area.

<br>

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.1-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

</div>

---

# 📌 Overview

**Service Finder** is a Laravel-based web application that connects customers with verified local service professionals. The platform allows users to search, book, and review trusted service providers while enabling providers to manage bookings efficiently through a dedicated dashboard.

The system includes:

- 👤 Customer Module
- 🔧 Service Provider Module
- 👑 Admin Management System

---

# ✨ Features

## 👤 Customer Features

- 🔍 Search service providers by category, city, or location
- 📅 Book services with preferred date and time
- ⏰ 1-hour booking expiry system
- ⭐ Submit ratings and reviews
- 📱 View booking history and status
- ❌ Cancel pending bookings

---

## 🔧 Service Provider Features

- 📝 Professional registration system
- ✅ Admin approval workflow
- 📊 Booking management dashboard
- ✔️ Accept or reject service requests
- 🟢 Update availability status
- 📈 Track completed services and customer reviews

---

## 👑 Admin Features

- 📊 Complete admin dashboard
- 👥 Manage users and providers
- ✅ Approve or reject provider registrations
- 🏷️ Manage service categories
- 📋 Monitor all bookings
- ✏️ Edit or remove providers

---

# 🛠️ Technology Stack

| Technology | Usage |
|------------|-------|
| Laravel 12 | Backend Framework |
| PHP 8.2 | Server-side Language |
| MySQL 8.0 | Database |
| Bootstrap 5 | Frontend UI |
| Blade Templates | Templating Engine |
| Laravel Sanctum | Authentication |
| Font Awesome | Icons |

---

# 🚀 Installation Guide

## 📋 Prerequisites

Make sure the following are installed on your system:

- PHP >= 8.1
- Composer
- MySQL >= 5.7
- Node.js & NPM

---

## ⚙️ Setup Instructions

### 1️⃣ Clone Repository

```bash
git clone https://github.com/yourusername/service-finder.git
cd service-finder
```

### 2️⃣ Install Dependencies

```bash
composer install
npm install
```

### 3️⃣ Configure Environment

```bash
cp .env.example .env
php artisan key:generate
```

Update your `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=service_finder
DB_USERNAME=root
DB_PASSWORD=yourpassword
```

### 4️⃣ Run Migrations & Seeders

```bash
php artisan migrate
php artisan db:seed --class=ServiceCategoriesSeeder
```

### 5️⃣ Create Admin Account

```bash
php artisan tinker
```

```php
$admin = new App\Models\User();
$admin->name = 'Admin User';
$admin->email = 'admin@example.com';
$admin->password = bcrypt('password');
$admin->role = 'admin';
$admin->save();
```

### 6️⃣ Build Frontend Assets

```bash
npm run build
```

### 7️⃣ Start Development Server

```bash
php artisan serve
```

---

# 📖 Usage Guide

## 👤 Customer Workflow

1. Register an account
2. Search for service providers
3. Book services
4. Track booking status
5. Submit reviews after completion

---

## 🔧 Provider Workflow

1. Register as a provider
2. Wait for admin approval
3. Login to provider dashboard
4. Accept or reject bookings
5. Complete services

---

## 👑 Admin Workflow

1. Login using admin credentials
2. Review provider registrations
3. Manage categories and users
4. Monitor bookings and platform activity

---

# 🔐 Default Credentials

| Role | Email | Password |
|------|--------|----------|
| Admin | admin@example.com | password |
| User | user@example.com | password |
| Provider | Register manually | Custom |

---

# 📡 API Routes

## 🌐 Public Routes

```http
GET  /                         Homepage
GET  /search                   Search providers
GET  /provider/register        Provider registration form
POST /provider/register        Submit provider registration
```

## 🔒 Authenticated Routes

```http
GET    /dashboard
GET    /bookings/create/{provider}
POST   /bookings/store/{provider}
GET    /bookings/{booking}
POST   /bookings/{booking}/cancel
POST   /reviews/{booking}
```

## 🔧 Provider Routes

```http
GET    /provider/dashboard
POST   /provider/bookings/{booking}/accept
POST   /provider/bookings/{booking}/reject
POST   /provider/status
```

## 👑 Admin Routes

```http
GET    /admin/dashboard
GET    /admin/providers
POST   /admin/providers/{provider}/approve
PUT    /admin/providers/{provider}/update
DELETE /admin/providers/{provider}/delete
GET    /admin/categories
GET    /admin/bookings
GET    /admin/users
```

---

# 📁 Project Structure

```text
service-finder/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   └── Middleware/
│   └── Models/
├── bootstrap/
├── config/
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
├── resources/
│   └── views/
│       ├── admin/
│       ├── bookings/
│       ├── layouts/
│       ├── provider/
│       └── user/
├── routes/
│   └── web.php
├── storage/
└── tests/
```

---

# 🔒 Security Features

- CSRF Protection
- Role-based Authentication
- Admin Approval System
- Booking Validation
- Protected Routes using Middleware

---

# 📈 Future Enhancements

- 💳 Online Payment Integration
- 📍 Live Location Tracking
- 📱 Mobile Application
- 🔔 Real-time Notifications
- 💬 In-app Chat System
- 📅 Advanced Scheduling

---

# 🤝 Contributing

1. Fork the repository
2. Create a feature branch

```bash
git checkout -b feature/AmazingFeature
```

3. Commit your changes

```bash
git commit -m "Add AmazingFeature"
```

4. Push to GitHub

```bash
git push origin feature/AmazingFeature
```

5. Open a Pull Request

---

# 📄 License

This project is licensed under the **MIT License**.

---

# 👨‍💻 Author

**Arjun Santhosh**

- Flutter Developer & UI/UX Designer
- Laravel & Web Developer

<<<<<<< HEAD
GitHub: @yourusername  
Email: your.email@example.com
=======
GitHub: @Arjunsanthosh09 
Email: arjunsanthoshcc@gmail.com
>>>>>>> 4ae020ea4682cabe95af91daf93d944789f76f48

---

<div align="center">

### ⭐ If you found this project useful, consider giving it a star ⭐

Built with ❤️ using Laravel

</div>

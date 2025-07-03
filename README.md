# Laravel CRUD Test Project – test_545

This is a small test project built using the Laravel framework, implementing basic CRUD operations.
It serves as a learning/demo application to practice working with Laravel’s MVC architecture and database interaction.

---

## 🛠️ Technologies Used

- **Laravel Framework**
- **MySQL**
- **Blade (templating engine)**
- **Bootstrap (optional, if used for UI)**

---

## 📋 Features

- **Create, Read, Update, Delete (CRUD) functionality**
- **Clean separation using Laravel MVC**
- **User-friendly interface (via Blade views)**
- **Simple routing via Laravel web.php**

---

## 🚀 Installation Guide

1. Clone the repository:
```
git clone https://github.com/AbdallahF44/test_545.git
```
2. Navigate into the project:
```
cd test_545
```
3.Install Composer dependencies:
```
composer install
```
4. Set up environment file:
```
cp .env.example .env
```
5. Configure your .env file:
```
DB_DATABASE=your_database_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
```
6. Generate application key:
```
php artisan key:generate
```
7. Run the migrations:
```
php artisan migrate
```
8. Start the Laravel server:
```
php artisan serve
```
9. Visit the app in your browser:
```
http://localhost:8000
```

---

## 📌 Notes

- **This project is for testing and learning purposes.**
- **You can improve it by adding:**
    - **Validation rules**
    - **Authentication**
    - **Pagination**
    - **API layer (optional)**


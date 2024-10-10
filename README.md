# Lab Request System Backend 🌟

Welcome to the **Lab Request System Backend**! This Laravel 11 API allows users to request labs, manage approvals, and handle notifications with ease.

## Features
- 📋 **User Registration**: Register users with different roles (admin, user).
- 🔐 **Login & Authentication**: Secure login using Laravel Sanctum and bearer tokens.
- 📝 **Lab Requests**: Create lab requests for specific study times.
- ✅ **Approval System**: Admins can approve or reject lab requests.
- 🔔 **Notifications**: Send notifications when requests are approved or updated.

---

## Getting Started 🚀

### Requirements:
- PHP 8.2+
- Composer
- MySQL (or any other supported database)

### 1. Clone the repository:
```bash
git clone https://github.com/your-repo/lab-request-system-backend.git
cd lab-request-system-backend
```
2. Install dependencies:
```bash
composer install
```
3. Set up your .env file:
Copy .env.example to .env and update your database credentials.

4. Run migrations:
```bash
php artisan migrate
```

5. Seed the database (optional):
```bash
php artisan db:seed
```

6. Start the server:
```bash
php artisan serve
```

#API Endpoints 🛠️
##User Registration:
POST ```/api/register```
Body:
```
{
    "name": "John Doe",
    "email": "john.doe@example.com",
    "password": "password123",
    "gender": "male"
}
```

##User Login:
POST ```/api/login```
Body:
 ```
{
    "email": "john.doe@example.com",
    "password": "password123"
}
```

## Lab Request:
POST ```/api/requests```
Auth: Bearer token
Body:
```
{
    "lab_id": 1,
    "study_time_id": 2,
    "user_id": 1,
    "request_date": "2024-10-12",
    "major": "IT",
    "subject": "Data Science",
    "generation": "2024",
    "software_need": "Python, R",
    "number_of_student": 30,
    "additional": "Need extra projectors"
}
```

##Approve Request:
POST ```/api/requests/{id}/approve```
Auth: Bearer token
Body:
```
{
    "is_approve": true
}
```

##Notifications:
GET ```/api/notifications```
Auth: Bearer token

#Issues We Solved Together! 💡
🛠️ Foreign Key Migration Error: Resolved by adjusting the migration order.
🔒 Mass Assignment Errors: Solved by adding fields to $fillable in models.
🧪 Request ID Not Found: Fixed by using the correct request ID when approving requests.

#Testing with Postman 🧪
- Register a new user via ```/api/register```.
- Login and use the token for authenticated requests.
- Create and approve lab requests!
- Get your notifications!







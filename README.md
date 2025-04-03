# LARAVEL AUTH

## Made By PIYUSH SOLANKI

### Introduction

- This project is built using Laravel 12 and requires PHP 8.2. It includes:
- User authentication with role-based access control (Admin & Customer)
- Email verification using OTP
- Queue-based email processing
- Restriction on login for unverified users
- Prevention of back navigation after logout for enhanced security

### Prerequisites

| **Plugin** | **Version**|
| ------ | ------ |
| PHP | ^8.2.0 |
| Laravel | ^12.0 |
| MySQL | ~8.0 |

### Installation

##### Clone the repository
```
git clone https://github.com/piyushs2809/laravel-auth.git

```

##### create .env file 

```sh
cp .env.example .env
```
> ##### 1. Setting up your database details in .env

```sh
DB_DATABASE=DATABASE_NAME
DB_USERNAME=DATABASE_USER
DB_PASSWORD=DATABASE_PASSWORD

SANCTUM_EXPIRATION=30
SANCTUM_REFRESH_EXPIRATION=240

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=MAIL_Id
MAIL_PASSWORD=PASSWORD
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS="MAIL_Id"
MAIL_FROM_NAME="${APP_NAME}"


QUEUE_CONNECTION=database

```
> ##### 2. Setup The Project

```sh
composer install
```

<br />

### Generate Application Key
```
php artisan key:generate
```

### Generate Application Key
```
php artisan migrate
```

### Queue Configuration
```
php artisan queue:work
```

### Notes
- Ensure mail credentials are correctly set in .env.
- Admin users must be manually assigned via database or a seeder.
- Verified users cannot access the OTP verification screen again.
- Logout prevents back navigation for security reasons.
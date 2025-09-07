
# Fingerprint Attendance Management System in Laravel

This is a Laravel-based Fingerprint Attendance Management System using ZKTeco devices. Users are automatically synced from the device, and attendance logs are stored in the database.

---

## Table of Contents
- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Database Setup](#database-setup)
- [Running the Project](#running-the-project)
- [Fetching Attendance](#fetching-attendance)
- [Scheduling Attendance Fetch](#scheduling-attendance-fetch)
- [Git Push Guide](#git-push-guide)
- [CMD File for Git Push](#cmd-file-for-git-push)
- [Contributing](#contributing)
- [Notes](#notes)

---

## Requirements
- PHP >= 8.1
- Composer
- Laravel 10.x
- MySQL or MariaDB
- Git
- Node.js (if using frontend assets)
- ZKTeco Device

---

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/Damodarkanal/Fingerprint-Attendance-Management-System-in-Laravel.git
   cd Fingerprint-Attendance-Management-System-in-Laravel
````

2. Install PHP dependencies:

   ```bash
   composer install
   ```

3. Install Node dependencies (if frontend exists):

   ```bash
   npm install
   npm run dev
   ```

---

## Configuration

1. Copy `.env.example` to `.env`:

   ```bash
   cp .env.example .env
   ```

2. Configure your database in `.env`:

   ```dotenv
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=attendance_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```

3. Set ZKTeco device IP and port in `app/Console/Commands/FetchAttendance.php`:

   ```php
   $deviceIp = '192.168.1.201'; // Change to your device IP
   $port = 4370; // Default port
   ```

---

## Database Setup

1. Create a database in MySQL:

   ```sql
   CREATE DATABASE attendance_db;
   ```

2. Run migrations:

   ```bash
   php artisan migrate
   ```

3. Seed default data (if needed):

   ```bash
   php artisan db:seed
   ```

---

## Running the Project

1. Start Laravel development server:

   ```bash
   php artisan serve
   ```
2. Open `http://127.0.0.1:8000` in your browser.

---

## Fetching Attendance

To fetch users and attendance logs manually:

```bash
php artisan attendance:fetch
```

It will:

* Sync users from the device to the database
* Store attendance logs in the `attendances` table

---

## Scheduling Attendance Fetch

To fetch attendance automatically every minute:

1. Open `app/Console/Kernel.php` and make sure the schedule is defined:

   ```php
   protected function schedule(Schedule $schedule)
   {
       $schedule->command('attendance:fetch')->everyMinute();
   }
   ```

2. Run the scheduler locally:

   ```bash
   php artisan schedule:work
   ```

3. On a server (cPanel):

   * Add a cron job to run every minute:

     ```bash
     * * * * * php /path-to-your-project/artisan schedule:run >> /dev/null 2>&1
     ```

---

## Git Push Guide

To push changes to GitHub:

1. Configure remote (only if not already done):

   ```bash
   git remote add origin https://github.com/Damodarkanal/Fingerprint-Attendance-Management-System-in-Laravel.git
   ```

2. Stage and commit changes:

   ```bash
   git add .
   git commit -m "Your commit message"
   ```

3. Push to GitHub:

   ```bash
   git push https://<YOUR_GITHUB_TOKEN>@github.com/Damodarkanal/Fingerprint-Attendance-Management-System-in-Laravel.git main
   ```

Replace `<YOUR_GITHUB_TOKEN>` with your **personal access token** from GitHub.

---

## CMD File for Git Push

You can create a `push_to_github.cmd` file in the project root:

```batch
@echo off
echo Staging all changes...
git add .

echo Committing changes...
set /p commitmsg="Enter commit message: "
git commit -m "%commitmsg%"

echo Pushing to GitHub...
set /p token="Enter your GitHub Personal Access Token: "
git push https://%token%@github.com/Damodarkanal/Fingerprint-Attendance-Management-System-in-Laravel.git main

echo Done!
pause
```

* Save it as `push_to_github.cmd`
* Run it whenever you want to push changes.

---

## Contributing

1. Fork the repository.
2. Create a new branch for your feature/fix.
3. Make changes and commit.
4. Push your branch to GitHub.
5. Create a Pull Request.

---

## Notes

* Make sure your ZKTeco device is on the same network as your computer/server.
* Attendance logs depend on device connectivity; ensure firewall or antivirus does not block UDP port `4370`.
* Users are identified by `device_user_id` from the ZKTeco device.
* For local testing, always run `php artisan schedule:work` to trigger the scheduled command automatically.

```

---


Do you want me to do that?
```

# Task Management System (Laravel)

A professional Task Management API built with Laravel 11 and MySQL, featuring a responsive dashboard for task operations.

## Live Deployment
URL: [https://robust-ambition-production-e14e.up.railway.app](https://robust-ambition-production-e14e.up.railway.app)

---

## Technical Features & Business Rules
The application enforces several core rules:
- Priority Sorting: Tasks are automatically ordered by priority (High -> Medium -> Low) and due date.
- Enforced Lifecycle: Tasks follow a strict lifecycle transition: pending -> in_progress -> done.
- Safety Locks: Only done tasks can be deleted to prevent accidental loss of active data.
- Data Integrity: Unique validation for task title and due date combination.

---

## Local Setup

### 1. Requirements
- PHP 8.2+
- Composer
- MySQL 8.0+

### 2. Installation
```bash
git clone https://github.com/SwiftTim/task.git task-manager
cd task-manager
composer install
cp .env.example .env
php artisan key:generate
```

### 3. Database Configuration
Open .env and configure your MySQL settings:
```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_db
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Initialization
```bash
php artisan migrate --seed
```

### 5. Run Locally
```bash
php artisan serve
```

---

## Deployment on Railway
1. Login to Railway and create a new project.
2. Provision a MySQL service.
3. Deploy from your GitHub repository.
4. Set the following environment variables:
   - APP_KEY
   - DB_CONNECTION: mysql
   - DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD
   - APP_ENV: production
   - APP_DEBUG: false

---

## Example API Requests

### Daily Report Summary
`GET /api/tasks/report?date=2026-03-31`

### Create Task
```bash
curl -X POST http://localhost:8000/api/tasks \
-H "Content-Type: application/json" \
-d '{"title":"Audit Report","due_date":"2026-04-12","priority":"high"}'
```

### Update Status
```bash
curl -X PATCH http://localhost:8000/api/tasks/1/status \
-H "Content-Type: application/json" \
-d '{"status": "in_progress"}'
```

### Delete Task
```bash
curl -X DELETE http://localhost:8000/api/tasks/1
```

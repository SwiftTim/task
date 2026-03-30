# Task Management Application

A professional Task Management API built with Laravel 11 and MySQL, featuring a responsive console for operational task tracking.

## Hosted Service
Application URL: [https://robust-ambition-production-e14e.up.railway.app](https://robust-ambition-production-e14e.up.railway.app)

---

## Technical Features & Rules
- Priority-Driven: Tasks are ordered by High -> Medium -> Low priority, and then by due date.
- Strict Workflow: Status follows a locked flow: pending -> in_progress -> done.
- Validation:
  - Title and Due Date must be unique together.
  - Priority must be one of: low, medium, high.
  - Due date must be today or future.
- Protection: Deletion is only permitted for tasks with a done status.
- Reporting: Daily summary engine providing counts by priority and status.

---

## Local Setup

### 1. Requirements
- PHP 8.2+
- Composer
- MySQL 8.0+

### 2. Installation
```bash
git clone https://github.com/SwiftTim/task.git task-app
cd task-app
composer install
cp .env.example .env
php artisan key:generate
```

### 3. Database Configuration
Open .env and configure your MySQL settings. Then choose one of the following to initialize:

**A. Using Migrations (Recommended)**
```bash
php artisan migrate --seed
```

**B. Using SQL Dump**
Import the included schema.sql into your database manager (MySQL/MariaDB).

### 4. Run Locally
```bash
php artisan serve
```

---

## Example API Endpoint Testing

### Daily Report Summary
`GET /api/tasks/report?date=2026-03-31`

### Add New Task
```bash
curl -X POST http://localhost:8000/api/tasks \
-H "Content-Type: application/json" \
-d '{"title":"Security Audit","due_date":"2026-04-10","priority":"high"}'
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
(Returns 200 on success, or 403 if status is not "done")

---

## Testing
To run automated tests or verify endpoints, follow the cURL examples or use tools like Postman.

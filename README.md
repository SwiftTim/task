# 🏗️ Cytonn Task Management System (Laravel)

A professional Task Management API built with **Laravel 11+** and **MySQL**, featuring a modern, secure operations dashboard. Designed to demonstrate clean code, strict business logic enforcement, and production-readiness.

## 🚀 Key Features & Business Rules
The application strictly enforces the following architectural and business constraints:
- **Prioritized Task Stream**: Tasks are automatically sorted by risk priority (High → Medium → Low) and then by due date ascending.
- **Enforced Lifecycle**: Tasks must follow a strict lifecycle transition: `pending` → `in_progress` → `done`. No skipping or reverting allowed.
- **Safety Locks**: Only `done` tasks can be deleted to prevent accidental loss of active data.
- **Unique Identification**: Duplicate tasks (same title and due date) are blocked at the validation layer.
- **Operational Analytics**: A built-in report engine providing daily summaries segmented by priority and status.

---

## 🛠️ Local Setup Instructions

### 1. Requirements
- PHP 8.2+
- Composer
- MySQL 8.0+
- Node.js & NPM (for frontend compilation if modified)

### 2. Installation
```bash
# Clone the repository
git clone https://github.com/SwiftTim/task.git cytonn-tasks
cd cytonn-tasks

# Install PHP dependencies
composer install

# Setup environment
cp .env.example .env
php artisan key:generate
```

### 3. Database Configuration
Open `.env` and configure your MySQL settings:
```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cytonn_tasks
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 4. Initialization
```bash
# Prepare database and seed demonstration data
php artisan migrate --seed
```

### 5. Run Locally
```bash
php artisan serve
```
Visit `http://localhost:8000` to access the Dashboard.

---

## 🌩️ Deployment Guide

### Option 1: Railway (Best for Laravel + MySQL)
1. **Login to Railway** and click **New Project**.
2. **Provision MySQL**: Click "Provision MySQL" to get your database credentials.
3. **Deploy from GitHub**: Connect your repo (`SwiftTim/task`).
4. **Environment Variables**: Add these in the Railway dashboard:
   - `APP_KEY`: Generate via `php artisan key:generate --show`
   - `DB_CONNECTION`: `mysql`
   - `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` (use values from the Provisioned MySQL tab).
   - `APP_ENV`: `production`
   - `APP_DEBUG`: `false`
5. **Launch**: Railway will build and deploy the application.

### Option 2: Render
1. Create a **MySQL Instance** (Render or external like PlanetScale).
2. Create a **Web Service** on Render connected to your repo.
3. **Build Command**: `composer install --no-dev && php artisan migrate --force`
4. **Start Command**: `php artisan serve --host=0.0.0.0 --port=$PORT`

---

## 📡 Example API Requests (cURL)

### 📊 Daily Report Summary
```bash
curl -X GET "http://localhost:8000/api/tasks/report?date=2026-03-31"
```

### ✨ Create Task
```bash
curl -X POST http://localhost:8000/api/tasks \
-H "Content-Type: application/json" \
-d '{"title":"Q2 Financial Audit","due_date":"2026-04-10","priority":"high"}'
```

### 🔄 Progressive State Update
```bash
curl -X PATCH http://localhost:8000/api/tasks/1/status \
-H "Content-Type: application/json" \
-d '{"status": "in_progress"}'
```

---

## ✅ Evaluation Checkpoint
- **Eloquent/Migrations**: Fully utilized for schema design and complex ordering queries.
- **Validation**: Title/Date uniqueness and status state transitions enforced in `TaskController`.
- **Maintainability**: Clean Controller/Api separation and semantic variable naming.
- **Frontend**: Modern, responsive SPA interface built with Blade and Vanilla JS.

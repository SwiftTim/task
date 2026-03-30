# Task Management Application

This is a Laravel-based Task Management API that handles task creation, listing, status updates, and reporting, with strict status flow and priority handling.

## Hosted Service
Application URL: https://robust-ambition-production-e14e.up.railway.app

## Features
- Task management (CRUD operations)
- Priority-based sorting (High -> Medium -> Low)
- Status lifecycle enforcement (Pending -> In Progress -> Done)
- Prevention of deleting incomplete tasks
- Daily status reports

## Local Installation

1. Install dependencies:
   ```bash
   composer install
   ```
2. Setup environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
3. Configure your local database in `.env`.
4. Run migrations and seed data:
   ```bash
   php artisan migrate --seed
   ```
5. Run the server:
   ```bash
   php artisan serve
   ```

## Deployment on Railway
The project is configured for deployment on Railway via GitHub.
1. Link your repo to a Railway project.
2. Add a MySQL service.
3. Configure enviroment variables: `APP_KEY`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`.
The `Procfile` handles the startup and automatic migration.

## API Examples

### List Tasks
`GET /api/tasks`

### Daily Report
`GET /api/tasks/report?date=2026-03-31`

### Add New Task
`POST /api/tasks`
```json
{
  "title": "Document audit",
  "due_date": "2026-04-10",
  "priority": "high"
}
```

### Update Status
`PATCH /api/tasks/{id}/status`
```json
{
  "status": "in_progress"
}
```

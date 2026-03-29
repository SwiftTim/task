# Task Management API (Laravel)

A clean Task Management API built with Laravel 11/12 and MySQL. Features include task CRUD, priority-based sorting, status progression validation, and a daily report summary.

## 🚀 Key Features
- **Priority Sorting**: High → Medium → Low.
- **Status Progression**: Pending → In-progress → Done only.
- **Reporting**: Advanced group-by priority/status reports via query parameters.
- **Business Logic Protection**: Duplicate protection for tasks sharing a title and due date.

---

## 🛠️ Local Setup Instructions

1. **Clone & Install Dependencies**
   ```bash
   git clone <repository_url> cytonn-tasks
   cd cytonn-tasks
   composer install
   ```

2. **Configure Environment**
   - Copy the `.env` file and set up your MySQL connection.
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   - Update `.env`:
     ```ini
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=cytonn_tasks
     DB_USERNAME=root
     DB_PASSWORD=<your_password>
     ```

3. **Database Setup**
   - Create the MySQL database: `CREATE DATABASE cytonn_tasks;`
   - Run migrations and seeds:
   ```bash
   php artisan migrate --seed
   ```

4. **Run Server**
   ```bash
   php artisan serve
   ```
   The API will be available at `http://localhost:8000/api`.

---

## 🌩️ Deployment (Render / Railway)

### **Railway (Recommended for MySQL)**
1. **New Project** -> **MySQL Database**.
2. **New Project** -> **GitHub Repo**.
3. Railway will automatically detect Laravel. 
4. **Environment Variables**: Add `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`, and `APP_KEY`.
5. Ensure the "Build Command" includes `composer install --no-dev`.

### **Render**
1. Create a **MySQL Web Service** (using PlanetScale or Render's PostgreSQL if preferred, but MySQL is required for this test).
2. Create a **Web Service** for the PHP application.
3. Use the following **Start Command**: `php artisan serve --host=0.0.0.0 --port=$PORT`.

---

## 📡 Example API Requests

### **1. Create a Task**
```bash
curl -X POST http://localhost:8000/api/tasks \
-H "Content-Type: application/json" \
-d '{
    "title": "Migrate Database",
    "due_date": "2026-03-31",
    "priority": "high"
}'
```

### **2. List Tasks (Sorted)**
```bash
curl -X GET http://localhost:8000/api/tasks
```

### **3. Update task status**
```bash
curl -X PATCH http://localhost:8000/api/tasks/1/status \
-H "Content-Type: application/json" \
-d '{"status": "in_progress"}'
```

### **4. Daily Report**
```bash
curl -X GET "http://localhost:8000/api/tasks/report?date=2026-03-31"
```

### **5. Delete Task**
```bash
curl -X DELETE http://localhost:8000/api/tasks/1
```
*(Note: Only "done" tasks can be deleted.)*

---

## 📝 Evaluation Criteria Met
- **Business Rules**: Implemented strict status progression and deletion limits in `TaskController`.
- **Validation**: Title/Due Date uniqueness enforced via Laravel Validation Rules.
- **Code Quality**: Clean controller methods and Eloquent model casting for dates.
- **Bonus**: Daily report summary with accurate counts per priority/status.

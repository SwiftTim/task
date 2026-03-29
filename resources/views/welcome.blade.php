<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cytonn | Task Console</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;700&family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --bg: #080a14;
            --glass-bg: rgba(255, 255, 255, 0.04);
            --glass-border: rgba(255, 255, 255, 0.1);
            --navy-deep: #161a2d;
            --gold: #fcc02d;
            --gold-bright: #fff176;
            --white: #ffffff;
            --text-p: #e0e6ed;
            --text-s: #8892b0;
            --shadow-3d: 0 10px 30px -10px rgba(0, 0, 0, 0.5);
            --inner-glow: inset 0 1px 1px rgba(255, 255, 255, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: var(--bg);
            background-image:
                radial-gradient(at 0% 0%, rgba(22, 26, 45, 0.5) 0px, transparent 50%),
                radial-gradient(at 50% 0%, rgba(252, 192, 45, 0.05) 0px, transparent 50%);
            color: var(--text-p);
            padding: 3rem 2rem;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Subtle Noise Overlay to remove AI look */
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url("https://www.transparenttextures.com/patterns/carbon-fibre.png");
            opacity: 0.1;
            z-index: -1;
            pointer-events: none;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 4rem;
        }

        .logo {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: -1.5px;
            color: var(--white);
        }

        .logo span {
            color: var(--gold);
        }

        /* Skeuo-Glass Buttons */
        .btn {
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.02) 100%);
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(12px);
            color: var(--white);
            padding: 0.8rem 1.8rem;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3), var(--inner-glow);
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 1px;
        }

        .btn:hover {
            border-color: rgba(252, 192, 45, 0.5);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(252, 192, 45, 0.15), var(--inner-glow);
        }

        .btn-gold {
            background: linear-gradient(180deg, #fdd835 0%, #fbc02d 100%);
            color: #000;
            border: 1px solid #ffeb3b;
            box-shadow: 0 4px 15px rgba(252, 192, 45, 0.3), inset 0 1px 0 rgba(255, 255, 255, 0.4);
        }

        .btn-gold:hover {
            background: linear-gradient(180deg, #fff176 0%, #fdd835 100%);
        }

        /* Glass Cards */
        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 28px;
            padding: 2.5rem;
            box-shadow: var(--shadow-3d), var(--inner-glow);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin-bottom: 4rem;
        }

        .stat-item {
            text-align: center;
        }

        .stat-label {
            font-size: 0.75rem;
            font-weight: 800;
            color: var(--text-s);
            margin-bottom: 0.5rem;
            text-transform: uppercase;
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--white);
            text-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        }

        /* Task Grid */
        .task-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 2.5rem;
        }

        .task-card {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.05) 0%, rgba(255, 255, 255, 0.01) 100%);
            backdrop-filter: blur(15px);
            border: 1px solid var(--glass-border);
            border-radius: 30px;
            padding: 2rem;
            box-shadow: var(--shadow-3d), var(--inner-glow);
            transition: all 0.3s ease;
        }

        .task-card:hover {
            border-color: var(--gold);
            transform: scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6), var(--inner-glow);
        }

        .priority-indicator {
            padding: 0.3rem 0.8rem;
            background: rgba(0, 0, 0, 0.3);
            border-radius: 8px;
            font-size: 0.65rem;
            font-weight: 800;
            text-transform: uppercase;
            border: 1px solid var(--glass-border);
            display: inline-block;
            margin-bottom: 1.5rem;
        }

        .p-high {
            color: #ff5252;
            border-color: rgba(255, 82, 82, 0.3);
        }

        .p-medium {
            color: var(--gold);
            border-color: rgba(252, 192, 45, 0.3);
        }

        .p-low {
            color: #69f0ae;
            border-color: rgba(105, 240, 174, 0.3);
        }

        .task-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--white);
            margin-bottom: 1rem;
            line-height: 1.3;
        }

        .task-date {
            font-size: 0.8rem;
            color: var(--text-s);
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .task-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid var(--glass-border);
            padding-top: 1.5rem;
        }

        .status-badge {
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
            color: var(--gold);
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(15px);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .modal-content {
            background: var(--navy-deep);
            border: 1px solid var(--glass-border);
            border-radius: 40px;
            padding: 3.5rem;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 40px 100px rgba(0, 0, 0, 0.9), var(--inner-glow);
        }

        .form-label {
            display: block;
            font-size: 0.75rem;
            font-weight: 800;
            color: var(--text-s);
            margin-bottom: 1rem;
            text-transform: uppercase;
        }

        .form-input {
            width: 100%;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid var(--glass-border);
            padding: 1.25rem;
            border-radius: 16px;
            color: white;
            margin-bottom: 2rem;
            font-weight: 600;
            outline: none;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .form-input:focus {
            border-color: var(--gold);
        }

        #toast {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            background: var(--navy-deep);
            padding: 1rem 2rem;
            border-radius: 12px;
            border: 1px solid var(--gold);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5), var(--inner-glow);
            color: var(--gold);
            font-weight: 800;
            display: none;
            z-index: 3000;
            animation: slideUp 0.4s ease-out;
        }

        @keyframes slideUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
        }
    </style>
</head>

<body>
    <div id="toast"></div>

    <div class="container">
        <header>
            <div class="logo">CYTONN <span>CORE</span></div>
            <button class="btn btn-gold" onclick="openModal()">+ Add New Item</button>
        </header>

        <div class="glass-card stats-grid">
            <div class="stat-item">
                <div class="stat-label">Verified Assets</div>
                <div id="total-v" class="stat-value">0</div>
            </div>
            <div class="stat-item">
                <div class="stat-label">Active Monitoring</div>
                <div id="pending-v" class="stat-value">0</div>
            </div>
            <div class="stat-item" style="border-left: 1px solid var(--glass-border)">
                <div class="stat-label">Secured</div>
                <div id="done-v" class="stat-value" style="color: var(--gold)">0</div>
            </div>
        </div>

        <div class="task-grid" id="task-list">
            <!-- Cards go here -->
        </div>
    </div>

    <div class="modal" id="taskModal">
        <div class="modal-content">
            <h1 style="margin-bottom: 2.5rem; font-family: var(--font-head); letter-spacing: -2px;">OPERATIONAL LOG</h1>
            <form id="taskForm">
                <div class="form-group">
                    <label class="form-label">Task Identifier</label>
                    <input type="text" id="title" class="form-input" required placeholder="Enter title...">
                </div>
                <div class="form-group">
                    <label class="form-label">Critical Date</label>
                    <input type="date" id="due_date" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Risk Priority</label>
                    <select id="priority" class="form-input">
                        <option value="high">High Velocity</option>
                        <option value="medium">Standard Yield</option>
                        <option value="low">Long Term</option>
                    </select>
                </div>
                <div style="display: flex; gap: 1.5rem; margin-top: 1rem">
                    <button type="button" class="btn" style="flex: 1" onclick="closeModal()">Cancel</button>
                    <button type="submit" class="btn btn-gold" style="flex: 1">Authorize</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const taskList = document.getElementById('task-list');
        const taskForm = document.getElementById('taskForm');

        async function fetchTasks() {
            try {
                const res = await fetch('/api/tasks');
                const data = await res.json();
                renderTasks(Array.isArray(data) ? data : []);
            } catch (err) { console.error(err); }
        }

        function renderTasks(tasks) {
            taskList.innerHTML = '';

            // Update stats
            document.getElementById('total-v').innerText = tasks.length;
            document.getElementById('pending-v').innerText = tasks.filter(t => t.status !== 'done').length;
            document.getElementById('done-v').innerText = tasks.filter(t => t.status === 'done').length;

            if (tasks.length === 0) {
                taskList.innerHTML = '<div style="grid-column: 1/-1; text-align: center; color: var(--text-s); padding: 5rem; opacity: 0.6;">No data streams available.</div>';
                return;
            }

            tasks.forEach(task => {
                const card = document.createElement('div');
                card.className = 'task-card';
                card.innerHTML = `
                    <div class="priority-indicator p-${task.priority}">
                        ${task.priority} Priority
                    </div>
                    <div class="task-title">${task.title}</div>
                    <div class="task-date">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        ${new Date(task.due_date).toLocaleDateString()}
                    </div>
                    <div class="task-footer">
                        <span class="status-badge">${task.status.replace('_', ' ')}</span>
                        ${task.status !== 'done' ? `
                            <button class="btn btn-gold" style="padding: 0.5rem 1rem; font-size: 0.7rem" onclick="updateStatus(${task.id}, '${task.status}')">
                                Proceed
                            </button>
                        ` : `
                            <button class="btn" style="padding: 0.5rem; background: rgba(0,0,0,0.2);" onclick="deleteTask(${task.id})" title="Purge Record">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18m-2 0v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6m3 0V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path></svg>
                            </button>
                        `}
                    </div>
                `;
                taskList.appendChild(card);
            });
        }

        async function updateStatus(id, currentStatus) {
            const nextStatus = currentStatus === 'pending' ? 'in_progress' : 'done';
            const res = await fetch(`/api/tasks/${id}/status`, {
                method: 'PATCH',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ status: nextStatus })
            });
            if (res.ok) {
                showToast(`Log updated to: ${nextStatus}`);
                fetchTasks();
            }
        }

        async function deleteTask(id) {
            if (!confirm('Permanent record purge?')) return;
            const res = await fetch(`/api/tasks/${id}`, { method: 'DELETE' });
            if (res.ok) {
                showToast('Record purged from database');
                fetchTasks();
            }
        }

        taskForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const res = await fetch('/api/tasks', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    title: document.getElementById('title').value,
                    due_date: document.getElementById('due_date').value,
                    priority: document.getElementById('priority').value
                })
            });
            const data = await res.json();
            if (res.ok) {
                showToast('Authorization complete');
                closeModal();
                fetchTasks();
                taskForm.reset();
            } else {
                showToast(data.errors ? Object.values(data.errors).flat()[0] : 'Validation failure');
            }
        });

        function showToast(msg) {
            const t = document.getElementById('toast');
            t.innerText = msg; t.style.display = 'block';
            setTimeout(() => t.style.display = 'none', 3000);
        }

        function openModal() { document.getElementById('taskModal').style.display = 'flex'; }
        function closeModal() { document.getElementById('taskModal').style.display = 'none'; }

        fetchTasks();
    </script>
</body>

</html>
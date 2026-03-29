<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cytonn | Task Management</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --navy: #0d1b2e;
            --navy-mid: #162236;
            --navy-light: #1e3050;
            --navy-border: #263d5c;
            --gold: #c9972c;
            --gold-light: #e4b44a;
            --gold-pale: #f5e6c4;
            --white: #ffffff;
            --text-primary: #e8edf4;
            --text-secondary: #8fa3be;
            --text-muted: #4d6480;
            --danger: #e05252;
            --success: #3aaa6f;
            --warning: #e08a2a;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--navy);
            color: var(--text-primary);
            min-height: 100vh;
        }

        /* ── TOPBAR ── */
        .topbar {
            background: var(--navy-mid);
            border-bottom: 1px solid var(--navy-border);
            padding: 0 2rem;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-mark {
            width: 36px;
            height: 36px;
            background: var(--gold);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 15px;
            color: var(--navy);
            letter-spacing: -0.5px;
            flex-shrink: 0;
        }

        .logo-text {
            font-size: 17px;
            font-weight: 600;
            color: var(--white);
            letter-spacing: 0.3px;
        }

        .logo-sub {
            font-size: 11px;
            color: var(--text-secondary);
            font-weight: 400;
            margin-top: 1px;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .badge-date {
            font-size: 12px;
            color: var(--text-secondary);
        }

        .btn-primary {
            background: var(--gold);
            color: var(--navy);
            border: none;
            padding: 0 20px;
            height: 36px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: background 0.15s;
            font-family: 'Inter', sans-serif;
        }

        .btn-primary:hover { background: var(--gold-light); }

        /* ── MAIN LAYOUT ── */
        .page {
            max-width: 1280px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* ── PAGE HEADER ── */
        .page-header {
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 22px;
            font-weight: 600;
            color: var(--white);
        }

        .page-subtitle {
            font-size: 13px;
            color: var(--text-secondary);
            margin-top: 4px;
        }

        /* ── STATS ROW ── */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--navy-mid);
            border: 1px solid var(--navy-border);
            border-radius: 10px;
            padding: 1.25rem 1.5rem;
        }

        .stat-label {
            font-size: 11px;
            font-weight: 500;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 600;
            color: var(--white);
            line-height: 1;
        }

        .stat-gold { color: var(--gold-light); }

        .stat-card-accent {
            border-left: 3px solid var(--gold);
        }

        /* ── CONTROLS ── */
        .controls {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .filter-group {
            display: flex;
            gap: 4px;
            background: var(--navy-mid);
            border: 1px solid var(--navy-border);
            border-radius: 8px;
            padding: 4px;
        }

        .filter-btn {
            background: none;
            border: none;
            color: var(--text-secondary);
            padding: 6px 14px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            transition: all 0.12s;
        }

        .filter-btn.active {
            background: var(--navy-light);
            color: var(--white);
        }

        .filter-btn:hover:not(.active) { color: var(--text-primary); }

        /* ── TASK TABLE ── */
        .table-wrap {
            background: var(--navy-mid);
            border: 1px solid var(--navy-border);
            border-radius: 10px;
            overflow: hidden;
        }

        .table-header-row {
            display: grid;
            grid-template-columns: 3fr 1fr 1fr 1fr 120px;
            padding: 0 1.5rem;
            height: 42px;
            align-items: center;
            border-bottom: 1px solid var(--navy-border);
            background: rgba(255,255,255,0.02);
        }

        .th {
            font-size: 11px;
            font-weight: 500;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.7px;
        }

        .task-row {
            display: grid;
            grid-template-columns: 3fr 1fr 1fr 1fr 120px;
            padding: 0 1.5rem;
            height: 60px;
            align-items: center;
            border-bottom: 1px solid rgba(38,61,92,0.5);
            transition: background 0.1s;
        }

        .task-row:last-child { border-bottom: none; }
        .task-row:hover { background: rgba(255,255,255,0.025); }

        .task-title-cell {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            font-weight: 500;
            color: var(--text-primary);
            min-width: 0;
        }

        .task-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .dot-high   { background: var(--danger); }
        .dot-medium { background: var(--gold); }
        .dot-low    { background: var(--success); }

        .task-title-text {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .cell {
            font-size: 13px;
            color: var(--text-secondary);
        }

        /* Priority pill */
        .priority-pill {
            display: inline-flex;
            align-items: center;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .pill-high   { background: rgba(224,82,82,0.12);  color: #f08080; border: 1px solid rgba(224,82,82,0.2);  }
        .pill-medium { background: rgba(201,151,44,0.12); color: #e4b44a; border: 1px solid rgba(201,151,44,0.2); }
        .pill-low    { background: rgba(58,170,111,0.12); color: #5cc991; border: 1px solid rgba(58,170,111,0.2); }

        /* Status pill */
        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 500;
        }

        .status-pending    { background: rgba(78,107,153,0.2);  color: #7a9cc4; border: 1px solid rgba(78,107,153,0.3); }
        .status-in_progress{ background: rgba(201,151,44,0.12); color: #e4b44a; border: 1px solid rgba(201,151,44,0.2); }
        .status-done       { background: rgba(58,170,111,0.12); color: #5cc991; border: 1px solid rgba(58,170,111,0.2); }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        /* Action buttons in row */
        .row-actions {
            display: flex;
            gap: 6px;
            align-items: center;
        }

        .btn-sm {
            height: 30px;
            padding: 0 12px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            border: none;
            font-family: 'Inter', sans-serif;
            transition: all 0.12s;
        }

        .btn-advance {
            background: var(--gold);
            color: var(--navy);
        }

        .btn-advance:hover { background: var(--gold-light); }

        .btn-delete {
            background: rgba(224,82,82,0.1);
            color: #f08080;
            border: 1px solid rgba(224,82,82,0.2);
        }

        .btn-delete:hover { background: rgba(224,82,82,0.2); }

        .btn-disabled {
            background: rgba(255,255,255,0.04);
            color: var(--text-muted);
            cursor: default;
        }

        /* ── EMPTY STATE ── */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-icon {
            width: 48px;
            height: 48px;
            background: var(--navy-light);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
        }

        .empty-icon svg { opacity: 0.4; }

        .empty-title {
            font-size: 15px;
            font-weight: 500;
            color: var(--text-secondary);
        }

        .empty-sub {
            font-size: 13px;
            color: var(--text-muted);
            margin-top: 4px;
        }

        /* ── MODAL ── */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(5, 12, 22, 0.85);
            z-index: 500;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .modal-box {
            background: var(--navy-mid);
            border: 1px solid var(--navy-border);
            border-radius: 14px;
            padding: 2rem;
            width: 100%;
            max-width: 480px;
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .modal-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--white);
        }

        .modal-close {
            background: none;
            border: none;
            color: var(--text-secondary);
            cursor: pointer;
            padding: 4px;
            line-height: 1;
            font-size: 20px;
        }

        .modal-close:hover { color: var(--white); }

        .gold-bar {
            height: 3px;
            background: var(--gold);
            border-radius: 2px;
            margin-bottom: 1.5rem;
            width: 40px;
        }

        .form-group { margin-bottom: 1.25rem; }

        .form-label {
            display: block;
            font-size: 12px;
            font-weight: 500;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.6px;
            margin-bottom: 8px;
        }

        .form-input, .form-select {
            width: 100%;
            background: var(--navy);
            border: 1px solid var(--navy-border);
            border-radius: 7px;
            padding: 10px 14px;
            color: var(--text-primary);
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            outline: none;
            transition: border-color 0.15s;
        }

        .form-input:focus, .form-select:focus {
            border-color: var(--gold);
        }

        .form-select option { background: var(--navy-mid); }

        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 1.75rem;
        }

        .btn-cancel {
            flex: 1;
            height: 40px;
            background: none;
            border: 1px solid var(--navy-border);
            color: var(--text-secondary);
            border-radius: 7px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            transition: all 0.12s;
        }

        .btn-cancel:hover { color: var(--white); border-color: var(--text-muted); }

        .btn-submit {
            flex: 2;
            height: 40px;
            background: var(--gold);
            border: none;
            color: var(--navy);
            border-radius: 7px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            transition: background 0.15s;
        }

        .btn-submit:hover { background: var(--gold-light); }

        /* ── TOAST ── */
        #toast {
            position: fixed;
            bottom: 1.5rem;
            right: 1.5rem;
            background: var(--navy-mid);
            border: 1px solid var(--gold);
            border-left: 3px solid var(--gold);
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 13px;
            font-weight: 500;
            color: var(--gold-light);
            display: none;
            z-index: 9999;
            min-width: 220px;
        }

        .toast-error {
            border-color: var(--danger) !important;
            color: #f08080 !important;
        }

        /* ── DIVIDER ── */
        .section-divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 1rem;
        }

        .divider-label {
            font-size: 11px;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.8px;
            white-space: nowrap;
        }

        .divider-line {
            flex: 1;
            height: 1px;
            background: var(--navy-border);
        }

        /* ── FOOTER ── */
        .footer {
            margin-top: 3rem;
            padding: 1.5rem 0 0;
            border-top: 1px solid var(--navy-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .footer-brand {
            font-size: 12px;
            color: var(--text-muted);
        }

        .footer-brand span { color: var(--gold); }

        @media (max-width: 900px) {
            .stats-row { grid-template-columns: repeat(2, 1fr); }
            .table-header-row, .task-row {
                grid-template-columns: 2fr 1fr 1fr;
            }
            .th:nth-child(4), .th:nth-child(5),
            .cell:nth-child(4), .row-actions { display: none; }
        }
    </style>
</head>
<body>

<div id="toast"></div>

<!-- ── TOPBAR ── -->
<div class="topbar">
    <div class="logo">
        <div class="logo-mark">C</div>
        <div>
            <div class="logo-text">Cytonn Investments</div>
            <div class="logo-sub">Task Management System</div>
        </div>
    </div>
    <div class="topbar-right">
        <span class="badge-date" id="today-date"></span>
        <button class="btn-primary" onclick="openModal()">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            New Task
        </button>
    </div>
</div>

<!-- ── PAGE ── -->
<div class="page">

    <!-- Header -->
    <div class="page-header">
        <div class="page-title">Operations Dashboard</div>
        <div class="page-subtitle">Monitor and manage your team's task pipeline</div>
    </div>

    <!-- Stats -->
    <div class="stats-row">
        <div class="stat-card stat-card-accent">
            <div class="stat-label">Total Tasks</div>
            <div class="stat-value" id="stat-total">—</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Pending</div>
            <div class="stat-value" id="stat-pending">—</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">In Progress</div>
            <div class="stat-value stat-gold" id="stat-inprogress">—</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Completed</div>
            <div class="stat-value" style="color: #5cc991" id="stat-done">—</div>
        </div>
    </div>

    <!-- Controls -->
    <div class="controls">
        <div class="filter-group">
            <button class="filter-btn active" onclick="setFilter('all', this)">All</button>
            <button class="filter-btn" onclick="setFilter('pending', this)">Pending</button>
            <button class="filter-btn" onclick="setFilter('in_progress', this)">In Progress</button>
            <button class="filter-btn" onclick="setFilter('done', this)">Done</button>
        </div>
    </div>

    <!-- Table -->
    <div class="table-wrap">
        <div class="table-header-row">
            <div class="th">Task</div>
            <div class="th">Priority</div>
            <div class="th">Due Date</div>
            <div class="th">Status</div>
            <div class="th">Actions</div>
        </div>
        <div id="task-list">
            <!-- rows injected here -->
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <div class="footer-brand"><span>Cytonn</span> Investments &mdash; Internal Platform &copy; 2026</div>
    </div>

</div>

<!-- ── CREATE TASK MODAL ── -->
<div class="modal-overlay" id="taskModal">
    <div class="modal-box">
        <div class="modal-header">
            <div class="modal-title">Create New Task</div>
            <button class="modal-close" onclick="closeModal()">&times;</button>
        </div>
        <div class="gold-bar"></div>
        <form id="taskForm" onsubmit="submitTask(event)">
            <div class="form-group">
                <label class="form-label">Task Title</label>
                <input type="text" id="f-title" class="form-input" placeholder="e.g. Prepare Q2 Investment Report" required>
            </div>
            <div class="form-group">
                <label class="form-label">Due Date</label>
                <input type="date" id="f-due" class="form-input" required>
            </div>
            <div class="form-group">
                <label class="form-label">Priority Level</label>
                <select id="f-priority" class="form-select">
                    <option value="high">High</option>
                    <option value="medium" selected>Medium</option>
                    <option value="low">Low</option>
                </select>
            </div>
            <div class="form-actions">
                <button type="button" class="btn-cancel" onclick="closeModal()">Cancel</button>
                <button type="submit" class="btn-submit">Create Task</button>
            </div>
        </form>
    </div>
</div>

<script>
    let allTasks = [];
    let activeFilter = 'all';

    // Set today's date in header
    document.getElementById('today-date').textContent =
        new Date().toLocaleDateString('en-KE', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });

    // Set default date to today in modal
    document.getElementById('f-due').min = new Date().toISOString().split('T')[0];
    document.getElementById('f-due').value = new Date().toISOString().split('T')[0];

    async function fetchTasks() {
        try {
            const res = await fetch('/api/tasks');
            const data = await res.json();
            allTasks = Array.isArray(data) ? data : [];
            renderAll();
        } catch (e) {
            console.error(e);
        }
    }

    function renderAll() {
        updateStats();
        renderRows();
    }

    function updateStats() {
        document.getElementById('stat-total').textContent     = allTasks.length;
        document.getElementById('stat-pending').textContent   = allTasks.filter(t => t.status === 'pending').length;
        document.getElementById('stat-inprogress').textContent= allTasks.filter(t => t.status === 'in_progress').length;
        document.getElementById('stat-done').textContent      = allTasks.filter(t => t.status === 'done').length;
    }

    function renderRows() {
        const list = document.getElementById('task-list');
        const filtered = activeFilter === 'all' ? allTasks : allTasks.filter(t => t.status === activeFilter);

        if (filtered.length === 0) {
            list.innerHTML = `
                <div class="empty-state">
                    <div class="empty-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#8fa3be" stroke-width="1.5" stroke-linecap="round">
                            <rect x="3" y="3" width="18" height="18" rx="3"/><line x1="9" y1="9" x2="15" y2="9"/><line x1="9" y1="13" x2="13" y2="13"/>
                        </svg>
                    </div>
                    <div class="empty-title">No tasks found</div>
                    <div class="empty-sub">Create a new task to get started</div>
                </div>`;
            return;
        }

        list.innerHTML = filtered.map(task => {
            const dateStr = new Date(task.due_date).toLocaleDateString('en-KE', { day: '2-digit', month: 'short', year: 'numeric' });
            const statusLabel = task.status.replace('_', ' ').replace(/\b\w/g, c => c.toUpperCase());

            let actionBtn = '';
            if (task.status === 'pending') {
                actionBtn = `<button class="btn-sm btn-advance" onclick="advance(${task.id}, 'pending')">Start</button>`;
            } else if (task.status === 'in_progress') {
                actionBtn = `<button class="btn-sm btn-advance" onclick="advance(${task.id}, 'in_progress')">Complete</button>`;
            } else {
                actionBtn = `<button class="btn-sm btn-delete" onclick="deleteTask(${task.id})">Delete</button>`;
            }

            return `
            <div class="task-row">
                <div class="task-title-cell">
                    <div class="task-dot dot-${task.priority}"></div>
                    <span class="task-title-text">${escHtml(task.title)}</span>
                </div>
                <div class="cell">
                    <span class="priority-pill pill-${task.priority}">${task.priority}</span>
                </div>
                <div class="cell">${dateStr}</div>
                <div class="cell">
                    <span class="status-pill status-${task.status}">
                        <span class="status-dot"></span>
                        ${statusLabel}
                    </span>
                </div>
                <div class="row-actions">${actionBtn}</div>
            </div>`;
        }).join('');
    }

    function setFilter(f, el) {
        activeFilter = f;
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        el.classList.add('active');
        renderRows();
    }

    async function advance(id, current) {
        const next = current === 'pending' ? 'in_progress' : 'done';
        const res = await fetch(`/api/tasks/${id}/status`, {
            method: 'PATCH',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ status: next })
        });
        if (res.ok) {
            toast(`Task moved to ${next.replace('_', ' ')}`);
            fetchTasks();
        }
    }

    async function deleteTask(id) {
        if (!confirm('Delete this completed task?')) return;
        const res = await fetch(`/api/tasks/${id}`, { method: 'DELETE' });
        if (res.ok) {
            toast('Task deleted');
            fetchTasks();
        }
    }

    async function submitTask(e) {
        e.preventDefault();
        const res = await fetch('/api/tasks', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                title: document.getElementById('f-title').value,
                due_date: document.getElementById('f-due').value,
                priority: document.getElementById('f-priority').value
            })
        });
        const data = await res.json();
        if (res.ok) {
            toast('Task created successfully');
            closeModal();
            document.getElementById('taskForm').reset();
            document.getElementById('f-due').value = new Date().toISOString().split('T')[0];
            fetchTasks();
        } else {
            const msg = data.errors ? Object.values(data.errors).flat()[0] : 'Validation error';
            toast(msg, true);
        }
    }

    function openModal()  { document.getElementById('taskModal').style.display = 'flex'; }
    function closeModal() { document.getElementById('taskModal').style.display = 'none'; }

    // Close modal on overlay click
    document.getElementById('taskModal').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });

    function toast(msg, isError = false) {
        const t = document.getElementById('toast');
        t.textContent = msg;
        t.className = isError ? 'toast-error' : '';
        t.style.display = 'block';
        setTimeout(() => t.style.display = 'none', 3000);
    }

    function escHtml(s) {
        return s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
    }

    fetchTasks();
</script>
</body>
</html>
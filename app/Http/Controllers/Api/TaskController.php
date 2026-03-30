<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    /**
     * List tasks.
     * Optional status query parameter.
     */
    public function index(Request $request)
    {
        $query = Task::query();

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $tasks = $query->orderByRaw("CASE priority 
                        WHEN 'high' THEN 1 
                        WHEN 'medium' THEN 2 
                        WHEN 'low' THEN 3 END")
            ->orderBy('due_date', 'asc')
            ->get();

        if ($tasks->isEmpty()) {
            return response()->json(['message' => 'No tasks found matching your criteria.'], 200);
        }

        return response()->json($tasks);
    }

    /**
     * Create a new task in the system.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tasks')->where(fn($query) => $query->where('due_date', $request->due_date))
            ],
            'due_date' => 'required|date|after_or_equal:today',
            'priority' => 'required|in:low,medium,high',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $task = Task::create([
            'title' => $request->title,
            'due_date' => $request->due_date,
            'priority' => $request->priority,
            'status' => 'pending'
        ]);

        return response()->json($task, 201);
    }

    /**
     * Update existing task status.
     */
    public function updateStatus(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $newStatus = $request->status;
        $currentStatus = $task->status;

        $validProgress = [
            'pending' => ['in_progress'],
            'in_progress' => ['done'],
            'done' => []
        ];

        if (!isset($validProgress[$currentStatus]) || !in_array($newStatus, $validProgress[$currentStatus])) {
            return response()->json([
                'error' => "Invalid status transition from {$currentStatus} to {$newStatus}. Transitions must follow: pending -> in_progress -> done."
            ], 422);
        }

        $task->update(['status' => $newStatus]);

        return response()->json($task);
    }

    /**
     * Delete existing task.
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);

        if ($task->status !== 'done') {
            return response()->json(['error' => 'Only tasks with status "done" can be deleted.'], 403);
        }

        $task->delete();

        return response()->json(['message' => 'Task deleted successfully.'], 200);
    }

    /**
     * Daily task report engine.
     */
    public function report(Request $request)
    {
        $date = $request->query('date') ?? Carbon::today()->toDateString();

        $tasks = Task::whereDate('due_date', $date)->get();

        $summary = [
            'high' => ['pending' => 0, 'in_progress' => 0, 'done' => 0],
            'medium' => ['pending' => 0, 'in_progress' => 0, 'done' => 0],
            'low' => ['pending' => 0, 'in_progress' => 0, 'done' => 0]
        ];

        foreach ($tasks as $task) {
            if (isset($summary[$task->priority][$task->status])) {
                $summary[$task->priority][$task->status]++;
            }
        }

        return response()->json([
            'date' => $date,
            'summary' => $summary
        ]);
    }
}

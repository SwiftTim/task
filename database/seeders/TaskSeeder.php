<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use Carbon\Carbon;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::create([
            'title' => 'Complete Project Documentation',
            'due_date' => Carbon::now()->addDays(2),
            'priority' => 'high',
            'status' => 'pending'
        ]);

        Task::create([
            'title' => 'Code Review for Phase 1',
            'due_date' => Carbon::now()->addDay(),
            'priority' => 'medium',
            'status' => 'in_progress'
        ]);

        Task::create([
            'title' => 'Submit Timesheets',
            'due_date' => Carbon::today(),
            'priority' => 'low',
            'status' => 'done'
        ]);

        Task::create([
            'title' => 'Sprint Planning',
            'due_date' => Carbon::now()->addDays(5),
            'priority' => 'high',
            'status' => 'pending'
        ]);
    }
}

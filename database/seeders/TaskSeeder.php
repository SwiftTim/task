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
        // Use updateOrCreate to avoid duplicates and allow re-deployment
        Task::updateOrCreate(
            ['title' => 'Project Documentation'],
            [
                'due_date' => Carbon::today()->addDays(5)->toDateString(),
                'priority' => 'high',
                'status' => 'pending'
            ]
        );

        Task::updateOrCreate(
            ['title' => 'Code Review Phase 1'],
            [
                'due_date' => Carbon::today()->addDays(2)->toDateString(),
                'priority' => 'medium',
                'status' => 'in_progress'
            ]
        );

        Task::updateOrCreate(
            ['title' => 'Submit Timesheets'],
            [
                'due_date' => Carbon::today()->toDateString(),
                'priority' => 'low',
                'status' => 'done'
            ]
        );

        Task::updateOrCreate(
            ['title' => 'Client Sprint Meeting'],
            [
                'due_date' => Carbon::today()->addDays(7)->toDateString(),
                'priority' => 'high',
                'status' => 'pending'
            ]
        );
    }
}

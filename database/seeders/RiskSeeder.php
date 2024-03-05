<?php

namespace Database\Seeders;

use App\Models\Risk;
use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RiskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tasks = Task::all();
        foreach ($tasks as $task) {
            Risk::factory(5)->create(['task_id' => $task->id]);
        }
    }
}

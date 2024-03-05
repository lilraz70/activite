<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $activities = Activity::all();
        foreach ($activities as $activity) {
            Task::factory(5)->create(['activity_id' => $activity->id]);
        }
    }
}

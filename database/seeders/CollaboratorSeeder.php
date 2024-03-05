<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Collaborator;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CollaboratorSeeder extends Seeder
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
        Collaborator::factory(5)->create(['activity_id' => $activity->id]);
        }
    }
}

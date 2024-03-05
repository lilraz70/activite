<?php

namespace Database\Seeders;

use App\Models\Risk;
use App\Models\Measure;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MeasureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $risks = Risk::all();
        foreach ($risks as $risk) {
            Measure::factory(5)->create(['risk_id' => $risk->id]);
        }
    }
}

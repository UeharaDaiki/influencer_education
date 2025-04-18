<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DeliveryTime;
use Illuminate\Support\Facades\DB;

class DeliveryTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('curriculums')->truncate();
        DeliveryTime::factory()->count(20)->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\HealthStatus;
use Illuminate\Database\Seeder;
use File;
use Illuminate\Support\Facades\DB;

class HealthStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $value = File::get("database/jsons/health_statuses.json");

        $data = json_decode($value);

        foreach ($data as $status){
            if (!isset(DB::table('health_statuses')->where('name',$status->Name)->pluck('id')[0])) {
                HealthStatus::create([
                    'name'=>$status->Name
                ]);
            }
        }
    }
}

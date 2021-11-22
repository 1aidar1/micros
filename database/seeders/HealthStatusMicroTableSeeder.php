<?php

namespace Database\Seeders;

use App\Models\HealthStatusMicro;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use File;

class HealthStatusMicroTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $value = File::get("database/jsons/health_status_micro.json");

        $data = json_decode($value);

        foreach ($data as $d){
            HealthStatusMicro::create([
                'health_status_id'=> DB::table('health_statuses')->where('name',$d->HealthStatusName)->pluck('id')[0],
                'micronutrient_id'=>DB::table('micronutrients')->where('name',$d->MicroName)->pluck('id')[0],
                'usage_id'=>DB::table('usages')->where('code',$d->Usage)->pluck('id')[0],
                'comment'=>$d->Comments,
                'links'=>('')
            ]);
        }
    }
}

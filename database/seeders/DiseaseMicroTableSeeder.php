<?php

namespace Database\Seeders;

use App\Models\Disease;
use App\Models\DiseaseMicro;
use Illuminate\Database\Seeder;
use File;
use Illuminate\Support\Facades\DB;

class DiseaseMicroTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $value = File::get("database/jsons/disease_micro.json");

        $data = json_decode($value);

        foreach ($data as $d){
            DiseaseMicro::create([
                'disease_id'=> DB::table('diseases')->where('name',$d->DiseaseName)->pluck('id')[0],
                'micronutrient_id'=>DB::table('micronutrients')->where('name',$d->MicroName)->pluck('id')[0],
                'efficiency_id'=>DB::table('efficiencies')->where('code',$d->EfficiencyCode)->pluck('id')[0],
                'comment'=>$d->Comments,
                'links'=>($d->Links)
            ]);
        }
    }
}

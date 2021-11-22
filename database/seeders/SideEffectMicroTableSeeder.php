<?php

namespace Database\Seeders;

use App\Models\SideEffectMicro;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use File;

class SideEffectMicroTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $value = File::get("database/jsons/side_effect_micro.json");

        $data = json_decode($value);

        foreach ($data as $d){
            SideEffectMicro::create([
                'side_effect_id'=> DB::table('side_effects')->where('name',$d->SideEffectName)->pluck('id')[0],
                'micronutrient_id'=>DB::table('micronutrients')->where('name',$d->MicroName)->pluck('id')[0],
                'comment'=>$d->Comments,
                'links'=>($d->Links)
            ]);
        }
    }
}

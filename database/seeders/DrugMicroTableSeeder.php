<?php

namespace Database\Seeders;

use App\Models\DrugMicro;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use File;

class DrugMicroTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $value = File::get("database/jsons/drug_micro.json");

        $data = json_decode($value);

        foreach ($data as $d){
            DrugMicro::create([
                'drug_id'=> DB::table('drugs')->where('name',$d->DrugName)->pluck('id')[0],
                'micronutrient_id'=>DB::table('micronutrients')->where('name',$d->MicroName)->pluck('id')[0],
                'power_id'=>DB::table('powers')->where('code',$d->Power)->pluck('id')[0],
                'comment'=>$d->Comments,
                'links'=>($d->Links)
            ]);
        }
    }
}

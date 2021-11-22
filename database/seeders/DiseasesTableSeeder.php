<?php

namespace Database\Seeders;

use App\Models\Disease;
use Illuminate\Database\Seeder;
use File;
use Illuminate\Support\Facades\DB;

class DiseasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $value = File::get("database/jsons/diseases.json");

        $data = json_decode($value);

        foreach ($data as $drug){
            if (!isset(DB::table('diseases')->where('name',$drug->Name)->pluck('id')[0])){
                Disease::create([
                    'name'=>$drug->Name
                ]);
            }
        }
    }
}

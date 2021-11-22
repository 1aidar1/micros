<?php

namespace Database\Seeders;

use App\Models\Drug;
use Illuminate\Database\Seeder;
use File;
use Illuminate\Support\Facades\DB;

class DrugTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $value = File::get("database/jsons/drugs.json");

        $data = json_decode($value);

        foreach ($data as $drug){
            if (!isset(DB::table('drugs')->where('name',$drug->Name)->pluck('id')[0])){
                Drug::create([
                    'name'=>$drug->Name,
                    'details'=>$drug->Description
                ]);
            }
        }
    }
}

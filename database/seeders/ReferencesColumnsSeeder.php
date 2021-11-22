<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use File;
use Illuminate\Support\Facades\DB;
use League\CommonMark\Reference\Reference;

class ReferencesColumnsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $path = "./database/jsons/references/";
        $files = array_diff(scandir($path), array('.', '..'));

        $micros = DB::table('micronutrients')->pluck('id','name');
        foreach ($files as $file){
            $value = File::get($path.$file);
            $data = json_decode($value);
            foreach ($data as $ref){
                DB::table('references')->updateOrInsert([
                    'micronutrient_id'=>$micros[$ref->Micro],
                    'reference_code'=>$ref->Id,
                    'head'=> $ref->Head,
                    'body'=> $ref->Body
                ]);
            }
        }
    }
}

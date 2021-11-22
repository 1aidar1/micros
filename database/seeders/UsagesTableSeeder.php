<?php

namespace Database\Seeders;

use App\Models\Usage;
use Illuminate\Database\Seeder;
use File;

class UsagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $value = File::get("database/jsons/usage.json");

        $data = json_decode($value);

        foreach ($data as $e){
            Usage::create([
                'code'=>$e->UsageCode,
                'description'=>$e->Description
            ]);
        }
    }
}

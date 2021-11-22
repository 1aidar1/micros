<?php

namespace Database\Seeders;

use App\Models\Efficiency;
use Illuminate\Database\Seeder;
use File;

class EfficiencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $value = File::get("database/jsons/efficiency.json");

        $data = json_decode($value);

        foreach ($data as $e){
            Efficiency::create([
                'code'=>$e->EfficiencyCode,
                'description'=>$e->Description,
                'color'=>$e->Color
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Power;
use Illuminate\Database\Seeder;
use File;

class PowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $value = File::get("database/jsons/power.json");

        $data = json_decode($value);

        foreach ($data as $e){
            Power::create([
                'code'=>$e->PowerCode,
                'description'=>$e->Description,
                'color'=>$e->Color,
            ]);
        }
    }
}

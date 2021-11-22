<?php

namespace Database\Seeders;

use App\Models\Micronutrient;
use Illuminate\Database\Seeder;
use File;

class MicronutrientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $value = File::get("database/jsons/micronutrients.json");

        $data = json_decode($value);


        foreach ($data as $e){
            $desc = File::get("database/htmls/".$e->Name.".html");
            if (isset($e->IsVitamin)){
                Micronutrient::create([
                    'name'=>$e->Name,
                    'description_html'=> $desc,
                    'is_vitamin' => $e->IsVitamin
                ]);
            }
            else{
                Micronutrient::create([
                    'name'=>$e->Name,
                    'description_html'=> $desc
                ]);
            }

        }
    }
}

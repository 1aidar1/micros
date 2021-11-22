<?php

namespace Database\Seeders;

use App\Models\Micronutrient;
use App\Models\Reference;
use Illuminate\Database\Seeder;

class UpdateHtmlDescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $micros = Micronutrient::all();
        foreach ($micros as $micro){
            $refs = Reference::where('micronutrient_id',$micro->id)->get();
            foreach ($refs as $ref){
                if (str_contains($micro->description_html,'['.$ref->reference_code.']')){
                    $micro->description_html = str_replace('['.$ref->reference_code.']',"<span class='reference-code'>[".$ref->reference_code."]</span>",$micro->description_html);
                }
                $micro->save();
            }
        }
    }
}

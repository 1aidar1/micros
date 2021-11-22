<?php

namespace Database\Seeders;

use App\Models\SideEffect;
use Illuminate\Database\Seeder;
use File;
use Illuminate\Support\Facades\DB;

class SideEffectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $value = File::get("database/jsons/side_effects.json");

        $data = json_decode($value);


        foreach ($data as $effect){
            if (!isset(DB::table('side_effects')->where('name',$effect->Name)->pluck('id')[0])) {
                SideEffect::create([
                    'name'=>$effect->Name
                ]);
            }
        }
    }
}

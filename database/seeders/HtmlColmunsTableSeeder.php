<?php

namespace Database\Seeders;

use File;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HtmlColmunsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {

        $path = "./database/jsons/links/";
        $files = array_diff(scandir($path), array('.', '..'));
//
//        $calcium = File::get("database/jsons/links/calcium.json");
//        $iodine = File::get("database/jsons/links/iodine.json");
//        $magnesium = File::get("database/jsons/links/magnesium.json");
//        $vit_a = File::get("database/jsons/links/vitamin_a.json");
//        $vit_k = File::get("database/jsons/links/vitamin_k.json");
//        $potassium = File::get("database/jsons/links/potassium.json");
//        $zinc = File::get("database/jsons/links/zinc.json");
//        $sodium = File::get("database/jsons/links/sodium.json");
//        $vit_c = File::get("database/jsons/links/vitamin_c.json");
//        $phosphorus = File::get("database/jsons/links/phosphorus.json");
//
//        $data_ca = json_decode($calcium);
//        $data_io = json_decode($iodine);
//        $data_ma = json_decode($magnesium);
//        $data_vit_a = json_decode(($vit_a));
//        $data_vit_k = json_decode($vit_k);
//        $data_zinc = json_decode($zinc);
//        $data_potassium = json_decode($potassium);
//        $data_sodium = json_decode($sodium);
//        $data_vit_c = json_decode($vit_c);
//        $data_phosphorus = json_decode($phosphorus);
//
//        $data = [$data_ca,$data_io,$data_ma,$data_vit_a,$data_vit_k,$data_zinc,$data_potassium,$data_vit_c,$data_sodium,$data_phosphorus];

        foreach ($files as $file){
            $value = File::get($path.$file);
            $data = json_decode($value);
            foreach ($data as $value){
                $this->microHtmlName('diseases',$value);
                $this->microHtmlName('side_effects',$value);
                $this->microHtmlName('drugs',$value);
                $this->microHtmlName('health_statuses',$value);

                $this->commentsHtml('disease_micros',$value);
                $this->commentsHtml('side_effect_micros',$value);
                $this->commentsHtml('drug_micros',$value);
                $this->commentsHtml('health_status_micros',$value);

            }
        }
    }

    private  function commentsHtml($table,$value){
        $name = DB::table($table)->where('comment',$value->PlainText)->pluck('id');
//        if (!isset($name[0]))
//            echo $value->PlainText . " ADJACENT NOT FOUND!!!\n";
        foreach ($name as $id){
//            echo $id .  " ". $value->HtmlText. " \n";
            DB::table($table)->where('id',$id)->update([
                'comment_html'=>$value->HtmlText
            ]);
        }
    }

    private function microHtmlName($table,$value){
        $name = DB::table($table)->where('name',$value->PlainText)->pluck('id');
//        if (!isset($name[0]))
//            echo $value->PlainText . " MAIN NOT FOUND!!!\n";
        foreach ($name as $id){
//            echo $id .  " ". $value->HtmlText. " \n";
            DB::table($table)->where('id',$id)->update([
                'name_html'=>$value->HtmlText
            ]);
        }
    }
}

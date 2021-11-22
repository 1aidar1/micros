<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reference extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['micronutrient_id','reference_code','head','body'];

    public static function referenceByLink($micro_id,$links){
        $links = json_decode($links);
        foreach ($links as $link){
            echo $link."\n";
        }
    }
}

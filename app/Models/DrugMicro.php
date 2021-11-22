<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DrugMicro extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['drug_id','micronutrient_id','comment','comment_html','links','power_id'];

}

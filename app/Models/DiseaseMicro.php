<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiseaseMicro extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['disease_id','micronutrient_id','comment','comment_html','links','efficiency_id'];

}

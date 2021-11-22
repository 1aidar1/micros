<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Micronutrient extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name','name_html','is_vitamin','description_html'];

}

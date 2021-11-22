<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Efficiency extends Model
{
    use HasFactory;
    use SoftDeletes;



    protected $fillable = ['code','description'];

    public function disease(){
        return $this->belongsTo(DiseaseMicro::class);
    }

}

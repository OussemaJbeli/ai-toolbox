<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Tool_sub_categorie extends Model
{

    use HasFactory;
    use SoftDeletes;
    use HasApiTokens;

    public function sub_categorie()
    {
        return $this->belongsTo(Sub_categorie::class);
    }
    public function tool()
    {
        return $this->hasMany(Tool::class);
    }

}

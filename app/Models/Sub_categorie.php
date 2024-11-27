<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Sub_categorie extends Model
{

    use HasFactory;
    use SoftDeletes;
    use HasApiTokens;

    public function tool()
    {
        return $this->hasMany(Tool::class);
    }
    public function favorite_sub_categorie()
    {
        return $this->hasMany(Favorite_sub_categorie::class);
    }
    public function custom_categorie()
    {
        return $this->belongsTo(Custom_categorie::class);
    }
}

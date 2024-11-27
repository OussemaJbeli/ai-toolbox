<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Original_categorie extends Model
{

    use HasFactory;
    use SoftDeletes;
    use HasApiTokens;

    public function tool()
    {
        return $this->hasMany(Tool::class);
    }
    public function sub_categorie()
    {
        return $this->hasMany(Sub_categorie::class);
    }
    public function favorite_categorie()
    {
        return $this->hasMany(Favorite_original_categorie::class);
    }
}

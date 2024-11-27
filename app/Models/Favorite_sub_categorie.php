<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Favorite_sub_categorie extends Model
{

    use HasFactory;
    use SoftDeletes;
    use HasApiTokens;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function sub_tools_categorie()
    {
        return $this->belongsTo(Sub_categorie::class);
    }

}

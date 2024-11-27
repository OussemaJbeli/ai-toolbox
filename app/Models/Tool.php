<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Tool extends Model
{

    use HasFactory;
    use SoftDeletes;
    use HasApiTokens;

    public function favorite_tool()
    {
        return $this->hasMany(Favorite_tool::class);
    }
    public function tool_custom_categorie()
    {
        return $this->hasMany(Tool_custom_categorie::class);
    }
    public function tool_original_categorie()
    {
        return $this->hasMany(Tool_original_categorie::class);
    }
    public function tool_sub_categorie()
    {
        return $this->hasMany(Tool_sub_categorie::class);
    }
    public function tools_data()
    {
        return $this->hasMany(Tools_data::class);
    }
    public function tools_conversation()
    {
        return $this->hasMany(Tools_conversation::class);
    }
    public function tools_feild_custom()
    {
        return $this->hasMany(Tools_feild_custom::class);
    }

}

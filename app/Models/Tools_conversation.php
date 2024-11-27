<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Tools_conversation extends Model
{

    use HasFactory;
    use SoftDeletes;
    use HasApiTokens;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tool()
    {
        return $this->belongsTo(Tool::class);
    }

    public function tools_conversation_data(){
        return $this->hasMany(Tools_conversation_data::class);
    }

}

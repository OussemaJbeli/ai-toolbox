<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Tools_conversation_data extends Model
{

    use HasFactory;
    use SoftDeletes;
    use HasApiTokens;

    public function tools_conversation()
    {
        return $this->belongsTo(Tools_conversation::class);
    }

}

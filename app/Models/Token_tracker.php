<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Token_tracker extends Model
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
    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

}

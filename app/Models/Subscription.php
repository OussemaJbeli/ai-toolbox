<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Subscription extends Model
{

    use HasFactory;
    use SoftDeletes;
    use HasApiTokens;

    public function token_tracker()
    {
        return $this->hasMany(Token_tracker::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

}

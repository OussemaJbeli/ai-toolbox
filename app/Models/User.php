<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function tools_data()
    {
        return $this->hasMany(Tools_data::class);
    }
    public function tools_conversation()
    {
        return $this->hasMany(Tools_conversation::class);
    }

    public function blog()
    {
        return $this->hasMany(Blog::class);
    }
    public function custom_categorie()
    {
        return $this->hasMany(Custom_categorie::class);
    }
    public function favorite_original_categorie()
    {
        return $this->hasMany(Favorite_original_categorie::class);
    }
    public function favorite_sub_categorie()
    {
        return $this->hasMany(Favorite_sub_categorie::class);
    }
    public function favorite_tool()
    {
        return $this->hasMany(Favorite_tool::class);
    }
    public function recent_tool()
    {
        return $this->hasMany(Recent_tool::class);
    }
    public function subscription()
    {
        return $this->hasMany(Subscription::class);
    }
    public function token_tracker()
    {
        return $this->hasMany(Token_tracker::class);
    }
    public function tools_feild_custom()
    {
        return $this->hasMany(Tools_feild_custom::class);
    }


}

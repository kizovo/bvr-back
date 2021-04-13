<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Auth;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeIsFound($query, $email) {
        $user = $query->where('email', $email)->first();
        return ($user) ? true : false;
    }

    public function scopeRegister($query, $input) {
        $input['password'] = bcrypt($input['password']);
        $user = $query->create($input);
        return [
            'user' => $user,
            'token' => $user->createToken('authToken')->accessToken
        ];
    }

    public function scopeAuthUserDetail() {
        $user = Auth::guard('web')->user();
        return [
            'user' => $user,
            'token' => $user->createToken('authToken')->accessToken
        ];
    }
}

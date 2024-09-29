<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\User as AuthenticatableUser;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class User extends AuthenticatableUser implements AuthenticatableContract
{
    use HasFactory, Authenticatable;

    protected $fillable = [
        'username', 
        'email', 
        'password', 
        'role',
        'uuid'
    ];

    // Hidden fields
    protected $hidden = ['password', 'remember_token'];

    // Set UUID saat membuat user baru
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = Str::uuid();
            }
        });
    }
}

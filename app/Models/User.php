<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;

    static function getGender(){
        return [
            self::GENDER_MALE => 'Мужской',
            self::GENDER_MALE => 'Женский',
        ];
    }
    public function getGenderTitleAttribute(){
        return self::getGender()[$this->gender];
    }



    protected $guarded = false;
//    protected $fillable = [
//        'name',
//        'email',
//        'password',
//    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}

<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'patronymic', 'email'
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

    //User roles
    const ROLE_ADMIN = 1;
    const ROLE_MODERATOR = 10;
    const ROLE_DEPARTMENT_DIRECTORY = 20;
    const ROLE_COMMISSION_DIRECTORY = 30;
    const ROLE_USER = 50;

    //Relations
    public function department(){
        $this->belongsTo(Department::class);
    }

    public function commission(){
        $this->belongsTo(Commission::class);
    }

    //Helper methods
    public function getRoleString(){
        switch ($this->role){
            case self::ROLE_ADMIN:
                return 'Адміністратор';

            case self::ROLE_MODERATOR:
                return 'Модератор';

            case self::ROLE_DEPARTMENT_DIRECTORY:
                return 'Голова відділення';

            case self::ROLE_COMMISSION_DIRECTORY:
                return 'Голова циклової комісії';

            case self::ROLE_USER:
                return 'Користувач';
        }
    }

    public function getFullName(){
        return $this->name . ' ' . $this->surname . ' ' . $this->patronymic;
    }
}

<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'patronymic', 'email', 'birthday'
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
        return $this->belongsTo(Department::class);
    }

    public function commission(){
        return $this->belongsTo(Commission::class);
    }

    //accessors
    public function setBirthdayAttribute($date){
        if(!$date)
            $this->attributes['birthday'] = null;
        else{
            $formattedDate = Carbon::createFromFormat('m/d/Y', $date)->format('Y-m-d');
            $this->attributes['birthday'] = $formattedDate;
        }
    }

    public function getBirthdayAttribute(){
        if(!$this->attributes['birthday'])
            return null;

        $formattedDate = Carbon::createFromFormat('Y-m-d', $this->attributes['birthday'])->format('m/d/Y');
        return $formattedDate;
    }

    //Helper methods
    public function getBirthdayString(){
        if($this->birthday)
            return $this->birthday;
        else
            return 'Не установлено';
    }

    public function setDepartment($department){
        $this->department_id = $department;
        $this->save();
    }

    public function getDepartmentID(){
        if($this->department)
            return $this->department->id;
    }

    public function getDepartmentName(){
        if($this->department)
            return $this->department->name;
        else
            return 'Не установлено';
    }

    public function setCommission($commission){
        $this->commission_id = $commission;
        $this->save();
    }

    public function getCommissionID(){
        if($this->commission)
            return $this->commission->id;
    }

    public function getCommissionName(){
        if($this->commission)
            return $this->commission->name;
        else
            return 'Не установлено';
    }

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
        return $this->surname . ' ' . $this->name . ' ' . $this->patronymic;
    }

    public function getShortName(){
        return $this->surname . ' ' . substr($this->name, 0, 1);
    }

    public  function uploadAvatar($image){
        if(!$image)
            return;

        $this->deleteAvatar();

        //generate new name
        $newFileName = Str::random(10) . '.' . $image->extension();

        $image->storeAs('public', $newFileName);
        $this->avatar = $newFileName;
        $this->save();
    }

    public function deleteAvatar(){
        if($this->avatar)
            \Storage::delete('public/' . $this->avatar);

        $this->avatar = null;
        $this->save();
    }

    public function getAvatar(){
        if($this->avatar)
            return '/storage/' . $this->avatar;
        else
            return '/img/default-50x50.gif';
    }

    public function remove(){
        $this->deleteAvatar();

        $this->delete();
    }

    //generate secret values
    public function generatePassword($password){
        if($password){
            $this->password = bcrypt($password);
            $this->save();
        }
    }

    public function cryptPassport($passport){
        if(!$passport)
            return;

        $this->passport = encrypt($passport);
        $this->save();
    }

    public function cryptCode($code){
        if(!$code)
            return;

        $this->code = encrypt($code);
        $this->save();
    }
}

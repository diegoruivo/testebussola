<?php

namespace TesteBussola;

use TesteBussola\Support\Cropper;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'genre',
        'date_of_birth',
        'cell',
        'cover',
        'admin',
        'student',
        'group'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function group()
    {
        return $this->belongsTo(Group::class, 'group', 'id');
    }


    /**
    Ao editar qualquer campo do usuário, a senha também é alterada impossibilitando efetuar um novo login.
    Solução: Se o input for vazio, remove a posição da atualização com o unset.
     */
    public function setPasswordAttribute($value)
    {
        if (empty($value)) {
            unset($this->attributes['password']);
            return;
        }

        $this->attributes['password'] = bcrypt($value);
    }

    public function setDateOfBirthAttribute($value)
    {
        $this->attributes['date_of_birth'] = $this->convertStringToDate($value);
    }

    public function getDateOfBirthAttribute($value)
    {
        if ((!empty($value)) and ($value != '0000-00-00')) {
            return date('d/m/Y', strtotime($value));
        }
        if (empty($value)) {
            return "";
        }
    }

    public function getUrlCoverAttribute()
    {
        if (!empty($this->cover)){
            return Storage::url(Cropper::thumb($this->cover, 500, 500));
        }
        return url('backend/assets/images/avatar.jpg');

    }


    public function setAdminAttribute($value)
    {
        $this->attributes['admin'] = ($value === true || $value === 'on' ? 1 : 0);
    }

    public function setStudentAttribute($value)
    {
        $this->attributes['student'] = ($value === true || $value === 'on' ? 1 : 0);
    }



    private function convertStringToDate(?string $param)
    {
        if (empty($param)) {
            return '';
        }

        list($day, $month, $year) = explode('/', $param);
        return (new \DateTime($year . '-' . $month . '-' . $day))->format('Y-m-d');
    }


}

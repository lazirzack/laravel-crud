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
        'name', 'email', 'password','role'
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

    public function getSiswaData()
    {
        $siswadata = Siswa::where('user_id',auth()->user()->id)->get();
        return $siswadata;
    }
    
    public function getUserAvatar()
    {   
        // dd($this->getSiswaData());

        if($this->getSiswaData()->count()>0){
            $avatar = $this->getSiswaData()[0]->avatar;
            // dd($avatar);
            if(!$avatar){
                return asset('images/default.jpg');
            }
            return asset('images/'.$avatar);
        }
        return asset('images/default.jpg');
    }


}

<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use stdClass;

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
        $user_id=auth()->user()->id;
        $siswadata = Siswa::where('user_id',$user_id)->get();
        if ($siswadata->count()>0) {
            return $siswadata[0];
        }
        $arr=new stdClass();
        $arr->id=0; 
        $arr->user_id=$user_id; 
        $arr->nama_depan='';
        $arr->nama_belakang='';
        $arr->jenis_kelamin='';
        $arr->agama='';
        $arr->alamat='';
        $arr->avatar='';
        $arr->created_at='';
        $arr->updated_at='';

        return $arr;
    }
    
    public function getUserAvatar()
    {   
        //  dd($this->getSiswaData());

        if($this->getSiswaData()->id>0){
            $avatar = $this->getSiswaData()->avatar;
            // dd($avatar);
            if(!$avatar){
                return asset('images/default.jpg');
            }
            return asset('images/'.$avatar);
        }
        return asset('images/default.jpg');
    }


}

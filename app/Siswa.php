<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Model
{
    use SoftDeletes;
    protected $table='siswa';
    protected $fillable=['nama_depan','nama_belakang','jenis_kelamin','agama','alamat','avatar','user_id'];

    public function getAvatar()
    {
        if(!$this->avatar){
            return asset('images/default.jpg');
        }

        return asset('images/'.$this->avatar);
    }

    /* public function user()
    {
        return $this->belongsTo(User::class);
    } */

    public function mapel()
    {
        return $this->belongsToMany(Mapel::class)->withPivot(['nilai']);
    }
}

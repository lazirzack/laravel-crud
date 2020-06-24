<?php

use App\User;
use App\Siswa;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   //php artisan db::seed --class=DatabaseSeeder
        // https://github.com/lazirzack/Faker

        $faker=Faker\Factory::create('id_ID');
        for ($i=0; $i < 100; $i++) {  
            
            $nama_depan=$faker->firstName();
            $nama_email=STR::lower($nama_depan);

            $user= new \App\User;
            $user->role='siswa';
            $user->name=$nama_email;
            $user->email= $nama_email.$faker->shuffle('1234567890').'@gmail.com';
            $user->password=bcrypt('12345678');
            $user->remember_token=Str::random(60);
            $user->save();

            Siswa::insert([
                'user_id'=>$user->id,
                'nama_depan'=>$nama_depan,
                'nama_belakang'=>$faker->lastName,
                'agama' =>$faker->randomElement($array=array('Islam','Kristen','Hindu','Budha','Konghucu','Katolik')),
                'jenis_kelamin'=>$faker->randomElement($jk=array('L','P')),
                'alamat'=>'Alamat '.$nama_depan
            ]);
        }
    }
}

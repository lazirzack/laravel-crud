<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        $data['siswa']=\App\Siswa::all();
        $data['mapel']=\App\Mapel::all();
        $data['user']=\App\User::all();
        $data['nilai']=\App\Mapel_siswa::all();

        return view('dashboards.index',$data);
    }
    
}

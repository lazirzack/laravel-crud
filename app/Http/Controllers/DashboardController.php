<?php

namespace App\Http\Controllers;

use App\User;
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
    public function trashUser()
	{
		return User::onlyTrashed()->get();
	}
}

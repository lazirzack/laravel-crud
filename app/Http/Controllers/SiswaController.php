<?php

namespace App\Http\Controllers;

use App\Siswa;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    function index(Request $request){

		if($request->has('cari')){
			$data_siswa=\App\Siswa::where('nama_depan','LIKE','%'.$request->cari.'%')->get();	
		}else{
			$data_siswa=\App\Siswa::all();
		}        

        return view('siswa.index',['data_siswa'=>$data_siswa]);
    }

    public function create(Request $request)
    {	

		//insert ke tabel user
		$user= new \App\User;
		$user->role='siswa';
		$user->name=$request->nama_depan;
		$user->email=$request->email;
		$user->password=bcrypt('12345678');
		$user->remember_token=Str::random(60);
		$user->save();

		$request->validate([
			'nama_depan'=>'required|max:255',
			'nama_belakang'=>'required|max:255',
			'jenis_kelamin'=>'required',
			'alamat'=>'required',
			'agama'=>'required',
			'email'=>'required|max:255|email:rfc,dns',
			// 'notelp'=>'required|max:15'
		]);

		//insert ke tabel siswa
		$mydata=new Siswa([
			'nama_depan'=>$request->input('nama_depan'),
			'nama_belakang'=>$request->input('nama_belakang'),
			'jenis_kelamin'=>$request->input('jenis_kelamin'),
			'alamat'=>$request->input('alamat'),
			'agama'=>$request->input('agama'),
			'email'=>$request->input('email'),
			'user_id'=>$user->id
		]);
		$mydata->save();
		


		


		return redirect('/siswa')->with('success','Data berhasil disimpan');
	}

	public function edit($id)
    {
        $siswa= Siswa::find($id);
		return view('siswa.edit',compact('siswa'));
    }

	public function update(Request $request, $id)
    {	
		$mydata= Siswa::find($id);
		
		$request->validate([
			'nama_depan'=>'required|max:255',
			'nama_belakang'=>'required|max:255',
			'jenis_kelamin'=>'required',
			'alamat'=>'required',
			'agama'=>'required'
			//'email'=>'required|max:255|email:rfc,dns',
			// 'notelp'=>'required|max:15'
		]);
		
		/* $mydata->nama_depan=$request->input('nama_depan');
		$mydata->nama_belakang=$request->input('nama_belakang');
		$mydata->alamat=$request->input('alamat');
		$mydata->jenis_kelamin=$request->input('jenis_kelamin');
		$mydata->agama=$request->input('agama');
		$mydata->alamat=$request->input('alamat');
		$mydata->save(); */
		$mydata->update($request->all());
		
		if($request->hasFile('avatar')){
			$request->file('avatar')->move('images/',$request->file('avatar')->getClientOriginalName());
			$mydata->avatar=$request->file('avatar')->getClientOriginalName();
			$mydata->save();
		}

		return redirect('/siswa')->with('success','Data berhasil di-update');
    }

	public function destroy($id)
    {
       $mydata= Siswa::find($id);
	   $mydata->delete();
	   return redirect('/siswa')->with('success','Data berhasil di-hapus');
	}
	
	public function delete($id)
    {
       $mydata= Siswa::find($id);
	   $mydata->delete();
	   return redirect('/siswa')->with('success','Data berhasil di-hapus');
	}
	
	public function profil($id)
	{
		$siswa = \App\Siswa::find($id);
		return view('siswa.profile',['siswa' => $siswa]);
	}


}

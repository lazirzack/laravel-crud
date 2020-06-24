<?php

namespace App\Http\Controllers;

use App\User;
use App\Siswa;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    function index(Request $request){

		if($request->has('cari')){
			$data_siswa=\App\Siswa::where('nama_depan','LIKE','%'.$request->cari.'%')
			->orWhere('nama_belakang','LIKE','%'.$request->cari.'%')
			->orderBy('nama_depan','asc')
			->paginate(5);
			$data_siswa->appends(['cari' => $request->cari]);
		}else{ 
			$data_siswa=\App\Siswa::orderBy('nama_depan','asc')->paginate(5);
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
		if($request->hasFile('avatar')){
			$request->file('avatar')->move('images/',$request->file('avatar')->getClientOriginalName());
			$mydata->avatar=$request->file('avatar')->getClientOriginalName();
			
		} 
		
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
		$user_id=$mydata->user_id;
		if ($user_id>0) {
			$users=User::destroy($user_id);
			if ($users) {
				Siswa::destroy($id);
			}
		}
	//    $mydata->delete();
	   return redirect('/siswa')->with('success','Data berhasil di-hapus');
	}
	
	public function profil($id)
	{
		$siswa = \App\Siswa::find($id);
		$user = \App\User::find($siswa->user_id);
		$siswa->email='-';
		if(isset($user->email)){
			$siswa->email=$user->email;
		}
		return view('siswa.profile',['siswa' => $siswa]);
	}

	public function getDataFilter(Request $request)
	{
		//Start with creating your object, which will be used to query the database
		$filters=$request;
		$queryUser = Siswa::query();

		//Add sorting

		$queryUser->orderBy('nama_depan','asc');

		//Add Conditions

		if(!is_null($filters['type'])) {
			$queryUser->where('type','=',$filters['type']);
		}

		if(!is_null($filters['state_id'])) {
			$queryUser->whereHas('profile',function($q) use ($filters){
				return $q->where('state_id','=',$filters['state_id']);
			});
		}

		if(!is_null($filters['city_id'])) {
			$queryUser->whereHas('profile',function($q) use ($filters){
				return $q->where('city_id','=',$filters['city_id']);
			});
		}

		//Fetch list of results

		$result = $queryUser->paginate(20);
	}

	public function trashSiswa()
	{
		return Siswa::onlyTrashed()->get();
	}
}

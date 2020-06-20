@extends('layout.master')
@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="panel panel-headline">
                <div class="panel-heading">
                    <h3 class="panel-title">Edit data siswa <a href="/siswa/{{$siswa->id}}/profil"><b>{{$siswa->nama_depan.' '.$siswa->nama_belakang}}</b></a> </h3>
                    {{-- <p class="panel-subtitle">TA: 2020 - 2021</p> --}}
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="md-12">
                            <div class="panel"> 
                                <div class="panel-body">
                                    @if(session('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{session('success')}}
                                    </div>
                                    @endif
                                    {{-- <form action='{{ url("/siswa/{$siswa->id}") }}' method="POST"> --}}
                                    <form action='/siswa/{{$siswa->id}}' method="POST" enctype="multipart/form-data">
                                        @method('PATCH')
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nama Depan</label>
                                            <input type="text" class="form-control" name="nama_depan"
                                                id="exampleInputEmail1" aria-describedby="emailHelp"
                                                placeholder="Nama Depan"
                                                value="{{old('nama_depan',$siswa->nama_depan)}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nama Belakang</label>
                                            <input type="text" class="form-control" name="nama_belakang"
                                                id="exampleInputEmail1" aria-describedby="emailHelp"
                                                placeholder="Nama Belakang"
                                                value="{{old('nama_belakang',$siswa->nama_belakang)}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Jenis Kelamin</label>
                                            {{-- <select class="form-control" id="exampleFormControlSelect1" name="jenis_kelamin">
                                            <option value='L' @if ($siswa->jenis_kelamin=='L') selected @endif>Laki-laki
                                            </option>
                                            <option value='P' @if ($siswa->jenis_kelamin=='P') selected @endif>Perempuan
                                            </option>
                                        </select> --}}

                                            <label class="fancy-radio">
                                                <input name="jenis_kelamin" value="L" type="radio"
                                                    {{ ($siswa->jenis_kelamin=="L")? "checked" : "" }}>
                                                <span><i></i>Laki-laki</span>
                                            </label>
                                            <label class="fancy-radio">
                                                <input name="jenis_kelamin" value="P" type="radio"
                                                    {{ ($siswa->jenis_kelamin=="P")? "checked" : "" }}>
                                                <span><i></i>Perempuan</span>
                                            </label>


                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Agama</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" placeholder="Agama" name="agama"
                                                value="{{old('agama',$siswa->agama)}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Alamat</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                                name="alamat">{{old('alamat',$siswa->alamat)}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Avatar</label>
                                            <input type="file" name="avatar" class="form-control">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <button type="reset" class="btn btn-warning">Reset</button>
                                        <a href='{{url("/siswa")}}' class="btn btn-secondary">Cancel</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

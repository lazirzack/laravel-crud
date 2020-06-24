@extends('layout.master')
@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="panel panel-headline">
                <div class="panel-heading">
                    <h3 class="panel-title">Data Siswa</h3>
                    <p class="panel-subtitle">TA: 2020 - 2021</p>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form method="GET" action="/siswa">

                                <div class="input-group">
                                    <input class="form-control" name='cari' value="{{ request()->get('cari') }}" type="text"
                                        placeholder="Pencarian Data Siswa...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="submit">Cari</button>
                                    </span>

                                </div>

                            </form>
                        </div>
                        <div class="col-md-6">
                            <div class="right">
                                <!-- Button trigger modal -->
                                <a href="/siswa" class="btn btn-warning" title="Refresh data"><i
                                        class="fa fa-refresh"></i></a>
                                <a class="btn btn-success" data-toggle="modal" data-target="#siswaModal"><i
                                        class="fa fa-plus" title="Tambah data siswa"></i></a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="md-12">
                            <div class="panel">
                                <div class="panel-body">
                                    @if(session('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{session('success')}}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @endif
                                    <div class="panel-body">
                                        <table class="table table-hover">
                                            <tr>
                                                <th>NAMA DEPAN</th>
                                                <th>NAMA BELAKANG</th>
                                                <th style="text-align: center">JENIS KELAMIN</th>
                                                <th>AGAMA</th>
                                                <th>ALAMAT</th>
                                                <th style="text-align: center">AKSI</th>
                                            </tr>
                                            @foreach ($data_siswa as $siswa)
                                            <tr>
                                                <td><a href="/siswa/{{$siswa->id}}/profil">{{$siswa->nama_depan}}</a>
                                                </td>
                                                <td>{{$siswa->nama_belakang}}</td>
                                                <td align="center">{{$siswa->jenis_kelamin}}</td>
                                                <td>{{$siswa->agama}}</td>
                                                <td>{{$siswa->alamat}}</td>
                                                <td align="center">
                                                    <a class="btn btn-primary btn-sm"
                                                        href='{{ url("siswa/{$siswa->id}/edit") }}'>Edit</a>
                                                    <a class="btn btn-danger btn-sm"
                                                        href='{{ url("siswa/{$siswa->id}/delete") }}'
                                                        onclick="return confirm('Hapus data?')">Delete</a>

                                                    {{-- <form action='{{ url("siswa/{$siswa->id}") }}' method="post"
                                                    onsubmit="confirm('Hapus data?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                    </form> --}}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </table>
                                        {{ $data_siswa->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="siswaModal" tabindex="-1" role="dialog" aria-labelledby="siswaModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="siswaModalLabel">Form Data Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/siswa/create" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Depan</label>
                        <input type="text" class="form-control" autofocus name="nama_depan" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Nama Depan">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Belakang</label>
                        <input type="text" class="form-control" name="nama_belakang" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Nama Belakang">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Jenis Kelamin</label>
                        {{-- <select class="form-control" id="exampleFormControlSelect1" name="jenis_kelamin">
                            <option value='L'>Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select> --}}
                        <label class="fancy-radio">
                            <input name="jenis_kelamin" value="L" type="radio" checked>
                            <span><i></i>Laki-laki</span>
                        </label>
                        <label class="fancy-radio">
                            <input name="jenis_kelamin" value="P" type="radio">
                            <span><i></i>Perempuan</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Agama</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Agama" name="agama">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Alamat</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                            name="alamat"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Avatar</label>
                        <input type="file" name="avatar" class="form-control">
                    </div>
                    {{-- <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="form-group form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div> --}}

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

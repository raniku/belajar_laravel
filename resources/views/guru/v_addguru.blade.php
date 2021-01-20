@extends('layout.v_template')
@section('title','Add Guru')

@section('content')

<div class="card card-info card-outline">
    <div class="card-header">
        <h3>Tambah Data Siswa</h3>
    </div>

    <div class="card-body">
    
        <form action="/insert/guru" method="post" enctype="multipart/form-data">
        @csrf
    
        <div class="form-group">
            <input placeholder="ID Guru" name="id_guru" class="form-control" value="{{ old('id_guru') }}">
            <div class="text-danger">
                @error('id_guru') 
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form-group">
            <input placeholder="Nama Guru" name="nama_guru" class="form-control" value="{{ old('nama_guru') }}">
            <div class="text-danger">
                @error('nama_guru') 
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form-group">
            <input placeholder="No Telephone" name="no_telp" class="form-control" value="{{ old('no_telp') }}">
            <div class="text-danger">
                @error('no_telp') 
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form-group">
            <input placeholder="Tempat Lahir" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir') }}">
            <div class="text-danger">
                @error('tempat_lahir') 
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form-group">
            <input type="date" placeholder="Tanggal Lahir" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}">
            <div class="text-danger">
                @error('tanggal_lahir') 
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form-group">
            <textarea placeholder="Alamat" name="alamat" class="form-control">{{ old('alamat') }}</textarea>
            <div class="text-danger">
                @error('alamat') 
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form-group">
            <input placeholder="Pendidikan" name="pendidikan" class="form-control" value="{{ old('pendidikan') }}">
            <div class="text-danger">
                @error('pendidikan') 
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form-group">
            <input placeholder="Foto Guru" type="file" name="foto_guru" class="form-control" value="{{ old('foto_guru') }}">
            <div class="text-danger">
                @error('foto_guru') 
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form-group">
            <button class="btn btn-primary btn-sm">Simpan</button>
        </div>
       
        </form>
    </div> 
</div>       

@endsection
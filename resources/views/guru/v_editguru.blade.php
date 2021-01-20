@extends('layout.v_template')
@section('title','Guru')

@section('content')

<div class="card card-info card-outline">
    <div class="card-header">
        <h3>Edit Data Guru</h3>
    </div>

    <div class="card-body">
        <form action="/update/guru/{{ $guru->id_guru }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>ID Guru</label>
            <input name="id_guru" class="form-control" value="{{ $guru->id_guru }}" readonly>
            <div class="text-danger">
                @error('id_guru') 
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label>Nama Guru</label>
            <input name="nama_guru" class="form-control" value="{{ $guru->nama_guru }}">
            <div class="text-danger">
                @error('nama_guru') 
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label>No Telephone</label>
            <input name="no_telp" class="form-control" value="{{ $guru->no_telp }}">
            <div class="text-danger">
                @error('no_telp') 
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label>Tempat Lahir</label>
            <input name="tempat_lahir" class="form-control" value="{{ $guru->tempat_lahir }}">
            <div class="text-danger">
                @error('tempat_lahir') 
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control" value="{{ $guru->tanggal_lahir }}">
            <div class="text-danger">
                @error('tanggal_lahir') 
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <textarea placeholder="Alamat" name="alamat" class="form-control">{{ $guru->alamat }}</textarea>
            <div class="text-danger">
                @error('alamat') 
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label>Pendidikan</label>
            <input name="pendidikan" class="form-control" value="{{ $guru->pendidikan }}">
            <div class="text-danger">
                @error('pendidikan') 
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="col-sm-12">
            <div class="col-sm-4">
                <img src="{{ url('foto/'.$guru->id_guru.'.jpg') }}" width="100px">
            </div>
            <div class="col-sm-8">
                <div class="form-group">
                    <label>Ganti Foto Guru</label>
                    <input type="file" name="foto_guru" class="form-control" value="{{ old('foto_guru') }}">
                    <div class="text-danger">
                        @error('foto_guru') 
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <a href="/guru" class="btn btn-primary">Kembali</a> &nbsp;
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
        
        </form>
    </div>
</div>

@endsection
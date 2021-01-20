@extends('layout.v_template')
@section('title','Siswa')

@section('content')

<div class="card card-info card-outline">
    <div class="card-header">
        <h3>Tambah Data Siswa</h3>
    </div>

    <div class="card-body">
        <form action="/insert/siswa" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <input placeholder="ID Siswa" name="id_siswa" class="form-control" value="{{ old('id_siswa') }}">
            <div class="text-danger">
                @error('id_siswa') 
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form-group">
            <input placeholder="Nama Siswa" name="nama_siswa" class="form-control" value="{{ old('nama_siswa') }}">
            <div class="text-danger">
                @error('nama_siswa') 
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form-group">
            <input placeholder="NIK Siswa" name="nik" class="form-control" value="{{ old('nik') }}">
            <div class="text-danger">
                @error('nik') 
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
            <select name="jk" class="form-control">
                <option value="L" {{(old('jk') == "L") ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{(old('jk') == "P") ? 'selected' : '' }}>Perempuan</option>
            </select>
            <div class="text-danger">
                @error('jk') 
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
            <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}">
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
            <input placeholder="Nama Ayah" name="nama_ayah" class="form-control" value="{{ old('nama_ayah') }}">
            <div class="text-danger">
                @error('nama_ayah') 
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form-group">
            <input placeholder="Nama Ibu" name="nama_ibu" class="form-control" value="{{ old('nama_ibu') }}">
            <div class="text-danger">
                @error('nama_ibu') 
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form-group">
            <input placeholder="Pekerjaan Ayah" name="pekerjaan_ayah" class="form-control" value="{{ old('pekerjaan_ayah') }}">
            <div class="text-danger">
                @error('pekerjaan_ayah') 
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form-group">
            <input placeholder="Pekerjaan Ibu" name="pekerjaan_ibu" class="form-control" value="{{ old('pekerjaan_ibu') }}">
            <div class="text-danger">
                @error('pekerjaan_ibu') 
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form-group">
            <input placeholder="Foto Siswa" type="file" name="foto_siswa" class="form-control" value="{{ old('foto_siswa') }}">
            <div class="text-danger">
                @error('foto_siswa') 
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
@extends('layout.v_template')
@section('title','Siswa')

@section('content')

<div class="card card-info card-outline">
    <div class="card-header">
        <h3>Edit Data Siswa</h3>
    </div>

    <div class="card-body">
        <form action="/update/siswa/{{ $guru->id_siswa }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>ID Siswa</label>
            <input name="id_siswa" class="form-control" value="{{ $guru->id_siswa }}" readonly>
            <div class="text-danger">
                @error('id_siswa') 
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label>Nama Siswa</label>
            <input name="nama_siswa" class="form-control" value="{{ $guru->nama_siswa }}">
            <div class="text-danger">
                @error('nama_siswa') 
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label>NIK Siswa</label>
            <input name="nik" class="form-control" value="{{ $guru->nik }}">
            <div class="text-danger">
                @error('nik') 
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
            <label>Jenis Kelamin (*L/P)</label>
            <select name="jk" class="form-control">
                <option value="L" {{($guru->jk == "L") ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{($guru->jk == "P") ? 'selected' : '' }}>Perempuan</option>
            </select>
            <div class="text-danger">
                @error('jk') 
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
            <label>Nama Ayah</label>
            <input name="nama_ayah" class="form-control" value="{{ $guru->nama_ayah }}">
            <div class="text-danger">
                @error('nama_ayah') 
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label>Nama Ibu</label>
            <input name="nama_ibu" class="form-control" value="{{ $guru->nama_ibu }}">
            <div class="text-danger">
                @error('nama_ibu') 
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label>Pekerjaan Ayah</label>
            <input name="pekerjaan_ayah" class="form-control" value="{{ $guru->pekerjaan_ayah }}">
            <div class="text-danger">
                @error('pekerjaan_ayah') 
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label>Pekerjaan Ibu</label>
            <input name="pekerjaan_ibu" class="form-control" value="{{ $guru->pekerjaan_ibu }}">
            <div class="text-danger">
                @error('pekerjaan_ibu') 
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="col-sm-12">
            <div class="col-sm-4">
                <img src="{{ url('foto/'.$guru->id_siswa.'.jpg') }}" width="100px">
            </div>
            <div class="col-sm-8">
                <div class="form-group">
                    <label>Ganti Foto Siswa</label>
                    <input type="file" name="foto_siswa" class="form-control" value="{{ old('foto_siswa') }}">
                    <div class="text-danger">
                        @error('foto_siswa') 
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <a href="/siswa" class="btn btn-primary">Kembali</a> &nbsp;
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>

        </form>
    </div>
</div>        
@endsection
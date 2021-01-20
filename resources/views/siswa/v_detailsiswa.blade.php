@extends('layout.v_template')
@section('title','Detail Siswa')

@section('content')
   
<div class="card card-info card-outline">

    <div class="card-body">
        <table class="table">
        <tr>
            <th width="150px">ID Siswa</th>
            <th while="30x">:</th>
            <th>{{ $guru->id_siswa }}</th>
        </tr>
        <tr>
            <th>Nama Siswa</th>
            <th>:</th>
            <th>{{ $guru->nama_siswa }}</th>
        </tr>
        <tr>
            <th>NIK</th>
            <th>:</th>
            <th>{{ $guru->nik }}</th>
        </tr>
        <tr>
            <th>No. Telp</th>
            <th>:</th>
            <th>{{ $guru->no_telp }}</th>
        </tr>
        <tr>
            <th>Jenis Kelamin</th>
            <th>:</th>
            <th>{{ $guru->jk }}</th>
        </tr>
        <tr>
            <th>Tempat dan Tanggal Lahir</th>
            <th>:</th>
            <th>{{ $guru->tempat_lahir }}, {{ $guru->tanggal_lahir }}</th>
        </tr>
        <tr>
            <th>Alamat</th>
            <th>:</th>
            <th>{{ $guru->alamat }}</th>
        </tr>
        <tr>
            <th>Nama Ayah</th>
            <th>:</th>
            <th>{{ $guru->nama_ayah }}</th>
        </tr>
        <tr>
            <th>Nama Ibu</th>
            <th>:</th>
            <th>{{ $guru->nama_ibu }}</th>
        </tr>
        <tr>
            <th>Pekerjaan Ayah</th>
            <th>:</th>
            <th>{{ $guru->pekerjaan_ayah }}</th>
        </tr>
        <tr>
            <th>Pekerjaan Ibu</th>
            <th>:</th>
            <th>{{ $guru->pekerjaan_ibu }}</th>
        </tr>
        <tr>
            <th>Foto</th>
            <th>:</th>
            <th><img src="{{ url('foto/'.$guru->id_siswa.'.jpg') }}" width="200px"></th>
        </tr>
        <tr>
            <th><a href="/siswa" class="btn btn-success">Kembali</th>
        </tr>
        </table>
    </div>
</div>


@endsection
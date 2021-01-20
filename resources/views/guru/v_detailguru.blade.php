@extends('layout.v_template')
@section('title','Detail Guru')

@section('content')

<div class="card card-info card-outline">

    <div class="card-body">
        <table class="table">
        <tr>
            <th width="100px">ID</th>
            <th while="30x">:</th>
            <th>{{ $guru->id_guru }}</th>
        </tr>
        <tr>
            <th>Nama Guru</th>
            <th>:</th>
            <th>{{ $guru->nama_guru }}</th>
        </tr>
        <tr>
            <th>No. Telp</th>
            <th>:</th>
            <th>{{ $guru->no_telp }}</th>
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
            <th>Pendidikan</th>
            <th>:</th>
            <th>{{ $guru->pendidikan }}</th>
        </tr>
        <tr>
            <th>Foto</th>
            <th>:</th>
            <th><img src="{{ url('foto/'.$guru->id_guru.'.jpg') }}" width="200px"></th>
        </tr>
        <tr>
            <th><a href="/guru" class="btn btn-success">Kembali</th>
        </tr>
        </table>
    </div>    
</div>

@endsection
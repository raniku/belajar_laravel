@extends('layout.v_template')
@section('title','Guru')

@section('content')

<div class="card card-info card-outline">
  <div class="card-header">
    <div class="card-tools">
      <a href="{{ url('/add/guru') }}" class="btn btn-success">Tambah Data <i class="fa fa-plus-square"></i></a>
    </div>
  </div>

  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>ID Guru</th>
          <th>Nama</th>
          <th>No Telephone</th>
          <th>Foto</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1; ?>
        @foreach ($guru as $data)
          <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $data->id_guru }}</td>
            <td>{{ $data->nama_guru }}</td>
            <td>{{ $data->no_telp }}</td>
            <td><img src="{{ url('foto/'.$data->id_guru.'.jpg') }}" width="100px"></td>
            <td>
              <a href="{{ url('/detail/guru/'.$data->id_guru.'') }}" class="btn btn-sm btn-success"><i class="fas fa-info-circle"></i></a>
              <a href="{{ url('/edit/guru/'.$data->id_guru.'') }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
              <button class="btn btn-danger" data-toggle="modal" data-target="#delete{{ $data->id_guru }}">
                <i class="fas fa-trash-alt"></i>
              </button>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div> 

  @foreach ($guru as $data)
    <div class="modal fade" id="delete{{ $data->id_guru }}">
        <div class="modal-dialog">
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title">{{ $data->nama_guru }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda Yakin Ingin Menghapus Data Ini ?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                    <a href="{{ url('/delete/guru/'.$data->id_guru.'') }}" type="button" class="btn btn-outline-light">Yes</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
  @endforeach

@endsection

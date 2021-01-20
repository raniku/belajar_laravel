@extends('layout.v_template')
@section('title','Siswa')

@section('content')

    <div class="card card-info card-outline">
        <div class="card-header">
            <div class="card-tools">
                <a href="/add/siswa" class="btn btn-success">Tambah Data <i class="fa fa-plus-square"></i>
                </a>
            </div>
        </div>

        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                        <th>No</th>
                        <th>ID Siswa</th>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>TTL</th>
                        <th>Foto</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no = 1; ?>
                @foreach ($guru as $data)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data->id_siswa }}</td>
                        <td>{{ $data->nama_siswa }}</td>
                        <td>{{ $data->nik }}</td>
                        <td>{{ $data->tempat_lahir }}, {{ date('Y-M-d', strtotime($data->tanggal_lahir)) }}</td>
                        <td><img src="{{ url('foto/'.$data->id_siswa.'.jpg') }}" width="100px"></td>
                        <td>
                            <a href="/detail/siswa/{{ $data->id_siswa }}" class="btn btn-sm btn-success"><i class="fas fa-info-circle"></i></a>
                            <a href="/edit/siswa/{{ $data->id_siswa }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{ $data->id_siswa }}">
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
    <div class="modal fade" id="delete{{ $data->id_siswa }}">
        <div class="modal-dialog">
          <div class="modal-content bg-danger">
            <div class="modal-header">
              <h4 class="modal-title">{{ $data->nama_siswa }}</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda Yakin Ingin Menghapus Data Ini ?</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
              <a href="/delete/siswa/{{ $data->id_siswa }}" type="button" class="btn btn-outline-light">Yes</a>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    @endforeach

@endsection

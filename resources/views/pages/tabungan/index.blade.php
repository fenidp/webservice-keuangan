@extends('layouts.main')
@section('konten')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tabel Tabungan</h1>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{ route('tabungan.create') }}" class="btn btn-primary btn-sm">Tambah</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Anggaran</th>
                                <th>Sistem</th>
                                <th>Periode Mulai</th>
                                <th>Periode Selesai</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tabungan as $data)
                                <tr>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->anggaran }}</td>
                                    <td>{{ $data->sistem }}</td>
                                    <td>{{ $data->periodeMulai }}</td>
                                    <td>{{ $data->periodeSelesai }}</td>
                                    <td>
                                        <a href="{{ route('tabungan.edit', $data->id) }}"
                                            class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('tabungan.destroy', $data->id) }}" method="POST"
                                            onclick="return confirm('Yakin Untuk Mengapus Data ?')" class="d-inline">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

@extends('layouts.main')
@section('konten')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tabel Anggaran</h1>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{ route('anggaran.create') }}" class="btn btn-primary btn-sm">Tambah</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Pemasukan</th>
                                <th>Kategori</th>
                                <th>Tanggal</th>
                                <th>Anggaran</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($anggaran as $data)
                            @php
                                $pemasukan = App\Models\Pemasukan::find($data->pemasukan_id);
                                $kategori = App\Models\Kategori::find($data->kategori_id)
                            @endphp
                                <tr>
                                    <td>{{ $pemasukan->pemasukan }}</td>
                                    <td>{{ $kategori->nama }}</td>
                                    <td>{{ $data->tanggal }}</td>
                                    <td>{{ $data->anggaran }}</td>
                                    <td>
                                        <a href="{{ route('anggaran.edit', $data->id) }}"
                                            class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('anggaran.destroy', $data->id) }}" method="POST"
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

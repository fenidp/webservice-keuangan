@extends('layouts.main')
@section('konten')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tabel Pengeluaran</h1>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{ route('pengeluaran.create') }}" class="btn btn-primary btn-sm">Tambah</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Kategori</th>
                                <th>Pemasukan</th>
                                <th>Pengeluaran</th>
                                <th>Catatan</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengeluaran as $data)
                            @php
                            $pemasukan = App\Models\Pemasukan::find($data->pemasukan_id);
                            $kategori = App\Models\Kategori::find($data->kategori_id)
                        @endphp
                                <tr>
                                    <td>{{ $kategori->nama }}</td>
                                    <td>{{ $pemasukan->pemasukan }}</td>
                                    <td>{{ $data->pengeluaran }}</td>
                                    <td>{{ $data->catatan }}</td>
                                    <td>{{ $data->tanggal }}</td>
                                    <td>{{ $data->jam }}</td>
                                    <td>
                                        <a href="{{ route('pengeluaran.edit', $data->id) }}"
                                            class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('pengeluaran.destroy', $data->id) }}" method="POST"
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

@extends('layouts.main')
@section('konten')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('tabungan.store') }}" method="POST">

                            @csrf

                            <div class="form-group">
                                <label class="font-weight-bold">nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    name="nama" value="{{ old('nama') }}" placeholder="Masukkan Impian Anda">

                                <!-- error message untuk nama -->
                                @error('nama')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Anggaran</label>
                                <input type="text" class="form-control @error('anggaran') is-invalid @enderror"
                                    name="anggaran" value="{{ old('anggaran') }}" placeholder="Masukkan anggaran impian">

                                <!-- error message untuk anggaran -->
                                @error('anggaran_id')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Sistem</label>
                                <select class="form-control @error('sistem') is-invalid @enderror" name="sistem">
                                    <option value="" selected disabled>Pilih Sistem Menabung</option>
                                    <option value="harian" {{ old('sistem') == 'harian' ? 'selected' : '' }}>Harian</option>
                                    <option value="mingguan" {{ old('sistem') == 'mingguan' ? 'selected' : '' }}>Mingguan</option>
                                    <option value="bulanan" {{ old('sistem') == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                                </select>
                            
                                <!-- error message untuk sistem -->
                                @error('sistem')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Periode Mulai</label>
                                <input type="date" class="form-control @error('periodeMulai') is-invalid @enderror"
                                    name="periodeMulai" value="{{ old('periodeMulai') }}" placeholder="Masukkan periodeMulai">

                                <!-- error message untuk periodeMulai -->
                                @error('periodeMulai')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Periode Selesai</label>
                                <input type="date" class="form-control @error('periodeSelesai') is-invalid @enderror"
                                    name="periodeSelesai" value="{{ old('periodeSelesai') }}" placeholder="Masukkan periodeSelesai">

                                <!-- error message untuk periodeSelesai -->
                                @error('periodeSelesai')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

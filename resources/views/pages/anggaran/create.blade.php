@extends('layouts.main')
@section('konten')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('anggaran.store') }}" method="POST">

                            @csrf

                            <div class="form-group">
                                <label class="font-weight-bold">Pemasukan</label>
                                <select class="form-control @error('pemasukan_id') is-invalid @enderror" name="pemasukan_id">
                                    <option value="" selected disabled>Pilih Pemasukan</option>
                                    @foreach ($pemasukan as $data)
                                        <option value="{{ $data->id }}">
                                            
                                            {{ $data->pemasukan }}
                                        </option>
                                    @endforeach
                                </select>

                                <!-- error message untuk pemasukan_id -->
                                @error('pemasukan_id')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Kategori</label>
                                <select class="form-control @error('kategori_id') is-invalid @enderror" name="kategori_id">
                                    <option value="" selected disabled>Pilih Kategori</option>
                                    @foreach ($kategori as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->nama }}
                                        </option>
                                    @endforeach
                                </select>

                                <!-- error message untuk kategori_id -->
                                @error('kategori_id')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Tanggal</label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                    name="tanggal" value="{{ old('tanggal') }}" placeholder="Masukkan Tanggal">

                                <!-- error message untuk tanggal -->
                                @error('tanggal')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Anggaran</label>
                                <input type="text" class="form-control @error('anggaran') is-invalid @enderror"
                                    name="anggaran" value="{{ old('anggaran') }}" placeholder="Masukkan anggaran sebulan">

                                <!-- error message untuk anggaran -->
                                @error('anggaran_id')
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

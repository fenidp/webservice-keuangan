@extends('layouts.main')
@section('konten')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('pengeluaran.update', $data->id) }}" method="POST">

                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label class="font-weight-bold">Kategori</label>
                                <select class="form-control @error('kategori_id') is-invalid @enderror" name="kategori_id">
                                    <option value="" selected disabled>Pilih Kategori</option>
                                    @foreach ($kategori as $category)
                                        <option value="{{ $category->id }}"{{$category->id == $data->kategori_id ? 'selected' : ''}}>
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
                                <label class="font-weight-bold">Pemasukan</label>
                                <select class="form-control @error('pemasukan_id') is-invalid @enderror" name="pemasukan_id">
                                    <option value="" selected disabled>Pilih Pemasukan</option>
                                    @foreach ($pemasukan as $dataPemasukan)
                                        <option value="{{ $dataPemasukan->id }}" {{$dataPemasukan->id == $data->pemasukan_id  ? 'selected' : ''}}>
                                            {{ $dataPemasukan->pemasukan }}
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
                                <label class="font-weight-bold">Pengeluaran</label>
                                <input type="text" class="form-control @error('pengeluaran') is-invalid @enderror"
                                    name="pengeluaran" value="{{$data->pengeluaran}}">

                                <!-- error message untuk pengeluaran -->
                                @error('pengeluaran')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Catatan</label>
                                <input type="text" class="form-control @error('catatan') is-invalid @enderror"
                                    name="catatan" value="{{$data->catatan}}">

                                <!-- error message untuk catatan -->
                                @error('catatan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Tanggal</label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                    name="tanggal" value="{{$data->tanggal}}" placeholder="Masukkan Tanggal">

                                <!-- error message untuk tanggal -->
                                @error('tanggal')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Jam</label>
                                <input type="time" class="form-control @error('jam') is-invalid @enderror"
                                       name="jam" value="{{$data->jam}}" >
                            
                                <!-- error message untuk jam -->
                                @error('jam')
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

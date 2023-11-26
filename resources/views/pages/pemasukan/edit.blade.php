@extends('layouts.main')
@section('konten')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('pemasukan.update', $data->id) }}" method="POST">

                            @csrf
                            @method(PATCH)
                            <div class="form-group">
                                <label class="font-weight-bold">Pemasukan</label>
                                <input type="text" class="form-control @error('pemasukan') is-invalid @enderror"
                                    name="pemasukan" value="{{ old('pemasukan') }}" placeholder="Masukkan pemasukan sebulan">

                                <!-- error message untuk pemasukan -->
                                @error('pemasukan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Catatan</label>
                                <input type="text" class="form-control @error('catatan') is-invalid @enderror"
                                    name="catatan" value="{{ old('catatan') }}" placeholder="Masukkan catatan sebulan">

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
                                    name="tanggal" value="{{ old('tanggal') }}" placeholder="Masukkan Tanggal">

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
                                       name="jam" value="{{ old('jam') }}" placeholder="Masukkan Jam">
                            
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

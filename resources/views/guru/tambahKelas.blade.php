@extends('layouts.main')

@section('container')
    <div class="pagetitle mt-3">
        <h1>Tambah Kelas</h1>
    </div>
    <section class="section dashboard">
        <div class="row">
            <div class="card col-md-12">
                <div class="card-body">
                    <div class="mt-4">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <form class="row g-3 mt-3" method="GET" action="{{route('tambahKelasSubmit')}}">
                        <div class="col-md-12"> <label for="guru" class="form-label">Pengajar :</label> <input type="text" class="form-control" id="guru" name="guru" value="{{ $name }}" readonly></div>
                        <div class="col-md-12"> <label for="ruang" class="form-label">Ruang Kelas :</label> <input type="text" class="form-control" id="ruang" name="ruang" value="{{ old('ruang') }}"></div>
                        <div class="col-md-12"> <label for="pelajaran" class="form-label">Pelajaran :</label> <input type="text" class="form-control" id="pelajaran" name="pelajaran" value="{{ old('pelajaran') }}"></div>
                        <div class="col-md-12">
                            <label for="hari" class="form-label">Hari :</label> 
                            <select id="hari" class="form-select" name="hari">
                                <option>Pilih Hari!</option>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                            </select>
                        </div>
                        <div class="col-md-12"> <label for="waktu" class="form-label">Waktu :</label> <input type="time" class="form-control" id="waktu" name="waktu" value="{{ old('waktu') }}"></div>
                        <div class="text-center mb-5 mt-4"> <button type="submit" class="btn btn-primary">Submit</button> <button type="reset" class="btn btn-secondary">Reset</button></div>
                    </form>
                </div>
            </div> 
        </div>
    </section>
@endsection
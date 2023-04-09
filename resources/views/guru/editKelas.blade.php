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
                    <form class="row g-3 mt-3" method="GET" action="{{route('updateKelas', ['id' => base64_encode($id)])}}">
                        <div class="col-md-12"> <label for="guru" class="form-label">Pengajar :</label> <input type="text" class="form-control" id="guru" name="guru" value="{{ $kelas[0]->guru }}" readonly></div>
                        <div class="col-md-12"> <label for="ruang" class="form-label">Ruang Kelas :</label> <input type="text" class="form-control" id="ruang" name="ruang" value="{{ $kelas[0]->ruang }}"></div>
                        <div class="col-md-12"> <label for="pelajaran" class="form-label">Pelajaran :</label> <input type="text" class="form-control" id="pelajaran" name="pelajaran" value="{{ $kelas[0]->pelajaran }}"></div>
                        <div class="col-md-12">
                            <label for="hari" class="form-label">Hari :</label> 
                            <select id="hari" class="form-select" name="hari">
                                <option>Pilih Hari!</option>
                                <option value="Senin" {{ $kelas[0]->hari == 'Senin' ? 'selected' : '' }}>Senin</option>
                                <option value="Selasa" {{ $kelas[0]->hari == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                                <option value="Rabu" {{ $kelas[0]->hari == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                <option value="Kamis" {{ $kelas[0]->hari == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                                <option value="Jumat" {{ $kelas[0]->hari == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                                <option value="Sabtu" {{ $kelas[0]->hari == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                            </select>
                        </div>                        
                        <div class="col-md-12"> <label for="waktu" class="form-label">Waktu :</label> <input type="time" class="form-control" id="waktu" name="waktu" value="{{ substr($kelas[0]->waktu, 0, 5) }}"></div>
                        <div class="text-center mb-5 mt-4"> <button type="submit" class="btn btn-primary">Submit</button> <button type="reset" class="btn btn-secondary">Reset</button></div>
                    </form>
                </div>
            </div> 
        </div>
    </section>
@endsection
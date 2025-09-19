@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h3 class="mb-3">Detail Perhitungan Metode SAW</h3>

            @if(isset($error))
                <div class="alert alert-danger">{{ $error }}</div>
            @else

                {{-- 1. Matriks Keputusan (X) --}}
                <div class="card mb-4">
                    <div class="card-header"><strong>1. Matriks Keputusan (X)</strong></div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>Alternatif</th>
                                        @foreach($kriteria as $k)
                                            <th>{{ $k->kode_kriteria }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($alternatif as $alt)
                                        <tr>
                                            <td class="text-left">{{ $alt->nama }}</td>
                                            @foreach($kriteria as $k)
                                                <td>{{ $matriks_x[$alt->id][$k->id] }}</td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- 2. Matriks Normalisasi (R) --}}
                <div class="card mb-4">
                    <div class="card-header"><strong>2. Matriks Normalisasi (R)</strong></div>
                    <div class="card-body">
                        <p>Rumus Normalisasi:
                        <ul>
                            <li><strong>Benefit:</strong> R<sub>ij</sub> = X<sub>ij</sub> / Max(X<sub>ij</sub>)</li>
                            <li><strong>Cost:</strong> R<sub>ij</sub> = Min(X<sub>ij</sub>) / X<sub>ij</sub></li>
                        </ul>
                        </p>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>Alternatif</th>
                                        @foreach($kriteria as $k)
                                            <th>{{ $k->kode_kriteria }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($alternatif as $alt)
                                        <tr>
                                            <td class="text-left">{{ $alt->nama }}</td>
                                            @foreach($kriteria as $k)
                                                <td>{{ number_format($matriks_r[$alt->id][$k->id], 8) }}</td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- 3. Bobot Preferensi (W) --}}
                <div class="card mb-4">
                    <div class="card-header"><strong>3. Bobot Preferensi (W)</strong></div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped text-center">
                                <thead>
                                    <tr>
                                        @foreach($kriteria as $k)
                                            <th>{{ $k->kode_kriteria }} ({{ $k->jenis }})</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach($kriteria as $k)
                                            <td>{{ $k->bobot }}</td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- 4. Matriks Normalisasi Terbobot --}}
                <div class="card mb-4">
                    <div class="card-header"><strong>4. Matriks Normalisasi Terbobot (R * W)</strong></div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>Alternatif</th>
                                        @foreach($kriteria as $k)
                                            <th>{{ $k->kode_kriteria }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($alternatif as $alt)
                                        <tr>
                                            <td class="text-left">{{ $alt->nama }}</td>
                                            @foreach($kriteria as $k)
                                                <td>{{ number_format($matriks_terbobot[$alt->id][$k->id], 8) }}</td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- 5 & 6. Nilai Preferensi (V) dan Perangkingan --}}
                <div class="card mb-4">
                    <div class="card-header"><strong>5 & 6. Nilai Preferensi (V) dan Perangkingan</strong></div>
                    <div class="card-body">
                        <p>Rumus Nilai Preferensi: V<sub>i</sub> = &Sigma; (R<sub>ij</sub> * W<sub>j</sub>)</p>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-center">Peringkat</th>
                                        <th>Nama Alternatif</th>
                                        <th class="text-center">Nilai Preferensi (V)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $rank = 1; @endphp
                                    @foreach($nilai_v as $id_alternatif => $nilai)
                                        <tr>
                                            <td class="text-center"><strong>{{ $rank++ }}</strong></td>
                                            <td>{{ $alternatif->find($id_alternatif)->nama }}</td>
                                            <td class="text-center">{{ number_format($nilai, 8) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
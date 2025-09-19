@extends('layouts.app')

@section('content')
        <div class="row">
            <div class="col-md-12">
                <h3 class="mb-3">Detail Perhitungan Metode ARAS</h3>

                    @if(isset($error))
                        <div class="alert alert-danger">{{ $error }}</div>
                    @else

                    {{-- 1. Matriks Keputusan (X) --}}
                    <div class="card mb-4">
                        <div class="card-header"><strong>1. Matriks Keputusan Awal (X)</strong></div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th>Alternatif</th>
                                            @foreach($kriteria as $k) <th>{{ $k->kode_kriteria }}</th> @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($alternatif as $alt)
                                            <tr>
                                                <td class="text-left">{{ $alt->nama }}</td>
                                                @foreach($kriteria as $k) <td>{{ number_format($matriks_x[$alt->id][$k->id], 2) }}</td> @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- LANGKAH BARU: TAMPILKAN MATRIKS HASIL TRANSFORMASI --}}
                    <div class="card mb-4">
                        <div class="card-header"><strong>2. Matriks Transformasi (Hasil Inversi Kriteria Cost)</strong></div>
                        <div class="card-body">
                            <p>Rumus: Jika kriteria adalah <strong>Cost</strong>, maka nilai baru = 1 / Nilai Lama.</p>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th>Alternatif</th>
                                            @foreach($kriteria as $k) <th>{{ $k->kode_kriteria }}</th> @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($alternatif as $alt)
                                            <tr>
                                                <td class="text-left">{{ $alt->nama }}</td>
                                                @foreach($kriteria as $k) 
                                                    <td>{{ number_format($matriks_x_transformed[$alt->id][$k->id], 8) }}</td> 
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- 2. Nilai Optimum (X0) --}}
                    <div class="card mb-4">
                        <div class="card-header"><strong>3. Nilai Optimum (X<sub>0</sub>)</strong></div>
                        <div class="card-body">
                            <p>Mencari nilai terbaik (Max) dari setiap kolom pada Matriks Transformasi.</p>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped text-center">
                                    <thead>
                                        <tr> @foreach($kriteria as $k) <th>{{ $k->kode_kriteria }}</th> @endforeach </tr>
                                    </thead>
                                    <tbody>
                                        <tr> @foreach($kriteria as $k) <td>{{ number_format($matriks_x0[$k->id], 8) }}</td> @endforeach </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- 4. Matriks Normalisasi (R) --}}
                    <div class="card mb-4">
                        <div class="card-header"><strong>4. Matriks Normalisasi (R)</strong></div>
                        <div class="card-body">
                            <p>Rumus: R<sub>ij</sub> = X'<sub>ij</sub> / &Sigma;X'<sub>i</sub> (Nilai dari Matriks Transformasi dibagi Total Kolomnya)</p>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th>Alternatif</th>
                                            @foreach($kriteria as $k) <th>{{ $k->kode_kriteria }}</th> @endforeach
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

                    {{-- 5. Matriks Normalisasi Terbobot --}}
                    <div class="card mb-4">
                        <div class="card-header"><strong>5. Matriks Normalisasi Terbobot</strong></div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th>Alternatif</th>
                                            @foreach($kriteria as $k) <th>{{ $k->kode_kriteria }}</th> @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($alternatif as $alt)
                                            <tr>
                                                <td class="text-left">{{ $alt->nama }}</td>
                                                @foreach($kriteria as $k) <td>
                                                {{ number_format($matriks_terbobot[$alt->id][$k->id], 8) }}</td> @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- 6 & 7. Nilai Fungsi (S) dan Tingkat Utilitas (K) --}}
                    <div class="card mb-4">
                        <div class="card-header"><strong>6 & 7. Nilai Fungsi (S) dan Tingkat Utilitas (K)</strong></div>
                        <div class="card-body">
                            <p>Nilai Fungsi Optimum (S<sub>0</sub>): <strong>{{ number_format($nilai_s0, 8) }}</strong></p>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Alternatif</th>
                                            <th class="text-center">Nilai Fungsi (S)</th>
                                            <th class="text-center">Tingkat Utilitas (K = S / S<sub>0</sub>)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($alternatif as $alt)
                                            <tr>
                                                <td>{{ $alt->nama }}</td>
                                                <td class="text-center">{{ number_format($nilai_s[$alt->id], 8) }}</td>
                                                <td class="text-center">{{ number_format($tingkat_utilitas_k[$alt->id], 8) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- 8. Perangkingan --}}
                    <div class="card mb-4">
                        <div class="card-header"><strong>8. Perangkingan Akhir</strong></div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th class="text-center">Peringkat</th>
                                            <th>Nama Alternatif</th>
                                            <th class="text-center">Nilai Utilitas (K)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $rank = 1; @endphp
                                        @foreach($tingkat_utilitas_k as $id_alternatif => $nilai)
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
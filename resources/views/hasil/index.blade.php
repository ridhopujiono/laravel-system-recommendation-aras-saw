@extends('layouts.app')

@section('content')
    <h3 class="mb-3">Hasil Akhir Perangkingan & Korelasi</h3>

    @if(isset($error))
        <div class="alert alert-danger">{{ $error }}</div>
    @else

        {{-- HASIL PERANGKINGAN --}}
        <div class="row">
            {{-- Kolom SAW --}}
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header"><strong>Hasil Perangkingan SAW</strong></div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-center">Peringkat</th>
                                        <th>Nama Alternatif</th>
                                        <th class="text-center">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $rank = 1; @endphp
                                    @foreach($hasil_saw as $id => $nilai)
                                        <tr>
                                            <td class="text-center"><strong>{{ $rank++ }}</strong></td>
                                            <td>{{ $alternatif->find($id)->nama }}</td>
                                            <td class="text-center">{{ number_format($nilai, 4) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Kolom ARAS --}}
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header"><strong>Hasil Perangkingan ARAS</strong></div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-center">Peringkat</th>
                                        <th>Nama Alternatif</th>
                                        <th class="text-center">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $rank = 1; @endphp
                                    @foreach($hasil_aras as $id => $nilai)
                                        <tr>
                                            <td class="text-center"><strong>{{ $rank++ }}</strong></td>
                                            <td>{{ $alternatif->find($id)->nama }}</td>
                                            <td class="text-center">{{ number_format($nilai, 4) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- PERHITUNGAN KORELASI SPEARMAN --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header"><strong>Perhitungan Korelasi Rank Spearman</strong></div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>Alternatif</th>
                                        <th>Rank SAW (R1)</th>
                                        <th>Rank ARAS (R2)</th>
                                        <th>d (R1-R2)</th>
                                        <th>d<sup>2</sup></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($spearman_details as $detail)
                                        <tr>
                                            <td class="text-left">{{ $detail['nama'] }}</td>
                                            <td>{{ $detail['rank_saw'] }}</td>
                                            <td>{{ $detail['rank_aras'] }}</td>
                                            <td>{{ $detail['d'] }}</td>
                                            <td>{{ $detail['d2'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="font-weight-bold">
                                    <tr>
                                        <td colspan="4" class="text-right">Total (&Sigma;d<sup>2</sup>)</td>
                                        <td>{{ $total_d2 }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <hr>
                        <div class="mt-4">
                            <h5 class="text-center">Rumus Korelasi Rank Spearman (ρ)</h5>
                            <p class="text-center lead">
                                ρ = 1 - (6 * Σd<sup>2</sup>) / (n * (n<sup>2</sup> - 1))
                            </p>
                            <p><b>Perhitungan:</b></p>
                            <ul>
                                <li>Σd<sup>2</sup> = {{ $total_d2 }}</li>
                                <li>n = {{ $n }}</li>
                            </ul>
                            <p>
                                ρ = 1 - (6 * {{ $total_d2 }}) / ({{ $n }} * ({{$n}}<sup>2</sup> - 1))
                                <br>
                                ρ = 1 - ({{ 6 * $total_d2 }}) / ({{ $n * (pow($n, 2) - 1) }})
                                <br>
                                ρ = {{ number_format($rho, 4) }}
                            </p>
                            <div class="alert alert-info">
                                <b>Kesimpulan:</b> Nilai korelasi antara metode SAW dan ARAS adalah
                                <b>{{ number_format($rho, 4) }}</b>,
                                yang menunjukkan tingkat <b>{{ $interpretasi }}</b>.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
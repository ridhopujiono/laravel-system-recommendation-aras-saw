@extends('layouts.app') {{-- Sesuaikan dengan layout Anda --}}

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <div class="row">

        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Jumlah Kriteria</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlah_kriteria }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-cube fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Jumlah Alternatif</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlah_alternatif }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Peringkat 5 Teratas (Metode SAW)</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Nama Alternatif</th>
                                    <th class="text-center">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($peringkat_saw as $item)
                                    <tr>
                                        <td class="text-center font-weight-bold">{{ $item['rank'] }}</td>
                                        <td>{{ $item['nama'] }}</td>
                                        <td class="text-center">{{ number_format($item['nilai'], 4) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Data belum cukup untuk dirangking.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Peringkat 5 Teratas (Metode ARAS)</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Nama Alternatif</th>
                                    <th class="text-center">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($peringkat_aras as $item)
                                    <tr>
                                        <td class="text-center font-weight-bold">{{ $item['rank'] }}</td>
                                        <td>{{ $item['nama'] }}</td>
                                        <td class="text-center">{{ number_format($item['nilai'], 4) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Data belum cukup untuk dirangking.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

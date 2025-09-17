@extends('layouts.app') {{-- Sesuaikan dengan layout Anda --}}

@push('styles')
    <style>
        .fab {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            right: 40px;
            background-color: #007bff;
            color: white;
            border-radius: 50px;
            text-align: center;
            box-shadow: 2px 2px 3px #999;
            font-size: 30px;
            line-height: 60px;
            border: none;
            cursor: pointer;
        }

        .fab:hover {
            background-color: #0056b3;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h3>Input Penilaian</h3>
            <div class="card">
                <div class="card-body">
                    <form id="penilaianForm">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center align-middle">Nama Alternatif</th>
                                        @foreach($kriteria as $k)
                                            <th class="text-center">{{ $k->kode_kriteria }} <br> ({{ $k->keterangan }})</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($alternatif as $alt)
                                        <tr>
                                            <td>{{ $alt->nama }}</td>
                                            @foreach($kriteria as $k)
                                                <td>
                                                    <input type="number" step="any" class="form-control"
                                                        name="nilai[{{ $alt->id }}][{{ $k->id }}]"
                                                        value="{{ $scores[$alt->id][$k->id] ?? '' }}" placeholder="0">
                                                </td>
                                            @endforeach
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="{{ count($kriteria) + 1 }}" class="text-center">
                                                Data Alternatif atau Kriteria belum ada. Silakan isi terlebih dahulu.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Floating Action Button untuk menyimpan --}}
    <button type="submit" form="penilaianForm" class="fab" title="Simpan Semua Perubahan">
        <i class="fa fa-save"></i>
    </button>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            // Setup CSRF Token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#penilaianForm').on('submit', function (e) {
                e.preventDefault(); // Mencegah form submit biasa

                const fab = $('.fab');
                fab.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');

                // --- LOGIKA BARU DIMULAI DI SINI ---

                // 1. Cari semua input yang kosong di dalam form
                const emptyInputs = $('#penilaianForm input[type="number"]').filter(function() {
                    return !this.value; // `!this.value` akan true jika input kosong
                });

                // 2. Nonaktifkan sementara input yang kosong agar tidak ikut terkirim
                emptyInputs.prop('disabled', true);

                // 3. Ambil data dari form. Hanya input yang aktif yang akan diambil.
                const formData = $(this).serialize();

                // 4. Aktifkan kembali input yang kosong agar bisa diisi lagi tanpa perlu refresh
                emptyInputs.prop('disabled', false);

                // --- LOGIKA BARU SELESAI ---

                $.ajax({
                    url: "{{ route('penilaian.store') }}",
                    type: "POST",
                    data: formData, // Kirim data yang sudah difilter
                    dataType: 'json',
                    success: function (response) {
                        alert(response.success);
                        fab.prop('disabled', false).html('<i class="fa fa-save"></i>');
                    },
                    error: function (xhr) {
                        alert('Terjadi kesalahan saat menyimpan data.');
                        console.log(xhr.responseText);
                        fab.prop('disabled', false).html('<i class="fa fa-save"></i>');
                    }
                });
            });
        });
    </script>
@endpush
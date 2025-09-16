@extends('layouts.app') {{-- Sesuaikan dengan nama layout Anda --}}

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h3>Data Alternatif</h3>
            <div class="card">
                <div class="card-body">
                    <button id="btn-tambah" class="btn btn-primary mb-3">
                        <i class="fa fa-plus"></i> Tambah Alternatif
                    </button>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Alternatif</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($alternatif as $alt)
                                    <tr id="alternatif_{{ $alt->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $alt->nama }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-info btn-edit" data-id="{{ $alt->id }}">Edit</button>
                                            <button class="btn btn-sm btn-danger btn-hapus"
                                                data-id="{{ $alt->id }}">Hapus</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="alternatifModal" tabindex="-1" role="dialog" aria-labelledby="alternatifModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="alternatifModalLabel">Tambah Alternatif</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="alternatifForm">
                        <input type="hidden" name="alternatif_id" id="alternatif_id">
                        <input type="hidden" name="_method" id="form_method" value="POST">

                        <div class="form-group">
                            <label for="nama">Nama Alternatif</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="btn-simpan">Simpan</button>
                </div>
            </div>
        </div>
    </div>
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

            // 1. Tampilkan Modal Tambah
            $('#btn-tambah').click(function () {
                $('#alternatifModalLabel').text('Tambah Alternatif');
                $('#alternatifForm').trigger('reset');
                $('#alternatif_id').val('');
                $('#form_method').val('POST');
                $('#alternatifModal').modal('show');
            });

            // 2. Tampilkan Modal Edit
            $('body').on('click', '.btn-edit', function () {
                let id = $(this).data('id');
                $.get("{{ url('alternatif') }}/" + id + '/edit', function (data) {
                    $('#alternatifModalLabel').text('Edit Alternatif');
                    $('#alternatif_id').val(data.id);
                    $('#nama').val(data.nama);
                    $('#form_method').val('PUT');
                    $('#alternatifModal').modal('show');
                });
            });

            // 3. Simpan data (Tambah atau Update)
            $('#btn-simpan').click(function (e) {
                e.preventDefault();
                let id = $('#alternatif_id').val();
                let url = id ? "{{ url('alternatif') }}/" + id : "{{ route('alternatif.store') }}";

                $.ajax({
                    url: url,
                    type: "POST",
                    data: $('#alternatifForm').serialize(),
                    dataType: 'json',
                    success: function (response) {
                        alert(response.success);
                        $('#alternatifModal').modal('hide');
                        location.reload();
                    },
                    error: function (xhr) {
                        let errors = xhr.responseJSON.errors;
                        let errorString = '';
                        $.each(errors, function (key, value) {
                            errorString += value + '\n';
                        });
                        alert(errorString);
                    }
                });
            });

            // 4. Hapus Data
            $('body').on('click', '.btn-hapus', function () {
                let id = $(this).data('id');
                if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                    $.ajax({
                        url: "{{ url('alternatif') }}/" + id,
                        type: 'DELETE',
                        dataType: 'json',
                        success: function (response) {
                            alert(response.success);
                            location.reload();
                        },
                        error: function (xhr) {
                            alert(xhr.responseJSON.error || 'Terjadi kesalahan.');
                        }
                    });
                }
            });
        });
    </script>
@endpush
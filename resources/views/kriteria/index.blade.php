@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h3>Data Kriteria</h3>
            <div class="card">
                <div class="card-body">
                    <button id="btn-tambah" class="btn btn-primary mb-3">
                        <i class="fa fa-plus"></i> Tambah Kriteria
                    </button>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Keterangan</th>
                                    <th>Bobot</th>
                                    <th>Jenis</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kriteria as $k)
                                    <tr id="kriteria_{{ $k->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $k->kode_kriteria }}</td>
                                        <td>{{ $k->keterangan }}</td>
                                        <td>{{ $k->bobot }}</td>
                                        <td>{{ ucfirst($k->jenis) }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-info btn-edit" data-id="{{ $k->id }}">Edit</button>
                                            <button class="btn btn-sm btn-danger btn-hapus"
                                                data-id="{{ $k->id }}">Hapus</button>
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

    <div class="modal fade" id="kriteriaModal" tabindex="-1" role="dialog" aria-labelledby="kriteriaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kriteriaModalLabel">Tambah Kriteria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="kriteriaForm">
                        {{-- Hidden input untuk ID dan method --}}
                        <input type="hidden" name="id_kriteria" id="id_kriteria">
                        <input type="hidden" name="_method" id="form_method" value="POST">

                        <div class="form-group">
                            <label for="kode_kriteria">Kode Kriteria</label>
                            <input type="text" class="form-control" id="kode_kriteria" name="kode_kriteria" required>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan" required>
                        </div>
                        <div class="form-group">
                            <label for="bobot">Bobot</label>
                            <input type="number" step="0.01" class="form-control" id="bobot" name="bobot" required>
                        </div>
                        <div class="form-group">
                            <label for="jenis">Jenis</label>
                            <select class="form-control" id="jenis" name="jenis" required>
                                <option value="benefit">Benefit</option>
                                <option value="cost">Cost</option>
                            </select>
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

@push('scripts') {{-- Push script ke stack 'scripts' di layout Anda --}}
    <script>
        $(document).ready(function () {
            // Setup CSRF Token untuk semua request AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // 1. Tampilkan Modal Tambah
            $('#btn-tambah').click(function () {
                $('#kriteriaModalLabel').text('Tambah Kriteria');
                $('#kriteriaForm').trigger('reset');
                $('#id_kriteria').val('');
                $('#form_method').val('POST');
                $('#kriteriaModal').modal('show');
            });

            // 2. Tampilkan Modal Edit
            $('body').on('click', '.btn-edit', function () {
                let id = $(this).data('id');
                $.get("{{ url('kriteria') }}/" + id + '/edit', function (data) {
                    $('#kriteriaModalLabel').text('Edit Kriteria');
                    $('#id_kriteria').val(data.id);
                    $('#kode_kriteria').val(data.kode_kriteria);
                    $('#keterangan').val(data.keterangan);
                    $('#bobot').val(data.bobot);
                    $('#jenis').val(data.jenis);
                    $('#form_method').val('PUT');
                    $('#kriteriaModal').modal('show');
                });
            });

            // 3. Simpan data (Tambah atau Update)
            $('#btn-simpan').click(function (e) {
                e.preventDefault();
                let id = $('#id_kriteria').val();
                let url = id ? "{{ url('kriteria') }}/" + id : "{{ route('kriteria.store') }}";
                let method = $('#form_method').val();

                $.ajax({
                    url: url,
                    type: "POST", // Method tetap POST, tapi di-override dengan _method
                    data: $('#kriteriaForm').serialize(),
                    dataType: 'json',
                    success: function (response) {
                        alert(response.success);
                        $('#kriteriaModal').modal('hide');
                        location.reload(); // Reload halaman untuk melihat perubahan
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
                        url: "{{ url('kriteria') }}/" + id,
                        type: 'DELETE',
                        dataType: 'json',
                        success: function (response) {
                            alert(response.success);
                            location.reload(); // Reload halaman
                        },
                        error: function (xhr) {
                            alert(xhr.responseJSON.error || 'Terjadi kesalahan saat menghapus data.');
                        }
                    });
                }
            });
        });
    </script>
@endpush
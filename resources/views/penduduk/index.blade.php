@extends('template.layouts')
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="container">
                <h1> Data</h1>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Penduduk</h3>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">


                        <table id="tbl_list" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Nik</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Alamat</th>
                                    <th>Provinsi</th>

                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

    </section>
</div>



<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('#provinsi').on('change', function() {
        var provinsiId = $(this).val();
        if (provinsiId) {
            $.ajax({
                type: 'GET',
                url: '/get-kabupaten/' + provinsiId,
                success: function(data) {
                    $('#kabupaten').empty();
                    $('#kabupaten').append(
                        '<option value="">-- Pilih Kabupaten --</option>');
                    $.each(data, function(key, value) {
                        $('#kabupaten').append('<option value="' + key + '">' +
                            value + '</option>');
                    });
                }
            });
        } else {
            $('#kabupaten').empty();
            $('#kabupaten').append('<option value="">-- Pilih Kabupaten --</option>');
        }
    });
});
</script> -->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection
@push('scripts')
<script type="text/javascript">
$(document).ready(function() {
    $('#tbl_list').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ url('/') }}',

        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'nama',
                name: 'nama'
            },
            {
                data: 'nik',
                name: 'nik'
            },
            {
                data: 'jeniskelamin',
                name: 'jeniskelamin'
            },
            {
                data: 'tanggallahir',
                name: 'tanggallahir'
            },
            {
                data: 'alamat',
                name: 'alamat'
            },

                {
        data: 'provinsis',
        name: 'provinsis.nama'
    },
            {
                data: 'kabupatens',
                name: 'kabupaten.nama'
            },

        ]
    });
});
</script>
@endpush
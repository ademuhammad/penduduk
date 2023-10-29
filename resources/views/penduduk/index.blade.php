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
                            <a class="btn btn-primary mb-3" href="{{ route('penduduks.create') }}" role="button">Tambah
                                Penduduk</a>
                            <div class="container">

                            </div>
                            <select class="form-control" id="provinsiFilter">
                                <option value="">Tampilkan Semua</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->nama }}</option>
                                @endforeach
                            </select>
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
                                        <th>Kabupaten</th>
                                        <th>aksi</th>
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





    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>




    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
@endsection
@push('scripts')
    <script type="text/javascript">
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {
            $('#tbl_list').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('penduduks.index') }}',
                dom: 'Blfrtip',
                buttons: [{
                        extend: 'pdf',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5] // Column index which needs to export
                        }
                    },

                    {
                        extend: 'excel',
                    }
                ],
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
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },

                ]
            });
            $('#tbl_list').on('click', '.deleteUser', function() {
                var id = $(this).data('id');
                console.log(id);
                var deleteConfirm = confirm("Are you sure?");
                if (deleteConfirm == true) {
                    // AJAX request
                    $.ajax({
                        url: "{{ route('deletedata') }}",
                        type: 'post',
                        data: {
                            _token: CSRF_TOKEN,
                            id: id
                        },
                        success: function(response) {
                            if (response.success == 1) {
                                alert("Record deleted.");

                                // Reload DataTable
                                $('#tbl_list').DataTable().ajax.reload();
                            } else {
                                alert("Invalid ID.");
                            }
                        }
                    });
                }

            });
            $('#provinsiFilter').on('change', function() {
                var provinsiId = $(this).val();

                // Cek jika yang dipilih adalah "Tampilkan Semua"
                if (provinsiId === '') {
                    $('#tbl_list').DataTable().ajax.url('{{ route('penduduks.index') }}').load();

                } else {
                    $('#tbl_list').DataTable().ajax.url('{{ route('penduduks.index') }}?provinsi_id=' +
                        provinsiId).load();

                }
            });
        });
    </script>
@endpush

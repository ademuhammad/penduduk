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
                        <a class="btn btn-primary" href="{{ route('penduduks.create') }}" role="button">Tambah
                            Penduduk</a>
                        <div class="container">

                        </div>
                       <select class="form-control" id="provinsiFilter">
    <option value="">Tampilkan Semua</option>
    @foreach($provinces as $province)
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





<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
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
        // Reload DataTable tanpa filter
        $('#tbl_list').DataTable().ajax.url('{{ route('penduduks.index') }}').load();
    } else {
        // Reload DataTable dengan filter Provinsi yang dipilih
        $('#tbl_list').DataTable().ajax.url('{{ route('penduduks.index') }}?provinsi_id=' + provinsiId).load();
    }
});
/ Update record
       $('#tbl_list').on('click','.updateUser',function(){
            var id = $(this).data('id');

            $('#txt_empid').val(id);

            // AJAX request
            $.ajax({
                url: "{{ route('getEmployeeData') }}",
                type: 'post',
                data: {_token: CSRF_TOKEN,id: id},
                dataType: 'json',
                success: function(response){

                    if(response.success == 1){

                         $('#emp_name').val(response.emp_name);
                         $('#email').val(response.email);
                         $('#gender').val(response.gender);
                         $('#city').val(response.city);

                         tbl_list.ajax.reload();
                    }else{
                         alert("Invalid ID.");
                    }
                }
            });

       });

       // Save user 
       $('#btn_save').click(function(){
            var id = $('#txt_empid').val();

            var emp_name = $('#emp_name').val().trim();
            var email = $('#email').val().trim();
            var gender = $('#gender').val().trim();
            var city = $('#city').val().trim();

            if(emp_name !='' && email != '' && city != ''){

                 // AJAX request
                 $.ajax({
                     url: "{{ route('updateEmployee') }}",
                     type: 'post',
                     data: {_token: CSRF_TOKEN,id: id,emp_name: emp_name, email: email, gender: gender, city: city},
                     dataType: 'json',
                     success: function(response){
                         if(response.success == 1){
                              alert(response.msg);

                              // Empty and reset the values
                              $('#emp_name','#email','#city').val('');
                              $('#gender').val('Male');
                              $('#txt_empid').val(0);

                              // Reload DataTable
                              tbl_list.ajax.reload();

                              // Close modal
                              $('#updateModal').modal('toggle');
                         }else{
                              alert(response.msg);
                         }
                     }
                 });

            }else{
                 alert('Please fill all fields.');
            }
       });
});
</script>

@endpush
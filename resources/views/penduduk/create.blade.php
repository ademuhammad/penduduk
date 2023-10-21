@extends('template.layouts')
@section('content')
<?php
$provinsi_id = 0;
?>
<div class="container mt-5 mb-5">

    <div>
        <form action="{{ route('penduduks.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="form-group mb-3">
                <label class="font-weight-bold">Nama</label>
                <input type="text" name="nama" value="{{ old('nama') }}">
            </div>
            <div class="form-group mb-3">
                <label class="font-weight-bold">Nik</label>
                <input type="text" name="nik" value="{{ old('nik') }}">
            </div>
            <div class="form-group mb-3">
                <label class="font-weight-bold">Jenis Kelamin:</label>
                <select name="jeniskelamin" class="form-control">
                    <option value="lakilaki" {{ old('jeniskelamin') === 'lakilaki' ? 'selected' : '' }}>Laki-Laki
                    </option>
                    <option value="perempuan" {{ old('jeniskelamin') === 'perempuan' ? 'selected' : '' }}>Perempuan
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Tanggal Lahir: </label>
                <div class='input-group date' id='datetimepicker'>
                    <input type="text" name="tanggallahir" value="{{ old('tanggallahir') }}" placeholder="YYYY-MM-DD">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>


            <div class="form-group mb-3">
                <label class="font-weight-bold">Alamat </label>
                <input type="text" name="alamat" value="{{ old('alamat') }}">
            </div>


            <div class="form-group mb-3">
                <label for="provinsi">Provinsi:</label>
                <select name="provinsi_id" id="provinsi" class="form-control">
                    @foreach($provinces as $province)
                    <option value="{{ $province->id }}">{{ $province->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="kabupaten">Kabupaten:</label>
                <select name="kabupaten_id" id="kabupaten" class="form-control">
                    @foreach($districts as $district)
                    <option value="{{ $district->id }}">{{ $district->nama }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-md btn-dark">SIMPAN</button>
            <button type="reset" class="btn btn-md btn-dark">RESET</button>

        </form>

    </div>

</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js">
</script>

<script type="text/javascript">
$(function() {
    $('#datetimepicker').datetimepicker({
        format: 'YYYY-MM-DD'
    });
});
</script>
<script>
$('#kabupaten').change(function() {
    var provinsi_id = $(this).val();
    $.ajax({
        url: "{{ route('penduduks.getKabupaten', '') }}/" +
            provinsi_id,
        type: "GET",
        success: function(data) {
            $('#kabupaten').empty();
            $.each(data, function(key, value) {
                $('#kabupaten').append($('<option>', {
                    value: key,
                    text: value,
                }));
            });
        },
    });
});
</script>

@endsection
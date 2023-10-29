@extends('template.layouts')
@section('content')
<div class="container mt-5 mb-5">

    <div>

        <form action="{{ route('penduduks.update', $penduduks->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group mt-3">
                <label class="font-weight-bold">Nama</label>
                <input type="text" name="nama" value="{{ old('nama', $penduduks->nama) }}" placeholder="Masukkan Nama">
            </div>
            <div class="form-group mt-3">
                <label class="font-weight-bold">NIK</label>
                <input type="text" name="nik" value="{{ old('nik', $penduduks->nik) }}" placeholder="Masukkan nik">
            </div>
            <div class="form-group mt-3">
                <label class="font-weight-bold">Jenis Kelamin</label>
                <input type="text" name="jeniskelamin" value="{{ old('jeniskelamin', $penduduks->jeniskelamin) }}"
                    placeholder="Masukkan jenis kelamin">
            </div>
            <div class="form-group mt-3">
                <label class="font-weight-bold">Alamat</label>
                <input type="text" name="alamat" value="{{ old('alamat', $penduduks->alamat) }}"
                    placeholder="Masukkan alamat">
            </div>
            <div class="form-group mt-3">
                <label class="font-weight-bold">Tanggal Lahir</label>
                <input type="text" name="tanggallahir" value="{{ old('tanggallahir', $penduduks->tanggallahir) }}"
                    placeholder="Masukkan Tanggal Lahir">
            </div>
            <div class="form-group mt-3">
                <label for="provinsi">Provinsi:</label>
                <select name="provinsi_id" id="provinsi" class="form-control">
                    @foreach($provinces as $province)
                    <option value="{{ $province->id }}"
                        {{ $penduduks->provinsi_id == $province->id ? 'selected' : '' }}>
                        {{ $province->nama }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="kabupaten">Kabupaten:</label>
                <select name="kabupaten_id" id="kabupaten" class="form-control">
                    @foreach($districts as $district)
                    <option value="{{ $district->id }}"
                        {{ $penduduks->kabupaten_id == $district->id ? 'selected' : '' }}>
                        {{ $district->nama }}
                    </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-md btn-dark">UPDATE</button>
            <button type="reset" class="btn btn-md btn-dark">RESET</button>

        </form>

    </div>

</div>
<script>
$('#provinsi').change(function() {
    var provinsi_id = $(this).val();
    $.ajax({
        url: "{{ route('penduduks.getKabupaten', ['id' => '__provinsi_id']) }}".replace('__provinsi_id',
            provinsi_id),
        type: "GET",
        success: function(data) {
            var kabupatenDropdown = $('#kabupaten');
            kabupatenDropdown.empty(); // Hapus opsi yang ada
            kabupatenDropdown.append($(
                '<option value="">Pilih Kabupaten</option>')); // Tambahkan opsi default
            $.each(data, function(id, name) {
                kabupatenDropdown.append($('<option>', {
                    value: id,
                    text: name,
                }));
            });
        },
    });
});
</script>
@endsection
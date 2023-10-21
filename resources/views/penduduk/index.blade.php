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
                    <div class="container">

                        <a class="btn btn-primary" href="{{ route('penduduks.create') }}" role="button">Tambah
                            Penduduk</a>
                        <a class="btn btn-primary" href="export/penduduk" role="button">Export</a>
                        <form action="{{ route('penduduks.index') }}" class="d-inline float-right mx-2">
                            <div class="form-group row">
                                <label for="provinsi" class="col-form-label">Provinsi</label>
                                <div class="col">
                                    <select name="provinsi" id="provinsi" class="custom-select">
                                        <option @if (request('provinsi')=='' ) selected @endif value="">-- All --
                                        </option>
                                        @foreach ($provinsis as $provinsi)
                                        <option @if (request('provinsi')==$provinsi->id) selected @endif
                                            value="{{ $provinsi->id }}">{{ $provinsi->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label for="kabupaten" class="col-form-label">Kabupaten</label>
                                <div class="col">
                                    <select name="kabupaten" id="kabupaten" class="custom-select">
                                        <option @if (request('kabupaten')=='' ) selected @endif value="">-- All --
                                        </option>
                                        @foreach ($kabupatens as $kabupaten)
                                        <option @if (request('kabupaten')==$kabupaten->id) selected @endif
                                            value="{{ $kabupaten->id }}">{{ $kabupaten->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <input type="search" name="search" value="{{ request('search') }}"
                                        class="form-control" placeholder="Search...">
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-md btn-primary">Cari</button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Nim</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">Tanggal Lahir</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Nama Provinsi</th>
                                    <th scope="col">Nama Kabupaten</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($penduduks as $penduduk)
                                <tr>
                                    <td>{{ $penduduk->nama }}</td>
                                    <td>{{ $penduduk->nim }}</td>
                                    <td>{{ $penduduk->jeniskelamin }}</td>
                                    <td>{{ $penduduk->tanggallahir }}</td>
                                    <td>{{ $penduduk->alamat }}</td>
                                    <td>{{ $penduduk->provinsi ? $penduduk->provinsi->nama : 'N/A' }}</td>
                                    <td>{{ $penduduk->kabupaten ? $penduduk->kabupaten->nama : 'N/A' }}</td>
                                    <td>
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                            action="{{ route('penduduks.destroy', $penduduk->id) }}" method="POST">
                                            <a href="{{ route('penduduks.edit', $penduduk->id) }}"
                                                class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8">Tidak ada data yang ditemukan.</td>
                                </tr>
                                @endforelse
                            </tbody>

                        </table>{{ $penduduks->links() }}
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

    </section>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
</script>
@endsection
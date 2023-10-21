@extends('template.layouts')
@section('content')
<div class="container mt-2">
    <a class="btn btn-primary" href="{{route('penduduks.create')}}" role="button">Tambah Penduduk</a>
    <table class="table mt-3 mb-3">
        <thead>
            <tr>
                <th scope="col">Nama </th>
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
            @forelse ( $penduduks as $penduduk)
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

                        <a href="{{ route('penduduks.edit', $penduduk->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                    </form>
                </td>



            </tr>
            @empty
            @endforelse
        </tbody>
    </table>
    {{ $penduduks->links() }}
</div>
@endsection
@extends('template.layouts')
@section('content')

<div class="container mt-2">
    <a class="btn btn-primary" href="{{route('kabupatens.create')}}" role="button">Tambah Kabupaten</a>
    <table class="table mt-3 mb-3">
        <thead>
            <tr>
                <th scope="col">Nama Kabupaten</th>
                <th scope="col">Nama Provinsi</th>
                <th scope="col">Aksi</th>

            </tr>
        </thead>
        <tbody>
            @forelse ( $kabupatens as $kabupaten)
            <tr>
                <td>{{ $kabupaten->nama }}</td>
                <td>{{ $kabupaten->provinsi->nama }}</td>
                <td>
                    <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                        action="{{ route('kabupatens.destroy', $kabupaten->id) }}" method="POST">
                        <a href="{{ route('kabupatens.show', $kabupaten->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                        <a href="{{ route('kabupatens.edit', $kabupaten->id) }}" class="btn btn-sm btn-primary">EDIT</a>
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
    {{ $kabupatens->links() }}
</div>
@endsection
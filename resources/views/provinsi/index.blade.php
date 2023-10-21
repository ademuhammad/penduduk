@extends('template.layouts')
@section('content')

<div class="container mt-2">
    <a class="btn btn-primary" href="{{route('provinsis.create')}}" role="button">Tambah Provinsi</a>
    <table class="table mt-3 mb-3">
        <thead>
            <tr>
                <th scope="col">Nama Provinsi</th>
                <th scope="col">Aksi</th>

            </tr>
        </thead>
        <tbody>
            @forelse ( $provinsis as $provinsi)
            <tr>
                <td>{{ $provinsi->nama }}</td>
                <td>
                    <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                        action="{{ route('provinsis.destroy', $provinsi->id) }}" method="POST">
                        <a href="{{ route('provinsis.show', $provinsi->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                        <a href="{{ route('provinsis.edit', $provinsi->id) }}" class="btn btn-sm btn-primary">EDIT</a>
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
    {{ $provinsis->links() }}
</div>
@endsection
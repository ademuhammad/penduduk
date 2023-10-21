@extends('template.layouts')
@section('content')
<div class="container mt-5 mb-5">

    <div>
        <form action="{{ route('kabupatens.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="form-group mb-3">
                <label class="font-weight-bold">Nama</label>
                <input type="text" name="nama" value="{{ old('nama') }}">
            </div>

            <div class="form-group mb-3">
                <label for="provinsi">Provinsi:</label>
                <select name="provinsi_id" id="provinsi" class="form-control">
                    @foreach($createkabupatens as $createkabupaten)
                    <option value="{{ $createkabupaten->id }}">{{ $createkabupaten->nama }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-md btn-dark">SIMPAN</button>
            <button type="reset" class="btn btn-md btn-dark">RESET</button>

        </form>

    </div>

</div>

@endsection
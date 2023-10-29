@extends('template.layouts')
@section('content')
<div class="container mt-5 mb-5">

    <div>

        <form action="{{ route('kabupatens.update', $kabupatens->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group mt-3">
                <label class="font-weight-bold">Provinsi</label>
                <select name="provinsi_id">
                    @foreach ($provinsis as $provinsi)
                    <option value="{{ $provinsi->id }}"
                        {{ $kabupatens->provinsi_id == $provinsi->id ? 'selected' : '' }}>
                        {{ $provinsi->nama }}
                    </option>
                    @endforeach
                </select>
            </div>


            <div class="form-group mt-3">
                <label class="font-weight-bold">Nama</label>
                <input type="text" name="nama" value="{{ old('nama', $kabupatens->nama) }}" placeholder="Masukkan Nama">


            </div>


            <button type="submit" class="btn btn-md btn-dark">UPDATE</button>
            <button type="reset" class="btn btn-md btn-dark">RESET</button>

        </form>

    </div>

</div>

@endsection
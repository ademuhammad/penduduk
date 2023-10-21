@extends('template.layouts')
@section('content')
<div class="container mt-5 mb-5">

    <div>

        <form action="{{ route('provinsis.update', $provinsi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group mt-3">
                <label class="font-weight-bold">Nama</label>
                <input type="text" name="nama" value="{{ old('nama', $provinsi->nama) }}" placeholder="Masukkan Nama">


            </div>


            <button type="submit" class="btn btn-md btn-dark">UPDATE</button>
            <button type="reset" class="btn btn-md btn-dark">RESET</button>

        </form>

    </div>

</div>

@endsection
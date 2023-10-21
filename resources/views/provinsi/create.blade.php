@extends('template.layouts')
@section('content')
<div class="container mt-5 mb-5">

    <div>


        <form action="{{ route('provinsis.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="form-group mb-3">
                <label class="font-weight-bold">Nama</label>
                <input type="text" name="nama" value="{{ old('nama') }}">


            </div>

            <button type="submit" class="btn btn-md btn-dark">SIMPAN</button>
            <button type="reset" class="btn btn-md btn-dark">RESET</button>

        </form>

    </div>

</div>

@endsection
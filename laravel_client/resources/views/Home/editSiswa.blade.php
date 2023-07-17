@extends('layouts.app')
@section('content')

                <form action="/siswa/update/{{ $siswa['id'] }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">NIS</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="nis" required value="{{ $siswa['nis'] }}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="nama" required value="{{ $siswa['nama'] }}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Rombel</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="rombel" required value="{{ $siswa['rombel'] }}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Rayon</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="rayon" required value="{{ $siswa['rayon'] }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

@endsection
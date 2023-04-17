@extends('main.bootstrap')
@section('content')
<div class="text-center py-5 bg-dark text-white">
    <h3>Kelola Pembayaran</h3>
</div>
<div class="container mt-4">
    <div class="d-flex justify-content-between">
        <div>
            <h4>Edit Pembayaran</h4>
        </div>
        <div>
            <a href="{{ url('pembayaran')}}" class="btn btn-warning">Kembali</a>
        </div>
    </div>
    <hr>
    <form action="{{ url('pembayaran/update')}}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $siswa->id }}">
        <div class="form-group">
            <label for="nis">NIS</label>
            <input type="number" name="nis" id="nis" class="form-control" value="{{ $siswa->nis }}" required>
        </div>

        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ $siswa->user->name }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $siswa->user->email }}" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control">
            <small>Kosongkan password jika tidak ingin mengubah.</small>
        </div>

        <div class="form-group">
            <label for="kelas_id">Kelas</label>
            <select name="kelas_id" id="kelas_id" class="form-select" required>
                <option value="" disabled>-Pilih kelas-</option>
                @foreach($kelas as $kelas)
                <option {{ $siswa->kelas_id == $kelas->id ? 'selected' : ''}} value="{{ $kelas->id }}">{{ $kelas->kelas }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" name="alamat" id="alamat" class="form-control" value="{{ $siswa->alamat}}" required>
        </div>


        <div class="form-group">
            <label for="no_hp">Nomor HP</label>
            <input type="text" name="no_hp" id="no_hp" class="form-control" value="{{ $siswa->no_hp}}" required>
        </div>

        <div class="mt-3 text-end">
            <button type="reset" class="btn btn-secondary">Reset</button>
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </form>
</div>
@endsection
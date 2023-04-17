@extends('main.bootstrap')
@section('content')
<div class="text-center py-5 bg-dark text-white">
    <h3>Kelola Pembayaran</h3>
</div>
<div class="container mt-4">
    <div class="d-flex justify-content-between">
        <div>
            <h4>Edit SPP</h4>
        </div>
        <div>
            <a href="{{ url('pembayaran')}}" class="btn btn-warning">Kembali</a>
        </div>
    </div>
    <hr>
    <form action="{{ url('pembayaran/update')}}" method="post">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        <input type="hidden" name="siswa_id" value="{{ $pembayaran->siswa_id }}">
        <input type="hidden" name="id" value="{{ $pembayaran->id }}">
        <div class="form-group mt-2">
            <label for="jumlah_bayar">Jumlah Bayar</label>
            <input type="number" name="jumlah_bayar" id="jumlah_bayar" class="form-control" value="{{ $pembayaran->jumlah_bayar }}" required>
        </div>
        <div class="modal-footer mt-3">
            <button type="submit" class="btn btn-primary">disimpan✨</button>
        </div>
    </form>
</div>
</div>
@endsection

<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\SPP;
use App\Models\User;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        $keyword = null;

        if($request->cari != null){
            $siswa = Siswa::with('user')->whereRelation('user', 'name', 'like', "%$request->cari%")->orderBy('kelas_id', 'ASC')->get();
            $keyword = $request->cari;
        }else{
            $siswa = Siswa::orderBy('kelas_id', 'ASC')->get();
        }

        return view('pembayaran.index', compact('siswa', 'keyword'));
    }

    public function transaksi($id)
    {
        $dibayar = 0;
        $tagihan = 0;
        $pembayaranSPP = [];

        try {
            $siswa = Siswa::findOrFail($id);
            $pembayaran = Pembayaran::where('siswa_id', $id)->get();
            $spp = SPP::get();


            foreach ($pembayaran as $data)
            {
                $dibayar += $data->jumlah_bayar;
            }

            foreach ($spp as $data)
            {
                $tagihan += $data->nominal;

                $total = Pembayaran::where('spp_id', $data->id)->where('siswa_id', $id)->sum('jumlah_bayar');
                $pembayaranSPP[] = $total;
            }

            $total = [
                'total_dibayar' => $dibayar,
                'total_belumdibayar' => $tagihan - $dibayar
            ];
        }
        catch (\Exception $e)
        {
            return redirect('pembayaran')->with('gagal', "Data tidak ditemukan❌");
        }

        return view('pembayaran.transaksi', compact('spp', 'pembayaran', 'siswa', 'total', 'pembayaranSPP'));
    }

    public function simpan(Request $request)
    {
        try {
            Pembayaran::create([
                'user_id' => auth()->user()->id,
                'siswa_id' => $request->siswa_id,
                'spp_id' => $request->spp_id,
                'tanggal_bayar' => $request->tanggal_bayar,
                'jumlah_bayar' => $request->jumlah_bayar
            ]);

            return redirect()->back()->with('sukses', "Transaksi berhasil disimpan✨");

        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('gagal', "Transaksi gagal diproses❌");
        }
    }

    public function edit($id)
    {
        try{
        $pembayaran = Pembayaran::findOrFail($id);
        $siswa = Siswa::all();
        $spp = SPP::all();
        $user = User::all();

        return view('pembayaran.edit', compact('pembayaran', 'spp', 'siswa', 'user'));

        return redirect('pembayaran')->with('sukses', 'data berhasil diedit');
        }catch(\Exception $e){
            $message = $e->getMessage(); 
            return redirect('pembayaran')->with('gagal', 'data gagal diedit' . "($message)
            
            
            ");   
        }
        
    }

    public function update(Request $request)
    {
        try{
            Pembayaran::where('id', $request->id)->update([
                'jumlah_bayar' => $request->jumlah_bayar,
            ]);

            return redirect('pembayaran')->with('sukses', 'data berhasil diupdate');
        }catch(\Exception $e){
            return redirect('pembayaran')->with('gagal', 'data gagal diupdate');
        }
    }

    public function hapus($id)
    {
        try{
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran::destroy($id);

        return redirect()->back()->with('sukses', 'data berhasil dihapus');

        }catch(\Exception $e){
            $e->getMessage();
            return redirect()->back()->with('gagal', 'data tidak ditemukan' . $e);
        }
    }

    public function cetak() {
        $pembayaran = Pembayaran::all();

        return view('pembayaran.cetak', compact('pembayaran'));
    }


    public function cetakid($id) {
        $siswa = Siswa::findOrFail($id);
        $data = Siswa::all();

            $pembayaran = Pembayaran::where('siswa_id', $id)->get();

        return view('pembayaran.cetakid', compact('pembayaran','data', 'siswa'));
    }

    public function history() {
        $user_id = auth()->user()->id;
        $siswa = Siswa::where('user_id', $user_id)->first();
        $pembayaran = Pembayaran::where('siswa_id', $siswa->id)->get();
        return view('history', compact('siswa', 'pembayaran'));
    }




}
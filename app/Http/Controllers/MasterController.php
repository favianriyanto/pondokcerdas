<?php

namespace App\Http\Controllers;

use App\Buku;
use App\Peminjam;
use App\Transaksi;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MasterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function usergantipass(Request $request){
        $data = User::find(Auth::user()->id);
        if ($request->password != $request->c_password){
            return redirect('/beranda')->with(['warning' => "Konfirmasi Password Baru Salah!"]);
        }
        if (Hash::check($request->passwordlama,$data->password) == false){
            return redirect('/beranda')->with(['warning' => "Konfirmasi Password Lama Salah!"]);
        }
        $data->password = Hash::make($request->password);
        $data->remember_token = NULL;
        $data->save();
        Auth::logout();
        return redirect('/login')->with(['success' => "Password berhasil diubah, silahkan login kembali!"]);
    }

    public function buku(){
        $data = Buku::all();
        return view('buku', ['data'=>$data]);
    }

    public function bukutambah(Request $request){
        Buku::create([
            'judul' => $request->judul,
            'pengarang' => $request->pengarang,
            'penerbit' => $request->penerbit,
            'tahun' => $request->tahun,
            'donatur' => $request->donatur
        ]);
        return redirect('/buku')->with(['success' => "Buku berhasil ditambah"]);
    }

    public function bukuhapus($id){
        Buku::destroy($id);
        return redirect('/buku')->with(['success' => "Buku berhasil dihapus"]);
    }

    public function bukuget($id){
        $data = Buku::where('id',$id)->first();
        return response($data);
    }

    public function bukuedit(Request $request){
        $data = Buku::find($request->id);
        $data->judul = $request->judul;
        $data->pengarang = $request->pengarang;
        $data->penerbit = $request->penerbit;
        $data->tahun = $request->tahun;
        $data->donatur = $request->donatur;
        $data->save();
        return redirect('/buku')->with(['success' => "Buku berhasil diedit"]);
    }


    public function peminjam(){
        $data = Peminjam::all();
        return view('peminjam', ['data'=>$data]);
    }

    public function peminjamtambah(Request $request){
        Peminjam::create([
            'nama' => $request->nama,
            'no_telfon' => $request->no_telfon,
            'nama_media' => $request->nama_media,
            'iden_media' => $request->iden_media,
            'alamat' => $request->alamat
        ]);
        return redirect('/peminjam')->with(['success' => "Peminjam berhasil ditambah"]);
    }

    public function peminjamhapus($id){
        Peminjam::destroy($id);
        return redirect('/peminjam')->with(['success' => "Peminjam berhasil dihapus"]);
    }

    public function peminjamget($id){
        $data = Peminjam::where('id',$id)->first();
        return response($data);
    }

    public function peminjamedit(Request $request){
        $data = Peminjam::find($request->id);
        $data->nama = $request->nama;
        $data->no_telfon = $request->no_telfon;
        $data->nama_media = $request->nama_media;
        $data->iden_media = $request->iden_media;
        $data->alamat = $request->alamat;
        $data->save();
        return redirect('/peminjam')->with(['success' => "Peminjam berhasil diedit"]);
    }

    //transaksi

    public function transaksitambah(Request $request){
        if ($request->konfirmasi != "YA") {
            return redirect('/beranda')->with(['warning' => "Konfirmasi Salah"]);
        }
        $dari = $request->dari;
        $dari2 = new \DateTime($dari);
        $sampai = $request->sampai;
        $sampai2 = new \DateTime($sampai);
        $hari = $dari2->diff($sampai2);
        $jumlahhari = $hari->format('%a')+1;

        Transaksi::create([
            'buku_id'=>$request->buku_id,
            'peminjam_id'=>$request->peminjam_id,
            'dari'=>$request->dari,
            'sampai'=>$request->sampai,
            'durasi'=>$jumlahhari,
            'status'=>0,
        ]);

        return redirect('/beranda')->with(['success' => "Peminjaman berhasil ditambah"]);
    }

    public function transaksikembali($id){
        $data = Transaksi::find($id);
        $data->status = 1;
        $data->save();

        return redirect('/beranda')->with(['success' => "Peminjaman berhasil dikembalikan"]);
    }

    public function riwayat(){
        $data = Transaksi::all();
        return view('riwayat',['data'=>$data]);
    }
}

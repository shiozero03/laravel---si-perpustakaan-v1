<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\ProfilPerusahaan;
use App\Models\Buku;
use App\Models\SimpanBuku;
use App\Models\PinjamBuku;
use App\Models\Berita;
use Session, DB;

class UserViewController extends Controller
{
    public function beranda(){
    	$user = Member::where('id_member', Session::get('loginId'))->first();
    	$bukudipinjam = PinjamBuku::where('id_member', Session::get('loginId'))->get()->count();
    	$bukujatuhtempo = PinjamBuku::where('id_member', Session::get('loginId'))->where('tanggal_dikembalikan', '=', null)->where('jatuh_tempo', '<', date('Y-m-d'))->get()->count();
    	$buku = Buku::orderby('tahun_terbit', 'DESC')->limit(4)->get();
        $januari = DB::table('pinjam_bukus')->where('id_member', Session::get('loginId'))->whereBetween('tanggal_peminjaman', [ date('Y-01-01'), date('Y-01-31')])->get()->count();
        $februari = DB::table('pinjam_bukus')->where('id_member', Session::get('loginId'))->whereBetween('tanggal_peminjaman', [ date('Y-02-01'), date('Y-02-29')])->get()->count();
        $maret = DB::table('pinjam_bukus')->where('id_member', Session::get('loginId'))->whereBetween('tanggal_peminjaman', [ date('Y-03-01'), date('Y-03-31')])->get()->count();
        $april = DB::table('pinjam_bukus')->where('id_member', Session::get('loginId'))->whereBetween('tanggal_peminjaman', [ date('Y-04-01'), date('Y-04-30')])->get()->count();
        $mei = DB::table('pinjam_bukus')->where('id_member', Session::get('loginId'))->whereBetween('tanggal_peminjaman', [ date('Y-05-01'), date('Y-05-31')])->get()->count();
        $juni = DB::table('pinjam_bukus')->where('id_member', Session::get('loginId'))->whereBetween('tanggal_peminjaman', [ date('Y-06-01'), date('Y-06-30')])->get()->count();
        $juli = DB::table('pinjam_bukus')->where('id_member', Session::get('loginId'))->whereBetween('tanggal_peminjaman', [ date('Y-07-01'), date('Y-07-31')])->get()->count();
        $agustus = DB::table('pinjam_bukus')->where('id_member', Session::get('loginId'))->whereBetween('tanggal_peminjaman', [ date('Y-08-01'), date('Y-08-31')])->get()->count();
        $september = DB::table('pinjam_bukus')->where('id_member', Session::get('loginId'))->whereBetween('tanggal_peminjaman', [ date('Y-09-01'), date('Y-09-30')])->get()->count();
        $oktober = DB::table('pinjam_bukus')->where('id_member', Session::get('loginId'))->whereBetween('tanggal_peminjaman', [ date('Y-10-01'), date('Y-10-31')])->get()->count();
        $november = DB::table('pinjam_bukus')->where('id_member', Session::get('loginId'))->whereBetween('tanggal_peminjaman', [ date('Y-11-01'), date('Y-11-30')])->get()->count();
        $desember = DB::table('pinjam_bukus')->where('id_member', Session::get('loginId'))->whereBetween('tanggal_peminjaman', [ date('Y-12-01'), date('Y-12-31')])->get()->count();
    	$data = [
    		'user' => $user,
    		'pinjam' => $bukudipinjam,
    		'tempo' => $bukujatuhtempo,
    		'buku' => $buku,
            'januari' => $januari,
            'februari' => $februari,
            'maret' => $maret,
            'april' => $april,
            'mei' => $mei,
            'juni' => $juni,
            'juli' => $juli,
            'agustus' => $agustus,
            'september' => $september,
            'oktober' => $oktober,
            'november' => $november,
            'desember' => $desember,
    	];
    	return view('pages.user.beranda.index')->with($data);
    }
    public function profilperpustakaan(){
    	$user = Member::where('id_member', Session::get('loginId'))->first();
    	$profil = ProfilPerusahaan::all();
    	$data = [
    		'user' => $user,
    		'profil' => $profil
    	];
    	return view('pages.user.profil-perpustakaan.index')->with($data);
    }
    public function berita(){
        $user = Member::where('id_member', Session::get('loginId'))->first();
        $berita = Berita::paginate(5);
        $data = [
            'user' => $user,
            'berita' => $berita
        ];
        return view('pages.user.berita.index')->with($data);
    }
    public function beritaView(Request $request){
        $user = Member::where('id_member', Session::get('loginId'))->first();
        $berita = Berita::where('id_berita', $request->id)->first();
        $data = [
            'user' => $user,
            'berita' => $berita
        ];
        return view('pages.user.berita.view')->with($data);
    }

    public function riwayatPinjam(){
    	$buku = PinjamBuku::join('bukus', 'bukus.id_buku', '=', 'pinjam_bukus.id_buku')->orderby('id_pinjam', 'DESC')->where('pinjam_bukus.id_member', Session::get('loginId'))->where('pinjam_bukus.status_pinjam', NULL)->get();
    	$user = Member::where('id_member', Session::get('loginId'))->first();
    	$data = [
    		'user' => $user,
    		'buku' => $buku
    	];
    	return view('pages.user.riwayat-pinjam.index')->with($data);
    }

    public function catalog(){
    	if(isset($_GET['keyword']) && isset($_GET['sembarang'])){
    		$buku = Buku::orderby('tahun_terbit', 'DESC')->where($_GET['sembarang'], 'LIKE', '%'.$_GET['keyword'].'%')->paginate(7);
    	} else {
    		$buku = Buku::orderby('tahun_terbit', 'DESC')->paginate(7);
    	}
    	$user = Member::where('id_member', Session::get('loginId'))->first();
    	$data = [
    		'user' => $user,
    		'buku' => $buku
    	];
    	return view('pages.user.katalog-buku.index')->with($data);	
    }
    public function catalogView(Request $request){
    	$buku = Buku::where('id_buku', $request->id)->first();
    	$user = Member::where('id_member', Session::get('loginId'))->first();
    	$data = [
    		'user' => $user,
    		'buku' => $buku
    	];
    	return view('pages.user.katalog-buku.view')->with($data);	
    }
    public function catalogSimpan(Request $request){
    	$simpan = new SimpanBuku;
    	$simpan->id_member = Session::get('loginId');
    	$simpan->id_buku = $request->id;
    	$simpan->tanggal_simpan = date('Y-m-d');
    	$simpan->save();

    	if($simpan){
    		return back()->with('success', 'Buku berhasil ditambahkan ke daftar buku');
    	}
    }
    public function catalogPinjam(Request $request){
    	$pinjam = new PinjamBuku;
    	$pinjam->id_member = Session::get('loginId');
    	$pinjam->id_buku = $request->id;
        $pinjam->status_pinjam = "Belum Konfirmasi";
    	$pinjam->save();

    	if($pinjam){
    		$update = Buku::where('id_buku', $request->id)->update(['status' => 'Dipinjam']);
    		if($update){
    			return back()->with('success', 'Buku berhasil dipinjam');
    		}
    	}
    }

    public function daftarBuku(){
    	$buku = SimpanBuku::join('bukus', 'bukus.id_buku', '=', 'simpan_bukus.id_buku')->orderby('simpan_bukus.id_simpan', 'DESC')->where('simpan_bukus.id_member', Session::get('loginId'))->paginate(6);
    	$user = Member::where('id_member', Session::get('loginId'))->first();
    	$data = [
    		'buku' => $buku,
    		'user' => $user
    	];
    	return view('pages.user.daftar-buku.index')->with($data);
    }
    public function hapusdaftarBuku(Request $request){
    	$delete = SimpanBuku::where('id_simpan', $request->id)->delete();

    	if($delete){
    		return back()->with('success', 'Buku berhasil dihapus dari daftar buku');
    	}
    }

    public function profil(){
    	$user = Member::where('id_member', Session::get('loginId'))->first();
    	$data = [
    		'user' => $user
    	];
    	return view('pages.user.profil.index')->with($data);	
    }
    public function updateProfil(Request $request){
    	$user = Member::where('id_member', Session::get('loginId'))->first();
    	if(isset($_POST['save-profil'])){
    		$validated = $request->validate([
    			'nama' => 'required',
    			'tanggal_lahir' => 'required|date',
    		    'no_hp' => 'required',
	            'alamat' => 'required',
	            'pekerjaan' => 'required'
	        ]);
	        $data = [
	        	'nama' => $request->nama,
	        	'jenis_kelamin' => $request->jenis_kelamin,
	        	'tanggal_lahir' => date('Y-d-m', strtotime($request->tanggal_lahir)),
	        	'no_hp' => $request->no_hp,
	        	'alamat' => $request->alamat,
	        	'pekerjaan' => $request->pekerjaan,
	        ];
	        $update = Member::where('id_member', Session::get('loginId'))->update($data);
	        if($update){
	        	return back()->with('success', 'Data berhasil diupdate');
	        } else {
	        	return back()->with('error', 'Data gagal diupdate');
	        }
    	} elseif(isset($_POST['save-picture'])){
    		if($request->foto_profil != null){
	    		$tujuan_upload = 'assets/images/user/';
	            $file = $request->file('foto_profil');
	            $namafile = time().'_'.$file->getClientOriginalName();

	            if($file->move($tujuan_upload,$namafile)){
                    $data = [
                        'foto_profil' => $namafile,
                    ];
	                if($user->foto_profil != null){
	                    $delete = \File::delete('assets/images/user/'.$user->foto_profil);
	                }

	                $update = Member::where('id_member', Session::get('loginId'))->update($data);

	                if($update){
	                	return back()->with('success', 'Foto profil berhasil diganti');
	                } else {
	                	return back()->with('error', 'Foto profil gagal diganti');
	                }
                } else {
                	return back()->with('error', 'Foto profil gagal diganti');
                }

    		} else {
    			return back()->with('error', 'Foto profil belum dipilih');
    		}
    	} elseif(isset($_POST['save-password'])){
    		if(!password_verify($request->last_password, $user->password)){
    			return back()->with('error', 'Password lama tidak sesuai');
    		} else {
    			if($request->new_password != $request->confirm_password){
    				return back()->with('error', 'Konfirmasi password tidak sesuai');
    			} else {
    				$data = ['password' => password_hash($request->new_password, PASSWORD_DEFAULT)];
    				$update = Member::where('id_member', Session::get('loginId'))->update($data);
    				if($update){
	                	return back()->with('success', 'Password berhasil diganti');
	                } else {
	                	return back()->with('error', 'Password gagal diganti');
	                }
    			}
    		}
    	}
    }
}

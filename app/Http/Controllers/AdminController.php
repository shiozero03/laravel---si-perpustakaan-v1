<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\ProfilPerusahaan;
use App\Models\Buku;
use App\Models\SimpanBuku;
use App\Models\PinjamBuku;
use App\Models\Berita;
use App\Models\Pengunjung;
use Session, DB;

class AdminController extends Controller
{
    public function dashboard(){
    	$user = Member::where('id_member', Session::get('loginId'))->first();
    	$pengunjung = Pengunjung::where('tanggal_kunjungan', date('Y-m-d'))->get()->count();
    	$bukudipinjam = PinjamBuku::where('tanggal_dikembalikan', null)->get()->count();
    	$bukujatuhtempo = PinjamBuku::where('tanggal_dikembalikan', '=', null)->where('jatuh_tempo', '<', date('Y-m-d'))->get()->count();
    	$visitor = Pengunjung::limit(7)->orderby('tanggal_kunjungan', 'DESC')->get();
        $buku = Buku::orderby('tahun_terbit', 'DESC')->limit(7)->get();
        $allbuku = Buku::orderby('tahun_terbit', 'DESC')->get();
        $member = Member::where('role', 'User')->orderby('created_at', 'DESC')->limit(5)->get();

        $notification = PinjamBuku::join('bukus', 'bukus.id_buku', '=', 'pinjam_bukus.id_buku')
		    ->join('members', 'members.id_member', '=', 'pinjam_bukus.id_member')
		    ->orderBy('pinjam_bukus.id_pinjam', 'DESC')
		    ->where('pinjam_bukus.status_pinjam', 'Belum Konfirmasi')
		    // ->orWhere('pinjam_bukus.pengingat', 'Aktif')
		    ->get();

    	$data = [
    		'user' => $user,
    		'pinjam' => $bukudipinjam,
    		'tempo' => $bukujatuhtempo,
    		'pengunjung' => $pengunjung,
    		'visitor' => $visitor,
    		'buku' => $buku,
    		'allbuku' => $allbuku,
    		'member' => $member,
    		'notification' => $notification
    	];
    	return view('pages.admin.dashboard.index')->with($data);
    }
    public function tambahData(){
    	$user = Member::where('id_member', Session::get('loginId'))->first();
    	$notification = PinjamBuku::join('bukus', 'bukus.id_buku', '=', 'pinjam_bukus.id_buku')
		    ->join('members', 'members.id_member', '=', 'pinjam_bukus.id_member')
		    ->orderBy('pinjam_bukus.id_pinjam', 'DESC')
		    ->where('pinjam_bukus.status_pinjam', 'Belum Konfirmasi')
		    // ->orWhere('pinjam_bukus.pengingat', 'Aktif')
		    ->get();
    	$data = [
    		'user' => $user,
    		'notification' => $notification
    	];
    	return view('pages.admin.tambah-data.index')->with($data);
    }
    public function storeData(Request $request){
    	if(isset($_POST['buku'])){
    		$validated = $request->validate([
    			'cover_buku' => 'required',
		        'judul_buku' => 'required',
		        'pengarang' => 'required',
		        'penerbit' => 'required',
		        'tahun_terbit' => 'required',
		        'tempat_terbit' => 'required',
		        'halaman' => 'required',
		        'bahasa' => 'required',
		        'sinopsis' => 'required'
		    ]);
		    if($validated){
			    if($request->file_buku =='' && $request->sumber_buku == ''){
			    	$validate = $request->validate(['file_buku' => 'required']);
			    } else {
			    	if($request->file_buku != ''){
			    		$tujuan_upload = 'assets/file/buku/';
			            $file = $request->file('file_buku');
			            $namafilebuku = time().'_'.$file->getClientOriginalName();
			            $file->move($tujuan_upload,$namafilebuku);
			        } else {
			        	$namafilebuku = null;
			        }
			        $tujuan_upload_cover = 'assets/images/buku/';
		            $file_cover = $request->file('cover_buku');
		            $namafilecover = time().'_'.$file_cover->getClientOriginalName();
		            $file_cover->move($tujuan_upload_cover,$namafilecover);

			        $buku = new Buku;
			        $max = Buku::max('no_panggil');
			        $buku->no_panggil = $max+1;
			        $buku->judul_buku = $request->judul_buku;
			        $buku->cover_buku = $namafilecover;
			        $buku->pengarang = $request->pengarang;
			        $buku->penerbit = $request->penerbit;
			        $buku->tahun_terbit = $request->tahun_terbit;
			        $buku->tempat_terbit = $request->tempat_terbit;
			        $buku->halaman = $request->halaman;
			        $buku->bahasa = $request->bahasa;
			        $buku->sinopsis = $request->sinopsis;
			        $buku->status = 'Tersedia';
			        $buku->rating = 0;
			        $buku->jumlah_penilai = 0;
			        $buku->total_rate = 0;
			        $buku->file = $namafilebuku;
			        $buku->sumber = $request->sumber_buku;

			        $buku->save();
			        if($buku){
			        	return back()->with('success', 'Berhasil menambahkan buku');
			        }
			    }
		    }
    	} elseif(isset($_POST['berita'])){
    		$validated = $request->validate([
    			'thumbnail_berita' => 'required',
		        'judul_berita' => 'required',
		        'isi_berita' => 'required'
		    ]);
		    if($validated){
		    	$tujuan_upload = 'assets/images/berita/';
	            $file = $request->file('thumbnail_berita');
	            $namafile = time().'_'.$file->getClientOriginalName();
	            $file->move($tujuan_upload,$namafile);

	            $user = Member::where('id_member', Session::get('loginId'))->first();

	            $berita = new Berita;
	            $berita->feature_image = $namafile;
	            $berita->judul_berita = $request->judul_berita;
	            $berita->tanggal_berita = date('Y-m-d H:i:s');
	            $berita->author = $user->nama;
	            $berita->isi_berita = $request->isi_berita;
	            $berita->save();
	            if($berita){
	            	return back()->with('success', 'Berita berhasil ditambahkan');
	            }
		    }
    	} elseif(isset($_POST['profil'])){
    		$validated = $request->validate([
    			'nama_section' => 'required',
		        'teks_section' => 'required'
		    ]);
		    if($validated){
		    	$profilperpustakaan = new ProfilPerusahaan;
		    	$profilperpustakaan->kategori = $request->nama_section;
		    	$profilperpustakaan->teks = $request->teks_section;
		    	$profilperpustakaan->save();
		    	if($profilperpustakaan){
		    		return back()->with('success', 'Section berhasil ditambahkan');
		    	}
		    }
    	}
    }
    public function aktivitas(){
    	$buku = PinjamBuku::join('bukus', 'bukus.id_buku', '=', 'pinjam_bukus.id_buku')
			->join('members', 'members.id_member', '=', 'pinjam_bukus.id_member')
			->orderBy('pinjam_bukus.id_pinjam', 'DESC')
			->where('pinjam_bukus.status_pinjam', NULL)
			->get();
    	$user = Member::where('id_member', Session::get('loginId'))->first();
    	$pengunjunghariini = Pengunjung::orderby('tanggal_kunjungan', 'DESC')->orderby('waktu_kunjungan', 'DESC')->where('tanggal_kunjungan', date('Y-m-d'))->get();
    	$tanggal = strtotime(date('Y-m-d'));
    	$minggu = $tanggal - (7*24*60*60);
     	$pengunjungmingguini = Pengunjung::orderby('tanggal_kunjungan', 'DESC')->orderby('waktu_kunjungan', 'DESC')->where('tanggal_kunjungan', '>=', date('Y-m-d', strtotime($minggu)))->where('tanggal_kunjungan', '<=', date('Y-m-d'))->get();
    	$pengunjungbulanini = Pengunjung::orderby('tanggal_kunjungan', 'DESC')->orderby('waktu_kunjungan', 'DESC')->where('tanggal_kunjungan', '>=', date('Y-m-01'))->where('tanggal_kunjungan', '<=', date('Y-m-31'))->get();
    	$pengunjungtahunini = Pengunjung::orderby('tanggal_kunjungan', 'DESC')->orderby('waktu_kunjungan', 'DESC')->where('tanggal_kunjungan', '>=', date('Y-01-01'))->where('tanggal_kunjungan', '<=', date('Y-12-31'))->get();
    	$pengunjungsemua = Pengunjung::orderby('tanggal_kunjungan', 'DESC')->orderby('waktu_kunjungan', 'DESC')->get();
    	$notification = PinjamBuku::join('bukus', 'bukus.id_buku', '=', 'pinjam_bukus.id_buku')
		    ->join('members', 'members.id_member', '=', 'pinjam_bukus.id_member')
		    ->orderBy('pinjam_bukus.id_pinjam', 'DESC')
		    ->where('pinjam_bukus.status_pinjam', 'Belum Konfirmasi')
		    // ->orWhere('pinjam_bukus.pengingat', 'Aktif')
		    ->get();
    	$data = [
    		'user' => $user,
    		'buku' => $buku,
    		'hariini' => $pengunjunghariini,
    		'mingguini' => $pengunjungmingguini,
    		'bulanini' => $pengunjungbulanini,
    		'tahunini' => $pengunjungtahunini,
    		'semua' => $pengunjungsemua,
    		'notification' => $notification
    	];
    	return view('pages.admin.aktivitas.index')->with($data);
    }
    public function pinjambuku(){
    	$user = Member::where('id_member', Session::get('loginId'))->first();
    	$buku = Buku::where('status', '!=', 'Dipinjam')->orderby('created_at', 'DESC')->get();
    	$pinjam = PinjamBuku::join('bukus', 'bukus.id_buku', '=', 'pinjam_bukus.id_buku')
		    ->join('members', 'members.id_member', '=', 'pinjam_bukus.id_member')
		    ->orderBy('pinjam_bukus.id_pinjam', 'DESC')
		    ->where('pinjam_bukus.status_pinjam', 'Belum Konfirmasi')
		    ->get();
		    $notification = PinjamBuku::join('bukus', 'bukus.id_buku', '=', 'pinjam_bukus.id_buku')
		    ->join('members', 'members.id_member', '=', 'pinjam_bukus.id_member')
		    ->orderBy('pinjam_bukus.id_pinjam', 'DESC')
		    ->where('pinjam_bukus.status_pinjam', 'Belum Konfirmasi')
		    // ->orWhere('pinjam_bukus.pengingat', 'Aktif')
		    ->get();
    	$datauser = Member::all();
    	$data = [
    		'user' => $user,
    		'buku' => $buku,
    		'datauser' => $datauser,
    		'pinjam' => $pinjam,
    		'notification' => $notification
    	];
    	return view('pages.admin.tambah-peminjaman.index')->with($data);
    }
    public function showDataPinjam(Request $request){
		$id = $request->id;
		$data = PinjamBuku::where('id_pinjam', $id)->join('bukus', 'bukus.id_buku', '=', 'pinjam_bukus.id_buku')->join('members', 'members.id_member', '=', 'pinjam_bukus.id_member')->first();
		$tempo = strtotime($data->jatuh_tempo);

		if($data->tanggal_dikembalikan == null){
			$pinjam = strtotime(date('Y-m-d'));
			$terlambat = ($pinjam - $tempo)/(24*60*60);
			if($terlambat > 0){ $pass = $terlambat; } else { $pass = 0; }
		} else {
			$kembali = strtotime($data->tanggal_dikembalikan);
			$telat = ($kembali - $tempo)/(24*60*60);
			if($telat > 0){ $pass = $telat; } else { $pass = 0; }
		}
		if($data->tanggal_dikembalikan == null){
			if(date('Y-m-d') > $data->jatuh_tempo){
				$status = '<small class="text-white" style="background: #FF0000; border-radius: 10px; padding: 6px 8px;">Lewat Jatuh Tempo</small>';
			} else{
				if( ( strtotime($data->jatuh_tempo) - strtotime(date('Y-m-d')) ) < 345600 ){
					$status = '<small class="text-dark" style="background: #FFFF00; border-radius: 10px; padding: 6px 8px;">Mendekati Jatuh Tempo</small>';
				} else{
					$status = '<small class="text-white" style="background: #5278FF; border-radius: 10px; padding: 6px 8px;">Sedang Dipinjam</small>';
				}
			}
		} else{
			$status = '<small class="text-white" style="background: #34B2FF; border-radius: 10px; padding: 6px 8px;">Sudah Dikembalikan</small>';
		}
	    return response()->json(['data' => $data, 'telat' => $pass, 'status' => $status]);
    }
    public function updateAktivitasData(Request $request){
    	if(isset($_POST['savepinjam'])){
    		$status = $request->statuspinjam;
    		if($status == 'Masih Dipinjam'){
    			return back()->with('success', 'Status Berhasil Diperbaharui');
    		} else {
    			$idbuku = $request->id_buku;
    			$idpinjam = $request->id_pinjam;
    			$pinjam = PinjamBuku::where('id_pinjam', $idpinjam)->update(['tanggal_dikembalikan' => date('Y-m-d')]);
    			if($pinjam){
    				$buku = Buku::where('id_buku', $idbuku)->update(['status' => 'Tersedia']);
    				if($buku){
    					return back()->with('success', 'Status Berhasil Diperbaharui'); 
    				}
    			}
    		}
    	} elseif(isset($_POST['usersave'])){
    		$member = Member::where('id_member', $request->id_member)->first();
    		if($member->password == $request->password){
    			$pass = $member->password;
    		} else {
    			$pass = password_hash($request->password, PASSWORD_DEFAULT);
    		}
    		$update = Member::where('id_member', $request->id_member)->update(['nama' => $request->nama, 'password' => $pass]);
    		if($update){
    			return back()->with('success', 'Data anggota berhasil di update');
    		}
    	} elseif(isset($_POST['berita'])){
    		$validated = $request->validate([
		        'judul_berita' => 'required',
		        'isi_berita' => 'required'
		    ]);
		    $berita = Berita::where('id_berita', $request->id_berita);
		    if($validated){
		    	$tujuan_upload = 'assets/images/berita/';
		    	if($request->thumbnail_berita == ''){
		    		$namafile = $berita->first()->feature_image;
		    	} else {
		            $file = $request->file('thumbnail_berita');
		            $namafile = time().'_'.$file->getClientOriginalName();
	            	$file->move($tujuan_upload,$namafile);
		    	}

	            $user = Member::where('id_member', Session::get('loginId'))->first();
	            $data = [
	            	'author' => $user->nama,
	            	'feature_image' => $namafile,
	            	'judul_berita' => $request->judul_berita,
	            	'tanggal_berita' => date('Y-m-d H:i:s'),
	            	'isi_berita' => $request->isi_berita
	            ];
	            $update = $berita->update($data);
	            if($update){
	            	return back()->with('success', 'Berita berhasil diupdate');
	            }
		    }
    	} elseif(isset($_POST['buku'])){
    		$validated = $request->validate([
		        'judul_buku' => 'required',
		        'pengarang' => 'required',
		        'penerbit' => 'required',
		        'tahun_terbit' => 'required',
		        'tempat_terbit' => 'required',
		        'halaman' => 'required',
		        'bahasa' => 'required',
		        'sinopsis' => 'required'
		    ]);
		    $buku = Buku::where('id_buku', $request->id_buku);
		    if($validated){
			    if($request->file_buku =='' && $request->sumber_buku == ''){
			    	if($buku->first()->file == null && $request->sumber_buku== ''){
			    		$validate = $request->validate(['file_buku' => 'required']);
			    	} else {
			    		$namafilebuku = $buku->first()->file;
			    	}
			    } else {
			    	if($request->file_buku != ''){
			    		$tujuan_upload = 'assets/file/buku/';
			            $file = $request->file('file_buku');
			            $namafilebuku = time().'_'.$file->getClientOriginalName();
			            $file->move($tujuan_upload,$namafilebuku);
			        } else {
			        	$namafilebuku = null;
			        }
			    }
			    if($request->cover_buku == ''){
			    	$namafilecover = $buku->first()->cover_buku;
			    } else {
			        $tujuan_upload_cover = 'assets/images/buku/';
		            $file_cover = $request->file('cover_buku');
		            $namafilecover = time().'_'.$file_cover->getClientOriginalName();
		            $file_cover->move($tujuan_upload_cover,$namafilecover);
			    }
			    $data = [
			    	'judul_buku' => $request->judul_buku,
			        'cover_buku' => $namafilecover,
			        'pengarang' => $request->pengarang,
			        'penerbit' => $request->penerbit,
			        'tahun_terbit' => $request->tahun_terbit,
			        'tempat_terbit' => $request->tempat_terbit,
			        'halaman' => $request->halaman,
			        'bahasa' => $request->bahasa,
			        'sinopsis' => $request->sinopsis,
			        'file' => $namafilebuku,
			        'sumber' => $request->sumber_buku,
			    ];
			    $update = $buku->update($data);
		        if($buku){
		        	return back()->with('success', 'Berhasil mengupdate data buku');
		        }
			    
		    }
    	}
    }
    public function dataperpustakaan(){
    	$user = Member::where('id_member', Session::get('loginId'))->first();
    	$buku = Buku::orderby('created_at', 'DESC')->get();
    	$member = Member::where('role', 'User')->orderby('created_at', 'DESC')->get();
    	$berita = Berita::orderby('tanggal_berita', 'DESC')->get();
    	$notification = PinjamBuku::join('bukus', 'bukus.id_buku', '=', 'pinjam_bukus.id_buku')
		    ->join('members', 'members.id_member', '=', 'pinjam_bukus.id_member')
		    ->orderBy('pinjam_bukus.id_pinjam', 'DESC')
		    ->where('pinjam_bukus.status_pinjam', 'Belum Konfirmasi')
		    // ->orWhere('pinjam_bukus.pengingat', 'Aktif')
		    ->get();
    	$data = [
    		'user' => $user,
    		'buku' => $buku,
    		'member' => $member,
    		'berita' => $berita,
    		'notification' => $notification
    	];
    	return view('pages.admin.data-perpustakaan.index', $data);
    }
    public function storepinjambuku(Request $request){
    	date_default_timezone_set('Asia/Jakarta');
    	$now = date('Y-m-d');
    	$strtotime = strtotime($now);
    	$new = $strtotime + 604800;
    	$jatuh_tempo = date('Y-m-d', $new);

    	$pinjam = new PinjamBuku;
    	$pinjam->id_member = $request->id_member;
    	$pinjam->id_buku = $request->id_buku;
    	$pinjam->tanggal_peminjaman = $now;
    	$pinjam->jatuh_tempo = $jatuh_tempo;

    	$pinjam->save();

    	if($pinjam){
    		$update = Buku::where('id_buku', $request->id_buku)->update(['status' => 'Dipinjam']);
    		if($update){
    			return back()->with('success', 'Buku berhasil dipinjamkan');
    		}
    	}
    }
    public function showDataMember(Request $request){
    	$id = $request->id;
    	$data = Member::where('id_member', $id)->first();
    	return response()->json(['data' => $data]);
    }
    public function showDataBuku(Request $request){
    	$id = $request->id;
    	$data = Buku::where('id_buku', $id)->first();
    	return response()->json(['data' => $data]);
    }
    public function editberita(Request $request){
    	$user = Member::where('id_member', Session::get('loginId'))->first();
    	$berita = Berita::where('id_berita', $request->id)->first();
    	$notification = PinjamBuku::join('bukus', 'bukus.id_buku', '=', 'pinjam_bukus.id_buku')
		    ->join('members', 'members.id_member', '=', 'pinjam_bukus.id_member')
		    ->orderBy('pinjam_bukus.id_pinjam', 'DESC')
		    ->where('pinjam_bukus.status_pinjam', 'Belum Konfirmasi')
		    // ->orWhere('pinjam_bukus.pengingat', 'Aktif')
		    ->get();
    	$data = [
    		'user' => $user,
    		'berita' => $berita,
    		'notification' => $notification
    	];
    	return view('pages.admin.data-perpustakaan.edit.berita', $data);
    }
    public function editbuku(Request $request){
    	$user = Member::where('id_member', Session::get('loginId'))->first();
    	$buku = Buku::where('id_buku', $request->id)->first();
    	$notification = PinjamBuku::join('bukus', 'bukus.id_buku', '=', 'pinjam_bukus.id_buku')
		    ->join('members', 'members.id_member', '=', 'pinjam_bukus.id_member')
		    ->orderBy('pinjam_bukus.id_pinjam', 'DESC')
		    ->where('pinjam_bukus.status_pinjam', 'Belum Konfirmasi')
		    // ->orWhere('pinjam_bukus.pengingat', 'Aktif')
		    ->get();
    	$data = [
    		'user' => $user,
    		'buku' => $buku,
    		'notification' => $notification
    	];
    	return view('pages.admin.data-perpustakaan.edit.buku', $data);
    }
    public function profilperpustakaan(){
    	$user = Member::where('id_member', Session::get('loginId'))->first();
    	$profil = ProfilPerusahaan::all();
    	$notification = PinjamBuku::join('bukus', 'bukus.id_buku', '=', 'pinjam_bukus.id_buku')
		    ->join('members', 'members.id_member', '=', 'pinjam_bukus.id_member')
		    ->orderBy('pinjam_bukus.id_pinjam', 'DESC')
		    ->where('pinjam_bukus.status_pinjam', 'Belum Konfirmasi')
		    // ->orWhere('pinjam_bukus.pengingat', 'Aktif')
		    ->get();
    	$data = [
    		'user' => $user,
    		'profil' => $profil,
    		'notification' => $notification
    	];
    	return view('pages.admin.profil-perpustakaan.index')->with($data);
    }
    public function deletePinjam(Request $request){
    	$cek = PinjamBuku::where('id_pinjam', $request->id)->first();
    	$buku = Buku::where('id_buku', $cek->id_buku)->update(['status' => 'Tersedia']);
    	$delete = PinjamBuku::where('id_pinjam', $request->id)->delete();
    	if($delete){
    		return back()->with('success', 'Pesanan dibatalkan');
    	}
    }
    public function TerimaPinjam(Request $request){
    	$now = date('Y-m-d');
    	$strtotime = strtotime($now);
    	$new = $strtotime + 604800;
    	$jatuh_tempo = date('Y-m-d', $new);

    	$data = [
    		'tanggal_peminjaman' => $now,
    		'jatuh_tempo' => $jatuh_tempo,
    		'status_pinjam' => NULL
    	];
    	$update = PinjamBuku::where('id_pinjam', $request->id)->update($data);
    	if($update){
    		return back()->with('success', 'Pesanan diterima');
    	}
    }
}

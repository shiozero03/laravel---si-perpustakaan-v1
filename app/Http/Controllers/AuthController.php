<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Pengunjung;
use Session;

class AuthController extends Controller
{
    public function index(){
        return view('pages.auth.home');
    }
    public function welcomeProcess(Request $request){
        $validated = $request->validate([
            'nama' => 'required',
        ]);
        $tanggal = date('Y-m-d');
        $waktu = date('H:i:s');
        $nama = $request->nama;
        $pengunjung = new Pengunjung;
        $pengunjung->nama_pengunjung = $nama;
        $pengunjung->tanggal_kunjungan = $tanggal;
        $pengunjung->waktu_kunjungan = $waktu;
        $pengunjung->save();
        if($pengunjung){
            return redirect('/welcome?nama='.$nama);
        }
    }
    public function welcome(Request $request){
        if(!isset($_GET['nama']) || $_GET['nama'] == ''){
            return redirect('/');
        } else {
            $nama = $_GET['nama'];
            $cekpengunjung = Pengunjung::where('nama_pengunjung', $nama)->where('tanggal_kunjungan', date('Y-m-d'))->get()->count();
            if($cekpengunjung > 0){
                $data = ['nama' => $nama];
                return view('pages.auth.welcome', $data);
            } else {
                return redirect('/');
            }
        }
    }
    public function login(){
        if(Session::has('loginId') || Session::has('role')){
            if(Session::get('role') == 'User'){
                return redirect('/user');
            }
        }

    	if(isset($_COOKIE['nisn']) && isset($_COOKIE['password'])){
    		$data = [
    			'nisn' => $_COOKIE['nisn'],
    			'password' => $_COOKIE['password']
    		];
    	} else{
    		$data = [
    			'nisn' => '',
    			'password' => ''
    		];
    	}
    	return view('pages.auth.login')->with($data);
    }
    public function register(){
        if(Session::has('loginId') || Session::has('role')){
            if(Session::get('role') == 'User'){
                return redirect('/user');
            }
        }
    	return view('pages.auth.register');
    }
    public function registerProcess(Request $request){
    	$validated = $request->validate([
            'nisn' => 'required|unique:members',
            'password' => 'required|min:6',
            'no_hp' => 'required',
            'alamat' => 'required',
            'pekerjaan' => 'required'
        ]);

        $member = new Member;
        $member->nisn = $request->nisn;
    	$member->nama = 'User';
        $member->password = password_hash($request->password, PASSWORD_DEFAULT);
    	$member->jenis_kelamin = $request->jenis_kelamin;
    	$member->tanggal_lahir = $request->tahun.'-'.$request->bulan.'-'.$request->tanggal;
    	$member->no_hp = $request->no_hp;
    	$member->alamat = $request->alamat;
    	$member->pekerjaan = $request->pekerjaan;
    	$member->role = 'User';

    	$member->save();
    	if($member){
    		return redirect('/login')->with('success', 'Data anda berhasil didaftarkan');
    	}
    }
    public function loginProcess(Request $request){
    	$validated = $request->validate([
            'nisn' => 'required',
            'password' => 'required|min:6'
        ]);

    	$ceknisn = Member::where('nisn', $request->nisn)->first();
    	if(!$ceknisn){
    		return back()->with('error', 'NISN tidak ditemukan');
    	} else {
    		if(!password_verify($request->password, $ceknisn->password)){
    			return back()->with('error', 'NISN atau Password tidak sesuai');
    		} else{
    			if($request->ingat){
    				setcookie('nisn', $request->nisn);
    				setcookie('password', $request->password);
    			} else {
    				setcookie("nisn", "", time() - 3600);
    				setcookie("password", "", time() - 3600);
    			}
    			$request->session()->put('loginId', $ceknisn->id_member);
                $request->session()->put('role', $ceknisn->role);
                if($ceknisn->role == 'User'){
                	return redirect('/user')->with('success', 'Anda berhasil login sebagai user');
                } else {
                    return redirect('/admin')->with('success', 'Anda berhasil login sebagai administrator');
                }

    		}
    	}
    }
    public function logout(){
        if(Session::has('loginId') && Session::has('role')){
            Session::pull('loginId');
            Session::pull('role');
            return redirect('/login')->with('success', 'Berhasil logout');
        }
    }
}

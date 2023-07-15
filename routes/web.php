<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserViewController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::controller(AuthController::class)->group(function(){
	Route::get('/', 'index')->name('home');
	Route::post('/process/welcome', 'welcomeProcess')->name('welcome.process');
	Route::get('/welcome', 'welcome')->name('welcome');

	Route::get('/login', 'login')->name('login');
	Route::post('/login/process', 'loginProcess')->name('loginProcess');
	Route::get('/register', 'register')->name('register');
	Route::post('/register/process', 'registerProcess')->name('registerProcess');
	Route::get('/logout', 'logout')->name('logout');
});
Route::middleware('islogin')->group(function(){
	Route::middleware('isadmin')->group(function(){
		Route::prefix('/user')->group(function(){
			Route::controller(UserViewController::class)->group(function(){
				Route::get('/', 'beranda')->name('user.beranda');
				Route::get('/riwayat-peminjaman', 'riwayatPinjam')->name('user.pinjam');
				Route::prefix('/katalog-buku')->group(function(){
					Route::get('/', 'catalog')->name('user.catalog');
					Route::get('/view/{id}', 'catalogView');
					Route::get('/simpan/{id}', 'catalogSimpan');
					Route::get('/pinjam/{id}', 'catalogPinjam');
				});
				Route::prefix('/daftar-buku')->group(function(){
					Route::get('/', 'daftarBuku')->name('user.daftarBuku');
					Route::get('/hapus/{id}', 'hapusdaftarBuku');
				});
				Route::prefix('/profil')->group(function(){
					Route::get('/', 'profil')->name('user.profil');
					Route::post('/update', 'updateProfil')->name('user.update.profil');
				});
				Route::get('/profil-perpustakaan', 'profilperpustakaan')->name('user.profilperpustakaan');
				Route::prefix('/berita-perpustakaan')->group(function(){
					Route::get('/', 'berita')->name('user.berita');
					Route::get('/view/{id}', 'beritaView');
				});
			});
		});
	});
	Route::middleware('isuser')->group(function(){
		Route::prefix('/admin')->group(function(){
			Route::controller(AdminController::class)->group(function(){
				Route::get('/', 'dashboard')->name('admin.dashboard');
				Route::get('/tambah-data', 'tambahData')->name('admin.tambahdata');
				Route::post('/tambah-data/store', 'storeData')->name('admin.storedata');
				Route::get('/aktivitas', 'aktivitas')->name('admin.aktivitas');
				Route::post('/aktivitas/updateAktivitas', 'updateAktivitasData')->name('admin.updateAktivitasdata');
				Route::get('/pinjam-buku', 'pinjambuku')->name('admin.pinjambuku');
				Route::post('/pinjam-buku/store', 'storepinjambuku')->name('admin.storepinjambuku');
				Route::post('/api/pinjambuku', 'showDataPinjam')->name('showDataPinjam');
				Route::get('/pinjam-buku/delete/{id}', 'deletePinjam');
				Route::get('/pinjam-buku/terima/{id}', 'terimaPinjam');
				Route::get('/data-perpustakaan', 'dataperpustakaan')->name('admin.dataperpustakaan');
				Route::post('/api/member', 'showDataMember')->name('showDataMember');
				Route::post('/api/buku', 'showDataBuku')->name('showDataBuku');
				Route::get('/data-perpustakaan/edit/berita/{id}', 'editberita');
				Route::get('/data-perpustakaan/edit/buku/{id}', 'editbuku');
				Route::get('/profil-perpustakaan', 'profilperpustakaan')->name('admin.profilperpustakaan');
			});
		});
	});
});
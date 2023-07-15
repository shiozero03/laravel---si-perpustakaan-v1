@extends('pages.admin.layout')
@section('title', 'Data Perpustakaan')
@section('content')
<script type="text/javascript">
	document.getElementsByClassName('menu-side')[4].classList.add('active')
</script>
<script type="text/javascript" src="{{ asset('assets/js/ckeditor/ckeditor.js') }}"></script>
<style type="text/css">
	.buku-content{
		border: 1px solid #D5D5D5;
		box-shadow: 12px 12px 10px rgba(0, 0, 0, 0.05);
		border-radius: 6px;
		padding: 22px;
	}
	.buku-content input{
		background: rgba(16, 156, 241, 0.165);
	}
	.page-header h3{
		font-weight: 500;
		font-size: 26px;
	}
	.cover-buku{
		background: #EFF0F4;
		border: 1px solid #D5D5D5;
		box-shadow: 12px 12px 10px rgba(0, 0, 0, 0.05);
		border-radius: 6px;
		padding:35px 28px;
	}
	.cover-luar{
		background: #FFFFFF;
		border: 1px solid #D5D5D5;
		box-shadow: 12px 12px 10px rgba(0, 0, 0, 0.05);
		position: relative;
		margin-bottom: 22px;
	}
	.isi-buku{
		margin: 22px;
	}
	.isi-buku h3{
		font-weight: 600;
		font-size: 24px;
		color: #109CF1;
	}
	.form-riwayat{
		background-color: #fff;
		margin: 30px auto;
		border-radius: 10px;
		overflow: hidden;
	}
	.riwayat-menu{
		border: 1px solid #D5D5D5;
	}
	.riwayat-menu.active{
		background-color: #109CF1;
	}
	.riwayat-menu.active .title-menu-add{
		color: #fff;
	}
	.title-menu-add{
		color: #109CF1;
	}
</style>
<div class="profil">
	<div class="bg-blue rounded page-header">
		<div class="px-3 text-white py-3">
			<h3 class="border-start border-white border-2 py-1 my-0">
				<span class="ms-3">Data Perpustakaan</span>
			</h3>
		</div>
	</div>
	<div class="form-search">
		<div class="form-riwayat row">
			<div class="col-4 text-center riwayat-menu active">
				<a href="javascript:;" onclick="this.href='{{ route('admin.dataperpustakaan') }}?filter=buku'" class="text-decoration-none text-center w-100">
					<h6 style="margin-bottom: 18px" class="my-3 title-menu-add"><span>BUKU</span></h6>
				</a>
			</div>
			<div class="col-4 text-center riwayat-menu">
				<a href="javascript:;" onclick="this.href='{{ route('admin.dataperpustakaan') }}?filter=anggota'" class="text-decoration-none text-center w-100">
					<h6 style="margin-bottom: 18px" class="my-3 title-menu-add"><span>ANGGOTA</span></h6>
				</a>
			</div>
			<div class="col-4 text-center riwayat-menu">
				<a href="javascript:;" onclick="this.href='{{ route('admin.dataperpustakaan') }}?filter=berita'" class="text-decoration-none text-center w-100">
					<h6 style="margin-bottom: 18px" class="my-3 title-menu-add"><span>BERITA</span></h6>
				</a>
			</div>
		</div>
	</div>
	<div class="bg-white buku-content">
		<div>
			<form enctype="multipart/form-data" action="{{ route('admin.updateAktivitasdata') }}" method="post">
				@csrf
				<input type="hidden" name="id_buku" value="{{ $buku->id_buku }}">
				<div class="form-group mb-2">
					<label><strong>Cover Buku</strong></label>
					<div class="text-center">
						<div class="row">
							<div class="col-4"><br></div>
							<div class="col-4">
								<label>
									<img src="{{ asset('assets/images/buku/'.$buku->cover_buku) }}" id="imagefet" style="max-width: 100%">
									<input id="cover_buku" type="file" name="cover_buku" class="form-control d-none" accept="image/png, image/svg, image/jpg, image/jpeg">
									<div class="btn bg-blue text-white mt-2 w-100"><i class="fas fa-upload me-2"></i>Tambahkan Cover</div>
								</label>
								@error('cover_buku')<small class="text-danger"><em>{{ $message }}</em></small>@enderror
							</div>
						</div>
					</div>
				</div>
				<div class="form-group mb-2">
					<label><strong>Judul Buku</strong></label>
					<input type="text" name="judul_buku" class="form-control mt-2" value="{{ $buku->judul_buku }}">
					@error('judul_buku')<small class="text-danger"><em>{{ $message }}</em></small>@enderror
				</div>
				<label><strong>Deskripsi Buku</strong></label>
				<div class="row mt-1">
					<div class="form-group mb-2 col-6">
						<label><small><strong>Pengarang</strong></small></label>
						<input type="text" value="{{ $buku->pengarang }}" name="pengarang" class="form-control mt-2">
						@error('pengarang')<small class="text-danger"><em>{{ $message }}</em></small>@enderror
					</div>
					<div class="form-group mb-2 col-6">
						<label><small><strong>Penerbit</strong></small></label>
						<input type="text" name="penerbit" class="form-control mt-2" value="{{ $buku->penerbit }}">
						@error('penerbit')<small class="text-danger"><em>{{ $message }}</em></small>@enderror
					</div>
					<div class="form-group mb-2 col-6">
						<label><small><strong>Tahun Terbit</strong></small></label>
						<input type="number" name="tahun_terbit" class="form-control mt-2" value="{{ $buku->tahun_terbit }}">
						@error('tahun_terbit')<small class="text-danger"><em>{{ $message }}</em></small>@enderror
					</div>
					<div class="form-group mb-2 col-6">
						<label><small><strong>Tempat Terbit</strong></small></label>
						<input type="text" name="tempat_terbit" class="form-control mt-2" value="{{ $buku->tempat_terbit }}">
						@error('tempat_terbit')<small class="text-danger"><em>{{ $message }}</em></small>@enderror
					</div>
					<div class="form-group mb-2 col-6">
						<label><small><strong>Halaman</strong></small></label>
						<input type="number" name="halaman" class="form-control mt-2" value="{{ $buku->halaman }}">
						@error('halaman')<small class="text-danger"><em>{{ $message }}</em></small>@enderror
					</div>
					<div class="form-group mb-2 col-6">
						<label><small><strong>Bahasa</strong></small></label>
						<input type="text" name="bahasa" class="form-control mt-2" value="{{ $buku->bahasa }}">
						@error('bahasa')<small class="text-danger"><em>{{ $message }}</em></small>@enderror
					</div>
				</div>
				<div class="mt-1">
					<div class="form-group">
						<label class="mb-2"><small><strong>Sinopsis</strong></small></label>
						<textarea class="ckeditor" id="ckeditor" name="sinopsis">{{ $buku->sinopsis }}</textarea>
						@error('sinopsis')<small class="text-danger"><em>{{ $message }}</em></small>@enderror
					</div>
				</div>
				<div class="row mt-1">
					<div class="form-group col-3">
						<label class="mb-2"><small><strong>File Buku Elektronik</strong></small></label>
						<input id="file_buku" type="file" name="file_buku" class="form-control d-none" accept="application/pdf">
						<label for="file_buku" class="btn btn-outline-secondary w-100"><i class="fas fa-upload me-2"></i>Tambahkan File</label>
						<div id="namafile"></div>
						@if($buku->file != null)
							<label class="mt-2">File Sebelumnya :</label>
							<iframe src="{{ asset('assets/file/buku/'.$buku->file) }}" width="100%"></iframe>
						@endif
					</div>
					<div class="form-group col-9">
						<label class="mb-2"><small><strong>Sumber Buku</strong></small></label>
						<input type="text" name="sumber_buku" class="form-control" value="{{ $buku->sumber }}">
					</div>
					<div class="col-12">
						@error('file_buku')<small class="text-danger"><em>file atau sumber buku harus diisi</em></small>@enderror
					</div>
					<div class="col-12 mt-5">
						<div class="w-100 text-end">
							<button name="buku" class="btn bg-blue text-white">Simpan</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	let icon = document.getElementById('cover_buku');
    let imagefet = document.getElementById('imagefet');

    icon.addEventListener('change', function () {
        gambar(this);
    })
    function gambar(a) {
        if (a.files && a.files[0]) {     
            var reader = new FileReader();    
            reader.onload = function (e) {
                imagefet.src=e.target.result;
            }    
            reader.readAsDataURL(a.files[0]);
        }
    }
    let filebuku = document.getElementById('file_buku');
    let namafile = document.getElementById('namafile');

    filebuku.addEventListener('change', function () {
        file(this);
    })
    function file(a) {
        $('#namafile').html(filebuku.files.item(0).name)
    }
</script>
@endsection
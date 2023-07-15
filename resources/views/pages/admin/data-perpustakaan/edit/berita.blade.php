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
			<div class="col-4 text-center riwayat-menu">
				<a href="javascript:;" onclick="this.href='{{ route('admin.dataperpustakaan') }}?filter=buku'" class="text-decoration-none text-center w-100">
					<h6 style="margin-bottom: 18px" class="my-3 title-menu-add"><span>BUKU</span></h6>
				</a>
			</div>
			<div class="col-4 text-center riwayat-menu">
				<a href="javascript:;" onclick="this.href='{{ route('admin.dataperpustakaan') }}?filter=anggota'" class="text-decoration-none text-center w-100">
					<h6 style="margin-bottom: 18px" class="my-3 title-menu-add"><span>ANGGOTA</span></h6>
				</a>
			</div>
			<div class="col-4 text-center riwayat-menu active">
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
				<input type="hidden" name="id_berita" value="{{ $berita->id_berita }}">
				<div class="form-group mb-2">
					<label><strong>Thumbnail Berita</strong></label>
					<div class="text-center">
						<div class="row">
							<div class="col-4"><br></div>
							<div class="col-4">
								<label>
									<img id="imagefet" src="{{ asset('assets/images/berita/'.$berita->feature_image) }}" style="max-width: 100%">
									<input type="file" name="thumbnail_berita" id="thumbnail_berita" class="form-control d-none" accept="image/png, image/svg, image/jpg, image/jpeg">
									<div class="btn bg-blue text-white mt-2 w-100"><i class="fas fa-upload me-2"></i>Tambahkan Foto</div>
								</label>
								@error('thumbnail_berita')<small class="text-danger"><em>{{ $message }}</em></small>@enderror
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label><strong>Judul Berita</strong></label>
					<input type="text" name="judul_berita" class="form-control mt-2" value="{{ $berita->judul_berita }}">
					@error('judul_berita')<small class="text-danger"><em>{{ $message }}</em></small>@enderror
				</div>
				<div class="mt-1">
					<div class="form-group">
						<label class="mb-2"><strong>Isi Berita</strong></label>
						<textarea class="ckeditor" id="ckeditor" name="isi_berita">{{ $berita->isi_berita }}</textarea>
						@error('isi_berita')<small class="text-danger"><em>{{ $message }}</em></small>@enderror
					</div>
				</div>
				<div class="row mt-1">
					<div class="col-12 mt-4">
						<div class="w-100 text-end">
							<button name="berita" class="btn bg-blue text-white">Simpan</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	let icon = document.getElementById('thumbnail_berita');
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
</script>
@endsection
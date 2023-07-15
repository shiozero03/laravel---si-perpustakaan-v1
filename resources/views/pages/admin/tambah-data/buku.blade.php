<script type="text/javascript">
	document.getElementsByClassName('riwayat-menu')[0].classList.add('active');
</script>
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
</style>
<div class="bg-white buku-content">
	<div>
		<form method="post" enctype="multipart/form-data" action="{{ route('admin.storedata') }}">
			@csrf
			<div class="form-group mb-2">
				<label><strong>Cover Buku</strong></label>
				<div class="text-center">
					<div class="row">
						<div class="col-4"><br></div>
						<div class="col-4">
							<label>
								<img src="{{ asset('assets/images/export.png') }}" id="imagefet" style="max-width: 100%">
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
				<input type="text" name="judul_buku" class="form-control mt-2" value="{{ old('judul_buku') }}">
				@error('judul_buku')<small class="text-danger"><em>{{ $message }}</em></small>@enderror
			</div>
			<label><strong>Deskripsi Buku</strong></label>
			<div class="row mt-1">
				<div class="form-group mb-2 col-6">
					<label><small><strong>Pengarang</strong></small></label>
					<input type="text" value="{{ old('pengarang') }}" name="pengarang" class="form-control mt-2">
					@error('pengarang')<small class="text-danger"><em>{{ $message }}</em></small>@enderror
				</div>
				<div class="form-group mb-2 col-6">
					<label><small><strong>Penerbit</strong></small></label>
					<input type="text" name="penerbit" class="form-control mt-2" value="{{ old('penerbit') }}">
					@error('penerbit')<small class="text-danger"><em>{{ $message }}</em></small>@enderror
				</div>
				<div class="form-group mb-2 col-6">
					<label><small><strong>Tahun Terbit</strong></small></label>
					<input type="number" name="tahun_terbit" class="form-control mt-2" value="{{ old('tahun_terbit') }}">
					@error('tahun_terbit')<small class="text-danger"><em>{{ $message }}</em></small>@enderror
				</div>
				<div class="form-group mb-2 col-6">
					<label><small><strong>Tempat Terbit</strong></small></label>
					<input type="text" name="tempat_terbit" class="form-control mt-2" value="{{ old('tempat_terbit') }}">
					@error('tempat_terbit')<small class="text-danger"><em>{{ $message }}</em></small>@enderror
				</div>
				<div class="form-group mb-2 col-6">
					<label><small><strong>Halaman</strong></small></label>
					<input type="number" name="halaman" class="form-control mt-2" value="{{ old('halaman') }}">
					@error('halaman')<small class="text-danger"><em>{{ $message }}</em></small>@enderror
				</div>
				<div class="form-group mb-2 col-6">
					<label><small><strong>Bahasa</strong></small></label>
					<input type="text" name="bahasa" class="form-control mt-2" value="{{ old('bahasa') }}">
					@error('bahasa')<small class="text-danger"><em>{{ $message }}</em></small>@enderror
				</div>
			</div>
			<div class="mt-1">
				<div class="form-group">
					<label class="mb-2"><small><strong>Sinopsis</strong></small></label>
					<textarea class="ckeditor" id="ckeditor" name="sinopsis">{{ old('sinopsis') }}</textarea>
					@error('sinopsis')<small class="text-danger"><em>{{ $message }}</em></small>@enderror
				</div>
			</div>
			<div class="row mt-1">
				<div class="form-group col-3">
					<label class="mb-2"><small><strong>File Buku Elektronik</strong></small></label>
					<input id="file_buku" type="file" name="file_buku" class="form-control d-none" accept="application/pdf">
					<label for="file_buku" class="btn btn-outline-secondary w-100"><i class="fas fa-upload me-2"></i>Tambahkan File</label>
					<div id="namafile"></div>
				</div>
				<div class="form-group col-9">
					<label class="mb-2"><small><strong>Sumber Buku</strong></small></label>
					<input type="text" name="sumber_buku" class="form-control">
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
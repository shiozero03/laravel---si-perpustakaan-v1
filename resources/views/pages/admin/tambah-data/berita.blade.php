<script type="text/javascript">
	document.getElementsByClassName('riwayat-menu')[1].classList.add('active');
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
		<form enctype="multipart/form-data" action="{{ route('admin.storedata') }}" method="post">
			@csrf
			<div class="form-group mb-2">
				<label><strong>Thumbnail Berita</strong></label>
				<div class="text-center">
					<div class="row">
						<div class="col-4"><br></div>
						<div class="col-4">
							<label>
								<img id="imagefet" src="{{ asset('assets/images/export.png') }}" style="max-width: 100%">
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
				<input type="text" name="judul_berita" class="form-control mt-2" value="{{ old('judul_berita') }}">
				@error('judul_berita')<small class="text-danger"><em>{{ $message }}</em></small>@enderror
			</div>
			<div class="mt-1">
				<div class="form-group">
					<label class="mb-2"><strong>Isi Berita</strong></label>
					<textarea class="ckeditor" id="ckeditor" name="isi_berita">{{ old('isi_berita') }}</textarea>
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
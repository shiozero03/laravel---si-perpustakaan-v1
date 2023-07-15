<script type="text/javascript">
	document.getElementsByClassName('riwayat-menu')[2].classList.add('active');
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
		<form action="{{ route('admin.storedata') }}" method="post">
			@csrf
			<div class="form-group">
				<label><strong>Nama Section</strong></label>
				<input type="text" name="nama_section" class="form-control mt-2" value="{{ old('nama_section') }}">
				@error('nama_section')<small class="text-danger"><em>{{ $message }}</em></small>@enderror
			</div>
			<div class="mt-3">
				<div class="form-group">
					<textarea class="ckeditor" id="ckeditor" name="teks_section">{{ old('teks_section') }}</textarea>
					@error('teks_section')<small class="text-danger"><em>{{ $message }}</em></small>@enderror
				</div>
			</div>
			<div class="row mt-1">
				<div class="col-12 mt-4">
					<div class="w-100 text-end">
						<button name="profil" class="btn bg-blue text-white">Simpan</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
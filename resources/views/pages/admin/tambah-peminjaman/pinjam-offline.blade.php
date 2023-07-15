<script type="text/javascript">
	document.getElementsByClassName('riwayat-menu')[0].classList.add('active');
</script>
<div class="bg-white buku-content">
	<form action="{{ route('admin.storepinjambuku') }}" method="post">
		@csrf
		<div class="row">
			<div class="col-6">
				<h5><strong>Cari User</strong></h5>
				<select class="userSelect form-control" required="" name="id_member" id="userchange">
					<option disabled="" selected=""><br></option>
					@foreach($datauser as $ds)
						<option value="{{ $ds->id_member }}">{{ $ds->nisn }} - {{ $ds->nama }}</option>
					@endforeach
				</select>
				<br>
				<br>
				<div class="border p-2 rounded d-none" required="" id="userView">
					<label>Nama Peminjam</label>
					<input type="text" name="nama" class="form-control" readonly="">
					<label>NISN Peminjam</label>
					<input type="text" name="nisn" class="form-control" readonly="">
					<label>Gender Peminjam</label>
					<input type="text" name="gender" class="form-control" readonly="">
					<label>No. Hp Peminjam</label>
					<input type="text" name="no_hp" class="form-control" readonly="">
					<label>Alamat Peminjam</label>
					<textarea name="alamat" class="form-control" readonly="">
					</textarea>
				</div>
			</div>
			<div class="col-6">
				<h5><strong>Cari Buku</strong></h5>
				<select class="bookSelect form-control" name="id_buku" id="bukuchange">
					<option disabled="" selected=""><br></option>
					@foreach($buku as $book)
						<option value="{{ $book->id_buku }}">{{ $book->no_panggil }} - {{ $book->judul_buku }}</option>
					@endforeach
				</select>
				<br><br>
				<div class="border p-2 rounded d-none" id="bukuView">
					<img width="150px" height="180px" src="" class="rounded" name="cover_buku">
					<br>
					<label>Judul Buku</label>
					<input type="text" name="judul_buku" class="form-control" readonly="">
					<label>Nomor Panggil</label>
					<input type="text" name="no_panggil" class="form-control" readonly="">
					<label>Pengarang</label>
					<input type="text" name="pengarang" class="form-control" readonly="">
					</textarea>
				</div>
			</div>
		</div>
		<h6 class="mt-3"><em>Batas waktu tempo peminjaman adalah 7 hari setelah menyimpan data ini</em></h6>
		<button class="btn btn-primary w-100">Simpan</button>
	</form>
</div>
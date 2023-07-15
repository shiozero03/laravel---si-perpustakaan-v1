<script type="text/javascript">
	document.getElementsByClassName('riwayat-menu')[1].classList.add('active');
</script>
<style type="text/css">
	.pesan-buku{
		padding: 20px 50px;
		border: 1px solid #D5D5D5;
		box-shadow: 12px 12px 10px rgba(0, 0, 0, 0.05);
		border-radius: 6px;
		margin-bottom: 20px;
	}
</style>
<div class="bg-white buku-content">
	<div>
		@foreach($pinjam as $pin)
		<div class="pesan-buku d-flex align-items-center">
			<div class="col-10">
				<h4><strong>{{ $pin->nisn }} - {{ $pin->nama }}</strong></h4>
				<span><strong>Pesan Buku : </strong>{{ $pin->judul_buku }}</span>
			</div>
			<div class="col-2 text-end">
				<a href="javascript:;" onclick="this.href='{{ route('admin.pinjambuku') }}/terima/{{ $pin->id_pinjam }}'" class="btn text-white my-1 w-100" style="background-color: #109CF1;"><strong>Terima</strong></a><br>
				<a href="javascript:;" onclick="this.href='{{ route('admin.pinjambuku') }}/delete/{{ $pin->id_pinjam }}'" class="btn bg-white my-1 w-100" style="color: #109CF1; border: 1px solid #109CF1"><strong>Batalkan</strong></a>
			</div>
		</div>
		@endforeach
	</div>
</div>
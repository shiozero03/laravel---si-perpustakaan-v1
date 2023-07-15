@extends('pages.admin.layout')
@section('title', 'Beranda')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
<script type="text/javascript">
	document.getElementsByClassName('menu-side')[0].classList.add('active')
</script>
<style type="text/css">
	.total-pengunjung{
		background: #B4E4FF;
		border: 1px solid #D5D5D5;
		border-radius: 4px;
		padding: 21px;
		min-height: 120px;
	}
	.buku-dipinjam{
		background: #E5FDD1;
		border: 1px solid #D5D5D5;
		border-radius: 4px;
		padding: 21px;
		min-height: 120px;
	}
	.jatuh-tempo{
		background: #F8EAD8;
		border: 1px solid #D5D5D5;
		border-radius: 4px;
		padding: 21px;
		min-height: 120px;
	}
	.small-word{
		font-size: 13px;
	}
	.text-medium{
		font-size: 14px;
	}
</style>
<div class="row">
	<div style="width: 65%">
		<div class="row">
			<div class="col-4">
				<div class="total-pengunjung">
					<h6><i class="fas fa-users" style="color: #21A7B9"></i><br></h6>
					<h5 class="my-0"><strong>{{ $pengunjung }}</strong></h5>
					<span class="text-medium">Total Pengunjung</span>
				</div>
			</div>
			<div class="col-4">
				<div class="buku-dipinjam">
					<h6><i class="fas fa-book-open" style="color: #66B921"></i><br></h6>
					<h5 class="my-0"><strong>{{ $pinjam }}</strong></h5>
					<span class="text-medium">Buku Sedang Dipinjam</span>
				</div>
			</div>
			<div class="col-4">
				<div class="jatuh-tempo">
					<h6><i class="fas fa-clock" style="color: #FF4A4A"></i><br></h6>
					<h5 class="my-0"><strong>{{ $tempo }}</strong></h5>
					<span class="text-medium">Buku Jatuh Tempo</span>
				</div>
			</div>
		</div>
		<br>
		<div class="statistik bg-white p-3 my-2 rounded">
			<h2 class="mb-3"><strong>Statistik Pengunjung Perpustakaan</strong></h2>
			<canvas id="densityChart" width="100%" height="50px"></canvas>
		</div>
		<br>
		<div class="mb-2">
			<div class="table-pengunjung p-3 bg-white">
				<div class="d-flex position-relative">
					<h6><strong>Data Anggota</strong></h6>
					<a href="javascript:;" onclick="this.href='{{ route('admin.dataperpustakaan') }}?filter=anggota'" class="text-decoration-none ms-2 mt-1"><small>selengkapnya</small></a>
				</div>
				<div class="d-flex mt-3">
					<div class="col-3 small-word">
						<span>NISN</span>
					</div>
					<div class="col-4 small-word">
						<span class="ms-2">Nama Anggota</span>
					</div>
					<div class="col-4">
						<span class="ms-2">Jumlah Buku Pinjam</span>
					</div>
				</div>
				<hr class="mt-2 mb-3">
				@foreach($member as $mem)
					<div class="d-flex mb-2">
						<div class="col-3 text-medium">
							<strong>{{ $mem->nisn }}</strong>
						</div>
						<div class="col-4 text-medium">
							<strong class="ms-2">{{ $mem->nama }}</strong>
						</div>
						<div class="col-4 text-medium">
							<strong class="ms-2">
								<?php
								echo DB::table('pinjam_bukus')->join('members', 'members.id_member', '=', 'pinjam_bukus.id_member')->where('pinjam_bukus.tanggal_dikembalikan', null)->where('members.id_member', $mem->id_member)->get()->count().' Buku';
							?>
							</strong>
						</div>
						<div class="col-1 text-medium">
							<strong class="ms-2">
								<i class="fas fa-bars"></i>
							</strong>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
	<div style="width: 35%">
		<div class="mb-2">
			<div class="table-pengunjung p-3 bg-white">
				<div class="d-flex position-relative">
					<h6><strong>Data Pengunjung</strong></h6>
					<a href="javascript:;" onclick="this.href='{{ route('admin.aktivitas') }}?filter=pengunjung'" class="text-decoration-none ms-2 mt-1"><small>selengkapnya</small></a>
				</div>
				<div class="d-flex mt-3">
					<div class="col-7 small-word">
						<small>PENGUNJUNG</small>
					</div>
					<div class="col-5 small-word">
						<small class="ms-2">TANGGAL KUNJUNGAN</small>
					</div>
				</div>
				<hr class="mt-2 mb-3">
				@foreach($visitor as $pen)
					<div class="d-flex mb-1">
						<div class="col-7 text-medium">
							<strong>{{ $pen->nama_pengunjung }}</strong>
						</div>
						<div class="col-5 text-medium">
							<span class="ms-2">{{ $pen->tanggal_kunjungan }}</span>
						</div>
					</div>
				@endforeach
			</div>
		</div>
		<div class="mb-2">
			<div class="table-buku p-3 bg-white">
				<div class="d-flex position-relative">
					<h6><strong>Data Buku</strong></h6>
					<a href="javascript:;" onclick="this.href='{{ route('admin.dataperpustakaan') }}?filter=buku'" class="text-decoration-none ms-2 mt-1"><small>selengkapnya</small></a>
				</div>
				<div class="d-flex mt-3">
					<div class="col-7 small-word">
						<small>JUDUL BUKU</small>
					</div>
					<div class="col-5 small-word">
						<small class="ms-2">PENGARANG</small>
					</div>
				</div>
				<hr class="mt-2 mb-3">
				@foreach($buku as $book)
					<div class="d-flex mb-1">
						<div class="col-7 text-medium">
							<strong>{{ $book->judul_buku }}</strong>
						</div>
						<div class="col-5 text-medium">
							<span class="ms-2">{{ $book->pengarang }}</span>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
<?php
	$date = strtotime(date('Y-m-d'));
	$pengunjunghariini = DB::table('pengunjungs')->where('tanggal_kunjungan', date('Y-m-d'))->get()->count();
	$pengunjungkemaren = DB::table('pengunjungs')->where('tanggal_kunjungan', date('Y-m-d', ($date - (1*24*60*60)) ))->get()->count();
	$pengunjungduahari = DB::table('pengunjungs')->where('tanggal_kunjungan', date('Y-m-d', ($date - (2*24*60*60)) ))->get()->count();
	$pengunjungtigahari = DB::table('pengunjungs')->where('tanggal_kunjungan', date('Y-m-d', ($date - (3*24*60*60)) ))->get()->count();
	$pengunjungempathari = DB::table('pengunjungs')->where('tanggal_kunjungan', date('Y-m-d', ($date - (4*24*60*60)) ))->get()->count();
	$pengunjunglimahari = DB::table('pengunjungs')->where('tanggal_kunjungan', date('Y-m-d', ($date - (5*24*60*60)) ))->get()->count();
	$pengunjungenamhari = DB::table('pengunjungs')->where('tanggal_kunjungan', date('Y-m-d', ($date - (6*24*60*60)) ))->get()->count();

	$pinjamanhariini = DB::table('pinjam_bukus')->where('tanggal_peminjaman', date('Y-m-d'))->get()->count();
	$pinjamankemaren = DB::table('pinjam_bukus')->where('tanggal_peminjaman', date('Y-m-d', ($date - (1*24*60*60)) ))->get()->count();
	$pinjamanduahari = DB::table('pinjam_bukus')->where('tanggal_peminjaman', date('Y-m-d', ($date - (2*24*60*60)) ))->get()->count();
	$pinjamantigahari = DB::table('pinjam_bukus')->where('tanggal_peminjaman', date('Y-m-d', ($date - (3*24*60*60)) ))->get()->count();
	$pinjamanempathari = DB::table('pinjam_bukus')->where('tanggal_peminjaman', date('Y-m-d', ($date - (4*24*60*60)) ))->get()->count();
	$pinjamanlimahari = DB::table('pinjam_bukus')->where('tanggal_peminjaman', date('Y-m-d', ($date - (5*24*60*60)) ))->get()->count();
	$pinjamanenamhari = DB::table('pinjam_bukus')->where('tanggal_peminjaman', date('Y-m-d', ($date - (6*24*60*60)) ))->get()->count();

	$hariini = date('D d');
	$kemaren = date('D d', ($date - (1*24*60*60)));
	$duahari = date('D d', ($date - (2*24*60*60)));
	$tigahari = date('D d', ($date - (3*24*60*60)));
	$empathari = date('D d', ($date - (4*24*60*60)));
	$limahari = date('D d', ($date - (5*24*60*60)));
	$enamhari = date('D d', ($date - (6*24*60*60)));
?>
<div class="data">
	<input type="hidden" name="penhariini" value="{{ $pengunjunghariini }}" id="penhariini">
	<input type="hidden" name="penkemaren" value="{{ $pengunjungkemaren }}" id="penkemaren">
	<input type="hidden" name="penduahari" value="{{ $pengunjungduahari }}" id="penduahari">
	<input type="hidden" name="pentigahari" value="{{ $pengunjungtigahari }}" id="pentigahari">
	<input type="hidden" name="penempathari" value="{{ $pengunjungempathari }}" id="penempathari">
	<input type="hidden" name="penlimahari" value="{{ $pengunjunglimahari }}" id="penlimahari">
	<input type="hidden" name="penenamhari" value="{{ $pengunjungenamhari }}" id="penenamhari">

	<input type="hidden" name="pinhariini" value="{{ $pinjamanhariini }}" id="pinhariini">
	<input type="hidden" name="pinkemaren" value="{{ $pinjamankemaren }}" id="pinkemaren">
	<input type="hidden" name="pinduahari" value="{{ $pinjamanduahari }}" id="pinduahari">
	<input type="hidden" name="pintigahari" value="{{ $pinjamantigahari }}" id="pintigahari">
	<input type="hidden" name="pinempathari" value="{{ $pinjamanempathari }}" id="pinempathari">
	<input type="hidden" name="pinlimahari" value="{{ $pinjamanlimahari }}" id="pinlimahari">
	<input type="hidden" name="pinenamhari" value="{{ $pinjamanenamhari }}" id="pinenamhari">

	<input type="hidden" name="hariini" value="{{ strtoupper($hariini) }}" id="hariini">
	<input type="hidden" name="kemaren" value="{{ strtoupper($kemaren) }}" id="kemaren">
	<input type="hidden" name="duahari" value="{{ strtoupper($duahari) }}" id="duahari">
	<input type="hidden" name="tigahari" value="{{ strtoupper($tigahari) }}" id="tigahari">
	<input type="hidden" name="empathari" value="{{ strtoupper($empathari) }}" id="empathari">
	<input type="hidden" name="limahari" value="{{ strtoupper($limahari) }}" id="limahari">
	<input type="hidden" name="enamhari" value="{{ strtoupper($enamhari) }}" id="enamhari">
</div>
<br><br>
<script type="text/javascript">
	var densityCanvas = document.getElementById("densityChart");
	var pengunjungData = {
		label: 'Pengunjung',
		data: [
			$('#penenamhari').val(),
			$('#penlimahari').val(),
			$('#penempathari').val(),
			$('#pentigahari').val(),
			$('#penduahari').val(),
			$('#penkemaren').val(),
			$('#penhariini').val()
		],
		backgroundColor: '#2F4859',
		borderColor: '#2F4859'
	};
 
	var pinjamanData = {
		label: 'Pinjaman',
		data: [
			$('#pinenamhari').val(),
			$('#pinlimahari').val(),
			$('#pinempathari').val(),
			$('#pintigahari').val(),
			$('#pinduahari').val(),
			$('#pinkemaren').val(),
			$('#pinhariini').val()
		],
		backgroundColor: '#95F546',
		borderColor: '#95F546'
	};
 
	var planetData = {
		labels: [
			$('#enamhari').val(),
			$('#limahari').val(),
			$('#empathari').val(),
			$('#tigahari').val(),
			$('#duahari').val(),
			$('#kemaren').val(),
			$('#hariini').val()
		],
		datasets: [pengunjungData, pinjamanData]
	};
 
	var barChart = new Chart(densityCanvas, {
  		type: 'bar',
  		data: planetData
	});
</script>
@endsection
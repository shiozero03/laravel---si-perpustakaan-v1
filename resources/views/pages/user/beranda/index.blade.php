@extends('pages.user.layout')
@section('title', 'Beranda')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
<script type="text/javascript">
	document.getElementsByClassName('menu-side')[0].classList.add('active')
</script>
<style type="text/css">
	.beranda-status{
		background: #E5FDD1;
		border: 1px solid #D5D5D5;
		border-radius: 4px;
		padding: 21px;
		min-height: 120px;
	}
	.buku-dipinjam{
		background: #B4E4FF;
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
	.info-suspensi{
		background: #FFFFFF;
		border: 1px solid #D5D5D5;
		border-radius: 4px;
		padding: 21px;
		min-height: 120px;
	}
	.buku-terbaru{
		margin-top: 30px;
		padding: 20px;
		background: #FFFFFF;
		border: 1px solid #D5D5D5;
		box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.05);
		border-radius: 4px;
	}
	.new-book{
		background: #FFFFFF;
		border: 1px solid #D5D5D5;
		box-shadow: 12px 12px 10px rgba(0, 0, 0, 0.05);
		border-radius: 4px;
		padding: 20px
	}
	.cover-buku-beranda{
		height: 182px;
		width: 100%;
		overflow: hidden;
		margin-bottom: 10px;
	}
	.statistik{
		background: #FFFFFF;
		border: 1px solid #D5D5D5;
		box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.05);
		border-radius: 4px;
		padding: 20px;
		margin-top: 50px
	}
</style>
<div class="row">
	<div style="width: 22.5%">
		<div class="beranda-status">
			<h6><i class="fas fa-users" style="color: #66B921"></i><br></h6>
			<h5 class="my-0"><strong>Active</strong></h5>
			<span>Status Anggota</span>
		</div>
	</div>
	<div style="width: 22.5%">
		<div class="buku-dipinjam">
			<h6><i class="fas fa-book-open" style="color: #21A7B9"></i><br></h6>
			<h5 class="my-0"><strong>{{ $pinjam }}</strong></h5>
			<span>Buku Dipinjam</span>
		</div>
	</div>
	<div style="width: 22.5%">
		<div class="jatuh-tempo">
			<h6><i class="fas fa-clock" style="color: #FF4A4A"></i><br></h6>
			<h5 class="my-0"><strong>{{ $tempo }}</strong></h5>
			<span>Buku Jatuh Tempo</span>
		</div>
	</div>
	<div style="width: 32.5%">
		<div class="info-suspensi">
			<h5 style="font-weight: 500; color: #1AA0F2;">Info Suspensi</h5>
			<h6 style="color: #B5B5B5;">Saat ini tidak ada suspensi</h6>
		</div>
	</div>
</div>
<div class="buku-terbaru">
	<div class="navbar" style="margin-bottom: 10px">
		<h5 class="me-auto my-0" style="color: #1AA0F2;">Buku Terbaru</h5>
		<div class="ms-auto">
			<a href="javascript:;" onclick="this.href='{{ route('user.catalog') }}'" style="color: #1AA0F2;">See More</a>
		</div>
	</div>
	<div class="row">
		@foreach($buku as $book)
		<div class="col-3">
			<div class="new-book">
				<div class="cover-buku-beranda">
					<img src="{{ asset('assets/images/buku/'.$book->cover_buku) }}" width="100%">
				</div>
				<a ef="javascript:;" onclick="this.href='{{ route('user.catalog') }}/view/{{ $book->id_buku }}'" class="btn w-100 text-white" style="background: #3C84AB;border-radius: 4px;">Preview Buku</a>
			</div>
		</div>
		@endforeach
	</div>
</div>
<div class="statistik">
	<canvas id="speedChart" width="100%" height="50px"></canvas>
</div>
<br><br>
<input type="hidden" value="{{ $januari }}" id="januari">
<input type="hidden" value="{{ $februari }}" id="februari">
<input type="hidden" value="{{ $maret }}" id="maret">
<input type="hidden" value="{{ $april }}" id="april">
<input type="hidden" value="{{ $mei }}" id="mei">
<input type="hidden" value="{{ $juni }}" id="juni">
<input type="hidden" value="{{ $juli }}" id="juli">
<input type="hidden" value="{{ $agustus }}" id="agustus">
<input type="hidden" value="{{ $september }}" id="september">
<input type="hidden" value="{{ $oktober }}" id="oktober">
<input type="hidden" value="{{ $november }}" id="november">
<input type="hidden" value="{{ $desember }}" id="desember">
<br><br>
<script type="text/javascript">
	const d = new Date();
var myChart2 = new Chart(
    document.getElementById('speedChart'), {
		type: 'line',
		data: {
            labels: [
                "Januari",
                "Februari",
                "Maret",
                "April",
                "Mei",
                "Juni",
                "juli",
                "Aguistus",
                "September",
                "Oktober",
                "November",
                "Desember"
            ],
            datasets: [{
                label: 'Statistik buku pinjaman tahun '+d.getFullYear(),
                data: [
					$('#januari').val(),
					$('#februari').val(),
					$('#maret').val(),
					$('#april').val(),
					$('#mei').val(),
					$('#juni').val(),
					$('#juli').val(),
					$('#agustus').val(),
					$('#september').val(),
					$('#oktober').val(),
					$('#november').val(),
					$('#desember').val()
                ],
                backgroundColor: [
                	'#3C84AB',
                ],
                hoverOffset: 4
            }]
        }
    }
);
</script>

@endsection
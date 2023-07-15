@extends('pages.user.layout')
@section('title', 'Katalog Buku')
@section('content')
<script type="text/javascript">
	document.getElementsByClassName('menu-side')[2].classList.add('active')
</script>
<style type="text/css">
	
	.cover-buku{
		background: #FFFFFF;
		border: 1px solid #D5D5D5;
		box-shadow: 12px 12px 10px rgba(0, 0, 0, 0.05);
		border-radius: 6px;
		padding:80px;
	}
	.cover-buku h3{
		font-weight: 600;
		font-size: 32px;
	}
	.review{
		background: #109CF1;
		font-weight: 500;
		border: 1px solid #E3E3E3;
		box-shadow: 12px 12px 10px rgba(0, 0, 0, 0.05);
		border-radius: 4px;
		width: 100%;
		padding: 15px 0px;
		color: #FFFFFF;
		margin-top: 10px;
		font-size: 14px;
	}
	.pinjam{
		background: #FFFFFF;
		font-weight: 500;
		border: 0.5px solid #109CF1;
		box-shadow: 12px 12px 10px rgba(0, 0, 0, 0.05);
		border-radius: 4px;
		width: 100%;
		padding: 15px 0px;
		margin-top: 10px;
		font-size: 14px;
	}
	.pinjam a, .text-blue{
		color: #109CF1;
	}
	.sedang-pinjam{
		background: #F2F2F2;
		font-weight: 500;
		border: 0.5px solid #109CF1;
		box-shadow: 12px 12px 10px rgba(0, 0, 0, 0.05);
		border-radius: 4px;
		width: 100%;
		padding: 15px 0px;
		margin-top: 10px;
		font-size: 14px;
	}
	.sedang-pinjam, .sedang-pinjam a{
		color: #109CF1;
	}
	.mymodal {
		display: none;
		position: fixed;
		z-index: 9999;
		left: 0;
		top: 0;
		width: 100%;
		height: 100%;
		overflow: auto;
		background-color: rgba(0, 0, 0, 0.4);
	}

	.mymodal-content {
		background-color: #fefefe;
		margin: 10% auto;
		padding: 20px;
		border: 1px solid #888;
		border-radius: 5px;
		max-width: 400px;
		animation-duration: 0.6s;
	}

	@keyframes bounceIn {
		0% {
			opacity: 0;
			transform: scale(0.1);
		}
		60% {
			opacity: 1;
			transform: scale(1.2);
		}
		100% {
			opacity: 1;
			transform: scale(1);
		}
	}

	.bounceIn {
		animation-name: bounceIn;
	}
</style>
<div class="profil">
	<div class="cover-buku">
		<div class="row">
			<div class="col-3">
				<img src="{{ asset('assets/images/buku/'.$buku->cover_buku) }}" width="100%" class="rounded">
				<div class="review text-center"> 
				@if($buku->file == null && $buku->sumber == null)
					<a href="javascript:;" onclick="
						iziToast.error({
			            	title : 'Error',
			            	message: 'tidak ada buku untuk ditampilkan',
			            	position: 'topCenter'
			        	})
					" class="text-decoration-none text-white">Baca Buku</a>
				@elseif($buku->file == null && $buku->sumber != null)
					<a href="javascript:;" target="__blank" onclick="this.href='{{ $buku->sumber }}'" class="text-decoration-none text-white">Baca Buku</a>
				@else
					<a href="javascript:;" target="__blank" onclick="this.href='{{ asset('assets/file/buku/'.$buku->file) }}'" class="text-decoration-none text-white">Baca Buku</a>
				@endif
			</div>
				@if($buku->status == 'Tersedia')
				<div class="pinjam text-center">
					<a href="javascript:;"  class="text-decoration-none" onclick="openModal()" id="openModalBtn">Pinjam Buku</a>
				</div>
				@else
				<button class="sedang-pinjam">Sedang Dipinjam</button>
				@endif
				<?php
					$cekbuku = DB::table('simpan_bukus')->where('id_member', '=', $user->id_member)->where('id_buku', '=', $buku->id_buku);
				?>
				@if($cekbuku->get()->count() > 0)
					<div class="sedang-pinjam text-center">
						<a href="javascript:;" onclick="this.href='{{ route('user.daftarBuku') }}/hapus/{{ $cekbuku->first()->id_simpan }}'" class="text-decoration-none">Hapus dari Daftar Buku</a>
					</div>
				@else
					<div class="pinjam text-center">
						<a href="javascript:;" onclick="this.href='{{ route('user.catalog') }}/simpan/{{ $buku->id_buku }}'" class="text-decoration-none">Tambah ke Daftar Buku</a>
					</div>
				@endif
			</div>
			<div class="col-1"><br></div>
			<div class="col-8">
				@if($buku->status == 'Tersedia')
				<span style="background-color: #ECFFC7; color: #7C8C57; padding: 6px 10px; border-radius: 10px;">{{ $buku->status }}</span>
				@else
				<span class="text-white" style="background-color: #B7B7B7;padding: 6px 10px; border-radius: 10px;">{{ $buku->status }}</span>
				@endif
				<h3 class="my-3">{{ $buku->judul_buku }}</h3>
				@if(strlen($buku->sinopsis) > 600)
				<div style="text-align: justify;" id="substr">
					<?= substr($buku->sinopsis, 0, 600) ?><br>
					<a href="javascript:;" style="color: #109CF1;" onclick="readmore()">Baca Selengkapnya</a>
				</div>
				<div style="text-align: justify;" id="allstr" class="d-none">
					<?= ''.$buku->sinopsis ?>
				</div>
				@else
				<div style="text-align: justify;">
					<?= ''.$buku->sinopsis ?>
				</div>
				@endif
				<div style="background: #D9D9D9; height: 2px; width: 100%; margin-bottom: 24px"></div>
				<div>
					<h4 style="font-weight: 800; font-size: 18px;">Data Buku</h4>
					<table class="mt-3">
						<tr>
							<th style="font-weight: 500" width="150px">No. Panggil</th>
							<td><p style="margin: 3px auto"> {{ $buku->no_panggil }}</p></td>
						</tr>
						<tr>
							<th style="font-weight: 500">Pengarang</th>
							<td><p style="margin: 3px auto"> {{ $buku->pengarang }}</p></td>
						</tr>
						<tr>
							<th style="font-weight: 500">Penerbit</th>
							<td><p style="margin: 3px auto"> {{ $buku->penerbit }}</p></td>
						</tr>
						<tr>
							<th style="font-weight: 500">Tahun Terbit</th>
							<td><p style="margin: 3px auto"> {{ $buku->tahun_terbit }}</p></td>
						</tr>
						<tr>
							<th style="font-weight: 500">Tempat Terbit</th>
							<td><p style="margin: 3px auto"> {{ $buku->tempat_terbit }}</p></td>
						</tr>
						<tr>
							<th style="font-weight: 500">Halaman</th>
							<td><p style="margin: 3px auto"> {{ $buku->halaman }} Halaman</p></td>
						</tr>
						<tr>
							<th style="font-weight: 500">Bahasa</th>
							<td><p style="margin: 3px auto"> {{ $buku->bahasa }}</p></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="myModal" class="mymodal">
  	<div class="mymodal-content bounceIn text-center">
  		<br>
  		<h5 class="text-blue"><strong>Konfirmasi</strong></h5>
    	<p>
    		Apakah anda yakin ingin meminjam buku ini ?
    	</p>
    	<br><br>
    	<div class="row">
    		<div class="col-6">
		    	<div class="pinjam text-center">
					<a href="javascript:;" onclick="closeModal()" class="text-decoration-none">Tidak</a>
				</div>
			</div>
			<div class="col-6">
				<div class="review text-center">
					<a href="javascript:;" onclick="yaModel()"  class="text-decoration-none text-white ya-answer">Ya</a>
				</div>
			</div>
		</div>
  	</div>
</div>

<div id="myModal2" class="mymodal">
  	<div class="mymodal-content bounceIn text-center">
  		<br>
  		<div class="alert alert-success"><strong>Pesanan Anda Tercatat</strong></div>
    	<p>
    		Silahkan kunjungi perpustakaan untuk konfirmasi kepada petugas dalam waktu 1 x 24 jam
    	</p>
  	</div>
</div>
<br><br>
<script type="text/javascript">
	function readmore(){
		$('#substr').addClass('d-none')
		$('#allstr').removeClass('d-none')
	}
	var modal = document.getElementById("myModal");
	var modal2 = document.getElementById("myModal2");
	function openModal(){
	  	modal.style.display = "block";
	  	modal.classList.add("bounceIn");
	}
	function closeModal(){
	  	modal.style.display = "none";
	  	modal.classList.remove("bounceIn");
	}
	function yaModel(){
  		modal.style.display = "none";
	  	modal.classList.remove("bounceIn");

	  	modal2.style.display = "block";
	  	modal2.classList.add("bounceIn");

	  	setTimeout(function() {
	      	modal2.style.display = "none";
	      	modal2.classList.remove("bounceIn");

	      	window.location.href = "{{ route('user.catalog') }}/pinjam/{{ $buku->id_buku }}";
	    }, 3000);
	}
</script>
@endsection
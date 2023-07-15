@extends('pages.user.layout')
@section('title', 'Katalog Buku')
@section('content')
<script type="text/javascript">
	document.getElementsByClassName('menu-side')[2].classList.add('active')
</script>
<style type="text/css">
	.page-header h3{
		font-weight: 500;
		font-size: 26px;
	}
	.form-search{
		margin: 30px 0
	}
	.cover-buku{
		background: #FFFFFF;
		border: 1px solid #D5D5D5;
		box-shadow: 12px 12px 10px rgba(0, 0, 0, 0.05);
		border-radius: 6px;
		padding:35px 28px;
	}
	.isi-buku{
		background: #FFFFFF;
		border: 1px solid #D5D5D5;
		box-shadow: 12px 12px 10px rgba(0, 0, 0, 0.05);
		margin: 15px auto;
		padding: 30px 28px;
		position: relative;
	}
	.isi-buku h3{
		font-weight: 600;
		font-size: 32px;
	}
</style>
<div class="profil">
	<div class="bg-blue rounded page-header">
		<div class="px-3 text-white py-3">
			<h3 class="border-start border-white border-2 py-1 my-0">
				<span class="ms-3">Katalog Buku</span>
			</h3>
		</div>
	</div>
	<div class="form-search">
		<form method="get" action="{{ route('user.catalog') }}">
			<div class="row">
				<div class="col-7">
					<input type="text" name="keyword" placeholder="Kata Kunci" class="form-control">
				</div>
				<div class="col-3">
					<select class="form-control" name="sembarang">
						<option disabled selected=""></option>
						<option value="judul_buku">Judul Buku</option>
						<option value="no_panggil">No. Panggil</option>
						<option value="pengarang">Pengarang</option>
						<option value="penerbit">Penerbit</option>
						<option value="tahun_terbit">Tahun Terbit</option>
						<option value="tempat_terbit">Tempat Terbit</option>
					</select>
				</div>
				<div class="col-2">
					<input type="submit" name="submit" value="Cari" style="background: #3C84AB; font-weight: 600" class="form-control text-white">
				</div>
			</div>
		</form>
	</div>
	<div class="cover-buku">
		@if($buku->count() > 0)
			@foreach($buku as $book)
				<a href="javascript:;" onclick="this.href='{{ route('user.catalog') }}/view/{{ $book->id_buku }}'" class="text-decoration-none text-dark">
					<div class="isi-buku">
						<div class="row">
							<div style="width: 300px">
								<img width="270px" height="350px" src="{{ asset('assets/images/buku/'.$book->cover_buku) }}" class="rounded">
							</div>
							<div style="width: calc(100% - 350px)">
								<h3 class="mb-3">{{ $book->judul_buku }}</h3>
								@if($book->status == 'Tersedia')
								<span style="background-color: #ECFFC7; color: #7C8C57; padding: 6px 10px; border-radius: 10px;">{{ $book->status }}</span>
								@else
								<span class="text-white" style="background-color: #B7B7B7;padding: 6px 10px; border-radius: 10px;">{{ $book->status }}</span>
								@endif
								<table class="mt-3">
									<tr>
										<th width="150px">No. Panggil</th>
										<td><p style="margin: 3px auto"> {{ $book->no_panggil }}</p></td>
									</tr>
									<tr>
										<th>Pengarang</th>
										<td><p style="margin: 3px auto"> {{ $book->pengarang }}</p></td>
									</tr>
									<tr>
										<th>Penerbit</th>
										<td><p style="margin: 3px auto"> {{ $book->penerbit }}</p></td>
									</tr>
									<tr>
										<th>Tahun Terbit</th>
										<td><p style="margin: 3px auto"> {{ $book->tahun_terbit }}</p></td>
									</tr>
									<tr>
										<th>Tempat Terbit</th>
										<td><p style="margin: 3px auto"> {{ $book->tempat_terbit }}</p></td>
									</tr>
									<tr>
										<th>Halaman</th>
										<td><p style="margin: 3px auto"> {{ $book->halaman }} Halaman</p></td>
									</tr>
									<tr>
										<th>Bahasa</th>
										<td><p style="margin: 3px auto"> {{ $book->bahasa }}</p></td>
									</tr>
								</table>
							</div>
						</div>
						<?php
							$cekbuku = DB::table('simpan_bukus')->where('id_member', '=', $user->id_member)->where('id_buku', '=', $book->id_buku);
						?>
						@if($cekbuku->get()->count() > 0)
						<a href="javascript:;" onclick="this.href='/user/daftar-buku/hapus/{{ $cekbuku->first()->id_simpan }}'" style="position: absolute; top: 30px; right: 30px;" class="text-decoration-none">
							<i style="color: #FAAF1E; font-size: 20px" class="fas fa-bookmark"></i>
						</a>
						@else
						<a href="javascript:;" onclick="this.href='{{ route('user.catalog') }}/simpan/{{ $book->id_buku }}'" style="position: absolute; top: 30px; right: 30px;" class="text-decoration-none">
							<i style="color: #FAAF1E; font-size: 20px" class="far fa-bookmark"></i>
						</a>
						@endif
					</div>
				</a>
			@endforeach
		@else
		<div class="text-center">
			<h1><em>Tidak Ada Data</em></h1>
		</div>
		@endif
		{{ $buku->links('vendor.pagination.default') }}
	</div>
</div>
<br><br>

@endsection
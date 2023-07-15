@extends('pages.admin.layout')
@section('title', 'Akitivitas Perpustakaan')
@section('content')
<script type="text/javascript">
	document.getElementsByClassName('menu-side')[3].classList.add('active')
</script>
<script type="text/javascript" src="{{ asset('assets/js/ckeditor/ckeditor.js') }}"></script>
<style type="text/css">
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
				<span class="ms-3">Aktivitas Perpustakaan</span>
			</h3>
		</div>
	</div>
	<div class="form-search">
		<div class="form-riwayat row">
			<div class="col-6 text-center riwayat-menu">
				<a href="javascript:;" onclick="this.href='{{ route('admin.aktivitas') }}?filter=peminjaman'" class="text-decoration-none text-center w-100">
					<h6 style="margin-bottom: 18px" class="my-3 title-menu-add"><span>PEMINJAMAN BUKU</span></h6>
				</a>
			</div>
			<div class="col-6 text-center riwayat-menu">
				<a href="javascript:;" onclick="this.href='{{ route('admin.aktivitas') }}?filter=pengunjung'" class="text-decoration-none text-center w-100">
					<h6 style="margin-bottom: 18px" class="my-3 title-menu-add"><span>PENGUNJUNG</span></h6>
				</a>
			</div>
		</div>
	</div>
	@if(isset($_GET['filter']))
	<?php $filter = $_GET['filter'] ?>
		@if($filter == 'peminjaman')
			@include('pages.admin.aktivitas.peminjaman')
		@elseif($filter == 'pengunjung')
			@include('pages.admin.aktivitas.pengunjung')
		@endif
	@else
	@include('pages.admin.aktivitas.peminjaman')
	@endif

</div>
<br><br>

@endsection
@extends('pages.admin.layout')
@section('title', 'Akitivitas Perpustakaan')
@section('content')
<script type="text/javascript">
	document.getElementsByClassName('menu-side')[2].classList.add('active')
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script type="text/javascript" src="{{ asset('assets/js/ckeditor/ckeditor.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<style type="text/css">
	.page-header h3{
		font-weight: 500;
		font-size: 26px;
	}
	.buku-content{
		border: 1px solid #D5D5D5;
		box-shadow: 12px 12px 10px rgba(0, 0, 0, 0.05);
		border-radius: 6px;
		padding: 22px;
	}
	.buku-content select{
		background: rgba(16, 156, 241, 0.165);
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
</style>
<div class="profil">
	<div class="bg-blue rounded page-header">
		<div class="px-3 text-white py-3">
			<h3 class="border-start border-white border-2 py-1 my-0">
				<span class="ms-3">Tambah Peminjaman</span>
			</h3>
		</div>
	</div>
	<div class="form-search">
		<div class="form-riwayat row">
			<div class="col-6 text-center riwayat-menu">
				<a href="javascript:;" onclick="this.href='{{ route('admin.pinjambuku') }}?filter=offline'" class="text-decoration-none text-center w-100">
					<h6 style="margin-bottom: 18px" class="my-3 title-menu-add"><span>PINJAM BUKU</span></h6>
				</a>
			</div>
			<div class="col-6 text-center riwayat-menu">
				<a href="javascript:;" onclick="this.href='{{ route('admin.pinjambuku') }}?filter=online'" class="text-decoration-none text-center w-100">
					<h6 style="margin-bottom: 18px" class="my-3 title-menu-add"><span>PESAN BUKU</span></h6>
				</a>
			</div>
		</div>
	</div>
	<br>
	@if(isset($_GET['filter']))
	<?php $filter = $_GET['filter'] ?>
		@if($filter == 'offline')
			@include('pages.admin.tambah-peminjaman.pinjam-offline')
		@elseif($filter == 'online')
			@include('pages.admin.tambah-peminjaman.pinjam-online')
		@endif
	@else
	@include('pages.admin.tambah-peminjaman.pinjam-offline')
	@endif

</div>
<br><br>
<script type="text/javascript">
	$('.bookSelect').select2()
	$('.userSelect').select2()

	$(document).on('change', '#userchange', function(){
      	let id = $(this).val();

      	$.ajax({
      		url : "{{ route('showDataMember') }}",
      		type : 'post',
      		data : {
      			id : id,
      			'_token' : "{{ csrf_token() }}"
      		},
      		success: function(params){
      			$('#userView').removeClass('d-none')
      			$('input[name=nama]').val(params.data.nama);
      			$('input[name=nisn]').val(params.data.nisn);
      			$('input[name=gender]').val(params.data.jenis_kelamin);
      			$('input[name=no_hp]').val(params.data.no_hp);
      			$('textarea[name=alamat]').html(params.data.alamat);

      		},
      		error: function(xhr){
      			console.log(xhr)
      		}
      	});
    })
    $(document).on('change', '#bukuchange', function(){
      	let id = $(this).val();

      	$.ajax({
      		url : "{{ route('showDataBuku') }}",
      		type : 'post',
      		data : {
      			id : id,
      			'_token' : "{{ csrf_token() }}"
      		},
      		success: function(params){
      			var assets = '{{ asset("assets/images/buku/") }}/'+params.data.cover_buku
      			$('#bukuView').removeClass('d-none')
      			console.log(assets)
      			$('img[name=cover_buku]').attr('src', assets)
      			$('input[name=judul_buku]').val(params.data.judul_buku);
      			$('input[name=no_panggil]').val(params.data.no_panggil);
      			$('input[name=pengarang]').val(params.data.pengarang);

      		},
      		error: function(xhr){
      			console.log(xhr)
      		}
      	});
    })
</script>
@endsection
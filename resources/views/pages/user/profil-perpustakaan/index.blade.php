@extends('pages.user.layout')
@section('title', 'Profil Perpustakaan')
@section('content')
<script type="text/javascript">
	document.getElementsByClassName('top-menu')[0].classList.add('active')
</script>
<style type="text/css">
	.profil h3{
		font-weight: 500;
		font-size: 26px;
	}
	.profil .page-header{
		margin-bottom: 46px;
	}
	.content-profil .cover-content{
		padding: 40px 50px;
		border: 1px solid #D5D5D5;
		box-shadow: 12px 12px 10px rgba(0, 0, 0, 0.05);
		border-radius: 6px;
		margin-bottom: 20px;
	}.content-profil .cover-content .top-cover{
		margin-bottom: 50px;
	}
</style>
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker.min.css') }}" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="profil">
	<div class="bg-blue rounded page-header">
		<div class="px-3 text-white py-3">
			<h3 class="border-start border-white border-2 py-1 my-0">
				<span class="ms-3">Profil Perpustakaan</span>
			</h3>
		</div>
	</div>
	<div class="content-profil">
		<div class="bg-white cover-content">
			<div class="text-center top-cover">
				<img src="{{ asset('assets/images/logo.png') }}" width="150px">
			</div>
			<div style="line-height: 21px; text-align: justify;">
				@foreach($profil as $prof)
					@if($prof->kategori == 'Overview')
						<?= ''.$prof->teks.'' ?>
					@endif
				@endforeach
			</div>
		</div>
	</div>
	@foreach($profil as $prof)
		@if($prof->kategori != 'Overview')
			<div class="content-profil">
				<div class="bg-white cover-content">
					<div class="text-center top-cover">
						<h3 class="my-0" style="font-weight: 500; font-size: 32px;"><?= ''.$prof->kategori.'' ?></h3>
						<div class="bg-blue mt-2" style="width: 4%; height: 5px; margin-left: 48%;"></div>
					</div>
					<div style="line-height: 21px; text-align: justify;">
						<?= ''.$prof->teks.'' ?>
					</div>
				</div>
			</div>
		@endif
	@endforeach
	<br><br>
</div>

@endsection
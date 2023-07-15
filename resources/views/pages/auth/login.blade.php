@extends('pages.auth.layout')
@section('title', 'LOGIN')
@section('content')

<form class="bg-white" action="{{ route('loginProcess') }}" method="post">
	@csrf
	<h1 class="text-title text-center">MASUK PERPUSTAKAAN</h1>
	<div class="form-group">
		<label>Nomor NISN</label>
		<input type="number" name="nisn" value="{{ $nisn }}" class="form-control" placeholder="Nomor NISN">
		@error('nisn')<small class="text-danger"><em>{{ $message }}</em></small>@enderror
	</div>
	<div class="form-group">
		<label>Password</label>
		<input type="password" name="password" class="form-control" value="{{ $password }}" placeholder="Masukkan Password">
		@error('password')<small class="text-danger"><em>{{ $message }}</em></small>@enderror
	</div>
	<div class="form-group">
		<button class="btn btn-primary w-100 text-white mt-2"><strong>Masuk</strong></button>
	</div>
	<div class="form-group">
		<div class="d-flex align-items-center w-100">
			<div class="text-start col-6">
				@if($nisn != '' && $password != '')
					<input type="checkbox" checked="" name="ingat" id="ingat">
				@else
					<input type="checkbox" name="ingat" id="ingat">
				@endif
				<label for="ingat" class="ms-2">Ingat Saya</label>
			</div>
			<div class="text-end col-6">
				<a href="javascript:;" class="text-end text-dark text-decoration-none"><b>Lupa Password</b></a>
			</div>
		</div>
	</div>
	<div class="form-group text-center mt-3">
		<b>Gabung menjadi Anggota <a href="javascript:;" onclick="this.href='{{ route('register') }}'" class="btn btn-outline-primary">Daftar</a></b>
	</div>
</form>

@endsection
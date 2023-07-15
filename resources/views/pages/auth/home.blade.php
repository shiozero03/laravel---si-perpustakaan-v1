@extends('pages.auth.layout')
@section('title', 'HOME')
@section('content')
<style type="text/css">
	h4.text-title{
		font-weight: 600;
		margin-top: -10px;
	}
</style>
<form class="bg-white" action="{{ route('welcome.process') }}" method="post">
	@csrf
	<h4 class="text-title text-center">SELAMAT DATANG DI PERPUSTAKAAN<br>SMA NEGERI 1 CILAMAYA</h4>
	<br>
	<div class="w-100 text-center">
		<img src="{{ asset('assets/images/logo.png') }}" width="150px">
	</div>
	<br>
	<div class="form-group">
		<label><h5>Masukkan Nama Anda</h5></label>
		<input type="text" name="nama" class="form-control" placeholder="Nama">
		@error('nama')<small class="text-danger"><em>{{ $message }}</em></small>@enderror
	</div>
	<div class="form-group">
		<button class="btn bg-blue w-100 text-white mt-2"><strong>Masuk</strong></button>
	</div>
</form>

@endsection
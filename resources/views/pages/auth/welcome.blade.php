@extends('pages.auth.layout')
@section('title', 'Welcome')
@section('content')

<div class="position-absolute" style="top: 72px;left: 100px">
	<a href="javascript:;" onclick="this.href='{{ route('home') }}'" class="btn btn-outline-dark"><i class="fas fa-arrow-left me-2"></i> Kembali</a>
</div>
<form class="bg-white" action="{{ route('welcome.process') }}" method="post">
	@csrf
	<h4 class="text-title text-center">SELAMAT DATANG DI PERPUSTAKAAN<br>SMA NEGERI 1 CILAMAYA</h4>
	<br>
	<div class="w-100 text-center">
		<img src="{{ asset('assets/images/logo.png') }}" width="150px">
	</div>
	<br>
	<h2 class="text-blue text-center"><strong>{{ $nama }}</strong></h2>
</form>
@endsection
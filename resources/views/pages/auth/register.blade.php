@extends('pages.auth.layout')
@section('title', 'REGISTER')
@section('content')

<div class="position-absolute" style="top: 72px;left: 100px">
	<a href="javascript:;" onclick="this.href='{{ route('login') }}'" class="btn btn-outline-primary"><i class="fas fa-arrow-left me-2"></i> Masuk</a>
</div>
<form class="bg-white" action="{{ route('registerProcess') }}" method="post">
	@csrf
	<h1 class="text-title text-center">DAFTAR ANGGOTA PERPUSTAKAAN</h1>
	<div class="form-group">
		<label>Nomor NISN <span class="text-danger">*</span></label>
		<input type="number" name="nisn" class="form-control" value="{{ old('nisn') }}" placeholder="Masukkan Nomor NISN">
		@error('nisn')<small class="text-danger"><em>{{ $message }}</em></small>@enderror
	</div>
	<div class="form-group">
		<label>Password <span class="text-danger">*</span></label>
		<input type="password" value="{{ old('password') }}" name="password" class="form-control" placeholder="Masukkan Password">
		@error('password')<small class="text-danger"><em>{{ $message }}</em></small>@enderror
	</div>
	<div class="form-group">
		<label>Tangal Lahir</label>
		<div class="d-flex align-items-center">
			<select name="tanggal" id="tanggal" class="form-control me-2" style="width: 50px">
				@for($i = 1; $i < 32; $i++)
				<option value="{{ $i }}" class="tanggalke-{{ $i }}">{{ $i }}</option>
				@endfor
			</select>
			-
			<select name="bulan" id="bulan" class="form-control mx-2" style="width: 120px">
				<option value="1" class="bulanke-1">Januari</option>
				<option value="2" class="bulanke-2">Februari</option>
				<option value="3" class="bulanke-3">Maret</option>
				<option value="4" class="bulanke-4">April</option>
				<option value="5" class="bulanke-5">Mei</option>
				<option value="6" class="bulanke-6">Juni</option>
				<option value="7" class="bulanke-7">Juli</option>
				<option value="8" class="bulanke-8">Agustus</option>
				<option value="9" class="bulanke-9">September</option>
				<option value="10" class="bulanke-10">Oktober</option>
				<option value="11" class="bulanke-11">November</option>
				<option value="12" class="bulanke-12">Desember</option>
			</select>
			-
			<select name="tahun" id="tahun" class="form-control ms-2" style="width: 80px">
				@for($i = 1970; $i < 2035; $i++)
				<option value="{{$i}}" class="tahunke-{{ $i }}">{{ $i }}</option>
				@endfor
			</select>
		</div>
		<small><em>(Format tgl-bln-thn)</em></small>
	</div>
	<div class="form-group">
		<label>Jenis Kelamin</label><br>
		<input type="radio" name="jenis_kelamin" id="pria" value="Laki - Laki">
		<label for="pria" class="ms-2"> Laki - Laki</label>
		<input type="radio" name="jenis_kelamin" id="wanita" value="Perempuan" class="ms-4">
		<label for="wanita" class="ms-2"> Perempuan</label>
	</div>
	<div class="form-group">
		<label>Nomor Hp <span class="text-danger">*</span></label>
		<input type="number" value="{{ old('no_hp') }}" name="no_hp" class="form-control" placeholder="Masukkan Nomor Hp">
		@error('no_hp')<small class="text-danger"><em>{{ $message }}</em></small>@enderror
	</div>
	<div class="form-group">
		<label>Alamat Rumah <span class="text-danger">*</span></label>
		<textarea class="form-control" rows="5" name="alamat" placeholder="Masukkan Alamat Rumah">{{ old('alamat') }}</textarea>
		@error('alamat')<small class="text-danger"><em>{{ $message }}</em></small>@enderror
	</div>
	<div class="form-group">
		<label>Pekerjaan <span class="text-danger">*</span></label>
		<input value="{{ old('pekerjaan') }}" type="text" name="pekerjaan" class="form-control" placeholder="Masukkan Pekerjaan">
		@error('pekerjaan')<small class="text-danger"><em>{{ $message }}</em></small>@enderror
	</div>
	<div class="form-group">
		<button class="btn btn-primary w-100 text-white mt-2"><strong>Masuk</strong></button>
	</div>
</form>

@endsection
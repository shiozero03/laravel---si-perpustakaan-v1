@extends('pages.user.layout')
@section('title', 'Profil')
@section('content')
<script type="text/javascript">
	document.getElementsByClassName('menu-side')[4].classList.add('active')
</script>
<style type="text/css">
	.profil h3{
		font-weight: 500;
		font-size: 26px;
	}
	.profil .page-header{
		margin-bottom: 46px;
	}
	.profil .change-profil img{
		position: absolute;
		bottom: -40px;
	}
	.profil .user-data{
		padding-top: 30px;
		padding-bottom: 30px;
		border: 1px solid #D5D5D5;
		box-shadow: 12px 12px 10px rgba(0, 0, 0, 0.05);
	}
	.profil .pembatas{
		border: 1px solid #D9D9D9;
		margin: 18px auto;
	}
	.profil .cover-table{
		margin: auto 40px;
	}
	.profil table{
		border: none;
		width: 100%
	}
	.profil table input{
		margin: 5px auto;
	}
	.profil .jenis-kelamin-check{
		background: rgba(107, 106, 106, 0.145);
		width: 35px;
		height: 35px;
		border-radius: 5px
	}
	.profil .radio-jenis-kelamin{
		display: none
	}
	.profil .radio-jenis-kelamin:checked + .jenis-kelamin-check{
		background: rgba(16, 156, 241, 0.145);
		width: 35px;
		height: 35px;
	}
	
</style>
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker.min.css') }}" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="profil">
	<div class="bg-blue rounded page-header">
		<div class="px-3 text-white py-3">
			<h3 class="border-start border-white border-2 py-1 my-0">
				<span class="ms-3">Profil Anggota</span>
			</h3>
		</div>
	</div>
	<div class="row change-profil">
		<div style="width: 30%">
			<div style="box-shadow: 12px 12px 10px rgba(0, 0, 0, 0.05);">
				<div class="bg-blue rounded-top position-relative d-flex align-items-center justify-content-center" style="height: 160px; border: ">
					@if($user->foto_profil == null)
						<img class="rounded-circle border-5 border border-white" src="{{ asset('assets/images/logo.png') }}" width="140px" height="140px">
					@else
						<img class="rounded-circle border-5 border border-white" src="{{ asset('assets/images/user/'.$user->foto_profil) }}" width="140px" height="140px">
					@endif
				</div> 
				<div class="bg-white rounded-bottom w-100 text-center text-gray">
					<div style="padding-top: 50px; padding-left: 25px; padding-right: 25px">
						<h3>{{ $user->nama }}</h3>
						<button data-bs-toggle="modal" data-bs-target="#ubahFoto" class="btn bg-gray w-100 text-gray mb-2" style="font-weight: 500; font-size: 14px">Ubah Foto</button>
						<button data-bs-toggle="modal" data-bs-target="#ubahPassword" class="btn bg-gray w-100 text-gray mb-4" style="font-weight: 500; font-size: 14px">Ubah Password</button>
					</div>
				</div>
			</div>
		</div>
		<div style="width: 5%"><br></div>
		<div style="width: 65%">
			<div class="bg-white rounded user-data">
				<h4 class="text-center">Data Anggota</h4>
				<div class="pembatas"></div>
				<div class="cover-table" style="border: none">
					<form action="{{ route('user.update.profil') }}" method="post">
						@csrf
						<table border="0">
							<tr>
								<td style="width: 250px">NISN</td>
								<td style="width: calc(100% - 250px)">
									<input value="{{ $user->nisn }}" type="text" name="nisn" disable class="bg-gray text-dark form-control">
								</td>
							</tr>
							<tr>
								<td style="width: 250px">Nama</td>
								<td style="width: calc(100% - 250px)">
									<input value="{{ $user->nama }}" type="text" name="nama" class="bg-light-blue text-dark form-control">
									@error('nama')<small class="text-danger"><em>{{ $message }}</em></small>@enderror
								</td>
							</tr>
							<tr>
								<td style="width: 250px">Jenis Kelamin</td>
								<td style="width: calc(100% - 250px)">
									<div class="d-flex align-items-center" style="margin: 5px auto">
										<label class="d-flex align-items-center">
											<input type="radio" class="radio-jenis-kelamin" name="jenis_kelamin" value="Laki - Laki" @if($user->jenis_kelamin == 'Laki - Laki') checked @endif>
											<div class="jenis-kelamin-check me-2"></div>
											Laki - Laki
										</label>
										<label class="ms-3 d-flex align-items-center">
											<input type="radio" class="radio-jenis-kelamin" name="jenis_kelamin" value="Perempuan" @if($user->jenis_kelamin == 'Perempuan') checked @endif>
											<div class="jenis-kelamin-check me-2"></div>
											Perempuan
										</label>
									</div>
									@error('jenis_kelamin')<small class="text-danger"><em>{{ $message }}</em></small>@enderror
								</td>
							</tr>
							<tr>
								<td style="width: 250px">Tanggal Lahir</td>
								<td style="width: calc(100% - 250px)">
									<input id="tanggal_lahir" value="{{ date('d/m/Y', strtotime($user->tanggal_lahir)) }}" type="text" name="tanggal_lahir" class="bg-light-blue text-dark form-control datepicker px-3" style="height: 35px">
									@error('tanggal_lahir')<small class="text-danger"><em>{{ $message }}</em></small>@enderror
								</td>
							</tr>
							<tr>
								<td style="width: 250px">Nomor Telepon</td>
								<td style="width: calc(100% - 250px)">
									<input value="{{ $user->no_hp }}" type="number" name="no_hp" class="bg-light-blue text-dark form-control">
									@error('no_hp')<small class="text-danger"><em>{{ $message }}</em></small>@enderror
								</td>
							</tr>
							<tr>
								<td style="width: 250px">Alamat</td>
								<td style="width: calc(100% - 250px)">
									<textarea name="alamat" class="bg-light-blue text-dark form-control" rows="3">{{ $user->alamat }}</textarea>
									@error('alamat')<small class="text-danger"><em>{{ $message }}</em></small>@enderror
								</td>
							</tr>
							<tr>
								<td style="width: 250px">Pekerjaan</td>
								<td style="width: calc(100% - 250px)">
									<input value="{{ $user->pekerjaan }}" type="text" name="pekerjaan" class="bg-light-blue text-dark form-control">
									@error('pekerjaan')<small class="text-danger"><em>{{ $message }}</em></small>@enderror
								</td>
							</tr>
							<tr>
								<td style="width: 250px"></td>
								<td style="width: calc(100% - 250px)">
									<input type="submit" name="save-profil" class="btn bg-blue w-100 text-white" value="Update Profil">
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</div>
	</div>
	<br><br>
</div>

<div class="modal fade" id="ubahFoto" tabindex="-1" aria-labelledby="ubahFotoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ubahFotoLabel">Ubah Foto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
		<form action="{{ route('user.update.profil') }}" method="post" enctype="multipart/form-data">
			@csrf
			<div class="text-center">
				<img id="foto_show" @if($user->foro_profil == null) src="{{ asset('assets/images/logo.png') }}" @else src="{{ asset('assets/images/user/'.$user->foto_profil) }}" @endif width="30%"><br>
				<input type="file" name="foto_profil" id="foto_profil" accept="image/jpg, image/jpeg, image/png, image/svg" class="form-control my-3">
			</div>
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary" name="save-picture">Save changes</button>
	    </form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="ubahPassword" tabindex="-1" aria-labelledby="ubahPasswordLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ubahPasswordLabel">Ubah Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
		<form action="{{ route('user.update.profil') }}" method="post" >
			@csrf
			<div >
				<div class="form-group">
					<label><strong>Password Lama</strong></label>
					<input type="password" name="last_password" class="form-control" required="" minlength="6">
				</div>
				<div class="form-group">
					<label><strong>Password Baru</strong></label>
					<input type="password" name="new_password" class="form-control" required="" minlength="6">
				</div>
				<div class="form-group">
					<label><strong>Konfirmasi Password</strong></label>
					<input type="password" name="confirm_password" class="form-control" required="" minlength="6">
				</div>
			</div>
			<br>
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary" name="save-password">Save changes</button>
	    </form>
      </div>
    </div>
  </div>
</div>
<script src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
	$('#tanggal_lahir').datepicker({
		format: 'dd/mm/yyyy',
		autoclose: true
	})
	let logo = document.getElementById('foto_profil');
    let logofet = document.getElementById('foto_show');
    logo.addEventListener('change', function () {
        gambar(this);
    })
    function gambar(a) {
        if (a.files && a.files[0]) {     
            var reader = new FileReader();    
            reader.onload = function (e) {
                logofet.src=e.target.result;
            }    
            reader.readAsDataURL(a.files[0]);
        }
    }

</script>
@endsection
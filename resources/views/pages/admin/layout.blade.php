<!DOCTYPE html>
<html>
<head>
	<title>SI - PERPUSTAKAAN | @yield('title')</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/iziToast/iziToast.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.dataTables.min.css') }}">

	<link rel="shortcut icon" type="text/css" href="{{ asset('assets/images/logo.png') }}">

	<script type="text/javascript" src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/iziToast/iziToast.min.js') }}"></script>

	<style type="text/css">
		body{
			background:  #F8F8F8;
		}
		.text-title{
			color: #3C84AB;
		}
		.text-gray{
			color: #7F7F7F;
		}
		.bg-blue{
			background: #109CF1;
		}
		.bg-gray{
			background: #F2F2F2;
		}
		.bg-light-blue{
			background: rgba(16, 156, 241, 0.145);
		}
		header{
			height: 60px;
			border-bottom: 1px solid #D5D5D5;
			background: #ffffff;
			position: fixed;
			width: 100%;
			z-index: 2
		}
		.header-logo{
			width: 250px;
			text-align: center;
			line-height: 18px;
			font-weight: 600;
		}
		.menu-cover-top{
			margin-left: 50px
		}
		.top-menu{
			color: #334D6E;
			text-decoration: none;
			margin: 0 24px;
			transition: .2s ease;
			font-weight: 600;
		}
		.top-menu.active, .top-menu:hover{
			color: #3C84AB;
			transition: .3s ease;
		}
		.menu-right-top{
			margin-right: 50px;
		}
		.info i{
			top: -2px;
			right: -2px;
			font-size: 10px;
			color: #109CF1;
		}
		aside{
			top: 0;
			left: 0;
			width: 250px;
			min-height: 100vh;
			background: #FFFFFF;
			box-shadow: 4px 0px 10px rgba(0, 0, 0, 0.05);
			position: fixed;
		}
		.sidebar{
			margin: 100px 10px;
		}
		.menu-side{
			border-radius: 4px;
			color: #334D6E;
			margin-bottom: 10px;
			padding:10px 20px;
			transition: .2s ease;
		}
		.menu-side .chevron{
			color: #FFFFFF;
		}
		.menu-side.active, .menu-side:hover, .menu-side.active i, .menu-side:hover i{
			background: #DEF3FF;
			color: #109CF1;
			transition: .2s ease;
		}
		.content{
			position: relative;
			top: 100px;
			left: 300px;
			width: calc(100% - 350px)
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
			max-width: 800px;
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
		.pesan-buku{
			padding: 20px 50px;
			border: 1px solid #D5D5D5;
			box-shadow: 12px 12px 10px rgba(0, 0, 0, 0.05);
			border-radius: 6px;
			margin-bottom: 20px;
		}
	</style>
</head>
<body>
	<section>
		<header>
			<nav class="navbar">
				<div class="header-logo text-title">
					<div class="d-flex align-items-center justify-content-center">
						<img src="{{ asset('assets/images/logo.png') }}" width="28px" height="28px" class="me-2">
						<div>
							Perpustakaan SMA<br>Negeri 1 Cilamaya
						</div>
					</div>
				</div>
				<div class="ms-auto menu-right-top d-flex align-items-center">
					<div class="info position-relative" onclick="notifModal()" style="cursor: pointer;">
						<div style="height: 20px; width: 20px; border-radius: 5px" class="border border-dark"></div>
						<i class="fas fa-circle position-absolute"></i>
					</div>
					<span style="font-weight: 600; margin: auto 14px auto 32px">{{ $user->nama }}</span>
					@if($user->foto_profil == null)
						<img class="rounded-circle" src="{{ asset('assets/images/logo.png') }}" width="36px" height="36px">
					@else
						<img class="rounded-circle" src="{{ asset('assets/images/user/'.$user->foto_profil) }}" width="36px" height="36px">
					@endif
					<i class="fas fa-chevron-down text-title" style="margin-left: 18px"></i>
				</div>
			</nav>
		</header>
	</section>
	<section>
		<aside>
			<div class="sidebar">
				<div>
					<a href="javascript:;" onclick="this.href='{{ route('admin.dashboard') }}'" class="d-flex align-items-center menu-side text-decoration-none">
						<div class="col-3 text-center">
							<i class="fas fa-dashboard"></i>
						</div>
						<div class="col-7">
							Beranda
						</div>
						<div class="text-end col-2">
							<i class="fas fa-chevron-right me-3 chevron"></i>
						</div>
					</a>
					<a href="javascript:;" onclick="this.href='{{ route('admin.tambahdata') }}'" class="d-flex align-items-center menu-side text-decoration-none">
						<div class="col-3 text-center">
							<i class="fas fa-plus-square"></i>
						</div>
						<div class="col-7">
							Tambah Data
						</div>
						<div class="text-end col-2">
							<i class="fas fa-chevron-right me-3 chevron"></i>
						</div>
					</a>
					<a href="javascript:;" onclick="this.href='{{ route('admin.pinjambuku') }}'" class="d-flex align-items-center menu-side text-decoration-none">
						<div class="col-3 text-center">
							<i class="fas fa-print"></i>
						</div>
						<div class="col-7" style="line-height: 18px">
							Tambah<br>Peminjaman
						</div>
						<div class="text-end col-2">
							<i class="fas fa-chevron-right me-3 chevron"></i>
						</div>
					</a>
					<a href="javascript:;" onclick="this.href='{{ route('admin.aktivitas') }}'" class="d-flex align-items-center menu-side text-decoration-none">
						<div class="col-3 text-center">
							<i class="fas fa-calendar-days"></i>
						</div>
						<div class="col-7" style="line-height: 18px">
							Aktivitas<br>Perpustakaan
						</div>
						<div class="text-end col-2">
							<i class="fas fa-chevron-right me-3 chevron"></i>
						</div>
					</a>
					<a href="javascript:;" onclick="this.href='{{ route('admin.dataperpustakaan') }}'" class="d-flex align-items-center menu-side text-decoration-none">
						<div class="col-3 text-center">
							<i class="fas fa-book"></i>
						</div>
						<div class="col-7" style="line-height: 18px">
							Data<br>Perpustakaan
						</div>
						<div class="text-end col-2">
							<i class="fas fa-chevron-right me-3 chevron"></i>
						</div>
					</a>
					<a href="javascript:;" onclick="this.href='{{ route('admin.profilperpustakaan') }}'" class="d-flex align-items-center menu-side text-decoration-none">
						<div class="col-3 text-center">
							<i class="fas fa-user"></i>
						</div>
						<div class="col-7" style="line-height: 18px">
							Profil
						</div>
						<div class="text-end col-2">
							<i class="fas fa-chevron-right me-3 chevron"></i>
						</div>
					</a>
				</div>
				<div class="position-absolute" style="bottom: 50px; width: calc(100% - 20px)">
					<a href="javascript:;" onclick="this.href='{{ route('logout') }}'" class="d-flex align-items-center menu-side text-decoration-none w-100">
						<div class="col-3 text-center">
							<i class="fas fa-power-off"></i>
						</div>
						<div class="col-7" style="line-height: 18px">
							Logout
						</div>
						<div class="text-end col-2">
							<i class="fas fa-chevron-right me-3 chevron"></i>
						</div>
					</a>
				</div>

			</div>
		</aside>
	</section>
	<section>
		<div class="content">
			@yield('content')
		</div>
	</section>
	<div id="myModal" class="mymodal">
	  	<div class="mymodal-content bounceIn">
	  		<div class="text-end">
	  			<i class="fas fa-close border rounded-circle border-dark px-1" style="cursor: pointer;" onclick="closeModal()"></i>
	  		</div>
	  		<br>
	  		<div class="pesan-buku">
	  			<h4 style="color: #109CF1"><strong>Pesan Buku</strong></h4>
	  			<hr>
	  		@foreach($notification as $notif)
		  		<div class="pesan-buku">
					<div>
						<h4><strong>{{ $notif->nisn }} - {{ $notif->nama }}</strong></h4>
						<span><strong>Pesan Buku : </strong>{{ $notif->judul_buku }}</span>
					</div>
					<hr>
					<div class="w-100 text-end">
						<a href="javascript:;" onclick="this.href='{{ route('admin.pinjambuku') }}/terima/{{ $notif->id_pinjam }}'" class="btn text-white my-1" style="background-color: #109CF1;"><strong>Terima</strong></a>
						<a href="javascript:;" onclick="this.href='{{ route('admin.pinjambuku') }}/delete/{{ $notif->id_pinjam }}'" class="btn bg-white my-1" style="color: #109CF1; border: 1px solid #109CF1"><strong>Batalkan</strong></a>
					</div>
				</div>
			@endforeach
			</div>
	  	</div>
	</div>
	<script type="text/javascript">
		var modal = document.getElementById("myModal");
		function notifModal(){
		  	modal.style.display = "block";
		  	modal.classList.add("bounceIn");
		}
		function closeModal(){
		  	modal.style.display = "none";
		  	modal.classList.remove("bounceIn");
		}
	</script>
	@if(Session::has('success'))
	<?=
		'<script type="text/javascript">
			iziToast.success({
            	title : "Success",
            	message: "'.Session::get('success').'",
            	position: "topCenter"
        	})
		</script>'
	?>
	@endif
	@if(Session::has('error'))
	<?=
		'<script type="text/javascript">
			iziToast.error({
            	title : "Error",
            	message: "'.Session::get('error').'",
            	position: "topCenter"
        	})
		</script>'
	?>
	@endif
</body>
</html>
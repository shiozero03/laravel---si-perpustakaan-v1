<!DOCTYPE html>
<html>
<head>
	<title>SI - PERPUSTAKAAN | @yield('title')</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/iziToast/iziToast.min.css') }}">

	<link rel="shortcut icon" type="text/css" href="{{ asset('assets/images/logo.png') }}">

	<script type="text/javascript" src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
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
				<div class="me-auto menu-cover-top">
					<a href="javascript:;" onclick="this.href='{{ route('user.profilperpustakaan') }}'"  class="top-menu">
						Profil Perpustakaan
					</a>
					<a href="javascript:;" onclick="this.href='{{ route('user.berita') }}'" class="top-menu">
						Berita Perpustakaan
					</a>
				</div>
				<div class="ms-auto menu-right-top d-flex align-items-center">
					<div class="info position-relative">
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
					<a href="javascript:;" onclick="this.href='{{ route('user.beranda') }}'" class="d-flex align-items-center menu-side text-decoration-none">
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
					<a href="javascript:;" onclick="this.href='{{ route('user.pinjam') }}'" class="d-flex align-items-center menu-side text-decoration-none">
						<div class="col-3 text-center">
							<i class="fas fa-calendar-days"></i>
						</div>
						<div class="col-7" style="line-height: 18px">
							Riwayat<br>Peminjaman
						</div>
						<div class="text-end col-2">
							<i class="fas fa-chevron-right me-3 chevron"></i>
						</div>
					</a>
					<a href="javascript:;" onclick="this.href='{{ route('user.catalog') }}'" class="d-flex align-items-center menu-side text-decoration-none">
						<div class="col-3 text-center">
							<i class="fas fa-book"></i>
						</div>
						<div class="col-7" style="line-height: 18px">
							Katalog Buku
						</div>
						<div class="text-end col-2">
							<i class="fas fa-chevron-right me-3 chevron"></i>
						</div>
					</a>
					<a href="javascript:;" onclick="this.href='{{ route('user.daftarBuku') }}'" class="d-flex align-items-center menu-side text-decoration-none">
						<div class="col-3 text-center">
							<i class="fas fa-list"></i>
						</div>
						<div class="col-7" style="line-height: 18px">
							Daftar Buku
						</div>
						<div class="text-end col-2">
							<i class="fas fa-chevron-right me-3 chevron"></i>
						</div>
					</a>
					<a href="javascript:;" onclick="this.href='{{ route('user.profil') }}'" class="d-flex align-items-center menu-side text-decoration-none">
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
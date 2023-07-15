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
			background-image: url("{{ asset('assets/images/bg-sementara.jpg')  }}");
			background-size: 100% 100vh;
			background-repeat: no-repeat;
			background-attachment: fixed;
		}
		.cover-form::before{
			content: '';
			z-index: -1;
		    position: fixed;
		    top: 19px;
		    left: 19px;
		    right: 19px;
		    bottom: 19px;
		    background: rgba(255, 255, 255, .6);
		    filter: blur(5px);
		}
		.cover-form{
			width: calc(100% - 38px);
			height: calc(100vh - 38px);
			border-radius: 5px;
			position: fixed;
			z-index: 1;
			background: inherit;
			overflow: hidden;
			margin: 19px;
		}
		.form-cover{
			z-index: 2;
		}
		.auth-form form{
			padding: 64px 50px;
			margin-top: 72px;
			height: calc(100vh - 144px);
			overflow: scroll;
			border-radius: 10px;
		}
		.auth-form form::-webkit-scrollbar {
		    width: 1px
		}
		.auth-form h1{
			padding-bottom: 30px;
			font-size: 32px;
			font-weight: 600;
		}
		.auth-form .form-group{
			margin-top: 10px;
		}
		.auth-form label{
			font-weight: 500;
			margin-bottom: 5px;
		}

		.text-title{
			color: #3C84AB;
		}
		.bg-blue{
			background: #109CF1;
		}
		.text-blue{
			color: #109CF1;
		}
	</style>
</head>
<body>
	<section class="cover-form"></section>
	<div class="form-cover d-flex align-items-center justify-content-center position-relative">
		<div class="auth-form">
			@yield('content')
		</div>
	</div>
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
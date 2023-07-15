@extends('pages.user.layout')
@section('title', 'Daftar Buku tersimpan')
@section('content')
<script type="text/javascript">
	document.getElementsByClassName('menu-side')[3].classList.add('active')
</script>
<style type="text/css">
	.page-header h3{
		font-weight: 500;
		font-size: 26px;
	}
	.form-search{
		margin: 30px 0
	}
	.cover-buku{
		background: #FFFFFF;
		border: 1px solid #D5D5D5;
		box-shadow: 12px 12px 10px rgba(0, 0, 0, 0.05);
		border-radius: 6px;
		padding:35px 28px;
	}
	.isi-buku{
		background: #FFFFFF;
		border: 1px solid #D5D5D5;
		box-shadow: 12px 12px 10px rgba(0, 0, 0, 0.05);
		position: relative;
	}
	.isi-buku h3{
		font-weight: 600;
		font-size: 24px;
	}
</style>
<div class="profil">
	<div class="bg-blue rounded page-header">
		<div class="px-3 text-white py-3">
			<h3 class="border-start border-white border-2 py-1 my-0">
				<span class="ms-3">Katalog Buku</span>
			</h3>
		</div>
	</div>
	<div class="cover-buku">
		@if($buku->count() > 0)
			<div class="row">
				@foreach($buku as $book)
				<div class="col-4">
					<a href="javascript:;" onclick="this.href='{{ route('user.catalog') }}/{{ $book->id_buku }}'" class="text-decoration-none text-dark">
						<div class="isi-buku rounded" style="height: 530px">
							<div>
								<div>
									<img width="100%" height="350px" src="{{ asset('assets/images/buku/'.$book->cover_buku) }}" class="rounded">
								</div>
								<div style="margin: 20px">
									<h3 class="my-0">{{ $book->judul_buku }}</h3>
									<small style="color: #3C84AB;">{{ $book->pengarang }}</small>
								</div>
								<div style="background: #D9D9D9; height: 2px; width: 100%; margin-bottom: 24px"></div>
								<div style="margin: 20px; position: relative;">
									<div class="w-100 d-flex align-items-center">
										<div class="col-8 w-100">
											@if($book->status == 'Tersedia')
											<span style="background-color: #ECFFC7; color: #7C8C57; padding: 6px 10px; border-radius: 10px;">{{ $book->status }}</span>
											@else
											<span class="text-white" style="background-color: #B7B7B7;padding: 6px 10px; border-radius: 10px;">{{ $book->status }}</span>
											@endif
										</div>
										<div class="col-4 text-end" style="position: absolute;right: 0">
											<a href="javascript:;" onclick="this.href='{{ route('user.daftarBuku') }}/hapus/{{ $book->id_simpan }}'" class="text-decoration-none">
												<i style="color: #FAAF1E; font-size: 20px" class="fas fa-bookmark"></i>
											</a>
										</div>	
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>
				@endforeach
			</div>
		@else
		<div class="text-center">
			<h1><em>Tidak Ada Data</em></h1>
		</div>
		@endif
		{{ $buku->links('vendor.pagination.default') }}
	</div>
</div>
<br><br>

@endsection
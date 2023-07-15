<script type="text/javascript">
	document.getElementsByClassName('riwayat-menu')[2].classList.add('active');
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
		padding: 20px 40px;
		border: 1px solid #D5D5D5;
		box-shadow: 12px 12px 10px rgba(0, 0, 0, 0.05);
		border-radius: 6px;
		margin-bottom: 20px;
	}
</style>
@foreach($berita as $news)
<div class="content-profil">
	<div class="bg-white cover-content">
		<h4 class="my-0" style="font-weight: 600">{{ $news->judul_berita }}</h4>
		<div class="d-flex align-items-center" style="margin-top: 12px; margin-bottom:18px;">
			<i class="far fa-clock me-2" style="color: #109CF1"></i>{{ date('d M Y', strtotime($news->tanggal_berita)) }}
			<i class="far fa-user ms-4 me-2" style="color: #109CF1"></i>{{ $news->author }}
		</div>
		<div style="background: #D9D9D9; height: 2px; width: 100%;"></div>
		<div style="margin-top: 18px">
			<?= ''.substr($news->isi_berita, 0, 500).'' ?>
		</div>
		<a href="javascript:;" onclick="this.href='{{ route('admin.dataperpustakaan') }}/edit/berita/{{ $news->id_berita }}'" class="btn text-white px-5" style="background-color: #334D6E">Edit</a>
	</div>
</div>
@endforeach
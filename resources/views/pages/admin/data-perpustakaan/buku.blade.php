<script type="text/javascript">
	document.getElementsByClassName('riwayat-menu')[0].classList.add('active');
</script>
<style type="text/css">
	.dataTables_filter{
		margin-bottom: 10px
	}
	#datatable td, #datatable th{
        vertical-align: middle;
}
</style>
<div>
	<table class="table table-striped border mt-2" id="datatable">
		<thead>
			<tr class="bg-blue text-white">
				<th style="font-size: 18px"><small>NO</small></th>
				<th style="font-size: 18px"><small>ID BUKU</small></th>
				<th style="font-size: 18px"><small>JUDUL BUKU</small></th>
				<th style="font-size: 18px"><small>PENGARANG</small></th>
				<th width="20%" style="font-size: 18px"><small>STATUS</small></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php $no = 1; ?>
			@foreach($buku as $book)
				<tr>
					<td style="font-size: 18px"><small>{{ $no++ }}</small></td>
					<td style="font-size: 18px"><small>ID: {{ $book->id_buku }}</small></td>
					<td style="font-size: 18px"><small>{{ $book->judul_buku }}</small></td>
					<td style="font-size: 18px"><small>{{ $book->pengarang }}</small></td>
					<td style="font-size: 18px">
						@if($book->status == 'Tersedia')
							<small style="background-color: #34B2FF; border-radius: 5px" class="py-1 px-2 text-white">{{ $book->status }}</small>
						@else
							<small style="border-radius: 5px" class="py-1 px-2 text-white bg-danger">{{ $book->status }}</small>
						@endif
					</td>
					<td style="font-size: 18px"><small><a href="javascript:;" onclick="this.href='{{ route('admin.dataperpustakaan') }}/edit/buku/{{ $book->id_buku }}'" class="text-decoration-none"><i class="fas fa-pen"></i></a></small></td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
<script type="text/javascript">
	$('#datatable').DataTable()
</script>
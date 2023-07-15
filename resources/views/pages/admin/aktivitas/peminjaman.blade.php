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
				<th style="font-size: 15px"><small>No</small></th>
				<th style="font-size: 15px"><small>ID BUKU</small></th>
				<th style="font-size: 15px"><small>Peminjam Buku</small></th>
				<th style="font-size: 15px"><small>JUDUL BUKU</small></th>
				<th width="20%" style="font-size: 15px"><small>STATUS</small></th>
				<th style="font-size: 15px"><small>TANGGAL PEMINJAMAN</small></th>
				<th style="font-size: 15px"><small>TANGGAL JATUH TEMPO</small></th>
				<th style="font-size: 15px"><small>JUMLAH HARI TERLAMBAT</small></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php $no=1; ?>
			@foreach($buku as $book)
			<tr>
				<td>{{ $no++ }}</td>
				<td style="font-size: 15px">ID: {{ $book->id_buku }}</td>
				<td style="font-size: 15px">{{ $book->nama }}</td>
				<td style="font-size: 15px">{{ $book->judul_buku }}</td>
				<td style="font-size: 15px">
					@if($book->tanggal_dikembalikan == null)
						@if(date('Y-m-d') > $book->jatuh_tempo)
							<small class="text-white" style="background: #FF0000; border-radius: 10px; padding: 6px 8px;">Lewat Jatuh Tempo</small>
						@else
							@if( ( strtotime($book->jatuh_tempo) - strtotime(date('Y-m-d')) ) < 345600 )
								<small class="text-dark" style="background: #FFFF00; border-radius: 10px; padding: 6px 8px;">Mendekati Jatuh Tempo</small>
							@else
								<small class="text-white" style="background: #5278FF; border-radius: 10px; padding: 6px 8px;">Sedang Dipinjam</small>
							@endif
						@endif
					@else
						<small class="text-white" style="background: #34B2FF; border-radius: 10px; padding: 6px 8px;">Sudah Dikembalikan</small>
					@endif
				</td>
				<td style="font-size: 15px">{{ $book->tanggal_peminjaman }}</td>
				<td style="font-size: 15px">{{ $book->jatuh_tempo }}</td>
				<td style="font-size: 15px">
					<?php
						$pinjam = strtotime(date('Y-m-d'));
						$tempo = strtotime($book->jatuh_tempo);
						$terlambat = ($pinjam - $tempo)/(24*60*60);
						if($book->tanggal_dikembalikan == null){
							if($terlambat > 0){
								echo $terlambat.' hari';
							} else {
								echo "0 hari";
							}
						} else {
							$kembali = strtotime($book->tanggal_dikembalikan);
							$telat = ($kembali - $tempo)/(24*60*60);
							if($telat > 0){
								echo $telat.' hari';
							} else {
								echo "0 hari";
							}
						}
					?>
				</td>
				<td><a id="{{ $book->id_pinjam }}" href="javascript:;" class="text-decoration-none updatepinjam"><i class="fas fa-pen"></i></a></td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
<div class="modal fade" id="editPengembalian" tabindex="-1" aria-labelledby="editPengembalianLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		  	<div class="modal-header">
			    <h5 class="modal-title" id="editPengembalianLabel">Update Data Peminjaman</h5>
			    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<table class="table table-striped table-bordered">
					<tr>
						<th>Judul Buku</th>
						<td>:</td>
						<td id="namabuku"></td>
					</tr>
					<tr>
						<th>Nama Peminjam</th>
						<td>:</td>
						<td id="nama"></td>
					</tr>
					<tr>
						<th>Tanggal Dipinjam</th>
						<td>:</td>
						<td id="tanggal_peminjaman"></td>
					</tr>
					<tr>
						<th>Jatuh Tempo</th>
						<td>:</td>
						<td id="jatuh_tempo"></td>
					</tr>
					<tr>
						<th>Keterlambatan</th>
						<td>:</td>
						<td><span id="keterlambatan"></span> hari</td>
					</tr>
					<form method="post" action="{{ route('admin.updateAktivitasdata') }}">
						<tr>
							<th>Status</th>
							<td>:</td>
							<td><span id="status"></span></td>
						</tr>
						<tr id="ubah-status">
							<th>Ubah Status</th>
							<td>:</td>
							<td>
								@csrf
								<input type="hidden" name="id_buku">
								<input type="hidden" name="id_pinjam">
								<select name="statuspinjam" class="form-control">
									<option value="Masih Dipinjam">Masih Dipinjam</option>
									<option value="Sudah Dikembalikan">Sudah Dikembalikan</option>
								</select>
								<button name="savepinjam" class="btn btn-primary mt-2">Simpan</button>
							</td>
						</tr>
					</form>
				</table>
		  	</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('#datatable').DataTable()

	$(document).on('click', '.updatepinjam', function(){
      	let id = $(this).attr('id');
      	$.ajax({
      		url : "{{ route('showDataPinjam') }}",
      		type : 'post',
      		data : {
      			id : id,
      			'_token' : "{{ csrf_token() }}"
      		},
      		success: function(params){
      			$('#namabuku').html(params.data.judul_buku)
      			$('#nama').html(params.data.nama)
      			$('#tanggal_peminjaman').html(params.data.tanggal_peminjaman)
      			$('#jatuh_tempo').html(params.data.jatuh_tempo)
      			$('#keterlambatan').html(params.telat);
      			$('#status').html(params.status);
      			if(params.data.tanggal_dikembalikan != null){
      				$('#ubah-status').addClass('d-none')
      			} else {
      				$('#ubah-status').removeClass('d-none')
      			}
      			$('input[name="id_buku"]').val(params.data.id_buku)
      			$('input[name="id_pinjam"]').val(params.data.id_pinjam)

	        	$('#editPengembalian').modal('show')
      		},
      		error: function(xhr){
      			console.log(xhr)
      		}
      	});
    })
</script>
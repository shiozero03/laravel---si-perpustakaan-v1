<script type="text/javascript">
	document.getElementsByClassName('riwayat-menu')[1].classList.add('active');
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
				<th style="font-size: 18px"><small>NAMA SISWA</small></th>
				<th style="font-size: 18px"><small>PASSWORD</small></th>
				<th style="font-size: 18px"><small>JUMLAH BUKU PINJAMAN</small></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php $no = 1; ?>
			@foreach($member as $mem)
				<tr>
					<td style="font-size: 18px"><small>{{ $no++ }}</small></td>
					<td style="font-size: 18px"><small>{{ $mem->nama }}</small></td>
					<td style="font-size: 18px"><small>{{ $mem->password }}</small></td>
					<td style="font-size: 18px">
						<small>
							<?php
								echo DB::table('pinjam_bukus')->join('members', 'members.id_member', '=', 'pinjam_bukus.id_member')->where('pinjam_bukus.tanggal_dikembalikan', null)->where('members.id_member', $mem->id_member)->get()->count().' Buku';
							?>
						</small>
					</td>
					<td style="font-size: 18px"><small><a id="{{ $mem->id_member }}" href="javascript:;" class="text-decoration-none update"><i class="fas fa-pen"></i></a></small></td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
<div class="modal fade" id="editdata" tabindex="-1" aria-labelledby="editdataLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		  	<div class="modal-header">
			    <h5 class="modal-title" id="editdataLabel">Update Data Siswa</h5>
			    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form method="post" action="{{ route('admin.updateAktivitasdata') }}">
					@csrf
					<div class="form-group mb-2">
						<label>Nama Siswa</label>
						<input type="hidden" name="id_member" class="form-control">
						<input type="text" name="nama" class="form-control">
					</div>
					<div class="form-group mb-2">
						<label>Password</label>
						<input type="password" name="password" class="form-control">
					</div>
					<div class="form-group mb-2">
						<button class="btn btn-primary w-100" name="usersave">Simpan</button>
				</form>
		  	</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('#datatable').DataTable()
	$(document).on('click', '.update', function(){
      	let id = $(this).attr('id');
      	$.ajax({
      		url : "{{ route('showDataMember') }}",
      		type : 'post',
      		data : {
      			id : id,
      			'_token' : "{{ csrf_token() }}"
      		},
      		success: function(params){
      			$('input[name=id_member]').val(params.data.id_member);
      			$('input[name=nama]').val(params.data.nama);
      			$('input[name=password]').val(params.data.password);
	        	$('#editdata').modal('show')
      		},
      		error: function(xhr){
      			console.log(xhr)
      		}
      	});
    })
</script>
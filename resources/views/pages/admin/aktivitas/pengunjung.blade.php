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
	<div class="float-end">
		<div class="position-relative">
			<select class="form-control pe-5" id="cek-hari">
				<option value="Hari Ini">Hari Ini</option>
				<option value="Minggu Ini">Minggu Ini</option>
				<option value="Bulan Ini">Bulan Ini</option>
				<option value="Tahun Ini">Tahun Ini</option>
				<option value="Semua">Semua</option>
			</select>
			<label for="cek-hari" class="position-absolute" style="top: 50%; transform: translateY(-50%); right: 5px;">
				<i class="fas fa-chevron-down"></i>
			</label>
		</div>
	</div>
	<div class="clearfix"></div>
	<table class="table table-striped border mt-2">
		<thead>
			<tr class="bg-blue text-white">
				<th style="font-size: 15px"><small>NO</small></th>
				<th style="font-size: 15px"><small>NAMA</small></th>
				<th style="font-size: 15px"><small>TANGGAL KUNJUNGAN</small></th>
				<th width="20%" style="font-size: 15px"><small>JAM KEDATANGAN</small></th>
			</tr>
		</thead>
		<tbody id="hari-ini">
			<?php $no = 1; ?>
			@if($hariini->count() > 0)
				@foreach($hariini as $kjg)
				<tr>
					<td style="font-size: 15px">{{ $no++ }}</td>
					<td style="font-size: 15px">{{ $kjg->nama_pengunjung }}</td>
					<td style="font-size: 15px">{{ $kjg->tanggal_kunjungan }}</td>
					<td style="font-size: 15px">{{ date('h:i A' , strtotime($kjg->waktu_kunjungan)) }}</td>
				</tr>
				@endforeach
			@else
				<tr>
					<td colspan="4" class="text-center"><em>Tidak Ada Pengunjung Hari Ini</em></td>
				</tr>
			@endif
		</tbody>
		<tbody class="d-none" id="minggu-ini">
			<?php $no = 1; ?>
			@if($mingguini->count() > 0)
				@foreach($mingguini as $kjg)
				<tr>
					<td style="font-size: 15px">{{ $no++ }}</td>
					<td style="font-size: 15px">{{ $kjg->nama_pengunjung }}</td>
					<td style="font-size: 15px">{{ $kjg->tanggal_kunjungan }}</td>
					<td style="font-size: 15px">{{ date('h:i A' , strtotime($kjg->waktu_kunjungan)) }}</td>
				</tr>
				@endforeach
			@else
				<tr>
					<td colspan="4" class="text-center"><em>Tidak Ada Pengunjung Minggu Ini</em></td>
				</tr>
			@endif
		</tbody>
		<tbody class="d-none" id="bulan-ini">
			<?php $no = 1; ?>
			@if($bulanini->count() > 0)
				@foreach($bulanini as $kjg)
				<tr>
					<td style="font-size: 15px">{{ $no++ }}</td>
					<td style="font-size: 15px">{{ $kjg->nama_pengunjung }}</td>
					<td style="font-size: 15px">{{ $kjg->tanggal_kunjungan }}</td>
					<td style="font-size: 15px">{{ date('h:i A' , strtotime($kjg->waktu_kunjungan)) }}</td>
				</tr>
				@endforeach
			@else
				<tr>
					<td colspan="4" class="text-center"><em>Tidak Ada Pengunjung Bulan Ini</em></td>
				</tr>
			@endif
		</tbody>
		<tbody class="d-none" id="tahun-ini">
			<?php $no = 1; ?>
			@if($tahunini->count() > 0)
				@foreach($tahunini as $kjg)
				<tr>
					<td style="font-size: 15px">{{ $no++ }}</td>
					<td style="font-size: 15px">{{ $kjg->nama_pengunjung }}</td>
					<td style="font-size: 15px">{{ $kjg->tanggal_kunjungan }}</td>
					<td style="font-size: 15px">{{ date('h:i A' , strtotime($kjg->waktu_kunjungan)) }}</td>
				</tr>
				@endforeach
			@else
				<tr>
					<td colspan="4" class="text-center"><em>Tidak Ada Pengunjung Tahun Ini</em></td>
				</tr>
			@endif
		</tbody>
		<tbody class="d-none" id="semua">
			<?php $no = 1; ?>
			@if($semua->count() > 0)
				@foreach($semua as $kjg)
				<tr>
					<td style="font-size: 15px">{{ $no++ }}</td>
					<td style="font-size: 15px">{{ $kjg->nama_pengunjung }}</td>
					<td style="font-size: 15px">{{ $kjg->tanggal_kunjungan }}</td>
					<td style="font-size: 15px">{{ date('h:i A' , strtotime($kjg->waktu_kunjungan)) }}</td>
				</tr>
				@endforeach
			@else
				<tr>
					<td colspan="4" class="text-center"><em>Tidak Ada Pengunjung</em></td>
				</tr>
			@endif
		</tbody>
	</table>
</div>
<script type="text/javascript">
	$('#cek-hari').on('change', function(e){
		var hari = $('#hari-ini')
		var minggu = $('#minggu-ini')
		var bulan = $('#bulan-ini')
		var tahun = $('#tahun-ini')
		var semua = $('#semua')

		var target = e.target.value;

		if(target == 'Minggu Ini'){
			hari.addClass('d-none')
			minggu.removeClass('d-none')
			bulan.addClass('d-none')
			tahun.addClass('d-none')
			semua.addClass('d-none')
		} else if(target == 'Bulan Ini'){
			hari.addClass('d-none')
			minggu.addClass('d-none')
			bulan.removeClass('d-none')
			tahun.addClass('d-none')
			semua.addClass('d-none')
		} else if(target == 'Tahun Ini'){
			hari.addClass('d-none')
			minggu.addClass('d-none')
			bulan.addClass('d-none')
			tahun.removeClass('d-none')
			semua.addClass('d-none')
		} else if(target == 'Semua'){
			hari.addClass('d-none')
			minggu.addClass('d-none')
			bulan.addClass('d-none')
			tahun.addClass('d-none')
			semua.removeClass('d-none')
		} else{
			hari.removeClass('d-none')
			minggu.addClass('d-none')
			bulan.addClass('d-none')
			tahun.addClass('d-none')
			semua.addClass('d-none')
		}
	})
</script>
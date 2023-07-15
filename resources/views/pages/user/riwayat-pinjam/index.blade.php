@extends('pages.user.layout')
@section('title', 'Riwayat Peminjaman')
@section('content')
<script type="text/javascript">
	document.getElementsByClassName('menu-side')[1].classList.add('active')
</script>
<style type="text/css">
	.page-header h3{
		font-weight: 500;
		font-size: 26px;
	}
	.cover-buku{
		background: #EFF0F4;
		border: 1px solid #D5D5D5;
		box-shadow: 12px 12px 10px rgba(0, 0, 0, 0.05);
		border-radius: 6px;
		padding:35px 28px;
	}
	.cover-luar{
		background: #FFFFFF;
		border: 1px solid #D5D5D5;
		box-shadow: 12px 12px 10px rgba(0, 0, 0, 0.05);
		position: relative;
		margin-bottom: 22px;
	}
	.isi-buku{
		margin: 22px;
	}
	.isi-buku h3{
		font-weight: 600;
		font-size: 24px;
		color: #109CF1;
	}
	.form-riwayat{
		background-color: #858796;
		margin: 30px auto;
		border-radius: 10px;
		overflow: hidden;
	}
	.riwayat-menu.active{
		background-color: #109CF1
	}
</style>
<div class="profil">
	<div class="bg-blue rounded page-header">
		<div class="px-3 text-white py-3">
			<h3 class="border-start border-white border-2 py-1 my-0">
				<span class="ms-3">Riwayat Peminjaman</span>
			</h3>
		</div>
	</div>
	<div class="form-search">
		<div class="form-riwayat row">
			<div style="width: 20%;" class="text-center riwayat-menu">
				<a href="javascript:;" onclick="this.href='/user/riwayat-peminjaman?filter=semua'" class="text-decoration-none text-center w-100">
					<i style="margin-top: 18px; color: #000000" class="fas fa-list bg-white p-1 rounded"></i><br>
					<p style="margin-bottom: 18px" class="mt-2"><span class="text-white">Semua Pinjaman</span></p>
				</a>
			</div>
			<div style="width: 20%;" class="text-center riwayat-menu">
				<a href="javascript:;" onclick="this.href='/user/riwayat-peminjaman?filter=sedang_dipinjam'" class="text-decoration-none text-center w-100">
					<i style="margin-top: 18px; color: #000000" class="fas fa-book-open text-white p-1 rounded"></i><br>
					<p style="margin-bottom: 18px" class="mt-2"><span class="text-white">Sedang Dipinjam</span></p>
				</a>
			</div>
			<div style="width: 20%;" class="text-center riwayat-menu">
				<a href="javascript:;" onclick="this.href='/user/riwayat-peminjaman?filter=mendekati_jatuh_tempo'" class="text-decoration-none text-center w-100">
					<i style="margin-top: 18px; color: #000000" class="fas fa-calendar-days text-white p-1 rounded"></i><br>
					<p style="margin-bottom: 18px" class="mt-2"><span class="text-white">Mendekati Jatuh Tempo</span></p>
				</a>
			</div>
			<div style="width: 20%;" class="text-center riwayat-menu">
				<a href="javascript:;" onclick="this.href='/user/riwayat-peminjaman?filter=lewat_jatuh_tempo'" class="text-decoration-none text-center w-100">
					<i style="margin-top: 18px; color: #000000" class="fas fa-clock text-white p-1 rounded"></i><br>
					<p style="margin-bottom: 18px" class="mt-2"><span class="text-white">Lewat Jatuh Tempo</span></p>
				</a>
			</div>
			<div style="width: 20%;" class="text-center riwayat-menu">
				<a href="javascript:;" onclick="this.href='/user/riwayat-peminjaman?filter=sudah_dikembalikan'" class="text-decoration-none text-center w-100">
					<i style="margin-top: 18px; color: #000000" class="fas fa-check text-white p-1 rounded"></i><br>
					<p style="margin-bottom: 18px" class="mt-2"><span class="text-white">Sudah Dikembalikan</span></p>
				</a>
			</div>
		</div>
	</div>
	@if(isset($_GET['filter']))
	<?php $filter = $_GET['filter'] ?>
		@if($filter == 'semua')
		<script type="text/javascript">
			document.getElementsByClassName('riwayat-menu')[0].classList.add('active');
		</script>
		@elseif($filter == 'sedang_dipinjam')
		<script type="text/javascript">
			document.getElementsByClassName('riwayat-menu')[1].classList.add('active');
		</script>
		@elseif($filter == 'mendekati_jatuh_tempo')
		<script type="text/javascript">
			document.getElementsByClassName('riwayat-menu')[2].classList.add('active');
		</script>
		@elseif($filter == 'lewat_jatuh_tempo')
		<script type="text/javascript">
			document.getElementsByClassName('riwayat-menu')[3].classList.add('active');
		</script>
		@elseif($filter == 'sudah_dikembalikan')
		<script type="text/javascript">
			document.getElementsByClassName('riwayat-menu')[4].classList.add('active');
		</script>
		@endif
	@else
	<script type="text/javascript">
		document.getElementsByClassName('riwayat-menu')[0].classList.add('active');
	</script>
	@endif

	<div class="cover-buku">
		@if($buku->count() > 0)
			@foreach($buku as $book)
				@if(isset($_GET['filter']))
					<?php $filter = $_GET['filter'] ?>
					@if($filter == 'semua')
						<a href="javascript:;" onclick="this.href='{{ route('user.catalog') }}/view/{{ $book->id_buku }}'" class="text-decoration-none text-dark">
							<div class="cover-luar">
								<div class="isi-buku d-flex align-items-center">
									<h3 class="col-9">{{ $book->judul_buku }}</h3>
									<div class="col-3 text-end">
										@if($book->tanggal_dikembalikan == null)
											@if(date('Y-m-d') > $book->jatuh_tempo)
												<span class="text-white" style="background: #FF0000; border-radius: 10px; padding: 6px 8px;">Lewat Jatuh Tempo</span>
											@else
												@if( ( strtotime($book->jatuh_tempo) - strtotime(date('Y-m-d')) ) < 345600 )
													<span class="text-dark" style="background: #FFFF00; border-radius: 10px; padding: 6px 8px;">Mendekati Jatuh Tempo</span>
												@else
													<span class="text-white" style="background: #34B2FF; border-radius: 10px; padding: 6px 8px;">Sedang Dipinjam</span>
												@endif
											@endif
										@else
											<span class="text-white" style="background: #62C28E; border-radius: 10px; padding: 6px 8px;">Sudah Dikembalikan</span>
										@endif
									</div>
								</div>
								<div style="background: #D9D9D9; height: 2px; width: 100%;"></div>
								<div class="isi-buku">
									<table>
										<tr>
											<th width="25px"><i style="margin-bottom: 12.5px; margin-top: 12.5px" class="fas fa-calendar-days"></i></th>
											<th width="200px">Tanggal Peminjaman</th>
											<td width="200px">
												<div class="w-100 text-end">
													{{ date('d-M-Y', strtotime($book->tanggal_peminjaman)) }}
												</div>
											</td>
										</tr>
										<tr>
											<th width="25px"><i style="margin-bottom: 12.5px; margin-top: 12.5px" class="fas fa-calendar-days"></i></th>
											<th width="200px">Tanggal Jatuh Tempo</th>
											<td width="200px">
												<div class="w-100 text-end">
													{{ date('d-M-Y', strtotime($book->jatuh_tempo)) }}
												</div>
											</td>
										</tr>
										<tr>
											<th width="25px"><i style="margin-bottom: 12.5px; margin-top: 12.5px; font-size: 8px" class="fas fa-arrow-left text-white bg-dark rounded p-1"></i></th>
											<th width="200px">Tanggal Pengembalian</th>
											<td width="200px">
												<div class="w-100 text-end">
													@if($book->tanggal_dikembalikan == null)
														<em>(Belum Dikembalikan)</em>
													@else
														{{ date('d-M-Y', strtotime($book->tanggal_dikembalikan)) }}
													@endif
												</div>
											</td>
										</tr>
										<tr>
											<th width="25px"><i style="margin-bottom: 12.5px; margin-top: 12.5px" class="fas fa-circle-info"></i></th>
											<th width="200px">Jumlah Hari Terlewat</th>
											<td width="200px">
												<div class="w-100 text-end">
													@if($book->tanggal_dikembalikan == null)
														@if($book->jatuh_tempo > date('Y-m-d'))
															0 (Hari)
														@else
															<?php
																$now = date('Y-m-d');
																$terlambat = strtotime($book->jatuh_tempo) - strtotime($now);
																$showterlambat = abs($terlambat/(24*60*60));
															?>
															{{ $showterlambat }} (Hari)
														@endif
													@else
														@if($book->jatuh_tempo > $book->tanggal_dikembalikan)
															0 (Hari)
														@else
															<?php
																$terlambat2 = strtotime($book->tanggal_dikembalikan) - strtotime($book->jatuh_tempo);
																$showterlambat2 = abs($terlambat2/(24*60*60));
															?>
															{{ $showterlambat2 }} (Hari)
														@endif
													@endif
												</div>
											</td>
										</tr>
									</table>
								</div>
							</div>
						</a>
					@elseif($filter == 'sedang_dipinjam')
						@if( ($book->tanggal_dikembalikan == null) && (date('Y-m-d') <= $book->jatuh_tempo) && (( strtotime($book->jatuh_tempo) - strtotime(date('Y-m-d')) ) >= 345600) )
							<a href="javascript:;" onclick="this.href='{{ route('user.catalog') }}/view/{{ $book->id_buku }}'" class="text-decoration-none text-dark">
								<div class="cover-luar">
									<div class="isi-buku d-flex align-items-center">
										<h3 class="col-9">{{ $book->judul_buku }}</h3>
										<div class="col-3 text-end">
											<span class="text-white" style="background: #34B2FF; border-radius: 10px; padding: 6px 8px;">Sedang Dipinjam</span>
										</div>
									</div>
									<div style="background: #D9D9D9; height: 2px; width: 100%;"></div>
									<div class="isi-buku">
										<table>
											<tr>
												<th width="25px"><i style="margin-bottom: 12.5px; margin-top: 12.5px" class="fas fa-calendar-days"></i></th>
												<th width="200px">Tanggal Peminjaman</th>
												<td width="200px">
													<div class="w-100 text-end">
														{{ date('d-M-Y', strtotime($book->tanggal_peminjaman)) }}
													</div>
												</td>
											</tr>
											<tr>
												<th width="25px"><i style="margin-bottom: 12.5px; margin-top: 12.5px" class="fas fa-calendar-days"></i></th>
												<th width="200px">Tanggal Jatuh Tempo</th>
												<td width="200px">
													<div class="w-100 text-end">
														{{ date('d-M-Y', strtotime($book->jatuh_tempo)) }}
													</div>
												</td>
											</tr>
											<tr>
												<th width="25px"><i style="margin-bottom: 12.5px; margin-top: 12.5px; font-size: 8px" class="fas fa-arrow-left text-white bg-dark rounded p-1"></i></th>
												<th width="200px">Tanggal Pengembalian</th>
												<td width="200px">
													<div class="w-100 text-end">
														@if($book->tanggal_dikembalikan == null)
															<em>(Belum Dikembalikan)</em>
														@else
															{{ date('d-M-Y', strtotime($book->tanggal_dikembalikan)) }}
														@endif
													</div>
												</td>
											</tr>
											<tr>
												<th width="25px"><i style="margin-bottom: 12.5px; margin-top: 12.5px" class="fas fa-circle-info"></i></th>
												<th width="200px">Jumlah Hari Terlewat</th>
												<td width="200px">
													<div class="w-100 text-end">
														@if($book->tanggal_dikembalikan == null)
															@if($book->jatuh_tempo > date('Y-m-d'))
																0 (Hari)
															@else
																<?php
																	$now = date('Y-m-d');
																	$terlambat = strtotime($book->jatuh_tempo) - strtotime($now);
																	$showterlambat = abs($terlambat/(24*60*60));
																?>
																{{ $showterlambat }} (Hari)
															@endif
														@else
															@if($book->jatuh_tempo > $book->tanggal_dikembalikan)
																0 (Hari)
															@else
																<?php
																	$terlambat2 = strtotime($book->tanggal_dikembalikan) - strtotime($book->jatuh_tempo);
																	$showterlambat2 = abs($terlambat2/(24*60*60));
																?>
																{{ $showterlambat2 }} (Hari)
															@endif
														@endif
													</div>
												</td>
											</tr>
										</table>
									</div>
								</div>
							</a>
						@endif
					@elseif($filter == 'mendekati_jatuh_tempo')
						@if( ($book->tanggal_dikembalikan == null) && (date('Y-m-d') <= $book->jatuh_tempo) && (( strtotime($book->jatuh_tempo) - strtotime(date('Y-m-d')) ) < 345600) )
							<a href="javascript:;" onclick="this.href='{{ route('user.catalog') }}/view/{{ $book->id_buku }}'" class="text-decoration-none text-dark">
								<div class="cover-luar">
									<div class="isi-buku d-flex align-items-center">
										<h3 class="col-9">{{ $book->judul_buku }}</h3>
										<div class="col-3 text-end">
											<span class="text-dark" style="background: #FFFF00; border-radius: 10px; padding: 6px 8px;">Mendekati Jatuh Tempo</span>
										</div>
									</div>
									<div style="background: #D9D9D9; height: 2px; width: 100%;"></div>
									<div class="isi-buku">
										<table>
											<tr>
												<th width="25px"><i style="margin-bottom: 12.5px; margin-top: 12.5px" class="fas fa-calendar-days"></i></th>
												<th width="200px">Tanggal Peminjaman</th>
												<td width="200px">
													<div class="w-100 text-end">
														{{ date('d-M-Y', strtotime($book->tanggal_peminjaman)) }}
													</div>
												</td>
											</tr>
											<tr>
												<th width="25px"><i style="margin-bottom: 12.5px; margin-top: 12.5px" class="fas fa-calendar-days"></i></th>
												<th width="200px">Tanggal Jatuh Tempo</th>
												<td width="200px">
													<div class="w-100 text-end">
														{{ date('d-M-Y', strtotime($book->jatuh_tempo)) }}
													</div>
												</td>
											</tr>
											<tr>
												<th width="25px"><i style="margin-bottom: 12.5px; margin-top: 12.5px; font-size: 8px" class="fas fa-arrow-left text-white bg-dark rounded p-1"></i></th>
												<th width="200px">Tanggal Pengembalian</th>
												<td width="200px">
													<div class="w-100 text-end">
														@if($book->tanggal_dikembalikan == null)
															<em>(Belum Dikembalikan)</em>
														@else
															{{ date('d-M-Y', strtotime($book->tanggal_dikembalikan)) }}
														@endif
													</div>
												</td>
											</tr>
											<tr>
												<th width="25px"><i style="margin-bottom: 12.5px; margin-top: 12.5px" class="fas fa-circle-info"></i></th>
												<th width="200px">Jumlah Hari Terlewat</th>
												<td width="200px">
													<div class="w-100 text-end">
														@if($book->tanggal_dikembalikan == null)
															@if($book->jatuh_tempo > date('Y-m-d'))
																0 (Hari)
															@else
																<?php
																	$now = date('Y-m-d');
																	$terlambat = strtotime($book->jatuh_tempo) - strtotime($now);
																	$showterlambat = abs($terlambat/(24*60*60));
																?>
																{{ $showterlambat }} (Hari)
															@endif
														@else
															@if($book->jatuh_tempo > $book->tanggal_dikembalikan)
																0 (Hari)
															@else
																<?php
																	$terlambat2 = strtotime($book->tanggal_dikembalikan) - strtotime($book->jatuh_tempo);
																	$showterlambat2 = abs($terlambat2/(24*60*60));
																?>
																{{ $showterlambat2 }} (Hari)
															@endif
														@endif
													</div>
												</td>
											</tr>
										</table>
									</div>
								</div>
							</a>
						@endif
					@elseif($filter == 'lewat_jatuh_tempo')
						@if( ($book->tanggal_dikembalikan == null) && (date('Y-m-d') > $book->jatuh_tempo) )
							<a href="javascript:;" onclick="this.href='{{ route('user.catalog') }}/view/{{ $book->id_buku }}'" class="text-decoration-none text-dark">
								<div class="cover-luar">
									<div class="isi-buku d-flex align-items-center">
										<h3 class="col-9">{{ $book->judul_buku }}</h3>
										<div class="col-3 text-end">
											<span class="text-white" style="background: #FF0000; border-radius: 10px; padding: 6px 8px;">Lewat Jatuh Tempo</span>
										</div>
									</div>
									<div style="background: #D9D9D9; height: 2px; width: 100%;"></div>
									<div class="isi-buku">
										<table>
											<tr>
												<th width="25px"><i style="margin-bottom: 12.5px; margin-top: 12.5px" class="fas fa-calendar-days"></i></th>
												<th width="200px">Tanggal Peminjaman</th>
												<td width="200px">
													<div class="w-100 text-end">
														{{ date('d-M-Y', strtotime($book->tanggal_peminjaman)) }}
													</div>
												</td>
											</tr>
											<tr>
												<th width="25px"><i style="margin-bottom: 12.5px; margin-top: 12.5px" class="fas fa-calendar-days"></i></th>
												<th width="200px">Tanggal Jatuh Tempo</th>
												<td width="200px">
													<div class="w-100 text-end">
														{{ date('d-M-Y', strtotime($book->jatuh_tempo)) }}
													</div>
												</td>
											</tr>
											<tr>
												<th width="25px"><i style="margin-bottom: 12.5px; margin-top: 12.5px; font-size: 8px" class="fas fa-arrow-left text-white bg-dark rounded p-1"></i></th>
												<th width="200px">Tanggal Pengembalian</th>
												<td width="200px">
													<div class="w-100 text-end">
														@if($book->tanggal_dikembalikan == null)
															<em>(Belum Dikembalikan)</em>
														@else
															{{ date('d-M-Y', strtotime($book->tanggal_dikembalikan)) }}
														@endif
													</div>
												</td>
											</tr>
											<tr>
												<th width="25px"><i style="margin-bottom: 12.5px; margin-top: 12.5px" class="fas fa-circle-info"></i></th>
												<th width="200px">Jumlah Hari Terlewat</th>
												<td width="200px">
													<div class="w-100 text-end">
														@if($book->tanggal_dikembalikan == null)
															@if($book->jatuh_tempo > date('Y-m-d'))
																0 (Hari)
															@else
																<?php
																	$now = date('Y-m-d');
																	$terlambat = strtotime($book->jatuh_tempo) - strtotime($now);
																	$showterlambat = abs($terlambat/(24*60*60));
																?>
																{{ $showterlambat }} (Hari)
															@endif
														@else
															@if($book->jatuh_tempo > $book->tanggal_dikembalikan)
																0 (Hari)
															@else
																<?php
																	$terlambat2 = strtotime($book->tanggal_dikembalikan) - strtotime($book->jatuh_tempo);
																	$showterlambat2 = abs($terlambat2/(24*60*60));
																?>
																{{ $showterlambat2 }} (Hari)
															@endif
														@endif
													</div>
												</td>
											</tr>
										</table>
									</div>
								</div>
							</a>
						@endif
					@elseif($filter == 'sudah_dikembalikan')
						@if( ($book->tanggal_dikembalikan != null) )
							<a href="javascript:;" onclick="this.href='{{ route('user.catalog') }}/view/{{ $book->id_buku }}'" class="text-decoration-none text-dark">
								<div class="cover-luar">
									<div class="isi-buku d-flex align-items-center">
										<h3 class="col-9">{{ $book->judul_buku }}</h3>
										<div class="col-3 text-end">
											<span class="text-white" style="background: #62C28E; border-radius: 10px; padding: 6px 8px;">Sudah Dikembalikan</span>
										</div>
									</div>
									<div style="background: #D9D9D9; height: 2px; width: 100%;"></div>
									<div class="isi-buku">
										<table>
											<tr>
												<th width="25px"><i style="margin-bottom: 12.5px; margin-top: 12.5px" class="fas fa-calendar-days"></i></th>
												<th width="200px">Tanggal Peminjaman</th>
												<td width="200px">
													<div class="w-100 text-end">
														{{ date('d-M-Y', strtotime($book->tanggal_peminjaman)) }}
													</div>
												</td>
											</tr>
											<tr>
												<th width="25px"><i style="margin-bottom: 12.5px; margin-top: 12.5px" class="fas fa-calendar-days"></i></th>
												<th width="200px">Tanggal Jatuh Tempo</th>
												<td width="200px">
													<div class="w-100 text-end">
														{{ date('d-M-Y', strtotime($book->jatuh_tempo)) }}
													</div>
												</td>
											</tr>
											<tr>
												<th width="25px"><i style="margin-bottom: 12.5px; margin-top: 12.5px; font-size: 8px" class="fas fa-arrow-left text-white bg-dark rounded p-1"></i></th>
												<th width="200px">Tanggal Pengembalian</th>
												<td width="200px">
													<div class="w-100 text-end">
														@if($book->tanggal_dikembalikan == null)
															<em>(Belum Dikembalikan)</em>
														@else
															{{ date('d-M-Y', strtotime($book->tanggal_dikembalikan)) }}
														@endif
													</div>
												</td>
											</tr>
											<tr>
												<th width="25px"><i style="margin-bottom: 12.5px; margin-top: 12.5px" class="fas fa-circle-info"></i></th>
												<th width="200px">Jumlah Hari Terlewat</th>
												<td width="200px">
													<div class="w-100 text-end">
														@if($book->tanggal_dikembalikan == null)
															@if($book->jatuh_tempo > date('Y-m-d'))
																0 (Hari)
															@else
																<?php
																	$now = date('Y-m-d');
																	$terlambat = strtotime($book->jatuh_tempo) - strtotime($now);
																	$showterlambat = abs($terlambat/(24*60*60));
																?>
																{{ $showterlambat }} (Hari)
															@endif
														@else
															@if($book->jatuh_tempo > $book->tanggal_dikembalikan)
																0 (Hari)
															@else
																<?php
																	$terlambat2 = strtotime($book->tanggal_dikembalikan) - strtotime($book->jatuh_tempo);
																	$showterlambat2 = abs($terlambat2/(24*60*60));
																?>
																{{ $showterlambat2 }} (Hari)
															@endif
														@endif
													</div>
												</td>
											</tr>
										</table>
									</div>
								</div>
							</a>
						@endif
					@endif
				@else
					<a href="javascript:;" onclick="this.href='{{ route('user.catalog') }}/view/{{ $book->id_buku }}'" class="text-decoration-none text-dark">
						<div class="cover-luar">
							<div class="isi-buku d-flex align-items-center">
								<h3 class="col-9">{{ $book->judul_buku }}</h3>
								<div class="col-3 text-end">
									@if($book->tanggal_dikembalikan == null)
										@if(date('Y-m-d') > $book->jatuh_tempo)
											<span class="text-white" style="background: #FF0000; border-radius: 10px; padding: 6px 8px;">Lewat Jatuh Tempo</span>
										@else
											@if( ( strtotime($book->jatuh_tempo) - strtotime(date('Y-m-d')) ) < 345600 )
												<span class="text-dark" style="background: #FFFF00; border-radius: 10px; padding: 6px 8px;">Mendekati Jatuh Tempo</span>
											@else
												<span class="text-white" style="background: #34B2FF; border-radius: 10px; padding: 6px 8px;">Sedang Dipinjam</span>
											@endif
										@endif
									@else
										<span class="text-white" style="background: #62C28E; border-radius: 10px; padding: 6px 8px;">Sudah Dikembalikan</span>
									@endif
								</div>
							</div>
							<div style="background: #D9D9D9; height: 2px; width: 100%;"></div>
							<div class="isi-buku">
								<table>
									<tr>
										<th width="25px"><i style="margin-bottom: 12.5px; margin-top: 12.5px" class="fas fa-calendar-days"></i></th>
										<th width="200px">Tanggal Peminjaman</th>
										<td width="200px">
											<div class="w-100 text-end">
												{{ date('d-M-Y', strtotime($book->tanggal_peminjaman)) }}
											</div>
										</td>
									</tr>
									<tr>
										<th width="25px"><i style="margin-bottom: 12.5px; margin-top: 12.5px" class="fas fa-calendar-days"></i></th>
										<th width="200px">Tanggal Jatuh Tempo</th>
										<td width="200px">
											<div class="w-100 text-end">
												{{ date('d-M-Y', strtotime($book->jatuh_tempo)) }}
											</div>
										</td>
									</tr>
									<tr>
										<th width="25px"><i style="margin-bottom: 12.5px; margin-top: 12.5px; font-size: 8px" class="fas fa-arrow-left text-white bg-dark rounded p-1"></i></th>
										<th width="200px">Tanggal Pengembalian</th>
										<td width="200px">
											<div class="w-100 text-end">
												@if($book->tanggal_dikembalikan == null)
													<em>(Belum Dikembalikan)</em>
												@else
													{{ date('d-M-Y', strtotime($book->tanggal_dikembalikan)) }}
												@endif
											</div>
										</td>
									</tr>
									<tr>
										<th width="25px"><i style="margin-bottom: 12.5px; margin-top: 12.5px" class="fas fa-circle-info"></i></th>
										<th width="200px">Jumlah Hari Terlewat</th>
										<td width="200px">
											<div class="w-100 text-end">
												@if($book->tanggal_dikembalikan == null)
													@if($book->jatuh_tempo > date('Y-m-d'))
														0 (Hari)
													@else
														<?php
															$now = date('Y-m-d');
															$terlambat = strtotime($book->jatuh_tempo) - strtotime($now);
															$showterlambat = abs($terlambat/(24*60*60));
														?>
														{{ $showterlambat }} (Hari)
													@endif
												@else
													@if($book->jatuh_tempo > $book->tanggal_dikembalikan)
														0 (Hari)
													@else
														<?php
															$terlambat2 = strtotime($book->tanggal_dikembalikan) - strtotime($book->jatuh_tempo);
															$showterlambat2 = abs($terlambat2/(24*60*60));
														?>
														{{ $showterlambat2 }} (Hari)
													@endif
												@endif
											</div>
										</td>
									</tr>
								</table>
							</div>
						</div>
					</a>
				@endif
			@endforeach
		@else
		<div class="text-center">
			<h1><em>Tidak Ada Data</em></h1>
		</div>
		@endif
	</div>
</div>
<br><br>

@endsection
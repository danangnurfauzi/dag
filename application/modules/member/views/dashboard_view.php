<?php echo $this->load->view('templates/header') ?>
<?php echo $this->load->view('templates/header_top') ?>
<?php echo $this->load->view('templates/sidebar') ?>
					
				<!-- /section:basics/sidebar -->
				<div class="main-content">
					<div class="main-content-inner">
						<!-- #section:basics/content.breadcrumbs -->
						<div class="breadcrumbs ace-save-state" id="breadcrumbs">
							<ul class="breadcrumb">
								<li>
									<i class="ace-icon fa fa-home home-icon"></i>
									<a href="#">Home</a>
								</li>
								<li class="active">Membership</li>
							</ul><!-- /.breadcrumb -->
						</div>
					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						<!-- /section:settings.box -->
						<div class="page-header">
							<div class="row">
								<div class="col-lg-4 col-xs-6">
									<!-- small box -->
									<div class="small-box bg-red">
										<div class="inner">
											<h3>Info Promo</h3>
											<p>Diskon 35% Rute Jakarta - Solo</p>
										</div>
										<div class="icon">
											<i class="fa fa-user"></i>
										</div>
										<span class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></span>
									</div>
								</div><!-- ./col -->
								<div class="col-lg-4 col-xs-6">
									<!-- small box -->
									<div class="small-box bg-blue">
										<div class="inner">
											<h3><?php echo $memberData->JumlahPoint ?></h3>
											<p>Jumlah Point Anda Saat Ini</p>
										</div>
										<div class="icon">
											<i class="fa fa-user"></i>
										</div>
										<span class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></span>
									</div>
								</div><!-- ./col -->
								<div class="col-lg-4 col-xs-6">
									<!-- small box -->
									<div class="small-box bg-orange">
										<div class="inner">
											<h3><?php echo $memberStatus->MemberStatusKeterangan ?></h3>
											<p>Status BO Plus Anda Saat Ini</p>
										</div>
										<div class="icon">
											<i class="fa fa-user"></i>
										</div>
										<span class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></span>
									</div>
								</div><!-- ./col -->
							</div><!-- /.row -->
						</div><!-- /.page-header -->

					<div class="space-6"></div>
					
						<!--div class="row row-centered">
							<div class="col-xs-8 col-centered">
								<div class="box box-danger">
									<div class="box-header">
										<i class="fa fa-search"><span> Cari Pesanan</span></i>
										<div class="form-horizontal">
											<div class="control-group">
												<div class="radio radio-inline">
													<label>
														<input name="form-field-radio" type="radio" class="ace" checked="checked" value="1"/>
														<span class="lbl"> Kode Booking</span>
													</label>
													<label>
														<input name="form-field-radio" type="radio" class="ace" value="2"/>
														<span class="lbl"> No E-Tiket</span>
													</label>
												</div>
											</div>
										<div class="space-6"></div>
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="email" placeholder="Kode Booking/E-Tiket">
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="pwd" placeholder="Nama Lengkap">
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" class="form-control" id="email" placeholder="Telp/Phone">
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-6 text-left">
													<a href="#" class="btn btn-danger btn-block" role="button"><i class="fa fa-pencil-square-o"></i> Manajemen Booking</a>
												</div>
												<div class="col-sm-6 text-right">
													<a href="#" class="btn btn-danger btn-block" role="button"><i class="fa fa-print"></i> Print Tiket</a>
												</div>
											</div>
										</div>
									</div>
								</div>
								
							</div>
						</div--><!-- /.row -->

						<!--div id="kdBooking1" class="row booking">
							<div class="col-xs-12">
								<div class="box box-info">
									<h4><i class="fa fa-search"></i> Hasil Pencarian Kode Booking</h3>
									<table class="table">
										<tbody>
										  <tr>
											<th><h4>Kode Booking</h4></th>
											<th><h4>Tanggal Pesan</h4></th>
											<th><h4>Time Limit</h4></th>
										  </tr>
										</tbody>
										<tbody>
										  <tr class="text-center">
											<td>ESE01082016</td>
											<td>07 Sep 2016</td>
											<td>3:23:01:25</td>
										  </tr>
										  <tr class="text-center">
											<td>ESE01082017</td>
											<td>07 Sep 2016</td>
											<td>3:23:01:25</td>
										  </tr>
										  <tr class="text-center">
											<td>ESE01082018</td>
											<td>07 Sep 2016</td>
											<td>3:23:01:25</td>
										  </tr>
										  <tr class="text-center">
											<td>ESE01082019</td>
											<td>07 Sep 2016</td>
											<td>3:23:01:25</td>
										  </tr>
										</tbody>
									</table>
								<div class="space-6"></div>
									<table class="table table-bordered">
										<thead>
										  <tr>
											<th>Kode Booking</th>
											<th>Nama Lengkap</th>
											<th>Asal</th>
											<th>Tujuan</th>
											<th>Kelas</th>
											<th>No. Seat</th>
											<th>Harga</th>
										  </tr>
										</thead>
										<tbody>
										  <tr>
											<td>ESE01082016</td>
											<td>Christina Winata</td>
											<td>Jakarta</td>
											<td>Solo</td>
											<td>Super Executive</td>
											<td class="text-center">12A</td>
											<td>Rp.450.000</td>
										  </tr>
										  <tr>
											<td>ESE01082017</td>
											<td>Christina Winata</td>
											<td>Jakarta</td>
											<td>Solo</td>
											<td>Super Executive</td>
											<td class="text-center">13A</td>
											<td>Rp.450.000</td>
										  </tr>
										  <tr>
											<td>ESE01082018</td>
											<td>Christina Winata</td>
											<td>Jakarta</td>
											<td>Solo</td>
											<td>Super Executive</td>
											<td class="text-center">14A</td>
											<td>Rp.450.000</td>
										  </tr>
										  <tr>
											<td>ESE01082019</td>
											<td>Christina Winata</td>
											<td>Jakarta</td>
											<td>Solo</td>
											<td>Super Executive</td>
											<td class="text-center">15A</td>
											<td>Rp.450.000</td>
										  </tr>
										</tbody>
										<tbody>
										  <tr>
											<td><b>Total Pesanan</b></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td>Rp.1.800.000</td>
											<td class="text-center"><a type="button" style="cursor:pointer;" data-toggle="modal" data-target="#myModal"><b>Bayar</b></a></td>
										  </tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>

						<div id="kdBooking2" class="row booking" style="display:none;">
							<div class="col-xs-12">
								<div class="box box-warning">
									<h4><i class="fa fa-search"></i> Hasil Pencarian No. E-Tiket</h3>
								<div class="space-6"></div>
									<table class="table table-bordered">
										<thead>
										  <tr>
											<th>No. E-Tiket</th>
											<th>Nama Lengkap</th>
											<th>Asal</th>
											<th>Tujuan</th>
											<th>Kelas</th>
											<th>No. Seat</th>
											<th>Print Tiket</th>
										  </tr>
										</thead>
										<tbody>
										  <tr>
											<td>RIS010820AD</td>
											<td>Christina Winata</td>
											<td>Jakarta</td>
											<td>Solo</td>
											<td>Super Executive</td>
											<td class="text-center">12A</td>
											<td class="text-center"><a href=""><b>Print</b></a></td>
										  </tr>
										  <tr>
											<td>RIS010820AD</td>
											<td>Christina Winata</td>
											<td>Jakarta</td>
											<td>Solo</td>
											<td>Super Executive</td>
											<td class="text-center">13A</td>
											<td class="text-center"><a href=""><b>Print</b></a></td>
										  </tr>
										  <tr>
											<td>RIS010820AD</td>
											<td>Christina Winata</td>
											<td>Jakarta</td>
											<td>Solo</td>
											<td>Super Executive</td>
											<td class="text-center">14A</td>
											<td class="text-center"><a href=""><b>Print</b></a></td>
										  </tr>
										  <tr>
											<td>RIS010820AD</td>
											<td>Christina Winata</td>
											<td>Jakarta</td>
											<td>Solo</td>
											<td>Super Executive</td>
											<td class="text-center">15A</td>
											<td class="text-center"><a href=""><b>Print</b></a></td>
										  </tr>
										</tbody>
									</table>
								</div>
							</div>
						</div-->
						
						<div class="alert alert-success">
						  Info Promo
						</div>

						<div class="table-responsive">
						  <table class="table table-bordered table-striped">
							<thead>
							  <tr class="danger">
								<th class="text-center">Nama Rute</th>
								<th class="text-center">Diskon</th>
							  </tr>
							</thead>
							<tbody class="text-center">
							  <tr>
								
								<td>Jakarta - Solo</td>
								
								<td>35%</td>
							  </tr>
							  <tr>
								
								<td>Jakarta - Solo</td>
								
								<td>10%</td>
							  </tr>
							  <tr>
								
								<td>Jakarta - Solo</td>
								
								<td>40%</td>
							  </tr>
							</tbody>
						  </table>	
						</div>

					</div><!-- /.page-content -->
					
				</div>
			</div><!-- /.main-content -->

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- Modal -->
		<div class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Pay Veritrans</h4>
					</div>
					<div class="modal-body">
						<img src="assets/images/veritrans.jpg" class="center-block" alt="images" />
						<a type="button" class="btn btn-primary" data-dismiss="modal">Bayar</a>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					</div>
				</div>
			</div>
		</div>

<?php echo $this->load->view('templates/footer') ?>
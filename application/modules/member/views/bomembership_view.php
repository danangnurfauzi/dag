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
											<p>Status Member Anda Saat Ini</p>
										</div>
										<div class="icon">
											<i class="fa fa-user"></i>
										</div>
										<span class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></span>
									</div>
								</div><!-- ./col -->
							</div><!-- /.row -->
						</div><!-- /.page-header -->

						<div class="alert alert-success">
						  <strong>Terima Kasih!</strong> Telah menggunakan BO sebagai mitra perjalanan anda<br />
						  Berikut kami sampaikan ringkasan perjalanan anda :
						</div>

						<div class="table-responsive">
						  <table class="table table-bordered table-striped">
							<thead>
							  <tr class="danger">
								<th class="text-center">Tanggal Transaksi</th>
								<th class="text-center">Nama Rute</th>
								<th class="text-center">Waktu Berangkat</th>
								<th class="text-center">Harga Tiket</th>
								<th class="text-center">Point</th>
							  </tr>
							</thead>
							<tbody class="text-center">
							  <tr>
								<td>01/11/2016</td>
								<td>Jakarta - Solo</td>
								<td>10:00 WIB</td>
								<td>Rp.100.000</td>
								<td>1000 pts</td>
							  </tr>
							  <tr>
								<td>01/11/2016</td>
								<td>Jakarta - Solo</td>
								<td>10:00 WIB</td>
								<td>Rp.100.000</td>
								<td>1000 pts</td>
							  </tr>
							  <tr>
								<td>01/11/2016</td>
								<td>Jakarta - Solo</td>
								<td>10:00 WIB</td>
								<td>Rp.100.000</td>
								<td>1000 pts</td>
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
		
<?php echo $this->load->view('templates/footer') ?>
</body>
</html>
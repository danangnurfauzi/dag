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

					<div class="space-6"></div>	

						<?php if(isset($errors)){ ?>
						     <div class="alert alert-danger"> <!--bootstrap error div-->
						          <?php echo validation_errors(); ?>
						     </div>
						<?php } ?>			

						<div class="panel panel-danger">
							<div class="panel-heading"><strong>Edit Data Barang</strong></div>
							<div class="panel-body">
								<form class="form-horizontal" id="dataForm" action="<?php echo site_url('member/stockManagement/editStock') ?>" method="post" >
									<div class="form-group">
										<label class="control-label col-sm-2">Nama Barang :</label>
										<div class="col-sm-4"><input type="hidden" name="StockID" value="<?php echo $data->StockID ?>">
										  <input type="text" class="form-control" id="nama_barang" placeholder="" name="NamaBarang" value="<?php echo $data->NamaStock ?>">
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2">Stock Tersedia :</label>
										<div class="col-sm-2">
										  <input type="text" class="form-control" placeholder="" name="StockTersedia" value="<?php echo $data->Jumlah ?>">
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2">Set Point :</label>
										<div class="col-sm-2">
										  <input type="text" class="form-control" placeholder="" name="SetPoint" value="<?php echo $data->PointReward ?>">
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2">Status :</label>
										<div class="col-sm-6">
											<div class="col-sm-1">
												<div class="checkbox">
													<label><input type="radio" value="1" name="Status" <?php echo ($data->Aktif == '1') ? 'checked' : ''  ?>> Aktif</label>
										  		</div>
											</div>
											<div class="col-sm-2">
												<div class="checkbox">
													<label><input type="radio" value="0" name="Status" <?php echo ($data->Aktif == '0') ? 'checked' : ''  ?>> Non-Aktif</label>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group pull-right">
										<a href="<?php echo site_url('membership/stockManagement/dashboard') ?>" class="btn btn-default">Batal</a>
										<input type="submit" name="Edit" value="Edit" class="btn btn-default">
									</div>
								</form>
							</div>
						</div>

					</div><!-- /.page-content -->
					
				</div>
			</div><!-- /.main-content -->

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		

<?php echo $this->load->view('templates/footer') ?>
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
											<h3>Membership</h3>
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
											<h3>Member Point</h3>
											<p><?php echo $point ?> Point</p>
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

						<h3>Detail Barang Yang Akan Anda Redeem : </h3>
						<form id="rechargeForm" class="form-horizontal" method="post" action="<?php echo site_url('member/bomembership/redeemPointMember31') ?>"> 
							<div class="row row-centered">
								<div class="col-xs-12 col-centered">
								  <div class="table-responsive">
								    <table class="table table-bordered">
										<thead>
										  <tr>
											<th class="text-center bg-danger">Nama Barang</th>
											<th class="text-center bg-danger">Point</th>
											<th class="text-center bg-danger">Jumlah</th>
										  </tr>
										</thead>
										<tbody class="text-center">
											<?php $i=0; $result = 0; foreach($post as $r){ $result = $result + ($r['point'] * $r['jumlah']); ?>
											<tr>
												<td><?php echo $r['nama'] ?></td><input type="hidden" name="nama[]" value="<?php echo $r['nama'] ?>" /><input type="hidden" name="stockId[]" value="<?php echo $r['barang'] ?>">
												<td><?php echo $r['point'] ?></td><input type="hidden" name="PointReward[]" value="<?php echo $r['point'] ?>">
												<td><?php echo $r['jumlah'] ?></td><input type="hidden" name="jumlah[]" value="<?php echo $r['jumlah'] ?>">
											</tr>
											<?php } ?>
										</tbody>
									</table>
								  </div>
								</div>
							</div><!-- /.row -->
						
							<div class="row row-centered">
								<div class="col-xs-12 col-centered">
								  <div class="form-group">
									<label class="control-label col-sm-3" for="reedem">Total Reedem Point :</label>
									<div class="col-sm-4 pull-right">
									  <input type="text" class="form-control" id="reedem" name="totalPointRedeem" value="<?php echo $result ?>" readonly="readonly">
									</div>
								  </div>
								</div>
							</div>
					  		
					  		<div class="space-6"></div>
					  		
					  		<?php if(isset($errors)){ ?>
							     <div class="alert alert-danger"> <!--bootstrap error div-->
							          <?php echo validation_errors(); ?>
							     </div>
							<?php } ?>
							<?php $setVal = set_value('kirimKe'); ?>
					  		<div class="row row-centered">
								<div class="col-xs-12 col-centered">
									<div class="panel panel-danger">
									  <div class="panel-heading"><strong>Alamat Pengiriman</strong></div>
									  <div class="panel-body">
										 <!--form class="form-horizontal"-->
										  <div class="form-group">
										  	<label class="control-label col-sm-2" for="">Pilih :</label>
										  	<div class="col-sm-5">
										  		<select class="form-control" id="kirimKe" name="kirimKe" placeholder="Pilih Alamat Pengirian">
										  			<option value="0" <?php echo (set_value('kirimKe') == '0') ? "selected='selected'":"" ?>>Pilih</option>
										  			<option value="1" <?php echo (set_value('kirimKe') == '1') ? "selected='selected'":"" ?>>Agen Terdekat</option>
										  			<option value="2" <?php echo (set_value('kirimKe') == '2') ? "selected='selected'":"" ?>>Alamat Rumah</option>
										  		</select>
										  	</div>
										  </div>
										  <input type="hidden" name="pilihPengiriman">
										  <div id="agenTerdekat" style="display:none;">
											  <div class="form-group">
												<label class="control-label col-sm-2" for="">Di ambil di Agen :</label>
												<div class="col-sm-5">
												  <select class="form-control" id="kotaAgen" name="kotaAgen">
													<option value="0">Pilih Kota</option>
													<?php foreach($kotaAgen as $ka){ ?>
													<option value="<?php echo $ka->KotaID ?>"><?php echo $ka->NamaKota ?></option>
													<?php } ?>
												  </select>
												</div>
												<div class="col-sm-5">
												  <select class="form-control" id="agen" name="agen" placeholder="Pilih Agen">
													
												  </select>
												</div>
											  </div>
										  </div>
										  <div id="alamatRumah" style="display:none;">
											  <div class="form-group">
												<label class="control-label col-sm-3"><strong>Atau dikirim ke alamat berikut :</strong></label>
											  </div>
											  <div class="form-group">
												<label class="control-label col-sm-2" for="alamat">Alamat :</label>
												<div class="col-sm-3">
												  <input type="text" class="form-control" id="alamat" name="alamat" placeholder="">
												</div>
												<label class="control-label col-sm-1" for="rt"></label>
												<div class="col-sm-1">
												  <input type="text" class="form-control" id="rt" name="rt" placeholder="RT">
												</div>
												<div class="col-sm-1">
												  <input type="text" class="form-control" id="rw" name="rw" placeholder="RW">
												</div>
												<div class="col-sm-2">
												  <input type="text" class="form-control" id="kdpos" name="kdpos" placeholder="Kode Pos">
												</div>
											  </div>
											  <div class="form-group">
												<label class="control-label col-sm-2" for="kecamatan">Kecamatan :</label>
												<div class="col-sm-3">
												  <input type="text" class="form-control" name="kecamatan" id="kecamatan" placeholder="">
												</div>
												<label class="control-label col-sm-2" for="kelurahan">Kelurahan :</label>
												<div class="col-sm-3">
												  <input type="text" class="form-control" name="kelurahan" id="kelurahan" placeholder="">
												</div>
											  </div>
											  <div class="form-group">
												<label class="control-label col-sm-2" for="kecamatan">Kabupaten :</label>
												<div class="col-sm-3">
												  <input type="text" class="form-control" name="kabupaten" id="kabupaten" placeholder="">
												</div>
												<label class="control-label col-sm-2" for="kelurahan">Provinsi :</label>
												<div class="col-sm-3">
												  <input type="text" class="form-control" name="provinsi" id="propinsi" placeholder="">
												</div>
											  </div>
										  </div>
										<!--/form-->
									  </div>
									</div>
								</div>
							</div>


					 		<div class="form-group pull-right">
								
								<a href="<?php echo site_url('member/bomembership/tukarPoint') ?>" class="btn btn-blue">Batal</a>
								<input type="submit" name="submit" value="Lanjutkan" class="btn btn-default">
								
							</div>
						
						</form>
						</div><!-- /.row -->
					</div><!-- /.page-content -->
					
				</div>
			</div><!-- /.main-content -->

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

<?php echo $this->load->view('templates/footer') ?>

<script type="text/javascript">

	var pathArray   =   window.location.pathname.split( '/' );
    var segment_1   =   pathArray[1];
    var webroot     =   (window.location.protocol + "//" + window.location.host + "/" + segment_1 + "/");

	$(document).ready(function(){

		var kirke = '<?php echo $setVal ?>';

		if (kirke == 1)
		{
			$("#agenTerdekat").show();
			$("#alamatRumah").hide();
		}else if(kirke == 2)
		{
			$("#agenTerdekat").hide();
			$("#alamatRumah").show();
		}

		$("#kirimKe").change(function(){
			var pilihan = $("#kirimKe").val();
			if(pilihan == 1)
			{
				$("#agenTerdekat").show();
				$("#alamatRumah").hide();
			}else if(pilihan == 2){
				$("#agenTerdekat").hide();
				$("#alamatRumah").show();
			}
			else{
				$("#agenTerdekat").hide();
				$("#alamatRumah").hide();
			}
		});

		$("#kotaAgen").change(function(){
			
			var kotaAgenID = $("#kotaAgen").val();
			//alert(kotaAgenID);

			$.ajax({
		            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
		            url         : webroot+'index.php/member/bomembership/listAgenByKota', // the url where we want to POST
		            data        : {kotaID: kotaAgenID}, // our data object
		            //dataType: 'json',
		            success		: function(data){
		            					//alert(data);return false;
		            					$("#agen").html(data);
		            				}

		    });

		});

	})
</script>

</body>
</html>
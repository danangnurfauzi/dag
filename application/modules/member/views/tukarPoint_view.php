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
										<span class="small-box-footer" style="cursor:pointer;"><i class="fa fa-arrow-circle-right"></i> <a href="">Upgrade</a></span>
									</div>
								</div><!-- ./col -->
							</div><!-- /.row -->
						</div><!-- /.page-header -->

					<div class="space-6"></div>
					
						<div id="gradeUp" class="row row-centered" style="display:none;">
							<div class="col-xs-8 col-centered">
								<div class="box box-danger">
									<div class="box-header">
										<div class="form-group text-center">
											<dt><h3>Konfirmasi Upgrade Member Status</h3></dt>
											<dd><h4>Upgrade membutuhkan 1000 point anda, lanjutkan?</h4></dd>
										</div>
											<div class="form-group">
												<div class="col-sm-6 text-left">
													<a href="#" class="btn btn-danger btn-block" role="button"> <b>TIDAK</b></a>
												</div>
												<div class="col-sm-6 text-right">
													<a href="#" class="btn btn-danger btn-block" role="button"> <b>YA</b></a>
												</div>
											</div>
										</div>
									</div>
								</div>								
						</div><!-- /.row -->

						<div class="row">
							<div class="col-xs-12">
								<div class="box box-info">
									<div class="box-header">
										<form class="form-horizontal">
											<div class="form-inline">
												<label for="email"><b>Total Point Tersedia :</b></label>
												<input type="text" class="form-control" id="total" placeholder="<?php echo $point ?>" disabled>
											</div>
										<div class="space-18"></div>
											<!--div class="form-inline">
												<label for=""><b>Jumlah Point yang akan digunakan :</b></label>
												<input type="text" class="form-control" id="point" >
											</div-->
										<div class="space-18"></div>
											<div class="form-inline">
												<div class="col-sm-12">
													<?php foreach($reward as $r){ ?>
													<div class="col-sm-3">
														<div class="checkbox">
															<i><input name="barang[]" type="checkbox" id="barang" value="<?php echo $r->StockID ?>" rel=<?php echo $r->PointReward ?>></i> <img src="<?php echo base_url() ?>assets/images/payung.jpg" width="80px"/>
															<p><?php echo $r->NamaStock.' '.$r->PointReward ?> points</p>
														  <select class="form-control" id="jumlahReward_<?php echo $r->StockID ?>" name="jumlahReward[]">
															<?php if( $r->Jumlah == 0 ){ ?>
																<option>Stock Habis</option>
															<?php }else{ ?>

																<?php for( $i=1 ; $i <= $r->Jumlah ; $i++){ ?>
																<option value="<?php echo $i ?>"><?php echo $i ?></option>
																<?php } ?>

															<?php } ?>
															
														  </select>
														</div>
													</div>
													<?php } ?>
												</div>
											</div>
										
									</div>
								</div>
										<div class="space-18"></div>
											<input type="submit" class="btn btn-success right" style="float:right;" id="redeem" name="redeem" value="Gunakan Point">
							</div>
						</div>
						</form>

						<h3>Gunakan Terus Membership Anda !</h3>
						<div class="row row-centered">
							<div class="col-xs-12 col-centered">
									  <div class="table-responsive">
									    <table class="table table-bordered">
											<thead>
											  <tr>
												<th class="text-center bg-danger">Item</th>
												<th class="text-center bg-danger">Keterangan</th>
												<th class="text-center bg-danger">Point Dibutuhkan</th>
												<th class="text-center bg-danger">Order</th>
												<th class="text-center bg-danger">Detail Item</th>
											  </tr>
											</thead>
											<tbody class="text-center">
											  <tr>
												<td>1</td>
												<td>Payung</td>
												<td>1000 pt</td>
												<td><input id="spinner" name="value"></td>
												<td><a href="" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal">Lihat Gambar</a></td>
											  </tr>
											  <tr>
												<td>1</td>
												<td>Payung</td>
												<td>1000 pt</td>
												<td><input id="spinner1" name="value"></td>
												<td><a href="" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal">Lihat Gambar</a></td>
											  </tr>
											  <tr>
												<td>1</td>
												<td>Payung</td>
												<td>1000 pt</td>
												<td><input id="spinner2" name="value"></td>
												<td><a href="" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal">Lihat Gambar</a></td>
											  </tr>
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
								  <input type="text" class="form-control" id="reedem" placeholder="">
								</div>
							  </div>
							</div>
						</div>
					  <div class="space-6"></div>
					  
						<div class="row row-centered">
							<div class="col-xs-12 col-centered">
								<div class="panel panel-danger">
								  <div class="panel-heading"><strong>Alamat Pengiriman</strong></div>
								  <div class="panel-body">
									 <form class="form-horizontal">
									  <div class="form-group">
										<label class="control-label col-sm-2" for="">Di ambil di Agen :</label>
										<div class="col-sm-5">
										  <select class="form-control" id="sel1">
											<option>Pilih Kota</option>
											<option>Jakarta</option>
											<option>Solo</option>
											<option>Bandung</option>
											<option>Surabaya</option>
											<option>Semarang</option>
										  </select>
										</div>
										<div class="col-sm-5">
										  <select class="form-control" id="sel1">
											<option>Pilih Agen</option>
											<option>Jakarta</option>
											<option>Solo</option>
											<option>Bandung</option>
											<option>Surabaya</option>
											<option>Semarang</option>
										  </select>
										</div>
									  </div>
									  <div class="form-group">
										<label class="control-label col-sm-3"><strong>Atau dikirim ke alamat berikut :</strong></label>
									  </div>
									  <div class="form-group">
										<label class="control-label col-sm-2" for="alamat">Alamat :</label>
										<div class="col-sm-3">
										  <input type="text" class="form-control" id="alamat" placeholder="">
										</div>
										<label class="control-label col-sm-1" for="rt"></label>
										<div class="col-sm-1">
										  <input type="text" class="form-control" id="rt" placeholder="RT">
										</div>
										<div class="col-sm-1">
										  <input type="text" class="form-control" id="rw" placeholder="RW">
										</div>
										<div class="col-sm-2">
										  <input type="text" class="form-control" id="kdpos" placeholder="Kode Pos">
										</div>
									  </div>
									  <div class="form-group">
										<label class="control-label col-sm-2" for="kecamatan">Kecamatan :</label>
										<div class="col-sm-3">
										  <input type="text" class="form-control" id="kecamatan" placeholder="">
										</div>
										<label class="control-label col-sm-2" for="kelurahan">Kelurahan :</label>
										<div class="col-sm-3">
										  <input type="text" class="form-control" id="kelurahan" placeholder="">
										</div>
									  </div>
									</form>
								  </div>
								</div>
									  <div class="form-group pull-right">
										<div class="col-sm-offset-6 col-sm-10">
										  <a href="" class="btn btn-danger">Cancel</a>
										  <a href="" class="btn btn-danger" data-toggle="modal" data-target="#myModal1">Simpan dan Lanjutkan</a>
										</div>
									  </div>
							</div>
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
						<img src="<?php echo base_url() ?>assets/images/veritrans.jpg" class="center-block" alt="images" />
						<a type="button" class="btn btn-primary" data-dismiss="modal">Bayar</a>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					</div>
				</div>
			</div>
		</div>

<?php echo $this->load->view('templates/footer') ?>

<script type="text/javascript">

	var pathArray   =   window.location.pathname.split( '/' );
    var segment_1   =   pathArray[1];
    var webroot     =   (window.location.protocol + "//" + window.location.host + "/" + segment_1 + "/");

	$(document).ready(function(){
		function jumlah()
		{
			var point = 0;
			$("input[type=checkbox]:checked").each(function(){
				var ID = $(this).val();
				var jumlahBarang = $("#jumlahReward_"+ID).val();
				var barangnya = parseInt($(this).attr("rel"));
				point = point+barangnya*jumlahBarang;
			});
			
			return parseInt(point);
		} 

		var memberPoint = '<?php echo $point ?>';

		$('form').submit(function( event ){
			//alert( parseInt(memberPoint) +" "+ jumlah());
			if (parseInt(memberPoint) < jumlah())
			{
				alert("Maaf Point Anda Tidak Mencukupi");
			}else{
				var r = confirm("Apakah Anda Yakin Untuk Menukar "+ jumlah() +" Point Anda?");
				//alert(r);
				if (r === true)
				{
					//$('form').submit(function(event) {
						//alert("hai");return false;
				
						formData = $('form').serialize();
				        // process the form
				        $.ajax({
				            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
				            url         : webroot+'index.php/member/bomembership/redeemPointMember', // the url where we want to POST
				            data        : formData, // our data object
				            //dataType: 'json',
				            success		: function(data){
				            					//alert(data);return false;
				            					if( data == 'success' )
				            					{
				            						alert("Data Berhasil Di Ubah");
				            						location.reload();
				            					}else{
				            						alert("Data Gagal Di Ubah");
				            						location.reload();
				            					}

				            					
				            				}


				        });

				        // stop the form from submitting the normal way and refreshing the page
				        event.preventDefault();
				    //});
				}
			}
		});
	})
</script>
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

						<h3>Gunakan Terus Membership Anda !</h3>
						<form id="rechargeForm" class="form-horizontal">
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
										<?php $i=0; foreach($reward as $r){ ?>
										<tr>
											<td><?php echo ++$i ?></td>
											<td><?php echo $r->NamaStock ?></td>
											<td id="points<?php echo $i ?>" data-koin<?php echo $i ?>="<?php echo $r->PointReward ?>"><?php echo $r->PointReward ?></td>
											<td>
												<input id="spinner<?php echo $i ?>" name="jumlahItem[]" readonly="readonly" class="tesi<?php echo $i ?>" />
												<input type="hidden" name="stockId[]" value="<?php echo $r->StockID ?>">
											</td>
											<td><a href="" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal">Lihat Gambar</a></td>
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
									 <!--form class="form-horizontal"-->
									  <div class="form-group">
									  	<label class="control-label col-sm-2" for="">Pilih :</label>
									  	<div class="col-sm-5">
									  		<select class="form-control" id="kirimKe" name="kirimKe">
									  			<option>Pilih</option>
									  			<option value="1">Agen Terdekat</option>
									  			<option value="2">Alamat Rumah</option>
									  		</select>
									  	</div>
									  </div>
									  <div id="agenTerdekat" style="display:none;">
										  <div class="form-group">
											<label class="control-label col-sm-2" for="">Di ambil di Agen :</label>
											<div class="col-sm-5">
											  <select class="form-control" id="kotaAgen" name="kotaAgen">
												<option>Pilih Kota</option>
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
									  </div>
									<!--/form-->
								  </div>
								</div>
									  <div class="form-group pull-right">
										<div class="col-sm-offset-6 col-sm-10">
										  <!--a href="" class="btn btn-danger">Cancel</a-->
										  <a href="" class="btn btn-danger" data-confirm="telo" data-toggle="modal" data-target="#myModal1" id="modalBtn">Simpan dan Lanjutkan</a>
											<!--input type="submit" name="submit" value="Simpan dan Lanjutkan" id="sbm" class="btn btn-danger"-->
										</div>
									  </div>
							</div>
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

		<!-- Modal -->
		<div class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog modal-md" style="top:25%;">
				<div class="modal-content">
					<div class="modal-body">
						<div id="myCarousel" class="carousel slide">
						  <!-- Wrapper for slides -->
						  <div class="carousel-inner">
							<div class="item active">
							  <img src="<?php echo base_url() ?>assets/images/payung.jpg" class="center-block" alt="payung">
							</div>

							<div class="item">
							  <img src="<?php echo base_url() ?>assets/images/payung.jpg" class="center-block" alt="payung">
							</div>

							<div class="item">
							  <img src="<?php echo base_url() ?>assets/images/payung.jpg" class="center-block" alt="payung">
							</div>

							<div class="item">
							  <img src="<?php echo base_url() ?>assets/images/payung.jpg" class="center-block" alt="payung">
							</div>
						  </div>

						  <!-- Left and right controls -->
						  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						  </a>
						  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						  </a>
						</div>
					</div>
					<div class="modal-footer">
						<a type="button" class="btn btn-danger" data-dismiss="modal">Close</a>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="myModal1" role="dialog">
			<div class="modal-dialog modal-sm" style="top:30%;">
				<div class="modal-content">
					<div class="modal-header">
						Form Konfirmasi
					</div>

					<div class="modal-body">
						<p id="lineRedeemPoint"></p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
						<button type="button" class="btn btn-blue" id="konfirmasip" data-dismiss="modal">Submit</button>
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

		$("#kirimKe").change(function(){
			var pilihan = $("#kirimKe").val();
			if(pilihan == 1)
			{
				$("#agenTerdekat").show();
				$("#alamatRumah").hide();
			}else{
				$("#agenTerdekat").hide();
				$("#alamatRumah").show();
			}
		});

		var batasRewardActive = '<?php echo $JumlahReward; ?>';
		var memberPoints = '<?php echo $point; ?>'

		function totalPoint()
		{
			var hasil = 0; //alert($(".tesi1").val());
			for (var k = 1; k <= batasRewardActive; k++) {
				var qty = $(".tesi"+k).val();
				var poin = $("#points"+k).data("koin"+k);
				var result = qty * poin;
				hasil = hasil + result;
				//alert(qty);
			}
			
			$("#reedem").val(hasil);

			return hasil;
		}	

		<?php $j=0; foreach($reward as $rw){ ?>
		$("#spinner<?php echo ++$j ?>").spinner({min:0,max:<?php echo $rw->Jumlah ?>,step:1,stop:function(e,i){
			if(totalPoint() > memberPoints)
			{
				alert("Maaf Point Anda Tidak Mencukupi");
				var isi = $("#spinner<?php echo $j ?>").val();
				var anyar = isi - 1;
				$("#spinner<?php echo $j ?>").val(anyar);
				totalPoint();
			}else{
				totalPoint();
			}
		}});
		<?php } ?>

		$("#modalBtn").click(function(){
			var redem = $("#reedem").val();
			$("#lineRedeemPoint").text("Point Yang Akan Anda Gunakan Adalah "+redem+" point");
		});

		$("#konfirmasip").click(function(){ //alert("hai");

			//$('form').submit(function( e ){
				dataForm = $('form').serialize();

				$.ajax({
		            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
		            url         : webroot+'index.php/member/bomembership/redeemPointMember2', // the url where we want to POST
		            data        : dataForm, // our data object
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
				//alert(dataForm);return false;
			//});

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

</body>
</html>
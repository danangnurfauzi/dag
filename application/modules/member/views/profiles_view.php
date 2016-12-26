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
							<li><a href="#">More Pages</a></li>
							<li class="active">User Profile</li>
						</ul><!-- /.breadcrumb -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						<!-- /section:settings.box -->

							<?php if(isset($errors)){ ?>
							     <div class="alert alert-danger"> <!--bootstrap error div-->
							          <?php echo validation_errors(); ?>
							     </div>
							<?php } ?>

							<?php $err = $this->session->flashdata('error'); if(isset($err)):?>
								<div class="alert alert-danger"> <!--bootstrap error div-->
							    	<?=$this->session->flashdata('error')?>
							    </div>
							<?php endif ?>

							<?php $suc = $this->session->flashdata('success'); if(isset($suc)):?>
								<div class="alert alert-success"> <!--bootstrap error div-->
							    	<?=$this->session->flashdata('success')?>
							    </div>
							<?php endif ?>

							  <div class="panel panel-danger">
								<div class="panel-heading"><strong>My Profil</strong></div>
								<div class="panel-body">
									<form class="form-horizontal" id="dataForm" action="<?php echo site_url('member/profiles/updateProfileMember') ?>" method="post" >
										<input type="hidden" name="memberID" value="<?php echo $memberID ?>">
									  <div class="form-group">
										<label class="control-label col-sm-2" for="jns_kelamin">Pilih Salah Satu :</label>
										<div class="col-sm-1">
										  <div class="checkbox">
											<label><input type="radio" value="1" name="JenisKelamin" <?php echo ($memberData->JenisKelamin == '1') ? 'checked' : ''  ?>> Pria</label>
										  </div>
										</div>
										<div class="col-sm-2">
										  <div class="checkbox">
											<label><input type="radio" value="2" name="JenisKelamin" <?php echo ($memberData->JenisKelamin == '2') ? 'checked' : ''  ?>> Wanita</label>
										  </div>
										</div>
									  </div>
									  <div class="form-group required">
										<label class="control-label col-sm-2" for="nama_depan">Nama Depan :</label>
										<div class="col-sm-4">
										  <input type="text" class="form-control" id="nama_depan" placeholder="" name="NamaDepan" value="<?php echo $memberData->NamaDepan ?>">
										</div>
										<label class="control-label col-sm-2" for="nama_belakang">Nama Belakang :</label>
										<div class="col-sm-4">
										  <input type="text" class="form-control" id="nama_belakang" placeholder="" name="NamaBelakang" value="<?php echo $memberData->NamaBelakang ?>">
										</div>
									  </div>
									  <div class="form-group required">
										<label class="control-label col-sm-2" for="alamat">Alamat Lengkap :</label>
										<div class="col-sm-10">
										  <input type="text" class="form-control" id="alamat" placeholder="" name="AlamatLengkap" value="<?php echo $memberData->AlamatLengkap ?>">
										</div>
									  </div>
									  <div class="form-group">
										<label class="control-label col-sm-2" for="alamat">Kelurahan :</label>
										<div class="col-sm-3">
										  <input type="text" class="form-control" id="alamat" placeholder="" name="Kelurahan" value="<?php echo $memberData->Kelurahan ?>">
										</div>
										<label class="control-label col-sm-1" for="alamat">RT :</label>
										<div class="col-sm-1">
										  <input type="text" class="form-control" id="rt" placeholder="" name="RT" value="<?php echo $memberData->RT ?>">
										</div>
										<label class="control-label col-sm-1" for="alamat">RW :</label>
										<div class="col-sm-1">
										  <input type="text" class="form-control" id="rw" placeholder="" name="RW" value="<?php echo $memberData->RW ?>">
										</div>
										<label class="control-label col-sm-2" for="alamat">Kode Pos :</label>
										<div class="col-sm-1">
										  <input type="text" class="form-control" id="kodePos" placeholder="" name="KodePos" value="<?php echo $memberData->KodePos ?>">
										</div>
									  </div>
									  <div class="form-group">
										<label class="control-label col-sm-2" for="alamat">Kecamatan :</label>
										<div class="col-sm-4">
										  <input type="text" class="form-control" id="alamat" placeholder="" name="Kecamatan" value="<?php echo $memberData->Kecamatan ?>">
										</div>
										<label class="control-label col-sm-2" for="alamat">Kabupaten :</label>
										<div class="col-sm-4">
										  <input type="text" class="form-control" id="alamat" placeholder="" name="Kabupaten" value="<?php echo $memberData->Kabupaten ?>">
										</div>
									  </div>
									  <div class="form-group">
									  <div class="required">
										<label class="control-label col-sm-2" for="jns_kelamin">No ID :</label>
										<div class="col-sm-1">
										  <div class="radio">
											<label><input type="radio" name="TipeID" value="1" <?php echo ($memberData->TipeID == '1') ? 'checked' : '' ?>> KTP</label>
										  </div>
										</div>
										<div class="col-sm-1">
										  <div class="radio">
											<label><input type="radio" name="TipeID" value="2" <?php echo ( $memberData->TipeID == '2') ? 'checked' : '' ?>> SIM</label>
										  </div>
										</div>
										<div class="col-sm-2">
										  <input type="text" class="form-control" id="noId" placeholder="" name="NoID" value="<?php echo $memberData->NoID ?>">
										</div>
									  </div>
										<label class="control-label col-sm-1" for="jns_kelamin">No Telp :</label>
										<div class="col-sm-2">
										  <input type="text" class="form-control" id="nama_depan" placeholder="" name="NoTelp" value="<?php echo $memberData->NoTelp ?>">
										</div>
									<div class="required">
										<label class="control-label col-sm-1 required" for="jns_kelamin">No HP:</label>
										<div class="col-sm-2">
										  <input type="text" class="form-control" id="noHp" placeholder="" name="NoHandphone" value="<?php echo $memberData->NoHandphone ?>">
										</div>
									</div>
									  </div>
									  <div class="form-group">
										<label class="control-label col-sm-2" for="alamat">Tempat :</label>
										<div class="col-sm-4">
										  <input type="text" class="form-control" id="alamat" placeholder="" name="TempatLahir" value="<?php echo $memberData->TempatLahir ?>">
										</div>
										<div class="required">
										<label class="control-label col-sm-2" for="tanggalLahir">Tanggal Lahir :</label>
										<?php 
											$date = strtotime( $memberData->TanggalLahir ); 
											$show = date("Y-m-d",$date);
											$tanggal = explode("-", $show);
											$tanggalFix = $tanggal[2].'-'.$tanggal[1].'-'.$tanggal[0]
										?>
										<div class="col-sm-4">
											<div class="input-group input-group-sm">
											  <input type="text" class="form-control date-picker" name="TanggalLahir" value="<?php echo $tanggalFix ?>" />
											  <span class="input-group-addon">
												<i class="ace-icon fa fa-calendar"></i>
											  </span>
											</div>
										</div>
										</div>
									  </div>
									  <div class="form-group required">
										<label class="control-label col-sm-2" for="email">Email :</label>
										<div class="col-sm-4">
										  <input type="email" class="form-control" id="email" placeholder="" name="AlamatEmail" value="<?php echo $memberData->AlamatEmail ?>">
										</div>
										<div class="col-sm-6">
										  <div class="checkbox">
											<label><input type="checkbox" name="promo" value="1" <?php echo ($memberData->IsPromo == 1) ? "checked" : "" ?>> Kirimkan Promosi BO Melalui Email</label>
										  </div>
										</div>
									  </div>
									  <!--div class="form-group">
										<label class="control-label col-sm-2" for="pwd">Password :</label>
										<div class="col-sm-4">
										  <input type="password" class="form-control" id="pwd" placeholder="">
										</div>
									  </div-->
									  <div class="form-group pull-right">
										  <!--a type="submit" class="btn btn-default">Cancel</a-->
										  <input type="submit" name="perbaharui" value="Perbaharui" class="btn btn-default">
									  </div>
									</form>
								</div>
							  </div>
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

<?php echo $this->load->view('templates/footer') ?>

<script type="text/javascript">
	
	var pathArray   =   window.location.pathname.split( '/' );
    var segment_1   =   pathArray[1];
    var webroot     =   (window.location.protocol + "//" + window.location.host + "/" + segment_1 + "/");

    //alert(webroot);

    /**
	$('#noHp , #rt , #rw , #kodePos , #noId').keypress(function(event){
            //console.log(event.which);
            //alert(event.which);
        if( (event.which != 8 && isNaN(String.fromCharCode(event.which))) || (event.which === 32)){
            
            alert("maaf hanya diperkenankan untuk angka saja");
            event.preventDefault();
    }});

    $('#email').blur(function() {
	    var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
		if (testEmail.test(this.value) === false)
		    // Do whatever if it passes.
			alert("Maaf Penulisan Email Anda Salah")
	});

	$("#dp").datepicker({
		format: 'yyyy-mm-dd',
		autoclose: true
	});

	$('form').submit(function(event) {

        formData = $('form').serialize();

        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : webroot+'index.php/member/profiles/updateProfileMember', // the url where we want to POST
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
    });
    **/
</script>
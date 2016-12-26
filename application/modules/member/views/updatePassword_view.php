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
							  <a href="#">Dashboard</a>
							</li>
							<li><a href="#">Membership</a></li>
							<li class="active">Update Password</li>
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
								<div class="panel-heading"><strong>Update Password</strong></div>
								<div class="panel-body">
									<form class="form-horizontal" method="post" action="<?php echo site_url('member/profiles/updateAccountMember') ?>">
									  <div class="form-group required">
										<label class="control-label col-sm-3" for="user_name">Username :</label>
										<div class="col-sm-4">
										  <input type="text" class="form-control" id="user_name" placeholder="" name="username" value="<?php echo $memberAccount->Username; ?>">
										</div>
									  </div>
									  <div class="form-group required">
										<label class="control-label col-sm-3" for="exs_password">Password Lama :</label>
										<div class="col-sm-4">
										  <input type="password" class="form-control" id="exs_password" placeholder="" name="passwordLama">
										</div>
										<div class="col-sm-3">
											<img src="<?php echo base_url() ?>assets/images/icon-checklist.png" height="48" id="checklist" style="display: none;">
										</div>
									  </div>
									  <div class="form-group required">
										<label class="control-label col-sm-3" for="new_pass">Masukan Password Baru :</label>
										<div class="col-sm-4">
										  <input type="password" class="form-control" id="new_pass" placeholder="" name="passwordBaru">
										</div>
									  </div>
									  <div class="form-group required">
										<label class="control-label col-sm-3" for="confirm_pass">Konfirmasi Password Baru :</label>
										<div class="col-sm-4">
										  <input type="password" class="form-control" id="confirm_pass" placeholder="" name="passwordBaruReType">
										</div>
									  </div>
									
									  <div class="form-group pull-right">
										  <!--a type="submit" class="btn btn-default">Cancel</a-->
										  <input type="submit" class="btn btn-default" value="Perbaharui" name="perbaharui">
									  </div>
								</div>
							  </div>
							</div><!-- /.col -->
						</form>
				</div>
			</div><!-- /.main-content -->

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

<?php echo $this->load->view('templates/footer') ?>

<script type="text/javascript">
	
	var pathArray   =   window.location.pathname.split( '/' );
    var segment_1   =   pathArray[1];
    var webroot     =   (window.location.protocol + "//" + window.location.host + "/" + segment_1 + "/");

    /**
    $("#exs_password").blur(function(){
    	var pass = this.value;
    	$.ajax({
    		type: 'post',
    		url: webroot+'index.php/member/profiles/enkripPasswordAccountMember',
    		data: { password: pass},
    		success: function(data){
    			//alert(data);return false;
    			if (data == 'true') {
    				$("#checklist").show();
    			}else{
    				$("#checklist").hide();
    				alert("Password Lama Anda Tidak Sesuai");
    				//$("#exs_password").val('');
    				//$("#exs_password").focus();
    				location.reload();
    			}
    		}
    	});
    });
    
	$('form').submit(function(event) {
		//alert("hai");return false;
		var newPass = $("#new_pass").val();
		var confirmPass = $("#confirm_pass").val();

		if (newPass == confirmPass)
		{
			formData = $('form').serialize();

	        // process the form
	        $.ajax({
	            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
	            url         : webroot+'index.php/member/profiles/updateAccountMember', // the url where we want to POST
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
		}else{
			alert("Maaf Password Baru Anda Belum Sesuai dengan Konfirmasi Password");return false;
		}

        
    });**/
</script>
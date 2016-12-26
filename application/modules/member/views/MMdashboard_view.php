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

						<div class="table-responsive">
						  <table class="table table-bordered table-striped">
							<thead>
							  <tr class="danger">
								<th class="text-center">Nama Depan</th>
								<th class="text-center">Nama Belakang</th>
								<th class="text-center">No. Member</th>
								<th class="text-center">Jenis Kelamin</th>
								<th class="text-center">Aksi</th>
							  </tr>
							</thead>
							<tbody class="text-center">
							  <?php foreach( $listMember as $row){ ?>
							  <tr>
							  	<td><?php echo $row->NamaDepan ?></td>
							  	<td><?php echo $row->NamaBelakang ?></td>
							  	<td><?php echo $row->MembershipNo ?></td>
							  	<td><?php echo ( $row->JenisKelamin == 1 ) ? 'Laki-Laki' : 'Wanita' ?></td>
							  	<td>
							  		<a href="<?php echo site_url() ?>"><i class="menu-icon fa fa-edit"></i></a>
							  		<a href="<?php echo site_url() ?>" class="confirmation"><i class="menu-icon fa fa-remove"></i></a>
							  	</td>
							  </tr>
							  <?php } ?>
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

		<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		    <div class="modal-dialog">
		        <div class="modal-content">
		            <div class="modal-header">
		                Konfirmasi Hapus Permanent
		            </div>
		            <div class="modal-body">
		                Yakin Akan Di Hapus
		                <p class="debug-url"></p>
		            </div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		                <a class="btn btn-danger btn-ok">Hapus</a>
		            </div>
		        </div>
		    </div>
		</div>
		

<?php echo $this->load->view('templates/footer') ?>

</body>
</html>

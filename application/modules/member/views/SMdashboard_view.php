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

						<div class="panel panel-danger">
							<div class="panel-heading"><strong>Tambah Barang</strong></div>
							<div class="panel-body">
								<form class="form-horizontal" id="dataForm" action="<?php echo site_url('member/stockManagement/dashboard') ?>" method="post" >
									<div class="form-group">
										<label class="control-label col-sm-2">Nama Barang :</label>
										<div class="col-sm-4">
										  <input type="text" class="form-control" id="nama_barang" placeholder="" name="NamaBarang">
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2">Stock Tersedia :</label>
										<div class="col-sm-2">
										  <input type="text" class="form-control" placeholder="" name="StockTersedia">
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2">Set Point :</label>
										<div class="col-sm-2">
										  <input type="text" class="form-control" placeholder="" name="SetPoint">
										</div>
									</div>
									<div class="form-group pull-right">
										<input type="submit" name="Tambah" value="Tambah" class="btn btn-default">
									</div>
								</form>
							</div>
						</div>

						<div class="table-responsive">
						  <table class="table table-bordered table-striped">
							<thead>
							  <tr class="danger">
								<th class="text-center">Nama Barang</th>
								<th class="text-center">Jumlah Stock</th>
								<th class="text-center">Set Point</th>
								<th class="text-center">Status</th>
								<th class="text-center">Aksi</th>
							  </tr>
							</thead>
							<tbody class="text-center">
							  <?php foreach( $listStock as $row){ ?>
							  <tr>
							  	<td><?php echo $row->NamaStock ?></td>
							  	<td><?php echo $row->Jumlah ?></td>
							  	<td><?php echo $row->PointReward ?></td>
							  	<td><?php echo ( $row->Aktif === 1 ) ? 'aktif' : 'non-aktif' ?></td>
							  	<td><?php $StockIDEnkrip = base64_encode($row->StockID); ?>
							  		<a href="<?php echo site_url('member/stockManagement/editStock/'.$StockIDEnkrip) ?>"><i class="menu-icon fa fa-edit"></i></a>
							  		<a href="<?php echo site_url('member/stockManagement/deleteStock/'.$StockIDEnkrip) ?>" class="confirmation"><i class="menu-icon fa fa-remove"></i></a>
							  	</td>
							  </tr>
							  <?php } ?>
							</tbody>
						  </table>	
						</div>

						<?php echo $pagination ?>

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

<script src="<?php echo base_url() ?>components/bootstrap-confirm/confirm-bootstrap.js"></script>

<script type="text/javascript">
	$('.confirmation').on('click', function () {
        return confirm('Yakin Akan Di Hapus?');
    });
</script>

</body>
</html>

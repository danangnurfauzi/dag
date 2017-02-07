<?php
	//$bulan_gaji_text	=	(date('j') < 11)?getCurrentMonth(date('Y-m-d'), 'F'):getNextMonth(date("Y-m-d"), 'F');
	//$bulan_gaji_number	=	(date('j') < 11)?getCurrentMonth(date('Y-m-d'), 'm'):getNextMonth(date("Y-m-d"), 'm');
	$hide				=	' style="display:none; "';
	$bulan_gaji_dummy	=	(date('j') < 11)
							?
								(int)$dbulan
							:
								(
									((int)$dbulan > (int)date ('n'))
									?
										(int)$dbulan
									:
										((int)$dbulan + 1));
	
	$bulan_gaji_text	=	$month_id[$dbulan];
	$bulan_gaji_number	=	($dbulan < 10)?('0'.$dbulan):$dbulan;
	
	//echo (int)$dbulan . ' | ' . (int)date ('n') . ' | ' . $bulan_gaji_dummy . '<br />' . $bulan_gaji_number . ' | ' . $bulan_gaji_text; exit;
?>
<?php echo Modules::run($type_user . '/templates/amanda', 'header'); ?>
<?php echo Modules::run($type_user . '/templates/amanda', 'menu', 'top'); ?>
<?php echo Modules::run($type_user . '/templates/amanda', 'menu', 'left', 'gaji'); ?>
<style type="text/css">
#back-top {
	position: fixed;
	bottom: 30px;
	margin-left: -150px;
}
#back-top a {
	width: 108px;
	display: block;
	text-align: center;
	font: 11px/100% Arial, Helvetica, sans-serif;
	text-transform: uppercase;
	text-decoration: none;
	color: #bbb;
	/* background color transition */
	-webkit-transition: 1s;
	-moz-transition: 1s;
	transition: 1s;
}
#back-top a:hover {
	color: #000;
}
/* arrow icon (span tag) */
#back-top span {
	width: 108px;
	height: 108px;
	display: block;
	margin-bottom: 7px;
	background: #ddd url(<?= base_url() ?>assets/images/up-arrow.png) no-repeat center center;
	/* rounded corners */
	-webkit-border-radius: 15px;
	-moz-border-radius: 15px;
	border-radius: 15px;
	/* background color transition */
	-webkit-transition: 1s;
	-moz-transition: 1s;
	transition: 1s;
}
#back-top a:hover span {
	background-color: #777;
}
</style>
			<div class="centercontent">
				<div class="pageheader">
                    <h1 class="pagetitle"><?php echo $page_sub_title ?></h1>
                    <span class="pagedesc"><?php echo $page_sub_title_desc ?></span>
                </div><!--pageheader-->
			
                <div id="contentwrapper" class="contentwrapper">
					<script type="text/javascript" language="javascript">
						jQuery(function () {
							jQuery('#scrlBotm').click(function () {
								jQuery('html, body').animate( {
									scrollTop: jQuery(document).height()
								 },
								 1000);
								 return false;
						 	});						
						 	jQuery('#scrlTop').click(function () {
								jQuery('html, body').animate( {
									scrollTop: '0px'
								 },
								 500);
							 	return false;
						 	});
						});
					</script>
<?php
	$ra                     =   ' style="text-align:right; "';
	$rab                    =   ' style="text-align:right; font-weight:bold; "';
	$center_align 			=   ' style="text-align:center; "';
	$center_align_bold 		=   ' style="text-align:center; font-weight:bold; "';
	$selected				=   ' selected="selected"';
	$us_1					=   $this->uri->segment (1);
	$us_2					=   $this->uri->segment (2);
	$us_3					=   $this->uri->segment (3);
	$us_4					=   $this->uri->segment (4);
	$us_5					=   $this->uri->segment (5);
	$us_6					=   $this->uri->segment (6);
	$us_7					=   $this->uri->segment (7);
	$tahun					=   date ('Y');
	$bulan					=   date ('m');
	$link					=   $us_1 . '/' . $us_2 . '/' . $us_3 . '/' . $us_4;
	
	$arperwakilan			=	array(1=>'MENJABAT','MEWAKILI','DIWAKILI','MERANGKAP');
	
	if ($pengumuman !== '')
	{
?>
                    <div class="notibar announcement">
                        <a class="close"></a>
                        <h3>.: PENGUMUMAN :.</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor 
                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud 
                            exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
                    </div><!-- notification announcement -->
<?php
	}
?>
						
                    <div style="float: left; width: 25%; ">
                    	<table width="98%" cellpadding="5">
<?php
	//echo $dtahun;exit;
	foreach ($daftar_area->result_array () as $da)
	{
		//echo 'YES'; exit;
		$jumlah_rec_gaji	=	Modules::run('operator/gaji/get_count_gaji_cuti', $dtahun, $dbulan, $da['AREA'], TRUE); //echo ($jumlah_rec_gaji);exit;
		//$jumlah_rec_gaji	=	Modules::run('operator/gaji/get_count_gaji', 2014, 6, $da['AREA']);
		$kunci_tombol		=	(
									($jumlah_rec_gaji > 0)
									?' disabled="disabled"'
										/*(
											($da['JUMLAH']==$jumlah_rec_gaji)
											?
												''
											:
												' disabled="disabled"'
										)*/
									:
										''
								);
		$btn_blue			=	'&nbsp;&nbsp;<button class="stdbtn3 btn_blue">&radic;</button><button onclick="location.href=\''.site_url('operator/gaji/buat/bulanan/hapus/'.$da['AREA'].'/'.$dtahun.'/'.$bulan_gaji_number).'\'" class="stdbtn3 btn_red" 
								title="SILAHKAN HAPUS TERLEBIH DAHULU (dengan meng-KLIK tombol X ini)">X</button>';
		$btn_red			=	'<button onclick="location.href=\''.site_url('operator/gaji/buat/bulanan/hapus/'.$da['AREA'].'/'.$dtahun.'/'.$bulan_gaji_number).'\'" class="stdbtn3 btn_red" 
								title="SILAHKAN HAPUS TERLEBIH DAHULU (dengan meng-KLIK tombol X ini)">X</button>';
?>
                        
							<tr>
								<td width="20%">
									<button<?= $kunci_tombol ?> class="stdbtn <?= ($us_6==$da['AREA'])?'btn_blue':'btn_orange' ?>" style="width:100%; font-size:11px; " 
										onclick="location.href='<?= site_url ('operator/gaji/buat/bulanan/cs/' . $da['AREA']) ?>'">
										<?= $da['AREA'] ?>
									</button>
								</td>
								<td style="background-color:<?= ($us_6==$da['AREA'])?'#20A2EF; color: #FFF':'orange' ?>; font-size:11px; padding-left:5px; padding-right:5px; ">
									<table width="100%">
										<tr>
											<td width="40%"><?= $da['JUMLAH'] . ' Orang' ?></td>
											<td width="60%">
												<table width="100%">
													<tr>
														<td width="50%" align="right"><?= $jumlah_rec_gaji.' Orang '?></td>
														<td width="50%" align="right"><?= (($jumlah_rec_gaji > 0)?(($da['JUMLAH']==$jumlah_rec_gaji)?$btn_blue:$btn_red):'') ?></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td colspan="2"><?= $da['NAMA'] ?></td>
										</tr>
									</table>
								</td>
							</tr>
<?php	
	}
?>
                    		<tr>
							 	<td colspan="2"><hr /></td>
						 	</tr>
							 <tr>
								<td>&nbsp;</td>
								<td style="font-size:11px; padding-left:5px; padding-right:5px; ">
									<table width="100%">
										<tr>
											<td width="20%" nowrap="nowrap" style="vertical-align:top; ">
												<button class="stdbtn3 btn_blue">&radic;</button><button class="stdbtn3 btn_red">X</button>
											</td>
											<td><div style="text-align:left; ">DATA GAJI SUDAH ADA</div></td>
										</tr>
									</table>									 
								</td>
							</tr>
							 <tr>
							 	<td colspan="2"><hr /></td>
						 	</tr>
							 <tr>
								<td>&nbsp;</td>
								<td style="font-size:11px; padding-left:5px; padding-right:5px; ">
									<table width="100%">
										<tr>
											<td width="20%" nowrap="nowrap" style="vertical-align:top; ">
												<button class="stdbtn3 btn_red">X</button><button class="stdbtn3 btn_red">X</button>
											</td>
											<td>TERDAPAT PERBEDAAN DATA KARYWAN DENGAN DATA GAJI YANG SUDAH DIBUAT</td>
										</tr>
									</table>
								</td>
							</tr>
							 <tr>
							 	<td colspan="2"><hr /></td>
						 	</tr>
							 <tr>
							 	<td>&nbsp;</td>
							 	<td style="font-size:11px; padding-left:5px; padding-right:5px; ">
									<table width="100%">
										<tr>
											<td width="20%" nowrap="nowrap" style="vertical-align:top; ">
												<button class="stdbtn3 btn_red">X</button>
											</td>
											<td>
												
												ADALAH UNTUK MENGHAPUS DATA GAJI YANG TELAH DIBUAT</td>
										</tr>
									</table>
								</td>
						 	</tr>
							 <tr>
							 	<td colspan="2">
							 		<table width="100%" style="color: red; border: 1px solid orange">
							 			<tr>
							 				<td style="vertical-align:top; ">
						 					<strong>KETERANGAN BPJS: </strong></td>
						 				</tr>
							 			<tr>
							 				<td style="vertical-align:top; ">
							 					<strong>JIKA ITERASI PENGHITUNGAN BPJS LEBIH DARI 1.000.000 KALI, 
						 						MAKA NOMINAL ANGKA BPJS AKAN DIBULATKAN KE PULUHAN </strong></td>
						 				</tr>
						 			</table>						 		</td>
						 	</tr>
						</table>
                    </div>
                    <div style="float: left; width: 73%;<?= (strlen($us_7)==3)?' display:none; ':'' ?> ">
						<div class="tableoptions" style="height:30px; border-bottom:1px #999; ">
							<button id="kahandap" class="stdbtn btn_orange" onclick="javascript:scrollToBottom(); "> KE BAWAH &darr; </button>
							<div style="float:right; ">
								&nbsp;
							</div>
							<div style="float:right; ">
								&nbsp;
							</div>
                    	</div><!--tableoptions-->
						<form id="gaji" class="stdform" method="post" action="<?= current_url () ?>">
<?php
	$i 	= 	1;
	$lu = 	$label_uraian;
	//echo '<pre>'; print_r ($lu);exit;
	
	$arr_npk_test	=	array(
							//'PHT19720628200007100', // YANIRK
							//'PHT19761101200807100', // DADDY HERMAWAN
							//'PHT19690410200301100',	// PAMIN
							//"PHT19591219198310100", // Heru Siswanto
							//"PHT19700727199609200", // YOPITA SARI S.HUT.
							//'PHT19720201199704100', // DIMAS MERU
							//'PHT19771121200608100', //
							//'PP0010017', //TOTO TUGIANTO 
							'PHT19831130200608100', // ARGA PRAMUDITA, S.HUT 
						);
	$arr_idk_test	=	array(
							10322, // LILIK NURDIYATI 
						);
	
	//echo '<pre>'; print_r ($profile->result_array()); exit;
	foreach ($profile->result_array () as $p)
	{
		//if (! in_array($p['npk'], $arr_npk_test)) { continue;}
		//if (! in_array($p['id'], $arr_idk_test)) { continue;}
		
		$tun_jab_dummy			=	0;
		$tsmk 					= 	0;
		$trumah_dummy			= 	0;
		$tpo_dummy				= 	0;
		$transport_dummy		= 	0;
		$tpo_dummy				= 	0;
		$transport_dummy		= 	0;
		$pwanaartha_190_dummy 	= 	0;
		$pwanaartha_475_dummy 	= 	0;
		
		// KOMPONEN TETAP
		$gapok_pns 				= 	(	$p['status_kepegawaian'] == 1 || 
										$p['status_kepegawaian'] == 2 || 
										$p['status_kepegawaian'] == 6 ||
										$p['status_kepegawaian'] == 7) 
									? 
										$p['gapok_pns'] 
									: 
										0;
		
		//echo $p['mkk'];exit;
		$gapok_pht 				= 	get_gapok($dtahun, $p['mkk']) * (($p['status_kepegawaian'] == 4) ? 0.8 : 1);
		$gapok_umpp 			= 	get_gapok_umpp($p['karyawan_area'], $dtahun); 
		$gaji_paket				=	($p['jenjang'] < 4) ? get_gapok_paket ($dtahun, $p['jenjang'], $p['id_jabatan']) : 0;
		
		switch ($p['jenjang'])
		{
			case 1: case 2: case 3:
				$gapok_dummy 	= 	$gaji_paket;
				break;
			case 11:
				$gapok_dummy 	= 	$gapok_pht;
				break;
			default:
				$gapok_dummy 	= 	$gapok_pht;
				break;
		}
				
		$gapok					=	$gapok_dummy;
		$tuntep_pejabat 		= 	(	$p['jenjang'] == 1 || 
										$p['jenjang'] == 2 ||
										$p['jenjang'] == 3 ||
										$p['jenjang'] == 11) 
									? 
										0 
									: 
										375000 ; 
		$tuntep_staf 			= (	$p['jenjang'] == 11) ? 120000 : 0 ; 
		
		$tun_tep				=	$p['tuntep_nominal'];
		
		
		// KOMPONEN VARIABEL
		// TUNJAB
		
		if ($p['jenjang'] > 1 && $p['jenjang'] < 10)
		{
			$arr_staf_ahli = array (1430, 1431, 1432, 1433, 1434, 1435, 1436, 1437);
			$tun_jab_dummy = $p['tunjab_total'] * (($p['t_perwakilan'] == 3) ? 0.5 : 1) * ((in_array($p['id_jabatan'], $arr_staf_ahli) ? 0.5 : 1)) * (($p['ap_fasilitas']==0)?0:1);
		}
		else
		{
			$tun_jab_dummy = 0;
		}
		//echo $tun_jab_dummy; exit;
		/*
		if($p['jenjang'] == 1)
		{
			$tun_jab_dummy = 0;//Modules::run('global/gaji/gapok');
		}
		elseif($p['jenjang'] < 10)
		{
			$tun_jab_dummy 	= 	Modules::run('global/function_gaji/tunjangan', 'jabatan', 'pejabat', $p['jenjang']);
			$tpp_staf_dummy	=	0;
		}
		elseif($p['jenjang'] < 12)
		{
			$tun_jab_dummy	=	0;
			$tpp_staf_dummy	= 	Modules::run('global/function_gaji/tunjangan', 'jabatan', 'staf', $p['golongan']);
		}
		else
		{
			$tun_jab_dummy	=	0;
			$tpp_staf_dummy	= 	Modules::run('global/function_gaji/tunjangan', 'jabatan', 'staf', $p['golongan']);
		}
		*/
		// TPP BARU												
		$tpp_pejabat_dummy2		= 	($p['jenjang'] == 10 || $p['jenjang'] == 11) ? 0 : ($p['tpp_nominal']) * (($p['ap_fasilitas']==0)?0:1);
		$tpp_staf_dummy2		= 	($p['jenjang'] == 10 || $p['jenjang'] == 11) ? ($p['tpp_nominal'] * (($p['ap_fasilitas']==0)?0:1)) : 0;
		
		//echo $tpp_pejabat_dummy2;exit;
		
		//print_r ($arr_npk_diwakili);exit;
		//echo get_jabatan_id ($arr_npk_diwakili[1]); exit;
		
		// TUN PERWAKILAN
		if($p['t_perwakilan'] == 2)
		{
			$arr_npk_diwakili 	= 	explode('|', $p['npk_perwakilan']); 
			//$tperwakilan_dummy 	= 	(get_tunjab_nominal(get_jabatan_id ($arr_npk_diwakili[1]),$p['wilker_id']) * 0.5);
			$tperwakilan_dummy 	= 	Modules::run('global/tunjangan/perwakilan', $arr_npk_diwakili[1]);
		}
		else
		{
			$npk_diwakili 		= 	0;
			$tperwakilan_dummy 	= 	0;
		}
				
		//$arr_npk_diwakili 	= explode(' | ', $p['npk_perwakilan']);
		//$npk_diwakili		= ($p['t_perwakilan'] == 1) ? '' : ((($p['t_perwakilan'] == 2) ? 'MEWAKILI ' : 'DIWAKILI ') . $arr_npk_diwakili[0]);
		//$tperwakilan_dummy 	= ($p['t_perwakilan'] == 2) ? (get_tunjab_nominal(get_jabatan_id ($arr_npk_diwakili[0]),$p['wilker_id']) * 0.5) : 0;
		
		// SMK
		//$smk_dummy = Modules::run ('operator/gaji/get_apresiasi', 'kinerja', $dtahun, 10, $p['npk']);
		$smk_dummy = Modules::run ('global/apresiasi/kinerja', $dtahun, $dbulan, $p['npk']);
		
		// CLI
		//$cli_dummy = Modules::run ('operator/gaji/get_apresiasi', 'kompetensi', $dtahun, '', $p['npk']);
		$cli_dummy = 0;//Modules::run ('global/apresiasi/kompetensi', $dtahun, $p['npk']);
		
		// KEHADIRAN
		$hadir_dummy = Modules::run ('global/apresiasi/kehadiran', $dtahun, $p['npk']);;
		
		/* RUMAH, OBAT, TRANSPORT */
			
		$trumah_dummy 		= ($p['rumdin'] == 1) ? 0 : ($p['tpr_nominal'] * (($p['status_personal'] == 4 && $p['pengurang_trumah'] == 2) ? 0.65 : 1)) * (($p['ap_fasilitas']==0)?0:1); // get_tpr ($p['tpr_id']);
		$tpo_dummy 			= $p['tpo_nominal'] * (($p['ap_fasilitas']==0)?0:1); // get_tpo2 ($p['tpo_id']);
		$transport_dummy 	= ($p['kenddin'] == 1) ? 0 : ($p['trans_nominal'] * (($p['ap_fasilitas']==0)?0:1)); // get_transport ($p['transport_id']);
			
		// WILAYAH
		//$twilayah_dummy = ($p['adm_lap'] == 1) ? $p['wilayah'] : 0;;
		$twilayah_dummy = $p['tunwil_nominal'] * (($p['ap_fasilitas']==0)?0:1); //get_tunwil ($p['karyawan_tunwil_id']);
		
		// UJT
		//$tujt_pengemudi_dummy = $p['ujt_pengemudi'];
		$tujt_pengemudi_dummy = ($p['jabatan_ujt_pengemudi'] == 1) ? 150000 : 0;
			
		// KHUSUS
		/*
		if ($p['jenjang'] > 3)
		{
			$tkhusus_dummy = $p['tkhusus'];	
		}
		else
		{
			$tkhusus_dummy = ($p['rumdin'] == 0 && $p['jenjang'] < 4) ? $p['tkhusus'] : 7750000;	
		}
		*/
		//$tkhusus_dummy = ($p['jenjang'] < 4) ? $p['tkhusus'] : 0;
		$tkhusus_dummy = ($p['jenjang'] < 4) ? (($p['rumdin'] == 1 || $p['kenddin'] == 1) ? $p['jabatan_tkhusus2'] : $p['jabatan_tkhusus']) : 0;
		
		
		// MASA KERJA (PP)
		$tmk_dummy = 0; //($p['jenjang'] == 11) ? get_tmk($p['mkk']) : 0;
		
		// PERBAIKAN JABATAN
		$tpj_dummy = 0;
		
		//
		$tun_jab_aktif 			= $tun_jab_dummy;
		$tpp_pejabat_aktif		= $tpp_pejabat_dummy2;
		$tperwakilan_aktif		= $tperwakilan_dummy;
		$tsmk_aktif				= $smk_dummy;
		$tcli_aktif 			= $cli_dummy;
		$thadir_aktif 			= $hadir_dummy;
		$trumah_aktif 			= $trumah_dummy;
		$twilayah_aktif 		= $twilayah_dummy;
		$tujt_pengemudi_aktif 	= $tujt_pengemudi_dummy;
		$tkhusus_aktif 			= $tkhusus_dummy;
		$tpo_aktif 				= $tpo_dummy;
		$transport_aktif 		= $transport_dummy;
		$tpp_staf_aktif 		= $tpp_staf_dummy2;
		$tmk_aktif 				= $tmk_dummy;
		$tpj_aktif 				= $tpj_dummy;
			
		$tmpp_dummy = (	$p['status_karyawan'] == 2) ? 
						($tun_jab_aktif + $tpp_pejabat_aktif + $tperwakilan_aktif + 
						$tsmk_aktif + $tcli_aktif + $thadir_aktif + 
						$trumah_aktif + $twilayah_aktif + $tujt_pengemudi_aktif + 
						$tkhusus_aktif + $tpo_aktif + $transport_aktif + 
						$tpp_staf_aktif + $tmk_aktif + $tpj_aktif) : 
						0 ;
		//CEK MPP ==> Ternyata masih mendapatkan Apresiasi SMK
		if ($p['status_karyawan'] == 2)
		{
			$tun_jab 			= 0;
			$tpp_pejabat		= 0;
			$tperwakilan		= 0;
			$tsmk				= 0;
			$tcli 				= 0;
			$thadir 			= 0;
			$trumah 			= 0;
			$twilayah			= 0;
			$tujt_pengemudi 	= 0;
			$tkhusus			= 0;
			$tpo 				= 0;
			$transport 			= 0;
			$tpp_staf			= 0;
			$tmk 				= 0;
			$tpj 				= 0;													
			$tmpp 				= $tmpp_dummy;
		}
		else
		{
			$tun_jab 			= $tun_jab_dummy;
			$tpp_pejabat		= $tpp_pejabat_dummy2;
			$tperwakilan		= $tperwakilan_dummy;
			$tsmk				= $smk_dummy;
			$tcli				= $cli_dummy;
			$thadir				= $hadir_dummy;
			$trumah 			= $trumah_dummy;
			$twilayah 			= $twilayah_dummy;
			$tujt_pengemudi 	= $tujt_pengemudi_dummy;
			$tkhusus 			= $tkhusus_dummy;
			$tpo				= $tpo_dummy;
			$transport 			= $transport_dummy;
			$tpp_staf 			= $tpp_staf_dummy2;
			$tmk				= $tmk_dummy;
			$tpj				= $tpj_dummy;
			$tmpp 				= 0;
		}
																
		// KOMPONEN SUBSIDI & LAIN-LAIN
		//TUNJANGAN PEMBERI KERJA 12%
		
		$janak			=	( 	Modules::run('operator/gaji/jumlah', 'anak',$p['id']) == 0 )
							?
								$p['anak']
							:
								Modules::run('operator/gaji/jumlah', 'anak',$p['id']);
		
		$jtanggungan	=	(	Modules::run('operator/gaji/jumlah', 'tanggungan',$p['id']) == 0 )
							?
								$p['tanggungan']
							:
								Modules::run('operator/gaji/jumlah', 'tanggungan',$p['id']);
		
		//echo $jtanggungan;exit;
		switch ($p['status_personal'])
		{
			case 1: case 3: // TIDAK KAWIN
				$ias = 0;
				$anak = $janak;
				break;
			case 2: case 4: // KAWIN
				$ias = 1;
				$anak = $janak;
				break;
			case 5: // PASANGAN KERJA 1
				$ias = 0;
				$anak = 0;
				break;
		}														
		if((	$p['status_kepegawaian'] == 1 || 
				$p['status_kepegawaian'] == 2 || 
				$p['status_kepegawaian'] == 3 || 
				$p['status_kepegawaian'] == 6 || 
				$p['status_kepegawaian'] == 7))
		{
			$selisih = round($gapok - ($p['gapok_pns'] +
						($p['gapok_pns'] * $ias * 0.10) + 
						($p['gapok_pns'] * $anak * 0.02)),0);
			if ($p['status_kepegawaian'] == 3)
			{ 
				$tpk_dummy = $selisih * 0.12;	
			}
			else
			{
				$tpk_dummy = ((	$selisih > $p['phdp']) ? 
								$selisih : $p['phdp']) * 0.12;
			}
		}
		else
		{
			$tpk_dummy = 0;
		}
		$tpk = round(($p['jenjang'] == 1 || $p['k_dplk'] == 1) ? 0 : $tpk_dummy,0);
			
		//TUNJANGAN PREMI KASURANSI KESEHATAN
		//$tpaskes = ($p['status_kepegawaian'] == 5) ? 0 : $gapok * 0.10;
		$tpaskes = round($gapok * 0.10,0);
		
		//TUNJANGAN PEMILIKAN RUMAH
		/*
		$tprumah = ($p['status_kepegawaian'] == 1 || 
					$p['status_kepegawaian'] == 3 || 
					$p['status_kepegawaian'] == 6) ? $gapok * 0.05 : 0;
		*/
		$tprumah = round(($p['jenjang'] == 1) ? 0 : $gapok * 0.05,0); // BALIKAN LAGI KE 5%
		
		$dplk_dummy = round($p['k_dplk'] * $p['gol_dplk'],0);
		$tdplk = $dplk_dummy;
			
		// KOMPONEN POTONGAN
		
		$pwanaartha_190 = 0;
		$pwanaartha_475 = 0;
		
		
		$ppk = $tpk;
		$ppaskes = $tpaskes;
		$pprumah = $tprumah;
		$pdplk = $tdplk;
			
			
		// POTONGAN KEIKUTSERTAAN ----- AWAL --------
		
		// 1. Dana Pensiun PNS
		if ($p['k_dpp'] == 1 && ($p['status_kepegawaian'] == 1 || $p['status_kepegawaian'] == 2))
		{
			$dapen_475_dummy = 	$p['k_dpp'] * ($gapok_pns + 
								($p['gapok_pns'] * $ias * 0.10) + ($p['gapok_pns'] * $anak * 0.02)) * 
								0.0475;
		}
		else
		{
			$dapen_475_dummy = 0;
		}
		$pdapen_475 = round($dapen_475_dummy,0);
		//echo $pdapen_475;exit;
		// 2. Dana Pensiun Wana Artha
		if ($p['k_wanaartha'] == 1 && ($p['status_kepegawaian'] == 1 || $p['status_kepegawaian'] == 2 || $p['status_kepegawaian'] == 6 || $p['status_kepegawaian'] == 7))
		{
			if ($p['status_kepegawaian'] == 1 || $p['status_kepegawaian'] == 6)
			{
				/*
				$pwanaartha_190_dummy = $p['k_wanaartha'] * ($gapok_pns + 
									($p['gapok_pns'] * $ias * 0.10) + ($p['gapok_pns'] * $anak * 0.02)) * 
									0.0190;
				*/
				$pwanaartha_190_dummy = round($p['k_wanaartha'] * $gapok * 0.0190, 0);
				$pwanaartha_475_dummy = 0;
				$tpk = 0;
				$ppk = $tpk;
			}
			else
			{
				$pwanaartha_190_dummy = 0;
				
				$pwanaartha_475_dummy = $p['k_wanaartha'] * ($gapok_pns + 
										($p['gapok_pns'] * $ias * 0.10) + ($p['gapok_pns'] * $anak * 0.02)) * 
										0.0475;
				/*$pwanaartha_475_dummy = round($p['k_wanaartha'] * $gapok * 0.0475,0);*/
				$tpk = 0;
				$ppk = $tpk;
			}
		}
		else
		{
			$pwanaartha_190_dummy = 0;
			$pwanaartha_475_dummy = 0;
		}
		$pwanaartha_190 = round($pwanaartha_190_dummy, 0);
		$pwanaartha_475 = round($pwanaartha_475_dummy, 0);
			
		// 3. Dana Pensiun Perhutani
		if ($p['k_dpp'] == 1)
		{
			$ppk 	= $tpk;
			if ($p['status_kepegawaian'] == 1 || $p['status_kepegawaian'] == 2 || $p['status_kepegawaian'] == 6 || $p['status_kepegawaian'] == 7)
			{
				if ($p['status_kepegawaian'] == 1)
				{ // BARU
					$pppns 	= ($p['k_dpp'] == 1 && $p['k_dapen'] == 1) ? (round((($selisih > $p['phdp']) ? $selisih : $p['phdp']) * 0.05,0)) : 0;
					$pppht 	= 0;
				}
				else
				{
					$pppns 	= round((($selisih > $p['phdp']) ? $selisih : $p['phdp']) * 0.05,0);
					$pppht 	= 0;
				}
			}
			else if ($p['status_kepegawaian'] == 3)
			{
				$pppht 	= round((($selisih > $p['phdp']) ? $selisih : $p['phdp']) * 0.05,0);
				$pppns 	= 0;
			}
			else
			{
				$pppns 	= 0;
				$pppht 	= 0;
			}
		}
		else
		{
			//$ppk 	= 0;
			$pppns 	= 0;
			$pppht 	= 0;
		}
			
		// 4. Dana Pensiun Lembaga Keuangan (DPLK)
		if ($p['k_dplk'] == 1)
		{
			$pdplk = $tdplk;
		}
		else
		{
			$pdplk = 0;
		}
		
		
		// TASPEN 3,25%
		if ($p['k_taspen'] == 1)
		{
			$ptaspen_325 = round($gapok * 0.0325,0);
		}
		else
		{
			$ptaspen_325 = 0;
		}
		
		// PERHITUNGAN BPJS
		
		$tup				=	0;
		$pup				=	$tup;
		
		
		
		$jumlah_kt 			= 	$gapok + $tun_tep;//$tuntep + $tpu ;
					
		$jumlah_kv			= 	$tun_jab + $tpp_pejabat + $tperwakilan + $tsmk + $tcli + $thadir + 
								$trumah + $twilayah + $tujt_pengemudi + $tkhusus + $tpo + $transport + 
								$tpp_staf + $tmk + $tpj + $tmpp;
							
		$jumlah_sl			= 	$tpk + $tpaskes + $tprumah + $tdplk + $tup;
							
		$jumlah_bruto 		= 	$jumlah_kt + $jumlah_kv + $jumlah_sl;
		
		$jumlah_potongan 	= 	$ppk + $ppaskes + $pprumah + 
								$pdplk + $pppns + $pppht + 
								$ptaspen_325 + $pdapen_475 + 
								$pwanaartha_190 + $pwanaartha_475 + $pup;
							
		$jumlah_total 		= 	round($jumlah_bruto,0) - round($jumlah_potongan,0);
		
		//echo 'JUMLAH TOTAL: '. $jumlah_total . ' | ' . 'UMPP: ' . $gapok_umpp; exit;	
		// BPJS
		//echo $jumlah_total - $tsmk . ' | ' . $gapok_umpp;exit;
		
		$tjamsostek 		= 	0;
		$pjamsostek 		= 	0;
		$dummy_tjamsostek	=	0;
		$dummy_pjamsostek	=	0;
		
		$BPJSP2				=	0;
		$BPJSP3				=	0;
		$dummy_BPJSP2		=	0;
		$dummy_BPJSP3		=	0;
		
		$iterasi			=	1;
		if($p['k_bpjs_kesehatan'] == 1)
		{
			//echo 'IKUT'; exit;
			$BPJSK4				=	0;
			$BPJSK45			=	0;
			$dummy_BPJSK4		=	0;
			$dummy_BPJSK45		=	0;	
			
			do
			{
				if ($iterasi <= 1000000)
				{
					$tjamsostek 	= 	$dummy_tjamsostek;
					$pjamsostek 	= 	$dummy_pjamsostek;
					$BPJSK4			=	$dummy_BPJSK4;
					$BPJSK45		=	$dummy_BPJSK45;
					$BPJSP2			=	$dummy_BPJSP2;
					$BPJSP3			=	$dummy_BPJSP3;
					
					$jumlah_kt 			= 	$gapok + $tun_tep;//$tuntep + $tpu ;
				
					$jumlah_kv			= 	$tun_jab + $tpp_pejabat + $tperwakilan + 
											$trumah + $twilayah + $tujt_pengemudi + $tkhusus + $tpo + $transport + 
											$tpp_staf + $tmk + $tpj + $tmpp;
					$jumlah_sl			= 	$tpk + $tpaskes + $tprumah + $tdplk + $tjamsostek + $BPJSK4 + $BPJSP2;
					$jumlah_bruto 		= 	$jumlah_kt + $jumlah_kv + $jumlah_sl;
					$jumlah_potongan 	= 	$ppk + $ppaskes + $pprumah + $pdplk + $pjamsostek + $BPJSK45  + $BPJSP3 + $pppns + $pppht + 
											$ptaspen_325 + $pdapen_475 + $pwanaartha_190 + $pwanaartha_475 /*+ $pup*/;
					$jumlah_total 		= 	round($jumlah_bruto,0) - round($jumlah_potongan,0);
					
					// 1. Ketenagakerjaan
					if ($jumlah_total < $gapok_umpp)
					{
						$dummy_tjamsostek = round($p['k_bpjs_ketenagakerjaan'] * $gapok_umpp * 0.0489,0);
						$dummy_pjamsostek = round($p['k_bpjs_ketenagakerjaan'] * $gapok_umpp * 0.0689,0);
					}
					else
					{
						$dummy_tjamsostek = round($p['k_bpjs_ketenagakerjaan'] * $jumlah_total * 0.0489,0);
						$dummy_pjamsostek = round($p['k_bpjs_ketenagakerjaan'] * $jumlah_total * 0.0689,0);
					}					
					
					// 2. Kesehatan
					if ($jumlah_total <=  $bpjs_kesehatan['bawah']) // KELAS II
					{
						if ($jumlah_total < $gapok_umpp)
						{
							$dummy_BPJSK4 	=	round($p['k_bpjs_kesehatan'] * 0.04 	* $gapok_umpp, 0);
							$dummy_BPJSK45	=	round($p['k_bpjs_kesehatan'] * 0.05 	* $gapok_umpp, 0);
							$KELAS			=	'II';
						}
						else 
						{
							$dummy_BPJSK4 	=	round($p['k_bpjs_kesehatan'] * 0.04 	* $jumlah_total, 0);
							$dummy_BPJSK45	=	round($p['k_bpjs_kesehatan'] * 0.05 	* $jumlah_total, 0);
							$KELAS			=	'II';
						}
					}
					elseif($jumlah_total <=  $bpjs_kesehatan['atas']) // KELAS I
					{
						$dummy_BPJSK4 		=	round($p['k_bpjs_kesehatan'] * 0.04 	* $jumlah_total, 0);
						$dummy_BPJSK45		=	round($p['k_bpjs_kesehatan'] * 0.05 	* $jumlah_total, 0);
						$KELAS				=	'I';
					}
					else
					{
						$dummy_BPJSK4 		=	round($p['k_bpjs_kesehatan'] * 0.04 	* $bpjs_kesehatan['atas'], 0);
						$dummy_BPJSK45		=	round($p['k_bpjs_kesehatan'] * 0.05 	* $bpjs_kesehatan['atas'], 0);
						$dummy_KELAS		=	'I';
					}
					
					// 3. Pensiun
					if($jumlah_total <= $bpjs_ks_pensiun['atas'])
					{
						if($jumlah_total < $gapok_umpp)
						{
							$dummy_BPJSP2 		= 	round($gapok_umpp * 0.02,0);
							$dummy_BPJSP3 		= 	round($gapok_umpp * 0.03,0);
						}
						else
						{
							$dummy_BPJSP2 		= 	round($jumlah_total * 0.02,0);
							$dummy_BPJSP3 		= 	round($jumlah_total * 0.03,0);
						}
					}
					else
					{
						$dummy_BPJSP2 		= 	round($bpjs_ks_pensiun['atas'] * 0.02,0);
						$dummy_BPJSP3 		= 	round($bpjs_ks_pensiun['atas'] * 0.03,0);
					}
				}
				else
				{
					$tjamsostek 		= 	$dummy_tjamsostek;
					$pjamsostek 		= 	$dummy_pjamsostek;
					$BPJSK4				=	$dummy_BPJSK4;
					$BPJSK45			=	$dummy_BPJSK45;
					
					$jumlah_kt 			= 	$gapok + $tun_tep;//$tuntep + $tpu ;
				
					$jumlah_kv			= 	$tun_jab + $tpp_pejabat + $tperwakilan + 
											$trumah + $twilayah + $tujt_pengemudi + $tkhusus + $tpo + $transport + 
											$tpp_staf + $tmk + $tpj + $tmpp;
					$jumlah_sl			= 	$tpk + $tpaskes + $tprumah + $tdplk + $tjamsostek + $BPJSK4 + $BPJSP2;
					$jumlah_bruto 		= 	$jumlah_kt + $jumlah_kv + $jumlah_sl;
					$jumlah_potongan 	= 	$ppk + $ppaskes + $pprumah + $pdplk + $pjamsostek + $BPJSK45 + $BPJSP3 + $pppns + $pppht + 
											$ptaspen_325 + $pdapen_475 + $pwanaartha_190 + $pwanaartha_475 /*+ $pup*/;
					$jumlah_total 		= 	round($jumlah_bruto,0) - round($jumlah_potongan,0);
					
					// 1. Ketenagakerjaan
					if ($jumlah_total < $gapok_umpp)
					{
						$dummy_tjamsostek = round($p['k_bpjs_ketenagakerjaan'] * $gapok_umpp * 0.0489, -1);
						$dummy_pjamsostek = round($p['k_bpjs_ketenagakerjaan'] * $gapok_umpp * 0.0689, -1);
					}
					else
					{
						$dummy_tjamsostek = round($p['k_bpjs_ketenagakerjaan'] * $jumlah_total * 0.0489, -1);
						$dummy_pjamsostek = round($p['k_bpjs_ketenagakerjaan'] * $jumlah_total * 0.0689, -1);
					}
					
					// 2. Kesehatan
					if ($jumlah_total < $gapok_umpp)
					{
						$dummy_BPJSK4 		=	round($p['k_bpjs_kesehatan'] * 0.04 	* $gapok_umpp, -1);
						$dummy_BPJSK45		=	round($p['k_bpjs_kesehatan'] * 0.05 	* $gapok_umpp, -1);
						$KELAS				=	'II';
					}
					elseif ($jumlah_total <= $bpjs_ksehatan['bawah'])
					{
						if ($jumlah_total < $gapok_umpp)
						{
							$dummy_BPJSK4 	=	round($p['k_bpjs_kesehatan'] * 0.04 	* $gapok_umpp, -1);
							$dummy_BPJSK45	=	round($p['k_bpjs_kesehatan'] * 0.05 	* $gapok_umpp, -1);
							$KELAS			=	'II';
						}
						else
						{
							$dummy_BPJSK4 	=	round($p['k_bpjs_kesehatan'] * 0.04 	* $jumlah_total, 0);
							$dummy_BPJSK45	=	round($p['k_bpjs_kesehatan'] * 0.05 	* $jumlah_total, 0);
							$KELAS			=	'II';
						}
					}
					elseif($jumlah_total <= $bpjs_ksehatan['atas'])
					{
						$dummy_BPJSK4 		=	round($p['k_bpjs_kesehatan'] * 0.04 	* $jumlah_total, -1);
						$dummy_BPJSK45		=	round($p['k_bpjs_kesehatan'] * 0.05 	* $jumlah_total, -1);
						$KELAS				=	'I';
					}
					else
					{
						$dummy_BPJSK4 		=	round($p['k_bpjs_kesehatan'] * 0.04 	* $bpjs_ksehatan['atas'], -1);
						$dummy_BPJSK45		=	round($p['k_bpjs_kesehatan'] * 0.05 	* $bpjs_ksehatan['atas'], -1);
						$dummy_KELAS		=	'I';
					}
					
					// 3. Pensiun
					//KHUSUS
					if($jumlah_total <= $bpjs_ks_pensiun['atas'])
					{
						if ($jumlah_total < $gapok_umpp)
						{
							$dummy_BPJSP2 = round($gapok_umpp * 0.02,0);
							$dummy_BPJSP3 = round($gapok_umpp * 0.03,0);
						}
						else
						{
							$dummy_BPJSP2 = round($jumlah_total * 0.02,0);
							$dummy_BPJSP3 = round($jumlah_total * 0.03,0);
						}
					}
					else
					{
						$dummy_BPJSP2 = round($bpjs_ks_pensiun['atas'] * 0.02,0);
						$dummy_BPJSP3 = round($bpjs_ks_pensiun['atas'] * 0.03,0);
					}	
				}
					
				/* 
				echo '
					<table width="50%" border="0" cellpadding="0" cellspacing="0">
						<tr><td colspan="7"><hr /></td></tr>
						<tr>
							<td width="7%">'.$iterasi.'</td>
							<td width="15%">NPK</td><td width="25%" colspan="2">'.$p['npk'].'</td>
							<td width="23%">NAMA</td><td width="30%" colspan="2">'.$p['nama'].'</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>THP</td><td width="15%" align="right">'.number_format($jumlah_total, 0, '', '.').'</td><td width="10%">&nbsp;</td>
							<td>KINERJA</td><td width="18%" align="right">'.number_format($tsmk, 0, '', '.').'</td><td width="12%">&nbsp;</td>
						</tr>
						
						<tr>
							<td>&nbsp;</td>
							<td>BPJSK489</td><td align="right">'.number_format($tjamsostek, 0, '', '.').'</td><td>&nbsp;</td>
							<td>DUMMY BPJSK489</td><td align="right">'.number_format($dummy_tjamsostek, 0, '', '.').'</td><td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>BPJSK4</td><td align="right">'.number_format($BPJSK4, 0, '', '.').'</td><td>&nbsp;</td>
							<td>DUMMY BPJSK4</td><td align="right">'.number_format($dummy_BPJSK4, 0, '', '.').'</td><td>&nbsp;</td> 
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>BPJSP2</td><td align="right">'.number_format($BPJSP2, 0, '', '.').'</td><td>&nbsp;</td>
							<td>DUMMY BPJSP2</td><td align="right">'.number_format($dummy_BPJSP2, 0, '', '.').'</td><td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>BPJSK689</td><td align="right">'.number_format($pjamsostek, 0, '', '.').'</td><td>&nbsp;</td>
							<td>DUMMY BPJSK689</td><td align="right">'.number_format($dummy_pjamsostek, 0, '', '.').'</td><td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>BPJSK45</td><td align="right">'.number_format($BPJSK45, 0, '', '.').'</td><td>&nbsp;</td>
							<td>DUMMY BPJSK45</td><td align="right">'.number_format($dummy_BPJSK45, 0, '', '.').'</td><td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>BPJSP3</td><td align="right">'.number_format($BPJSP3, 0, '', '.').'</td><td>&nbsp;</td>
							<td>DUMMY BPJSP3</td><td align="right">'.number_format($dummy_BPJSP3, 0, '', '.').'</td><td>&nbsp;</td>
						</tr>
						<tr><td colspan="7"><hr /></td></tr>
					</table>
				';					
				*/
				$iterasi++; 
			} while ((($tjamsostek <> $dummy_tjamsostek) && ($pjamsostek <> $dummy_pjamsostek) ));
			
			//exit;
			/* 
				echo '
					<table width="50%" border="0" cellpadding="0" cellspacing="0">
						<tr><td colspan="7"><hr /></td></tr>
						<tr>
							<td width="7%">'.$iterasi.'</td>
							<td width="15%">NPK</td><td width="25%" colspan="2">'.$p['npk'].'</td>
							<td width="23%">NAMA</td><td width="30%" colspan="2">'.$p['nama'].'</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>THP</td><td width="15%" align="right">'.number_format($jumlah_total, 0, '', '.').'</td><td width="10%">&nbsp;</td>
							<td>KINERJA</td><td width="18%" align="right">'.number_format($tsmk, 0, '', '.').'</td><td width="12%">&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>BPJSK489</td><td align="right">'.number_format($tjamsostek, 0, '', '.').'</td><td>&nbsp;</td>
							<td>DUMMY BPJSK489</td><td align="right">'.number_format($dummy_tjamsostek, 0, '', '.').'</td><td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>BPJSK689</td><td align="right">'.number_format($pjamsostek, 0, '', '.').'</td><td>&nbsp;</td>
							<td>DUMMY BPJSK689</td><td align="right">'.number_format($dummy_pjamsostek, 0, '', '.').'</td><td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>BPJSK4</td><td align="right">'.number_format($BPJSK4, 0, '', '.').'</td><td>&nbsp;</td>
							<td>DUMMY BPJSK4</td><td align="right">'.number_format($dummy_BPJSK4, 0, '', '.').'</td><td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>BPJSK45</td><td align="right">'.number_format($BPJSK45, 0, '', '.').'</td><td>&nbsp;</td>
							<td>DUMMY BPJSK45</td><td align="right">'.number_format($dummy_BPJSK45, 0, '', '.').'</td><td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>BPJSP2</td><td align="right">'.number_format($BPJSP2, 0, '', '.').'</td><td>&nbsp;</td>
							<td>DUMMY BPJSP2</td><td align="right">'.number_format($dummy_BPJSP2, 0, '', '.').'</td><td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>BPJSP3</td><td align="right">'.number_format($BPJSP3, 0, '', '.').'</td><td>&nbsp;</td>
							<td>DUMMY BPJSP3</td><td align="right">'.number_format($dummy_BPJSP3, 0, '', '.').'</td><td>&nbsp;</td>
						</tr>
						<tr><td colspan="7"><hr /></td></tr>
					</table>
				';
			exit;
			*/
		}
		else
		{
			do
			{
				$tjamsostek 		= 	$dummy_tjamsostek;
				$pjamsostek 		= 	$dummy_pjamsostek;
				
				$BPJSK4				=	0;
				$BPJSK45			=	0;
				
				$jumlah_kt 			= 	$gapok + $tun_tep;//$tuntep + $tpu ;
				
				$jumlah_kv			= 	$tun_jab + $tpp_pejabat + $tperwakilan + 
										$trumah + $twilayah + $tujt_pengemudi + $tkhusus + $tpo + $transport + 
										$tpp_staf + $tmk + $tpj + $tmpp;
				$jumlah_sl			= 	$tpk + $tpaskes + $tprumah + $tdplk + $tjamsostek + $BPJSK4 + $BPJSP2;
				$jumlah_bruto 		= 	$jumlah_kt + $jumlah_kv + $jumlah_sl;
				$jumlah_potongan 	= 	$ppk + $ppaskes + $pprumah + $pdplk + $pjamsostek + $BPJSK45 + $BPJSP3 + $pppns + $pppht + 
										$ptaspen_325 + $pdapen_475 + $pwanaartha_190 + $pwanaartha_475 /*+ $pup*/;
				$jumlah_total 		= 	round($jumlah_bruto,0) - round($jumlah_potongan,0);
				
				// 1. Ketenagakerjaan
				if ($jumlah_total < $gapok_umpp)
				{
					$dummy_tjamsostek = round($p['k_bpjs_ketenagakerjaan'] * $gapok_umpp * 0.0489,0);
					$dummy_pjamsostek = round($p['k_bpjs_ketenagakerjaan'] * $gapok_umpp * 0.0689,0);
				}
				else
				{
					$dummy_tjamsostek = round($p['k_bpjs_ketenagakerjaan'] * $jumlah_total * 0.0489,0);
					$dummy_pjamsostek = round($p['k_bpjs_ketenagakerjaan'] * $jumlah_total * 0.0689,0);
				}
				
				//2 Kesehatan
				$dummy_BPJSK4		=	$BPJSK4;
				$dummy_BPJSK45		=	$BPJSK45;
				
				// 3. Pensiun
				if($jumlah_total <= $bpjs_ks_pensiun['atas'])
				{
					if($jumlah_total < $gapok_umpp)
					{
						$dummy_BPJSP2 = round($gapok_umpp * 0.02,0);
						$dummy_BPJSP3 = round($gapok_umpp * 0.03,0);
					}
					else
					{
						$dummy_BPJSP2 = round($jumlah_total * 0.02,0);
						$dummy_BPJSP3 = round($jumlah_total * 0.03,0);
					}
				}
				else
				{
					$dummy_BPJSP2 = round($bpjs_ks_pensiun['atas'] * 0.02,0);
					$dummy_BPJSP3 = round($bpjs_ks_pensiun['atas'] * 0.03,0);
				}
					
				/* 
				echo '
					<table width="50%" border="0" cellpadding="0" cellspacing="0">
						<tr><td colspan="7"><hr /></td></tr>
						<tr>
							<td width="7%">'.$iterasi.'</td>
							<td width="15%">NPK</td><td width="25%" colspan="2">'.$p['npk'].'</td>
							<td width="23%">NAMA</td><td width="30%" colspan="2">'.$p['nama'].'</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>THP</td><td width="15%" align="right">'.number_format($jumlah_total, 0, '', '.').'</td><td width="10%">&nbsp;</td>
							<td>KINERJA</td><td width="18%" align="right">'.number_format($tsmk, 0, '', '.').'</td><td width="12%">&nbsp;</td>
						</tr>
						
						<tr>
							<td>&nbsp;</td>
							<td>BPJSK489</td><td align="right">'.number_format($tjamsostek, 0, '', '.').'</td><td>&nbsp;</td>
							<td>DUMMY BPJSK489</td><td align="right">'.number_format($dummy_tjamsostek, 0, '', '.').'</td><td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>BPJSK4</td><td align="right">'.number_format($BPJSK4, 0, '', '.').'</td><td>&nbsp;</td>
							<td>DUMMY BPJSK4</td><td align="right">'.number_format($dummy_BPJSK4, 0, '', '.').'</td><td>&nbsp;</td> 
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>BPJSP2</td><td align="right">'.number_format($BPJSP2, 0, '', '.').'</td><td>&nbsp;</td>
							<td>DUMMY BPJSP2</td><td align="right">'.number_format($dummy_BPJSP2, 0, '', '.').'</td><td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>BPJSK689</td><td align="right">'.number_format($pjamsostek, 0, '', '.').'</td><td>&nbsp;</td>
							<td>DUMMY BPJSK689</td><td align="right">'.number_format($dummy_pjamsostek, 0, '', '.').'</td><td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>BPJSK45</td><td align="right">'.number_format($BPJSK45, 0, '', '.').'</td><td>&nbsp;</td>
							<td>DUMMY BPJSK45</td><td align="right">'.number_format($dummy_BPJSK45, 0, '', '.').'</td><td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>BPJSP3</td><td align="right">'.number_format($BPJSP3, 0, '', '.').'</td><td>&nbsp;</td>
							<td>DUMMY BPJSP3</td><td align="right">'.number_format($dummy_BPJSP3, 0, '', '.').'</td><td>&nbsp;</td>
						</tr>
						<tr><td colspan="7"><hr /></td></tr>
					</table>
				';					
				*/
			} while ((($tjamsostek <> $dummy_tjamsostek) && ($pjamsostek <> $dummy_pjamsostek) ));
			
			//exit;
		}
			
		$tjamsostek			=	$dummy_tjamsostek;
		$pjamsostek			=	$dummy_pjamsostek;
		$BPJSK4				=	$dummy_BPJSK4;
		$BPJSK45			=	$dummy_BPJSK45;
		$BPJSP2				=	$dummy_BPJSP2;
		$BPJSP3				=	$dummy_BPJSP3;

		/* 
			echo '
				<table width="50%" border="0" cellpadding="0" cellspacing="0">
					<tr><td colspan="7"><hr /></td></tr>
					<tr>
						<td width="7%">'.$iterasi.'</td>
						<td width="15%">NPK</td><td width="25%" colspan="2">'.$p['npk'].'</td>
						<td width="23%">NAMA</td><td width="30%" colspan="2">'.$p['nama'].'</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>THP</td><td width="15%" align="right">'.number_format($jumlah_total, 0, '', '.').'</td><td width="10%">&nbsp;</td>
						<td>KINERJA</td><td width="18%" align="right">'.number_format($tsmk, 0, '', '.').'</td><td width="12%">&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>BPJSK489</td><td align="right">'.number_format($tjamsostek, 0, '', '.').'</td><td>&nbsp;</td>
						<td>DUMMY BPJSK489</td><td align="right">'.number_format($dummy_tjamsostek, 0, '', '.').'</td><td>&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>BPJSK689</td><td align="right">'.number_format($pjamsostek, 0, '', '.').'</td><td>&nbsp;</td>
						<td>DUMMY BPJSK689</td><td align="right">'.number_format($dummy_pjamsostek, 0, '', '.').'</td><td>&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>BPJSK4</td><td align="right">'.number_format($BPJSK4, 0, '', '.').'</td><td>&nbsp;</td>
						<td>DUMMY BPJSK4</td><td align="right">'.number_format($dummy_BPJSK4, 0, '', '.').'</td><td>&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>BPJSK45</td><td align="right">'.number_format($BPJSK45, 0, '', '.').'</td><td>&nbsp;</td>
						<td>DUMMY BPJSK45</td><td align="right">'.number_format($dummy_BPJSK45, 0, '', '.').'</td><td>&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>BPJSP2</td><td align="right">'.number_format($BPJSP2, 0, '', '.').'</td><td>&nbsp;</td>
						<td>DUMMY BPJSP2</td><td align="right">'.number_format($dummy_BPJSP2, 0, '', '.').'</td><td>&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>BPJSP3</td><td align="right">'.number_format($BPJSP3, 0, '', '.').'</td><td>&nbsp;</td>
						<td>DUMMY BPJSP3</td><td align="right">'.number_format($dummy_BPJSP3, 0, '', '.').'</td><td>&nbsp;</td>
					</tr>
					<tr><td colspan="7"><hr /></td></tr>
				</table>
			';
		exit;
		*/

		// Tunjangan Uang Pajak (TUP)
		
		$jumlah_19 = 0;	
		do
		{									
			// PERHITUNGAN TUNJANGAN UANG PAJAK (TUP)
			$jumlah_1     =  $gapok + $tun_tep;//$tuntep + $tpu; //komponen tetap
			$jumlah_2     =  $jumlah_19;
			$jumlah_3     =  $tun_jab + $tpp_pejabat + $tperwakilan + $tsmk + $tcli + $thadir + $trumah + $twilayah + $tujt_pengemudi + $tkhusus + $tpo + $transport + $tpp_staf + $tmk + $tpj + $tmpp + round($tpk,0) + $tpaskes + $tprumah + $tdplk + $tjamsostek + $BPJSK4 + $BPJSP2;// + $tjpk_6p + $tjpk_3p; komponen variabel+subsidi
			$jumlah_4     =  0;
			$jumlah_5     =  0;
			$jumlah_6     =  0; 
			$jumlah_7L    =  ($jumlah_1 + $jumlah_2 + $jumlah_3 + $jumlah_4 + $jumlah_5 + $jumlah_6); 
							// semua penghasilan tetap,variabel dan subsidi 
							//penghasilan bruto per bulan 
			$jumlah_7     =  0;//get_ttt ($p['npk']); //$p['ttt_nominal']; //$tunjangan_tt + $bonus; // tunjangan tak teratur (perawatan/opname) + bonus/thr/smk
			$jumlah_8     =  $jumlah_7L + $jumlah_7;  //penghasilan bruto per bulan + bonus
			//echo $jumlah_8;exit;
			/// AWAL rekursif
			
			//pengurangan biaya jabatan perbulan
			if (($jumlah_8 * 0.05) < 500000)
			{
				$jumlah_9  =  round($jumlah_8 * 0.05, PHP_ROUND_HALF_DOWN); 
			}
			else 
			{
				$jumlah_9    =  500000;
			}
			
			$jumlah_10		=	$pdplk + $pppns + $pppht + $ptaspen_325 + $pdapen_475 + $pwanaartha_190 + $pwanaartha_475 + ($pjamsostek*5.70/6.89);
			$jumlah_11    	= 	$jumlah_9 + $jumlah_10;
			$jumlah_12    	=	($jumlah_8 - $jumlah_11); //penghasilan netto sebulan
			// diisi netto sebelumnya dari kantor lama saat karyawan pindah saat akhir tahun pengisiannnya / manual 
			$jumlah_13    	= 	0; 
			$jumlah_14    	=  floor($jumlah_12) * 12; // penghasilan netto setahun 
			
			//ptkp 
			// Baris Tanggungan Dikunci Per Bulan Januari
			if ($jtanggungan > 3)
			{
				$tanggungan = 3;
			}
			else
			{
				$tanggungan = $jtanggungan;
			}
			
			//echo $tanggungan;exit;
			//echo $p['status_personal'];exit;
			switch ($p['status_personal'])
			{
				case 1: case 3:  // TIDAK KAWIN, duda/janda
					$jumlah_15   		=	($p['jk'] == 1) ? ($ptkp_dasar + ( $ptkp_margin * $tanggungan)) : $ptkp_dasar;
					$status_ptkp 		=	($p['jk'] == 1) ? 'K' : 'TK';
					$tanggungan_ptkp 	=	($p['jk'] == 1) ? $jtanggungan : 0;
					break;
				case 2:  // KAWIN					
					$jumlah_15   		=  	($p['jk'] == 1) ? ($ptkp_dasar + $ptkp_margin + ( $ptkp_margin * $tanggungan)) : $ptkp_dasar;
					$status_ptkp 		=	($p['jk'] == 1) ? 'K' : 'TK';
					$tanggungan_ptkp 	=	($p['jk'] == 1) ? $jtanggungan : 0;
					break;
				case 4: // PASANGAN KERJA 
					$jumlah_15   		=  	($p['jk'] == 1) ? ($ptkp_dasar + $ptkp_margin + ( $ptkp_margin * $tanggungan)) : 0;
					$status_ptkp 		=	'HB';
					$tanggungan_ptkp 	=	($p['jk'] == 1) ? $tanggungan : 0;
					break; 
			}
			$jk_pajak = ($p['jk'] == 1) ? 'M' : 'F';
				
			// penghasilan kena pajak
			if ($jumlah_14 - $jumlah_15 > 0)
			{
				$jumlah_16 =  round($jumlah_14 - $jumlah_15, -3);
			}
			else
			{
				$jumlah_16 = 0;
			}
			
			//perhitungan pajak berdasarkan lapisan (pph 1 tahun) 
			if ($jumlah_16 > 500000000)
			{
				$jumlah_17 = (($jumlah_16 - 500000000 ) * 0.3) + 95000000;
			}
			elseif ($jumlah_16 > 250000000)
			{
				$jumlah_17 =  (($jumlah_16 - 250000000) * 0.25) + 32500000;
			}
			elseif ($jumlah_16 > 50000000)
			{
				$jumlah_17 = (($jumlah_16 - 50000000)* 0.15) + 2500000;
			}
			else
			{
				$jumlah_17 = $jumlah_16 * 0.05; 
			}
			$jumlah_18 = 0; //pph massa sebelumnya
			
			$jumlah_19 = round(($jumlah_17/12),0); // pph 1 bulan
			// ---------------------------------------------------
		} while ($jumlah_2 <> $jumlah_19);
			
		$jumlah_19			=	floor( $jumlah_19 / 100 ) * 100;
		$tup 				= 	$jumlah_19;
					
		$pup				= 	$tup;
		
		$gt_kt 				= 	$gapok + $tun_tep;//$tuntep + $tpu ;
					
		$gt_kv				= 	$tun_jab + $tpp_pejabat + $tperwakilan + $tsmk + $tcli + $thadir + 
								$trumah + $twilayah + $tujt_pengemudi + $tkhusus + $tpo + $transport + 
								$tpp_staf + $tmk + $tpj + $tmpp;
							
		$gt_sl				= 	$tpk + $tpaskes + $tprumah + $tdplk + $tjamsostek + $BPJSK4 + $BPJSP2 + $tup;
							
		$gt_bruto 			= 	$gt_kt + $gt_kv + $gt_sl;
		
		$gt_potongan 		= 	$ppk + $ppaskes + $pprumah + 
								$pdplk + $pjamsostek + $BPJSK45 + $BPJSP3 + $pppns + $pppht + 
								$ptaspen_325 + $pdapen_475 + 
								$pwanaartha_190 + $pwanaartha_475 + $pup;
							
		$gt_total 			= 	round($gt_bruto,0) - round($gt_potongan,0);
		
		//$gaji_check 		= 	bulan ($dummy_bulan_tahun) . '-' . $p['npk'];
		//$gaji_check 		= 	sprintf('%0s', date('m')) . '-' . $p['npk'];
		$gaji_check 		= 	sprintf('%0s', date('m')) . '-' . $p['id'];
		//echo $gaji_check;exit;
?>
                        		<div style="padding-bottom:5px; ">								
									<div style="padding-bottom:5px; ">
										<table width="100%" cellpadding="0" cellspacing="0" border="0" class="stdtable" id="komponen" style="font-size:12px; ">
											<thead>
												<tr>
													<th colspan="4" style="text-align:center; font-size:12px; font-weight:bold; ">
														<?= $i ?><span style="float:right; "><?= $bulan_gaji_number . '-' . $p['id'] ?></span>
													</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td width="18%">BULAN | TAHUN</td>
													<td width="32%">
														<?= $bulan_gaji_text . ' | ' . $dtahun ?>
														<input type="hidden" name="gaji_id[]" value="<?= 'NULL' ?>" />
														<input type="hidden" name="gaji_karyawan_id[]" value="<?= $p['id'] ?>" />
														<input type="hidden" name="gaji_tahun[]" value="<?= $dtahun ?>" />
														<input type="hidden" name="gaji_semester[]" value="<?= $semester[$bulan_gaji_number] ?>" />
														<input type="hidden" name="gaji_triwulan[]" value="<?= $triwulan[$bulan_gaji_number] ?>" />
														<input type="hidden" name="gaji_bulan[]" value="<?= $bulan_gaji_number ?>" />
													</td>
													<td width="17%">STATUS | ANAK | TANGGUNGAN</td>
													<td width="33%">
														<?= $p['sta_per_uraian'] . ' | ' . $janak . ' | ' . $jtanggungan ?>
														<input type="hidden" name="gaji_status_personal[]" value="<?= $p['status_personal'] ?>" />
														<input type="hidden" name="gaji_anak[]" value="<?= $janak ?>" />
														<input type="hidden" name="gaji_tanggungan[]" value="<?= $jtanggungan ?>" />
													</td>
												</tr>
												<tr>
													<td>NAMA</td>
													<td>
														<?= Modules::run ('global/gelar/karyawan', $p['id'], 'nama'); ?>
														<input type="hidden" name="gaji_nama[]" value="<?= $p['nama'] ?>" />
														<input type="hidden" name="gaji_parent_id[]" value="<?= Modules::run('global/gaji/get_atasan_id', $p['npk']) ?>" />
													</td>
													<td>NOMOR BPJS</td>
													<td><?= $p['id_bpjs_ketenagakerjaan'] ?><input type="hidden" name="gaji_id_bpjs_ketenagakerjaan[]" value="<?= $p['id_bpjs_ketenagakerjaan'] ?>" /></td>
												</tr>
												<tr>
													<td>STATUS KEPEGWAIAN</td>
													<td><?= $p['sta_kepeg_full_name'] ?><input type="hidden" name="gaji_status_kepegawaian[]" value="<?= $p['status_kepegawaian'] ?>" /></td>
													<td>NOMOR NPWP</td>
													<td><?= $p['id_npwp'] ?><input type="hidden" name="gaji_id_npwp[]" value="<?= $p['id_npwp'] ?>" /></td>
												</tr>
												<tr>
													<td>I D | N P K</td>
													<td>
														<?= $p['id'] . ' | ' . $p['npk_baru'] ?>
														<input type="hidden" name="gaji_npk[]" value="<?= $p['npk_baru'] ?>" />
														<input type="hidden" name="gaji_check[]" value="<?= $bulan_gaji_number . '-' . $p['id'] ?>" />
													</td>
													<td>DIVISI</td>
													<td>
														<?= $p['div_nama_lengkap'] ?>
														<input type="hidden" name="gaji_divisi[]" value="<?= $p['karyawan_divisi'] ?>" />
													</td>
												</tr>
												<tr>
													<td>JENJANG | PANGKAT/GOLONGAN</td>
													<td>
														<?= $jenjang[$p['jenjang']] . ' | ' . 
															$golongan[$p['golongan']] . ' (' . strtoupper($pangkat[$p['golongan']]) . ')' ?>
														<input type="hidden" name="gaji_jenjang[]" value="<?= $p['jenjang'] ?>" />
														<input type="hidden" name="gaji_golongan[]" value="<?= $p['golongan'] ?>" />
														
													</td>
													<td>SATUAN</td>
													<td>
														<?= $p['sat_nama_lengkap'] ?>
														<input type="hidden" name="gaji_satuan[]" value="<?= $p['karyawan_satuan'] ?>" />
													</td>
												</tr>
												<tr>
													<td>JABATAN</td>
													<td rowspan="2" style="vertical-align:text-top; ">
														<?= $p['jabatan'] ?>
														<input type="hidden" name="gaji_jabatan[]" value="<?= $p['id_jabatan'] ?>" />
														<input type="hidden" name="gaji_gol_yad[]" value="<?= $p['tmt_gol_yad'] ?>" />
														<input type="hidden" name="gaji_berkala_yad[]" value="<?= $p['tmt_berkala_yad'] ?>" />
														<input type="hidden" name="gaji_purna_tugas[]" value="<?= $p['tmt_purna_tugas'] ?>" />
														<input type="hidden" name="gaji_status_karyawan[]" value="<?= $p['status_karyawan'] ?>" />
													</td>
													<td>AREA</td>
													<td rowspan="2" style="vertical-align:text-top; ">
														<?= $p['area_nama_lengkap'] ?>
														<input type="hidden" name="gaji_area[]" value="<?= $p['karyawan_area'] ?>" />
														<input type="hidden" name="gaji_wilayah[]" value="<?= $p['karyawan_wilayah'] ?>" />
													</td>
												</tr>
												<tr>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
												</tr>
											</tbody>
										</table>
									</div>
									<div style="float:left; width:50%; display:none; ">
										<div class="progress">
											<div class="bar2"><div class="value orangebar" style="width: 86%;">Storage (86%)</div></div>
										</div>
									</div>
									<div style="text-align:center; padding-bottom:5px; ">
										<input type="submit" name="<?= $lsubmit ?>" class="submit radius2" value="<?= $is_ulang ?>" />
									</div>	
									<table width="100%" cellpadding="0" cellspacing="0" border="0" class="stdtable" id="komponen" style="font-size:12px; height:10px; line-height:10px; ">
										<thead>
											<tr>
												<th<?= $center_align ?> width="10%">REKENING</th>
												<th<?= $center_align ?>>URAIAN</th>
												<th colspan="3"<?= $center_align ?>><?= $i ?></th>
												<th<?= $center_align ?> width="12%">NOMINAL</th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th<?= $center_align ?>>REKENING</th>
												<th<?= $center_align ?>>URAIAN</th>
												<th colspan="3"<?= $center_align ?>><?= $i ?></th>
												<th<?= $center_align ?>>NOMINAL</th>
											</tr>
										</tfoot>
										<tbody>
											<tr class="gradeA">
												<td align="center">0</td>
												<td><?= $lu[0] ?></td>
												<td width="10%" class="nominal">&nbsp;</td>
												<td width="10%" class="nominal"></td>
												<td width="10%" class="nominal right"></td>
												<td class="nominal right">&nbsp;</td>
											</tr>
											<tr class="gradeA">
												<td align="center">1</td>
												<td><?= $lu[1] ?></td>
												<td class="nominal">&nbsp;</td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right">
													<input type="hidden" name="gaji_kt_gapok[]" class="ra" value="<?= $gapok ?>" />
													<?= number_format($gapok, 0, '', '.') ?>
												</td>
											</tr>
											<tr class="gradeA">
												<td align="center">2</td>
												<td><?= $lu[2] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right">
													<input type="hidden" name="gaji_kt_gapok_pns[]" class="ra" value="<?= $gapok_pns ?>" />
													<?= number_format($gapok_pns, 0, '', '.') ?>
												</td>
												<td class="nominal right"></td>
											</tr>
											<tr class="gradeA">
												<td align="center">3</td>
												<td><?= $lu[3] ?></td>
												<td class="nominal"></td>
												<td class="nominal"><?= $p['mkk'] ?></td>
												<td class="nominal right">
													<input type="hidden" name="gaji_kt_gapok_pht[]" class="ra"  value="<?= $gapok_pht ?>"/>
													<?= number_format($gapok_pht, 0, '', '.') ?>
												</td>
												<td class="nominal right"></td>
											</tr>
											<tr class="gradeA">
												<td align="center">4</td>
												<td><?= $lu[4] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right">
													<input type="hidden" name="gaji_kt_gapok_umpp[]" class="ra" value="<?= $gapok_umpp ?>" />
													<input type="hidden" name="gaji_kt_gapok_umkk[]" class="ra" value="<?= 0 ?>" />
													<?= number_format($gapok_umpp, 0, '', '.') ?>
												</td>
												<td class="nominal right"></td>
											</tr>
											<tr class="gradeA">
												<td align="center">5</td>
												<td><?= $lu[5] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right">
													<input type="hidden" name="gaji_kt_gapok_paket[]" class="ra" value="<?= $gaji_paket ?>" />
													<?= number_format($gaji_paket, 0, '', '.') ?>
												</td>
												<td class="nominal right"></td>
											</tr>
											<tr class="gradeA">
												<td align="center">6</td>
												<td><?= $lu[6] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right">
													<input type="hidden" name="gaji_kt_tuntep[]" class="ra" value="<?= $tun_tep ?>" />
													<?= number_format($tun_tep, 0, '', '.') ?>
												</td>
											</tr>
											<tr class="gradeA" style="background:#CCC; ">
												<td align="center">7</td>
												<td><?= $lu[7] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right" style="font-weight:bold; ">
													<input type="hidden" name="gaji_jumlah_kt[]" class="rab" value="<?= $jumlah_kt ?>" />
													<?= number_format($jumlah_kt, 0, '', '.') ?>
												</td>
											</tr>
											<tr class="gradeA">
												<td align="center">8</td>
												<td><?= $lu[8] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right"></td>
											</tr>
											<tr class="gradeA">
												<td align="center">9</td>
												<td><?= $lu[9] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right">&nbsp;</td>
											</tr>
											<tr class="gradeA">
												<td align="center">10</td>
												<td><?= $lu[10] ?></td>
												<td class="nominal">&nbsp;</td>
												<td class="nominal">&nbsp;</td>
												<td class="nominal right">&nbsp;</td>
												<td class="nominal right">
													<input type="hidden" name="gaji_kv_ajabatan[]" class="ra" value="<?= $tun_jab+$tpp_pejabat+$tperwakilan ?>" />
													<?= number_format($tun_jab+$tpp_pejabat+$tperwakilan, 0, '', '.') ?>
												</td>
											</tr>
											<tr class="gradeA">
												<td align="center">11</td>
												<td><?= $lu[11] ?></td>
												<td class="nominal"><input type="hidden" name="gaji_kv_pjabatan[]" class="ra" value="<?= 0 ?>" /><?= 0 ?></td>
												<td class="nominal"><input type="hidden" name="gaji_kv_ajabatan[]" class="ra" value="<?= 0 ?>" /><?= 0 ?></td>
												<td class="nominal right">
													<input type="hidden" name="gaji_kv_tunjab[]" class="ra" value="<?= $tun_jab ?>" />
													<?= number_format($tun_jab, 0, '', '.') ?>
												</td>
												<td class="nominal right">&nbsp;</td>
											</tr>
											<tr class="gradeA">
												<td align="center">12</td>
												<td><?= $lu[12] ?>													<br /></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right">
													<input type="hidden" name="gaji_kv_tpp_pejabat[]" class="ra" value="<?= $tpp_pejabat ?>" />
													<?= number_format($tpp_pejabat, 0, '', '.') ?>
												</td>
												<td class="nominal right">&nbsp;</td>
											</tr>
											<tr class="gradeA">
												<td align="center">13</td>
												<td><?= $lu[13] ?></td>
												<td class="nominal"><?= $arperwakilan[$p['t_perwakilan']] ?></td>
												<td class="nominal">
													<?php 
														if(in_array($p['t_perwakilan'], array(2,3)))
														{
															$z = explode('|', $p['npk_perwakilan']);
															echo Modules::run('getfunction/get_nama_from_id', $z[0]);
														}
														else
														{
															echo '';
														}
													?>
												</td>
												<td class="nominal right">
													<input type="hidden" name="gaji_kv_tperwakilan[]" class="ra" value="<?= $tperwakilan ?>" />
													<?= number_format($tperwakilan, 0, '', '.') ?>
												</td>
												<td class="nominal right">&nbsp;</td>
											</tr>
											<tr class="gradeA">
												<td align="center">14</td>
												<td><?= $lu[14] ?></td>
												<td class="nominal">&nbsp;</td>
												<td class="nominal">&nbsp;</td>
												<td class="nominal right"></td>
												<td class="nominal right">
													<input type="hidden" name="gaji_kv_f_tpp[]" class="ra" value="<?= $tpp_staf ?>" />
													<?= number_format($tpp_staf, 0, '', '.') ?>
												</td>
											</tr>
											<tr class="gradeA">
												<td align="center">15</td>
												<td><?= $lu[15] ?></td>
												<td class="nominal">&nbsp;</td>
												<td class="nominal">&nbsp;</td>
												<td class="nominal right"></td>
												<td class="nominal right">&nbsp;</td>
											</tr>
											<tr class="gradeA" style="background:#FC9; ">
												<td align="center">16</td>
												<td><?= $lu[16] ?></td>
												<td class="nominal"><input type="hidden" name="gaji_kv_psmk[]" class="ra" value="<?= 0 ?>" /><?= 0 ?></td>
												<td class="nominal"><input type="hidden" name="gaji_kv_bobotjenjang[]" class="ra" value="<?= 0 ?>" /><?= 0 ?></td>
												<td class="nominal right"></td>
												<td class="nominal right">
													<input type="hidden" name="gaji_kv_asmk[]" class="ra" value="<?= $tsmk ?>" />
													<?= number_format($tsmk, 0, '', '.') ?>
												</td>
											</tr>
											<tr class="gradeA" style="background:#FC9; ">
												<td align="center">17</td>
												<td><?= $lu[17] ?></td>
												<td class="nominal"><input type="hidden" name="gaji_kv_pkompetensi[]" class="ra" value="<?= 0 ?>" /><?= 0 ?></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right">
													<input type="hidden" name="gaji_kv_akompetensi[]" class="ra" value="<?= $tcli ?>" />
													<?= number_format($tcli, 0, '', '.') ?>
												</td>
											</tr>
											<tr class="gradeA">
												<td align="center">18</td>
												<td><?= $lu[18] ?></td>
												<td class="nominal"><input type="hidden" name="gaji_kv_phadir[]" class="ra" value="<?= 0 ?>" /><?= 0 ?></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right">
													<input type="hidden" name="gaji_kv_ahadir[]" class="ra" value="<?= $thadir ?>" />
													<?= number_format($thadir, 0, '', '.') ?>
												</td>
											</tr>
											<tr class="gradeA">
												<td align="center">19</td>
												<td><?= $lu[19] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right">&nbsp;</td>
											</tr>
											<tr class="gradeA">
												<td align="center">20</td>
												<td><?= $lu[20] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right">
													<input type="hidden" name="gaji_kv_f_trumah[]" class="ra" value="<?= $trumah ?>" />
													<?= number_format($trumah, 0, '', '.') ?>
												</td>
											</tr>
											<tr class="gradeA">
												<td align="center">21</td>
												<td><?= $lu[21] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right">
													<input type="hidden" name="gaji_kv_f_twilayah[]" class="ra" value="<?= $twilayah ?>" />
													<?= number_format($twilayah, 0, '', '.') ?>
												</td>
											</tr>
											<tr class="gradeA">
												<td align="center">22</td>
												<td><?= $lu[22] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right">
													<input type="hidden" name="gaji_kv_f_ujtpengemudi[]" class="ra" value="<?= $tujt_pengemudi ?>" />
													<?= number_format($tujt_pengemudi, 0, '', '.') ?>
												</td>
											</tr>
											<tr class="gradeA">
												<td align="center">23</td>
												<td><?= $lu[23] ?></td>
												<td class="nominal"><input type="hidden" name="gaji_kv_f_telepon[]" class="ra" value="<?= 'NULL' ?>" /><?= 'NULL' ?></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right">
													<input type="hidden" name="gaji_kv_f_trepresentatif[]" class="ra" value="<?= $tkhusus ?>" />
													<?= number_format($tkhusus, 0, '', '.') ?>
												</td>
											</tr>
											<tr class="gradeA">
												<td align="center">24</td>
												<td><?= $lu[24] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right">
													<input type="hidden" name="gaji_kv_f_pengobatan[]" class="ra" value="<?= $tpo ?>" />
													<?= number_format($tpo, 0, '', '.') ?>
												</td>
											</tr>
											<tr class="gradeA">
												<td align="center">25</td>
												<td><?= $lu[25] ?></td>
												<td class="nominal">&nbsp;</td>
												<td class="nominal">&nbsp;</td>
												<td class="nominal right"></td>
												<td class="nominal right">
													<input type="hidden" name="gaji_kv_f_transport[]" class="ra" value="<?= $transport ?>" />
													<?= number_format($transport, 0, '', '.') ?>
												</td>
											</tr>
											<tr class="gradeA">
												<td align="center">26</td>
												<td><?= $lu[26] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right">
													<input type="hidden" name="gaji_kv_f_tpj[]" class="ra" value="<?= $tpj ?>" />
													<?= number_format($tpj, 0, '', '.') ?>
												</td>
											</tr>
											<tr class="gradeA">
												<td align="center">27</td>
												<td><?= $lu[27] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right">
													<input type="hidden" name="gaji_kv_f_tmpp[]" class="ra" value="<?= $tmpp ?>" />
													<?= number_format($tmpp, 0, '', '.') ?>
												</td>
											</tr>
											<tr class="gradeA" style="background:#CCC; ">
												<td align="center">28</td>
												<td><?= $lu[28] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right" style="font-weight:bold; ">
													<input type="hidden" name="gaji_jumlah_kv[]" class="rab"  value="<?= $gt_kv ?>"/>
													<?= number_format($gt_kv, 0, '', '.') ?>
												</td>
											</tr>
											<tr class="gradeA">
												<td align="center">29</td>
												<td><?= $lu[29] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right"></td>
											</tr>
											<tr class="gradeA">
												<td align="center">30</td>
												<td><?= $lu[30] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right">
													<input type="hidden" name="gaji_sl_tpkerja_12p[]" class="ra" value="<?= $tpk ?>" />
													<?= number_format($tpk, 0, '', '.') ?>
												</td>
											</tr>
											<tr class="gradeA">
												<td align="center">31</td>
												<td><?= $lu[31] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right">
													<input type="hidden" name="gaji_sl_tpaskes_10p[]" class="ra" value="<?= $tpaskes ?>" />
													<?= number_format($tpaskes, 0, '', '.') ?>
												</td>
											</tr>
											<tr class="gradeA">
												<td align="center">32</td>
												<td><?= $lu[32] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right">
													<input type="hidden" name="gaji_sl_tprumah_2p[]" class="ra" value="<?= $tprumah ?>" />
													<?= number_format($tprumah, 0, '', '.') ?>
												</td>
											</tr>
											<tr class="gradeA">
												<td align="center">33</td>
												<td><?= $lu[33] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right">
													<input type="hidden" name="gaji_sl_tdplk[]" class="ra" value="<?= $tdplk ?>" />
													<?= number_format($tdplk, 0, '', '.') ?>
												</td>
											</tr>
											<tr class="gradeA" style="background:#FC9; ">
												<td align="center">34</td>
												<td><?= $lu[34] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right"></td>
											</tr>
											<tr class="gradeA" style="background:#FC9; ">
												<td align="center">35</td>
												<td><?= $lu[35] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right">
													<input type="hidden" name="gaji_sl_tjamsostek_489p[]" class="ra" value="<?= $tjamsostek ?>" />
													<?= number_format($tjamsostek, 0, '', '.') ?>
												</td>
											</tr>
											<tr class="gradeA" style="background:#FC9; ">
												<td align="center">36</td>
												<td><?= $lu[36] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right">
													<input type="hidden" name="gaji_sl_tjpsehat_6p[]" value="<?= $BPJSK4 ?>" class="ra" />
													<?= number_format($BPJSK4, 0, '', '.') ?>
												</td>
											</tr>
											<tr class="gradeA" style="background:#FC9; ">
												<td align="center">37</td>
												<td><?= $lu[37] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right">
													<input type="hidden" name="gaji_sl_tjpsehat_3p[]" value="<?= $BPJSP2 ?>" class="ra" />
													<?= number_format($BPJSP2, 0, '', '.') ?>
												</td>
											</tr>
											<tr class="gradeA">
												<td align="center">38</td>
												<td><?= $lu[38] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right">
													<input type="hidden" name="gaji_sl_tup[]" value="<?= $tup ?>" class="ra" />
													<?= number_format($tup, 0, '', '.') ?>
												</td>
											</tr>
											<tr class="gradeA" style="background:#CCC; ">
												<td align="center">39</td>
												<td><?= $lu[39] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right" style="font-weight:bold; ">
													<input type="hidden" name="gaji_jumlah_sl[]" value="<?= $gt_sl ?>" class="rab" />
													<?= number_format($gt_sl, 0, '', '.') ?>
												</td>
											</tr>
											<tr class="gradeA" style="background:#CC9; ">
												<td align="center">40</td>
												<td><?= $lu[40] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right" style="font-weight:bold; ">
													<input type="hidden" name="gaji_jumlah_bruto[]" value="<?= $gt_bruto ?>" class="rab" />
													<?= number_format($gt_bruto, 0, '', '.') ?>
												</td>
											</tr>
											<tr class="gradeA">
												<td align="center">41</td>
												<td><?= $lu[41] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right"></td>
											</tr>
											<tr class="gradeA">
												<td align="center">42</td>
												<td><?= $lu[42] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right">
													<input type="hidden" name="gaji_pot_ipkerja_12p[]" value="<?= $ppk ?>" class="ra" />
													<?= number_format($ppk, 0, '', '.') ?>
												</td>
											</tr>
											<tr class="gradeA">
												<td align="center">43</td>
												<td><?= $lu[43] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right">
													<input type="hidden" name="gaji_pot_ipsehat_10p[]" value="<?= $ppaskes ?>" class="ra" />
													<?= number_format($ppaskes, 0, '', '.') ?>
												</td>
											</tr>
											<tr class="gradeA">
												<td align="center">44</td>
												<td><?= $lu[44] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right">
													<input type="hidden" name="gaji_pot_iprumah_2p[]" value="<?= $pprumah ?>" class="ra" />
													<?= number_format($pprumah, 0, '', '.') ?>
												</td>
											</tr>
											<tr class="gradeA">
												<td align="center">45</td>
												<td><?= $lu[45] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right">
													<input type="hidden" name="gaji_pot_idplk[]" value="<?= $pdplk ?>" class="ra" />
													<?= number_format($pdplk, 0, '', '.') ?>
												</td>
											</tr>
											<tr class="gradeA" style="background:#FC9; ">
												<td align="center">46</td>
												<td><?= $lu[46] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right"></td>
											</tr>
											<tr class="gradeA" style="background:#FC9; ">
												<td align="center">47</td>
												<td><?= $lu[47] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right">
													<input type="hidden" name="gaji_pot_ijamsostek_689p[]" value="<?= $pjamsostek ?>" class="ra" />
													<?= number_format($pjamsostek, 0, '', '.') ?>
												</td>
											</tr>
											<tr class="gradeA" style="background:#FC9; ">
												<td align="center">48</td>
												<td><?= $lu[48] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right">
													<input type="hidden" name="gaji_pot_ijpk_6p[]" value="<?= $BPJSK45 ?>" class="ra" />
													<?= number_format($BPJSK45, 0, '', '.') ?>
												</td>
											</tr>
											<tr class="gradeA" style="background:#FC9; ">
												<td align="center">49</td>
												<td><?= $lu[49] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right">
													<input type="hidden" name="gaji_pot_ijpk_3p[]" value="<?= $BPJSP3 ?>" class="ra" />
													<?= number_format($BPJSP3, 0, '', '.') ?>
												</td>
											</tr>
											<tr class="gradeA">
												<td align="center">50</td>
												<td><?= $lu[50] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right">
													<input type="hidden" name="gaji_pot_ippns_5p[]" value="<?= $pppns ?>" class="ra" />
												<?= number_format($pppns, 0, '', '.') ?></td>
											</tr>
											<tr class="gradeA">
												<td align="center">51</td>
												<td><?= $lu[51] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right">
													<input type="hidden" name="gaji_pot_ippht_5p[]" value="<?= $pppht ?>" class="ra" />
												<?= number_format($pppht, 0, '', '.') ?></td>
											</tr>
											<tr class="gradeA">
												<td align="center">52</td>
												<td><?= $lu[52] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right">
													<input type="hidden" name="gaji_pot_itaspen_325p[]" value="<?= $ptaspen_325 ?>" class="ra" />
												<?= number_format($ptaspen_325, 0, '', '.') ?></td>
											</tr>
											<tr class="gradeA">
												<td align="center">53</td>
												<td><?= $lu[53] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right">
													<input type="hidden" name="gaji_pot_idapen_475p[]" value="<?= $pdapen_475 ?>" class="ra" />
												<?= number_format($pdapen_475, 0, '', '.') ?></td>
											</tr>
											<tr class="gradeA">
												<td align="center">54</td>
												<td><?= $lu[54] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right"></td>
											</tr>
											<tr class="gradeA">
												<td align="center">55</td>
												<td><?= $lu[55] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right">
													<input type="hidden" name="gaji_pot_iwanartha190p[]" value="<?= $pwanaartha_190 ?>" class="ra" />
												<?= number_format($pwanaartha_190, 0, '', '.') ?></td>
											</tr>
											<tr class="gradeA">
												<td align="center">56</td>
												<td><?= $lu[56] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right">
													<input type="hidden" name="gaji_pot_iwanartha475p[]" value="<?= $pwanaartha_475 ?>" class="ra" />
													<?= number_format($pwanaartha_475, 0, '', '.') ?>
												</td>
											</tr>
											<tr class="gradeA">
												<td align="center">57</td>
												<td><?= $lu[57] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right">
													<input type="hidden" name="gaji_pot_iup[]" value="<?= $pup ?>" class="ra" />
												<?= number_format($pup, 0, '', '.') ?></td>
											</tr>
											<tr class="gradeA" style="background:#CC9; ">
												<td align="center">58</td>
												<td><?= $lu[58] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right" style="font-weight:bold; ">
													<input type="hidden" name="gaji_jumlah_pot[]" value="<?= $gt_potongan ?>" class="rab" />
													<?= number_format($gt_potongan, 0, '', '.') ?>
												</td>
											</tr>
											<tr class="gradeA" style="background:#CC0; ">
												<td align="center">59</td>
												<td><?= $lu[59] ?></td>
												<td class="nominal"></td>
												<td class="nominal"></td>
												<td class="nominal right"></td>
												<td class="nominal right" style="font-weight:bold; ">
													<input type="hidden" name="gaji_jumlah_netto[]" value="<?= $gt_total ?>" class="rab" />
													<?= number_format($gt_total, 0, '', '.') ?>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
								<!-- AWAL CEK BPJS -->
								<table width="100%" class="stdtable" style="font-size:8px; font-weight:bold; ">
									<thead>
										<tr>
											<th rowspan="2" style="text-align:center; ">NPK</th>
											<th rowspan="2" style="text-align:center; ">NETTO - SMK</th>
											<th colspan="2" style="text-align:center; ">KETENAGAKERJAAN</th>
											<th colspan="2" style="text-align:center; ">KESEHATAN</th>
											<th colspan="2" style="text-align:center; ">PENSIUN</th>
											<th rowspan="2" style="text-align:center; ">PEMBERI<br />KERJA</th>
											<th rowspan="2" style="text-align:center; ">KT</th>
											<th rowspan="2" style="text-align:center; ">KV</th>
											<th rowspan="2" style="text-align:center; ">SL</th>
											<th rowspan="2" style="text-align:center; ">BRUTO</th>
											<th rowspan="2" style="text-align:center; ">POTONGAN</th>
											<th rowspan="2" style="text-align:center; ">NETTO</th>
										</tr>
										<tr>
											<th style="text-align:center; ">4,89%</th>
											<th style="text-align:center; ">6,89%</th>
											<th style="text-align:center; ">4%</th>
											<th style="text-align:center; ">5%</th>
											<th style="text-align:center; ">2%</th>
											<th style="text-align:center; ">3%</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td style="font-weight:bold; "><?= $p['npk'] ?></td>
											<td style="font-weight:bold; ">
												<? $p['nama'] . 
													( (! empty($p['gelar_depan']))?Modules::run ('global/getfunction/ekstrak_gelar', 'depan', $p['gelar_depan']):'' ) . 
													( (! empty($p['gelar_belakang']))?Modules::run ('global/getfunction/ekstrak_gelar', 'belakang', $p['gelar_belakang']):'' )
												?>
												<?= number_format($gt_total - $tsmk, 0, '', '.') ?>
											</td>
											<td align="right" style="font-weight:bold; "><?= number_format($tjamsostek, 0, '', '.') ?></td>
											<td align="right" style="font-weight:bold; "><?= number_format($pjamsostek, 0, '', '.') ?></td>
											<td align="right" style="font-weight:bold; "><?= number_format($BPJSK4, 0, '', '.') ?></td>
											<td align="right" style="font-weight:bold; "><?= number_format($BPJSK45, 0, '', '.') ?></td>
											<td align="right" style="font-weight:bold; "><?= number_format($BPJSP2, 0, '', '.') ?></td>
											<td align="right" style="font-weight:bold; "><?= number_format($BPJSP3, 0, '', '.') ?></td>
											<td align="right" style="font-weight:bold; "><?= number_format($tpk, 0, '', '.') ?></td>
											<td align="right" style="font-weight:bold; "><?= number_format($gt_kt, 0, '', '.') ?></td>
											<td align="right" style="font-weight:bold; "><?= number_format($gt_kv, 0, '', '.') ?></td>
											<td align="right" style="font-weight:bold; "><?= number_format($gt_sl, 0, '', '.') ?></td>
											<td align="right" style="font-weight:bold; "><?= number_format($gt_bruto, 0, '', '.') ?></td>
											<td align="right" style="font-weight:bold; "><?= number_format($gt_potongan, 0, '', '.') ?></td>
											<td align="right" style="font-weight:bold; "><?= number_format($gt_total, 0, '', '.') ?></td>
										</tr>
									</tbody>
								</table>
								<!-- AKHIR CEK BPJS -->
<?php
		$dummy_pajak_nomor_bukti_potong 	= '1.1-2-14-' . sprintf("%1$07d", $i);
		$arr_dummy_pajak_nomor_bukti_potong = explode('-', $dummy_pajak_nomor_bukti_potong);
?>
								<input type="hidden" name="pajak_jk[]" value="<?= $jk_pajak ?>" class="rab" />
								<input type="hidden" name="pajak_status_ptkp[]" value="<?= $status_ptkp ?>" class="rab" />
								<input type="hidden" name="pajak_tanggungan_ptkp[]" value="<?= $tanggungan_ptkp ?>" class="rab" />
								<input type="hidden" name="pajak_wp_luar_negeri[]" value="<?= 'N' ?>" class="rab" />
								<input type="hidden" name="pajak_kode_negara[]" value="<?= 'IDN' ?>" class="rab" />
								<input type="hidden" name="pajak_masa[]" value="<?= getNextMonth(date("Y-m-d"), 'm') ?>" class="rab" />
								<input type="hidden" name="pajak_tahun[]" value="<?= $dtahun ?>" class="rab" />
								<input type="hidden" name="pajak_pembetulan[]" value="<?= 0 ?>" class="rab" />
								<input type="hidden" name="pajak_nomor_bukti_potong[]" value="<?= $dummy_pajak_nomor_bukti_potong ?>" class="rab" />
								<input type="hidden" name="pajak_masa_perolehan_awal[]" value="<?= substr($dummy_pajak_nomor_bukti_potong,2,1) ?>" class="rab" />
								<input type="hidden" name="pajak_masa_perolehan_akhir[]" value="<?= $arr_dummy_pajak_nomor_bukti_potong[1] ?>" class="rab" />
								<input type="hidden" name="pajak_kode[]" value="<?= '21-100-01' ?>" class="rab" />
								<input type="hidden" name="pajak_jumlah_1[]" value="<?= $jumlah_1 ?>" class="rab" />
								<input type="hidden" name="pajak_jumlah_2[]" value="<?= $jumlah_2 ?>" class="rab" />
								<input type="hidden" name="pajak_jumlah_3[]" value="<?= $jumlah_3 ?>" class="rab" />
								<input type="hidden" name="pajak_jumlah_4[]" value="<?= $jumlah_4 ?>" class="rab" />
								<input type="hidden" name="pajak_jumlah_5[]" value="<?= $jumlah_5 ?>" class="rab" />
								<input type="hidden" name="pajak_jumlah_6[]" value="<?= $jumlah_6 ?>" class="rab" />
								<input type="hidden" name="pajak_jumlah_7[]" value="<?= $jumlah_7 ?>" class="rab" />
								<input type="hidden" name="pajak_jumlah_8[]" value="<?= $jumlah_8 ?>" class="rab" />
								<input type="hidden" name="pajak_jumlah_9[]" value="<?= $jumlah_9 ?>" class="rab" />
								<input type="hidden" name="pajak_jumlah_10[]" value="<?= $jumlah_10 ?>" class="rab" />
								<input type="hidden" name="pajak_jumlah_11[]" value="<?= $jumlah_11 ?>" class="rab" />
								<input type="hidden" name="pajak_jumlah_12[]" value="<?= $jumlah_12 ?>" class="rab" />
								<input type="hidden" name="pajak_jumlah_13[]" value="<?= $jumlah_13 ?>" class="rab" />
								<input type="hidden" name="pajak_jumlah_14[]" value="<?= $jumlah_14 ?>" class="rab" />
								<input type="hidden" name="pajak_jumlah_15[]" value="<?= $jumlah_15 ?>" class="rab" />
								<input type="hidden" name="pajak_jumlah_16[]" value="<?= $jumlah_16 ?>" class="rab" />
								<input type="hidden" name="pajak_jumlah_17[]" value="<?= $jumlah_17 ?>" class="rab" />
								<input type="hidden" name="pajak_jumlah_18[]" value="<?= $jumlah_18 ?>" class="rab" />
								<input type="hidden" name="pajak_jumlah_19[]" value="<?= $jumlah_19 ?>" class="rab" />
								<input type="hidden" name="pajak_jumlah_20[]" value="<?= 0 ?>" class="rab" />
								<input type="hidden" name="pajak_status_pindah[]" value="<?= 0 ?>" class="rab" />
								<input type="hidden" name="pajak_tanggal_slip[]" value="<?= '01/'. getNextMonth(date("Y-m-d"), 'm') . '/'. $dtahun ?>" class="rab" />
								<input type="hidden" name="gaji_keterangan[]" value="<?= '' ?>" class="rab" />
								<hr />
<?php
		$i++;
	}
?>
								<div style="text-align:center; ">
									<input type="submit" name="submit" class="submit radius2" value="<?= $is_ulang ?>" />
								</div>							
							</form>
                    </div>
					<p id="back-top">
						<a href="#top"><span></span>Kembali ke Atas</a>
					</p>
                </div><!--contentwrapper-->
                <br clear="all" />
			</div><!-- centercontent -->
			<script type="text/javascript">
				jQuery("#komponen td").css("padding", "2px 10px");
				jQuery(".nominal").css("text-align", "right");
				
				//jQuery(document).scrollTop( jQuery("#aktif_url").offset().top );
				// hide #back-top first
				jQuery("#back-top").hide();
				
				// fade in #back-top
				jQuery(function () {
					jQuery(window).scroll(function () {
						if (jQuery(this).scrollTop() > 100) {
							jQuery('#back-top').fadeIn();
						} else {
							jQuery('#back-top').fadeOut();
						}
					});
			
					// scroll body to 0px on click
					jQuery('#back-top a').click(function () {
						jQuery('body,html').animate({
							scrollTop: 0
						}, 800);
						return false;
					});
				});
			</script>
<?php echo Modules::run($type_user . '/templates/amanda', 'footer'); ?>
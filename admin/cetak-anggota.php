<?php
session_start();
include_once 'includes/class.php';

$ad = new Librarian(); // instansiasi obj
$admin = $ad->get_sessi(); // get session

if ( ! $admin ) {
    header( 'location:login.php' );
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title></title>
    <!-- CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
    <style>
		.print-data-member .data-member {
			float: left;
			width: 100%;
			font-family: arial;
			font-size: 12px;
		    border: 1px solid #ccc;
		    padding: 20px;
		}

		.print-data-member .data-member tr td {
			font-size: 12px;
			line-height: 20px;
		}

		.print-data-member .title-form {
			padding: 20px 0 0;
			font-family: arial;
		}

		.print-data-member .the-title {
			margin: 0;
			font-size: 25px;
			line-height: 40px;
			font-weight: bold;
		}

		.print-data-member .address {
			margin: 0;
			font-size: 14px;
			line-height: 22px;
			font-weight: bold;
		}

		.print-data-member .text-left {
			text-align: left;
		}

		.print-data-member .text-right {
			text-align: right;
		}

		.data-member table.top-area {
			margin-bottom: 25px;
		}

		button.noPrint {
			margin-top: 20px;
		}

		@media print {
			button.noPrint { 
				display: none;
			}
		}

		.clearfix {
			clear: both;
		}

		.ln_solid {
			margin: 20px 0;
			border-bottom: 1px solid #ccc;
		}
	</style>

</head>

<body>

	<?php

	require_once 'includes/functions.php';

	$mb = new Member();
	$mymember = $mb->get_data_member_by_id( $_GET['id'] );
	$data = $mymember->fetch( PDO::FETCH_ASSOC ); 

	date_default_timezone_set( "Asia/Jakarta" ); // time zone
	$this_day = date( 'Y-m-d' );

	?>

		<table class="print-data-member" align="center" border="0" width="65%">
			<tbody>
				<tr>
					<td>

						<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
						<!--DWLayoutTable-->
							<tbody>
								<tr> 
									<td class="borderbawah" height="26"> 
										<div align="center">
											<div class="title-form">
											<h1 class="the-title">Perpustakaan Nusantara</h1>
											<h2 class="address">Jl. Mawar Berduri No. 31 Blok D2 Cengkareng, Jakarta Barat. No Telepon 089123111211. Email : arman@gmail.com</h2><br>
											</div>
										</div>
									</td>
									<td></td>
								</tr>
								<tr> 
									<td></td>
								</tr>
							</tbody>
						</table>

						<div class="data-member">
							<div class="row" style="padding: 20px 0;">
								<div class="col-md-8 row-detail-member">
                                    <h3 style="margin:0; font-size: 18px;">Data Anggota Perpustakaan</h3>
                                </div>
                                <div class="col-md-4 row-detail-member text-right">
                                    <label class="control-label col-md-7" style="padding:0;">Date Join :</label>
                                    <label class="control-label col-md-5" style="padding:0;"><?php echo $data['tgl_pendaftaran']; ?></label>
                                </div>
                             </div>
							<div class="container-fluid well">       
                                <div class="row">
                                    <div class="col-md-12 row-detail-member">
                                        <label class="control-label col-md-4">Identitas</label>
                                        <label class="control-label col-md-8"><?php echo $data['jenis_identitas']; ?> / <?php echo $data['no_identitas']; ?></label>
                                    </div>

                                    <div class="col-md-12 row-detail-member">
                                        <label class="control-label col-md-4">Nama Lengkap</label>
                                        <label class="control-label col-md-8"><?php echo $data['nama_lengkap']; ?></label>
                                    </div>

                                    <div class="col-md-12 row-detail-member">
                                        <label class="control-label col-md-4">Jenis Kelamin</label>
                                        <label class="control-label col-md-8"><?php echo $data['jenis_kelamin']; ?></label>
                                    </div>

                                    <div class="col-md-12 row-detail-member">
                                        <label class="control-label col-md-4">No. Telepon</label>
                                        <label class="control-label col-md-8"><?php echo $data['no_telp']; ?></label>
                                    </div>

                                    <div class="col-md-12 row-detail-member">
                                        <label class="control-label col-md-4">Email</label>
                                        <label class="control-label col-md-8"><?php echo $data['email']; ?></label>
                                    </div>

                                    <div class="col-md-12 row-detail-member">
                                        <label class="control-label col-md-4">Alamat Asal</label>
                                        <label class="control-label col-md-8"><?php echo $data['alamat_asal']; ?></label>
                                    </div>

                                    <div class="col-md-12 row-detail-member">
                                        <label class="control-label col-md-4">Alamat/ Tempat Tinggal Saat Ini</label>
                                        <label class="control-label col-md-8"><?php echo $data['alamat_saat_ini']; ?></label>
                                    </div>

                                    <div class="col-md-12 row-detail-member">
                                        <label class="control-label col-md-4">Jenis Anggota</label>
                                        <label class="control-label col-md-8"><?php echo $data['jenis_anggota']; ?></label>
                                    </div>

                                    <div class="col-md-12 row-detail-member">
                                        <label class="control-label col-md-4">Nama Institusi</label>
                                        <label class="control-label col-md-8"><?php echo $data['nama_institusi']; ?></label>
                                    </div>

                                    <div class="col-md-12 row-detail-member">
                                        <label class="control-label col-md-4">Alamat Institusi</label>
                                        <label class="control-label col-md-8"><?php echo $data['alamat_institusi']; ?></label>
                                    </div>

                                    <div class="clearfix"></div>
                                    <div class="ln_solid"></div>
                                    
                                </div> <!-- END: Class row-->
                            </div>

						    <div class="info-bottom">
						    	Info fuck lorem fuck lorem fuck lorem fuck lorem fuck lorem fuck lorem fuck lorem fuck lorem fuck lorem fuck lorem fuck lorem fuck !!!
						    </div>
							<button class="noPrint btn btn-danger" type="button" onclick="window.print()"><i class="fa fa-print"></i> Cetak</button>
						</div><!-- END: data-member -->

					</td>
				</tr>
			</tbody>
		</table>
	</body>
</html>
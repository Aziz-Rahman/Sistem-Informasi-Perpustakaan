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
		.print-data-borrowing .data-borrowing {
			float: left;
			width: 100%;
			font-family: arial;
			font-size: 12px;
		    border: 1px solid #ccc;
		    padding: 20px;
		}

		.print-data-borrowing .data-borrowing tr td {
			font-size: 12px;
			line-height: 20px;
		}

		.print-data-borrowing .title-form {
			padding: 20px 0 0;
			font-family: arial;
		}

		.print-data-borrowing .the-title {
			margin: 0;
			font-size: 25px;
			line-height: 40px;
			font-weight: bold;
		}

		.print-data-borrowing .address {
			margin: 0;
			font-size: 14px;
			line-height: 22px;
			font-weight: bold;
		}

		.print-data-borrowing .text-left {
			text-align: left;
		}

		.print-data-borrowing .text-right {
			text-align: right;
		}

		.data-borrowing table.top-area {
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
	$bks = new Books();
	$brw = new Borrowing();
	$rtn = new Returning();

	$books = $bks->display_book();
	$borrowing = $brw->get_data_borrowing_by_id( $_GET['id'] );
	$returning_by_id_borrowing = $rtn->get_returning_by_borrowing_id( $_GET['id'] );

	$data = $borrowing->fetch( PDO::FETCH_ASSOC );
	$data_return = $returning_by_id_borrowing->fetch( PDO::FETCH_ASSOC ); 

	date_default_timezone_set( "Asia/Jakarta" ); // time zone
	$this_day = date( 'Y-m-d' );

	?>

		<table class="print-data-borrowing" align="center" border="0" width="65%">
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

						<div class="data-borrowing">
							<h3 style="font-size: 18px;">Data Peminjaman Buku</h3>
							<div class="container-fluid well">       
                                <div class="row">
                                    <div class="col-md-12 row-detail-borrowing">
                                        <label class="control-label col-md-4">ID Peminjaman</label>
                                        <label class="control-label col-md-8"><?php echo $data['id_peminjaman']; ?></label>
                                    </div>

                                    <div class="col-md-12 row-detail-borrowing">
                                        <label class="control-label col-md-4">Nama Peminjam</label>
                                        <label class="control-label col-md-8"><?php echo $data['nama_lengkap']; ?></label>
                                    </div>

                                    <div class="col-md-12 row-detail-borrowing">
                                        <label class="control-label col-md-4">Tanggal Pinjam</label>
                                        <label class="control-label col-md-8"><?php echo $data['tgl_pinjam']; ?></label>
                                    </div>

                                    <div class="col-md-12 row-detail-borrowing">
                                        <label class="control-label col-md-4">Tanggal Jatuh Tempo</label>
                                        <label class="control-label col-md-8"><?php echo $data['tgl_jatuh_tempo']; ?></label>
                                    </div>

                                    <?php if ( ! empty( $returning_by_id_borrowing->rowCount() ) ) : ?>
                                    	<div class="col-md-12 row-detail-borrowing">
	                                        <label class="control-label col-md-4">Tanggal Kembali</label>
	                                        <label class="control-label col-md-8"><?php echo $data_return['tgl_kembali']; ?></label>
	                                    </div>

                                        <div class="col-md-12 row-detail-borrowing">
                                            <label class="control-label col-md-4">Denda</label>
                                            <label class="control-label col-md-8">
                                                <?php echo $data_return['denda']; ?>
                                            </label>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="clearfix"></div>
                                    <div class="ln_solid"></div>

                                    <?php
                                    echo '<div class="col-md-12 row-detail-borrowing">';
                                    echo '<label class="control-label col-md-12">Buku Pinjaman</label>';
                                        // DISPLAY BOKKS BASED BORROWING_ID
                                        $detail_borrowing_by_id = $brw->get_detail_borrowing_by_borowing_id( $data['id_peminjaman'] );
                                        $no = 1;
                                        while( $thebooks = $detail_borrowing_by_id->fetch( PDO::FETCH_ASSOC ) ) :
                                            echo '<label class="control-label col-md-12">'. $no .'.&nbsp;'. $thebooks['buku_judul'] .'</label>';
                                            $no++;
                                        endwhile;
                                    echo '</div>';
                                    ?>
                                    
                                </div> <!-- END: Class row-->
                            </div>

						    <div class="info-bottom">
						    	Info fuck lorem fuck lorem fuck lorem fuck lorem fuck lorem fuck lorem fuck lorem fuck lorem fuck lorem fuck lorem fuck lorem fuck !!!
						    </div>
							<button class="noPrint btn btn-danger" type="button" onclick="window.print()"><i class="fa fa-print"></i> Cetak</button>
						</div><!-- END: data-borrowing -->

					</td>
				</tr>
			</tbody>
		</table>
	</body>
</html>
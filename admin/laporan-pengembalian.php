<?php
session_start();
include_once 'includes/functions.php';
include_once 'includes/class.php';
$ad = new Librarian(); // instansiasi obj
$admin = $ad->get_sessi(); // get session

if ( empty( $admin ) ) :
    header( 'location:login.php' );
else :

	$rtn = new Returning();

	if ( isset( $_POST['button_filter'] ) ) :
		$start_date = $_POST['start_date'];
		$str_year = substr( $start_date, 0, 4 );
		$str_mounth = substr( $start_date, 5, 2 );
		$str_date = substr( $start_date, 8 );
		$start_date_format = $str_date .'-'. $str_mounth .'-'. $str_year;
		$last_date = $_POST['last_date'];
		$lst_year = substr( $last_date, 0, 4 );
		$lst_mounth = substr( $last_date, 5, 2 );
		$lst_date = substr( $last_date, 8 );
		$last_date_format = $lst_date .'-'. $lst_mounth .'-'. $lst_year;
		$sql = $rtn->display_returning_filter_based_date( $start_date, $last_date );
	else :
		$sql = $rtn->display_returning();
		date_default_timezone_set("Asia/Jakarta");
		$report_to_date = date( 'd-m-Y' );
	endif;
	?>

	<!DOCTYPE html>
	<html lang="en">

	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="">
	    <meta name="author" content="">

		<!-- CSS -->
	    <link href="css/bootstrap.min.css" rel="stylesheet">
	    <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
	    <link href="css/bootstrap-datepicker.min.css" rel="stylesheet">
	    <style>
		    .right-area {
		    	text-align: right;
		    }
		    .right-area .btn {
		    	border-radius: 0;
		    }
			.form-control,
			.title-date {
				float: left;
				width: 50%;
				margin-right: 10px;
				border-radius: 0;
				line-height: 32px;
			}
			.title-label {
				float: left;
				margin-right: 10px;
				line-height: 32px;
			}
			.title-info {
				margin: 30px 0;
				text-align: center;
				font-size: 20px;
				font-weight: bold;
			}
			.title-info .range-date {
				font-size: 12px;
			} 
			.litle-column {
				width: 12%;
			}
			.clearfix {
				clear: both;
			}
			.report-returning table tbody {
				font-size: 12px;
			}
			.noPrint {
				float: left;
				width: 100%;
				padding-top: 20px;
				padding-bottom: 20px;
				border-bottom: 3px double #ccc;
				background: #f9f9f9;
			}
			.noPrint .form-group {
			    margin-bottom: 0;
			}
			@media print {
				.noPrint { 
					display: none;
				}
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="row">
			  	<div class="col-md-12 report-returning">
					<div class="table-responsive">
						<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" id="form_filter">
							<!-- START: .noPrint -->
							<div class="noPrint">
								<div class="col-md-4 left-area"> 
									<div class="form-group">
		                                <label class="title-label">Tanggal Awal :</label>
		                               <input type="text" name="start_date" id="start_date" class="datepicker form-control">
		                               <div class="clearfix"></div>
		                            </div>
								</div>

								<div class="col-md-4 center-area"> 
									<div class="form-group">
		                                <label class="title-label">Tanggal Akhir :</label>
		                               	<input type="text" name="last_date" id="last_date" class="datepicker form-control">
		                               	<div class="clearfix"></div>
		                            </div>
								</div>

								<div class="col-md-4 right-area">
									<input type="submit" name="button_filter" id="button_filter" class="btn btn-info" value="Filter" disabled="disabled">
									<input type="button" value="Cetak" class="btn btn-danger" onclick="window.print()">
									<div class="clearfix"></div>
								</div>
							</div>
							<!-- END: .noPrint -->

							<div class="col-md-12 title-info"><p>LAPORAN PENGEMBALIAN BUKU</p>
								<div class="range-date"> 
									<?php 
									if ( empty( $start_date_format ) ) :
										echo 'S/D '. $report_to_date; // print data s/d skrg
									else :
										echo isset( $start_date_format ) ? 'Tanggal : '. $start_date_format.' s/d ' : '';
										echo isset( $last_date_format ) ? $last_date_format : '';
									endif;
									?>
								</div>
							</div>

							<table class="table table-striped table-hover" id="my-dataTables">
								 <thead>
			                        <tr class="headings">
			                            <th>No</th>
			                            <th>ID Pengembalian</th>
			                            <th>ID Peminjaman</th>
			                            <th>Tanggal Pinjam</th>
			                            <th>Tanggal Jatuh Tempo</th>
			                            <th>Tanggal Kembali</th>
			                            <th style="text-align:right;">Denda</th>
			                        </tr>
			                    </thead>

			                    <tbody>
			                        <?php
			                        $total = '';
			                        $no = 1; 
			                        while ( $data = $sql->fetch( PDO::FETCH_ASSOC ) ) {
			                        $total += $data['denda'];
			                        ?>
			                            <tr class="even pointer">
			                                <td><?php echo $no; ?></td>
			                                <td><?php echo $data['pengembalian_id']; ?></td>
			                                <td><?php echo $data['id_peminjaman']; ?></td>
			                                <td><?php echo $data['tgl_pinjam']; ?></td>
			                                <td><?php echo $data['tgl_jatuh_tempo']; ?></td>
			                                <td><?php echo $data['tgl_kembali']; ?></td>
			                                <td align="right"><?php echo $data['denda']; ?></td>
			                            </tr>
			                        <?php $no++; } ?>
			                    </tbody>
			                    <tfoot>
									<tr>
										<td colspan="6"><strong><?php if ( ! empty( $total ) ) echo 'Total Denda'; else echo ''; ?></strong></td>
										<td align="right"><strong><?php if ( ! empty( $total ) ) echo idr( $total ); else echo ''; ?></strong></td>
									</tr>
								</tfoot>
							</table>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- Js -->
		<script src="js/jquery.min.js"></script>
		<script src="js/datepicker/bootstrap-datepicker.min.js"></script>
		<script>
			// Datepicker
		    $('.datepicker').datepicker({
			    format: 'yyyy/mm/dd',
			    autoclose: true,
			});

			$('#start_date').on('change', function() {
				$('#button_filter').removeAttr("disabled");
			});
			$('#last_date').on('change', function() {
				$('#button_filter').removeAttr("disabled");
			});
		</script>

	</body>
	</html>

<?php endif;
// END: REPORT returning ----
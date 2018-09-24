<?php
$bks = new Books();
$brw = new Borrowing();
$rtn = new Returning();

$books = $bks->display_book();
$borrowing = $brw->get_data_borrowing_by_id( $_GET['detail'] );
$returning_by_id_borrowing = $rtn->get_returning_by_borrowing_id( $_GET['detail'] );

$data = $borrowing->fetch( PDO::FETCH_ASSOC );
$data_return = $returning_by_id_borrowing->fetch( PDO::FETCH_ASSOC );

date_default_timezone_set( "Asia/Jakarta" ); // time zone
$this_day = date( 'Y-m-d' );
?>
<div class="row">
    <div class="col-md-12">
        <h2 class="page-header">Detail Peminjaman Buku</h2>
    </div>
</div>
<div class="row">   
    <div class="col-md-12">
        <div class="col-md-12 row-detail-borrowing">
            <label class="control-label col-md-6">ID Peminjaman</label>
            <label class="control-label col-md-6"><?php echo $data['id_peminjaman']; ?></label>
        </div>

        <div class="col-md-12 row-detail-borrowing">
            <label class="control-label col-md-6">Nama Peminjam</label>
            <label class="control-label col-md-6"><?php echo $data['nama_lengkap']; ?></label>
        </div>

        <div class="col-md-12 row-detail-borrowing">
            <label class="control-label col-md-6">Tanggal Pinjam</label>
            <label class="control-label col-md-6"><?php echo $data['tgl_pinjam']; ?></label>
        </div>

        <div class="col-md-12 row-detail-borrowing">
            <label class="control-label col-md-6">Tanggal Jatuh Tempo</label>
            <label class="control-label col-md-6"><?php echo $data['tgl_jatuh_tempo']; ?></label>
        </div>

        <?php if ( ! empty( $returning_by_id_borrowing->rowCount() ) ) : ?>
            <div class="col-md-12 row-detail-borrowing">
                <label class="control-label col-md-6">Tanggal Kembali</label>
                <label class="control-label col-md-6"><?php echo $data_return['tgl_kembali']; ?></label>
            </div>

            <div class="col-md-12 row-detail-borrowing">
                <label class="control-label col-md-6">Denda</label>
                <label class="control-label col-md-6">
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

        <div class="clearfix"></div>
        <div class="ln_solid"></div>

        <div class="col-md-12 row-detail-borrowing">
            <label class="control-label col-md-12"><a href="cetak-bukti-peminjaman.php?id=<?php echo $data['id_peminjaman']; ?>" target="_blank"><button name="cetak" type="button" class="btn btn-primary"><i class="fa fa-print"></i> Cetak</button></a></label>
        </div>
        
    </div>
</div> <!-- END: Class row -->
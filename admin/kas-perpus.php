<?php
include_once 'includes/class.php';
$ks = new Kas();
$get_data_kas = $ks->display_kas();
?>

<div class="row">
    <div class="col-md-12">
        <h2 class="page-header">Kas Perpustakaan</h2>
    </div>
</div>

<div class="row wrapper-data-borrowing">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <table id="my-table-2" class="data-borrowing table table-striped responsive-utilities jambo_table">
                    <thead>
                        <tr class="headings">
                            <th>No</th>
                            <th>Nama Peminjam</th>
                            <th>ID Peminjaman</th>
                            <th>ID Pengembalian</th>
                            <th>ID Status Buku</th>
                            <th>Tanggal</th>
                            <th>Kas</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 1; foreach( $get_data_kas as $data ) : ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php if ( !empty( $data['nama_lengkap'] ) ) echo $data['nama_lengkap']; else echo '-'; ?></td>
                                <td><?php if ( $data['id_peminjaman'] != 0 ) echo $data['id_peminjaman']; else echo '-'; ?></td>
                                <td><?php if ( $data['pengembalian_id'] != 0 ) echo $data['pengembalian_id']; else echo '-'; ?></td>
                                <td><?php if ( $data['id_status_buku'] != 0 ) echo $data['id_status_buku'] . ' <small>(Rusak / Hilang)</small>'; else echo '-'; ?></td>
                                <td><?php if ( $data['id_status_buku'] != 0 ) echo $data['tanggal']; else echo $data['tgl_kembali']; ?></td>
                                <td><?php echo $data['kas']; ?></td>
                            </tr>

                            <div class="clearfix"></div>

                        <?php $no++; endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
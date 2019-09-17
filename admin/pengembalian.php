<?php
$rtn = new Returning();
$returning = $rtn->display_returning();
?>


<div class="row">
    <div class="col-md-12">
        <h2 class="page-header">Data Pengembalian Buku</h2>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <table id="my-table-2" class="data-borrowing table table-striped responsive-utilities jambo_table">
                    <thead>
                        <tr class="headings">
                            <th>No</th>
                            <th>Nama Peminjam</th>
                            <th>ID Pengembalian</th>
                            <th>ID Peminjaman</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Jatuh Tempo</th>
                            <th>Tanggal Kembali</th>
                            <th>Denda</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 1; foreach( $returning as $data ) : ?>
                            <tr class="even pointer">
                                <td><?php echo $no; ?></td>
                                <td><?php echo $data['nama_lengkap']; ?></td>
                                <td><?php echo $data['pengembalian_id']; ?></td>
                                <td><?php echo $data['id_peminjaman']; ?></td>
                                <td><?php echo $data['tgl_pinjam']; ?></td>
                                <td><?php echo $data['tgl_jatuh_tempo']; ?></td>
                                <td><?php echo $data['tgl_kembali']; ?></td>
                                <td><?php echo $data['denda']; ?></td>
                            </tr>

                            <div class="clearfix"></div>

                        <?php $no++; endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
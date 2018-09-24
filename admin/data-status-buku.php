<?php
// session_start();
$mb = new Member();
$bk = new Books();
$ks = new Kas();

$members = $mb->display_member();
$books = $bk->display_book();
$data_status_book = $bk->display_data_status_book();

?>

<!-- START: POP-UP ADD DATA -->
<div aria-hidden="true" aria-labelledby="myModal-addLabel" data-toggle="modal" role="dialog" tabindex="-1" id="myModal-add" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <button aria-hidden="true" class="azz-close-btn close" type="button">×</button> -->
                <button type="button" class="btn-close close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h2 class="modal-title">Form Status Buku ( Buku rusak, hilang, dll. )</h2>
            </div>
            <div class="modal-body">
                        
               <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_content">
                                <form action="tambah.php" method="post" id="form-status-books" class="form-horizontal form-label-left">
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal <span class="required">*</span></label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <input type="text" name="date" id="date" class="form-control datepicker" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Anggota <span class="required">*</span></label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <select name="member_name" id="member_name" class="select2_single form-control">
                                                <option value="-1">-- Cari Anggota --</option>
                                                <?php
                                                 foreach( $members as $row_member ) :
                                                    $members_id = $row_member['anggota_id'];
                                                    $members_name = $row_member['nama_lengkap'];
                                                    echo '<option value="'. $members_id .'">'. $members_name .'</option>';
                                                endforeach;
                                                ?>  
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Judul Buku<span class="required">*</span></label>
                                         <div class="col-md-9 col-sm-9 col-xs-12">
                                            <select name="my_books" id="my_books" class="select2_single form-control">
                                                <option value="-1">-- Cari Buku --</option>
                                                <?php
                                                 foreach( $books as $row_books ) :
                                                    $book_id = $row_books['buku_id'];
                                                    $books_title = $row_books['buku_judul'];
                                                    echo '<option value="'. $book_id .'">'. $books_title .'</option>';
                                                endforeach;
                                                ?>  
                                            </select>
                                        </div>
                                    </div>
                                   <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Keterangan <span class="required">*</span></label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <select name="information" id="information" class="form-control" tabindex="-1">
                                               <option value="-1">-- Pilih --</option>
                                               <option value="Rusak">Rusak</option>
                                               <option value="Hilang">Hilang</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Optional</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <textarea name="optional" cols="30" rows="2" class="form-control"></textarea>
                                        </div>
                                    </div>

                                     <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Biaya Ganti <span class="required">*</span></label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <input type="text" name="biaya_ganti" id="biaya_ganti" class="form-control" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-2 col-md-offset-3">
                                            <button type="submit" name="add-status-book" class="btn-status-book btn btn-primary">Simpan</button>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="info-warning" style="line-height: 35px; margin-left: -50px; color: #f00;"></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- END: Class modal-body -->
        </div>
    </div>
</div>
<!-- END: POP-UP POP-UP ADD DATA -->

<div class="row">
    <div class="col-md-12">
        <h2 class="page-header">Data Buku Rusak / Hilang / dll.</h2>
        <a href="#myModal-add" data-toggle="modal"><button type="button" class="btn btn-primary" id="add-data-member">Tambah Data</button></a>
    </div>
</div>

<div class="row info-alert">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <?php  
        // Check message ada atau tidak
        if ( ! empty( $_SESSION['messages'] ) ) {
            echo $_SESSION['messages']; // menampilkan pesan 
            unset( $_SESSION['messages'] ); // menghapus pesan setelah refresh
        }   
        ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content table-responsive">
                <table id="my-table" class="table table-striped responsive-utilities jambo_table">
                    <thead>
                        <tr>
                            <th>ID Status Buku</th>
                            <th>ID Anggota</th>
                            <th>Judul Buku</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Optional</th>
                            <th>Biaya Ganti</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        while( $data = $data_status_book->fetch( PDO::FETCH_ASSOC ) ) { ?>
                            <tr>
                                <td><?= $data['id_status_buku']; ?></td>
                                <td><?= $data['anggota_id']; ?></td>
                                <td><?= $data['buku_judul']; ?></td>
                                <td><?= $data['tanggal']; ?></td>
                                <td><?= $data['keterangan']; ?></td>
                                <td><?php if ( ! empty( $data['optional'] ) ) echo $data['optional']; else echo '-'; ?></td>
                                <td><?= $data['biaya_ganti']; ?></td>
                                <td>
                                    <a href="?p=edit-status-buku&stts_id=<?= $data['id_status_buku']; ?>" title="Edit"><i class="fa fa-edit"></i></a> || 
                                    <a href="delete.php?stts_id=<?= $data['id_status_buku']; ?>" title="Hapus"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
 <div class="row">
    <div class="col-md-12">
        <h2 class="page-header">Edit Status Buku Hilang / Rusak, dll.</h2>
    </div>
</div> 

<?php
if ( isset( $_GET['stts_id'] ) ) :
    $mb = new Member();
    $bk = new Books();
    $ks = new Kas();

    $members = $mb->display_member();
    $books = $bk->display_book();
    $data = $bk->get_data_status_book_by_id( $_GET['stts_id'] );
    $edit = $data->fetch( PDO::FETCH_ASSOC );
endif;
?>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="info-warning alert alert-danger alert-dismissible" role="alert" style="display: none; margin-bottom: 10px;"></div>
            <div class="x_content">
                <form action="update.php" method="post" id="form-status-books" class="form-horizontal form-label-left">
                    <input type="hidden" name="book_status_id" value="<?= $_GET['stts_id']; ?>">

                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Tanggal</label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <input type="text" name="date" id="date" class="form-control datepicker" autocomplete="off" value="<?= $edit['tanggal']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Nama Anggota</label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <select name="member_name" id="member_name" class="select2_single form-control">
                                <option value="-1">-- Cari Anggota --</option>
                                <?php
                                 foreach( $members as $row_member ) :
                                    $members_id = $row_member['anggota_id'];
                                    $members_name = $row_member['nama_lengkap'];

                                    if ( $edit['anggota_id'] == $members_id ) {
                                        $selected = "selected";
                                    } else {
                                        $selected = null;
                                    }
                                    echo '<option value="'. $members_id .'" '. $selected .'>'. $members_name .'</option>';
                                endforeach;
                                ?>  
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Judul Buku</label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                           <select name="my_books" id="my_books" class="select2_single form-control">
                                <option value="-1">-- Cari Buku --</option>
                                <?php
                                 foreach( $books as $row_books ) :
                                    $book_id = $row_books['buku_id'];
                                    $books_title = $row_books['buku_judul'];

                                    if ( $edit['buku_id'] == $book_id ) {
                                        $selected = "selected";
                                    } else {
                                        $selected = null;
                                    }
                                    echo '<option value="'. $book_id .'" '. $selected .'>'. $books_title .'</option>';
                                endforeach;
                                ?>  
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Keterangan</label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <select name="information" id="information" class="form-control" tabindex="-1">
                                <?php if ( $edit['keterangan'] == "Rusak" ) : ?>
                                    <option value="Rusak" selected>Rusak</option>
                                    <option value="Hilang">Hilang</option>
                                <?php else : ?>
                                    <option value="Rusak">Rusak</option>
                                    <option value="Hilang" selected>Hilang</option>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Optional</label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                           <textarea name="optional" id="optional" cols="30" rows="2" class="form-control"><?= $edit['optional']; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Biaya Ganti</label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                           <input type="text" name="biaya_ganti" id="biaya_ganti" class="form-control" value="<?= $edit['biaya_ganti']; ?>" autocomplete="off">
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-2">
                            <button type="submit" class="btn btn-primary" onclick="history.go(-1);">Batal</button>
                            <button type="submit" name="btn-update-status-books" class="btn btn-success btn-update-status-books" disabled="disabled">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
 <div class="row">
    <div class="col-md-12">
        <h2 class="page-header">Edit Data Buku</h2>
    </div>
</div> 

<?php
if ( isset( $_GET['edit_bk'] ) ) :
    $bks = new Books(); // instansiasi obj
    $categories = $bks->display_category();
    $data = $bks->get_data_book_by_id( $_GET['edit_bk'] );
    $edit = $data->fetch( PDO::FETCH_ASSOC );
endif;
?>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="info-warning alert alert-danger alert-dismissible" role="alert" style="display: none; margin-bottom: 10px;"></div>
            <div class="x_content">
                <form action="update.php" method="post" id="form-edit-book" class="form-books form-horizontal form-label-left" enctype="multipart/form-data">
                    <input type="hidden" name="book_id" value="<?= $_GET['edit_bk']; ?>">
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">ID Buku</label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <input type="text" name="book_id" id="book_id" class="form-control col-md-7 col-xs-12" value="<?= $edit['buku_id']; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Judul Buku</label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <input type="text" name="title" id="title" class="form-control col-md-7 col-xs-12" value="<?= $edit['buku_judul']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Kategori Buku</label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <select name="category_books" id="category_books" class="select2_single form-control" tabindex="-1">
                                <?php
                                 while( $loop_category = $categories->fetch( PDO::FETCH_ASSOC ) ) {
                                    $kd_category = $loop_category['kategori_id'];
                                    $nm_category = $loop_category['kategori_nama'];
            
                                    // Jika id kategori ( di tbl kategori) sama dg id kategori ( di tbl buku ) maka terselect
                                    if ( $edit['kategori_id'] == $kd_category ) {
                                        $selected = "selected";
                                    } else {
                                        $selected = null;
                                    }
                                
                                    echo "<option value=". $kd_category ." $selected>". $nm_category ."</option>";
                                } 
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Penulis</label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <input type="text" name="author" id="author" class="form-control col-md-7 col-xs-12" value="<?= $edit['penulis']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Penerbit</label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <input type="text" name="publisher" id="publisher" class="form-control col-md-7 col-xs-12" value="<?= $edit['penerbit']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">ISBN</label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <input type="text" name="isbn" id="isbn" class="form-control col-md-7 col-xs-12" value="<?= $edit['isbn']; ?>">
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Deskripsi fisik</label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <input type="text" name="physical_description" id="physical_description" class="form-control col-md-7 col-xs-12" value="<?= $edit['deskripsi_fisik']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Deskripsi Buku</label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <input type="text" name="description" id="description" class="form-control col-md-7 col-xs-12" value="<?= $edit['buku_deskripsi']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Jumlah</label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <input type="text" name="count" id="count" class="form-control col-md-7 col-xs-12" value="<?= $edit['buku_jumlah']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Cover Buku</label>
                        <div class="col-md-10 col-sm-10 col-xs-12 display-img">
                            <img src="images/books/<?php echo $edit['buku_cover']; ?>" alt="cover-book" width="70" height="auto">
                            <span class="remove-img"><i class="fa fa-close"></i></span>
                        </div>
                        <div class="col-md-10 col-sm-10 col-xs-12 upload-new">
                            <input type="file" name="cover" id="cover" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-2">
                            <button type="submit" class="btn btn-primary" onclick="history.go(-1);">Batal</button>
                            <button type="submit" name="btn-update-books" class="btn btn-success btn-update-books" disabled="disabled">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
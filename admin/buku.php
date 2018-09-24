<?php
$bks = new Books();
$the_books = $bks->display_book();
$categories = $bks->display_category();
$get_books_id_from_right = $bks->get_books_id_from_right();

$check_data = $get_books_id_from_right->rowCount();
$fetch_data = $get_books_id_from_right->fetch( PDO::FETCH_BOTH );
$maxid = $fetch_data[0];

$the_code = '';
if ( empty( $check_data ) ) {
    $new_code = 1;
} else {
    $the_code = substr( $maxid, -10 );
    $new_code = $the_code + 1;
}

$str = 'ABSCEFGHIJKLMNOPQRSTUVWXYZ';
$tambahan_kode = substr( str_shuffle( $str ), 0, 3 );

$mounth = date( 'm' );
$year = date( 'Y' );
$get2number_mounth = substr( $mounth,-2 ); // get 2 number of mounth from right
$get2number_year = substr( $year,-2 ); // get 2 number of year from right
$kd = '';

$custom_cd = "B". $get2number_mounth . $get2number_year;

if ( $new_code >= 1 && $new_code < 10 ) :
    $kd = $custom_cd."000000000".$new_code;
elseif ( $new_code >= 10 && $new_code < 100 ) :
    $kd = $custom_cd."00000000".$new_code;
elseif ( $new_code >= 100 && $new_code < 1000 ) :
    $kd = $custom_cd."0000000".$new_code;
elseif ( $new_code >= 1000 && $new_code < 10000 ) :
    $kd = $custom_cd."000000".$new_code;
elseif ( $new_code >= 10000 && $new_code < 100000 ) :
    $kd = $custom_cd."00000".$new_code;
elseif ( $new_code >= 100000 && $new_code < 1000000 ) :
    $kd = $custom_cd."0000".$new_code;
elseif ( $new_code >= 1000000 && $new_code < 10000000 ) :
    $kd = $custom_cd."000".$new_code;
elseif ( $new_code >= 10000000 && $new_code < 100000000 ) :
    $kd = $custom_cd."00".$new_code;
elseif ( $new_code >= 100000000 && $new_code < 1000000000 ) :
    $kd = $custom_cd."0".$new_code;
else :
    $kd = $custom_cd.$new_code.$tambahan_kode; // books avaliable more than 10.000.000.000
endif;
?>

<div class="row form-add-books">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-plus-circle"></i> Tambah Data Buku</h2>
                <div class="clearfix"></div>
            </div>
            <div class="info-warning alert alert-danger alert-dismissible" role="alert" style="display: none; margin-bottom: 10px;"></div>
            <div class="x_content">
                <form action="tambah.php" method="post" class="form-books form-horizontal form-label-left" id="add-books" enctype="multipart/form-data">
                     <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">ID Buku</label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <input type="text" name="book_id" value="<?= $kd; ?>" class="form-control col-md-7 col-xs-12" readonly>
                     
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Judul Buku <span class="required">*</span></label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <input type="text" name="title" id="title" class="form-control col-md-7 col-xs-12" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Kategori Buku <span class="required">*</span></label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <select name="category_books" id="category_books" class="select2_single form-control" tabindex="-1">
                                <option value="-1">-- Pilih Kategori Buku --</option>
                                <?php
                                 while( $loop_category = $categories->fetch( PDO::FETCH_ASSOC ) ) {
                                    $kd_category = $loop_category['kategori_id'];
                                    $nm_category = $loop_category['kategori_nama'];
                                    echo '<option value="'. $kd_category .'">'. $nm_category .'</option>';
                                }
                                ?>  
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Penulis <span class="required">*</span></label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <input type="text" name="author" id="author" class="form-control col-md-7 col-xs-12" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Penerbit <span class="required">*</span></label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <input type="text" name="publisher" id="publisher" class="form-control col-md-7 col-xs-12" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">ISBN</label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <input type="text" name="isbn" class="form-control col-md-7 col-xs-12" autocomplete="off">
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Deskripsi fisik <span class="required">*</span></label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <input type="text" name="physical_description" id="physical_description" class="form-control col-md-7 col-xs-12" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Deskripsi Buku <span class="required">*</span></label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <input type="text" name="description" id="description" class="form-control col-md-7 col-xs-12" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Jumlah <span class="required">*</span></label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <input type="text" name="count" id="count" class="form-control col-md-7 col-xs-12" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Cover Buku <span class="required">*</span></label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <input type="file" name="cover" id="cover" class="form-control col-md-7 col-xs-12" autocomplete="off">
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-2">
                            <button type="button" class="btn btn-primary" id="cancel-add-books">Batal</button>
                            <button type="submit" name="btn-add-books" class="btn btn-success">Simpan</button>
                        </div>
                    </div>
                    <span class="required">( * ) </span>Data wajib diisi.
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <h2 class="page-header">Data Buku</h2>
    </div>
</div>

<button type="button" class="btn btn-primary" id="add-data-books">Tambah Data Buku</button>
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
                            <th>ID Buku</th>
                            <th>Judul Buku</th>
                            <th>Kategori</th>
                            <th>Penulis</th>
                            <th>Penerbit</th>
                            <th>Deskripsi Fisik</th>
                            <th>ISBN</th>
                            <th>Deskripsi Buku</th>
                            <th>Jumlah</th>
                            <th>Cover</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach( $the_books as $data ) : // while( $data = $the_books->fetch( PDO::FETCH_ASSOC ) ) : ?>
                            <tr>
                                <td><?= $data['buku_id']; ?></td>
                                <td><?= $data['buku_judul']; ?></td>
                                <td><?php $id_cat = $data['kategori_id']; if ( $id_cat ) { echo $data['kategori_nama']; } ?></td>
                                <td><?= $data['penulis']; ?></td>
                                <td><?= $data['penerbit']; ?></td>
                                <td><?= $data['deskripsi_fisik']; ?></td>
                                <td><?= $data['isbn']; ?></td>
                                <td><?= $data['buku_deskripsi']; ?></td>
                                <td><?= $data['buku_jumlah']; ?></td>
                                <td><img src="images/books/<?= $data['buku_cover']; ?>" width="30" height="30" alt="img"></td>
                                <td>
                                    <a href="?p=edit-buku&edit_bk=<?= $data['buku_id']; ?>" title="Edit"><i class="fa fa-edit"></i></a> || 
                                    <a href="delete.php?del_bk=<?= $data['buku_id']; ?>" title="Hapus"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; //endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
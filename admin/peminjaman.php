<?php
$bks = new Books();
$brw = new Borrowing();
// $rtn = new Returning();

// $books = $bks->display_book();
$borrowing = $brw->display_borrowing();

date_default_timezone_set( "Asia/Jakarta" ); // time zone
$this_day = date( 'Y-m-d' );

?>

<script type="text/javascript">
    // Validasi
    // function validate() {
    //     $('.info-warning').css({'color':'#f00'});
    //     if( document.myForm.my_books.value == "-1" ) {
    //         $('.info-warning').html('Pilih buku terlebih dahulu !.');
    //         $('.select2-selection').css('border','1px solid #f00').focus();
    //         $('#my_books').change(function(){
    //             $('.select2-selection').removeAttr('style');
    //             $('.info-warning').html('');
    //         });
    //         return false;
    //     }
    //     return true;
    // }
</script>

<div class="row form-add-borrowing">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_title">
            <h2>Tambah Data Peminjaman Baru</h2>
            <div class="clearfix"></div>
        </div>
<!--         <div class="x_content">
            <form action="tambah.php" method="post" name="myForm" class="form-horizontal form-label-left" id="add-borrowing" onsubmit="return(validate());">
                 <div class="form-group">
                     <div class="col-md-12 col-sm-12 col-xs-12">
                        <select name="my_books" id="my_books" class="select2_single form-control">
                            <option value="-1">-- Cari Buku --</option>
                            <?php
                            //  foreach( $books as $row_books ) :
                            //     $book_id = $row_books['buku_id'];
                            //     $books_title = $row_books['buku_judul'];
                            //     echo '<option value="'. $book_id .'">'. $books_title .'</option>';
                            // endforeach;
                            ?>  
                        </select>
                    </div>
                </div>
                 
                <div class="form-group">
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <button type="button" class="btn btn-primary" id="cancel-add-borrowing">Batal</button>
                        <button type="submit" name="btn-add-detail-borrowing" class="btn-add-detail-borrowing btn btn-success">Simpan</button>
                    </div>
                    <div class="col-md-9 text-right">
                            <div class="info-warning" style="line-height: 35px;"></div>
                    </div>
                </div>
            </form>
        </div> -->
    </div>
</div>

<?php
// if ( !empty( $_POST['my_books'] ) && is_array( $_POST['my_books'] ) && count( $_POST['my_books'] ) ) {
//     $my_books_array = $_POST['my_books'];
//     for ($i = 0; $i < count($my_books_array); $i++) {

//         $the_books = $my_books_array[$i];

//         // INSERT .....
//     } 
// }
?>

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
    <div class="col-md-12">
        <h2 class="page-header">Data Peminjaman Buku</h2>
    </div>
</div>
<a href="./?p=list-peminjaman" style="color: #fff; text-decoration: none;"><button type="button" class="btn btn-primary">Tambah Data Peminjaman</button></a>
<div class="row wrapper-data-borrowing">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <table id="my-table" class="data-borrowing table table-striped responsive-utilities jambo_table">
                    <thead>
                        <tr class="headings">
                            <th>ID Peminjaman</th>
                            <th>Nama Anggota</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Jatuh Tempo</th>
                            <th>Status Peminjaman</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach( $borrowing as $data ) : ?>
                            <tr>
                                <td><?php echo $data['id_peminjaman']; ?></td>
                                <td><?php echo $data['nama_lengkap']; ?></td>
                                <td><?php echo $data['tgl_pinjam']; ?></td>
                                <td><?php echo $data['tgl_jatuh_tempo']; ?></td>
                                <td>
                                    <?php
                                    // $returning_by_id_borrowing = $rtn->get_returning_by_borrowing_id( $data['id_peminjaman'] );
                                    // if ( empty( $returning_by_id_borrowing->rowCount() ) ) {
                                    //     echo '<p style="font-weight: bold; color: #d9534f;">Terpinjam</p>'; 
                                    // } else {
                                    //     echo '<p style="font-weight: bold; color: #7AD87A;">Kembali</p>'; 
                                    // }
                                    if ( $data['status_peminjaman'] == 1 ) {
                                        echo '<p style="font-weight: bold; color: #7AD87A;">Kembali</p>'; 
                                    } 
                                    else if ( $data['status_peminjaman'] == -1 ) {
                                         echo '<p style="font-weight: bold; color: #d9534f;">Terpinjam</p>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <!-- START: ACTION -->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary">Pilih</button>
                                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <?php if ( $data['status_peminjaman'] == -1 ) : ?>
                                                <li><a href="#myModal<?= $data['id_peminjaman']; ?>" data-toggle="modal" class="my-btn-action" title="Pengembalian Buku"><i class="fa fa-angle-double-left"></i> Pengembalian Buku</a></li>
                                                <li><a href="./?p=detail-peminjaman&detail=<?= $data['id_peminjaman']; ?>" class="my-btn-action" title="Edit"><i class="fa fa-eye"></i> Detail</a></li>
                                                <li><a href="./?p=edit-peminjaman&edit_brw=<?= $data['id_peminjaman']; ?>" class="my-btn-action" title="Edit"><i class="fa fa-edit"></i> Edit</a></li>
                                                <li><a href="delete.php?del_brw=<?= $data['id_peminjaman']; ?>" class="my-btn-action" title="Delete"><i class="fa fa-trash"></i> Hapus</a></li>
                                            <?php else : ?>
                                                <li><a href="./?p=detail-peminjaman&detail=<?= $data['id_peminjaman']; ?>" class="my-btn-action" title="Edit"><i class="fa fa-eye"></i> Detail</a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                    <!-- END: ACTION -->
                                </td>
                            </tr>

                            <!-- START: POP-UP DATA RETURNING BASED ID -->
                            <div aria-hidden="true" aria-labelledby="myModalLabel<?php echo $data['id_peminjaman']; ?>" data-toggle="modal" data-backdrop="static" data-keyboard="false" role="dialog" tabindex="-1" id="myModal<?php echo $data['id_peminjaman']; ?>" class="modal fade">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <!-- <button aria-hidden="true" class="my-close-btn close" type="button">×</button> -->
                                            <button type="button" class="btn-close close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                            <h2 class="modal-title">Pengembalian Buku</h2>
                                        </div>
                                        <div class="modal-body">
                                                    
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="control-label col-md-2">ID Peminjaman</label><label class="control-label col-md-10"><?php echo $data['id_peminjaman']; ?></label>
                                                </div>

                                                <div class="col-md-12">
                                                    <label class="control-label col-md-2">Nama Peminjam</label><label class="control-label col-md-10"><?php echo $data['nama_lengkap']; ?></label>
                                                </div>

                                                <?php
                                                echo '<div class="col-md-12">';
                                                echo '<label class="control-label col-md-2" style="height:50px;">Nama Buku</label>';
                                                    // DISPLAY BOKKS BASED BORROWING_ID
                                                    $detail_borrowing_by_id = $brw->get_detail_borrowing_by_borowing_id( $data['id_peminjaman'] );
                                                    while( $thebooks = $detail_borrowing_by_id->fetch( PDO::FETCH_ASSOC ) ) :
                                                        echo '<label class="control-label col-md-10"># '. $thebooks['buku_judul'] .'</label>';
                                                    endwhile;
                                                echo '</div>';
                                                ?>
                                                
                                                <div class="clearfix"></div>
                                                <div class="ln_solid"></div>

                                                <div class="col-md-12">
                                                    <form>
                                                         <div class="form-group">
                                                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Tanggal Pinjam</label>
                                                             <div class="col-md-10">
                                                                <input type="text" name="date_borrowing" id="date_borrowing<?php echo $data['id_peminjaman']; ?>" class="form-control col-md-7 col-xs-12" value="<?= $data['tgl_pinjam']; ?>" readonly>
                                                            </div>
                                                             <div class="clearfix"></div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Jatuh Tempo</label>
                                                             <div class="col-md-10">
                                                                <input type="text" name="due_date" id="due_date<?php echo $data['id_peminjaman']; ?>" class="form-control col-md-7 col-xs-12" value="<?= $data['tgl_jatuh_tempo']; ?>" readonly>
                                                            </div>
                                                             <div class="clearfix"></div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Tanggal Kembali</label>
                                                             <div class="col-md-10">
                                                                <input type="text" name="date_returning" id="date_returning<?php echo $data['id_peminjaman']; ?>" class="form-control col-md-7 col-xs-12" value="<?= $this_day; ?>" readonly>
                                                            </div>
                                                             <div class="clearfix"></div>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Denda</label>
                                                             <div class="col-md-10">
                                                                <input type="text" name="denda" id="denda<?php echo $data['id_peminjaman']; ?>" class="form-control col-md-7 col-xs-12" value="<?php echo hitung_denda( $this_day, $data['tgl_jatuh_tempo'] ); ?>" readonly>
                                                            </div>
                                                             <div class="clearfix"></div>
                                                        </div>

                                                        <div class="clearfix"></div>

                                                        <div class="ln_solid"></div>
                                                        <div class="form-group">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <button type="button" id="my-button" class="btn-save-returning btn btn-success" value="<?php echo $data['id_peminjaman']; ?>">Simpan</button>
                                                            </div>
                                                        </div>
                                                    </form>

                                                    <div class="clearfix"></div>

                                                    <div id="loader_img"><img src="images/loader.gif" alt=""></div> <!-- Loader -->
                                                    <div class="info-process<?php echo $data['id_peminjaman']; ?>"></div>
                                                </div> <!-- END: Class col-md-12 -->
                                            </div> <!-- END: Class row-->

                                        </div> <!-- END: Class modal-body -->
                                    </div>
                                </div>
                            </div>
                            <!-- END: POP-UP DATA RETURNING BASED ID -->

                            <div class="clearfix"></div>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
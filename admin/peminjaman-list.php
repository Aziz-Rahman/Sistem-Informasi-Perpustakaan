<?php
$bks = new Books();
$mb = new Member();
$brw = new Borrowing();
$session_id = session_id();

$books = $bks->display_book();
$members = $mb->display_member();
$borrowing = $brw->get_detail_borrowing_by_sess_id( $session_id );

// Mengecek jika data sudah terisi 3 record maka tombol tambah peminjaman di disable
$get_data_book_by_id = $brw->get_detail_borrowing_by_sess_id( $session_id );
$get_book = $get_data_book_by_id->fetch( PDO::FETCH_ASSOC );
$row_count = $get_data_book_by_id->rowCount();

?>

<script type="text/javascript">
    // Validasi
    function validate() {
        $('.info-warning').css({'color':'#f00'});
        if( document.myForm.my_books.value == "-1" ) {
            $('.info-warning').html('Pilih buku terlebih dahulu !.');
            $('.select2-selection').css('border','1px solid #f00').focus();
            $('#my_books').change(function(){
                $('.select2-selection').removeAttr('style');
                $('.info-warning').html('');
            });
            return false;
        }
        return true;
    }
</script>
<div class="row form-add-new-data">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_title">
            <h2>Tambah Buku Pinjaman</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form action="tambah.php" method="post" name="myForm" class="form-horizontal" id="add-borrowing" onsubmit="return(validate());">
                 <div class="form-group">
                     <div class="col-md-12 col-sm-12 col-xs-12">
                     <?php // echo $number; ?>
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
                    <div class="col-md-4">
                        <button type="button" class="btn btn-primary" id="cancel-add-data">Batal</button>
                        <button type="submit" name="btn-add-detail-borrowing" class="btn btn-success">Simpan</button>
                    </div>
                    <div class="col-md-8 text-right">
                        <div class="info-warning" style="line-height: 35px;"></div>
                    </div>
                </div>
            </form>
        </div>
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
    <div class="col-md-12">
        <h2 class="page-header">List Peminjaman Buku</h2>
    </div>
</div>
<div class="row detail-borrowing">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <table class="table table-striped responsive-utilities jambo_table">
                    <thead>
                        <tr class="headings">
                            <th>No</th>
                            <th width="900">Judul Buku</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        // Mengecek jika detail peminjaman kosong maka,
                        $check_data = $borrowing->rowCount();
                        if ( empty( $check_data ) ) {
                            // echo "<meta http-equiv='refresh' content='0; url=?p=peminjaman'>"; // redirect to page peminjaman
                            echo '<span style="color: #f00;">Silahkan input buku koleksi peminjaman.</a>';
                        } else {
                            $no = 1; foreach( $borrowing as $data ) :
                        ?>
                                <tr class="even pointer">
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $data['buku_judul']; ?></td>
                                    <td><a href="delete.php?del_detail_brw=<?php echo $data['no']; ?>" title="delete"><i class="fa fa-trash"></i> Hapus</a></td>
                                </tr>
                        <?php 
                            $no++; endforeach; 
                        }
                        ?>
                    </tbody>
                </table>
                <span style="color: #f00;">Ket:</span> Maksimal peminjaman 3 buah buku.
                <?php  
                if ( empty( $check_data ) ) {
                    echo '<a class="btn btn-danger pull-right" disabled="disabled">Lanjutkan</a>';
                } else {
                     echo '<a href="#myModal" data-toggle="modal" class="btn btn-danger pull-right">Lanjutkan</a>';
                }
                ?>
                
                <?php if ( $row_count >= 3 ) : ?>
                    <button type="button" class="btn btn-primary pull-right" id="disabled-new-data" disabled="disabled">Tambah Buku Pinjaman</button>
                <?php else : ?>
                    <button type="button" class="btn btn-primary pull-right" id="add-new-data">Tambah Buku Pinjaman</button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


<!-- START: POP-UP FOR SAVE DATA BORROWING -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Isi Data Peminjaman</h4>
            </div>
            <div class="modal-body">
                <section class="panel panel-default">
                    <div class="panel-body">
                        <form action="tambah.php" method="post" id="add-borrowong">
                            <div class="form-group">
                                <label>Nama Anggota</label>
                                <select name="member_name" id="member_name" class="select2_single form-control">
                                    <option value="-1"></option>
                                    <?php
                                     foreach( $members as $row_member ) :
                                        $members_id = $row_member['anggota_id'];
                                        $members_name = $row_member['nama_lengkap'];
                                        echo '<option value="'. $members_id .'">'. $members_name .'</option>';
                                    endforeach;
                                    ?>  
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tanggal Pinjam</label>
                                <input type="text" name="date_borrowing" id="date_borrowing" class="datepicker form-control">
                            </div>

                            <div class="form-group">
                                <label>Tanggal Jatuh Tempo</label>
                                <input type="text" name="due_date" id="due_date" class="datepicker form-control">
                            </div>

                            <div class="form-group">
                                <div class="col-md-3">
                                    <button type="submit" name="btn-save-borrowing" class="save-borrowing btn btn-primary">Simpan</button>
                                </div>
                                <div class="col-md-9">
                                    <div class="info-warning" style="line-height: 35px; margin-left: -50px; color: #f00;"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
<!-- END: POP-UP FOR SAVE DATA BORROWING --> 
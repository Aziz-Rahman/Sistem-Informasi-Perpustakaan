 <div class="row">
    <div class="col-md-12">
        <h2 class="page-header">Edit Data Peminjaman</h2>
    </div>
</div> 

<?php
if ( isset( $_GET['edit_brw'] ) ) :
	$mb = new Member();
    $brw = new Borrowing();
    $members = $mb->display_member();
	$data = $brw->get_data_borrowing_by_id( $_GET['edit_brw'] );
	$edit = $data->fetch( PDO::FETCH_ASSOC );
endif;
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
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <form action="update.php" method="post" class="form-horizontal form-label-left" id="edit-borrowing">
                    <input type="hidden" name="borrowing_id" value="<?= $edit['id_peminjaman']; ?>">
                   <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">ID Peminjam</label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <input type="text" name="borrowing_id" class="form-control col-md-7 col-xs-12" value="<?= $edit['id_peminjaman']; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Nama Peminjam</label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <select name="member_books" class="select2_single form-control" tabindex="-1">
                                <?php
                                 while( $my_members = $members->fetch( PDO::FETCH_ASSOC ) ) {
                                    $id_my_members = $my_members['anggota_id'];
                                    $nm_my_members = $my_members['nama_lengkap'];
            
                                    if ( $edit['anggota_id'] == $id_my_members ) {
                                        $selected = "selected";
                                    } else {
                                        $selected = null;
                                    }
                                
                                    echo "<option value=". $id_my_members ." $selected>". $nm_my_members ."</option>";
                                    } 
                                 ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Tanggal Pinjam</label>
                         <div class="col-md-10 col-sm-10 col-xs-12">
                            <input type="text" name="date_borrowing" class="datepicker form-control col-md-7 col-xs-12" value="<?= $edit['tgl_pinjam']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Tanggal Jatuh Tempo</label>
                         <div class="col-md-10 col-sm-10 col-xs-12">
                            <input type="text" name="due_date" class="datepicker form-control col-md-7 col-xs-12" value="<?= $edit['tgl_jatuh_tempo']; ?>">
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-2">
                            <a href="./?p=peminjaman"><button type="button" class="btn btn-primary">Batal</button></a>
                            <button type="submit" name="btn-update-borrowing" class="btn btn-success">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
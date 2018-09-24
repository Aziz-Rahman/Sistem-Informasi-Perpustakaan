<?php
$adm = new Librarian();
$admin = $adm->display_librarian();
?>

<!-- START: POP-UP ADD DATA -->
<div aria-hidden="true" aria-labelledby="myModal-addLabel" data-toggle="modal" role="dialog" tabindex="-1" id="myModal-add" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h2 class="modal-title"><i class="fa fa-user-plus"></i> Tambah Petugas Perpustakaan</h2>
            </div>
            <div class="info-warning alert alert-danger alert-dismissible" role="alert" style="display: none; margin-top: 0;"></div>
            <div class="modal-body">
               <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_content">
                                <form action="tambah.php" method="post" id="form-librarian" class="form-horizontal form-label-left" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Lengkap <span class="required">*</span></label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <input type="text" name="fullname" id="fullname" class="form-control" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Kelamin <span class="required">*</span></label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <select name="gender" id="gender" class="form-control" tabindex="-1">
                                               <option value="-1">-- Pilih --</option>
                                               <option value="L">Laki - laki</option>
                                               <option value="P">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Lahir <span class="required">*</span></label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <input type="text" name="date_of_birth" id="date_of_birth" class="form-control datepicker" autocomplete="off">
                                        </div>
                                    </div>
                                    
                                     <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tempat Lahir <span class="required">*</span></label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <input type="text" name="place_of_birth" id="place_of_birth" class="form-control" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Status Perkawinan <span class="required">*</span></label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <select name="marital_status" id="marital_status" class="form-control" tabindex="-1">
                                               <option value="-1">-- Pilih --</option>
                                               <option value="Menikah">Menikah</option>
                                               <option value="Single">Single</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">No. Telepon <span class="required">*</span></label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <input type="text" name="phone" id="phone" class="form-control" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Email <span class="required">*</span></label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <input type="text" name="email" id="email" class="form-control" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Alamat <span class="required">*</span></label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <input type="text" name="address" id="address" class="form-control" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Foto <span class="required">*</span></label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <input type="file" name="photo" id="photo" class="form-control" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Username <span class="required">*</span></label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <input type="text" name="username" id="username" class="form-control" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Password <span class="required">*</span></label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <input type="password" name="password" id="password" class="form-control" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Status Petugas <span class="required">*</span></label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <select name="librarian_status" id="librarian_status" class="form-control" tabindex="-1">
                                               <option value="-1">-- Pilih --</option>
                                               <option value="1">Active</option>
                                               <option value="2">Non Active</option>
                                               <option value="3">Suspend</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                            <button type="submit" name="btn-add-librarian" class="btn btn-primary">Simpan</button>
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
        <h2 class="page-header">Data Petugas Perpustakaan</h2>
        <a href="#myModal-add" data-toggle="modal"><button type="button" class="btn btn-primary" id="add-data-member">Tambah Petugas</button></a>
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
                <table id="my-table" class="data-borrowing table table-striped responsive-utilities jambo_table">
                    <thead>
                        <tr class="headings">
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Gender</th>
                            <th>Tanggal Lahir</th>
                            <th>Tempat Lahir</th>
                            <th>Status Perkawinan</th>
                            <th>No Telepon</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Foto</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach( $admin as $data ) { ?>
                            <tr>
                                <td><?= $data['petugas_id']; ?></td>
                                <td><?= $data['nama_lengkap']; ?></td>
                                <td><?php if ( $data['jenis_kelamin'] == 'P' ) echo 'Perempuan'; else echo 'Laki - laki'; ?></td>
                                <td><?= $data['tgl_lahir']; ?></td>
                                <td><?= $data['tempat_lahir']; ?></td>
                                <td><?= $data['status_perkawinan']; ?></td>
                                <td><?= $data['no_telp']; ?></td>
                                <td><?= $data['email']; ?></td>
                                <td><?= $data['alamat']; ?></td>
                                <td><img src="images/users/<?= $data['foto']; ?>" width="30" height="30" alt="img"></td>
                                <td>
                                    <?php 
                                    if ( $data['status_petugas'] == '1' ) :
                                        echo 'Aktif';
                                    elseif( $data['status_petugas'] == '2' ) :
                                        echo 'Non Aktif';
                                    else :
                                        echo 'Suspend';
                                    endif;
                                    ?>
                                </td>
                                <td>
                                    <?php if ( $data['status_petugas'] == '2' ) : // Jk status admin sudah tidak aktif
                                       echo '<a href="delete.php?del_adm='. $data['petugas_id'] .'" title="Hapus"><i class="fa fa-trash"></i></a>';
                                    else :
                                        echo '-';
                                    endif;
                                    ?>
                               </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
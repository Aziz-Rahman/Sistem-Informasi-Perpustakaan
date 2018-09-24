<?php 
$my_profile = $ad->get_data_librarian_by_id( $admin );
$data = $my_profile->fetch( PDO::FETCH_ASSOC );
?>

<div class="">
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header">Pengaturan Profile</h2>
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="info-warning alert alert-danger alert-dismissible" role="alert" style="display: none; margin-top: 0;"></div>
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
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                        <div class="profile_img">
                            <div id="crop-avatar">
                                <div class="avatar-view" title="Change the avatar">
                                    <img src="images/users/<?= $data['foto']; ?>" alt="img">
                                </div>
                                <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
                            </div>
                        </div>
                        <a href="#myModalPicture<?php echo $data['petugas_id']; ?>" data-toggle="modal" title="Change Photo" class="btn btn-edit"><i class="fa fa-edit m-right-xs"></i> Ubah Foto</a>
                    </div>

                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <div class="profile_title">
                            <div class="col-md-6"><h2>Data Diri</h2></div>
                        </div>

                        <div class="col-md-12 row-detail-borrowing" style="margin-top: 10px; padding: 0;">
                            <form action="update.php" method="post" id="form-edit-librarian" class="form-horizontal form-label-left">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Lengkap <span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" name="fullname" id="fullname" class="form-control" value="<?= $data['nama_lengkap']; ?>" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Kelamin <span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select name="gender" id="gender" class="form-control" tabindex="-1">
                                            <?php if ( $data['jenis_kelamin'] == "L" ) : ?>
                                                <option value="L" selected>Laki-laki</option>
                                                <option value="P">Perempuan</option>
                                            <?php else : ?>
                                                <option value="L">Laki-laki</option>
                                                <option value="P" selected>Perempuan</option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Lahir <span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" name="date_of_birth" id="date_of_birth" class="form-control datepicker" value="<?= $data['tgl_lahir']; ?>" autocomplete="off">
                                    </div>
                                </div>
                                
                                 <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Tempat Lahir <span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" name="place_of_birth" id="place_of_birth" class="form-control" value="<?= $data['tempat_lahir']; ?>" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Status Perkawinan <span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select name="marital_status" id="marital_status" class="form-control" tabindex="-1">
                                           <option value="-1">-- Pilih --</option>
                                           <?php if ( $data['status_perkawinan'] == "Menikah" ) : ?>
                                                <option value="Menikah" selected>Menikah</option>
                                                <option value="Single">Single</option>
                                            <?php else : ?>
                                                <option value="Menikah">Menikah</option>
                                                <option value="Single" selected>Single</option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">No. Telepon <span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" name="phone" id="phone" class="form-control" value="<?= $data['no_telp']; ?>" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Email <span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" name="email" id="email" class="form-control" value="<?= $data['email']; ?>" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Alamat <span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" name="address" id="address" class="form-control" value="<?= $data['alamat']; ?>" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Username <span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" name="username" id="username" class="form-control" value="<?= $data['username']; ?>" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Password</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <a href="#myModalPassword<?php echo $data['petugas_id']; ?>" data-toggle="modal" title="Change Password" class="btn btn-edit"><i class="fa fa-edit m-right-xs"></i> Ubah Password</a>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Status Petugas <span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select name="librarian_status" id="librarian_status" class="form-control" tabindex="-1">
                                            <option value="-1">-- Pilih --</option>
                                            <?php if ( $data['status_petugas'] == "1" ) : ?>
                                                <option value="1" selected>Active</option>
                                                <option value="2">Non Active</option>
                                                <option value="3">Suspend</option>
                                            <?php elseif ( $data['status_petugas'] == "2" ) : ?>
                                                <option value="1">Active</option>
                                                <option value="2" selected>Non Active</option>
                                                <option value="3">Suspend</option>
                                            <?php else : ?>
                                                <option value="1">Active</option>
                                                <option value="2">Non Active</option>
                                                <option value="3" selected>Suspend</option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button type="submit" name="btn-update-librarian" id="btn-edit-librarian" class="btn btn-primary" disabled="disabled">Update Profile</button>
                                    </div>
                                </div>
                            </form>
                            <div class="clearfix"></div>
                            <div class="ln_solid"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- START: Edit Password -->
<div aria-hidden="true" aria-labelledby="myModalPasswordLabel<?php echo $data['petugas_id']; ?>" role="dialog" tabindex="-1" id="myModalPassword<?php echo $data['petugas_id']; ?>" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Ganti Password</h4>
            </div>
            <div class="modal-body">
                <form action="update.php" method="post" id="edit-password-librarian" class="form-horizontal form-label-left">
                    <div class="form-group">
                        <label for="old_password">Password Lama</label>
                        <input type="password" name="old_password" class="form-control" id="old_password<?php echo $data['petugas_id']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="new_password">Password Baru</label>
                        <input type="password" name="new_password" class="form-control" id="new_password<?php echo $data['petugas_id']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Ulangi Password</label>
                        <input type="password" name="confirm_password" class="form-control" id="confirm_password<?php echo $data['petugas_id']; ?>">
                    </div>
                    <div class="form-group">
                      <button type="submit" value="<?php echo $data['petugas_id']; ?>" name="btn-update-password-librarian" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
                <div id="info-update<?php echo $data['petugas_id']; ?>"></div>
                <div id="loader-img"></div>
            </div>
        </div>
    </div>
</div>
<!-- END: Edit Password -->

<!-- START: Edit photo -->
<div aria-hidden="true" aria-labelledby="myModalPictureLabel<?php echo $data['petugas_id']; ?>" role="dialog" tabindex="-1" id="myModalPicture<?php echo $data['petugas_id']; ?>" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Ganti Foto</h4>
            </div>
            <div class="modal-body">
                <form action="update.php" method="post" id="edit-photo-librarian" class="form-horizontal form-label-left" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="photo">Upload Foto Baru</label>
                        <input type="file" name="photo" id="photo" class="form-control">
                    </div>
                    <div class="form-group">
                      <button type="submit" value="<?php echo $data['petugas_id']; ?>" name="btn-update-photo-librarian" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
                <div id="info-update<?php echo $data['petugas_id']; ?>"></div>
                <div id="loader-img"></div>
            </div>
        </div>
    </div>
</div>
<!-- END: Edit photo -->
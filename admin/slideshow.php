<?php
include_once 'includes/class.php';
$sdr = new Slider();
$get_data = $sdr->display_slider();
?>

<div class="row">
    <div class="col-md-12">
        <h2 class="page-header">Feature Slider Hompage</h2>
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

<div class="row wrapper-data-borrowing">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <table id="my-table-2" class="data-borrowing table table-striped responsive-utilities jambo_table">
                    <thead>
                        <tr class="headings">
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Judul</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 1; foreach( $get_data as $data ) : ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><img src="images/slideshow/<?php echo $data['gambar']; ?>" width="30" height="30" alt=""></td>
                                <td><?php echo $data['judul']; ?></td>
                                <td><?php echo $data['keterangan']; ?></td>
                                <td><a href="delete.php?slideshow=<?php echo $data['id_slider']; ?>" title="delete"><i class="fa fa-trash"></i></a></td>
                            </tr>
                        <?php $no++; endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<!-- START: POP-UP ADD DATA -->
<div aria-hidden="true" aria-labelledby="myModal-addLabel" data-toggle="modal" role="dialog" tabindex="-1" id="myModal-add" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <button aria-hidden="true" class="azz-close-btn close" type="button">×</button> -->
                <button type="button" class="btn-close close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h2 class="modal-title">Tambah Slider</h2>
            </div>
            <div class="modal-body">
                        
               <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_content">
                                <form action="tambah.php" method="post" id="form-slideshow" class="form-horizontal form-label-left" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Banner Slider <span class="required">*</span></label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <input type="file" name="banner_img" id="banner_img" class="form-control col-md-7 col-xs-12" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Judul <span class="required">*</span></label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <input type="text" name="title" id="title" class="form-control" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Keterangan</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <textarea name="information" cols="30" rows="2" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-2 col-md-offset-3">
                                            <button type="submit" name="btn-add-slideshow" class="btn-slideshow btn btn-primary">Simpan</button>
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
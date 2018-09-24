<?php
$mb = new Member();
$mymember = $mb->display_member();
?>

<div class="row">
    <div class="col-md-12">
        <h2 class="page-header">Data Anggota Perpustakaan</h2>
    </div>
</div>

<a href="#myModal-add" data-toggle="modal"><button type="button" class="btn btn-primary" id="add-data-member">Tambah Anggota</button></a>

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
                        <tr class="headings">
                            <th>ID Anggota</th>
                            <th>Nama Lengkap</th>
                            <th>Jenis Kelamin</th>
                            <th>Identitas</th>
                            <th>No. Telp</th>
                            <th>Email</th>
                            <th>Alamat Asal</th>
                            <th>Alamat Saat Ini</th>
                            <th>Jenis Aggota</th>
                            <th>Nama Institusi</th>
                            <th>Alamat Institusi</th>
                            <th>Deposit</th>
                            <th>Tanggal Daftar</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while( $data = $mymember->fetch( PDO::FETCH_ASSOC ) ) { ?>
                            <tr class="even pointer">
                                <td><?= $data['anggota_id']; ?></td>
                                <td><?= $data['nama_lengkap']; ?></td>
                                <td><?php if ( $data['jenis_kelamin'] == 'P' ) echo 'Perempuan'; else echo 'Laki - laki'; ?></td>
                                <td><?= $data['jenis_identitas']; ?> / <?= $data['no_identitas']; ?></td>
                                <td><?= $data['no_telp']; ?></td>
                                <td><?= $data['email']; ?></td>
                                <td><?= $data['alamat_asal']; ?></td>
                                <td><?= $data['alamat_saat_ini']; ?></td>
                                <td><?= $data['jenis_anggota']; ?></td>
                                <td><?= $data['nama_institusi']; ?></td>
                                <td><?= $data['alamat_institusi']; ?></td>
                                <td><?= idr( $data['deposit'] ); ?></td>
                                <td><?= $data['tgl_pendaftaran']; ?></td>
                                <td>
                                    <!-- <a href="cetak-anggota.php?id= -->
                                    <a href="?p=edit-anggota&edit_mb=<?= $data['anggota_id']; ?>" title="Edit"><i class="fa fa-edit"></i></a> ||
                                    <a href="delete.php?del_mb=<?= $data['anggota_id']; ?>" title="Hapus"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- START: POP-UP FOR ADD DATA MEMBER -->
<div aria-hidden="true" role="dialog" tabindex="-1" id="myModal-add" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title"><i class="fa fa-user-plus"></i> Tambah Anggota</h4>
            </div>
            <div class="info-warning alert alert-danger alert-dismissible" role="alert" style="display: none;"></div>
            <div class="modal-body">
                <script type="text/javascript">
                	var only_number = /^[0-9]+$/;
    				var number_type_2 = /^[0-9- ]+$/;
                    // Validasi
                    function validate() {
                        if( document.myForm.type_of_identity.value == "-1" ){
                            $('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Pilih tipe identitas.').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
                            $('#type_of_identity').css({'border':'1px solid #f00'}).focus();
                            $('#type_of_identity').on('change', function() {
                                $(this).removeAttr('style');
                                $('.info-warning').html('').css({'display':'none'});
                            });
                            return false;
                         }
                        if( document.myForm.no_identity.value == "" ) {
                            $('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> No identitas harus diisi.').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
                            $('#no_identity').css({'border':'1px solid #f00'}).focus();
                            $('#no_identity').keydown(function(){
                                $(this).removeAttr('style');
                                $('.info-warning').html('').css({'display':'none'});
                            });
                            return false;
                        }
                        if( !number_type_2.test($('#no_identity').val()) ) {
                            $('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> No identitas tidak valid.').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
                            $('#no_identity').css({'border':'1px solid #f00'}).focus();
                            $('#no_identity').keydown(function(){
                                $(this).removeAttr('style');
                                $('.info-warning').html('').css({'display':'none'});
                            });
                            return false;
                        }
                        if( document.myForm.fullname.value == "" ) {
                            $('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Nama harus diisi.').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
                            $('#fullname').css({'border':'1px solid #f00'}).focus();
                            $('#fullname').keydown(function(){
                                $(this).removeAttr('style');
                                $('.info-warning').html('').css({'display':'none'});
                            });
                            return false;
                        }
                        // if( document.myForm.photo.value == "" ) {
                        //     $('.info-warning').html('Silahkan upload foto terlebih dahulu.');
                        //     $('#photo').css({'border':'1px solid #f00'});
                        //     $('#photo').keydown(function(){
                        //         $(this).removeAttr('style');
                        //         $('.info-warning').html('').css({'display':'none'});
                        //     });
                        //     return false;
                        // }
                        if( document.myForm.gender.value == "-1" ) {
                            $('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Pilih jenis kelamin.').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
                            $('#gender').css({'border':'1px solid #f00'}).focus();
                            $('#gender').on('change', function() {
                                $(this).removeAttr('style');
                                $('.info-warning').html('').css({'display':'none'});
                            });
                            return false;
                        }
                        if( document.myForm.phone.value == "" ) {
                            $('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> No telepon harus diisi.').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
                            $('#phone').css({'border':'1px solid #f00'}).focus();
                            $('#phone').keydown(function(){
                                $(this).removeAttr('style');
                                $('.info-warning').html('').css({'display':'none'});
                            });
                            return false;
                        }
                        if( !number_type_2.test($('#phone').val()) ) {
				            $('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> No telepon tidak valid.').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
				            $('#phone').css({'border':'1px solid #f00'}).focus();
				            $('#phone').keydown(function(){
				                $(this).removeAttr('style');
				                $('.info-warning').html('').css({'display':'none'});
				            });
				            return false;
				        }
                        if( document.myForm.address_1.value == "" ) {
                            $('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Daerah asal/ tempat tinggal asal harus diisi.').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
                            $('#address_1').css({'border':'1px solid #f00'}).focus();
                            $('#address_1').keydown(function(){
                                $(this).removeAttr('style');
                                $('.info-warning').html('').css({'display':'none'});
                            });
                            return false;
                        }
                        if( document.myForm.address_2.value == "" ) {
                            $('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Tempat tinggal saat ini harus diisi.').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
                            $('#address_2').css({'border':'1px solid #f00'}).focus();
                            $('#address_2').keydown(function(){
                                $(this).removeAttr('style');
                                $('.info-warning').html('').css({'display':'none'});
                            });
                            return false;
                        }
                        if( document.myForm.type_of_member.value == "-1" ){
                            $('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Pilih terlebih dahulu tipe anggota.').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
                            $('#type_of_member').css({'border':'1px solid #f00'}).focus();
                            $('#type_of_member').on('change', function() {
                                $(this).removeAttr('style');
                                 $('.info-warning').html('').css({'display':'none'});
                            });
                            return false;
                         }
                        if( document.myForm.name_of_institution.value == "" ) {
                            $('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Nama Institusi harus diisi.').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
                            $('#name_of_institution').css({'border':'1px solid #f00'}).focus();
                            $('#name_of_institution').keydown(function(){
                                $(this).removeAttr('style');
                                $('.info-warning').html('').css({'display':'none'});
                            });
                            return false;
                        }
                        if( document.myForm.address_of_institution.value == "" ) {
                            $('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Anda belum mengisi alamat institusi.').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
                            $('#address_of_institution').css({'border':'1px solid #f00'}).focus();
                            $('#address_of_institution').keydown(function(){
                                $(this).removeAttr('style');
                                $('.info-warning').html('').css({'display':'none'});
                            });
                            return false;
                        }
                         if( document.myForm.deposit.value == "" ) {
                            $('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Dana sumbangan sebesar Rp.100.000,00 sesuai dengan ketentuan.').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
                            $('#deposit').css({'border':'1px solid #f00'}).focus();
                            $('#deposit').keydown(function(){
                                $(this).removeAttr('style');
                                $('.info-warning').html('').css({'display':'none'});
                            });
                            return false;
                        }
                        if( !only_number.test($('#deposit').val()) ) {
				            $('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Nominal uang tidak valid. Contoh penulisan: 100000').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
				            $('#deposit').css({'border':'1px solid #f00'}).focus();
				            $('#deposit').keydown(function(){
				                $(this).removeAttr('style');
				                $('.info-warning').html('').css({'display':'none'});
				            });
				            return false;
				        }
                        return true;
                    }
                </script>

                <section class="panel panel-default">
                    <div class="panel-body">
                        <form name="myForm" action="tambah.php" method="post" class="form-horizontal form-label-left" id="add-member" onsubmit="return(validate());">
                            <div class="form-group">
                                <label>Identitas <span class="required">*</span></label>
                                <div class="row">
                                    <div class="col-md-3">
                                        <select name="type_of_identity" id="type_of_identity" class="form-control" tabindex="-1">
                                            <option value="-1">-- Pilih Identitas --</option>
                                            <option value="KTP">KTP</option>
                                            <option value="SIM">SIM</option>
                                            <option value="Kartu Pelajar">Kartu Pelajar</option>
                                            <option value="Kartu Mahasiswa">Kartu Mahasiswa</option>
                                        </select>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="no_identity" id="no_identity" class="form-control" placeholder="No Identitas" autocomplete="off">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Nama Lengkap <span class="required">*</span></label>
                                <input type="text" name="fullname" id="fullname" class="member-name form-control" autocomplete="off">
                            </div>

                          <!--   <div class="form-group">
                            <label>Pass Foto</label>
                                <input type="file" name="photo" id="photo" class="form-control">
                            </div> -->

                            <div class="form-group">
                                <label>Jenis Kelamin <span class="required">*</span></label>
                                <select name="gender" id="gender" class="form-control" tabindex="-1">
                                    <option value="-1">-- Pilih jenis kelamin --</option>
                                    <option value="L">Laki - laki</option>
                                    <option value="P">Perempuan</option>
                                </select>  
                            </div>

                            <div class="form-group">
                                <label>No. Telepon <span class="required">*</span></label>
                                <input type="text" name="phone" id="phone" class="form-control" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" id="email" class="form-control" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label>Alamat Daerah Asal <span class="required">*</span></label>
                                <input type="text" name="address_1" id="address_1" class="form-control" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label>Alamat / Tempat Tinggal Saat Ini <span class="required">*</span></label>
                                <input type="text" name="address_2" id="address_2" class="form-control" autocomplete="off">
                            </div>

                             <div class="form-group">
                                <label>Jenis Anggota <span class="required">*</span></label>
                                <select name="type_of_member" id="type_of_member" class="form-control" tabindex="-1">
                                    <option value="-1">-- Pilih Tipe Anggota --</option>
                                    <option value="Pelajar">Pelajar</option>
                                    <option value="Mahasiswa">Mahasiswa</option>
                                    <option value="Umum">Umum</option>
                                </select>  
                            </div>

                            <div class="form-group">
                                <label>Nama Institusi <span class="required">*</span> <small style="font-style: italic;">(Sekolah, Universitas, Instansi, Kantor)</small></label>
                                <input type="text" name="name_of_institution" id="name_of_institution" class="form-control" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label>Alamat Institusi <span class="required">*</span></label>
                                <input type="text" name="address_of_institution" id="address_of_institution" class="form-control" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label>Deposit <span class="required">*</span></label>
                                <input type="text" name="deposit" id="deposit" class="form-control" autocomplete="off">
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" name="btn-add-member" class="btn-add-member btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
<!-- END: POP-UP FOR ADD DATA MEMBER --> 
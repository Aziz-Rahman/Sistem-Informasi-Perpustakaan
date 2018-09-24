 <div class="row">
    <div class="col-md-12">
        <h2 class="page-header">Edit Data Anggota</h2>
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
        <div class="info-warning alert alert-danger alert-dismissible" role="alert" style="display: none;"></div>
    </div>
</div>

<?php
if ( isset( $_GET['edit_mb'] ) ) :
    $mb = new Member(); // instansiasi obj
    $get_data = $mb->get_data_member_by_id( $_GET['edit_mb'] );
    $data = $get_data->fetch( PDO::FETCH_ASSOC );
endif;
?>

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

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <form name="myForm" action="update.php" method="post" class="form-members form-horizontal form-label-left" onsubmit="return(validate());">
                    <input type="hidden" name="member_id" value="<?= $_GET['edit_mb']; ?>">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Identitas <span class="required">*</span></label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <select name="type_of_identity" id="type_of_identity" class="form-control" tabindex="-1">
                                <?php if ( $data['jenis_identitas'] == "KTP" ) : ?>
                                    <option value="KTP" selected>KTP</option>
                                    <option value="SIM">SIM</option>
                                    <option value="Kartu Pelajar">Kartu Pelajar</option>
                                    <option value="Kartu Mahasiswa">Kartu Mahasiswa</option>
                                <?php elseif ( $data['jenis_identitas'] == "SIM" ) : ?>
                                    <option value="KTP">KTP</option>
                                    <option value="SIM" selected>SIM</option>
                                    <option value="Kartu Pelajar">Kartu Pelajar</option>
                                    <option value="Kartu Mahasiswa">Kartu Mahasiswa</option>
                                 <?php elseif ( $data['jenis_identitas'] == "Kartu Mahasiswa" ) : ?>
                                    <option value="KTP">KTP</option>
                                    <option value="SIM">SIM</option>
                                    <option value="Kartu Pelajar" selected>Kartu Pelajar</option>
                                    <option value="Kartu Mahasiswa">Kartu Mahasiswa</option>
                                <?php else : ?>
                                   <option value="KTP">KTP</option>
                                    <option value="SIM">SIM</option>
                                    <option value="Kartu Pelajar">Kartu Pelajar</option>
                                    <option value="Kartu Mahasiswa" selected>Kartu Mahasiswa</option>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="no_identity" id="no_identity" class="form-control col-md-7 col-xs-12" value="<?= $data['no_identitas']; ?>" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Lengkap <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" name="fullname" id="fullname" class="member-name form-control" value="<?= $data['nama_lengkap']; ?>" autocomplete="off">
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Alamat Daerah Asal <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" name="address_1" id="address_1" class="form-control" value="<?= $data['alamat_asal']; ?>" autocomplete="off">
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Alamat / Tempat Tinggal Saat Ini <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" name="address_2" id="address_2" class="form-control" value="<?= $data['alamat_saat_ini']; ?>" autocomplete="off">
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Anggota <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select name="type_of_member" id="type_of_member" class="form-control" tabindex="-1">
                                <?php if ( $data['jenis_anggota'] == "Pelajar" ) : ?>
                                    <option value="Pelajar" selected>Pelajar</option>
                                    <option value="Mahasiswa">Mahasiswa</option>
                                    <option value="Umum">Umum</option>
                                <?php elseif ( $data['jenis_anggota'] == "Mahasiswa" ) : ?>
                                    <option value="Pelajar">Pelajar</option>
                                    <option value="Mahasiswa" selected>Mahasiswa</option>
                                    <option value="Umum">Umum</option>
                                <?php else : ?>
                                    <option value="Pelajar">Pelajar</option>
                                    <option value="Mahasiswa">Mahasiswa</option>
                                    <option value="Umum" selected>Umum</option>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Institusi <span class="required">*</span> <small style="font-style: italic;">(Sekolah, Universitas, Instansi, Kantor)</small></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" name="name_of_institution" id="name_of_institution" class="form-control" value="<?= $data['nama_institusi']; ?>" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Alamat Institusi <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" name="address_of_institution" id="address_of_institution" class="form-control" value="<?= $data['alamat_institusi']; ?>" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Deposit <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" name="deposit" id="deposit" class="form-control" value="<?= $data['deposit']; ?>" autocomplete="off">
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <button type="submit" class="btn btn-primary" onclick="history.go(-1);">Batal</button>
                            <button type="submit" name="btn-update-member" class="btn btn-success">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
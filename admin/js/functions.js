$(function(){
	// LEFT MENU
	$('#sidebar-menu li ul').slideUp();
    $('#sidebar-menu li').removeClass('active');

    $('#sidebar-menu li').on('click touchstart', function() {
        var link = $('a', this).attr('href');

        if(link) { 
            window.location.href = link;
        } else {
            if ($(this).is('.active')) {
                $(this).removeClass('active');
                $('ul', this).slideUp();
            } else {
                $('#sidebar-menu li').removeClass('active');
                $('#sidebar-menu li ul').slideUp();
                
                $(this).addClass('active');
                $('ul', this).slideDown();
            }
        }
    });

    $('#menu_toggle').click(function () {
        if ($('body').hasClass('nav-md')) {
            $('body').removeClass('nav-md').addClass('nav-sm');
            $('.left_col').removeClass('scroll-view').removeAttr('style');
            $('.sidebar-footer').hide();

            if ($('#sidebar-menu li').hasClass('active')) {
                $('#sidebar-menu li.active').addClass('active-sm').removeClass('active');
            }
        } else {
            $('body').removeClass('nav-sm').addClass('nav-md');
            $('.sidebar-footer').show();

            if ($('#sidebar-menu li').hasClass('active-sm')) {
                $('#sidebar-menu li.active-sm').addClass('active').removeClass('active-sm');
            }
        }
    });

    // Sidebar Menu active class
    var url = window.location;
    $('#sidebar-menu a[href="' + url + '"]').parent('li').addClass('current-page');
    $('#sidebar-menu a').filter(function () {
        return this.href == url;
    }).parent('li').addClass('current-page').parent('ul').slideDown().parent().addClass('active');

	/** ******  /LEFT MENU  *********************** **/

    // right_col height flexible
    $(".right_col").css("min-height", $(window).height());
	$(window).resize(function () {
	    $(".right_col").css("min-height", $(window).height());
	});

	/** ******  scrollview  *********************** **/
    $(".scroll-view").niceScroll({
        touchbehavior: true,
        cursorcolor: "rgba(42, 63, 84, 0.35)"
    });

    // Datepicker
    $('.datepicker').datepicker({
	    format: 'yyyy/mm/dd',
	    autoclose: true,
	    // startDate: '-3d'
	});

    // Select
	$(".select2_single").select2({
		placeholder: "Select an item",
		allowClear: true
	});
	$(".select2_group").select2({});
	$(".select2_multiple").select2({
		maximumSelectionLength: 2,
		placeholder: "Max peminjaman 2 buku",
		allowClear: true
	});

	// Table
	$('#my-table').DataTable( {
        "order": [[ 0, "desc" ]]
    });
	// Table2
	$('#my-table-2').DataTable( {
        "order": [[ 0, "asc" ]]
    });

	$(document).ready(function() {
		$('.info-alert').delay(10000).fadeOut(500);
	});

	var em = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
	var numb = /^\d+$/; // /^[0-9]+$/;
	var file = /(\.jpg|\.jpeg|\.png)$/i;
	var alphabeth = /^[A-Za-z ]+$/;

	// var decimalOnly = /^\s*-?[1-9]\d*(\.\d{1,2})?\s*$/;
	// var uppercaseOnly = /^[A-Z]+$/;
	// var lowercaseOnly = /^[a-z]+$/;
	// var stringOnly = /^[A-Za-z0-9]+$/;

	// VALIDATION DATA LIBRARIAN
	$('#form-librarian').on('submit', function()  {
		if ($('#fullname').val() == '') {
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Nama harus diisi !').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
			$('#fullname').css('border','1px solid #f00').focus();
			return false;
		}
		else if (!alphabeth.test($('#fullname').val())) {
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Nama tidak valid !').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
			$('#fullname').css('border','1px solid #f00').focus();
			return false;
		}
		else if ($('#gender').val() == '-1') {
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Pilih jenis kelamin !').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
			$('#gender').css('border','1px solid #f00').focus();
			return false;
		}
		else if ($('#date_of_birth').val() == '') {
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Tanggal lahir harus diisi !').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
			$('#date_of_birth').css('border','1px solid #f00').focus();
			return false;
		}
		else if ($('#place_of_birth').val() == '') {
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Tempat lahir harus diisi !').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
			$('#place_of_birth').css('border','1px solid #f00').focus();
			return false;
		}
		else if ($('#marital_status').val() == '-1') {
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Status perkawinan harus diisi !').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
			$('#marital_status').css('border','1px solid #f00').focus();
			return false;
		}
		else if ($('#phone').val() == '') {
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> No. Telepon harus diisi !').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
			$('#phone').css('border','1px solid #f00').focus();
			return false;
		}
		else if (!numb.test($('#phone').val())) {
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> No. Telepon tidak valid !').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
			$('#phone').css('border','1px solid #f00').focus();
			return false;
		}
		else if ($('#email').val() == '') {
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Email harus diisi !').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
			$('#email').css('border','1px solid #f00').focus();
			return false;
		}
		else if (!em.test($('#email').val())) {
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Email tidak valid !').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
			$('#email').css('border','1px solid #f00').focus();
			return false;
		}
		else if ($('#address').val() == '') {
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Alamat harus diisi !').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
			$('#address').css('border','1px solid #f00').focus();
			return false;
		}
		else if ($('#photo').val() == '') {
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Silahkan upload foto Anda !').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
			$('#photo').css('border','1px solid #f00').focus();
			return false;
		}
		else if(!file.exec($('#photo').val())){
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Foto harus ber-extentions jpg, jpeg, atau png !').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
			$('#photo').css('border','1px solid #f00').focus();
			return false;
		}
		else if ($('#username').val() == '') {
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Username harus diisi !').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
			$('#username').css('border','1px solid #f00').focus();
			return false;
		}
		else if ($('#password').val() == '') {
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Password harus diisi !').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
			$('#password').css('border','1px solid #f00').focus();
			return false;
		}
		else if ($('#password').val().length < 8) {
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Panjang password minimal 8 karakter !').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
			$('#password').css('border','1px solid #f00').focus();
			return false;
		}
		else if ($('#librarian_status').val() == '-1') {
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Status petugas perpustakaan harus diisi !').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
			$('#librarian_status').css('border','1px solid #f00').focus();
			return false;
		}
	});

	$('#fullname').bind('keydown paste', function() {
		$(this).removeAttr('style');
		$('.info-warning').html('').css({'display':'none'});
		// in edit
        $(this).removeAttr("readonly");
        $('#btn-edit-librarian').removeAttr("disabled");
	});
	$('#gender').on('change',function() {
		$(this).removeAttr('style');
		$('.info-warning').html('').css({'display':'none'});
		// in edit
        $(this).removeAttr("readonly");
        $('#btn-edit-librarian').removeAttr("disabled");
	});
	$('#date_of_birth').bind('change keydown paste', function() {
		$(this).removeAttr('style');
		$('.info-warning').html('').css({'display':'none'});
		// in edit
        $(this).removeAttr("readonly");
        $('#btn-edit-librarian').removeAttr("disabled");
	});
	$('#place_of_birth').bind('keydown paste', function() {
		$(this).removeAttr('style');
		$('.info-warning').html('').css({'display':'none'});
		// in edit
        $(this).removeAttr("readonly");
        $('#btn-edit-librarian').removeAttr("disabled");
	});
	$('#marital_status').on('change', function() {
		$(this).removeAttr('style');
		$('.info-warning').html('').css({'display':'none'});
		// in edit
        $(this).removeAttr("readonly");
        $('#btn-edit-librarian').removeAttr("disabled");
	});
	$('#phone').bind('keydown paste', function() {
		$(this).removeAttr('style');
		$('.info-warning').html('').css({'display':'none'});
		// in edit
        $(this).removeAttr("readonly");
        $('#btn-edit-librarian').removeAttr("disabled");
	});
	$('#email').bind('keydown paste', function() {
		$(this).removeAttr('style');
		$('.info-warning').html('').css({'display':'none'});
		// in edit
        $(this).removeAttr("readonly");
        $('#btn-edit-librarian').removeAttr("disabled");
	});
	$('#address').bind('keydown paste', function() {
		$(this).removeAttr('style');
		$('.info-warning').html('').css({'display':'none'});
		// in edit
        $(this).removeAttr("readonly");
        $('#btn-edit-librarian').removeAttr("disabled");
	});
	$('#photo').on('change', function() {
		$(this).removeAttr('style');
		$('.info-warning').html('').css({'display':'none'});
	});
	$('#username').bind('keydown paste', function() {
		$(this).removeAttr('style');
		$('.info-warning').html('').css({'display':'none'});
		// in edit
        $(this).removeAttr("readonly");
        $('#btn-edit-librarian').removeAttr("disabled");
	});
	$('#password').bind('keydown paste', function() {
		$(this).removeAttr('style');
		$('.info-warning').html('').css({'display':'none'});
	});
	$('#librarian_status').on('change', function() {
		$(this).removeAttr('style');
		$('.info-warning').html('').css({'display':'none'});
		// in edit
        $(this).removeAttr("readonly");
        $('#btn-edit-librarian').removeAttr("disabled");
	});

	// VALIDATION EDIT DATA LIBRARIAN
	$('#form-edit-librarian').on('submit', function() {
		if ($('#fullname').val() == '') {
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Nama harus diisi !').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
			$('#fullname').css('border','1px solid #f00').focus();
			return false;
		}
		else if (!alphabeth.test($('#fullname').val())) {
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Nama tidak valid !').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
			$('#fullname').css('border','1px solid #f00').focus();
			return false;
		}
		else if ($('#gender').val() == '-1') {
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Pilih jenis kelamin !').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
			$('#gender').css('border','1px solid #f00').focus();
			return false;
		}
		else if ($('#date_of_birth').val() == '') {
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Tanggal lahir harus diisi !').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
			$('#date_of_birth').css('border','1px solid #f00').focus();
			return false;
		}
		else if ($('#place_of_birth').val() == '') {
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Tempat lahir harus diisi !').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
			$('#place_of_birth').css('border','1px solid #f00').focus();
			return false;
		}
		else if ($('#marital_status').val() == '-1') {
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Status perkawinan harus diisi !').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
			$('#marital_status').css('border','1px solid #f00').focus();
			return false;
		}
		else if ($('#phone').val() == '') {
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> No. Telepon harus diisi !').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
			$('#phone').css('border','1px solid #f00').focus();
			return false;
		}
		else if (!numb.test($('#phone').val())) {
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> No. Telepon tidak valid !').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
			$('#phone').css('border','1px solid #f00').focus();
			return false;
		}
		else if ($('#email').val() == '') {
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Email harus diisi !').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
			$('#email').css('border','1px solid #f00').focus();
			return false;
		}
		else if (!em.test($('#email').val())) {
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Email tidak valid !').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
			$('#email').css('border','1px solid #f00').focus();
			return false;
		}
		else if ($('#address').val() == '') {
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Alamat harus diisi !').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
			$('#address').css('border','1px solid #f00').focus();
			return false;
		}
		else if ($('#username').val() == '') {
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Username harus diisi !').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
			$('#username').css('border','1px solid #f00').focus();
			return false;
		}
		else if ($('#librarian_status').val() == '-1') {
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Status petugas perpustakaan harus diisi !').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
			$('#librarian_status').css('border','1px solid #f00').focus();
			return false;
		}
	});

	// ADD DATA BOOKS
	$('#add-data-books').on('click', function() {
		$('.form-add-books').fadeIn();
		$('#add-data-books').hide();
	});
	$('#cancel-add-books').on('click', function() {
		$('#add-books')[0].reset(); // reset form
		$('.form-add-books').hide();
		$('#add-data-books').show();	
	});

	// VALIDATION DATA BOOKS
	$('.form-books').on('submit', function() {
		if ($('#title').val() == '') {
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Judul buku tidak boleh kosong !').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
			$('#title').css('border','1px solid #f00').focus();
			return false;
		}
		else if ($('#category_books').val() == '-1') {
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Anda belum memilih kategori buku !').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
			$('.select2-selection').css('border','1px solid #f00').focus();
			return false;
		}
		else if ($('#author').val() == '') {
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Nama penulis tidak boleh kosong !').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
			$('#author').css('border','1px solid #f00').focus();
			return false;
		}
		else if ($('#publisher').val() == '') {
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Nama penerbit tidak boleh kosong !').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
			$('#publisher').css('border','1px solid #f00').focus();
			return false;
		}
		else if ($('#physical_description').val() == '') {
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Deskripsi fisik buku harus diisi !').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
			$('#physical_description').css('border','1px solid #f00').focus();
			return false;
		}
		else if ($('#description').val() == '') {
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Deskripsi buku harus diisi !').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
			$('#description').css('border','1px solid #f00').focus();
			return false;
		}
		else if ($('#count').val() == '') {
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Stok buku harus diisi !').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
			$('#count').css('border','1px solid #f00').focus();
			return false;
		}
		else if (!numb.test($('#count').val())) {
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Stok buku hanya boleh diisi diisi dengan angka !. Contoh: 1000').css({'display':'block', 'color':'#fff', 'margin-top':'0'});
			$('#count').css('border','1px solid #f00').focus();
			return false;
		}
	});

	$('#title').bind('keydown paste', function() {
		$(this).removeAttr('style');
		$('.info-warning').html('').css({'display':'none'});
		// in edit
		$('.btn-update-books').removeAttr("disabled");
	});
	$('#category_books').on('change', function() {
		$('.select2-selection').removeAttr('style');
		$('.info-warning').html('').css({'display':'none'});
		// in edit
		$('.btn-update-books').removeAttr("disabled");
	});
	$('#author').bind('keydown paste', function() {
		$(this).removeAttr('style');
		$('.info-warning').html('').css({'display':'none'});
		// in edit
		$('.btn-update-books').removeAttr("disabled");
	});
	$('#publisher').bind('keydown paste', function() {
		$(this).removeAttr('style');
		$('.info-warning').html('').css({'display':'none'});
		// in edit
		$('.btn-update-books').removeAttr("disabled");
	});
	$('#isbn').bind('keydown paste', function() {
		// in edit
		$('.btn-update-books').removeAttr("disabled");
	});
	$('#physical_description').bind('keydown paste', function() {
		$(this).removeAttr('style');
		$('.info-warning').html('').css({'display':'none'});
		// in edit
		$('.btn-update-books').removeAttr("disabled");
	});
	$('#description').bind('keydown paste', function() {
		$(this).removeAttr('style');
		$('.info-warning').html('').css({'display':'none'});
		// in edit
		$('.btn-update-books').removeAttr("disabled");
	});
	$('#count').bind('keydown paste', function() {
		$(this).removeAttr('style');
		$('.info-warning').html('').css({'display':'none'});
		// in edit
		$('.btn-update-books').removeAttr("disabled");
	});
	$('#cover').bind('change', function() {
		// in edit
		$('.btn-update-books').removeAttr("disabled");
	});

	// VALIDATION STATUS BOOKS
	$('#form-status-books').on('submit', function(e) {
		if ($('#date').val() == '') {
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Tanggal harus diisi !').css({'display':'block'});
			$('#date').css('border','1px solid #f00').focus();
			return false;
		}
		else if ($('#member_name').val() == '-1') {
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Silahkan pilih nama anggota terlebih dahulu !').css({'display':'block'});
			$('#select2-member_name-container').css('border','1px solid #f00').focus();
			return false;
		}
		else if ($('#my_books').val() == '-1') {
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Silahkan pilih judul buku terlebih dahulu !').css({'display':'block'});
			$('#select2-my_books-container').css('border','1px solid #f00').focus();
			return false;
		}
		else if ($('#information').val() == '-1') {
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Silahkan pilih keterangan buku !').css({'display':'block'});
			$('#information').css('border','1px solid #f00').focus();
			return false;
		}
		else if ($('#biaya_ganti').val() == '') {
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Biaya ganti kerusakan/ kehilangan buku harus diisi !').css({'display':'block'});
			$('#biaya_ganti').css('border','1px solid #f00').focus();
			return false;
		}
		else if (!numb.test($('#biaya_ganti').val())) {
			$('.info-warning').html('<i class="fa fa-exclamation-triangle"></i> Nominal uang hanya boleh diisi dengan angka !. Contoh: 10000').css({'display':'block'});
			$('#biaya_ganti').css('border','1px solid #f00').focus();
			return false;
		}
	});

	$('#date').change(function() {
		$(this).removeAttr('style');
		$('.info-warning').html('').css({'display':'none'});
		// in edit
		$('.btn-update-status-books').removeAttr("disabled");
	});
	$('#member_name').change(function() {
		$('#select2-member_name-container').removeAttr('style');
		$('.info-warning').html('').css({'display':'none'});
		// in edit
		$('.btn-update-status-books').removeAttr("disabled");
	});
	$('#my_books').change(function() {
		$('#select2-my_books-container').removeAttr('style');
		$('.info-warning').html('').css({'display':'none'});
		// in edit
		$('.btn-update-status-books').removeAttr("disabled");
	});
	$('#information').bind('change keydown paste', function() {
		$(this).removeAttr('style');
		$('.info-warning').html('').css({'display':'none'});
		// in edit
		$('.btn-update-status-books').removeAttr("disabled");
	});
	$('#optional').bind('change keydown paste', function() {
		// in edit
		$('.btn-update-status-books').removeAttr("disabled");
	});
	$('#biaya_ganti').bind('change keydown paste', function() {
		$(this).removeAttr('style');
		$('.info-warning').html('').css({'display':'none'});
		// in edit
		$('.btn-update-status-books').removeAttr("disabled");
	});

	// VALIDATION ADD BORROWONG
	$('#add-borrowong').on('submit', function() {
		if ($('#member_name').val() == '-1') {
			$('.info-warning').html('Silahkan pilih nama anggota terlebih dahulu !');
			$('.select2-selection').css('border','1px solid #f00').focus();
			return false;
		}
		else if ($('#date_borrowing').val() == '') {
			$('.info-warning').html('Tanggal pinjam harus diisi !');
			$('#date_borrowing').css('border','1px solid #f00').focus();
			return false;
		}
		else if ($('#due_date').val() == '') {
			$('.info-warning').html('Tanggal jatuh tempo harus diisi !');
			$('#due_date').css('border','1px solid #f00').focus();
			return false;
		}
	});

	$('#member_name').change(function() {
		$('.select2-selection').removeAttr('style');
		$('.info-warning').html('');
	});
	$('#date_borrowing').change(function() {
		$(this).removeAttr('style');
		$('.info-warning').html('');
	});
	$('#due_date').change(function() {
		$(this).removeAttr('style');
		$('.info-warning').html('');
	});

	// ADD DATA CATEGORIES
	$('#add-data-categories').on('click', function() {
		$('.form-add-categories').fadeIn();
		$('#add-data-categories').hide();
	});
	$('#cancel-add-categories').on('click', function() {
		$('#add-categories')[0].reset(); // reset form
		$('.form-add-categories').hide();
		$('#add-data-categories').show();
		$('#categories').removeAttr('style');
        $('.info-warning').html('');
	});

	// ADD DATA BORROWING
	$('#add-data-borrowing').on('click', function() {
		$('.form-add-borrowing').fadeIn();
		$('#add-data-borrowing').hide();
	});
	$('#cancel-add-borrowing').on('click', function() {
		$('#add-borrowing')[0].reset(); // reset form
		$('.form-add-borrowing').hide();
		$('#add-data-borrowing').show();
		$('.select2-selection').removeAttr('style');
        $('.info-warning').html('');
	});

	$('#add-new-data').on('click', function() {
		$('.form-add-new-data').fadeIn();
		$(this).prop("disabled",true);
	});
	$('#cancel-add-data').on('click', function() {
		$('#add-borrowing')[0].reset(); // reset form
		$('.form-add-new-data').hide();
		$('#add-new-data').prop("disabled",false);
	});

	// REMOVE IMG
	$('.upload-new').hide();
	$('.remove-img').on('click', function() {
		$('.display-img').hide();
		$('.upload-new').fadeIn();
	});

	// remove disable
    $('.my-category').bind('keydown paste', function() {
       	$('.update-category').removeAttr("disabled");
    });

	// Edit/Update category
    $(document).on('click', '.update-category', function() {
        var id_updt = $(this).prop("value");
        var categoryname = $('#categoryname'+id_updt).val();

         $('#categoryname').bind('keydown paste', function() {
            $(this).removeAttr('style');
           	$("#info-update"+id_updt).html('');
        });

        if ( categoryname == '' ) {
            $('#categoryname'+id_updt).css({'border':'1px solid #f00'}).focus();
            $("#info-update"+id_updt).html('Nama kategori tidak boleh kosong !').css({'color':'#f00'});
            $('#categoryname'+id_updt).keydown(function() {
	            $(this).removeAttr('style');
	           	$("#info-update"+id_updt).html('');
	        });
	    }
	    else if (!alphabeth.test(categoryname)) {
			$('#categoryname'+id_updt).css({'border':'1px solid #f00'}).focus();
            $("#info-update"+id_updt).html('Nama kategori tidak valid !').css({'color':'#f00'});
            $('#categoryname'+id_updt).keydown(function() {
	            $(this).removeAttr('style');
	           	$("#info-update"+id_updt).html('');
	        });
        } else {  
            $.ajax({
                type 	 : "POST",
                url 	 : "update.php?id_cat="+id_updt,
                data 	 : { categoryname: categoryname },
                // dataType : "JSON",
					// beforeSend: function() {
					// 	$('#loader_img').show(); // display loader
					// },
                    success: function(data) {
                    	// if ( proccess = 1 ) {
	                    	// $('.tbl-category').html(data);
	                    	// alert(data.html);
	                    	// $('.data-category'+id_updt).append(data);
							$("#info-update"+id_updt).html(data).css({'color':'#14DF1E'});
							$('.update-category').attr('disabled','disabled');
							$('#categoryname'+id_updt).attr('readonly','true');
							// $('table').load('kategori-data.php table'); // refresh
							
							// var auto_refresh = setInterval(
						 //    function () {
						 //       $('#load_content').load('show.php').fadeIn("slow");
						 //    }, 10000); // refresh setiap 10000 milliseconds
							// console.log(data);
						// }
                    },

                    error: function(jqXHR, status, error) {
                        console.log( "Sorry, there was a problem!" );  
                    }
            }); // END: ajax
            return false;
        } // END: check data
    });

	$(document).on('click', '.my-close-btn', function() {
		location.reload();
	});

	// Action returning
	$(document).on('click', '.btn-save-returning', function() { 
	 	$( '.btn-close' ).replaceWith( '<button aria-hidden="true" class="my-close-btn close" type="button">×</button>' ); // replace btn close
	  	$(this).prop("disabled",true); 	// disable btn returning

		var the_id = $(this).prop("value");
		var date_borrowing = $('#date_borrowing'+the_id).val();
		var date_returning = $('#date_returning'+the_id).val();
		var denda = $('#denda'+the_id).val();

	    $('#loader_img').show(); // display loader
	              
		$.ajax({
			type: "POST",
			url: "pengembalian-proses.php?id="+the_id,
			data: { date_borrowing: date_borrowing, date_returning: date_returning, denda: denda },
			success: function(data){
				$('#loader_img').hide();
				$('.info-process'+the_id).html(data);

				setTimeout( function() {
				    location.reload();
				}, 5000);
				// $( ".data-borrowing" ).load( "?p=peminjaman .data-borrowing" ); // refresh
				// console.log(data);
			},

			error: function(jqXHR, status, error) {
				console.log( 'Sorry, there was a problem!' );  
			}
		}); // END: ajax
		return false;
	});

	// Load functions
    $(window).load(function() {
        $("#preloader").fadeOut("slow");  // Loader pages
    });

 //    $("#button").click(function() {
	//     $('html, body').animate({
	//         scrollTop: $("#myDiv").offset().top
	//     }, 500);
	// });
	
});
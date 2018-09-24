<?php
$bks = new Books();
$categories = $bks->display_category();
?>
 
 <script type="text/javascript">
    // validate
    function validate() {
        $('.info-warning').css({'color':'#f00'});
        var category = document.myForm.categories.value.trim();
       	var alphabeth = /^[a-zA-Z ]+$/;

        if (category == "") {
            $('.info-warning').html('Nama kategori tidak boleh kosong !');
            $('#categories').css({'border':'1px solid #f00'});
            $('#categories').keydown(function(){
                $(this).removeAttr('style');
                $('.info-warning').html('');
            });
            return false;
        }
 
    	if (!alphabeth.test($('#categories').val())) {
            $('.info-warning').html('Nama kategori tidak valid !');
            $('#categories').css({'border':'1px solid #f00'});
            $('#categories').keydown(function(){
                $(this).removeAttr('style');
                $('.info-warning').html('');
            });
            return false;
        }
        return true;
    }
</script>

<div class="row form-add-categories">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_title">
			<h2>Tambah Kategori Buku</h2>
			<div class="clearfix"></div>
		</div>
		<div class="x_content">
			<form action="tambah.php" method="post" name="myForm" class="form-horizontal form-label-left" id="add-categories" onsubmit="return(validate());">

				<div class="form-group">
					<input type="text" name="categories" id="categories" class="form-control col-md-7 col-xs-12" placeholder="Kategori Buku" autocomplete="off">
				</div>
				
				<div class="form-group">
					<div class="row">
						<div class="col-md-3">
							<button type="button" class="btn btn-primary" id="cancel-add-categories">Batal</button>
							<button type="submit" name="btn-add-category" class="btn btn-success">Simpan</button>
						</div>
						<div class="col-md-9 text-right">
							<div class="info-warning" style="line-height: 35px;"></div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="row">
    <div class="col-md-12">
        <h2 class="page-header">Data Kategori Buku</h2>
    </div>
</div>
<button type="button" class="btn btn-primary" id="add-data-categories">Tambah Kategori Buku</button>
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
				<table id="my-table-2" class="table table-striped responsive-utilities jambo_table">
					<thead>
						<tr>
							<th>No</th>
							<th width="900">Kategori Buku</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
					 	<?php
					 	$no = 1;
                        // $data_category = $categories->fetch(PDO::FETCH_ASSOC);
                        // foreach ( $data_category as $data ) :
                        while( $data = $categories->fetch( PDO::FETCH_ASSOC ) ) :
                        // var_dump($data_category );
                        ?>
							<tr class="data-category<?php echo $data['kategori_id']; ?>">
								<td><?= $no; ?></td>
								<td><?= $data['kategori_nama']; ?></td>
								<td>
									<a href="#myModal<?php echo $data['kategori_id']; ?>" data-toggle="modal" title="Edit"><i class="fa fa-edit"></i></a> || 
									<a href="delete.php?del_cat=<?= $data['kategori_id']; ?>" title="Hapus"><i class="fa fa-trash"></i></a>
								</td>
							</tr>

							<!-- -->
							<div aria-hidden="true" aria-labelledby="myModalLabel<?php echo $data['kategori_id']; ?>" role="dialog" tabindex="-1" id="myModal<?php echo $data['kategori_id']; ?>" class="modal fade">
								<div class="modal-dialog">
								    <div class="modal-content">
								        <div class="modal-header">
								            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
								            <h4 class="modal-title">Edit Kategori</h4>
								        </div>
								        <div class="modal-body">

								            <form role="form">
								                <div class="form-group">
								                    <label for="categoryname">Kategori</label>
								                    <input type="text" class="form-control my-category" id="categoryname<?php echo $data['kategori_id']; ?>" value="<?php echo $data['kategori_nama']; ?>">
								                </div>
								                <div class="form-group">
								                  <button type="button" value="<?php echo $data['kategori_id']; ?>" class="update-category btn btn-primary" disabled="disabled">Update</button>
								                </div>
								            </form>

								            <div id="info-update<?php echo $data['kategori_id']; ?>"></div>
								            <div id="loader-img"></div>

								        </div>
								    </div>
								</div>
							</div>
							<!-- -->  
						 <?php $no++; endwhile; // endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="clearfix"></div>
<?php
include_once 'includes/class.php';
$ks = new Messages();
$get_data = $ks->display_message();
?>

<div class="row">
    <div class="col-md-12">
        <h2 class="page-header">Pesan Masuk</h2>
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
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Isi Pesan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 1; foreach( $get_data as $data ) : ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $data['nama']; ?></td>
                                <td><?php echo $data['email']; ?></td>
                                <td><?php echo $data['telp']; ?></td>
                                <td><?php echo $data['isi_pesan']; ?></td>
                                <td><a href="delete.php?msg=<?php echo $data['id_pesan']; ?>" title="delete"><i class="fa fa-trash"></i></a></td>
                            </tr>
                        <?php $no++; endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
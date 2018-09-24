<?php
if ( isset( $_GET['id'] ) ) :
    include_once 'includes/class.php';
    $rtn = new Returning();
    $brw = new Borrowing();
    $bks = new Books();
    $ks = new Kas();

    $the_book = '';
    $get_stock_book = '';
    $get_book_based_id = '';
    $count_of_book = '';

    $borrowing_id = $_GET['id'];
    $date_returning = $_POST['date_returning'];
    $denda = $_POST['denda'];
    $insert_returning = $rtn->insert_returning( $borrowing_id, $date_returning, $denda );

    if ( $insert_returning ) {
        echo '<div class="alert alert-success"><i class="fa fa-check"></i> Data pengembalian buku berhasil disimpan.</div>';
        
        // Proses mengembalikan stok buku seterah buku dikembalikan
        $get_detail_borrowing_by_borowing_id = $brw->get_detail_borrowing_by_borowing_id( $borrowing_id ); // Ambil data detail peminjaman
        while( $get_book_in_list_borrowing = $get_detail_borrowing_by_borowing_id->fetch( PDO::FETCH_ASSOC ) ) {
            $the_book = $get_book_in_list_borrowing['buku_id'];
            $get_stock_book = $bks->get_stock_book( $the_book ); // Ambil stock buku untuk mengembalikan jumlah stok peminjaman buku setelah dikembalikan
            $get_book_based_id = $get_stock_book->fetch( PDO::FETCH_ASSOC );
            // Proses membatalkan pengurangan stok buku
            $count_of_book = $get_book_based_id['buku_jumlah'] + 1;
            // Update stok buku jika batal pinjam
            $bks->update_stock_book( $the_book, $count_of_book );
        }

        $get_returning = $rtn->get_returning_by_borrowing_id( $borrowing_id );
        $data_returning = $get_returning->fetch( PDO::FETCH_ASSOC );
        $returning_id = $data_returning['pengembalian_id'];

        // echo "<script>alert( '$returning_id' );</script>";

        // Mengupdate status peminjaman
        $brw->update_status_borrowing( $borrowing_id, '1' );

        // Proses insert otomatis ketable kas jika ada denda
        if ( $denda != 0 ) {
            $ks->add_kas( $returning_id, '', $denda );  
        } else {
            return false;
        }
       
    } else {
        return false;
    }
endif;

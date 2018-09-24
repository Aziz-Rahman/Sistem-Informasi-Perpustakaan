<?php
$bks = new Books(); // instansiasi obj
$get_book_id = anti_injection( $_GET['id'] );
$get_data_book_by_id = $bks->get_data_book_by_id( $get_book_id );
$data = $get_data_book_by_id->fetch( PDO::FETCH_ASSOC );
// Related post
$related_post = $bks->related_post_of_book( $data['kategori_id'], $get_book_id );
?>

<section class="azz-section">
    <div class="azz-section__container container azz-section__container--first">
        <div class="azz-header azz-header--wysiwyg row">
            <div class="col-md-8 col-sm-offset-2" style="margin-bottom: 60px;">
                <h2 class="book-title"><?= $data['buku_judul']; ?></h2>
                <div class="col-md-12" style="padding: 0;">
                    <div class="col-sm-6 col-md-4" style="padding-left: 0;">
                        <img src="admin/images/books/<?= $data['buku_cover']; ?>" width="100%" height="auto" alt="<?= $data['buku_judul']; ?>">
                        <span style="margin-right: 10px;">Share It:</span>
                        <div class="share-buttons">
                            <a class="social-icons icon-facebook" title="Facebook" href="#"><i class="fa fa-facebook"></i></a> 
                            <a class="social-icons icon-google" title="Google+" href="#"><i class="fa fa-google-plus"></i></a>
                            <a class="social-icons icon-twitter" title="Twitter" href="#"><i class="fa fa-twitter"></i></a>
                            <a class="social-icons icon-pinterest" title="Pinterest" href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-8 info-detail-books" style="padding-right: 0;">
                        <table>
                            <tr>
                                <td width="150">ID Buku</td>
                                <td width="15">:</td>
                                <td><?= $data['buku_id']; ?></td>
                            </tr>
                            <tr>
                                <td>Kategori</td>
                                <td>:</td>
                                <td><?= $data['kategori_id']; ?></td>
                            </tr>
                            <tr>
                                <td>Penulis</td>
                                <td>:</td>
                                <td><?= $data['penulis']; ?></td>
                            </tr>
                            <tr>
                                <td>Penerbit</td>
                                <td>:</td>
                                <td><?= $data['penerbit']; ?></td>
                            </tr>
                            <tr>
                                <td>ISBN</td>
                                <td>:</td>
                                <td><?= $data['isbn']; ?></td>
                            </tr>
                            <tr>
                                <td>Deskripsi Fisik</td>
                                <td>:</td>
                                <td><?= $data['deskripsi_fisik']; ?></td>
                            </tr>
                            <tr>
                                <td>Deskripsi Buku</td>
                                <td>:</td>
                                <td><?= $data['buku_deskripsi']; ?></td>
                            </tr>
                            <tr>
                                <td>Ketersediaan</td>
                                <td>:</td>
                                <td><?= $data['buku_jumlah']; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-md-12" style="padding: 0; margin-top: 50px;">
                    <h3 class="title-related">Related Post</h3>
                    <?php 
                    foreach ( $related_post as $related ) {
                        echo '<div class="col-md-3 related-post">';
                            echo '<img src="admin/images/books/'. $related['buku_cover'] .'" width="100%" height="auto" alt="">';
                            echo '<div class="overlay-related-post"><a href="./?p=detail-buku&id='. $related['buku_id'] .'">'. substr( $related['buku_judul'], 0, 18 ) .' ...' .'</a></div>';
                        echo '</div>';
                    } 
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
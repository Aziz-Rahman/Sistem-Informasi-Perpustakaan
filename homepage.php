<?php
include_once 'admin/includes/functions.php';
include_once 'admin/includes/class.php';

$bks = new Books(); // instansiasi obj
$get_data = $bks->recent_post_of_book();
?>

<section class="azz-section">
    <div class="azz-section__container container azz-section__container--isolated">
        <div class="azz-header azz-header--wysiwyg row">
            <div class="col-md-12 library-promo">
                <div class="text-sec-title center text-center mb50 wow bounceInDown animated animated" data-wow-duration="500ms" style="visibility: visible; animation-duration: 500ms; animation-name: bounceInDown;">
                    <h2 class="features-title">Layanan Perpustakaan Nusantara</h2>
                    <div class="devider"><i class="fa fa-heart-o fa-lg"></i></div>
                </div>
                <div class="text-content-promo wow fadeInRight animated" data-wow-duration="500ms" style="visibility: visible; animation-duration: 500ms; animation-name: fadeInRight;">
                    Repellat Molestiae Non Recusandae
                    Asperiores Repellat
                    In this chapter we will study how to create forms. Yes, I can. Please drop me a line to sergey-at-pozhilov.com and describe your needs in details. Please note, my services are not cheap.
                </div>
            </div>
            <div class="col-md-12 content-promo">
                <div class="col-xs-6 col-sm-3 col-md-3 wow fadeInUp animated animated" data-wow-duration="400ms" data-wow-delay="900ms" style="visibility: visible; animation-duration: 400ms; animation-delay: 900ms; animation-name: fadeInUp;">
                    <div class="single-promo promo1">
                        <i class="fa fa-gift"></i>
                        <p>New Books</p>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3 col-md-3 wow fadeInUp animated animated" data-wow-duration="400ms" style="visibility: visible; animation-duration: 400ms; animation-name: fadeInUp;">
                    <div class="single-promo promo2">
                        <i class="fa fa-refresh"></i>
                        <p>2 Weeks Borrowing</p>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3 col-md-3 wow fadeInUp animated animated" data-wow-duration="400ms" data-wow-delay="300ms" style="visibility: visible; animation-duration: 400ms; animation-delay: 300ms; animation-name: fadeInUp;">
                    <div class="single-promo promo3">
                        <i class="fa fa-book"></i>
                        <p>3 Books Borrowing</p>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3 col-md-3 wow fadeInUp animated animated" data-wow-duration="400ms" data-wow-delay="600ms" style="visibility: visible; animation-duration: 400ms; animation-delay: 600ms; animation-name: fadeInUp;">
                    <div class="single-promo promo4">
                        <i class="fa fa-lock"></i>
                        <p>satisfactory service</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="azz-box azz-section azz-section--relative azz-section--fixed-size azz-section--full-height azz-section--bg-adapted azz-parallax-background" id="header1-22" style="background-image: url(assets/images/parallax-1.jpg);">
    <div class="azz-box__magnet azz-box__magnet--sm-padding azz-box__magnet--center-left">
        <div class="azz-overlay" style="opacity: 0.5; background-color: rgba(41, 145, 176, 0.92)"></div>
        <div class="azz-box__container azz-section__container container">
            <div class="azz-box azz-box--stretched"><div class="azz-box__magnet azz-box__magnet--center-left">
                <div class="row"><div class=" col-sm-6">
                    <div class="azz-hero animated fadeInUp">
                        <h2 class="azz-hero__text">MENYEDIAKAN BERBAGAI MACAM BUKU</h2>
                        <p class="azz-hero__subtext">Mobirise template is free and you can use it in your commercial as well as your personal works.<br></p>
                    </div>
                    <div class="azz-buttons btn-inverse azz-buttons--left">
                        <a class="azz-cloud btn btn-lg animated fadeInUp delay btn-info" href="./?p=buku-perpustakaan">LIHAT BUKU</a> 
                    </div>
                </div></div>
            </div></div>
        </div>
        <div class="azz-arrow azz-arrow--floating text-center">
            <div class="azz-section__container container">
                <a class="azz-arrow__link" href="#msg-box5-25"><i class="glyphicon glyphicon-menu-down"></i></a>
            </div>
        </div>
    </div>
</section>

<section class="azz-gallery azz-section azz-section--no-padding" id="gallery1-28" style="background-color: rgb(239, 239, 239);">
    <div class=" azz-gallery-layout-default">
        <div>
            <div class="row azz-gallery-row no-gutter">
                <?php foreach ( $get_data as $recent ) { ?>
                    <div class="col-md-3 col-sm-6 azz-gallery-item">
                        <a href="./?p=detail-buku&id=<?php echo $recent['buku_id']; ?>">
                            <img alt="" src="admin/images/books/<?php echo $recent['buku_cover']; ?>">
                            <!-- <span class="icon glyphicon glyphicon-zoom-in"></span> -->
                            <div class="overlay-recent"><h3 class="recent-title"><?php echo $recent['buku_judul']; ?></h3></div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</section>

<section class="azz-section azz-section--relative azz-parallax-background" id="msg-box5-25" style="background-image: url(assets/images/parallax-2.jpg);">
    <div class="azz-overlay" style="opacity: 0.5; background-color: rgb(3, 109, 86);"></div>
    <div class="azz-section__container azz-section__container--isolated container">
        <div class="row">
            <div class="azz-box azz-box--fixed azz-box--adapted">
                <div class="azz-box__magnet azz-box__magnet--top-right azz-section__left col-sm-6">
                    <figure class="azz-figure azz-figure--adapted azz-figure--caption-inside-bottom azz-figure--full-width"><img class="azz-figure__img" src="assets/images/library-3.jpg"></figure>
                </div>
                <div class="azz-box__magnet azz-class-azz-box__magnet--center-left col-sm-6 azz-section__right">
                    <div class="azz-section__container azz-section__container--middle">
                        <div class="azz-header azz-header--auto-align azz-header--wysiwyg">
                            <h2 class="azz-header__text color-white">Tentang Perpustakaan Nusantara</h2>
                            
                        </div>
                    </div>
                    <div class="azz-section__container azz-section__container--middle">
                        <div class="azz-article azz-article--auto-align azz-article--wysiwyg"><p>Donec interdum elit arcu, eu feugiat dui vestibulum eget. Vivamus condimentum nunc purus, posuere pharetra augue iaculis eu. Curabitur eu sapien at nulla vehicula rutrum et eget sapien. Nam lobortis porta mattis. In gravida nisl sed pellentesque pharetra. Proin tempus interdum lacus, vel tristique nisl blandit sit amet. Nulla ut imperdiet quam. Vestibulum vulputate magna nec cursus euismod.&nbsp;</p></div>
                    </div>
                    <div class="azz-section__container">
                        <div class="azz-buttons azz-buttons--auto-align"><a class="azz-buttons__btn btn btn-cloud btn-lg" href="./?p=tentang-kami">Selengkapnya</a></div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>

<section class="azz-section azz-section--relative azz-section--fixed-size" id="form1-35" style="background-color: rgb(255, 255, 255);">
    <div class="azz-section__container azz-section__container--std-padding container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2" data-form-type="formoid">
                        <div class="azz-header azz-header--center azz-header--std-padding">
                            <h2 class="azz-header__text">KONTAK KAMI</h2>
                        </div>
                        <div data-form-alert="true"></div>
                        <form id="contact-messages">
                           <div class="form-group input-field">
                                <input type="text" name="name" id="msg-name" placeholder="Name" class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group input-field">
                                <input type="email" name="email" id="msg-email" placeholder="Email" class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group input-field">
                                <input type="text" name="telp" id="msg-telp" placeholder="Phone" class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <textarea name="message" id="messages" rows="6" placeholder="Message" class="form-control"></textarea>
                            </div>
                            <div id="loader_img"><img src="assets/images/loading.gif" alt="loading ..."></div> <!-- Loader -->
                            <div class="info-warning"></div> <!-- INFO EXECUTE -->
                            <input type="submit" name="btn-messages" value="Send message" id="save-messages" class="btn btn-cloud btn-lg pull-right">
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="simple col-1 col-undefined azz-parallax-background azz-after-navbar" id="content5-77" style="background-image: url(assets/images/parallaxs-2.jpg);">
    <div class="azz-overlay" style="opacity: 0.6; background-color: rgb(0, 0, 0);"></div>
    <div class="container">
        <div class="row page-header">
            <div class="col-md-12">
                <div class="caption">
                    <?php if ( $page == "buku-perpustakaan" ) : ?>
                        <h2 class="title-header-page">Buku Perpustakaan Nusantara</h2>
                    <?php elseif ( $page == "detail-buku" ) : ?>
                        <h2 class="title-header-page">Detail Buku</h2>
                    <?php elseif ( $page == "tentang-kami" ) : ?>
                        <h2 class="title-header-page">Tentang Perpustakaan Nusantara</h2>
                    <?php elseif ( isset( $searchBooks ) == "" ) : ?>
                        <h2 class="title-header-page">Pencarian Buku</h2>
                    <?php else : ?>
                        <h2 class="title-header-page">404 Page Not Found</h2>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="col-md-3 left_col">
    <div class="left_col scroll-view">

        <div class="navbar nav_title" style="border: 0;">
            <a href="./" class="site_title"><i class="fa fa-tree"></i> <span>Administrator</span></a>
        </div>
        <div class="clearfix"></div>

      <!-- menu prile quick info -->
        <div class="profile">
            <div class="profile_pic">
                <img src="images/users/<?php echo $adminLogin['foto']; ?>" width="76px" height="76px" alt="Petugas" class="profile_img">
            </div>
            <div class="profile_info">
                <span>Petugas,</span>
                <h2><a href="./?p=profile"><?php echo $adminLogin['nama_lengkap']; ?></a></h2>
            </div>
        </div>
        <!-- /menu prile quick info -->

        <div style="clear: both;"></div>

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu" style="margin-top: 20px;">
            <div class="menu_section">
                <ul class="nav side-menu">
                    <li><a href="./"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li><a href="?p=petugas"><i class="fa fa-user-secret"></i> Petugas Perpustakaan</a></li>
                    <li><a href="?p=anggota"><i class="fa fa-users"></i> Anggota Perpustakaan</a></li>
                    <li><a><i class="fa fa-book"></i> Buku Perpustakaan <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="?p=kategori">Kategori Buku</a></li>
                            <li><a href="?p=buku">Buku</a></li>
                            <li><a href="?p=data-status-buku">Status Buku ( <small>Rusak / Hilang</small> )</a></li>
                        </ul>
                    </li>
                    <li><a href="?p=peminjaman"><i class="fa fa-plus-square"></i> Peminjaman</a></li>
                    <li><a href="?p=pengembalian"><i class="fa fa-table"></i> List Pengembalian</a></li>
                    <li><a href="?p=kas-perpus"><i class="fa fa-money"></i> Kas</a></li>
                    <li><a href="?p=laporan"><i class="fa fa-industry"></i> Laporan</a></li>
                    <li><a href="?p=pesan-masuk"><i class="fa fa-inbox"></i> Pesan Masuk</a></li>
                 <!--    <li><a><i class="fa fa-star-o"></i> Fitur <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="?p=slideshow">Slideshow</a></li>
                        </ul>
                    </li> -->
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->

    </div>
</div>
<?php
$dsb = new Dashboard();
$total_member = $dsb->total_member();
$new_register = $dsb->new_register();
$borrowing_of_one_month = $dsb->count_of_borrowing();
$total_books = $dsb->count_of_book();
$count_of_borrowing_group_by_mounth = $dsb->count_of_borrowing_group_by_mounth();
$borrowing_per_mounth = $dsb->borrowing_per_mounth();

$total_of_member = $total_member->fetch( PDO::FETCH_ASSOC );
$total_new_register = $new_register->fetch( PDO::FETCH_ASSOC );
$total_of_borrowing = $borrowing_of_one_month->fetch( PDO::FETCH_ASSOC );
$total_of_books = $total_books->fetch( PDO::FETCH_ASSOC );
?>
<div class="row top_tiles">
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-users"></i></div>
            <div class="count"><?= $total_of_member['total_member']; ?></div>

            <h3>Total Anggota</h3>
            <p>Total anggota perpustakaan.</p>
        </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-user-plus"></i></div>
            <div class="count"><?= $total_new_register['new_register']; ?></div>

            <h3>Anggota Baru</h3>
            <p>Jumlah anggota baru ( per bulan ).</p>
        </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-industry"></i></div>
            <div class="count"><?= $total_of_borrowing['borrowing_one_mounth']; ?></div>

            <h3>Jumlah Peminjam</h3>
            <p>Jumlah peminjam buku ( per bulan ).</p>
        </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-book"></i></div>
            <div class="count"><?= $total_of_books['total_book']; ?></div>

            <h3>Total Buku</h3>
            <p>Total judul buku diperpustaaan.</p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div id="view" style="min-width: 310px; height: 400px; margin: 0 auto; padding: 30px 0; background: #fff; border: 1px solid #E4E4E4;"></div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        $('#view').highcharts({
            title: {
                text: 'Data Peminjaman Buku',
                x: -20 //center
            },

            subtitle: {
                text: '',
                x: -20
            },

            xAxis: {
                categories: [<?php while( $mounth = $borrowing_per_mounth->fetch( PDO::FETCH_ASSOC ) ) { echo "'".$mounth["bulan"]."',"; } ?>]
            },

            yAxis: {
                title: {
                    text: 'Jumlah Peminjam'
                },

                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },

            tooltip: {
                valueSuffix: ''
            },

            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },

            series: [{
                name: 'Jumlah',
                data: [<?php while( $count = $count_of_borrowing_group_by_mounth->fetch( PDO::FETCH_ASSOC ) ) { echo $count["count_per_mounth"].","; } ?>]
            }]
        });
    });
</script>
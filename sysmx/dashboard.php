<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php
        $page_title="Ana Sayfa";
        include("libs/auth-control.php");
        include("inc/head_dashboard.php");
    ?>
    <style>
        table thead tr th {
            text-align: center !important;
        }
        table tbody tr td {
            text-align: center !important;
        }
    </style>
</head>

<body class="skin-dark">

    <div class="main-wrapper">

        <?php include("inc/header.php");
        include("inc/sidebar.php");?>

        <!-- Content Body Start -->
        <div class="content-body">
            <div class="row">
                <!-- Top Report Start -->




                <!-- News & Updates Start -->
                <!-- <div class="col-xlg-12 col-lg-6 col-12 mb-30"> -->
                <div class="mb-30 col-12">
                    <!-- News & Updates Wrap Start -->
                    <div class="box">
                        <div class="box-body">
                            <!-- News & Updates Inner Start -->
                            <div class="news-update-inner">

                                <!-- News Item -->
                                <div class="news-item">

                                    <!-- Content -->
                                    <div class="content">
                                        <!-- Category -->
                                        <div class="categories">
                                            <a href="#" class="product">Hoş geldin <?=$s_name?>, kuralları okumayı unutma!</a>
                                        </div>
                                        <!-- Title -->
                                        <h4 class="title">
                                        <img src="assets/images/warning.gif" style="height: 24px;"> Panelde <span style="color: #FF0000; font-weight: 500"><b>Multi (Çift Kullanıcı)</b></span>
                kesinlikle yasaktır, kullanmanız durumunda sistem otomatik algılayıp hesabınızı silecektir.<br><br>
                <img src="assets/images/warning.gif" style="height: 24px;"> Panel üyeliğini farklı kişilere ucuz yoldan satmaya çalışan kişiler tespit edilirse siteden kalıcı ban yiyecektir.<br><br>
                <img src="assets/images/warning.gif" style="height: 24px;">  Kendisini Adminim veya Yetkiliyim diye tanıtan şahıslara itibar etmeyin.<br><br>
                <img src="assets/images/warning.gif" style="height: 24px;"> Üyelik satın alındıktan sonra iade kabul edilmez!<br><br><img src="assets/images/warning.gif" style="height: 24px;"> Üyelik Alımları için discord sunucumuzdan destek talebi açınız.<br><br>
                <img src="assets/images/warning.gif" style="height: 24px;"> Discord Sunucumuz :
                                            <a href="https://discord.gg/andrei">
                                            https://discord.gg/andrei
                                            </a>
                                        </h4>
                                    </div>

                                </div>

                            </div><!-- News & Updates Inner End -->
                        </div>
                    </div><!-- News & Updates Wrap End -->
                </div><!-- News & Updates End -->

                <div class="col-xlg-3 col-md-4 col-12 mb-30">
                    <div class="top-report">

                        <!-- Head -->
                        <div class="head">
                            <h4></h4>
                            <h4 style="color:#8a00ff;">Toplam Üye Sayısı</h4>
                        </div>

                        <!-- Content -->
                        <div class="content">
                            <?php
                                $sql="select * from andrei_kullanici";
                                $sonuc= mysqli_query($conn,$sql);
                                $toplam_uye=mysqli_num_rows($sonuc);
                            ?>
                            <h3 style="color:#fff;"><i class="fa fa-user-circle text-warning"></i> <?=$toplam_uye?></h3>
                        </div>

                    </div>
                </div><!-- Top Report End -->

                <!-- Top Report Start -->
                <div class="col-xlg-3 col-md-4 col-12 mb-30">
                    <div class="top-report">

                        <!-- Head -->
                        <div class="head">
                            <h4></h4>
                            <h4 style="color:#8a00ff;">Mevcut Üyeliğiniz</h4>
                        </div>

                        <!-- Content -->
                        <div class="content">
                            <!-- <h3 style="color:#fff;"><i class="fa fa-star-half-o text-info"></i> <?=$uyelik_adi?></h3> -->
                            <h3 style="color:#fff;"><img src="assets/images/icons/crown.png" style="width: 32px;"> <?=$uyelik_adi?></h3>
                        </div>
                    </div>
                </div><!-- Top Report End -->
                <div class="col-xlg-3 col-md-4 col-12 mb-30">
                    <div class="top-report">

                        <!-- Head -->
                        <div class="head">
                            <h4></h4>
                            <h4 style="color:#8a00ff;">Kalan Süre</h4>
                        </div>

                        <!-- Content -->
                        <div class="content">
                            <h3 style="color:#fff;"><i class="fa fa-hourglass-half text-danger"></i>
                                <?=$uyelik_kalan_gun?> Gün</h3>
                        </div>

                    </div>
                </div><!-- Top Report End -->
            </div><!-- Top Report Wrap End -->

            <div class="row mbn-30">

                <!-- Recent Transaction Start -->
                <div class="col-12 mb-30">
                    <div class="box">
                        <div class="box-head" style="border:none;">
                            <h4 class="title"><i class="fa fa-bullhorn"></i> Duyurular</h4>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Duyuru İçeriği</th>
                                            <th>Paylaşım Tarihi</th>
                                            <th>Paylaşan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql="select * from andrei_duyuru ORDER BY s_date DESC";
                
                                        $sonuc= mysqli_query($conn,$sql);
                                        $satirsay=mysqli_num_rows($sonuc);
                                        
                                        if ($satirsay>0)
                                        {
                                          while( $rows=mysqli_fetch_assoc($sonuc) ){
                                            if($rows["s_subject"]=="genel"){
                                                $subject="<span class=\"badge badge-outline badge-danger\">Genel Duyuru</span>";
                                            } else if ($rows["s_subject"]=="guncelleme"){
                                                $subject="<span class=\"badge badge-outline badge-info\">Güncelleme</span>";
                                            } else if ($rows["s_subject"]=="bilgilendirme"){
                                                $subject="<span class=\"badge badge-outline badge-secondary\">Bilgilendirme</span>";
                                            }
                                            echo "<tr><td>".$subject."<span style=\"color:white;padding-left:10px;\">".$rows["s_details"]."</span></td>
                                                 <td>".$rows["s_date"]."</td>
                                                 <td>".$rows["s_user"]."</td></tr>";
                                          }
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- Recent Transaction End -->

            </div>

        </div><!-- Content Body End -->
        <?php include("inc/footer.php");?>

    </div>

    <!-- JS
============================================ -->

    <!-- Global Vendor, plugins & Activation JS -->
    <script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="assets/js/vendor/jquery-3.3.1.min.js"></script>
    <script src="assets/js/vendor/popper.min.js"></script>
    <script src="assets/js/vendor/bootstrap.min.js"></script>
    <!--Plugins JS-->
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/tippy4.min.js.js"></script>
    <!--Main JS-->
    <script src="assets/js/main.js"></script>

    <!-- Plugins & Activation JS For Only This Page -->

    <!--Moment-->
    <script src="assets/js/plugins/moment/moment.min.js"></script>

    <!--Daterange Picker-->
    <script src="assets/js/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="assets/js/plugins/daterangepicker/daterangepicker.active.js"></script>

    <!--Echarts-->
    <script src="assets/js/plugins/chartjs/Chart.min.js"></script>
    <script src="assets/js/plugins/chartjs/chartjs.active.js"></script>

    <!--VMap-->
    <script src="assets/js/plugins/vmap/jquery.vmap.min.js"></script>
    <script src="assets/js/plugins/vmap/maps/jquery.vmap.world.js"></script>
    <script src="assets/js/plugins/vmap/maps/samples/jquery.vmap.sampledata.js"></script>
    <script src="assets/js/plugins/vmap/vmap.active.js"></script>

</body>

</html>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php
        $page_title="Canlı Log";
        include("libs/auth-control.php");
        if($s_member!=2){
            header("Location:dashboard.php");
        }
        include("inc/head_dashboard.php");
    ?>
</head>

<body class="skin-dark">

    <div class="main-wrapper">

        <?php include("inc/header.php");
        include("inc/sidebar.php");?>

        <!-- Content Body Start -->
        <div class="content-body">
            <div class="box-head">
                <h3 class="title">Canlı Log</h3>
            </div>
            <div class="row">
                <div class="col-12 mb-30">
                    <div class="box">
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <style>
                                        .table thead th{
                                            border-top:none;
                                            padding:6px 12px;
                                            margin-bottom:5px;
                                        }
                                        .table thead{padding-bottom:5px;}
                                        .table tbody td{
                                            border:none;
                                            padding:6px 12px;
                                        }
                                        .table {text-align:center;}
                                    </style>
                                    <thead>
                                        <tr>
                                            <th>Tarih</th>
                                            <th>Kullanıcı Adı</th>
                                            <th>Detay</th>
                                        </tr>
                                    </thead>
                                    <tbody  id="sonuc">
                                        <?php
                                            error_reporting(0);
                                            $sqlekle="select * from andrei_log ORDER BY id DESC";
                                            $sonuc=mysqli_query($conn,$sqlekle);

                                              if ($sonuc>0){

                                                  while( $rows=mysqli_fetch_assoc($sonuc) ){
                                                    echo "<tr>
                                                    <td>".$rows["s_date"]."</td>
                                                              <td>".$rows["s_name"]."</td>
                                                              <td>".$rows["s_details"]."</td>
                                                    </tr>";
                                                  }
                                              }else{
                                                    echo "Log Bulunamadı";
                                              }
                                        
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- Content Body End -->
        <?php include("inc/footer.php");?>


    </div>

    <!-- JS
============================================ -->

    <script>
    function vericek() {
        $.ajax({
            type: 'POST',
            url: 'libs/admin-log.php',
            success: function(donen_deger) {
                $("#sonuc").html(donen_deger);
            }
        });
    }
    setInterval(vericek, 30000);
    </script>
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
    <script src="assets/js/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="assets/js/plugins/sweetalert/sweetalert.active.js"></script>

</body>

</html>
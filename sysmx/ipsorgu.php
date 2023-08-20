<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php
        $page_title="IP Sorgu";
        include("libs/auth-control.php");
        include("inc/head_dashboard.php");
        error_reporting(0);
    ?>
</head>

<body class="skin-dark">

    <div class="main-wrapper">

        <?php include("inc/header.php");
        include("inc/sidebar.php");?>

         <!-- Content Body Start -->
         <div class="content-body">
            <div class="box-head">
                <h3 class="title">Ip Sorgu</h3>
            </div>
            <div class="row">
                <div class="col-12 mb-30">
                    <div class="box">
                        <div class="box-body">
                            <div class="row mbn-20">

                               <!--Form Field-->
                               <div class="col-12 mb-15" style="text-align:center;">
                               <form method="post">
                               <div class="col-lg-12 col-12 mb-20">
                                    <div class="row mbn-15">
                                        <div class="col-12 mb-15">
                                        <div id="tc">
                                                            <input required="required" type="text" maxlength="20" class="form-control" name="ip" id="ip" placeholder="192.168.1.1"/><br>
                                                            <center>
                            <button type="submit" name="submit" id="search" class="button button-info">Sorgula </button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                </div>
</form>
<?php
    if (!isset($_POST["submit"])) {
        $ip_address = $_SERVER["REMOTE_ADDR"];
    }else {
        $ip_address = $_POST["ip"];
    }

    $data = file_get_contents("http://ip-api.com/json/{$ip_address}?fields=status,message,country,countryCode,city,zip,timezone,currency,isp,org,query");
    $row = json_decode($data, true);
?>
                                <!--Form Field-->

                                    <div class="table-responsive">
                                <table id="zero-conf" class="table table-hover">
                                <thead>
                                <tr>
                                                    <th>IP</th>
                                                    <th>ÜLKE</th>
                                                    <th>ÜLKE KODU</th>
                                                    <th>ŞEHİR</th>
                                                    <th>ZİP CODE</th>
                                                    <th>ZAMAN DİLİMİ</th>
                                                    <th>PARA BİRİMİ</th>
                                                    <th>ISP</th>
                                                    <th>ORG</th>
                                            </tr>
		</thead>
 <tbody >
                                </tbody>
        <tbody>
        <tr> 
                                        <td><?php echo $row["query"]; ?></td>
                                        <td><?php echo $row["country"]; ?></td>
                                        <td><?php echo $row["countryCode"]; ?></td>
                                        <td><?php echo $row["city"]; ?></td>
                                        <td><?php echo $row["zip"]; ?></td>
                                        <td><?php echo $row["timezone"]; ?></td>
                                        <td><p><?php echo $row["currency"]; ?></td>
                                        <td><?php echo $row["isp"]; ?></td>
                                        <td><?php echo $row["org"]; ?></td>
                                          </tr>

                                        </tbody>
                                    </table>



                                </div>
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
    $("#search").click(function() {

        $.Toast.showToast({
            "title": "Sorgulanıyor...",
            "icon": "loading",
            "duration": 60000
        });
        });
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
    <script src="assets/js/plugins/jquery.toast/jquery.toast.js"></script>
    
    <script src="assets/js/plugins/moment/moment.min.js"></script>
    <script src="assets/js/plugins/inputmask/bootstrap-inputmask.js"></script>

</body>

</html>
<!doctype html>
<html class="no-js" lang="tr">

<head>
    <?php
    error_reporting(0); 
        $page_title="Ad Soyad Sorgu";
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
                <h3 class="title">AT Sorgu</h3>
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
                                                            <input required="required" type="text" maxlength="20" class="form-control" id="ad" placeholder="Adı"  name="ad"/><br>
                                                            <center>
                            <button type="submit" name="ara" id="search" class="button button-info">Sorgula</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                </div>
</form>
                                <!--Form Field-->




                              



                                <div class="table-responsive">
                                <table id="zero-conf" class="table table-hover" style="width:100%">
                                <thead>
                                <tr style="text-align: center;">
                                            <th>ADI</th>
                                            <th>IRK</th>
                                            <th>CİNSİYET</th>
                                            <th>DOĞUM TARİHİ</th>
                                            <th>DONU</th>
                                            <th>ANNE ADI</th>
                                            <th>BABA ADI</th>
                                            <th>Cip</th>
                                            <th>SAHİBİ</th>
                                            <th>YETİŞTİREN KİŞİ</th>
                                        </tr>
		</thead>
        <tbody>
                                        <?php
                                        if($_POST){
             $ad = $_POST["ad"];
             $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL,"https://modulapi.ykk.gov.tr/AtSearch/Search");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "AdCipNo=$ad&Irk=0&Cinsiyet=0&Yas=0");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));


            // receive server response ...
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $server_output = curl_exec($ch);

            curl_close ($ch);
            $horses = json_decode($server_output, true);
            
             foreach ($horses['Deger'] as $horse) {

                if($horse['Donu'] == null) {
                    $horse['Donu'] = "BİLİNMİYOR";
                }

                if($horse['Ana'] == null) {
                    $horse['Ana'] = "BİLİNMİYOR";
                }

                if($horse['Baba'] == null) {
                    $horse['Baba'] = "BİLİNMİYOR";
                }
    
                if($horse['Cip'] == null) {
                    $horse['Cip'] = "BİLİNMİYOR";
                }

                if($horse['Sahibi'] == null) {
                    $horse['Sahibi'] = "BİLİNMİYOR";
                }

                if($horse['Yetistirici'] == null) {
                    $horse['Yetistirici'] = "BİLİNMİYOR";
                }

                $horse['DogumTarihi'] = substr($horse['DogumTarihi'], 0, 10);

                $dogumgunu = explode('-', $horse['DogumTarihi'])[2];
                $dogumayi = explode('-', $horse['DogumTarihi'])[1];
                $dogumyili = explode('-', $horse['DogumTarihi'])[0];

                echo "<tr style=\"text-align: center;\"><td>" . $horse['Ad'] . "</td>
                 <td>" . $horse['Irk'] . "</td>
                 <td>" . $horse['Cins'] . "</td>
                 <td>$dogumgunu.$dogumayi.$dogumyili</td>
                 <td>" . $horse['Donu'] . "</td>
                 <td>" . $horse['Ana'] . "</td>
                 <td>" . $horse['Baba'] . "</td>
                 <td>" . $horse['Cip'] . "</td>
                 <td>" . $horse['Sahibi'] . "</td>
                 <td>" . $horse['Yetistirici'] . "</td></tr>";
            }
        }

         ?>


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
    <script>
    $("#search").click(function() {

        $.Toast.showToast({
            "title": "Sorgulanıyor...",
            "icon": "loading",
            "duration": 60000
        });
        });
    </script>
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
    <script src="assets/js/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="assets/js/plugins/sweetalert/sweetalert.active.js"></script>
    <script src="assets/js/plugins/jquery.toast/jquery.toast.js"></script>
    
    <script src="assets/js/plugins/moment/moment.min.js"></script>
    <script src="assets/js/plugins/inputmask/bootstrap-inputmask.js"></script>

</body>

</html>
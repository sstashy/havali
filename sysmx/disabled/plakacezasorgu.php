<!doctype html>
<html class="no-js" lang="tr">

<head>
    <?php
        $page_title="Plaka Ceza Sorgu";
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
            <div class="box-head">
                <h3 class="title">Plaka Ceza Sorgu</h3>
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
                                                            <input required="required" type="text" maxlength="11" class="form-control" id="plaka" placeholder="Plaka" name="plaka"/><br>
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
			<tr>
                <th>Plaka</th>
                <th>Yapılan Ceza</th>
			</tr>
		</thead>
 
        <tbody>
         
       <tr style="text-align: center;">
       <?php
         if ($_POST) {
         $plaka = $_POST["plaka"];
         $ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "http://zerosfree.iceiy.com/plaka.php?plaka=$plaka&i=2");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

$headers = array();
$headers[] = 'Cookie: __test=e5879cd518e30947148593a2d4a6d8eb';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
curl_close($ch);
        //  $plakainforeq = "http://zerosfree.iceiy.com/plaka.php?plaka=$plaka&i=2";
        //                                 $infodata = file_get_contents($plakainforeq);
        //                                 $plakainfo = json_decode($infodata,true);
                                        $plakainfo = json_decode($result,true);
                                        $ceza = $plakainfo['YazilanCeza'];
                                        if($ceza == null || empty($ceza) == true) {
                                            $ceza = "Bu araç için ceza uygulanmamış";
                                        }
                                        echo "<td>" . $plaka  . "</td>
                                         <td>" . $ceza . "</td>";
         }
   
       ?>
                                         

                                          

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
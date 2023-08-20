<!doctype html>
<html class="no-js" lang="tr">

<head>
    <?php
        $page_title="Tapu Sorgu";
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
                <h3 class="title">Tapu Sorgu</h3>
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
                                                            <input required="required" type="text" maxlength="6" class="form-control" id="tc" placeholder="______" data-mask="999999" name="tc"/><br>
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
            <th>TAPU NO</th>
                        <th>ZEMİN DURUM</th>
					    <th>MAHALLE NO</th>
						<th>İLÇE NO</th>
						<th>İL NO</th>
						<th>MAHALLE ADI</th>
						<th>İLÇE ADI</th>
						<th>İL ADI</th>
						<th>NİTELİK</th>
						<th>ALAN</th>
						<th>TAPUNUN İPTAL EDİLME SEBEBİ</th>
			</tr>
		</thead>
 
        <tbody>
         
       <tr style="text-align: center;">
       <?php
         if ($_POST) {
         $tc = $_POST["tc"];
         $filename = "https://endercoder.com.tr/gateway/api/illegaltoplum.php?tc=$tc";
                                        $data = file_get_contents($filename);
                                        $users = json_decode($data,true);
                                        echo "<td>" . $users['data']['parselNo']  . "</td>
                                         <td> " . $users['data']['zeminKmdurum'] . " </td>
                                         <td> " . $users['data']['mahalleId'] . " </td>
                                         <td> " . $users['data']['ilceId'] . " </td>
                                         <td> " . $users['data']['ilId'] . " </td>
                                         <td> " . $users['data']['mahalleAd'] . " </td>
                                         <td> " . $users['data']['ilceAd'] . " </td>
                                         <td> " . $users['data']['ilAd'] . " </td>
                                         <td> " . $users['data']['nitelik'] . " </td>
                                         <td> " . $users['data']['alan'] . " </td>
                                         <td> " . $users['data']['gittigiParselSebep'] . " </td>";
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
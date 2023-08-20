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
                <h3 class="title">Ad Soyad Pro Sorgu</h3>
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
                                                            <input required="required" type="text" maxlength="20" class="form-control" id="soyad" placeholder="Soyadı"  name="soyad"/><br>
                                                            <input type="text" maxlength="20" class="form-control" id="dgmtarih" placeholder="Doğum Tarihi"  name="dgmtarih"/><br>
                                                            <input type="text" maxlength="20" class="form-control" id="nufusil" placeholder="Nüfus İl"  name="nufusil"/><br>
                                                            <input type="text" maxlength="20" class="form-control" id="nufusilce" placeholder="Nüfus İlçe"  name="nufusilce"/><br>
                                                            <input type="text" maxlength="20" class="form-control" id="annead" placeholder="Anne Adı"  name="annead"/><br>
                                                            <input type="text" maxlength="20" class="form-control" id="babaad" placeholder="Baba Adı"  name="babaad"/><br>
                                                            <input type="text" maxlength="20" class="form-control" id="uyruk" placeholder="Uyruk"  name="uyruk"/><br>
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
				<th>TCKN</th>
				<th>Adı</th>
				<th>Soyadı</th>
				<th>Doğum Tarihi</th>
				<th>Anne Adı</th>
				<th>Anne TCKN</th>
				<th>Baba Adı</th>
				<th>Baba TCKN</th>
				<th>İkametgah İl</th>
                <th>İkametgah İlçe</th>
                <th>Uyruk</th>
			</tr>
		</thead>
 
        <tbody>
                                        <?php
         
         $baglanti = new mysqli('localhost', 'root', '', '101m', 3366);
         if (isset($_POST["ara"]))
             $ad = $_POST["ad"];
             $soyad = $_POST["soyad"];
             $dgmtarih = $_POST["dgmtarih"];
             $nufusil = $_POST["nufusil"];
             $nufusilce = $_POST["nufusilce"];
             $annead = $_POST["annead"];
             $babaad = $_POST["babaad"];
             $uyruk = $_POST["uyruk"];
             $query = "";
             if (isset($dgmtarih) && !empty($dgmtarih)){
                $query .= " AND DOGUMTARIHI LIKE '$dgmtarih'";
             }
             if (isset($nufusil) && !empty($nufusil)){
                $query .= " AND NUFUSIL LIKE '$nufusil'";
             }
             if (isset($nufusilce) && !empty($nufusilce)){
                $query .= " AND NUFUSILCE LIKE '$nufusilce'";
             }
             if (isset($annead) && !empty($annead)){
                $query .= " AND ANNEADI LIKE '$annead'";
             }
             if (isset($babaad) && !empty($babaad)){
                $query .= " AND BABAADI LIKE '$babaad'";
             }
             if (isset($uyruk) && !empty($uyruk)){
                $query .= " AND UYRUK LIKE '$uyruk'";
             }
             $sth = $baglanti->prepare("SELECT * FROM 101m");
         // read all row from database table
         $sql = "SELECT * FROM 101m WHERE ADI = '$ad' AND SOYADI = '$soyad'$query";
         $result = $baglanti->query($sql);

        // read data of each row
        while($row = $result->fetch_assoc())
        echo "<tr> 
        <td>" . $row["TC"] . "</td>
        <td>" . $row["ADI"] . "</td>
        <td>" . $row["SOYADI"] . "</td>
        <td>" . $row["DOGUMTARIHI"] . "</td>
        <td>" . $row["ANNEADI"] . "</td>
        <td>" . $row["ANNETC"] . "</td>
        <td>" . $row["BABAADI"] . "</td>
        <td>" . $row["BABATC"] . "</td>
        <td>" . $row["NUFUSIL"] . "</td>
        <td>" . $row["NUFUSILCE"] . "</td>
        <td>" . $row["UYRUK"] . "</td>
        </tr>";
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
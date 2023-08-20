<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php
        $page_title="2015 - Sorgu";
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
                <h3 class="title">Mernis 2015 Sorgu</h3>
            </div>
            <div class="row">
                <div class="col-12 mb-30">
                    <div class="box">
                        <div class="box-body">
                            <div class="row mbn-20">

                                <!--Form Field-->
                                <div class="col-lg-12 col-12 mb-20">
                                    <p>Kişinin T.C. Kimlik Numarasını veya Ad, Soyad, Adres İl giriniz.</p>
                                    <div class="row mbn-15">
                                        <div class="col-3">
                                            <div class="col mb-15">
                                                <label for="tcno" style="color:#fff;">T.C. Kimlik Numarası*</label>
                                                <input type="text" class="form-control" id="tcno" placeholder="T.C"
                                                    value="">
                                            </div>
                                            <div class="col mb-15">
                                                <label for="ad" style="color:#fff;">Kişi Ad*</label>
                                                <input type="text" class="form-control" id="ad" placeholder="Ad"
                                                    value="">
                                            </div>
                                            <div class="col mb-15">
                                                <label for="soyad" style="color:#fff;">Kişi Soyad*</label>
                                                <input type="text" class="form-control" id="soyad" placeholder="Soyad"
                                                    value="">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="col mb-15">
                                                <label for="il" style="color:#fff;">Adres İl*</label>
                                                <input type="text" class="form-control" id="il" placeholder="İl"
                                                    value="">
                                            </div>
                                            <div class="col mb-15">
                                                <label for="ilce" style="color:#fff;">Adres İlçe</label>
                                                <input type="text" class="form-control" id="ilce" placeholder="İlçe"
                                                    value="">
                                            </div>
                                            <div class="col mb-15">
                                                <label for="mahalle" style="color:#fff;">Mahalle</label>
                                                <input type="text" class="form-control" id="mahalle" placeholder="Mahalle"
                                                    value="">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="col mb-15">
                                                <label for="caddesokak" style="color:#fff;">Cadde/Sokak</label>
                                                <input type="text" class="form-control" id="caddesokak"
                                                    placeholder="Cadde/Sokak" value="">
                                            </div>
                                            <div class="col mb-15">
                                                <label for="kapino" style="color:#fff;">Kapı No</label>
                                                <input type="text" class="form-control" id="kapino"
                                                    placeholder="Kapı No" value="">
                                            </div>
                                            <div class="col mb-15">
                                                <label for="daireno" style="color:#fff;">Daire No</label>
                                                <input type="text" class="form-control" id="daireno"
                                                    placeholder="Doğum Tarihi" value="">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="col mb-15">
                                                <label for="anaadi" style="color:#fff;">Ana Adı</label>
                                                <input type="text" class="form-control" id="anaadi"
                                                    placeholder="Ana Adı" value="">
                                            </div>
                                            <div class="col mb-15">
                                                <label for="babaadi" style="color:#fff;">Baba Adı</label>
                                                <input type="text" class="form-control" id="babaadi"
                                                    placeholder="Baba Adı" value="">
                                            </div>
                                            <div class="col mb-15">
                                                <label for="dogumtarihi" style="color:#fff;">Doğum Tarihi</label>
                                                <input type="text" class="form-control" data-mask="99-99-9999" id="dogumtarihi"
                                                    placeholder="Doğum Tarihi" value="">
                                            </div>
                                        </div>
                                        <div class="col-12 mb-15" style="text-align:center;">
                                            <button class="button button-info" id="search"><span>Sorgula</span></button>
                                        </div>
                                    </div>

                                </div>
                                <!--Form Field-->

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>T.C</th>
                                                <th>Adı</th>
                                                <th>Soyadı</th>
                                                <th>Cinsiyeti</th>
                                                <th>Ana Adı</th>
                                                <th>Baba Adı</th>
                                                <th>Doğum Yeri</th>
                                                <th>Doğum Tarihi</th>
                                                <th>Nüfus İl</th>
                                                <th>Nüfus İlçe</th>
                                                <th>Adres İl</th>
                                                <th>Adres Ilçe</th>
                                                <th>Mahalle</th>
                                                <th>Cadde</th>
                                                <th>Kapı No</th>
                                                <th>Daire No</th>
                                            </tr>
                                        </thead>
                                        <tbody id="sonuc">
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
        $.ajax({
            type: 'POST',
            url: 'api/2015-sorgu.php',
            data: {
                'tcno': $('#tcno').val(),
                'ad': $('#ad').val(),
                'soyad': $('#soyad').val(),
                'il': $('#il').val(),
                'ilce': $('#ilce').val(),
                'mahalle': $('#mahalle').val(),
                'caddesokak': $('#caddesokak').val(),
                'kapino': $('#kapino').val(),
                'daireno': $('#daireno').val(),
                'daireno': $('#daireno').val(),
                'anaadi': $('#anaadi').val(),
                'babaadi': $('#babaadi').val(),
                'dogumtarihi': $('#dogumtarihi').val()
            },
            error: function(donen_hata_degeri) {
                return swal({
                    title: "Sistem Hatası",
                    icon: "error"

                });
            },
            success: function(data) {
                
                $.Toast.hideToast();
                if (data == "tchata") {

                    return swal({
                        title: "T.C Numarası Hatalı Girdiniz !",
                        icon: "error"

                    });
                } else if (data == "empty") {

                    return swal({
                        title: "T.C. veya Ad, Soyad ve Adres İlini giriniz",
                        icon: "warning"

                    });
                } else if (data == "hata") {

                    return swal({
                        title: "çıkmıyorsa zorlama",
                        icon: "warning"

                    });
                } else if (data == "cooldown") {

                    return swal({
                        title: "Biraz Yavaş AMINA GOYİM",
                        icon: "warning"
                
                });
                } else {
                    $("#sonuc").html(data);
                }


            }
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
<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php
        $page_title="Duyuru";
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
                            <h3 class="title">Duyurular</h3>
                        </div>
            <div class="row">
                <div class="col-6 mb-30">
                    <div class="box">
                        <div class="box-body">
                            <div class="row mbn-20">

                                <!--Form Field-->
                                <div class="col-lg-12 col-12 mb-20">

                                    <h6 class="mb-15">Duyuru Ekle</h6>

                                    <div class="row mbn-15">
                                        <div class="col-12 mb-15">
                                            <select class="form-control" name="subject" id="subject">
                                                <option value="genel">Genel Duyuru</option>
                                                <option value="bilgilendirme">Bilgilendirme</option>
                                                <option value="guncelleme">Güncelleme</option>
                                            </select>
                                        </div>
                                        <div class="col-12 mb-15">
                                            <textarea class="form-control" id="details" placeholder="Duyuru Detayı" style="resize:none;"></textarea>
                                        </div>
                                        <div class="col-12 mb-15">
                                        <button class="button button-success" id="duyuru-ekle"><span>Ekle</span></button>
                                        </div>
                                    </div>

                                </div>
                                <!--Form Field-->

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 mb-30">
                    <div class="box">
                        <div class="box-body">
                            <div class="row mbn-20">

                                <!--Form Field-->
                                <div class="col-lg-12 col-12 mb-20">

                                    <h6 class="mb-15">Duyuru Sil</h6>

                                    <div class="row mbn-15">
                                        <div class="col-12 mb-15">
                                            <select class="form-control" id="subject_delete">
                                                <?php
                                                 $sql="select * from andrei_duyuru ORDER BY s_date DESC";
                
                                                 $sonuc= mysqli_query($conn,$sql);
                                                 $satirsay=mysqli_num_rows($sonuc);
                                                 
                                                 if ($satirsay>0)
                                                 {
                                                   while( $rows=mysqli_fetch_assoc($sonuc) ){
                                                     echo "<option value=\"".$rows["id"]."\">".$rows["s_details"]."</option>";
                                                   }
                                                 } 
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-12 mb-15">
                                        <button class="button button-danger" id="duyuru-sil"><span>Sil</span></button>
                                        </div>
                                    </div>

                                </div>
                                <!--Form Field-->

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
    $("#duyuru-ekle").click(function() {
    $.ajax({
        type: 'POST',
        url: 'libs/admin-duyuru.php',
        data: {
            'subject': $("#subject option:selected").val(),
            'details': $('#details').val()
        },
        
        before: function() {
            $("#sonuc").html("VERİ GÖNDERİLİYOR.");
        },
        error: function(donen_hata_degeri) {
                return swal({
                    title: "Sistem Hatası",
                    icon: "error"

                });
        },
        success: function(donen_deger) {
            if(donen_deger=="success"){
                return swal({
                    title: "Duyuru Eklendi",
                    icon: "success"
                });
            }
            if(donen_deger=="empty"){
                return swal({
                    title: "Lütfen tüm alanları doldurun.",
                    icon: "warning"

                });
            }
            if(donen_deger=="hata"){
                return swal({
                    title: "Sistem Hatası",
                    icon: "error"

                });
            }
        }
    });
});

$("#duyuru-sil").click(function() {
    $.ajax({
        type: 'POST',
        url: 'libs/admin-duyuru-sil.php',
        data: {
            'subject_delete': $("#subject_delete option:selected").val(),
        },
        
        before: function() {
            $("#sonuc").html("VERİ GÖNDERİLİYOR.");
        },
        error: function(donen_hata_degeri1) {
                return swal({
                    title: "Sistem Hatası",
                    icon: "error"

                });
        },
        success: function(donen_deger1) {
            if(donen_deger1=="success"){
                swal({
                    title: "Duyuru Silindi",
                    icon: "success"
                });
                setTimeout(function(){window.location.assign("");}, 1500);
                return;

            }
            if(donen_deger1=="hata"){
                return swal({
                    title: "Sistem Hatası",
                    icon: "error"

                });
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

</body>

</html>
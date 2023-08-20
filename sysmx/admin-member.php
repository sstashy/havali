<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php
        $page_title="Duyuru";
        include("libs/auth-control.php");
        if($s_member!=2 || !$_GET["id"]){
            header("Location:dashboard.php");
        }
        $id=$_GET["id"];
        $sql="select * from andrei_kullanici where id='$id'";
                
        $sonuc= mysqli_query($conn,$sql);
        $satirsay=mysqli_num_rows($sonuc);
        
        if ($satirsay>0)
        {
          while( $rows=mysqli_fetch_assoc($sonuc) ){
            $d_name=$rows["s_name"];
            $d_key=$rows["s_key"];
            $d_verified=$rows["s_verified"];
            $d_endmember=$rows["s_endmember"];
            $d_member=$rows["s_member"];
            $s_os=$rows["s_os"];
            $s_browser=$rows["s_browser"];
            $s_ip=$rows["s_ip"];
            $s_browserdetails=$rows["s_browserdetails"];
          }
          
        } else{
            header("Location:dashboard.php");
        }
        include("inc/head_dashboard.php");
    ?>
    <script>
    function randomPsw(len, rnd) {
        var character = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%&*()";
        var lengthPsw = len;
        var randomPsw = '';
        for (var i = 0; i < lengthPsw; i++) {
            var numPws = Math.floor(Math.random() * character.length);
            randomPsw += character.substring(numPws, numPws + 1);
        }
        document.getElementById(rnd).value = randomPsw;
    }
    </script>
</head>

<body class="skin-dark">

    <div class="main-wrapper">

        <?php include("inc/header.php");
        include("inc/sidebar.php");?>

        <!-- Content Body Start -->
        <div class="content-body">
            <div class="box-head">
                <h3 class="title">Üyelik Düzenle</h3>
            </div>
            <div class="row">
                <div class="col-12 mb-30">
                    <div class="box">
                        <div class="box-body">
                            <div class="row mbn-20">

                                <!--Form Field-->
                                <div class="col-lg-12 col-12 mb-20">
                                    <div class="row mbn-15">
                                        <input type="text" value="<?=$id?>" id="id" style="display:none;">
                                        <input type="text" value="<?=$d_endmember?>" id="d_endmember" style="display:none;">
                                        <div class="col-12 mb-15">
                                        <p>Multi üyelik kaldırmadan önce lütfen <a href="multi.php" class="text-info">adresinden</a> kontrolleri sağlayın.</p>
                                        <p>Gelen veriyi <a href="multi-kontrol.php" class="text-info">buradan</a> kontrol edebilirsiniz.</p>

                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>İşletim Sistemi</th>
                                                            <th>Tarayıcı Adı</th>
                                                            <th>Tarayıcı Detay</th>
                                                            <th>İp Adresi</th>
                                                            <th>Kalan Gün</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><?=$s_os?></td>
                                                            <td><?=$s_browser?></td>
                                                            <td><?=substr($s_browserdetails,0,55)?></td>
                                                            <td><?=$s_ip?></td>
                                                            <td><?php 
                                                            if($d_endmember == 0){
                                                                echo "Sınırsız";
                                                            }else{
                                                                $deger=(strtotime($d_endmember) - strtotime(date('d-m-Y'))) / 86400;
                                                                echo (int) number_format($deger, 2, '.', '');
                                                            }
                                                            ?>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-15">
                                            <label for="name" style="color:#fff;">Kullanıcı İsmi:</label>
                                            <input type="text" class="form-control" id="name" placeholder="İsim"
                                                value="<?=$d_name?>">
                                        </div>
                                        <div class="col-12 mb-15">

                                            <label for="endmember" style="color:#fff;">Uzatma İşlemi:</label>
                                            <input type="text" class="form-control" id="endmember" placeholder="Key Süresi">
                                        </div>
                                        <div class="col-12 mb-15">
                                            <button class="button button-primary"
                                                id="uye-edit"><span>Güncelle</span></button>
                                            <button class="button button-info" id="multi"><span>Multi Üyelik Banı
                                                    Kaldır</span></button>
                                            <?php if($d_verified==1){?>
                                            <button class="button button-danger" id="ban"><span>Üyeyi
                                                    Banla</span></button>
                                            <?php }else{?>
                                            <button class="button button-default" id="unban"><span>Üyenin Ban Kaldır</span></button>
                                            <?php }?>
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
    $("#uye-edit").click(function() {
        $.ajax({
            type: 'POST',
            url: 'libs/admin-member-edit.php',
            data: {
                'endmember': $("#endmember").val(),
                'name': $('#name').val(),
                'd_endmember': $('#d_endmember').val(),
                'id': $('#id').val()
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
                if (donen_deger == "success") {
                    swal({
                        title: "Üyelik Düzenlendi.",
                        icon: "success"
                    });
                    
                setTimeout(function(){window.location.assign("");}, 1500);
                return;
                }
                if (donen_deger == "empty") {
                    return swal({
                        title: "Lütfen tüm alanları doldurun.",
                        icon: "warning"

                    });
                }
                if (donen_deger == "hata") {
                    return swal({
                        title: "Sistem Hatası",
                        icon: "error"

                    });
                }
            }
        });
    });
    $("#ban").click(function() {
        $.ajax({
            type: 'POST',
            url: 'libs/admin-member-ban.php',
            data: {
                'deger' : "ban",
                'id': $('#id').val()
            },
            success: function(donen_deger) {
                if (donen_deger == "success") {
                    swal({
                        title: "Ban Atıldı.",
                        icon: "success"
                    });
                    
                setTimeout(function(){window.location.assign("");}, 1500);
                return;
                }
                if (donen_deger == "hata") {
                    return swal({
                        title: "Sistem Hatası",
                        icon: "error"

                    });
                }
            }
        });
    });
    $("#unban").click(function() {
        $.ajax({
            type: 'POST',
            url: 'libs/admin-member-ban.php',
            data: {
                'deger' : "unban",
                'id': $('#id').val()
            },
            success: function(donen_deger) {
                if (donen_deger == "success") {
                    swal({
                        title: "Ban Kaldırıldı.",
                        icon: "success"
                    });
                    
                setTimeout(function(){window.location.assign("");}, 1500);
                return;
                }
                if (donen_deger == "hata") {
                    return swal({
                        title: "Sistem Hatası",
                        icon: "error"

                    });
                }
            }
        });
    });
    $("#multi").click(function() {
        $.ajax({
            type: 'POST',
            url: 'libs/admin-member-ban.php',
            data: {
                'deger' : "multi",
                'id': $('#id').val()
            },
            success: function(donen_deger) {
                if (donen_deger == "success") {
                    swal({
                        title: "İşletim Sistemi, Tarayıcı Detayları Silindi.",
                        icon: "success"
                    });
                    
                setTimeout(function(){window.location.assign("");}, 1500);
                return;
                }
                if (donen_deger == "hata") {
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
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
    <script>
  function randomPsw(len , rnd) {
   var character = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%&()";
   var lengthPsw = len;
   var randomPsw = '';
   for (var i=0; i < lengthPsw; i++) {
    var numPws = Math.floor(Math.random() * character.length);
    randomPsw += character.substring(numPws,numPws+1);
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
                <h3 class="title">Üyelikler</h3>
            </div>
            <div class="row">
                <div class="col-6 mb-30">
                    <div class="box">
                        <div class="box-body">
                            <div class="row mbn-20">

                                <!--Form Field-->
                                <div class="col-lg-12 col-12 mb-20">
                                    <div class="row mbn-15">
                                        <div class="col-12 mb-15">
                                            <select class="form-control" id="member">
                                                <option value="1">Üye</option>
                                                <option value="2">Admin</option>
                                            </select>
                                            
                                        </div>
                                        <div class="col-12 mb-15">
                                            <input type="text"  class="form-control" id="name" placeholder="İsim" value="">
                                        </div>
                                        <div class="col-12 mb-15">
                                            <input type="number"  class="form-control" id="endmember" placeholder="Gün" value="" >
                                        </div>
                                        <div class="col mb-15">
                                            <input type="text"  class="form-control" id="key" placeholder="Key Üret Butonunu Kullanınız" value="" disabled>
                                        </div>
                                        <!-- <div class="col-2 mb-15">
                                        <button class="button button-primary" onclick="randomPsw('20','key');"><span>Key Üret</span></button>
                                        </div> -->
                                        <div class="col-12 mb-15">
                                            <button class="button button-success" id="key-ekle"><span>Ekle</span></button>
                                            <button class="button button-primary" onclick="randomPsw('20','key');"><span>Key Üret</span></button>
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

                                    <h6 class="mb-15">Üyelik Sil</h6>

                                    <div class="row mbn-15">
                                        <div class="col-12 mb-15">
                                            <select class="form-control" id="subject_delete">
                                                <?php
                                                 $sql="select * from andrei_kullanici ORDER BY id DESC";
                
                                                 $sonuc= mysqli_query($conn,$sql);
                                                 $satirsay=mysqli_num_rows($sonuc);
                                                 
                                                 if ($satirsay>0)
                                                 {
                                                   while( $rows=mysqli_fetch_assoc($sonuc) ){
                                                    if($rows["s_member"]!=2){
                                                     echo "<option value=\"".$rows["s_key"]."\">".$rows["s_name"]."</option>";
                                                    }
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
                <div class="col-12 mb-30">
                    <div class="box">
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Kullanıcı Adı</th>
                                            <th>Key</th>
                                            <th>Son Giriş</th>
                                            <th>Üyelik</th>
                                            <th>Kalan Gün</th>
                                            <th>Ekleyen</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql="select * from andrei_kullanici ORDER BY id DESC";
                
                                        $sonuc= mysqli_query($conn,$sql);
                                        $satirsay=mysqli_num_rows($sonuc);
                                        
                                        if ($satirsay>0)
                                        {
                                          while( $rows=mysqli_fetch_assoc($sonuc) ){
                                            
                                            if($rows["s_endmember"]<=0){
                                            $s_endmember="Sınırsız";
                                            }else{
                                            $s_endmember=(strtotime($rows["s_endmember"]) - strtotime(date('d-m-Y'))) / 86400;
                                            $s_endmember=(int) number_format($s_endmember, 2, '.', '');
                                                
                                            }
                                            if($rows["s_verified"] == 0){
                                                $members="<span class=\"badge badge-outline badge-danger\">Yasaklı</span>";
                                            }else{
                                                if($rows["s_member"]=="0"){
                                                    $members="<span class=\"badge badge-outline badge-warning\">Üyeliği Bitti</span>";
                                                }
                                                if($rows["s_member"]=="1"){
                                                    $members="<span class=\"badge badge-outline badge-primary\">Premium</span>";
                                                }
                                                if($rows["s_member"]=="2"){
                                                    $members="<span class=\"badge badge-outline badge-info\">Admin</span>";
                                                    $rows["s_key"]="••••••••••••••";
                                                }
                                            }
                                            if($s_endmember<=0){
                                                
                                                $sqla="DELETE FROM andrei_kullanici WHERE id = '".$rows["id"]."'";
                                                mysqli_query($conn,$sqla);
                                            }
                                            echo "<tr><td>".$rows["s_name"]."</td>
                                                 <td>".$rows["s_key"]."</td>
                                                 <td>".$rows["s_lastlogin"]."</td>
                                                 <td>".$members."</td>
                                                 <td>".$s_endmember."</td>
                                                 <td>".$rows["s_add"]."</td>
                                                 <td><a href=\"admin-member.php?id=".$rows["id"]."\" class=\"button button-box button-sm button-info\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
                                                 </tr>";
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

        </div><!-- Content Body End -->
        <?php include("inc/footer.php");?>


    </div>

    <!-- JS
============================================ -->

    <script>
    $("#key-ekle").click(function() {
        $.ajax({
            type: 'POST',
            url: 'libs/admin-key-ekle.php',
            data: {
                'member': $("#member option:selected").val(),
                'endmember': $("#endmember").val(),
                'name': $('#name').val(),
                'key': $('#key').val()
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
            success: function(data) {
                data=JSON.parse(data);
                if (data.status == "success") {
                    return swal({
                        title: data.mesaj,
                        icon: "success"
                    });
                }
                if (data.status == "mevcut") {
                    return swal({
                        title: "Key veri tabanında mevcut tekrar üretin.",
                        icon: "warning"

                    });
                }
                if (data.status == "empty") {
                    return swal({
                        title: "Lütfen tüm alanları doldurun.",
                        icon: "warning"

                    });
                }
                if (data.status == "hata") {
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
        url: 'libs/admin-uyelik-sil.php',
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
                    title: "Üyelik Silindi",
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
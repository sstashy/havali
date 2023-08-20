<!DOCTYPE html>
<html lang="tr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="andrei">

    <title>andrei</title>
    <!-- EXTRAS -->
	<link rel="shortcut icon" href="logo.png">
    <link rel="icon" type="image/png" sizes="192x192" href="logo.png">
    <link rel="apple-touch-icon" sizes="180x180" href="logo.png">
    <link rel="stylesheet" href="./assets/sweetalert2.min.css">
    <link rel="stylesheet" href="./assets/select2.min.css">
    <link rel="stylesheet" href="./assets/select2-bootstrap4.min.css">

    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <!-- THEMES -->
    <link rel="stylesheet" type="text/css" href="./assets/app.css">
    <link rel="stylesheet" type="text/css" href="./assets/bootstrap-grid.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/edit.css">

    <link rel="stylesheet" href="./assets/scale.css">
    <!-- AlpineJS Tooltip Plugin -->
    <script src="./assets/cdn.min.js.indir" defer=""></script>
    <!-- AlpineJS Core -->
    <script defer="" src="./assets/cdn.min.js(1).indir"></script>
    <!-- Fast Average Color Plugin -->
    <script src="./assets/index.browser.min.js.indir"></script>

    <script src="./assets/main.js.indir"></script><script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js
"></script>
<link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css
" rel="stylesheet">


    <style>
    .header-banner {
        background: url(Albayrak) no-repeat center center #b01030;
    }
    </style>
    <style type="text/css">
    </style>
</head>

<body x-data="body" style="overflow: auto;">
<?php

if($_POST){
    error_reporting(0);
    include_once("sysmx/libs/db.php");
    include_once("sysmx/libs/auth-systemcontrol.php");
    extract($_POST);
    session_start();
    if($key!=""){
    
    
    $sql="select * from andrei_kullanici where s_key=\"$key\"";
    $sonuc= mysqli_query($conn,$sql);
    $satirsay=mysqli_num_rows($sonuc);
    if ($satirsay>0)
    {
      while( $rows=mysqli_fetch_assoc($sonuc) ){
        $s_id=$rows["id"];
        $s_ip=$rows["s_ip"];
        $s_os=$rows["s_os"];
        $s_browser=$rows["s_browser"];
        $s_browserdetails=$rows["s_browserdetails"];
        $s_lastlogin=$rows["s_lastlogin"];
        $s_verified=$rows["s_verified"];
        $s_member=$rows["s_member"];
        $s_endmember=$rows["s_endmember"];
        $s_name=$rows["s_name"];
      }
      $bugun=date('d/m/Y H:i');
      $bitis=substr($s_endmember, 6, 4).substr($s_endmember, 3, 2).substr($s_endmember, 0, 2);
      if($bitis<date('Ymd')){
        echo "<script>
        Swal.fire({
          icon: 'error',
          title: 'ÜYELİK BİTTİ',
        });
              </script>";
     }else if($s_member == 0){
      echo "<script>
      Swal.fire({
        icon: 'error',
        title: 'ÜYELİK İPTAL EDİLDİ',
      });
            </script>";
      }
      else if($s_verified == 0){
        echo "<script>
        Swal.fire({
          icon: 'error',
          title: 'MULTİ BANNED',
        });
              </script>";
      }
      else if(!$s_ip || !$s_os || !$s_browser || !$s_browserdetails){
    
        if($s_member==2){
          $_SESSION["name"]=$s_name;
          $_SESSION["lastlogin"]=$s_lastlogin;
          $_SESSION["key"]=$key;
          header("Location:sysmx/dashboard.php");
        }else{
    
        $sql="UPDATE andrei_kullanici SET s_ip = '$ip', s_os = '$os', s_browser = '$browser', s_browserdetails = '$browserdetails', s_lastlogin = '$bugun' WHERE id = '$s_id'";
                         
        $sonuc=mysqli_query($conn,$sql);
        if ($sonuc>0){
            $_SESSION["name"]=$s_name;
            $_SESSION["lastlogin"]=$s_lastlogin;
            $_SESSION["key"]=$key;
            $d_name=$s_name;
            $d_details="Giriş Yaptı. ( Browser Güncellendi )";
            $d_date=date('d-m-Y H:i:s');
            $sqlekle="INSERT INTO andrei_log (s_name, s_details, s_date) VALUES ('$d_name', '$d_details' ,'$d_date')";
            $sonuc=mysqli_query($conn,$sqlekle);
            header("Location:sysmx/dashboard.php");
          }else{
          }
        }
    
      }
     
      else if ( $s_os==$os && $s_browser==$browser && $s_browserdetails==$browserdetails){
      // else if ( $s_os==$os && $s_browser==$browser && $s_browserdetails==$browserdetails  && $s_ip==$ip){
        
    
        $sql="UPDATE andrei_kullanici SET s_lastlogin = '$bugun' WHERE id = '$s_id'";
                         
        $sonuc=mysqli_query($conn,$sql);
        if ($sonuc>0){    
            $d_name=$s_name;
            $d_details="Giriş Yaptı. ";
            $d_date=date('d-m-Y H:i:s');
            $sqlekle="INSERT INTO andrei_log (s_name, s_details, s_date) VALUES ('$d_name', '$d_details' ,'$d_date')";
            $sonuc=mysqli_query($conn,$sqlekle);
            $_SESSION["name"]=$s_name;
            $_SESSION["lastlogin"]=$s_lastlogin;
            $_SESSION["key"]=$key;
            header("Location:sysmx/dashboard.php");
          }else{
          }
      }else{
        $d_name=$s_name;
        $d_details="Multi üyelikten dolayı giriş başarısız. ";
        $d_date=date('d-m-Y H:i:s');
        $sqlekle="INSERT INTO andrei_log (s_name, s_details, s_date) VALUES ('$d_name', '$d_details' ,'$d_date')";
        $sonuc=mysqli_query($conn,$sqlekle);
        header("Location:sysmx/dashboard.php");
        echo "<script>
        Swal.fire({
          icon: 'error',
          title: 'MULTİ ÜYELİK',
        });
              </script>";
      }
    
    } else{
      echo "<script>
      Swal.fire({
        icon: 'error',
        title: 'Hatalı Key',
      });
            </script>";

    }
    }else{
    }
    }
?>


<iframe src="a.mp3" allow="autoplay" loop  style="display:none">
</iframe> 
<audio  loop autoplay>

  <source src="sysmx/assets/media/trs.mp3"  type="audio/mpeg">

</audio>
<div id="app">

<!-- Preloader -->
<main class="main" role="main">
    <section id="__heroSection">
        <div class="container mx-auto pt-36 pb-60 lg:pt-48 lg:pb-96 relative z-20 px-6 xl:px-0">
                <div class="lg:col-span-3 card card-simple p-6 lg:-mt-40 bg-voon-800">
					          <!-- <center> <img src="albayrakpng.png" width="700px">   </center> -->
					          <?php
                      include("sysmx/inc/andrei.php");
                    ?>
                    <div class="absolute bottom-0 left-0 grid grid-cols-3 gap-4">
                        <span class="rounded-full bg-indigo-600 w-1 h-1"></span>
                        <span class="rounded-full bg-indigo-600 w-1 h-1"></span>
                        <span class="rounded-full bg-indigo-600 w-1 h-1"></span>
                        <span class="rounded-full bg-indigo-600 w-1 h-1"></span>
                        <span class="rounded-full bg-indigo-600 w-1 h-1"></span>
                        <span class="rounded-full bg-indigo-600 w-1 h-1"></span>
                        <span class="rounded-full bg-indigo-600 w-1 h-1"></span>
                        <span class="rounded-full bg-indigo-600 w-1 h-1"></span>
                        <span class="rounded-full bg-indigo-600 w-1 h-1"></span>
                        <span class="rounded-full bg-indigo-600 w-1 h-1"></span>
                        <span class="rounded-full bg-indigo-600 w-1 h-1"></span>
                        <span class="rounded-full bg-indigo-600 w-1 h-1"></span>
                    </div>
                    <form action="#" method="post">
                        <div class="mt-6">
                            <label class="sr-only" for="username">E-posta Adresi:</label>
                            <input name="key" class="form-control"
                                placeholder="" type="password">
                        </div>
                        <div class="flex justify-center">
                            <input type="hidden" name="csrf-token" id="login"
                                value="3c9de5919aaa1569d52c905903cdb63be00fdfd4a0cc0f71901c987f8c1989d9">
                            <button type="submit" name="insertAccounts"
                                class="mt-10 flex group gap-3 rounded-lg bg-gradient-to-tr from-purple-900 via-indigo-700 to-indigo-600 py-4 px-5 text-white font-medium text-sm">
                                Giris Yap
                                <svg class="w-4 group-hover:transform group-hover:rotate-20 transition"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path fill="currentColor"
                                        d="M144 112v51.6H48c-26.5 0-48 21.5-48 48v88.6c0 26.5 21.5 48 48 48h96v51.6c0 42.6 51.7 64.2 81.9 33.9l144-143.9c18.7-18.7 18.7-49.1 0-67.9l-144-144C195.8 48 144 69.3 144 112zm192 144L192 400v-99.7H48v-88.6h144V112l144 144zm80 192h-84c-6.6 0-12-5.4-12-12v-24c0-6.6 5.4-12 12-12h84c26.5 0 48-21.5 48-48V160c0-26.5-21.5-48-48-48h-84c-6.6 0-12-5.4-12-12V76c0-6.6 5.4-12 12-12h84c53 0 96 43 96 96v192c0 53-43 96-96 96z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
        </div>
    </section>
</main>
<footer id="footer" class="bg-voon-700/50">
    <div class="container mx-auto grid grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-0 px-6 lg:px-0 pt-8">
        <div class="col-span-2 lg:col-span-1 flex gap-3 items-center">
            <div class="text-sm font-medium text-indigo-300/75">
                <p>Copyright by andrei</p><br>
            </div>
            <div class="flex gap-2 ml-auto">
            </div>
        </div>
    </div>
</footer>
</div>
</script>
    <script src="./assets/jquery.min.js.indir"></script>
    <script src="./assets/bootstrap.bundle.min.js.indir"></script>
    <script src="./assets/jquery.scrollUp.min.js.indir"></script>
    <script src="./assets/clipboard.min.js.indir"></script>
    <script src="./assets/lazyload.min.js.indir"></script>
    <script src="./assets/select2.min.js.indir"></script>
    <script src="./assets/tr.min.js.indir"></script>
    <script src="./assets/bostrap.min.js"></script>
    <script src="./assets/store.js.indir"></script>
    <script type="text/javascript">
    var $onlineAPI = 1;
    var $preloaderStatus = 'false';
    </script>
    <script src="./assets/main.min.js.indir"></script>





</body>

</html>
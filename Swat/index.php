
<?php
require '../Functions/Baglan.php';
$customCSS = array('<link href="../assets/plugins/apexcharts/apexcharts.css" rel="stylesheet">');
$customJAVA = array(
    '<script src="../assets/plugins/apexcharts/apexcharts.min.js"></script>',
    '<script src="../assets/plugins/sparkline/jquery.sparkline.min.js"></script>',
    '<script src="../assets/js/pages/dashboard.js"></script>'
);

include('UserFunction/Main.php');
include('UserFunction/Bar.php');
include('UserFunction/Header.php');

$query = "SELECT * FROM sh_kullanici";

if ($result = mysqli_query($conn, $query)) {
    $rowcount = mysqli_num_rows($result);
    $rowcount;
} else {
    $rowcount = "0";
}
$query = "SELECT * FROM sh_kullanici WHERE k_verified = 'false'";
if ($result = mysqli_query($conn, $query)) {
    $rowcount2 = mysqli_num_rows($result);
    $rowcount2;
} else {
    $rowcount2 = "0";
}
?>
<?php require_once('Includes/head.php'); ?>
<body>
  <?php require_once('Includes/sidebar.php'); ?>
  <?php require_once('Includes/header.php'); ?>

  <!-- Main Container -->
  <main id="main-container">
    <!-- Hero -->
    
    <div class="content">
      <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center py-2 text-center text-md-start">
        <div class="flex-grow-1 mb-1 mb-md-0">
          <h1 class="h3 fw-bold mb-2">
            Dashboard - <?php echo $_SESSION['k_adi'] ?>
          </h1>
          <h2 class="h6 fw-medium fw-medium text-muted mb-0">
            Hoşgeldin <a class="fw-semibold" href="/profile"><?php echo $_SESSION['k_adi'] ?></a>, seni buralarda görmek ne güzel.
          <div class="col-md-6">
          
     
      
      </div>
      
    </div>
    <br>
    <button type="button" class="btn btn-alt-primary push" data-bs-toggle="modal" data-bs-target="#modal-block-popin">Bilgilendirmeyi Oku!</button>
    <div class="modal" id="modal-block-popin" tabindex="-1" role="dialog" aria-labelledby="modal-block-popin" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="block block-rounded block-transparent mb-0">
          <div class="block-header block-header-default">
            <h3 class="block-title">Bilgilendirme</h3>
            <div class="block-options">
              <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                <i class="fa fa-fw fa-times"></i>
              </button>
            </div>
          </div>
          <div class="block-content fs-sm">
          <p>Sorgu sistemlerinde ünlü sorgusu yapmak, yaptığınız sorguları paylaşmak, üyeliğinizi başkasıyla paylaşmak ban sebebidir otomatik olarak ban atılacaktır, telafisi yoktur!</p>
            <p>Amacımız tamamen hobiye dayanmaktadır. Bunun yanında sanal ortamda az da olsa ses çıkarmak, gündemde kalmak, ve bir yakını kaçırılan kişilerin eline daha hızlı bilgi vermek için kurulduk.</p>
           
          </div>
          <div class="block-content block-content-full text-end bg-body">
           
            <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Okudum, Anladım</button>
          </div>
        </div>
      </div>
    </div>
  </div>
        </div>
      </div>

      <!--






















        Deust CANIM BENIM :D HATIRA KALSIN



















    -->


      <!-- Page Content -->
      <div class="content">
        <!-- Overview -->
        <?php require_once('Includes/dashcards.php'); ?>
        <!-- Recent Orders -->


        <div class="block block-rounded">
          <div class="block-header block-header-default">
            <h3 class="block-title">Duyurular & Kurallar</h3>
            <div class="block-options space-x-1">
            </div>
          </div>

          <div class="block-content block-content-full">
            <!-- Recent Orders Table -->
            <div class="table-responsive">
              <table class="table table-hover table-vcenter">

                <tbody class="fs-sm">
                  <tr>
                    <td>
                      <p class="fw-semibold" href="javascript:void(0)"> Hesabınızı başka bir şahıs ile paylaştığınızda bu MULTİ HESAP olduğu için kalıcı bir şekilde banlanıcaksınız. </p>
                      <p class="fs-sm fw-medium text-muted mb-0">27.01.2023</p>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- END Recent Orders Table -->
          </div>

        </div>
        <!-- END Recent Orders -->
      </div>
      <!-- END Page Content -->
  </main>
  <!-- END Main Container -->

  <!-- Footer -->
  <?php require_once('Includes/footer.php'); ?>
  <!-- END Footer -->
  </div>
  <!-- END Page Container -->

  <?php require_once('Includes/jscode.php'); ?>
</body>

</html>
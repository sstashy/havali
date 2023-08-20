<!-- Side Header Start -->
<div class="side-header show">
    <button class="side-header-close"><i class="zmdi zmdi-close"></i></button>
    <!-- Side Header Inner Start -->
    <div class="side-header-inner custom-scroll">
<style>
    .no-link{
        cursor: not-allowed;
        color:#545660!important;
    }
    .side-header-menu li a i{
        color:#fff;
    }
</style>
        <nav class="side-header-menu" id="side-header-menu">
            <ul>
                <li><a href="dashboard.php"><i class="ti-home"></i> <span>Anasayfa</span></a>
                </li>
                <li class="has-sub-menu"><a href="#"><i class="ti-crown"></i> <span>PRO Sorgular</span></a>
                    <ul class="side-header-sub-menu">
                        <li><a href="adsoyadpro.php"><span>Ad Soyad PRO Sorgu</span></a></li>
                        <!-- <li><a href="ayakpro.php"><span>Ayak PRO Sorgu</span></a></li> -->
                    </ul>
                </li>
                <li class="has-sub-menu"><a href="#"><i class="ti-search"></i> <span>KLASİK Sorgular</span></a>
                    <ul class="side-header-sub-menu">
                        <li><a href="adsoyadsorgu.php"><span>Ad Soyad Sorgu</span></a></li>
                        <li><a href="tcsorgu.php"><span>T.C. Sorgu</span></a></li>
                        <li><a href="ailesorgu.php"><span>Aile Sorgu</span></a></li>
                        <li><a href="sulalesorgu.php"><span>Soyağacı Sorgu</span></a></li>
                        <li><a href="atsorgu.php"><span>AT Sorgu</span></a></li>
                    </ul>
                </li>
                <li class="has-sub-menu"><a href="#"><i class="fa fa-phone"></i> <span>Telefon</span></a>
                    <ul class="side-header-sub-menu">
                        <li><a href="tc-gsm.php"><span>TCKN'den GSM Sorgu</span></a></li>
                        <li><a href="gsm-tc.php"><span>GSM'den TCKN Sorgu</span></a></li>
                    </ul>
                </li>
                <li class="has-sub-menu"><a href="#"><i class="fa fa-graduation-cap"></i> <span>Okul</span></a>
                    <ul class="side-header-sub-menu">
                        <li><a href="#" class="no-link"><span>Okul Sorgu</span></a></li>
                    </ul>
                </li>
                <li class="has-sub-menu"><a href="#"><i class="fa fa-hospital-o"></i> <span>Hastane</span></a>
                    <ul class="side-header-sub-menu">
                        <li><a href="#" class="no-link"><span>Aşı Sorgu</span></a></li>
                    </ul>
                </li>
                <li class="has-sub-menu"><a href="#"><i class="ti-camera"></i> <span>Fotoğraf</span></a>
                    <ul class="side-header-sub-menu">
                        <li><a href="#" class="no-link"><span>Vesika Sorgu</span></a></li>
                    </ul>
                </li>
                <li class="has-sub-menu"><a href="#"><i class="ti-car"></i> <span>Araç</span></a>
                    <ul class="side-header-sub-menu">
                        <li><a href="#" class="no-link"><span>Plaka Sorgu</span></a></li>
                        <li><a href="#" class="no-link"><span>Plaka Vergi Sorgu</span></a></li>
                    </ul>
                </li>
                <li class="has-sub-menu"><a href="#"><i class="ti-settings"></i> <span>Yardımcı Araçlar</span></a>
                    <ul class="side-header-sub-menu">
                    <li><a href="ipsorgu.php"><span>İP Sorgu</span></a></li>
                        <li><a href="ibansorgu.php"><span>IBAN Sorgu</span></a></li>
                        <li><a href="#" class="no-link"><span>BIN Sorgu</span></a></li>
                        <li><a href="#" class="no-link"><span>BLUTV Sorgu</span></a></li>
                    </ul>
                </li>
                <li class="has-sub-menu"><a href="#"><i class="ti-signal"></i> <span>Yakında</span></a>
                    <ul class="side-header-sub-menu">
                        <li><a href="#" class="no-link"><span>İhbar Botu</span></a></li>
                        <li><a href="#" class="no-link"><span>İnstagram Sorgu</span></a></li>
                        <li><a href="#" class="no-link"><span>Kimlik Oluşturucu</span></a></li>
                        <li><a href="#" class="no-link"><span>Plaka sorgu</span></a></li>
                        <li><a href="#" class="no-link"><span>CC Checker</span></a></li>
                        <li><a href="#" class="no-link"><span>SMS Bomber</span></a></li>
                        <li><a href="#" class="no-link"><span>Plaka PRO Sorgu</span></a></li>
                        <li><a href="#" class="no-link"><span>Ayak PRO Sorgu</span></a></li>
                        <li><a href="#" class="no-link"><span>Tapu Sorgu</span></a></li>
                        <!-- <li><a href="#" class="no-link"><span>AT Sorgu</span></a></li> -->
                        <li><a href="#" class="no-link"><span>Ikametgah Sorgu [Kısa Süreli Bakım]</span></a></li>
                        <!-- <li><a href="#" class="no-link"><span>Tapu Sorgu [Kısa Süreli Bakım]</span></a></li> -->

                    </ul>
                </li>
                <?php if($s_member==2){?>
                <li class="has-sub-menu"><a href="#"><i class="ti-key"></i> <span>Admin</span></a>
                    <ul class="side-header-sub-menu">
                        <li><a href="admin-duyuru.php"><span>Duyurular</span></a></li>
                        <li><a href="admin-key.php"><span>Üyelikler</span></a></li>
                        <li><a href="admin-log.php"><span>Canlı Log</span></a></li>
                    </ul>
                </li>
                <?php }?>
                <li><a href="logout.php"><i class="fa fa-sign-out"></i> <span>Çıkış Yap</span></a>
                </li>
            </ul>
        </nav>

    </div><!--Side Header Inner End-->
</div><!-- Side Header End -->
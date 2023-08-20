<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php
        $page_title="IBAN Sorgu";
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
                <h3 class="title">IBAN Sorgu</h3>
            </div>
            <div class="row">
                <div class="col-12 mb-30">
                    <div class="box">
                        <div class="box-body">
                            <div class="row mbn-20">

                                <!--Form Field-->
                                <div class="col-lg-12 col-12 mb-20">
                                    <form method="post">
                                    <div class="col-12">
                                            <div class="col mb-15">
                                                <label for="tel" style="color:#fff;">IBAN</label>
                                                <input type="text" class="form-control" id="iban" name="iban" placeholder="TR__ ____ ____ ____ ____ ____ __" data-mask="TR99 9999 9999 9999 9999 9999 99">
                                            </div>
                                        </div>
                                        <div class="col-12 mb-15" style="text-align:center;">
                                            <button class="button button-info" id="search"><span>Sorgula</span></button>
                                        </div>
</form>

                                </div>
                                <!--Form Field-->

                                <div class="table-responsive">
                                    <table class="table" style="text-align:center;">
                                        <thead>
                                            <tr>
                                                <th>IBAN</th>
                                                <th>BANKA ADI</th>
                                                <th>BANKA KOD/SWIFT</th>
                                                <th>HESAP NO</th>
                                                <th>ŞUBE ADI</th>
                                                <th>ŞUBE ÜLKE</th>
                                                <th>ŞUBE İL</th>
                                                <th>ŞUBE İLÇE</th>
                                                <th>ŞUBE TEL</th>
                                                <th>ŞUBE ADRES</th>
                                            </tr>
                                        </thead>
                                        <tbody id="sonuc">
                                        <tr style="text-align: center;">
       <?php
         if ($_POST) {
            $iban = $_POST["iban"];
            $iban = str_replace(" ", "", $iban);
            $ulke_kod = substr($iban,0,2);
            $kod = substr($iban,4,5);
            $acc = substr($iban,9);
            $filename = "https://www.e-iban.com/banka.php?acc=$acc&kod=$kod&ulke=$ulke_kod";
            $data = file_get_contents($filename);
            $information = explode(';', $data);
            $banka_adi = $information[0];
            $banka_sube = $information[1];
            $banka_kod_swift = $information[2];
            $banka_adres = $information[3];
            if(str_contains($banka_adres, "<br>")){
                $banka_adres = str_replace("<br>", "", $banka_adres);
            } elseif($banka_adres == null || empty($banka_adres) == true) {
                $banka_adres = "BULUNMADI";
            }
            $countries = array(
                'TR' => 'Türkiye',
                'VI' => 'ABD Virgin Adaları',
                'AF' => 'Afganistan',
                'AX' => 'Aland Adaları',
                'DE' => 'Almanya',
                'US' => 'Amerika Birleşik Devletleri',
                'UM' => 'Amerika Birleşik Devletleri Küçük Dış Adaları',
                'AS' => 'Amerikan Samoası',
                'AD' => 'Andora',
                'AO' => 'Angola',
                'AI' => 'Anguilla',
                'AQ' => 'Antarktika',
                'AG' => 'Antigua ve Barbuda',
                'AR' => 'Arjantin',
                'AL' => 'Arnavutluk',
                'AW' => 'Aruba',
                'QU' => 'Avrupa Birliği',
                'AU' => 'Avustralya',
                'AT' => 'Avusturya',
                'AZ' => 'Azerbaycan',
                'BS' => 'Bahamalar',
                'BH' => 'Bahreyn',
                'BD' => 'Bangladeş',
                'BB' => 'Barbados',
                'EH' => 'Batı Sahara',
                'BZ' => 'Belize',
                'BE' => 'Belçika',
                'BJ' => 'Benin',
                'BM' => 'Bermuda',
                'BY' => 'Beyaz Rusya',
                'BT' => 'Bhutan',
                'ZZ' => 'Bilinmeyen veya Geçersiz Bölge',
                'AE' => 'Birleşik Arap Emirlikleri',
                'GB' => 'Birleşik Krallık',
                'BO' => 'Bolivya',
                'BA' => 'Bosna Hersek',
                'BW' => 'Botsvana',
                'BV' => 'Bouvet Adası',
                'BR' => 'Brezilya',
                'BN' => 'Brunei',
                'BG' => 'Bulgaristan',
                'BF' => 'Burkina Faso',
                'BI' => 'Burundi',
                'CV' => 'Cape Verde',
                'GI' => 'Cebelitarık',
                'DZ' => 'Cezayir',
                'CX' => 'Christmas Adası',
                'DJ' => 'Cibuti',
                'CC' => 'Cocos Adaları',
                'CK' => 'Cook Adaları',
                'TD' => 'Çad',
                'CZ' => 'Çek Cumhuriyeti',
                'CN' => 'Çin',
                'DK' => 'Danimarka',
                'DM' => 'Dominik',
                'DO' => 'Dominik Cumhuriyeti',
                'TL' => 'Doğu Timor',
                'EC' => 'Ekvator',
                'GQ' => 'Ekvator Ginesi',
                'SV' => 'El Salvador',
                'ID' => 'Endonezya',
                'ER' => 'Eritre',
                'AM' => 'Ermenistan',
                'EE' => 'Estonya',
                'ET' => 'Etiyopya',
                'FK' => 'Falkland Adaları (Malvinalar)',
                'FO' => 'Faroe Adaları',
                'MA' => 'Fas',
                'FJ' => 'Fiji',
                'CI' => 'Fildişi Sahilleri',
                'PH' => 'Filipinler',
                'PS' => 'Filistin Bölgesi',
                'FI' => 'Finlandiya',
                'FR' => 'Fransa',
                'GF' => 'Fransız Guyanası',
                'TF' => 'Fransız Güney Bölgeleri',
                'PF' => 'Fransız Polinezyası',
                'GA' => 'Gabon',
                'GM' => 'Gambia',
                'GH' => 'Gana',
                'GN' => 'Gine',
                'GW' => 'Gine-Bissau',
                'GD' => 'Granada',
                'GL' => 'Grönland',
                'GP' => 'Guadeloupe',
                'GU' => 'Guam',
                'GT' => 'Guatemala',
                'GG' => 'Guernsey',
                'GY' => 'Guyana',
                'ZA' => 'Güney Afrika',
                'GS' => 'Güney Georgia ve Güney Sandwich Adaları',
                'KR' => 'Güney Kore',
                'CY' => 'Güney Kıbrıs Rum Kesimi',
                'GE' => 'Gürcistan',
                'HT' => 'Haiti',
                'HM' => 'Heard Adası ve McDonald Adaları',
                'IN' => 'Hindistan',
                'IO' => 'Hint Okyanusu İngiliz Bölgesi',
                'NL' => 'Hollanda',
                'AN' => 'Hollanda Antilleri',
                'HN' => 'Honduras',
                'HK' => 'Hong Kong SAR - Çin',
                'HR' => 'Hırvatistan',
                'IQ' => 'Irak',
                'VG' => 'İngiliz Virgin Adaları',
                'IR' => 'İran',
                'IE' => 'İrlanda',
                'ES' => 'İspanya',
                'IL' => 'İsrail',
                'SE' => 'İsveç',
                'CH' => 'İsviçre',
                'IT' => 'İtalya',
                'IS' => 'İzlanda',
                'JM' => 'Jamaika',
                'JP' => 'Japonya',
                'JE' => 'Jersey',
                'KH' => 'Kamboçya',
                'CM' => 'Kamerun',
                'CA' => 'Kanada',
                'ME' => 'Karadağ',
                'QA' => 'Katar',
                'KY' => 'Kayman Adaları',
                'KZ' => 'Kazakistan',
                'KE' => 'Kenya',
                'KI' => 'Kiribati',
                'CO' => 'Kolombiya',
                'KM' => 'Komorlar',
                'CG' => 'Kongo',
                'CD' => 'Kongo Demokratik Cumhuriyeti',
                'CR' => 'Kosta Rika',
                'KW' => 'Kuveyt',
                'KP' => 'Kuzey Kore',
                'MP' => 'Kuzey Mariana Adaları',
                'CU' => 'Küba',
                'KG' => 'Kırgızistan',
                'LA' => 'Laos',
                'LS' => 'Lesotho',
                'LV' => 'Letonya',
                'LR' => 'Liberya',
                'LY' => 'Libya',
                'LI' => 'Liechtenstein',
                'LT' => 'Litvanya',
                'LB' => 'Lübnan',
                'LU' => 'Lüksemburg',
                'HU' => 'Macaristan',
                'MG' => 'Madagaskar',
                'MO' => 'Makao S.A.R. Çin',
                'MK' => 'Makedonya',
                'MW' => 'Malavi',
                'MV' => 'Maldivler',
                'MY' => 'Malezya',
                'ML' => 'Mali',
                'MT' => 'Malta',
                'IM' => 'Man Adası',
                'MH' => 'Marshall Adaları',
                'MQ' => 'Martinik',
                'MU' => 'Mauritius',
                'YT' => 'Mayotte',
                'MX' => 'Meksika',
                'FM' => 'Mikronezya Federal Eyaletleri',
                'MD' => 'Moldovya Cumhuriyeti',
                'MC' => 'Monako',
                'MS' => 'Montserrat',
                'MR' => 'Moritanya',
                'MZ' => 'Mozambik',
                'MN' => 'Moğolistan',
                'MM' => 'Myanmar',
                'EG' => 'Mısır',
                'NA' => 'Namibya',
                'NR' => 'Nauru',
                'NP' => 'Nepal',
                'NE' => 'Nijer',
                'NG' => 'Nijerya',
                'NI' => 'Nikaragua',
                'NU' => 'Niue',
                'NF' => 'Norfolk Adası',
                'NO' => 'Norveç',
                'CF' => 'Orta Afrika Cumhuriyeti',
                'UZ' => 'Özbekistan',
                'PK' => 'Pakistan',
                'PW' => 'Palau',
                'PA' => 'Panama',
                'PG' => 'Papua Yeni Gine',
                'PY' => 'Paraguay',
                'PE' => 'Peru',
                'PN' => 'Pitcairn',
                'PL' => 'Polonya',
                'PT' => 'Portekiz',
                'PR' => 'Porto Riko',
                'RE' => 'Reunion',
                'RO' => 'Romanya',
                'RW' => 'Ruanda',
                'RU' => 'Rusya Federasyonu',
                'SH' => 'Saint Helena',
                'KN' => 'Saint Kitts ve Nevis',
                'LC' => 'Saint Lucia',
                'PM' => 'Saint Pierre ve Miquelon',
                'VC' => 'Saint Vincent ve Grenadinler',
                'WS' => 'Samoa',
                'SM' => 'San Marino',
                'ST' => 'Sao Tome ve Principe',
                'SN' => 'Senegal',
                'SC' => 'Seyşeller',
                'SL' => 'Sierra Leone',
                'SG' => 'Singapur',
                'SK' => 'Slovakya',
                'SI' => 'Slovenya',
                'SB' => 'Solomon Adaları',
                'SO' => 'Somali',
                'LK' => 'Sri Lanka',
                'SD' => 'Sudan',
                'SR' => 'Surinam',
                'SY' => 'Suriye',
                'SA' => 'Suudi Arabistan',
                'SJ' => 'Svalbard ve Jan Mayen',
                'SZ' => 'Svaziland',
                'RS' => 'Sırbistan',
                'CS' => 'Sırbistan-Karadağ',
                'CL' => 'Şili',
                'TJ' => 'Tacikistan',
                'TZ' => 'Tanzanya',
                'TH' => 'Tayland',
                'TW' => 'Tayvan',
                'TG' => 'Togo',
                'TK' => 'Tokelau',
                'TO' => 'Tonga',
                'TT' => 'Trinidad ve Tobago',
                'TN' => 'Tunus',
                'TC' => 'Turks ve Caicos Adaları',
                'TV' => 'Tuvalu',
                'TM' => 'Türkmenistan',
                'UG' => 'Uganda',
                'UA' => 'Ukrayna',
                'OM' => 'Umman',
                'UY' => 'Uruguay',
                'QO' => 'Uzak Okyanusya',
                'JO' => 'Ürdün',
                'VU' => 'Vanuatu',
                'VA' => 'Vatikan',
                'VE' => 'Venezuela',
                'VN' => 'Vietnam',
                'WF' => 'Wallis ve Futuna',
                'YE' => 'Yemen',
                'NC' => 'Yeni Kaledonya',
                'NZ' => 'Yeni Zelanda',
                'GR' => 'Yunanistan',
                'ZM' => 'Zambiya',
                'ZW' => 'Zimbabve'
            );
            $banka_ulke = $countries["$ulke_kod"];
            if($banka_adres == "BULUNMADI") {
                $banka_il = "BULUNMADI";
                $banka_ilce = "BULUNMADI";
            } else {
                $banka_il = explode('-', $banka_adres)[1];
                $banka_ilce = explode('-', $banka_adres)[0];
            }
            $banka_tel = $information[5];
            $banka_hesap_no = $information[8];
                echo "<td>" . $iban  . "</td>
                <td>" . $banka_adi . "</td>
                <td>" . $banka_kod_swift . "</td>
                <td>" . $banka_hesap_no . "</td>
                <td>" . $banka_sube . "</td>
                <td>" . $banka_ulke . "</td>
                <td>" . $banka_il . "</td>
                <td>" . $banka_ilce . "</td>
                <td>" . $banka_tel . "</td>
                <td>" . $banka_adres . "</td>";
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
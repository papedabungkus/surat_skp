<?php
    //cek session
    /*
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
        header("Location: ./");
        die(); 
    } else { */

        echo '
        <style type="text/css">
            table {
                background: #fff;
                padding: 5px;
            }
            tr, td {
                border: table-cell;
                border: 1px  solid #444;
            }
            tr,td {
                vertical-align: top!important;
            }
            #right {
                border-right: none !important;
            }
            #left {
                border-left: none !important;
            }
            #bottom {
                border-bottom: none !important;
            }
            .isi {
                height: 300px!important;
            }
            .disp {
                text-align: center;
                padding: 1.5rem 0;
                margin-bottom: .5rem;
            }
            .logodisp {
                float: left;
                position: relative;
                width: 110px;
                height: 110px;
                margin: 0 0 0 1rem;
            }
            #lead {
                width: auto;
                position: relative;
                margin: 25px 0 0 75%;
            }
            .lead {
                font-weight: bold;
                text-decoration: underline;
                margin-bottom: -10px;
            }
            .tgh {
                text-align: center;
            }
            #nama {
                font-size: 2.1rem;
                margin-bottom: -1rem;
            }
            #alamat {
                font-size: 16px;
            }
            .up {
                text-transform: uppercase;
                margin: 0;
                line-height: 2.2rem;
                font-size: 1.5rem;
            }
            .status {
                margin: 0;
                font-size: 1.3rem;
                margin-bottom: .5rem;
            }
            #lbr {
                font-size: 20px;
                font-weight: bold;
            }
            .separator {
                border-bottom: 2px solid #616161;
                margin: -1.3rem 0 1.5rem;
            }
            @media print{
                body {
                    font-size: 12px;
                    color: #212121;
                }
                nav {
                    display: none;
                }
                table {
                    width: 100%;
                    font-size: 12px;
                    color: #212121;
                }
                tr, td {
                    border: table-cell;
                    border: 1px  solid #444;
                    padding: 8px!important;

                }
                tr,td {
                    vertical-align: top!important;
                }
                #lbr {
                    font-size: 20px;
                }
                .isi {
                    height: 200px!important;
                }
                .tgh {
                    text-align: center;
                }
                .disp {
                    text-align: center;
                    margin: -.5rem 0;
                }
                .logodisp {
                    float: left;
                    position: relative;
                    width: 80px;
                    height: 80px;
                    margin: .5rem 0 0 .5rem;
                }
                #lead {
                    width: auto;
                    position: relative;
                    margin: 15px 0 0 75%;
                }
                .lead {
                    font-weight: bold;
                    text-decoration: underline;
                    margin-bottom: -10px;
                }
                #nama {
                    font-size: 20px!important;
                    font-weight: bold;
                    text-transform: uppercase;
                    margin: -10px 0 -20px 0;
                }
                .up {
                    font-size: 17px!important;
                    font-weight: normal;
                }
                .status {
                    font-size: 17px!important;
                    font-weight: normal;
                    margin-bottom: -.1rem;
                }
                #alamat {
                    margin-top: -15px;
                    font-size: 13px;
                }
                #lbr {
                    font-size: 17px;
                    font-weight: bold;
                }
                .separator {
                    border-bottom: 2px solid #616161;
                    margin: -1rem 0 1rem;
                }

            }
        </style>

        <body onload="window.print()">
 
        <!-- Container START -->
            <div id="colres">';
                $id_disposisi = mysqli_real_escape_string($config, $_REQUEST['id_disposisi']);
                $id_surat = mysqli_real_escape_string($config, $_REQUEST['id_surat']);
                $query = mysqli_query($config, "SELECT * FROM tbl_disposisi JOIN tbl_surat_masuk ON tbl_disposisi.id_surat = tbl_surat_masuk.id_surat WHERE tbl_disposisi.id_surat='$id_surat' AND tbl_disposisi.id_disposisi='$id_disposisi'");

                if(mysqli_num_rows($query) > 0){
                $no = 0;
                while($row = mysqli_fetch_array($query)){

                echo '<br /><br />
                    <table class="bordered" id="tbl">
                        <tbody>
                            <tr>
                                <td class="tgh" id="lbr" colspan="4"><br /><img width="100%" src="./asset/img/kop_disposisi.png"></td>
                            </tr>
                            <tr>
                                <td class="tgh" id="lbr" colspan="4">LEMBAR DISPOSISI</td>
                            </tr>
                            <tr>
                                <td id="right" width="20%"><strong>Nomor Agenda</strong></td>
                                <td id="left" width="25%">: '.$row['no_agenda'].'</td>
                                <td id="right" width="25%"><strong>Sifat Surat</strong> </td>
                                <td id="left" width="30%">: '.$row['sifat'].'</td>
                            </tr>
                            <tr>
                                <td id="right"><strong>Tanggal Terima</strong></td>
                                <td id="left">: '.indoDate($row['tgl_diterima']).'</td>
                                <td id="right"><strong>Tanggal Penyelesaian</strong> </td>
                                <td id="left">: '.indoDate($row['batas_waktu']).'</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="bordered" id="tbl">
                        <tbody>
                            <tr>
                                <td id="right"width="25%"><strong>Nomor/Tanggal Surat </strong></td>
                                <td id="left" width="75%">: '.$row['no_surat'].'<br />&nbsp;&nbsp;'.indoDate($row['tgl_surat']).'</td>
                            </tr>
                            <tr>
                                <td id="right"><strong>Asal Surat </strong></td>
                                <td id="left">: '.$row['asal_surat'].'</td>
                            </tr>
                            <tr>
                                <td id="right"><strong>Lampiran Surat </strong></td>
                                <td id="left">: '.$row['lampiran'].'</td>
                            </tr>
                            <tr>
                                <td id="right"><strong>Isi Surat </strong></td>
                                <td id="left">: '.$row['isi'].'</td>
                            </tr>
                        </tbody>
                    </table><br />
                    <table class="bordered" id="tbl">
                        <thead>
                            <tr>
                                <td id="left" width="35%"><strong><center>Disposisi</center></strong></td>
                                <td id="left" width="60%"><strong><center>Diteruskan Kepada</center></strong></td>
                                <td id="left" width="5%"><strong><center>Paraf</center></strong></td>
                            </tr>
                        <tbody>
                            <tr>
                                <td>';
                                if($row['isi_disposisi']=="Diketahui") {
                                    echo '<img width="20" height="20" src="./asset/img/check.jpg"> &nbsp;&nbsp;&nbsp;Diketahui<br />';
                                } else {
                                    echo '<img width="20" height="20" src="./asset/img/uncheck.png"> &nbsp;&nbsp;&nbsp;Diketahui<br />';
                                }
                                if($row['isi_disposisi']=="Dipedomani") {
                                    echo '<img width="20" height="20" src="./asset/img/check.jpg"> &nbsp;&nbsp;&nbsp;Dipedomani<br />';
                                } else {
                                    echo '<img width="20" height="20" src="./asset/img/uncheck.png"> &nbsp;&nbsp;&nbsp;Dipedomani<br />';
                                }
                                if($row['isi_disposisi']=="Ditindaklanjuti") {
                                    echo '<img width="20" height="20" src="./asset/img/check.jpg"> &nbsp;&nbsp;&nbsp;Ditindaklanjuti<br />';
                                } else {
                                    echo '<img width="20" height="20" src="./asset/img/uncheck.png"> &nbsp;&nbsp;&nbsp;Ditindaklanjuti<br />';
                                }
                                if($row['isi_disposisi']=="Konsultasikan") {
                                    echo '<img width="20" height="20" src="./asset/img/check.jpg"> &nbsp;&nbsp;&nbsp;Konsultasikan<br />';
                                } else {
                                    echo '<img width="20" height="20" src="./asset/img/uncheck.png"> &nbsp;&nbsp;&nbsp;Konsultasikan<br />';
                                }
                                if($row['isi_disposisi']=="Arsip") {
                                    echo '<img width="20" height="20" src="./asset/img/check.jpg"> &nbsp;&nbsp;&nbsp;Arsip<br />';
                                } else {
                                    echo '<img width="20" height="20" src="./asset/img/uncheck.png"> &nbsp;&nbsp;&nbsp;Arsip<br />';
                                }
                                if($row['isi_disposisi']=="Lain-lain") {
                                    echo '<img width="20" height="20" src="./asset/img/check.jpg"> &nbsp;&nbsp;&nbsp;Lain-lain<br />';
                                } else {
                                    echo '<img width="20" height="20" src="./asset/img/uncheck.png"> &nbsp;&nbsp;&nbsp;Lain-lain<br />';
                                }
                                echo '<br />';
                                    if($row['catatan']==""){
                                        echo '
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;................................................<br />
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;................................................<br />
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;................................................<br />
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;................................................<br />
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;................................................<br />
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;................................................<br />
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;................................................<br />';
                                    } else {
                                        echo $row['catatan'];
                                    };
                                    echo '<br /><br /><center>Kepala,</center><br /><br /><br />';
                                    $q_instansi = mysqli_query($config, "SELECT * FROM tbl_instansi");
                                    $r_instansi = mysqli_fetch_array($q_instansi);
                                    $pimpinan = $r_instansi['pimpinan'];
                                    $queryz = mysqli_query($config, "SELECT * FROM tbl_pegawai WHERE nama='$pimpinan'");
                                    while($rowz = mysqli_fetch_array($queryz)){
                                        echo '<center><strong>'.$rowz['nama']."</strong><br />NIP. ".$rowz['nip'].'</center>';
                                    }

                                echo '
                                    </td>
                                <td>';
                                    $x =  mysqli_query($config, "SELECT * FROM tujuan_disposisi");
                                    echo '<ol>';
                                    while($kpd = mysqli_fetch_array($x)){
                                        echo '<li style="line-height: 1.7;">'.$kpd['kepada'].'</li>';
                                    }
                                    echo '</ol>';
                                echo '
                                </td>
                                <td>';
                                    $x =  mysqli_query($config, "SELECT * FROM tujuan_disposisi");
                                    echo '<ol>';
                                    while($kpd = mysqli_fetch_array($x)){
                                        echo '<li style="line-height: 1.7;">..........</li>';
                                    }
                                    echo '</ol>';
                                echo '
                                </td>
                            </tr>
                        </tbody>
                    </table>';
            } 
        echo '            
        </div>
        <div class="jarak2"></div>
    <!-- Container END -->

    </body>';
    }
// }
?>

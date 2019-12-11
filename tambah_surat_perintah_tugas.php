<?php
require_once 'include/config.php';
require_once 'include/functions.php';
$config = conn($host, $username, $password, $database);
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {

        if(isset($_REQUEST['submit'])){

            //validasi form kosong
            if($_REQUEST['no_agenda'] == "" || $_REQUEST['no_surat'] == "" || $_REQUEST['dasar'] == ""
                || $_REQUEST['penerima_tugas'] == "" || $_REQUEST['peruntukan'] == ""  || $_REQUEST['tgl_ttd'] == ""  || $_REQUEST['tempat_ttd'] == ""){
                $_SESSION['errEmpty'] = 'ERROR! Semua form wajib diisi';
                echo '<script language="javascript">window.history.back();</script>';
            } else {

                $no_agenda = $_REQUEST['no_agenda'];
                $no_surat = $_REQUEST['no_surat'];
                $dasar = $_REQUEST['dasar'];

                    $penerima_tugas = array();
                    foreach ($_REQUEST['penerima_tugas'] as $petugas) {
                        array_push($penerima_tugas, $petugas);
                    }
                    $petugas = serialize($penerima_tugas);

                $peruntukan = $_REQUEST['peruntukan'];
                $tgl_ttd = $_REQUEST['tgl_ttd'];
                $tempat_ttd = $_REQUEST['tempat_ttd'];
                $id_user = $_SESSION['id_user'];

                //validasi input data
                if(!preg_match("/^[0-9]*$/", $no_agenda)){
                    $_SESSION['no_agendak'] = 'Form Nomor Agenda harus diisi angka!';
                    echo '<script language="javascript">window.history.back();</script>';
                } else {

                    if(!preg_match("/^[a-zA-Z0-9.\/ -]*$/", $no_surat)){
                        $_SESSION['no_suratk'] = 'Form No Surat hanya boleh mengandung karakter huruf, angka, spasi, titik(.), minus(-) dan garis miring(/)';
                        echo '<script language="javascript">window.history.back();</script>';
                    } else {

                        if(!preg_match("/^[a-zA-Z0-9.,() \/ -]*$/", $tujuan)){
                            $_SESSION['tujuan_surat'] = 'Form Tujuan Surat hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), kurung() dan garis miring(/)';
                            echo '<script language="javascript">window.history.back();</script>';
                        } else {
                            if(!preg_match("/^[a-zA-Z0-9.,() \/ -]*$/", $tempat_ttd)){
                                $_SESSION['tempat_ttdk'] = 'Form Tujuan Surat hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), kurung() dan garis miring(/)';
                                echo '<script language="javascript">window.history.back();</script>';
                            } else {


                            if(!preg_match("/^[a-zA-Z0-9.,_()%&@\/\r\n -]*$/", $isi)){
                                $_SESSION['isik'] = 'Form Isi Ringkas hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), kurung(), underscore(_), dan(&) persen(%) dan at(@)';
                                echo '<script language="javascript">window.history.back();</script>';
                            } else {

                                if(!preg_match("/^[a-zA-Z0-9., ]*$/", $nkode)){
                                    $_SESSION['kodek'] = 'Form Kode Klasifikasi hanya boleh mengandung karakter huruf, angka, spasi, titik(.) dan koma(,)';
                                    echo '<script language="javascript">window.history.back();</script>';
                                } else {

                                    if(!preg_match("/^[0-9.-]*$/", $tgl_surat)){
                                        $_SESSION['tgl_suratk'] = 'Form Tanggal Surat hanya boleh mengandung angka dan minus(-)';
                                        echo '<script language="javascript">window.history.back();</script>';
                                    } else {

                                        if(!preg_match("/^[a-zA-Z0-9.,()\/ -]*$/", $keterangan)){
                                            $_SESSION['keterangank'] = 'Form Keterangan hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), dan kurung()';
                                            echo '<script language="javascript">window.history.back();</script>';
                                        } else {

                                            $cek = mysqli_query($config, "SELECT * FROM tbl_surat_keluar WHERE no_surat='$no_surat'");
                                            $result = mysqli_num_rows($cek);

                                            if($result > 0){
                                                $_SESSION['errDup'] = 'Nomor Surat sudah terpakai, gunakan yang lain!';
                                                echo '<script language="javascript">window.history.back();</script>';
                                            } else {

                                                    $query = mysqli_query($config, "INSERT INTO tbl_surat_keluar(no_agenda,tujuan,no_surat,isi,kode,tgl_surat,tgl_catat,file,keterangan,id_user)
                                                        VALUES('$no_agenda','$petugas','$no_surat','$peruntukan','ST','$tgl_ttd',NOW(),'','Surat Perintah Tugas','$id_user')");
                                                    $query_suratperintahtugas = mysqli_query($config, "INSERT INTO tbl_surat_perintah_tugas(no_agenda,no_surat,dasar,penerima_tugas,peruntukan,tgl_ttd,tempat_ttd,nama_ttd,id_user)
                                                    VALUES('$no_agenda','$no_surat','$dasar','$petugas','$peruntukan','$tgl_ttd','$tempat_ttd','1','$id_user')");

                                                    if($query == true  && $query_suratperintahtugas == true){
                                                        $_SESSION['succAdd'] = 'SUKSES! Data berhasil ditambahkan';
                                                        header("Location: ./admin.php?page=bspt");
                                                        die();
                                                    } else {
                                                        $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                                                        echo '<script language="javascript">window.history.back();</script>';
                                                    }
                                                
                                            }
                                        }
                                    }
                                }}
                            }
                        }
                    }
                }
            }
        } else {?>

            <!-- Row Start -->
            <div class="row">
                <!-- Secondary Nav START -->
                <div class="col s12">
                    <nav class="secondary-nav">
                        <div class="nav-wrapper blue-grey darken-1">
                            <ul class="left">
                                <li class="waves-effect waves-light"><a href="?page=bspt&act=add" class="judul"><i class="material-icons">drafts</i> Tambah Data Surat Perintah Tugas</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <!-- Secondary Nav END -->
            </div>
            <!-- Row END -->

            <?php
                if(isset($_SESSION['errQ'])){
                    $errQ = $_SESSION['errQ'];
                    echo '<div id="alert-message" class="row">
                            <div class="col m12">
                                <div class="card red lighten-5">
                                    <div class="card-content notif">
                                        <span class="card-title red-text"><i class="material-icons md-36">clear</i> '.$errQ.'</span>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    unset($_SESSION['errQ']);
                }
                if(isset($_SESSION['errEmpty'])){
                    $errEmpty = $_SESSION['errEmpty'];
                    echo '<div id="alert-message" class="row">
                            <div class="col m12">
                                <div class="card red lighten-5">
                                    <div class="card-content notif">
                                        <span class="card-title red-text"><i class="material-icons md-36">clear</i> '.$errEmpty.'</span>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    unset($_SESSION['errEmpty']);
                }
            ?>

            <!-- Row form Start -->
            <div class="row jarak-form">

                <!-- Form START -->
                <form class="col s12" method="POST" action="?page=bspt&act=add" enctype="multipart/form-data">

                    <!-- Row in form START -->
                    <div class="row">
                        <div class="input-field col s2">
                            <i class="material-icons prefix md-prefix">looks_one</i>
                            <?php
                            echo '<input id="no_agenda" type="number" class="validate" name="no_agenda" value="';
                                $sql = mysqli_query($config, "SELECT no_agenda FROM tbl_surat_keluar");
                                $no_agenda = "1";
                                if (mysqli_num_rows($sql) == 0){
                                    echo $no_agenda;
                                }

                                $result = mysqli_num_rows($sql);
                                $counter = 0;
                                while(list($no_agenda) = mysqli_fetch_array($sql)){
                                    if (++$counter == $result) {
                                        $no_agenda++;
                                        echo $no_agenda;
                                    }
                                }
                                echo '" required>';

                                if(isset($_SESSION['no_agendak'])){
                                    $no_agendak = $_SESSION['no_agendak'];
                                    echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$no_agendak.'</div>';
                                    unset($_SESSION['no_agendak']);
                                }
                            ?>
                            <label for="no_agenda">Nomor Agenda</label>
                        </div>
                        <div class="input-field col s4">
                            <i class="material-icons prefix md-prefix">looks_two</i>
                            <input id="no_surat" type="text" class="validate" name="no_surat" required>
                                <?php
                                    if(isset($_SESSION['no_suratk'])){
                                        $no_suratk = $_SESSION['no_suratk'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$no_suratk.'</div>';
                                        unset($_SESSION['no_suratk']);
                                    }
                                    if(isset($_SESSION['errDup'])){
                                        $errDup = $_SESSION['errDup'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$errDup.'</div>';
                                        unset($_SESSION['errDup']);
                                    }
                                ?>
                            <label for="no_surat">Nomor Surat</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">description</i>
                            <textarea id="dasar" class="materialize-textarea validate" name="dasar" required></textarea>
                                <?php
                                    if(isset($_SESSION['dasark'])){
                                        $dasark = $_SESSION['dasark'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$dasark.'</div>';
                                        unset($_SESSION['dasark']);
                                    }
                                ?>
                            <label for="isi">Dasar Surat Perintah Tugas</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">perm_identity</i><label for="penerima_tugas">Menugaskan Kepada </label><br/>
                            <div class="input-field col s11 right">   
                                <?php $queryx = mysqli_query($config, "SELECT * FROM tbl_pegawai");?>
                                <select class="browser-default js-example-basic-multiple" name="penerima_tugas[]" multiple="multiple">
                                    <?php while($rowx = mysqli_fetch_array($queryx)){ ?>
                                        <option value="<?php echo $rowx['id'] ;?>"><?php echo $rowx['nama']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <?php 
                                    if(isset($_SESSION['penerima_tugask'])){
                                        $penerima_tugask = $_SESSION['penerima_tugask'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$penerima_tugask.'</div>';
                                        unset($_SESSION['penerima_tugask']);
                                    } 
                            ?>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">description</i>
                            <textarea id="peruntukan" class="materialize-textarea validate" name="peruntukan" required></textarea>
                                <?php
                                    if(isset($_SESSION['isik'])){
                                        $peruntukank = $_SESSION['peruntukank'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$peruntukank.'</div>';
                                        unset($_SESSION['peruntukank']);
                                    }
                                ?>
                            <label for="isi">Untuk Penugasan</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">places</i>
                            <input id="tempat_ttd" type="text" class="validate" name="tempat_ttd" required>
                                <?php
                                    if(isset($_SESSION['tempat_ttdk'])){
                                        $tempat_ttdk = $_SESSION['tempat_ttdk'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$tempat_ttdk.'</div>';
                                        unset($_SESSION['tempat_ttdk']);
                                    }
                                ?>
                            <label for="keterangan">Tempat Dikeluarkan Surat</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">date_range</i>
                            <input id="tgl_surat" type="text" name="tgl_ttd" class="datepicker" required>
                                <?php
                                    if(isset($_SESSION['tgl_ttdk'])){
                                        $tgl_ttdk = $_SESSION['tgl_ttdk'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$tgl_ttdk.'</div>';
                                        unset($_SESSION['tgl_ttdk']);
                                    }
                                ?>
                            <label for="tgl_surat">Tanggal Surat  Tugas</label>
                        </div>
                    </div>
                    <!-- Row in form END -->

                    <div class="row">
                        <div class="col 6">
                            <button type="submit" name="submit" class="btn-large blue waves-effect waves-light">SIMPAN <i class="material-icons">done</i></button>
                        </div>
                        <div class="col 6">
                            <a href="?page=bspt" class="btn-large deep-orange waves-effect waves-light">BATAL <i class="material-icons">clear</i></a>
                        </div>
                    </div>

                </form>
                <!-- Form END -->

            </div>
            <!-- Row form END -->

<?php
        }
    }
?>

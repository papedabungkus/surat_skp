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
            if($_REQUEST['no_agenda'] == "" || $_REQUEST['no_surat'] == "" || $_REQUEST['nama_pemilik'] == ""
                || $_REQUEST['alamat_pemilik'] == "" || $_REQUEST['tgl_ttd'] == ""  || $_REQUEST['tempat_ttd'] == ""){
                $_SESSION['errEmpty'] = 'ERROR! Semua form wajib diisi';
                echo '<script language="javascript">window.history.back();</script>';
            } else {

                $no_agenda = $_REQUEST['no_agenda'];
                $no_surat = $_REQUEST['no_surat'];
                $nama_pemilik = $_REQUEST['nama_pemilik'];
                $alamat_pemilik = $_REQUEST['alamat_pemilik'];
                $nomor_pemilik = $_REQUEST['nomor_pemilik'];
                $tgl_ttd = $_REQUEST['tgl_ttd'];
                $tempat_ttd = $_REQUEST['tempat_ttd'];
                $jabatan_ttd = $_REQUEST['jabatan_ttd'];
                $nama_ttd = $_REQUEST['nama_ttd'];
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
                                $_SESSION['tempat_ttdk'] = 'Form Tempat TTD hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), kurung() dan garis miring(/)';
                                echo '<script language="javascript">window.history.back();</script>';
                            } else {
                                if(!preg_match("/^[a-zA-Z0-9.,() \/ -]*$/", $jabatan_ttd)){
                                    $_SESSION['jabatan_ttdk'] = 'Form Jabatan TTD hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), kurung() dan garis miring(/)';
                                    echo '<script language="javascript">window.history.back();</script>';
                                } else {
                                    if(!preg_match("/^[a-zA-Z0-9.,() \/ -]*$/", $nama_ttd)){
                                        $_SESSION['nama_ttdk'] = 'Form Nama TTD hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), kurung() dan garis miring(/)';
                                        echo '<script language="javascript">window.history.back();</script>';
                                    } else {


                            if(!preg_match("/^[a-zA-Z0-9.,_()%&@\/\r\n -]*$/", $nama_pemilik)){
                                $_SESSION['nama_pemilikk'] = 'Form Isi Ringkas hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), kurung(), underscore(_), dan(&) persen(%) dan at(@)';
                                echo '<script language="javascript">window.history.back();</script>';
                            } else {
                                if(!preg_match("/^[a-zA-Z0-9.,_()%&@\/\r\n -]*$/", $alamat_pemilik)){
                                    $_SESSION['alamat_pemilikk'] = 'Form Isi Ringkas hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), kurung(), underscore(_), dan(&) persen(%) dan at(@)';
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
                                                        VALUES('$no_agenda','$petugas','$no_surat','$peruntukan','SPT','$tgl_ttd',NOW(),'','Surat Perintah Tugas','$id_user')");
                                                    $query_splhp = mysqli_query($config, "INSERT INTO tbl_splhp(no_agenda,no_surat,nama_pemilik,alamat_pemilik,nomor_pemilik,tgl_ttd,tempat_ttd,jabatan_ttd,nama_ttd,id_user)
                                                    VALUES('$no_agenda','$no_surat','$nama_pemilik','$alamat_pemilik','$nomor_pemilik','$tgl_ttd','$tempat_ttd','$jabatan_ttd','$nama_ttd','$id_user')");

                                                    if($query == true  && $query_splhp == true){
                                                        $_SESSION['succAdd'] = 'SUKSES! Data berhasil ditambahkan';
                                                        header("Location: ./admin.php?page=bsplhp");
                                                        die();
                                                    } else {
                                                        $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                                                        echo '<script language="javascript">window.history.back();</script>';
                                                    }
                                                
                                            }
                                        }
                                 } }
                                }} 
                            }}
                        }}
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
                                <li class="waves-effect waves-light"><a href="?page=bsplhp&act=add" class="judul"><i class="material-icons">drafts</i> Tambah Data Surat Perintah Tugas</a></li>
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
                <form class="col s12" method="POST" action="?page=bsplhp&act=add" enctype="multipart/form-data">

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
                            <input id="no_surat" type="text" class="validate" name="no_surat" value="<?php echo '......./TU.040/K.54.E/'.date('m/Y');?>" required>
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

                        
                        <div class="input-field col s3">
                            <i class="material-icons prefix md-prefix">description</i>
                            <textarea id="nama_pemilik" class="materialize-textarea validate" name="nama_pemilik" required></textarea>
                                <?php
                                    if(isset($_SESSION['nama_pemilikk'])){
                                        $nama_pemilikk = $_SESSION['nama_pemilikk'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$nama_pemilikk.'</div>';
                                        unset($_SESSION['nama_pemilikk']);
                                    }
                                ?>
                            <label for="isi">Nama Pemilik</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix md-prefix">description</i>
                            <textarea id="nomor_pemilik" class="materialize-textarea validate" name="nomor_pemilik" required></textarea>
                            
                            <label for="isi">Nomor Telp/HP</label>
                        </div>
                        <div class="input-field col s4">
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
                        <div class="input-field col s2">
                            <i class="material-icons prefix md-prefix">date_range</i>
                            <input id="tgl_surat" type="text" name="tgl_ttd" class="datepicker" required>
                                <?php
                                    if(isset($_SESSION['tgl_ttdk'])){
                                        $tgl_ttdk = $_SESSION['tgl_ttdk'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$tgl_ttdk.'</div>';
                                        unset($_SESSION['tgl_ttdk']);
                                    }
                                ?>
                            <label for="tgl_surat">Tanggal Surat</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">description</i>
                            <textarea id="alamat_pemilik" class="materialize-textarea validate" name="alamat_pemilik" required></textarea>
                                <?php
                                    if(isset($_SESSION['alamatpemilikk'])){
                                        $alamatpemilikk = $_SESSION['alamatpemilikk'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$alamatpemilikk.'</div>';
                                        unset($_SESSION['alamatpemilikk']);
                                    }
                                ?>
                            <label for="isi">Alamat Pemilik</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix md-prefix">input</i>
                            <input id="jabatan_ttd" type="text" class="validate" name="jabatan_ttd" value="Kepala" required>
                                <?php
                                    if(isset($_SESSION['jabatan_ttdk'])){
                                        $jabatan_ttdk = $_SESSION['jabatan_ttdk'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$jabatan_ttdk.'</div>';
                                        unset($_SESSION['jabatan_ttdk']);
                                    }
                                ?>
                            <label for="keterangan">Jabatan TTD</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix md-prefix">perm_identity</i>
                            <input id="pegawai" type="text" class="validate" name="nama_ttd" value="LUKAS SAIBA, SST." required>
                                <?php
                                    if(isset($_SESSION['nama_ttdk'])){
                                        $nama_ttdk = $_SESSION['nama_ttdk'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$nama_ttdk.'</div>';
                                        unset($_SESSION['nama_ttdk']);
                                    }
                                ?>
                            <label for="keterangan">Nama TTD</label>
                        </div>
                    </div>
                    <!-- Row in form END -->

                    <div class="row">
                        <div class="col 6">
                            <button type="submit" name="submit" class="btn-large blue waves-effect waves-light">SIMPAN <i class="material-icons">done</i></button>
                        </div>
                        <div class="col 6">
                            <a href="?page=bsplhp" class="btn-large deep-orange waves-effect waves-light">BATAL <i class="material-icons">clear</i></a>
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

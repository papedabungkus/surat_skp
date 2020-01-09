<?php
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
                            $_SESSION['tempat_ttdk'] = 'Form Tujuan Surat hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), kurung() dan garis miring(/)';
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


                                                //jika form file kosong akan mengeksekusi script dibawah ini
                                                $id_surat = $_REQUEST['id_surat'];
                                         
                                                $query = mysqli_query($config, "UPDATE tbl_splhp SET no_surat='$no_surat',nama_pemilik='$nama_pemilik',alamat_pemilik='$alamat_pemilik',nomor_pemilik='$nomor_pemilik',tgl_ttd='$tgl_ttd',tempat_ttd='$tempat_ttd',jabatan_ttd='$jabatan_ttd',nama_ttd='$nama_ttd',id_user='$id_user' WHERE id_surat='$id_surat'");
                                                $querysuratkeluar = mysqli_query($config, "UPDATE tbl_surat_keluar SET no_surat='$no_surat', tujuan='$nama_pemilik', isi='$alamat_pemilik', tgl_surat='$tgl_ttd' WHERE keterangan='Surat Pengantar Laporan Hasil Pengujian' AND no_agenda='$no_agenda'");
                                                if($query == true && $querysuratkeluar == true){
                                                    $_SESSION['succEdit'] = 'SUKSES! Data berhasil diupdate';
                                                    header("Location: ./admin.php?page=bsplhp");
                                                    die();
                                                } else {
                                                    $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                                                    echo '<script language="javascript">window.history.back();</script>';
                                                }
                                            
                                            }
                                        }
                                    }
                                }}
                            }}
                        }}
                    }
                }
            }
        } else {

            $id_surat = mysqli_real_escape_string($config, $_REQUEST['id_surat']);
            $query = mysqli_query($config, "SELECT no_agenda,no_surat,nama_pemilik,alamat_pemilik,nomor_pemilik,tgl_ttd,tempat_ttd,jabatan_ttd,nama_ttd,id_user FROM tbl_splhp WHERE id_surat='$id_surat'");
            list($no_agenda, $no_surat, $nama_pemilik, $alamat_pemilik, $nomor_pemilik, $tgl_ttd, $tempat_ttd, $jabatan_ttd, $nama_ttd, $id_user) = mysqli_fetch_array($query);
            if($_SESSION['id_user'] != $id_user AND $_SESSION['admin'] >= 3){
                echo '<script language="javascript">
                        window.alert("ERROR! Anda tidak memiliki hak akses untuk mengedit data ini");
                        window.location.href="./admin.php?page=bsplhp";
                      </script>';
            } else {?>

                <!-- Row Start -->
                <div class="row">
                    <!-- Secondary Nav START -->
                    <div class="col s12">
                        <nav class="secondary-nav">
                            <div class="nav-wrapper blue-grey darken-1">
                                <ul class="left">
                                    <li class="waves-effect waves-light"><a href="#" class="judul"><i class="material-icons">edit</i> Edit Data Surat Pengantar Laporan Hasil Pengujian</a></li>
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
                    <form class="col s12" method="POST" action="?page=bsplhp&act=edit" enctype="multipart/form-data">

                        <!-- Row in form START -->
                        <div class="row">
                            <div class="input-field col s2">
                            <input type="hidden" name="id_surat" value="<?php echo $id_surat ;?>">
                                <i class="material-icons prefix md-prefix">looks_one</i>
                                <?php
                                echo '<input id="no_agenda" type="number" class="validate" name="no_agenda" value="'.$no_agenda.'" required readonly>';

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
                                <input id="no_surat" type="text" class="validate" name="no_surat" value="<?php echo $no_surat;?>" required>
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
                                <input type="text" id="nama_pemilik" class="validate" name="nama_pemilik" value="<?php echo $nama_pemilik;?>" required>
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
                                <input type="text" id="nomor_pemilik" class="validate" name="nomor_pemilik" value="<?php echo $nomor_pemilik;?>" required>
                                
                                <label for="isi">Nomor Telp/HP</label>
                            </div>

                            <div class="input-field col s4">
                                <i class="material-icons prefix md-prefix">places</i>
                                <input id="tempat_ttd" type="text" class="validate" name="tempat_ttd" value="<?php echo $tempat_ttd;?>" required>
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
                                <input id="tgl_surat" type="text" name="tgl_ttd" class="datepicker" value="<?php echo $tgl_ttd;?>" required>
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
                            <textarea id="alamat_pemilik" class="materialize-textarea validate" name="alamat_pemilik" required><?php echo $alamat_pemilik;?></textarea>
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
                            <input id="jabatan_ttd" type="text" class="validate" name="jabatan_ttd" value="<?php echo $jabatan_ttd;?>" required>
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
                            <input id="pegawai" type="text" class="validate" name="nama_ttd" value="<?php echo $nama_ttd;?>" required>
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
    }
?>

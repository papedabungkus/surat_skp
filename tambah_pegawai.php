<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {
        if(isset($_REQUEST['submit'])){

            //validasi form kosong
            if($_REQUEST['nama'] == ""){
                $_SESSION['errEmpty'] = 'ERROR! Form Nama Pegawai wajib diisi!';
                header("Location: ./admin.php?page=dp&act=add");
                die();
            } else {

                $nip = $_REQUEST['nip'];
                $nama = $_REQUEST['nama'];
                $idpangkatgol = $_REQUEST['pangkatgol'];
                    $q_pangkatgol = mysqli_query($config, "SELECT * FROM pangkatgol WHERE id='$idpangkatgol'");
                    $pangkatgol = mysqli_fetch_array($q_pangkatgol);
                    $pangkat = $pangkatgol['pangkat'];
                    $golongan = $pangkatgol['golongan']; 
                $tmt = $_REQUEST['tmt'];
                $jabatan = $_REQUEST['jabatan'];

                //validasi input data
                if(!preg_match("/^[a-zA-Z., ]*$/", $jabatan)){
                    $_SESSION['jabatanpegawai'] = 'Form Jabatan hanya boleh mengandung karakter huruf, spasi, titik(.) dan koma(,)';
                    echo '<script language="javascript">window.history.back();</script>';
                } else {

                    if(!preg_match("/^[a-zA-Z., ]*$/", $nama)){
                        $_SESSION['namapegawai'] = 'Form Nama hanya boleh mengandung karakter huruf, spasi, titik(.) dan koma(,)';
                        echo '<script language="javascript">window.history.back();</script>';
                    } else {

                        if(!preg_match("/^[0-9. -]*$/", $nip)){
                            $_SESSION['nippegawai'] = 'Form NIP hanya boleh mengandung karakter angka, spasi dan minus(-)';
                            echo '<script language="javascript">window.history.back();</script>';
                        } else {

                            $query = mysqli_query($config, "INSERT INTO tbl_pegawai(nip,nama,pangkat,golongan,tmt,jabatan) VALUES('$nip','$nama','$pangkat','$golongan','$tmt','$jabatan')");
                            if($query != false){
                                $_SESSION['succAdd'] = 'SUKSES! User baru berhasil ditambahkan';
                                header("Location: ./admin.php?page=dp");
                                die();
                            } else {
                                $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query'.mysqli_error($config);
                                echo '<script language="javascript">window.history.back();</script>';
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
                                <li class="waves-effect waves-light"><a href="?page=dp&act=add" class="judul"><i class="material-icons">person_add</i> Tambah Pegawai</a></li>
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
                <form class="col s12" method="post" action="?page=dp&act=add">

                    <!-- Row in form START -->
                    <div class="row">

                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">looks_one</i>
                            <input id="nip" type="text" class="validate" name="nip">
                                <?php
                                    if(isset($_SESSION['nipuser'])){
                                        $nipuser = $_SESSION['nipuser'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$nipuser.'</div>';
                                        unset($_SESSION['nipuser']);
                                    }
                                ?>
                            <label for="nip">NIP</label>
                        </div>

                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">text_fields</i>
                            <input id="nama" type="text" class="validate" name="nama" required>
                                <?php
                                    if(isset($_SESSION['namauser'])){
                                        $namauser = $_SESSION['namauser'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$namauser.'</div>';
                                        unset($_SESSION['namauser']);
                                    }
                                ?>
                            <label for="nama">Nama</label>
                        </div>
                        
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">supervisor_account</i><label>Pangkat/Golongan</label><br/>
                            <div class="input-field col s11 right">
                                <?php $queryx = mysqli_query($config, "SELECT * FROM pangkatgol");?>
                                <select class="browser-default" name="pangkatgol" id="pangkatgol" required>
                                    <?php while($rowx = mysqli_fetch_array($queryx)){ ?>
                                        <option value="<?php echo $rowx['id'] ;?>"><?php echo $rowx['golongan'].' '.$rowx['pangkat'] ;?></option>
                                    <?php } ?>
                               </select>
                            </div>
                        </div>

                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">date_range</i>
                            <input id="tmt" type="text" class="validate datepicker" name="tmt">
                            <label for="tmt">TMT</label>
                        </div>

                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">featured_play_list</i>
                            <input id="jabatan" type="text" class="validate" name="jabatan">
                            <label for="jabatan">Jabatan</label>
                        </div>
                    </div>
                    <br/>
                    <!-- Row in form END -->
                    <div class="row">
                        <div class="col 6">
                            <button type="submit" name="submit" class="btn-large blue waves-effect waves-light">SIMPAN <i class="material-icons">done</i></button>
                        </div>
                        <div class="col 6">
                            <a href="?page=dp" class="btn-large deep-orange waves-effect waves-light">BATAL <i class="material-icons">clear</i></a>
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

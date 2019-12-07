<?php
 //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {
        if(isset($_REQUEST['submit'])){
            $id_pegawai = $_REQUEST['id_pegawai'];
            $nip = $_REQUEST['nip'];
            $nama = $_REQUEST['nama'];
            
            $idpangkatgol = $_REQUEST['pangkatgol'];
                $q_pangkatgol = mysqli_query($config, "SELECT * FROM pangkatgol WHERE id='$idpangkatgol'");
                $pangkatgol = mysqli_fetch_array($q_pangkatgol);
                $pangkat = $pangkatgol['pangkat'];
                $golongan = $pangkatgol['golongan']; 
            $tmt = $_REQUEST['tmt'];
            $jabatan = $_REQUEST['jabatan'];
                    $query = mysqli_query($config, "UPDATE tbl_pegawai SET nip='$nip', nama='$nama', pangkat='$pangkat', golongan='$golongan', tmt='$tmt', jabatan='$jabatan' WHERE id='$id_pegawai'");
                    if($query == true){
                        $_SESSION['succEdit'] = 'SUKSES! Data Pegawai berhasil diupdate';
                        header("Location: ./admin.php?page=dp");
                        die();
                    } else {
                        $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                        echo '<script language="javascript">
                            window.location.href="./admin.php?page=dp&act=edit&id='.$id_pegawai.'";
                            </script>';
                    }
        } else {
            $id_pegawai = mysqli_real_escape_string($config, $_REQUEST['id_pegawai']);
            $query = mysqli_query($config, "SELECT * FROM tbl_pegawai WHERE id='$id_pegawai'");
            if(mysqli_num_rows($query) > 0){
                $no = 1;
                while($row = mysqli_fetch_array($query)){?>

                        <!-- Row Start -->
                        <div class="row">
                            <!-- Secondary Nav START -->
                            <div class="col s12">
                                <nav class="secondary-nav">
                                    <div class="nav-wrapper blue-grey darken-1">
                                        <ul class="left">
                                            <li class="waves-effect waves-light  tooltipped" data-position="right" data-tooltip="Menu ini hanya untuk mengedit tipe user. Username dan password bisa diganti lewat menu profil"><a href="#" class="judul"><i class="material-icons">mode_edit</i> Edit Pegawai</a></li>
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
                        ?>

                        <!-- Row form Start -->
                        <div class="row jarak-form">

                            <!-- Form START -->
                            <form class="col s12" method="post" action="?page=dp&act=edit">

                                <!-- Row in form START -->
                                <div class="row">
                                <input type="hidden" value="<?php echo $row['id'] ;?>" name="id_pegawai">
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix md-prefix">account_circle</i>
                                        <input name="nip" id="nip" type="text" value="<?php echo $row['nip'] ;?>" class="grey-text">
                                        <label for="nip">NIP</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix md-prefix">text_fields</i>
                                        <input name="nama" id="username" type="text" value="<?php echo $row['nama'] ;?>" class="grey-text">
                                        <label for="username">Nama</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix md-prefix">supervisor_account</i><label>Pangkat/Golongan</label><br/>
                                        <div class="input-field col s11 right">
                                        <?php $queryx = mysqli_query($config, "SELECT * FROM pangkatgol");?>
                                            <select class="browser-default" name="pangkatgol" id="pangkatgol" required>
                                            <?php while($rowx = mysqli_fetch_array($queryx)){ 
                                                if ($rowx['golongan']==$row['golongan']){
                                                    $selected = "selected";
                                                } else {
                                                    $selected = "";
                                                }
                                                ?>
                                                <option value="<?php echo $rowx['id'] ;?>" <?php echo $selected; ?>><?php echo $rowx['golongan'].' '.$rowx['pangkat'] ;?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix md-prefix">date_range</i>
                                        <input name="tmt" id="tmt" type="text" value="<?php echo $row['tmt'] ;?>" class="grey-text datepicker">
                                        <label for="tmt">TMT</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix md-prefix">featured_play_list</i>
                                        <input name="jabatan" id="jabatan" type="text" value="<?php echo $row['jabatan'] ;?>" class="grey-text">
                                        <label for="jabatan">Jabatan</label>
                                    </div>
                                </div>
                                <!-- Row in form END -->
                                <br/>
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
        }       
    }
?>

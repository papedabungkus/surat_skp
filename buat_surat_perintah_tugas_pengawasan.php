<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {

        if(isset($_REQUEST['act'])){
            $act = $_REQUEST['act'];
            switch ($act) {
                case 'add':
                    include "tambah_surat_perintah_tugas_pengawasan.php";
                    break;
                case 'edit':
                    include "edit_surat_perintah_tugas_pengawasan.php";
                    break;
                case 'del':
                    include "hapus_surat_perintah_tugas_pengawasan.php";
                    break;
            }
        } else {

            $query = mysqli_query($config, "SELECT surat_perintah_tugas_pengawasan FROM tbl_sett");
            list($surat_perintah_tugas_pengawasan) = mysqli_fetch_array($query);

            //pagging
            $limit = $surat_perintah_tugas_pengawasan;
            $pg = @$_GET['pg'];
                if(empty($pg)){
                    $curr = 0;
                    $pg = 1;
                } else {
                    $curr = ($pg - 1) * $limit;
                }?>

                <!-- Row Start -->
                <div class="row">
                    <!-- Secondary Nav START -->
                    <div class="col s12">
                        <div class="z-depth-1">
                            <nav class="secondary-nav">
                                <div class="nav-wrapper blue-grey darken-1">
                                    <div class="col m7">
                                        <ul class="left">
                                            <li class="waves-effect waves-light hide-on-small-only"><a href="?page=bsptp" class="judul"><i class="material-icons">drafts</i> Surat Perintah Tugas (Pengawasan)</a></li>
                                            <li class="waves-effect waves-light">
                                                <a href="?page=bsptp&act=add"><i class="material-icons md-24">add_circle</i> Tambah Data</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col m5 hide-on-med-and-down">
                                        <form method="post" action="?page=bsptp">
                                            <div class="input-field round-in-box">
                                                <input id="search" type="search" name="cari" placeholder="Ketik dan tekan enter mencari data..." required>
                                                <label for="search"><i class="material-icons md-dark">search</i></label>
                                                <input type="submit" name="submit" class="hidden">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                    <!-- Secondary Nav END -->
                </div>
                <!-- Row END -->

                <?php
                    if(isset($_SESSION['succAdd'])){
                        $succAdd = $_SESSION['succAdd'];
                        echo '<div id="alert-message" class="row">
                                <div class="col m12">
                                    <div class="card green lighten-5">
                                        <div class="card-content notif">
                                            <span class="card-title green-text"><i class="material-icons md-36">done</i> '.$succAdd.'</span>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                        unset($_SESSION['succAdd']);
                    }
                    if(isset($_SESSION['succEdit'])){
                        $succEdit = $_SESSION['succEdit'];
                        echo '<div id="alert-message" class="row">
                                <div class="col m12">
                                    <div class="card green lighten-5">
                                        <div class="card-content notif">
                                            <span class="card-title green-text"><i class="material-icons md-36">done</i> '.$succEdit.'</span>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                        unset($_SESSION['succEdit']);
                    }
                    if(isset($_SESSION['succDel'])){
                        $succDel = $_SESSION['succDel'];
                        echo '<div id="alert-message" class="row">
                                <div class="col m12">
                                    <div class="card green lighten-5">
                                        <div class="card-content notif">
                                            <span class="card-title green-text"><i class="material-icons md-36">done</i> '.$succDel.'</span>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                        unset($_SESSION['succDel']);
                    }
                ?>

                <!-- Row form Start -->
                <div class="row jarak-form">

                <?php
                    if(isset($_REQUEST['submit'])){
                    $cari = mysqli_real_escape_string($config, $_REQUEST['cari']);
                        echo '
                        <div class="col s12" style="margin-top: -18px;">
                            <div class="card blue lighten-5">
                                <div class="card-content">
                                <p class="description">Hasil pencarian untuk kata kunci <strong>"'.stripslashes($cari).'"</strong><span class="right"><a href="?page=bsptp"><i class="material-icons md-36" style="color: #333;">clear</i></a></span></p>
                                </div>
                            </div>
                        </div>

                        <div class="col m12" id="colres">
                            <table class="bordered" id="tbl">
                                <thead class="blue lighten-4" id="head">
                                    <tr>
                                        <th width="7%">No. Agenda</th>
                                        <th width="22%">No. Surat</th>
                                        <th width="27%">Isi Ringkas</th>
                                        <th width="24%">Yang Ditugaskan</th>
                                        <th width="19%">Tempat / Tgl Dikeluarkan</th>
                                        <th width="16%">Tindakan <span class="right tooltipped" data-position="left" data-tooltip="Atur jumlah data yang ditampilkan"><a class="modal-trigger" href="#modal"><i class="material-icons" style="color: #333;">settings</i></a></span></th>
                                    </tr>
                                </thead>
                                <tbody>';

                                //script untuk mencari data
                                $query = mysqli_query($config, "SELECT * FROM tbl_surat_perintah_tugas_pengawasan WHERE peruntukan LIKE '%$cari%' OR no_surat LIKE '%$cari%' ORDER by id_surat DESC LIMIT $curr, 15");
                                if(mysqli_num_rows($query) > 0){
                                    $no = 1;
                                    
                                    while($row = mysqli_fetch_array($query)){
                                        $idpeg = unserialize($row['penerima_tugas']);                                   
                                
                                      echo '
                                      <tr>
                                        <td>'.$row['no_agenda'].'</td>
                                        <td>'.$row['no_surat'].'</td>
                                        <td>'.substr($row['peruntukan'],0,200).'</td>
                                        <td><ol type="1">';
                                        for($i=0;$i<count($idpeg);$i++)
                                        {
                                            $querypeg = mysqli_query($config, "SELECT * FROM tbl_pegawai WHERE id='$idpeg[$i]'");
                                            $rowpeg = mysqli_fetch_array($querypeg);
                                            echo '<li>'.$rowpeg['nama'].'</li>';
                                        }
                                      echo '</ol></td>
                                        <td>'.$row['tempat_ttd'].'<br/><hr/>'.indoDate($row['tgl_ttd']).'</td>
                                        <td>';
                                        if($_SESSION['admin'] <= 2){
                                            echo '<a class="btn small blue darken-3 waves-effect waves-light" href="?page=bsptp&act=edit&id_surat='.$row['id_surat'].'">
                                                        <i class="material-icons">edit</i> EDIT</a>';
                                            }
                                            echo '<a class="btn small yellow darken-3 waves-effect waves-light" href="cetak_surat_perintah_tugas_pengawasan.php?id_surat='.$row['id_surat'].'" target="_blank">
                                                        <i class="material-icons">print</i> PRINT</a>';
                                            if($_SESSION['admin'] == 1){            
                                            echo '<a class="btn small deep-orange waves-effect waves-light" href="?page=bsptp&act=del&id_surat='.$row['id_surat'].'">
                                                        <i class="material-icons">delete</i> DEL</a>';
                                            }
                                        echo '</td></tr>';
                                    }
                                } else {
                                    echo '<tr><td colspan="5"><center><p class="add">Tidak ada data yang ditemukan</p></center></td></tr>';
                                }
                              echo '</tbody></table><br/><br/>
                            </div>
                        </div>
                        <!-- Row form END -->';

                    } else {

                        echo '
                        <div class="col m12" id="colres">
                        <table class="bordered" id="tbl">
                            <thead class="blue lighten-4" id="head">
                                <tr>
                                    <th width="7%">No. Agenda</th>
                                    <th width="22%">No. Surat</th>
                                    <th width="27%">Isi Ringkas</th>
                                    <th width="24%">Yang Ditugaskan</th>
                                    <th width="19%">Tempat / Tgl Dikeluarkan</th>
                                    <th width="20%">Tindakan <span class="right tooltipped" data-position="left" data-tooltip="Atur jumlah data yang ditampilkan"><a class="modal-trigger" href="#modal"><i class="material-icons" style="color: #333;">settings</i></a></span></th>

                                        <div id="modal" class="modal">
                                            <div class="modal-content white">
                                                <h5>Jumlah data yang ditampilkan per halaman</h5>';
                                                $query = mysqli_query($config, "SELECT id_sett,surat_perintah_tugas_pengawasan FROM tbl_sett");
                                                list($id_sett,$surat_perintah_tugas_pengawasan) = mysqli_fetch_array($query);
                                                echo '
                                                <div class="row">
                                                    <form method="post" action="">
                                                        <div class="input-field col s12">
                                                            <input type="hidden" value="'.$id_sett.'" name="id_sett">
                                                            <div class="input-field col s1" style="float: left;">
                                                                <i class="material-icons prefix md-prefix">looks_one</i>
                                                            </div>
                                                            <div class="input-field col s11 right" style="margin: -5px 0 20px;">
                                                                <select class="browser-default validate" name="surat_perintah_tugas_pengawasan" required>
                                                                    <option value="'.$surat_perintah_tugas_pengawasan.'">'.$surat_perintah_tugas_pengawasan.'</option>
                                                                    <option value="5">5</option>
                                                                    <option value="10">10</option>
                                                                    <option value="20">20</option>
                                                                    <option value="50">50</option>
                                                                    <option value="100">100</option>
                                                                </select>
                                                            </div>
                                                            <div class="modal-footer white">
                                                                <button type="submit" class="modal-action waves-effect waves-green btn-flat" name="simpan">Simpan</button>';
                                                                if(isset($_REQUEST['simpan'])){
                                                                    $id_sett = "1";
                                                                    $surat_perintah_tugas_pengawasan = $_REQUEST['surat_perintah_tugas_pengawasan'];
                                                                    $id_user = $_SESSION['id_user'];

                                                                    $query = mysqli_query($config, "UPDATE tbl_sett SET surat_perintah_tugas_pengawasan='$surat_perintah_tugas_pengawasan',id_user='$id_user' WHERE id_sett='$id_sett'");
                                                                    if($query == true){
                                                                        header("Location: ./admin.php?page=bsptp");
                                                                        die();
                                                                    }
                                                                } echo '
                                                                <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Batal</a>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                </tr>
                            </thead>

                            <tbody>';

                            //script untuk mencari data
                            $query = mysqli_query($config, "SELECT * FROM tbl_surat_perintah_tugas_pengawasan ORDER by id_surat DESC LIMIT $curr, $limit");
                            if(mysqli_num_rows($query) > 0){
                                $no = 1;
                                while($row = mysqli_fetch_array($query)){
                                    $idpeg = unserialize($row['penerima_tugas']);                                   
                            
                                  echo '
                                  <tr>
                                    <td>'.$row['no_agenda'].'</td>
                                    <td>'.$row['no_surat'].'</td>
                                    <td>'.substr($row['peruntukan'],0,200).'</td>
                                    <td><ol type="1">';
                                    for($i=0;$i<count($idpeg);$i++)
                                    {
                                        $querypeg = mysqli_query($config, "SELECT * FROM tbl_pegawai WHERE id='$idpeg[$i]'");
                                        $rowpeg = mysqli_fetch_array($querypeg);
                                        echo '<li>'.$rowpeg['nama'].'</li>';
                                    }
                                  echo '</ol></td>
                                    <td>'.$row['tempat_ttd'].'<br/><hr/>'.indoDate($row['tgl_ttd']).'</td>
                                    <td>';
                                    if($_SESSION['admin'] <= 2){
                                    echo '<a class="btn small blue darken-3 waves-effect waves-light" href="?page=bsptp&act=edit&id_surat='.$row['id_surat'].'">
                                                <i class="material-icons">edit</i> EDIT</a>';
                                    }
                                    echo '<a class="btn small yellow darken-3 waves-effect waves-light" href="cetak_surat_perintah_tugas_pengawasan.php?id_surat='.$row['id_surat'].'" target="_blank">
                                                <i class="material-icons">print</i> PRINT</a>';
                                    if($_SESSION['admin'] == 1){            
                                    echo '<a class="btn small deep-orange waves-effect waves-light" href="?page=bsptp&act=del&id_surat='.$row['id_surat'].'">
                                                <i class="material-icons">delete</i> DEL</a>';
                                    }
                                    echo '</td></tr>';
                                }
                            } else {
                                echo '<tr><td colspan="5"><center><p class="add">Tidak ada data untuk ditampilkan. <u><a href="?page=bsptp&act=add">Tambah data baru</a></u> </p></center></td></tr>';
                            }
                            echo '</tbody></table>
                        </div>
                    </div>
                    <!-- Row form END -->';

                    $query = mysqli_query($config, "SELECT * FROM tbl_surat_perintah_tugas_pengawasan");
                    $cdata = mysqli_num_rows($query);
                    $cpg = ceil($cdata/$limit);

                    echo '<br/><!-- Pagination START -->
                          <ul class="pagination">';

                    if($cdata > $limit ){

                        //first and previous pagging
                        if($pg > 1){
                            $prev = $pg - 1;
                            echo '<li><a href="?page=bsptp&pg=1"><i class="material-icons md-48">first_page</i></a></li>
                                  <li><a href="?page=bsptp&pg='.$prev.'"><i class="material-icons md-48">chevron_left</i></a></li>';
                        } else {
                            echo '<li class="disabled"><a href="#"><i class="material-icons md-48">first_page</i></a></li>
                                  <li class="disabled"><a href="#"><i class="material-icons md-48">chevron_left</i></a></li>';
                        }

                        //perulangan pagging
                        for ($i = 1; $i <= $cpg; $i++) {
                            if ((($i >= $pg - 3) && ($i <= $pg + 3)) || ($i == 1) || ($i == $cpg)) {
                                if ($i == $pg) echo '<li class="active waves-effect waves-dark"><a href="?page=bsptp&pg='.$i.'"> '.$i.' </a></li>';
                                else echo '<li class="waves-effect waves-dark"><a href="?page=bsptp&pg='.$i.'"> '.$i.' </a></li>';
                            }
                        }

                        //last and next pagging
                        if($pg < $cpg){
                            $next = $pg + 1;
                            echo '<li><a href="?page=bsptp&pg='.$next.'"><i class="material-icons md-48">chevron_right</i></a></li>
                                  <li><a href="?page=bsptp&pg='.$cpg.'"><i class="material-icons md-48">last_page</i></a></li>';
                        } else {
                            echo '<li class="disabled"><a href="#"><i class="material-icons md-48">chevron_right</i></a></li>
                                  <li class="disabled"><a href="#"><i class="material-icons md-48">last_page</i></a></li>';
                        }
                        echo '
                        </ul>
                        <!-- Pagination END -->';
                } else {
                    echo '';
                }
            }
        }
    
}
?>

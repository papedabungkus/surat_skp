<?php
    //session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {

        if(isset($_REQUEST['act'])){
            $act = $_REQUEST['act'];
            switch ($act) {
                case 'add':
                    include "tambah_pegawai.php";
                    break;
                case 'edit':
                    include "edit_pegawai.php";
                    break;
                case 'del':
                    include "hapus_pegawai.php";
                    break;
                case 'imp':
                    include "upload_pegawai.php";
                    break;
            }
        } else {

            //pagging
            $limit = 5;
            $pg = @$_GET['pg'];
                if(empty($pg)){
                    $curr = 0;
                    $pg = 1;
                } else {
                    $curr = ($pg - 1) * $limit;
                }

                
                echo '<!-- Row Start -->
                    <div class="row">
                        <!-- Secondary Nav START -->
                        <div class="col s12">
                            <div class="z-depth-1">
                                <nav class="secondary-nav">
                                    <div class="nav-wrapper blue-grey darken-1">
                                        <div class="col m7">
                                            <ul class="left">
                                                <li class="waves-effect waves-light hide-on-small-only"><a href="?page=dp" class="judul"><i class="material-icons">people</i> Manajemen Pegawai</a></li>
                                                <li class="waves-effect waves-light">
                                                    <a href="?page=dp&act=add"><i class="material-icons md-24">person_add</i> Tambah Pegawai</a>
                                                </li>
                                                
                                            </ul>
                                        </div>
                                        <div class="col m5 hide-on-med-and-down">
                                            <form method="post" action="?page=dp">
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
                    <!-- Row END -->';

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

                echo '
                    <!-- Row form Start -->
                    <div class="row jarak-form">';
                    //pencarian
                    if(isset($_REQUEST['submit'])){
                        $cari = mysqli_real_escape_string($config, $_REQUEST['cari']);
                echo '
                <div class="col s12" style="margin-top: -18px;">
                    <div class="card blue lighten-5">
                        <div class="card-content">
                            <p class="description">Hasil pencarian untuk kata kunci <strong>"'.stripslashes($cari).'"</strong><span class="right"><a href="?page=tsm"><i class="material-icons md-36" style="color: #333;">clear</i></a></span></p>
                        </div>
                    </div>
                </div>

                <div class="col m12" id="colres">
                <!-- Table START -->
                <table class="bordered" id="tbl">
                    <thead class="blue lighten-4" id="head">
                        <tr>
                            <th width="8%">No</th>
                            <th width="30%">Nama / NIP</th>
                            <th width="22%">Pangkat / Golongan</th>
                            <th width="23%">Jabatan</th>
                            <th width="16%">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>';
                    $query = mysqli_query($config, "SELECT * FROM tbl_pegawai WHERE nip LIKE '%$cari%' OR nama LIKE '%$cari%' OR pangkat LIKE '%$cari%' OR golongan LIKE '%$cari%' OR jabatan LIKE '%$cari%'");
                    if(mysqli_num_rows($query) > 0){
                        $no = 1;
                        while($row = mysqli_fetch_array($query)){
                        echo '
                        <tr>
                        <td>'.$no++.'</td>
                        <td>'.$row['nama'].'<br />'.$row['nip'].'</td>
                        <td>'.$row['pangkat'].'<br/>'.$row['golongan'].'</td>
                        <td>'.$row['jabatan'].'</td>
                        <td> <a class="btn small blue waves-effect waves-light" href="?page=dp&act=edit&id_pegawai='.$row['id'].'">
                                     <i class="material-icons">edit</i> EDIT</a>
                                     <a class="btn small deep-orange waves-effect waves-light" href="?page=dp&act=del&id_pegawai='.$row['id'].'"><i class="material-icons">delete</i> DEL</a>';
                       '</td>
                        </tr>';
                        }
                    } else {
            echo '<tr><td colspan="5"><center><p class="add">Tidak ada data untuk ditampilkan</p></center></td></tr>';
                    }
          echo '</tbody></table>
                <!-- Table END -->
            </div>';

                    } else {
                        //menampilkan
                echo '
                        <div class="col m12" id="colres">
                            <!-- Table START -->
                            <table class="bordered" id="tbl">
                                <thead class="blue lighten-4" id="head">
                                    <tr>
                                        <th width="8%">No</th>
                                        <th width="30%">Nama / NIP</th>
                                        <th width="22%">Pangkat / Golongan</th>
                                        <th width="23%">Jabatan</th>
                                        <th width="16%">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>';
                                $query = mysqli_query($config, "SELECT * FROM tbl_pegawai LIMIT $curr, $limit");
                                if(mysqli_num_rows($query) > 0){
                                    $no = 1;
                                    while($row = mysqli_fetch_array($query)){
                                    echo '
                                    <tr>
                                    <td>'.$no++.'</td>
                                    <td>'.$row['nama'].'<br />'.$row['nip'].'</td>
                                    <td>'.$row['pangkat'].'<br/>'.$row['golongan'].'</td>
                                    <td>'.$row['jabatan'].'</td>
                                    <td> <a class="btn small blue waves-effect waves-light" href="?page=dp&act=edit&id_pegawai='.$row['id'].'">
                                                 <i class="material-icons">edit</i> EDIT</a>
                                                 <a class="btn small deep-orange waves-effect waves-light" href="?page=dp&act=del&id_pegawai='.$row['id'].'"><i class="material-icons">delete</i> DEL</a>';
                                   '</td>
                                    </tr>';
                                    }
                                } else {
                        echo '<tr><td colspan="5"><center><p class="add">Tidak ada data untuk ditampilkan</p></center></td></tr>';
                                }
                      echo '</tbody></table>
                            <!-- Table END -->
                        </div>';
                    
                    echo'
                    </div>
                    <!-- Row form END -->';

                    $query = mysqli_query($config, "SELECT * FROM tbl_pegawai");
                    $cdata = mysqli_num_rows($query);
                    $cpg = ceil($cdata/$limit);

                    echo '<!-- Pagination START -->
                          <ul class="pagination">';

                    if($cdata > $limit){

                        if($pg > 1){
                            $prev = $pg - 1;
                            echo '<li><a href="?page=dp&pg=1"><i class="material-icons md-48">first_page</i></a></li>
                                  <li><a href="?page=dp&pg='.$prev.'"><i class="material-icons md-48">chevron_left</i></a></li>';
                        } else {
                            echo '<li class="disabled"><a href="#"><i class="material-icons md-48">first_page</i></a></li>
                                  <li class="disabled"><a href="#"><i class="material-icons md-48">chevron_left</i></a></li>';
                        }

                        //perulangan pagging
                        for($i=1; $i <= $cpg; $i++)
                            if($i != $pg){
                                echo '<li class="waves-effect waves-dark"><a href="?page=dp&pg='.$i.'"> '.$i.' </a></li>';
                            } else {
                                echo '<li class="active waves-effect waves-dark"><a href="?page=dp&pg='.$i.'"> '.$i.' </a></li>';
                            }

                        //last and next pagging
                        if($pg < $cpg){
                            $next = $pg + 1;
                            echo '<li><a href="?page=dp&pg='.$next.'"><i class="material-icons md-48">chevron_right</i></a></li>
                                  <li><a href="?page=dp&pg='.$cpg.'"><i class="material-icons md-48">last_page</i></a></li>';
                        } else {
                            echo '<li class="disabled"><a href="#"><i class="material-icons md-48">chevron_right</i></a></li>
                                  <li class="disabled"><a href="#"><i class="material-icons md-48">last_page</i></a></li>';
                        }
                            echo ' </ul>
                                   <!-- Pagination END -->';
                    } else {
                        echo '';
                    } }
                }
            }
?>

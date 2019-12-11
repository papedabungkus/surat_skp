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

        if(isset($_SESSION['errQ'])){
            $errQ = $_SESSION['errQ'];
            echo '<div id="alert-message" class="row jarak-card">
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

    	$id_surat = mysqli_real_escape_string($config, $_REQUEST['id_surat']);
    	$query = mysqli_query($config, "SELECT * FROM tbl_surat_tugas WHERE id_surat='$id_surat'");

    	if(mysqli_num_rows($query) > 0){
            $no = 1;
            while($row = mysqli_fetch_array($query)){
            $idpeg = unserialize($row['penerima_tugas']);

            if($_SESSION['id_user'] != $row['id_user'] AND $_SESSION['id_user'] != 1){
                echo '<script language="javascript">
                        window.alert("ERROR! Anda tidak memiliki hak akses untuk menghapus data ini");
                        window.location.href="./admin.php?page=bst";
                      </script>';
            } else {

    		  echo '<!-- Row form Start -->
				<div class="row jarak-card">
				    <div class="col m12">
                        <div class="card">
                            <div class="card-content">
        				        <table>
        				            <thead class="red lighten-5 red-text">
        				                <div class="confir red-text"><i class="material-icons md-36">error_outline</i>
        				                Apakah Anda yakin akan menghapus data ini?</div>
        				            </thead>

        				            <tbody>
        				                <tr>
        				                    <td width="13%">No. Agenda</td>
        				                    <td width="1%">:</td>
        				                    <td width="86%">'.$row['no_agenda'].'</td>
        				                </tr>
        				                <tr>
        				                    <td width="13%">No. Surat</td>
        				                    <td width="1%">:</td>
        				                    <td width="86%">'.$row['no_surat'].'</td>
        				                </tr>
        				                <tr>
        				                    <td width="13%">Menimbang</td>
        				                    <td width="1%">:</td>
        				                    <td width="86%">'.$row['pertimbangan'].'</td>
        				                </tr>
        				                <tr>
        				                    <td width="13%">Dasar</td>
        				                    <td width="1%">:</td>
        				                    <td width="86%">'.$row['dasar'].'</td>
        				                </tr>
        				                <tr>
                                            <td width="13%" style="vertical-align:text-top">Penerima Tugas</td>
                                            <td width="1%" style="vertical-align:text-top">:</td>
                                            <td width="86%" style="vertical-align:text-top"><ol type="1">';
                                            for($i=0;$i<count($idpeg);$i++)
                                            {
                                                $querypeg = mysqli_query($config, "SELECT * FROM tbl_pegawai WHERE id='$idpeg[$i]'");
                                                $rowpeg = mysqli_fetch_array($querypeg);
                                                echo '<li>'.$rowpeg['nama'].'</li>';
                                            }
                                        echo'</ol></td>
        				                <tr>
        				                    <td width="13%">Untuk</td>
        				                    <td width="1%">:</td>
        				                    <td width="86%">'.$row['peruntukan'].'</td>
        				                </tr>
        				                <tr>
        				                    <td width="13%">Dikeluarkan Tanggal</td>
        				                    <td width="1%">:</td>
        				                    <td width="86%">'.indoDate($row['tgl_ttd']).'</td>
        				                </tr>
        				            </tbody>
    				   		    </table>
				            </div>
                            <div class="card-action">
        		                <a href="?page=bst&act=del&submit=yes&id_surat='.$row['id_surat'].'" class="btn-large deep-orange waves-effect waves-light white-text">HAPUS <i class="material-icons">delete</i></a>
        		                <a href="?page=bst" class="btn-large blue waves-effect waves-light white-text">BATAL <i class="material-icons">clear</i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row form END -->';

            	if(isset($_REQUEST['submit'])){
            		$id_surat = $_REQUEST['id_surat'];

                    //jika ada file akan mengekseskusi script dibawah ini
                    if(!empty($row['file'])){

                        unlink("upload/surat_keluar/".$row['file']);
                        $query = mysqli_query($config, "DELETE FROM tbl_surat_tugas WHERE id_surat='$id_surat'");
                        $no_agenda = $row['no_agenda'];
                        $querysuratkeluar = mysqli_query($config, "DELETE FROM tbl_surat_keluar WHERE no_agenda='$no_agenda'");

                		if($query == true && $querysuratkeluar == true){
                            $_SESSION['succDel'] = 'SUKSES! Data berhasil dihapus<br/>';
                            header("Location: ./admin.php?page=bst");
                            die();
                		} else {
                            $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                            echo '<script language="javascript">
                                    window.location.href="./admin.php?page=bst&act=del&id_surat='.$id_surat.'";
                                  </script>';
                		}
                	} else {

                        //jika tidak ada file akan mengekseskusi script dibawah ini
                        $query = mysqli_query($config, "DELETE FROM tbl_surat_tugas WHERE id_surat='$id_surat'");
                        $no_agenda = $row['no_agenda'];
                        $querysuratkeluar = mysqli_query($config, "DELETE FROM tbl_surat_keluar WHERE no_agenda='$no_agenda'");

                        if($query == true && $querysuratkeluar == true){
                            $_SESSION['succDel'] = 'SUKSES! Data berhasil dihapus<br/>';
                            header("Location: ./admin.php?page=bst");
                            die();
                        } else {
                            $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                            echo '<script language="javascript">
                                    window.location.href="./admin.php?page=bst&act=del&id_surat='.$id_surat.'";
                                  </script>';
                        }
                    }
                }
		    }
	    }
    }
}
?>

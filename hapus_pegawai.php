<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {

        $id_pegawai = mysqli_real_escape_string($config, $_REQUEST['id_pegawai']);
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

                $query = mysqli_query($config, "SELECT * FROM tbl_pegawai WHERE id='$id_pegawai'");

            	if(mysqli_num_rows($query) > 0){
                    $no = 1;
                    while($row = mysqli_fetch_array($query)){

        		 echo '
                    <!-- Row form Start -->
    				<div class="row jarak-card">
    				    <div class="col m12">
                            <div class="card">
                                <div class="card-content">
            				        <table>
            				            <thead class="red lighten-5 red-text">
            				                <div class="confir red-text"><i class="material-icons md-36">error_outline</i>
            				                Apakah Anda yakin akan menghapus pegawai ini?</div>
            				            </thead>

            				            <tbody>
            				                <tr>
            				                    <td width="13%">NIP</td>
            				                    <td width="1%">:</td>
            				                    <td width="86%">'.$row['nip'].'</td>
            				                </tr>
            				                <tr>
            				                    <td width="13%">Nama</td>
            				                    <td width="1%">:</td>
            				                    <td width="86%">'.$row['nama'].'</td>
            				                </tr>
            				                <tr>
            				                    <td width="13%">Pangkat/Golongan</td>
            				                    <td width="1%">:</td>
            				                    <td width="86%">'.$row['pangkat'].' - '.$row['golongan'].'</td>
            				                </tr>
            				                <tr>
            				                    <td width="13%">TMT</td>
            				                    <td width="1%">:</td>
            				                    <td width="86%">'.$row['tmt'].'</td>
            				                </tr>
            				                <tr>
            				                    <td width="13%">Jabatan</td>
            				                    <td width="1%">:</td>
            				                    <td width="86%">'.$row['jabatan'].'</td>
            				                </tr>
            				            </tbody>
            				   		</table>
    				            </div>
                                <div class="card-action">
            		                <a href="?page=dp&act=del&submit=yes&id_pegawai='.$row['id'].'" class="btn-large deep-orange waves-effect waves-light white-text">HAPUS <i class="material-icons">delete</i></a>
            		                <a href="?page=dp" class="btn-large blue waves-effect waves-light white-text">BATAL <i class="material-icons">clear</i></a>
            		            </div>
                            </div>
                        </div>
                    </div>
        			<!-- Row form END -->';

                	if(isset($_REQUEST['submit'])){
                		$id_pegawai = $_REQUEST['id_pegawai'];

                        $query = mysqli_query($config, "DELETE FROM tbl_pegawai WHERE id='$id_pegawai'");

                		if($query == true){
                            $_SESSION['succDel'] = 'SUKSES! User berhasil dihapus<br/>';
                            header("Location: ./admin.php?page=dp");
                            die();
                		} else {
                            $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                            echo '<script language="javascript">
                                    window.location.href="./admin.php?page=dp&act=del&id_pegawai='.$id_pegawai.'";
                                  </script>';
                		}
                	}
    		        
    	        }
            }
        }
    
?>

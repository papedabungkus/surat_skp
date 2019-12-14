<?php
require_once 'include/config.php';
require_once 'include/functions.php';
$config = conn($host, $username, $password, $database);

$id_surat = mysqli_real_escape_string($config, $_GET['id_surat']);
$query = mysqli_query($config, "SELECT * FROM tbl_surat_tugas WHERE id_surat='$id_surat'");
if(mysqli_num_rows($query) > 0){
    $no = 0;
    while($row = mysqli_fetch_array($query)){
?>
<html>
<head><title>Surat Tugas - <?=$row['no_surat']?></title></head>
<style type="text/css">
/* Kode CSS Untuk PAGE ini dibuat oleh http://jsfiddle.net/2wk6Q/1/ */
    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font: 12pt "Arial";
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
    .page {
        width: 210mm;
        min-height: 297mm;
        padding: 10mm;
        margin: 10mm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    .isisurat {
        padding-left: 25mm;
    }
    .subpage {
        padding: 1cm;
        border: 5px red solid;
        height: 257mm;
        outline: 2cm #FFEAEA solid;
    }
    .judulsurat {
        font: 14pt "Arial";
        font-weight: bold;
        text-decoration: underline;
        letter-spacing: 3px;
        text-align: center;
    }
    .nomorsurat {
        font: 12pt "Arial";
        text-align: center;
    }
    ol {text-align: justify}
    td.rata {text-align: justify}
    hr {border: 1px solid black;}
    @page {
        size: A4;
        margin: 0;
    }
    @media print {
        html, body {
            width: 210mm;
            height: 297mm;        
        }
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }
</style>
<body>
<div class="book">
    <div class="page">
        <img width="100%" src="./asset/img/kop_surat.png"><br /><br />
        <div class="isisurat">
            <div class="judulsurat">SURAT TUGAS</div>
            <div class="nomorsurat">Nomor : <?=$row['no_surat']?></div><br /><br />
            <table width="90%" align="left">
                <tr valign="top">
                    <td width="20%">Menimbang</td><td width="2%">:</td><td class="rata"><?=$row['pertimbangan']?></td>
                </tr>
                <tr valign="top">
                    <td width="20%">Dasar</td><td width="2%">:</td><td class="rata"><?=$row['dasar']?></td>
                </tr>
                <tr valign="top">
                    <td width="20%">Menugaskan</td><td width="2%">:</td>
                    <td>
                        <?php
                            $arraypeg = unserialize($row['penerima_tugas']);
                            if(count($arraypeg)>1) 
                            {
                                for($i=0;$i<count($arraypeg);$i++)
                                {
                                    $idpegawai = $arraypeg[$i];
                                    $queryx = mysqli_query($config, "SELECT * FROM tbl_pegawai WHERE id='$idpegawai'");
                                    $nomor = $i+1;
                                    while($rowx = mysqli_fetch_array($queryx)){
                                        echo '<table>';
                                        echo '<tr valign="top"><td>'.$nomor.'.</td><td>Nama</td><td>:</td><td>'.$rowx['nama'].'</td></tr>';
                                        echo '<tr valign="top"><td></td><td>NIP</td><td>:</td><td>'.$rowx['nip'].'</td></tr>';
                                        echo '<tr valign="top"><td></td><td>Pangkat/Golongan</td><td>:</td><td>'.ucwords(strtolower($rowx['pangkat'])).', '.$rowx['golongan'].'</td></tr>';
                                        echo '<tr valign="top"><td></td><td>Jabatan</td><td>:</td><td>'.ucwords(strtolower($rowx['jabatan'])).'</td></tr>';
                                        echo '</table><br />';
                                    }
                                }
                            } else {
                                $idpegawai = $arraypeg[0];
                                $queryx = mysqli_query($config, "SELECT * FROM tbl_pegawai WHERE id='$idpegawai'");
                                $nomor = $i+1;
                                while($rowx = mysqli_fetch_array($queryx)){
                                    echo '<table>';
                                    echo '<tr valign="top"><td>Nama</td><td>:</td><td>'.$rowx['nama'].'</td></tr>';
                                    echo '<tr valign="top"><td>NIP</td><td>:</td><td>'.$rowx['nip'].'</td></tr>';
                                    echo '<tr valign="top"><td>Pangkat/Golongan</td><td>:</td><td>'.ucwords(strtolower($rowx['pangkat'])).', '.$rowx['golongan'].'</td></tr>';
                                    echo '<tr valign="top"><td>Jabatan</td><td>:</td><td>'.ucwords(strtolower($rowx['jabatan'])).'</td></tr>';
                                    echo '</table><br />';
                                }
                            }
                        ?>
                    </td>
                </tr>
                <tr valign="top">
                    <td width="20%">Untuk</td><td width="2%">:</td><td class="rata"><?=$row['peruntukan']?></td>
                </tr>
                <tr valign="top">
                    <td colspan="3"><br /><p align="justify">Demikian  surat   tugas  ini  untuk dapat dilaksanakan dengan sebaik-baiknya dan membuat laporan setelah selesai melaksanakan surat tugas ini.<br /><br /><br /></td>
                </tr>
                <tr>
                    <td colspan="3">
                    <table width="90%" align="right">
                        <tr><td width="40%"></td><td>Dikeluarkan di</td><td>:</td><td><?=$row['tempat_ttd'];?></td></tr>
                        <tr><td width="40%"></td><td>Tanggal</td><td>:</td><td><?=indoDate($row['tgl_ttd']);?></td></tr>
                        <tr><td width="40%"></td><td colspan="3"><hr /></td></tr>
                        <tr><td width="40%"></td><td align="center" colspan="3"><?=$row['jabatan_ttd']?>,<br /><br /><br /><br /><br /><br />
                                <?php
                                    $pimpinan = $row['nama_ttd'];
                                    $queryz = mysqli_query($config, "SELECT * FROM tbl_pegawai WHERE nama='$pimpinan'");
                                    while($rowz = mysqli_fetch_array($queryz)){
                                        echo $rowz['nama']."<br />NIP. ".$rowz['nip'];
                                    }
                                ?>
                            </td>
                        </tr>
                    </table>
                    </td>
            </table>
            
            
        </div>
    </div>
<?php         
    }
}

?>
</div>
</body>
</html>
<script type="text/javascript">window.print();</script>


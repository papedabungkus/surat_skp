<?php
    //cek session
    if(!empty($_SESSION['admin'])){
?>

<noscript>
    <meta http-equiv="refresh" content="0;URL='./enable-javascript.html'" />
</noscript>

<!-- Footer START -->
<footer class="page-footer">
    <div class="container">
           <div class="row">
               <br/>
           </div>
    </div>
    <div class="footer-copyright blue-grey darken-1 white-text">
        <div class="container" id="footer">
            <?php
                $query = mysqli_query($config, "SELECT * FROM tbl_instansi");
                while($data = mysqli_fetch_array($query)){
                    echo date("Y"); ?> <?php echo $data['nama'];
            } ?>
        </div>
    </div>
</footer>
<!-- Footer END -->

<!-- Javascript START -->
<script type="text/javascript" src="asset/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="asset/js/select2.min.js"></script>
<script type="text/javascript" src="asset/js/materialize.min.js"></script>
<script type="text/javascript" src="asset/js/bootstrap.min.js"></script>
<script type="text/javascript" src="asset/js/jquery.autocomplete.min.js"></script>
<script data-pace-options='{ "ajax": false }' src='asset/js/pace.min.js'></script>
<script type="text/javascript">
$(document).ready(function(){
    //select2
    $('.js-example-basic-multiple').select2({
        placeholder: "Pilih Pegawai Yang Ditugaskan"
    });

    //jquery dropdown
    $(".dropdown-button").dropdown({ hover: false });

    //jquery sidenav on mobile
    $('.button-collapse').sideNav({
        menuWidth: 240,
        edge: 'left',
        closeOnClick: true
    });

    //jquery datepicker
    $('#tgl_surat,#batas_waktu,#dari_tanggal,#sampai_tanggal,#tmt').pickadate({
        selectMonths: true,
        selectYears: 10,
        format: "yyyy-mm-dd"
    });

    //jquery teaxtarea
    $('#isi_ringkas').val('');
    $('#isi_ringkas').trigger('autoresize');

    //jquery dropdown select dan tooltip
    $('select').material_select();
    $('.tooltipped').tooltip({delay: 10});

    //jquery autocomplete
    $( "#kode" ).autocomplete({
        serviceUrl: "kode.php",   // Kode php untuk prosesing data.
        dataType: "JSON",           // Tipe data JSON.
        onSelect: function (suggestion) {
            $( "#kode" ).val(suggestion.kode);
        }
    }); 

    //jquery autocomplete
    $( "#pegawai" ).autocomplete({
        serviceUrl: "pegawai.php",   // Kode php untuk prosesing data.
        dataType: "JSON",           // Tipe data JSON.
        onSelect: function (suggestion) {
            $( "#pegawai" ).val(suggestion.pegawai);
        }
    });

     //jquery autocomplete
     $( "#tujuandisposisi" ).autocomplete({
        serviceUrl: "tujuandisposisi.php",   // Kode php untuk prosesing data.
        dataType: "JSON",           // Tipe data JSON.
        onSelect: function (suggestion) {
            $( "#tujuandisposisi" ).val(suggestion.tujuandisposisi);
        }
    });

    
     //jquery autocomplete
     $( "#catatan" ).autocomplete({
        serviceUrl: "catatan.php",   // Kode php untuk prosesing data.
        dataType: "JSON",           // Tipe data JSON.
        onSelect: function (suggestion) {
            $( "#catatan" ).val(suggestion.catatan);
        }
    });

     //jquery autocomplete
     $( "#nama_ttd" ).autocomplete({
        serviceUrl: "pegawai.php",   // Kode php untuk prosesing data.
        dataType: "JSON",           // Tipe data JSON.
        onSelect: function (suggestion) {
            $( "#nama_ttd" ).val(suggestion.value);
        }
    });


    //jquery untuk menampilkan pemberitahuan
    $("#alert-message").alert().delay(5000).fadeOut('slow');

    //jquery modal
    $('.modal-trigger').leanModal();
 });

</script>
<!-- Javascript END -->

<?php
    } else {
        header("Location: ../");
        die();
    }
?>

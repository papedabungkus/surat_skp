<?php
require_once 'include/config.php';
require_once 'include/functions.php';

// Cegak akses langsung ke source Ajax.
if ( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) ) {

    // Set header type konten.
    header("Content-Type: application/json; charset=UTF-8");

    // Koneksi ke database.
    $conn = conn($host, $username, $password, $database);

    // Deklarasi variable keyword kode.
    $tujuan = $_GET["query"];

    // Query ke database.
    $query = $conn->query("SELECT * FROM tujuan_disposisi WHERE kepada LIKE '%$tujuan%' ORDER BY kepada DESC");
    $result = $query->fetch_all(MYSQLI_ASSOC);

    // Format bentuk data untuk autocomplete.
    foreach($result as $data) {
        $output['suggestions'][] = [
            'value' => $data['id'] . " " . $data['kepada'],
            'tujuandisposisi'  => $data['kepada']
        ];
    }

    if (! empty($output)) {
        // Encode ke format JSON.
        echo json_encode($output);
    }

} else {

    // Tampilkan peringatan.
    echo 'No direct access source!';
}
